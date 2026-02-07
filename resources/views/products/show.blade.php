@extends('layouts.app')

@section('title', 'View Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">View Product</h2>
    <div>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->title }}" 
                         class="img-fluid mb-3" 
                         style="max-width: 100%; border-radius: 10px;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-3" 
                         style="width: 100%; height: 200px; border-radius: 10px; font-size: 3rem;">
                        <i class="bi bi-image"></i>
                    </div>
                @endif
                <h4 class="mb-1">{{ $product->title }}</h4>
                <p class="text-muted mb-3">{{ $product->category->name ?? '-' }}</p>
                @if($product->status === 'active')
                    <span class="badge bg-success fs-6">Active</span>
                @else
                    <span class="badge bg-danger fs-6">Inactive</span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Product Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">Title</th>
                            <td>{{ $product->title }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $product->category->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{!! $product->short_desc ?: '-' !!}</td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>{!! $product->long_desc ?: '-' !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($product->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $product->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $product->updated_at->format('F d, Y h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
