<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Menangani Logika Login
    public function login(Request $request)
    {
        // Validasi input tingkat lanjut (Wajib untuk UAS!)
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Proses Otentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek Role setelah login berhasil
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/shop');
        }

        // Jika login gagal, kembalikan dengan error pesan mewah
        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan arsip eksklusif kami.',
        ])->onlyInput('email');
    }

    // 3. Menampilkan Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 4. Menangani Logika Register Customer Baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Otomatis mendaftar sebagai customer biasa
        ]);

        Auth::login($user);

        return redirect('/shop');
    }

    // 5. Menangani Logika Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}