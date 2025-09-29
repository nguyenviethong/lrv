@extends('adminlte::page')

@section('title', 'Slider')

@section('content_header')
    <h1>Danh sách Slider</h1>
@stop

@section('content')
<a href="{{ route('admin.hero.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>  Slider</a>

@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($heros as $hero)
            <tr>
                <td>{{ $hero->id }}</td>
                <td>{{ $hero->title }}</td>
                <td>
                    @if($hero->image)
                        <img src="{{ asset('storage/'.$hero->image) }}" style="height:60px;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.hero.edit', $hero) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.hero.destroy', $hero) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Xóa hero này?')" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
