@extends('adminlte::page')

@section('title', 'Quản lý liên hệ')

@section('content_header')
    <h1>Quản lý liên hệ</h1>
@stop

@section('content')

    <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>  Thêm liên hệ</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Hotline</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Zalo</th>
                <th>Facebook</th>
                <th>Message</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->hotline }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->zalo }}</td>
                <td>{{ $contact->facebook }}</td>
                <td>{{ $contact->message }}</td>
                <td>
                    <a href="{{ route('admin.contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xoá liên hệ này?')">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
@endsection
