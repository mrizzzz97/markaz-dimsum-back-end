@extends('layouts.app')

@section('title', 'Tentang Kami - Markaz Dimsum')

@push('styles')
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
  :root {
    --bg-color: #f6fff9;
    --text-color: #222;
    --card-bg: #fff;
    --header-bg: #fff;
    --border-color: #eee;
    --primary-color: #1dbf73;
    --primary-hover: #17a567;
    --modal-bg: rgba(255, 255, 255, 0.95);
    --shadow-color: rgba(0, 0, 0, 0.07);
  }

  [data-theme="dark"] {
    --bg-color: #181818;
    --text-color: #f0f0f0;
    --card-bg: #2a2a2a;
    --header-bg: #2a2a2a;
    --border-color: #444;
    --primary-color: #1dbf73;
    --primary-hover: #17a567;
    --modal-bg: rgba(42, 42, 42, 0.95);
    --shadow-color: rgba(0, 0, 0, 0.2);
  }

  body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    scroll-behavior: smooth;
    transition: background-color 0.3s ease, color 0.3s ease;
    overflow-x: hidden;
  }

  .main-header {
    background-color: var(--header-bg);
    border-bottom: 1px solid var(--border-color);
    padding: 0.75rem 1rem;
    box-shadow: 0 4px 10px var(--shadow-color);
    transition: background-color 0.3s ease, border-color 0.3s ease;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .main-header .nav-link {
    color: var(--text-color);
    font-weight: 500;
    position: relative;
    transition: color 0.3s ease;
    padding: 0.5rem 0;
  }

  .main-header .nav-link::after {
    content: '';
    display: block;
    width: 0;
    height: 2px;
    background: var(--primary-color);
    transition: 0.3s;
    margin-top: 4px;
  }

  .main-header .nav-link:hover::after {
    width: 100%;
  }

  .btn-success {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
  }

  .btn-success:hover {
    background-color: var(--primary-hover);
  }

  .btn-theme {
    border: none;
    background: none;
    font-size: 1.5rem;
    color: var(--primary-color);
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .btn-theme:hover {
    background-color: rgba(29, 191, 115, 0.1);
    transform: rotate(20deg);
  }

  .btn-theme:active {
    transform: scale(0.95);
  }

  /* Hamburger Menu Button */
  .hamburger-btn {
    display: inline-block;
    width: 30px;
    height: 24px;
    position: relative;
    cursor: pointer;
    background: transparent;
    border: none;
    padding: 0;
    margin: 0;
    z-index: 1101;
  }

  .hamburger-btn span {
    display: block;
    position: absolute;
    height: 3px;
    width: 100%;
    background: var(--text-color);
    border-radius: 3px;
    opacity: 1;
    left: 0;
    transform: rotate(0deg);
    transition: .25s ease-in-out;
  }

  .hamburger-btn span:nth-child(1) {
    top: 0px;
  }

  .hamburger-btn span:nth-child(2) {
    top: 10px;
  }

  .hamburger-btn span:nth-child(3) {
    top: 20px;
  }

  .hamburger-btn.open span:nth-child(1) {
    top: 10px;
    transform: rotate(135deg);
  }

  .hamburger-btn.open span:nth-child(2) {
    opacity: 0;
    left: -60px;
  }

  .hamburger-btn.open span:nth-child(3) {
    top: 10px;
    transform: rotate(-135deg);
  }

  .glass-card {
    background: var(--card-bg);
    border-radius: 1.25rem;
    padding: 2rem;
    box-shadow: 0 8px 30px var(--shadow-color);
    backdrop-filter: blur(10px);
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .content-section {
    margin-top: 5rem;
    padding-top: 2rem;
    padding-bottom: 4rem;
    max-width: 750px;
  }

  .text-success {
    color: var(--primary-color) !important;
  }

  .footer {
    background-color: var(--header-bg);
    border-top: 1px solid var(--border-color);
    color: var(--text-color);
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
    padding: 2rem 0;
  }

  /* Theme toggle animation */
  .theme-toggle-container {
    position: relative;
    display: inline-block;
  }

  .theme-toggle-tooltip {
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
  }

  .theme-toggle-container:hover .theme-toggle-tooltip {
    opacity: 1;
  }

  /* Mobile menu styles */
  .mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 280px;
    height: 100vh;
    background-color: var(--header-bg);
    box-shadow: -2px 0 10px var(--shadow-color);
    transition: right 0.3s ease;
    z-index: 1100;
    padding: 80px 20px 20px;
    overflow-y: auto;
  }

  .mobile-menu.active {
    right: 0;
  }

  .mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1099;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
  }

  .mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
  }

  .mobile-menu .nav-link {
    display: block;
    padding: 15px 0;
    border-bottom: 1px solid var(--border-color);
    font-size: 1.1rem;
    color: var(--text-color);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .mobile-menu .nav-link:hover {
    color: var(--primary-color);
  }

  .mobile-menu .btn-success {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
  }

  .mobile-menu .theme-section {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  /* Contact cards */
  .contact-card {
    background-color: var(--card-bg);
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 14px var(--shadow-color);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px var(--shadow-color);
  }

  .contact-icon {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
  }

  /* Map container */
  .map-container {
    border-radius: 1rem;
    overflow: hidden;
    height: 300px;
    box-shadow: 0 4px 14px var(--shadow-color);
  }

  /* Feature cards */
  .feature-card {
    background-color: var(--card-bg);
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 14px var(--shadow-color);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px var(--shadow-color);
  }

  .feature-icon {
    font-size: 2rem;
    color: var(--primary-color);
    margin-right: 1rem;
  }

  /* Team member cards */
  .team-card {
    background-color: var(--card-bg);
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 14px var(--shadow-color);
    transition: all 0.3s ease;
    height: 100%;
  }

  .team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px var(--shadow-color);
  }

  .team-img {
    height: 200px;
    object-fit: cover;
    width: 100%;
  }

  /* Smooth transition for all elements */
  * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .content-section {
      margin-top: 3rem;
      padding-top: 1rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .glass-card {
      padding: 1.5rem;
    }

    .main-header {
      padding: 0.75rem;
    }

    .main-header .logo-container img {
      height: 35px;
    }

    .main-header .logo-container span {
      font-size: 1.2rem;
    }
  }

  @media (max-width: 576px) {
    .glass-card {
      padding: 1rem;
    }

    .contact-card {
      margin-bottom: 1rem;
    }

    .feature-card {
      margin-bottom: 1rem;
    }
  }
</style>
@endpush


@section('content')
<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
  <a href="/" class="nav-link">
    <i class="bi bi-house-door mr-2"></i>Beranda
  </a>
  <a href="/tentang" class="nav-link">
    <i class="bi bi-info-circle mr-2"></i>Tentang
  </a>
  <a href="{{ route('home') }}#produk" class="nav-link">
    <i class="bi bi-box mr-2"></i>Produk
  </a>

  <a href="/login" class="btn btn-success">
    <i class="bi bi-person-lock mr-2"></i>Admin
  </a>
  
  <div class="theme-section">
    <span>Tema</span>
    <div class="theme-toggle-container">
      <button id="themeToggleBtnMobile" class="btn-theme">
        <i class="bi bi-sun-fill" id="themeIconMobile"></i>
      </button>
    </div>
  </div>
</div>

<!-- Header -->
<header class="main-header">
  <div class="d-flex justify-content-between align-items-center">
    <div class="logo-container d-flex align-items-center">
      <img src="{{ asset('images/logo.png') }}" height="40" class="mr-2">
      <span class="font-weight-bold text-success">Markaz Dimsum</span>
    </div>
    
    <!-- Desktop Navigation -->
    <div class="d-none d-md-flex align-items-center">
      <a href="/" class="nav-link">Beranda</a>
      <a href="/tentang" class="nav-link mx-3">Tentang</a>
      <a href="{{ route('home') }}#produk" class="nav-link">
          <i class="bi bi-box mr-2"></i>Produk
      </a>


      <a href="/login" class="btn btn-success ml-4 px-3">Admin</a>
      <div class="theme-toggle-container ml-3">
        <button id="themeToggleBtn" class="btn-theme">
          <i class="bi bi-sun-fill" id="themeIcon"></i>
        </button>
        <div class="theme-toggle-tooltip" id="themeTooltip">Ganti Tema</div>
      </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button class="hamburger-btn d-md-none" id="mobileMenuToggle">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>

<!-- Hero Section -->
<section class="container-fluid px-0 py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
        <h1 class="display-4 font-weight-bold text-success mb-4">Tentang Kami</h1>
        <p class="lead">Selamat datang di <strong>Markaz Dimsum</strong> — mitra kuliner Anda dalam sajian dimsum beku yang praktis, lezat, dan HALAL!</p>
        <p>Kami berkomitmen menyajikan rasa autentik Asia yang bisa Anda nikmati di rumah.</p>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <img src="{{ asset('images/about-hero.jpg') }}" class="img-fluid rounded-lg shadow" alt="Tentang Markaz Dimsum">
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="container py-5">
  <div class="row">
    <div class="col-lg-12" data-aos="fade-up">
      <div class="glass-card">
        <h2 class="font-weight-bold mb-4 text-success">Cerita Kami</h2>
        <p class="mb-3">
          Markaz Dimsum lahir dari kecintaan kami terhadap kuliner Asia dan kebutuhan akan makanan praktis yang tetap lezat. 
          Dimulai sebagai usaha kecil di rumah, kami telah berkembang menjadi merek yang dipercaya oleh ribuan pelanggan di seluruh Indonesia.
        </p>
        <p>
          Produk kami dibuat dari bahan-bahan terbaik, higienis, dan menggunakan metode <em>quick freezing</em> untuk menjaga rasa dan tekstur seperti baru dimasak.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="container py-5">
  <h2 class="text-center font-weight-bold mb-5 text-success" data-aos="fade-up">Kenapa Pilih Kami?</h2>
  <div class="row">
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
          <h4>100% Halal & Higienis</h4>
          <p>Semua produk kami tersertifikasi halal dan diproduksi dengan standar higienis tertinggi.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-tag-fill"></i>
        </div>
        <div>
          <h4>Harga Ramah di Kantong</h4>
          <p>Kami menawarkan produk berkualitas tinggi dengan harga yang terjangkau untuk semua kalangan.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-award-fill"></i>
        </div>
        <div>
          <h4>Kualitas Premium Rasa Restoran</h4>
          <p>Rasakan sensasi makanan restoran langsung dari dapur Anda dengan produk kami.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-people-fill"></i>
        </div>
        <div>
          <h4>Telah Dipercaya Ribuan Konsumen</h4>
          <p>Kepuasan pelanggan adalah prioritas utama kami, terbukti dengan ribuan pelanggan setia.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Location Section -->
<section class="container py-5">
  <h2 class="text-center font-weight-bold mb-5 text-success" data-aos="fade-up">Kunjungi Toko Kami</h2>
  <div class="row">
    <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
      <div class="map-container">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d107.05840731477057!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d8546adbf33%3A0x4e4ed8f8c6e8c6e8!2sSpring%20Fiesta!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
          width="100%" 
          height="100%" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>
    <div class="col-lg-6" data-aos="fade-left">
      <div class="glass-card h-100">
        <h4 class="font-weight-bold mb-3 text-success">Alamat Toko</h4>
        <p class="mb-4">
          <i class="bi bi-geo-alt-fill text-success mr-2"></i>
          Spring fiesta, Ak 9 No 20, Lambangsari, Tambun Selatan, Bekasi, Jawa Barat 17510
        </p>
        
        <h4 class="font-weight-bold mb-3 text-success">Jam Operasional</h4>
        <p class="mb-4">
          <i class="bi bi-clock-fill text-success mr-2"></i>
          Senin - Minggu: 09:00 - 21:00 WIB
        </p>
        
        <h4 class="font-weight-bold mb-3 text-success">Hubungi Kami</h4>
        <p>
          <i class="bi bi-whatsapp text-success mr-2"></i>
          WhatsApp: <a href="https://wa.me/6281770825467" target="_blank">+62 817-7082-5467</a><br>
          <i class="bi bi-instagram text-success mr-2"></i>
          Instagram: <a href="https://instagram.com/markazdimsum" target="_blank">@markazdimsum</a>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="container py-5">
  <h2 class="text-center font-weight-bold mb-5 text-success" data-aos="fade-up">Apa Kata Pelanggan Kami</h2>
  <div class="row">
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
      <div class="contact-card">
        <div class="mb-3">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
        <p class="mb-3">"Dimsumnya enak banget! Rasanya sama seperti di restoran, tapi harganya jauh lebih terjangkau. Recommended!"</p>
        <div>
          <strong>Siti Nurhaliza</strong>
          <small class="d-block text-muted">Pelanggan Setia</small>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="contact-card">
        <div class="mb-3">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
        <p class="mb-3">"Pengiriman cepat dan packing rapi. Dimsumnya masih beku sempurna saat sampai. Pasti order lagi!"</p>
        <div>
          <strong>Budi Santoso</strong>
          <small class="d-block text-muted">Pelanggan Baru</small>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
      <div class="contact-card">
        <div class="mb-3">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
        <p class="mb-3">"Sudah coba semua varian rasa dan favorit saya dimsum mentai. Halal dan enak, cocok untuk keluarga."</p>
        <div>
          <strong>Ahmad Fauzi</strong>
          <small class="d-block text-muted">Pelanggan Rutin</small>
        </div>
      </div>
    </div>
  </div>
</section>

@include('partials.footer')
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  $(document).ready(function () {
    // Initialize theme based on localStorage or system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
      document.documentElement.setAttribute('data-theme', 'dark');
      updateThemeIcon(true);
    }

    // Mobile menu functionality
    $('#mobileMenuToggle').on('click', function (e) {
      e.preventDefault();
      $(this).toggleClass('open');
      $('#mobileMenu').toggleClass('active');
      $('#mobileMenuOverlay').toggleClass('active');
      
      // Prevent body scroll when menu is open
      if ($('#mobileMenu').hasClass('active')) {
        $('body').css('overflow', 'hidden');
      } else {
        $('body').css('overflow', 'auto');
      }
    });

    // Close mobile menu when clicking on overlay
    $('#mobileMenuOverlay').on('click', function () {
      closeMobileMenu();
    });

    // Close mobile menu when clicking on a link
    $('.mobile-menu .nav-link, .mobile-menu .btn-success').on('click', function () {
      closeMobileMenu();
    });

    // Function to close mobile menu
    function closeMobileMenu() {
      $('#mobileMenuToggle').removeClass('open');
      $('#mobileMenu').removeClass('active');
      $('#mobileMenuOverlay').removeClass('active');
      $('body').css('overflow', 'auto');
    }

    // Theme toggle functionality for desktop
    $('#themeToggleBtn').on('click', function (e) {
      e.preventDefault();
      toggleTheme();
    });

    // Theme toggle functionality for mobile
    $('#themeToggleBtnMobile').on('click', function (e) {
      e.preventDefault();
      toggleTheme();
    });

    // Toggle theme function
    function toggleTheme() {
      const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
      
      if (isDarkMode) {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
        updateThemeIcon(false);
      } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        updateThemeIcon(true);
      }
    }

    // Update theme icon based on current theme
    function updateThemeIcon(isDarkMode) {
      const icon = document.getElementById('themeIcon');
      const iconMobile = document.getElementById('themeIconMobile');
      const tooltip = document.getElementById('themeTooltip');
      
      if (isDarkMode) {
        if (icon) icon.className = 'bi bi-moon-stars-fill';
        if (iconMobile) iconMobile.className = 'bi bi-moon-stars-fill';
        if (tooltip) tooltip.textContent = 'Mode Terang';
      } else {
        if (icon) icon.className = 'bi bi-sun-fill';
        if (iconMobile) iconMobile.className = 'bi bi-sun-fill';
        if (tooltip) tooltip.textContent = 'Mode Gelap';
      }
    }

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      if (!localStorage.getItem('theme')) {
        const isDarkMode = e.matches;
        document.documentElement.setAttribute('data-theme', isDarkMode ? 'dark' : 'light');
        updateThemeIcon(isDarkMode);
      }
    });
  });
</script>
@endpush