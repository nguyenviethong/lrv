<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('name');
        $parent_id = $request->input('parent_id');
        $is_active = $request->input('is_active');

        $categories = Category::with('parent')
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->when($parent_id, fn($query) => $query->where('parent_id', $parent_id))
            ->when(!is_null($is_active) && $is_active !== '', fn($query) => $query->where('is_active', $is_active))
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Giữ query string khi phân trang

        $parentCategories = Category::whereNull('parent_id')->get();

        return view('admin.categories.index', compact('categories', 'parentCategories'));
    }

    public function create()
    {
        $parents = Category::pluck('name', 'id');
        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'is_active' => 'boolean',
        ]);
        // Nếu không có is_active trong request => gán false
        $data['is_active'] = $data['is_active'] ?? false;
        // Nếu không có parent_id trong request => gán null
        $data['parent_id'] = $data['parent_id'] ?? null;
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
         // Lặp cho đến khi tìm được slug chưa tồn tại
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // $data['slug'] = Str::slug($data['name']);
        $data['slug'] = $slug; // Sử dụng slug đã kiểm tra trùng lặp

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '!=', $category->id)->pluck('name', 'id');
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'is_active' => 'boolean',
        ]);
        // Nếu không có is_active trong request => gán false
        $data['is_active'] = $data['is_active'] ?? false;
        // Nếu không có parent_id trong request => gán null
        $data['parent_id'] = $data['parent_id'] ?? null;
        // Tạo slug ban đầu
        $slug = Str::slug($data['name']);
        $original = $slug;
        $count = 1;
         // Kiểm tra trùng slug (ngoại trừ chính $category hiện tại)
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $original . '-' . $count++;
        }

        $data['slug'] = $slug; // Cập nhật slug đã kiểm tra trùng lặp

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
