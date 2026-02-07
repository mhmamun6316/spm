@extends('layouts.app')

@section('title', 'Add Office Location')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Add New Office Location</h2>
    <a href="{{ route('admin.office-locations.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.office-locations.store') }}" method="POST" id="locationForm">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Office Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="e.g. UK Design Studio">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e.g. info@spm.com">
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-12 mb-3">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
                    <div class="error-message text-danger small"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
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
                <a href="{{ route('admin.office-locations.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Create Location
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#locationForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                address: {
                    required: true
                },
                email: {
                    email: true
                },
                sort_order: {
                    number: true
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
            }
        });
    });
</script>
@endpush
