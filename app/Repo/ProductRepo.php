<?php

namespace App\Repo;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductRepo
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all(array $relation)
    {
        return $this->product->with($relation)->get();
    }

    public function findOrFail(int $productId)
    {
        return $this->product->findOrFail($productId);
    }

    public function update(int $productId, array $value)
    {
        $product = $this->findOrFail($productId);

        $product->update($value);
    }

    public function findBySku(array $relation, string $sku)
    {
        $product = $this->product->with($relation);
        return $product = $product->where('sku', $sku)->get();
    }

    public function findBrand(array $relation)
    {
        return $this->product->with($relation)->select('brand')->distinct()->pluck('brand');
    }

    public function findByCategory(array $relation, string $categoryId)
    {
        $product = $this->product->with($relation);
        return $product = $product->where('category', $categoryId)->get();
    }

    public function findByProductByBrand(array $relation, string $brand = null, string $product = null, string $sku = null)
    {
        $product = $this->product->with($relation);

        if (isset($brand) && isset($product)) {
            $product = $product->where('brand', $brand)->get();
        } else if (isset($product) && isset($brand)) {
            $product = $product->where('sku', $sku)
                               ->where('brand', $brand)->first();
        } else {
            $product = $product->get();
        }
        
        return $product;
        
    }

    public function findProductByFilter(array $relation, string $brand = null, string $product_name = null, string $sku = null)
    {
        $product = $this->product->with($relation);
        if (! empty($brand)) {
            if (empty($product_name)) {
                $product = $product->where('brand', $brand)->get();
            } else {
                $product = $product->where('sku', $sku)
                                   ->where('brand', $brand)->get();
            }
        } elseif (! empty($sku)) {
            $product = $product->where('sku', $sku)->get();
        } else {
            $product = $product->get();
        }
        return $product;
    }

}
