/* =========================================================================
   HEADER + SIDEBAR — composant JS partagé
   Référence : dashboard.html
   Génère EXACTEMENT le même HTML sur toutes les pages (logo, menu, header).
   Ne jamais recopier ce HTML directement dans une page.
========================================================================= */

/* ---- Liste des liens du menu (source unique de vérité) ----
   "key" doit correspondre à l'attribut data-page="..." posé sur <body>
   de chaque page pour activer automatiquement le bon lien. */
const HS_MENU_LINKS = [
  { key:'dashboard', label:'Dashboard', href:'dashboard.html',
    svg:'<rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="8" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/><rect x="13" y="13" width="8" height="8" rx="1.5"/>' },
  { key:'salle', label:'Plan de salle', href:'plan-de-salle.html',
    svg:'<path d="M12 3v18M5 8h14M5 8a2 2 0 0 1-2-2V4a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v2a2 2 0 0 1-2 2"/>' },
  { key:'menus', label:'Gestion des menus', href:'gestion-menus.html',
    svg:'<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v5"/>' },
  { key:'commandes', label:'Commandes', href:'creation-commande.html',
    svg:'<path d="M4 7h16l-1.5 12.5a2 2 0 0 1-2 1.5H7.5a2 2 0 0 1-2-1.5L4 7z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/>' },
  { key:'paiements', label:'Paiements', href:'paiements.html',
    svg:'<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>' },
  { key:'stats', label:'Statistiques', href:'statistiques.html',
    svg:'<path d="M4 19V5M4 19h16M8 19v-6M13 19V9M18 19v-9"/>' },
  { key:'users', label:'Utilisateurs', href:'utilisateurs.html',
    svg:'<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17.5" cy="9.5" r="2.4"/><path d="M15.5 14a5 5 0 0 1 5.5 5"/>' },
  { key:'params', label:'Paramètres', href:'parametres.html',
    svg:'<circle cx="12" cy="12" r="3"/><path d="M19.4 13.5a1.7 1.7 0 0 0 .34 1.87l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.87-.34 1.7 1.7 0 0 0-1 1.56V19a2 2 0 1 1-4 0v-.09a1.7 1.7 0 0 0-1-1.56 1.7 1.7 0 0 0-1.87.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.7 1.7 0 0 0 .34-1.87 1.7 1.7 0 0 0-1.56-1H4a2 2 0 1 1 0-4h.09a1.7 1.7 0 0 0 1.56-1 1.7 1.7 0 0 0-.34-1.87l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.7 1.7 0 0 0 1.87.34H10a1.7 1.7 0 0 0 1-1.56V4a2 2 0 1 1 4 0v.09a1.7 1.7 0 0 0 1 1.56 1.7 1.7 0 0 0 1.87-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.7 1.7 0 0 0-.34 1.87V10a1.7 1.7 0 0 0 1.56 1H20a2 2 0 1 1 0 4h-.09a1.7 1.7 0 0 0-1.56 1z"/>' },
];

/* ---- Chemins des logos (identiques partout, ne jamais dupliquer/redimensionner) ---- */
const HS_LOGO_SIDEBAR = 'assets/images/logo_gourmet_rouge.jpeg';
const HS_LOGO_MOBILE  = 'assets/images/logo_gourmet.jpeg';

/* ---- Identité de l'utilisateur connecté (à terme : injectée depuis le backend) ---- */
const HS_CURRENT_USER = {
  nom: 'Sarah Duchesse',
  role: 'Gérante principale',
  avatar: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50'><rect width='50' height='50' fill='%23D9A7A0'/><circle cx='25' cy='19' r='9' fill='%23fff'/><circle cx='25' cy='52' r='18' fill='%23fff'/></svg>"
};

function hsBuildMenuHTML(activeKey, itemClass, closeAttr){
  return HS_MENU_LINKS.map(l => `
    <a class="${itemClass}${l.key===activeKey ? ' active' : ''}" href="${l.href}" ${closeAttr||''}>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">${l.svg}</svg>
      <span>${l.label}</span>
    </a>`).join('');
}

