@extends('layouts.app')

@section('title', 'Le Gourmet — Membres de la table')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --gold:#C9952A;
  --gold-lt:#E8B84B;
  --cream:#FBF8F3;
  --cream2:#F4EFE6;
  --text:#2C2C2A;
  --muted:#8A857B;
  --border:#EDE7DA;
  --wine:#7B1C2A;
  --wine-dark:#5C1320;
  --wine-light:#9B2335;
}

.serif{font-family:'Playfair Display',serif;}

/* ===== PAGE HERO ===== */
.page-hero{
  background:linear-gradient(135deg,var(--wine-dark) 0%,var(--wine) 55%,var(--wine-light) 100%);
  padding:48px 0 70px;
  position:relative;
  overflow:hidden;
}
.page-hero::before{content:'';position:absolute;top:-80px;right:-60px;width:320px;height:320px;background:rgba(255,255,255,.05);border-radius:50%;}
.page-hero::after{content:'';position:absolute;bottom:-60px;left:5%;width:260px;height:260px;background:rgba(245,200,66,.07);border-radius:50%;}
.page-hero-eyebrow{font-size:.72rem;font-weight:800;letter-spacing:4px;text-transform:uppercase;color:var(--gold-lt);margin-bottom:10px;display:flex;align-items:center;gap:8px;}
.page-hero-eyebrow::before{content:'';display:inline-block;width:20px;height:2px;background:var(--gold-lt);}
.page-hero h1{font-family:'Playfair Display',serif;font-size:2.4rem;font-weight:700;color:#fff;line-height:1.2;margin-bottom:10px;}
.page-hero h1 span{color:var(--gold-lt);}
.page-hero p{color:rgba(255,255,255,.6);font-size:.88rem;line-height:1.8;}
.hero-stat-pill{
  display:inline-flex;align-items:center;gap:10px;
  background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.18);
  border-radius:50px;padding:10px 20px;
  color:#fff;font-size:.82rem;font-weight:600;
  backdrop-filter:blur(8px);
  margin-top:24px;
}
.hero-stat-pill i{color:var(--gold-lt);font-size:1rem;}

/* ===== AVATARS DE LA TABLE ===== */
.table-avatar-badge {
  width:42px;
  height:42px;
  border-radius:50%;
  background:#fff;
  border:2px solid var(--border);
  display:flex;
  align-items:center;
  justify-content:center;
  color:var(--wine);
  font-size:1.1rem;
  box-shadow:0 2px 8px rgba(0,0,0,.08);
}

/* ===== CARD CONTAINER ===== */
.main-card{
  background:#fff;
  border-radius:24px;
  border:1px solid var(--border);
  box-shadow:0 8px 40px rgba(0,0,0,.06);
  overflow:hidden;
  position:relative;
  z-index:2;
}
.main-card-header{
  background:linear-gradient(135deg,var(--wine) 0%,var(--wine-dark) 100%);
  padding:20px 28px;
  display:flex;align-items:center;justify-content:space-between;
}
.main-card-header h2{
  font-family:'Playfair Display',serif;font-size:1.1rem;color:#fff;margin:0;
}
.main-card-header .table-badge{
  background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);
  color:#fff;font-size:.72rem;font-weight:700;padding:5px 14px;border-radius:20px;
  letter-spacing:.5px;
}

