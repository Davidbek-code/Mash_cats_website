<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'rating',
        'text',
        'review_status',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
