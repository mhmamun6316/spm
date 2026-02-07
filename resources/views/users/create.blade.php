@extends('layouts.app')

@section('title', __('common.add_new') . ' ' . __('common.users'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.add_new') }} {{ __('common.users') }}</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation">
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>


                <div class="col-md-6">
                    <x-image-cropper 
                        name="profile_photo" 
                        id="profile_photo" 
                        label="Profile Photo" 
                        width="300" 
                        height="300" 
                    />
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('common.roles') }}</label>
                        <select class="form-select select2" name="roles[]" multiple="multiple" id="roles" data-placeholder="{{ __('common.select_roles') }}">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Create User
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
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // Custom validation method for file size (2MB max)
        $.validator.addMethod('filesize', function(value, element, param) {
            if (element.files.length === 0) {
                return true; // File is optional
            }
            return this.optional(element) || (element.files[0].size <= param);
        }, 'File size must be less than {0} bytes');

        // Custom validation method for image type
        $.validator.addMethod('imageType', function(value, element) {
            if (element.files.length === 0) {
                return true; // File is optional
            }
            var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            return this.optional(element) || (allowedTypes.indexOf(element.files[0].type) !== -1);
        }, 'Please select a valid image file (JPEG, PNG, JPG, GIF)');

        // Initialize jQuery Validation
        $('#userForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
                status: {
                    required: true
                },
                profile_photo: {
                    imageType: true,
                    filesize: 2097152 // 2MB in bytes
                }
            },
            messages: {
                name: {
                    required: 'Please enter the user name',
                    minlength: 'Name must be at least 2 characters long',
                    maxlength: 'Name cannot exceed 255 characters'
                },
                email: {
                    required: 'Please enter the email address',
                    email: 'Please enter a valid email address',
                    maxlength: 'Email cannot exceed 255 characters'
                },
                password: {
                    required: 'Please enter a password',
                    minlength: 'Password must be at least 8 characters long'
                },
                password_confirmation: {
                    required: 'Please confirm the password',
                    equalTo: 'Passwords do not match'
                },
                status: {
                    required: 'Please select a status'
                },
                profile_photo: {
                    imageType: 'Please select a valid image file (JPEG, PNG, JPG, GIF)',
                    filesize: 'Image size must be less than 2MB'
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
@endpush

