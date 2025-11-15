@extends('layouts.app')

@section('title', 'Markaz Dimsum - Halal & Murah')

@push('styles')
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap, AOS, Animate -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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

  .hero-section img {
    object-fit: cover;
    width: 100%;
    height: 60vh;
    border-radius: 1rem;
    animation: fadeInZoom 1.5s ease-in-out;
  }

  @keyframes fadeInZoom {
    from {
      opacity: 0;
      transform: scale(1.03);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 14px var(--shadow-color);
    transition: all 0.3s ease;
    transform: translateY(0);
    background: var(--card-bg);
    height: 100%;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 20px var(--shadow-color);
  }

  .card img {
    transition: transform 0.4s ease;
    height: 200px;
    object-fit: cover;
  }

  .card:hover img {
    transform: scale(1.05);
  }

  .card-body {
    background-color: var(--card-bg);
    padding: 1.25rem;
    transition: background-color 0.3s ease;
  }

  .modal-content {
    border-radius: 1rem;
    background: var(--modal-bg);
    backdrop-filter: blur(8px);
    padding: 2rem;
    animation: fadeInDown 0.8s ease-out;
    color: var(--text-color);
    transition: background-color 0.3s ease, color 0.3s ease;
    margin: 1rem;
  }

  .modal-content h2 {
    color: var(--primary-color);
    font-weight: 700;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    filter: invert(1);
  }

  [data-theme="dark"] .carousel-control-prev-icon,
  [data-theme="dark"] .carousel-control-next-icon {
    filter: invert(0.5);
  }

  .carousel-indicators li {
    background-color: rgba(0, 0, 0, 0.5);
  }

  [data-theme="dark"] .carousel-indicators li {
    background-color: rgba(255, 255, 255, 0.5);
  }

  .text-success {
    color: var(--primary-color) !important;
  }

  .text-muted {
    color: #888 !important;
  }

  [data-theme="dark"] .text-muted {
    color: #aaa !important;
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

  /* Mobile menu styles - FIXED */
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

  /* Smooth transition for all elements */
  * {
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .hero-section img {
      height: 40vh;
      border-radius: 0.5rem;
    }

    .card img {
      height: 160px;
    }

    .modal-content {
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
    .hero-section img {
      height: 30vh;
    }

    .card img {
      height: 140px;
    }

    .card-body {
      padding: 1rem;
    }

    .modal-content {
      padding: 1rem;
      margin: 0.5rem;
    }

    .modal-content h2 {
      font-size: 1.5rem;
    }

    .container {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .section-title {
      font-size: 1.5rem;
    }
  }

  /* Large screens */
  @media (min-width: 992px) {
    .hero-section img {
      height: 70vh;
    }
  }

  @media (min-width: 1200px) {
    .hero-section img {
      height: 80vh;
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
  <a href="#produk" class="nav-link">
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

<!-- Modal -->
<div class="modal fade" id="welcomeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <h2 class="mb-3 animate__animated animate__fadeInDown">Selamat Datang 👋</h2>
      <p class="animate__animated animate__fadeInUp">Dimsum enak, halal, dan murah — semua ada di sini!</p>
      <button class="btn btn-success rounded-pill px-4 mt-3" data-dismiss="modal">Lanjut</button>
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
      <a href="#produk" class="nav-link">Produk</a>
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
<section class="hero-section container-fluid px-0 my-4">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3500">
    <ol class="carousel-indicators">
      <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#heroCarousel" data-slide-to="1"></li>
      <li data-target="#heroCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/product/produk-1.png') }}" class="d-block w-100" alt="Produk 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/product/produk-2.png') }}" class="d-block w-100" alt="Produk 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/product/produk-3.png') }}" class="d-block w-100" alt="Produk 3">
      </div>
    </div>
    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Sebelumnya</span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Berikutnya</span>
    </a>
  </div>
</section>

<!-- Produk -->
<section id="produk" class="container mb-5">
  <h3 class="text-center text-success mb-4 font-weight-bold section-title" data-aos="fade-up">Semua Produk</h3>
  <div class="row">
    @foreach($products as $product)
    <div class="col-sm-6 col-lg-4 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 100 }}">
      <a href="{{ url('/produk/'.$product->id) }}" class="w-100 text-decoration-none">
        <div class="card h-100">
          @if($product->image)
              @if(preg_match('/^https?:\/\//', $product->image))
              <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
            @else
              <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @endif
          @else
            <img src="{{ asset('images/default-product.png') }}" class="card-img-top" alt="Default Product">
          @endif
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="font-weight-bold">{{ $product->name == 'Dimsum Mentai' ? 'Dimsum Mentai Isi 6' : $product->name }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="text-success font-weight-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
              <small class="text-muted"><i class="bi bi-star-fill text-warning"></i> {{ $product->rating ?? '5.0' }}</small>
            </div>
          </div>
        </div>
      </a>
    </div>
    @endforeach
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

    // Show welcome modal only on first visit
    const hasVisited = localStorage.getItem('hasVisited');
    if (!hasVisited) {
      $('#welcomeModal').modal('show');
      localStorage.setItem('hasVisited', 'true');
    }

    // Mobile menu functionality - FIXED
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

    // Adjust carousel height on window resize
    let resizeTimer;
    $(window).on('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        // Trigger carousel reinitialization if needed
        $('#heroCarousel').carousel('pause');
        setTimeout(function() {
          $('#heroCarousel').carousel('cycle');
        }, 500);
      }, 250);
    });
  });
</script>
@endpush