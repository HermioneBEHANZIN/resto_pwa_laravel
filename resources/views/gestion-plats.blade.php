@extends('layouts.app')

@section('title', 'Le Gourmet — Gestion des menus — Plats')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --bordeaux: #7B1C2A;
  --bordeaux-dark: #5c1420;
  --rouge: #E8112D;
  --or: #FFBF0D;
  --orange: #FF9500;
  --orange-pale: #FFF1DC;
  --bg-app: #F2F1FA;
  --text: #1A1A1A;
  --muted: #8A8A8A;
  --border-grey: #E7E4F2;
  --rose-pale: #FBEAEA;
  --green: #31AA1C;
  --blue: #1877F2;
  --radius-lg: 22px;
  --radius-md: 16px;
  --radius-sm: 12px;
  --shadow: 0 4px 18px rgba(123,28,42,0.06);
  --orange-50: #FF9500;
}

.font-serif{ font-family:'Playfair Display', serif; }

/* KPI card */
.kpi-card{
  background:#fff; border:1.5px solid var(--orange); border-radius:var(--radius-md);
  padding:20px 26px; display:flex; align-items:center; justify-content:space-between;
  gap:18px; box-shadow:var(--shadow); margin-bottom:34px; flex-wrap:wrap;
}
.kpi-left{ display:flex; align-items:center; gap:16px; }
.kpi-icon{
  width:54px; height:54px; border-radius:14px; background:var(--orange-pale);
  color:var(--orange); display:flex; align-items:center; justify-content:center;
  font-size:21px; flex-shrink:0;
}
.kpi-label{ font-size:13px; color:var(--muted); margin-bottom:5px; }
.kpi-amount{ font-family:'Playfair Display',serif; font-weight:700; font-size:30px; color:var(--orange); line-height:1; }
.kpi-amount .fcfa{ font-size:14px; letter-spacing:1px; margin-left:4px; }
.kpi-growth{ color:var(--orange-50); font-weight:600; font-size:13.5px; margin-top:5px; }
.kpi-date{
  display:flex; align-items:center; gap:14px; background:#fff; border:1px solid var(--border-grey);
  border-radius:var(--radius-sm); padding:11px 20px; font-weight:500; color:#333;
}
.kpi-date i{ color:var(--blue); }

/* Section title */
.section-title{ font-weight:700; font-size:32px; margin:0 0 24px; }

