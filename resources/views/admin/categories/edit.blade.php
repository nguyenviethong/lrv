@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
    <h1>Cập nhật nhóm hàng</h1>
@stop

@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Nhóm hàng cha</label>
            <select name="parent_id" class="form-control">
                <option value="">-- None --</option>
                @foreach($parents as $id => $name)
                    <option value="{{ $id }}" @if($id == $category->parent_id) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" @if($category->is_active) checked @endif>
            <label class="form-check-label">Active</label>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
@stop
