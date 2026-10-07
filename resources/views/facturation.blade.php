@extends('layouts.app')

@section('title', 'Facturation — Le Gourmet')

@push('styles')
<style>
:root{
  --bg:#EEF1FF;
  --bordeaux:#7B1C2A;
  --red:#E8112D;
  --orange:#FF9500;
  --yellow:#FFBF0D;
  --green:#31AA1C;
  --blue:#2F80ED;
  --purple:#8C4AF2;
  --white:#FFFFFF;

  --bordeaux-20:rgba(123,28,42,.12);
  --orange-20:rgba(255,149,0,.15);
  --orange-50:rgba(255,149,0,.5);
  --red-20:rgba(232,17,45,.12);
  --green-20:rgba(49,170,28,.12);
  --green-50:rgba(49,170,28,.5);
  --blue-20:rgba(47,128,237,.12);
  --purple-20:rgba(140,74,242,.12);
  --purple-50:rgba(140,74,242,.5);
  --yellow-20:rgba(255,191,13,.18);

  --ink:#2C2018;
  --muted:#8A8398;
  --border:#E4E7F7;
}

/* ============ CARTE CHIFFRE D'AFFAIRES ============ */
.revenue-card{
  background:var(--white);
  border:1px solid var(--orange-50);
  border-radius:22px;
  padding:22px 28px;
  display:flex;align-items:center;gap:20px;flex-wrap:wrap;
  box-shadow:0 12px 30px rgba(123,28,42,.05);
  margin-bottom:28px;
}
.revenue-icon{
  width:52px;height:52px;border-radius:14px;
  background:var(--orange-20);color:var(--orange);
  display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;
}
.revenue-text{flex:1;min-width:220px;}
.revenue-label{font-size:.95rem;color:var(--ink);font-weight:500;margin-bottom:4px;}
.revenue-amount{font-size:1.9rem;font-weight:800;color:var(--orange);line-height:1.1;}
.revenue-amount .unit{font-size:1.1rem;font-weight:600;margin-left:4px;}
.revenue-growth{font-size:.85rem;color:var(--green);font-weight:600;margin-top:2px;}
.revenue-growth i{margin-right:3px;}
.revenue-date{
  display:flex;align-items:center;gap:10px;
  background:var(--bg);border:1px solid var(--border);border-radius:14px;
  padding:10px 16px;font-size:.9rem;color:var(--ink);cursor:pointer;
}
.revenue-date i{color:var(--blue);}
.revenue-date input{border:none;background:transparent;font-family:'Playfair Display',serif;font-size:.9rem;color:var(--ink);cursor:pointer;width:150px;}
.revenue-date input:focus{outline:none;}

/* ============ FIL D'ARIANE ============ */
.breadcrumb-row{
  display:flex;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap;
}
.breadcrumb-text{display:flex;align-items:center;gap:12px;flex:1;flex-wrap:wrap;}
.breadcrumb-link{font-size:1.35rem;color:var(--muted);font-weight:600;text-decoration:none;}
.breadcrumb-link:hover{color:var(--bordeaux);}
.breadcrumb-chevron{color:var(--muted);font-size:1rem;}
.breadcrumb-current{font-size:1.45rem;font-weight:800;color:var(--ink);}
.btn-refresh{
  width:48px;height:48px;border-radius:50%;border:none;
  background:var(--green-20);color:var(--green);font-size:1.05rem;
  display:flex;align-items:center;justify-content:center;cursor:pointer;transition:.25s;flex-shrink:0;
}
.btn-refresh:hover{background:var(--green);color:var(--white);}
.btn-refresh.is-spinning i{animation:spin .7s linear;}
@keyframes spin{from{transform:rotate(0);}to{transform:rotate(360deg);}}

