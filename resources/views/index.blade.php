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
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f6fff9;
    color: #222;
    scroll-behavior: smooth;
  }

  .main-header {
    background-color: #fff;
    border-bottom: 1px solid #eee;
    padding: 1rem 2rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
  }

  .main-header .nav-link {
    color: #333;
    font-weight: 500;
    position: relative;
  }

  .main-header .nav-link::after {
    content: '';
    display: block;
    width: 0;
    height: 2px;
    background: #1dbf73;
    transition: 0.3s;
    margin-top: 4px;
  }

  .main-header .nav-link:hover::after {
    width: 100%;
  }

  .btn-success {
    background-color: #1dbf73;
    border-color: #1dbf73;
    transition: all 0.3s ease;
  }

  .btn-success:hover {
    background-color: #17a567;
  }

  .btn-theme {
    border: none;
    background: none;
    font-size: 1.5rem;
    color: #1dbf73;
  }

  .hero-section img {
    object-fit: cover;
    width: 100%;
    height: 80vh;
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
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    transform: translateY(0);
    background: #fff;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08);
  }

  .card img {
    transition: transform 0.4s ease;
  }

  .card:hover img {
    transform: scale(1.05);
  }

  .card-body {
    background-color: #ffffff;
    padding: 1.25rem;
  }

  .modal-content {
    border-radius: 1rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    padding: 2rem;
    animation: fadeInDown 0.8s ease-out;
  }

  .modal-content h2 {
    color: #1dbf73;
    font-weight: 700;
  }

  .dark-mode {
    background-color: #181818;
    color: #eee;
  }

  .dark-mode .main-header,
  .dark-mode .card,
  .dark-mode .modal-content {
    background-color: #2a2a2a !important;
  }

  .dark-mode .nav-link,
  .dark-mode .card-body {
    color: #f0f0f0 !important;
  }
</style>
@endpush

@section('content')
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
<header class="main-header d-flex justify-content-between align-items-center">
  <div class="d-flex align-items-center">
    <img src="{{ asset('images/logo.png') }}" height="40" class="mr-2">
    <span class="font-weight-bold text-success">Markaz Dimsum</span>
  </div>
  <div class="d-none d-md-flex align-items-center">
    <a href="/" class="nav-link">Beranda</a>
    <a href="/tentang" class="nav-link mx-3">Tentang</a>
    <a href="#produk" class="nav-link">Produk</a>
    <a href="/login" class="btn btn-success ml-4 px-3">Admin</a>
    <button id="themeToggleBtn" class="btn-theme ml-3"><i class="bi bi-brightness-high"></i></button>
  </div>
</header>

<!-- Hero Section -->
<section class="hero-section container my-5">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3500">
    <ol class="carousel-indicators">
      <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#heroCarousel" data-slide-to="1"></li>
      <li data-target="#heroCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner rounded-3 shadow">
      <div class="carousel-item active">
        <img src="{{ asset('images/product/produk-1.png') }}" class="d-block w-100" style="height: 80vh; object-fit: cover;" alt="Produk 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/product/produk-2.png') }}" class="d-block w-100" style="height: 80vh; object-fit: cover;" alt="Produk 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/product/produk-3.png') }}" class="d-block w-100" style="height: 80vh; object-fit: cover;" alt="Produk 3">
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
  <h3 class="text-center text-success mb-4 font-weight-bold" data-aos="fade-up">Semua Produk</h3>
  <div class="row">
    @foreach($products as $product)
    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 100 }}">
      <a href="{{ url('/produk/'.$product->id) }}" class="w-100 text-decoration-none">
        <div class="card h-100">
          @if($product->image)
              @if(preg_match('/^https?:\/\//', $product->image))
              <img src="{{ $product->image }}" class="card-img-top" style="height:220px;object-fit:cover;">
            @else
              <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:220px;object-fit:cover;">
            @endif
          @else
            <img src="{{ asset('images/default-product.png') }}" class="card-img-top" style="height:220px;object-fit:cover;">
          @endif
          <div class="card-body">
            <span class="font-weight-bold">{{ $product->name == 'Dimsum Mentai' ? 'Dimsum Mentai Isi 6' : $product->name }}</span>
            <span class="text-success font-weight-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
            <small class="text-muted"><i class="bi bi-star-fill text-warning"></i> {{ $product->rating ?? '5.0' }}</small>
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
    $('#welcomeModal').modal('show');

    $('#themeToggleBtn').on('click', function () {
      $('body').toggleClass('dark-mode');
      const icon = $('body').hasClass('dark-mode') ? 'moon-stars-fill' : 'brightness-high';
      $(this).html(`<i class="bi bi-${icon}"></i>`);
    });
  });
</script>
@endpush