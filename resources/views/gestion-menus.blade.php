@extends('layouts.app')

@section('title', 'Le Gourmet — Gestion des menus')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --wine:#7B1C2A;
  --red:#E8112D;
  --yellow:#FFBF0D;
  --orange:#FF9500;
  --orange-10:rgba(255,149,0,.10);
  --orange-20:rgba(255,149,0,.20);
  --green:#31AA1C;
  --green-15:rgba(49,170,28,.12);
  --wine-08:rgba(123,28,42,.08);
  --wine-12:rgba(123,28,42,.12);
  --pink-soft:#FBE4E8;
  --text:#1C1712;
  --muted:#9A928A;
  --border:#ECE6DF;
  --bg:#EEF0F8;
  --card:#FFFFFF;
  --radius-lg:26px;
  --radius-md:18px;
  --radius-sm:12px;
  --shadow-card:0 14px 34px rgba(28,23,18,.06);
  --shadow-soft:0 6px 18px rgba(28,23,18,.05);
  --orange-50: #FF9500;
}

.menus-main{padding:0;}
.main-area{flex:1;min-width:0;padding:26px 34px 60px;}

/* ---- Revenue card ---- */
.revenue-card{
  background:var(--card);
  border:1.5px solid var(--orange);
  border-radius:15px;
  padding:22px 30px;
  display:flex;align-items:center;justify-content:space-between;gap:22px;
  margin-bottom:28px;flex-wrap:wrap;
  box-shadow:var(--shadow-card);
}
.rc-left{display:flex;align-items:center;gap:18px;flex:1;min-width:220px;}
.rc-icon{
  width:52px;height:52px;border-radius:14px;background:var(--orange-10);
  display:flex;align-items:center;justify-content:center;color:var(--orange);font-size:1.25rem;flex-shrink:0;
}
.rc-label{font-size:1rem;color:var(--text);margin-bottom:4px;}
.rc-amount{font-family:'Playfair Display',serif;font-weight:800;font-size:1.9rem;color:var(--orange);line-height:1.1;}
.rc-amount span{font-size:1rem;font-weight:700;}
.rc-variation{font-size:.8rem;color:var(--orange-50);font-weight:600;margin-top:3px;}
.rc-date{
  background:#fff;border:1px solid var(--border);border-radius:40px;
  padding:12px 22px;display:flex;align-items:center;gap:26px;font-size:.85rem;font-weight:600;color:var(--text);
  box-shadow:var(--shadow-soft);white-space:nowrap;
}
.rc-date i{color:#3B82F6;}

/* ---- Page title ---- */
.page-title{
  font-family:'Playfair Display',serif;font-weight:800;font-size:2rem;color:var(--text);margin-bottom:22px;
}

/* ---- Tabs ---- */
.tabs-row{
  display:flex;gap:16px;margin-bottom:26px;
  overflow-x:auto;scrollbar-width:none;padding-bottom:2px;
}
.tabs-row::-webkit-scrollbar{display:none;}
.tab-btn{
  flex:1;min-width:150px;
  background:#fff;color:var(--text);border:none;
  border-radius:16px;padding:16px 8px;font-weight:600;font-size:18px;
  box-shadow:var(--shadow-soft);transition:.2s;cursor:pointer;font-family:'Playfair Display',serif;
  text-align:center;text-decoration:none;display:block;
}
.tab-btn.active{background:var(--wine);color:#fff;box-shadow:0 10px 22px var(--wine-12);}

/* ---- Layout: two columns ---- */
.content-grid{display:grid;grid-template-columns:minmax(0,64%) minmax(0,36%);gap:24px;align-items:stretch;}
.col-left{display:flex;flex-direction:column;gap:24px;min-width:0;}
.col-right{min-width:0;}

/* ---- Shared panel card ---- */
.panel-card{
  background:var(--card);border-radius:var(--radius-lg);padding:26px 26px 22px;
  box-shadow:var(--shadow-card);
}
.panel-head{margin-bottom:16px;}
.panel-title{
  font-family:'Playfair Display',serif;font-weight:700;font-size:1.35rem;color:var(--wine);
  margin-bottom:8px;
}
.panel-underline{width:50px;height:4px;background:var(--wine);border-radius:3px;margin-left: 30px;}

/* ---- Horizontal scroll row + next button ---- */
.hscroll-wrap{position:relative;}
.hscroll{display:flex;gap:16px;overflow-x:auto;scrollbar-width:none;padding:2px 2px 6px;scroll-behavior:smooth;}
.hscroll::-webkit-scrollbar{display:none;}
.hs-next{
  position:absolute;right:-6px;top:38%;width:38px;height:38px;border-radius:50%;
  background:var(--pink-soft);border:none;color:var(--text);display:flex;align-items:center;justify-content:center;
  box-shadow:var(--shadow-soft);z-index:3;cursor:pointer;
}

/* ---- Category card ---- */
.cat-card{
  flex:0 0 auto;width:150px;cursor:pointer;border:1.5px solid var(--border);
  border-radius:var(--radius-md);overflow:hidden;transition:.2s;
}
.cat-card img{width:100%;height:98px;object-fit:cover;display:block;}
.cat-card-label{
  text-align:center;padding:11px 6px;font-size:.83rem;font-weight:700;color:var(--text);
  font-family:'Playfair Display',serif;line-height:1.2;
}
.cat-card.active{border-color:var(--wine); background:var(--wine); color:#fff; }
.cat-card.active .cat-card-label{background:var(--wine);color:#fff;}

/* ---- Subcategory card ---- */
.subcat-card{
  flex:0 0 auto;width:150px;cursor:pointer;border:1.5px solid var(--border);
  border-radius:var(--radius-md);overflow:hidden;background:#fff;transition:.2s;
}
.subcat-card img{width:100%;height:98px;object-fit:cover;display:block;}
.subcat-card-body{padding:11px 10px;}
.subcat-card-name{font-size:.85rem;font-weight:700;color:var(--text);font-family:'Playfair Display',serif;}
.subcat-card-count{font-size:.68rem;color:var(--muted);margin-top:2px;}
.subcat-card.active{border-color:var(--wine);}
.subcat-card.active .subcat-card-name{color:var(--wine);}

/* ---- Plats panel (right column) ---- */
.plats-panel{height:100%;display:flex;flex-direction:column;}
.plats-head{display:flex;align-items:center;gap:16px;margin-bottom:18px;}
.plats-icon{
  width:52px;height:52px;border-radius:50%;background:var(--pink-soft);
  display:flex;align-items:center;justify-content:center;color:var(--wine);font-size:1.2rem;flex-shrink:0;
}
.plats-title{font-family:'Playfair Display',serif;font-weight:800;font-size:1.5rem;color:var(--wine);line-height:1.15;}
.plats-list{display:flex;flex-direction:column;gap:14px;overflow-y:auto;padding-right:2px;}
.plat-row{
  display:flex;align-items:center;gap:16px;
  background:#fff;border:1.5px solid var(--border);border-radius:20px;padding:10px 16px;
  transition:.2s;cursor:default;
}
.plat-row:hover{border-color:var(--wine);}
.plat-row img{width:54px;height:54px;border-radius:50%;object-fit:cover;flex-shrink:0;background:var(--orange-10);}
.plat-row-name{font-weight:600;font-size:.95rem;color:var(--text);}
.plats-empty{padding:40px 10px;text-align:center;color:var(--muted);font-size:.88rem;}

.section-count-pill{
  font-size:.72rem;color:var(--muted);font-weight:600;margin-left:auto;
}
.panel-head-row{display:flex;align-items:center;gap:10px;margin-bottom:16px;}

.grid-view{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:16px;}
.plat-row-wide{
  display:flex;align-items:center;gap:18px;background:#fff;border:1.5px solid var(--border);
  border-radius:20px;padding:12px 18px;
}
.plat-row-wide img{width:64px;height:64px;border-radius:16px;object-fit:cover;flex-shrink:0;}
.plat-row-wide .prw-name{font-weight:700;font-size:.98rem;}
.plat-row-wide .prw-meta{font-size:.76rem;color:var(--muted);margin-top:2px;}
.plat-row-wide .prw-price{margin-left:auto;font-family:'Playfair Display',serif;font-weight:800;color:var(--wine);font-size:1rem;white-space:nowrap;}

/* RESPONSIVE */
@media (max-width:1199.98px){
  .content-grid{grid-template-columns:60% 40%;}
}
@media (max-width:991.98px){
  .content-grid{grid-template-columns:1fr;}
  .col-right{order:3;}
  .plats-list{max-height:420px;}
}
@media (max-width:767.98px){
  .main-area{padding:16px 16px 40px;}
  .rc-amount{font-size:1.6rem;}

  .revenue-card{
    padding:18px 10px;flex-direction:column;align-items:flex-start;gap:14px;margin-bottom:20px;
    border-radius:16px;
  }
  .rc-left{min-width:0;}
  .rc-icon{width:56px;height:56px;}
  .rc-date{
    width:100%;justify-content:space-between;
    border-radius:12px;padding:12px 20px;gap:12px;white-space:normal;
  }

  .page-title{font-size:22px;margin-bottom:16px;}

  .tabs-row{gap:10px;margin-bottom:18px;}
  .tab-btn{flex:0 0 auto;min-width:0;padding:13px 20px;font-size:14.5px;white-space:nowrap;text-align:center;border-radius:14px;}

  .panel-card{padding:18px;border-radius:18px;}
  .panel-title{font-size:1.1rem;}
  .plats-title{font-size:1.1rem;}

  .cat-card,.subcat-card{width:126px;border-radius:14px;}
  .cat-card img,.subcat-card img{height:84px;}

  .plats-list{max-height:none;overflow-y:visible;gap:12px;}
  .plats-icon{width:44px;height:44px;font-size:1.05rem;}
  .plats-head{margin-bottom:14px;}

  .grid-view{grid-template-columns:repeat(2, 1fr);gap:12px;}
  .grid-view .cat-card,.grid-view .subcat-card{width:100%;}

  .plat-row-wide{padding:10px 14px;gap:14px;border-radius:16px;}
  .plat-row-wide img{width:52px;height:52px;border-radius:12px;}
  .plat-row-wide .prw-name{font-size:.88rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:140px;}
  .plat-row-wide .prw-meta{font-size:.7rem;}
  .plat-row-wide .prw-price{font-size:.88rem;}
}
@media (max-width:479.98px){
  .rc-amount{font-size:1.4rem;}
  .grid-view{grid-template-columns:repeat(2, 1fr);gap:10px;}
  .cat-card img,.subcat-card img{height:76px;}
  .tab-btn{padding:11px 16px;font-size:13.5px;}
}
</style>
@endpush

@section('content')
<div class="menus-main">
  <div class="main-area">

    <!-- KPI CHIFFRE D'AFFAIRES -->
    <div class="revenue-card">
      <div class="rc-left">
        <div class="rc-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
        <div>
          <div class="rc-label">Chiffres d'affaires journaliers</div>
          <div class="rc-amount" id="rcAmount">1 250 000 <span>FCFA</span></div>
          <div class="rc-variation" id="rcVariation" style="color:var(--orange-50)">+ 10%</div>
        </div>
      </div>
      <div class="rc-date">
        <span id="rcDate">03 juillet 2026</span>
        <i class="bi bi-calendar3"></i>
      </div>
    </div>

    <h1 class="page-title">Gestion des menus</h1>

    <!-- TABS ONGLETS NAVIGATION -->
    <div class="tabs-row" id="tabsRow">
      <a href="{{ url('/menus/apercus') }}" class="tab-btn active">Aperçus</a>
      <a href="{{ url('/menus/categories') }}" class="tab-btn">Catégories</a>
      <a href="{{ url('/menus/sous-categories') }}" class="tab-btn">Sous-catégories</a>
      <a href="{{ url('/menus/plats') }}" class="tab-btn">Plats</a>
    </div>

    <!-- ZONE PRINCIPALE (GRILLE A2 COLONNES) -->
    <div class="content-grid">
      
      <!-- COLONNE GAUCHE : CATÉGORIES ET SOUS-CATÉGORIES -->
      <div class="col-left">

        <div class="panel-card">
          <div class="panel-head">
            <div class="panel-title" style="text-decoration:solid;width:250px;color:var(--wine);border-radius:3px;">Catégories</div>
            <div class="panel-underline"></div>
          </div>
          <div class="hscroll-wrap">
            <div class="hscroll" id="catRow"></div>
            <button class="hs-next" id="catNext" aria-label="Voir plus de catégories"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>

        <div class="panel-card">
          <div class="panel-head">
            <div class="panel-title">Sous-catégories</div>
            <div class="panel-underline"></div>
          </div>
          <div class="hscroll-wrap">
            <div class="hscroll" id="subRow"></div>
            <button class="hs-next" id="subNext" aria-label="Voir plus de sous-catégories"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>

      </div>

      <!-- COLONNE DROITE : PANNEAU DES PLATS -->
      <div class="col-right">
        <div class="panel-card plats-panel" id="platsPanel"></div>
      </div>

    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Crect width='200' height='200' fill='%23F4EDE4'/%3E%3Ccircle cx='100' cy='100' r='88' fill='none' stroke='%23EDE0D0' stroke-width='3'/%3E%3Ctext x='50%25' y='54%25' font-size='66' text-anchor='middle' dominant-baseline='middle'%3E%F0%9F%8D%BD%EF%B8%8F%3C/text%3E%3C/svg%3E";
  const IMG_FB = `this.onerror=null;this.src='${FALLBACK_IMG}'`;

  const RAW_DATA = {
    categories: [
      {key:'cuisine-de-rue', label:'Street Food', img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&q=80'},
      {key:'grillades', label:'Spécialité grillées', img:'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&q=80'},
      {key:'africain', label:'Spécialités africaines', img:'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=300&q=80'},
      {key:'pates', label:'Pâtes alimentaires', img:'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=300&q=80'},
      {key:'dejeuner', label:'Petit déjeuner', img:'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?w=300&q=80'},
      {key:'boissons', label:'Boissons', img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=300&q=80'},
      {key:'cocktails', label:'Cocktails', img:'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=300&q=80'},
      {key:'desserts', label:'Desserts et glaces', img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=300&q=80'},
    ],
    subcategories: {
      'cuisine-de-rue':[
        {key:'burgers', label:'Burgers', img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&q=80'},
        {key:'pizzas', label:'Pizzas', img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=300&q=80'},
        {key:'chawarmas', label:'Chawarmas', img:'https://images.unsplash.com/photo-1561651823-34feb02250e4?w=300&q=80'},
        {key:'crepes', label:'Crêpes', img:'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=300&q=80'},
      ],
      'grillades':[
        {key:'poulet', label:'Poulet', img:'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&q=80'},
        {key:'poisson', label:'Poisson', img:'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=300&q=80'},
      ],
      'africain':[
        {key:'plats-locaux', label:'Plats locaux', img:'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=300&q=80'},
        {key:'riz', label:'Riz & Sauces', img:'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300&q=80'},
      ],
      'pates':[
        {key:'sauce-rouge', label:'Sauce rouge', img:'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=300&q=80'},
        {key:'sauce-creme', label:'Sauce crème', img:'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=300&q=80'},
      ],
      'dejeuner':[
        {key:'sale', label:'Salé', img:'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?w=300&q=80'},
        {key:'sucre', label:'Sucré', img:'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=300&q=80'},
      ],
      'boissons':[
        {key:'naturels', label:'Jus naturels', img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=300&q=80'},
        {key:'sodas', label:'Sodas', img:'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=300&q=80'},
      ],
      'cocktails':[
        {key:'classiques', label:'Classiques', img:'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=300&q=80'},
        {key:'fruites', label:'Fruités', img:'https://images.unsplash.com/photo-1546173159-315724a31696?w=300&q=80'},
      ],
      'desserts':[
        {key:'gateaux', label:'Gâteaux', img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=300&q=80'},
        {key:'glaces', label:'Glaces', img:'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=300&q=80'},
      ],
    },
    plats: [
      {id:'burger-viande', cat:'cuisine-de-rue', subcat:'burgers', name:'Burger viande', price:3000, img:'https://images.unsplash.com/photo-1550547660-d9450f859349?w=200&q=80'},
      {id:'royal-burger', cat:'cuisine-de-rue', subcat:'burgers', name:'Royal burger', price:4000, img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80'},
      {id:'double-cheese', cat:'cuisine-de-rue', subcat:'burgers', name:'Double cheese burger', price:6000, img:'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=200&q=80'},
      {id:'cheese-burger', cat:'cuisine-de-rue', subcat:'burgers', name:'Cheese burger', price:3500, img:'https://images.unsplash.com/photo-1550547660-d9450f859349?w=200&q=80'},
      {id:'chicken-burger', cat:'cuisine-de-rue', subcat:'burgers', name:'Chicken burger', price:3200, img:'https://images.unsplash.com/photo-1606755962773-d324e0a13086?w=200&q=80'},
      {id:'pizza-gourmet', cat:'cuisine-de-rue', subcat:'pizzas', name:'Pizza Gourmet', price:6000, img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=200&q=80'},
      {id:'pizza-margherita', cat:'cuisine-de-rue', subcat:'pizzas', name:'Pizza Margherita', price:5000, img:'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=200&q=80'},
      {id:'chawarma-unico', cat:'cuisine-de-rue', subcat:'chawarmas', name:'Shawarma Unico', price:3500, img:'https://images.unsplash.com/photo-1561651823-34feb02250e4?w=200&q=80'},
      {id:'crepe-nutella', cat:'cuisine-de-rue', subcat:'crepes', name:'Crêpe Nutella', price:1800, img:'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=200&q=80'},
      {id:'poulet-braise', cat:'grillades', subcat:'poulet', name:'Poulet Braisé', price:4000, img:'https://images.unsplash.com/photo-1544025162-d76694265947?w=200&q=80'},
      {id:'tilapia', cat:'grillades', subcat:'poisson', name:'Tilapia Grillé', price:5500, img:'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=200&q=80'},
      {id:'alloco', cat:'africain', subcat:'plats-locaux', name:'Alloco Spécial', price:1500, img:'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=200&q=80'},
      {id:'riz-sauce', cat:'africain', subcat:'riz', name:'Riz Sauce Graine', price:2500, img:'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=200&q=80'},
      {id:'spaghetti-bolo', cat:'pates', subcat:'sauce-rouge', name:'Spaghetti Bolognaise', price:3500, img:'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=200&q=80'},
      {id:'pasta-carbonara', cat:'pates', subcat:'sauce-creme', name:'Pasta Carbonara', price:4000, img:'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=200&q=80'},
      {id:'english-breakfast', cat:'dejeuner', subcat:'sale', name:'English Breakfast', price:4500, img:'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?w=200&q=80'},
      {id:'pancakes', cat:'dejeuner', subcat:'sucre', name:'Pancakes Maison', price:3000, img:'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=200&q=80'},
      {id:'bissap', cat:'boissons', subcat:'naturels', name:'Jus de Bissap', price:1000, img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=200&q=80'},
      {id:'cola', cat:'boissons', subcat:'sodas', name:'Coca-Cola Frais', price:800, img:'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=200&q=80'},
      {id:'mojito', cat:'cocktails', subcat:'classiques', name:'Mojito Virgin', price:2000, img:'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=200&q=80'},
      {id:'tropical-punch', cat:'cocktails', subcat:'fruites', name:'Tropical Punch', price:2500, img:'https://images.unsplash.com/photo-1546173159-315724a31696?w=200&q=80'},
      {id:'fondant-chocolat', cat:'desserts', subcat:'gateaux', name:'Fondant Chocolat', price:2500, img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=200&q=80'},
      {id:'glace-chocolat', cat:'desserts', subcat:'glaces', name:'Glace au Chocolat', price:2500, img:'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=200&q=80'},
    ],
  };

  let categories = RAW_DATA.categories;
  let subcatsMap = RAW_DATA.subcategories;
  let allPlats = RAW_DATA.plats;
  let activeCatKey = categories[0] ? categories[0].key : null;
  let firstSubs = subcatsMap[activeCatKey] || [];
  let activeSubKey = firstSubs[0] ? firstSubs[0].key : null;

  function countPlats(catKey, subKey){
    return allPlats.filter(p=>p.cat===catKey && p.subcat===subKey).length.toString().padStart(2,'0');
  }

  function renderCatRow(){
    const row = document.getElementById('catRow');
    if(!row) return;
    row.innerHTML = categories.map(c => `
      <div class="cat-card${c.key===activeCatKey ? ' active' : ''}" data-cat="${c.key}">
        <img src="${c.img}" alt="${c.label}" ${IMG_FB}>
        <div class="cat-card-label">${c.label}</div>
      </div>
    `).join('');

    row.querySelectorAll('.cat-card').forEach(card=>{
      card.addEventListener('click', ()=>{
        activeCatKey = card.dataset.cat;
        const subs = subcatsMap[activeCatKey] || [];
        activeSubKey = subs[0] ? subs[0].key : null;
        renderCatRow(); 
        renderSubRow(); 
        renderPlatsPanel();
        requestAnimationFrame(()=>{ wireHscrollArrow('subRow','subNext'); });
      });
    });
  }

  function renderSubRow(){
    const row = document.getElementById('subRow');
    if(!row) return;
    const subs = subcatsMap[activeCatKey] || [];
    row.innerHTML = subs.map(s => `
      <div class="subcat-card${s.key===activeSubKey ? ' active' : ''}" data-sub="${s.key}">
        <img src="${s.img}" alt="${s.label}" ${IMG_FB}>
        <div class="subcat-card-body">
          <div class="subcat-card-name">${s.label}</div>
          <div class="subcat-card-count">Nombre de plats : ${countPlats(activeCatKey, s.key)}</div>
        </div>
      </div>
    `).join('');

    row.querySelectorAll('.subcat-card').forEach(card=>{
      card.addEventListener('click', ()=>{
        activeSubKey = card.dataset.sub;
        renderSubRow(); 
        renderPlatsPanel();
      });
    });
  }

  function renderPlatsPanel(){
    const panel = document.getElementById('platsPanel');
    if(!panel) return;
    const subLabel = (subcatsMap[activeCatKey]||[]).find(s=>s.key===activeSubKey);
    const plats = allPlats.filter(p=>p.cat===activeCatKey && p.subcat===activeSubKey);
    panel.innerHTML = `
      <div class="plats-head">
        <div class="plats-icon"><i class="fa-solid fa-utensils"></i></div>
        <div class="plats-title">Plats : ${subLabel ? subLabel.label : ''}</div>
      </div>
      <div class="plats-list">
        ${plats.length ? plats.map(p=>`
          <div class="plat-row">
            <img src="${p.img}" alt="${p.name}" ${IMG_FB}>
            <div class="plat-row-name">${p.name}</div>
          </div>
        `).join('') : `<div class="plats-empty">Aucun plat dans cette sous-catégorie pour le moment.</div>`}
      </div>
    `;
  }

  function wireHscrollArrow(rowId, btnId){
    const row = document.getElementById(rowId);
    const btn = document.getElementById(btnId);
    if(!row || !btn) return;

    function update(){
      const overflow = row.scrollWidth > row.clientWidth + 6;
      const atEnd = row.scrollLeft + row.clientWidth >= row.scrollWidth - 6;
      btn.style.display = (overflow && !atEnd) ? 'flex' : 'none';
    }

    row.removeEventListener('scroll', row._scrollHandler || (()=>{}));
    row._scrollHandler = update;
    row.addEventListener('scroll', update);
    btn.onclick = ()=> row.scrollBy({left:200, behavior:'smooth'});
    window.addEventListener('resize', update);
    setTimeout(update, 30);
  }

  // Initialisation du composant
  renderCatRow();
  renderSubRow();
  renderPlatsPanel();
  wireHscrollArrow('catRow','catNext');
  wireHscrollArrow('subRow','subNext');
});
</script>
@endpush