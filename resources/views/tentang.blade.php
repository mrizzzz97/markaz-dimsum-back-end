@extends('layouts.app')

@section('title', 'Tentang Kami - Markaz Dimsum')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f9fdfc;
    color: #222;
  }

  .dark-mode {
    background-color: #181818;
    color: #ffffff;
  }

  .dark-mode .main-header, .dark-mode .footer-markaz {
    background: #232323;
    border-bottom: 1px solid #444;
  }

  .dark-mode .glass-card, .dark-mode .modal-content {
    background: #2c2c2c;
    color: #fff;
  }

  .dark-mode a {
    color: #1dbf73;
  }

  .dark-mode .main-header .nav-link {
    color: #f1f1f1;
  }

  .dark-mode .main-header .nav-link:hover {
    color: #1dbf73;
  }

  .dark-mode .main-header .text-success {
    color: #1dbf73 !important;
  }

  .dark-mode .btn-light {
    background-color: #3a3a3a;
    border-color: #3a3a3a;
    color: #fff;
  }

  .btn-success {
    background-color: #1dbf73;
    border-color: #1dbf73;
    color: #fff;
  }

  .main-header {
    background: #fff;
    padding: 1rem 2rem;
    border-bottom: 1px solid #eee;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .main-header .nav-link {
    font-weight: 600;
    color: #333;
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 1.25rem;
    padding: 2rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.07);
    backdrop-filter: blur(10px);
  }

  .content-section {
    margin-top: 5rem;
    padding-top: 2rem;
    padding-bottom: 4rem;
    max-width: 750px;
  }

  @media (max-width: 768px) {
    .content-section {
      margin-top: 3rem;
      padding-top: 1rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }
</style>
@endpush

@section('content')
<header class="main-header d-flex justify-content-between align-items-center">
  <div class="d-flex align-items-center">
    <img src="{{ asset('images/logo.png') }}" height="40" class="mr-2">
    <span class="font-weight-bold text-success" style="font-size: 1.3rem;">Markaz Dimsum</span>
  </div>
  <div class="d-none d-md-flex align-items-center">
    <a href="/" class="nav-link">Beranda</a>
    <a href="/tentang" class="nav-link mx-2">Tentang</a>
    <a href="#produk" class="nav-link">Produk</a>
    <a href="/login" class="btn btn-success ml-3 px-3">Admin</a>
    <button id="themeToggleBtn" class="btn btn-light ml-3" style="font-size: 1.4rem;">
      <i class="bi bi-brightness-high"></i>
    </button>
  </div>
</header>

<section class="container content-section">
  <div class="glass-card animate__animated animate__fadeInUp" data-aos="fade-up">
    <h2 class="font-weight-bold mb-3 text-success">Tentang Kami</h2>
    <p>
      Selamat datang di <strong>Markaz Dimsum</strong> — mitra kuliner Anda dalam sajian dimsum beku yang praktis, lezat, dan HALAL!
      Kami berkomitmen menyajikan rasa autentik Asia yang bisa Anda nikmati di rumah.
    </p>
    <p>
      Produk kami dibuat dari bahan-bahan terbaik, higienis, dan menggunakan metode <em>quick freezing</em> untuk menjaga rasa dan tekstur seperti baru dimasak.
    </p>
    <h4 class="text-success mt-4">Kenapa Pilih Kami?</h4>
    <ul class="list-unstyled mt-2">
      <li>✅ 100% Halal & Higienis</li>
      <li>✅ Harga Ramah di Kantong</li>
      <li>✅ Kualitas Premium Rasa Restoran</li>
      <li>✅ Telah Dipercaya Ribuan Konsumen</li>
    </ul>
    <h4 class="text-success mt-4">Alamat Toko</h4>
    <p>Spring fiesta, Ak 9 No 20, Lambangsari, Tambun Selatan, Bekasi, Jawa Barat 17510</p>

    <h4 class="text-success mt-4">Hubungi Kami</h4>
    <p>
      📱 WhatsApp: <a href="https://wa.me/6281770825467" target="_blank">+62 817-7082-5467</a><br>
      📷 Instagram: <a href="https://instagram.com/markazdimsum" target="_blank">@markazdimsum</a>
    </p>
  </div>
</section>

@include('partials.footer')
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();

  document.addEventListener('DOMContentLoaded', function () {
    $('#themeToggleBtn').on('click', function () {
      document.body.classList.toggle('dark-mode');
      const icon = document.body.classList.contains('dark-mode') ? 'moon-stars-fill' : 'brightness-high';
      $(this).html(`<i class="bi bi-${icon}"></i>`);
    });
  });
</script>
@endpush
