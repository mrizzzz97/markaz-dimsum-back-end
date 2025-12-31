@extends('layouts.kasir')

@section('title', 'Struk Transaksi')

@section('content')

<div class="container-fluid d-print-none text-center mb-3">
    <button onclick="window.print()" class="btn btn-success btn-sm">Print</button>
    <button onclick="downloadImage()" class="btn btn-warning btn-sm">Download Foto</button>
    <a href="{{ route('kasir.transaksi.struk.text', $transaction->id) }}"
       target="_blank"
       class="btn btn-dark btn-sm">Cetak Struk (Thermal)</a>
    <a href="{{ route('kasir.transaksi.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>

{{-- ================= STRUK THERMAL ================= --}}
<div id="print-area">

<pre style="
    font-family: monospace;
    font-size: 12px;
    line-height: 1.4;
    background: #ffffff;
    color: #000000;
    padding: 10px;
    width: 58mm;
    margin: auto;
">

            MARKAZ DIMSUM
         STRUK PEMBELIAN
--------------------------------
Invoice : {{ $transaction->invoice_code }}
Tanggal : {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
Kasir   : {{ $transaction->cashier->name ?? '-' }}
Pelanggan: {{ $transaction->customer_name ?? '-' }}
Metode  : {{ strtoupper($transaction->payment_method) }}
--------------------------------
@foreach ($transaction->items as $item)
{{ $item->product->name }}
{{ $item->qty }} x {{ number_format($item->product->price,0,',','.') }}
    {{ number_format($item->subtotal,0,',','.') }}
@endforeach
--------------------------------
TOTAL     {{ number_format($transaction->total,0,',','.') }}
DIBAYAR   {{ number_format($transaction->paid,0,',','.') }}
KEMBALI   {{ number_format($transaction->change,0,',','.') }}
--------------------------------
     TERIMA KASIH 🤍
</pre>

</div>
{{-- ================= END STRUK ================= --}}

{{-- SCRIPT FOTO --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadImage() {
    const el = document.getElementById('print-area');
    html2canvas(el, {
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

{{-- PRINT CSS --}}
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
    }
}
</style>

@endsection
