<?php

namespace App\Http\Controllers\Admin;
use App\Models\SettingSections;
use Illuminate\Http\Request;

class SettingSectionsController extends Controller
{
    public function index()
    {
        $settingSections = SettingSections::all();
        return view('admin.settingSections.index', compact('settingSections'));
    }

    public function create()
    {
        return view('admin.settingSections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:settingSections,name',
            'is_active' => 'nullable|boolean',
        ]);

        Section::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.settingSections.index')->with('success', 'Thêm section thành công!');
    }

    public function show(SettingSections $settingSection)
    {
        return view('admin.settingSections.show', compact('settingSections'));
    }

    public function edit(SettingSections $settingSection)
    {
        return view('admin.settingSections.edit', compact('settingSections'));
    }

    public function update(Request $request, SettingSections $settingSection)
    {
        $request->validate([
            'name' => 'required|unique:settingSections,name,' . $settingSection->id,
            'is_active' => 'nullable|boolean',
        ]);

        $settingSection->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.settingSections.index')->with('success', 'Cập nhật section thành công!');
    }

    public function destroy(SettingSections $settingSection)
    {
        $settingSection->delete();
        return redirect()->route('admin.settingSections.index')->with('success', 'Xóa section thành công!');
    }

    public function indexFE()
    {
        $sections = SettingSections::pluck('is_active', 'name')->toArray();
        return view('index', compact('settingSections'));
    }
}
