@extends('frontend.layouts.appproduct')

@section('title', 'Sản phẩm')

@section('css')
<style>

</style>
@endsection

@section('content')
<div id="clients-section" class="container" >
    <h1>{{ $category->name }}</h1>

    @if($products->isEmpty())
        <!-- Trang thông báo khi không có sản phẩm -->
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center aos-init" data-aos="fade-up" data-aos-delay="200">
                <div class="empty-state">
                    <div class="icon mb-4">
                        <i class="fas fa-tools" style="font-size: 4rem; color: #6c757d;"></i> <!-- Icon từ Font Awesome, bạn có thể thay bằng hình ảnh -->
                    </div>
                    <h3 class="mb-3">Hệ thống đang cập nhật sản phẩm</h3>
                    <p class="text-muted mb-4">
                        Chúng tôi đang nỗ lực cập nhật thêm sản phẩm mới cho danh mục <strong>{{ $category->name }}</strong>. 
                        Vui lòng quay lại sau để khám phá thêm!
                    </p>
                    <div class="actions">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    @else

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
    @forelse($products as $product)
        <div class="col lazy-card " >
            <div class="card h-100" >
                @if($product->image)
                    <a href="{{ route('products.show', $product) }}" class="stretched-link">
                            <img data-src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top lazyload" 
                                 alt="{{ $product->name }}" loading="lazy">
                    </a>
                @else
                    <a href="{{ route('products.show', $product) }}" class="stretched-link"></a>
                @endif
                <div class="card-body">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    @if($product->is_contact)
                        <p class="text-danger">Liên hệ</p>
                    @else
                        <p class="text-primary">{{ number_format($product->price) }} đ</p>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p>Hệ thống đang cập nhật sản phẩm.</p>
    @endforelse
</div>

    {{ $products->links() }}
@endif
</div>
@endsection
