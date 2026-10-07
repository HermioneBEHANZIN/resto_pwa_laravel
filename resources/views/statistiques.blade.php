@extends('layouts.app')

@section('title', 'Statistiques — Le Gourmet')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/statistiques.css') }}">
@endpush

@section('content')
<main class="main statistiques-main">
  <div class="container-fluid p-0">

    <h1 class="page-title">Statistiques</h1>
    <p class="page-subtitle mb-4">Analyse des performances de votre restaurant</p>

    <!-- Filtres de période -->
    <div class="period-row mb-4">
      <button type="button" class="period-chip" data-period="jour">Aujourd'hui</button>
      <button type="button" class="period-chip active" data-period="semaine">Cette semaine</button>
      <button type="button" class="period-chip" data-period="mois">Ce mois</button>
      <button type="button" class="period-chip" data-period="trimestre">Ce trimestre</button>
      <button type="button" class="period-chip" data-period="annee">Cette année</button>
      <button type="button" class="period-chip" data-period="perso"><i class="fa-regular fa-calendar"></i> Personnalisé</button>
    </div>

    <!-- 4 cartes KPI -->
    <div class="row g-3 mb-4">
      <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card orange">
          <div class="kpi-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
          <div>
            <div class="label">Chiffres d'affaire journaliers</div>
            <div class="value">425 000<span class="unit">FCFA</span></div>
            <div class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs période précédente</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card rouge">
          <div class="kpi-icon"><i class="fa-solid fa-file-lines"></i></div>
          <div>
            <div class="label">Commandes</div>
            <div class="value">128</div>
            <div class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> +8% vs période précédente</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card bleu">
          <div class="kpi-icon"><i class="fa-solid fa-users"></i></div>
          <div>
            <div class="label">Clients servis</div>
            <div class="value">102</div>
            <div class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> +15% vs période précédente</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card violet">
          <div class="kpi-icon"><i class="fa-solid fa-user-group"></i></div>
          <div>
            <div class="label">Montant moyen par commande</div>
            <div class="value">7 800<span class="unit">FCFA</span></div>
            <div class="trend down"><i class="fa-solid fa-arrow-trend-down"></i> -5% vs période précédente</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Evolution du chiffre d'affaire -->
    <div class="chart-card mb-4">
      <div class="chart-card-header">
        <div class="chart-title">Evolution du chiffre d'affaire</div>
        <div class="period-select">Par semaine <i class="fa-solid fa-chevron-down"></i></div>
      </div>
      <div class="chart-wrap" id="revenueChart"></div>
    </div>

    <!-- Répartition des ventes par catégories -->
    <div class="chart-card mb-4">
      <div class="chart-title mb-4">Répartition des ventes par catégories</div>
      <div class="row align-items-center g-4">
        <div class="col-12 col-md-6">
          <div class="chart-wrap" id="pieChart"></div>
        </div>
        <div class="col-12 col-md-6">
          <div class="pie-legend" id="pieLegend"></div>
        </div>
      </div>
    </div>

    <!-- Evolution du nombre de commandes -->
    <div class="chart-card mb-4">
      <div class="chart-card-header">
        <div class="chart-title">Evolution du nombre de commandes</div>
        <div class="period-select">Par semaine <i class="fa-solid fa-chevron-down"></i></div>
      </div>
      <div class="chart-wrap" id="ordersChart"></div>
    </div>

    <!-- Répartition des modes de paiements -->
    <div class="chart-card mb-4">
      <div class="chart-title mb-4">Répartitions des modes de paiements</div>

      <div class="split-row mb-4">
        <span class="split-dot" style="background:var(--orange)"></span>
        <span class="split-name">Mobile money</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:37%; background:var(--orange)"></div></div>
        <span class="split-pct">37%</span>
      </div>

      <div class="split-row mb-4">
        <span class="split-dot" style="background:var(--vert)"></span>
        <span class="split-name">Espèces</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:53%; background:var(--vert)"></div></div>
        <span class="split-pct">53%</span>
      </div>

      <div class="split-row">
        <span class="split-dot" style="background:var(--violet)"></span>
        <span class="split-name">Carte bancaire</span>
        <div class="split-bar-track"><div class="split-bar-fill" style="width:10%; background:var(--violet)"></div></div>
        <span class="split-pct">10%</span>
      </div>
    </div>

    <!-- Bannière info -->
    <div class="info-banner">
      <i class="fa-solid fa-circle-info"></i>
      <span>Les données sont mises à jour en temps réel.</span>
    </div>

  </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/statistiques.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Gestion interactive des puces de périodes
  const periodChips = document.querySelectorAll('.period-chip');
  periodChips.forEach(chip => {
    chip.addEventListener('click', function () {
      periodChips.forEach(c => c.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
</script>
@endpush