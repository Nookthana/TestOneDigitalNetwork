<?php

namespace App\Repo;

use App\Models\ProductImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductImagesRepo
{
    protected $productImages;

    public function __construct(ProductImages $productImages)
    {
        $this->productImages = $productImages;
    }

    public function all(array $relation)
    {
        return $this->productImages->with($relation)->get();
    }

    public function create(array $create)
    {
        return $this->productImages->create($create);
    }

}
