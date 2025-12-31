{{-- PURE NAVBAR ONLY - NO EXTENDS, NO SECTIONS, NO CSS --}}

<header class="main-header" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; padding: 12px 5%; background: var(--bg-glass); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); transition: 0.3s; min-height: 80px; display: flex; align-items: center;">
  <div style="display:flex; justify-content:space-between; align-items:center; width: 100%;">
    <a href="/" style="display:flex; align-items:center; gap:10px; font-family:'Poppins',sans-serif; font-weight:900; font-size:1.3rem; background:linear-gradient(135deg,#0a7c4e,#1dbf73); -webkit-background-clip:text; -webkit-text-fill-color:transparent; text-decoration:none; white-space:nowrap;">
      <img src="{{ asset('images/logo.png') }}" height="40" alt="Logo" style="object-fit:contain;">
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

<script>
function toggleMenu(){const nav=document.getElementById('navLinks');nav.classList.toggle('active');}
(function(){const html=document.documentElement;const btn=document.getElementById('themeToggle');const icon=document.getElementById('themeIcon');function applyTheme(theme){html.setAttribute('data-theme',theme);localStorage.setItem('theme',theme);icon.className=theme==='dark'?'bi bi-moon-stars-fill':'bi bi-sun-fill';}const saved=localStorage.getItem('theme')||'light';applyTheme(saved);if(btn){btn.addEventListener('click',function(){const current=html.getAttribute('data-theme');applyTheme(current==='dark'?'light':'dark');});}})();
</script>

<style>
  :root {
    --primary: #059669;
    --secondary: #1dbf73;
    --text: #0f172a;
    --bg: #f8fafc;
    --card: #ffffff;
    --muted: #64748b;
    --bg-glass: rgba(255,255,255,0.7);
    --shadow: 0 10px 35px rgba(0,0,0,0.1);
    --gradient: linear-gradient(135deg, #0a7c4e, #1dbf73);
    --radius: 24px;
  }

  [data-theme="dark"] {
    --bg: #020617;
    --card: #0f172a;
    --text: #e5e7eb;
    --muted: #94a3b8;
    --bg-glass: rgba(2,6,23,0.85);
    --shadow: 0 15px 45px rgba(0,0,0,0.85);
  }

  * { scroll-behavior: smooth; }
  
  body {
    margin: 0;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: var(--bg);
    color: var(--text);
    line-height: 1.6;
    padding-top: 80px; /* Sesuaikan dengan tinggi header */
  }

  /* ================= HEADER (RESPONSIF & STABLE) ================= */
  .main-header {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 9999; /* Z-Index tinggi agar selalu di atas */
    padding: 12px 5%;
    background: var(--bg-glass);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: 0.3s;
    min-height: 80px;
    display: flex;
    align-items: center;
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 900;
    font-size: 1.3rem;
    background: var(--gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-decoration: none;
    white-space: nowrap; /* Mencegah logo turun baris */
  }
  
  .logo img {
    object-fit: contain;
  }

  /* Desktop Nav */
  .nav-links {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .nav-link {
    font-weight: 600;
    padding: 10px 16px;
    border-radius: 12px;
    color: var(--text);
    text-decoration: none;
    transition: 0.2s;
    font-size: 0.95rem;
  }

  .nav-link:hover { 
    background: rgba(10, 124, 78, 0.05); 
    color: var(--primary); 
  }

  .btn-admin {
    padding: 10px 24px;
    border-radius: 999px;
    background: var(--gradient);
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    border: none;
    transition: 0.3s;
    white-space: nowrap;
  }

  .btn-admin:hover { 
    opacity: 0.9; 
    transform: translateY(-2px); 
  }

  .btn-theme {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--primary);
    background: transparent;
    color: var(--text);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: 0.3s;
    flex-shrink: 0;
  }

  .btn-theme:hover { 
    background: var(--primary); 
    color: #fff; 
  }

  .mobile-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.8rem;
    color: var(--text);
    cursor: pointer;
    padding: 5px;
  }

  /* Desktop: White text & icons */
  @media (min-width: 993px) {
    .main-header .logo,
    .main-header a,
    .main-header .nav-link,
    .main-header #themeIcon {
      color: #fff !important;
    }

    .main-header .btn-theme,
    .main-header .btn-theme i {
      border-color: #fff !important;
      color: #fff !important;
    }
  }

  /* Mobile: Nav Menu & Toggle */
  @media (max-width: 992px) {
    .mobile-toggle { 
      display: block !important; 
    }

    .main-header .mobile-toggle i { 
      color: var(--text) !important; 
    }

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
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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

    .nav-link,
    .btn-admin {
      width: 100%;
      max-width: 300px;
      text-align: center;
      display: block;
    }

    .logo { 
      font-size: 1.1rem; 
    }

    .logo img { 
      height: 32px; 
    }
  }

  /* ================= HERO SECTION ================= */
  .hero {
    position: relative;
    min-height: 600px;
    height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-top: -80px; /* Kompensasi padding body agar gambar full sampai atas */
    padding-top: 80px;
  }

  .hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1.5s ease;
    z-index: 0;
  }

  .hero-slide.active { 
    opacity: 1; 
  }

  .hero-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6);
  }

  .hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
    padding: 0 20px;
    max-width: 800px;
  }

  .hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 6vw, 3.5rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 16px;
  }

  .hero p {
    font-size: clamp(1rem, 2vw, 1.1rem);
    margin-bottom: 30px;
    opacity: 0.9;
  }

  .btn-main {
    display: inline-block;
    padding: 12px 32px;
    background: var(--gradient);
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: 0.3s;
  }
  .btn-main:hover { transform: scale(1.05); }

  /* ================= SECTIONS ================= */
  section { padding: 60px 20px; }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
  }

  .section-title {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 10px;
  }
  
  .section-desc {
    text-align: center;
    color: var(--muted);
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  /* ================= PRODUCT GRID (RESPONSIF) ================= */
  .product-grid {
    display: grid;
    gap: 24px;
    /* Default Mobile: 1 Kolom */
    grid-template-columns: 1fr; 
  }

  /* Tablet: 2 Kolom */
  @media (min-width: 600px) {
    .product-grid { grid-template-columns: repeat(2, 1fr); }
  }
  
  /* Desktop: Auto Fit */
  @media (min-width: 1024px) {
    .product-grid { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
  }

  .card-product {
    background: var(--card);
    border-radius: 20px;
    overflow: hidden;
    text-decoration: none;
    color: var(--text);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
  }
  .card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }

  .card-img-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
  }

  .card-product img { 
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s;
  }

  .card-product:hover img { 
    transform: scale(1.05); 
  }

  .card-content { 
    padding: 16px; 
    flex-grow: 1; 
    display: flex; 
    flex-direction: column; 
  }

  .card-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--primary);
    color: #fff;
    font-size: 0.7rem;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: bold;
  }

  .card-product h4 { 
    margin: 0 0 8px; 
    font-size: 1.1rem; 
  }

  .card-price { 
    color: var(--primary); 
    font-weight: 700; 
    margin-top: auto; 
  }

  /* ================= FEATURES ================= */
  .feature-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
  }
  @media (min-width: 768px) {
    .feature-grid { grid-template-columns: 1fr 1fr; }
  }

  .feature-card {
    background: var(--card);
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid rgba(0,0,0,0.05);
  }

  /* ================= TESTIMONI ================= */
  .testi-scroller {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    padding-bottom: 20px;
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .testi-scroller::-webkit-scrollbar { 
    display: none; 
  }

  .testi-item {
    min-width: 300px;
    background: var(--card);
    padding: 24px;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    flex-shrink: 0;
  }

  /* ================= FOOTER ================= */
  footer {
    background: #020617;
    color: #cbd5e1;
    padding: 60px 20px 30px;
    margin-top: 60px;
  }
  
  .footer-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    margin-bottom: 40px;
  }

  /* Footer Tablet: 2 kolom */
  @media (min-width: 768px) {
    .footer-grid { 
      grid-template-columns: 1fr 1fr; 
    }
  }

  /* Footer Desktop: 4 kolom */
  @media (min-width: 1024px) {
    .footer-grid { 
      grid-template-columns: 2fr 1fr 1fr 1fr; 
    }
  }

  .brand-wrapper { 
    display: flex; 
    align-items: center; 
    gap: 12px; 
    margin-bottom: 16px; 
  }

  .footer-logo { 
    height: 40px; 
    object-fit: contain; 
  }

  footer h4 { 
    color: #fff; 
    margin-bottom: 16px; 
    font-size: 1.1rem; 
  }

  footer p,
  footer a { 
    color: #94a3b8; 
    font-size: 0.9rem; 
    text-decoration: none; 
    display: block; 
    margin-bottom: 8px; 
  }

  footer a:hover { 
    color: var(--primary); 
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 20px;
    text-align: center;
    font-size: 0.85rem;
    color: #64748b;
  }

  @media (max-width: 768px) {
    .brand-wrapper { 
      flex-direction: column; 
      text-align: center; 
    }

    .hero { 
      padding-top: 100px; 
    }

    section { 
      padding: 50px 15px; 
    }
  }
