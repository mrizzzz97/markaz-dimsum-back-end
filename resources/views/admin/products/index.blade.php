@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Daftar Produk</h4>
            <p class="text-muted small mb-0">Kelola data produk, stok, dan harga.</p>
        </div>
        
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm mt-3 mt-md-0">
            <i class="fas fa-plus me-2"></i> Tambah Produk
        </a>
    </div>

    <!-- Search & Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control bg-light border-start-0" 
                               placeholder="Cari nama produk..." 
                               value="{{ request('search') }}">
                        @if(request('search'))
                            <a href="{{ route('admin.products.index') }}" class="input-group-text bg-light border-start-0 text-danger" title="Hapus Pencarian">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-center text-uppercase small fw-bold text-muted">
                            <th style="width: 80px;">Gambar</th>
                            <th class="text-start">Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Rating</th>
                            <!-- Channel disembunyikan di HP (col-md) jika layar terlalu sempit -->
                            <th class="d-none d-md-table-cell">Channel</th>
                            <th class="d-none d-md-table-cell">Dibuat</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <!-- Kolom Gambar -->
                                <td class="text-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded shadow-sm" 
                                             style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/45?text=No+Img" 
                                             alt="No Image" 
                                             class="rounded shadow-sm" 
                                             style="width: 45px; height: 45px; object-fit: cover;">
                                    @endif
                                </td>

                                <!-- Kolom Nama & Deskripsi -->
                                <td>
                                    <h6 class="mb-0 fw-bold text-primary">{{ $product->name }}</h6>
                                    <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                        {{ \Illuminate\Support\Str::limit($product->description, 50) }}
                                    </small>
                                </td>

                                <!-- Kolom Harga -->
                                <td class="text-end fw-bold text-dark">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <!-- Kolom Stok -->
                                <td class="text-center">
                                    @if ($product->stock == 0)
                                        <span class="badge bg-danger rounded-pill px-3">Habis</span>
                                    @elseif ($product->stock <= 5)
                                        <span class="badge bg-warning text-dark rounded-pill px-3">
                                            {{ $product->stock }} (Low)
                                        </span>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3">
                                            {{ $product->stock }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Kolom Rating -->
                                <td class="text-center text-warning">
                                    <i class="fas fa-star"></i> {{ $product->rating ?? 0 }}
                                </td>

                                <!-- Kolom Channel (Hidden on Mobile) -->
                                <td class="d-none d-md-table-cell text-center">
                                    <div class="d-flex flex-column gap-1">
                                        @if ($product->offline_available)
                                            <span class="badge bg-primary"><i class="fas fa-store me-1"></i>Offline</span>
                                        @endif

                                        @if ($product->tokopedia_url)
                                            <span class="badge bg-success"><i class="fas fa-shopping-bag me-1"></i>Tokopedia</span>
                                        @endif

                                        @if ($product->shopee_url)
                                            <span class="badge bg-warning text-dark"><i class="fas fa-bag-shopping me-1"></i>Shopee</span>
                                        @endif
                                        
                                        @if (!$product->offline_available && !$product->tokopedia_url && !$product->shopee_url)
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Kolom Tanggal (Hidden on Mobile) -->
                                <td class="d-none d-md-table-cell text-center text-muted small">
                                    {{ $product->created_at->format('d M y') }}
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="btn btn-sm btn-info text-white btn-action"
                                           title="Edit">
                                            <i class="fas fa-pencil-alt small"></i>
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-action" title="Hapus">
                                                <i class="fas fa-trash small"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3 text-secondary"></i>
                                        <p class="mb-0">Belum ada data produk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Style tambahan untuk responsifitas -->
<style>
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
    }
    /* Memastikan table tidak gepeng di layar sangat kecil */
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.85rem;
        }
        .badge {
            font-size: 0.7em;
        }
    }
</style>
@endsection  
