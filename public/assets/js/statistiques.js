// =========================================================
// PAGE STATISTIQUES — graphiques 100% SVG en JavaScript vanilla
// (aucune bibliothèque de graphiques externe)
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

  const SVG_NS = 'http://www.w3.org/2000/svg';

  function el(tag, attrs) {
    const e = document.createElementNS(SVG_NS, tag);
    for (const k in attrs) e.setAttribute(k, attrs[k]);
    return e;
  }

  function formatCompact(n) {
    if (n >= 1000000) {
      const v = n / 1000000;
      return (v % 1 === 0 ? v.toFixed(0) : v.toFixed(2).replace(/0$/, '').replace(/\.$/, '')) + 'm';
    }
    if (n >= 1000) return (n / 1000).toFixed(0) + 'k';
    return String(n);
  }

  /* =======================================================
     1) COURBE — Evolution du chiffre d'affaire
     Echelle verticale non-linéaire (paliers), pour rester
     lisible sur une très large plage de valeurs.
     ======================================================= */
  (function renderRevenueChart() {
    const ticks = [0, 120000, 200000, 300000, 500000, 750000, 1000000, 1500000, 5500000, 10000000, 20000000];
    const tickLabels = ['0', '120k', '200k', '300k', '500k', '750k', '1m', '1.50m', '5.50m', '10m', '20m'];

    const data = [
      { label: '01/07', value: 500000 },
      { label: '02/07', value: 1000000 },
      { label: '03/07', value: 780000 },
      { label: '04/07', value: 1000000 },
      { label: '05/07', value: 1500000 },
      { label: '06/07', value: 1000000 },
      { label: '07/07', value: 1500000 },
      { label: '08/07', value: 5000000 },
      { label: '09/07', value: 9800000 }
    ];

    function valueToFraction(value) {
      for (let i = 0; i < ticks.length - 1; i++) {
        if (value <= ticks[i + 1]) {
          const local = (value - ticks[i]) / (ticks[i + 1] - ticks[i]);
          return (i + local) / (ticks.length - 1);
        }
      }
      return 1;
    }

    const width = 980, height = 400;
    const padLeft = 64, padRight = 24, padTop = 16, padBottom = 40;
    const plotW = width - padLeft - padRight;
    const plotH = height - padTop - padBottom;

    const svg = el('svg', { viewBox: '0 0 ' + width + ' ' + height, xmlns: SVG_NS });

    const defs = el('defs', {});
    const grad = el('linearGradient', { id: 'revenueGradient', x1: '0', y1: '0', x2: '0', y2: '1' });
    grad.appendChild(el('stop', { offset: '0%', 'stop-color': '#7B1C2A', 'stop-opacity': '0.32' }));
    grad.appendChild(el('stop', { offset: '100%', 'stop-color': '#7B1C2A', 'stop-opacity': '0' }));
    defs.appendChild(grad);
    svg.appendChild(defs);

    // Grille horizontale + labels Y
    ticks.forEach(function (t, i) {
      const frac = i / (ticks.length - 1);
      const y = padTop + (1 - frac) * plotH;
      svg.appendChild(el('line', { x1: padLeft, x2: width - padRight, y1: y, y2: y, stroke: 'rgba(123,28,42,0.08)', 'stroke-width': '1' }));
      const txt = el('text', { x: padLeft - 12, y: y + 4, 'text-anchor': 'end', 'font-size': '12', fill: '#7A7686', 'font-family': 'Playfair Display, serif' });
      txt.textContent = tickLabels[i];
      svg.appendChild(txt);
    });

    // Points (x,y)
    const points = data.map(function (d, i) {
      const x = padLeft + (i / (data.length - 1)) * plotW;
      const frac = valueToFraction(d.value);
      const y = padTop + (1 - frac) * plotH;
      return { x: x, y: y, label: d.label, value: d.value };
    });

    // Aire remplie
    let areaD = 'M ' + points[0].x + ',' + (padTop + plotH);
    points.forEach(function (p) { areaD += ' L ' + p.x + ',' + p.y; });
    areaD += ' L ' + points[points.length - 1].x + ',' + (padTop + plotH) + ' Z';
    svg.appendChild(el('path', { d: areaD, fill: 'url(#revenueGradient)', stroke: 'none' }));

    // Ligne
    let lineD = 'M ' + points.map(function (p) { return p.x + ',' + p.y; }).join(' L ');
    svg.appendChild(el('path', { d: lineD, fill: 'none', stroke: '#7B1C2A', 'stroke-width': '2.5', 'stroke-linejoin': 'round', 'stroke-linecap': 'round' }));

    // Points + labels X
    points.forEach(function (p) {
      svg.appendChild(el('circle', { cx: p.x, cy: p.y, r: '4.5', fill: '#7B1C2A', stroke: '#fff', 'stroke-width': '1.5' }));
      const txt = el('text', { x: p.x, y: height - 12, 'text-anchor': 'middle', 'font-size': '12.5', fill: '#2A1E20', 'font-family': 'Playfair Display, serif' });
      txt.textContent = p.label;
      svg.appendChild(txt);
    });

    document.getElementById('revenueChart').appendChild(svg);
  })();

  /* =======================================================
     2) CAMEMBERT — Répartition des ventes par catégories
     ======================================================= */
  (function renderPieChart() {
    const data = [
      { label: 'Boissons', value: 14, color: '#8C4AF2' },
      { label: 'Coktails', value: 5, color: 'rgba(47,128,237,0.55)' },
      { label: 'Desserts et glaces', value: 5, color: 'rgba(232,17,45,0.55)' },
      { label: 'Cuisine de rue', value: 22, color: '#7B1C2A' },
      { label: 'Spécialités grillées', value: 18, color: '#FF9500' },
      { label: 'Spécialités africaines', value: 16, color: '#2F80ED' },
      { label: 'Pâtes alimentaires', value: 12, color: '#FFBF0D' },
      { label: 'Petit déjeuner', value: 8, color: '#31AA1C' }
    ];

    const size = 300, cx = 150, cy = 150, r = 138;
    const svg = el('svg', { viewBox: '0 0 ' + size + ' ' + size, xmlns: SVG_NS });

    let angle = -90; // départ en haut
    data.forEach(function (d) {
      const sweep = (d.value / 100) * 360;
      const start = angle;
      const end = angle + sweep;
      const startRad = (Math.PI / 180) * start;
      const endRad = (Math.PI / 180) * end;
      const x1 = cx + r * Math.cos(startRad);
      const y1 = cy + r * Math.sin(startRad);
      const x2 = cx + r * Math.cos(endRad);
      const y2 = cy + r * Math.sin(endRad);
      const largeArc = sweep > 180 ? 1 : 0;
      const d_attr = 'M ' + cx + ',' + cy + ' L ' + x1 + ',' + y1 + ' A ' + r + ',' + r + ' 0 ' + largeArc + ',1 ' + x2 + ',' + y2 + ' Z';
      svg.appendChild(el('path', { d: d_attr, fill: d.color, stroke: '#fff', 'stroke-width': '2' }));

      // Label pourcentage
      const midRad = (Math.PI / 180) * (start + sweep / 2);
      const lx = cx + (r * 0.62) * Math.cos(midRad);
      const ly = cy + (r * 0.62) * Math.sin(midRad);
      const txt = el('text', { x: lx, y: ly + 4, 'text-anchor': 'middle', 'font-size': '15', 'font-weight': '700', fill: '#fff', 'font-family': 'Playfair Display, serif' });
      txt.textContent = d.value + '%';
      svg.appendChild(txt);

      angle = end;
    });

    document.getElementById('pieChart').appendChild(svg);

    // Légende
    const legend = document.getElementById('pieLegend');
    data.slice().reverse().forEach(function (d) {
      const row = document.createElement('div');
      row.className = 'pie-legend-item';
      row.innerHTML = '<span class="dot" style="background:' + d.color + '"></span>' + d.label;
      legend.appendChild(row);
    });
    // Réordonner dans l'ordre "métier" attendu (Cuisine de rue en premier)
    const order = ['Cuisine de rue', 'Spécialités grillées', 'Spécialités africaines', 'Pâtes alimentaires', 'Petit déjeuner', 'Boissons', 'Coktails', 'Desserts et glaces'];
    const rows = Array.prototype.slice.call(legend.children);
    rows.sort(function (a, b) {
      return order.indexOf(a.textContent.trim()) - order.indexOf(b.textContent.trim());
    });
    rows.forEach(function (r) { legend.appendChild(r); });
  })();

  /* =======================================================
     3) BARRES — Evolution du nombre de commandes
     ======================================================= */
  (function renderOrdersChart() {
    const data = [
      { label: '01/07', value: 58 },
      { label: '02/07', value: 83 },
      { label: '03/07', value: 75 },
      { label: '04/07', value: 113 },
      { label: '05/07', value: 125 },
      { label: '06/07', value: 62 },
      { label: '07/07', value: 147 }
    ];

    const maxVal = 150;
    const yTicks = [0, 25, 50, 75, 100, 125, 150];

    const width = 900, height = 340;
    const padLeft = 50, padRight = 20, padTop = 30, padBottom = 40;
    const plotW = width - padLeft - padRight;
    const plotH = height - padTop - padBottom;

    const svg = el('svg', { viewBox: '0 0 ' + width + ' ' + height, xmlns: SVG_NS });

    yTicks.forEach(function (t) {
      const y = padTop + (1 - t / maxVal) * plotH;
      svg.appendChild(el('line', { x1: padLeft, x2: width - padRight, y1: y, y2: y, stroke: 'rgba(123,28,42,0.08)', 'stroke-width': '1' }));
      const txt = el('text', { x: padLeft - 12, y: y + 4, 'text-anchor': 'end', 'font-size': '13', fill: '#2A1E20', 'font-weight': '600', 'font-family': 'Playfair Display, serif' });
      txt.textContent = t;
      svg.appendChild(txt);
    });

    const slotW = plotW / data.length;
    const barW = slotW * 0.42;

    data.forEach(function (d, i) {
      const barH = (d.value / maxVal) * plotH;
      const x = padLeft + i * slotW + (slotW - barW) / 2;
      const y = padTop + plotH - barH;

      svg.appendChild(el('rect', { x: x, y: y, width: barW, height: barH, rx: '6', fill: 'rgba(123,28,42,0.42)' }));

      const valTxt = el('text', { x: x + barW / 2, y: y - 10, 'text-anchor': 'middle', 'font-size': '16', 'font-weight': '700', fill: '#7B1C2A', 'font-family': 'Playfair Display, serif' });
      valTxt.textContent = d.value;
      svg.appendChild(valTxt);

      const lblTxt = el('text', { x: x + barW / 2, y: height - 12, 'text-anchor': 'middle', 'font-size': '13.5', fill: '#2A1E20', 'font-family': 'Playfair Display, serif' });
      lblTxt.textContent = d.label;
      svg.appendChild(lblTxt);
    });

    document.getElementById('ordersChart').appendChild(svg);
  })();

  /* =======================================================
     Filtres de période — bascule visuelle (données statiques
     pour cette maquette front-end)
     ======================================================= */
  document.querySelectorAll('.period-chip').forEach(function (chip) {
    chip.addEventListener('click', function () {
      document.querySelectorAll('.period-chip').forEach(function (c) { c.classList.remove('active'); });
      chip.classList.add('active');
    });
  });

});