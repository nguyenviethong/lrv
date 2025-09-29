@extends('adminlte::page')
@section('title', 'Thêm sản phẩm')
@section('content')
@include('admin.products.form', ['action' => route('admin.products.store')])

@stop

{{-- Thêm thư viện JS bên ngoài --}}
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->has('sku'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi SKU',
                    text: '{{ $errors->first('sku') }}',
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
    @endif
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
