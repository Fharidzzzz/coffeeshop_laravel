<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 📊 1. READ: Menampilkan semua produk di halaman dashboard admin
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    // ➕ 2. CREATE: Menampilkan form tambah produk baru
    public function create()
    {
        return view('admin.create');
    }

    // 💾 3. STORE: Menyimpan data dari form ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect('/admin/dashboard')->with('success', 'Menu kopi baru berhasil ditambahkan!');
    }

    // 📝 4. EDIT: Menampilkan form edit data produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // 🔄 5. UPDATE: Menyimpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect('/admin/dashboard')->with('success', 'Menu kopi berhasil diperbarui!');
    }

    // ❌ 6. DELETE: Menghapus menu kopi dari database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Menu kopi berhasil dihapus!');
    }
}