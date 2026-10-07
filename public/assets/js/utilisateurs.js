// =========================================================
// PAGE UTILISATEURS — rendu dynamique + filtres + recherche
// Vanilla JavaScript uniquement
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

  const users = [
    { name: 'Sarah Duchesse', email: 'sarahduch34@gmail.com', role: 'super-administrateur', roleLabel: 'Super Administrateur', roleColor: 'orange', roleIcon: 'fa-crown', phone: '+229 01 97 21 45 78', status: 'actif', photo: 'https://i.pravatar.cc/100?img=47' },
    { name: 'Clara Ryce', email: 'ryceclara@gmail.com', role: 'serveur', roleLabel: 'Serveuse', roleColor: 'violet', roleIcon: 'fa-bell-concierge', phone: '+229 01 97 21 45 78', status: 'actif', photo: 'https://i.pravatar.cc/100?img=32' },
    { name: 'Ridwane Fitts', email: 'ridwane@gmail.com', role: 'cuisinier', roleLabel: 'Cuisinier', roleColor: 'vert', roleIcon: 'fa-utensils', phone: '+229 01 97 21 45 78', status: 'desactive', photo: 'https://i.pravatar.cc/100?img=13' },
    { name: 'Daniel Common', email: 'commondaniel4@gmail.com', role: 'serveur', roleLabel: 'Serveur', roleColor: 'violet', roleIcon: 'fa-bell-concierge', phone: '+229 01 97 21 45 78', status: 'actif', photo: 'https://i.pravatar.cc/100?img=51' },
    { name: 'Martin QUENUM', email: 'quenummart@gmail.com', role: 'administrateur', roleLabel: 'Administrateur', roleColor: 'orange', roleIcon: 'fa-crown', phone: '+229 01 97 21 45 78', status: 'desactive', photo: 'https://i.pravatar.cc/100?img=60' },
  ];

  const tbody = document.getElementById('usersTableBody');
  const cardsWrap = document.getElementById('usersCards');

  function statusMarkup(status) {
    const label = status === 'actif' ? 'Actif' : 'Désactivé';
    return '<span class="avail-badge ' + status + '"><span class="dot"></span> ' + label + '</span>';
  }

  function roleMarkup(u) {
    return '<span class="role-badge ' + u.roleColor + '"><i class="fa-solid ' + u.roleIcon + '"></i> ' + u.roleLabel + '</span>';
  }

  function render() {
    tbody.innerHTML = '';
    cardsWrap.innerHTML = '';

    users.forEach(function (u) {
      // Ligne de tableau
      const tr = document.createElement('tr');
      tr.setAttribute('data-role', u.role);
      tr.innerHTML =
        '<td><div class="user-cell"><img src="' + u.photo + '" alt="' + u.name + '"><div><div class="name">' + u.name + '</div><div class="email">' + u.email + '</div></div></div></td>' +
        '<td>' + roleMarkup(u) + '</td>' +
        '<td>' + u.phone + '</td>' +
        '<td>' + statusMarkup(u.status) + '</td>' +
        '<td><div class="d-flex gap-2"><button class="action-btn edit"><i class="fa-solid fa-pen"></i> Modifier</button><button class="action-btn delete"><i class="fa-solid fa-trash"></i> Supprimer</button></div></td>';
      tbody.appendChild(tr);

      // Carte mobile
      const card = document.createElement('div');
      card.className = 'user-card-item';
      card.setAttribute('data-role', u.role);
      card.innerHTML =
        '<div class="head"><img src="' + u.photo + '" alt="' + u.name + '"><div><div class="name">' + u.name + '</div><div class="email">' + u.email + '</div></div></div>' +
        '<div class="rowline"><span class="k">Rôle</span>' + roleMarkup(u) + '</div>' +
        '<div class="rowline"><span class="k">Téléphone</span><span>' + u.phone + '</span></div>' +
        '<div class="rowline"><span class="k">Disponibilité</span>' + statusMarkup(u.status) + '</div>' +
        '<div class="actions"><button class="action-btn edit"><i class="fa-solid fa-pen"></i> Modifier</button><button class="action-btn delete"><i class="fa-solid fa-trash"></i> Supprimer</button></div>';
      cardsWrap.appendChild(card);
    });
  }

  render();

  // --- Filtres par rôle ---
  const chips = document.querySelectorAll('.filter-chip');
  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      chips.forEach(function (c) { c.classList.remove('active'); });
      chip.classList.add('active');
      const filter = chip.getAttribute('data-filter');

      document.querySelectorAll('#usersTableBody tr, #usersCards .user-card-item').forEach(function (row) {
        const role = row.getAttribute('data-role');
        const visible = filter === 'tous' || role === filter;
        row.style.display = visible ? '' : 'none';
      });
    });
  });

  // --- Recherche par nom / email ---
  const searchInput = document.querySelector('.search-group input');
  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const term = searchInput.value.trim().toLowerCase();
      document.querySelectorAll('#usersTableBody tr').forEach(function (row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
      document.querySelectorAll('#usersCards .user-card-item').forEach(function (card) {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(term) ? '' : 'none';
      });
    });
  }

});
