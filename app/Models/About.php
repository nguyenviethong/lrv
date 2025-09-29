<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title', 'intro', 'content', 'image', 'items'
    ];

    protected $casts = [
        'items' => 'array', // Tự động JSON encode/decode
    ];
}
