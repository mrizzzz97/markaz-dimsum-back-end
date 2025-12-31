@extends('layouts.kasir')

@section('title', 'Transaksi Baru')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Transaksi Baru</h4>

    <form action="{{ route('kasir.transaksi.store') }}" method="POST">
        @csrf

        {{-- ================= DATA PELANGGAN ================= --}}
        <div class="card-soft p-4 mb-4">
            <h6 class="mb-3">Data Pelanggan</h6>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text"
                           name="customer_name"
                           class="form-control"
                           placeholder="Opsional">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="payment_method"
                            id="payment_method"
                            class="form-control"
                            required>
                        <option value="">-- Pilih --</option>
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="tokopedia">Tokopedia</option>
                        <option value="shopee">Shopee</option>
                    </select>
                </div>
            </div>

            {{-- QRIS --}}
            <div id="qrisBox" class="mt-3 d-none">
                <label>Scan QRIS</label><br>
                <img src="{{ asset('images/qris.png') }}"
                     alt="QRIS"
                     style="max-width:200px">
            </div>
        </div>

        {{-- ================= PRODUK ================= --}}
        <div class="card-soft p-4 mb-4">
            <h6 class="mb-3">Daftar Produk</h6>

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th width="150">Harga</th>
                        <th width="120">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <strong>{{ $product->name }}</strong><br>
                            <small class="text-muted">Stok: {{ $product->stock }}</small>
                            <input type="hidden" name="products[]" value="{{ $product->id }}">
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            <input type="hidden" class="price" value="{{ $product->price }}">
                        </td>

                        <td>
                            <input type="number"
                                   name="qty[]"
                                   class="form-control qty"
                                   min="0"
                                   max="{{ $product->stock }}"
                                   value="0">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ================= PEMBAYARAN ================= --}}
        <div class="card-soft p-4 mb-4">
            <h6 class="mb-3">Pembayaran</h6>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Total Belanja</label>
                    <input type="text" id="total_display" class="form-control" readonly>
                    <input type="hidden" id="total" name="total">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Uang Dibayar</label>
                    {{-- input tampilan --}}
                    <input type="text"
                           id="paid_display"
                           class="form-control"
                           placeholder="Masukkan uang">
                    {{-- input asli --}}
                    <input type="hidden"
                           id="paid"
                           name="paid">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Kembalian</label>
                    <input type="text" id="change" class="form-control" readonly>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-success px-4">
                Proses Transaksi
            </button>
        </div>

    </form>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
    const qtyInputs   = document.querySelectorAll('.qty');
    const prices      = document.querySelectorAll('.price');
    const totalEl     = document.getElementById('total');
    const totalDisp   = document.getElementById('total_display');
    const paidDisplay = document.getElementById('paid_display');
    const paidEl      = document.getElementById('paid');
    const changeEl    = document.getElementById('change');

    function rupiah(n) {
        return 'Rp ' + (n || 0).toLocaleString('id-ID');
    }

    function onlyNumber(str) {
        return parseInt(str.replace(/\D/g, '')) || 0;
    }

    function hitungTotal() {
        let total = 0;
        qtyInputs.forEach((qty, i) => {
            total += (parseInt(qty.value) || 0) * (parseInt(prices[i].value) || 0);
        });

        totalEl.value = total;
        totalDisp.value = rupiah(total);
        hitungKembalian();
    }

    function hitungKembalian() {
        const bayar = parseInt(paidEl.value) || 0;
        const total = parseInt(totalEl.value) || 0;
        const kembali = bayar - total;
        changeEl.value = kembali > 0 ? rupiah(kembali) : rupiah(0);
    }

    qtyInputs.forEach(q => q.addEventListener('input', hitungTotal));

    paidDisplay.addEventListener('input', function () {
        const angka = onlyNumber(this.value);
        paidEl.value = angka;
        this.value = rupiah(angka);
        hitungKembalian();
    });

    // QRIS toggle
    const paymentSelect = document.getElementById('payment_method');
    const qrisBox = document.getElementById('qrisBox');

    paymentSelect.addEventListener('change', function () {
        qrisBox.classList.toggle('d-none', this.value !== 'qris');
    });
</script>
@endsection
