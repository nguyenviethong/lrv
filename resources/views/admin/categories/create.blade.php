@extends('adminlte::page')

@section('title', 'Add Category')

@section('content_header')
    <h1>Thêm nhóm hàng</h1>
@stop

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Nhóm hàng cha</label>
            <select name="parent_id" class="form-control">
                <option value="">-- None --</option>
                @foreach($parents as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
            <label class="form-check-label">Active</label>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
@stop
