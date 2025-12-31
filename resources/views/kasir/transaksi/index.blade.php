@extends('layouts.kasir')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container-fluid">

    <div class="card-soft p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Riwayat Transaksi</h5>

            <a href="{{ route('kasir.transaksi.create') }}"
               class="btn btn-success btn-sm">
                + Transaksi Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Invoice</th>
                        <th>Kasir</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $index => $t)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $t->invoice_code }}</td>
                            <td>{{ $t->cashier->name ?? '-' }}</td>
                            <td class="text-uppercase">{{ $t->payment_method }}</td>
                            <td>
                                Rp {{ number_format($t->total, 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('kasir.transaksi.show', $t->id) }}"
                                   class="btn btn-primary btn-sm">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
