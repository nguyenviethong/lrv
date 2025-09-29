<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'    => 'nullable|email',
            'hotline'  => 'nullable|string|max:20',
        ]);

        Contact::create($request->all());

        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được thêm thành công!');
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'    => 'nullable|email',
            'hotline'  => 'nullable|string|max:20',
        ]);

        $contact->update($request->all());

        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được cập nhật!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được xoá!');
    }

    public function showContactPage()
    {
        // Lấy thông tin liên hệ đầu tiên (hoặc bản ghi bạn muốn)
        $contact = Contact::first();

        return view('frontend.contact', compact('contact'));
    }
}
