<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ category cha + con
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('index', compact('categories'));
    }
}
