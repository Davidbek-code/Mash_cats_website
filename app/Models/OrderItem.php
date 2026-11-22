<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'custom_cake_id',
        'quanity',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customCake()
    {
        return $this->belongsTo(CustomCake::class);
    }
}
