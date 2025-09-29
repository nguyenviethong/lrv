@extends('adminlte::page')

@section('title', 'Sửa Slider')

@section('content_header')
    <h1>Sửa Slider</h1>
@stop

@section('content')
<form action="{{ route('admin.hero.update', $hero) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.hero.partials.form', ['hero' => $hero])
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@stop
