<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class ProductController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = Product::query();

        if($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create() {
        $categories = Category::all();
        // $product = new Product(); // Create an empty Product instance for the form
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'title' => 'nullable|string',
            'imageDetails'   => 'nullable|array',
            'imageDetails.*.image' => 'nullable',
            'content' => 'nullable|string',
        ],[
            'sku.unique' => 'Mã SKU này đã tồn tại, vui lòng nhập mã khác.',
            'sku.required' => 'Bạn chưa nhập SKU.',
        ]);
        $isContact = $request->has('is_contact');
        if ($isContact) {
                $data['price'] = 0;
                $data['quantity'] = 0;
        }
        $data['is_contact'] = $isContact;
        // Chuẩn hóa dữ liệu (phòng trường hợp JS không chạy)
        // $data['price'] = $this->parseNumber($request->input('price'));
        // $data['quantity'] = $this->parseNumber($request->input('quantity'));

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        // Nếu không có imageDetails thì set null
        $imageDetails = $product->imageDetails ?? [];
        if ($request->has('imageDetails')) {
            foreach ($request->imageDetails as $i => $detail) {
                $path = null;

                // Nếu là file upload
                if ($request->hasFile("imageDetails.$i.image")) {
                    $file = $request->file("imageDetails.$i.image");
                    if ($file && $file->isValid()) {
                        $path = $file->store('products', 'public');
                    }
                } 
                // Nếu là string link (người dùng nhập URL hoặc đường dẫn cũ)
                elseif (!empty($detail['image']) && is_string($detail['image'])) {
                    $path = $detail['image'];
                }

                if ($path) {
                    $imageDetails[] = ['image' => $path];
                }
            }
        }

        $data['imageDetails'] = $imageDetails;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'title' => 'nullable|string',
            'imageDetails'   => 'nullable|array',
            'imageDetails.*.image' => 'nullable',
            'content' => 'nullable|string',
        ]);
        $isContact = $request->has('is_contact');
        if ($isContact) {
            $data['price'] = 0;
            $data['quantity'] = 0;
        }
        $data['is_contact'] = $isContact;
        // Chuẩn hóa dữ liệu (phòng trường hợp JS không chạy)
        // $data['price'] = $this->parseNumber($request->input('price'));
        // $data['quantity'] = $this->parseNumber($request->input('quantity'));

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
         // Nếu không có imageDetails thì set null
        $imageDetails = $product->imageDetails ?? [];
        if ($request->has('imageDetails')) {
            foreach ($request->imageDetails as $i => $detail) {
                $path = null;

                // Nếu là file upload
                if ($request->hasFile("imageDetails.$i.image")) {
                    $file = $request->file("imageDetails.$i.image");
                    if ($file && $file->isValid()) {
                        $path = $file->store('products', 'public');
                    }
                } 
                // Nếu là string link (người dùng nhập URL hoặc đường dẫn cũ)
                elseif (!empty($detail['image']) && is_string($detail['image'])) {
                    $path = $detail['image'];
                }

                if ($path) {
                    $imageDetails[] = ['image' => $path];
                }
            }
        }

        $data['imageDetails'] = $imageDetails;

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function parseNumber($value)
    {
        if ($value === null) return null;
        // bỏ dấu . (ngăn cách ngàn), đổi dấu , thành .
        $normalized = str_replace(['.', ','], ['', '.'], $value);
        return (float) $normalized;
    }



    public function showFE(Product $product)
{    
    $categoryName = $product->category ? $product->category->name : null;

    // chỉ lấy category cha đang active
    $categories = $this->categoryService->getActiveRootCategories();

    return view('product-details', compact('product','categoryName','categories'));
}
   
}
