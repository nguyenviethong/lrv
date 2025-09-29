<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $product->name ?? 'Thêm mới sản phẩm' }}</h3>
    </div>
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset
        <div class="card-body row">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>SKU</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id ?? '') == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            
             <!-- Liên hệ -->
            <div class="form-group form-check col-md-12" style="margin-left: 8px;">
                <input type="checkbox" class="form-check-input" id="is_contact" name="is_contact" value="1" 
                    {{ old('is_contact', isset($product) ? $product->is_contact : 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_contact">Liên hệ (không nhập giá và số lượng)</label>
            </div>

            <div class="form-group col-md-3 price-quantity">
                <label>Price</label>
                <input type="text" name="price" id="price" 
                   class="form-control" 
                   value="{{ old('price', $product->price ?? 0) }}">
            </div>
            <div class="form-group col-md-3 price-quantity">
                <label>Quantity</label>
                <input type="text" name="quantity" id="quantity" 
                   class="form-control" 
                   value="{{ old('quantity', $product->quantity ?? 0) }}">
            </div>
            <div class="form-group col-md-3">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ (old('is_active', $product->is_active ?? 1) == 1) ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ (old('is_active', $product->is_active ?? 1) == 0) ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                @if(isset($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" width="80" class="mt-2">
                @endif
            </div>
            <!-- <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $product->title ?? '') }}">
            </div> -->
            <div class="form-group col-12">
                <label>Thông tin chi tiết</label>
                <textarea id="description" name="description" class="form-control" rows="3">
                    {{ old('description', $product->description ?? '') }}
                </textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh chi tiết</label>
                <button type="button" id="add-image" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Thêm ảnh
                </button>
                <div id="images-wrapper">
                    @php
                        $imageDetails = old('imageDetails', $product->imageDetails ?? []);
                    @endphp
                    @foreach($imageDetails as $i => $img)
                            <div class="input-group mb-2 align-items-center">
                                <input type="file" name="imageDetails[{{ $i }}][image]" class="form-control">
                                
                                {{-- Nếu đã có ảnh cũ thì hiển thị --}}
                                @if(!empty($img['image']))
                                    <img src="{{ asset('storage/' . $img['image']) }}" alt="Ảnh chi tiết" width="80" class="ms-2">
                                @endif

                                <button type="button" class="btn btn-danger remove-image ms-2">X</button>
                            </div>
                        @endforeach
                </div>
            </div>

            <div class="form-group col-12">
                <label>Mô tả sản phẩm</label>
                <textarea id="content" name="content" class="form-control" rows="3">
                    {{ old('content', $product->content ?? '') }}
                </textarea>
            </div>


        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
<script>
    function togglePriceQuantity() {
        if (document.getElementById('is_contact').checked) {
            document.querySelectorAll('.price-quantity').forEach(el => el.style.display = 'none');
        } else {
            document.querySelectorAll('.price-quantity').forEach(el => el.style.display = 'block');
        }
    }

    document.getElementById('is_contact').addEventListener('change', togglePriceQuantity);

    // chạy 1 lần khi load trang edit
    document.addEventListener('DOMContentLoaded', togglePriceQuantity);
</script>
@section('js')
<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        language: 'vi',
       
        extraPlugins: 'autogrow,image2',   // gộp plugin
        autoGrow_minHeight: 200,   // chiều cao tối thiểu
        autoGrow_maxHeight: 800,   // chiều cao tối đa
        removePlugins: 'easyimage, cloudservices',
        filebrowserUploadUrl: "/ckeditor/upload?_token={{ csrf_token() }}",
        filebrowserUploadMethod: 'form'

        
        
    });
</script>
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

<!-- thêm imagedetail động -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let wrapper = document.getElementById('images-wrapper');
    let addBtn = document.getElementById('add-image');

    addBtn.addEventListener('click', function () {
        let index = wrapper.querySelectorAll('.input-group').length;
        let html = `
            <div class="input-group mb-2 align-items-center">
                <input type="file" name="imageDetails[${index}][image]" class="form-control">
                <button type="button" class="btn btn-danger remove-image ms-2">X</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
    });

    wrapper.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>

@endsection


