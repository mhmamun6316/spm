@extends('layouts.frontend')

@section('title', 'Sustainability - SPM')

@section('content')
<section class="sustainability-hero-section">
        <div class="sustainability-hero-image">
            <img src="{{ asset('frontend/assets/sustainability/1.jpg') }}" alt="Sustainability" class="hero-zoom-image">
        </div>
        <div class="sustainability-hero-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="sustainability-hero-title" data-aos="fade-up">Sustainability</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Introduction -->
    <section class="sustainability-intro-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-intro-content">
                    <h2 class="sustainability-section-title" data-aos="slide-right">Building A Greener Future Together</h2>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="100">
                        At SPM Limited, we are committed to creating a sustainable future where environmental responsibility, social equity, and economic viability converge. Our dedication to sustainability extends across every aspect of our operations, from sourcing materials to manufacturing processes, ensuring that we contribute positively to both people and the planet.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="200">
                        We believe that sustainable fashion is not just a trend but a fundamental responsibility. Through innovative practices and responsible sourcing, we aim to transform the fashion industry while preserving our environment for future generations.
                    </p>
                </div>
                <div class="col-lg-6 sustainability-intro-images">
                    <div class="row">
                        <div class="col-6">
                            <div class="sustainability-image-box" data-aos="slide-left" data-aos-delay="100">
                                <img src="{{ asset('frontend/assets/sustainability/2.jpg') }}" alt="Green Future" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="sustainability-image-box" data-aos="slide-left" data-aos-delay="200">
                                <img src="{{ asset('frontend/assets/sustainability/3.jpeg') }}" alt="Sustainability" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Green Quote Banner -->
    <section class="sustainability-quote-banner-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="sustainability-quote-text" data-aos="fade-up">"Revive the Earth, Renew Our Future and Choose Today for a Greener Tomorrow"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Sustainable Fashion Principles -->
    <section class="sustainability-principles-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="sustainability-section-title" data-aos="fade-up">Together We Thrive: Partnering for a Greener, Sustainable Future</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-principles-visual">
                    <div class="principles-diagram" data-aos="slide-right">
                        <div class="principles-center">
                            <div class="principles-icon">🌿</div>
                            <h4>SUSTAINABLE FASHION</h4>
                        </div>
                        <div class="principles-item principles-top-left">
                            <h5>CONSCIOUS FASHION</h5>
                            <p>Eco-friendly & Green</p>
                        </div>
                        <div class="principles-item principles-top-right">
                            <h5>CIRCULAR FASHION</h5>
                            <p>Upcycled & Recyclable</p>
                        </div>
                        <div class="principles-item principles-bottom-left">
                            <h5>ETHICAL FASHION</h5>
                            <p>Vegan & Cruelty-free</p>
                            <p>Thrifting, Swapping & Renting</p>
                        </div>
                        <div class="principles-item principles-bottom-right">
                            <h5>Connect with SPM</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 sustainability-principles-content">
                    <h3 class="sustainability-subtitle" data-aos="slide-left">Environmental Responsibility and Accountability</h3>
                    <p class="sustainability-section-text" data-aos="slide-left" data-aos-delay="100">
                        Our commitment to environmental stewardship drives every decision we make. We recognize that the fashion industry has a significant impact on our planet, and we are dedicated to minimizing our ecological footprint through responsible practices and innovative solutions.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-left" data-aos-delay="200">
                        We actively work to reduce waste, conserve resources, and implement sustainable manufacturing processes. Our transparent reporting ensures accountability, allowing us to track our progress and continuously improve our environmental performance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Environmental Standards -->
    <section class="sustainability-standards-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-standards-content">
                    <h2 class="sustainability-section-title" data-aos="slide-right">Environmental Standards & Compliance</h2>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="100">
                        We adhere to the highest environmental standards and maintain strict compliance with international regulations and certifications. Our operations are designed to meet and exceed industry benchmarks for sustainability, ensuring that our practices align with global best practices for environmental protection.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="200">
                        Through continuous monitoring and assessment, we ensure that our manufacturing processes, material sourcing, and supply chain operations meet rigorous environmental criteria, contributing to a healthier planet.
                    </p>
                </div>
                <div class="col-lg-6 sustainability-standards-image">
                    <div class="sustainability-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/sustainability/4.jpg') }}" alt="Environmental Standards" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Partnering Section -->
    <section class="sustainability-partnering-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-partnering-image">
                    <div class="sustainability-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/sustainability/5.jpg') }}" alt="Partnering" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 sustainability-partnering-content">
                    <h2 class="sustainability-section-title" data-aos="slide-left">Partnering for a Sustainable and Greener Future</h2>
                    <p class="sustainability-section-text" data-aos="slide-left" data-aos-delay="100">
                        Collaboration is at the heart of our sustainability journey. We work closely with our partners, suppliers, and stakeholders to drive meaningful change across the fashion industry. Together, we develop innovative solutions, share best practices, and create a collective impact that extends far beyond individual efforts.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-left" data-aos-delay="200">
                        Our partnerships are built on shared values and a mutual commitment to sustainability. By joining forces with like-minded organizations, we amplify our ability to create positive environmental and social change.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Green Banner with Image -->
    <section class="sustainability-quote-banner-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="sustainability-quote-text" data-aos="fade-up">"Crafting Tomorrow: Innovative Solutions for a Greener Fashion Industry"</p>
                    <div class="banner-image-wrapper" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('frontend/assets/sustainability/6.jpeg') }}" alt="Innovation" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 7: Redefining Fashion -->
    <section class="sustainability-redefining-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-redefining-content">
                    <h2 class="sustainability-section-title" data-aos="slide-right">Redefining Fashion: Green Initiatives for a Sustainable Future</h2>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="100">
                        We are reimagining the future of fashion through comprehensive green initiatives that address environmental challenges while maintaining style and quality. Our approach integrates sustainable materials, eco-friendly production methods, and circular design principles to create fashion that is both beautiful and responsible.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="200">
                        From renewable energy adoption to waste reduction strategies, our green initiatives encompass every aspect of our operations, demonstrating that fashion and sustainability can coexist harmoniously.
                    </p>
                </div>
                <div class="col-lg-6 sustainability-redefining-image">
                    <div class="sustainability-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/sustainability/7.jpg') }}" alt="Redefining Fashion" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 8: Green Quote Banner -->
    <section class="sustainability-quote-banner-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="sustainability-quote-text" data-aos="fade-up">"Driving Eco-Friendly Fashion: Where Innovation Meets Responsibility"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 9: Carbon Footprint -->
    <section class="sustainability-carbon-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="sustainability-section-title" data-aos="fade-up">Commit to Change: Lower Carbon Footprint to Safeguard the Planet!</h2>
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 sustainability-carbon-content">
                    <p class="sustainability-section-text" data-aos="slide-right">
                        We are committed to significantly reducing our carbon footprint through strategic initiatives and sustainable practices. Recognizing the urgent need to address climate change, we have implemented comprehensive measures to minimize greenhouse gas emissions across our entire supply chain.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="100">
                        From energy-efficient manufacturing facilities to sustainable transportation and logistics, every aspect of our operations is optimized to reduce environmental impact and contribute to a healthier planet.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="sustainability-image-box" data-aos="slide-left" data-aos-delay="100">
                                <img src="{{ asset('frontend/assets/sustainability/8.jpg') }}" alt="Carbon Reduction" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="sustainability-image-box sustainability-carbon-box" data-aos="slide-left" data-aos-delay="200">
                                <img src="{{ asset('frontend/assets/sustainability/1.jpg') }}" alt="Sustainability" class="img-fluid">
                                <div class="carbon-overlay">
                                    <p class="carbon-text">"Source Sustainably: Together, We Lower Carbon Footprints."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 10: Circularity -->
    <section class="sustainability-circularity-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="sustainability-section-title" data-aos="fade-up">Crafted with Care: Committed to Impact through Sustainability, Renewal and Circularity</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 sustainability-circularity-content">
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="100">
                        Circularity is fundamental to our sustainability strategy. We design products with their entire lifecycle in mind, ensuring that materials can be reused, recycled, or repurposed at the end of their useful life. This approach minimizes waste and maximizes resource efficiency.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="200">
                        Our commitment to sustainable sourcing means we carefully select materials that are renewable, recyclable, and responsibly produced. We work with suppliers who share our values and demonstrate environmental stewardship throughout their operations.
                    </p>
                    <p class="sustainability-section-text" data-aos="slide-right" data-aos-delay="300">
                        Through responsible manufacturing practices, we ensure that our production processes are efficient, waste-minimizing, and environmentally conscious. Every garment we create reflects our dedication to circularity and sustainable impact.
                    </p>
                </div>
                <div class="col-lg-6 sustainability-circularity-image">
                    <div class="sustainability-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/sustainability/2.jpg') }}" alt="Circularity" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 11: Light Blue Banner -->
    <section class="sustainability-light-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="sustainability-light-quote" data-aos="fade-up">"We dedicated to offer sustainable sourcing solutions aligned with your values, transforming the fashion industry one eco-friendly garment at a time."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 12: Call to Action -->
    <section class="sustainability-cta-section">
        <div class="sustainability-cta-background">
            <img src="{{ asset('frontend/assets/sustainability/3.jpeg') }}" alt="Call to Action" class="cta-bg-image">
            <div class="sustainability-cta-overlay"></div>
        </div>
        <div class="sustainability-cta-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="sustainability-cta-title" data-aos="fade-up">Discover our services and partner with us on the journey towards responsible fashion and a more sustainable world.</h2>
                        <p class="sustainability-cta-subtitle" data-aos="fade-up" data-aos-delay="100">To Enquire with Us</p>
                        <a href="#contact" class="btn btn-sustainability-cta" data-aos="fade-up" data-aos-delay="200">ENQUIRE NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/sustainability-script.js') }}"></script>
@endpush
