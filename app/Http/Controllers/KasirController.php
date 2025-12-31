<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KasirController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        return view('kasir.dashboard', [
            'totalProduk' => Product::count(),
            'stokHabis'   => Product::where('stock', 0)->count(),
        ]);
    }

    // ================= RIWAYAT TRANSAKSI =================
    public function index()
    {
        $transactions = Transaction::with('cashier')
            ->latest()
            ->get();

        return view('kasir.transaksi.index', compact('transactions'));
    }

    // ================= FORM TRANSAKSI =================
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('kasir.transaksi.create', compact('products'));
    }

    // ================= SIMPAN TRANSAKSI =================
    public function store(Request $request)
    {
        $request->validate([
            'products'        => 'required|array',
            'qty'             => 'required|array',
            'payment_method'  => 'required',
            'total'           => 'required|numeric',
            'paid'            => 'nullable|numeric',
        ]);

        /* ================= INVOICE CANTIK ================= */
        $today = Carbon::now()->format('Ymd');

        $countToday = Transaction::whereDate(
            'created_at',
            Carbon::today()
        )->count() + 1;

        $number = str_pad($countToday, 3, '0', STR_PAD_LEFT);

        $invoiceCode = 'INV-' . $today . '-' . $number;
        /* ================================================== */

        // 🔹 transaksi utama
        $transaction = Transaction::create([
            'invoice_code'   => $invoiceCode,
            'customer_name'  => $request->customer_name,
            'payment_method' => $request->payment_method,
            'total'          => $request->total,
            'paid'           => $request->paid ?? 0,
            'change'         => max(($request->paid ?? 0) - $request->total, 0),
            'cashier_id'     => Auth::id(),
        ]);

        // 🔹 item transaksi
        foreach ($request->products as $index => $productId) {
            $qty = (int) $request->qty[$index];

            if ($qty > 0) {
                $product  = Product::findOrFail($productId);
                $subtotal = $product->price * $qty;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $product->id,
                    'qty'            => $qty,
                    'price'          => $product->price,
                    'subtotal'       => $subtotal,
                ]);

                // kurangi stok
                $product->decrement('stock', $qty);
            }
        }

        return redirect()
            ->route('kasir.transaksi.show', $transaction->id)
            ->with('success', 'Transaksi berhasil disimpan');
    }

    // ================= STRUK / DETAIL =================
    public function show($id)
    {
        $transaction = Transaction::with([
            'items.product',
            'cashier'
        ])->findOrFail($id);

        return view('kasir.transaksi.show', compact('transaction'));
    }
}
