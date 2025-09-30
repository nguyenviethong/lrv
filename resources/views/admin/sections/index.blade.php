@extends('adminlte::page')

@section('title', 'Quản lý trang chủ')

@section('content_header')
    <h1>Quản lý trang chủ</h1>
@stop

@section('content')
    <a href="{{ route('admin.settingSections.create') }}" class="btn btn-primary mb-3">+ Thêm Section</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($settingSections as $section)
                <tr>
                    <td>{{ ucfirst($section->name) }}</td>
                    <td>{{ $section->is_active ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('admin.settingSections.edit', $section->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.settingSections.destroy', $section->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
