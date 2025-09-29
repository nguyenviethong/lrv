@extends('frontend.layouts.appproduct')

@section('title', 'Chi tiết dịch vụ')

@section('css')
<style>

</style>
@endsection
@section('content')
<!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container">

        <div class="row gy-4">

          <!-- Sidebar Services List -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="services-list">
                @foreach($allServices as $item)
                    <a href="{{ route('services.show', $item) }}" 
                        class="{{ $service->id == $item->id ? 'active' : '' }}">
                    <i class="{{ $item->icon }}"></i> {{ $item->title }}
                    </a>
                @endforeach
                </div>

                <!-- <h4>{{ $service->title }}</h4> -->
                <!-- <p>{{ $service->description }}</p> -->
            </div>

                <!-- Service Details Content -->
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                @if($service->image)
                <img data-src="{{ asset('storage/' . $service->image) }}" 
                    alt="{{ $service->title }}" 
                    class="img-fluid services-img" loading="lazy">
                @endif

                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
                @if($service->features && is_array($service->features))
                <ul>
                    @foreach($service->features as $feature)
                    <li><i class="bi bi-check-circle"></i> 
                        <span>{{ $feature['title'] ?? '' }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif

                <p>{!! $service->content !!}</p>

            </div>

        </div>

      </div>

    </section><!-- /Service Details Section -->
@endsection