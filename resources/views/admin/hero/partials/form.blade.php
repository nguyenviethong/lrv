<div class="form-group">
    <label for="title">Tiêu đề</label>
    <input type="text" name="title" id="title" class="form-control"
           value="{{ old('title', $hero->title ?? '') }}" required>
</div>

<div class="form-group">
    <label for="subtitle">Mô tả</label>
    <textarea name="subtitle" id="subtitle" rows="3" class="form-control">{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="button_text">Nút (Text)</label>
    <input type="text" name="button_text" id="button_text" class="form-control"
           value="{{ old('button_text', $hero->button_text ?? '') }}">
</div>

<div class="form-group">
    <label for="button_link">Nút (Link)</label>
    <input type="text" name="button_link" id="button_link" class="form-control"
           value="{{ old('button_link', $hero->button_link ?? '') }}">
</div>

<div class="form-group">
    <label for="video_link">Video link (YouTube)</label>
    <input type="text" name="video_link" id="video_link" class="form-control"
           value="{{ old('video_link', $hero->video_link ?? '') }}">
</div>

<div class="form-group">
    <label for="image">Hình ảnh</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(!empty($hero->image))
        <div class="mt-2">
            <img src="{{ asset('storage/'.$hero->image) }}" alt="Hero Image" class="img-thumbnail" style="max-height: 200px;">
        </div>
    @endif
</div>
