<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Wajib import ini untuk API!

class ProductController extends Controller
{
    public function index()
    {
        // 1. Mengambil data produk dari database
        $products = Product::all();
        
        // 2. Mengambil data kurs real-time dari API eksternal (Tanpa API Key, menggunakan endpoint publik resmi)
        try {
            $response = Http::get('https://open.er-api.com/v6/latest/IDR');
            
            if ($response->successful()) {
                // Ambil rate konversi IDR ke USD
                $usdRate = $response->json()['rates']['USD'] ?? 0.000062; // fallback jika API down sekitar Rp 16.000
            } else {
                $usdRate = 0.000062;
            }
        } catch (\Exception $e) {
            $usdRate = 0.000062; // Antisipasi jika laptop tidak terkoneksi internet
        }

        // 3. Kirim data produk dan nilai kurs ke halaman View
        return view('shop', compact('products', 'usdRate'));
    }
}