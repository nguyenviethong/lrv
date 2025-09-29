@extends('adminlte::page')

@section('title', 'Quản lý dịch vụ')

@section('content_header')
    <h1>Quản lý dịch vụ</h1>
@stop

@section('content')

    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm dịch vụ</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Link</th>
                <th>Status</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td><i class="{{ $service->icon }}"></i></td>
                <td>{{ $service->title }}</td>
                <td>{{ $service->description }}</td>
                <td>{{ $service->link }}</td>
                <td>
                        @if($service->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                <td>
                    <a href="{{ route('admin.services.edit',$service) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.services.destroy',$service) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Xóa dịch vụ này?')" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
@endsection
