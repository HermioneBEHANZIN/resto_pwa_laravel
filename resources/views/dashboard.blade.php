@extends('layouts.app')

@section('title', 'Le Gourmet — Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root {
  --bg: #EEF0FF;
  --sidebar: #7A1024;
  --white: #FFFFFF;
  --black: #202020;
  --green: #31AA1C;
  --orange: #FF9500;
  --blue: #2F80ED;
  --yellow: #FFBF0D;
  --red: #E8112D;
  --pink-notif: #F7E6E6;
  --gray-text: #9AA0B4;
  --gray-line: #E7E9F5;
}

h1.page-title {
  font-family: 'Playfair Display', serif;
  font-size: 40px;
  font-weight: 800;
  letter-spacing: 1px;
  color: var(--black);
  margin-bottom: 22px;
}

/* ============ CA BANNER ============ */
.ca-banner {
  background: #fff;
  border: 1px solid #B7E3B9;
  border-radius: 20px;
  height: 130px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  margin-bottom: 30px;
  overflow: hidden;
}

.ca-left .ca-label {
  font-family: 'Playfair Display', serif;
  font-size: 19px;
  font-weight: 500;
  color: var(--black);
  margin-bottom: 6px;
}

.ca-left .ca-amount {
  font-family: 'Playfair Display', serif;
  font-size: 34px;
  font-weight: 800;
  color: var(--green);
}

.ca-amount span {
  font-size: 18px;
  font-weight: 700;
}

.ca-right {
  width: 55%;
  max-width: 520px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  overflow: hidden;
}

.ca-right img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  margin-left: 0;
}

/* ============ STAT CARDS ============ */
.stats-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 26px;
  margin-bottom: 30px;
}

.stat-card {
  background: #fff;
  border-radius: 18px;
  height: 120px;
  padding: 18px 22px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  border: 1.4px solid transparent;
}

.stat-card.c-red { border-color: var(--sidebar); }
.stat-card.c-orange { border-color: var(--orange); }
.stat-card.c-blue { border-color: var(--blue); }
.stat-card.c-yellow { border-color: var(--yellow); }

.stat-num {
  font-family: 'Playfair Display', serif;
  font-size: 29px;
  font-weight: 800;
  line-height: 1;
  margin-bottom: 6px;
}

.stat-num small { font-size: 14px; font-weight: 700; }

.c-red .stat-num { color: var(--sidebar); }
.c-orange .stat-num { color: var(--orange); }
.c-blue .stat-num { color: var(--blue); }
.c-yellow .stat-num { color: var(--yellow); }

.stat-label {
  font-size: 13px;
  color: #202020;
  margin-bottom: 5px;
}

.stat-delta {
  font-size: 12px;
  font-weight: 600;
}

.c-red .stat-delta { color: #D97583; }
.c-orange .stat-delta { color: var(--orange); }
.c-blue .stat-delta { color: var(--blue); }
.c-yellow .stat-delta { color: var(--yellow); }

/* ============ MIDDLE SECTION ============ */
.middle-row {
  display: grid;
  grid-template-columns: 1.7fr 1fr;
  gap: 26px;
  margin-bottom: 30px;
  align-items: start;
}

.chart-title {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 16px;
}

.chart-card {
  background: #fff;
  border-radius: 20px;
  padding: 22px 24px 14px;
  margin-left: 0;
}

.chart-card svg { width: 100%; height: auto; display: block; }

.chart-dates {
  display: flex;
  justify-content: space-between;
  font-size: 10px;
  color: #202020;
  padding: 0 4px;
  padding-left: 50px;
  margin-top: -16px;
}

.top-card {
  background: #fff;
  border-radius: 20px;
  padding: 26px 26px 10px;
  height: 100%;
  margin-left: 0;
  margin-bottom: 0;
}

.top-card h2 {
  font-family: 'Playfair Display', serif;
  color: var(--sidebar);
  font-size: 23px;
  font-weight: 700;
  margin-bottom: 18px;
}

.top-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 13px 0;
  border-bottom: 1px solid var(--gray-line);
}

.top-item:last-child { border-bottom: none; }

.top-rank {
  font-size: 13px;
  color: #202020;
  width: 12px;
  font-weight: 500;
}

.top-thumb {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  flex-shrink: 0;
  background: #F2E7E9;
  overflow: hidden;
}

.top-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.top-thumb i { color: var(--sidebar); }

.top-name {
  flex: 1;
  font-size: 14.5px;
  color: var(--black);
}

.top-score {
  font-size: 13px;
  font-weight: 700;
  color: var(--red);
}

/* ============ TABLE ============ */
.orders-card {
  background: #fff;
  border-radius: 18px;
  padding: 28px 30px 8px;
}

