<section id="trangchu" class="hero d-flex align-items-center section-bg">
  <div class="container">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
      <div class="carousel-inner">
        @foreach($heros as $key => $hero)
          <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
            <div class="row justify-content-between gy-5">
              <div class="col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                  <h2>{{ $hero->title }}</h2>
                  <h3><p>{{ $hero->subtitle }}</p><h3>
                  <div class="d-flex">
                    @if($hero->button_link && $hero->button_text)
                      <a href="{{ $hero->button_link }}" class="btn-get-started">{{ $hero->button_text }}</a>
                    @endif
                    @if($hero->video_link)
                      <a href="{{ $hero->video_link }}" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="bi bi-play-circle"></i><span>Watch Video</span>
                      </a>
                    @endif
                  </div>
              </div>

              <div class="col-lg-7 text-center">
                @if($hero->image)
                  <img data-src="{{ asset('storage/'.$hero->image) }}" class="img-fluid" alt="" loading="lazy">
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

  </div>
</section>

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselEl = document.querySelector('#heroCarousel');
    if (!carouselEl) return;

    // Khởi tạo Carousel nếu chưa có instance
    let bsCarousel = bootstrap.Carousel.getInstance(carouselEl);
    if (!bsCarousel) {
        bsCarousel = new bootstrap.Carousel(carouselEl, {
            interval: false, // tắt auto chạy nếu muốn
            ride: false
        });
    }

    let touchStartX = 0;
    let touchEndX = 0;

    carouselEl.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].clientX;
    });

    carouselEl.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50; // vuốt tối thiểu 50px
        if (touchEndX < touchStartX - swipeThreshold) {
            bsCarousel.next(); // Vuốt sang trái
        }
        if (touchEndX > touchStartX + swipeThreshold) {
            bsCarousel.prev(); // Vuốt sang phải
        }
    }
});
</script>
@endsection

