<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Services\CategoryService;

class ServiceController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'features'   => 'nullable|array',
            'features.*.title' => 'nullable|string',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Nếu không có features thì set null
        $data['features'] = $data['features'] ?? [];

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success','Thêm dịch vụ thành công');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'features'   => 'nullable|array',
            'features.*.title' => 'nullable|string',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Nếu không có features thì set null
        $data['features'] = $data['features'] ?? [];

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success','Cập nhật dịch vụ thành công');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success','Xóa dịch vụ thành công');
    }


    public function show(Service $service)
    {   
         // Nếu slug không khớp thì redirect về URL đúng
        // if ($service->slug !== $slug) {
        //     return redirect()->route('services.show', [
        //         'service' => $service->id,
        //         'slug'    => $service->slug
        //     ]);
        // }
        $allServices = Service::where('is_active', true)->get();
        // chỉ lấy category cha đang active
        $categories = $this->categoryService->getActiveRootCategories();
        return view('service-details', compact('service','allServices','categories'));
    }
}
