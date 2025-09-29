<!-- resources/views/layouts/partials/navbar.blade.php -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <!-- <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a> -->
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Logout -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    </li>
  </ul>
</nav>
