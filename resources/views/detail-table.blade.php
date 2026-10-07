@extends('layouts.app')

@section('title', 'Suivi de la table - Le Gourmet')

@push('styles')
<style>
:root {
    --bg: #EEF1FF;
    --bordeaux: #7B1C2A;
    --red: #E8112D;
    --orange: #FF9500;
    --yellow: #FFBF0D;
    --green: #31AA1C;
    --blue: #2F80ED;
    --purple: #8C4AF2;
    --white: #FFFFFF;

    --bordeaux-20: rgba(123, 28, 42, .12);
    --orange-20: rgba(255, 149, 0, .15);
    --orange-50: rgba(255, 149, 0, .5);
    --red-20: rgba(232, 17, 45, .12);
    --green-20: rgba(49, 170, 28, .12);
    --blue-20: rgba(47, 128, 237, .12);
    --purple-20: rgba(140, 74, 242, .12);
    --purple-50: rgba(140, 74, 242, .5);

    --ink: #2C2018;
    --muted: #8A8398;
    --border: #E4E7F7;
}

/* ============ CARTE CHIFFRE D'AFFAIRES ============ */
.revenue-card {
    background: var(--white);
    border: 1px solid var(--orange-50);
    border-radius: 22px;
    padding: 22px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    box-shadow: 0 12px 30px rgba(123, 28, 42, .05);
    margin-bottom: 28px;
}
.revenue-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    background: var(--orange-20);
    color: var(--orange);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}
.revenue-text { flex: 1; min-width: 220px; }
.revenue-label { font-size: .95rem; color: var(--ink); font-weight: 500; margin-bottom: 4px; }
.revenue-amount { font-size: 1.9rem; font-weight: 800; color: var(--orange); line-height: 1.1; }
.revenue-amount .unit { font-size: 1.1rem; font-weight: 600; margin-left: 4px; }
.revenue-growth { font-size: .85rem; color: var(--green); font-weight: 600; margin-top: 2px; }
.revenue-growth i { margin-right: 3px; }
.revenue-date {
    display: flex; align-items: center; gap: 10px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 10px 16px;
    font-size: .9rem;
    color: var(--ink);
    cursor: pointer;
}
.revenue-date i { color: var(--blue); }

