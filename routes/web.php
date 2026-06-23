<?php

use App\Http\Controllers\AuthController;
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
// ☕ Rute KHUSUS USER/CUSTOMER (Harus login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/shop', [\App\Http\Controllers\ProductController::class, 'index']);
    
    // 🚀 Tambahkan baris ini untuk rute checkout Midtrans
    Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout']);
});

// 👑 Rute KHUSUS ADMIN (Harus login & lolos Middleware IsAdmin)
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>The Monolith - Admin Management</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
            <style>body { font-family: "Inter", sans-serif; } .serif-title { font-family: "Playfair Display", serif; }</style>
        </head>
        <body class="bg-[#121212] text-[#F5F5F7] min-h-screen">
            <nav class="border-b border-[#222222] bg-[#1A1A1A] px-8 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <h1 class="serif-title text-xl font-bold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#AA771C]">THE MONOLITH</h1>
                    <span class="bg-[#D4AF37]/10 text-[#D4AF37] text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 border border-[#D4AF37]/20 rounded">Internal Management</span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-sm text-gray-400">Logged in as: <span class="text-white font-medium">' . auth()->user()->name . '</span></span>
                    <form action="/logout" method="POST" class="inline">
                        ' . csrf_field() . '
                        <button type="submit" class="bg-red-950/40 hover:bg-red-900/60 border border-red-800 text-red-400 text-xs uppercase font-semibold tracking-wider px-4 py-2 rounded-xl transition-all duration-300">Logout</button>
                    </form>
                </div>
            </nav>

            <main class="max-w-7xl mx-auto px-8 py-12">
                <div class="mb-8">
                    <h2 class="serif-title text-3xl font-bold text-white tracking-wide">Control Panel</h2>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, Boss. Seluruh sistem kontrol operasional coffee shop berada di bawah kendali Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-[#1A1A1A] border border-[#262626] rounded-2xl p-6 shadow-xl">
                        <p class="text-xs uppercase tracking-wider text-gray-500">Total Products</p>
                        <p class="text-3xl font-bold text-white mt-2">5 <span class="text-xs font-normal text-gray-500">Items Active</span></p>
                    </div>
                    <div class="bg-[#1A1A1A] border border-[#262626] rounded-2xl p-6 shadow-xl opacity-60">
                        <p class="text-xs uppercase tracking-wider text-gray-500">Total Orders (Coming Soon)</p>
                        <p class="text-3xl font-bold text-white mt-2">0 <span class="text-xs font-normal text-gray-500">Transactions</span></p>
                    </div>
                    <div class="bg-[#1A1A1A] border border-[#262626] rounded-2xl p-6 shadow-xl opacity-60">
                        <p class="text-xs uppercase tracking-wider text-gray-500">Revenue (Coming Soon)</p>
                        <p class="text-3xl font-bold text-white mt-2">Rp 0</p>
                    </div>
                </div>

                <div class="border-2 border-dashed border-[#2A2A2A] rounded-2xl p-12 text-center bg-[#161616]/50">
                    <span class="text-4xl">🛠️</span>
                    <h3 class="text-lg font-medium text-white mt-4">Modul Manajemen Produk (CRUD)</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto mt-2">Tahap berikutnya: Kita akan membangun tabel manajemen data produk di area ini agar Admin bisa melakukan Tambah, Edit, dan Hapus menu kopi.</p>
                </div>
            </main>
        </body>
        </html>';
    });
});