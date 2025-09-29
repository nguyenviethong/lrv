<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
          @if(!empty($setting->logo))
              <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" height="50" loading="lazy">
          @endif
          <h1 class="sitename">{{ $setting->site_name ?? 'Site name' }}</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="active">Trang chủ</a></li>
          

          
          
          <li class="dropdown">
              <a href="#"><span>Danh mục</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  @include('frontend.layouts.category-menu', ['categories' => $categories])
              </ul>
          </li>
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      

    </div>
  </header>