@extends('adminlte::page')

@section('title', 'Thêm liên hệ mới')

@section('content_header')
    <h1>Thêm liên hệ mới</h1>
@stop

@section('content')

    <form action="{{ route('admin.contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hotline</label>
            <input type="text" name="hotline" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label>Zalo</label>
            <input type="text" name="zalo" class="form-control">
        </div>
        <div class="mb-3">
            <label>Facebook</label>
            <input type="text" name="facebook" class="form-control">
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>

@endsection