/* ============ CARTE RECAPITULATIVE ============ */
.summary-card{
  background:var(--white);border-radius:24px;padding:26px 30px;
  box-shadow:0 14px 40px rgba(44,32,24,.06);margin-bottom:30px;
  display:flex;align-items:center;gap:24px;flex-wrap:wrap;
}
.summary-icon{
  width:54px;height:54px;border-radius:50%;background:var(--blue-20);color:var(--blue);
  display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;
}
.summary-info{flex:1;min-width:260px;}
.summary-top{display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:10px;}
.summary-name{font-size:1.5rem;font-weight:800;color:var(--ink);}
.status-badge{
  display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:700;
  background:var(--green-20);color:#1F7A10;
}
.status-badge .dot{width:7px;height:7px;border-radius:50%;background:var(--green);}
.summary-meta{display:flex;gap:20px;flex-wrap:wrap;align-items:center;font-size:.86rem;color:var(--muted);}
.summary-meta span{display:flex;align-items:center;gap:6px;}
.summary-meta i{font-size:.9rem;}
.summary-meta .ic-p{color:var(--purple);}
.summary-meta .ic-s{color:var(--blue);}
.summary-meta .ic-d{color:var(--orange);}
.summary-total{text-align:right;flex-shrink:0;}
.summary-total-label{font-size:.85rem;color:var(--muted);margin-bottom:4px;}
.summary-total-amount{font-size:1.7rem;font-weight:800;color:var(--bordeaux);}

/* ============ PANNEAUX GENERIQUES ============ */
.panel{
  background:var(--white);border-radius:22px;padding:28px;
  box-shadow:0 12px 32px rgba(44,32,24,.05);margin-bottom:26px;
}
.panel-title{
  font-size:1.2rem;font-weight:700;color:var(--bordeaux);margin-bottom:20px;
  display:flex;align-items:center;gap:10px;
}
.panel-title i{color:var(--orange);}

/* ============ TABLEAU DES PLATS ============ */
.dishes-table-wrap{overflow-x:auto;}
table.dishes-table{width:100%;border-collapse:collapse;min-width:560px;}
table.dishes-table thead th{
  text-align:left;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;
  color:var(--muted);font-weight:700;padding:0 12px 12px;border-bottom:2px solid var(--border);
}
table.dishes-table thead th.text-end{text-align:right;}
table.dishes-table tbody td{
  padding:14px 12px;border-bottom:1px solid var(--border);font-size:.92rem;vertical-align:middle;
}
table.dishes-table tbody tr:last-child td{border-bottom:none;}
.dish-cell{display:flex;align-items:center;gap:14px;}
.dish-cell img{width:44px;height:44px;border-radius:50%;object-fit:cover;background:var(--bg);flex-shrink:0;}
.dish-cell span{font-weight:700;color:var(--ink);}
.text-end{text-align:right;}
.dish-subtotal{font-weight:800;color:var(--bordeaux);}

/* ============ BLOC FACTURATION ============ */
.billing-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;}
@media(max-width:767.98px){.billing-grid{grid-template-columns:1fr;}}
.field-label{font-size:.85rem;font-weight:600;color:var(--ink);margin-bottom:8px;display:block;}
.field-input, .field-select{
  width:100%;border:1.5px solid var(--border);border-radius:14px;padding:13px 16px;
  font-size:.95rem;color:var(--ink);background:var(--bg);
}
.field-input:focus, .field-select:focus, textarea.field-input:focus{
  outline:none;border-color:var(--bordeaux);box-shadow:0 0 0 3px var(--bordeaux-20);
}
.field-with-icon{position:relative;}
.field-with-icon i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--muted);}
.field-with-icon input{padding-left:42px;}
textarea.field-input{resize:vertical;min-height:90px;}
.tax-row{
  display:flex;justify-content:space-between;align-items:center;
  background:var(--bg);border-radius:14px;padding:14px 18px;font-size:.92rem;
}
.tax-row .tax-label{color:var(--ink);font-weight:600;}
.tax-row .tax-val{font-weight:700;color:var(--bordeaux);}

