<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Jangan lupa import ini!

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Admin Coffee',
            'email' => 'admin@coffeeshop.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat akun User biasa
        User::create([
            'name' => 'Customer Biasa',
            'email' => 'user@coffeeshop.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
        
        // Memanggil ProductSeeder agar menu kopi juga terisi otomatis
        $this->call([
            ProductSeeder::class,
        ]);
    }
}