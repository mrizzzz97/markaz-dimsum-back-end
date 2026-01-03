<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    /* ================= AUTH ================= */

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
            return redirect()->route('login')->with('error', 'Role akun tidak valid');
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

    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalProduk'        => Product::count(),
            'stokHabis'          => Product::where('stock', 0)->count(),
            'stokMenipis'        => Product::whereBetween('stock', [1, 5])->count(),
            'produkTerlaris'     => Product::orderBy('rating', 'desc')->value('name'),
            'offlineCount'       => Product::where('offline_available', 1)->count(),
            'tokopediaCount'     => Product::whereNotNull('tokopedia_url')->where('tokopedia_url','!=','')->count(),
            'shopeeCount'        => Product::whereNotNull('shopee_url')->where('shopee_url','!=','')->count(),
            'transaksiHariIni'   => 0,
            'transaksiBulanIni'  => 0,
        ]);
    }

    /* ================= PRODUK ================= */

    public function products()
    {
        return view('admin.products.index', [
            'products' => Product::latest()->get()
        ]);
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
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

    public function editProduct($id)
    {
        return view('admin.products.edit', [
            'product' => Product::findOrFail($id)
        ]);
    }

    /* ================= UPDATE PRODUK (FIX HOSTING) ================= */

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

        // === UPLOAD FILE ===
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($product->image && !str_starts_with($product->image, 'http')) {
                $old = public_path($product->image);
                if (file_exists($old)) {
                    unlink($old);
                }
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/products'), $filename);

            $imagePath = 'storage/products/'.$filename;
        }

        // === URL GAMBAR ===
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

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index');
    }
}
