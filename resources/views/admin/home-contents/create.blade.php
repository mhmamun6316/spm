@extends('layouts.app')

@section('title', 'Add Home Content')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Add New Home Content</h2>
    <a href="{{ route('admin.home-contents.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.home-contents.store') }}" method="POST" enctype="multipart/form-data" id="textContentForm">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select">
                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text Only</option>
                        <option value="text_image" {{ old('type') == 'text_image' ? 'selected' : '' }}>Text & Image</option>
                    </select>
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="text_position" class="form-label">Text Position <span class="text-danger">*</span></label>
                    <select name="text_position" class="form-select">
                        <option value="">-- Select Position --</option>
                        <option value="left" {{ old('text_position') == 'left' ? 'selected' : '' }}>Left</option>
                        <option value="center" {{ old('text_position') == 'center' ? 'selected' : '' }}>Center</option>
                        <option value="right" {{ old('text_position') == 'right' ? 'selected' : '' }}>Right</option>
                    </select>
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
                    <div class="error-message text-danger small"></div>
                </div>

                <!-- Fields for Text & Image Type -->
                <div class="col-md-6 mb-3 image-fields" style="display: none;">
                    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage(this)">
                    <div class="mt-2" id="preview_container" style="display: none;">
                        <img src="" id="image_preview" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>
                    <div class="error-message text-danger small mt-1"></div>
                </div>

                <div class="col-md-6 mb-3 image-fields" style="display: none;">
                    <label for="image_position" class="form-label">Image Position <span class="text-danger">*</span></label>
                    <select name="image_position" class="form-select">
                        <option value="">-- Select Position --</option>
                        <option value="left" {{ old('image_position') == 'left' ? 'selected' : '' }}>Left</option>
                        <option value="right" {{ old('image_position') == 'right' ? 'selected' : '' }}>Right</option>
                        <option value="top" {{ old('image_position') == 'top' ? 'selected' : '' }}>Top</option>
                        <option value="bottom" {{ old('image_position') == 'bottom' ? 'selected' : '' }}>Bottom</option>
                    </select>
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-12 mb-3 image-fields" style="display: none;">
                    <label for="footer" class="form-label">Footer Text (Optional)</label>
                    <textarea class="form-control" name="footer" rows="3">{{ old('footer') }}</textarea>
                    <div class="error-message text-danger small"></div>
                </div>
                <!-- End Fields for Text & Image Type -->

                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.home-contents.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Create Home Content
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
                $('#preview_container').show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview_container').hide();
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

        tinymce.init({
            ...tinymceConfig,
            selector: 'textarea[name="description"]',
            placeholder: 'Enter description...'
        });

        tinymce.init({
            ...tinymceConfig,
            selector: 'textarea[name="footer"]',
            placeholder: 'Enter footer text...',
            height: 200
        });

        // Toggle fields based on type
        function toggleFields() {
            if ($('#type').val() === 'text_image') {
                $('.image-fields').show();
            } else {
                $('.image-fields').hide();
            }
        }

        $('#type').change(toggleFields);
        toggleFields(); // Initial check

        $('#textContentForm').validate({
            rules: {
                type: { required: true },
                title: { required: true, maxlength: 255 },
                description: { required: true },
                text_position: { required: true },
                sort_order: { required: true, digits: true },
                image: {
                    required: function(element) {
                        return $('#type').val() === 'text_image';
                    },
                    extension: "jpg|jpeg|png|gif|svg"
                },
                image_position: {
                    required: function(element) {
                        return $('#type').val() === 'text_image';
                    }
                }
            },
            messages: {
                // ... messages ...
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.mb-3').find('.error-message'));
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                tinymce.triggerSave();
                form.submit();
            }
        });
    });
</script>
@endpush
