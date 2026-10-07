@extends('layouts.app')

@section('title', 'Le Gourmet — Création d\'une commande')

@push('styles')
<style>
:root{
  --bg:#EEF1FF;
  --bordeaux:#7B1C2A;
  --red:#E8112D;
  --orange:#FF9500;
  --yellow:#FFBF0D;
  --green:#31AA1C;
  --blue:#2F80ED;
  --purple:#8C4AF2;
  --white:#FFFFFF;

  --bordeaux-20:rgba(123,28,42,.12);
  --orange-20:rgba(255,149,0,.15);
  --orange-50:rgba(255,149,0,.5);
  --red-20:rgba(232,17,45,.12);
  --green-20:rgba(49,170,28,.12);
  --blue-20:rgba(47,128,237,.12);
  --purple-20:rgba(140,74,242,.12);

  --ink:#2C2018;
  --muted:#8A8398;
  --border:#E4E7F7;
}

.main-content{
  padding:32px clamp(16px,3vw,40px) 60px;
}

/* ============ CARTE CHIFFRE D'AFFAIRES ============ */
.kpi-card{
  background:var(--white);
  border:1.5px solid var(--orange);
  border-radius:16px;
  padding:20px 26px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:18px;
  flex-wrap:wrap;
  box-shadow:0 4px 18px rgba(123,28,42,.06);
  margin-bottom:28px;
}
.kpi-left{display:flex;align-items:center;gap:16px;}
.kpi-icon{
  width:54px;height:54px;
  border-radius:14px;
  background:var(--orange-20);
  color:var(--orange);
  display:flex;align-items:center;justify-content:center;
  font-size:21px;
  flex-shrink:0;
}
.kpi-label{font-size:13px;color:var(--muted);margin-bottom:5px;}
.kpi-amount{font-family:'Playfair Display',serif;font-weight:700;font-size:30px;color:var(--orange);line-height:1;}
.kpi-amount .fcfa{font-size:14px;letter-spacing:1px;margin-left:4px;}
.kpi-growth{color:var(--orange);font-weight:600;font-size:13.5px;margin-top:5px;}
.kpi-date{
  display:flex;align-items:center;gap:14px;
  background:var(--white);
  border:1px solid var(--border);
  border-radius:12px;
  padding:11px 20px;
  font-weight:500;
  color:var(--ink);
}
.kpi-date i{color:var(--blue);}

@media (max-width:860px){
  .main-content{ padding:16px clamp(16px,3vw,40px) 40px; }
}
@media (max-width:767.98px){
  .kpi-card{ flex-direction:column; align-items:flex-start; padding:18px 20px; gap:14px; }
  .kpi-date{ width:100%; justify-content:space-between; }
}

/* ============ BOUTONS NAVIGATION ============ */
.nav-toggle-row{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:18px;
  margin-bottom:28px;
}
.nav-toggle-btn{
  border:none;
  border-radius:18px;
  padding:20px 24px;
  font-size:1.15rem;
  font-weight:700;
  cursor:pointer;
  transition:.2s;
  text-align:center;
}
.nav-toggle-btn.is-active{
  background:var(--bordeaux);
  color:var(--white);
  box-shadow:0 14px 30px rgba(123,28,42,.28);
}
.nav-toggle-btn.is-inactive{
  background:var(--white);
  color:var(--ink);
  border:1px solid var(--border);
}
.nav-toggle-btn.is-inactive:hover{border-color:var(--bordeaux);color:var(--bordeaux);}

/* ============ CARTES BLANCHES GENERIQUES ============ */
.panel{
  background:var(--white);
  border-radius:24px;
  padding:32px;
  box-shadow:0 14px 40px rgba(44,32,24,.05);
  margin-bottom:28px;
}
.panel-title{
  font-size:1.5rem;
  font-weight:700;
  color:var(--bordeaux);
  text-align:center;
  margin-bottom:28px;
}

