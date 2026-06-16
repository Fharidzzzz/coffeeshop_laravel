<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $coffees = [
            [
                'name' => 'Golden Truffle Latte',
                'description' => 'Espresso mewah dipadukan dengan susu oat premium, sentuhan ekstrak truffle hitam, dan topping edible gold leaf.',
                'price' => 85000,
            ],
            [
                'name' => 'Madagascar Vanilla Cold Brew',
                'description' => 'Kopi cold brew yang diekstrak selama 24 jam, disempurnakan dengan sirup vanila murni langsung dari Madagaskar.',
                'price' => 75000,
            ],
            [
                'name' => 'Saffron Affogato Royal',
                'description' => 'Es krim gelato vanilla premium yang disiram dengan ristretto panas dan taburan rempah saffron terbaik dunia.',
                'price' => 95000,
            ],
            [
                'name' => 'Velvet Espresso Shakerato',
                'description' => 'Double shot espresso yang dikocok intens dengan es batu dan sirup aren organik hingga berbusa selembut beludru.',
                'price' => 65000,
            ],
            [
                'name' => 'Kyoto Matcha Espresso Fusion',
                'description' => 'Perpaduan layer estetis antara matcha premium asal Uji, Kyoto, susu segar, dan shot espresso arabika.',
                'price' => 80000,
            ]
        ];

        foreach ($coffees as $coffee) {
            Product::create([
                'name' => $coffee['name'],
                'slug' => Str::slug($coffee['name']),
                'description' => $coffee['description'],
                'price' => $coffee['price'],
                'image' => 'placeholder.jpg',
                'stock' => 20,
            ]);
        }
    }
}