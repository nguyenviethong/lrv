<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Trang web')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}?v={{ filemtime(public_path('assets/vendor/bootstrap/css/bootstrap.min.css')) }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}?v={{ filemtime(public_path('assets/vendor/bootstrap-icons/bootstrap-icons.css')) }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}?v={{ filemtime(public_path('assets/vendor/aos/aos.css')) }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}?v={{ filemtime(public_path('assets/vendor/glightbox/css/glightbox.min.css')) }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}?v={{ filemtime(public_path('assets/vendor/swiper/swiper-bundle.min.css')) }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}?v={{ filemtime(public_path('assets/css/main.css')) }}" rel="stylesheet">

  @stack('styles')
</head>

<body class="index-page">

  {{-- Header --}}
  @include('frontend.layouts.headerproduct', ['categories' => $categories ?? collect()])

  {{-- Nội dung chính --}}
  <main class="main">
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('frontend.layouts.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ filemtime(public_path('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}?v={{ filemtime(public_path('assets/vendor/php-email-form/validate.js')) }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}?v={{ filemtime(public_path('assets/vendor/aos/aos.js')) }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}?v={{ filemtime(public_path('assets/vendor/glightbox/js/glightbox.min.js')) }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}?v={{ filemtime(public_path('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')) }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}?v={{ filemtime(public_path('assets/vendor/isotope-layout/isotope.pkgd.min.js')) }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}?v={{ filemtime(public_path('assets/vendor/swiper/swiper-bundle.min.js')) }}"></script>


  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}?v={{ filemtime(public_path('assets/js/main.js')) }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".lazy-card");

        if ("IntersectionObserver" in window) {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => observer.observe(card));
        } else {
            // fallback
            cards.forEach(card => card.classList.add("visible"));
        }
    });
    </script>

  @stack('scripts')
  <!-- Thêm đoạn này để load script -->
  @yield('js')
</body>
</html>
