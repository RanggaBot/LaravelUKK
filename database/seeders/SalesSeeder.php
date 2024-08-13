<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach (range(1, 30) as $index) {
            $product = $products->random();
            Sale::create([
                'product_id' => $product->id,
                'quantity' => rand(1, 5),
                'total_price' => $product->price * rand(1, 5),
                'sale_date' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}