@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Nhóm hàng</h1>
@stop

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Thêm nhóm hàng
    </a>

    <div class="card card-outline card-primary mb-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-filter me-1"></i> Bộ lọc danh mục</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
        <div class="col-md-12 input-group">    
        <!-- Filter theo tên -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên..." value="{{ request('name') }}">
                    </div>
                </div>
            </div>

            <!-- Filter theo nhóm cha -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="parent_id">Nhóm cha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-sitemap"></i></span>
                        <select name="parent_id" id="parent_id" class="form-select">
                            <option value="">-- Chọn nhóm --</option>
                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filter theo trạng thái -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="is_active">Trạng thái</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Nút Lọc -->
            <div class="col-md-2 d-grid">
                
            </div>

            </div>
            <div class="col-md-12">
                <div class="col-md-12 input-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i> Lọc
                </button>
                <!-- Nút Reset -->
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo me-1"></i> Reset
                </a>
                </div>
                
            </div>
            
        </form>
    </div>
</div>




    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Nhóm hàng cha</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->parent?->name }}</td>
                    <td>
                        @if($cat->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
@stop
