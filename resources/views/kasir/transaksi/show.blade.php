@extends('layouts.kasir')

@section('title', 'Struk Transaksi')

@section('content')
<div class="container-fluid">

    {{-- PRINT AREA --}}
    <div id="print-area">

        <div class="card-soft p-3" style="max-width:380px;margin:auto;font-size:13px">

            {{-- HEADER --}}
            <div class="text-center mb-2">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo Markaz Dimsum"
                     style="height:60px">

                <h6 class="mb-0 mt-1">Markaz Dimsum</h6>
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

            {{-- ITEMS --}}
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
                    <td align="right">
                        <strong>Rp {{ number_format($transaction->total,0,',','.') }}</strong>
                    </td>
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

            <p class="text-center mb-0">
                <small>Terima kasih 💚<br>Semoga harimu menyenangkan</small>
            </p>

        </div>
    </div>

    {{-- BUTTON --}}
    <div class="text-center mt-3 d-print-none">
        <button onclick="window.print()" class="btn btn-success btn-sm">
            Print
        </button>

        <button onclick="downloadPDF()" class="btn btn-primary btn-sm">
            Download
        </button>

        <a href="{{ route('kasir.transaksi.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>

{{-- SCRIPT PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById('print-area');

    const opt = {
        margin: 0,
        filename: 'struk-{{ $transaction->invoice_code }}.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: 'mm',
            format: [58, 200],
            orientation: 'portrait'
        }
    };

    html2pdf().set(opt).from(element).save();
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

    .card-soft {
        box-shadow: none !important;
        border: none !important;
    }
}
</style>
@endsection
    