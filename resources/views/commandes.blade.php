@extends('layouts.app')

@section('title', 'Gestion des commandes — Le Gourmet')
@section('page-id', 'commandes')

@push('styles')
<style>
    :root {
        --bg: #EEF1FF;
        --bordeaux: #7B1C2A;
        --bordeaux-20: rgba(123, 28, 42, 0.12);
        --rouge: #E8112D;
        --orange: #FF9500;
        --orange-50: rgba(255, 149, 0, 0.5);
        --orange-20: rgba(255, 149, 0, 0.16);
        --jaune: #FFBF0D;
        --vert: #31AA1C;
        --vert-20: rgba(49, 170, 28, 0.16);
        --bleu: #2F80ED;
        --bleu-20: rgba(47, 128, 237, 0.16);
        --violet: #8C4AF2;
        --blanc: #FFFFFF;
        --text-dark: #2B2330;
        --text-muted: #8A8494;
    }

    * { font-family: 'Playfair Display', serif; }

    body {
        background: var(--bg);
        color: var(--text-dark);
        min-height: 100vh;
    }

    .cmd-main {
        padding: 28px 32px 60px;
    }

    /* ---------- Carte chiffre d'affaires ---------- */
    .kpi-card {
        background: var(--blanc);
        border: 1.5px solid var(--orange);
        border-radius: 16px;
        padding: 20px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        box-shadow: 0 4px 18px rgba(123, 28, 42, 0.06);
        margin-bottom: 6px;
    }

    .kpi-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .kpi-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: var(--orange-20);
        color: var(--orange);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .kpi-label {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 5px;
    }

    .kpi-amount {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 30px;
        color: var(--orange);
        line-height: 1;
    }

    .kpi-amount .fcfa {
        font-size: 14px;
        letter-spacing: 1px;
        margin-left: 4px;
    }

    .kpi-growth {
        color: var(--orange);
        font-weight: 600;
        font-size: 13.5px;
        margin-top: 5px;
    }

    .kpi-date {
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--blanc);
        border: 1px solid #E7E4F2;
        border-radius: 12px;
        padding: 11px 20px;
        font-weight: 500;
        color: #333;
    }

    .kpi-date i { color: var(--bleu); }

    @media (max-width: 860px) {
        .cmd-main { padding: 16px 16px 40px; }
    }

    @media (max-width: 767.98px) {
        .kpi-card { flex-direction: column; align-items: flex-start; padding: 18px 20px; gap: 14px; }
        .kpi-date { width: 100%; justify-content: space-between; }
    }

    /* ---------- Navigation boutons ---------- */
    .nav-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 26px;
    }

    .nav-btn {
        text-align: center;
        padding: 20px 24px;
        border-radius: 18px;
        font-size: 1.15rem;
        font-weight: 700;
        border: 1px solid #E4E7F7;
        background: var(--blanc);
        color: var(--bordeaux);
        cursor: pointer;
        transition: all .2s ease;
        box-shadow: none;
    }

    .nav-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(123, 28, 42, 0.12);
    }

    .nav-btn.active {
        background: var(--bordeaux);
        color: var(--blanc);
        border-color: var(--bordeaux);
        box-shadow: 0 14px 30px rgba(123, 28, 42, .28);
    }

    .refresh-btn {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--vert-20);
        color: var(--vert);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
        transition: transform .4s ease, background .2s ease;
    }

    .refresh-btn:hover {
        background: var(--vert);
        color: var(--blanc);
    }

    .refresh-btn.spinning i {
        animation: spin .6s linear;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* ---------- Barre recherche / filtre ---------- */
    .search-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 22px;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1 1 380px;
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .search-box input {
        width: 100%;
        border-radius: 999px;
        border: 1px solid rgba(123, 28, 42, 0.14);
        background: var(--blanc);
        padding: 14px 20px 14px 48px;
        font-size: 1rem;
        color: var(--text-dark);
        outline: none;
        transition: box-shadow .2s ease, border-color .2s ease;
    }

    .search-box input:focus {
        border-color: var(--bordeaux);
        box-shadow: 0 0 0 3px var(--bordeaux-20);
    }

    .filter-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 22px;
        border-radius: 999px;
        border: 1px solid rgba(123, 28, 42, 0.14);
        background: var(--blanc);
        color: var(--text-dark);
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
        transition: box-shadow .2s ease;
    }

    .filter-btn:hover { box-shadow: 0 6px 16px rgba(123, 28, 42, 0.08); }
    .filter-btn i.fa-filter { color: var(--bordeaux); }

    .filter-dropdown {
        position: relative;
    }

    .filter-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        background: var(--blanc);
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(43, 35, 48, 0.14);
        padding: 10px;
        min-width: 220px;
        z-index: 20;
        display: none;
    }

    .filter-menu.show { display: block; }

    .filter-option {
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background .15s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-option:hover { background: var(--bg); }
    .filter-option i { width: 16px; font-size: 0.7rem; }

    /* ---------- Grille des tables ---------- */
    .tables-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-top: 26px;
    }

    @media (max-width: 992px) {
        .tables-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .tables-grid { grid-template-columns: 1fr; }
    }

    .table-card {
        background: var(--blanc);
        border-radius: 18px;
        padding: 20px 22px;
        box-shadow: 0 6px 18px rgba(43, 35, 48, 0.06);
        border: 2px solid transparent;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        text-decoration: none;
        color: inherit;
        display: block;
        animation: fadeUp .35s ease both;
    }

    .table-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(43, 35, 48, 0.12);
    }

    .table-card.is-active {
        border-color: var(--orange);
    }

    .table-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .table-identity {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .table-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .table-icon.status-progress { background: var(--orange-20); color: var(--orange); }
    .table-icon.status-waiting { background: var(--bleu-20); color: var(--bleu); }

    .table-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .table-people {
        font-size: 0.85rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .status-badge.progress { background: var(--orange-20); color: var(--orange); }
    .status-badge.waiting { background: var(--bleu-20); color: var(--bleu); }

    .status-badge .dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: currentColor;
    }

    .table-divider {
        border-top: 1px solid rgba(43, 35, 48, 0.08);
        margin: 16px 0 14px;
    }

    .table-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-orders-count {
        font-size: 0.88rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-amount {
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--text-dark);
    }

    .table-arrow {
        color: var(--bordeaux);
        font-size: 0.95rem;
        transition: transform .2s ease;
    }

    .table-card:hover .table-arrow {
        transform: translateX(4px);
    }

    .amount-arrow-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    /* ---------- Bandeau info ---------- */
    .info-banner {
        margin-top: 26px;
        background: rgba(47, 128, 237, 0.10);
        border-left: 4px solid var(--bleu);
        border-radius: 12px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .info-banner i { color: var(--bleu); font-size: 1.1rem; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<main class="main cmd-main">

    <!-- Carte chiffre d'affaires -->
    <div class="kpi-card">
        <div class="kpi-left">
            <div class="kpi-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
            <div>
                <div class="kpi-label">Chiffres d'affaires journaliers</div>
                <div class="kpi-amount" style="color:var(--orange)">1 250 000 <span class="fcfa" style="color:var(--orange)">FCFA</span></div>
                <div class="kpi-growth" style="color:var(--orange)">+ 10%</div>
            </div>
        </div>
        <div class="kpi-date">
            <span>03 juillet 2026</span>
            <i class="fa-regular fa-calendar"></i>
        </div>
    </div>

    <!-- Navigation -->
    <section class="nav-row">
        <a class="nav-btn" id="btnCreer" href="{{ route('commandes.create') }}" style="text-decoration: none; color: #2B2330;">Créer une commande</a>
        <button type="button" class="nav-btn active" id="btnGestion">Gestion des commandes</button>
    </section>

    <!-- Recherche / Filtre -->
    <section class="search-row">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Rechercher une table...">
        </div>
        <div class="filter-dropdown">
            <button type="button" class="filter-btn" id="filterToggle">
                <i class="fa-solid fa-filter"></i>
                <span>Filtrer</span>
                <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
            </button>
            <div class="filter-menu" id="filterMenu">
                <div class="filter-option" data-filter="all"><i class="fa-solid fa-circle" style="color:var(--text-muted)"></i> Toutes les tables</div>
                <div class="filter-option" data-filter="progress"><i class="fa-solid fa-circle" style="color:var(--orange)"></i> Commande en cours</div>
                <div class="filter-option" data-filter="waiting"><i class="fa-solid fa-circle" style="color:var(--bleu)"></i> En attente de paiement</div>
            </div>
        </div>
        <button type="button" class="refresh-btn" id="btnRefresh" title="Actualiser">
            <i class="fa-solid fa-arrows-rotate"></i>
        </button>
    </section>

    <!-- Grille des tables -->
    <section class="tables-grid" id="tablesGrid">
        <!-- Les cartes sont générées par JavaScript -->
    </section>

    <!-- Bandeau info -->
    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        <span>Cliquez sur une table pour afficher le détail des commandes.</span>
    </div>

</main>
@endsection

@push('scripts')
<script>
    // ---------- Données des tables (À adapter selon les données réelles de l'API / Laravel) ----------
    const tablesData = [
        { id: 1, name: "Table 1", people: 4, status: "progress", orders: 2, amount: 38500 },
        { id: 2, name: "Table 2", people: 4, status: "progress", orders: 1, amount: 3500 },
        { id: 3, name: "Table 3", people: 2, status: "waiting",  orders: 3, amount: 48500 },
        { id: 4, name: "Table 4", people: 4, status: "progress", orders: 2, amount: 38500 },
        { id: 5, name: "Table 5", people: 4, status: "progress", orders: 2, amount: 38500 },
        { id: 6, name: "Table 6", people: 4, status: "progress", orders: 2, amount: 38500 },
        { id: 7, name: "Table 7", people: 4, status: "waiting",  orders: 2, amount: 38500 },
        { id: 8, name: "Table 8", people: 4, status: "waiting",  orders: 2, amount: 38500 },
        { id: 9, name: "Table 9", people: 4, status: "progress", orders: 2, amount: 38500 },
    ];

    const statusConfig = {
        progress: { label: "Commande en cours",       badgeClass: "progress", iconClass: "status-progress" },
        waiting:  { label: "En attente de paiement",  badgeClass: "waiting",  iconClass: "status-waiting"  }
    };

    const grid = document.getElementById('tablesGrid');
    let currentFilter = 'all';
    let currentSearch = '';

    function formatFCFA(n) {
        return n.toLocaleString('fr-FR').replace(/,/g, ' ') + ' FCFA';
    }

    function renderTables() {
        const term = currentSearch.trim().toLowerCase();
        const filtered = tablesData.filter(t => {
            const matchesFilter = currentFilter === 'all' || t.status === currentFilter;
            const matchesSearch = t.name.toLowerCase().includes(term);
            return matchesFilter && matchesSearch;
        });

        grid.innerHTML = '';

        if (filtered.length === 0) {
            grid.innerHTML = `<div style="grid-column:1/-1; text-align:center; color:var(--text-muted); padding:40px 0;">
                <i class="fa-regular fa-face-frown" style="font-size:1.6rem; display:block; margin-bottom:10px;"></i>
                Aucune table ne correspond à votre recherche.
            </div>`;
            return;
        }

        filtered.forEach((t, index) => {
            const cfg = statusConfig[t.status];
            const card = document.createElement('a');
            // Utilisation des routes nommées Laravel si nécessaire
            card.href = `{{ url('/tables') }}/${t.id}`;
            card.className = 'table-card';
            card.style.animationDelay = `${index * 0.03}s`;
            card.setAttribute('role', 'button');
            card.setAttribute('aria-label', `Voir le détail de la ${t.name}`);
            card.innerHTML = `
                <div class="table-card-top">
                    <div class="table-identity">
                        <div class="table-icon ${cfg.iconClass}"><i class="fa-solid fa-chair"></i></div>
                        <div>
                            <div class="table-name">${t.name}</div>
                            <div class="table-people"><i class="fa-solid fa-user"></i> ${String(t.people).padStart(2,'0')} personnes</div>
                        </div>
                    </div>
                    <div class="status-badge ${cfg.badgeClass}"><span class="dot"></span>${cfg.label}</div>
                </div>
                <div class="table-divider"></div>
                <div class="table-bottom">
                    <div class="table-orders-count"><i class="fa-regular fa-file-lines"></i> ${t.orders} commande${t.orders > 1 ? 's' : ''}</div>
                    <div class="amount-arrow-wrap">
                        <div class="table-amount">${formatFCFA(t.amount)}</div>
                        <i class="fa-solid fa-chevron-right table-arrow"></i>
                    </div>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    // ---------- Recherche ----------
    document.getElementById('searchInput').addEventListener('input', (e) => {
        currentSearch = e.target.value;
        renderTables();
    });

    // ---------- Filtre ----------
    const filterToggle = document.getElementById('filterToggle');
    const filterMenu = document.getElementById('filterMenu');

    filterToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        filterMenu.classList.toggle('show');
    });

    document.querySelectorAll('.filter-option').forEach(opt => {
        opt.addEventListener('click', () => {
            currentFilter = opt.dataset.filter;
            filterMenu.classList.remove('show');
            renderTables();
        });
    });

    document.addEventListener('click', () => filterMenu.classList.remove('show'));

    // ---------- Navigation boutons ----------
    document.getElementById('btnGestion').addEventListener('click', function() {
        document.getElementById('btnCreer').classList.remove('active');
        this.classList.add('active');
    });

    // ---------- Rafraîchir ----------
    document.getElementById('btnRefresh').addEventListener('click', function() {
        this.classList.add('spinning');
        setTimeout(() => this.classList.remove('spinning'), 600);
        renderTables();
    });

    // ---------- Rendu initial ----------
    renderTables();
</script>
@endpush