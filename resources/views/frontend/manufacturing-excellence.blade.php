@extends('layouts.frontend')

@section('title', 'Manufacturing Excellence - SPM')

@section('content')
<section class="manufacturing-hero-section">
        <div class="manufacturing-hero-image">
            <img src="{{ asset('frontend/assets/excellence/1.jpeg') }}" alt="Manufacturing Excellence" class="hero-zoom-image">
        </div>
        <div class="manufacturing-hero-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="manufacturing-hero-title" data-aos="fade-up">Manufacturing Excellence</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="manufacturing-welcome-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="manufacturing-section-title" data-aos="fade-up">Welcome to SPM Limited. Where Excellence is Crafted into Every Stitch!</h2>
                    <p class="manufacturing-section-text" data-aos="fade-up" data-aos-delay="100">
                        At SPM Limited, we are dedicated to delivering manufacturing excellence that transcends industry standards. Our commitment to precision, quality, and innovation drives every aspect of our operations, ensuring that each garment we produce reflects the highest levels of craftsmanship and attention to detail.
                    </p>
                    <p class="manufacturing-section-text" data-aos="fade-up" data-aos-delay="200">
                        From the initial design concept to the final stitch, we combine traditional expertise with modern technology to create products that exceed expectations. Our team of skilled professionals works tirelessly to maintain our reputation for excellence, delivering superior quality garments that stand the test of time.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 mb-4">
                    <div class="manufacturing-image-box" data-aos="slide-right" data-aos-delay="100">
                        <img src="{{ asset('frontend/assets/excellence/2.jpg') }}" alt="Craftsmanship" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="manufacturing-image-box" data-aos="slide-left" data-aos-delay="200">
                        <img src="{{ asset('frontend/assets/excellence/3.jpg') }}" alt="Quality Control" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="manufacturing-mission-quote" data-aos="fade-up">"Excellence Mission: Driven by Precision- Empowering Quality, Converging Innovation!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Manufacturing Services Section -->
    <section class="manufacturing-services-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="manufacturing-services-title" data-aos="fade-up">MANUFACTURING SERVICES:</h2>
                </div>
            </div>
            
            <!-- Fabric R&D and Innovation -->
            <div class="row align-items-center mt-5">
                <div class="col-lg-6 manufacturing-services-content">
                    <h3 class="manufacturing-subtitle" data-aos="slide-right">Fabric R&D and Innovation:</h3>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="100">
                        Our Fabric Research and Development division is at the forefront of textile innovation, continuously exploring new materials, techniques, and technologies to create fabrics that meet the evolving needs of the fashion industry. We collaborate with leading suppliers and research institutions to develop sustainable, high-performance materials.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="200">
                        Through rigorous testing and quality assessment, we ensure that every fabric we source meets our stringent standards for durability, comfort, and aesthetic appeal. Our commitment to innovation drives us to stay ahead of trends while maintaining the highest quality benchmarks.
                    </p>
                </div>
                <div class="col-lg-6 manufacturing-services-image">
                    <div class="manufacturing-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/excellence/4.jpg') }}" alt="Fabric R&D" class="img-fluid">
                    </div>
                    <p class="manufacturing-services-quote" data-aos="fade-up" data-aos-delay="300">"Ahead of the Curve: Designing Tomorrow's Fashion Today!"</p>
                </div>
            </div>

            <!-- Fitting / Garment Technical Support -->
            <div class="row align-items-center mt-5">
                <div class="col-lg-6 manufacturing-services-image">
                    <div class="manufacturing-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/excelence1.png') }}" alt="Fitting Support" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 manufacturing-services-content">
                    <h3 class="manufacturing-subtitle" data-aos="slide-left">Fitting / Garment Technical Support</h3>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="100">
                        Our dedicated technical support team provides comprehensive fitting and garment development services, ensuring that every piece meets exact specifications and quality standards. We offer personalized consultation and technical assistance throughout the design and production process.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="200">
                        From pattern development to fit analysis, our experts work closely with clients to achieve the perfect balance of style, comfort, and functionality. Our commitment to technical excellence ensures that every garment we produce fits flawlessly and performs exceptionally.
                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="manufacturing-services-quote" data-aos="fade-up">"Precision Fit, Precision Style. Your Style, Our Expertise, Where Comfort Meets Fashion!!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Production Control Section -->
    <section class="manufacturing-production-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 manufacturing-production-content">
                    <h2 class="manufacturing-section-title" data-aos="slide-right">Production Control</h2>
                    <p class="manufacturing-image-subtitle" data-aos="slide-right" data-aos-delay="100">Optimizing Efficiency, Ensuring Quality, Orchestrating Excellence!!</p>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="200">
                        At the foundation of our production management system are four essential elements: Material Requirement Planning (MRP), Capacity Planning, Production Scheduling, and Quality Control. These components collaborate to guarantee a smooth, effective manufacturing operation, overseeing all aspects from material procurement to end product examination.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="300">
                        Material Requirement Planning (MRP) handles material requirements to preserve ideal stock levels and prevent deficits or surpluses. Capacity Planning coordinates manufacturing with requirements to enhance assets and stabilize work distribution. Production Scheduling arranges activities to increase yield and decrease idle periods. Quality Control maintains criteria to guarantee each item fulfills or surpasses requirements.
                    </p>
                </div>
                <div class="col-lg-6 manufacturing-production-image">
                    <div class="manufacturing-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/product_control.png') }}" alt="Production Control" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <!-- Production Control Infographic -->
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="production-infographic" data-aos="slide-right">
                        <div class="infographic-center">
                            <div class="infographic-logo">SPM</div>
                        </div>
                        <div class="infographic-item infographic-top">Material Management</div>
                        <div class="infographic-item infographic-right-top">Capacity Planning and Production Scheduling</div>
                        <div class="infographic-item infographic-right-bottom">Quality Control</div>
                        <div class="infographic-item infographic-bottom-right">Competitive Price</div>
                        <div class="infographic-item infographic-bottom-left">Flexible Lead Time</div>
                        <div class="infographic-item infographic-left-bottom">Waste Reduction and Productivity</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="manufacturing-image-box" data-aos="slide-left">
                        <img src="{{ asset('frontend/assets/product_control2.png') }}" alt="Production Control" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="manufacturing-services-quote" data-aos="fade-up">"Crafting Excellence: Refined Control, Flawless Garments, Excellence in Every Stitch, Efficiency in Every Step"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Assurance Section -->
    <section class="manufacturing-quality-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 manufacturing-quality-image">
                    <div class="manufacturing-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/excellence/5.jpg') }}" alt="Quality Assurance" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 manufacturing-quality-content">
                    <h2 class="manufacturing-section-title" data-aos="slide-left">Quality Assurance:</h2>
                    <p class="manufacturing-image-subtitle" data-aos="slide-left" data-aos-delay="100">Upholding Excellence in Deliverables - Genuine Durability!</p>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="200">
                        Dedicated to maintaining flawless criteria through strict quality management, we guarantee each apparel surpasses requirements for workmanship and resilience. In partnership with our associates, we implement sophisticated procedures—including laboratory examinations and on-location assessments—at each phase of manufacturing, strengthening trust in the honesty and superiority of our merchandise.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="300">
                        Our comprehensive quality assurance program encompasses every stage of production, from raw material inspection to final product testing. We employ advanced testing methodologies and maintain rigorous standards to ensure consistent quality across all our products.
                    </p>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="manufacturing-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/product_control3.png') }}" alt="Quality Control" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 manufacturing-quality-quote">
                    <p class="manufacturing-quality-quote-text" data-aos="slide-left">
                        "Quality is not an act, it is a habit. We are committed to delivering products that consistently meet or exceed the highest standards of craftsmanship and durability."
                    </p>
                    <h3 class="manufacturing-subtitle mt-4" data-aos="slide-left" data-aos-delay="100">Delivering Premium Quality with Care</h3>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="200">
                        Our commitment to quality extends beyond meeting standards—we strive to exceed them. Every garment undergoes meticulous inspection and testing to ensure it meets our exacting requirements for durability, appearance, and performance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Philosophy Section -->
    <section class="manufacturing-philosophy-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="manufacturing-section-title" data-aos="fade-up">Quality Philosophy</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="philosophy-card-title">Excellence in Products</h4>
                        <p class="philosophy-card-text">Delivering superior quality garments that exceed expectations through meticulous attention to detail and craftsmanship.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="philosophy-card-title">Ethical & Responsible Sourcing</h4>
                        <p class="philosophy-card-text">Ensuring all materials and processes align with ethical standards and environmental responsibility.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="philosophy-card-title">Proactive Prevention</h4>
                        <p class="philosophy-card-text">Identifying and addressing potential quality issues before they impact production or delivery.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="400">
                        <h4 class="philosophy-card-title">Continuous Improvement</h4>
                        <p class="philosophy-card-text">Constantly refining processes and techniques to enhance quality and efficiency.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="500">
                        <h4 class="philosophy-card-title">Customer Focus</h4>
                        <p class="philosophy-card-text">Prioritizing customer satisfaction through responsive service and tailored solutions.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="600">
                        <h4 class="philosophy-card-title">Innovation & Technology</h4>
                        <p class="philosophy-card-text">Leveraging cutting-edge technology and innovative methods to achieve superior results.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="700">
                        <h4 class="philosophy-card-title">Team Excellence</h4>
                        <p class="philosophy-card-text">Investing in our team's development to ensure the highest levels of expertise and professionalism.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="philosophy-card" data-aos="fade-up" data-aos-delay="800">
                        <h4 class="philosophy-card-title">Transparency & Accountability</h4>
                        <p class="philosophy-card-text">Maintaining open communication and taking responsibility for every aspect of our operations.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="manufacturing-image-box" data-aos="fade-up">
                        <img src="{{ asset('frontend/assets/excellence/2.jpg') }}" alt="Quality Philosophy" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fair Traceability Section -->
    <section class="manufacturing-traceability-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 manufacturing-traceability-content">
                    <h2 class="manufacturing-section-title" data-aos="slide-right">Fair Traceability</h2>
                    <p class="manufacturing-image-subtitle" data-aos="slide-right" data-aos-delay="100">Real-Time Updates Promote-Transparency, Ethics, and Accountability—Fostering Trust Across the Supply Chain.</p>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="200">
                        Instant Notifications Advance Openness, Morality, and Responsibility—Building Confidence Throughout the Supply Network. We emphasize equitable tracking by delivering instant notifications at each phase of the item path—from basic material procurement to production—guaranteeing moral conduct and supply network responsibility.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-right" data-aos-delay="300">
                        Our traceability system provides complete visibility into the journey of every product, ensuring transparency and accountability at every stage. This commitment to fair traceability builds trust with our partners and customers while promoting ethical practices throughout the supply chain.
                    </p>
                </div>
                <div class="col-lg-6 manufacturing-traceability-image">
                    <div class="traceability-infographic" data-aos="slide-left">
                        <div class="traceability-center">
                            <div class="traceability-icon">📊</div>
                            <h4>TRACEABILITY</h4>
                        </div>
                        <div class="traceability-item traceability-top">Raw Material Sourcing</div>
                        <div class="traceability-item traceability-right-top">Manufacturing</div>
                        <div class="traceability-item traceability-right-bottom">Quality Control</div>
                        <div class="traceability-item traceability-bottom-right">Packaging</div>
                        <div class="traceability-item traceability-bottom-left">Shipping</div>
                        <div class="traceability-item traceability-left-bottom">Delivery</div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="manufacturing-services-quote" data-aos="fade-up">"Trace The Journey, Trust The Process- Where Transparency Meets Fashion !!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Shipping and Logistics Section -->
    <section class="manufacturing-shipping-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 manufacturing-shipping-image">
                    <div class="manufacturing-image-box" data-aos="slide-right">
                        <img src="{{ asset('frontend/assets/product_control5.png') }}" alt="Shipping and Logistics" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 manufacturing-shipping-content">
                    <h2 class="manufacturing-section-title" data-aos="slide-left">Shipping and Logistics</h2>
                    <p class="manufacturing-image-subtitle" data-aos="slide-left" data-aos-delay="100">Seamless Delivery, Global Reach, Streamlined Solutions.</p>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="200">
                        SPM ensures a seamless end-to-end logistics experience through our dedicated in-house shipping and logistics team. We streamline supply chain processes and manage all shipping and forwarder formalities with precision. From manufacturing facilities to global destinations, we oversee every step to guarantee efficient delivery and the highest level of customer satisfaction.
                    </p>
                    <p class="manufacturing-section-text" data-aos="slide-left" data-aos-delay="300">
                        Our comprehensive logistics network spans the globe, enabling us to deliver products to customers worldwide with speed and reliability. We work with trusted shipping partners and maintain strict quality control throughout the shipping process to ensure products arrive in perfect condition.
                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="manufacturing-services-quote" data-aos="fade-up">"Seamless Shipping, Global Reach-Precision in Fashion Supply Chain, Streamlining Solutions for Your Needs."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Quote Section -->
    <section class="manufacturing-bottom-section">
        <div class="manufacturing-bottom-background">
            <img src="{{ asset('frontend/assets/excellence/1.jpeg') }}" alt="Manufacturing Excellence" class="bottom-bg-image">
            <div class="manufacturing-bottom-overlay"></div>
        </div>
        <div class="manufacturing-bottom-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="manufacturing-bottom-text" data-aos="fade-up">
                            We ensure excellence at every stage, from materials sourcing to shipping. Experience our commitment to quality, integrity, and craftsmanship in every thread and stitch.
                        </p>
                        <p class="manufacturing-bottom-quote" data-aos="fade-up" data-aos-delay="200">
                            "Welcome to SPM Limited. Where craftsmanship meets innovation!"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/manufacturing-excellence-script.js') }}"></script>
@endpush
