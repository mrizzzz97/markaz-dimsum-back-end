@extends('layouts.admin')

@section('title', 'Edit Product')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/main.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #f0f4f7, #d9f8e2);
        font-family: 'Poppins', sans-serif;
    }
    h2 { font-weight: 700; color: #1dbf73; }
    label { font-weight: 600; }
    .form-control { border-radius: 10px; }
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

    <form method="POST"
          action="{{ route('admin.products.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text"
                   class="form-control"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   required>
        </div>

        {{-- HARGA --}}
        <div class="form-group mt-3">
            <label>Harga (Rp)</label>

            {{-- tampilan --}}
            <input type="text"
                   id="price_display"
                   class="form-control"
                   value="{{ number_format(old('price', $product->price), 0, ',', '.') }}"
                   placeholder="Contoh: 25.000">

            {{-- nilai asli --}}
            <input type="hidden"
                   id="price"
                   name="price"
                   value="{{ old('price', $product->price) }}"
                   required>
        </div>

        {{-- STOK --}}
        <div class="form-group mt-3">
            <label>Stok</label>
            <input type="number"
                   class="form-control"
                   name="stock"
                   value="{{ old('stock', $product->stock) }}"
                   min="0"
                   required>
        </div>

        {{-- RATING --}}
        <div class="form-group mt-3">
            <label>Rating (0–5)</label>
            <input type="number"
                   step="0.1"
                   min="0"
                   max="5"
                   class="form-control"
                   name="rating"
                   value="{{ old('rating', $product->rating) }}">
        </div>

        {{-- DESKRIPSI --}}
        <div class="form-group mt-3">
            <label>Deskripsi</label>
            <textarea class="form-control"
                      name="description"
                      rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- GAMBAR --}}
        <div class="form-group mt-3">
            <label>Upload Gambar Baru</label>
            <input type="file"
                   class="form-control"
                   id="image"
                   name="image"
                   accept="image/*">
        </div>

        <div class="form-group mt-3">
            <label>Atau URL Gambar</label>
            <input type="url"
                   class="form-control"
                   id="image_url"
                   name="image_url">
        </div>

        {{-- PREVIEW --}}
        <div class="form-group mt-3">
            <label>Preview Gambar</label><br>
            @if($product->image)
                @if(\Illuminate\Support\Str::startsWith($product->image, 'http'))
                    <img id="preview-image" src="{{ $product->image }}" width="200">
                @else
                    <img id="preview-image" src="{{ asset('storage/'.$product->image) }}" width="200">
                @endif
            @else
                <img id="preview-image" style="display:none;" width="200">
            @endif
        </div>

        <hr>

        {{-- LINK PEMBELIAN --}}
        <div class="form-group mt-3">
            <label>Link Tokopedia</label>
            <input type="url"
                   class="form-control"
                   name="tokopedia_url"
                   value="{{ old('tokopedia_url', $product->tokopedia_url) }}"
                   placeholder="https://www.tokopedia.com/...">
        </div>

        <div class="form-group mt-3">
            <label>Link Shopee</label>
            <input type="url"
                   class="form-control"
                   name="shopee_url"
                   value="{{ old('shopee_url', $product->shopee_url) }}"
                   placeholder="https://shopee.co.id/...">
        </div>

        {{-- OFFLINE --}}
        <div class="form-check mt-3">
            <input class="form-check-input"
                   type="checkbox"
                   name="offline_available"
                   value="1"
                   id="offline"
                   {{ old('offline_available', $product->offline_available) ? 'checked' : '' }}>
            <label class="form-check-label" for="offline">
                Tersedia di Offline Store
            </label>
        </div>

        {{-- BUTTON --}}
        <div class="mt-4">
            <button type="submit"
                    class="btn btn-success rounded-pill px-4">
                Update Produk
            </button>
            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-secondary rounded-pill px-4 ml-2">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- SCRIPT --}}
<script>
    const priceDisplay = document.getElementById('price_display');
    const priceInput   = document.getElementById('price');

    const imageInput    = document.getElementById('image');
    const imageUrlInput = document.getElementById('image_url');
    const preview       = document.getElementById('preview-image');

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function onlyNumber(str) {
        return str.replace(/\D/g, '');
    }

    priceDisplay.addEventListener('input', function () {
        const raw = onlyNumber(this.value);
        priceInput.value = raw;
        this.value = formatRupiah(raw);
    });

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            imageUrlInput.value = '';
        }
    });

    imageUrlInput.addEventListener('input', function () {
        if (this.value) {
            preview.src = this.value;
            preview.style.display = 'block';
            imageInput.value = '';
        }
    });
</script>
@endsection
