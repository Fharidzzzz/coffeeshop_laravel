<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Landing Page awal
Route::get('/', function () {
    return view('welcome');
});

// Rute Autentikasi (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// ☕ Rute KHUSUS USER/CUSTOMER (Harus login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/shop', [ProductController::class, 'index']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
});

// 👑 Rute KHUSUS ADMIN (Harus login & lolos Middleware IsAdmin)
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    
    // 📊 READ: Tampilan Utama Dashboard Admin (Tabel Produk)
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    
    // ➕ CREATE: Rute untuk menampilkan form dan menyimpan produk baru
    Route::get('/admin/products/create', [AdminController::class, 'create']);
    Route::post('/admin/products', [AdminController::class, 'store']);
    
    // 📝 UPDATE: Rute untuk memunculkan form edit dan menyimpan perubahan
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/admin/products/{id}', [AdminController::class, 'update']);
    
    // ❌ DELETE: Rute untuk menghapus data menu kopi
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy']);
    
});