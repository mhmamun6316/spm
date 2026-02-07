@extends('layouts.app')

@section('title', 'Edit Global Partner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Global Partner</h2>
    <a href="{{ route('admin.global-partners.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.global-partners.update', $globalPartner->id) }}" method="POST" enctype="multipart/form-data" id="partnerForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Partner Logo (Leave blank to keep current)</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage(this)">
                    <div class="mt-2" id="preview_container" @if(!$globalPartner->image) style="display: none;" @endif>
                        <img src="{{ $globalPartner->image ? asset('storage/' . $globalPartner->image) : '' }}" id="image_preview" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>
                    <div class="error-message text-danger small mt-1"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $globalPartner->name) }}">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="url" class="form-label">URL (Optional)</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url', $globalPartner->url) }}">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ $globalPartner->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$globalPartner->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.global-partners.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Global Partner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
                $('#preview_container').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('#partnerForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                image: {
                    extension: "jpg|jpeg|png|gif|svg"
                },
                url: {
                    maxlength: 255,
                    url: true
                },
                is_active: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'Please enter a name',
                    maxlength: 'Name cannot exceed 255 characters'
                },
                image: {
                    extension: 'Please upload a valid image file'
                },
                url: {
                    maxlength: 'URL cannot exceed 255 characters',
                    url: 'Please enter a valid URL'
                }
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
                form.submit();
            }
        });
    });
</script>
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
                form.submit();
            }
        });
    });
</script>
@endpush
