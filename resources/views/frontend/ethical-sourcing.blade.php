@extends('layouts.frontend')

@section('title', 'Ethical Sourcing - SPM')

@section('content')
<section class="ethical-hero-section">
        <div class="ethical-hero-image">
            <img src="{{ asset('frontend/assets/ethical/1.jpg') }}" alt="Ethical and Responsive Sourcing" class="hero-zoom-image">
        </div>
        <div class="ethical-hero-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="ethical-hero-title" data-aos="fade-up">Ethical and Responsive Sourcing</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Introduction Content -->
    <section class="ethical-intro-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ethical-intro-text" data-aos="fade-up">
                        <p class="ethical-section-text">
                            At SPM Limited, we are committed to ethical and responsive sourcing practices that prioritize quality, transparency, and responsibility. Our dedication extends beyond simply delivering products—we ensure that every step of our supply chain reflects our core values of integrity, fairness, and environmental stewardship.
                        </p>
                        <p class="ethical-section-text">
                            We believe that responsible sourcing is fundamental to building a sustainable future. Through careful selection of partners, rigorous quality control, and transparent processes, we create value for our clients while maintaining the highest ethical standards throughout our operations.
                        </p>
                        <p class="ethical-section-text">
                            Our approach integrates social responsibility, environmental consciousness, and economic viability, ensuring that our business practices contribute positively to communities, protect our planet, and deliver exceptional results for our partners.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="ethical-image-box" data-aos="slide-up" data-aos-delay="100">
                        <img src="{{ asset('frontend/assets/ethical/2.jpg') }}" alt="Ethical Sourcing" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="ethical-image-box" data-aos="slide-up" data-aos-delay="200">
                        <img src="{{ asset('frontend/assets/ethical/3.jpeg') }}" alt="Business Ethics" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="ethical-image-box" data-aos="slide-up" data-aos-delay="300">
                        <img src="{{ asset('frontend/assets/ethical/4.jpeg') }}" alt="Quality Control" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Green Quote Banner -->
    <section class="ethical-quote-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="ethical-quote-text" data-aos="fade-up">"SPM, Where Fashion Meets Integrity!! Elevate Your Wardrobe, Elevate Your Values!!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Our Commitment -->
    <section class="ethical-commitment-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 ethical-commitment-content">
                    <h2 class="ethical-section-title" data-aos="slide-right">Where Fashion Meets Integrity</h2>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="100">
                        Our commitment to ethical sourcing encompasses fair wages, safe working conditions, and respectful treatment of all workers throughout our supply chain. We work exclusively with partners who share our values and demonstrate a genuine commitment to social responsibility.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="200">
                        We ensure that every manufacturing facility meets or exceeds international labor standards, providing safe environments where workers can thrive. Our partnerships are built on mutual respect, transparency, and a shared vision for a more equitable fashion industry.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="300">
                        Through regular audits and continuous monitoring, we maintain the highest standards of ethical conduct, ensuring that our operations contribute positively to the communities where we work.
                    </p>
                </div>
                <div class="col-lg-6 ethical-commitment-image">
                    <div class="ethical-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/ethical/5.jpeg') }}" alt="Our Commitment" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Environmental Responsibility -->
    <section class="ethical-environmental-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 ethical-environmental-image">
                    <div class="ethical-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/ethical/1.jpg') }}" alt="Environmental Responsibility" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 ethical-environmental-content">
                    <h2 class="ethical-section-title" data-aos="slide-left">Environmental Responsibility</h2>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="100">
                        Environmental responsibility is integral to our ethical sourcing practices. We actively seek out suppliers who implement sustainable manufacturing processes, reduce waste, and minimize their ecological footprint.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="200">
                        Our commitment extends to supporting renewable energy initiatives, water conservation efforts, and the use of eco-friendly materials. We work closely with our partners to continuously improve environmental performance and reduce the impact of fashion production on our planet.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="300">
                        Through responsible sourcing and sustainable practices, we contribute to a healthier environment while delivering high-quality products that meet the expectations of conscious consumers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Social Engagement & CSR Programs -->
    <section class="ethical-social-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="ethical-section-title" data-aos="fade-up">Social Engagement & CSR Programs</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 ethical-social-content">
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="100">
                        Our Corporate Social Responsibility programs reflect our deep commitment to making a positive impact in the communities where we operate. We engage in initiatives that support education, healthcare, and local development, creating opportunities for growth and empowerment.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="200">
                        We partner with local organizations to provide educational resources, health services, and skills training programs that benefit workers and their families. Our CSR efforts extend beyond our immediate operations, contributing to broader social and economic development.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="300">
                        Through these programs, we build stronger communities, support local initiatives, and create lasting positive change that extends far beyond the fashion industry.
                    </p>
                </div>
                <div class="col-lg-6 ethical-social-image">
                    <div class="ethical-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/ethical/2.jpg') }}" alt="Social Engagement" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Supplier Audits and Certifications -->
    <section class="ethical-certifications-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="ethical-section-title" data-aos="fade-up">Supplier Audits and Certifications</h2>
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 ethical-certifications-content">
                    <p class="ethical-section-text" data-aos="slide-right">
                        We maintain rigorous supplier audit processes to ensure compliance with international standards and certifications. Our comprehensive evaluation system assesses labor practices, environmental impact, quality management, and ethical conduct.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="100">
                        All our partners must meet strict criteria and hold relevant certifications that demonstrate their commitment to ethical and sustainable practices. We conduct regular audits and assessments to ensure ongoing compliance and continuous improvement.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-right" data-aos-delay="200">
                        Our certification requirements include international standards for labor rights, environmental protection, quality assurance, and social responsibility, ensuring that our supply chain meets the highest global benchmarks.
                    </p>
                </div>
                <div class="col-lg-6 ethical-certifications-image">
                    <div class="ethical-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/ethical/3.jpeg') }}" alt="Certifications" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <!-- Certifications Grid -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="certifications-grid" data-aos="fade-up">
                        <div class="certification-item">
                            <div class="certification-logo">amfori BSCI</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">GOTS</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">Disney FAMA</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">ZDHC</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">CTPAT</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">RCS</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">Better Work</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">SMETA</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">GRS</div>
                        </div>
                        <div class="certification-item">
                            <div class="certification-logo">BCI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 7: Continuous Improvement -->
    <section class="ethical-improvement-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 ethical-improvement-image">
                    <div class="ethical-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/ethical/4.jpeg') }}" alt="Continuous Improvement" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 ethical-improvement-content">
                    <h2 class="ethical-section-title" data-aos="slide-left">Continuous Improvement</h2>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="100">
                        We believe that excellence is a journey, not a destination. Our commitment to continuous improvement drives us to constantly evaluate and enhance our ethical sourcing practices, staying ahead of industry trends and evolving standards.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="200">
                        Through innovation, training, and collaboration with industry leaders, we develop new approaches to ethical sourcing that set higher benchmarks for the fashion industry. Our focus on continuous improvement ensures that we remain at the forefront of responsible business practices.
                    </p>
                    <p class="ethical-section-text" data-aos="slide-left" data-aos-delay="300">
                        We invest in research and development, partner education, and process optimization to create a supply chain that is not only ethical and sustainable but also efficient and innovative.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 8: Green Quote Banner -->
    <section class="ethical-quote-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="ethical-quote-text" data-aos="fade-up">"SPM, Where Fashion Meets Integrity!! Elevate Your Wardrobe, Elevate Your Values!!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 9: Call to Action -->
    <section class="ethical-cta-section">
        <div class="ethical-cta-background">
            <img src="{{ asset('frontend/assets/ethical/5.jpeg') }}" alt="Call to Action" class="cta-bg-image">
            <div class="ethical-cta-overlay"></div>
        </div>
        <div class="ethical-cta-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="ethical-cta-title" data-aos="fade-up">To Enquire with Us</h2>
                        <p class="ethical-cta-subtitle" data-aos="fade-up" data-aos-delay="100">Connect with us to discover how ethical sourcing can elevate your business and values</p>
                        <a href="#contact" class="btn btn-ethical-cta" data-aos="fade-up" data-aos-delay="200">ENQUIRE NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/ethical-sourcing-script.js') }}"></script>
@endpush
