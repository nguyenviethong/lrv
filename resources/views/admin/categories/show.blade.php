@extends('adminlte::page')

@section('title', 'Category Detail')

@section('content_header')
    <h1>Category #{{ $category->id }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-2">Name</dt>
            <dd class="col-sm-10">{{ $category->name }}</dd>

            <dt class="col-sm-2">Description</dt>
            <dd class="col-sm-10 text-muted">{{ $category->description ?: '—' }}</dd>

            <dt class="col-sm-2">Created at</dt>
            <dd class="col-sm-10">{{ $category->created_at }}</dd>

            <dt class="col-sm-2">Updated at</dt>
            <dd class="col-sm-10">{{ $category->updated_at }}</dd>
        </dl>
    </div>
    <div class="card-footer">
        <a class="btn btn-info" href="{{ route('admin.categories.edit', $category) }}"><i class="fas fa-edit"></i> Edit</a>
        <a class="btn btn-default" href="{{ route('admin.categories.index') }}">Back</a>
        <form class="d-inline float-right" method="POST" action="{{ route('admin.categories.destroy', $category) }}">
            @csrf @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Delete this category?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>
@stop
