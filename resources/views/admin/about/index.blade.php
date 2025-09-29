@extends('adminlte::page')

@section('title', 'Quản lý About')

@section('content_header')
    <h1>Quản lý About</h1>
@stop

@section('content')
<a href="{{ route('admin.about.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Thêm About
</a>
    @if($about)
        <div class="card">
            <div class="card-body">
                <h3>{{ $about->title }}</h3>
                <p><em>{{ $about->intro }}</em></p>
                <p>{{ $about->content }}</p>

                @if($about->image)
                    <img src="{{ asset('storage/'.$about->image) }}" width="200">
                @endif

                <a href="{{ route('admin.about.edit', $about) }}" class="btn btn-primary mt-3">
                    <i class="fas fa-edit"></i> Sửa
                </a>
            </div>
        </div>
    @else
        <p>Chưa có nội dung About</p>
    @endif
@stop
