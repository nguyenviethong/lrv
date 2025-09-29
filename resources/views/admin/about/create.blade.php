@extends('adminlte::page')

@section('title', 'Tạo About')

@section('content_header')
    <h1>Tạo About mới</h1>
@stop

@section('content')
    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label>Intro (in nghiêng)</label>
            <textarea name="intro" class="form-control">{{ old('intro') }}</textarea>
        </div>

        <div class="form-group">
            <label>Nội dung chính</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label>Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

    <hr>
    <h4>Danh sách Items</h4>
    <button type="button" id="add-item" class="btn btn-secondary"><i class="fas fa-plus"></i> Thêm Item</button>
    <div id="items-wrapper">
    @php
        $items = old('items', $about->items ?? []);
    @endphp
    @php
                $iconOptions = [
                    'bi bi-diagram-3' => 'Diagram',
                    'bi bi-fullscreen-exit' => 'Fullscreen Exit',
                    'bi bi-gear' => 'Gear',
                    'bi bi-people' => 'People',
                    'bi bi-star' => 'Star',
                ];
            @endphp

    @foreach($items as $index => $item)
        <div class="item-group border p-2 mb-2 position-relative">
            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-item">
                <i class="fas fa-times"></i>
            </button>
            <div class="form-group">
                <label>Icon</label>
                <select name="items[{{ $index }}][icon]" class="form-select">
                            @foreach($iconOptions as $class => $label)
                                <option value="{{ $class }}" 
                                    {{ ($item['icon'] ?? '') == $class ? 'selected' : '' }}>
                                    <i class="{{ $class }}"></i> {{ $label }}
                                </option>
                            @endforeach
                        </select>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="items[{{ $index }}][title]" class="form-control" value="{{ $item['title'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="items[{{ $index }}][description]" class="form-control">{{ $item['description'] ?? '' }}</textarea>
            </div>
        </div>
    @endforeach
</div>

        <button type="submit" class="btn btn-success mt-3">Tạo mới</button>
    </form>
@stop
@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('icon-select')) {
            let preview = e.target.closest('.form-group').querySelector('.icon-preview');
            preview.className = e.target.value + ' ms-3 fs-4 icon-preview';
        }
    });
    // Xoá item
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('.item-group').remove();
        }
    });

    // Thêm item
    document.getElementById('add-item').addEventListener('click', function() {
        let wrapper = document.getElementById('items-wrapper');
        let index = wrapper.querySelectorAll('.item-group').length;
        let html = `
            <div class="item-group border p-2 mb-2 position-relative">
                <button type="button" class="btn btn-danger btn-sm top-0 end-0 m-1 remove-item">
                    <i class="fas fa-times"></i>
                </button>
                <div class="form-group">
                    <label>Icon</label>
                    <div class="d-flex align-items-center">
                        <select name="items[${index}][icon]" class="form-select icon-select" style="max-width:200px;">
                            @foreach($iconOptions as $class => $label)
                                <option value="{{ $class }}" {{ ($item['icon'] ?? '') == $class ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <i class="{{ $item['icon'] ?? '' }} ms-3 fs-4 icon-preview"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" name="items[${index}][title]" class="form-control">
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="items[${index}][description]" class="form-control"></textarea>
                </div>
                
            </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
    });
});
</script>
@endsection