/* ============ FORMULAIRE COMMANDE ============ */
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px 28px;
}
@media(max-width:767.98px){
  .form-grid{grid-template-columns:1fr;}
}
.field-label{
  font-size:.85rem;
  font-weight:600;
  color:var(--ink);
  margin-bottom:8px;
  display:block;
}
.field-select{
  width:100%;
  border:1.5px solid var(--border);
  border-radius:14px;
  padding:13px 18px;
  font-size:1rem;
  color:var(--ink);
  background:var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9'%3E%3Cpath d='M1 1l6 6 6-6' stroke='%237B1C2A' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 18px center;
  appearance:none;
  cursor:pointer;
  transition:.2s;
}
.field-select:focus{outline:none;border-color:var(--bordeaux);box-shadow:0 0 0 3px var(--bordeaux-20);}
.field-number{
  width:100%;
  border:1.5px solid var(--border);
  border-radius:14px;
  padding:13px 18px;
  font-size:1rem;
  color:var(--ink);
  background:var(--bg);
}
.field-number:focus{outline:none;border-color:var(--bordeaux);box-shadow:0 0 0 3px var(--bordeaux-20);}

/* ============ RECHERCHE PLAT ============ */
.dish-search-wrap{position:relative;margin-bottom:22px;}
.dish-search-wrap i.icon-search{
  position:absolute;left:20px;top:50%;transform:translateY(-50%);
  color:var(--muted);font-size:1rem;
}
.dish-search-input{
  width:100%;
  height:56px;
  border-radius:40px;
  border:1.5px solid var(--border);
  background:var(--bg);
  padding:0 50px;
  font-size:.95rem;
  color:var(--ink);
}
.dish-search-input:focus{outline:none;border-color:var(--bordeaux);box-shadow:0 0 0 3px var(--bordeaux-20);}
.dish-search-clear{
  position:absolute;right:16px;top:50%;transform:translateY(-50%);
  background:none;border:none;color:var(--muted);font-size:1rem;cursor:pointer;
  display:none;
}
.dish-search-clear.show{display:block;}

.dish-preview{
  border:1.5px solid var(--border);
  border-radius:20px;
  padding:20px;
  background:var(--bg);
}
.dish-preview-title{
  font-weight:700;color:var(--ink);font-size:1rem;margin-bottom:14px;
}
.dish-list{
  display:flex;flex-direction:column;gap:10px;max-height:280px;overflow-y:auto;margin-bottom:18px;
}
.dish-row{
  display:flex;align-items:center;gap:14px;
  background:var(--white);
  border:1.5px solid var(--border);
  border-radius:14px;
  padding:10px 16px;
  cursor:pointer;
  transition:.15s;
}
.dish-row:hover{border-color:var(--bordeaux);}
.dish-row.checked{border-color:var(--green);background:var(--green-20);}
.dish-row input[type=checkbox]{
  width:24px;height:24px;border-radius:6px;
  accent-color:var(--green);cursor:pointer;flex-shrink:0;
}
.dish-row img{
  width:42px;height:42px;border-radius:50%;object-fit:cover;flex-shrink:0;background:var(--bg);
}
.dish-row .dish-row-name{font-weight:600;font-size:.95rem;flex:1;}
.dish-row .dish-row-price{font-size:.82rem;color:var(--bordeaux);font-weight:700;}
.dish-empty{text-align:center;padding:24px 0;color:var(--muted);font-size:.9rem;}

.btn-add-dishes{
  background:var(--bordeaux);
  color:var(--white);
  border:none;
  border-radius:30px;
  padding:14px 44px;
  font-weight:700;
  font-size:1rem;
  float:right;
  cursor:pointer;
  transition:.2s;
}

