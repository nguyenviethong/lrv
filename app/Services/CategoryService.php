<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getActiveRootCategories()
    {
        return Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', 1)
            ->get();
    }
}