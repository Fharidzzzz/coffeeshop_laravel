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
Route::middleware('auth')->group(function () {
    Route::get('/shop', function () {
        return "<h1>Selamat Datang di Katalog Kopi Mewah</h1><p>Halo, " . auth()->user()->name . ". Ini halaman belanja premium kamu.</p><form action='/logout' method='POST'>" . csrf_field() . "<button type='submit'>Logout</button></form>";
    });
});

// 👑 Rute KHUSUS ADMIN (Harus login & lolos Middleware IsAdmin)
Route::middleware(['auth', \App\Http\Middleware::class . '\IsAdmin'::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "<h1>Dashboard Manajemen Coffee Shop (ADMIN)</h1><p>Selamat datang Boss, " . auth()->user()->name . ".</p><form action='/logout' method='POST'>" . csrf_field() . "<button type='submit'>Logout</button></form>";
    });
});