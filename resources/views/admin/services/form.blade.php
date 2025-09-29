@csrf
<div class="mb-3">
    <label for="title" class="form-label">Tiêu đề</label>
    <input type="text" name="title" id="title" 
           value="{{ old('title', $service->title ?? '') }}" 
           class="form-control @error('title') is-invalid @enderror">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@php
                $iconOptions = [
                        'bi bi-activity' => 'Activity',
                        'bi bi-bounding-box-circles' => 'Bounding Box',
                        'bi bi-calendar4-week' => 'Calendar Week',
                        'bi bi-broadcast' => 'Broadcast',
                        'bi bi-check-circle' => 'Check Circle',
                        'bi bi-gear' => 'Gear',
                        'bi bi-people' => 'People',
                        'bi bi-laptop' => 'Laptop',
                ];
            @endphp

<div class="form-group mb-3">
    <label for="icon">Icon</label>
    <div class="d-flex align-items-center">
        <select name="icon" id="icon" class="form-select" style="max-width:250px;"
                onchange="document.getElementById('icon-preview').className = this.value + ' fs-4 ms-3';">
            <option value="">-- Chọn icon --</option>
            @foreach($iconOptions as $class => $label)
                <option value="{{ $class }}" {{ old('icon', $service->icon ?? '') == $class ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <i id="icon-preview" class="{{ old('icon', $service->icon ?? '') }} fs-4 ms-3"></i>
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Mô tả ngắn</label>
    <textarea name="description" id="description" rows="3" 
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="link" class="form-label">Liên kết</label>
    <input type="text" name="link" id="link" 
           value="{{ old('link', $service->link ?? '') }}" 
           class="form-control @error('link') is-invalid @enderror">
    @error('link')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 p-0">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ (old('is_active', $service->is_active ?? 1) == 1) ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ (old('is_active', $service->is_active ?? 1) == 0) ? 'selected' : '' }}>Không hoạt động</option>
                </select>
  </div>

<div class="mb-3">
    <label for="content" class="form-label">Nội dung chi tiết</label>
    <textarea name="content" id="content" rows="5" 
              class="form-control @error('content') is-invalid @enderror">{{ old('content', $service->content ?? '') }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="mb-3">
    <label for="image" class="form-label">Hình ảnh</label>

    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
    @if(!empty($service->image))
        <div class="mt-2">
            <img src="{{ asset('storage/'.$service->image) }}" alt="" class="img-thumbnail" style="max-height:150px;">
        </div>
    @endif
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Features lặp lại --}}
<div class="mb-3">
    <label class="form-label">Tính năng</label>
    <button type="button" id="add-feature" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Thêm tính năng</button>
    <div id="features-wrapper">
        @php
            $features = old('features', $service->features ?? []);
        @endphp
        @foreach($features as $i => $feature)
            <div class="input-group mb-2">
                <input type="text" name="features[{{ $i }}][title]" class="form-control"
                       value="{{ $feature['title'] ?? '' }}" placeholder="Feature title">
                <button type="button" class="btn btn-danger remove-feature">X</button>
            </div>
        @endforeach
    </div>
    
</div>

@section('js')
<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        language: 'vi',
       
        extraPlugins: 'autogrow,image2',   // gộp plugin
        autoGrow_minHeight: 200,   // chiều cao tối thiểu
        autoGrow_maxHeight: 800,   // chiều cao tối đa
        removePlugins: 'easyimage, cloudservices',
        filebrowserUploadUrl: "/ckeditor/upload?_token={{ csrf_token() }}",
        filebrowserUploadMethod: 'form'

        
        
    });
</script>
<style>
    [id^="cke_notifications_area_"] {
        display: none !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let wrapper = document.getElementById('features-wrapper');
        let addBtn = document.getElementById('add-feature');
        let index = {{ count($features) }};

        addBtn.addEventListener('click', function () {
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="features[${index}][title]" class="form-control" placeholder="Feature title">
                <button type="button" class="btn btn-danger remove-feature">X</button>
            `;
            wrapper.appendChild(div);
            index++;
        });

        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection

