@extends('layouts.app')

@section('title', 'Le Gourmet — Paiements')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/paiements.css') }}">

<style>
.serif { font-family: 'Playfair Display', serif; }
</style>
@endpush

@section('content')
<main class="main paiements-main">
  <div class="container-fluid p-0">

    <!-- Carte chiffres d'affaires journaliers -->
    <div class="revenue-card d-flex align-items-center flex-wrap gap-4 p-4 mb-4">
      <div class="revenue-icon">
        <i class="fa-solid fa-chart-line" style="color: #202020;"></i>
      </div>
      <div class="revenue-info">
        <div class="label">Chiffres d'affaires journaliers</div>
        <div class="amount" style="color:var(--orange)">1 250 000 <span class="unit" style="color:var(--orange)">FCFA</span></div>
        <div class="delta" style="color:var(--orange)">+ 10%</div>
      </div>
      <div class="revenue-date ms-md-auto d-flex align-items-center gap-2">
        <span>{{ date('d F Y') }}</span>
        <i class="fa-regular fa-calendar"></i>
      </div>
    </div>

    <h1 class="page-title mb-4">Paiements</h1>

    <!-- 4 cartes statistiques -->
    <div class="row g-3 mb-4">
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card stat-red h-100">
          <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
          <div class="label">Recettes totales</div>
          <div class="amount">425 000 FCFA</div>
          <div class="sub up">+12% par rapport à hier</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card stat-orange h-100">
          <div class="stat-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
          <div class="label">Mobile money</div>
          <div class="amount">180 000 FCFA</div>
          <div class="sub">37% des recettes</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card stat-green h-100">
          <div class="stat-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
          <div class="label">Espèces</div>
          <div class="amount">205 000 FCFA</div>
          <div class="sub">53% des recettes</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card stat-purple h-100">
          <div class="stat-icon"><i class="fa-solid fa-credit-card"></i></div>
          <div class="label">Carte bancaire</div>
          <div class="amount">40 000 FCFA</div>
          <div class="sub">10% des recettes</div>
        </div>
      </div>
    </div>

    <!-- Recherche + filtre -->
    <div class="toolbar-row mb-4">
      <div class="search-col">
        <div class="input-group search-group">
          <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
          <input type="text" class="form-control" id="searchPaymentInput" placeholder="Rechercher un mode de paiement...">
        </div>
      </div>
      <div class="filter-col">
        <div class="dropdown h-100">
          <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-filter me-2"></i>Filtrer par
          </button>
          <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item filter-opt" href="#" data-filter="all">Tous</a></li>
            <li><a class="dropdown-item filter-opt" href="#" data-filter="Espèces">Espèces</a></li>
            <li><a class="dropdown-item filter-opt" href="#" data-filter="Mobile money">Mobile money</a></li>
            <li><a class="dropdown-item filter-opt" href="#" data-filter="Carte bancaire">Carte bancaire</a></li>
          </ul>
        </div>
      </div>
    </div>

    <h2 class="section-title mb-3">Tous les paiements</h2>

    <!-- Tableau (desktop / tablette) -->
    <div class="table-card mb-3 d-none d-md-block">
      <div class="table-responsive">
        <table class="table payments-table mb-0">
          <thead>
            <tr>
              <th>N° de paiement</th>
              <th>Table</th>
              <th>Montant</th>
              <th>Mode de paiement</th>
              <th>Date et heure</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody id="paymentsTableBody"></tbody>
        </table>
      </div>
    </div>

    <!-- Liste (mobile) -->
    <div class="payments-cards d-md-none mb-3" id="paymentsCards"></div>

    <div class="text-center mb-5">
      <button type="button" class="btn see-more-btn" id="btnSeeMore">
        Voir plus de paiements <i class="fa-solid fa-chevron-down ms-2"></i>
      </button>
    </div>

    <!-- Répartition des paiements -->
    <div class="split-card p-4 p-lg-5 mb-4">
      <h2 class="section-title mb-4">Répartitions des paiements</h2>

      <div class="d-flex align-items-center gap-3 mb-4">
        <span class="split-dot" style="background:var(--orange)"></span>
        <span class="split-name">Mobile money</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:37%; background:var(--orange)"></div></div>
        <span class="split-pct">37%</span>
      </div>

      <div class="d-flex align-items-center gap-3 mb-4">
        <span class="split-dot" style="background:var(--vert)"></span>
        <span class="split-name">Espèces</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:53%; background:var(--vert)"></div></div>
        <span class="split-pct">53%</span>
      </div>

      <div class="d-flex align-items-center gap-3">
        <span class="split-dot" style="background:var(--violet)"></span>
        <span class="split-name">Carte bancaire</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:10%; background:var(--violet)"></div></div>
        <span class="split-pct">10%</span>
      </div>
    </div>

    <!-- Bannière info -->
    <div class="info-banner d-flex align-items-start gap-3 p-3">
      <i class="fa-solid fa-circle-info"></i>
      <span>Les montants affichés incluent la TVA (18%). Les données sont mises à jour en temps réel.</span>
    </div>

  </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/paiements.js') }}"></script>
@endpush