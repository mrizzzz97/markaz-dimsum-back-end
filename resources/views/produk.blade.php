@extends('layouts.app')

@section('title', $product->name . ' - Markaz Dimsum')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/main.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

<style>
  body {
    background-color: #f9fdfc;
    color: #222;
    font-family: 'Inter', sans-serif;
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 1.25rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  }

  .product-img {
    object-fit: cover;
    border-radius: 1rem;
    width: 100%;
    max-height: 320px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
  }

  .btn-shopee {
    background: #ee4d2d;
    color: #fff;
  }
  .btn-shopee:hover {
    background: #d73211;
    color: #fff;
  }
</style>
@endpush

@section('content')
<section class="container" style="margin-top:120px;max-width:850px;">
  <div class="row align-items-center glass-card" data-aos="zoom-in">

    {{-- GAMBAR --}}
    <div class="col-md-5 mb-4 mb-md-0">
      @if($product->image)
        @if(preg_match('/^https?:\/\//', $product->image))
          <img src="{{ $product->image }}" class="product-img" alt="{{ $product->name }}">
        @else
          <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->name }}">
        @endif
      @else
        <img src="{{ asset('images/default-product.png') }}" class="product-img" alt="{{ $product->name }}">
      @endif
    </div>

    {{-- DETAIL --}}
    <div class="col-md-7">
      <h2 class="font-weight-bold mb-3" style="color:#1dbf73;">
        {{ $product->name }}
      </h2>

      <div class="mb-2">
        <span class="h4 text-danger font-weight-bold">
          Rp{{ number_format($product->price, 0, ',', '.') }}
        </span>
        <span class="ml-3">
          <i class="bi bi-star-fill text-warning"></i> {{ $product->rating }}
        </span>
      </div>

      <div class="mb-2 text-muted">Stok: {{ $product->stock }}</div>

      @if($product->stock == 0)
        <div class="mb-2 text-danger font-weight-bold">Stok habis</div>
      @elseif($product->stock <= 10)
        <div class="mb-2 text-danger font-weight-bold">
          Stok sisa sedikit! ({{ $product->stock }})
        </div>
      @endif

      <p class="mt-3">{{ $product->description }}</p>

      {{-- TOMBOL PEMBELIAN --}}
      <div class="mt-4">

        @if($product->tokopedia_url)
          <a href="{{ $product->tokopedia_url }}" target="_blank"
             class="btn btn-success btn-lg font-weight-bold mb-2 d-block">
            <i class="bi bi-cart-check mr-2"></i> Beli di Tokopedia
          </a>
        @endif

        @if($product->shopee_url)
          <a href="{{ $product->shopee_url }}" target="_blank"
             class="btn btn-shopee btn-lg font-weight-bold mb-2 d-block">
            <i class="bi bi-bag-check mr-2"></i> Beli di Shopee
          </a>
        @endif

        @if($product->offline_available)
          <div class="alert alert-info mt-3">
            <i class="bi bi-shop mr-2"></i>
            <strong>Tersedia di Offline Store</strong><br>
            <small>
              Datang langsung ke toko atau hubungi WhatsApp kami
            </small>
          </div>
        @endif

        @if(
          !$product->tokopedia_url &&
          !$product->shopee_url &&
          !$product->offline_available
        )
          <div class="alert alert-warning mt-3">
            Produk belum tersedia untuk dibeli saat ini.
          </div>
        @endif

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
  AOS.init();
</script>
@endpush
