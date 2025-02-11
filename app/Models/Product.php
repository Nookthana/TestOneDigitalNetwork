<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'product';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'brand',
        'category',
        'view',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }
}
