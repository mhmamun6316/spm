@extends('layouts.app')

@section('title', __('common.edit_role'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.edit_role') }}: {{ $role->name }}</h2>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="form-label">{{ __('common.name') }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold mb-3">{{ __('common.permissions') }}</label>
                
                <div class="row">
                    @foreach($permissions as $group => $perms)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <div class="form-check">
                                    <input class="form-check-input group-checkbox" type="checkbox" id="group_{{ $group }}" data-group="{{ $group }}">
                                    <label class="form-check-label fw-bold text-uppercase" for="group_{{ $group }}">
                                        {{ str_replace('_', ' ', $group) }}
                                    </label>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach($perms as $permission)
                                <div class="form-check mb-2">
                                    <input class="form-check-input permission-checkbox group-{{ $group }}" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ str_replace('.', ' ', $permission->name) }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('permissions')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>{{ __('common.update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle group checkbox click
        $('.group-checkbox').change(function() {
            var group = $(this).data('group');
            var isChecked = $(this).prop('checked');
            $('.permission-checkbox.group-' + group).prop('checked', isChecked);
        });

        // Handle individual permission checkbox click to update group checkbox
        $('.permission-checkbox').change(function() {
            var groupClass = $(this).attr('class').split(' ').find(c => c.startsWith('group-'));
            var group = groupClass.replace('group-', '');
            checkGroupCheckbox(group);
        });

        // Initial check for group checkboxes
        $('.group-checkbox').each(function() {
            var group = $(this).data('group');
            checkGroupCheckbox(group);
        });

        function checkGroupCheckbox(group) {
            var allChecked = $('.permission-checkbox.group-' + group).length === $('.permission-checkbox.group-' + group + ':checked').length;
            $('#group_' + group).prop('checked', allChecked);
        }
    });
</script>
@endpush
