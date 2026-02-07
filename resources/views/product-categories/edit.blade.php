@extends('layouts.app')

@section('title', __('common.edit') . ' ' . __('common.product_categories'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.edit') }} {{ __('common.product_categories') }}</h2>
    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.product-categories.update', $productCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('common.name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $productCategory->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status', $productCategory->status) == 'active' ? 'selected' : '' }}>{{ __('common.active') }}</option>
                            <option value="inactive" {{ old('status', $productCategory->status) == 'inactive' ? 'selected' : '' }}>{{ __('common.inactive') }}</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('common.description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $productCategory->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">{{ __('common.cancel') }}</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>{{ __('common.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
