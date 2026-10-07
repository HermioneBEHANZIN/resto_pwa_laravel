@extends('layouts.app')

@section('title', 'Le Gourmet — Gestion des Sous-Catégories')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --bordeaux: #6E1423;
    --bordeaux-light: #8a1c2e;
    --bg-app: #F1F0FA;
    --gold: #E8A33D;
    --gold-soft: #FBEBD3;
    --red: #E5273A;
    --green: #4CAF50;
    --text-muted: #8A8A8A;
    --radius-lg: 20px;
    --radius-md: 16px;
    --radius-sm: 12px;
    --orange-50: #FF9500;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg-app);
    color: #1A1A1A;
    margin: 0;
  }

  .font-serif {
    font-family: 'Playfair Display', serif;
  }

  /* KPI card */
  .kpi-card {
    background: #fff;
    border: 1.5px solid var(--gold);
    border-radius: var(--radius-md);
    padding: 20px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
    margin-bottom: 40px;
    flex-wrap: wrap;
  }

  .kpi-left {
    display: flex;
    align-items: center;
    gap: 18px;
  }

  .kpi-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: var(--gold-soft);
    color: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }

  .kpi-label {
    font-size: 13.5px;
    color: var(--text-muted);
    margin-bottom: 6px;
  }

  .kpi-amount {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 32px;
    color: var(--orange-50);
    line-height: 1;
  }

  .kpi-amount .fcfa {
    font-size: 15px;
    letter-spacing: 1px;
    margin-left: 4px;
  }

  .kpi-growth {
    color: var(--orange-50);
    font-weight: 600;
    font-size: 14px;
    margin-top: 6px;
  }

  .kpi-date {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    border: 1px solid #ece9f8;
    border-radius: var(--radius-sm);
    padding: 12px 20px;
    font-weight: 500;
    color: #333;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  }

  .kpi-date i {
    color: #2f6fed;
  }

  /* Section title */
  .section-title {
    font-weight: 700;
    font-size: 34px;
    margin: 0 0 28px 0;
  }

  /* Tabs */
  .menu-tabs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 26px;
  }

  .menu-tabs button {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    font-size: 19px;
    background: #fff;
    border: none;
    border-radius: var(--radius-md);
    padding: 18px 10px;
    color: #1A1A1A;
    box-shadow: 0 3px 10px rgba(0,0,0,0.03);
    cursor: pointer;
    transition: all .2s ease;
  }

  .menu-tabs button.active {
    background: var(--bordeaux);
    color: #fff;
  }

  .menu-tabs button:not(.active):hover {
    background: #f7f6fd;
  }

  /* Content cards */
  .content-row {
    display: grid;
    grid-template-columns: 1.7fr 1fr;
    gap: 24px;
    align-items: start;
  }

  .panel {
    background: #fff;
    border-radius: var(--radius-md);
    padding: 34px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
  }

  .panel-title {
    font-weight: 700;
    color: var(--bordeaux);
    font-size: 23px;
    margin-bottom: 26px;
  }

  .form-group {
    margin-bottom: 22px;
  }

  .form-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 8px;
    font-weight: 500;
  }

  .form-control-custom {
    width: 100%;
    border: 1px solid #e3e1f0;
    background: #FAFAFD;
    border-radius: 10px;
    padding: 13px 16px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #333;
    outline: none;
  }

  .form-control-custom:focus {
    border-color: var(--bordeaux);
    background: #fff;
  }

  select.form-control-custom {
    appearance: none;
    background-image: none;
  }

  .select-wrap {
    position: relative;
  }

  .select-wrap i {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
    font-size: 13px;
  }

  .upload-zone {
    border: 2px dashed #d7d4ea;
    border-radius: 14px;
    padding: 48px 20px;
    text-align: center;
    background: #FAFAFD;
    cursor: pointer;
    margin-bottom: 28px;
    transition: border-color .2s ease, background .2s ease;
  }

  .upload-zone:hover {
    border-color: var(--bordeaux);
    background: #fdf6f7;
  }

  .upload-zone i {
    font-size: 30px;
    color: #2f6fed;
    margin-bottom: 14px;
    display: block;
  }

  .upload-zone .main-txt {
    font-size: 14.5px;
    color: #333;
  }

  .upload-zone .main-txt b {
    font-weight: 600;
  }

  .upload-zone .sub-txt {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 6px;
  }

  .form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
  }

  .btn-cancel {
    border: 1.5px solid #ddd9ee;
    background: #fff;
    color: #333;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 14.5px;
    cursor: pointer;
  }

  .btn-cancel:hover {
    background: #f6f5fb;
  }

  .btn-add {
    border: none;
    background: var(--bordeaux);
    color: #fff;
    padding: 12px 32px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .btn-add:hover {
    background: var(--bordeaux-light);
  }

  /* Preview panel */
  .preview-card {
    text-align: center;
  }

  .preview-img-wrap {
    background: #f4f3fa;
    border-radius: 14px 14px 0px 0px;
    overflow: hidden;
    margin-bottom: 18px;
  }

  .preview-img-wrap img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
  }

  .preview-name {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 26px;
    margin-bottom: 24px;
  }

  .btn-modify {
    width: 100%;
    border: 1.5px solid #ddd9ee;
    background: #fff;
    color: #1A1A1A;
    padding: 13px;
    border-radius: 30px;
    font-weight: 500;
    margin-top: 30px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
  }

  .btn-modify:hover {
    background: #f6f5fb;
  }

  .btn-delete {
    width: 100%;
    border: none;
    background: var(--red);
    color: #fff;
    padding: 13px;
    border-radius: 30px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
  }

  .btn-delete:hover {
    background: #c81f30;
  }

  /* Responsive */
  @media (max-width: 992px) {
    .content-row {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 767.98px) {
    .kpi-card {
      flex-direction: column;
      align-items: flex-start;
      padding: 18px 20px;
      gap: 14px;
      margin-bottom: 20px;
    }

    .kpi-date {
      width: 100%;
      justify-content: space-between;
    }

    .section-title {
      font-size: 24px;
      margin-bottom: 16px;
    }

    .panel-title {
      font-size: 1.125rem;
      margin-bottom: 18px;
    }

    .menu-tabs {
      display: flex;
      grid-template-columns: none;
      overflow-x: auto;
      gap: 10px;
      padding-bottom: 6px;
      margin-bottom: 20px;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }

    .menu-tabs::-webkit-scrollbar {
      display: none;
    }

    .menu-tabs button {
      flex: 0 0 auto;
      padding: 13px 20px;
      font-size: 15px;
      white-space: nowrap;
    }

    .content-row {
      gap: 16px;
    }

    .panel {
      padding: 18px;
    }

    .upload-zone {
      padding: 32px 16px;
      margin-bottom: 20px;
    }

    .preview-img-wrap img {
      height: 180px;
    }

    .form-actions {
      flex-direction: column-reverse;
      gap: 12px;
      justify-content: flex-start;
    }

    .form-actions .btn-cancel,
    .form-actions .btn-add {
      width: 100%;
      text-align: center;
      justify-content: center;
      min-height: 48px;
    }

    .btn-modify,
    .btn-delete {
      min-height: 48px;
    }
  }
</style>
@endpush

@section('content')
<main class="main">

  <!-- KPI CARD -->
  <div class="kpi-card">
    <div class="kpi-left">
      <div class="kpi-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
      <div>
        <div class="kpi-label" style="font-size:1rem;color:var(--text);">Chiffres d'affaires journaliers</div>
        <div class="kpi-amount">1 250 000 <span class="fcfa">FCFA</span></div>
        <div class="kpi-growth" id="kpiGrowth">+ 10%</div>
      </div>
    </div>
    <div class="kpi-date">
      <span>03 juillet 2026</span>
      <i class="fa-regular fa-calendar"></i>
    </div>
  </div>

  <!-- SECTION TITLE -->
  <h1 class="section-title font-serif">Gestion des menus</h1>

  <!-- TABS -->
  <div class="menu-tabs" id="menuTabs">
    <button type="button" data-tab="apercus" onclick="window.location.href='{{ route('menus.apercus') }}'">Aperçus</button>
    <button type="button" data-tab="categories" onclick="window.location.href='{{ route('menus.categories') }}'">Catégories</button>
    <button type="button" data-tab="sous-categories" class="active">Sous-catégories</button>
    <button type="button" data-tab="plats" onclick="window.location.href='{{ route('menus.plats') }}'">Plats</button>
  </div>

  <!-- CONTENT ROW -->
  <div class="content-row">

    <!-- LEFT PANEL : FORM -->
    <div class="panel">
      <div class="panel-title font-serif">Informations de la sous-catégorie</div>

      <div class="form-group">
        <label for="catName">Nom de la catégorie</label>
        <input type="text" id="catName" class="form-control-custom" placeholder="Ex : Burgers, Boissons...">
      </div>

      <div class="form-group">
        <label for="catParent">Catégorie parente</label>
        <div class="select-wrap">
          <select id="catParent" class="form-control-custom">
            <option value="">Aucune</option>
            <option value="entrees">Entrées</option>
            <option value="plats_principaux">Plats principaux</option>
            <option value="desserts">Desserts</option>
          </select>
          <i class="fa-solid fa-chevron-right"></i>
        </div>
      </div>

      <div class="upload-zone" id="uploadZone">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <div class="main-txt"><b>Cliquez pour télécharger</b> ou glisser déposer</div>
        <div class="sub-txt">PNG, JPG ou WEBP</div>
        <input type="file" id="fileInput" accept=".png,.jpg,.jpeg,.webp" style="display:none">
      </div>

      <div class="form-actions">
        <button type="button" class="btn-cancel">Annuler</button>
        <button type="button" class="btn-add"><i class="fa-solid fa-plus"></i> Ajouter</button>
      </div>
    </div>

    <!-- RIGHT PANEL : PREVIEW -->
    <div class="panel preview-card">
      <div class="panel-title font-serif" style="text-align:left;">Aperçu de la sous-catégorie</div>

      <div style="border: 0.60px solid #e3e1f0; border-radius: 15px; padding-bottom: 10px;">
        <div class="preview-img-wrap">
          <img id="previewImage" src="https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?w=600&q=80" alt="Glaces">
        </div>
        <div class="preview-name font-serif" id="previewTitle">Glaces</div>
      </div>

      <button type="button" class="btn-modify"><i class="fa-solid fa-pen"></i> Modifier</button>
      <button type="button" class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
    </div>

  </div>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  // Feedback visuel et déclenchement du téléchargement de fichier
  const fileInput = document.getElementById('fileInput');
  const uploadZone = document.getElementById('uploadZone');

  if (uploadZone && fileInput) {
    uploadZone.addEventListener('click', () => {
      fileInput.click();
    });

    fileInput.addEventListener('change', () => {
      if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        const mainTxt = uploadZone.querySelector('.main-txt');
        if (mainTxt) {
          mainTxt.innerHTML = '<b>' + fileName + '</b> sélectionné';
        }

        // Aperçu dynamique de l'image si applicable
        const reader = new FileReader();
        reader.onload = function (e) {
          const previewImg = document.getElementById('previewImage');
          if (previewImg) {
            previewImg.src = e.target.result;
          }
        };
        reader.readAsDataURL(fileInput.files[0]);
      }
    });
  }

  // Mise à jour dynamique du titre dans l'aperçu
  const catNameInput = document.getElementById('catName');
  const previewTitle = document.getElementById('previewTitle');

  if (catNameInput && previewTitle) {
    catNameInput.addEventListener('input', function () {
      previewTitle.textContent = this.value.trim() !== '' ? this.value : 'Glaces';
    });
  }

});
</script>
@endpush