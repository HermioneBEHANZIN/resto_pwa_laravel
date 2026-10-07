@extends('layouts.app')

@section('title', 'Le Gourmet - Contacts')

@push('styles')
<style>
:root {
  --bordeaux: #800020;
  --bordeaux-dark: #5e0017;
  --gold: #c9a24b;
  --pink-cream: #fbe4e8;
  --whatsapp-green: #25b346;
  --blue-info: #1a6fd1;
  --benin-green: #2e7d32;
  --benin-yellow: #fdd835;
  --benin-red: #c62828;
}

/* ---------- HERO ---------- */
.hero-contact {
  position: relative;
  min-height: 520px;
  background: linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.55)),
              url('https://images.unsplash.com/photo-1698605039943-2fa2f7d442ef?fm=jpg&q=70&w=1920&auto=format&fit=crop') center/cover no-repeat;
  display: flex;
  align-items: center;
}

.hero-contact .back-btn {
  position: absolute;
  top: 32px;
  left: 40px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--bordeaux);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  transition: background-color 0.2s ease;
}
.hero-contact .back-btn:hover { background: var(--bordeaux-dark); }

.hero-contact .hero-content {
  color: #fff;
  padding: 0 40px;
  max-width: 900px;
}

.hero-contact h1 {
  font-size: 5rem;
  font-weight: 700;
  letter-spacing: 2px;
}

.hero-contact p {
  font-size: 1.1rem;
  max-width: 700px;
}

/* ---------- FAITES NOUS PART DE VOS ENVIES ---------- */
.section-envies {
  background: var(--pink-cream);
  padding: 60px 20px;
  text-align: center;
}

.section-envies h2 {
  color: var(--bordeaux);
  font-size: 2rem;
  margin-bottom: 36px;
}

.phone-pill {
  background: #fff;
  border-radius: 40px;
  padding: 10px 24px;
  display: inline-flex;
  align-items: center;
  gap: 12px;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
}

.phone-pill .flag {
  width: 26px;
  height: 18px;
  border-radius: 3px;
  overflow: hidden;
  display: inline-flex;
  flex-shrink: 0;
}

.phone-pill .flag .g { width: 40%; height: 100%; background: var(--benin-green); }
.phone-pill .flag .yr { width: 60%; height: 100%; display: flex; flex-direction: column; }
.phone-pill .flag .yr .y { height: 50%; background: var(--benin-yellow); }
.phone-pill .flag .yr .r { height: 50%; background: var(--benin-red); }

.btn-whatsapp {
  background: var(--whatsapp-green);
  color: #fff;
  border-radius: 40px;
  padding: 12px 34px;
  font-weight: 600;
  border: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  transition: background-color 0.2s ease;
}
.btn-whatsapp:hover { background: #1e9438; color: #fff; }

/* ---------- MAP ---------- */
.section-map-header {
  padding: 18px 40px;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.section-map-header .map-title {
  color: var(--blue-info);
  font-weight: 600;
  font-family: 'Playfair Display', serif;
}

#map {
  width: 100%;
  height: 360px;
  background: #e9ebee;
  border: none;
}

/* ---------- HORAIRE ---------- */
.section-horaire {
  padding: 30px 40px 60px;
}

.section-horaire h3 {
  color: var(--blue-info);
  font-weight: 600;
  margin-bottom: 20px;
}

.section-horaire .horaire-row {
  display: flex;
  justify-content: space-between;
  max-width: 600px;
  font-weight: 600;
  margin-bottom: 10px;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 767.98px) {
  .hero-contact { min-height: 400px; }
  .hero-contact .back-btn { top: 20px; left: 16px; width: 40px; height: 40px; }
  .hero-contact .hero-content { padding: 0 20px; }
  .hero-contact h1 { font-size: 3rem; }
  .hero-contact p { font-size: .95rem; }

  .section-envies { padding: 40px 16px; }
  .section-envies h2 { font-size: 1.6rem; }
  .phone-pill { padding: 8px 14px; font-size: .82rem; gap: 8px; }
  .phone-pill .flag { width: 20px; height: 14px; }
  .btn-whatsapp { padding: 10px 18px; font-size: .9rem; white-space: nowrap; }

  .section-map-header { padding: 14px 20px; }
  #map { height: 260px; }

  .section-horaire { padding: 24px 20px 110px; }
}
</style>
@endpush

@section('content')
<!-- HERO -->
<header class="hero-contact">
  <button class="back-btn" onclick="history.back()" aria-label="Retour à la page précédente">
    <i class="fa-solid fa-arrow-left d-none d-md-inline"></i>
    <i class="fa-solid fa-chevron-left d-inline d-md-none"></i>
  </button>
  <div class="hero-content">
    <h1 class="d-none d-md-block">CONTACTS</h1>
    <h1 class="d-block d-md-none">CONTACT</h1>
    <p>Une question, une réservation ou une demande particulière ? Notre équipe est à votre écoute et se fera un plaisir de vous répondre.</p>
  </div>
</header>

<!-- FAITES-NOUS PART DE VOS ENVIES -->
<section class="section-envies">
  <h2>Faites-nous part de vos envies</h2>
  <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
    <div class="phone-pill">
      <span class="flag"><span class="g"></span><span class="yr"><span class="y"></span><span class="r"></span></span></span>
      +229 01 00 00 00 00
    </div>
    <a href="https://wa.me/2290100000000" target="_blank" rel="noopener noreferrer" class="btn-whatsapp">
      <i class="fa-brands fa-whatsapp fa-lg"></i> Contacter
    </a>
  </div>
</section>

<!-- LOCALISATION / CARTE -->
<section class="section-map">
  <div class="section-map-header">
    <span class="map-title"><i class="fa-solid fa-map-location-dot me-2"></i>Localisation du siège</span>
    <span class="text-muted">Calavi, Bénin</span>
  </div>
  <div id="map"></div>
</section>

<!-- HORAIRE D'OUVERTURE -->
<section class="section-horaire">
  <h3>Horaire d'ouverture</h3>
  <div class="horaire-row">
    <span>Lundi - vendredi</span>
    <span>10H00 - 23H00</span>
  </div>
  <div class="horaire-row">
    <span>Samedi - Dimanche</span>
    <span>11H00 - 00H00</span>
  </div>
</section>
@endsection

@push('scripts')
<script>
  function initMap() {
    const siege = { lat: 6.454383, lng: 2.353946 }; 
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: siege,
    });
    new google.maps.Marker({ position: siege, map: map, title: "Le Gourmet - Siège" });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
@endpush