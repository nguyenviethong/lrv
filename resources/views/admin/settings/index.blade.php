@extends('adminlte::page')

@section('title', 'Cấu hình Logo & Tên site')

@section('content_header')
    <h1>Cấu hình Website</h1>
@stop

@section('content')

@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="site_name">Tên website</label>
            <input type="text" name="site_name" id="site_name" class="form-control" 
                   value="{{ old('site_name', $setting->site_name ?? '') }}">
        </div>

        <div class="form-group mb-3">
            <label for="logo">Logo</label><br>
            @if(!empty($setting->logo))
                <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" height="80" class="mb-2">
            @endif
            <input type="file" name="logo" id="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@stop
