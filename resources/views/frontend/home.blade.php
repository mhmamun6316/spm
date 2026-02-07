@extends('layouts.frontend')

@section('title', 'SPM - Home')

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-section" id="home">
        @if($heroSliders && $heroSliders->count() > 0)
            <div class="swiper heroSlider">
                <div class="swiper-wrapper">
                    @foreach($heroSliders as $slider)
                        <div class="swiper-slide hero-slide">
                            <div class="hero-slide-bg" style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                                <div class="hero-overlay"></div>
                                <div class="hero-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 {{ $loop->index % 2 == 0 ? 'text-start' : 'text-end order-lg-2' }}">
                                                <div class="hero-text">
                                                    <h1 class="hero-title">{{ $slider->title }}</h1>
                                                    <p class="hero-subtitle">{{ $slider->subtitle }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        @else
            <!-- Fallback: Simple hero with default content -->
            <div class="hero-section-fallback">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-4 fw-bold text-white mb-3">Welcome to SPM</h1>
                            <p class="lead text-white-75 mb-4">Discover excellence in textile manufacturing and sustainable sourcing</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    @push('scripts')
    <script>
        // Initialize Swiper for Hero Slider
        const heroSlider = new Swiper('.heroSlider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            speed: 1000,
            fadeEffect: {
                crossFade: true
            },
            on: {
                init: function() {
                    // Animate first slide
                    const firstSlide = document.querySelector('.hero-slide.swiper-slide-active');
                    if (firstSlide) {
                        animateSlideContent(firstSlide);
                    }
                },
                slideChangeTransitionStart: function() {
                    // Remove animations from all slides
                    const slides = document.querySelectorAll('.hero-slide');
                    slides.forEach(slide => {
                        const title = slide.querySelector('.hero-title');
                        const subtitle = slide.querySelector('.hero-subtitle');
                        if (title) {
                            title.classList.remove('animate-slide-left', 'animate-slide-right');
                            title.style.opacity = '0';
                        }
                        if (subtitle) {
                            subtitle.classList.remove('animate-slide-left', 'animate-slide-right');
                            subtitle.style.opacity = '0';
                        }
                    });
                },
                slideChangeTransitionEnd: function() {
                    // Animate new active slide
                    const activeSlide = document.querySelector('.hero-slide.swiper-slide-active');
                    if (activeSlide) {
                        animateSlideContent(activeSlide);
                    }
                }
            }
        });

        function animateSlideContent(slide) {
            const title = slide.querySelector('.hero-title');
            const subtitle = slide.querySelector('.hero-subtitle');

            // Title slides in from left after a short delay (for image to appear first)
            if (title) {
                setTimeout(() => {
                    title.classList.add('animate-slide-left');
                    title.style.opacity = '1';
                }, 300);
            }

            // Subtitle slides in from right after title
            if (subtitle) {
                setTimeout(() => {
                    subtitle.classList.add('animate-slide-right');
                    subtitle.style.opacity = '1';
                }, 600);
            }
        }
    </script>
    @endpush

    <style>
        /* Swiper Navigation Size */
        .heroSlider {
            --swiper-navigation-size: 30px!important;
        }

        .hero-section {
            position: relative;
            min-height: 100vh;
            margin-top: 0; /* Remove margin for full-screen hero */
        }

        .hero-slide {
            position: relative;
            height: 100vh;
        }

        .hero-slide-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: scroll;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .hero-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .hero-text {
            /* Container for title and subtitle */
        }

        .hero-title,
        .hero-subtitle {
            opacity: 0;
            transform: translateX(-100vw);
        }

        /* Slide in from left animation */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100vw);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Slide in from right animation */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100vw);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-left {
            animation: slideInLeft 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-slide-right {
            animation: slideInRight 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: #0C2E92; /* Primary Blue */
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: #7BBC1E; /* Secondary Green */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-weight: 300;
            line-height: 1.5;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: white;
            z-index: 10;
        }

        .swiper-pagination-bullet {
            background: white;
            opacity: 0.6;
        }

        .swiper-pagination-bullet-active {
            background: #7BBC1E; /* Secondary Green */
            opacity: 1;
        }

        .hero-section-fallback {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            margin-top: 0;
            display: flex;
            align-items: center;
            color: white;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 70vh; /* Reduce height on mobile */
            }

            .hero-slide {
                height: 70vh; /* Reduce slide height on mobile */
            }

            .hero-slide-bg {
                background-size: cover;
                background-position: center center; /* Ensure image is centered */
                background-attachment: scroll;
            }

            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                min-height: 60vh; /* Even smaller on very small screens */
            }

            .hero-slide {
                height: 60vh;
            }

            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
        }

        /* Home Content Sections Styles */
        .home-content-section {
            background: #f8f9fa;
        }

        .home-content-section:nth-child(even) {
            background: #ffffff;
        }

        .content-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0C2E92; /* Primary Blue */
            margin-bottom: 1.5rem;
        }

        .content-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 1rem;
        }

        .content-description p {
            margin-bottom: 1rem;
        }

        .content-description strong {
            color: #0C2E92; /* Primary Blue for strong text */
            font-weight: 700;
        }

        .text-justify {
            text-align: justify;
        }

        .content-footer {
            font-size: 1rem;
            color: #666;
            padding-top: 1rem;
            border-top: 2px solid #7BBC1E; /* Secondary Green */
        }

        .content-footer p {
            margin-bottom: 0.5rem;
        }

        .content-footer strong {
            color: #7BBC1E; /* Secondary Green for strong text in footer */
            font-weight: 700;
        }

        .image-content .image-wrapper img {
            height: 500px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .content-title {
                font-size: 1.8rem;
            }
            .content-description {
                font-size: 1rem;
            }
            .image-content .image-wrapper img {
                height: 300px;
            }
        }

        /* Mission & Vision Section Styles */
        .mission-vision-section {
            background-color: #f5f5f5; /* Light gray background */
            padding: 80px 0;
        }

        .mission-vision-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 35px;
            height: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .mission-vision-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-icon-img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .mission-vision-card:hover .card-icon-img {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0C2E92; /* Dark blue */
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .card-text {
            font-size: 1rem;
            line-height: 1.8;
            color: #666666; /* Dark gray */
            margin: 0;
            flex-grow: 1;
        }

        .card-text p {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .mission-vision-section {
                padding: 60px 0;
            }

            .mission-vision-card {
                padding: 30px 25px;
                margin-bottom: 20px;
            }

            .card-icon {
                margin-bottom: 20px;
            }

            .card-icon svg {
                width: 50px;
                height: 50px;
            }

            .card-title {
                font-size: 1.5rem;
                margin-bottom: 15px;
            }

            .card-text {
                font-size: 0.95rem;
            }
        }

        /* Service Cards Hover Effect */
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
            border-color: rgba(0,0,0,0.05);
        }

        .text-orange {
            color: #fd7e14;
        }

        .service-title {
            color: #0C2E92; /* Primary Blue */
        }

        .service-card .btn-outline-dark:hover {
            background-color: #0C2E92;
            border-color: #0C2E92;
            color: white;
        }

        /* Partners & Clients Hover Effect */
        .partner-logo img:hover,
        .client-logo img:hover {
            filter: grayscale(0%) !important;
            transform: scale(1.1);
        }
    </style>

    {{-- Dynamic Home Content Sections --}}
    @if($homeContents && $homeContents->count() > 0)
        @foreach($homeContents as $content)
            @if($content->type === 'text')
                {{-- Text Only Section --}}
                <section class="home-content-section text-content py-5">
                    <div class="container">
                        <div class="row justify-content-{{ $content->text_position === 'center' ? 'center' : ($content->text_position === 'left' ? 'start' : 'end') }}">
                            <div class="col-lg-{{ $content->text_position === 'center' ? '10' : '12' }}">
                                <div class="content-wrapper text-{{ $content->text_position === 'center' ? 'center' : $content->text_position }}">
                                    <h2 class="content-title" data-aos="fade-{{ $content->text_position === 'center' ? 'up' : ($content->text_position === 'left' ? 'right' : 'left') }}" data-aos-duration="1000">{{ $content->title }}</h2>
                                    <div class="content-description {{ $content->text_position === 'center' ? 'text-justify' : '' }}" data-aos="fade-{{ $content->text_position === 'center' ? 'up' : ($content->text_position === 'left' ? 'right' : 'left') }}" data-aos-delay="200" data-aos-duration="1000">
                                        {!! $content->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @elseif($content->type === 'text_image')
                {{-- Image + Description Section --}}
                <section class="home-content-section image-content py-5">
                    <div class="container">
                        {{-- Title at Top --}}
                        <div class="row">
                            <div class="col-12 text-{{ $content->text_position ?? 'center' }}">
                                <h2 class="content-title mb-4" data-aos="fade-{{ $content->text_position === 'center' ? 'up' : ($content->text_position === 'left' ? 'right' : 'left') }}" data-aos-duration="1000">{{ $content->title }}</h2>
                            </div>
                        </div>

                        {{-- Image and Description Row --}}
                        <div class="row align-items-center {{ $content->image_position === 'right' ? 'flex-row-reverse' : '' }}">
                            {{-- Image Column --}}
                            <div class="col-lg-6">
                                <div class="image-wrapper" data-aos="fade-{{ $content->image_position === 'left' ? 'right' : 'left' }}" data-aos-duration="1000" data-aos-delay="200">
                                    <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->title }}" class="img-fluid w-100">
                                </div>
                            </div>

                            {{-- Description Column --}}
                            <div class="col-lg-6">
                                <div class="content-description" data-aos="fade-{{ $content->image_position === 'left' ? 'left' : 'right' }}" data-aos-duration="1000" data-aos-delay="400">
                                    {!! $content->description !!}
                                </div>
                            </div>
                        </div>

                        {{-- Footer at Bottom --}}
                        @if($content->footer)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="content-footer" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                                        {!! $content->footer !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    {{-- Mission & Vision Section --}}
    @if($pageContent)
        <section class="mission-vision-section py-5" data-aos="fade-up">
            <div class="container">
                <div class="row g-4">
                    {{-- Mission Card --}}
                    <div class="col-md-6">
                        <div class="mission-vision-card">
                            <div class="card-icon mission-icon">
                                <img src="{{ asset('uploads/mission.png') }}" alt="Mission Icon" class="card-icon-img">
                            </div>
                            <h2 class="card-title">Our Mission</h2>
                            <p class="card-text">
                                {!! $pageContent->mission !!}
                            </p>
                        </div>
                    </div>

                    {{-- Vision Card --}}
                    <div class="col-md-6">
                        <div class="mission-vision-card">
                            <div class="card-icon vision-icon">
                                <img src="{{ asset('uploads/vission.png') }}" alt="Vision Icon" class="card-icon-img">
                            </div>
                            <h2 class="card-title">Our Vision</h2>
                            <p class="card-text">
                                {!! $pageContent->values !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Services Section --}}
    @if($services && $services->count() > 0)
        <section class="services-section py-3" style="background-color: #f8f9fa;">
            <div class="container py-5">
                <div class="row g-4">
                    @foreach($services as $service)
                        <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="service-card w-100 bg-white p-5 rounded-3 shadow-sm d-flex flex-column h-100 position-relative overflow-hidden">
                                {{-- Icon/Image --}}
                                <div class="service-icon mb-4">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" height="50">
                                    @else
                                        <i class="fas fa-cogs fa-3x text-orange"></i>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3 class="service-title fw-bold mb-3 h4">{{ $service->title }}</h3>

                                {{-- Description --}}
                                <div class="service-description text-muted mb-4 flex-grow-1">
                                    {{ Str::limit($service->short_description, 150) }}
                                </div>

                                {{-- Read More Button --}}
                                <div class="mt-auto">
                                    <a href="{{ route('service.show', $service->slug) }}" class="btn btn-outline-dark rounded-pill px-4 py-2 text-uppercase small fw-bold" style="letter-spacing: 1px;">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Global Partners Section --}}
    @if($globalPartners && $globalPartners->count() > 0)
        <section class="global-partners-section py-5" style="background-color: #E5E5E5;">
            <div class="container py-4">
                <h2 class="text-center section-heading text-uppercase mb-5 text-primary fw-bold" style="color: #0C2E92 !important;">OUR GLOBAL PARTNER</h2>

                <div class="swiper partners-swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($globalPartners as $partner)
                            <div class="swiper-slide text-center">
                                <div class="partner-logo px-3">
                                    <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 80px; filter: grayscale(100%); transition: all 0.3s ease;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Satisfied Clients Section --}}
    @if($satisfiedClients && $satisfiedClients->count() > 0)
        <section class="satisfied-clients-section py-5 bg-white">
            <div class="container py-4">
                <h2 class="text-center section-heading text-uppercase mb-5 text-primary fw-bold" style="color: #0C2E92 !important;">Our Happy Customers</h2>

                <div class="swiper clients-swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($satisfiedClients as $client)
                            <div class="swiper-slide text-center">
                                <div class="client-logo px-3">
                                    <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name }}" class="img-fluid" style="max-height: 80px; filter: grayscale(0%); transition: all 0.3s ease;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Partners Swiper
        new Swiper('.partners-swiper', {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            }
        });

        // Clients Swiper
        new Swiper('.clients-swiper', {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            }
        });
    });
</script>
@endpush
