@extends('layouts.app')

@section('title', __('common.view') . ' ' . __('common.product_categories'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.view') }} {{ __('common.product_categories') }}</h2>
    <div>
        <a href="{{ route('admin.product-categories.edit', $productCategory->id) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>{{ __('common.edit') }}
        </a>
        <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>{{ __('common.back') }}
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('common.information') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">{{ __('common.name') }}</th>
                            <td>{{ $productCategory->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.description') }}</th>
                            <td>{{ $productCategory->description ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.status') }}</th>
                            <td>
                                @if($productCategory->status === 'active')
                                    <span class="badge bg-success">{{ __('common.active') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('common.inactive') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('common.products') }} {{ __('common.count') }}</th>
                            <td>{{ $productCategory->products->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.created_at') }}</th>
                            <td>{{ $productCategory->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('common.updated_at') }}</th>
                            <td>{{ $productCategory->updated_at->format('F d, Y h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
