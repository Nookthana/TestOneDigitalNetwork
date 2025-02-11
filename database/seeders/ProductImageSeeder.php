<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImages;
use App\Models\Product; 
use Illuminate\Support\Facades\File;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $imageFiles = File::allFiles(storage_path('app/public/images/product'));
        $products = Product::all();
        if ($products->isEmpty()) {
            echo "No products found in the database!";
            return;
        }
        foreach ($imageFiles as $file) {
            $product = $products->random(); 
            ProductImages::create([
                'product_id' => $product->id, 
                'image_url' => 'images/product/' . $file->getFilename(), 
                'remark' => 'Image by seeder ' . now(),
                'created_at' => now(),
            ]);
        }
    }
}
