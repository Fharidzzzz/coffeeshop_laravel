<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    // 💾 3. STORE: Menyimpan data + FOTO BARU dari form ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto maks 2MB
        ]);

        $data = $request->all();

        // 📸 Logika memproses upload file gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Bikin nama file unik
            $file->storeAs('public/products', $filename); // Simpan fisiknya ke storage/app/public/products
            $data['image'] = $filename; // Masukkan nama file ke array database
        }

        Product::create($data);

        return redirect('/admin/dashboard')->with('success', 'Menu kopi baru berhasil ditambahkan!');
    }

    // 📝 4. EDIT: Menampilkan form edit data produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // 🔄 5. UPDATE: Menyimpan perubahan data + GANTI FOTO ke database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // 📸 Logika ganti gambar
        if ($request->hasFile('image')) {
            // Hapus file foto lama di folder storage agar tidak menumpuk dan bikin penuh laptop
            if ($product->image && Storage::exists('public/products/' . $product->image)) {
                Storage::delete('public/products/' . $product->image);
            }

            // Upload file foto baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect('/admin/dashboard')->with('success', 'Menu kopi berhasil diperbarui!');
    }

    // ❌ 6. DELETE: Menghapus menu kopi + FOTONYA sekalian dari database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambarnya dari folder storage saat menu dihapus
        if ($product->image && Storage::exists('public/products/' . $product->image)) {
            Storage::delete('public/products/' . $product->image);
        }

        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Menu kopi berhasil dihapus!');
    }
}