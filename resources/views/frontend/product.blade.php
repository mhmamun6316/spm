@extends('layouts.frontend')

@section('title', $product->name . ' - SPM')

@section('content')
    {{-- Product Detail Section --}}
    <section class="product-detail py-5">
        <div class="container">
            {{-- Product Main Section --}}
            <div class="row mb-5">
                {{-- Left Column - Product Image --}}
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="product-image-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid rounded-3 shadow-sm w-100">
                        @else
                            <div class="no-image bg-light rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="height: 400px;">
                                <i class="bi bi-image" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right Column - Product Info --}}
                <div class="col-lg-7">
                    <div class="product-info">
                        {{-- Product Title --}}
                        <h1 class="product-title mb-3">{{ $product->name }}</h1>

                        {{-- Category --}}
                        <div class="product-category mb-3">
                            <span class="text-muted">Category:</span>
                            <span class="badge bg-primary ms-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>

                        <hr>

                        {{-- Short Description --}}
                        @if($product->short_desc)
                            <div class="product-short-description mt-4">
                                <div class="content-description">
                                    {!! $product->short_desc !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Full Description Section --}}
            @if($product->long_desc)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="description-section">
                            <h3 class="section-title mb-4">Description</h3>
                            <div class="product-long-description content-description">
                                {!! $product->long_desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Related Products Section --}}
            @if($relatedProducts->count() > 0)
                <div class="row mt-5 pt-5 border-top">
                    <div class="col-12">
                        <h3 class="section-title mb-4">Related Products</h3>
                    </div>
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="related-product-card h-100">
                                <a href="{{ route('product.detail', $relatedProduct->id) }}" class="text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                                        @if($relatedProduct->image)
                                            <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                                 alt="{{ $relatedProduct->name }}"
                                                 class="card-img-top"
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <i class="bi bi-image" style="font-size: 2rem; color: #ccc;"></i>
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title text-dark mb-2">{{ $relatedProduct->name }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="bi bi-tag me-1"></i>{{ $relatedProduct->category->name ?? 'Uncategorized' }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Back Button --}}
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary rounded-pill px-5 py-2">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-detail {
            padding-top: 140px !important;
            padding-bottom: 60px;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0C2E92; /* Primary Blue matching the image */
            line-height: 1.2;
        }

        .product-category {
            font-size: 1.1rem;
        }

        .product-category .badge {
            background-color: #dc3545;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .product-short-description,
        .product-long-description {
            font-size: 1rem;
            line-height: 1.8;
            color: #666;
        }

        .content-description p {
            margin-bottom: 1.5rem;
        }

        .content-description h1,
        .content-description h2,
        .content-description h3,
        .content-description h4 {
            color: #333;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: #28a745; /* Green accent */
        }

        .description-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }

        .related-product-card .card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .related-product-card .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .related-product-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .product-image-wrapper img {
            max-height: 500px;
            object-fit: contain;
            width: 100%;
        }

        @media (max-width: 768px) {
            .product-detail {
                padding-top: 120px !important;
            }

            .product-title {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        /* Additional styling to match the transformers aesthetic */
        .product-info {
            padding: 0;
        }

        .btn-outline-primary {
            border-width: 2px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: #0C2E92;
            border-color: #0C2E92;
        }
    </style>
@endsection
