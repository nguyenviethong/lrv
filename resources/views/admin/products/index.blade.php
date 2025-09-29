@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<h1>Sản phẩm</h1>
@stop

@section('content')
<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Thêm sản phẩm
    </a>
@include('admin.products.partials.filter')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" width="50">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category?->name }}</td>
                    <td>{{ $product->is_contact ? 'Liên hệ' : number_format($product->price) }}</td>
                    <td>{{ $product->is_contact ? '' : number_format($product->quantity) }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
@stop
