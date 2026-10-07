const SITE_HEADER_HTML = `
<nav class="navbar navbar-expand-md navbar-legourmet bg-white">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <a class="navbar-brand" href="#">
      <img src="assets/images/logo_gourmet.jpeg" alt="Le Gourmet" class="logo-img">
    </a>

   <ul class="navbar-nav d-none d-md-flex flex-row mx-auto">
        <li class="nav-item"><a class="nav-link" href="index.html" data-page="index.html">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="assistance.html" data-page="assistance.html">Assistance</a></li>
        <li class="nav-item"><a class="nav-link" href="factures.html" data-page="factures.html">Factures</a></li>
         <li class="nav-item"><a class="nav-link" href="contact.html" data-page="contact.html">Contacts</a></li>
    </ul>

    <a href="panier-table.html" class="btn btn-commander d-none d-md-inline-flex align-items-center gap-2" style="position:relative;">
      <i class="fa-solid fa-cart-shopping"></i> Panier
      <span class="notif-badge" id="headerCartBadge">0</span>
    </a>

    <div class="d-flex d-md-none align-items-center gap-3">
      <a href="panier-table.html" class="navbar-mobile-icon position-relative text-decoration-none" style="background:#fff; color:#2C2018; font-size:1.2rem">
        <i class="fa-solid fa-bell"></i>
        <span class="notif-badge" id="headerBellBadge">0</span>
      </a>
      <a href="factures.html" class="navbar-mobile-icon text-decoration-none" style="background:#fdf1d8; color:#C9A227; font-size:1.2rem;">
        <i class="fa-solid fa-file-invoice"></i>
      </a>
      <div class="navbar-mobile-icon" style="background:#d9ecff; color:#3B82F6; font-size:1.7rem;">
        <i class="fa-solid fa-user"></i>
      </div>
    </div>

  </div>
</nav>`;

const SITE_FOOTER_HTML = `
<footer class="footer-legourmet">
  <div class="container-fluid">
    <div class="row gy-4">

      <div class="col-12 col-md-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <img src="assets/images/logo_gourmet.jpeg" alt="Le Gourmet" class="footer-logo">
        </div>
        <p>Le Gourmet Restaurant vous propose une sélection raffinée de mets préparés avec passion.</p>
        <div class="social-icons">
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </div>

      <div class="col-6 col-md-4">
        <h5><i class="fa-solid fa-location-arrow"></i> A propos</h5>
        <a href="index.html">Menu</a>
        <a href="#">A propos</a>
        <a href="assistance.html">Assistance</a>
      </div>

      <div class="col-6 col-md-4">
        <h5><i class="fa-regular fa-user"></i> Contact</h5>
        <a href="#"><i class="fa-solid fa-location-dot me-2"></i>Calavi, Allègleta</a>
        <a href="tel:+2290100000"><i class="fa-solid fa-phone me-2"></i>+229 0100000000</a>
        <a href="mailto:gourmet@gmail.com"><i class="fa-solid fa-envelope me-2"></i>gourmet@gmail.com</a>
        <a href="#"><i class="fa-regular fa-clock me-2"></i>Heure d'ouverture :</a>
        <div class="ms-4">
          <div>Lun - ven : 10h00 - 23h00</div>
          <div>Sam - dim : 11h00 - 00h00</div>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      © 2026 Gourmet Restaurant. Tout droits réservés
    </div>
  </div>
</footer>

<nav class="mobile-bottom-nav d-flex">
  <a href="index.html" class="nav-item" data-page="index.html">
     <i class="bi bi-book"></i>Menu
  </a>
  <a href="panier-table.html" class="nav-item" data-page="panier-table.html">
    <i class="fa-solid fa-cart-shopping"></i>Commandes
  </a>
  <a href="assistance.html" class="nav-item" data-page="assistance.html">
    <i class="fa-regular fa-bell"></i>Assistance
  </a>
  <a href="contact.html" class="nav-item" data-page="contact.html">
    <i class="fa-solid fa-user"></i>Contacts
  </a>

</nav>`;

window.SITE_HEADER_HTML = SITE_HEADER_HTML;
window.SITE_FOOTER_HTML = SITE_FOOTER_HTML;

function syncHeaderHeight(){
  var header = document.querySelector('.navbar-legourmet');
  if(header){
    document.documentElement.style.setProperty('--header-h', header.offsetHeight + 'px');
  }
}
window.addEventListener('load', syncHeaderHeight);
window.addEventListener('resize', syncHeaderHeight);
document.addEventListener('DOMContentLoaded', syncHeaderHeight);
window.syncHeaderHeight = syncHeaderHeight; // rendue accessible depuis les pages



/* ===========================================================
   ⚠️ TEMPORAIRE — PHASE DE CONSTRUCTION UNIQUEMENT
   Bouton flottant pour réinitialiser panier + verrou de commande.
   À SUPPRIMER avant la mise en production.
=========================================================== */
(function addResetButton(){
  document.addEventListener('DOMContentLoaded', function(){
    var btn = document.createElement('button');
    btn.textContent = '🔄 Reset panier';
    btn.style.cssText = 'position:fixed;bottom:80px;right:12px;z-index:99999;background:#000;color:#fff;border:none;border-radius:20px;padding:8px 14px;font-size:.72rem;opacity:.75;cursor:pointer;font-family:sans-serif;';
    btn.addEventListener('click', function(){
      localStorage.removeItem('panier');
      localStorage.removeItem('orderLocked');
      location.reload();
    });
    document.body.appendChild(btn);
  });
})();


/* ===========================================================
   NOTIFICATION — nombre de plats distincts (hors quantité)
   après passage de commande. Affichée sur le bouton "Commander"
   (desktop) et la cloche (mobile), partout où le header est présent.
=========================================================== */
function updateOrderNotifBadge(){
  var locked = localStorage.getItem('orderLocked') === '1';
  var panier = [];
  try{ panier = JSON.parse(localStorage.getItem('panier') || '[]'); }catch(e){}
  var count = locked ? panier.length : 0;
  document.querySelectorAll('.notif-badge').forEach(function(el){
    el.textContent = count;
    el.style.display = count > 0 ? 'flex' : 'none';
  });
}
window.updateOrderNotifBadge = updateOrderNotifBadge;
window.addEventListener('load', updateOrderNotifBadge);
document.addEventListener('DOMContentLoaded', updateOrderNotifBadge);


/* ===========================================================
   COMMANDES / FACTURES — utilitaires partagés entre pages
=========================================================== */
function genererNumeroCommande(){
  var seq = parseInt(localStorage.getItem('commandeSeq') || '1057', 10) + 1;
  localStorage.setItem('commandeSeq', String(seq));
  return String(seq);
}
window.genererNumeroCommande = genererNumeroCommande;

function enregistrerFacture(order){
  var factures = [];
  try{ factures = JSON.parse(localStorage.getItem('factures') || '[]'); }catch(e){}
  factures.unshift(order);
  localStorage.setItem('factures', JSON.stringify(factures));
}
window.enregistrerFacture = enregistrerFacture;