/* ============ MODES DE PAIEMENT ============ */
.payment-grid{
  display:grid;grid-template-columns:repeat(4,1fr);gap:18px;
}
@media(max-width:991.98px){.payment-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:575.98px){.payment-grid{grid-template-columns:1fr;}}
.payment-card{
  border:2px solid var(--border);border-radius:18px;padding:22px 16px;text-align:center;
  cursor:pointer;transition:.2s;background:var(--white);
}
.payment-card:hover{border-color:var(--bordeaux);transform:translateY(-2px);}
.payment-card.selected{
  border-color:var(--bordeaux);background:var(--bordeaux-20);
  box-shadow:0 10px 24px rgba(123,28,42,.15);
}
.payment-icon{
  width:52px;height:52px;border-radius:50%;margin:0 auto 12px;
  display:flex;align-items:center;justify-content:center;font-size:1.3rem;
}
.payment-card[data-method="especes"] .payment-icon{background:var(--green-20);color:var(--green);}
.payment-card[data-method="carte"] .payment-icon{background:var(--blue-20);color:var(--blue);}
.payment-card[data-method="momo"] .payment-icon{background:var(--orange-20);color:var(--orange);}
.payment-card[data-method="mixte"] .payment-icon{background:var(--purple-20);color:var(--purple);}
.payment-name{font-weight:700;font-size:.95rem;color:var(--ink);}
.payment-check{
  margin-top:10px;width:22px;height:22px;border-radius:50%;border:2px solid var(--border);
  display:flex;align-items:center;justify-content:center;margin-left:auto;margin-right:auto;
  font-size:.7rem;color:transparent;transition:.2s;
}
.payment-card.selected .payment-check{background:var(--bordeaux);border-color:var(--bordeaux);color:var(--white);}

/* ============ RESUME FINANCIER ============ */
.recap-panel{
  background:var(--white);border-radius:22px;padding:28px;
  box-shadow:0 12px 32px rgba(44,32,24,.05);margin-bottom:26px;
}
.recap-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;font-size:.95rem;}
.recap-row .r-label{color:var(--muted);}
.recap-row .r-val{font-weight:700;color:var(--ink);}
.recap-row.discount .r-val{color:var(--red);}
.recap-total-row{
  display:flex;justify-content:space-between;align-items:center;
  margin-top:14px;padding:18px 22px;border-radius:16px;
  background:var(--bordeaux);color:var(--white);
}
.recap-total-label{font-size:1.15rem;font-weight:700;}
.recap-total-amount{font-size:1.9rem;font-weight:800;}

