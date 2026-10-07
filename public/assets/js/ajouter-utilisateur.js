// =========================================================
// PAGE AJOUTER UN UTILISATEUR — synchronisation en temps réel
// du formulaire vers l'aperçu, sans rechargement de page
// Vanilla JavaScript uniquement
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

  const fullName   = document.getElementById('fullName');
  const userEmail  = document.getElementById('userEmail');
  const userPhone  = document.getElementById('userPhone');
  const userRole   = document.getElementById('userRole');
  const photoInput = document.getElementById('photoInput');

  const previewPhoto    = document.getElementById('previewPhoto');
  const previewName     = document.getElementById('previewName');
  const previewRole     = document.getElementById('previewRole');
  const previewPhone    = document.getElementById('previewPhone');
  const previewEmail    = document.getElementById('previewEmail');
  const previewFunction = document.getElementById('previewFunction');

  function avatarUrlFor(name) {
    const label = name && name.trim() ? name.trim() : 'Nouvel Utilisateur';
    return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(label) +
           '&background=EEF1FF&color=7B1C2A&bold=true&size=170';
  }

  function updatePreview() {
    // Nom
    const name = fullName.value.trim();
    previewName.textContent = name || 'Nouvel utilisateur';

    // Rôle
    const role = userRole.value;
    previewRole.textContent = role || 'Rôle non défini';
    previewFunction.textContent = role || 'Fonction non définie';

    // Téléphone
    const phone = userPhone.value.trim();
    previewPhone.textContent = phone ? ('+229 ' + phone) : '+229 —';

    // Email
    const email = userEmail.value.trim();
    previewEmail.textContent = email || 'adresse@email.com';

    // Photo (uniquement si aucun fichier n'a été importé manuellement)
    if (!photoInput.files || !photoInput.files.length) {
      previewPhoto.src = avatarUrlFor(name);
    }
  }

  [fullName, userEmail, userPhone, userRole].forEach(function (el) {
    el.addEventListener('input', updatePreview);
    el.addEventListener('change', updatePreview);
  });

  // Import de photo -> aperçu instantané via FileReader
  photoInput.addEventListener('change', function () {
    const file = photoInput.files && photoInput.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
      previewPhoto.src = e.target.result;
    };
    reader.readAsDataURL(file);
  });

  updatePreview();
});
