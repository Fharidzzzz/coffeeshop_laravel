<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('number')->unique(); // Nomor invoice unik (misal: INV-123456)
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang beli
        $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Kopi apa yang dibeli
        $table->integer('quantity')->default(1); // Jumlah pesanan
        $table->decimal('total_price', 12, 2); // Total bayar dalam Rupiah
        $table->string('status')->default('pending'); // pending, success, atau failed
        $table->string('snap_token')->nullable(); // Token dari Midtrans untuk memunculkan pop-up bayar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
