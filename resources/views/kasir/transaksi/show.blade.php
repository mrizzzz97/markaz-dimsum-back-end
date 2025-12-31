@extends('layouts.kasir')

@section('title', 'Struk Transaksi')

@section('content')
<div class="container-fluid">

    {{-- AREA STRUK --}}
    <div id="print-area">

        <div style="max-width:380px;margin:auto;font-size:13px;font-family:Arial">

            {{-- HEADER --}}
            <div style="text-align:center;margin-bottom:10px">
                <img src="{{ asset('images/logo.png') }}" style="height:60px">
                <h4 style="margin:5px 0 0">Markaz Dimsum</h4>
                <small>Struk Pembelian</small>
            </div>

            <hr>

            {{-- INFO --}}
            <table width="100%">
                <tr>
                    <td>Invoice</td>
                    <td align="right">{{ $transaction->invoice_code }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td align="right">
                        {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td align="right">{{ $transaction->cashier->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td align="right">{{ $transaction->customer_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Metode</td>
                    <td align="right">{{ strtoupper($transaction->payment_method) }}</td>
                </tr>
            </table>

            <hr>

            {{-- ITEM --}}
            <table width="100%">
                @foreach ($transaction->items as $item)
                <tr>
                    <td>
                        {{ $item->product->name }} <br>
                        <small>{{ $item->qty }} x Rp {{ number_format($item->product->price,0,',','.') }}</small>
                    </td>
                    <td align="right">
                        Rp {{ number_format($item->subtotal,0,',','.') }}
                    </td>
                </tr>
                @endforeach
            </table>

            <hr>

            {{-- TOTAL --}}
            <table width="100%">
                <tr>
                    <td><strong>Total</strong></td>
                    <td align="right"><strong>Rp {{ number_format($transaction->total,0,',','.') }}</strong></td>
                </tr>
                <tr>
                    <td>Dibayar</td>
                    <td align="right">Rp {{ number_format($transaction->paid,0,',','.') }}</td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td align="right">Rp {{ number_format($transaction->change,0,',','.') }}</td>
                </tr>
            </table>

            <hr>

            <p style="text-align:center;margin-bottom:0">
                <small>Terima kasih 💚<br>Semoga harimu menyenangkan</small>
            </p>

        </div>
    </div>

    {{-- BUTTON --}}
    <div class="text-center mt-3 d-print-none">
        <button onclick="window.print()" class="btn btn-success btn-sm">
            Print
        </button>

        <button onclick="downloadImage()" class="btn btn-warning btn-sm">
            Download Foto
        </button>

        <a href="{{ route('kasir.transaksi.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>

{{-- SCRIPT FOTO --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadImage() {
    const element = document.getElementById('print-area');

    html2canvas(element, {
        scale: 2,
        backgroundColor: '#ffffff'
    }).then(canvas => {
        const link = document.createElement('a');
        link.download = 'struk-{{ $transaction->invoice_code }}.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
}
</script>

{{-- PRINT STYLE --}}
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #print-area, #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>
@endsection
