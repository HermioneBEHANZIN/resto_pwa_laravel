// ===== MOBILE MENU TOGGLE =====
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const mobileMenu = document.getElementById('mobileMenu');
if (mobileMenuToggle && mobileMenu) {
  mobileMenuToggle.addEventListener('click', () => {
    mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
  });
}

// ===== CART =====
let cart = JSON.parse(localStorage.getItem('le-prestige-cart') || '[]');

function addToCart(name) {
  const existing = cart.find(i => i.name === name);
  if (existing) { existing.qty++; }
  else { cart.push({ name, qty: 1 }); }
  localStorage.setItem('le-prestige-cart', JSON.stringify(cart));
  showToast(`${name} ajouté au panier ✓`);
  updateCartBadge();
}

function updateCartBadge() {
  const total = cart.reduce((s, i) => s + i.qty, 0);
  document.querySelectorAll('.cart-badge').forEach(el => el.textContent = total);
}

// ===== TOAST =====
function showToast(msg) {
  const existing = document.querySelector('.prestige-toast');
  if (existing) existing.remove();
  const toast = document.createElement('div');
  toast.className = 'prestige-toast';
  toast.textContent = msg;
  toast.style.cssText = `
    position:fixed;bottom:90px;left:50%;transform:translateX(-50%);
    background:#1A1A1A;color:#fff;padding:12px 24px;border-radius:30px;
    font-size:0.85rem;font-weight:600;z-index:9999;
    box-shadow:0 4px 20px rgba(0,0,0,0.3);
    border:1px solid rgba(201,149,42,0.3);
    animation:slideUp 0.3s ease;
  `;
  document.body.appendChild(toast);
  setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 2500);
}

// ===== CATEGORY FILTER =====
document.querySelectorAll('.chip-category').forEach(chip => {
  chip.addEventListener('click', function(e) {
    document.querySelectorAll('.chip-category').forEach(c => c.classList.remove('active'));
    this.classList.add('active');
  });
});

// ===== FAVORITES =====
document.querySelectorAll('.btn-fav').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    this.textContent = this.textContent === '♡' ? '♥' : '♡';
    this.style.color = this.textContent === '♥' ? '#E53935' : '';
  });
});

// ===== SCROLL ANIMATIONS =====
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.style.opacity = '1';
      e.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.food-card, .food-card-list, .promo-banner').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(20px)';
  el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
  observer.observe(el);
});

// ===== CSS ANIMATION =====
const style = document.createElement('style');
style.textContent = `
  @keyframes slideUp {
    from { opacity:0; transform:translate(-50%, 20px); }
    to { opacity:1; transform:translate(-50%, 0); }
  }
`;
document.head.appendChild(style);

updateCartBadge();