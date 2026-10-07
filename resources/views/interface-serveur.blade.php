@extends('layouts.app')

@section('title', 'Le Gourmet — Interface Serveur')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --gold:#C9952A;
  --gold-lt:#E8B84B;
  --cream:#FBF8F3;
  --cream2:#F4EFE6;
  --text:#2C2C2A;
  --muted:#8A857B;
  --border:#EDE7DA;
  --wine:#7B1C2A;
  --wine-dark:#5C1320;
  --wine-light:#9B2335;
  /* status colors */
  --free:#4CAF50;
  --active:#F4821F;
  --alert:#E24B4A;
  --pay:#3A9BE8;
}

.serif{font-family:'Playfair Display',serif;}

/* PAGE HERO SERVEUR */
.page-hero{
  background:linear-gradient(135deg,var(--wine-dark) 0%,var(--wine) 55%,var(--wine-light) 100%);
  padding:40px 0 56px;
  position:relative;overflow:hidden;
}
.page-hero::before{content:'';position:absolute;top:-60px;right:-50px;width:280px;height:280px;background:rgba(255,255,255,.05);border-radius:50%;}
.page-hero::after{content:'';position:absolute;bottom:-50px;left:10%;width:220px;height:220px;background:rgba(245,200,66,.07);border-radius:50%;}
.page-hero-eyebrow{font-size:.72rem;font-weight:800;letter-spacing:4px;text-transform:uppercase;color:var(--gold-lt);margin-bottom:10px;display:flex;align-items:center;gap:8px;}
.page-hero-eyebrow::before{content:'';display:inline-block;width:20px;height:2px;background:var(--gold-lt);}
.page-hero h1{font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;color:#fff;line-height:1.2;margin-bottom:8px;}
.page-hero h1 span{color:var(--gold-lt);}
.page-hero p{color:rgba(255,255,255,.6);font-size:.88rem;line-height:1.8;}

/* Hero pills row */
.hero-pills{display:flex;gap:10px;flex-wrap:wrap;margin-top:22px;}
.hero-pill{
  display:inline-flex;align-items:center;gap:7px;
  background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.18);
  border-radius:50px;padding:8px 16px;
  color:#fff;font-size:.78rem;font-weight:600;
  backdrop-filter:blur(8px);
}
.hero-pill .dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}

/* INTERFACE BODY */
.interface-wrap{
  margin-top:-30px;
  position:relative;z-index:2;
  display:grid;
  grid-template-columns:220px 1fr 300px;
  gap:0;
  background:#fff;
  border-radius:20px;
  border:1px solid var(--border);
  box-shadow:0 10px 50px rgba(0,0,0,.1);
  overflow:hidden;
  min-height:560px;
}

