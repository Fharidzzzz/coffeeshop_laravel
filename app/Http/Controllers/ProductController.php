<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data kopi mewah dari database (Eloquent Read)
        $products = Product::all();
        
        // Kirim data produk ke view shop
        return view('shop', compact('products'));
    }
}