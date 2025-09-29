<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
     protected $fillable = [
        'title', 'icon', 'description', 'link','is_active','content','image','features'
    ];

    protected $casts = [
        'features' => 'array', // Tự động JSON encode/decode
    ];

    // Tự động sinh slug
    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
    /**
     * Trả về key cho route model binding.
     * Thay vì chỉ id, ta kết hợp id + slug.
     */
    public function getRouteKey()
    {   
        $slugC = Str::slug($this->title);
        return $this->id . '-' . $slugC;
    }
}
