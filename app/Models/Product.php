<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sku', 'category_id', 'price', 'quantity', 'is_active', 'description', 'image', 'is_contact',
        'title','imageDetails','content'
    ];

    protected $casts = [
        'imageDetails' => 'array', // Tự động JSON encode/decode
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Trả về key cho route model binding.
     * Thay vì chỉ id, ta kết hợp id + slug.
     */
    public function getRouteKey()
    {   
        return $this->id . '-' . Str::slug($this->name);
    }
}
