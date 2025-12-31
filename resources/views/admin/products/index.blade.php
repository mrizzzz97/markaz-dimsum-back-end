@extends('layouts.admin')

@section('title', 'Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Produk</h4>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        + Tambah Produk
    </a>
</div>

<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Rating</th>
                    <th>Channel</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>

                        <td>
                            <strong>{{ $product->name }}</strong><br>
                            <small class="text-muted">
                                {{ \Illuminate\Support\Str::limit($product->description, 40) }}
                            </small>
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="text-center">
                            @if ($product->stock == 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif ($product->stock <= 5)
                                <span class="badge bg-warning text-dark">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="badge bg-success">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            ⭐ {{ $product->rating }}
                        </td>

                        <td>
                            @if ($product->offline_available)
                                <span class="badge bg-primary mb-1">Offline</span>
                            @endif

                            @if ($product->tokopedia_url)
                                <span class="badge bg-success mb-1">Tokopedia</span>
                            @endif

                            @if ($product->shopee_url)
                                <span class="badge bg-warning text-dark mb-1">Shopee</span>
                            @endif
                        </td>

                        <td>
                            {{ $product->created_at->format('d M Y') }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn btn-sm btn-warning mb-1">
                                Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada produk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
