// =========================================================
// PAGE PARAMÈTRES — gestion de l'onglet actif "Sous-modules"
// Vanilla JavaScript uniquement
// =========================================================
document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.submodule-list .btn');

  buttons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      buttons.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
    });
  });
});
