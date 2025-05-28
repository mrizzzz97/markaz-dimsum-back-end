<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('index', compact('products'));
});

Route::get('/produk/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('produk', compact('product'));
});

use App\Http\Controllers\AdminController;

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/tentang/sejarah', function () {
    return view('tentang.sejarah');
});

Route::get('/tentang/tim-kami', function () {
    return view('tentang.tim-kami');
});

Route::get('/tentang/visi-misi', function () {
    return view('tentang.visi-misi');
});

Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');

Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');

Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
