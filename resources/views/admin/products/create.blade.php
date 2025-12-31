@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    h2 {
        font-weight: 700;
        color: #1dbf73;
    }
    label {
        font-weight: 600;
        color: #333;
    }
    .form-control {
        border-radius: 12px;
    }
    .btn-success {
        background-color: #1dbf73;
        border: none;
        font-weight: 600;
    }
    .btn-success:hover {
        background-color: #17a864;
    }
    .form-wrapper {
        max-width: 700px;
        margin: auto;
    }
    @media (max-width: 768px) {
        .form-wrapper {
            padding: 0 5px;
        }
    }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="card-soft p-4">

        <h2 class="mb-4 text-center">Tambah Produk Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- NAMA --}}
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       required>
            </div>

            {{-- HARGA --}}
            <div class="form-group mt-3">
                <label>Harga (Rp)</label>

                {{-- tampilan --}}
                <input type="text"
                       id="price_display"
                       class="form-control"
                       placeholder="Contoh: 25.000">

                {{-- nilai asli --}}
                <input type="hidden"
                       id="price"
                       name="price"
                       required>
            </div>

            {{-- STOK --}}
            <div class="form-group mt-3">
                <label>Stok Produk</label>
                <input type="number"
                       class="form-control"
                       name="stock"
                       min="0"
                       value="0"
                       required>
            </div>

            {{-- RATING --}}
            <div class="form-group mt-3">
                <label>Rating</label>
                <input type="number"
                       step="0.1"
                       max="5"
                       min="0"
                       class="form-control"
                       name="rating"
                       value="5">
            </div>

            {{-- DESKRIPSI --}}
            <div class="form-group mt-3">
                <label>Deskripsi</label>
                <textarea class="form-control"
                          name="description"
                          rows="3"></textarea>
            </div>

            <hr>

            {{-- GAMBAR --}}
            <div class="form-group mt-3">
                <label>Upload Gambar</label>
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
            <div class="form-group mt-3 text-center">
                <label>Preview Gambar</label><br>
                <img id="preview-image"
                     style="max-width:200px; display:none; border-radius:12px; border:1px solid #ddd;">
            </div>

            <hr>

            {{-- LINK PEMBELIAN --}}
            <div class="form-group mt-3">
                <label>Link Tokopedia</label>
                <input type="url"
                       class="form-control"
                       name="tokopedia_url"
                       placeholder="https://www.tokopedia.com/...">
            </div>

            <div class="form-group mt-3">
                <label>Link Shopee</label>
                <input type="url"
                       class="form-control"
                       name="shopee_url"
                       placeholder="https://shopee.co.id/...">
            </div>

            {{-- OFFLINE --}}
            <div class="form-check mt-3">
                <input class="form-check-input"
                       type="checkbox"
                       name="offline_available"
                       value="1"
                       id="offline">
                <label class="form-check-label" for="offline">
                    Tersedia di Offline Store
                </label>
            </div>

            {{-- BUTTON --}}
            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                <button type="submit"
                        class="btn btn-success rounded-pill px-4 mb-2 mb-sm-0">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.dashboard') }}"
                   class="btn btn-secondary rounded-pill px-4">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const priceDisplay = document.getElementById('price_display');
    const priceInput   = document.getElementById('price');

    const imageInput    = document.getElementById('image');
    const imageUrlInput = document.getElementById('image_url');
    const preview       = document.getElementById('preview-image');

    function onlyNumber(str) {
        return str.replace(/\D/g, '');
    }

    function formatRupiah(angka) {
        return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
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
