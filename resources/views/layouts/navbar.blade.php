{{-- PURE NAVBAR ONLY - NO EXTENDS, NO SECTIONS, NO CSS BLOAT --}}

<header class="main-header" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; padding: 12px 5%; background: var(--bg-glass); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); transition: 0.3s; min-height: 80px; display: flex; align-items: center;">
  <div style="display:flex; justify-content:space-between; align-items:center; width: 100%;">
    <a href="/" style="display:flex; align-items:center; gap:10px; font-family:'Poppins',sans-serif; font-weight:900; font-size:1.3rem; background:linear-gradient(135deg,#0a7c4e,#1dbf73); -webkit-background-clip:text; -webkit-text-fill-color:transparent; text-decoration:none; white-space:nowrap;">
      <img src="{{ asset('images/logo.png') }}" height="40" alt="Logo" style="object-fit: contain;">
      Markaz Dimsum
    </a>

    <button class="mobile-toggle" onclick="toggleMenu()" style="display:none; background:none; border:none; font-size:1.8rem; color:var(--text); cursor:pointer; padding:5px;">
      <i class="bi bi-list"></i>
    </button>

    <div class="nav-links" id="navLinks" style="display:flex; align-items:center; gap:10px;">
      <a href="/" style="font-weight:600; padding:10px 16px; border-radius:12px; color:var(--text); text-decoration:none; transition:.2s; font-size:0.95rem;">Beranda</a>
      <a href="#produk" style="font-weight:600; padding:10px 16px; border-radius:12px; color:var(--text); text-decoration:none; transition:.2s; font-size:0.95rem;">Produk</a>
      <a href="#testi" style="font-weight:600; padding:10px 16px; border-radius:12px; color:var(--text); text-decoration:none; transition:.2s; font-size:0.95rem;">Testimoni</a>
      <a href="/login" style="padding:10px 24px; border-radius:999px; background:linear-gradient(135deg,#0a7c4e,#1dbf73); color:#fff; font-weight:700; text-decoration:none; border:none; transition:0.3s; white-space:nowrap;">Admin</a>

      <button id="themeToggle" style="width:40px; height:40px; border-radius:50%; border:2px solid #0a7c4e; background:transparent; color:var(--text); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:0.3s; flex-shrink:0;">
        <i id="themeIcon" class="bi bi-sun-fill"></i>
      </button>
    </div>
  </div>
</header>

<style>
  @media (max-width: 992px) {
    .nav-links {
      position: fixed;
      top: 80px;
      left: 0;
      right: 0;
      background: var(--card);
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      gap: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transform: translateY(-150%);
      opacity: 0;
      visibility: hidden;
      transition: all 0.4s ease;
    }
    .nav-links.active {
      transform: translateY(0);
      opacity: 1;
      visibility: visible;
    }
    .mobile-toggle { display: block !important; }
  }
</style>

<script>
function toggleMenu(){const nav=document.getElementById('navLinks');nav.classList.toggle('active');}
(function(){const html=document.documentElement;const btn=document.getElementById('themeToggle');const icon=document.getElementById('themeIcon');function applyTheme(theme){html.setAttribute('data-theme',theme);localStorage.setItem('theme',theme);icon.className=theme==='dark'?'bi bi-moon-stars-fill':'bi bi-sun-fill';}const saved=localStorage.getItem('theme')||'light';applyTheme(saved);if(btn){btn.addEventListener('click',function(){const current=html.getAttribute('data-theme');applyTheme(current==='dark'?'light':'dark');});}})();
</script>
