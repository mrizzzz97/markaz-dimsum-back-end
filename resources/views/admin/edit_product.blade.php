@extends('layouts.app')

@section('title', 'Edit Product')

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
    <h2 class="mb-4">Edit Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" required autofocus value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group mt-3">
            <label for="price">Price (Rp):</label>
            <input type="number" id="price" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
        </div>

        <div class="form-group mt-3">
            <label for="stock">Stock (bisa diisi dibawah 10):</label>
            <input type="number" id="stock" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
        </div>

        <div class="form-group mt-3">
            <label for="rating">Rating (0-5):</label>
            <input type="number" step="0.1" min="0" max="5" id="rating" name="rating" class="form-control" required value="{{ old('rating', $product->rating) }}">
        </div>

        <div class="form-group mt-3">
            <label for="image">Gambar Produk (upload)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group mt-3">
            <label for="image_url">Atau URL Gambar</label>
            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $product->image) }}">
        </div>

        <div class="form-group mt-3">
            <label for="description">Deskripsi Produk:</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success rounded-pill px-4">Update Product</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary rounded-pill px-4 ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
