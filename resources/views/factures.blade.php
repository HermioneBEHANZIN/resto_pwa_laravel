@extends('layouts.app')

@section('title', 'Mes Factures — Le Gourmet')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root {
  --wine: #7B1C2A;
  --wine-dark: #5A1320;
  --gold: #C9952A;
  --bg-pink: #F9DDE2;
  --text: #2C2018;
  --muted: #9A8E83;
  --border: #EDE0D0;
}

.f-wrap {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px 18px 90px;
}

.f-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--wine);
  margin-bottom: 22px;
  padding-left: 14px;
  border-left: 5px solid var(--wine);
}

.f-card {
  background: #fff;
  border-radius: 20px;
  padding: 18px 20px;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 10px 28px rgba(0,0,0,.06);
}

.f-icon {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: #FFF5F5;
  color: var(--wine);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  flex-shrink: 0;
}

.f-info {
  flex: 1;
  min-width: 0;
}

.f-num {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  color: var(--text);
  font-size: 1.05rem;
}

.f-date {
  font-size: .8rem;
  color: var(--muted);
  margin-top: 2px;
}

.f-pay {
  font-size: .78rem;
  color: var(--muted);
  margin-top: 2px;
}

.f-right {
  text-align: right;
  flex-shrink: 0;
}

.f-amount {
  font-family: 'Playfair Display', serif;
  font-weight: 800;
  color: var(--wine);
  font-size: 1.15rem;
}

.f-status {
  display: inline-block;
  margin-top: 6px;
  background: #E7F7EC;
  color: #2E9E5B;
  font-size: .7rem;
  font-weight: 700;
  padding: 4px 12px;
  border-radius: 20px;
}

.f-btn {
  display: block;
  margin-top: 10px;
  background: var(--wine);
  color: #fff;
  border: none;
  border-radius: 20px;
  padding: 6px 16px;
  font-size: .78rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s;
}

.f-btn:hover {
  background: var(--wine-dark);
}

.f-empty {
  text-align: center;
  padding: 70px 20px;
  color: var(--muted);
}

.f-empty i {
  font-size: 3rem;
  color: #ddd;
  margin-bottom: 16px;
  display: block;
}

.f-modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(30,10,14,.5);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 3000;
  padding: 20px;
}

.f-modal-overlay.show {
  display: flex;
}

.f-modal {
  background: #fff;
  border-radius: 24px;
  max-width: 420px;
  width: 100%;
  padding: 26px;
  max-height: 85vh;
  overflow-y: auto;
}

.f-modal h3 {
  font-family: 'Playfair Display', serif;
  color: var(--wine);
  margin-bottom: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.f-modal .close-f {
  background: rgba(123,28,42,.1);
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  color: var(--wine);
  cursor: pointer;
}

.f-line {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px dashed var(--border);
  font-size: .92rem;
}

.f-line:last-child {
  border-bottom: none;
}
</style>
@endpush

@section('content')
<div class="f-wrap">
  <div class="f-title">Mes factures</div>
  <div id="facturesList"></div>
</div>

<!-- Modal Détails Facture -->
<div class="f-modal-overlay" id="fModalOverlay">
  <div class="f-modal">
    <h3>Détails facture <button class="close-f" id="fModalClose"><i class="bi bi-x-lg"></i></button></h3>
    <div id="fModalBody"></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

  window.chargerFactures = function() {
    var factures = [];
    try { 
      factures = JSON.parse(localStorage.getItem('factures') || '[]'); 
    } catch(e) {}
    
    var list = document.getElementById('facturesList');
    if (!list) return;

    if (!factures.length) {
      list.innerHTML = '<div class="f-empty"><i class="bi bi-receipt"></i><p>Aucune facture pour le moment.</p></div>';
      return;
    }

    list.innerHTML = factures.map(function(f, i) {
      return '<div class="f-card">'
        + '<div class="f-icon"><i class="bi bi-file-earmark-text"></i></div>'
        + '<div class="f-info">'
        +   '<div class="f-num">Facture #' + f.numero + '</div>'
        +   '<div class="f-date">' + f.date + '</div>'
        +   '<div class="f-pay">' + f.paiement + '</div>'
        + '</div>'
        + '<div class="f-right">'
        +   '<div class="f-amount">' + f.total + '</div>'
        +   '<div class="f-status">Payée</div>'
        +   '<button class="f-btn" onclick="voirFacture(' + i + ')">Voir</button>'
        + '</div>'
      + '</div>';
    }).join('');
  };

  window.voirFacture = function(i) {
    var factures = [];
    try { 
      factures = JSON.parse(localStorage.getItem('factures') || '[]'); 
    } catch(e) {}

    var f = factures[i];
    if (!f) return;

    var lignes = (f.items || []).map(function(it) {
      return '<div class="f-line"><span>' + it.nom + ' × ' + it.qty + '</span><span>' + (it.prix * it.qty).toLocaleString('fr-FR') + ' FCFA</span></div>';
    }).join('');

    var modalBody = document.getElementById('fModalBody');
    if (modalBody) {
      modalBody.innerHTML =
        '<div class="f-line"><span>Table</span><span>' + (f.table || '-') + '</span></div>'
        + lignes
        + '<div class="f-line"><span>Sous-total</span><span>' + f.sousTotal + '</span></div>'
        + '<div class="f-line"><span>Taxes</span><span>' + f.taxes + '</span></div>'
        + '<div class="f-line"><b>Total</b><b>' + f.total + '</b></div>'
        + '<div class="f-line"><span>Paiement</span><span>' + f.paiement + '</span></div>';
    }

    var modalOverlay = document.getElementById('fModalOverlay');
    if (modalOverlay) {
      modalOverlay.classList.add('show');
    }
  };

  var btnClose = document.getElementById('fModalClose');
  if (btnClose) {
    btnClose.addEventListener('click', function() {
      var modalOverlay = document.getElementById('fModalOverlay');
      if (modalOverlay) modalOverlay.classList.remove('show');
    });
  }

  var modalOverlay = document.getElementById('fModalOverlay');
  if (modalOverlay) {
    modalOverlay.addEventListener('click', function(e) {
      if (e.target.id === 'fModalOverlay') {
        this.classList.remove('show');
      }
    });
  }

  chargerFactures();
});
</script>
@endpush