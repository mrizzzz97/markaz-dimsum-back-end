<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Text</title>
    <style>
        body {
            margin: 0;
            padding: 10px;
            background: #ffffff;
            color: #000000;
        }
        pre {
            font-family: monospace;
            font-size: 12px;
            line-height: 1.4;
            white-space: pre;
        }
    </style>
</head>
<body>

<pre>
MARKAZ DIMSUM
STRUK PEMBELIAN
--------------------------------
Invoice   : {{ $transaction->invoice_code }}
Tanggal   : {{ $transaction->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
Kasir     : {{ $transaction->cashier->name ?? '-' }}
Pelanggan : {{ $transaction->customer_name ?? '-' }}
Metode    : {{ strtoupper($transaction->payment_method) }}
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

</body>
</html>
