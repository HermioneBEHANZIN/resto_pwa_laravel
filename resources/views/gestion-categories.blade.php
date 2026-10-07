@extends('layouts.app')

@section('title', 'Gestion des menus — Catégories — Le Gourmet')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
:root{
  --bordeaux: #7B1C2A;
  --bordeaux-dark: #601520;
  --rouge: #E8112D;
  --jaune: #FFBF0D;
  --orange: #FF9500;
  --orange-20: rgba(255,149,0,.20);
  --orange-pale: #FFF1DC;
  --vert: #31AA1C;
  --bleu: #1877F2;
  --violet: #8C4AF2;
  --orange-50: #FF9500;
  --bg-app: #F2F1FA;
  --text: #1A1A1A;
  --muted: #8A8A8A;
  --border-grey: #E7E4F2;

  --radius-lg: 22px;
  --radius-md: 16px;
  --radius-sm: 12px;
  --shadow-soft: 0 4px 18px rgba(123,28,42,0.06);
}

.font-serif{ font-family:'Playfair Display', serif; }

/* KPI card */
.kpi-card{
  background:#fff; border:1.5px solid var(--orange); border-radius:var(--radius-md); padding:20px 26px;
  display:flex; align-items:center; justify-content:space-between; gap:18px;
  box-shadow:var(--shadow-soft); margin-bottom:34px; flex-wrap:wrap;
}
.kpi-left{ display:flex; align-items:center; gap:16px; }
.kpi-icon{
  width:54px; height:54px; border-radius:14px; background:var(--orange-pale); color:var(--orange);
  display:flex; align-items:center; justify-content:center; font-size:21px; flex-shrink:0;
}
.kpi-label{ font-size:13px; color:var(--muted); margin-bottom:5px; }
.kpi-amount{ font-family:'Playfair Display',serif; font-weight:700; font-size:30px; color:var(--orange); line-height:1; }
.kpi-amount .fcfa{ font-size:14px; letter-spacing:1px; margin-left:4px; }
.kpi-growth{ color:var(--orange-50); font-weight:600; font-size:13.5px; margin-top:5px; }
.kpi-date{
  display:flex; align-items:center; gap:14px; background:#fff; border:1px solid var(--border-grey);
  border-radius:var(--radius-sm); padding:11px 20px; font-weight:500; color:#333;
}
.kpi-date i{ color:var(--bleu); }

/* Section title */
.section-title{ font-weight:700; font-size:32px; margin:0 0 24px; }

