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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique(); // Untuk URL yang rapi (misal: /menu/golden-truffle-latte)
        $table->text('description');
        $table->integer('price'); // Harga dalam rupiah (IDR)
        $table->string('image')->nullable(); // Menyimpan nama file gambar kopi
        $table->integer('stock')->default(20); // Stok default awal
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
