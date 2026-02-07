@extends('layouts.app')
@section('title', 'Add Page Content')
@section('content')
<div class="mb-4">
    <h2>Add Page Content</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.page-contents.store') }}" method="POST" id="pageContentForm">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="key" class="form-label">Key *</label>
                    <select class="form-select @error('key') is-invalid @enderror" name="key" id="key" required>
                        <option value="">-- Select Key --</option>
                        @foreach($keys as $keyValue => $keyLabel)
                            <option value="{{ $keyValue }}" {{ old('key') == $keyValue ? 'selected' : '' }}>
                                {{ $keyLabel }}
                            </option>
                        @endforeach
                    </select>
                    @error('key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input 
                        type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        name="title"
                        value="{{ old('title') }}"
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        name="description"
                        id="description"
                        rows="8"
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.page-contents.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const tinymceConfig = {
            height: 400,
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
            selector: '#description',
            placeholder: 'Enter page content description...'
        });

        $('#pageContentForm').on('submit', function() {
            tinymce.triggerSave();
        });
    });
</script>
@endpush