/* ============ ACTIONS FINALES ============ */
.final-actions{display:flex;gap:16px;flex-wrap:wrap;justify-content:flex-end;}
.btn-cancel, .btn-print, .btn-validate-pay{
  border-radius:16px;padding:15px 30px;font-weight:700;font-size:.95rem;cursor:pointer;transition:.2s;border:none;
}
.btn-cancel{background:var(--white);border:1.5px solid var(--border);color:var(--ink);}
.btn-cancel:hover{border-color:var(--red);color:var(--red);}
.btn-print{background:var(--blue-20);color:var(--blue);border:1.5px solid transparent;}
.btn-print:hover{background:var(--blue);color:var(--white);}
.btn-validate-pay{background:var(--bordeaux);color:var(--white);box-shadow:0 14px 28px rgba(123,28,42,.25);}
.btn-validate-pay:hover:not(:disabled){background:#611420;}
.btn-validate-pay:disabled{background:var(--border);color:var(--muted);cursor:not-allowed;box-shadow:none;}
@media(max-width:575.98px){
  .final-actions{flex-direction:column;}
  .final-actions button{width:100%;}
}

@media print{
  .breadcrumb-row, .revenue-card, .final-actions, .btn-refresh{display:none !important;}
}
</style>
@endpush

@section('content')
<!-- ============ CHIFFRE D'AFFAIRES ============ -->
<div class="revenue-card">
  <div class="revenue-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
  <div class="revenue-text">
    <div class="revenue-label">Chiffres d'affaires journaliers</div>
    <div class="revenue-amount">1 250 000<span class="unit">FCFA</span></div>
    <div class="revenue-growth">+10%</div>
  </div>
  <label class="revenue-date">
    <span>03 juillet 2026</span>
    <i class="fa-regular fa-calendar"></i>
  </label>
</div>

<!-- ============ FIL D'ARIANE ============ -->
<div class="breadcrumb-row">
  <div class="breadcrumb-text">
    <a href="{{ url('/commandes') }}" class="breadcrumb-link">Gestion des Commandes</a>
    <i class="fa-solid fa-chevron-right breadcrumb-chevron"></i>
    <a href="{{ url('/commandes/detail') }}" class="breadcrumb-link" id="breadcrumbTableLink">Table 3</a>
    <i class="fa-solid fa-chevron-right breadcrumb-chevron"></i>
    <span class="breadcrumb-current">Facturation</span>
  </div>
  <button class="btn-refresh" id="btnRefresh" title="Actualiser"><i class="fa-solid fa-rotate-right"></i></button>
</div>

<!-- ============ CARTE RECAPITULATIVE ============ -->
<div class="summary-card">
  <div class="summary-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
  <div class="summary-info">
    <div class="summary-top">
      <span class="summary-name" id="summaryTableName">Table 3</span>
      <span class="status-badge"><span class="dot"></span> Prête pour paiement</span>
    </div>
    <div class="summary-meta">
      <span><i class="fa-solid fa-user-group ic-p"></i> 04 personnes</span>
      <span><i class="fa-solid fa-user-tie ic-s"></i> Serveur : Kevin</span>
      <span><i class="fa-regular fa-calendar ic-d"></i> 03 juillet 2026</span>
      <span><i class="fa-regular fa-clock ic-d"></i> 12:34</span>
    </div>
  </div>
  <div class="summary-total">
    <div class="summary-total-label">Montant total</div>
    <div class="summary-total-amount" id="summaryTotal">39 900 FCFA</div>
  </div>
</div>

<!-- ============ TABLEAU DES PLATS ============ -->
<section class="panel">
  <div class="panel-title"><i class="fa-solid fa-utensils"></i> Plats commandés</div>
  <div class="dishes-table-wrap">
    <table class="dishes-table">
      <thead>
        <tr>
          <th>Plat</th>
          <th class="text-end">Quantité</th>
          <th class="text-end">Prix unitaire</th>
          <th class="text-end">Sous-total</th>
        </tr>
      </thead>
      <tbody id="dishesTableBody"></tbody>
    </table>
  </div>
</section>

<!-- ============ BLOC FACTURATION ============ -->
<section class="panel">
  <div class="panel-title"><i class="fa-solid fa-receipt"></i> Détails de la facturation</div>
  <div class="billing-grid">
    <div>
      <label class="field-label" for="discountInput">Remise (FCFA)</label>
      <div class="field-with-icon">
        <i class="fa-solid fa-tag"></i>
        <input type="number" class="field-input" id="discountInput" min="0" value="0" placeholder="0">
      </div>
    </div>
    <div>
      <label class="field-label">Taxes / Service</label>
      <div class="tax-row">
        <span class="tax-label">Service (5%)</span>
        <span class="tax-val" id="taxAmount">1 900 FCFA</span>
      </div>
    </div>
    <div style="grid-column:1/-1;">
      <label class="field-label" for="notesInput">Observations</label>
      <textarea class="field-input" id="notesInput" placeholder="Remarques particulières concernant la commande ou le paiement..."></textarea>
    </div>
  </div>
</section>

<!-- ============ MODES DE PAIEMENT ============ -->
<section class="panel">
  <div class="panel-title"><i class="fa-solid fa-wallet"></i> Mode de paiement</div>
  <div class="payment-grid" id="paymentGrid">
    <div class="payment-card" data-method="especes">
      <div class="payment-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
      <div class="payment-name">Espèces</div>
      <div class="payment-check"><i class="fa-solid fa-check"></i></div>
    </div>
    <div class="payment-card" data-method="carte">
      <div class="payment-icon"><i class="fa-solid fa-credit-card"></i></div>
      <div class="payment-name">Carte bancaire</div>
      <div class="payment-check"><i class="fa-solid fa-check"></i></div>
    </div>
    <div class="payment-card" data-method="momo">
      <div class="payment-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
      <div class="payment-name">Mobile Money</div>
      <div class="payment-check"><i class="fa-solid fa-check"></i></div>
    </div>
    <div class="payment-card" data-method="mixte">
      <div class="payment-icon"><i class="fa-solid fa-layer-group"></i></div>
      <div class="payment-name">Paiement mixte</div>
      <div class="payment-check"><i class="fa-solid fa-check"></i></div>
    </div>
  </div>
</section>

<!-- ============ RESUME FINANCIER ============ -->
<section class="recap-panel">
  <div class="panel-title"><i class="fa-solid fa-calculator"></i> Résumé financier</div>
  <div class="recap-row">
    <span class="r-label">Sous-total</span>
    <span class="r-val" id="recapSubtotal">38 000 FCFA</span>
  </div>
  <div class="recap-row discount">
    <span class="r-label">Remise</span>
    <span class="r-val" id="recapDiscount">- 0 FCFA</span>
  </div>
  <div class="recap-row">
    <span class="r-label">Taxes / Service (5%)</span>
    <span class="r-val" id="recapTax">1 900 FCFA</span>
  </div>
  <div class="recap-total-row">
    <span class="recap-total-label">Total à payer</span>
    <span class="recap-total-amount" id="recapTotal">39 900 FCFA</span>
  </div>
</section>

<!-- ============ ACTIONS FINALES ============ -->
<div class="final-actions">
  <button type="button" class="btn-cancel" id="btnCancel">Annuler</button>
  <button type="button" class="btn-print" id="btnPrint"><i class="fa-solid fa-print me-2"></i>Imprimer la facture</button>
  <button type="button" class="btn-validate-pay" id="btnValidatePay" disabled><i class="fa-solid fa-check-double me-2"></i>Valider le paiement</button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23EEF1FF'/%3E%3C/svg%3E";
  const IMG_FB = `this.onerror=null;this.src='${FALLBACK_IMG}'`;

  function fmt(p){ return Math.round(p).toLocaleString('fr-FR') + ' FCFA'; }

  const TABLES_DB = {
    1:{ name:'Table 1' }, 2:{ name:'Table 2' }, 3:{ name:'Table 3' },
    4:{ name:'Table 4' }, 5:{ name:'Table 5' }, 6:{ name:'Table 6' },
    7:{ name:'Table 7' }, 8:{ name:'Table 8' }, 9:{ name:'Table 9' },
  };

  const urlParams        = new URLSearchParams(window.location.search);
  const requestedId      = parseInt(urlParams.get('table'), 10);
  const currentTableId   = TABLES_DB[requestedId] ? requestedId : 3;
  const currentTableName = TABLES_DB[currentTableId].name;

  const breadcrumbLink = document.getElementById('breadcrumbTableLink');
  if (breadcrumbLink) {
    breadcrumbLink.textContent = currentTableName;
    breadcrumbLink.href = `{{ url('/commandes/detail') }}?table=${currentTableId}`;
  }

  const summaryTableName = document.getElementById('summaryTableName');
  if (summaryTableName) summaryTableName.textContent = currentTableName;

  const dishes = [
    {name:'Crêpe au chocolat', qty:6, unitPrice:2000, img:'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=200&q=80'},
    {name:'Chicken burger', qty:6, unitPrice:3000, img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80'},
    {name:'Tiramisu', qty:8, unitPrice:500, img:'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=200&q=80'},
    {name:'Desperados', qty:10, unitPrice:400, img:'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=200&q=80'},
  ];

  function renderDishesTable(){
    const body = document.getElementById('dishesTableBody');
    if (!body) return;
    body.innerHTML = dishes.map(d=>{
      const sub = d.qty * d.unitPrice;
      return `
        <tr>
          <td>
            <div class="dish-cell">
              <img src="${d.img}" alt="${d.name}" ${IMG_FB}>
              <span>${d.name}</span>
            </div>
          </td>
          <td class="text-end">${d.qty}</td>
          <td class="text-end">${fmt(d.unitPrice)}</td>
          <td class="text-end dish-subtotal">${fmt(sub)}</td>
        </tr>
      `;
    }).join('');
  }

  function getSubtotal(){
    return dishes.reduce((s,d)=> s + d.qty*d.unitPrice, 0);
  }

  const TAX_RATE = 0.05;

  function recalculate(){
    const subtotal = getSubtotal();
    const discountInput = document.getElementById('discountInput');
    let discount = parseFloat(discountInput ? discountInput.value : 0) || 0;
    discount = Math.max(0, Math.min(discount, subtotal));

    const taxable = subtotal - discount;
    const tax = taxable * TAX_RATE;
    const total = taxable + tax;

    if (document.getElementById('taxAmount')) document.getElementById('taxAmount').textContent = fmt(tax);
    if (document.getElementById('recapSubtotal')) document.getElementById('recapSubtotal').textContent = fmt(subtotal);
    if (document.getElementById('recapDiscount')) document.getElementById('recapDiscount').textContent = `- ${fmt(discount)}`;
    if (document.getElementById('recapTax')) document.getElementById('recapTax').textContent = fmt(tax);
    if (document.getElementById('recapTotal')) document.getElementById('recapTotal').textContent = fmt(total);
    if (document.getElementById('summaryTotal')) document.getElementById('summaryTotal').textContent = fmt(total);
  }

  const discountInput = document.getElementById('discountInput');
  if (discountInput) discountInput.addEventListener('input', recalculate);

  let selectedPayment = null;
  const paymentCards = document.querySelectorAll('.payment-card');
  const btnValidatePay = document.getElementById('btnValidatePay');

  paymentCards.forEach(card=>{
    card.addEventListener('click', function(){
      paymentCards.forEach(c=>c.classList.remove('selected'));
      this.classList.add('selected');
      selectedPayment = this.dataset.method;
      if (btnValidatePay) btnValidatePay.disabled = false;
    });
  });

  const btnRefresh = document.getElementById('btnRefresh');
  if (btnRefresh) {
    btnRefresh.addEventListener('click', function(){
      this.classList.add('is-spinning');
      setTimeout(()=> this.classList.remove('is-spinning'), 700);
      renderDishesTable();
      recalculate();
    });
  }

  const btnCancel = document.getElementById('btnCancel');
  if (btnCancel) {
    btnCancel.addEventListener('click', function(){
      window.location.href = `{{ url('/commandes/detail') }}?table=${currentTableId}`;
    });
  }

  const btnPrint = document.getElementById('btnPrint');
  if (btnPrint) btnPrint.addEventListener('click', function(){ window.print(); });

  const paymentLabels = {especes:'Espèces', carte:'Carte bancaire', momo:'Mobile Money', mixte:'Paiement mixte'};

  if (btnValidatePay) {
    btnValidatePay.addEventListener('click', function(){
      if(this.disabled) return;
      const total = document.getElementById('recapTotal').textContent;
      alert(`Paiement validé pour ${currentTableName}.\nMode : ${paymentLabels[selectedPayment]}\nMontant : ${total}\n\nLa table est maintenant libre.`);
    });
  }

  renderDishesTable();
  recalculate();
});
</script>
@endpush