<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top {{ !request()->routeIs('home') ? 'scrolled' : '' }}" id="mainNavbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('frontend/assets/logo.png') }}" alt="SPM Design" height="60" width="100%">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-close">✕</span>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>

                <!-- About Us with Submenu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about.board-of-directors') }}">About Us</a>
                </li>

                <!-- Services -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        @php
                            $navServices = \App\Models\Service::where('is_active', 1)->get();
                        @endphp
                        @forelse($navServices as $service)
                            <li><a class="dropdown-item" href="{{ route('service.show', $service->slug) }}">{{ $service->title }}</a></li>
                            @if(!$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @empty
                            <li><a class="dropdown-item text-muted" href="#">No services available</a></li>
                        @endforelse
                    </ul>
                </li>

                <!-- Global Partner -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#global-partners">Certifications</a>
                </li>

                <!-- Products with Categories and Sub-products -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        @php
                            $navCategories = \App\Models\ProductCategory::where('status', 1)->get();
                        @endphp
                        @forelse($navCategories as $category)
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle-sub" href="{{ route('category', \Illuminate\Support\Str::slug($category->name)) }}">
                                    {{ $category->name }}
                                </a>
                                @php
                                    $categoryProducts = $category->products()->where('status', 1)->get();
                                @endphp
                                @if($categoryProducts->count() > 0)
                                    <ul class="dropdown-menu submenu">
                                        @foreach($categoryProducts as $product)
                                            <li><a class="dropdown-item" href="{{ route('category', \Illuminate\Support\Str::slug($category->name)) }}">{{ $product->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @if(!$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @empty
                            <li><a class="dropdown-item text-muted" href="#">No categories available</a></li>
                        @endforelse
                    </ul>
                </li>

                <!-- Contact Us -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Primary Color: #0C2E92 (Blue) */
    /* Secondary Color: #7BBC1E (Green) */

    #mainNavbar {
        background-color: transparent;
        transition: background-color 0.3s ease;
        z-index: 1030;
    }

    #mainNavbar .navbar-brand,
    #mainNavbar .nav-link {
        color: #ffffff !important;
        transition: color 0.3s ease;
    }

    #mainNavbar .nav-link:hover,
    #mainNavbar .nav-link.active {
        color: #7BBC1E !important; /* Secondary green for hover */
    }

    #mainNavbar.scrolled {
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    #mainNavbar.scrolled .nav-link {
        color: #0C2E92 !important; /* Primary blue when scrolled */
    }

    #mainNavbar.scrolled .nav-link:hover,
    #mainNavbar.scrolled .nav-link.active {
        color: #7BBC1E !important; /* Secondary green for hover */
    }

    /* Dropdown arrow styling - positioned on the right */
    .dropdown-arrow {
        font-size: 0.7em;
        display: inline-block;
        transition: transform 0.3s ease;
        vertical-align: middle;
    }

    .nav-item.dropdown.show .dropdown-arrow {
        transform: rotate(180deg);
    }

    .dropdown-arrow-sub {
        font-size: 0.7em;
        display: inline-block;
        transition: transform 0.3s ease;
        vertical-align: middle;
        float: right;
    }

    .dropdown-submenu.show .dropdown-arrow-sub {
        transform: rotate(180deg);
    }

    /* White dropdown menu styling like the second image */
    #mainNavbar .dropdown-menu {
        background-color: #ffffff !important;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        padding: 10px 0;
        margin-top: 10px;
        min-width: 250px;
    }

    #mainNavbar .dropdown-item {
        color: #333333 !important;
        padding: 10px 20px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 500;
    }

    #mainNavbar .dropdown-item:hover,
    #mainNavbar .dropdown-item:focus {
        background-color: #f5f5f5 !important;
        color: #0C2E92 !important;
    }

    #mainNavbar .dropdown-divider {
        margin: 8px 0;
        border-color: #e0e0e0;
    }

    /* Submenu styling for Products dropdown */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-toggle-sub {
        position: relative;
        padding-right: 40px;
    }

    .dropdown-submenu .submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        margin-top: 0;
        margin-left: 5px;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        min-width: 200px;
    }

    /* Show submenu on hover (desktop only) */
    @media (min-width: 992px) {
        .dropdown-submenu:hover > .submenu {
            display: block;
        }
    }

    /* Mobile toggle button with cross icon */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
        position: relative;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        display: inline-block;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .navbar-toggler-close {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.8rem;
        color: #ffffff;
        font-weight: bold;
        line-height: 1;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    #mainNavbar.scrolled .navbar-toggler-close {
        color: #0C2E92;
    }

    .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
        opacity: 0;
        transform: rotate(90deg);
    }

    .navbar-toggler[aria-expanded="true"] .navbar-toggler-close {
        opacity: 1;
        pointer-events: auto;
    }

    .navbar-toggler[aria-expanded="false"] .navbar-toggler-close {
        opacity: 0;
    }

    /* Mobile responsiveness */
    @media (max-width: 991px) {
        #mainNavbar {
            padding: 0.5rem 0;
        }

        #mainNavbar .container {
            padding-left: 15px;
            padding-right: 15px;
            max-width: 100%;
        }

        #navbarNav {
            max-width: 100%;
            overflow-x: hidden;
            background-color: rgba(12, 46, 146, 0.98) !important; /* Dark blue background for mobile menu initially */
            margin-top: 0.5rem;
            border-radius: 8px;
            padding: 1rem 0;
        }

        /* Remove blue background when navbar is scrolled */
        #mainNavbar.scrolled #navbarNav {
            background-color: rgba(255, 255, 255, 0.98) !important; /* White background when scrolled */
        }

        #navbarNav.show {
            background-color: rgba(12, 46, 146, 0.98) !important; /* Keep dark blue when menu is open (only if not scrolled) */
        }

        #mainNavbar.scrolled #navbarNav.show {
            background-color: rgba(255, 255, 255, 0.98) !important; /* White when scrolled and menu is open */
        }

        .navbar-nav {
            width: 100%;
            max-width: 100%;
            padding: 0;
        }

        .nav-item {
            width: 100%;
            max-width: 100%;
        }

        .nav-link {
            width: 100%;
            padding: 0.75rem 1rem !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #ffffff !important; /* White text on dark blue mobile menu background */
        }

        /* When scrolled, change nav link color to blue */
        #mainNavbar.scrolled .nav-link {
            color: #0C2E92 !important; /* Blue text when scrolled */
        }

        .nav-link:hover,
        .nav-link.active {
            color: #7BBC1E !important; /* Green on hover/active */
        }

        #mainNavbar.scrolled .nav-link:hover,
        #mainNavbar.scrolled .nav-link.active {
            color: #7BBC1E !important; /* Green on hover/active even when scrolled */
        }

        /* Mobile dropdown menus */
        #mainNavbar .dropdown-menu {
            position: static !important;
            float: none;
            width: 100%;
            max-width: 100%;
            margin-top: 0;
            margin-left: 0;
            box-shadow: none;
            border: none;
            background-color: rgba(255, 255, 255, 0.15) !important; /* Light white overlay on dark blue */
            padding-left: 1rem;
        }

        /* When scrolled, make dropdown menu white */
        #mainNavbar.scrolled .dropdown-menu {
            background-color: rgba(245, 245, 245, 0.8) !important; /* Light gray when scrolled */
        }

        .dropdown-submenu .submenu {
            position: static !important;
            margin-left: 1rem;
            margin-top: 0.5rem;
            box-shadow: none;
            background-color: rgba(255, 255, 255, 0.1) !important; /* Even lighter overlay for nested submenu */
        }

        .dropdown-item {
            padding: 8px 15px !important;
            font-size: 0.9rem;
            word-wrap: break-word;
            white-space: normal;
            color: #ffffff !important; /* White text on dark blue background */
        }

        /* When scrolled, change dropdown item color to dark */
        #mainNavbar.scrolled .dropdown-item {
            color: #333333 !important; /* Dark text when scrolled */
        }

        .dropdown-item:hover {
            background-color: rgba(123, 188, 30, 0.3) !important; /* Green hover on dark blue */
            color: #ffffff !important;
        }

        #mainNavbar.scrolled .dropdown-item:hover {
            background-color: #f5f5f5 !important; /* Light gray hover when scrolled */
            color: #0C2E92 !important; /* Blue text on hover when scrolled */
        }

        .dropdown-arrow,
        .dropdown-arrow-sub {
            font-size: 0.6em;
        }
    }

    /* Prevent horizontal scroll */
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }

    /* Desktop hover behavior */
    @media (min-width: 992px) {
        #mainNavbar {
            background-color: transparent; /* Keep transparent on desktop initially */
        }

        #mainNavbar .nav-item.dropdown:hover > .dropdown-menu {
            display: block;
        }
    }
