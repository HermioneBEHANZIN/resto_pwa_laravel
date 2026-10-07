@extends('layouts.app')

@section('title', 'Le Gourmet — Menu')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
  --bg-pink:#F9DDE2;
  --gold:#C9952A;
  --gold-lt:#E8B84B;
  --cream:#FBF5F0;
  --cream2:#F4EDE4;
  --text:#2C2018;
  --muted:#9A8E83;
  --border:#EDE0D0;
  --wine:#7B1C2A;
  --wine-dark:#5A1320;
  --wine-light:#9B2335;
  --pink-bg:#FDE8E8;
  --hero-pink:#FFE6EA;
  --bordeaux: #800020;
  --bordeaux-dark: #5e0017;
}

*{box-sizing:border-box;margin:0;padding:0;}
html{overflow-x:hidden;}
body{font-family:'Poppins',sans-serif;color:var(--text); background:var(--bg-pink);}
h1,h2,h3,.serif{font-family:'Playfair Display',serif;}

::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px;}

.order-item-del:disabled, .order-item-qty-ctrl button:disabled{ opacity:.3; cursor:not-allowed; }

/* PAGE SWITCH */
.page-mobile{display:block;}
.page-desktop{display:none;}
@media(min-width:992px){
  .page-mobile{display:none!important;}
  .page-desktop{display:block!important;}
}

/* SHARED ATOMS */
.brand-logo-wrap{
  width:52px;height:52px;border-radius:50%;
  border:2px solid var(--wine);
  display:flex;align-items:center;justify-content:center;
  overflow:hidden;background:#fff;flex-shrink:0;
}
.brand-logo-wrap img{width:100%;height:100%;object-fit:cover;}
.brand-logo-icon{font-size:1.4rem;color:var(--wine);}
.brand-name{font-family:'Playfair Display',serif;font-weight:700;font-size:1.1rem;color:var(--text);line-height:1.1;}
.brand-sub{font-size:.58rem;color:var(--gold);letter-spacing:3px;text-transform:uppercase;}