/* ===== MEMBER ROW ===== */
.member-list{padding:0 8px;}
.member-row{
  display:flex;align-items:center;gap:16px;
  padding:18px 20px;
  border-bottom:1px solid var(--border);
  transition:.2s;
  position:relative;
}
.member-row:last-child{border-bottom:none;}
.member-row:hover{background:rgba(123,28,42,.03);}
.member-name{font-weight:700;font-size:.92rem;color:var(--text);margin-bottom:3px;}
.role-badge{
  display:inline-flex;align-items:center;gap:4px;
  font-size:.66rem;font-weight:700;
  padding:3px 10px;border-radius:20px;
  letter-spacing:.3px;
}
.role-badge.creator{background:rgba(201,149,42,.12);color:var(--gold);border:1px solid rgba(201,149,42,.25);}
.role-badge.member{background:rgba(123,28,42,.08);color:var(--wine);border:1px solid rgba(123,28,42,.18);}
.btn-remove{
  margin-left:auto;
  background:#fff;
  border:1.5px solid #E24B4A;
  color:#E24B4A;
  font-size:.76rem;font-weight:700;
  padding:7px 18px;border-radius:10px;
  cursor:pointer;transition:.2s;
  flex-shrink:0;
}
.btn-remove:hover{background:#E24B4A;color:#fff;box-shadow:0 4px 14px rgba(226,75,74,.3);}

/* ===== INVITE SECTION ===== */
.invite-section{
  padding:28px;
  background:var(--cream);
  border-top:2px solid var(--border);
}
.invite-title{
  display:flex;align-items:center;gap:12px;
  font-weight:700;font-size:.95rem;color:var(--text);
  margin-bottom:6px;
}
.invite-title .icon-wrap{
  width:38px;height:38px;border-radius:12px;
  background:linear-gradient(135deg,var(--wine),var(--wine-light));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:.95rem;
  flex-shrink:0;
}
.invite-desc{font-size:.8rem;color:var(--muted);line-height:1.6;margin-bottom:20px;padding-left:50px;}
.code-display{
  display:flex;align-items:center;justify-content:space-between;
  background:#fff;
  border:2px solid var(--border);
  border-radius:16px;
  padding:16px 22px;
  gap:16px;
  transition:.2s;
}
.code-display:hover{border-color:var(--wine);}
.code-text{
  font-family:'Playfair Display',serif;
  font-size:2rem;font-weight:700;
  color:var(--text);
  letter-spacing:6px;
}
.btn-copy{
  background:linear-gradient(135deg,var(--wine),var(--wine-light));
  border:none;color:#fff;
  width:44px;height:44px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;cursor:pointer;transition:.2s;
  flex-shrink:0;
}
.btn-copy:hover{opacity:.88;transform:scale(1.05);box-shadow:0 6px 18px rgba(123,28,42,.3);}

/* ===== ADD MEMBER BTN ===== */
.btn-add-member{
  width:100%;
  background:linear-gradient(135deg,var(--wine),var(--wine-light));
  color:#fff;font-weight:700;border:none;
  border-radius:14px;padding:15px 20px;
  display:flex;align-items:center;justify-content:center;gap:10px;
  font-size:.9rem;cursor:pointer;transition:.2s;
  box-shadow:0 6px 20px rgba(123,28,42,.25);
  margin-top:16px;
}
.btn-add-member:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(123,28,42,.35);opacity:.95;}

/* ===== STATS ROW ===== */
.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:28px;}
.stat-card{
  background:#fff;border-radius:16px;border:1px solid var(--border);
  padding:16px;text-align:center;
  box-shadow:0 2px 12px rgba(0,0,0,.04);
}
.stat-card .val{font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:var(--wine);}
.stat-card .lbl{font-size:.68rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;}
.stat-card .ico{font-size:1.2rem;margin-bottom:6px;color:var(--gold);}

/* ===== TOAST ===== */
#toast{position:fixed;bottom:90px;left:50%;transform:translateX(-50%);background:#2C2C2A;color:#fff;padding:12px 22px;border-radius:40px;font-size:.84rem;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,.2);transition:opacity .3s;opacity:0;pointer-events:none;}

