<div class="card card-outline card-primary mb-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-filter me-1"></i> Bộ lọc sản phẩm</h3>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3">
            <div class="col-md-12 input-group">
                <!-- Tên sản phẩm -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ request('name') }}" placeholder="Nhập tên...">
                        </div>
                    </div>
                </div>

                <!-- Nhóm (Category) -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-sitemap"></i></span>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Trạng thái -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="is_active">Trạng thái</label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                <select name="is_active" id="is_active" class="form-select">
                                <option value="">-- Tất cả --</option>
                                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Không hoạt động</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Nút -->
                <div class="col-md-12 input-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Lọc
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
