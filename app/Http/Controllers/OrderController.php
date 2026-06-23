<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Validasi request dan ambil data produk
        $product = Product::findOrFail($request->product_id);
        $user = auth()->user();

        // 2. Buat record order baru di database dengan status pending
        $order = Order::create([
            'number' => 'INV-' . time() . rand(10, 99), // Nomor invoice unik otomatis
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
            'status' => 'pending',
        ]);

        // 3. Konfigurasi SDK Midtrans menggunakan data dari file .env
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 4. Susun parameter transaksi untuk dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => $product->id,
                    'price' => (int) $product->price,
                    'quantity' => 1,
                    'name' => $product->name,
                ]
            ]
        ];

        try {
            // 5. Minta Snap Token resmi dari server Midtrans Sandbox
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke database agar bisa dipanggil di view
            $order->update(['snap_token' => $snapToken]);

            // 6. Alirkan token dan data pesanan ke halaman konfirmasi bayar
            return view('checkout', compact('order', 'snapToken'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke Midtrans: ' . $e->getMessage());
        }
    }
}