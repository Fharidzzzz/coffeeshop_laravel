<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Update kolom 'image' untuk tiap produk.
     *
     * PENTING: nama file di sini harus SAMA PERSIS (termasuk huruf besar/kecil)
     * dengan nama file yang kamu simpan di folder:
     * storage/app/public/products/
     */
    public function run(): void
    {
        $images = [
            1 => 'golden-truffle-latte.jpg',
            2 => 'madagascar-vanilla-cold-brew.jpg',
            3 => 'saffron-affogato-royal.jpg',
            4 => 'velvet-espresso-shakerato.jpg',
            5 => 'kyoto-matcha-espresso-fusion.jpg',
            6 => 'himalayan-butterscotch.jpg',
        ];

        foreach ($images as $id => $filename) {
            $product = Product::find($id);

            if ($product) {
                $product->image = $filename;
                $product->save();
                echo "Updated #{$id} - {$product->name} -> {$filename}" . PHP_EOL;
            } else {
                echo "Produk dengan ID {$id} tidak ditemukan, dilewati." . PHP_EOL;
            }
        }
    }
}