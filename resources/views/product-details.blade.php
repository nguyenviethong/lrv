@extends('frontend.layouts.appproduct')

@section('title', 'Chi tiết sản phẩm')

@section('css')
<style>

</style>
@endsection
@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $product->name}}</h1>
        <!-- <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Trang chủ</a></li>
            <li class="current">Portfolio Details</li>
          </ol>
        </nav> -->
      </div>
    </div><!-- End Page Title -->

     <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section" style="padding-top:20px">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">

              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>

              <div class="swiper-wrapper align-items-center">

                {{-- Ảnh chính --}}
                @if($product->image)
                    <div class="swiper-slide">
                        <img data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                    </div>
                @endif

                {{-- Ảnh chi tiết (nếu có) --}}
                @if(!empty($product->imageDetails) && is_array($product->imageDetails))
                    @foreach($product->imageDetails as $detail)
                        @if(!empty($detail['image']))
                            <div class="swiper-slide">
                                <img data-src="{{ asset('storage/' . $detail['image']) }}" alt="{{ $product->name }}" loading="lazy">
                            </div>
                        @endif
                    @endforeach
                @endif

              </div>

              <div class="swiper-pagination"></div>
            </div>

          </div>

          <div class="col-lg-4">
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <h3>Thông tin sản phẩm</h3>
              <ul>
                <li><strong>Tên hàng</strong>: {{ $product->name}}</li>
                <li><strong>Ngành hàng</strong>: {{ $categoryName ?? 'Đang chờ cập nhật' }}</li>
                <li><strong>Giá</strong>
                    @if($product->is_contact)
                    <span class="text-danger">Liên hệ</span>
                    @else
                    <span class="text-primary" style="color:#eb5d1e !important">{{ number_format($product->price) }} đ</span>
                    @endif
                </li>
                <!-- <li><strong>Client</strong>: ASU Company</li>
                <li><strong>Project date</strong>: 01 March, 2020</li>
                <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li> -->
              </ul>
            </div>
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                <!-- @if(!empty($product->title))
                    <h2>{{$product->title}}</h2>
                @endif -->
              
              @if(!empty($product->description))
                <p>
                    {!! $product->description !!}
                </p>
              @endif
              
            </div>
          </div>
        
            <div class="col-lg-12">
                <div class="card shadow-sm p-3 border-0" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="fw-bold mb-3">Mô tả sản phẩm</h5>

                    <div id="description-content" class="text-muted" style="max-height: 150px; overflow: hidden; transition: all 0.3s ease;">
                    {!! $product->content !!}
                    </div>

                    <div class="text-center mt-2">
                    <a href="javascript:void(0);" id="toggle-description" class="text-primary fw-semibold" style="color:#eb5d1e !important">Xem thêm</a>
                    </div>
                </div>
            </div>


        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const desc = document.getElementById("description-content");
  const toggle = document.getElementById("toggle-description");

  if (desc && toggle) {
    let expanded = false;

    toggle.addEventListener("click", function () {
      if (expanded) {
        desc.style.maxHeight = "150px";
        desc.style.overflow = "hidden";
        toggle.textContent = "Xem thêm";
      } else {
        desc.style.maxHeight = "none";
        desc.style.overflow = "visible";
        toggle.textContent = "Thu gọn";
      }
      expanded = !expanded;
    });
  }
});
</script>


@endsection