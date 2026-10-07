@extends('layouts.app')

@section('title', 'Suivi commande — Le Prestige')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>

<style>
  body { 
    background: #FAF7F2; 
    color: #1A1A1A; 
    font-family: 'Poppins', sans-serif; 
    margin: 0; 
    min-height: 100vh; 
    display: flex; 
    justify-content: center;
    align-items: center; 
  }
  
  .page-max { 
    max-width: 450px; 
    width: 100%;
    background: #FAF7F2;
    padding: 40px 20px;
  }
  
  .m-topbar-btn {
    width: 38px; height: 38px;
    border-radius: 10px; background: rgba(0,0,0,0.05);
    display: flex; align-items: center; justify-content: center;
    color: #1A1A1A; font-size: 1.2rem; text-decoration: none;
    border: none; cursor: pointer; flex-shrink: 0;
  }

  .header-info { text-align: center; margin-bottom: 30px; }
  .header-title { font-family: 'Poppins', serif; font-size: 1.4rem; font-weight: 700; }
  
  .suivi-chef-wrapper { text-align: center; margin: 20px 0; }
  .suivi-chef-icon { font-size: 3.5rem; color: #685942; }
  .suivi-main-title { font-family: 'Poppins', serif; font-size: 1.7rem; font-weight: 800; text-align: center; margin-bottom: 8px; }
  .suivi-desc { font-size: 0.9rem; color: #555; text-align: center; margin-bottom: 35px; }

  .custom-timeline { list-style: none; padding: 0; margin: 0 auto; max-width: 340px; position: relative; }
  .custom-timeline::before { content: ''; position: absolute; left: 25px; top: 10px; bottom: 20px; width: 2px; background: #EAE3D8; z-index: 1; }
  .timeline-row { display: flex; align-items: center; margin-bottom: 28px; position: relative; z-index: 2; padding-left: 15px; }
  .timeline-center-badge { width: 34px; display: flex; justify-content: center; margin-right: 15px; z-index: 2; }
  .timeline-left-time { width: 55px; font-size: 0.88rem; color: #666; text-align: left; font-weight: 500; margin-right: 10px; }
  
  .dot-status { width: 20px; height: 20px; border-radius: 50%; background: #FFF; border: 2px solid #DDD; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: bold; }
  .dot-status.done { background: #4CAF50; border-color: #4CAF50; color: #FFF; }
  .dot-status.active { background: #F4821F; border-color: #F4821F; color: #FFF; }
  .dot-status.pending { background: #FFF; border-color: #DDD; }

  .timeline-right-label { font-size: 0.92rem; color: #888; font-weight: 500; }
  .highlight-dark { color: #1A1A1A; font-weight: 700; }
  .highlight-active { color: #1A1A1A; font-weight: 700; }

  .btn-action-detail { width: 100%; background: #7B1C2A; border: 1px solid #ECE4DA; color: #FFF; font-weight: 600; padding: 14px; border-radius: 14px; margin-top: 40px; cursor: pointer; }
  .suivi-order-card {
    background:#FFF; border-radius:18px; padding:16px 18px; margin:18px 20px 0;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
  }
  .suivi-order-card .so-line {
    display:flex; justify-content:space-between; padding:6px 0;
    border-bottom:1px dashed #EAE3D8; font-size:.92rem;
  }
  .suivi-order-card .so-line:last-child { border-bottom:none; }
  .suivi-order-card .so-total { font-weight:800; color:#7B1C2A; }
  .suivi-pay-line {
    display:flex; justify-content:space-between; padding:14px 20px 0; font-size:.9rem; color:#555;
  }
</style>
@endpush

@section('content')
<div class="page-max">
  
  <div class="header-info">
    <a href="{{ route('panier.table') }}" class="m-topbar-btn"><i class="bi bi-arrow-left"></i></a>
    <div class="header-title">Commande #<span id="cmdNumero">—</span></div>
    <div style="font-size: 0.9rem; color: black; margin-top: 5px;"><strong id="cmdTable">Table 15</strong> · <span id="cmdDate"></span></div>
  </div>

  <div class="suivi-chef-wrapper">
    <i class="fa-solid fa-utensils suivi-chef-icon"></i>
  </div>

  <h1 class="suivi-main-title">En préparation</h1>
  <p class="suivi-desc">Votre commande est en <strong>cours de préparation.</strong></p>

  <div class="suivi-order-card" id="suiviItemsList"></div>
  <div class="suivi-pay-line">
    <span>Moyen de paiement</span>
    <strong id="cmdPaiement">—</strong>
  </div>

  <ul class="custom-timeline">
    <li class="timeline-row">
      <div class="timeline-center-badge"><div class="dot-status done">✓</div></div>
      <div class="timeline-left-time">12:45</div>
      <div class="timeline-right-label highlight-dark">Commande reçue</div>
    </li>
    <li class="timeline-row">
      <div class="timeline-center-badge"><div class="dot-status done">✓</div></div>
      <div class="timeline-left-time">12:46</div>
      <div class="timeline-right-label highlight-dark">Confirmée par le restaurant</div>
    </li>
    <li class="timeline-row">
      <div class="timeline-center-badge"><div class="dot-status active">✓</div></div>
      <div class="timeline-left-time" style="color: #F4821F;">12:50</div>
      <div class="timeline-right-label highlight-active">En préparation</div>
    </li>
    <li class="timeline-row">
      <div class="timeline-center-badge"><div class="dot-status pending"></div></div>
      <div class="timeline-left-time"></div>
      <div class="timeline-right-label">Prête</div>
    </li>
    <li class="timeline-row">
      <div class="timeline-center-badge"><div class="dot-status pending"></div></div>
      <div class="timeline-left-time"></div>
      <div class="timeline-right-label">Servie</div>
    </li>
  </ul>

  <button class="btn-action-detail" onclick="location.href='{{ route('construction') }}'">
    Voir le détail de la commande
  </button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var order = null;
  try { 
    order = JSON.parse(localStorage.getItem('derniereCommande') || 'null'); 
  } catch(e) {}

  if (!order) {
    document.getElementById('cmdNumero').textContent = '—';
    document.getElementById('suiviItemsList').innerHTML = '<p style="text-align:center;color:#888;padding:10px 0;">Aucune commande en cours.</p>';
    return;
  }

  document.getElementById('cmdNumero').textContent = order.numero;
  document.getElementById('cmdTable').textContent = order.table || 'Table 15';
  document.getElementById('cmdDate').textContent = order.date;
  document.getElementById('cmdPaiement').textContent = order.paiement;

  var lignes = (order.items || []).map(function(it) {
    var lt = (it.prix * it.qty).toLocaleString('fr-FR');
    return '<div class="so-line"><span>' + it.nom + ' × ' + it.qty + '</span><span>' + lt + ' FCFA</span></div>';
  }).join('');
  
  lignes += '<div class="so-line"><span>Sous-total</span><span>' + order.sousTotal + '</span></div>';
  lignes += '<div class="so-line"><span>Taxes (5%)</span><span>' + order.taxes + '</span></div>';
  lignes += '<div class="so-line so-total"><span>Total</span><span>' + order.total + '</span></div>';
  
  document.getElementById('suiviItemsList').innerHTML = lignes;
});
</script>
@endpush