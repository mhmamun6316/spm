@extends('layouts.frontend')

@section('title', 'Contact Us - SPM')

@section('content')
<section class="contact-section" style="background-color: #f5f5f5; padding: 100px 0; min-height: 80vh;">
    <div class="container">
        <div class="row align-items-center">
            {{-- Left Column: Information with Dotted Pattern --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="contact-info-wrapper" style="position: relative; padding: 40px;">
                    <div class="contact-info-content" style="position: relative; z-index: 2;">
                        <h2 class="contact-heading mb-4" style="color: #0C2E92; font-weight: 700; font-size: 2.5rem; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 2px solid #e0e0e0;">
                            Make an appointment!
                        </h2>
                        <div class="contact-text" style="color: #666666; line-height: 1.8; font-size: 1rem;">
                            <p class="mb-4" style="margin-bottom: 25px;">
                                Schedule a free consultation with our team to discuss your specific requirements and learn more about how we can help you. Our experts will work with you to find customized solutions to meet your goals.
                            </p>
                            <p class="mb-4" style="margin-bottom: 25px;">
                                Our experienced professionals work closely with our clients to provide them with customized solutions for their specific needs, helping them achieve their goals and grow together.
                            </p>
                            <p style="margin-bottom: 0;">
                                Thank you for considering us, and we look forward to hearing from you soon!
                            </p>
                        </div>
                    </div>
                    {{-- Dotted Pattern Background --}}
                    <div class="dotted-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(circle, #d0d0d0 1.5px, transparent 1.5px); background-size: 25px 25px; opacity: 0.4; z-index: 1; pointer-events: none;"></div>
                </div>
            </div>

            {{-- Right Column: Contact Form --}}
            <div class="col-lg-6">
                <div class="contact-form-wrapper" style="background-color: #ffffff; padding: 50px 40px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);">
                    <h2 class="contact-heading mb-4" style="color: #0C2E92; font-weight: 700; font-size: 2.5rem; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 2px solid #e0e0e0;">
                        Say Hello! Its Free
                    </h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 5px;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 5px;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label" style="color: #666666; font-weight: 500; margin-bottom: 8px; font-size: 0.95rem;">Your name <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ old('name') }}" required style="border: 1px solid #e0e0e0; border-radius: 5px; padding: 12px 15px; font-size: 0.95rem; color: #333; background-color: #ffffff;">
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label" style="color: #666666; font-weight: 500; margin-bottom: 8px; font-size: 0.95rem;">Phone no <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Phone no" value="{{ old('phone') }}" required style="border: 1px solid #e0e0e0; border-radius: 5px; padding: 12px 15px; font-size: 0.95rem; color: #333; background-color: #ffffff;">
                                @error('phone')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label" style="color: #666666; font-weight: 500; margin-bottom: 8px; font-size: 0.95rem;">Your Work Email <span style="color: #dc3545;">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your Work Email" value="{{ old('email') }}" required style="border: 1px solid #e0e0e0; border-radius: 5px; padding: 12px 15px; font-size: 0.95rem; color: #333; background-color: #ffffff;">
                                @error('email')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="company_name" class="form-label" style="color: #666666; font-weight: 500; margin-bottom: 8px; font-size: 0.95rem;">Company name <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" placeholder="Company name" value="{{ old('company_name') }}" required style="border: 1px solid #e0e0e0; border-radius: 5px; padding: 12px 15px; font-size: 0.95rem; color: #333; background-color: #ffffff;">
                                @error('company_name')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label" style="color: #666666; font-weight: 500; margin-bottom: 8px; font-size: 0.95rem;">Any Special Note</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Any Special Note" style="border: 1px solid #e0e0e0; border-radius: 5px; padding: 12px 15px; font-size: 0.95rem; color: #333; background-color: #ffffff; resize: vertical;">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3" style="background-color: #0C2E92; border: none; border-radius: 5px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.95rem; transition: all 0.3s ease;">
                                SEND MESSAGE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-section {
        position: relative;
    }

    .form-control::placeholder {
        color: #999999;
        opacity: 1;
    }

    .form-control:focus {
        border-color: #0C2E92;
        box-shadow: 0 0 0 0.2rem rgba(12, 46, 146, 0.15);
        outline: none;
    }

    .form-control {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0a2569 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(12, 46, 146, 0.3);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    @media (max-width: 992px) {
        .contact-section {
            padding: 60px 0 !important;
        }

        .contact-form-wrapper {
            padding: 40px 30px !important;
            margin-top: 30px;
        }

        .contact-heading {
            font-size: 2rem !important;
        }
    }

    @media (max-width: 768px) {
        .contact-form-wrapper {
            padding: 30px 20px !important;
        }

        .contact-heading {
            font-size: 1.75rem !important;
        }

        .contact-info-wrapper {
            padding: 30px 20px !important;
        }
    }
</style>
@endsection
