@extends('adminlte::page')

@section('title', 'Thêm Dịch vụ')

@section('content_header')
    <h1>Thêm Dịch vụ</h1>
@stop

@section('content')
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.services.form')
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
@endsection