/* Tabs */
.menu-tabs{ display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:26px; }
.menu-tabs a, .menu-tabs button{
  font-family:'Playfair Display',serif; font-weight:600; font-size:18px;
  background:#fff; border:none; border-radius:var(--radius-md); padding:16px 8px;
  color:var(--text); box-shadow:var(--shadow); cursor:pointer; transition:.2s;
  text-decoration:none; text-align:center; display:block;
}
.menu-tabs a.active, .menu-tabs button.active{ background:var(--bordeaux); color:#fff; }
.menu-tabs a:not(.active):hover, .menu-tabs button:not(.active):hover{ background:#f7f6fd; }

/* content 2 columns */
.content-row{ display:grid; grid-template-columns: 1.4fr 1fr; gap:24px; align-items:start; margin-bottom:24px; }

.card-white{
  background:#fff; border-radius:var(--radius-md); padding:30px;
  box-shadow:var(--shadow); margin-bottom:24px;
}
.card-title{ font-weight:700; color:var(--bordeaux); font-size:21px; margin-bottom:22px; }
.card-title.centered{ text-align:center; }

/* upload */
.upload-zone{
  border:2px dashed var(--border-grey); border-radius:14px; padding:46px 20px;
  text-align:center; background:#FAFAFD; cursor:pointer; transition:.2s;
  display:flex; flex-direction:column; align-items:center; justify-content:center;
}
.upload-zone:hover{ border-color:var(--bordeaux); background:#fdf6f7; }
.upload-zone i{ font-size:28px; color:var(--blue); margin-bottom:12px; }
.upload-zone .main-txt{ font-size:14px; color:#333; }
.upload-zone .main-txt b{ font-weight:600; }
.upload-zone .sub-txt{ font-size:12px; color:var(--muted); margin-top:6px; }

/* form fields */
.form-group{ margin-bottom:20px; }
.form-group label{ display:block; font-size:13.5px; color:#555; margin-bottom:7px; font-weight:500; }
.form-control-custom{
  width:100%; border:1px solid var(--border-grey); background:#fff; border-radius:12px;
  padding:13px 16px; font-family:'Poppins',sans-serif; font-size:14px; color:#333;
  outline:none; box-shadow:0 2px 6px rgba(0,0,0,.02);
}
.form-control-custom:focus{ border-color:var(--bordeaux); }
.select-wrap{ position:relative; }
.select-wrap select{ appearance:none; }
.select-wrap i{ position:absolute; right:18px; top:50%; transform:translateY(-50%); color:#999; font-size:13px; pointer-events:none; }

.input-suffix-wrap{ position:relative; }
.input-suffix-wrap input{ padding-right:60px; }
.input-suffix{
  position:absolute; right:16px; top:50%; transform:translateY(-50%);
  font-size:13px; color:var(--muted); font-weight:600;
}

.stepper-wrap{
  display:flex; align-items:center; gap:12px;
  border:1px solid var(--border-grey); border-radius:12px; padding:8px 16px; background:#fff;
}
.stepper-wrap i.fa-stopwatch{ color:var(--orange); }
.stepper-wrap input{ border:none; outline:none; width:60px; font-family:'Poppins'; font-size:14px; text-align:center; }
.stepper-wrap .unit{ font-size:13px; color:var(--muted); font-weight:600; }
.stepper-arrows{ display:flex; flex-direction:column; margin-left:auto; gap:2px; cursor:pointer; }
.stepper-arrows i{ font-size:10px; color:#999; line-height:1; }

/* Plats preview cards */
.plat-preview-card{
  display:flex; align-items:center; gap:16px; background:#fff; border:1px solid var(--border-grey);
  border-radius:20px; padding:18px 18px 36px; margin-bottom:38px; position:relative;
  box-shadow:var(--shadow);
}
.plat-preview-img{ width:30%; aspect-ratio:1/1; height:auto; border-radius:50%; object-fit:cover; flex-shrink:0; }
.plat-preview-body{ flex:1; min-width:0; }
.plat-preview-name{ font-weight:600; font-size:16px; margin-bottom:4px; }
.plat-preview-stars{ font-size:13px; color:var(--or); white-space:nowrap; }
.plat-preview-stars .note{ color:var(--muted); font-size:12px; margin-left:4px; }
.plat-preview-price{
  position:absolute; left:50%; bottom:-24px; transform:translateX(-50%);
  width:140px; height:52px; background:var(--bordeaux); color:#fff;
  border-radius:30px; display:flex; align-items:center; justify-content:center;
  font-weight:700; font-size:20px; white-space:nowrap;
  box-shadow:0 8px 16px rgba(123,28,42,0.28); flex-shrink:0;
}

.preview-actions{ display:flex; flex-direction:column; gap:12px; margin-top:8px; }
.btn-modify{
  width:100%; border:1.5px solid var(--border-grey); background:#fff; color:var(--text);
  padding:13px; border-radius:30px; font-weight:500; display:flex; align-items:center;
  justify-content:center; gap:10px; cursor:pointer;
}
.btn-modify:hover{ background:#f6f5fb; }
.btn-delete{
  width:100%; border:none; background:var(--rouge); color:#fff; padding:13px; border-radius:30px;
  font-weight:500; display:flex; align-items:center; justify-content:center; gap:10px; cursor:pointer;
}
.btn-delete:hover{ background:#c50e26; }
.btn-link-details{
  background:none; border:none; color:var(--bordeaux); font-weight:600; font-size:14px;
  display:flex; align-items:center; justify-content:center; gap:8px; padding:8px; cursor:pointer;
}

/* description editor */
.editor-toolbar{
  background:#FAF7F2; border:1px solid var(--border-grey); border-bottom:none;
  border-radius:12px 12px 0 0; padding:10px 16px; display:flex; align-items:center;
  gap:14px; flex-wrap:wrap;
}
.editor-toolbar i, .editor-toolbar span{ color:#555; font-size:14px; cursor:pointer; }
.editor-toolbar .sep{ width:1px; height:18px; background:var(--border-grey); }
.editor-body{
  border:1px solid var(--border-grey); border-radius:0 0 12px 12px; min-height:170px;
  padding:16px; font-size:14px; color:#333; outline:none; background:#fff;
}
.editor-body:empty:before{ content: attr(data-placeholder); color:#bbb; }

/* ingredients */
.ingr-search{
  background:#fff; border:1px solid var(--border-grey); border-radius:50px; padding:12px 20px;
  display:flex; align-items:center; gap:12px; margin-bottom:20px;
}
.ingr-search i{ color:#b8b8b8; }
.ingr-search input{ border:none; outline:none; flex:1; font-family:'Poppins'; font-size:14px; }
.ingr-list{ display:flex; flex-wrap:wrap; gap:12px; margin-bottom:18px; }
.ingr-chip{
  background:var(--rose-pale); border-radius:30px; padding:9px 16px 9px 18px;
  display:flex; align-items:center; gap:10px; font-size:14px; font-weight:500;
}
.ingr-chip .x-remove{ cursor:pointer; color:#a0555f; font-size:12px; }
.add-ingr-link{ background:none; border:none; color:var(--blue); font-weight:600; font-size:14px; display:flex; align-items:center; gap:8px; cursor:pointer; }

/* final action bar */
.final-actions{ display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; }
.btn-cancel{
  border:1.5px solid var(--border-grey); background:#fff; color:var(--text);
  padding:14px 32px; border-radius:30px; font-weight:500; font-size:14.5px; cursor:pointer;
}
.btn-cancel:hover{ background:#f6f5fb; }
.btn-save{
  border:none; background:var(--bordeaux); color:#fff; padding:16px 44px; border-radius:30px;
  font-weight:600; font-size:14.5px; cursor:pointer;
}
.btn-save:hover{ background:var(--bordeaux-dark); }

/* RESPONSIVE */
@media (max-width: 1200px){
  .content-row{ grid-template-columns: 1fr; }
}

@media (max-width: 767.98px){
  .kpi-card{ flex-direction:column; align-items:flex-start; padding:18px 20px; gap:14px; margin-bottom:20px; }
  .kpi-date{ width:100%; justify-content:space-between; }
  .section-title{ font-size:24px; margin-bottom:16px; }
  .card-title{ font-size:1.125rem; margin-bottom:18px; }

  .menu-tabs{
    display:flex; overflow-x:auto; gap:10px; padding-bottom:6px; margin-bottom:20px;
    -webkit-overflow-scrolling:touch; scrollbar-width:none;
  }
  .menu-tabs::-webkit-scrollbar{ display:none; }
  .menu-tabs a, .menu-tabs button{ flex:0 0 auto; padding:13px 20px; font-size:15px; white-space:nowrap; }

  .content-row{ gap:16px; margin-bottom:20px; }
  .card-white{ padding:18px; margin-bottom:20px; }
  .upload-zone{ padding:32px 16px; }
  .plat-preview-card{ padding:16px 16px 32px; }
  .plat-preview-price{ width:120px; height:48px; font-size:18px; bottom:-22px; }
  .btn-modify, .btn-delete{ min-height:48px; }

  .final-actions{ flex-direction:column-reverse; gap:12px; }
  .final-actions .btn-cancel, .final-actions .btn-save{ width:100%; text-align:center; min-height:48px; }

  .editor-toolbar{ gap:10px; }
}
</style>
@endpush

@section('content')
<!-- KPI CHIFFRE D'AFFAIRES -->
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

<h1 class="section-title font-serif">Gestion des menus</h1>

<!-- TABS ONGLETS NAVIGATION -->
<div class="menu-tabs" id="menuTabs">
  <a href="{{ url('/menus/apercus') }}">Aperçus</a>
  <a href="{{ url('/menus/categories') }}">Catégories</a>
  <a href="{{ url('/menus/sous-categories') }}">Sous-catégories</a>
  <a href="{{ url('/menus/plats') }}" class="active">Plats</a>
</div>

<!-- GRILLE A 2 COLONNES -->
<div class="content-row">

  <!-- COLONNE GAUCHE -->
  <div>
    <div class="card-white upload-card">
      <div class="upload-zone" id="uploadZone">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <div class="main-txt"><b>Cliquez pour télécharger</b> ou glisser déposer</div>
        <div class="sub-txt">PNG, JPG ou WEBP</div>
        <input type="file" id="fileInput" accept=".png,.jpg,.jpeg,.webp" style="display:none">
      </div>
    </div>

    <div class="card-white">
      <div class="card-title font-serif">Informations générales</div>

      <div class="form-group">
        <label for="platName">Nom du plat</label>
        <input type="text" id="platName" class="form-control-custom" placeholder="Ex : Pizza, Poisson de mer">
      </div>

      <div class="form-group">
        <label for="platCat">Catégorie</label>
        <div class="select-wrap">
          <select id="platCat" class="form-control-custom">
            <option>Street Food</option>
            <option>Grillades</option>
            <option>Africain</option>
            <option>Desserts</option>
          </select>
          <i class="fa-solid fa-chevron-right"></i>
        </div>
      </div>

      <div class="form-group">
        <label for="platSubcat">Sous-catégorie</label>
        <div class="select-wrap">
          <select id="platSubcat" class="form-control-custom">
            <option>Pizza</option>
            <option>Burgers</option>
            <option>Sandwichs</option>
          </select>
          <i class="fa-solid fa-chevron-right"></i>
        </div>
      </div>

      <div class="form-group">
        <label for="platPrice">Prix (Fcfa)</label>
        <div class="input-suffix-wrap">
          <input type="number" id="platPrice" class="form-control-custom" placeholder="0.00">
          <span class="input-suffix">F cfa</span>
        </div>
      </div>

      <div class="form-group">
        <label>Temps de cuisson</label>
        <div class="stepper-wrap">
          <i class="fa-solid fa-stopwatch"></i>
          <input type="number" id="cookTime" value="20">
          <span class="unit">min</span>
          <div class="stepper-arrows">
            <i class="fa-solid fa-chevron-up" id="stepUpBtn"></i>
            <i class="fa-solid fa-chevron-down" id="stepDownBtn"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- COLONNE DROITE : APERÇU DE PLATS -->
  <div class="card-white">
    <div class="card-title font-serif centered">Aperçu des plats</div>

    <div class="plat-preview-card">
      <img class="plat-preview-img" src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80" alt="Burger viande">
      <div class="plat-preview-body">
        <div class="plat-preview-name">Burger viande</div>
        <div class="plat-preview-stars">★★★★<span style="color:#ddd;">★</span><span class="note">3.5</span></div>
      </div>
      <div class="plat-preview-price">3000 Fcfa</div>
    </div>

    <div class="plat-preview-card">
      <img class="plat-preview-img" src="https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=200&q=80" alt="Double cheese burger">
      <div class="plat-preview-body">
        <div class="plat-preview-name">Double cheese burger</div>
        <div class="plat-preview-stars">★★★★★<span class="note">4.9</span></div>
      </div>
      <div class="plat-preview-price">6000 Fcfa</div>
    </div>

    <div class="preview-actions" style="margin-top: 195px;">
      <button class="btn-modify" style="border-radius: 30px;"><i class="fa-solid fa-pen"></i> Modifier</button>
      <button class="btn-delete" style="border-radius: 30px;"><i class="fa-solid fa-trash"></i> Supprimer</button>
      <button class="btn-link-details"><i class="fa-solid fa-eye"></i> Voir les détails</button>
    </div>
  </div>

</div>

<!-- EDITUER DE DESCRIPTION -->
<div class="card-white">
  <div class="card-title font-serif">Description du plat</div>
  <div class="editor-toolbar">
    <i class="fa-solid fa-bold" title="Gras"></i>
    <i class="fa-solid fa-underline" title="Souligné"></i>
    <i class="fa-solid fa-italic" title="Italique"></i>
    <span title="Taille du texte" style="font-weight:700;">A<i class="fa-solid fa-caret-down" style="font-size:10px;"></i></span>
    <div class="sep"></div>
    <i class="fa-solid fa-align-left" title="Aligner à gauche"></i>
    <i class="fa-solid fa-align-center" title="Centrer"></i>
    <i class="fa-solid fa-align-right" title="Aligner à droite"></i>
    <div class="sep"></div>
    <i class="fa-solid fa-list-ul" title="Liste à puces"></i>
    <i class="fa-solid fa-list-ol" title="Liste numérotée"></i>
    <i class="fa-solid fa-indent" title="Indentation"></i>
    <div class="sep"></div>
    <i class="fa-solid fa-rotate-left" title="Annuler"></i>
    <i class="fa-solid fa-rotate-right" title="Rétablir"></i>
  </div>
  <div class="editor-body" contenteditable="true" data-placeholder="Lorem ipsum...."></div>
</div>

<!-- INGRÉDIENTS -->
<div class="card-white">
  <div class="card-title font-serif">Ingrédients</div>
  <div class="ingr-search">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Canard, ail, miel...">
  </div>
  <div class="ingr-list" id="ingrList">
    <span class="ingr-chip">Fromage <i class="fa-solid fa-xmark x-remove"></i></span>
    <span class="ingr-chip">Carotte <i class="fa-solid fa-xmark x-remove"></i></span>
    <span class="ingr-chip">Viande de boeuf <i class="fa-solid fa-xmark x-remove"></i></span>
    <span class="ingr-chip">Tomates <i class="fa-solid fa-xmark x-remove"></i></span>
  </div>
  <button class="add-ingr-link" id="addIngrBtn"><i class="fa-solid fa-plus"></i> Ajouter un ingrédient</button>
</div>

<!-- ACTIONS FINALES -->
<div class="card-white final-actions" style="box-shadow:none; background:transparent; padding:0;">
  <button class="btn-cancel">Annuler</button>
  <button class="btn-save">Enregistrer les informations</button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

  // Gestion du File Input
  const fileInput = document.getElementById('fileInput');
  const uploadZone = id('uploadZone');

  if (uploadZone && fileInput) {
    uploadZone.addEventListener('click', function() {
      fileInput.click();
    });

    fileInput.addEventListener('change', function() {
      if (fileInput.files.length) {
        const txtEl = uploadZone.querySelector('.main-txt');
        if (txtEl) {
          txtEl.innerHTML = '<b>' + fileInput.files[0].name + '</b> sélectionné';
        }
      }
    });
  }

  // Stepper temps de cuisson
  window.stepTime = function(delta) {
    const input = document.getElementById('cookTime');
    if (!input) return;
    let val = parseInt(input.value || 0) + delta;
    if (val < 0) val = 0;
    input.value = val;
  };

  const stepUpBtn = document.getElementById('stepUpBtn');
  const stepDownBtn = document.getElementById('stepDownBtn');

  if (stepUpBtn) stepUpBtn.addEventListener('click', () => stepTime(1));
  if (stepDownBtn) stepDownBtn.addEventListener('click', () => stepTime(-1));

  // Ingrédients
  const ingrList = document.getElementById('ingrList');
  if (ingrList) {
    ingrList.addEventListener('click', function(e) {
      if (e.target && e.target.classList.contains('x-remove')) {
        e.target.parentElement.remove();
      }
    });
  }

  const addIngrBtn = document.getElementById('addIngrBtn');
  if (addIngrBtn) {
    addIngrBtn.addEventListener('click', function() {
      const name = prompt("Nom de l'ingrédient :");
      if (!name || !ingrList) return;
      const chip = document.createElement('span');
      chip.className = 'ingr-chip';
      chip.innerHTML = name + ' <i class="fa-solid fa-xmark x-remove"></i>';
      ingrList.appendChild(chip);
    });
  }

  function id(elementId) {
    return document.getElementById(elementId);
  }
});
</script>
@endpush