.btn-wine{
  background:linear-gradient(135deg,var(--wine-dark),var(--wine-light));
  color:#fff;font-weight:700;border:none;border-radius:12px;
  padding:11px 26px;text-decoration:none;
  display:inline-flex;align-items:center;gap:8px;
  transition:.2s;font-size:.88rem;
}
.btn-wine:hover{opacity:.9;color:#fff;transform:translateY(-1px);box-shadow:0 8px 22px rgba(123,28,42,.35);}

.cart-badge-pill{
  position:absolute;top:-7px;right:-7px;
  background:#E24B4A;color:#fff;font-size:.6rem;font-weight:800;
  width:18px;height:18px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;border:2px solid #fff;
}

/* TABLE INFO BANNER */
.table-info-banner{
  background: linear-gradient(135deg, #2B1714 0%, #5C1322 55%, #842238 100%);
  border-radius:20px;
  padding:0px 0px;
  min-height:10px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  overflow:hidden;
  position:relative;
  box-shadow: 0 22px 50px rgba(123,28,42,.30);
}
.table-info-banner::before{content:'';position:absolute;top:-20px;right:-20px;width:200px;height:200px;background:rgba(255,255,255,.04);border-radius:50%;}
.table-info-banner::after{content:'';position:absolute;bottom:-40px;left:20%;width:150px;height:150px;background:rgba(245,200,66,.06);border-radius:50%;}
.table-info-left{position:relative;z-index:2;margin: 0%;}
.table-info-welcome{font-size:.70rem;font-weight:990;color:#fff;letter-spacing:2.5px;text-transform:uppercase;margin-bottom:5px;}
.table-info-number{font-size:2.25rem;margin-top:8px;margin-bottom:8px;font-family:'Playfair Display',serif;font-weight:700;color:#fff;line-height:1;}
.table-info-sub{ font-size:.60rem;color:rgba(255,255,255,.6);font-weight:500;}
.table-info-right{display:flex;align-items:center;gap:4px;position:relative;z-index:2;flex-shrink:0;margin: 0%;}

.t-avatar{
  width:28px;height:28px;border-radius:50%;
  background:#fff;
  border:2px solid rgba(255,255,255,.35);
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1.25rem;margin-left:-17px;
}
.t-avatar:first-child{margin-left:0;}
.t-avatar-extra{
  background:#fff;border-color:#fff;
  font-size:.80rem;font-weight:800;
  text-decoration:none;color:#1B1B1B!important;transition:.2s;
}
.t-avatar-extra:hover{transform:scale(1.1);}
.t-avatar:nth-child(1){background:#fff;color:#3B82F6;}
.t-avatar:nth-child(2){background:#fff;color:#22C55E;}
.t-avatar:nth-child(3){background:#fff;color:#F4A623;}

/* SEARCH */
.search-wrap{position:relative;}
.search-wrap .s-icon{position:absolute;left:24px;top:50%;transform:translateY(-50%);color:#2C2018;font-size:1.2rem;}
.search-bar{
  width:100%;
  height:62px;
  border-radius:50px;
  border:2px solid #EFE4D8;
  background:#fff;
  font-size:.95rem;
  padding-left:62px;
  transition:.25s;
  box-shadow:0 5px 15px rgba(0,0,0,.03);
}
.search-bar:focus{
  outline:none;
  border-color:var(--wine);
  box-shadow: 0 0 0 5px rgba(123,28,42,.08);
}
.search-bar::placeholder{color:var(--muted);font-size:.85rem;}

/* CATEGORY CHIPS */
.chips-row{
  display:flex;
  gap:16px;
  overflow-x:auto;
  padding:4px 12px 10px;
  justify-content:flex-start;
  scrollbar-width:none;
  -webkit-overflow-scrolling:touch;
  scroll-snap-type:x proximity;
  margin-left: 20px;
}
.chips-row::-webkit-scrollbar{display:none;}
.chip{
  display:flex;flex-direction:column;align-items:center;gap:12px;
  background:white;border:none;padding:6px;cursor:pointer;transition:.25s;
  flex-shrink:1;min-width:0;font-family:'Poppins',sans-serif; border-radius:45%;
}
.chip-img-wrap{
  width:clamp(72px, 9vw, 108px);
  height:clamp(72px, 9vw, 108px);
  border-radius:50%;
  overflow:hidden;
  background:white;
  box-shadow: 0 12px 30px rgba(0,0,0,.18);
  transition:.25s;
}
.chip-img-wrap img{
  width:100%;height:100%;object-fit:cover;border-radius:50%;
  filter:saturate(1.25) contrast(1.08) brightness(1.02);
}
.chip:hover .chip-img-wrap{ transform:translateY(-5px); }
.chip span{
  margin-top:10px;
  font-size:.80rem;
  font-weight:700;
  color:var(--text);
  transition:.2s;
  text-align:center;
  line-height:1.25;
}
.chip.active span{color:var(--wine);}
.chip.active .chip-img-wrap{box-shadow:0 0 0 2px var(--wine);}

.m-cat-strip .chip{
  background:#fff;
  flex-shrink:0;
  min-width:92px;
  border-radius:999px;
  padding:10px 8px 12px;
  box-shadow:0 10px 24px rgba(0,0,0,.20);
  scroll-snap-align:start;
}
.m-cat-strip .chip span{color:var(--text);font-size:.82rem;}
.m-cat-strip .chip.active span{color:var(--gold);}
.m-cat-strip .chip-img-wrap{border:none;background:var(--cream2);box-shadow:none;width:76px;height:76px;}
.m-cat-strip .chip.active .chip-img-wrap{box-shadow:0 0 0 2px var(--wine);}

/* SECTION HEADER */
.section-bar{
  display:flex;align-items:center;gap:14px;
  padding-bottom:14px;
}
.section-bar-accent{width:5px;height:36px;background:var(--wine);border-radius:4px;flex-shrink:0;}
.section-title{font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:var(--wine);}
.section-count{font-size:.78rem;color:var(--muted);font-weight:500;margin-left:auto;}

/* SUBCATEGORY CARDS */
.subcat-row{
  display:flex;gap:14px;overflow-x:auto;padding:4px 2px 16px;scrollbar-width:none;position:relative;
}
.subcat-row::-webkit-scrollbar{display:none;}
.subcat-card{
  width:190px;
  min-width:190px;
  max-width:190px;
  height:190px;
  display:flex;
  flex-direction:column;
  border-radius:10px;
  overflow:hidden;
  background:white;
  box-shadow:0 15px 35px rgba(0,0,0,.08);
  transition:.30s;
  cursor:pointer;
  flex-shrink:0;
}
.subcat-card img{
  width:100%;
  height:125px;
  object-fit:cover;
  display:block;
  background:var(--cream2);
  filter:saturate(1.25) contrast(1.08) brightness(1.02);
  margin-top:8px;
  padding-left:8px;
  padding-right:8px;
  border-radius:15px;
  box-sizing:border-box;
}
.subcat-card-label{
  flex:1;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:12px 6px;
  font-size:1.05rem;
  font-weight:800;
  font-family:'Playfair Display',serif;
  color:var(--text);
  line-height:1.15;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

@media (max-width:991.98px){
  .subcat-card{
    width:100px;
    min-width:100px;
    max-width:100px;
    height:150px;
  }
  .subcat-card img{
    height:100px;
  }
  .subcat-card-label{
    font-size:0.9rem;
    padding:4px 4px;
  }
}
.subcat-card.active{border:2px solid var(--wine);}
.subcat-card.active .subcat-card-label{color:var(--wine);}

.m-chips-wrap{position:relative;}

/* FOOD ITEM CARDS */
.menu-card{
  background:white;
  border-radius:24px;
  padding:18px;
  display:flex;
  align-items:center;
  gap:20px;
  position:relative;
  margin-bottom:42px;
  cursor:pointer;
  transition:.28s;
  box-shadow: 0 10px 35px rgba(0,0,0,.05);
}
.menu-card:hover{
  transform:translateY(-4px);
}
.menu-card-img-wrap{
  width:86px;
  height:86px;
  border-radius:50%;
  overflow:hidden;
  flex-shrink:0;
  background:var(--cream2);
}
.menu-card-img{width:100%;height:100%;object-fit:cover;display:block;}
.menu-card-body{flex:1;min-width:0;}
.menu-card-name{
  font-size:1.40rem;
  font-family:'Playfair Display',serif;
  font-weight:700;
}
.menu-card-stars{
  margin-top:-5px;
  font-size:1.2rem;
  color: #F26522;
  margin-bottom: 20px;
}
.menu-card-price{
  position:absolute;
  bottom:-18px;
  left:118px;
  background:var(--wine);
  color:white;
  padding:8px 24px;
  border-radius:40px;
  font-size:1.10rem;
  font-family:'Playfair Display',serif;
  box-shadow:0 12px 25px rgba(123,28,42,.30);
}

/* MOBILE PAGE STYLING */
.m-shell{width:100%;max-width:991px;margin:0 auto; background:var(--bg-pink);min-height:100vh;padding-bottom:78px;position:relative;}
.m-header{
  display:flex;align-items:center;justify-content:space-between;
  background:#fff;padding:14px 18px;
}
.m-cart-btn{position:relative;width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--text);font-size:1.2rem;text-decoration:none;}
.m-cart-badge{position:absolute;top:-3px;right:-3px;background:#E24B4A;color:#fff;font-size:.58rem;font-weight:800;width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
.m-body{padding:0 18px;}
.m-table-banner{padding:22px 24px;margin:6px 0 18px;}
.m-table-banner .table-info-number{font-size:1.5rem;}
.m-search-wrap{margin-bottom:18px;}
.m-cat-strip{
  position:relative;
  overflow:hidden;
  margin:0 calc(50% - 50vw) 18px;
  width:100vw;
  padding:26px 0 22px;
  background: linear-gradient(rgba(20,10,8,.65),rgba(20,10,8,.65)), url('figma/bg_categories.jpeg') center center/cover;
}
.m-cat-title{font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:800;color:#fff;text-align:center;margin-bottom:4px;}
.m-cat-line{width:90px;height:5px;background:orangered;margin:0 auto 18px;border-radius:2px;}
.m-section-title{font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:700;color:var(--wine);border-left:5px solid var(--wine);padding-left:14px;margin:8px 0 16px;}

/* DESKTOP STYLING */
.d-navbar{
  background:#ffffff;
  position:sticky;
  top:0;
  z-index:5000;
  padding:18px 0;
  border-bottom:1px solid #F3E9DF;
  box-shadow:0 10px 25px rgba(0,0,0,.04);
}
.d-navbar .d-wrap{ max-width:1500px; }
.d-nav-link{
  color:#7c7068;
  font-size:.97rem;
  font-weight:600;
  padding:12px 18px;
  border-radius:12px;
  transition:.25s;
  text-decoration:none;
}
.d-nav-link:hover, .d-nav-link.active{
  color:var(--wine);
  background:#FFF5F5;
  font-weight:700;
}
.d-wrap{max-width:1440px;margin:0 auto;padding:24px 40px;}
.d-table-banner{padding:24px 32px;margin-bottom:22px;}
.d-table-banner .table-info-number{font-size:1.9rem;}
.d-search-wrap{max-width:100%;margin-bottom:30px;}

.d-cat-strip{
  position:relative;
  overflow:hidden;
  border-radius:0;
  padding:48px;
  margin:0 calc(50% - 50vw) 40px;
  width:100vw;
  background: linear-gradient(rgba(20,10,8,.65), rgba(20,10,8,.65)), url('figma/bg_categories.jpeg') center center/cover;
  filter: brightness(1.2);
  box-shadow: 0 20px 45px rgba(0,0,0,.15);
}
.d-cat-title{
  font-size:2.7rem;
  color: #fff;
  font-weight:800;
  text-align:center;
  margin-bottom:8px;
}
.d-cat-line{width:120px;height:3px;background:orangered;margin:0 auto 26px;border-radius:2px;}
.d-cat-strip .chips-row{
  justify-content:center;
  overflow-x:visible;
  margin:0 40px;
  padding:42px 24px;
}
.d-cat-strip .chip{
  background:#fff;
  border-radius:999px;
  padding:8px 10px 10px;
  box-shadow:0 10px 24px rgba(0,0,0,.20);
}
.d-cat-strip .chip span{color:var(--text);}
.d-cat-strip .chip.active span{color:var(--gold);}
.d-cat-strip .chip-img-wrap{border:none;background:var(--cream2);box-shadow:none;width:100px;height:100px;border-radius:50%;}
.d-cat-strip .chip.active .chip-img-wrap{box-shadow:0 0 0 3px var(--wine);}

.d-main-layout{
  display:grid;
  grid-template-columns:minmax(0,57%) minmax(470px,43%);
  gap:55px;
  align-items:start;
}
.d-menu-col{ min-width:0; width:100%; }
.d-order-col{ width:100%; max-width:none; }

/* ORDER PANEL */
.order-panel{
  background:#fff;
  border-radius:28px;
  padding:0;
  overflow:hidden;
  border:1px solid rgba(0,0,0,.05);
  box-shadow: 0 18px 50px rgba(0,0,0,.08), 0 3px 10px rgba(0,0,0,.04);
  position:sticky;
  top:95px;
}
.order-panel-header{
  padding:30px;
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  border-bottom:1px solid #f2ece6;
}
.order-avatars{display:flex;align-items:center;gap:0;flex-shrink:0;}
.o-avatar{
  width:34px;height:34px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.3rem;margin-left:-10px;
  border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.12);
}
.o-avatar:first-child{margin-left:0;}
.o-avatar:nth-child(1){background:#fff;color:#3B82F6;}
.o-avatar:nth-child(2){background:#fff;color:#22C55E;}
.o-avatar:nth-child(3){background:#fff;color:#F4A623;}
.o-avatar-extra{ background:#fff;color:#1B1B1B;font-size:.99rem;font-weight:800; }

.order-panel-title{
  font-family:'Playfair Display',serif;
  font-size:2rem;
  color:var(--wine);
  font-weight:700;
  line-height:1;
}
.order-panel-sub{
  margin-top:6px;
  color:black;
  font-size:1rem;
  font-family:'Playfair Display',serif;
}
.order-body{ padding:28px; }
.order-item{
  display:flex;
  align-items:center;
  gap:16px;
  background:rgba(123, 28, 42, 0.2);
  border-radius:18px;
  padding:15px;
  margin-bottom:16px;
  transition:.25s;
}
.order-item:hover{ transform:translateY(-2px); }
.order-item-img{
  width:72px;
  height:72px;
  border-radius:16px;
  object-fit:cover;
  background:var(--cream2);
}
.order-item-name{
  font-size:1rem;
  font-weight:700;
  margin-bottom:5px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}
.order-item-price{
  font-size:1rem;
  color:var(--wine);
  font-weight:800;
  flex-shrink:0;
  white-space:nowrap;
}
.order-item-del{
  background:none;border:none;color:#E24B4A;font-size:1rem;
  padding:6px;cursor:pointer;transition:.2s;flex-shrink:0;
}

.order-row{
  margin-top:8px;
  display:flex;
  justify-content:space-between;
  font-size:1rem;
}
.order-row-label{color:#130b03;}
.order-row-val{color:var(--text);font-weight:700;}

.order-total-row{
  margin:22px 0;
  display:flex;
  justify-content:space-between;
  align-items:center;
}
.order-total-label{
  font-family:'Playfair Display',serif;
  font-size:1.7rem;
  font-weight:700;
  color:var(--wine);
}
.order-total-val{
  font-family:'Playfair Display',serif;
  font-size:2rem;
  color:var(--wine);
  font-weight:800;
}

.pay-row{
  display:flex;
  gap:15px;
  margin-top:25px;
  margin-bottom:22px;
}
.pay-btn{
  height:45px;
  border-radius:8px;
  font-weight:700;
  font-size:.95rem;
  flex:1;
  background:#fff;
  border:2px solid var(--border);
  color:var(--text);
  display:flex;align-items:center;justify-content:center;gap:8px;
  cursor:pointer;transition:.2s;
}
.pay-btn:hover{border-color:#dac9b8;}
.pay-btn.active{
  border-color:var(--wine);
  background:#FFF5F5;
  color:var(--wine);
  box-shadow:0 4px 14px rgba(123,28,42,.12);
}
.pay-icon-cash{color:#2E9E5B;font-size:1.05rem;}
.pay-btn.active .pay-icon-cash{color:var(--wine);}

.mobile-wrapper{position:relative;flex:1;}
.mobile-wrapper .pay-btn{width:100%;}
.operator-dropdown{
  position:absolute;top:calc(100% + 8px);left:0;right:0;
  background:#fff;border-radius:18px;
  box-shadow:0 8px 20px rgba(123,28,42,.22);
  overflow:hidden;z-index:20;display:none;
  border:1px solid rgba(123,28,42,.08);
}
.operator-dropdown.show{display:block;}
.operator-option{
  display:flex;align-items:center;gap:12px;
  padding:12px 16px;cursor:pointer;font-weight:600;font-size:0.9rem;
  color:var(--text);border-bottom:1px solid rgba(0,0,0,.06);
  transition:background .15s ease;
}
.operator-option:last-child{border-bottom:none;}
.operator-option:hover,.operator-option:active{background:rgba(123,28,42,.08);}
.operator-option .dot{
  width:22px;height:22px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:.65rem;font-weight:800;
}
.operator-option[data-operator="MTN"] .dot{background:#FFCB05;color:#1B1B1B;}
.operator-option[data-operator="MOOV"] .dot{background:#F26522;}
.operator-option[data-operator="CELTIIS"] .dot{background:#0A6EBD;}
.chevron{font-size:12px;color:var(--text);transition:transform .2s ease;}
.pay-btn.open .chevron{transform:rotate(180deg);}

.btn-commander{
  height:58px;
  border-radius:40px;
  font-size:1rem;
  font-weight:700;
  width:100%;
  background:linear-gradient(135deg,var(--wine-dark),var(--wine-light));
  color:#fff;
  border:none;
  display:flex;align-items:center;justify-content:center;gap:10px;
  cursor:pointer;transition:.2s;
  box-shadow:0 12px 28px rgba(123,28,42,.3);
}
.btn-commander:hover{opacity:.92;transform:translateY(-1px);}

.btn-details{
  height:55px;
  border-radius:40px;
  width:100%;
  margin-top:14px;
  background:#fff;
  color:var(--text);
  border:2px solid var(--border);
  font-weight:700;font-size:.92rem;
  display:flex;align-items:center;justify-content:center;gap:8px;
  cursor:pointer;transition:.2s;
}
.btn-details:hover{border-color:var(--wine);color:var(--wine);}

.order-empty{
  padding:60px 20px;
  text-align:center;
}
.order-empty i{
  font-size:3.4rem;
  color:#ddd;
  margin-bottom:18px;
}

/* FOOTER */
.site-footer{background:var(--wine-dark);color:rgba(255,255,255,.7);padding:50px 0 28px;margin-top:50px;}
.footer-brand{font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;color:#fff;margin-bottom:4px;}
.footer-desc{font-size:.8rem;line-height:1.7;color:rgba(255,255,255,.7);margin-bottom:18px;max-width:280px;}
.footer-social a{
  width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.12);
  display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:.95rem;
  text-decoration:none;margin-right:8px;
}
.footer-heading{font-weight:700;font-size:.95rem;color:#fff;margin-bottom:16px;}
.footer-links{list-style:none;padding:0;margin:0;}
.footer-links li{margin-bottom:9px;}
.footer-links a{color:rgba(255,255,255,.75);text-decoration:none;font-size:.88rem;}
.footer-links a:hover{color:var(--gold-lt);}
.footer-contact-item{display:flex;align-items:flex-start;gap:10px;margin-bottom:10px;}
.footer-contact-item i{color:var(--gold-lt);font-size:.85rem;margin-top:3px;flex-shrink:0;}
.footer-contact-item span{font-size:.85rem;color:rgba(255,255,255,.85);line-height:1.5;}
.footer-bottom{border-top:1px solid rgba(255,255,255,.15);margin-top:36px;padding-top:20px;text-align:center;font-size:.8rem;color:rgba(255,255,255,.6);}

@media(max-width:767.98px){
  .site-footer{padding:34px 0 18px;margin-top:30px;}
  .site-footer .d-wrap{padding:0 22px;}
  .site-footer .row > div{text-align:center;margin-bottom:26px;}
  .site-footer .row > div:last-child{margin-bottom:0;}
  .footer-desc{margin:0 auto 16px;}
  .footer-social{display:flex;justify-content:center;}
  .footer-social a{width:32px;height:32px;font-size:.85rem;}
  .footer-heading{font-size:.88rem;margin-bottom:12px;}
  .footer-links li{margin-bottom:7px;}
  .footer-links a{font-size:.82rem;}
  .footer-contact-item{justify-content:center;text-align:left;}
  .footer-bottom{margin-top:22px;padding-top:16px;font-size:.72rem;}
}

/* DETAIL MODAL */
.detail-overlay{
  position:fixed;inset:0;background:rgba(30,10,14,.55);
  z-index:3000;display:flex;align-items:flex-end;justify-content:center;
  opacity:0;pointer-events:none;transition:.3s;
}
.detail-overlay.open{opacity:1;pointer-events:auto;}
.detail-sheet{
  background:#fff;width:100%;max-width:100%;border-radius:0;overflow-y:auto;overflow-x:hidden;
  transition:.3s;
  height:100%;max-height:100vh;display:flex;flex-direction:column;
}
.detail-hero{
  position:sticky;top:0;z-index:2;
  background:var(--hero-pink);
  overflow:hidden;flex-shrink:0;
  height:33.3vh;
}
.hero-wave-svg{position:absolute;inset:0;width:100%;height:100%;display:block;}
.wave-wine{fill:var(--wine);}
.wave-white{fill:#fff;}
.detail-hero-top{position:absolute;top:4%;right:4%;z-index:6;}
.detail-close{width:38px;height:38px;border-radius:50%;background:#fff;border:none;display:flex;align-items:center;justify-content:center;font-size:1.05rem;color:var(--text);cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.2);}
.detail-hero-name{
  position:absolute;top:18%;left:0;right:0;text-align:center;z-index:6;
  font-family:'Playfair Display',serif;font-size:1.60rem;font-weight:800;color:#fff;
  padding:0 20px;
}
.detail-food-img-wrap{
  position:absolute;top:68%;left:50%;transform:translate(-50%,-50%);
  width:min(38%,20vh);aspect-ratio:1;border-radius:50%;overflow:hidden;
  z-index:5;filter:drop-shadow(0 4px 8px rgba(0,0,0,.18));background:var(--cream2);
}
.detail-food-img{
  display:block;width:100%;height:100%;object-fit:cover;border-radius:50%;
}
.detail-body{padding:24px 24px 14px;background:#fff;position:relative;margin-top:-2px;}
.detail-price-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;}
.detail-price{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:var(--wine);}
.detail-qty-row{display:flex;align-items:center;gap:8px;font-size: 0.90rem;}
.qty-btn{width:34px;height:34px;border-radius:50%;background:var(--cream2);border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:700;cursor:pointer;color:var(--text);}
.qty-btn:hover{background:var(--gold);border-color:var(--gold);color:#fff;}
.qty-num{width:34px;height:34px;border-radius:50%;background:var(--wine);display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:.95rem;}
.detail-stats{display:flex;gap:10px;margin-bottom:24px;}
.detail-stat{flex:1;background-color:rgba(255, 149, 0, 0.1);border-radius:20px;padding:14px 8px;display:flex;flex-direction:column;align-items:center;gap:6px;box-shadow:0 6px 16px rgba(123,28,42,.06);}
.detail-stat-icon{font-size:1.15rem;color: #F26522;}
.detail-stat-label{font-size:.60rem;color:var(--text);font-weight:600;}
.detail-stat-val{font-size:.72rem;font-weight:500;color:var(--wine);}
.detail-section-title{
  display:flex;align-items:center;gap:12px;
  font-family:'Playfair Display',serif;font-weight:700;font-size:1.15rem;color:var(--wine);margin-bottom:12px;
}
.detail-section-title::after{content:'';flex:1;height:1px;background:var(--border);}
.detail-ingrs{display:flex;gap:9px;flex-wrap:wrap;margin-bottom:20px;}
.detail-ingr{background:#EFD9DC;border-radius:20px;padding:8px 16px;font-size:.82rem;color:var(--text);font-weight:600;}
.detail-desc{font-size:.9rem;color:var(--text);line-height:1.75;margin-bottom:18px;}
.detail-footer{padding:18px 22px 22px;background:#fff;border-top:1px solid var(--border);flex-shrink:0;position:sticky;bottom:0;z-index:3;}
.btn-add-cart{
  width:100%;background:var(--wine);color:#fff;font-weight:700;
  border:none;border-radius:40px;padding:17px 20px;display:flex;align-items:center;justify-content:center;gap:10px;
  font-size:1rem;cursor:pointer;box-shadow:0 12px 25px rgba(123,28,42,.3);font-family:'Poppins',sans-serif;
}
.btn-add-cart:hover{opacity:.92;}

@media(min-width:992px){
  .detail-overlay{align-items:center;padding:40px 20px;}
  .detail-sheet{
    width:440px;max-width:440px;height:auto;max-height:88vh;
    border-radius:32px;
    transform:translateY(24px) scale(.97);opacity:0;
    transition:.35s cubic-bezier(.4,0,.2,1);
  }
  .detail-overlay.open .detail-sheet{transform:translateY(0) scale(1);opacity:1;}
  .detail-hero{border-radius:32px 32px 0 0;height:auto;aspect-ratio:440/250;}
  .detail-footer{border-radius:0 0 32px 32px;}
}

/* TOAST */
#toast{
  position:fixed;bottom:90px;left:50%;transform:translateX(-50%);
  background:#2C2018;color:#fff;padding:12px 24px;border-radius:40px;
  font-size:.84rem;font-weight:700;z-index:9999;box-shadow:0 8px 24px rgba(0,0,0,.25);
  transition:opacity .3s;opacity:0;pointer-events:none;
}
#toast.show{opacity:1;}
</style>
@endpush

@section('content')

<!-- ==================== MOBILE VIEW ==================== -->
<div class="page-mobile">
  <div class="m-shell">
    <header class="m-header">
      <div class="d-flex align-items:center gap-2">
        <div class="brand-logo-wrap">
          <img src="{{ asset('figma/legourmet_logo.png') }}" alt="Le Gourmet" onerror="this.onerror=null;this.parentNode.innerHTML='<i class=\'fa-solid fa-utensils brand-logo-icon\'></i>'">
        </div>
        <div>
          <div class="brand-name">Le Gourmet</div>
          <div class="brand-sub">RESTAURANT</div>
        </div>
      </div>
      <a href="#m-order-sec" class="m-cart-btn" aria-label="Mon panier">
        <i class="bi bi-bag-fill"></i>
        <span class="m-cart-badge js-cart-count">0</span>
      </a>
    </header>

    <div class="m-body">
      <!-- Banner Table Info -->
      <div class="table-info-banner m-table-banner">
        <div class="table-info-left">
          <div class="table-info-welcome">BIENVENUE À LA</div>
          <div class="table-info-number">Table N°12</div>
          <div class="table-info-sub">Vos commandes seront servies à cette table</div>
        </div>
        <div class="table-info-right">
          <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
          <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
          <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
          <a href="#" class="t-avatar t-avatar-extra" title="Inviter">+</a>
        </div>
      </div>

      <!-- Recherche -->
      <div class="search-wrap m-search-wrap">
        <i class="bi bi-search s-icon"></i>
        <input type="text" class="search-bar js-search-input" placeholder="Consulter les repas...">
      </div>

      <!-- Catégories (m-cat-strip) -->
      <div class="m-cat-strip">
        <div class="m-cat-title">Catégories</div>
        <div class="m-cat-line"></div>
        <div class="m-chips-wrap">
          <div class="chips-row js-cat-chips"></div>
        </div>
      </div>

      <!-- Sous-catégories -->
      <div class="m-section-title">Sous-catégories</div>
      <div class="subcat-row js-subcat-row"></div>

      <!-- Plats -->
      <div class="section-bar" style="margin-top:18px;">
        <div class="section-bar-accent"></div>
        <div class="section-title js-current-sub-title">Burgers</div>
        <div class="section-count js-item-count">0 plats</div>
      </div>

      <div class="js-food-list"></div>

      <!-- Section Commande Mobile -->
      <div id="m-order-sec" class="order-panel" style="margin-top:24px;margin-bottom:30px;">
        <div class="order-panel-header">
          <div>
            <div class="order-panel-title">Ma Commande</div>
            <div class="order-panel-sub">Table N°12</div>
          </div>
          <div class="order-avatars">
            <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
            <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
            <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
            <div class="o-avatar o-avatar-extra">+</div>
          </div>
        </div>
        <div class="order-body">
          <div class="js-order-items"></div>

          <div class="order-row" style="margin-top:20px;">
            <span class="order-row-label">TVA (18%)</span>
            <span class="order-row-val js-tva-val">0 FCFA</span>
          </div>
          <div class="order-total-row">
            <span class="order-total-label">Sous Total</span>
            <span class="order-total-val js-total-val">0 FCFA</span>
          </div>

          <div class="pay-row">
            <button type="button" class="pay-btn active js-pay-btn" data-mode="cash">
              <i class="fa-solid fa-money-bill-wave pay-icon-cash"></i> Espèce
            </button>
            <div class="mobile-wrapper">
              <button type="button" class="pay-btn js-pay-btn" data-mode="momo">
                Mobile Money <i class="fa-solid fa-chevron-down chevron"></i>
              </button>
              <div class="operator-dropdown js-operator-dropdown">
                <div class="operator-option" data-operator="MTN">
                  <div class="dot">M</div> MTN MoMo
                </div>
                <div class="operator-option" data-operator="MOOV">
                  <div class="dot">M</div> Moov Money
                </div>
                <div class="operator-option" data-operator="CELTIIS">
                  <div class="dot">C</div> Celtiis Cash
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn-commander js-btn-checkout">
            Valider la commande
          </button>
          <a href="{{ url('/mes-commandes') }}" class="btn-details" style="text-decoration:none;">
            Voir les détails de mes commandes
          </a>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- ==================== DESKTOP VIEW ==================== -->
<div class="page-desktop">
  <!-- Desktop Sticky Header -->
  <header class="d-navbar">
    <div class="d-wrap d-flex align-items-center justify-content-between py-0">
      <div class="d-flex align-items-center gap-3">
        <div class="brand-logo-wrap">
          <img src="{{ asset('figma/legourmet_logo.png') }}" alt="Le Gourmet" onerror="this.onerror=null;this.parentNode.innerHTML='<i class=\'fa-solid fa-utensils brand-logo-icon\'></i>'">
        </div>
        <div>
          <div class="brand-name">Le Gourmet</div>
          <div class="brand-sub">RESTAURANT</div>
        </div>
      </div>

      <nav class="d-flex align-items-center gap-2">
        <a href="{{ url('/') }}" class="d-nav-link active">Accueil</a>
        <a href="{{ url('/mes-commandes') }}" class="d-nav-link">Mes commandes</a>
        <a href="{{ url('/contact') }}" class="d-nav-link">Contact</a>
      </nav>

      <a href="{{ url('/commander') }}" class="btn-wine">
        Commander <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </header>

  <div class="d-wrap">
    <!-- Banner Table Info -->
    <div class="table-info-banner d-table-banner">
      <div class="table-info-left">
        <div class="table-info-welcome">BIENVENUE À LA</div>
        <div class="table-info-number">Table N°12</div>
        <div class="table-info-sub">Vos commandes seront servies à cette table</div>
      </div>
      <div class="table-info-right">
        <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
        <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
        <div class="t-avatar"><i class="fa-solid fa-user"></i></div>
        <a href="#" class="t-avatar t-avatar-extra" title="Inviter">+</a>
      </div>
    </div>

    <!-- Recherche -->
    <div class="search-wrap d-search-wrap">
      <i class="bi bi-search s-icon"></i>
      <input type="text" class="search-bar js-search-input" placeholder="Consulter les repas...">
    </div>

    <!-- Catégories Strip -->
    <div class="d-cat-strip">
      <div class="d-cat-title">Catégories</div>
      <div class="d-cat-line"></div>
      <div class="chips-row js-cat-chips"></div>
    </div>

    <!-- Contenu Principal 2 Colonnes -->
    <div class="d-main-layout">
      <!-- Colonne Menu -->
      <div class="d-menu-col">
        <div class="section-bar">
          <div class="section-bar-accent"></div>
          <div class="section-title">Sous-catégories</div>
        </div>
        <div class="subcat-row js-subcat-row mb-4"></div>

        <div class="section-bar">
          <div class="section-bar-accent"></div>
          <div class="section-title js-current-sub-title">Burgers</div>
          <div class="section-count js-item-count">0 plats</div>
        </div>

        <div class="js-food-list"></div>
      </div>

      <!-- Colonne Panneau Commande -->
      <div class="d-order-col">
        <div class="order-panel">
          <div class="order-panel-header">
            <div>
              <div class="order-panel-title">Ma Commande</div>
              <div class="order-panel-sub">Table N°12</div>
            </div>
            <div class="order-avatars">
              <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
              <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
              <div class="o-avatar"><i class="fa-solid fa-user"></i></div>
              <div class="o-avatar o-avatar-extra">+</div>
            </div>
          </div>

          <div class="order-body">
            <div class="js-order-items"></div>

            <div class="order-row" style="margin-top:20px;">
              <span class="order-row-label">TVA (18%)</span>
              <span class="order-row-val js-tva-val">0 FCFA</span>
            </div>
            <div class="order-total-row">
              <span class="order-total-label">Sous Total</span>
              <span class="order-total-val js-total-val">0 FCFA</span>
            </div>

            <div class="pay-row">
              <button type="button" class="pay-btn active js-pay-btn" data-mode="cash">
                <i class="fa-solid fa-money-bill-wave pay-icon-cash"></i> Espèce
              </button>
              <div class="mobile-wrapper">
                <button type="button" class="pay-btn js-pay-btn" data-mode="momo">
                  Mobile Money <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <div class="operator-dropdown js-operator-dropdown">
                  <div class="operator-option" data-operator="MTN">
                    <div class="dot">M</div> MTN MoMo
                  </div>
                  <div class="operator-option" data-operator="MOOV">
                    <div class="dot">M</div> Moov Money
                  </div>
                  <div class="operator-option" data-operator="CELTIIS">
                    <div class="dot">C</div> Celtiis Cash
                  </div>
                </div>
              </div>
            </div>

            <button type="button" class="btn-commander js-btn-checkout">
              Valider la commande
            </button>
            <a href="{{ url('/mes-commandes') }}" class="btn-details" style="text-decoration:none;">
              Voir les détails de mes commandes
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Desktop -->
  <footer class="site-footer">
    <div class="d-wrap">
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand">Le Gourmet</div>
          <div class="footer-desc">Une expérience culinaire d'exception combinant tradition, raffinement et saveurs authentiques.</div>
          <div class="footer-social">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="footer-heading">Navigation</div>
          <ul class="footer-links">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="{{ url('/mes-commandes') }}">Mes commandes</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-heading">Horaire & Service</div>
          <ul class="footer-links">
            <li>Lundi - Dimanche</li>
            <li>11h00 - 23h00</li>
            <li>Service à table & à emporter</li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-heading">Contact</div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>Cotonou, Bénin</span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-phone"></i>
            <span>+229 01 23 45 67 89</span>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; {{ date('Y') }} Le Gourmet Restaurant. Tous droits réservés.
      </div>
    </div>
  </footer>
</div>


<!-- ==================== DETAIL MODAL SHEET ==================== -->
<div class="detail-overlay js-detail-overlay" id="detailOverlay">
  <div class="detail-sheet">
    <div class="detail-hero">
      <svg class="hero-wave-svg" viewBox="0 0 440 250" preserveAspectRatio="none">
        <path class="wave-wine" d="M0,0 L440,0 L440,160 Q330,190 220,165 Q110,140 0,175 Z"></path>
        <path class="wave-white" d="M0,175 Q110,140 220,165 Q330,190 440,160 L440,250 L0,250 Z"></path>
      </svg>
      <div class="detail-hero-top">
        <button type="button" class="detail-close js-detail-close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="detail-hero-name js-detail-name">Nom du plat</div>
      <div class="detail-food-img-wrap">
        <img src="" alt="" class="detail-food-img js-detail-img">
      </div>
    </div>

    <div class="detail-body">
      <div class="detail-price-row">
        <div class="detail-price js-detail-price">0 FCFA</div>
        <div class="detail-qty-row">
          <button type="button" class="qty-btn js-modal-minus">-</button>
          <div class="qty-num js-modal-qty">1</div>
          <button type="button" class="qty-btn js-modal-plus">+</button>
        </div>
      </div>

      <div class="detail-stats">
        <div class="detail-stat">
          <i class="fa-solid fa-star detail-stat-icon"></i>
          <span class="detail-stat-label">NOTE</span>
          <span class="detail-stat-val js-detail-rating">4.5</span>
        </div>
        <div class="detail-stat">
          <i class="fa-solid fa-fire detail-stat-icon"></i>
          <span class="detail-stat-label">CALORIES</span>
          <span class="detail-stat-val js-detail-cal">320 kcal</span>
        </div>
        <div class="detail-stat">
          <i class="fa-solid fa-clock detail-stat-icon"></i>
          <span class="detail-stat-label">TEMPS</span>
          <span class="detail-stat-val js-detail-time">20 min</span>
        </div>
      </div>

      <div class="detail-section-title">Ingrédients</div>
      <div class="detail-ingrs js-detail-ingrs"></div>

      <div class="detail-section-title">Description</div>
      <div class="detail-desc js-detail-desc"></div>
    </div>

    <div class="detail-footer">
      <button type="button" class="btn-add-cart js-modal-add-btn">
        Ajouter au panier — <span class="js-modal-total-price">0 FCFA</span>
      </button>
    </div>
  </div>
</div>

<div id="toast"></div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const FALLBACK_IMG = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Crect width='200' height='200' fill='%23F4EDE4'/%3E%3Ccircle cx='100' cy='100' r='88' fill='none' stroke='%23EDE0D0' stroke-width='3'/%3E%3Ctext x='50%25' y='54%25' font-size='66' text-anchor='middle' dominant-baseline='middle'%3E%F0%9F%8D%BD%EF%B8%8F%3C/text%3E%3C/svg%3E";

  const RAW_DATA = {
    categories: [
      { key: 'street-food', label: 'Street Food', img: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&q=80' },
      { key: 'grillades', label: 'Grillades', img: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&q=80' },
      { key: 'africain', label: 'Africain', img: 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=300&q=80' },
      { key: 'pates', label: 'Pâtes', img: 'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=300&q=80' },
      { key: 'desserts', label: 'Desserts', img: 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=300&q=80' }
    ],
    subcategories: {
      'street-food': [
        { key: 'burgers', label: 'Burgers', img: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&q=80' },
        { key: 'pizzas', label: 'Pizzas', img: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=300&q=80' },
        { key: 'chawarmas', label: 'Chawarmas', img: 'https://images.unsplash.com/photo-1561651823-34feb02250e4?w=300&q=80' }
      ],
      'grillades': [
        { key: 'poulet', label: 'Poulet', img: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&q=80' },
        { key: 'poisson', label: 'Poisson', img: 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=300&q=80' }
      ],
      'africain': [
        { key: 'locaux', label: 'Plats locaux', img: 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=300&q=80' }
      ],
      'pates': [
        { key: 'italiennes', label: 'Pâtes', img: 'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=300&q=80' }
      ],
      'desserts': [
        { key: 'douceurs', label: 'Gâteaux & Glaces', img: 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=300&q=80' }
      ]
    },
    plats: [
      { id: 'b1', cat: 'street-food', subcat: 'burgers', name: 'Burger viande', price: 3000, stars: 4, rating: 4.2, calories: '450 kcal', time: '15 min', img: 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=300&q=80', ingrs: ['Boeuf', 'Pain brioché', 'Salade', 'Tomate'], desc: 'Un délicieux burger de boeuf juteux servi avec nos épices maison.' },
      { id: 'b2', cat: 'street-food', subcat: 'burgers', name: 'Double cheese burger', price: 6000, stars: 5, rating: 4.9, calories: '680 kcal', time: '20 min', img: 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=300&q=80', ingrs: ['Double Boeuf', 'Cheddar', 'Oignons grillés'], desc: 'Le régal ultime des amateurs de fromage, double portion de viande.' },
      { id: 'p1', cat: 'street-food', subcat: 'pizzas', name: 'Pizza Gourmet', price: 6000, stars: 5, rating: 4.8, calories: '800 kcal', time: '25 min', img: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=300&q=80', ingrs: ['Sauce tomate', 'Mozzarella', 'Jambon', 'Champignons'], desc: 'Une pâte artisanale croustillante garnie d ingrédients frais sélectionnés.' },
      { id: 'g1', cat: 'grillades', subcat: 'poulet', name: 'Poulet Braisé', price: 4000, stars: 4, rating: 4.5, calories: '520 kcal', time: '30 min', img: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=300&q=80', ingrs: ['Poulet', 'Épices', 'Alloco'], desc: 'Poulet marinée aux épices locales, braisé au feu de bois.' }
    ]
  };

  let activeCat = 'street-food';
  let activeSub = 'burgers';
  let searchQuery = '';
  let cart = [];
  let modalCurrentPlat = null;
  let modalQty = 1;

  function formatPrice(val) {
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " FCFA";
  }

  function showToast(msg) {
    const toast = document.getElementById('toast');
    toast.innerText = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2500);
  }

  /* RENDER CATEGORIES */
  function renderCategories() {
    document.querySelectorAll('.js-cat-chips').forEach(container => {
      container.innerHTML = RAW_DATA.categories.map(c => `
        <button type="button" class="chip ${c.key === activeCat ? 'active' : ''}" data-cat="${c.key}">
          <div class="chip-img-wrap">
            <img src="${c.img}" alt="${c.label}" onerror="this.onerror=null;this.src='${FALLBACK_IMG}'">
          </div>
          <span>${c.label}</span>
        </button>
      `).join('');

      container.querySelectorAll('.chip').forEach(btn => {
        btn.addEventListener('click', () => {
          activeCat = btn.dataset.cat;
          const subs = RAW_DATA.subcategories[activeCat] || [];
          activeSub = subs[0] ? subs[0].key : '';
          renderCategories();
          renderSubcategories();
          renderPlats();
        });
      });
    });
  }

  /* RENDER SUBCATEGORIES */
  function renderSubcategories() {
    const subs = RAW_DATA.subcategories[activeCat] || [];
    document.querySelectorAll('.js-subcat-row').forEach(container => {
      container.innerHTML = subs.map(s => `
        <div class="subcat-card ${s.key === activeSub ? 'active' : ''}" data-sub="${s.key}">
          <img src="${s.img}" alt="${s.label}" onerror="this.onerror=null;this.src='${FALLBACK_IMG}'">
          <div class="subcat-card-label">${s.label}</div>
        </div>
      `).join('');

      container.querySelectorAll('.subcat-card').forEach(card => {
        card.addEventListener('click', () => {
          activeSub = card.dataset.sub;
          renderSubcategories();
          renderPlats();
        });
      });
    });
  }

  /* RENDER PLATS */
  function renderPlats() {
    let filtered = RAW_DATA.plats.filter(p => p.cat === activeCat && p.subcat === activeSub);
    if (searchQuery.trim() !== '') {
      const q = searchQuery.toLowerCase();
      filtered = RAW_DATA.plats.filter(p => p.name.toLowerCase().includes(q));
    }

    const currentSubObj = (RAW_DATA.subcategories[activeCat] || []).find(s => s.key === activeSub);
    const subTitleText = searchQuery ? 'Résultats de recherche' : (currentSubObj ? currentSubObj.label : '');

    document.querySelectorAll('.js-current-sub-title').forEach(el => el.innerText = subTitleText);
    document.querySelectorAll('.js-item-count').forEach(el => el.innerText = filtered.length + ' plat(s)');

    document.querySelectorAll('.js-food-list').forEach(container => {
      if (!filtered.length) {
        container.innerHTML = `<div class="p-4 text-center text-muted">Aucun plat disponible.</div>`;
        return;
      }

      container.innerHTML = filtered.map(p => {
        let starsHtml = '★'.repeat(p.stars) + '☆'.repeat(5 - p.stars);
        return `
          <div class="menu-card" data-id="${p.id}">
            <div class="menu-card-img-wrap">
              <img src="${p.img}" alt="${p.name}" class="menu-card-img" onerror="this.onerror=null;this.src='${FALLBACK_IMG}'">
            </div>
            <div class="menu-card-body">
              <div class="menu-card-name">${p.name}</div>
              <div class="menu-card-stars">${starsHtml}</div>
            </div>
            <div class="menu-card-price">${formatPrice(p.price)}</div>
          </div>
        `;
      }).join('');

      container.querySelectorAll('.menu-card').forEach(card => {
        card.addEventListener('click', () => {
          const item = RAW_DATA.plats.find(p => p.id === card.dataset.id);
          if (item) openDetailModal(item);
        });
      });
    });
  }

  /* CART OPERATIONS */
  function addToCart(plat, qty = 1) {
    const existing = cart.find(c => c.plat.id === plat.id);
    if (existing) {
      existing.qty += qty;
    } else {
      cart.push({ plat: plat, qty: qty });
    }
    updateCartUI();
    showToast(`${plat.name} ajouté au panier !`);
  }

  function updateCartUI() {
    const totalCount = cart.reduce((acc, c) => acc + c.qty, 0);
    document.querySelectorAll('.js-cart-count').forEach(el => el.innerText = totalCount);

    const subTotal = cart.reduce((acc, c) => acc + (c.plat.price * c.qty), 0);
    const tva = Math.round(subTotal * 0.18);
    const total = subTotal + tva;

    document.querySelectorAll('.js-tva-val').forEach(el => el.innerText = formatPrice(tva));
    document.querySelectorAll('.js-total-val').forEach(el => el.innerText = formatPrice(total));

    document.querySelectorAll('.js-order-items').forEach(container => {
      if (!cart.length) {
        container.innerHTML = `
          <div class="order-empty">
            <i class="fa-solid fa-basket-shopping"></i>
            <div style="font-size:0.9rem;color:var(--muted);">Votre panier est vide</div>
          </div>
        `;
        return;
      }

      container.innerHTML = cart.map((item, idx) => `
        <div class="order-item">
          <img src="${item.plat.img}" class="order-item-img" alt="${item.plat.name}" onerror="this.onerror=null;this.src='${FALLBACK_IMG}'">
          <div style="flex:1;min-width:0;">
            <div class="order-item-name">${item.plat.name}</div>
            <div style="font-size:0.85rem;color:var(--muted);">Qté: ${item.qty}</div>
          </div>
          <div class="order-item-price">${formatPrice(item.plat.price * item.qty)}</div>
          <button type="button" class="order-item-del" data-idx="${idx}"><i class="fa-solid fa-trash"></i></button>
        </div>
      `).join('');

      container.querySelectorAll('.order-item-del').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.stopPropagation();
          const idx = parseInt(btn.dataset.idx);
          cart.splice(idx, 1);
          updateCartUI();
        });
      });
    });
  }

  /* MODAL DETAIL */
  function openDetailModal(plat) {
    modalCurrentPlat = plat;
    modalQty = 1;

    document.querySelector('.js-detail-name').innerText = plat.name;
    document.querySelector('.js-detail-img').src = plat.img;
    document.querySelector('.js-detail-price').innerText = formatPrice(plat.price);
    document.querySelector('.js-detail-rating').innerText = plat.rating;
    document.querySelector('.js-detail-cal').innerText = plat.calories;
    document.querySelector('.js-detail-time').innerText = plat.time;
    document.querySelector('.js-detail-desc').innerText = plat.desc;

    const ingrContainer = document.querySelector('.js-detail-ingrs');
    ingrContainer.innerHTML = (plat.ingrs || []).map(i => `<span class="detail-ingr">${i}</span>`).join('');

    updateModalQtyUI();
    document.getElementById('detailOverlay').classList.add('open');
  }

  function updateModalQtyUI() {
    document.querySelector('.js-modal-qty').innerText = modalQty;
    if (modalCurrentPlat) {
      const totalPrice = modalCurrentPlat.price * modalQty;
      document.querySelector('.js-modal-total-price').innerText = formatPrice(totalPrice);
    }
  }

  document.querySelector('.js-detail-close').addEventListener('click', () => {
    document.getElementById('detailOverlay').classList.remove('open');
  });

  document.querySelector('.js-modal-minus').addEventListener('click', () => {
    if (modalQty > 1) { modalQty--; updateModalQtyUI(); }
  });

  document.querySelector('.js-modal-plus').addEventListener('click', () => {
    modalQty++; updateModalQtyUI();
  });

  document.querySelector('.js-modal-add-btn').addEventListener('click', () => {
    if (modalCurrentPlat) {
      addToCart(modalCurrentPlat, modalQty);
      document.getElementById('detailOverlay').classList.remove('open');
    }
  });

  /* SEARCH BINDING */
  document.querySelectorAll('.js-search-input').forEach(input => {
    input.addEventListener('input', (e) => {
      searchQuery = e.target.value;
      renderPlats();
    });
  });

  /* PAYMENT DROPDOWNS & BUTTONS */
  document.querySelectorAll('.js-pay-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const mode = this.dataset.mode;
      if (mode === 'momo') {
        const wrapper = this.closest('.mobile-wrapper');
        const dropdown = wrapper ? wrapper.querySelector('.js-operator-dropdown') : null;
        if (dropdown) {
          dropdown.classList.toggle('show');
          this.classList.toggle('open');
        }
      } else {
        document.querySelectorAll('.js-pay-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.querySelectorAll('.js-operator-dropdown').forEach(d => d.classList.remove('show'));
      }
    });
  });

  document.querySelectorAll('.operator-option').forEach(opt => {
    opt.addEventListener('click', function() {
      const opName = this.dataset.operator;
      const wrapper = this.closest('.mobile-wrapper');
      const btn = wrapper.querySelector('.js-pay-btn');
      document.querySelectorAll('.js-pay-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      btn.innerHTML = `${opName} <i class="fa-solid fa-chevron-down chevron"></i>`;
      this.closest('.js-operator-dropdown').classList.remove('show');
      btn.classList.remove('open');
    });
  });

  document.querySelectorAll('.js-btn-checkout').addEventListener?.('click', () => {
    if (!cart.length) {
      showToast("Votre panier est vide !");
      return;
    }
    showToast("Commande envoyée avec succès !");
    cart = [];
    updateCartUI();
  });

  /* INIT */
  renderCategories();
  renderSubcategories();
  renderPlats();
  updateCartUI();
});
</script>
@endpush