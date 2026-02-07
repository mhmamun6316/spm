@extends('layouts.frontend')

@section('title', $service->title . ' - SPM')

@section('content')
    {{-- Service Content --}}
    <section class="service-detail py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    @if($service->image)
                        <div class="service-image mb-5 rounded-3 overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid w-100">
                        </div>
                    @endif

                    <div class="service-description content-description">
                        {!! $service->long_description !!}
                    </div>

                    <div class="mt-5 text-center">
                        <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-2">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .service-detail {
            padding-top: 120px !important;
        }

        .service-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        .service-description p {
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item.active {
            color: #0C2E92; /* Primary Blue */
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .service-detail {
                padding-top: 100px !important;
            }
        }
    </style>
@endsection
