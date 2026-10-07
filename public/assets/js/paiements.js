// =========================================================
// PAGE PAIEMENTS — génération dynamique du tableau / des cartes
// Vanilla JavaScript uniquement
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

  const payments = [
    { id: '#P_244', table: 'Table 12', montant: '45 000',  mode: 'especes', modeLabel: 'Espèces',       date: '15/07/2026', heure: '10 : 49' },
    { id: '#P_21',  table: 'Table 17', montant: '19 000',  mode: 'mobile',  modeLabel: 'Mobile money',   date: '15/07/2026', heure: '11 : 12' },
    { id: '#P_225', table: 'Table 1',  montant: '33 070',  mode: 'especes', modeLabel: 'Espèces',       date: '15/07/2026', heure: '11 : 47' },
    { id: '#P_75',  table: 'Table 5',  montant: '18 075',  mode: 'carte',   modeLabel: 'Carte bancaire', date: '15/07/2026', heure: '14 : 23' },
    { id: '#P_97',  table: 'Table 10', montant: '29 075',  mode: 'carte',   modeLabel: 'Carte bancaire', date: '15/07/2026', heure: '18 : 42' },
    { id: '#P_225', table: 'Table 8',  montant: '33 070',  mode: 'especes', modeLabel: 'Espèces',       date: '15/07/2026', heure: '11 : 47' },
    { id: '#P_21',  table: 'Table 16', montant: '26 000',  mode: 'mobile',  modeLabel: 'Mobile money',   date: '15/07/2026', heure: '16 : 19' },
    { id: '#P_21',  table: 'Table 19', montant: '120 000', mode: 'mobile',  modeLabel: 'Mobile money',   date: '15/07/2026', heure: '16 : 43' },
    { id: '#P_21',  table: 'Table 22', montant: '59 000',  mode: 'mobile',  modeLabel: 'Mobile money',   date: '15/07/2026', heure: '15 : 02' },
  ];

  const modeIcons = {
    especes: 'fa-solid fa-money-bill-wave',
    mobile: 'fa-solid fa-mobile-screen-button',
    carte: 'fa-solid fa-credit-card'
  };

  const tbody = document.getElementById('paymentsTableBody');
  const cardsWrap = document.getElementById('paymentsCards');

  payments.forEach(function (p) {
    // Ligne de tableau
    const tr = document.createElement('tr');
    tr.innerHTML =
      '<td>' + p.id + '</td>' +
      '<td class="muted">' + p.table + '</td>' +
      '<td>' + p.montant + 'Fcfa</td>' +
      '<td><div class="mode-cell"><span class="mode-icon ' + p.mode + '"><i class="' + modeIcons[p.mode] + '"></i></span>' + p.modeLabel + '</div></td>' +
      '<td class="muted">' + p.date + '<br>' + p.heure + '</td>' +
      '<td><span class="status-badge"><i class="fa-solid fa-check"></i> Payé</span></td>';
    tbody.appendChild(tr);

    // Carte mobile
    const card = document.createElement('div');
    card.className = 'payment-card-item';
    card.innerHTML =
      '<div class="row1">' +
        '<span class="pid">' + p.id + '</span>' +
        '<span class="status-badge"><i class="fa-solid fa-check"></i> Payé</span>' +
      '</div>' +
      '<div class="grid2">' +
        '<div><div class="k">Table</div><div class="v">' + p.table + '</div></div>' +
        '<div><div class="k">Montant</div><div class="v">' + p.montant + ' Fcfa</div></div>' +
        '<div><div class="k">Mode</div><div class="v">' + p.modeLabel + '</div></div>' +
        '<div><div class="k">Date</div><div class="v">' + p.date + ' · ' + p.heure + '</div></div>' +
      '</div>';
    cardsWrap.appendChild(card);
  });

});
