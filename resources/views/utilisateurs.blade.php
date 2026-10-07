<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Utilisateurs — Le Gourmet</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/header-sidebar.css">
<link rel="stylesheet" href="assets/css/utilisateurs.css">
</head>
<body data-page="users">

  <div class="app">
<div id="hsMount"></div>

<main class="main utilisateurs-main">
  <div class="container-fluid p-0">

    <!-- Carte chiffres d'affaires journaliers -->
    <div class="revenue-card d-flex align-items-center flex-wrap gap-4 p-4 mb-4">
      <div class="revenue-icon">
        <i class="fa-solid fa-chart-line" style="color: #202020;"></i>
      </div>
      <div class="revenue-info">
        <div class="label">Chiffres d'affaires journaliers</div>
        <div class="amount" style="color:var(--orange)">1 250 000<span class="unit" style="color:var(--orange)">FCFA</span></div>
        <div class="delta" style="color:var(--orange)">+ 10%</div>
      </div>
      <div class="revenue-date ms-md-auto d-flex align-items-center gap-2">
        <i class="fa-regular fa-calendar"></i>
        03 juillet 2026
      </div>
    </div>

    <h1 class="page-title mb-4">Utilisateurs</h1>

    <!-- 4 cartes statistiques -->
    <div class="row g-3 mb-4">
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card total h-100">
          <div class="stat-icon-round"><i class="fa-solid fa-users"></i></div>
          <div>
            <div class="label">Total des utilisateurs</div>
            <div class="value">14</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card admins h-100">
          <div class="stat-icon-round"><i class="fa-solid fa-crown"></i></div>
          <div>
            <div class="label">Administrateurs</div>
            <div class="value">2</div>
            <div class="sub">Compte avec accès complet</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card serveurs h-100">
          <div class="stat-icon-round"><i class="fa-solid fa-bell-concierge"></i></div>
          <div>
            <div class="label">Serveurs</div>
            <div class="value">7</div>
            <div class="sub">En charge du service</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card cuisine h-100">
          <div class="stat-icon-round">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
              <path d="M12 2c-2.2 0-4 2.1-4 4.7 0 1.6.7 3 1.8 3.9-1.7.6-2.8 2.2-2.8 4.1v.3h10v-.3c0-1.9-1.1-3.5-2.8-4.1 1.1-.9 1.8-2.3 1.8-3.9C16 4.1 14.2 2 12 2z"/>
              <rect x="7" y="16" width="10" height="2.2" rx="1.1"/>
              <rect x="7.6" y="19" width="8.8" height="2" rx="1"/>
            </svg>
          </div>
          <div>
            <div class="label">Cuisiniers</div>
            <div class="value">5</div>
            <div class="sub">En charge de la cuisine</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recherche + statut + bouton ajouter -->
    <div class="toolbar-row mb-4">
      <div class="search-col">
        <div class="input-group search-group">
          <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
          <input type="text" class="form-control" placeholder="Rechercher un utilisateur...">
        </div>
      </div>
      <div class="status-pill"><span class="dot"></span> Actif</div>
      <a href="ajouter-utilisateur.html" class="btn btn-add-user">
        <i class="fa-solid fa-plus me-2"></i>Ajouter un utilisateur
      </a>
    </div>

    <!-- Filtres -->
    <div class="filters-row mb-4">
      <button type="button" class="filter-chip active" data-filter="tous">Tous (14)</button>
      <button type="button" class="filter-chip" data-filter="super-administrateur">Super Administrateurs (1)</button>
      <button type="button" class="filter-chip" data-filter="administrateur">Administrateurs (2)</button>
      <button type="button" class="filter-chip" data-filter="serveur">Serveurs (7)</button>
      <button type="button" class="filter-chip" data-filter="cuisinier">Cuisiniers (5)</button>
    </div>

    <!-- Tableau (desktop / tablette) -->
    <div class="table-card mb-3 d-none d-md-block">
      <div class="table-responsive">
        <table class="table users-table mb-0">
          <thead>
            <tr>
              <th>Utilisateurs</th>
              <th>Rôle</th>
              <th>Téléphone</th>
              <th>Disponibilité</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="usersTableBody"></tbody>
        </table>
      </div>
    </div>

    <!-- Liste (mobile) -->
    <div class="d-md-none mb-3" id="usersCards"></div>

    <div class="text-center mb-2">
      <button class="btn see-more-btn">
        Voir plus d'utilisateurs <i class="fa-solid fa-chevron-down ms-2"></i>
      </button>
    </div>

  </div>
</main>
  </div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Header + Sidebar déjà fournis (ne pas modifier) -->
<script src="assets/js/header-sidebar.js"></script>

<!-- Script propre à la page Utilisateurs -->
<script src="assets/js/utilisateurs.js"></script>
</body>
</html>
