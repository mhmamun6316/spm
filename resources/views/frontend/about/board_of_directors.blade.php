@extends('layouts.frontend')

@section('title', 'Board of Directors - SPM')

@section('content')
    {{-- Page Header --}}
    <div class="page-header py-5 bg-light">
        <div class="container py-5 text-center">
            <h1 class="display-4 fw-bold text-primary">Board of Directors</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item text-muted">About Us</li>
                    <li class="breadcrumb-item active" aria-current="page">Board of Directors</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Board Members Grid --}}
    <section class="board-members-section py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse($members as $member)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="member-card position-relative overflow-hidden rounded-3 shadow-sm bg-white h-100">
                            {{-- Image --}}
                            <div class="member-image-wrapper">
                                @if($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="img-fluid w-100 member-img">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                                        <i class="fas fa-user fa-5x text-muted"></i>
                                    </div>
                                @endif
                                
                                {{-- Overlay Content --}}
                                <div class="member-overlay d-flex flex-column justify-content-end p-4 text-center">
                                    <div class="overlay-content text-white">
                                        <h3 class="member-name h4 fw-bold mb-1">{{ $member->name }}</h3>
                                        <p class="member-position mb-0 small text-uppercase">{{ $member->position }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted h5">No board members found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .page-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .member-card {
            transition: transform 0.3s ease;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }

        .member-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .member-img {
            transition: transform 0.5s ease;
            display: block;
        }

        .member-card:hover .member-img {
            transform: scale(1.05);
        }

        .member-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(12, 46, 146, 0.85); /* Primary Blue Overlay with opacity */
            opacity: 0;
            transform: translateY(100%); /* Start from bottom */
            transition: all 0.4s ease;
        }

        /* On hover, slide up overlay */
        .member-card:hover .member-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .overlay-content {
            transform: translateY(20px);
            transition: transform 0.4s ease 0.1s;
        }

        .member-card:hover .overlay-content {
            transform: translateY(0);
        }

        .breadcrumb-item.active {
            color: #0C2E92;
            font-weight: 600;
        }
    </style>
@endsection
