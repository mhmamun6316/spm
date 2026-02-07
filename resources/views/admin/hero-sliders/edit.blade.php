@extends('layouts.app')

@section('title', 'Edit Hero Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Edit Hero Slider</h2>
    <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.hero-sliders.update', $heroSlider->id) }}" method="POST" enctype="multipart/form-data" id="heroSliderForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <x-image-cropper
                        name="image"
                        id="hero_image"
                        label="Slider Image (Change to replace)"
                        :value="$heroSlider->image"
                        width="943"
                        height="530"
                    />
                    <div class="error-message text-danger small mt-1"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        name="title"
                        value="{{ old('title', $heroSlider->title) }}"
                    >
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input
                        type="text"
                        class="form-control"
                        name="subtitle"
                        value="{{ old('subtitle', $heroSlider->subtitle) }}"
                    >
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input
                        type="number"
                        class="form-control"
                        name="sort_order"
                        value="{{ old('sort_order', $heroSlider->sort_order) }}"
                    >
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ $heroSlider->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$heroSlider->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Hero Slider
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

<script>
    $(document).ready(function() {
        $('#heroSliderForm').validate({
            ignore: ":hidden:not(#hero_image)",
            rules: {
                title: {
                    maxlength: 255
                },
                subtitle: {
                    maxlength: 255
                },
                sort_order: {
                    required: true,
                    digits: true
                },
                is_active: {
                    required: true
                }
            },
            messages: {
                title: {
                    maxlength: 'Title cannot exceed 255 characters'
                },
                subtitle: {
                    maxlength: 'Subtitle cannot exceed 255 characters'
                },
                sort_order: {
                    required: 'Please enter a sort order',
                    digits: 'Sort order must be a number'
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr('name') == 'image') {
                    error.appendTo(element.closest('.col-md-6').find('.error-message'));
                } else {
                    error.appendTo(element.closest('.mb-3').find('.error-message'));
                }
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
