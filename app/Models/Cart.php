<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'custom_cake_id',
        'quanity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Связь на будущее, когда появится модель CustomCake
    public function customCake()
    {
        return $this->belongsTo(CustomCake::class);
    }
}

