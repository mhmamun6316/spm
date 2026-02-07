@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Add New Product</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="product_category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('product_category_id') is-invalid @enderror" 
                                id="product_category_id" name="product_category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px; border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="short_desc" class="form-label">Short Description</label>
                <textarea class="form-control @error('short_desc') is-invalid @enderror" 
                          id="short_desc" name="short_desc">{{ old('short_desc') }}</textarea>
                @error('short_desc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="long_desc" class="form-label">Long Description</label>
                <textarea class="form-control @error('long_desc') is-invalid @enderror" 
                          id="long_desc" name="long_desc">{{ old('long_desc') }}</textarea>
                @error('long_desc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        const tinymceConfig = {
            height: 300,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatselect | fontsize | ' +
                'bold italic underline strikethrough | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | table | ' +
                'removeformat | link image media | code fullscreen | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            font_size_formats: '8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 33px 34px 35px 36px 37px 38px 39px 40px 41px 42px 43px 44px 45px 46px 47px 48px',
            image_advtab: true,
            image_caption: true,
            image_dimensions: true,
            image_title: true,
            table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            table_appearance_options: false,
            table_grid: true,
            table_resize_bars: true,
            automatic_uploads: false,
            file_picker_types: 'image',
            paste_data_images: true,
            object_resizing: true,
            license_key: 'gpl',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        const file = this.files[0];
                        if (!file) return;
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Image size must be less than 5MB');
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            callback(e.target.result, {
                                alt: file.name,
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        };

        // Initialize TinyMCE for short description
        tinymce.init({
            ...tinymceConfig,
            selector: 'textarea[name="short_desc"]',
            placeholder: 'Enter brief product description...'
        });

        // Initialize TinyMCE for long description
        tinymce.init({
            ...tinymceConfig,
            height: 400,
            selector: 'textarea[name="long_desc"]',
            placeholder: 'Enter detailed product description...'
        });

        $('#productForm').on('submit', function() {
            tinymce.triggerSave();
        });
    });
</script>
@endpush
