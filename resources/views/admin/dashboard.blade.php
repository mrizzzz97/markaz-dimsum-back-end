@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('style/main.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to right, #f0f4f7, #d9f8e2);
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-weight: 700;
        color: #1dbf73;
    }

    .table th {
        background-color: #e8f5e9;
        font-weight: 600;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #1dbf73;
        border: none;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #159a5f;
    }

    .btn-danger {
        font-weight: 600;
    }

    .alert-success {
        background-color: #e6ffed;
        color: #1b5e20;
        border-left: 4px solid #1dbf73;
    }

    img {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    table {
        border-radius: 10px;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 d-flex justify-content-between align-items-center">
        Admin Dashboard
        <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm rounded-pill px-3">Tambah Produk</a>
    </h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <p class="text-muted">No products found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm rounded">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price (Rp)</th>
                        <th>Rating</th>
                        <th>Image</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->rating }}</td>
                        <td>
                            @if($product->image)
                                @if(preg_match('/^https?:\/\//', $product->image))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-height: 60px;">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 60px;">
                                @endif
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">Edit</a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-danger rounded-pill px-4">Logout</button>
    </form>
</div>
@endsection
