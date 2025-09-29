@extends('adminlte::page')
@section('title', 'Chỉnh sửa sản phẩm')
@section('content')
@include('admin.products.form', ['action' => route('admin.products.update', $product)])
@stop
