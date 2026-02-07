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

        /* Our Values Section */
        .our-values-section {
            padding: 80px 0;
            position: relative;
        }

        .values-diagram-wrapper {
            min-height: 500px;
            position: relative;
        }

        .values-circle-diagram {
            position: relative;
            width: 600px;
            height: 600px;
            margin: 0 auto;
        }

        .company-name-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .company-name-svg {
            width: 100%;
            height: 100%;
        }

        .company-name-text {
            font-size: 14px;
            fill: rgba(0, 0, 0, 0.3);
            font-weight: 500;
            letter-spacing: 2px;
        }

        .values-segments-svg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            z-index: 2;
        }

        .value-segment-group {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .value-segment-path {
            transition: fill 0.3s ease;
        }

        .value-segment-group:hover .value-segment-path {
            fill: #dc3545 !important;
        }

        .segment-icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            width: 100%;
            height: 100%;
        }

        .segment-icon {
            width: 70px;
            height: 70px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .segment-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
            display: block;
        }

        .segment-icon i {
            font-size: 50px;
            color: #ffffff !important;
            display: block;
        }

        .segment-label {
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
            line-height: 1.4;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            white-space: nowrap;
            display: block;
            margin-top: 5px;
        }

        .segment-label-svg {
            fill: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        foreignObject {
            overflow: visible;
        }

        .values-center-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .center-logo-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .center-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .center-logo-text {
            text-align: center;
        }

        .logo-text-main {
            font-size: 18px;
            font-weight: 700;
            color: #0C2E92;
            margin-bottom: 5px;
        }

        .logo-text-sub {
            font-size: 10px;
            color: #666666;
            line-height: 1.2;
        }

        .values-content {
            padding: 20px;
        }

        .values-section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0C2E92;
            margin-bottom: 40px;
        }

        .values-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .value-item {
            margin-bottom: 0;
        }

        .value-item-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0C2E92;
            margin-bottom: 8px;
        }

        .value-item-description {
            font-size: 1rem;
            line-height: 1.7;
            color: #666666;
            margin: 0;
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

            .our-values-section {
                padding: 0;
            }

            .values-diagram-wrapper {
                min-height: 300px;
                position: relative;
            }

            .values-circle-diagram {
                width: 350px;
                height: 350px;
            }

            .values-circle-diagram {
                width: 400px;
                height: 400px;
            }

            .values-segments-svg {
                width: 350px;
                height: 350px;
            }

            .segment-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 10px;
            }

            .segment-icon i {
                font-size: 35px;
            }

            .segment-label {
                font-size: 10px;
            }

            .values-center-logo {
                width: 120px;
                height: 120px;
            }

            .values-center-logo {
                width: 100px;
                height: 100px;
            }

            .values-section-title {
                font-size: 2rem;
                margin-bottom: 30px;
            }

            .value-item-title {
                font-size: 1.1rem;
            }

            .value-item-description {
                font-size: 0.95rem;
            }
        }

            .card-title {
                font-size: 1.5rem;
                margin-bottom: 15px;
            }

            .card-text {
                font-size: 0.95rem;
            }
        }

        /* Why Choose Us Section */
        .why-choose-us-section {
            background-color: #ffffff;
            position: relative;
        }

        .section-title-wrapper {
            position: relative;
            margin-bottom: 50px;
        }

        .section-title-wrapper::before,
        .section-title-wrapper::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 100px;
            height: 1px;
            background-color: #C4C4C4;
        }

        .section-title-wrapper::before {
            left: calc(50% - 150px);
        }

        .section-title-wrapper::after {
            right: calc(50% - 150px);
        }

        .section-title {
            display: inline-block;
            background-color: #ffffff;
            padding: 0 30px;
            font-size: 2.5rem;
            font-weight: 700;
            color: #0C2E92;
            border: 1px solid #C4C4C4;
            position: relative;
            z-index: 1;
        }

        .why-choose-us-swiper {
            padding: 40px 0 60px;
            position: relative;
        }

        .why-choose-card {
            height: 100%;
            min-height: 200px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        .why-choose-us-swiper .swiper-slide {
            height: auto;
            display: flex;
        }

        .card-content {
            padding: 40px 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
            color: #0C2E92;
        }

        .card-description {
            font-size: 1rem;
            line-height: 1.7;
            color: #666666;
        }

        /* Hover Overlay */
        .card-hover-overlay {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: #0C2E92;
            transition: left 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .why-choose-card:hover .card-hover-overlay {
            left: 0;
        }

        .overlay-content {
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }

        .overlay-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
            color: #ffffff;
        }

        .btn-learn-more {
            display: inline-block;
            background-color: #dc3545;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-learn-more:hover {
            background-color: #c82333;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* Swiper Navigation */
        .why-choose-us-swiper .swiper-button-next,
        .why-choose-us-swiper .swiper-button-prev {
            color: #0C2E92;
            background-color: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .why-choose-us-swiper .swiper-button-next:after,
        .why-choose-us-swiper .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }

        .why-choose-us-swiper .swiper-button-next:hover,
        .why-choose-us-swiper .swiper-button-prev:hover {
            background-color: #0C2E92;
            color: #ffffff;
        }

        .why-choose-us-swiper .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background-color: #C4C4C4;
            opacity: 1;
        }

        .why-choose-us-swiper .swiper-pagination-bullet-active {
            background-color: #0C2E92;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
                padding: 0 20px;
            }

            .section-title-wrapper::before,
            .section-title-wrapper::after {
                width: 50px;
            }

            .section-title-wrapper::before {
                left: calc(50% - 100px);
            }

            .section-title-wrapper::after {
                right: calc(50% - 100px);
            }

            .why-choose-card {
                min-height: 200px;
            }

            .why-choose-us-swiper .swiper-slide {
                height: auto;
            }

            .card-content {
                padding: 30px 20px;
            }

            .card-title {
                font-size: 1.3rem;
            }

            .card-description {
                font-size: 0.95rem;
            }
        }

        /* Partners Hover Effect */
        .partner-logo img:hover {
            filter: grayscale(0%) !important;
            transform: scale(1.1);
        }

        /* Global Partners, Certifications & Satisfied Clients Sections - Card Style */
        .global-partners-section,
        .certifications-section,
        .satisfied-clients-section {
            background-color: #f5f5f5;
        }

        /* Shared Card Style for Partners, Certifications, and Clients */
        .partner-logo-card,
        .certification-logo-card,
        .client-logo-card {
            width: 100%;
            height: 159px;
            background-color: #ffffff;
            border-radius: 4px;
            padding: 20px;
            border-style: solid;
            border-width: 2px;
            border-color: #C4C4C4FA;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .partner-logo-card:hover,
        .certification-logo-card:hover,
        .client-logo-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .partner-logo-content,
        .certification-logo-content,
        .client-logo-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-logo-img,
        .certification-logo-img,
        .client-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(0%);
            transition: all 0.3s ease;
        }

        .partner-logo-card:hover .partner-logo-img,
        .certification-logo-card:hover .certification-logo-img,
        .client-logo-card:hover .client-logo-img {
            transform: scale(1.05);
        }

        .partners-swiper,
        .certifications-swiper,
        .clients-swiper {
            padding: 20px 0;
        }

        .partners-swiper .swiper-slide,
        .certifications-swiper .swiper-slide,
        .clients-swiper .swiper-slide {
            height: auto;
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .partners-swiper .swiper-wrapper,
        .certifications-swiper .swiper-wrapper,
        .clients-swiper .swiper-wrapper {
            display: flex;
            align-items: stretch;
        }

        /* Ensure equal width for all slides */
        .partners-swiper .swiper-slide > *,
        .certifications-swiper .swiper-slide > *,
        .clients-swiper .swiper-slide > * {
            width: 100%;
        }

        @media (max-width: 768px) {
            .partner-logo-card,
            .certification-logo-card,
            .client-logo-card {
                height: 140px;
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .partner-logo-card,
            .certification-logo-card,
            .client-logo-card {
                height: 120px;
                padding: 12px;
            }
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
                            <div class="col-lg-12">
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

    {{-- Our Values Section --}}
    <section class="our-values-section" style="background-color: #f5f5f5;">
        <div class="container">
            <div class="row align-items-center">
                {{-- Circular Diagram --}}
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="values-diagram-wrapper d-flex justify-content-center align-items-center">
                        <div class="values-circle-diagram">
                            {{-- Value Segments SVG --}}
                            <svg class="values-segments-svg" viewBox="0 0 500 500">
                                @php
                                    $values = [
                                        ['title' => 'INTEGRITY', 'icon' => 'fas fa-balance-scale', 'color' => '#dc3545', 'description' => 'We create trust through responsible action and honest relationships. We will be guided by the core values of transparency and integrity.'],
                                        ['title' => 'EXCELLENCE', 'icon' => 'fas fa-star', 'color' => '#0C2E92', 'description' => 'We strive to deliver exceptional results and ensure customer satisfaction.'],
                                        ['title' => 'CUSTOMER FOCUS', 'icon' => 'fas fa-bullseye', 'color' => '#0C2E92', 'description' => 'Nothing means more to us than the satisfaction of our customers.'],
                                        ['title' => 'RESPECT', 'icon' => 'fas fa-heart', 'color' => '#0C2E92', 'description' => 'We value everyone and treat people with dignity and professionalism.'],
                                        ['title' => 'ACCOUNTABILITY', 'icon' => 'fas fa-handshake', 'color' => '#0C2E92', 'description' => 'Each of us is accountable for our words, actions and results.'],
                                        ['title' => 'COLLABORATION', 'icon' => 'fas fa-users', 'color' => '#0C2E92', 'description' => 'We achieve more when we work together and all pull in the same direction.'],
                                    ];
                                    $centerX = 250;
                                    $centerY = 250;
                                    $radius = 220;
                                    $innerRadius = 100;
                                    $gap = 3; // Gap between segments in degrees
                                    $segmentAngle = (360 - ($gap * count($values))) / count($values);
                                @endphp

                                @foreach($values as $index => $value)
                                    @php
                                        $startAngleDeg = $index * ($segmentAngle + $gap) - 90;
                                        $endAngleDeg = $startAngleDeg + $segmentAngle;
                                        $startAngle = deg2rad($startAngleDeg);
                                        $endAngle = deg2rad($endAngleDeg);

                                        $x1 = round($centerX + $innerRadius * cos($startAngle), 2);
                                        $y1 = round($centerY + $innerRadius * sin($startAngle), 2);
                                        $x2 = round($centerX + $radius * cos($startAngle), 2);
                                        $y2 = round($centerY + $radius * sin($startAngle), 2);
                                        $x3 = round($centerX + $radius * cos($endAngle), 2);
                                        $y3 = round($centerY + $radius * sin($endAngle), 2);
                                        $x4 = round($centerX + $innerRadius * cos($endAngle), 2);
                                        $y4 = round($centerY + $innerRadius * sin($endAngle), 2);

                                        $textAngle = ($startAngleDeg + $endAngleDeg) / 2;
                                        $textRadius = ($innerRadius + $radius) / 2;
                                        $textX = round($centerX + $textRadius * cos(deg2rad($textAngle)), 2);
                                        $textY = round($centerY + $textRadius * sin(deg2rad($textAngle)), 2);

                                        // Keep all text at same rotation as EXCELLENCE (-1.5 degrees)
                                        $textRotation = -1.5;
                                    @endphp

                                    <g class="value-segment-group" data-segment-color="{{ $value['color'] }}">
                                        <path class="value-segment-path"
                                              d="M {{ $centerX }},{{ $centerY }} L {{ $x1 }},{{ $y1 }} A {{ $innerRadius }},{{ $innerRadius }} 0 0,1 {{ $x4 }},{{ $y4 }} Z
                                                 M {{ $x1 }},{{ $y1 }} L {{ $x2 }},{{ $y2 }} A {{ $radius }},{{ $radius }} 0 0,1 {{ $x3 }},{{ $y3 }} L {{ $x4 }},{{ $y4 }} A {{ $innerRadius }},{{ $innerRadius }} 0 0,0 {{ $x1 }},{{ $y1 }} Z"
                                              fill="{{ $value['color'] }}"
                                              stroke="none"/>

                                        {{-- Icon (always upright) --}}
                                        <g transform="translate({{ $textX }}, {{ $textY - 20 }})">
                                            <foreignObject x="-35" y="-35" width="70" height="70" style="overflow: visible;">
                                                <div class="segment-icon-wrapper" xmlns="http://www.w3.org/1999/xhtml">
                                                    <div class="segment-icon">
                                                        <i class="{{ $value['icon'] }}"></i>
                                                    </div>
                                                </div>
                                            </foreignObject>
                                        </g>

                                        {{-- Text (rotated to follow segment direction) --}}
                                        <g transform="translate({{ $textX }}, {{ $textY + 25 }}) rotate({{ $textRotation }})">
                                            <text x="0" y="0" text-anchor="middle" class="segment-label-svg" fill="#ffffff" font-size="13" font-weight="700">{{ $value['title'] }}</text>
                                        </g>
                                    </g>
                                @endforeach
                            </svg>

                            {{-- Center Logo --}}
                            <div class="values-center-logo">
                                <div class="center-logo-content">
                                    <img src="{{ asset('frontend/assets/logo.png') }}" alt="Logo" class="center-logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <div class="center-logo-text" style="display: none;">
                                        <div class="logo-text-main">{{ $pageContent->company_name ?? 'ANOOSHA' }}</div>
                                        <div class="logo-text-sub">APPAREL SOURCING LTD</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Values Text Descriptions --}}
                <div class="col-lg-6">
                    <div class="values-content">
                        <h2 class="values-section-title">Our Values</h2>
                        <div class="values-list">
                            @foreach($values as $value)
                                <div class="value-item">
                                    <h3 class="value-item-title">{{ $value['title'] }}:</h3>
                                    <p class="value-item-description">{{ $value['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section (Why Choose Us) --}}
    @if($services && $services->count() > 0)
        <section class="why-choose-us-section py-5">
            <div class="container">
                <div class="section-title-wrapper text-center">
                    <h2 class="section-title">Why Choose Us</h2>
                </div>

                <div class="swiper why-choose-us-swiper">
                    <div class="swiper-wrapper">
                        @foreach($services as $service)
                            <div class="swiper-slide">
                                <div class="why-choose-card">
                                    <div class="card-content">
                                        {{-- Title --}}
                                        <h3 class="card-title">{{ $service->title }}</h3>

                                        {{-- Description --}}
                                        <p class="card-description">
                                            {{ Str::limit($service->short_description, 200) }}
                                        </p>
                                    </div>

                                    {{-- Hover Overlay --}}
                                    <div class="card-hover-overlay">
                                        <div class="overlay-content">
                                            <h3 class="overlay-title">{{ $service->title }}</h3>
                                            <a href="{{ route('service.show', $service->slug) }}" class="btn-learn-more">Learn More</a>
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
            </div>
        </section>
    @endif

    {{-- Global Partners Section --}}
    @if($globalPartners && $globalPartners->count() > 0)
        <section class="global-partners-section" id="global-partners">
            <div class="container py-4">
                <h2 class="text-center section-heading text-uppercase mb-5 text-primary fw-bold" style="color: #0C2E92 !important;">OUR GLOBAL PARTNER</h2>

                <div class="swiper partners-swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($globalPartners as $partner)
                            <div class="swiper-slide">
                                <div class="partner-logo-card">
                                    <div class="partner-logo-content">
                                        <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}" class="partner-logo-img">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Our Certifications Section --}}
    @if(isset($certifications) && $certifications->count() > 0)
        <section class="certifications-section">
            <div class="container py-4">
                <h2 class="text-center section-heading text-uppercase mb-5 text-primary fw-bold" style="color: #0C2E92 !important;">Our Certifications</h2>

                <div class="swiper certifications-swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($certifications as $certification)
                            <div class="swiper-slide">
                                <div class="certification-logo-card">
                                    <div class="certification-logo-content">
                                        <img src="{{ asset('storage/' . $certification->image) }}" alt="{{ $certification->name }}" class="certification-logo-img">
                                    </div>
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
        <section class="satisfied-clients-section">
            <div class="container py-4">
                <h2 class="text-center section-heading text-uppercase mb-5 text-primary fw-bold" style="color: #0C2E92 !important;">Our Happy Customers</h2>

                <div class="swiper clients-swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($satisfiedClients as $client)
                            <div class="swiper-slide">
                                <div class="client-logo-card">
                                    <div class="client-logo-content">
                                        <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name }}" class="client-logo-img">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Let's Work Together Section --}}
    <section class="work-together-section">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="work-together-title" data-aos="fade-up">Let's Work Together ?</h2>
                    <p class="work-together-text" data-aos="fade-up" data-aos-delay="200">
                        If You Find Yourself Questioning, 'Is This The Best It Can Be?' Then Look No Further - We Are The Right Team To Assist You.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-contact-us" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Partners Swiper
        new Swiper('.partners-swiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
            }
        });

        // Certifications Swiper
        if (document.querySelector('.certifications-swiper')) {
            new Swiper('.certifications-swiper', {
                slidesPerView: 2,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 2800,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 5,
                        spaceBetween: 20,
                    },
                }
            });
        }

        // Clients Swiper
        new Swiper('.clients-swiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
            }
        });

        // Why Choose Us Swiper
        if (document.querySelector('.why-choose-us-swiper')) {
            new Swiper('.why-choose-us-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
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
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
    /* Work Together Section */
    .work-together-section {
        background-color: #ffffff;
        min-height: 400px;
        display: flex;
        align-items: center;
    }

    .work-together-title {
        font-size: 3rem;
        font-weight: 700;
        color: #0C2E92;
        margin-bottom: 25px;
    }

    .work-together-text {
        font-size: 1.2rem;
        color: #666666;
        margin-bottom: 35px;
        line-height: 1.8;
    }

    .btn-contact-us {
        background-color: #dc3545;
        color: #ffffff;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 5px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-contact-us:hover {
        background-color: #c82333;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-contact-us i {
        font-size: 1.2rem;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .work-together-title {
            font-size: 2.5rem;
        }

        .work-together-text {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 768px) {
        .work-together-title {
            font-size: 2rem;
        }

        .work-together-text {
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .btn-contact-us {
            padding: 12px 30px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .work-together-title {
            font-size: 1.75rem;
        }
    }
</style>
@endpush
