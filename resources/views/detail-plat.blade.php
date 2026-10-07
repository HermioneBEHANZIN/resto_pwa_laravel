@extends('layouts.app')

@section('title', 'Le Gourmet — Détail du plat')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
  :root {
    --gold: #C9952A;
    --cream: #FAF7F2;
    --border: #E8E0D5;
    --text: #1A1A1A;
    --muted: #888;
  }

  body { 
    background: #FAF7F2; 
    color: var(--text); 
    font-family: 'Inter', sans-serif; 
    padding-bottom: 70px; 
  }

  /* ───────── OVERLAY (centré, PC et mobile) ───────── */
  .dish-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 2000;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }
  .dish-overlay.open { display: flex; }

  /* ───────── FENETRE / DRAWER ───────── */
  .dish-drawer {
    background: var(--cream);
    width: 100%;
    max-width: 420px;
    max-height: 92vh;
    border-radius: 22px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    position: relative;
    animation: popIn .25s cubic-bezier(.22,.61,.36,1) forwards;
    box-shadow: 0 25px 60px rgba(0,0,0,.35);
  }
  @keyframes popIn {
    from { opacity: 0; transform: scale(.94) translateY(20px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
  }

  /* ───────── IMAGE + QUART DE CERCLE ───────── */
  .dish-img-wrap {
    position: relative;
    width: 100%;
    height: 230px;
    flex-shrink: 0;
  }
  .dish-img-wrap img {
    width: 100%; height: 100%; object-fit: cover; display: block;
  }
  .dish-img-wrap::after {
    content: '';
    position: absolute;
    bottom: -1px; right: -1px;
    width: 90px; height: 90px;
    background: var(--cream);
    border-radius: 100% 0 0 0;
  }

  /* Bouton fermer */
  .btn-close-drawer {
    position: absolute;
    top: 14px; right: 14px;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.92);
    border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: var(--text);
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
    transition: .15s;
  }
  .btn-close-drawer:hover { background: #fff; transform: scale(1.06); }

  /* Bouton favori */
  .btn-fav-drawer {
    position: absolute;
    top: 14px; left: 14px;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.92);
    border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.05rem; color: var(--muted);
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
  }
  .btn-fav-drawer.active { color: #E24B4A; }

  /* ───────── CONTENU SCROLLABLE ───────── */
  .dish-body {
    flex: 1;
    overflow-y: auto;
    padding: 0 20px 110px;
  }
  .dish-body::-webkit-scrollbar { width: 0; }

  /* ───────── TITRE / PRIX ───────── */
  .dish-title-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin: 16px 0 8px;
  }
  .dish-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text);
    line-height: 1.25;
  }
  .dish-price {
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--gold);
    white-space: nowrap;
  }

  .dish-desc {
    color: #777;
    font-size: 0.85rem;
    line-height: 1.65;
    margin-bottom: 14px;
  }

  .stars { color: var(--gold); font-size: 0.9rem; }
  .rating-row {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
  }

  /* ───────── SECTION LABEL ───────── */
  .section-label {
    font-size: 0.78rem;
    font-weight: 700;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
  }

  /* ───────── BADGES ───────── */
  .chip-scroll {
    display: flex;
    gap: 14px;
    overflow-x: auto;
    padding-bottom: 4px;
    margin-bottom: 20px;
  }
  .chip-scroll::-webkit-scrollbar { height: 0; }

  .ing-chip, .allerg-chip {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    flex-shrink: 0;
  }
  .ing-chip .icon-circle {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: #F5F0E8;
    border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    color: var(--gold);
  }
  .allerg-chip .icon-circle {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: #FFF3F3;
    border: 1px solid #F5CCCC;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.05rem;
    color: #E07A30;
  }
  .ing-chip span, .allerg-chip span {
    font-size: 0.62rem;
    font-weight: 600;
    color: #555;
    text-align: center;
    max-width: 60px;
  }

  /* ───────── SUGGESTIONS ───────── */
  .suggest-scroll {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding-bottom: 4px;
    margin-bottom: 16px;
  }
  .suggest-scroll::-webkit-scrollbar { height: 0; }

  .suggest-card {
    flex-shrink: 0;
    width: 110px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    text-decoration: none;
    color: var(--text);
    cursor: pointer;
  }
  .suggest-card img {
    width: 100%; height: 70px; object-fit: cover;
  }
  .suggest-card .sc-body {
    padding: 7px 8px;
    text-align: center;
  }
  .suggest-card .sc-name {
    font-size: 0.71rem; font-weight: 700; color: var(--text); margin-bottom: 2px;
  }
  .suggest-card .sc-price {
    font-size: 0.67rem; color: var(--gold); font-weight: 700;
  }

  /* ───────── BARRE BAS FIXE ───────── */
  .dish-footer {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: var(--cream);
    border-top: 1px solid var(--border);
    padding: 14px 20px 18px;
  }
  .footer-row {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .qty-control {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #F5F0E8;
    border-radius: 30px;
    padding: 8px 18px;
    flex-shrink: 0;
  }
  .qty-btn {
    background: none; border: none;
    font-size: 1.05rem; font-weight: 700;
    cursor: pointer; color: var(--text); line-height: 1;
    padding: 0; width: 20px; height: 20px;
    display: flex; align-items: center; justify-content: center;
  }
  .qty-value { font-size: 0.95rem; font-weight: 700; min-width: 16px; text-align: center; }

  .btn-add-cart {
    flex: 1;
    background: #1A1A1A;
    color: #fff;
    border: none;
    border-radius: 14px;
    padding: 14px 16px;
    font-size: 0.88rem;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .btn-add-cart:hover { background: var(--gold); }
  .btn-add-cart:active { transform: scale(.98); }

  @media(min-width: 769px) {
    .dish-drawer { max-width: 460px; max-height: 88vh; }
  }

  /* ───────── BOTTOM NAV ───────── */
  .bottom-nav {
    position: fixed; bottom: 0; left: 0; right: 0;
    background: #fff; border-top: 1px solid var(--border);
    display: flex; z-index: 50;
    max-width: 480px; margin: 0 auto;
  }
  .bottom-nav-item {
    flex: 1; display: flex; flex-direction: column; align-items: center;
    gap: 3px; padding: 10px 0 8px; color: var(--muted);
    font-size: 0.62rem; text-decoration: none; font-weight: 600;
  }
  .bottom-nav-item i { font-size: 1.25rem; }
  .bottom-nav-item.active { color: var(--gold); }

  /* ───────── CARTES MENU ───────── */
  .host-card {
    background:#fff; border:1px solid var(--border); border-radius:16px;
    overflow:hidden; cursor:pointer; text-decoration:none; color:var(--text);
    transition:.2s;
  }
  .host-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.08); transform: translateY(-2px); }
  .host-card-img-wrap { position: relative; }
  .host-card-img-wrap img { width:100%; height:130px; object-fit:cover; display:block; }
  .host-card-img-wrap::after {
    content:''; position:absolute; bottom:-1px; right:-1px;
    width:46px; height:46px; background:#fff; border-radius:100% 0 0 0;
  }
  .host-card-body { padding:10px 14px 14px; }
  .host-card-name { font-weight:700; font-size:.92rem; margin-bottom:4px; }
  .host-card-price { color:var(--gold); font-weight:700; font-size:.88rem; }
