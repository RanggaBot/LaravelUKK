<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Produk A',
            'description' => 'Deskripsi Produk A',
            'price' => 10000,
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Produk B',
            'description' => 'Deskripsi Produk B',
            'price' => 15000,
            'stock' => 75,
        ]);

        Product::create([
            'name' => 'Produk C',
            'description' => 'Deskripsi Produk C',
            'price' => 20000,
            'stock' => 50,
        ]);
    }
}