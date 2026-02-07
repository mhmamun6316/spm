@extends('layouts.app')

@section('title', __('common.edit') . ' ' . __('common.users'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.edit') }} {{ __('common.users') }}</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="approval_status" class="form-label">Approval Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('approval_status') is-invalid @enderror" 
                                id="approval_status" name="approval_status" required>
                            <option value="pending" {{ old('approval_status', $user->approval_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('approval_status', $user->approval_status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('approval_status', $user->approval_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('approval_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
                <div class="col-md-6">
                    <x-image-cropper 
                        name="profile_photo" 
                        id="profile_photo" 
                        label="Profile Photo" 
                        :value="$user->profile_photo"
                        width="300" 
                        height="300" 
                    />
                </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('common.roles') }}</label>
                        <select class="form-select select2" name="roles[]" multiple="multiple" id="roles" data-placeholder="{{ __('common.select_roles') }}">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
    });
</script>
@endpush