</style>
@endpush

@section('content')

{{-- HEADER --}}
<header class="main-header">
  <div style="display:flex; justify-content:space-between; align-items:center; width: 100%;">
    <a href="/" class="logo">
      <img src="{{ asset('images/logo.png') }}" height="40" alt="Logo">
      Markaz Dimsum
    </a>

    <button class="mobile-toggle" onclick="toggleMenu()">
      <i class="bi bi-list"></i>
    </button>

    <div class="nav-links" id="navLinks">
      <a href="/" class="nav-link" onclick="toggleMenu()">Beranda</a>
      <a href="#produk" class="nav-link" onclick="toggleMenu()">Produk</a>
      <a href="#testi" class="nav-link" onclick="toggleMenu()">Testimoni</a>
      <a href="/login" class="btn-admin" onclick="toggleMenu()">Admin</a>

      <button class="btn-theme" id="themeToggle">
        <i id="themeIcon" class="bi"></i>
      </button>
    </div>
  </div>
</header>


@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // AOS (Dimatikan sementara agar tidak konflik di mobile scroll, atau pakai once:true)
  // AOS.init({ once: true });

  // THEME TOGGLE
  (function(){
    const html = document.documentElement;
    const btn  = document.getElementById('themeToggle');
    const icon = document.getElementById('themeIcon');

    function applyTheme(theme){
      html.setAttribute('data-theme', theme);
      localStorage.setItem('theme', theme);
      icon.className = theme === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
    }

    const saved = localStorage.getItem('theme') || 'light';
    applyTheme(saved);

    if(btn) {
      btn.addEventListener('click', function(){
        const current = html.getAttribute('data-theme');
        applyTheme(current === 'dark' ? 'light' : 'dark');
      });
    }
  })();

  // MOBILE MENU
  function toggleMenu() {
    const nav = document.getElementById('navLinks');
    nav.classList.toggle('active');
  }

  // HERO SLIDER
  const slides = document.querySelectorAll('.hero-slide');
  let idx = 0;
  if(slides.length > 0){
    setInterval(()=>{
      slides[idx].classList.remove('active');
      idx = (idx + 1) % slides.length;
      slides[idx].classList.add('active');
    }, 5000);
  }
</script>
@endpush