@extends('layouts.app')

@section('title', 'Le Gourmet — Commandes Table 15')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root{
  --bg-pink:#F9DDE2;
  --card-pink:#DDACB4;
  --wine:#7A2030;
  --wine-dark:#5C1622;
  --gold:#C9A227;
  --text-dark:#2B2B2B;
  --white:#FFFFFF;
  --cash-green:#3FAE49;
  --shadow-card: 0 4px 10px rgba(122,32,48,0.12);
  --radius-lg: 26px;
  --radius-md: 18px;
  --radius-pill: 999px;
}

body {
  background: var(--bg-pink) !important;
  font-family: 'Playfair Display', serif;
  color: var(--text-dark);
  padding-top: 0 !important;
}

.item-del-btn:disabled{ opacity:.35; cursor:not-allowed; }

.phone{
  max-width:100%;
  margin:0 auto;
  min-height:100vh;
  background:var(--bg-pink);
  display:flex;
  flex-direction:column;
  position:relative;
  padding-bottom:90px;
}

/* ---------- Header ---------- */
.header{
  padding:40px 24px 1px;
}
.back-btn{
  width:48px; height:48px;
  border-radius:50%;
  background:rgba(122,32,48,0.12);
  border:none;
  display:flex; align-items:center; justify-content:center;
  color:var(--wine);
  font-size:22px;
  margin-bottom:16px;
  cursor:pointer;
}
.title-row{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
}
.title-row h1{
  font-family:'Playfair Display', serif;
  font-weight:700;
  color:var(--wine);
  font-size:2.3rem;
  line-height:1.05;
}
.title-row h2{
  font-family:'Playfair Display', serif;
  font-weight:600;
  color:var(--text-dark);
  font-size:1.9rem;
  margin-top:2px;
}
.order-avatars{display:flex;align-items:center;gap:0;flex-shrink:0;}
.o-avatar{
  width:34px;height:34px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.7rem;margin-left:-15px;
  border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.12);
}
.o-avatar:first-child{margin-left:0;}
.o-avatar:nth-child(1){background:#fff;color:#3B82F6;}
.o-avatar:nth-child(2){background:#fff;color:#22C55E;}
.o-avatar:nth-child(3){background:#fff;color:#F4A623;}
.o-avatar-extra{
  background:#fff;color:#1B1B1B;font-size:.99rem;font-weight:800;
}

/* ---------- Order list ---------- */
.order-list{
  padding:26px 22px 6px;
  display:flex;
  flex-direction:column;
  gap:16px;
  flex:1;
}
.order-item{
  background: #7B1C2A33 ;
  border-radius:var(--radius-lg);
  display:flex;
  align-items:center;
  padding:12px;
  box-shadow:var(--shadow-card);
  gap:14px;
}
.order-item img{
  width:78px;
  height:78px;
  object-fit:cover;
  border-radius:16px;
  flex-shrink:0;
}
.order-item .item-info{
  flex:1;
  min-width:0;
  display:flex;
  flex-direction:column;
  gap:4px;
}
.order-item .item-name{
  font-size:1.05rem;
  font-weight:600;
  line-height:1.25;
  color:var(--text-dark);
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
  max-width:100%;
}
.order-item .item-name b{ font-weight:700; }
.order-item .item-price{
  font-weight:700;
  font-size:1rem;
  color:var(--wine);
  white-space:nowrap;
  text-align:left;
}
.item-del-btn{
  background:rgba(122,32,48,0.1);
  border:none;
  width:34px;height:34px;
  border-radius:50%;
  color:var(--wine);
  font-size:15px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  cursor:pointer;
}

/* ---------- Totals ---------- */
.totals{
  padding:18px 26px 4px;
  display:flex;
  flex-direction:column;
  gap:10px;
  font-size:1.15rem;
}
.totals .totals-row{
  display:flex;
  justify-content:space-between;
}
.totals .total-row{
  margin-top:6px;
}
.totals .total-row .label{
  font-family:'Playfair Display', serif;
  font-weight:700;
  color:var(--wine);
  font-size:1.6rem;
}
.totals .total-row .value{
  font-family:'Playfair Display', serif;
  font-weight:800;
  color:var(--wine);
  font-size:1.7rem;
}

/* ---------- Payment methods ---------- */
.payment-row{
  display:flex;
  gap:14px;
  padding:22px 22px 6px;
  position:relative;
}
.pay-btn{
  flex:1;
  background:var(--white);
  border-radius:var(--radius-pill);
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  padding:14px 10px;
  font-weight:600;
  font-size:1.05rem;
  box-shadow:var(--shadow-card);
  border:2px solid transparent;
  cursor:pointer;
  color:var(--text-dark);
  height: 50px;
}
.pay-btn.active{
  border-color:var(--wine);
  border-radius: 10px;
  height: 50px;
  width: 70px;
}
.pay-btn .cash-icon{
  width:50px; height:26px;
  background:var(--cash-green);
  border-radius:6px;
  display:flex;align-items:center;justify-content:center;
  color:var(--white);
  font-size:14px;
}
.pay-btn .chevron{ font-size:12px; color:var(--text-dark); transition:transform .2s ease; }
.pay-btn.open .chevron{ transform:rotate(180deg); }

.mobile-wrapper{ position:relative; flex:1;}
.mobile-wrapper .pay-btn{ width:100%; border-radius: 10px; }

.operator-dropdown{
  position:absolute;
  top:calc(100% + 8px);
  left:0;
  right:0;
  background:var(--white);
  border-radius:var(--radius-md);
  box-shadow:0 8px 20px rgba(122,32,48,0.22);
  overflow:hidden;
  z-index:20;
  display:none;
  border:1px solid rgba(122,32,48,0.08);
}
.operator-dropdown.show{ display:block; }
.operator-option{
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px 16px;
  cursor:pointer;
  font-weight:600;
  font-size:1rem;
  color:var(--text-dark);
  border-bottom:1px solid rgba(0,0,0,0.06);
  transition:background .15s ease;
}
.operator-option:last-child{ border-bottom:none; }
.operator-option:hover, .operator-option:active{ background:rgba(122,32,48,0.08); }
.operator-option .dot{
  width:22px; height:22px;
  border-radius:50%;
  flex-shrink:0;
  display:flex; align-items:center; justify-content:center;
  color:var(--white);
  font-size:0.65rem;
  font-weight:800;
}
.operator-option[data-operator="MTN"] .dot{ background:#FFCB05; color:#1B1B1B; }
.operator-option[data-operator="MOOV"] .dot{ background:#F26522; }
.operator-option[data-operator="CELTIIS"] .dot{ background:#0A6EBD; }

/* ---------- Toast ---------- */
.toast-msg{
  position:fixed;
  left:50%;
  bottom:110px;
  transform:translateX(-50%) translateY(20px);
  background:var(--wine-dark);
  color:var(--white);
  padding:13px 22px;
  border-radius:var(--radius-pill);
  font-weight:600;
  font-size:0.95rem;
  box-shadow:0 8px 20px rgba(0,0,0,0.25);
  opacity:0;
  pointer-events:none;
  transition:opacity .25s ease, transform .25s ease;
  z-index:1000;
  max-width:85%;
  text-align:center;
}
.toast-msg.show{
  opacity:1;
  transform:translateX(-50%) translateY(0);
}

/* ---------- Details modal ---------- */
.modal-overlay{
  position:fixed;
  inset:0;
  background:rgba(43,20,25,0.45);
  display:none;
  align-items:flex-end;
  justify-content:center;
  z-index:1200;
}
.modal-overlay.show{ display:flex; }
.modal-sheet{
  background:var(--bg-pink);
  width:100%;
  max-width:440px;
  border-radius:28px 28px 0 0;
  padding:26px 24px 30px;
  box-shadow:0 -10px 30px rgba(0,0,0,0.25);
  animation:slideUp .25s ease;
}
@keyframes slideUp{
  from{ transform:translateY(30px); opacity:0; }
  to{ transform:translateY(0); opacity:1; }
}
.modal-sheet h3{
  font-family:'Playfair Display', serif;
  color:var(--wine);
  font-size:1.5rem;
  margin-bottom:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}
.modal-sheet .close-modal{
  background:rgba(122,32,48,0.12);
  border:none;
  width:34px; height:34px;
  border-radius:50%;
  color:var(--wine);
  font-size:16px;
  cursor:pointer;
}
.modal-sheet .detail-line{
  display:flex;
  justify-content:space-between;
  padding:8px 0;
  font-size:1rem;
  border-bottom:1px dashed rgba(0,0,0,0.12);
}
.modal-sheet .detail-line:last-of-type{ border-bottom:none; }

/* ---------- Action buttons ---------- */
.actions{
  padding:26px 22px 14px;
  display:flex;
  flex-direction:column;
  gap:16px;
}
.btn-commander{
  background:var(--wine-dark);
  color:var(--white);
  border:none;
  border-radius:var(--radius-pill);
  padding:18px;
  font-family:'Playfair Display', serif;
  font-weight:700;
  font-size:1.4rem;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:12px;
  cursor:pointer;
  box-shadow:0 6px 14px rgba(92,22,34,0.35);
}
.btn-commander:disabled, .btn-commander.is-disabled {
  opacity: 0.5;
  cursor: not-allowed;
  box-shadow: none;
}
.btn-details{
  background:var(--white);
  color:var(--text-dark);
  border:1px solid rgba(0,0,0,0.08);
  border-radius:var(--radius-pill);
  padding:16px;
  font-family:'Playfair Display', serif;
  font-weight:600;
  font-size:1.3rem;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:12px;
  cursor:pointer;
}

@media (max-width:380px){
  .title-row h1{ font-size:1.9rem; }
  .title-row h2{ font-size:1.6rem; }
}

@media (min-width:768px){
  .phone{
    max-width:900px;
    margin:0 auto;
    box-shadow:none;
    background:transparent;
  }
}
</style>
@endpush

@section('content')
<div class="phone">

  <!-- Header -->
  <div class="header">
    <button type="button" class="back-btn" id="btnBack"><i class="bi bi-chevron-left"></i></button>
    <div class="title-row">
      <div>
        <h1>Commandes</h1>
        <h2>Table 15</h2>
      </div>

      <div class="order-avatars">
        <div class="o-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="o-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="o-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="o-avatar o-avatar-extra">+1</div>
      </div>
    </div>
  </div>

  <!-- Order list -->
  <div class="order-list" id="orderList"></div>

  <!-- Totals -->
  <div class="totals">
    <div class="totals-row">
      <span>Sous-total :</span>
      <span id="subTotal">0 FCFA</span>
    </div>
    <div class="totals-row">
      <span>Taxes (5%) :</span>
      <span id="taxTotal">0 FCFA</span>
    </div>
    <div class="totals-row total-row">
      <span class="label">Total :</span>
      <span class="value" id="grandTotal">0 FCFA</span>
    </div>
  </div>

  <!-- Payment methods -->
  <div class="payment-row">
    <button type="button" class="pay-btn" id="cashBtn">
      <span class="cash-icon"><i class="bi bi-cash-coin"></i></span>
      Cash
    </button>
    <div class="mobile-wrapper">
      <button type="button" class="pay-btn" id="mobileBtn" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-caret-down-fill chevron"></i>
        <span id="mobileLabel" style="font-size:14px;">Mobile Money</span>
      </button>
      <div class="operator-dropdown" id="operatorDropdown">
        <div class="operator-option" data-operator="MTN"><span class="dot">M</span> MTN Mobile Money</div>
        <div class="operator-option" data-operator="MOOV"><span class="dot">M</span> Moov Money</div>
        <div class="operator-option" data-operator="CELTIIS"><span class="dot">C</span> Celtiis Cash</div>
      </div>
    </div>
  </div>

  <!-- Actions -->
  <div class="actions">
    <button type="button" class="btn-commander" id="btnCheckout"><i class="bi bi-send-fill"></i> Commander</button>
    <button type="button" class="btn-details" id="btnDetails"><i class="bi bi-list"></i> Suivre la commande</button>
  </div>

  <!-- Toast -->
  <div class="toast-msg" id="toastMsg"></div>

  <!-- Modale de détails -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal-sheet">
      <h3>Détails de la commande
        <button type="button" class="close-modal" id="closeModal"><i class="bi bi-x-lg"></i></button>
      </h3>
      <div id="modalBody"></div>
    </div>
  </div>

  <!-- Modale suppression / quantité -->
  <div class="modal-overlay" id="qtyModalOverlay">
    <div class="modal-sheet">
      <h3>Modifier la quantité
        <button type="button" class="close-modal" id="closeQtyModal"><i class="bi bi-x-lg"></i></button>
      </h3>
      <div id="qtyModalBody"></div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const TAX_RATE = 0.05;
  const isOrderLocked = () => localStorage.getItem('orderLocked') === '1';
  const lockOrder = () => localStorage.setItem('orderLocked', '1');

  function formatFCFA(n) {
    return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }

  function recalcTotals() {
    const items = document.querySelectorAll('.order-item');
    let subTotal = 0;

    items.forEach(item => {
      const unitPrice = parseFloat(item.dataset.price);
      const qty = parseInt(item.dataset.qty, 10);
      const lineTotal = unitPrice * qty;
      const lineTotalEl = item.querySelector('.line-total');
      const qtyEl = item.querySelector('.qty');
      
      if (lineTotalEl) lineTotalEl.textContent = formatFCFA(lineTotal);
      if (qtyEl) qtyEl.textContent = qty;
      
      subTotal += lineTotal;
    });

    const tax = subTotal * TAX_RATE;
    const total = subTotal + tax;

    document.getElementById('subTotal').textContent = formatFCFA(subTotal) + ' FCFA';
    document.getElementById('taxTotal').textContent = formatFCFA(tax) + ' FCFA';
    document.getElementById('grandTotal').textContent = formatFCFA(total) + ' FCFA';
  }

  // ---------- Panier dynamique (localStorage) ----------
  const FALLBACK_IMG = 'https://images.unsplash.com/photo-1481070555726-e2fe8357725c?w=200&h=200&fit=crop';

  function loadPanier() {
    return JSON.parse(localStorage.getItem('panier') || '[]');
  }
  function savePanier(panier) {
    localStorage.setItem('panier', JSON.stringify(panier));
  }

  function renderOrderList() {
    const panier = loadPanier();
    const list = document.getElementById('orderList');

    if (!panier.length) {
      list.innerHTML = '<p style="text-align:center;padding:30px 10px;color:var(--wine-dark);">Votre panier est vide.</p>';
      document.getElementById('subTotal').textContent = '0 FCFA';
      document.getElementById('taxTotal').textContent = '0 FCFA';
      document.getElementById('grandTotal').textContent = '0 FCFA';
      return;
    }

    list.innerHTML = panier.map(it => `
      <div class="order-item"
           data-slug="${it.slug}"
           data-price="${it.prix}"
           data-qty="${it.qty}">
          <img src="${it.img || FALLBACK_IMG}" alt="${it.nom}">
          <div class="item-info">
              <div class="item-name" title="${it.nom}">
                  ${it.nom} <b>×<span class="qty">${it.qty}</span></b>
              </div>
              <div class="item-price">
                  <span class="line-total">0</span> FCFA
              </div>
          </div>
          <button type="button" class="item-del-btn js-open-qty-modal" data-slug="${it.slug}" ${isOrderLocked() ? 'disabled' : ''} title="${isOrderLocked() ? 'Commande en cuisson' : 'Modifier / supprimer'}">
            <i class="bi bi-trash3"></i>
          </button>
      </div>
    `).join('');

    // Bind event dynamic item del buttons
    document.querySelectorAll('.js-open-qty-modal').forEach(btn => {
      btn.addEventListener('click', function() {
        if (!isOrderLocked()) {
          openQtyModal(this.getAttribute('data-slug'));
        }
      });
    });

    recalcTotals();
  }

  // ---------- Modale suppression intelligente / quantité ----------
  let qtyModalSlug = null;
  const qtyModalOverlay = document.getElementById('qtyModalOverlay');
  const qtyModalBody = document.getElementById('qtyModalBody');

  window.openQtyModal = function(slug) {
    qtyModalSlug = slug;
    const item = loadPanier().find(p => p.slug === slug);
    if (!item) return;

    qtyModalBody.innerHTML = `
      <p style="margin-bottom:14px;">${item.nom} — quantité actuelle : <b>${item.qty}</b></p>
      <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
        <button type="button" id="btnQtyMinus" style="width:40px;height:40px;border-radius:50%;border:none;background:rgba(122,32,48,.12);color:var(--wine);font-size:18px;">−</button>
        <span id="qtyModalValue" style="font-size:1.3rem;font-weight:700;min-width:30px;text-align:center;">${item.qty}</span>
        <button type="button" id="btnQtyPlus" style="width:40px;height:40px;border-radius:50%;border:none;background:rgba(122,32,48,.12);color:var(--wine);font-size:18px;">+</button>
      </div>
      <button type="button" class="btn-commander" id="btnConfirmQty" style="font-size:1.05rem;padding:14px;">Mettre à jour la quantité</button>
      <button type="button" class="btn-details" id="btnRemoveItemQty" style="font-size:1rem;padding:12px;margin-top:10px;color:#B23A3A;"><i class="bi bi-trash3"></i> Supprimer l'article</button>
    `;

    document.getElementById('btnQtyMinus').addEventListener('click', () => qtyModalChange(-1));
    document.getElementById('btnQtyPlus').addEventListener('click', () => qtyModalChange(1));
    document.getElementById('btnConfirmQty').addEventListener('click', confirmQtyModal);
    document.getElementById('btnRemoveItemQty').addEventListener('click', removeAllQtyModal);

    qtyModalOverlay.classList.add('show');
  };

  function qtyModalChange(delta) {
    const el = document.getElementById('qtyModalValue');
    if (el) el.textContent = Math.max(1, parseInt(el.textContent, 10) + delta);
  }

  function confirmQtyModal() {
    const v = parseInt(document.getElementById('qtyModalValue').textContent, 10);
    const panier = loadPanier();
    const item = panier.find(p => p.slug === qtyModalSlug);
    if (item) item.qty = v;
    savePanier(panier);
    qtyModalOverlay.classList.remove('show');
    renderOrderList();
    showToast('Quantité mise à jour');
  }

  function removeAllQtyModal() {
    savePanier(loadPanier().filter(p => p.slug !== qtyModalSlug));
    qtyModalOverlay.classList.remove('show');
    renderOrderList();
    showToast('Article supprimé du panier');
  }

  document.getElementById('closeQtyModal').addEventListener('click', () => qtyModalOverlay.classList.remove('show'));

  // ---------- Moyen de paiement ----------
  let paymentSelected = null;
  const cashBtn = document.getElementById('cashBtn');
  const mobileBtn = document.getElementById('mobileBtn');
  const mobileLabel = document.getElementById('mobileLabel');
  const operatorDropdown = document.getElementById('operatorDropdown');

  function setActivePayment(btn) {
    cashBtn.classList.remove('active');
    mobileBtn.classList.remove('active');
    btn.classList.add('active');
  }

  function closeDropdown() {
    operatorDropdown.classList.remove('show');
    mobileBtn.classList.remove('open');
    mobileBtn.setAttribute('aria-expanded', 'false');
  }

  cashBtn.addEventListener('click', () => {
    if (isOrderLocked()) { showToast('Commande déjà en cuisson'); return; }
    paymentSelected = 'Cash';
    setActivePayment(cashBtn);
    closeDropdown();
  });

  mobileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = operatorDropdown.classList.toggle('show');
    mobileBtn.classList.toggle('open', isOpen);
    mobileBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  document.querySelectorAll('.operator-option').forEach(opt => {
    opt.addEventListener('click', (e) => {
      e.stopPropagation();
      if (isOrderLocked()) { showToast('Commande déjà en cuisson'); closeDropdown(); return; }
      const operator = opt.dataset.operator;
      const niceName = operator === 'MTN' ? 'MTN Mobile Money'
                     : operator === 'MOOV' ? 'Moov Money'
                     : 'Celtiis Cash';
      mobileLabel.textContent = niceName;
      paymentSelected = niceName;
      setActivePayment(mobileBtn);
      closeDropdown();
      showToast(niceName + ' sélectionné');
    });
  });

  document.addEventListener('click', () => closeDropdown());

  // ---------- Toast ----------
  const toastEl = document.getElementById('toastMsg');
  let toastTimer;
  function showToast(message, duration) {
    clearTimeout(toastTimer);
    toastEl.textContent = message;
    toastEl.classList.add('show');
    toastTimer = setTimeout(() => toastEl.classList.remove('show'), duration || 2200);
  }

  // ---------- Flèche de retour ----------
  document.getElementById('btnBack').addEventListener('click', () => {
    if (window.history.length > 1) {
      window.history.back();
    } else {
      showToast('Retour à l’écran précédent');
    }
  });

  // ---------- Bouton Commander ----------
  document.getElementById('btnCheckout').addEventListener('click', () => {
    if (isOrderLocked()) { showToast('Commande déjà en cuisson'); return; }
    const panier = loadPanier();
    if (!panier.length) { showToast('Votre panier est vide !'); return; }
    if (!paymentSelected) {
      showToast('Veuillez choisir un moyen de paiement pour valider');
      return;
    }

    const order = {
      numero: 'CMD-' + Math.floor(1000 + Math.random() * 9000),
      date: new Date().toLocaleString('fr-FR', {day:'2-digit',month:'2-digit',year:'numeric',hour:'2-digit',minute:'2-digit'}),
      table: 'Table 15',
      items: panier.map(it => ({ nom: it.nom, prix: it.prix, qty: it.qty })),
      sousTotal: document.getElementById('subTotal').textContent,
      taxes: document.getElementById('taxTotal').textContent,
      total: document.getElementById('grandTotal').textContent,
      paiement: paymentSelected,
      heureCommande: new Date().toISOString()
    };
    localStorage.setItem('derniereCommande', JSON.stringify(order));

    lockOrder();

    savePanier([]);
    renderOrderList();
    paymentSelected = null;
    cashBtn.classList.remove('active');
    mobileBtn.classList.remove('active');
    mobileLabel.textContent = 'Mobile Money';

    const btnCheckout = document.getElementById('btnCheckout');
    btnCheckout.disabled = true;
    btnCheckout.classList.add('is-disabled');

    showToast('Merci pour votre commande ! Vous serez bientôt servi.', 4000);
  });

  // ---------- Voir les détails / Suivre la commande ----------
  const modalOverlay = document.getElementById('modalOverlay');
  const modalBody = document.getElementById('modalBody');
  const closeModalBtn = document.getElementById('closeModal');

  function buildDetailsHTML() {
    let html = '';
    document.querySelectorAll('.order-item').forEach(item => {
      const name = item.querySelector('.item-name').textContent.replace(/\s+/g,' ').trim();
      const price = item.querySelector('.item-price').textContent.trim();
      html += `<div class="detail-line"><span>${name}</span><span>${price}</span></div>`;
    });
    html += `<div class="detail-line"><span>Sous-total</span><span>${document.getElementById('subTotal').textContent}</span></div>`;
    html += `<div class="detail-line"><span>Taxes (5%)</span><span>${document.getElementById('taxTotal').textContent}</span></div>`;
    html += `<div class="detail-line"><b>Total</b><b>${document.getElementById('grandTotal').textContent}</b></div>`;
    return html;
  }

  document.getElementById('btnDetails').addEventListener('click', () => {
    if (isOrderLocked()) {
      window.location.href = "{{ url('/suivi-commande') }}";
      return;
    }
    modalBody.innerHTML = buildDetailsHTML();
    modalOverlay.classList.add('show');
  });

  closeModalBtn.addEventListener('click', () => modalOverlay.classList.remove('show'));
  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) modalOverlay.classList.remove('show');
  });

  // Init
  renderOrderList();
  if (isOrderLocked()) {
    const btnCheckout = document.getElementById('btnCheckout');
    if (btnCheckout) {
      btnCheckout.disabled = true;
      btnCheckout.classList.add('is-disabled');
    }
  }
});
</script>
@endpush