.orders-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 18px;
  border-bottom: 1px solid var(--gray-line);
}

.orders-head h2 {
  font-family: 'Playfair Display', serif;
  color: var(--sidebar);
  font-size: 26px;
  font-weight: 700;
}

.refresh-btn {
  background: #fff;
  border: 1px solid #E4E6F2;
  color: var(--black);
  font-family: 'Playfair Display', serif;
  font-size: 13px;
  padding: 9px 20px;
  border-radius: 20px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.refresh-btn.spinning i { animation: spin .6s linear; }

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.refresh-btn:hover { background: #FAFAFF; }

.table-scroll {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead th {
  text-align: left;
  font-family: 'Playfair Display', serif;
  color: var(--sidebar);
  font-weight: 600;
  font-size: 15.5px;
  padding-bottom: 14px;
}

tbody td {
  padding: 16px 0;
  font-size: 14.5px;
  color: var(--black);
  border-bottom: 1px solid var(--gray-line);
}

tbody tr:last-child td { border-bottom: none; }

.badge {
  display: inline-block;
  padding: 5px 14px;
  border-radius: 20px;
  font-size: 12.5px;
  font-weight: 500;
}

.badge.prep { background: #FDECD4; color: #C97F13; }
.badge.ready { background: #DCEBFC; color: #2E6FD1; }
.badge.served { background: #DBF0DD; color: #2F8C3B; }

th.col-table, td.col-table,
th.col-status, td.col-status,
th.col-time, td.col-time {
  text-align: center;
}

/* ============ MEDIA QUERIES ============ */
@media (max-width: 1200px) {
  .stats-row { grid-template-columns: repeat(2, 1fr); }
  .middle-row { grid-template-columns: 1fr; }
}

@media (max-width: 767.98px) {
  h1.page-title { font-size: 22px; margin-bottom: 16px; letter-spacing: 0.5px; }

  .ca-banner {
    flex-direction: column; align-items: flex-start; height: auto;
    padding: 22px 20px; gap: 12px; margin-bottom: 18px;
    border-radius: 20px; box-shadow: 0 2px 14px rgba(20,10,20,.06);
  }
  .ca-left .ca-label { font-size: 13px; }
  .ca-left .ca-amount { font-size: 27px; }
  .ca-right { width: 100%; max-width: 100%; justify-content: center; }
  .ca-right img { width: 100%; max-width: 170px; height: auto; margin-left: 0; }

  .stats-row { grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 18px; }
  .stat-card {
    height: auto; min-height: 96px; padding: 16px 14px;
    border-radius: 16px; border: none; border-left: 4px solid transparent;
    box-shadow: 0 2px 12px rgba(20,10,20,.05); justify-content: center;
  }
  .stat-card.c-red { border-left-color: var(--sidebar); }
  .stat-card.c-orange { border-left-color: var(--orange); }
  .stat-card.c-blue { border-left-color: var(--blue); }
  .stat-card.c-yellow { border-left-color: var(--yellow); }
  .stat-num { font-size: 20px; margin-bottom: 4px; }
  .stat-num small { font-size: 11px; }
  .stat-label { font-size: 11.5px; line-height: 1.3; margin-bottom: 6px; }
  .stat-delta { font-size: 11px; }

  .chart-title { font-size: 17px; margin-bottom: 12px; font-weight: 700; }
  .chart-card {
    margin-left: 0; padding: 16px 14px 8px;
    background: #fff; border-radius: 18px; box-shadow: 0 2px 14px rgba(20,10,20,.05);
  }
  .chart-dates { padding-left: 2px; font-size: 9.5px; }

  .middle-row { gap: 16px; margin-bottom: 18px; }
  .top-card {
    margin-left: 0; margin-bottom: 0; padding: 18px 16px;
    border-radius: 18px; box-shadow: 0 2px 14px rgba(20,10,20,.05);
  }
  .top-card h2 { font-size: 17px; margin-bottom: 12px; }
  .top-name { font-size: 13.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

  .orders-card { padding: 18px 16px; border-radius: 18px; box-shadow: 0 2px 14px rgba(20,10,20,.05); }
  .orders-head { margin-bottom: 14px; padding-bottom: 12px; flex-wrap: wrap; gap: 10px; }
  .orders-head h2 { font-size: 17px; }
  .refresh-btn { min-height: 38px; padding: 8px 16px; font-size: 12px; }

  .table-scroll { overflow-x: visible; }
  table { min-width: 0; width: 100%; table-layout: fixed; }
  thead th { font-size: 0; padding-bottom: 10px; text-align: center; }
  thead th::before {
    font-size: 11px; font-family: 'Playfair Display', serif;
    color: var(--sidebar); font-weight: 600;
  }
  thead th:nth-child(1)::before { content: "ID"; }
  thead th:nth-child(2)::before { content: "Table"; }
  thead th:nth-child(3)::before { content: "Statut"; }
  thead th:nth-child(4)::before { content: "Heure"; }
  tbody td { padding: 12px 2px; font-size: 12px; text-align: center; }
  .badge { padding: 4px 8px; font-size: 10.5px; white-space: normal; line-height: 1.25; }
}

@media (max-width: 479.98px) {
  .chart-dates span:nth-child(even) { display: none; }
  .ca-right img { max-width: 130px; }
}
</style>
@endpush

@section('content')
<h1 class="page-title">DASHBOARD</h1>

<!-- CA BANNER -->
<div class="ca-banner">
  <div class="ca-left">
    <div class="ca-label">Chiffres d'affaires global</div>
    <div class="ca-amount">98 250 000 <span>FCFA</span></div>
  </div>
  <div class="ca-right">
    <img src="{{ asset('figma/courbe_de_revenus.jpg') }}" alt="Chiffres d'affaires en hausse">
  </div>
</div>

<!-- STAT CARDS -->
<div class="stats-row" id="stats-row"></div>

<!-- MIDDLE ROW -->
<div class="middle-row">
  <div>
    <div class="chart-title">Commandes d'aujourd'hui</div>
    <div class="chart-card">
      <svg viewBox="0 0 620 280" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="areaGrad" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#7B1C2A" stop-opacity="0.35"/>
            <stop offset="100%" stop-color="#7B1C2A" stop-opacity="0"/>
          </linearGradient>
        </defs>
        <line x1="40" y1="20" x2="40" y2="230" stroke="#E7E9F5" stroke-width="1"/>
        <line x1="40" y1="230" x2="610" y2="230" stroke="#E7E9F5" stroke-width="1"/>
        <text x="10" y="24" font-size="11" fill="#202020" font-family="Playfair Display, serif">120</text>
        <text x="18" y="76" font-size="11" fill="#202020" font-family="Playfair Display, serif">90</text>
        <text x="18" y="128" font-size="11" fill="#202020" font-family="Playfair Display, serif">60</text>
        <text x="18" y="180" font-size="11" fill="#202020" font-family="Playfair Display, serif">30</text>
        <text x="24" y="234" font-size="11" fill="#202020" font-family="Playfair Display, serif">0</text>
        <line x1="40" y1="20" x2="610" y2="20" stroke="#F0F1FA" stroke-width="1"/>
        <line x1="40" y1="72" x2="610" y2="72" stroke="#F0F1FA" stroke-width="1"/>
        <line x1="40" y1="124" x2="610" y2="124" stroke="#F0F1FA" stroke-width="1"/>
        <line x1="40" y1="176" x2="610" y2="176" stroke="#F0F1FA" stroke-width="1"/>
        <path d="M40,132 C100,150 140,110 190,108 C220,106 235,120 255,116 C300,108 340,88 400,74 C460,60 500,64 540,44 C570,32 590,30 610,20 L610,230 L40,230 Z" fill="url(#areaGrad)"/>
        <path d="M40,132 C100,150 140,110 190,108 C220,106 235,120 255,116 C300,108 340,88 400,74 C460,60 500,64 540,44 C570,32 590,30 610,20" fill="none" stroke="#7B1C2A" stroke-width="2.6" stroke-linecap="round"/>
      </svg>
      <div class="chart-dates">
        <span>12 avril</span><span>30 avril</span><span>14 mai</span><span>02 juin</span><span>20 juin</span><span>03 juillet</span><span style="font-weight:600;color:#5B5F73;">Date…</span>
      </div>
    </div>
  </div>

  <div class="top-card">
    <h2>Les tops du moment</h2>
    <div id="tops-list"></div>
  </div>
</div>

<!-- ORDERS TABLE -->
<div class="orders-card">
  <div class="orders-head">
    <h2>Dernières commandes</h2>
    <button class="refresh-btn" id="refresh-btn"><i class="bi bi-arrow-clockwise"></i> Actualiser</button>
  </div>

  <div class="table-scroll">
    <table>
      <thead>
        <tr>
          <th>ID commande</th>
          <th class="col-table">Table</th>
          <th class="col-status">Statut</th>
          <th class="col-time">Heure</th>
        </tr>
      </thead>
      <tbody id="orders-tbody"></tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const dashboardPlats = [
    {id:'burger-viande', name:'Burger viande', reviews:45, img:'https://images.unsplash.com/photo-1550547660-d9450f859349?w=200&q=80'},
    {id:'royal-burger', name:'Royal Burger', reviews:128, img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&q=80'},
    {id:'double-cheese', name:'Double Cheese Burger', reviews:95, img:'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=200&q=80'},
    {id:'pizza-gourmet', name:'Pizza Gourmet', reviews:96, img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=200&q=80'},
  ];

  window.thumbFallback = function(imgEl){
    const wrap = imgEl.parentElement;
    wrap.innerHTML = '<i class="bi bi-egg-fried"></i>';
  };

  function renderTopsDuMoment(){
    const top4 = [...dashboardPlats].sort((a,b)=>b.reviews-a.reviews).slice(0,4);
    const list = document.getElementById('tops-list');
    if (!list) return;
    list.innerHTML = top4.map((p,i)=>`
      <div class="top-item">
        <div class="top-rank">${i+1}</div>
        <div class="top-thumb"><img src="${p.img}" alt="${p.name}" onerror="thumbFallback(this)"></div>
        <div class="top-name">${p.name}</div>
        <div class="top-score">${p.reviews}</div>
      </div>
    `).join('');
  }

  const dashboardState = {
    commandes: 128,
    commandesDelta: '+ 10%',
    caJournalier: '1 250 000',
    caDelta: '+ 10%',
    tablesOccupees: 25,
    tablesDelta: '+ 6%',
    tempsMoyen: 32,
    tempsDelta: '− 6%',
  };

  function renderStats(){
    const s = dashboardState;
    const statsRow = document.getElementById('stats-row');
    if (!statsRow) return;
    statsRow.innerHTML = `
      <div class="stat-card c-red">
        <div class="stat-num">${s.commandes}</div>
        <div class="stat-label">Commandes</div>
        <div class="stat-delta">${s.commandesDelta}</div>
      </div>
      <div class="stat-card c-orange">
        <div class="stat-num">${s.caJournalier} <small>FCFA</small></div>
        <div class="stat-label">Chiffres d'affaires journaliers</div>
        <div class="stat-delta">${s.caDelta}</div>
      </div>
      <div class="stat-card c-blue">
        <div class="stat-num">${s.tablesOccupees}</div>
        <div class="stat-label">Tables occupées</div>
        <div class="stat-delta">${s.tablesDelta}</div>
      </div>
      <div class="stat-card c-yellow">
        <div class="stat-num">${s.tempsMoyen} <small>min</small></div>
        <div class="stat-label">Temps moyen</div>
        <div class="stat-delta">${s.tempsDelta}</div>
      </div>
    `;
  }

  const statusFlow = ['prep', 'ready', 'served'];
  const statusLabel = { prep:'En préparation', ready:'Prêt', served:'Servi' };

  let ordersState = [
    { id:414, table:'Table 12', status:'prep', time:'12 : 54' },
    { id:418, table:'Table 2', status:'ready', time:'12 : 40' },
    { id:411, table:'Table 8', status:'served', time:'12 : 34' },
    { id:423, table:'Table 20', status:'served', time:'12 : 14' },
  ];

  function renderOrders(){
    const tbody = document.getElementById('orders-tbody');
    if (!tbody) return;
    tbody.innerHTML = ordersState.map(o => `
      <tr>
        <td># ${o.id}</td>
        <td class="col-table">${o.table}</td>
        <td class="col-status"><span class="badge ${o.status}">${statusLabel[o.status]}</span></td>
        <td class="col-time">${o.time}</td>
      </tr>
    `).join('');
  }

  function nowHHMM(){
    const d = new Date();
    return String(d.getHours()).padStart(2,'0') + ' : ' + String(d.getMinutes()).padStart(2,'0');
  }

  function refreshDashboard(){
    const btn = document.getElementById('refresh-btn');
    if (btn) {
      btn.classList.add('spinning');
      setTimeout(() => btn.classList.remove('spinning'), 600);
    }

    ordersState = ordersState.map(o => {
      const idx = statusFlow.indexOf(o.status);
      const nextStatus = idx < statusFlow.length - 1 ? statusFlow[idx + 1] : o.status;
      return { ...o, status: nextStatus, time: nextStatus !== o.status ? nowHHMM() : o.time };
    });

    const nextId = Math.max(...ordersState.map(o => o.id)) + Math.ceil(Math.random() * 4);
    const nextTable = 'Table ' + (Math.ceil(Math.random() * 24));
    ordersState.unshift({ id: nextId, table: nextTable, status: 'prep', time: nowHHMM() });
    ordersState = ordersState.slice(0, 4);

    dashboardState.commandes += 1;
    dashboardState.tablesOccupees = Math.min(30, dashboardState.tablesOccupees + (Math.random() > 0.5 ? 1 : 0));

    renderOrders();
    renderStats();
  }

  const refreshBtn = document.getElementById('refresh-btn');
  if (refreshBtn) {
    refreshBtn.addEventListener('click', refreshDashboard);
  }

  renderTopsDuMoment();
  renderStats();
  renderOrders();
});
</script>
@endpush