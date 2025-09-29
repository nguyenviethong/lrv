@extends('adminlte::page')

@section('title', 'Thêm Slider')

@section('content_header')
    <h1>Thêm Slider</h1>
@stop

@section('content')
<form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.hero.partials.form')
    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@stop