@media(max-width:991px){
  .page-hero{padding:36px 0 56px;}
  .page-hero h1{font-size:1.8rem;}
  .stats-row{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:576px){
  .page-hero h1{font-size:1.5rem;}
  .main-card-header{padding:16px 20px;}
  .member-row{padding:14px 16px;}
  .invite-section{padding:20px;}
  .code-text{font-size:1.6rem;letter-spacing:4px;}
}
</style>
@endpush

@section('content')
<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
  <div class="container" style="position:relative;z-index:2;">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="page-hero-eyebrow"><span>Gestion de table</span></div>
        <h1>Membres de la <span>Table 15</span></h1>
        <p>Invitez vos convives et gérez ensemble votre expérience gastronomique en temps réel.</p>
        <div class="hero-stat-pill">
          <i class="bi bi-people-fill"></i>
          <span>4 personnes connectées · Table active</span>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1 mt-4 mt-lg-0 d-none d-lg-block text-end">
        <div style="display:inline-flex;align-items:center;gap:6px;">
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<main class="py-4">
  <div class="container" style="max-width:680px;">

    <!-- Stats -->
    <div class="stats-row mb-4">
      <div class="stat-card">
        <div class="ico"><i class="fa-solid fa-users"></i></div>
        <div class="val">4</div>
        <div class="lbl">Membres</div>
      </div>
      <div class="stat-card">
        <div class="ico"><i class="fa-solid fa-receipt"></i></div>
        <div class="val">3</div>
        <div class="lbl">Commandes</div>
      </div>
      <div class="stat-card">
        <div class="ico"><i class="fa-solid fa-chair"></i></div>
        <div class="val">15</div>
        <div class="lbl">Table</div>
      </div>
    </div>

    <!-- Members card -->
    <div class="main-card mb-4">
      <div class="main-card-header">
        <h2><i class="bi bi-people-fill me-2"></i>Liste des membres</h2>
        <span class="table-badge">Table 15</span>
      </div>

      <div class="member-list">
        <div class="member-row">
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="member-name">Ahmed</div>
            <span class="role-badge creator"><i class="fa-solid fa-crown fa-xs"></i> Créateur</span>
          </div>
          <button type="button" class="btn-remove js-btn-creator">Retirer</button>
        </div>
        <div class="member-row">
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="member-name">Marie</div>
            <span class="role-badge member"><i class="fa-solid fa-user fa-xs"></i> Membre</span>
          </div>
          <button type="button" class="btn-remove js-btn-remove" data-name="Marie">Retirer</button>
        </div>
        <div class="member-row">
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="member-name">Jean</div>
            <span class="role-badge member"><i class="fa-solid fa-user fa-xs"></i> Membre</span>
          </div>
          <button type="button" class="btn-remove js-btn-remove" data-name="Jean">Retirer</button>
        </div>
        <div class="member-row">
          <div class="table-avatar-badge"><i class="bi bi-person-fill"></i></div>
          <div>
            <div class="member-name">Sophie</div>
            <span class="role-badge member"><i class="fa-solid fa-user fa-xs"></i> Membre</span>
          </div>
          <button type="button" class="btn-remove js-btn-remove" data-name="Sophie">Retirer</button>
        </div>
      </div>

      <!-- Invite section -->
      <div class="invite-section">
        <div class="invite-title">
          <div class="icon-wrap"><i class="bi bi-person-plus-fill"></i></div>
          <span>Inviter avec un code</span>
        </div>
        <p class="invite-desc">Partagez ce code à vos convives pour qu'ils rejoignent la table et commandent ensemble.</p>

        <div class="code-display">
          <div class="code-text" id="inviteCodeText">M7K9</div>
          <button type="button" class="btn-copy" id="btnCopyCode" title="Copier le code">
            <i class="bi bi-clipboard2"></i>
          </button>
        </div>

        <button type="button" class="btn-add-member" id="btnShareInvite">
          <i class="bi bi-share-fill"></i>
          Partager l'invitation
        </button>
      </div>
    </div>

  </div>
</main>

<div id="toast"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  function showToast(msg) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg; 
    t.style.opacity = 1;
    clearTimeout(t._timer);
    t._timer = setTimeout(() => t.style.opacity = 0, 2800);
  }

  function copyCode() {
    const codeText = document.getElementById('inviteCodeText')?.textContent.trim() || 'M7K9';
    if (navigator.clipboard) {
      navigator.clipboard.writeText(codeText).catch(() => {});
    }
    showToast('Code ' + codeText + ' copié dans le presse-papiers !');
  }

  function removeMember(btn, name) {
    const row = btn.closest('.member-row');
    if (!row) return;
    row.style.opacity = '0.4';
    row.style.transform = 'translateX(20px)';
    row.style.transition = 'all .35s ease';
    setTimeout(() => {
      row.remove();
      showToast(name + ' a été retiré(e) de la table.');
    }, 350);
  }

  // Événements
  const btnCopyCode = document.getElementById('btnCopyCode');
  if (btnCopyCode) {
    btnCopyCode.addEventListener('click', copyCode);
  }

  const btnShareInvite = document.getElementById('btnShareInvite');
  if (btnShareInvite) {
    btnShareInvite.addEventListener('click', function() {
      showToast('Lien d\'invitation copié dans le presse-papiers !');
    });
  }

  const btnCreator = document.querySelector('.js-btn-creator');
  if (btnCreator) {
    btnCreator.addEventListener('click', function() {
      showToast('Ahmed ne peut pas être retiré (créateur)');
    });
  }

  document.querySelectorAll('.js-btn-remove').forEach(btn => {
    btn.addEventListener('click', function() {
      const name = this.getAttribute('data-name');
      removeMember(this, name);
    });
  });
});
</script>
@endpush