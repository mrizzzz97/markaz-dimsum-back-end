@extends('layouts.app')

@section('title', 'Markaz Dimsum – Halal & Premium')

@section('meta_description')
Markaz Dimsum menyajikan dimsum halal dan premium dengan bahan berkualitas, higienis, dan cita rasa autentik. Cocok untuk keluarga, reseller, dan event.
@endsection

@section('og_title', 'Markaz Dimsum – Halal & Premium')
@section('og_description', 'Dimsum halal premium dengan rasa autentik, lembut, higienis, dan halal. Favorit keluarga sejak 2019.')
@section('og_image', asset('images/logo.png'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
  /* --- RESET & VARS --- */
  :root {
    --primary: #059669;
    --primary-dark: #047857;
    --primary-light: #d1fae5;
    --bg: #f8fafc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --radius: 24px;
    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }

  [data-theme="dark"] {
    --bg: #020617;
    --card: #0f172a;
    --text: #f1f5f9;
    --muted: #94a3b8;
    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
  }

  * { scroll-behavior: smooth; -webkit-tap-highlight-color: transparent; }
  body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg); color: var(--text); overflow-x: hidden; line-height: 1.6; }

  /* --- LOADER --- */
  #preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--bg); z-index: 999999; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.5s ease, visibility 0.5s; }
  .loader-logo { width: 80px; margin-bottom: 20px; animation: pulse 2s infinite; }
  .spinner { width: 50px; height: 50px; border: 4px solid var(--primary-light); border-top: 4px solid var(--primary); border-radius: 50%; animation: spin 1s linear infinite; }
  @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
  @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

  /* --- HERO --- */
  .hero { 
    min-height: 80vh; 
    height: auto; 
    padding: 120px 20px 40px; 
    position: relative; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    z-index: 1; 
  }
  
  .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1.5s ease-in-out; z-index: 0; pointer-events: none; }
  .hero-slide.active { opacity: 1; }
  .hero-slide.active img { animation: kenBurns 8s infinite alternate; }
  @keyframes kenBurns { from { transform: scale(1); } to { transform: scale(1.15); } }
  .hero-slide img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.65); }
  .hero::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(2,6,23,0.28) 0%, rgba(2,6,23,0.6) 50%, rgba(2,6,23,0) 70%); z-index: 1; pointer-events: none; }
  
  .hero-content { position: relative; z-index: 2; text-align: center; color: #fff; max-width: 900px; width: 100%; }
  .hero-badge { display: inline-block; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); padding: 6px 16px; border-radius: 50px; border: 1px solid rgba(255, 255, 255, 0.2); font-size: 0.75rem; margin-bottom: 20px; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; animation: fadeInDown 1s ease-out; }
  
  .hero h1 { 
    font-family: 'Poppins', serif; 
    font-size: clamp(2rem, 6vw, 4rem); 
    font-weight: 800; 
    line-height: 1.1; 
    margin-bottom: 20px; 
    text-shadow: 0 4px 20px rgba(0,0,0,0.3); 
    background: linear-gradient(to right, #ffffff, #e2e8f0); 
    -webkit-background-clip: text; 
    -webkit-text-fill-color: transparent; 
    animation: fadeInUp 1s ease-out 0.3s backwards; 
  }
  
  .hero p { 
    font-size: clamp(0.95rem, 2vw, 1.15rem); 
    color: #cbd5e1; 
    margin-bottom: 32px; 
    margin-left: auto; 
    margin-right: auto; 
    padding: 0 10px;
    animation: fadeInUp 1s ease-out 0.5s backwards; 
  }
  
  .btn-main { 
    display: inline-flex; 
    align-items: center; 
    justify-content: center;
    gap: 10px; 
    padding: 14px 36px; 
    border-radius: 50px; 
    background: var(--primary); 
    color: #fff; 
    font-weight: 700; 
    text-decoration: none; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    box-shadow: 0 10px 25px rgba(5, 150, 105, 0.4); 
    border: 1px solid rgba(255,255,255,0.1); 
    animation: fadeInUp 1s ease-out 0.7s backwards; 
    width: auto; 
  }
  .btn-main:hover { transform: translateY(-4px) scale(1.02); background: var(--primary-dark); box-shadow: 0 15px 35px rgba(5, 150, 105, 0.5); }
  .btn-main i { transition: transform 0.3s; }
  .btn-main:hover i { transform: translateX(5px); }

  /* --- LAYOUT & SECTIONS --- */
  section { padding: 60px 20px; position: relative; z-index: 3; }
  .container { max-width: 1280px; margin: auto; position: relative; z-index: 2; padding: 0 10px;}
  .section-header { text-align: center; margin-bottom: 40px; }
  .section-subtitle { color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem; display: block; margin-bottom: 10px; }
  .section-title { font-size: clamp(1.5rem, 4vw, 2.2rem); font-weight: 800; margin: 0; line-height: 1.2; }
  .section-desc { max-width: 600px; margin: 16px auto 0; color: var(--muted); font-size: 1rem; line-height: 1.7; }

  /* --- PRODUCT CARDS --- */
  .product-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); 
    gap: 24px; 
  }
  .card-product { 
    background: var(--card); 
    border-radius: var(--radius); 
    overflow: hidden; 
    position: relative; 
    text-decoration: none; 
    color: var(--text); 
    box-shadow: var(--shadow-sm); 
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
    border: 1px solid rgba(0,0,0,0.05); 
    display: flex; 
    flex-direction: column; 
    height: 100%;
  }
  .card-img-wrapper { position: relative; height: 220px; overflow: hidden; }
  .card-product img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
  @media (hover: hover) {
    .card-product:hover img { transform: scale(1.1); }
  }
  
  .card-action { 
    position: absolute; 
    bottom: 16px; 
    right: 16px; 
    width: 44px; 
    height: 44px; 
    background: #fff; 
    border-radius: 50%; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    color: var(--text); 
    box-shadow: 0 8px 20px rgba(0,0,0,0.15); 
    transform: translateY(20px) scale(0.8); 
    opacity: 0; 
    transition: all 0.3s ease; 
    z-index: 2; 
  }
  .card-product:hover .card-action { transform: translateY(0) scale(1); opacity: 1; }
  .card-action:hover { background: var(--primary); color: #fff; }
  
  .card-content { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; position: relative; background: var(--card); }
  .card-badge { position: absolute; top: -12px; left: 20px; background: var(--primary); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 5px 12px; border-radius: 20px; text-transform: uppercase; box-shadow: 0 4px 10px rgba(5, 150, 105, 0.3); }
  .card-product h4 { margin: 0 0 8px; font-size: 1.15rem; font-weight: 700; }
  .card-price { color: var(--primary); font-weight: 800; font-size: 1.05rem; margin-top: auto; display: flex; align-items: center; gap: 8px; }
  
  .card-product::after { content: ""; position: absolute; top: 0; left: -100%; width: 50%; height: 100%; background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent); transform: skewX(-25deg); transition: 0.5s; z-index: 3; pointer-events: none; }
  .card-product:hover::after { left: 150%; transition: 0.7s ease-in-out; }
  .card-product:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }

  /* --- FEATURES --- */
  .feature-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
  .feature-card { 
    background: rgba(255, 255, 255, 0.7); 
    backdrop-filter: blur(12px); 
    border: 1px solid rgba(255,255,255,0.5); 
    padding: 30px; 
    border-radius: 32px; 
    text-align: left; 
    transition: 0.4s;
    display: flex;
    flex-direction: column;
  }
  [data-theme="dark"] .feature-card { background: rgba(30, 41, 59, 0.6); border: 1px solid rgba(255,255,255,0.05); }
  
  .feature-card h3 {
    margin: 16px 0 12px 0;
    font-size: 1.25rem;
    font-weight: 700;
  }

  .feature-card > p {
    color: var(--muted);
    margin: 0 0 20px 0;
    font-size: 0.95rem;
    line-height: 1.6;
  }
  
  .feature-icon { 
    width: 60px; 
    height: 60px; 
    background: var(--primary-light); 
    color: var(--primary); 
    border-radius: 20px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.5rem; 
    margin-bottom: 20px; 
    transition: 0.4s; 
  }
  [data-theme="dark"] .feature-icon { background: rgba(5,150,105,0.2); color: #34d399; }
  .feature-card:hover .feature-icon { transform: rotateY(180deg) scale(1.1); background: var(--primary); color: #fff; }
  .feature-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
  
  .ingredient-tags { display: flex; flex-wrap: wrap; gap: 8px; margin: 15px 0; }
  .tag { background: var(--primary-light); color: var(--primary-dark); padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
  [data-theme="dark"] .tag { background: rgba(5,150,105,0.2); color: #4ade80; }
  
  .highlight-box { 
    background: rgba(5,150,105,0.1); 
    border-left: 4px solid var(--primary); 
    padding: 12px 15px; 
    margin-top: 15px; 
    font-weight: 600; 
    color: var(--text); 
    font-size: 0.9rem;
  }

  .highlight-testimonial {
    background: rgba(245, 158, 11, 0.1);
    border-left-color: #f59e0b;
    color: #b45309;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .highlight-testimonial i {
    color: #f59e0b;
  }

  .feature-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin: 20px 0;
  }

  .feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 0;
    font-weight: 600;
    color: var(--text);
  }

  .feature-item i {
    font-size: 1.2rem;
    flex-shrink: 0;
  }

  .feature-item:not(.negative) i {
    color: #10b981;
  }

  .feature-item.negative i {
    color: #ef4444;
  }

  /* --- TESTIMONIALS (SCROLL SNAP) --- */
  .testi-wrapper { position: relative; padding: 0 0 20px 0; }
  .testi-scroller { 
    display: flex; 
    gap: 20px; 
    overflow-x: auto; 
    scroll-snap-type: x mandatory; 
    padding: 20px 5px 40px; 
    -ms-overflow-style: none; 
    scrollbar-width: none; 
    -webkit-overflow-scrolling: touch; 
    touch-action: pan-x; /* allow horizontal touch panning */
  }
  .testi-scroller::-webkit-scrollbar { display: none; }
  
  .testi-item {
    flex: 0 0 85%; 
    max-width: 340px; 
    scroll-snap-align: center;
    display: flex;
    flex-direction: column;
    background: var(--card);
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 20px;
    padding: 20px;
    box-shadow: var(--shadow-sm);
    font-size: 14px;
    transition: transform 0.3s;
  }

  /* show grabbing cursor when dragging (desktop pointer) */
  .testi-scroller.dragging { cursor: grabbing; cursor: -webkit-grabbing; }

  [data-theme="dark"] .testi-item {
    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.08);
  }

  .testi-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }

  .stars { color: #fbbf24; font-size: 14px; letter-spacing: 1px; }
  .time { font-size: 11px; color: var(--muted); font-weight: 500; }
  .testi-text { font-size: 14px; line-height: 1.6; color: var(--text); margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
  
  .testi-user {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-top: 18px;
    border-top: 1px dashed rgba(0,0,0,0.08);
  }
  [data-theme="dark"] .testi-user { border-top-color: rgba(255,255,255,0.12); }

  .avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: var(--bg); color: var(--muted);
    font-weight: 700; font-size: 14px;
    flex-shrink: 0;
  }
  .avatar { flex-shrink:0; }
  .avatar img { display:block; }
  .name { margin-top: 3px; }
  .name { font-size: 15px; font-weight: 600; color: var(--text); }

  /* Navigation Buttons for Desktop */
  .control-btn { 
    width: 48px; height: 48px; 
    border-radius: 50%; 
    border: 2px solid var(--primary); 
    background: #fff; 
    color: var(--primary); 
    cursor: pointer; 
    transition: 0.3s; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.2rem; 
    box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
    position: absolute; 
    top: 50%; 
    transform: translateY(-50%); 
    z-index: 10; 
  }
  .control-btn:hover { background: var(--primary); color: #fff; transform: translateY(-50%) scale(1.1); }
  .control-btn.prev { left: -60px; }
  .control-btn.next { right: -60px; }

  /* --- FOOTER --- */
  footer { background: #020617; color: #cbd5e1; padding: 60px 20px 30px; margin-top: 60px; position: relative; overflow: hidden; }
  footer::before { content: ''; position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 80%; height: 200px; background: radial-gradient(ellipse at center, rgba(5,150,105,0.15) 0%, transparent 70%); pointer-events: none; }
  footer h4 { color: #fff; margin-bottom: 16px; font-size: 1.1rem; font-weight: 700; }
  footer p { color: #94a3b8; margin-bottom: 10px; font-size: 0.95rem; }
  footer a { color: #94a3b8; text-decoration: none; display: block; margin-bottom: 10px; transition: 0.3s; font-size: 0.95rem; font-weight: 500; }
  footer a:hover { color: var(--primary); padding-left: 5px; transform: translateX(3px); }
  
  .brand-wrapper { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
  .footer-logo { height: 45px; width: auto; object-fit: contain; }
  .brand-text h4 { margin-bottom: 0; font-size: 1.25rem; font-family: 'Poppins', serif; }
  
  .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 50px; }
  
  .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 25px; text-align: center; font-size: 0.85rem; color: #64748b; }

  /* Animations */
  @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

  /* --- RESPONSIVE MEDIA QUERIES --- */
  @media (max-width: 992px) {
    .footer-grid { grid-template-columns: 1fr 1fr; gap: 30px; }
    .control-btn { display: none; } 
  }

  @media (max-width: 768px) {
    section { padding: 50px 15px; }
    .hero { padding-top: 100px; min-height: 80vh; }
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
    .feature-grid { grid-template-columns: 1fr; }
    .feature-card { padding: 24px; }
    .testi-wrapper { padding: 0 10px; }
    .testi-item { width: 85vw; max-width: none; }
    .control-btn.prev, .control-btn.next { display: none; }
    .testi-controls-mobile { display: flex; justify-content: center; gap: 16px; margin-top: -20px; margin-bottom: 20px; position: relative; z-index: 5; }
  }

  @media (max-width: 480px) {
    .hero h1 { font-size: 2.2rem; }
    .btn-main { width: 100%; padding: 16px; }
    .product-grid { grid-template-columns: 1fr; }
    .card-img-wrapper { height: 200px; }
    .footer-grid { grid-template-columns: 1fr; text-align: center; }
    .brand-wrapper { justify-content: center; }
    .footer-bottom { font-size: 0.75rem; }
    .testi-item { padding: 15px; }
    .testi-text { font-size: 13px; }
  }

</style>
@endpush

@section('content')

{{-- LOADING SCREEN --}}
<div id="preloader">
  <img src="{{ asset('images/logo.png') }}" alt="Logo" class="loader-logo" onerror="this.style.display='none'">
  <div class="spinner"></div>
</div>

{{-- HERO --}}
<section class="hero">
  @foreach(['produk-1.png','produk-2.png','produk-3.png'] as $i => $img)
    <div class="hero-slide {{ $i==0?'active':'' }}">
      <img src="{{ asset('images/product/'.$img) }}" alt="Dimsum Background" >
    </div>
  @endforeach

  <div class="hero-content">
    <span class="hero-badge">Halal & Premium</span>
    <h1>Markaz Dimsum</h1>
    <p>Diproses dengan bahan baku terbaik</p>
    <a href="#produk" class="btn-main">
      Lihat Menu Kami
      <i class="bi bi-arrow-right"></i>
    </a>
  </div>
</section>

{{-- PRODUK --}}
<section id="produk">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-subtitle">Pilihan Terbaik</span>
      <h2 class="section-title">Menu Kami</h2>
    </div>

    <div class="product-grid">
      @if(isset($products) && $products->count())
        @foreach($products as $product)
          @php
            $image = $product->image;

            if ($image) {
              $imageUrl = \Illuminate\Support\Str::startsWith($image, 'http')
                  ? $image
                  : asset($image);

            } else {
              // 🔥 placeholder lokal (bukan dummy / bukan URL luar)
              $imageUrl = asset('images/placeholder-product.png');
            }
          @endphp

          <a href="{{ url('/produk/'.$product->id) }}"
             class="card-product"
             data-aos="fade-up"
             data-aos-delay="{{ $loop->index * 100 }}">

            <div class="card-img-wrapper">
              <img
                src="{{ $imageUrl }}"
                alt="{{ $product->name }}"
                loading="lazy"
                onerror="this.src='{{ asset('images/placeholder-product.png') }}'"
              >

              <div class="card-action">
                <i class="bi bi-bag-plus-fill"></i>
              </div>
            </div>

            <div class="card-content">
              @if($loop->first)
                <div class="card-badge">Best Seller</div>
              @endif

              <h4>{{ $product->name }}</h4>

              <div class="card-price">
                <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                <i class="bi bi-chevron-right"
                   style="font-size:0.8rem; opacity:.5"></i>
              </div>
            </div>
          </a>
        @endforeach
      @else
        {{-- Tidak ada produk --}}
        <div style="text-align:center; grid-column:1/-1; color:#64748b;">
          Produk belum tersedia.
        </div>
      @endif
    </div>
  </div>
</section>

{{-- MENGAPA MARKAZ DIMSUM --}}
{{-- Perbaikan Style sesuai referensi gambar (Aman & Lezat) --}}
<section style="background-color: rgba(5, 150, 105, 0.03);">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <span class="section-subtitle">Kenapa Pilih Kami</span>
      <h2 class="section-title">Mengapa Markaz Dimsum?</h2>
    </div>
    
    <div class="feature-grid">
      {{-- Card Bahan Premium --}}
      <div class="feature-card" data-aos="fade-right">
        <h3>Dibuat dengan Bahan Baku Terbaik</h3>
        <p style="color:var(--muted);">Setiap dimsum kami dipilih dari bahan berkualitas tinggi dan diolah dengan penuh ketelitian, menghadirkan cita rasa autentik yang lembut, lezat, dan selalu berkesan.</p>
        <div class="ingredient-tags">
          <span class="tag">Ayam Pilihan</span><span class="tag">Wortel</span><span class="tag">Jamur</span> <span class="tag">Smokebeef</span><span class="tag">Tuna</span><span class="tag">Crabstick</span><span class="tag">Udang</span>
        </div>
        <div class="highlight-box"></i>Free Saos Pasta Merah</div>
      </div>

      {{-- Card Aman & Lezat --}}
      <div class="feature-card" data-aos="fade-left">
        <h3>Aman & Lezat</h3>
        <p>Berkomitmen penuh pada keamanan pangan dan kepuasan pelanggan.</p>
        
        <div class="feature-list">
          <div class="feature-item">
            <i class="bi bi-check-circle-fill"></i>
            <span>Higienis</span>
          </div>
          <div class="feature-item negative">
            <i class="bi bi-x-circle-fill"></i>
            <span>TANPA Pengawet</span>
          </div>
        </div>
        
        <div class="highlight-box highlight-testimonial">
          <i class="bi bi-star-fill"></i>
          <span>Ratusan Testimoni</span>
        </div>
      </div>
    </div>
  </div>
</section>

  {{-- TESTIMONI --}}
  <section id="testi">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <span class="section-subtitle">Kata Mereka</span>
        <h2 class="section-title">Review Pelanggan</h2>
      </div>

      <div class="testi-wrapper">
        <button class="control-btn prev" onclick="slideTesti(-1)">
          <i class="bi bi-chevron-left"></i>
        </button>

        <div class="testi-scroller" id="testiScroller">
          @foreach([
              ['name'=>'Yuni', 'text'=>'dimsunnya lembut, enaaaakkk bgt… seller nya responsif dan ramah… recommended bgt pokoknya..', 'avatar'=>'yuni.jpg'],
              ['name'=>'Azis', 'text'=>'Respon cepat, dimsum & sausnya enak, favorit keluarga buat sarapan.', 'avatar'=>'azis.jpg'],
              ['name'=>'Ratu', 'text'=>'Sudah langganan 2 tahun, rasa konsisten, isinya gemuk-gemuk 😍', 'avatar'=>'ratu.jpg'],
              ['name'=>'Dwi', 'text'=>'Anak-anak suka, proses & pengiriman cepat. Terima kasih.', 'avatar'=>'dwi.jpg'],
              ['name'=>'Dona', 'text'=>'enak..rasanya gak berubah..seller selalu ramah dan merespon dg baik', 'avatar'=>'dona.jpg'],
              ['name'=>'Andini', 'text'=>'best best best, sat set sat set', 'avatar'=>'andini.jpg'],
          ] as $item)
          <div class="testi-item" data-aos="fade-up">
            <div class="testi-top">
              <div class="stars">★★★★★</div>
              <span class="time">Dari Tokopedia</span>
            </div>
            <p class="testi-text">"{{ $item['text'] }}"</p>
            <div class="testi-user">
              <div class="avatar">
                @if($item['avatar'] && file_exists(public_path('images/avatar/' . $item['avatar'])))
                  <img src="{{ asset('images/avatar/' . $item['avatar']) }}" alt="{{ $item['name'] }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                @else
                  {{ substr($item['name'],0,1) }}
                @endif
              </div>
              <span class="name">{{ $item['name'] }}</span>
            </div>
          </div>
          @endforeach
        </div>

        <button class="control-btn next" onclick="slideTesti(1)">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
      
      <div class="testi-controls-mobile">
         <span style="font-size: 0.8rem; color: var(--muted);">Geser untuk lihat lainnya &rarr;</span>
      </div>
    </div>
  </section>
  
{{-- FOOTER --}}
<footer>
  <div class="container">
    <div class="footer-grid">
      <div data-aos="fade-up">
        <div class="brand-wrapper">
          <img src="{{ asset('images/logo.png') }}" alt="Markaz Dimsum Logo" class="footer-logo" onerror="this.style.display='none'">
          <div class="brand-text"><h4>Markaz Dimsum</h4></div>
        </div>
        <p style="max-width:300px; line-height:1.6;">Menghadirkan kebahagiaan melalui dimsum berkualitas premium yang halal, higienis, dan penuh rasa.</p>
      <div style="display:flex; gap:12px; margin-top:24px; justify-content: inherit;">
        <a href="https://www.instagram.com/markazdimsum/"
          target="_blank" rel="noopener noreferrer"
          style="display:inline-flex; width:36px; height:36px; background:rgba(255,255,255,0.1); align-items:center; justify-content:center; border-radius:50%;">
          <i class="bi bi-instagram"></i>
        </a>

        <a href="https://markaz-dimsum.com"
          target="_blank" rel="noopener noreferrer"
          style="display:inline-flex; width:36px; height:36px; background:rgba(255,255,255,0.1); align-items:center; justify-content:center; border-radius:50%;">
          <i class="bi bi-globe"></i>
        </a>

        <a href="https://wa.me/6281770825467"
          target="_blank" rel="noopener noreferrer"
          style="display:inline-flex; width:36px; height:36px; background:rgba(255,255,255,0.1); align-items:center; justify-content:center; border-radius:50%;">
          <i class="bi bi-whatsapp"></i>
        </a>
      </div>

      </div>
      <div data-aos="fade-up" data-aos-delay="100">
        <h4>Menu Cepat</h4>
        <a href="">Beranda</a>
        <a href="#produk">Produk Dimsum</a>
        <a href="#testi">Testimoni</a>
      </div>
      <div data-aos="fade-up" data-aos-delay="200">
        <h4>Kontak Kami</h4>
        <p style="display:flex; align-items:center; gap:10px;"><i class="bi bi-geo-alt-fill" style="color:var(--primary);"></i> Bekasi, Jawa Barat</p>
        <p style="display:flex; align-items:center; gap:10px;"><i class="bi bi-whatsapp" style="color:var(--primary);"></i> 081770825467</p>
      </div>
      <div data-aos="fade-up" data-aos-delay="300">
        <h4>Kerjasama</h4>
        <p>Terbuka untuk peluang kemitraan:</p>
        <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content: inherit;">
          <span style="background:rgba(255,255,255,0.1); padding:4px 12px; border-radius:20px; font-size:0.85rem;">Reseller</span>
          <span style="background:rgba(255,255,255,0.1); padding:4px 12px; border-radius:20px; font-size:0.85rem;">UMKM</span>
          <span style="background:rgba(255,255,255,0.1); padding:4px 12px; border-radius:20px; font-size:0.85rem;">Event</span>
        </div>
      </div>
    </div>
    <div class="footer-bottom"><p>© 2019 Markaz Dimsum. All rights reserved.</p></div>
  </div>
</footer>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  window.addEventListener('load', function() {
    // Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
      setTimeout(() => {
        preloader.style.opacity = '0';
        setTimeout(() => {
          preloader.style.visibility = 'hidden';
        }, 500);
      }, 800); 
    }
    
    // Init AOS
    AOS.init({ 
      once: true, 
      duration: 800, 
      easing: 'ease-out-cubic', 
      offset: 50,
      disable: function() {
        var maxWidth = 768;
        return window.innerWidth < maxWidth;
      } 
    });
  });

  // Hero Slider Logic
  const slides = document.querySelectorAll('.hero-slide');
  let currentIdx = 0;
  if(slides.length > 0) {
    setInterval(() => {
      slides[currentIdx].classList.remove('active');
      currentIdx = (currentIdx + 1) % slides.length;
      slides[currentIdx].classList.add('active');
    }, 6000);
  }

  // Testimonial Scroll Logic
  const scroller = document.getElementById('testiScroller');
  function slideTesti(dir) {
    if(scroller) {
      const cardWidth = scroller.querySelector('.testi-item').offsetWidth;
      const gap = 20; 
      const scrollAmount = cardWidth + gap;
      
      scroller.scrollBy({ left: dir * scrollAmount, behavior: 'smooth' });
    }
  }

  // Enable pointer-drag scrolling (desktop + hybrid devices)
  (function enablePointerDrag(){
    if(!scroller) return;
    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;

    scroller.addEventListener('pointerdown', (e) => {
      isDown = true;
      scroller.setPointerCapture(e.pointerId);
      startX = e.clientX;
      scrollLeft = scroller.scrollLeft;
      scroller.classList.add('dragging');
    });

    scroller.addEventListener('pointermove', (e) => {
      if(!isDown) return;
      const dx = e.clientX - startX;
      scroller.scrollLeft = scrollLeft - dx;
    });

    const pointerUp = (e) => {
      if(!isDown) return;
      isDown = false;
      try { scroller.releasePointerCapture(e.pointerId); } catch(_) {}
      scroller.classList.remove('dragging');
    };

    scroller.addEventListener('pointerup', pointerUp);
    scroller.addEventListener('pointercancel', pointerUp);
    // Prevent accidental image dragging
    scroller.querySelectorAll('img').forEach(img => img.setAttribute('draggable','false'));
  })();
</script>
@endpush