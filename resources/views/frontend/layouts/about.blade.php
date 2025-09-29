<section id="about" class="section about">

      <div class="container">

        <div class="row gy-3">

          {{-- Ảnh bên trái --}}
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img data-src="{{ isset($about['image']) ? asset('storage/'.$about['image']) : asset('assets/img/about-img.svg') }}" 
                  alt="{{ $about['title'] ?? 'About Image' }}" 
                  class="img-fluid" loading="lazy" style="max-height: 420px;">

          </div>

           {{-- Nội dung bên phải --}}
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="about-content ps-0 ps-lg-3">
              {{-- Tiêu đề --}}
              <h3>{{ $about['title'] ?? '' }}</h3>
              {{-- Intro --}}
              @if(!empty($about['intro']))
                <p class="fst-italic">
                  {{ $about['intro'] }}
                </p>
              @endif
              {{-- Danh sách items --}}
              @if(!empty($about['items']))
                <ul>
                  @foreach($about['items'] as $item)
                    <li>
                      <i class="{{ $item['icon'] ?? 'bi bi-circle' }}"></i>
                      <div>
                        <h4>{{ $item['title'] ?? '' }}</h4>
                        <p>{{ $item['description'] ?? '' }}</p>
                      </div>
                    </li>
                  @endforeach
                </ul>
              @endif
              {{-- Nội dung cuối --}}
              @if(!empty($about['content']))
                <p>{!! nl2br(e($about['content'])) !!}</p>
              @endif
            </div>

          </div>
        </div>

      </div>

    </section>