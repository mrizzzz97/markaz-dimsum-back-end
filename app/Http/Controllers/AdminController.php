<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // Ambil query builder untuk model Product
        $query = Product::query();

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
        }

        // Paginate hasil (misal 10 data per halaman)
        // Jangan lupa append parameter search agar pagination tetap membawa keyword
        $products = $query->latest()->paginate(10)->appends(['search' => $request->search]);

        return view('admin.products.index', compact('products'));
    }

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

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            }

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
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalProduk = Product::count();
        $stokHabis   = Product::where('stock', 0)->count();
        $stokMenipis = Product::whereBetween('stock', [1, 5])->count();

        $produkTerlaris = Product::orderBy('rating', 'desc')->value('name');

        $offlineCount = Product::where('offline_available', 1)->count();

        $tokopediaCount = Product::whereNotNull('tokopedia_url')
            ->where('tokopedia_url', '!=', '')
            ->count();

        $shopeeCount = Product::whereNotNull('shopee_url')
            ->where('shopee_url', '!=', '')
            ->count();

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
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'rating'      => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url',
            'tokopedia_url' => 'nullable|url',
            'shopee_url'    => 'nullable|url',
        ]);

        $imagePath = null;

        // ✅ UPLOAD FILE (FIX UTAMA)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = 'uploads/products/' . $filename;
        }
        // ✅ ATAU PAKE URL
        elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        Product::create([
            'name'              => $request->name,
            'price'             => $request->price,
            'stock'             => $request->stock,
            'rating'            => $request->rating ?? 5,
            'description'       => $request->description,
            'image'             => $imagePath,
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

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'rating'      => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                if (file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = 'uploads/products/' . $filename;
        }

        if ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        $product->update([
            'name'              => $request->name,
            'price'             => $request->price,
            'stock'             => $request->stock,
            'rating'            => $request->rating ?? $product->rating,
            'description'       => $request->description,
            'image'             => $imagePath,
            'tokopedia_url'     => $request->tokopedia_url,
            'shopee_url'        => $request->shopee_url,
            'offline_available' => $request->has('offline_available') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
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