</style>

<script>
    // Add scroll listener to change navbar styling
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        // Only toggle scrolled class if on home page
        @if(request()->routeIs('home'))
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        @endif
    });

    // Handle dropdown hover behavior and mobile interactions
    document.addEventListener('DOMContentLoaded', function() {
        const isDesktop = window.innerWidth >= 992;
        const navbar = document.getElementById('navbarNav');
        const navbarToggler = document.querySelector('.navbar-toggler');

        // Update desktop check on resize
        window.addEventListener('resize', function() {
            const wasDesktop = window.innerWidth >= 992;
            if (wasDesktop !== isDesktop) {
                location.reload(); // Reload to reset Bootstrap state
            }
        });

        // Handle mobile toggle button cross icon
        if (navbarToggler) {
            navbarToggler.addEventListener('click', function() {
                // Bootstrap handles the aria-expanded attribute
                // CSS will show/hide the cross icon based on this
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                if (!navbar.contains(e.target) && !navbarToggler.contains(e.target)) {
                    if (navbar.classList.contains('show')) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbar);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    }
                }
            }
        });

        // Handle dropdown hover behavior for desktop only
        if (isDesktop) {
            const dropdowns = document.querySelectorAll('.nav-item.dropdown');

            dropdowns.forEach(dropdown => {
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                let hideTimeout;

                // Prevent Bootstrap's default click behavior on desktop (use hover instead)
                if (dropdownToggle) {
                    dropdownToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                }

                // Show dropdown on mouseenter
                dropdown.addEventListener('mouseenter', function() {
                    clearTimeout(hideTimeout);
                    if (menu) {
                        menu.style.display = 'block';
                        dropdown.classList.add('show');
                        if (dropdownToggle) {
                            dropdownToggle.setAttribute('aria-expanded', 'true');
                        }
                    }
                });

                // Hide dropdown on mouseleave with a small delay
                dropdown.addEventListener('mouseleave', function() {
                    hideTimeout = setTimeout(() => {
                        if (menu) {
                            menu.style.display = 'none';
                            dropdown.classList.remove('show');
                            if (dropdownToggle) {
                                dropdownToggle.setAttribute('aria-expanded', 'false');
                            }
                        }
                    }, 150);
                });
            });

            // Handle submenu hover for products
            const submenus = document.querySelectorAll('.dropdown-submenu');

            submenus.forEach(submenu => {
                let hideSubmenuTimeout;

                submenu.addEventListener('mouseenter', function() {
                    clearTimeout(hideSubmenuTimeout);
                    const submenuDropdown = this.querySelector('.submenu');
                    if (submenuDropdown) {
                        submenuDropdown.style.display = 'block';
                        this.classList.add('show');
                    }
                });

                submenu.addEventListener('mouseleave', function() {
                    const submenuDropdown = this.querySelector('.submenu');
                    hideSubmenuTimeout = setTimeout(() => {
                        if (submenuDropdown) {
                            submenuDropdown.style.display = 'none';
                            this.classList.remove('show');
                        }
                    }, 150);
                });
            });
        } else {
            // Mobile: Handle submenu clicks
            const submenuToggles = document.querySelectorAll('.dropdown-toggle-sub');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const submenuItem = this.closest('.dropdown-submenu');
                    const submenu = submenuItem.querySelector('.submenu');

                    // Close other submenus
                    document.querySelectorAll('.dropdown-submenu').forEach(item => {
                        if (item !== submenuItem) {
                            item.classList.remove('show');
                            const otherSubmenu = item.querySelector('.submenu');
                            if (otherSubmenu) {
                                otherSubmenu.style.display = 'none';
                            }
                        }
                    });

                    // Toggle current submenu
                    submenuItem.classList.toggle('show');
                    if (submenu) {
                        if (submenuItem.classList.contains('show')) {
                            submenu.style.display = 'block';
                        } else {
                            submenu.style.display = 'none';
                        }
                    }
                });
            });
        }

        // Prevent horizontal scroll
        function preventHorizontalScroll() {
            document.body.style.overflowX = 'hidden';
            document.documentElement.style.overflowX = 'hidden';
        }
        preventHorizontalScroll();
        window.addEventListener('resize', preventHorizontalScroll);
    });
</script>
