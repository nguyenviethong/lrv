@extends('adminlte::page')

@section('title', 'Sửa Dịch vụ')

@section('content_header')
    <h1>Sửa Dịch vụ</h1>
@stop

@section('content')
<form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.services.form')
        <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection
