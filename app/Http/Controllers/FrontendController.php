<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Category;
use App\Models\HeroSection;
use App\Models\About;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class FrontendController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
       // chỉ lấy category cha đang active
        $categories = $this->categoryService->getActiveRootCategories();

            // lấy tất cả hero section đang có
        $heros = HeroSection::orderBy('updated_at', 'desc')->get();

        $about = About::first();

        $services = Service::where('is_active', true)->get();

        // Lấy 8 sản phẩm active, sắp xếp theo updated_at desc
        $products = Product::where('is_active', true)
                    ->orderBy('updated_at', 'desc')
                    ->take(12)
                    ->get();

        return view('index', compact('categories','heros','about','services','products'));
        // return view('index', compact('contact'));

    }

    public function category($slug)
    {
        // tìm category theo slug
        $category = Category::where('slug', $slug)
        
            ->where('is_active', 1)
            ->firstOrFail();

        // lấy tất cả ID của category cha + con (nhiều cấp)
        $categoryIds = $this->getAllCategoryIds($category);

        // query sản phẩm thuộc các category này
        $products = Product::whereIn('category_id', $categoryIds)
            ->where('is_active', 1)
            ->paginate(12);

        // chỉ lấy category cha đang active
        $categories = $this->categoryService->getActiveRootCategories();
        return view('category', compact('category', 'products','categories'));
    }

    /**
     * Hàm đệ quy lấy toàn bộ id của category + children
     */
    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }
    
}
