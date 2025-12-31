@extends('layouts.kasir')

@section('content')
<div class="row">

    <div class="col-md-6 mb-3">
        <div class="card-soft p-3 text-center">
            <small>Total Produk</small>
            <h3>{{ $totalProduk }}</h3>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card-soft p-3 text-center">
            <small>Stok Habis</small>
            <h3 class="text-danger">{{ $stokHabis }}</h3>
        </div>
    </div>

</div>
@endsection
