<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first(); // chỉ 1 bản ghi
        return view('admin.about.index', compact('about'));
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'intro'   => 'nullable|string',
            'content' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'items'   => 'nullable|array',
            'items.*.icon' => 'nullable|string',
            'items.*.title' => 'nullable|string',
            'items.*.description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'Cập nhật About thành công!');
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'intro'   => 'nullable|string',
            'content' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'items'   => 'nullable|array',
            'items.*.icon' => 'nullable|string',
            'items.*.title' => 'nullable|string',
            'items.*.description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        About::create($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'Tạo About thành công!');
    }
}
