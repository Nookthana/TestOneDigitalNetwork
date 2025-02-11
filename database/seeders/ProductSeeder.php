<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; 
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'sku' => Str::random(10),
                'price' => rand(100, 1000),
                'brand' => 'Brand ' . rand(1, 5),
                'category' => 'Category ' . rand(1, 3),
                'view' => rand(1, 100),
                'created_at' => now(),
            ]);
        }
    }
}
