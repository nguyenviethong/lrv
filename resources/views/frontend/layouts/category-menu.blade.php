@if(isset($categories) && $categories->count())
    @foreach($categories as $category)
        @if($category->children->count() > 0)
            <li class="dropdown">
                <a href="{{ route('category.show', $category->slug) }}">
                    <span>{{ $category->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                </a>
                <ul>
                    {{-- Đệ quy gọi lại chính nó, truyền children --}}
                    @include('frontend.layouts.category-menu', ['categories' => $category->children])
                </ul>
            </li>
        @else
            <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
        @endif
    @endforeach
@endif