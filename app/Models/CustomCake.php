<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomCake extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'biscuit_type',
        'cream_type',
        'filling_type',
        'decor_text',
        'total_price',
    ];
}
