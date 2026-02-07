<!-- Footer Section -->
<footer class="footer-section" id="footer">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Logo, Description, Social -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="footer-logo">
                    <img src="{{ asset('frontend/assets/logo.png') }}" alt="SPM Limited" height="60" width="200px">
                </div>
                <p class="footer-description">
                    {{ $pageContent->footer_description ?? 'Your Reliable Strategic Ethical & Responsive Global Sourcing and Manufacturing partner' }}
                </p>

                <!-- Social Media -->
                <div class="footer-social">
                    <h4 class="footer-heading">To be Connected with Us</h4>
                    <div class="social-icons">
                        <a href="{{ $pageContent->linkedin_url ?? '#' }}" class="social-icon" aria-label="LinkedIn" target="_blank">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                            </svg>
                        </a>
                        <a href="{{ $pageContent->facebook_url ?? '#' }}" class="social-icon" aria-label="Facebook" target="_blank">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.513c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z"></path>
                            </svg>
                        </a>
                        <a href="{{ $pageContent->twitter_url ?? '#' }}" class="social-icon" aria-label="Twitter" target="_blank">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path>
                            </svg>
                        </a>
                        <a href="{{ $pageContent->youtube_url ?? '#' }}" class="social-icon" aria-label="YouTube" target="_blank">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path>
                            </svg>
                        </a>
                        <a href="{{ $pageContent->instagram_url ?? '#' }}" class="social-icon" aria-label="Instagram" target="_blank">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Contact Button -->
                <div class="footer-contact">
                    <h4 class="footer-heading">TO CONTACT WITH US</h4>
                    <a href="mailto:{{ $pageContent->footer_contact_email ?? 'info@spm.com' }}" class="btn btn-footer-email">E-mail Us</a>
                </div>
            </div>

            <!-- Middle Column - Office Locations -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h4 class="footer-heading-main">Where We Are</h4>

                <!-- Dynamic Office Locations -->
                @forelse($officeLocations as $location)
                <div class="office-location">
                    <h5 class="office-title text-uppercase">{{ $location->name }}</h5>
                    <p class="office-address">
                        {!! nl2br(e($location->address)) !!}
                    </p>
                    @if($location->email)
                    <p class="office-email">Email: <a href="mailto:{{ $location->email }}">{{ $location->email }}</a></p>
                    @endif
                </div>
                @empty
                <!-- Fallback if no locations -->
                <div class="office-location">
                    <h5 class="office-title">OUR GLOBAL PRESENCE</h5>
                    <p class="office-address">
                        Dhaka, Bangladesh
                    </p>
                    <p class="office-email">Email: <a href="mailto:info@spm.com">info@spm.com</a></p>
                </div>
                @endforelse
            </div>

            <!-- Right Column - Quick Links -->
            <div class="col-lg-4 col-md-12">
                <!-- Quick Links -->
                <div class="footer-quick-links">
                    <h4 class="footer-heading-main">QUICK LINK</h4>
                    <ul class="quick-links-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('home') }}#about">About Us</a></li>
                        <li><a href="{{ route('about.board-of-directors') }}">Board of Directors</a></li>
                        <li><a href="{{ route('home') }}#products">Products</a></li>
                        <li><a href="{{ route('home') }}#services">Services</a></li>
                        <li><a href="{{ route('home') }}#footer">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p class="footer-copyright">
                        {{ $pageContent->copyright_text ?? 'Copyright © ' . date('Y') . ' SPM Limited | Powered by SPM Limited' }}
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 text-md-end">
                    <p class="footer-credit">
                        Concept & Content
                        <a style="color:white;text-decoration:none;" href="https://facebook.com/mhmamun6316" target="_blank" rel="noopener noreferrer">
                            @Mehedi Hassan Mamun
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
