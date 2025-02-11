<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use SoftDeletes;

    public $table = 'product_image';

    protected $fillable = [
        'product_id',
        'image_url',
        'remark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productImages()
    {
        return $this->belongsTo(Product::class);
    }
}