</style>
@endpush

@section('content')
<!-- PAGE HÔTE — grille du menu -->
<div style="padding:40px 20px;max-width:480px;margin:0 auto;">
  <h2 style="font-family:'Playfair Display',serif;margin-bottom:20px;">
    <a href="{{ url('/menu') }}" style="color:var(--text);text-decoration:none;"><i class="bi bi-arrow-left"></i></a>
    Menu
  </h2>
  <div class="row g-3" id="hostGrid"></div>
</div>

<!-- FÉNETRE DE DÉTAIL (Modal centré) -->
<div class="dish-overlay" id="dishOverlay">
  <div class="dish-drawer" id="dishDrawer">

    <!-- Image -->
    <div class="dish-img-wrap">
      <img id="drawerImg" src="" alt="">
      <button class="btn-fav-drawer" id="btnFav" title="Favori"><i class="bi bi-heart"></i></button>
      <button class="btn-close-drawer" id="btnCloseDrawer" title="Fermer"><i class="bi bi-x-lg"></i></button>
    </div>

    <!-- Contenu scrollable -->
    <div class="dish-body" id="drawerBody">

      <div class="dish-title-row">
        <h1 class="dish-title" id="drawerName">—</h1>
        <div class="dish-price" id="drawerPrice">—</div>
      </div>

      <p class="dish-desc" id="drawerDesc">—</p>

      <div class="rating-row">
        <span class="stars">★★★★★</span>
        <span style="font-weight:700;font-size:.9rem;" id="drawerRating">—</span>
        <span style="color:var(--muted);font-size:.82rem;" id="drawerReviews">—</span>
      </div>

      <div class="section-label">Ingrédients</div>
      <div class="chip-scroll" id="drawerIngredients"></div>

      <div class="section-label">Allergènes</div>
      <div class="chip-scroll" id="drawerAllergens"></div>

      <div class="section-label">Vous aimerez aussi</div>
      <div class="suggest-scroll" id="drawerSuggestions"></div>

    </div>

    <!-- Barre bas fixe -->
    <div class="dish-footer">
      <div class="footer-row">
        <div class="qty-control">
          <button class="qty-btn" id="btnQtyMinus"><i class="bi bi-dash"></i></button>
          <span class="qty-value" id="qty">1</span>
          <button class="qty-btn" id="btnQtyPlus"><i class="bi bi-plus"></i></button>
        </div>
        <button class="btn-add-cart" id="btnAddCart">
          <i class="bi bi-cart3"></i> Ajouter au panier
        </button>
      </div>
    </div>

  </div>
