@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ================= PRODUK ================= --}}
<div class="row mb-4">

    <div class="col-md-3 col-6 mb-3">
        <div class="card-soft text-center p-3">
            <i class="bi bi-box-seam fs-3 text-primary"></i>
            <small class="d-block mt-2">Total Produk</small>
            <h3 class="fw-bold">{{ $totalProduk ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-3">
        <div class="card-soft text-center p-3">
            <i class="bi bi-x-circle fs-3 text-danger"></i>
            <small class="d-block mt-2">Stok Habis</small>
            <h3 class="fw-bold">{{ $stokHabis ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-3">
        <div class="card-soft text-center p-3">
            <i class="bi bi-exclamation-circle fs-3 text-warning"></i>
            <small class="d-block mt-2">Stok Menipis</small>
            <h3 class="fw-bold">{{ $stokMenipis ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 col-6 mb-3">
        <div class="card-soft text-center p-3">
            <i class="bi bi-star-fill fs-3 text-success"></i>
            <small class="d-block mt-2">Produk Terlaris</small>
            <h6 class="fw-bold">{{ $produkTerlaris ?? '-' }}</h6>
        </div>
    </div>

</div>

{{-- ================= TRANSAKSI ================= --}}
<div class="row mb-4">

    <div class="col-md-6 col-12 mb-3">
        <div class="card-soft p-3">
            <small>Transaksi Hari Ini</small>
            <h3 class="fw-bold">{{ $transaksiHariIni ?? 0 }}</h3>

            <div class="progress mt-2" style="height: 6px">
                <div class="progress-bar bg-primary" style="width: 60%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12 mb-3">
        <div class="card-soft p-3">
            <small>Transaksi Bulan Ini</small>
            <h3 class="fw-bold">{{ $transaksiBulanIni ?? 0 }}</h3>

            <div class="progress mt-2" style="height: 6px">
                <div class="progress-bar bg-success" style="width: 80%"></div>
            </div>
        </div>
    </div>

</div>

{{-- ================= CHANNEL PENJUALAN ================= --}}
<div class="row mb-4">

    {{-- OFFLINE --}}
    <div class="col-md-4 col-12 mb-3">
        <div class="card-soft p-3">
            <small>Offline</small>
            <h5 class="fw-bold">{{ $offlineCount ?? 0 }} Produk</h5>

            <div class="progress mt-2" style="height:6px">
                <div class="progress-bar bg-primary" style="width: 100%"></div>
            </div>
        </div>
    </div>

    {{-- TOKOPEDIA --}}
    <div class="col-md-4 col-12 mb-3">
        <div class="card-soft p-3">
            <small>Tokopedia</small>
            <h5 class="fw-bold">{{ $tokopediaCount ?? 0 }} Produk</h5>

            <div class="progress mt-2" style="height:6px">
                <div class="progress-bar bg-success" style="width: 70%"></div>
            </div>
        </div>
    </div>

    {{-- SHOPEE --}}
    <div class="col-md-4 col-12 mb-3">
        <div class="card-soft p-3">
            <small>Shopee</small>
            <h5 class="fw-bold">{{ $shopeeCount ?? 0 }} Produk</h5>

            <div class="progress mt-2" style="height:6px">
                <div class="progress-bar bg-warning" style="width: 40%"></div>
            </div>
        </div>
    </div>

</div>

@endsection
