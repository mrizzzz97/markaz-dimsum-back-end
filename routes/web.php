<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// ================= HOME =================
Route::get('/', function () {
    $products = Product::all();
    return view('index', compact('products'));
})->name('home');

// ================= DETAIL PRODUK =================
Route::get('/produk/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('produk', compact('product'));
})->name('produk.show');

// ================= TENTANG =================
Route::get('/tentang', function () {
    $products = Product::all(); // 🔥 WAJIB
    return view('tentang', compact('products'));
})->name('tentang');

Route::get('/tentang/sejarah', fn () => view('tentang.sejarah'))
    ->name('tentang.sejarah');

Route::get('/tentang/tim-kami', fn () => view('tentang.tim-kami'))
    ->name('tentang.tim');

Route::get('/tentang/visi-misi', fn () => view('tentang.visi-misi'))
    ->name('tentang.visi');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AdminController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AdminController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AdminController::class, 'logout'])
    ->name('logout');

Route::post('/admin/logout', [AdminController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| PROTECTED AREA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ================= ADMIN =================
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/products', [AdminController::class, 'products'])
        ->name('admin.products.index');

    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])
        ->name('admin.products.create');

    Route::post('/admin/products', [AdminController::class, 'storeProduct'])
        ->name('admin.products.store');

    Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])
        ->name('admin.products.edit');

    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])
        ->name('admin.products.update');

    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])
        ->name('admin.products.destroy');

    // ================= KASIR =================
    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])
        ->name('kasir.dashboard');

    // 🔹 RIWAYAT TRANSAKSI
    Route::get('/kasir/transaksi', [KasirController::class, 'index'])
        ->name('kasir.transaksi.index');

    // 🔹 FORM TRANSAKSI BARU
    Route::get('/kasir/transaksi/create', [KasirController::class, 'create'])
        ->name('kasir.transaksi.create');

    // 🔹 SIMPAN TRANSAKSI
    Route::post('/kasir/transaksi', [KasirController::class, 'store'])
        ->name('kasir.transaksi.store');

    // 🔹 STRUK / DETAIL
    Route::get('/kasir/transaksi/{id}', [KasirController::class, 'show'])
        ->name('kasir.transaksi.show');

    // 🔹 STRUK MODE TEKS (KHUSUS THERMAL)
    Route::get('/kasir/transaksi/{id}/struk-text', [KasirController::class, 'strukText'])
        ->name('kasir.transaksi.struk.text');
});
