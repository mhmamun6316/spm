@extends('layouts.app')

@section('title', __('common.view') . ' ' . __('common.products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.view') }} {{ __('common.products') }}</h2>
    <div>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>{{ __('common.edit') }}
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid mb-3" 
                         style="max-width: 100%; border-radius: 10px;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-3" 
                         style="width: 100%; height: 200px; border-radius: 10px; font-size: 3rem;">
                        <i class="bi bi-image"></i>
                    </div>
                @endif
                <h4 class="mb-1">{{ $product->name }}</h4>
                <p class="text-muted mb-3">{{ $product->category->name ?? '-' }}</p>
                @if($product->status === 'active')
                    <span class="badge bg-success fs-6">{{ __('common.active') }}</span>
                @else
                    <span class="badge bg-danger fs-6">{{ __('common.inactive') }}</span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('common.information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">{{ __('common.name') }}</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.category') }}</th>
                            <td>{{ $product->category->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.price') }}</th>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.quantity') }}</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.description') }}</th>
                            <td>{{ $product->description ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.status') }}</th>
                            <td>
                                @if($product->status === 'active')
                                    <span class="badge bg-success">{{ __('common.active') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('common.inactive') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('common.created_at') }}</th>
                            <td>{{ $product->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.updated_at') }}</th>
                            <td>{{ $product->updated_at->format('F d, Y h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
