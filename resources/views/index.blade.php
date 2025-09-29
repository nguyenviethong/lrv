@extends('frontend.layouts.app')

@section('title', 'Trang chủ')

@section('content')
    {{-- Copy phần nội dung trong <main> từ file index.html --}}
    <main class="main">
    <section id="clients-section" class="clients p-0 m-0" >
    <!-- Hero Section -->
    @include('frontend.layouts.hero')
    <!-- /Hero Section -->

    <!-- About Section -->
    @include('frontend.layouts.about')
    <!-- /About Section -->

    <!-- Services Section -->
    @include('frontend.layouts.services')
    <!-- /Services Section -->

    <!-- Portfolio Section -->
     @include('frontend.layouts.portfolio')
    <!-- /Portfolio Section -->

    <!-- Faq Section -->
     
    <!-- /Faq Section -->

    <!-- Team Section -->
     @include('frontend.layouts.team')
    <!-- /Team Section -->

    <!-- Clients Section -->
     
    <!-- /Clients Section -->

    <!-- Contact Section -->
     @include('frontend.layouts.contact')
    <!-- /Contact Section -->
</section>
  </main>
@endsection
