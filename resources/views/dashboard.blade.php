@extends('layouts.app')

@section('title', __('common.dashboard'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.dashboard') }}</h2>
</div>

<!-- User Statistics Row -->
<h5 class="mb-3"><i class="bi bi-people me-2"></i>User Statistics</h5>
<div class="row">
    <div class="col-md-4">
        <div class="stat-card blue">
            <h3>{{ $totalUsers }}</h3>
            <p><i class="bi bi-people me-2"></i>{{ __('common.total_users') }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card green">
            <h3>{{ $activeUsers }}</h3>
            <p><i class="bi bi-check-circle me-2"></i>{{ __('common.active_users') }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange">
            <h3>{{ $totalUsers - $activeUsers }}</h3>
            <p><i class="bi bi-x-circle me-2"></i>{{ __('common.inactive_users') }}</p>
        </div>
    </div>
</div>

<!-- Product Statistics Row -->
<h5 class="mb-3 mt-4"><i class="bi bi-box-seam me-2"></i>Product Statistics</h5>
<div class="row">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);">
            <h3>{{ $totalCategories }}</h3>
            <p><i class="bi bi-tags me-2"></i>Total Categories</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);">
            <h3>{{ $activeCategories }}</h3>
            <p><i class="bi bi-check2-circle me-2"></i>Active Categories</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
            <h3>{{ $totalProducts }}</h3>
            <p><i class="bi bi-box me-2"></i>Total Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
            <h3>{{ $activeProducts }}</h3>
            <p><i class="bi bi-box-seam me-2"></i>Active Products</p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>{{ __('common.recent_users') }}</h5>
            </div>
            <div class="card-body">
                @if($recentUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('common.profile') }}</th>
                                    <th>{{ __('common.name') }}</th>
                                    <th>{{ __('common.email') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                                 alt="{{ $user->name }}" class="table-img">
                                        @else
                                            <div class="table-img bg-primary d-flex align-items-center justify-content-center text-white">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->status === 'active')
                                            <span class="badge bg-success">{{ __('common.active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('common.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">{{ __('common.no_data') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