/* SIDEBAR */
.sidebar{
  background:linear-gradient(180deg,var(--wine-dark) 0%,var(--wine) 100%);
  padding:24px 0;
  display:flex;flex-direction:column;
}
.sidebar-brand{
  display:flex;align-items:center;gap:10px;
  padding:0 20px 24px;
  border-bottom:1px solid rgba(255,255,255,.1);
  margin-bottom:12px;
}
.sidebar-brand-icon{
  width:38px;height:38px;border-radius:10px;
  background:rgba(255,255,255,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;color:var(--gold-lt);
}
.sidebar-brand-name{font-family:'Playfair Display',serif;font-size:1rem;color:#fff;font-weight:700;}
.sidebar-brand-sub{font-size:.58rem;color:var(--gold-lt);letter-spacing:2px;text-transform:uppercase;}
.nav-item-s{
  display:flex;align-items:center;gap:12px;
  padding:12px 20px;
  color:rgba(255,255,255,.55);
  font-size:.82rem;font-weight:600;
  cursor:pointer;transition:.2s;
  border-radius:0;
  border-left:3px solid transparent;
  text-decoration:none;
}
.nav-item-s i{font-size:1.05rem;width:20px;text-align:center;}
.nav-item-s:hover{color:rgba(255,255,255,.85);background:rgba(255,255,255,.07);}
.nav-item-s.active{color:#fff;background:rgba(255,255,255,.12);border-left-color:var(--gold-lt);}
.nav-item-s .badge-s{
  margin-left:auto;
  background:var(--alert);color:#fff;
  font-size:.62rem;font-weight:800;
  min-width:20px;height:20px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  padding:0 5px;
}
.nav-item-s .badge-s.orange{background:var(--active);}
.sidebar-footer{margin-top:auto;padding:16px 20px 0;border-top:1px solid rgba(255,255,255,.1);}
.sidebar-footer p{color:rgba(255,255,255,.35);font-size:.68rem;line-height:1.5;}

/* PLAN DE SALLE */
.plan-area{background:var(--cream);padding:24px;}
.plan-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.plan-title{font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:var(--text);}
.refresh-btn{
  width:36px;height:36px;border-radius:50%;
  background:#fff;border:1.5px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;color:var(--muted);cursor:pointer;transition:.3s;
}
.refresh-btn:hover{border-color:var(--wine);color:var(--wine);transform:rotate(180deg);}

/* Legend */
.legend{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:18px;}
.legend-item{display:flex;align-items:center;gap:5px;font-size:.7rem;font-weight:600;color:var(--muted);}
.legend-dot{width:10px;height:10px;border-radius:50%;}

/* Table grid */
.tables-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:10px;
}
.table-cell{
  background:#fff;
  border:2px solid var(--free);
  border-radius:14px;
  padding:14px 10px 12px;
  text-align:center;
  cursor:pointer;
  position:relative;
  transition:.2s;
  min-height:72px;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
}
.table-cell:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.1);}
.table-cell.free{border-color:var(--free);background:#fff;}
.table-cell.active-order{border-color:var(--active);background:rgba(244,130,31,.06);}
.table-cell.alert-call{border-color:var(--alert);background:rgba(226,75,74,.06);}
.table-cell.waiting-pay{border-color:var(--pay);background:rgba(58,155,232,.06);}
.table-cell.selected{box-shadow:0 0 0 3px var(--wine);border-color:var(--wine);}
.table-label{font-weight:800;font-size:.85rem;color:var(--text);}
.table-cell.active-order .table-label{color:var(--active);}
.table-cell.alert-call .table-label{color:var(--alert);}
.table-cell.waiting-pay .table-label{color:var(--pay);}
.table-badge-s{
  position:absolute;top:-8px;right:-8px;
  width:22px;height:22px;border-radius:50%;
  color:#fff;font-size:.65rem;font-weight:800;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 2px 8px rgba(0,0,0,.2);
}
.table-badge-s.orange{background:var(--active);}
.table-badge-s.red{background:var(--alert);}
.table-badge-s.blue{background:var(--pay);}

/* DETAIL PANEL */
.detail-panel{
  background:#fff;
  border-left:1px solid var(--border);
  padding:24px 20px;
  display:flex;flex-direction:column;
  overflow-y:auto;
}
.panel-table-num{
  font-family:'Playfair Display',serif;
  font-size:1.5rem;font-weight:700;color:var(--text);
  margin-bottom:3px;
}
.panel-persons{font-size:.78rem;color:var(--muted);font-weight:600;margin-bottom:14px;}
.panel-avatars{display:flex;gap:-6px;margin-bottom:20px;}
.panel-avatar{
  width:34px;height:34px;border-radius:50%;
  object-fit:cover;
  border:2.5px solid #fff;
  margin-left:-8px;
}
.panel-avatar:first-child{margin-left:0;}
.panel-section{font-weight:700;font-size:.78rem;color:var(--text);letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px;margin-top:4px;}
.order-line{
  display:flex;justify-content:space-between;align-items:center;
  padding:9px 0;
  border-bottom:1px solid var(--border);
  font-size:.82rem;
}
.order-line:last-of-type{border-bottom:none;}
.order-line-name{font-weight:600;color:var(--text);}
.order-line-qty{color:var(--muted);font-size:.76rem;}
.order-line-price{font-weight:700;color:var(--wine);}
.panel-total{
  display:flex;justify-content:space-between;align-items:center;
  padding:14px 16px;
  background:var(--cream);
  border-radius:12px;
  margin-top:14px;
  margin-bottom:20px;
}
.panel-total .label{font-weight:700;font-size:.88rem;color:var(--text);}
.panel-total .amount{font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:var(--wine);}
.btn-panel{
  width:100%;border:none;border-radius:12px;
  padding:13px 20px;
  font-size:.85rem;font-weight:700;cursor:pointer;
  transition:.2s;display:flex;align-items:center;justify-content:center;gap:8px;
  margin-bottom:10px;
}
.btn-panel.primary{
  background:linear-gradient(135deg,var(--wine),var(--wine-light));
  color:#fff;
  box-shadow:0 4px 16px rgba(123,28,42,.25);
}
.btn-panel.primary:hover{opacity:.9;transform:translateY(-1px);}
.btn-panel.outline{
  background:#fff;
  border:1.5px solid var(--border);
  color:var(--text);
}
.btn-panel.outline:hover{border-color:var(--wine);color:var(--wine);}
.status-chip{
  display:inline-flex;align-items:center;gap:6px;
  padding:5px 12px;border-radius:20px;
  font-size:.7rem;font-weight:700;
  margin-bottom:16px;
}
.status-chip.active{background:rgba(244,130,31,.12);color:var(--active);border:1px solid rgba(244,130,31,.25);}

/* TOAST */
#toast{position:fixed;bottom:90px;left:50%;transform:translateX(-50%);background:#2C2C2A;color:#fff;padding:12px 22px;border-radius:40px;font-size:.84rem;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,.2);transition:opacity .3s;opacity:0;pointer-events:none;}

/* RESPONSIVE */
@media(max-width:1199px){
  .interface-wrap{grid-template-columns:190px 1fr 270px;}
}
@media(max-width:991px){
  .page-hero{padding:32px 0 48px;}
  .page-hero h1{font-size:1.6rem;}
  .interface-wrap{
    grid-template-columns:1fr;
    grid-template-rows:auto auto auto;
    border-radius:16px;
  }
  .sidebar{
    flex-direction:row;
    overflow-x:auto;
    padding:14px 16px;
    gap:4px;
  }
  .sidebar-brand{display:none;}
  .nav-item-s{border-left:none;border-bottom:3px solid transparent;padding:8px 14px;border-radius:8px;white-space:nowrap;flex-shrink:0;}
  .nav-item-s.active{border-bottom-color:var(--gold-lt);border-left-color:transparent;}
  .sidebar-footer{display:none;}
  .detail-panel{border-left:none;border-top:1px solid var(--border);}
}
@media(max-width:576px){
  .tables-grid{grid-template-columns:repeat(4,1fr);gap:7px;}
  .table-cell{padding:10px 6px;min-height:58px;}
  .table-label{font-size:.76rem;}
}
</style>
@endpush

@section('content')
<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-hero-eyebrow"><span>Interface Serveur</span></div>
    <h1>Plan de <span>salle</span></h1>
    <p>Visualisez et gérez l'ensemble des tables en temps réel depuis votre tablette.</p>
    <div class="hero-pills">
      <div class="hero-pill"><span class="dot" style="background:var(--free);"></span> Libre</div>
      <div class="hero-pill"><span class="dot" style="background:var(--active);"></span> Commande en cours</div>
      <div class="hero-pill"><span class="dot" style="background:var(--alert);"></span> Demande serveur</div>
      <div class="hero-pill"><span class="dot" style="background:var(--pay);"></span> Attente paiement</div>
    </div>
  </div>
</section>

<!-- INTERFACE -->
<main class="py-4">
  <div class="container-fluid px-3 px-lg-4" style="max-width:1200px;margin:0 auto;">

    <div class="interface-wrap">

      <!-- SIDEBAR -->
      <aside class="sidebar">
        <div class="sidebar-brand">
          <div class="sidebar-brand-icon"><i class="fa-solid fa-utensils"></i></div>
          <div>
            <div class="sidebar-brand-name">Le Gourmet</div>
            <div class="sidebar-brand-sub">Serveur</div>
          </div>
        </div>

        <a class="nav-item-s active" id="navPlanSalle">
          <i class="bi bi-grid-1x2"></i> Plan de salle
        </a>
        <a class="nav-item-s" id="navCommandes">
          <i class="bi bi-receipt"></i> Commandes
          <span class="badge-s orange">4</span>
        </a>
        <a class="nav-item-s" id="navDemandes">
          <i class="bi bi-bell"></i> Demandes
          <span class="badge-s">2</span>
        </a>
        <a class="nav-item-s" id="navHistorique">
          <i class="bi bi-clock-history"></i> Historique
        </a>

        <div class="sidebar-footer">
          <p>Service du soir<br>{{ date('l d F') }} · {{ date('H\hi') }}</p>
        </div>
      </aside>

      <!-- PLAN DE SALLE -->
      <section class="plan-area">
        <div class="plan-header">
          <div class="plan-title">Plan de salle</div>
          <button type="button" class="refresh-btn" id="btnRefreshPlan"><i class="bi bi-arrow-clockwise"></i></button>
        </div>

        <div class="legend">
          <span class="legend-item"><span class="legend-dot" style="background:var(--free);"></span> Libre (9)</span>
          <span class="legend-item"><span class="legend-dot" style="background:var(--active);"></span> Commande (4)</span>
          <span class="legend-item"><span class="legend-dot" style="background:var(--alert);"></span> Appel (1)</span>
          <span class="legend-item"><span class="legend-dot" style="background:var(--pay);"></span> Paiement (2)</span>
        </div>

        <div class="tables-grid" id="tables-grid">
          <!-- Row 1 -->
          <div class="table-cell free" data-table="T1">
            <div class="table-label">T1</div>
          </div>
          <div class="table-cell active-order selected" data-table="T2">
            <span class="table-badge-s orange">2</span>
            <div class="table-label">T2</div>
          </div>
          <div class="table-cell free" data-table="T3">
            <div class="table-label">T3</div>
          </div>
          <div class="table-cell alert-call" data-table="T4">
            <span class="table-badge-s red"><i class="bi bi-bell-fill" style="font-size:.55rem;"></i></span>
            <div class="table-label">T4</div>
          </div>
          <!-- Row 2 -->
          <div class="table-cell free" data-table="T5">
            <div class="table-label">T5</div>
          </div>
          <div class="table-cell free" data-table="T6">
            <div class="table-label">T6</div>
          </div>
          <div class="table-cell active-order" data-table="T7">
            <span class="table-badge-s orange">1</span>
            <div class="table-label">T7</div>
          </div>
          <div class="table-cell free" data-table="T8">
            <div class="table-label">T8</div>
          </div>
          <!-- Row 3 -->
          <div class="table-cell free" data-table="T9">
            <div class="table-label">T9</div>
          </div>
          <div class="table-cell free" data-table="T10">
            <div class="table-label">T10</div>
          </div>
          <div class="table-cell waiting-pay" data-table="T11">
            <span class="table-badge-s blue">1</span>
            <div class="table-label">T11</div>
          </div>
          <div class="table-cell free" data-table="T12">
            <div class="table-label">T12</div>
          </div>
          <!-- Row 4 -->
          <div class="table-cell free" data-table="T13">
            <div class="table-label">T13</div>
          </div>
          <div class="table-cell free" data-table="T14">
            <div class="table-label">T14</div>
          </div>
          <div class="table-cell active-order" data-table="T15">
            <span class="table-badge-s orange">4</span>
            <div class="table-label">T15</div>
          </div>
          <div class="table-cell waiting-pay" data-table="T16">
            <span class="table-badge-s blue">1</span>
            <div class="table-label">T16</div>
          </div>
        </div>
      </section>

      <!-- DETAIL PANEL -->
      <aside class="detail-panel" id="detail-panel">
        <div class="panel-table-num" id="panel-table-num">Table 2</div>
        <div class="panel-persons" id="panel-persons">2 personnes connectées</div>

        <div class="panel-avatars">
          <div class="table-avatar"><i class="bi bi-person-fill"></i></div>
          <div class="table-avatar"><i class="bi bi-person-fill"></i></div>
        </div>

        <span class="status-chip active"><i class="bi bi-circle-fill" style="font-size:.5rem;"></i> Commande active</span>

        <div class="panel-section">Commande active</div>
        <div id="order-lines">
          <div class="order-line">
            <div><div class="order-line-name">Burger Royal</div><div class="order-line-qty">x2</div></div>
            <div class="order-line-price">9 000 FCFA</div>
          </div>
          <div class="order-line">
            <div><div class="order-line-name">Jus Bissap</div><div class="order-line-qty">x2</div></div>
            <div class="order-line-price">2 000 FCFA</div>
          </div>
        </div>

        <div class="panel-total">
          <span class="label">Total</span>
          <span class="amount" id="panel-total">11 000 FCFA</span>
        </div>

        <button type="button" class="btn-panel primary" id="btnConfirmOrder">
          <i class="bi bi-check-circle-fill"></i> Voir la commande
        </button>
        <button type="button" class="btn-panel outline" id="btnCallServer">
          <i class="bi bi-bell-fill"></i> Appeler le serveur
        </button>
      </aside>

    </div>

  </div>
</main>

<div id="toast"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  function showToast(msg) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg; 
    t.style.opacity = 1;
    clearTimeout(t._timer);
    t._timer = setTimeout(() => t.style.opacity = 0, 2800);
  }

  // Navigation interne
  const navItems = document.querySelectorAll('.nav-item-s');
  navItems.forEach(item => {
    item.addEventListener('click', function() {
      navItems.forEach(n => n.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Action Boutons
  const btnRefresh = document.getElementById('btnRefreshPlan');
  if (btnRefresh) {
    btnRefresh.addEventListener('click', () => showToast('Plan actualisé ✓'));
  }

  const btnConfirmOrder = document.getElementById('btnConfirmOrder');
  if (btnConfirmOrder) {
    btnConfirmOrder.addEventListener('click', () => showToast('Commande confirmée ✓'));
  }

  const btnCallServer = document.getElementById('btnCallServer');
  if (btnCallServer) {
    btnCallServer.addEventListener('click', () => showToast('Serveur appelé à la table !'));
  }

  // Données des tables
  const tableData = {
    T1:{persons:0,status:'free',orders:[]},
    T2:{persons:2,status:'active',orders:[{n:'Burger Royal',q:2,p:9000},{n:'Jus Bissap',q:2,p:2000}]},
    T3:{persons:0,status:'free',orders:[]},
    T4:{persons:3,status:'alert',orders:[{n:'Pizza Gourmet',q:1,p:6000},{n:'Fondant Choc.',q:1,p:2500}]},
    T5:{persons:0,status:'free',orders:[]},
    T6:{persons:0,status:'free',orders:[]},
    T7:{persons:2,status:'active',orders:[{n:'Poulet Braisé',q:2,p:8000},{n:'Alloco Spécial',q:1,p:1500}]},
    T8:{persons:0,status:'free',orders:[]},
    T9:{persons:0,status:'free',orders:[]},
    T10:{persons:0,status:'free',orders:[]},
    T11:{persons:2,status:'pay',orders:[{n:'Tilapia Grillé',q:1,p:5500},{n:'Coca-Cola',q:2,p:1600}]},
    T12:{persons:0,status:'free',orders:[]},
    T13:{persons:0,status:'free',orders:[]},
    T14:{persons:0,status:'free',orders:[]},
    T15:{persons:4,status:'active',orders:[{n:'Burger Royal',q:2,p:9000},{n:'Pizza Margherita',q:1,p:4500},{n:'Coca-Cola',q:2,p:2000},{n:'Tiramisu',q:1,p:2500}]},
    T16:{persons:2,status:'pay',orders:[{n:'Pizza Gourmet',q:2,p:12000},{n:'Fondant Choc.',q:2,p:5000}]},
  };

  function selectTable(cell, tableId) {
    document.querySelectorAll('.table-cell').forEach(c => c.classList.remove('selected'));
    cell.classList.add('selected');

    const data = tableData[tableId];
    if (!data) return;

    const panelTableNum = document.getElementById('panel-table-num');
    const panelPersons = document.getElementById('panel-persons');
    const linesEl = document.getElementById('order-lines');
    const panelTotal = document.getElementById('panel-total');

    if (panelTableNum) panelTableNum.textContent = 'Table ' + tableId.replace('T','');
    if (panelPersons) panelPersons.textContent = data.persons > 0 ? data.persons + ' personne' + (data.persons>1?'s':'') + ' connectée' + (data.persons>1?'s':'') : 'Table libre';

    if (linesEl) {
      if (data.orders.length === 0) {
        linesEl.innerHTML = '<div style="padding:16px 0;text-align:center;color:var(--muted);font-size:.82rem;">Aucune commande en cours</div>';
        if (panelTotal) panelTotal.textContent = '0 FCFA';
      } else {
        let total = 0;
        linesEl.innerHTML = data.orders.map(o => {
          total += o.p;
          return `<div class="order-line">
            <div><div class="order-line-name">${o.n}</div><div class="order-line-qty">x${o.q}</div></div>
            <div class="order-line-price">${o.p.toLocaleString('fr-FR')} FCFA</div>
          </div>`;
        }).join('');
        if (panelTotal) panelTotal.textContent = total.toLocaleString('fr-FR') + ' FCFA';
      }
    }
  }

  // Événements sur les cartes des tables
  document.querySelectorAll('.table-cell').forEach(cell => {
    cell.addEventListener('click', function() {
      const tableId = this.getAttribute('data-table');
      selectTable(this, tableId);
    });
  });
});
</script>
@endpush