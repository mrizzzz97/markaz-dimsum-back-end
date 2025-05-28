@extends('layouts.app')

@section('title', 'Visi & Misi - Tentang Kami - Markaz Dimsum')

@section('content')
<section class="container content-section" style="max-width:700px; margin-top: 5rem;">
  <div class="glass-card p-5 rounded-4 shadow-lg" data-aos="fade-up">
    <h2 class="font-weight-bold mb-3 text-success" style="font-size:2rem;">Visi & Misi</h2>
    <p style="font-size:1.1rem;">
      <strong>Visi:</strong> Menjadi produsen dimsum beku terkemuka yang dikenal akan kualitas dan kehalalannya.<br>
      <strong>Misi:</strong> Menyediakan produk dimsum yang praktis, lezat, dan higienis untuk pelanggan di seluruh Indonesia.
    </p>
  </div>
</section>
@include('partials.footer')
@endsection