/* ============ FIL D'ARIANE ============ */
.breadcrumb-row {
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.breadcrumb-back {
    color: var(--muted);
    font-size: 1.5rem;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
    transition: .2s;
}
.breadcrumb-back:hover { color: var(--bordeaux); }
.breadcrumb-text { display: flex; align-items: center; gap: 14px; flex: 1; flex-wrap: wrap; }
.breadcrumb-parent { font-size: 1.5rem; color: var(--muted); font-weight: 600; text-decoration: none; }
.breadcrumb-parent:hover { color: var(--bordeaux); }
.breadcrumb-chevron { color: var(--muted); font-size: 1.1rem; }
.breadcrumb-current { font-size: 1.6rem; font-weight: 800; color: var(--ink); }

.btn-refresh {
    height: 44px;
    border-radius: 999px;
    border: none;
    padding: 0 22px;
    gap: 10px;
    background: var(--green-20);
    color: var(--green);
    font-size: .95rem;
    font-weight: 700;
    display: inline-flex; align-items: center; justify-content: center;
    cursor: pointer; transition: .25s; flex-shrink: 0;
    margin-bottom: 24px;
}
.btn-refresh:hover { background: var(--green); color: var(--white); }
.btn-refresh.is-spinning i { animation: spin .7s linear; }
@keyframes spin { from { transform: rotate(0); } to { transform: rotate(360deg); } }

/* ============ CARTE RECAPITULATIVE ============ */
.summary-card {
    background: var(--white);
    border-radius: 24px;
    padding: 26px 30px;
    box-shadow: 0 14px 40px rgba(44, 32, 24, .06);
    margin-bottom: 32px;
    display: flex; align-items: center; gap: 24px; flex-wrap: wrap;
}
.summary-icon {
    width: 54px; height: 54px; border-radius: 16px;
    background: var(--orange-20); color: var(--orange);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.summary-info { flex: 1; min-width: 260px; }
.summary-top { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; margin-bottom: 8px; }
.summary-name { font-size: 1.6rem; font-weight: 800; color: var(--ink); }
.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 20px;
    font-size: .78rem; font-weight: 700;
}
.status-badge .dot { width: 7px; height: 7px; border-radius: 50%; }
.status-badge.status-cours { background: var(--orange-20); color: #B36700; }
.status-badge.status-cours .dot { background: var(--orange); }
.status-badge.status-attente { background: var(--blue-20); color: #1758B5; }
.status-badge.status-attente .dot { background: var(--blue); }

.summary-meta {
    display: flex; gap: 22px; flex-wrap: wrap; align-items: center; font-size: .88rem; color: var(--muted);
}
.summary-meta span { display: flex; align-items: center; gap: 6px; }
.summary-meta .icon-persons { color: var(--purple); }
.summary-meta .icon-server { color: var(--blue); }
.summary-total { font-size: .92rem; color: var(--ink); }
.summary-total b { font-size: 1.3rem; color: var(--bordeaux); font-weight: 800; margin-left: 6px; }

.btn-validate {
    background: var(--bordeaux);
    color: var(--white);
    border: none;
    border-radius: 16px;
    padding: 16px 34px;
    font-weight: 700; font-size: 1rem;
    cursor: pointer; transition: .2s;
    box-shadow: 0 14px 28px rgba(123, 28, 42, .25);
    flex-shrink: 0; white-space: nowrap;
}
.btn-validate:hover:not(:disabled) { background: #611420; }
.btn-validate:disabled { background: var(--border); color: var(--muted); cursor: not-allowed; box-shadow: none; }

/* ============ AJOUTER UNE COMMANDE ============ */
.add-order-row { display: flex; justify-content: flex-end; margin-bottom: 22px; }
.add-order-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--bordeaux); font-weight: 700; font-size: 1rem;
    background: none; border: none; cursor: pointer; transition: .2s;
}
.add-order-link:hover { color: #611420; }
.add-order-link i {
    width: 26px; height: 26px; border-radius: 50%;
    background: var(--bordeaux-20); color: var(--bordeaux);
    display: flex; align-items: center; justify-content: center; font-size: .8rem;
}

/* ============ CARTES DE COMMANDES ============ */
.orders-list { display: flex; flex-direction: column; gap: 24px; }
.order-card {
    background: var(--white);
    border-radius: 22px;
    padding: 26px 28px;
    box-shadow: 0 12px 32px rgba(44, 32, 24, .05);
}
.order-card-head {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border);
}
.order-card-id { font-size: 1.15rem; font-weight: 800; color: var(--bordeaux); }
.order-card-time { font-size: .9rem; color: var(--muted); }

.dish-line {
    display: flex; align-items: center; gap: 16px;
    padding: 14px 0; border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
}
.dish-line:last-of-type { border-bottom: none; }
.dish-img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; flex-shrink: 0; background: var(--bg); }
.dish-name { font-weight: 700; font-size: 1rem; color: var(--ink); min-width: 170px; flex: 1; }
.dish-name .dish-qty { color: var(--muted); font-weight: 500; font-size: .9rem; }
.dish-price { font-weight: 700; font-size: .95rem; color: var(--ink); min-width: 90px; text-align: right; }

.dish-status {
    padding: 5px 14px; border-radius: 20px; font-size: .75rem; font-weight: 700;
    min-width: 100px; text-align: center;
}
.dish-status.st-a_preparer { background: var(--blue-20); color: #1758B5; }
.dish-status.st-pret { background: var(--green-20); color: #1F7A10; }
.dish-status.st-servi { background: var(--purple-20); color: #5F2FBF; }
.dish-status.st-termine { background: var(--green-20); color: var(--green); }

.dish-action-btn {
    border-radius: 20px; padding: 8px 18px; font-size: .82rem; font-weight: 700;
    background: var(--white); cursor: pointer; transition: .2s; white-space: nowrap;
}
.dish-action-btn.act-preparer { border: 1.5px solid var(--orange); color: var(--orange); }
.dish-action-btn.act-preparer:hover { background: var(--orange); color: var(--white); }
.dish-action-btn.act-servi { border: 1.5px solid var(--purple); color: var(--purple); }
.dish-action-btn.act-servi:hover { background: var(--purple); color: var(--white); }
.dish-action-btn.act-termine { border: 1.5px solid var(--green); color: var(--green); }
.dish-action-btn.act-termine:hover { background: var(--green); color: var(--white); }
.dish-done-check { color: var(--green); font-size: 1.1rem; min-width: 100px; text-align: center; }

.order-subtotal-row {
    display: flex; justify-content: flex-end; align-items: center; gap: 16px;
    margin-top: 18px; padding-top: 16px; border-top: 1.5px solid var(--border);
}
.order-subtotal-label { font-size: 1.05rem; font-weight: 700; color: var(--ink); }
.order-subtotal-amount { font-size: 1.3rem; font-weight: 800; color: var(--bordeaux); }

/* ============ MODALE ============ */
.modal-content { border-radius: 24px; border: none; overflow: hidden; }
.modal-header { background: var(--bordeaux); color: var(--white); border: none; padding: 20px 26px; }
.modal-title { font-weight: 800; font-size: 1.25rem; }
.btn-close { filter: invert(1) brightness(2); }
.modal-body { padding: 26px; }
.modal-dish-row {
    display: flex; align-items: center; gap: 14px;
    border: 1.5px solid var(--border); border-radius: 14px;
    padding: 10px 14px; margin-bottom: 10px;
}
.modal-dish-row img { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; background: var(--bg); }
.modal-dish-row .m-name { flex: 1; font-weight: 600; font-size: .92rem; }
.modal-dish-row .m-price { font-size: .82rem; color: var(--bordeaux); font-weight: 700; margin-right: 6px; }
.modal-qty-ctrl { display: flex; align-items: center; gap: 8px; }
.modal-qty-btn {
    width: 28px; height: 28px; border-radius: 50%; border: 1.5px solid var(--border);
    background: var(--white); color: var(--bordeaux); font-weight: 800;
    display: flex; align-items: center; justify-content: center; cursor: pointer;
}
.modal-footer { border: none; padding: 18px 26px 26px; }
.btn-modal-cancel { background: var(--bg); color: var(--ink); border: none; border-radius: 14px; padding: 11px 24px; font-weight: 700; font-size: .9rem; }
.btn-modal-add { background: var(--bordeaux); color: var(--white); border: none; border-radius: 14px; padding: 11px 30px; font-weight: 700; font-size: .9rem; }
.btn-modal-add:hover { background: #611420; }
</style>
@endpush

@section('content')
<div class="breadcrumb-row">
    <a href="{{ url('/commandes') }}" class="breadcrumb-back"><i class="fa-solid fa-arrow-left"></i></a>
    <div class="breadcrumb-text">
        <a href="{{ url('/commandes') }}" class="breadcrumb-parent">Gestion des Commandes</a>
        <i class="fa-solid fa-chevron-right breadcrumb-chevron"></i>
        <span class="breadcrumb-current" id="breadcrumbTable">Table 2</span>
    </div>
</div>

<!-- ============ CHIFFRE D'AFFAIRES ============ -->
<div class="revenue-card">
    <div class="revenue-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
    <div class="revenue-text">
        <div class="revenue-label">Chiffres d'affaires journaliers</div>
        <div class="revenue-amount">1 250 000<span class="unit">FCFA</span></div>
        <div class="revenue-growth" style="color:#FF9500;">+10%</div>
    </div>
    <label class="revenue-date">
        <span>03 juillet 2026</span>
        <i class="fa-regular fa-calendar"></i>
    </label>
</div>

<!-- ============ BOUTON REINITIALISER ============ -->
<div>
    <button class="btn-refresh" id="btnRefresh" title="Actualiser"><i class="fa-solid fa-rotate-right"></i> Réinitialiser</button>
</div>

<!-- ============ CARTE RECAPITULATIVE ============ -->
<div class="summary-card">
    <div class="summary-icon"><i class="fa-solid fa-chair"></i></div>
    <div class="summary-info">
        <div class="summary-top">
            <span class="summary-name" id="tableName">Table 2</span>
            <span class="status-badge status-cours" id="tableStatusBadge"><span class="dot"></span> Commande en cours</span>
        </div>
        <div class="summary-meta">
            <span><i class="fa-solid fa-user-group icon-persons"></i> <span id="tablePersons">04 personnes</span></span>
            <span><i class="fa-solid fa-user-tie icon-server"></i> Serveur : <span id="tableServer">Kevin</span></span>
            <span class="summary-total">Total actuel : <b id="tableTotal">38 500 FCFA</b></span>
        </div>
    </div>
    <button class="btn-validate" id="btnValidate" disabled>
        <i class="fa-solid fa-check-double me-2"></i>Valider le paiement
    </button>
</div>

<!-- ============ AJOUTER UNE COMMANDE ============ -->
<div class="add-order-row">
    <button type="button" class="add-order-link" data-bs-toggle="modal" data-bs-target="#addOrderModal">
        <i class="fa-solid fa-plus"></i> Ajouter une commande
    </button>
</div>

<!-- ============ LISTE DES COMMANDES ============ -->
<div class="orders-list" id="ordersList"></div>

<!-- ============ MODALE AJOUTER UNE COMMANDE ============ -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-basket-shopping me-2"></i>Ajouter une commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDishList"></div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn-modal-add" id="btnConfirmAddOrder">Ajouter la commande</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/* ============================================================
   CATALOGUE DES PLATS
============================================================ */
const dishCatalog = [
    {id:'crepe-choc', name:'Crêpe au chocolat', price:4000, img:'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=200&q=80'},
    {id:'chicken-burger', name:'Chicken burger', price:9000, img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80'},
    {id:'tiramisu', name:'Tiramisu', price:2000, img:'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=200&q=80'},
    {id:'desperados', name:'Desperados', price:2000, img:'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=200&q=80'},
    {id:'bissap', name:'Jus de Bissap', price:1000, img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=200&q=80'},
    {id:'fondant', name:'Fondant Chocolat', price:2500, img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=200&q=80'},
];

const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23EEF1FF'/%3E%3C/svg%3E";
const IMG_FB = `this.onerror=null;this.src='${FALLBACK_IMG}'`;

function fmt(p){ return p.toLocaleString('fr-FR') + ' FCFA'; }

/* ============================================================
   ETAT DE LA TABLE / DES COMMANDES
============================================================ */
const TABLES_DB = {
    1:{ name:'Table 1', persons:4, server:'Kevin', status:'cours' },
    2:{ name:'Table 2', persons:4, server:'Kevin', status:'cours' },
    3:{ name:'Table 3', persons:2, server:'Kevin', status:'attente' },
    4:{ name:'Table 4', persons:4, server:'Kevin', status:'cours' },
    5:{ name:'Table 5', persons:4, server:'Kevin', status:'cours' },
    6:{ name:'Table 6', persons:4, server:'Kevin', status:'cours' },
    7:{ name:'Table 7', persons:4, server:'Kevin', status:'attente' },
    8:{ name:'Table 8', persons:4, server:'Kevin', status:'attente' },
    9:{ name:'Table 9', persons:4, server:'Kevin', status:'cours' },
};

const urlParams       = new URLSearchParams(window.location.search);
const requestedId     = parseInt(urlParams.get('table'), 10);
const currentTableId  = TABLES_DB[requestedId] ? requestedId : 2;

const tableInfo = Object.assign({ id: currentTableId }, TABLES_DB[currentTableId]);

let orderCounter = 32;
let orders = [
    {
        numero:'CMD-24', time:'12:34',
        items:[
            {dishId:'crepe-choc', qty:3, status:'a_preparer'},
            {dishId:'chicken-burger', qty:3, status:'pret'},
            {dishId:'tiramisu', qty:4, status:'servi'},
            {dishId:'desperados', qty:5, status:'a_preparer'},
        ]
    },
    {
        numero:'CMD-32', time:'12:34',
        items:[
            {dishId:'crepe-choc', qty:3, status:'a_preparer'},
            {dishId:'chicken-burger', qty:3, status:'pret'},
            {dishId:'tiramisu', qty:4, status:'servi'},
            {dishId:'desperados', qty:5, status:'a_preparer'},
        ]
    }
];

const statusFlow = {
    a_preparer: {label:'À préparer', nextLabel:'Marquer comme en préparation', nextClass:'act-preparer', next:'pret'},
    pret:       {label:'Prêt',        nextLabel:'Marquer comme servis',        nextClass:'act-servi',    next:'servi'},
    servi:      {label:'Servi',       nextLabel:'Terminé',                     nextClass:'act-termine',  next:'termine'},
    termine:    {label:'Terminé',     nextLabel:null,                          nextClass:null,           next:null},
};

function getDish(id){ return dishCatalog.find(d=>d.id===id); }

/* ============================================================
   RENDU DE L'ENTETE / RECAPITULATIF
============================================================ */
function renderSummary(){
    document.getElementById('breadcrumbTable').textContent = tableInfo.name;
    document.getElementById('tableName').textContent = tableInfo.name;
    document.getElementById('tablePersons').textContent = `${String(tableInfo.persons).padStart(2,'0')} personnes`;
    document.getElementById('tableServer').textContent = tableInfo.server;

    const badgeLabels = { cours:'Commande en cours', attente:'En attente de paiement' };
    const badgeEl = document.getElementById('tableStatusBadge');
    badgeEl.className = `status-badge status-${tableInfo.status}`;
    badgeEl.innerHTML = `<span class="dot"></span> ${badgeLabels[tableInfo.status]}`;

    const total = orders.reduce((sum,o)=> sum + o.items.reduce((s,it)=> s + getDish(it.dishId).price*it.qty, 0), 0);
    document.getElementById('tableTotal').textContent = fmt(total);

    const allDone = orders.length>0 && orders.every(o=> o.items.every(it=> it.status==='termine'));
    document.getElementById('btnValidate').disabled = !allDone;
}

/* ============================================================
   RENDU DES CARTES DE COMMANDES
============================================================ */
function renderOrders(){
    const list = document.getElementById('ordersList');
    list.innerHTML = orders.map((order, oIndex)=>{
        const subtotal = order.items.reduce((s,it)=> s + getDish(it.dishId).price*it.qty, 0);
        const itemsHtml = order.items.map((it, iIndex)=>{
            const dish = getDish(it.dishId);
            const flow = statusFlow[it.status];
            const actionHtml = flow.next
                ? `<button class="dish-action-btn ${flow.nextClass}" onclick="advanceStatus(${oIndex},${iIndex})">${flow.nextLabel}${it.status==='servi' ? ' <i class="fa-solid fa-check"></i>' : ''}</button>`
                : `<span class="dish-done-check"><i class="fa-solid fa-circle-check"></i> Terminé</span>`;
            return `
                <div class="dish-line">
                    <img class="dish-img" src="${dish.img}" alt="${dish.name}" ${IMG_FB}>
                    <div class="dish-name">${dish.name} <span class="dish-qty">(×${it.qty})</span></div>
                    <div class="dish-price">${fmt(dish.price*it.qty)}</div>
                    <span class="dish-status st-${it.status}">${flow.label}</span>
                    ${actionHtml}
                </div>
            `;
        }).join('');

        return `
            <div class="order-card">
                <div class="order-card-head">
                    <span class="order-card-id">${order.numero}</span>
                    <span class="order-card-time"><i class="fa-regular fa-clock me-1"></i>${order.time}</span>
                </div>
                ${itemsHtml}
                <div class="order-subtotal-row">
                    <span class="order-subtotal-label">Sous-total :</span>
                    <span class="order-subtotal-amount">${fmt(subtotal)}</span>
                </div>
            </div>
        `;
    }).join('');

    renderSummary();
}

function advanceStatus(oIndex, iIndex){
    const item = orders[oIndex].items[iIndex];
    const flow = statusFlow[item.status];
    if(flow.next){
        item.status = flow.next;
        renderOrders();
    }
}

/* ============================================================
   VALIDATION DU PAIEMENT
============================================================ */
document.getElementById('btnValidate').addEventListener('click', function(){
    if(this.disabled) return;
    window.location.href = `{{ url('/facturation') }}?table=${tableInfo.id}`;
});

/* ============================================================
   RAFRAICHISSEMENT
============================================================ */
document.getElementById('btnRefresh').addEventListener('click', function(){
    this.classList.add('is-spinning');
    setTimeout(()=> this.classList.remove('is-spinning'), 700);
    renderOrders();
});

/* ============================================================
   MODALE "AJOUTER UNE COMMANDE"
============================================================ */
let modalSelection = {};

function renderModalDishes(){
    const wrap = document.getElementById('modalDishList');
    wrap.innerHTML = dishCatalog.map(d=>{
        const qty = modalSelection[d.id] || 0;
        return `
            <div class="modal-dish-row">
                <img src="${d.img}" alt="${d.name}" ${IMG_FB}>
                <span class="m-name">${d.name}</span>
                <span class="m-price">${fmt(d.price)}</span>
                <div class="modal-qty-ctrl">
                    <button type="button" class="modal-qty-btn" onclick="changeModalQty('${d.id}',-1)"><i class="fa-solid fa-minus"></i></button>
                    <span style="min-width:20px;text-align:center;font-weight:700;">${qty}</span>
                    <button type="button" class="modal-qty-btn" onclick="changeModalQty('${d.id}',1)"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        `;
    }).join('');
}

function changeModalQty(id, delta){
    const current = modalSelection[id] || 0;
    modalSelection[id] = Math.max(0, current + delta);
    renderModalDishes();
}

document.getElementById('addOrderModal').addEventListener('show.bs.modal', function(){
    modalSelection = {};
    renderModalDishes();
});

document.getElementById('btnConfirmAddOrder').addEventListener('click', function(){
    const selectedItems = Object.entries(modalSelection)
        .filter(([id,qty])=> qty>0)
        .map(([id,qty])=> ({dishId:id, qty, status:'a_preparer'}));

    if(!selectedItems.length){
        alert('Veuillez sélectionner au moins un plat.');
        return;
    }

    orderCounter += 1;
    orders.push({
        numero:`CMD-${orderCounter}`,
        time:new Date().toLocaleTimeString('fr-FR',{hour:'2-digit',minute:'2-digit'}),
        items:selectedItems
    });

    renderOrders();
    bootstrap.Modal.getInstance(document.getElementById('addOrderModal')).hide();
});

/* ============================================================
   INIT
============================================================ */
renderOrders();
</script>
@endpush