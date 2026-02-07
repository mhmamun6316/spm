@extends('layouts.app')

@section('title', __('common.view_role'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.view_role') }}: {{ $role->name }}</h2>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <h5 class="fw-bold">{{ __('common.name') }}: <span class="text-primary">{{ $role->name }}</span></h5>
            <p class="text-muted">{{ __('common.created_at') }}: {{ $role->created_at->format('M d, Y h:i A') }}</p>
        </div>

        <h5 class="fw-bold mb-3">{{ __('common.permissions') }}</h5>
        
        <div class="row">
            @foreach($permissions as $group => $perms)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <span class="fw-bold text-uppercase">{{ str_replace('_', ' ', $group) }}</span>
                    </div>
                    <div class="card-body">
                        @foreach($perms as $permission)
                            @if($role->hasPermissionTo($permission->name))
                                <span class="badge bg-success me-1 mb-1 p-2">
                                    <i class="bi bi-check-circle me-1"></i>{{ str_replace('.', ' ', $permission->name) }}
                                </span>
                            @else
                                <span class="badge bg-secondary me-1 mb-1 p-2 opacity-50">
                                    <i class="bi bi-x-circle me-1"></i>{{ str_replace('.', ' ', $permission->name) }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
