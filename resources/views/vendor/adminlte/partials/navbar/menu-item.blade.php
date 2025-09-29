@inject('adminlte', 'JeroenNoten\LaravelAdminLte\AdminLte')

<li @if($item['topnav'] ?? false) class="nav-item d-none d-sm-inline-block"
    @elseif(isset($item['submenu'])) class="nav-item has-treeview {{ $item['submenu_class'] ?? '' }} {{ $item['submenu_open'] ? 'menu-open' : '' }}"
    @else class="nav-item" @endif>

    {{-- Menu links --}}
    @if(isset($item['submenu']))
        <a class="nav-link {{ $item['active'] ? 'active' : '' }}" href="" @if(isset($item['submenu_open']) && $item['submenu_open']) aria-expanded="true" @endif>
            @if(isset($item['icon'])) <i class="nav-icon {{ $item['icon'] }}"></i> @endif
            <p>
                {{ $item['text'] }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @each('adminlte::partials.sidebar.menu-item', $item['submenu'], 'item')
        </ul>
    @else
        <a class="nav-link {{ $item['active'] ? 'active' : '' }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
            href="{{ $item['href'] ?? '#' }}">
            @if(isset($item['icon'])) <i class="nav-icon {{ $item['icon'] }}"></i> @endif
            <p>
                {{ $item['text'] ?? '' }}
                @if(($item['key'] ?? '') === 'logout')
                    <span class="badge badge-danger">Exit</span>
                @endif
            </p>
        </a>
    @endif
</li>
<li class="nav-item">
    <span class="nav-link">Hello, {{ Auth::guard('admin')->user()->name }}</span>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</li>