function hsBuildHTML(activeKey){
  const showLogout = activeKey === 'dashboard';
  const logoutMobileHTML = showLogout ? `
      <a class="mobile-drawer-item mobile-drawer-logout" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        <span>Déconnexion</span>
      </a>` : '';
  const logoutDesktopHTML = showLogout ? `
    <div class="logout-wrap">
      <a class="menu-item" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        <span>Déconnexion</span>
      </a>
    </div>` : '';
  return `
  <!-- ================= MOBILE HEADER ================= -->
  <header class="mobile-header">
    <div class="mobile-logo"><img src="${HS_LOGO_MOBILE}" alt="Le Gourmet Restaurant"></div>
    <div class="mobile-search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      <input type="text" placeholder="Recherche...">
    </div>
    <button class="mobile-icon-btn" aria-label="Notifications">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
      <span class="mobile-notif-dot"></span>
    </button>
    <button class="mobile-icon-btn mobile-menu-toggle" id="hsMobileMenuToggle" aria-label="Menu">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    </button>
  </header>

  <!-- ================= MOBILE DRAWER ================= -->
  <div class="mobile-drawer-overlay" id="hsMobileDrawerOverlay"></div>
  <aside class="mobile-drawer" id="hsMobileDrawer">
    <div class="mobile-drawer-head">
      <div class="mobile-drawer-logo">
        <img src="${HS_LOGO_MOBILE}" alt="Le Gourmet Restaurant">
        <span>Le Gourmet</span>
      </div>
      <button class="mobile-drawer-close" id="hsMobileDrawerClose" aria-label="Fermer">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>
   <nav class="mobile-drawer-menu">
      ${hsBuildMenuHTML(activeKey, 'mobile-drawer-item')}
      ${logoutMobileHTML}
    </nav>
  </aside>

  <!-- ================= SIDEBAR (desktop) ================= -->
  <aside class="sidebar">
    <div class="logo-wrap">
      <div class="logo-circle"><img src="${HS_LOGO_SIDEBAR}" alt="Le Gourmet Restaurant"></div>
    </div>
   <nav class="menu">
      ${hsBuildMenuHTML(activeKey, 'menu-item')}
    </nav>
    ${logoutDesktopHTML}
  </aside>

  <!-- ================= HEADER (desktop) ================= -->
  <header class="top">
    <div class="title-role">${HS_CURRENT_USER.role}</div>
    <div class="search-bar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      <input type="text" placeholder="Recherche...">
    </div>
    <div class="header-right">
      <div class="notif-circle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
        <span class="notif-dot"></span>
      </div>
      <div class="divider-v"></div>
      <div class="user-name">${HS_CURRENT_USER.nom}</div>
      <img class="avatar" alt="${HS_CURRENT_USER.nom}" src="${HS_CURRENT_USER.avatar}">
    </div>
  </header>`;
}

/* ---- Initialisation : à appeler une seule fois, en bas de chaque page ----
   Lit data-page sur <body> pour savoir quel lien mettre en surbrillance. */
function initHeaderSidebar(){
  const mount = document.getElementById('hsMount');
  if(!mount){
    console.error('header-sidebar.js : élément #hsMount introuvable dans la page.');
    return;
  }
  const activeKey = document.body.dataset.page || '';
  mount.outerHTML = hsBuildHTML(activeKey);

  const drawer   = document.getElementById('hsMobileDrawer');
  const overlay  = document.getElementById('hsMobileDrawerOverlay');
  const toggle   = document.getElementById('hsMobileMenuToggle');
  const close    = document.getElementById('hsMobileDrawerClose');

  const open  = () => { drawer.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow = 'hidden'; };
  const shut  = () => { drawer.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow = ''; };

  toggle?.addEventListener('click', open);
  close?.addEventListener('click', shut);
  overlay?.addEventListener('click', shut);
}

document.addEventListener('DOMContentLoaded', initHeaderSidebar);
