<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 🔑 PEMBEDA ADMIN & KASIR
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            }

            // kalau role tidak dikenali
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Role akun tidak valid');
        }

        return back()->with('error', 'Email atau password salah');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD  🔥 INI YANG BIKIN 0 SEBELUMNYA
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        // PRODUK
        $totalProduk = Product::count();
        $stokHabis   = Product::where('stock', 0)->count();
        $stokMenipis = Product::whereBetween('stock', [1, 5])->count();

        // PRODUK TERLARIS (sementara pakai rating tertinggi)
        $produkTerlaris = Product::orderBy('rating', 'desc')->value('name');

        // CHANNEL PENJUALAN (JUMLAH PRODUK)
        $offlineCount = Product::where('offline_available', 1)->count();

        $tokopediaCount = Product::whereNotNull('tokopedia_url')
                                ->where('tokopedia_url', '!=', '')
                                ->count();

        $shopeeCount = Product::whereNotNull('shopee_url')
                              ->where('shopee_url', '!=', '')
                              ->count();

        // TRANSAKSI (BELUM ADA)
        $transaksiHariIni  = 0;
        $transaksiBulanIni = 0;

        return view('admin.dashboard', compact(
            'totalProduk',
            'stokHabis',
            'stokMenipis',
            'produkTerlaris',
            'offlineCount',
            'tokopediaCount',
            'shopeeCount',
            'transaksiHariIni',
            'transaksiBulanIni'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUK - LIST
    |--------------------------------------------------------------------------
    */

    public function products()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric',
            'stock'         => 'required|integer|min:0',
            'rating'        => 'nullable|numeric|min:0|max:5',
            'description'   => 'nullable|string',
            'tokopedia_url' => 'nullable|url',
            'shopee_url'    => 'nullable|url',
        ]);

        Product::create([
            'name'              => $request->name,
            'price'             => $request->price,
            'stock'             => $request->stock,
            'rating'            => $request->rating ?? 5,
            'description'       => $request->description,
            'tokopedia_url'     => $request->tokopedia_url,
            'shopee_url'        => $request->shopee_url,
            'offline_available' => $request->has('offline_available') ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name'              => $request->name,
            'price'             => $request->price,
            'stock'             => $request->stock,
            'rating'            => $request->rating ?? $product->rating,
            'description'       => $request->description,
            'tokopedia_url'     => $request->tokopedia_url,
            'shopee_url'        => $request->shopee_url,
            'offline_available' => $request->has('offline_available') ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index');
    }


}
