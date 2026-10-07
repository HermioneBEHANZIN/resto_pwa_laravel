@extends('layouts.app')

@section('title', 'Le Gourmet — Plan de Salle')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --wine: #7B1C2A;
    --red: #E8112D;
    --yellow: #FFBF0D;
    --orange: #FF9500;
    --orange-50: #FFC266;
    --orange-20: #FFE9CC;
    --green: #31AA1C;
    --green-50: #98D58E;
    --green-20: #D9F0D5;
    --blue: #2F80ED;
    --blue-50: #2F80ED80;
    --blue-20: #2F80ED33;
    --purple: #8C4AF2;
    --purple-50: #C6A4F8;
    --purple-20: #EDE0FD;

    --bg: #EEF0FA;
    --black: #1E1E1E;
    --gray-text: #6B6B6B;
    --gray-line: #E7E9F5;
  }

  body {
    background: var(--bg);
    font-family: 'Playfair Display', serif;
    color: var(--black);
    min-height: 100vh;
  }

  h1, h2, h3, .serif {
    font-family: 'Playfair Display', serif;
  }

  /* ---- Carte chiffre d'affaires ---- */
  .ca-card {
    background: #fff;
    border: 1.5px solid var(--orange);
    border-radius: 24px;
    padding: 22px 32px;
    display: flex;
    align-items: center;
    gap: 26px;
    margin-bottom: 30px;
  }
  .ca-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: var(--orange-20);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .ca-icon i {
    color: var(--orange);
    font-size: 22px;
  }
  .ca-mid {
    flex: 1;
    min-width: 0;
  }
  .ca-label {
    font-size: 13.5px;
    color: var(--gray-text);
    margin-bottom: 6px;
  }
  .ca-amount {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 800;
    color: var(--orange);
    line-height: 1;
  }
  .ca-amount small {
    font-size: 16px;
    font-weight: 700;
  }
  .ca-delta {
    font-size: 12.5px;
    color: var(--orange-50);
    font-weight: 600;
    margin-top: 6px;
  }

  .date-pill {
    background: #fff;
    border-radius: 30px;
    padding: 12px 22px;
    display: flex;
    align-items: center;
    gap: 30px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, .05);
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
  }
  .date-pill i {
    color: var(--blue);
  }

  /* ---- Titre page ---- */
  .page-title {
    font-size: 36px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 22px;
  }

  /* ---- Légende statuts ---- */
  .legend-bar {
    background: #fff;
    border-radius: 20px;
    padding: 16px 30px;
    display: flex;
    align-items: center;
    gap: 100px;
    margin-bottom: 26px;
  }
  .legend-item {
    display: flex;
    gap: 23px;
    font-size: 13.5px;
    color: var(--black);
  }
  .legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
  }
  .legend-dot.libre { background: var(--green); }
  .legend-dot.occupee { background: var(--yellow); }
  .legend-dot.commande { background: var(--orange); }
  .legend-dot.serveur { background: var(--red); position: relative; }
  .legend-dot.paiement { background: var(--blue); }

  .reset-btn {
    margin-left: auto;
    background: #fff;
    border: 1px solid var(--gray-line);
    border-radius: 10px;
    padding: 9px 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 500;
    color: var(--black);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .04);
    cursor: pointer;
    margin-bottom: 20px;
  }
  .reset-btn i {
    color: var(--green);
    padding-bottom: 2px;
  }
  .reset-btn:hover {
    background: #FAFAFF;
  }

  /* ---- Contenu principal (2 colonnes) ---- */
  .room-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 28px;
    align-items: start;
  }

  /* ---- Grille des tables ---- */
  .tables-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 22px;
  }

  .table-cell {
    position: relative;
    aspect-ratio: 1/1;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--black);
    cursor: pointer;
    border: 2px solid transparent;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .table-cell:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, .08);
  }
  .table-cell.selected {
    border-color: var(--wine);
  }

  .table-cell.status-libre { background: var(--green-50); }
  .table-cell.status-occupee { background: #FFF3CC; }
  .table-cell.status-commande { background: var(--orange-50); }
  .table-cell.status-paiement { background: var(--blue-50); }

  .table-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    border: 2px solid #fff;
  }
  .table-cell.status-libre .table-badge { background: var(--green); }
  .table-cell.status-occupee .table-badge { background: var(--yellow); color: var(--black); }
  .table-cell.status-commande .table-badge { background: var(--orange); }
  .table-cell.status-paiement .table-badge { background: var(--blue); }

  .table-bell {
    position: absolute;
    top: -8px;
    left: -8px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--red);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    border: 2px solid #fff;
  }

  /* ---- Carte de commande active ---- */
  .order-card {
    background: #fff;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
  }

  .order-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .order-table-title {
    font-size: 26px;
    font-weight: 800;
  }

  .order-avatars {
    display: flex;
    align-items: center;
  }
  .o-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
    margin-left: -10px;
    border: 2px solid #fff;
  }
  .o-avatar:first-child { margin-left: 0; }
  .o-avatar-extra {
    background: #fff;
    color: var(--black);
    font-weight: 800;
    font-size: 12px;
  }

  .order-section-title {
    font-family: 'Playfair Display', serif;
    color: var(--wine);
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 14px;
  }

  .order-item-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--orange-20);
    border-radius: 14px;
    padding: 13px 16px;
    margin-bottom: 10px;
    font-size: 14px;
  }
  .order-item-name { font-weight: 500; }
  .order-item-price { font-weight: 700; white-space: nowrap; }

  .order-empty {
    padding: 30px 10px;
    text-align: center;
    color: var(--gray-text);
    font-size: 13.5px;
  }
  .order-empty i {
    font-size: 28px;
    display: block;
    margin-bottom: 10px;
    color: #DADFF5;
  }

  .order-divider {
    height: 1px;
    background: var(--gray-line);
    margin: 18px 0;
  }

  .order-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }
  .order-total-label { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; }
  .order-total-val { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 800; color: var(--red); }
  .order-wait-val { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 800; color: var(--blue); }
  .order-wait-label { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: var(--blue); }

  .pay-btn {
    width: 100%;
    margin-top: 20px;
    background: var(--wine);
    color: #fff;
    border: none;
    border-radius: 40px;
    padding: 16px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
  }
  .pay-btn:disabled { opacity: .45; cursor: not-allowed; }
  .pay-btn:hover:not(:disabled) { opacity: .92; }

  /* =========================================================
     RESPONSIVE
  ========================================================= */
  @media (max-width: 1200px) {
    .room-layout { grid-template-columns: 1fr; }
  }

  @media (max-width: 860px) {
    .page-title { font-size: 22px; margin-bottom: 0; }
    .page-title-row { flex-wrap: wrap; gap: 12px; margin-bottom: 18px; }

    .ca-card {
      flex-direction: column;
      align-items: flex-start;
      gap: 14px;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 2px 14px rgba(20, 10, 20, .06);
      margin-bottom: 16px;
    }
    .date-pill { width: 100%; justify-content: space-between; }

    .legend-bar {
      flex-wrap: wrap;
      gap: 12px 18px;
      padding: 16px 18px;
      border-radius: 16px;
      box-shadow: 0 2px 14px rgba(20, 10, 20, .05);
      margin-bottom: 18px;
    }
    .legend-item { font-size: 12.5px; gap: 8px; }

    .reset-btn { width: 100%; justify-content: center; margin-left: 0; order: 99; }

    .room-layout { gap: 16px; }

    .tables-grid {
      grid-auto-flow: row;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: none;
      overflow-x: visible;
      gap: 12px;
      padding-bottom: 0;
    }
    .table-cell { border-radius: 16px; font-size: 14px; }
    .table-badge { width: 20px; height: 20px; font-size: 9.5px; top: -6px; right: -6px; }
    .table-bell { width: 18px; height: 18px; font-size: 8.5px; top: -6px; left: -6px; }

    .order-card { border-radius: 20px; padding: 20px; }
    .order-item-name { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 60%; }
  }

  @media (max-width: 480px) {
    .ca-amount { font-size: 24px; }
    .order-table-title { font-size: 22px; }

    .tables-grid { grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .table-cell { font-size: 13px; border-radius: 14px; }
    .legend-item { font-size: 12px; }
    .legend-bar { gap: 10px 14px; }
  }
</style>
@endpush

@section('content')
<main class="main">

  <!-- CA CARD -->
  <div class="ca-card">
    <div class="ca-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
    <div class="ca-mid">
      <div class="ca-label">Chiffres d'affaires journaliers</div>
      <div class="ca-amount" id="ca-amount">0 <small>FCFA</small></div>
      <div class="ca-delta" id="ca-delta">+ 10%</div>
    </div>
    <div class="date-pill">
      <span id="ca-date">—</span>
      <i class="bi bi-calendar3"></i>
    </div>
  </div>

  <div style="display: flex;" class="page-title-row">
    <h1 class="page-title">Plan de salle</h1>
    <button type="button" class="reset-btn" id="resetBtn"><i class="fa-solid fa-rotate-right"></i> Réinitialiser</button>
  </div>

  <!-- LEGEND -->
  <div class="legend-bar">
    <div class="legend-item"><span class="legend-dot libre"></span>Libre</div>
    <div class="legend-item"><span class="legend-dot occupee"></span>Occupée</div>
    <div class="legend-item"><span class="legend-dot commande"></span>Commande en cours</div>
    <div class="legend-item">
      <i class="fa-solid fa-bell" style="
         width:22px; height:22px; border-radius:50%;
         background:var(--red); color:#fff;
         display:flex; align-items:center; justify-content:center;
         font-size:10px; border:2px solid #fff;"></i>Demande de serveur
    </div>
    <div class="legend-item"><span class="legend-dot paiement"></span>Attente de paiement</div>
  </div>

  <!-- ROOM LAYOUT -->
  <div class="room-layout">
    <div class="tables-grid" id="tablesGrid"><!-- généré en JS --></div>

    <div class="order-card">
      <div class="order-head">
        <div class="order-table-title" id="order-table-title">—</div>
        <div class="order-avatars" id="order-avatars"></div>
      </div>

      <div class="order-section-title">Commande active</div>
      <div id="order-items"><!-- généré en JS --></div>

      <div class="order-divider"></div>

      <div class="order-total-row">
        <span class="order-total-label">Total</span>
        <span class="order-total-val" id="order-total">0 Fcfa</span>
      </div>
      <div class="order-total-row">
        <span class="order-wait-label">Attente de paiement</span>
        <span class="order-wait-val" id="order-wait">0 Fcfa</span>
      </div>

      <button type="button" class="pay-btn" id="payBtn">Valider le paiement</button>
    </div>
  </div>

</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  /* ==========================================================================
     CARTE CHIFFRE D'AFFAIRES — dynamique
  ========================================================================== */
  const revenueState = { amount: 1250000, delta: '+ 10%', date: new Date(2026, 6, 3) };

  function renderRevenue() {
    const caAmountEl = document.getElementById('ca-amount');
    const caDeltaEl = document.getElementById('ca-delta');
    const caDateEl = document.getElementById('ca-date');

    if (caAmountEl) {
      caAmountEl.innerHTML = revenueState.amount.toLocaleString('fr-FR') + ' <small>FCFA</small>';
    }
    if (caDeltaEl) {
      caDeltaEl.textContent = revenueState.delta;
    }
    if (caDateEl) {
      caDateEl.textContent = revenueState.date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });
    }
  }
  renderRevenue();

  /* ==========================================================================
     DONNÉES DES TABLES
  ========================================================================== */
  const STATUS = {
    libre:    { label: 'Libre',               class: 'status-libre' },
    occupee:  { label: 'Occupée',             class: 'status-occupee' },
    commande: { label: 'Commande en cours',    class: 'status-commande' },
    paiement: { label: 'Attente de paiement', class: 'status-paiement' },
  };

  let tablesState = [
    { id: 1,  status: 'libre' },
    { id: 2,  status: 'commande', badge: 2 },
    { id: 3,  status: 'libre' },
    { id: 4,  status: 'libre' },
    { id: 5,  status: 'paiement', badge: 2 },
    { id: 6,  status: 'paiement', badge: 3, serverCall: true },
    { id: 7,  status: 'paiement', badge: 1 },
    { id: 8,  status: 'libre' },
    { id: 9,  status: 'paiement', badge: 1 },
    { id: 10, status: 'paiement', badge: 3, serverCall: true },
    { id: 11, status: 'libre' },
    { id: 12, status: 'occupee', badge: 1 },
    { id: 13, status: 'libre' },
    { id: 14, status: 'libre', serverCall: true },
    { id: 15, status: 'paiement', badge: 1, isActiveOrder: true },
    { id: 16, status: 'paiement', badge: 1 },
  ];

  let selectedTableId = 15;

  function renderTables() {
    const grid = document.getElementById('tablesGrid');
    if (!grid) return;

    grid.innerHTML = tablesState.map(t => {
      const st = STATUS[t.status];
      const selected = t.id === selectedTableId ? ' selected' : '';
      const badge = t.badge ? `<span class="table-badge">${t.badge}</span>` : '';
      const bell = t.serverCall ? `<span class="table-bell"><i class="fa-solid fa-bell"></i></span>` : '';
      return `
        <div class="table-cell ${st.class}${selected}" data-id="${t.id}">
          T ${t.id}
          ${badge}
          ${bell}
        </div>
      `;
    }).join('');

    grid.querySelectorAll('.table-cell').forEach(cell => {
      cell.addEventListener('click', () => {
        selectedTableId = Number(cell.dataset.id);
        renderTables();
        renderOrderCard();
      });
    });
  }

  /* ==========================================================================
     COMMANDE ACTIVE
  ========================================================================== */
  const ordersByTable = {
    15: {
      guests: [{ color: '#3B82F6' }, { color: '#22C55E' }, { color: '#F4A623' }],
      extraGuests: 1,
      items: [
        { name: 'Burger Royal ×3', price: 9000 },
        { name: 'Pizza margherita', price: 4500 },
        { name: 'Tiramisu', price: 2500 },
        { name: 'Poulet mayonnaise', price: 2000 },
      ],
      paid: 0,
    },
  };

  function fmt(n) { return n.toLocaleString('fr-FR') + ' Fcfa'; }

  function renderOrderCard() {
    const order = ordersByTable[selectedTableId];
    const titleEl = document.getElementById('order-table-title');
    const avatarsEl = document.getElementById('order-avatars');
    const itemsEl = document.getElementById('order-items');
    const totalEl = document.getElementById('order-total');
    const waitEl = document.getElementById('order-wait');
    const payBtn = document.getElementById('payBtn');

    if (titleEl) titleEl.textContent = 'Table ' + selectedTableId;

    if (!order) {
      if (avatarsEl) avatarsEl.innerHTML = '';
      if (itemsEl) itemsEl.innerHTML = `<div class="order-empty"><i class="fa-solid fa-utensils"></i>Aucune commande active pour cette table.</div>`;
      if (totalEl) totalEl.textContent = fmt(0);
      if (waitEl) waitEl.textContent = fmt(0);
      if (payBtn) payBtn.disabled = true;
      return;
    }

    if (avatarsEl) {
      avatarsEl.innerHTML = order.guests.map(g =>
        `<div class="o-avatar" style="background:${g.color};"><i class="fa-solid fa-user"></i></div>`
      ).join('') + (order.extraGuests ? `<div class="o-avatar o-avatar-extra">+${order.extraGuests}</div>` : '');
    }

    if (itemsEl) {
      itemsEl.innerHTML = order.items.map(it => `
        <div class="order-item-row">
          <span class="order-item-name">${it.name}</span>
          <span class="order-item-price">${fmt(it.price)}</span>
        </div>
      `).join('');
    }

    const total = order.items.reduce((sum, it) => sum + it.price, 0);
    const remaining = Math.max(0, total - order.paid);

    if (totalEl) totalEl.textContent = fmt(total);
    if (waitEl) waitEl.textContent = fmt(remaining);
    if (payBtn) {
      payBtn.disabled = remaining === 0;
      payBtn.textContent = remaining === 0 ? 'Commande payée' : 'Valider le paiement';
    }
  }

  /* Paiement */
  const payBtn = document.getElementById('payBtn');
  if (payBtn) {
    payBtn.addEventListener('click', () => {
      const order = ordersByTable[selectedTableId];
      if (!order) return;
      order.paid = order.items.reduce((sum, it) => sum + it.price, 0);

      const table = tablesState.find(t => t.id === selectedTableId);
      if (table) {
        table.status = 'libre';
        delete table.badge;
        delete table.serverCall;
      }

      renderTables();
      renderOrderCard();
    });
  }

  /* Réinitialiser */
  const resetBtn = document.getElementById('resetBtn');
  if (resetBtn) {
    resetBtn.addEventListener('click', () => {
      tablesState = tablesState.map(t => ({ id: t.id, status: 'libre' }));
      renderTables();
      renderOrderCard();
    });
  }

  renderTables();
  renderOrderCard();
});
</script>
@endpush