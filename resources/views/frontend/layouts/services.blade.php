<section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dịch vụ</h2>
        <p>Dưới đây là các dịch vụ của chúng tôi</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

            @foreach($services as $index => $service)
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ ($index+1) * 100 }}">
                  <div class="service-item position-relative">
                    <div class="icon">
                      <i class="{{ $service->icon }} icon"></i>
                    </div>
                    <h4>
                      <a href="{{ $service->link ?? route('services.show', $service) }}" class="stretched-link">
                        {{ $service->title }}
                      </a>
                    </h4>
                    <p>{{ $service->description }}</p>
                  </div>
                </div><!-- End Service Item -->
              @endforeach

        </div>

      </div>

    </section>