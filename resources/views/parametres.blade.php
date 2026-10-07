@extends('layouts.app')

@section('title', 'Le Gourmet — Paramètres')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/parametres.css') }}">
@endpush

@section('content')
<main class="main parametres-main">
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

    <h1 class="page-title mb-2">Paramètres</h1>
    <p class="page-subtitle mb-4">Gérez les paramètres de votre restaurant et personnalisez l'application.</p>

    <div class="row g-3">

      <!-- Colonne gauche : sous-modules -->
      <div class="col-12 col-lg-3">
        <div class="submodules-card">
          <h2>Sous-modules</h2>
          <div class="submodule-list" id="submoduleList">
            <button type="button" class="btn active" data-target="general">Informations générales</button>
            <button type="button" class="btn" data-target="apparence">Apparence</button>
            <button type="button" class="btn" data-target="preferences">Préférences</button>
            <button type="button" class="btn" data-target="comptes">Comptes</button>
          </div>
        </div>
      </div>

      <!-- Colonne droite : formulaire -->
      <div class="col-12 col-lg-9">
        <div class="form-card">
          <h2>Informations générales</h2>

          <form id="settingsForm" method="POST" action="#" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4 mb-1">
              <div class="col-12 col-md-6 field">
                <label for="nom">Nom du restaurant</label>
                <input type="text" class="form-control" id="nom" name="nom" value="Le Gourmet restaurant">
              </div>
              <div class="col-12 col-md-6 field">
                <label for="cuisine">Type de cuisine</label>
                <input type="text" class="form-control" id="cuisine" name="cuisine" value="Cuisine africaine et internationale">
              </div>
            </div>

            <div class="row g-4 mb-1 mt-1">
              <div class="col-12 field">
                <label for="desc">Description (Facultatif)</label>
                <textarea class="form-control" id="desc" name="description" rows="3">Le Gourmet restaurant vous propose une expérience culinaire unique mélant saveurs africaines et internationales dans un cadre chaleureux et convivial.</textarea>
              </div>
            </div>

            <div class="row g-4 mb-1 mt-1">
              <div class="col-12 col-md-6 field">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="Calavi, Quartier Houéto, Bénin">
              </div>
              <div class="col-12 col-md-6 field">
                <label for="tel">Numéro de téléphone</label>
                <div class="phone-field">
                  <span class="phone-flag"><span class="flag"></span>+229 <i class="fa-solid fa-chevron-down"></i></span>
                  <input type="tel" id="tel" name="telephone" value="01 97 36 74 67">
                </div>
              </div>
            </div>

            <div class="row g-4 mb-1 mt-1">
              <div class="col-12 col-md-6 field">
                <label for="email">Adresse e-mail</label>
                <div class="field-email">
                  <i class="fa-regular fa-envelope"></i>
                  <input type="email" id="email" name="email" value="contact@legourmet.bj">
                </div>
              </div>
              <div class="col-12 col-md-6 field">
                <label for="site">Site web (facultatif)</label>
                <input type="text" class="form-control" id="site" name="site_web" value="www.legourmet.bj">
              </div>
            </div>

            <hr class="divider">

            <div class="logo-section">
              <h3>Logo du restaurant</h3>
              <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                  <div class="logo-preview">
                    <button class="del-btn" type="button" id="btnDeleteLogo" aria-label="Supprimer le logo">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                    <div>
                      <div class="logo-badge"><i class="fa-solid fa-utensils"></i></div>
                      <div class="brand-name">Le Gourmet</div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="logo-upload" id="logoUploadZone">
                    <div class="up-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div class="upload-text">Glissez-déposez une image ici</div>
                    <div class="hint">ou</div>
                    <button type="button" class="import-btn" id="btnBrowseLogo">Importer une image</button>
                    <input type="file" id="logoFileInput" name="logo" accept="image/png, image/jpeg, image/webp" style="display:none;">
                    <div class="fmt">PNG, JPG ou WEBP</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-actions d-flex justify-content-between align-items-center">
              <button type="button" class="btn btn-cancel" id="btnResetForm">Annuler</button>
              <button type="submit" class="btn btn-save">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/parametres.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Navigation sous-modules
  const submoduleBtns = document.querySelectorAll('#submoduleList .btn');
  submoduleBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      submoduleBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Gestion de l'upload d'image/logo
  const logoFileInput = document.getElementById('logoFileInput');
  const btnBrowseLogo = document.getElementById('btnBrowseLogo');
  const uploadText = document.querySelector('.upload-text');

  if (btnBrowseLogo && logoFileInput) {
    btnBrowseLogo.addEventListener('click', () => logoFileInput.click());

    logoFileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        if (uploadText) {
          uploadText.textContent = this.files[0].name;
        }
      }
    });
  }

  // Action suppression logo
  const btnDeleteLogo = document.getElementById('btnDeleteLogo');
  if (btnDeleteLogo) {
    btnDeleteLogo.addEventListener('click', function() {
      if (confirm('Voulez-vous vraiment supprimer le logo ?')) {
        if (logoFileInput) logoFileInput.value = '';
        if (uploadText) uploadText.textContent = 'Glissez-déposez une image ici';
      }
    });
  }
});
</script>
@endpush