/* Tabs */
.menu-tabs{ display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:26px; }
.menu-tabs button, .menu-tabs a{
  font-family:'Playfair Display',serif; font-weight:600; font-size:18px; background:#fff; border:none;
  border-radius:var(--radius-md); padding:16px 8px; color:var(--text); box-shadow:var(--shadow-soft); 
  cursor:pointer; transition:.2s; text-decoration:none; text-align:center; display:block;
}
.menu-tabs button.active, .menu-tabs a.active{ background:var(--bordeaux); color:#fff; }
.menu-tabs button:not(.active):hover, .menu-tabs a:not(.active):hover{ background:#f7f6fd; }

/* ============ ZONE PRINCIPALE : 2 cartes ============ */
.content-row{ display:grid; grid-template-columns: 3fr 2fr; gap:24px; align-items:stretch; }

.card-white{
  background:#fff; border-radius:var(--radius-md); padding:34px; box-shadow:var(--shadow-soft);
  display:flex; flex-direction:column;
}
.card-title{ font-weight:700; color:var(--bordeaux); font-size:23px; margin-bottom:26px; }
.card-title.centered{ text-align:center; }

/* form */
.form-group{ margin-bottom:22px; }
.form-group label{ display:block; font-size:14px; color:#555; margin-bottom:8px; font-weight:500; }
.form-control-custom{
  width:100%; border:1px solid var(--border-grey); background:#fff; border-radius:12px; padding:13px 16px;
  font-family:'Poppins',sans-serif; font-size:14px; color:#333; outline:none; box-shadow:0 2px 6px rgba(0,0,0,.02);
}
.form-control-custom:focus{ border-color:var(--bordeaux); }
.form-control-custom:focus-visible, .btn-focusable:focus-visible{
  outline: 2px solid var(--bordeaux); outline-offset: 2px;
}

/* upload */
.upload-zone{
  border:2px dashed var(--border-grey); border-radius:14px; padding:48px 20px; text-align:center;
  background:#FAFAFD; cursor:pointer; transition:.2s; flex:1; min-height:220px;
  display:flex; flex-direction:column; align-items:center; justify-content:center; position:relative;
  overflow:hidden; margin-bottom:28px;
}
.upload-zone:hover, .upload-zone.dragover{ border-color:var(--bordeaux); background:#fdf6f7; }
.upload-zone i{ font-size:30px; color:var(--bleu); margin-bottom:14px; }
.upload-zone .main-txt{ font-size:14.5px; color:#333; }
.upload-zone .main-txt b{ font-weight:600; }
.upload-zone .sub-txt{ font-size:12px; color:var(--muted); margin-top:6px; }
.upload-zone img.preview-thumb{
  position:absolute; inset:0; width:100%; height:100%; object-fit:cover; border-radius:12px; display:none;
}
.upload-zone.has-image .upload-placeholder{ display:none; }
.upload-zone.has-image img.preview-thumb{ display:block; }

/* buttons row */
.form-actions{ display:flex; justify-content:space-between; gap:14px; margin-top:auto; }
.btn-cancel{
  border:1.5px solid var(--border-grey); background:#fff; color:#333; padding:14px 32px;
  border-radius:30px; font-weight:500; font-size:14.5px; cursor:pointer;
}
.btn-cancel:hover{ background:#f6f5fb; }
.btn-add{
  border:none; background:var(--bordeaux); color:#fff; padding:14px 38px; border-radius:30px;
  font-weight:600; font-size:14.5px; display:inline-flex; align-items:center; gap:10px; cursor:pointer;
}
.btn-add:hover{ background:var(--bordeaux-dark); }

/* preview card (right) */
.preview-wrap{ flex:1; display:flex; flex-direction:column; align-items:center; }
.preview-card{
  width:100%; max-width:280px; background:#fff; border:1px solid var(--border-grey); border-radius:var(--radius-md);
  overflow:hidden; margin-bottom:26px;
}
.preview-img-wrap{ width:100%; height:190px; background:#f4f3fa; overflow:hidden; }
.preview-img-wrap img{ width:100%; height:100%; object-fit:cover; display:block; border-radius: 20px 20px 0 0; }
.preview-name{
  font-family:'Playfair Display',serif; font-weight:700; font-size:22px; text-align:center;
  padding:22px 14px; line-height:1.2; word-break:break-word;
}

.preview-actions{ width:100%; max-width:280px; display:flex; flex-direction:column; gap:14px; margin-top:auto; }
.btn-modify{
  width:100%; border:1.5px solid var(--border-grey); background:#fff; color:var(--text); padding:13px;
  border-radius:30px; font-weight:500; display:flex; align-items:center; justify-content:center; gap:10px; cursor:pointer;
}
.btn-modify:hover{ background:#f6f5fb; }
.btn-delete{
  width:100%; border:none; background:var(--rouge); color:#fff; padding:13px; border-radius:30px;
  font-weight:500; display:flex; align-items:center; justify-content:center; gap:10px; cursor:pointer;
}
.btn-delete:hover{ background:#c50e26; }

/* toast */
#toast{
  position:fixed; bottom:30px; left:50%; transform:translateX(-50%);
  background:#2C2018; color:#fff; padding:13px 26px; border-radius:40px; font-size:.86rem; font-weight:600;
  z-index:9999; box-shadow:0 8px 24px rgba(0,0,0,.25); transition:opacity .3s; opacity:0; pointer-events:none;
  white-space:nowrap;
}

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
  .menu-tabs button, .menu-tabs a{ flex:0 0 auto; padding:13px 20px; font-size:15px; white-space:nowrap; }

  .content-row{ gap:16px; }
  .card-white{ padding:18px; }
  .upload-zone{ padding:32px 16px; min-height:160px; margin-bottom:20px; }
  .form-actions{ flex-direction:column-reverse; gap:12px; }
  .form-actions .btn-cancel, .form-actions .btn-add{ width:100%; justify-content:center; text-align:center; min-height:48px; }
  .preview-card, .preview-actions{ max-width:100%; }
  .btn-modify, .btn-delete{ min-height:48px; }
}
</style>
@endpush

@section('content')
<!-- KPI -->
<div class="kpi-card">
  <div class="kpi-left">
    <div class="kpi-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
    <div>
      <div class="kpi-label" style="font-size:1rem;color:var(--text);">Chiffres d'affaires journaliers</div>
      <div class="kpi-amount" id="kpiAmount">1 250 000 <span class="fcfa">FCFA</span></div>
      <div class="kpi-growth" id="kpiGrowth">+ 10%</div>
    </div>
  </div>
  <div class="kpi-date">
    <span id="kpiDate">03 juillet 2026</span>
    <i class="fa-regular fa-calendar"></i>
  </div>
</div>

<h1 class="section-title font-serif">Gestion des menus</h1>

<!-- Tabs -->
<div class="menu-tabs" id="menuTabs" role="tablist">
  <a href="{{ url('/menus/apercus') }}">Aperçus</a>
  <a href="{{ url('/menus/categories') }}" class="active">Catégories</a>
  <a href="{{ url('/menus/sous-categories') }}">Sous-catégories</a>
  <a href="{{ url('/menus/plats') }}">Plats</a>
</div>

<!-- 2 cartes -->
<div class="content-row">

  <!-- CARTE GAUCHE : formulaire -->
  <form class="card-white" id="categoryForm" novalidate>
    <div class="card-title font-serif">Informations de la catégorie</div>

    <div class="form-group">
      <label for="catName">Nom de la catégorie</label>
      <input type="text" id="catName" name="nom" class="form-control-custom"
             placeholder="Ex : Burgers, Boissons..." autocomplete="off">
    </div>

    <div class="upload-zone" id="uploadZone" tabindex="0" role="button"
         aria-label="Zone de dépôt d'image pour la catégorie">
      <div class="upload-placeholder">
        <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i>
        <div class="main-txt"><b>Cliquez pour télécharger</b> ou glisser déposer</div>
        <div class="sub-txt">PNG, JPG ou WEBP</div>
      </div>
      <img class="preview-thumb" id="uploadPreviewImg" alt="Aperçu de l'image de la catégorie">
      <input type="file" id="fileInput" accept=".png,.jpg,.jpeg,.webp" style="display:none">
    </div>

    <div class="form-actions">
      <button type="button" class="btn-cancel" id="btnCancel">Annuler</button>
      <button type="submit" class="btn-add" id="btnAdd"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </div>
  </form>

  <!-- CARTE DROITE : aperçu -->
  <div class="card-white">
    <div class="card-title font-serif centered">Aperçu de la catégorie</div>

    <div class="preview-wrap">
      <div class="preview-card">
        <div class="preview-img-wrap">
          <img id="previewImage" src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&q=80" alt="Aperçu de la catégorie sélectionnée">
        </div>
        <div class="preview-name font-serif" id="previewName">Glaces</div>
      </div>

      <div class="preview-actions">
        <button type="button" class="btn-modify" id="btnModify"><i class="fa-solid fa-pen"></i> Modifier</button>
        <button type="button" class="btn-delete" id="btnDelete"><i class="fa-solid fa-trash"></i> Supprimer</button>
      </div>
    </div>
  </div>

</div>

<div id="toast" role="status" aria-live="polite"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Crect width='200' height='200' fill='%23F4EDE4'/%3E%3Ctext x='50%25' y='54%25' font-size='60' text-anchor='middle' dominant-baseline='middle'%3E%F0%9F%8D%BD%EF%B8%8F%3C/text%3E%3C/svg%3E";

  let currentCategory = {
    id: 'glaces',
    nom: 'Glaces',
    image: 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&q=80'
  };

  let selectedFile = null;

  const form             = document.getElementById('categoryForm');
  const inputName        = document.getElementById('catName');
  const uploadZone       = document.getElementById('uploadZone');
  const fileInput        = document.getElementById('fileInput');
  const uploadPreviewImg = document.getElementById('uploadPreviewImg');
  const previewImage     = document.getElementById('previewImage');
  const previewName      = document.getElementById('previewName');
  const btnCancel        = document.getElementById('btnCancel');
  const btnModify        = document.getElementById('btnModify');
  const btnDelete        = document.getElementById('btnDelete');
  const toast            = document.getElementById('toast');

  function renderPreview(cat){
    if (previewName) previewName.textContent = cat.nom || 'Nom de la catégorie';
    if (previewImage) {
      previewImage.src = cat.image || FALLBACK_IMG;
      previewImage.onerror = function(){ this.onerror=null; this.src = FALLBACK_IMG; };
    }
  }
  renderPreview(currentCategory);

  if (inputName) {
    inputName.addEventListener('input', ()=>{
      if (previewName) previewName.textContent = inputName.value.trim() || 'Nom de la catégorie';
    });
  }

  if (uploadZone && fileInput) {
    uploadZone.addEventListener('click', ()=> fileInput.click());
    uploadZone.addEventListener('keydown', (e)=>{
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); fileInput.click(); }
    });

    fileInput.addEventListener('change', ()=>{
      if(fileInput.files && fileInput.files[0]) handleFile(fileInput.files[0]);
    });

    ['dragenter','dragover'].forEach(evt=>{
      uploadZone.addEventListener(evt, (e)=>{ e.preventDefault(); uploadZone.classList.add('dragover'); });
    });
    ['dragleave','drop'].forEach(evt=>{
      uploadZone.addEventListener(evt, (e)=>{ e.preventDefault(); uploadZone.classList.remove('dragover'); });
    });
    uploadZone.addEventListener('drop', (e)=>{
      const file = e.dataTransfer.files && e.dataTransfer.files[0];
      if(file) handleFile(file);
    });
  }

  function handleFile(file){
    if(!/^image\/(png|jpe?g|webp)$/.test(file.type)){
      showToast("Format non supporté. Utilisez PNG, JPG ou WEBP.");
      return;
    }
    selectedFile = file;
    const reader = new FileReader();
    reader.onload = (e)=>{
      if (uploadPreviewImg) uploadPreviewImg.src = e.target.result;
      if (uploadZone) uploadZone.classList.add('has-image');
      if (previewImage) previewImage.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  if (form) {
    form.addEventListener('submit', (e)=>{
      e.preventDefault();

      const nom = inputName.value.trim();
      if(!nom){
        showToast("Veuillez indiquer le nom de la catégorie.");
        inputName.focus();
        return;
      }

      const payload = {
        nom,
        image: uploadPreviewImg ? uploadPreviewImg.src : currentCategory.image,
        file: selectedFile
      };

      currentCategory = { ...currentCategory, nom: payload.nom, image: payload.image };
      renderPreview(currentCategory);
      showToast(`Catégorie "${nom}" enregistrée avec succès.`);
    });
  }

  if (btnCancel) {
    btnCancel.addEventListener('click', ()=>{
      if (form) form.reset();
      selectedFile = null;
      if (uploadZone) uploadZone.classList.remove('has-image');
      if (uploadPreviewImg) uploadPreviewImg.src = '';
      showToast("Formulaire réinitialisé.");
    });
  }

  if (btnModify) {
    btnModify.addEventListener('click', ()=>{
      if (inputName) inputName.value = currentCategory.nom;
      if (uploadPreviewImg) uploadPreviewImg.src = currentCategory.image;
      if (uploadZone) uploadZone.classList.add('has-image');
      if (inputName) inputName.focus();
      showToast("Mode modification activé pour cette catégorie.");
    });
  }

  if (btnDelete) {
    btnDelete.addEventListener('click', ()=>{
      const confirmDelete = confirm(`Supprimer la catégorie "${currentCategory.nom}" ?`);
      if(!confirmDelete) return;
      showToast(`Catégorie "${currentCategory.nom}" supprimée.`);
      currentCategory = { id:null, nom:'', image:'' };
      renderPreview(currentCategory);
    });
  }

  function showToast(msg){
    if (!toast) return;
    toast.textContent = msg;
    toast.style.opacity = 1;
    clearTimeout(toast._timer);
    toast._timer = setTimeout(()=>{ toast.style.opacity = 0; }, 2800);
  }
});
</script>
@endpush