@extends('layouts.kasir')

@section('title', 'Struk Transaksi')

@section('content')
<div class="container-fluid">

    {{-- PRINT AREA --}}
    <div id="print-area">

        <div class="card-soft p-4" style="max-width:600px;margin:auto">

            {{-- HEADER --}}
            <div class="text-center mb-3">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo Markaz Dimsum"
                     style="height:70px">

                <h5 class="mb-0 mt-2">Markaz Dimsum</h5>
                <small class="text-muted">Struk Pembelian</small>
            </div>

            <hr>

            {{-- INFO TRANSAKSI --}}
            <table class="table table-borderless mb-2">
                <tr>
                    <td>Invoice</td>
                    <td class="text-end">{{ $transaction->invoice_code }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td class="text-end">
                        {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td class="text-end">
                        {{ $transaction->cashier->name ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td class="text-end">
                        {{ $transaction->customer_name ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td>Metode</td>
                    <td class="text-end text-uppercase">
                        {{ $transaction->payment_method }}
                    </td>
                </tr>
            </table>

            <hr>

            {{-- ITEM --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-end">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            {{-- TOTAL --}}
            <table class="table table-borderless">
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-end">
                        <strong>
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td>Dibayar</td>
                    <td class="text-end">
                        Rp {{ number_format($transaction->paid, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td class="text-end">
                        Rp {{ number_format($transaction->change, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

        </div>
    </div>

    {{-- BUTTON (TIDAK IKUT PRINT) --}}
    <div class="text-center mt-3 d-print-none">
        <button onclick="window.print()" class="btn btn-success btn-sm">
            Print Struk
        </button>

        <a href="{{ route('kasir.transaksi.index') }}"
           class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>

{{-- PRINT CSS --}}
<style>
@media print {

    /* SEMBUNYIKAN SEMUA */
    body * {
        visibility: hidden;
    }

    /* TAMPILKAN STRUK SAJA */
    #print-area, #print-area * {
        visibility: visible;
    }

    /* POSISI STRUK */
    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    /* HILANGKAN SIDEBAR & HEADER */
    .sidebar, .topbar {
        display: none !important;
    }

    /* RAPIN */
    .card-soft {
        box-shadow: none !important;
        border: none !important;
    }
}
</style>
@endsection
