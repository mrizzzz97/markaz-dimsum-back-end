@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/main.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to right, #f0f4f7, #d9f8e2);
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        font-weight: 700;
        color: #1dbf73;
    }

    label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #1dbf73;
        box-shadow: 0 0 0 3px rgba(29, 191, 115, 0.25);
    }

    .btn-success {
        background-color: #1dbf73;
        border: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #17a864;
    }

    .btn-secondary {
        font-weight: 600;
    }

    .alert-danger {
        border-left: 4px solid #dc3545;
        border-radius: 8px;
        background-color: #ffe5e9;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endpush

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Tambah Produk Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group mt-3">
            <label for="price">Harga (Rp):</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="image">Gambar Produk (upload):</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group mt-3">
            <label for="image_url">Atau URL Gambar:</label>
            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url') }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success rounded-pill px-4">Simpan Produk</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary rounded-pill px-4 ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