</div>

<!-- Bottom nav -->
<nav class="bottom-nav">
  <a href="{{ url('/') }}" class="bottom-nav-item"><i class="bi bi-house-door-fill"></i><span>Accueil</span></a>
  <a href="{{ url('/menu') }}" class="bottom-nav-item active"><i class="bi bi-grid-fill"></i><span>Menu</span></a>
  <a href="#" class="bottom-nav-item"><i class="bi bi-heart"></i><span>Favoris</span></a>
  <a href="{{ url('/panier') }}" class="bottom-nav-item"><i class="bi bi-cart3"></i><span>Panier</span></a>
  <a href="{{ url('/compte') }}" class="bottom-nav-item"><i class="bi bi-person"></i><span>Compte</span></a>
</nav>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/catalogue.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  let CURRENT_PRICE = 0;
  let CURRENT_NAME  = '';
  let CURRENT_SLUG  = '';

  const hostGrid = document.getElementById('hostGrid');
  
  /* Vérification si CATALOGUE existe dans catalogue.js */
  if (typeof CATALOGUE !== 'undefined' && hostGrid) {
    Object.keys(CATALOGUE).forEach(slug => {
      const d = CATALOGUE[slug];
      hostGrid.insertAdjacentHTML('beforeend', `
        <div class="col-6">
          <div class="host-card" data-slug="${slug}">
            <div class="host-card-img-wrap">
              <img src="${d.img}" alt="${d.name}">
            </div>
            <div class="host-card-body">
              <div class="host-card-name">${d.name}</div>
              <div class="host-card-price">${d.price.toLocaleString('fr-FR')} FCFA</div>
            </div>
          </div>
        </div>`);
    });

    // Écouteur global pour ouvrir les détails au clic sur une carte
    hostGrid.addEventListener('click', function (e) {
      const card = e.target.closest('.host-card');
      if (card) {
        const slug = card.getAttribute('data-slug');
        openDishBySlug(slug);
      }
    });
  }

  /* ── Ouvrir le détail d'un plat ── */
  window.openDish = function(dish, slug) {
    CURRENT_PRICE = dish.price;
    CURRENT_NAME  = dish.name;
    CURRENT_SLUG  = slug;

    document.getElementById('drawerImg').src = dish.img;
    document.getElementById('drawerImg').alt = dish.name;
    document.getElementById('drawerName').textContent    = dish.name;
    document.getElementById('drawerPrice').textContent   = dish.price.toLocaleString('fr-FR') + ' FCFA';
    document.getElementById('drawerDesc').textContent    = dish.desc;
    document.getElementById('drawerRating').textContent  = dish.rating;
    document.getElementById('drawerReviews').textContent = '(' + dish.reviews + ' avis)';

    document.getElementById('qty').textContent = '1';

    // Ingrédients
    const ingWrap = document.getElementById('drawerIngredients');
    ingWrap.innerHTML = '';
    dish.ingredients.forEach(ing => {
      ingWrap.innerHTML += `<div class="ing-chip"><div class="icon-circle"><i class="fas ${ing.icon}"></i></div><span>${ing.name}</span></div>`;
    });

    // Allergènes
    const algWrap = document.getElementById('drawerAllergens');
    algWrap.innerHTML = dish.allergens.length ? '' : '<span style="font-size:.78rem;color:var(--muted);">Aucun allergène connu</span>';
    dish.allergens.forEach(alg => {
      algWrap.innerHTML += `<div class="allerg-chip"><div class="icon-circle"><i class="fas ${alg.icon}"></i></div><span>${alg.name}</span></div>`;
    });

    // Suggestions
    const sugWrap = document.getElementById('drawerSuggestions');
    sugWrap.innerHTML = '';
    dish.suggestions.forEach(sSlug => {
      if (typeof CATALOGUE !== 'undefined') {
        const s = CATALOGUE[sSlug];
        if (!s) return;
        sugWrap.innerHTML += `<div class="suggest-card" data-slug="${sSlug}"><img src="${s.img}" alt="${s.name}" loading="lazy"><div class="sc-body"><div class="sc-name">${s.name}</div><div class="sc-price">${s.price.toLocaleString('fr-FR')} FCFA</div></div></div>`;
      }
    });

    // Écouteur pour les suggestions
    sugWrap.querySelectorAll('.suggest-card').forEach(card => {
      card.addEventListener('click', function () {
        openDishBySlug(this.getAttribute('data-slug'));
      });
    });

    // Favori
    const btnFav = document.getElementById('btnFav');
    const favIcon = btnFav.querySelector('i');
    favIcon.className = 'bi bi-heart';
    btnFav.classList.remove('active');
    btnFav.style.color = '';

    document.getElementById('drawerBody').scrollTop = 0;
    document.getElementById('dishOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  window.openDishBySlug = function(slug) {
    if (typeof CATALOGUE !== 'undefined') {
      const dish = CATALOGUE[slug];
      if (dish) openDish(dish, slug);
    }
  };

  /* ── Fermer le modal ── */
  window.closeDish = function() {
    document.getElementById('dishOverlay').classList.remove('open');
    document.body.style.overflow = '';
  };

  const overlay = document.getElementById('dishOverlay');
  if (overlay) {
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeDish();
    });
  }

  const btnClose = document.getElementById('btnCloseDrawer');
  if (btnClose) btnClose.addEventListener('click', closeDish);

  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDish(); });

  /* ── Gestion de la quantité ── */
  function changeQty(delta) {
    let q = parseInt(document.getElementById('qty').textContent);
    q = Math.max(1, q + delta);
    document.getElementById('qty').textContent = q;
  }

  document.getElementById('btnQtyMinus').addEventListener('click', () => changeQty(-1));
  document.getElementById('btnQtyPlus').addEventListener('click', () => changeQty(1));

  /* ── Favoris ── */
  const btnFav = document.getElementById('btnFav');
  if (btnFav) {
    btnFav.addEventListener('click', function () {
      const icon = this.querySelector('i');
      if (icon.classList.contains('bi-heart-fill')) {
        icon.className = 'bi bi-heart';
        this.classList.remove('active');
        this.style.color = '';
      } else {
        icon.className = 'bi bi-heart-fill';
        this.classList.add('active');
        this.style.color = '#E24B4A';
      }
    });
  }

  /* ── Ajouter au panier ── */
  const btnAddCart = document.getElementById('btnAddCart');
  if (btnAddCart) {
    btnAddCart.addEventListener('click', function () {
      const q = parseInt(document.getElementById('qty').textContent);
      let panier = JSON.parse(localStorage.getItem('panier') || '[]');
      const existing = panier.find(p => p.slug === CURRENT_SLUG);
      if (existing) existing.qty += q;
      else panier.push({ slug: CURRENT_SLUG, nom: CURRENT_NAME, prix: CURRENT_PRICE, qty: q });
      localStorage.setItem('panier', JSON.stringify(panier));
      closeDish();
      showToast(q + 'x ' + CURRENT_NAME + ' ajouté au panier');
    });
  }

  function showToast(msg) {
    let toast = document.createElement('div');
    toast.textContent = msg;
    toast.style.cssText = 'position:fixed;bottom:90px;left:50%;transform:translateX(-50%);background:#1A1A1A;color:#fff;padding:12px 22px;border-radius:30px;font-size:.85rem;font-weight:600;z-index:4000;box-shadow:0 8px 24px rgba(0,0,0,.2);opacity:0;transition:.3s;';
    document.body.appendChild(toast);
    requestAnimationFrame(() => { toast.style.opacity = '1'; });
    setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 300); }, 2000);
  }
});
</script>
@endpush