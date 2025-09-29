<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_id',
        'is_active',
    ];
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        // return $this->hasMany(Category::class, 'parent_id');
        //đệ quy để lấy con của con
        // return $this->hasMany(Category::class, 'parent_id')->with('children');

        return $this->hasMany(Category::class, 'parent_id')
                ->where('is_active', 1)
                ->with('children');
        
        // return $this->hasMany(Category::class, 'parent_id')
        //         ->where('is_active', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
