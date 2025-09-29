<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CKEditorController extends Controller
{
    public function upload(Request $request)
{
    try {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Tạo tên file duy nhất
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Lưu file gốc (chưa resize)
            $path = $file->storeAs('uploads/ckeditor', $filename, 'public');

            return response()->json([
                'uploaded'  => true,
                'url'       => asset('storage/uploads/ckeditor/' . $filename)
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error'    => ['message' => 'No file uploaded']
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'uploaded' => false,
            'error'    => ['message' => $e->getMessage()]
        ], 500);
    }
}
}