.btn-add-dishes:hover{background:#611420;}
.dish-preview-footer{overflow:auto;padding-top:4px;}

/* ============ PLATS AJOUTES ============ */
.order-list{margin-top:28px;display:flex;flex-direction:column;gap:14px;}
.order-line{
  display:flex;align-items:center;gap:16px;
  background:var(--bg);
  border-radius:16px;
  padding:12px 18px;
}
.order-line img{
  width:56px;height:56px;border-radius:50%;object-fit:cover;flex-shrink:0;background:var(--white);
}
.order-line-name{font-weight:700;font-size:1rem;flex:1;min-width:0;}
.order-line-qty{font-size:.95rem;color:var(--muted);margin-right:4px;}
.qty-ctrl{display:flex;align-items:center;gap:8px;}
.qty-btn{
  width:44px;height:44px;border-radius:12px;
  border:none;
  background:var(--bg);
  color:var(--ink);
  font-weight:800;font-size:1rem;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:.15s;
}
.qty-btn:hover{background:var(--bordeaux-20);}
.qty-btn.minus{color:var(--ink);}
.order-line-del{
  width:44px;height:44px;border-radius:12px;
  border:none;background:var(--red-20);color:var(--red);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;font-size:1rem;flex-shrink:0;
}
.order-line-del:hover{background:var(--red);color:var(--white);}
.order-empty-msg{
  text-align:center;padding:30px 0;color:var(--muted);font-size:.95rem;
}

.order-total-row{
  display:flex;justify-content:flex-end;align-items:center;gap:16px;
  margin-top:26px;padding-top:22px;border-top:1.5px solid var(--border);
}
.order-total-label{font-size:1.2rem;font-weight:700;color:var(--ink);}
.order-total-amount{font-size:2rem;font-weight:800;color:var(--bordeaux);}

.add-dish-link{
  display:inline-flex;align-items:center;gap:8px;
  color:var(--blue);font-weight:700;font-size:.95rem;
  text-decoration:none;margin-top:22px;background:none;border:none;cursor:pointer;
}
.add-dish-link:hover{color:#1a5fc4;}

/* ============ ACTIONS FINALES ============ */
.final-actions{
  display:flex;justify-content:space-between;gap:18px;margin-top:10px;flex-wrap:wrap;
}
.btn-cancel{
  background:var(--white);
  border:1.5px solid var(--border);
  color:var(--ink);
  border-radius:16px;
  padding:15px 36px;
  font-weight:700;font-size:1rem;
  cursor:pointer;transition:.2s;
}
.btn-cancel:hover{border-color:var(--red);color:var(--red);}
.btn-create{
  background:var(--bordeaux);
  border:none;color:var(--white);
  border-radius:16px;
  padding:15px 40px;
  font-weight:700;font-size:1rem;
  cursor:pointer;transition:.2s;
  box-shadow:0 14px 28px rgba(123,28,42,.25);
  flex:1;
  max-width:320px;
  margin-left:auto;
}
.btn-create:hover{background:#611420;}
@media(max-width:575.98px){
  .final-actions{flex-direction:column;}
  .btn-create{max-width:none;margin-left:0;}
}
</style>
@endpush

@section('content')
<div class="main-content">

  <!-- ============ CHIFFRE D'AFFAIRES ============ -->
  <div class="kpi-card">
    <div class="kpi-left">
      <div class="kpi-icon"><i class="fa-solid fa-chart-line" style="color: #202020;"></i></div>
      <div>
        <div class="kpi-label">Chiffres d'affaires journaliers</div>
        <div class="kpi-amount" style="color:var(--orange)">1 250 000 <span class="fcfa" style="color:var(--orange)">FCFA</span></div>
        <div class="kpi-growth" style="color:var(--orange)">+ 10%</div>
      </div>
    </div>
    <div class="kpi-date">
      <span>03 juillet 2026</span>
      <i class="fa-regular fa-calendar"></i>
    </div>
  </div>

  <!-- ============ NAVIGATION ============ -->
  <div class="nav-toggle-row">
    <button class="nav-toggle-btn is-active" type="button">Créer une commande</button>
    <a class="nav-toggle-btn is-inactive" href="#" style="text-decoration: none;">Gestion des commandes</a>
  </div>

  <!-- ============ FORMULAIRE ============ -->
  <section class="panel">
    <div class="panel-title">Création d'une commande</div>
    <div class="form-grid">
      <div>
        <label class="field-label" for="tableNumber">Numéro de table</label>
        <input type="number" class="field-number" id="tableNumber" min="1" max="60" value="15">
      </div>
      <div>
        <label class="field-label" for="serverSelect">Serveur</label>
        <select class="field-select" id="serverSelect">
          <option>Sydney</option>
          <option>Adjovi</option>
          <option>Kokou</option>
          <option>Fabrice</option>
          <option>Nadège</option>
        </select>
      </div>
      <div>
        <label class="field-label" for="statusSelect">Statut</label>
        <select class="field-select" id="statusSelect">
          <option>En attente</option>
          <option selected>En préparation</option>
          <option>Prêt</option>
          <option>Servi</option>
          <option>Annulé</option>
        </select>
      </div>
    </div>
  </section>

  <!-- ============ AJOUTER UN PLAT ============ -->
  <section class="panel">
    <div class="panel-title">Ajouter un plat</div>

    <div class="dish-search-wrap">
      <i class="fa-solid fa-magnifying-glass icon-search"></i>
      <input type="text" class="dish-search-input" id="dishSearch" placeholder="Rechercher un plat (ex : Burgers, Pizzas, Boissons...)">
      <button type="button" class="dish-search-clear" id="dishSearchClear"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="dish-preview">
      <div class="dish-preview-title">Aperçu des plats</div>
      <div class="dish-list" id="dishList"></div>
      <div class="dish-preview-footer">
        <button type="button" class="btn-add-dishes" id="btnAddDishes">Ajouter</button>
      </div>
    </div>

    <div class="order-list" id="orderList"></div>

    <div class="order-total-row">
      <span class="order-total-label">Total :</span>
      <span class="order-total-amount" id="orderTotal">0 FCFA</span>
    </div>

    <button type="button" class="add-dish-link" id="addAnotherDish">
      <i class="fa-solid fa-plus"></i> Ajouter un plat
    </button>
  </section>

  <!-- ============ ACTIONS ============ -->
  <div class="final-actions">
    <button type="button" class="btn-cancel" id="btnCancel">Annuler</button>
    <button type="button" class="btn-create" id="btnCreate">Créer la commande</button>
  </div>

</div>
@endsection

@push('scripts')
<script>
/* ============================================================
   CATALOGUE DES PLATS
============================================================ */
const dishCatalog = [
  {id:'burger-viande', name:'Burger viande', price:3000, img:'https://images.unsplash.com/photo-1550547660-d9450f859349?w=200&q=80'},
  {id:'royal-burger', name:'Burger royal', price:4000, img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80'},
  {id:'double-cheese', name:'Cheese burger', price:6000, img:'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=200&q=80'},
  {id:'pizza-gourmet', name:'Pizza Gourmet', price:6000, img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=200&q=80'},
  {id:'pizza-margherita', name:'Pizza Margherita', price:5000, img:'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=200&q=80'},
  {id:'sandwich-fromage', name:'Sandwich fromage jambon', price:2000, img:'assets/images/menu/sandwich-fromage-jambon.jpeg'},
  {id:'chawarma-unico', name:'Shawarma Unico', price:3500, img:'https://images.unsplash.com/photo-1561651823-34feb02250e4?w=200&q=80'},
  {id:'poulet-braise', name:'Poulet Braisé', price:4000, img:'https://images.unsplash.com/photo-1544025162-d76694265947?w=200&q=80'},
  {id:'tilapia', name:'Tilapia Grillé', price:5500, img:'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=200&q=80'},
  {id:'bissap', name:'Jus de Bissap', price:1000, img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=200&q=80'},
  {id:'cola', name:'Coca-Cola Frais', price:800, img:'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=200&q=80'},
  {id:'fondant-chocolat', name:'Fondant Chocolat', price:2500, img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=200&q=80'},
];

const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' fill='%23EEF1FF'/%3E%3C/svg%3E";
const IMG_FB = `this.onerror=null;this.src='${FALLBACK_IMG}'`;

function fmt(p){ return p.toLocaleString('fr-FR') + ' FCFA'; }

/* ============================================================
   ETAT
============================================================ */
let checkedIds = new Set(['royal-burger']);
let orderItems = [{...dishCatalog.find(d=>d.id==='royal-burger'), qty:3}];

/* ============================================================
   RENDU : LISTE DE RECHERCHE
============================================================ */
function renderDishList(filter=''){
  const listEl = document.getElementById('dishList');
  const q = filter.trim().toLowerCase();
  const results = q ? dishCatalog.filter(d=>d.name.toLowerCase().includes(q)) : dishCatalog;

  if(!results.length){
    listEl.innerHTML = `<div class="dish-empty"><i class="fa-solid fa-circle-info"></i> Aucun plat trouvé</div>`;
    return;
  }

  listEl.innerHTML = results.map(d=>`
    <label class="dish-row ${checkedIds.has(d.id)?'checked':''}" data-id="${d.id}">
      <input type="checkbox" ${checkedIds.has(d.id)?'checked':''} onchange="toggleDishCheck('${d.id}', this)">
      <img src="${d.img}" alt="${d.name}" ${IMG_FB}>
      <span class="dish-row-name">${d.name}</span>
      <span class="dish-row-price">${fmt(d.price)}</span>
    </label>
  `).join('');
}

function toggleDishCheck(id, input){
  if(input.checked) checkedIds.add(id); else checkedIds.delete(id);
  input.closest('.dish-row').classList.toggle('checked', input.checked);
}

/* ============================================================
   AJOUTER LES PLATS COCHES A LA COMMANDE
============================================================ */
function addCheckedToOrder(){
  if(!checkedIds.size){
    return;
  }
  checkedIds.forEach(id=>{
    const dish = dishCatalog.find(d=>d.id===id);
    if(!dish) return;
    const existing = orderItems.find(o=>o.id===id);
    if(existing){ existing.qty += 1; } else { orderItems.push({...dish, qty:1}); }
  });
  renderOrderList();
}

/* ============================================================
   RENDU : PLATS AJOUTES A LA COMMANDE
============================================================ */
function renderOrderList(){
  const el = document.getElementById('orderList');
  if(!orderItems.length){
    el.innerHTML = `<div class="order-empty-msg"><i class="fa-solid fa-basket-shopping"></i><br>Aucun plat ajouté à la commande.</div>`;
  } else {
    el.innerHTML = orderItems.map((item,i)=>`
      <div class="order-line">
        <img src="${item.img}" alt="${item.name}" ${IMG_FB}>
        <div class="order-line-name">${item.name} <span class="order-line-qty">(×${item.qty})</span></div>
        <div class="qty-ctrl">
          <button type="button" class="qty-btn" onclick="changeQty(${i},1)"><i class="fa-solid fa-plus"></i></button>
          <button type="button" class="qty-btn minus" onclick="changeQty(${i},-1)"><i class="fa-solid fa-minus"></i></button>
        </div>
        <button type="button" class="order-line-del" onclick="removeOrderItem(${i})"><i class="fa-solid fa-trash"></i></button>
      </div>
    `).join('');
  }
  updateTotal();
}

function changeQty(index, delta){
  const item = orderItems[index];
  if(!item) return;
  item.qty = Math.max(1, item.qty + delta);
  renderOrderList();
}

function removeOrderItem(index){
  orderItems.splice(index,1);
  renderOrderList();
}

function updateTotal(){
  const total = orderItems.reduce((s,i)=>s + i.price*i.qty, 0);
  document.getElementById('orderTotal').textContent = fmt(total);
}

/* ============================================================
   RECHERCHE
============================================================ */
const searchInput = document.getElementById('dishSearch');
const clearBtn = document.getElementById('dishSearchClear');
searchInput.addEventListener('input', ()=>{
  clearBtn.classList.toggle('show', !!searchInput.value);
  renderDishList(searchInput.value);
});
clearBtn.addEventListener('click', ()=>{
  searchInput.value='';
  clearBtn.classList.remove('show');
  renderDishList();
});

/* ============================================================
   BOUTONS
============================================================ */
document.getElementById('btnAddDishes').addEventListener('click', addCheckedToOrder);
document.getElementById('addAnotherDish').addEventListener('click', ()=> searchInput.focus());

document.getElementById('btnCancel').addEventListener('click', ()=>{
  orderItems = [];
  checkedIds.clear();
  document.getElementById('tableNumber').value = 15;
  document.getElementById('serverSelect').selectedIndex = 0;
  document.getElementById('statusSelect').selectedIndex = 1;
  searchInput.value='';
  clearBtn.classList.remove('show');
  renderDishList();
  renderOrderList();
});

document.getElementById('btnCreate').addEventListener('click', ()=>{
  if(!orderItems.length){
    alert('Veuillez ajouter au moins un plat avant de créer la commande.');
    return;
  }
  const table = document.getElementById('tableNumber').value;
  const server = document.getElementById('serverSelect').value;
  const status = document.getElementById('statusSelect').value;
  const total = orderItems.reduce((s,i)=>s + i.price*i.qty, 0);
  alert(`Commande créée avec succès !\n\nTable : ${table}\nServeur : ${server}\nStatut : ${status}\nTotal : ${fmt(total)}`);
});

/* ============================================================
   INIT
============================================================ */
renderDishList();
renderOrderList();
</script>
@endpush