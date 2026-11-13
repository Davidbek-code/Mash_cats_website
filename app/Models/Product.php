<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'product_name',
        'description',
        'price',
        'image_url',
        'in_stock',
        'weight'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
