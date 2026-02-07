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
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>

                <!-- About Us with Submenu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About Us
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item" href="#">Our History</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('about.board-of-directors') }}">Board of Directors</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">At a Glance</a></li>
                    </ul>
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
                                <a class="dropdown-item dropdown-toggle" href="{{ route('category', \Illuminate\Support\Str::slug($category->name)) }}">
                                    {{ $category->name }}
                                </a>
                                @php
                                    $categoryProducts = $category->products()->where('status', 1)->get();
                                @endphp
                                @if($categoryProducts->count() > 0)
                                <ul class="dropdown-menu">
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
                            <li><a class="dropdown-item" href="#">{{ $service->title }}</a></li>
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
                    <a class="nav-link" href="#">Global Partner</a>
                </li>

                <!-- Contact Us -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
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

    /* Dropdown menu styling */
    #mainNavbar .dropdown-menu {
        background-color: rgba(12, 46, 146, 0.95); /* Primary blue with transparency */
        display: none;
    }

    /* Show dropdown only on direct parent hover */
    #mainNavbar .nav-item.dropdown:hover > .dropdown-menu {
        display: block;
    }

    #mainNavbar .dropdown-item {
        color: #ffffff;
        transition: all 0.3s ease;
    }

    #mainNavbar .dropdown-item:hover,
    #mainNavbar .dropdown-item.active {
        background-color: #7BBC1E; /* Secondary green for hover */
        color: #ffffff;
    }

    /* Submenu styling for Products dropdown */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        margin-top: 0;
        margin-left: 0;
        background-color: rgba(12, 46, 146, 0.95);
    }

    /* Show submenu only when hovering the submenu item */
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }

    .dropdown-submenu > a::after {
        content: " ▶";
        font-size: 0.8em;
        margin-left: 0.5em;
    }

    /* Mobile responsiveness */
    @media (max-width: 991px) {
        #mainNavbar .dropdown-menu {
            position: static !important;
        }
        
        .dropdown-submenu .dropdown-menu {
            position: static !important;
            margin-left: 1rem;
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

    // Handle dropdown hover behavior for desktop
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.nav-item.dropdown');
        
        dropdowns.forEach(dropdown => {
            let hideTimeout;
            
            // Show dropdown on mouseenter
            dropdown.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
                const menu = this.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.display = 'block';
                }
            });
            
            // Hide dropdown on mouseleave with a small delay
            dropdown.addEventListener('mouseleave', function() {
                const menu = this.querySelector('.dropdown-menu');
                hideTimeout = setTimeout(() => {
                    if (menu) {
                        menu.style.display = 'none';
                    }
                }, 100);
            });
        });

        // Handle submenu hover for products
        const submenus = document.querySelectorAll('.dropdown-submenu');
        
        submenus.forEach(submenu => {
            let hideSubmenuTimeout;
            
            submenu.addEventListener('mouseenter', function() {
                clearTimeout(hideSubmenuTimeout);
                const submenuDropdown = this.querySelector('.dropdown-menu');
                if (submenuDropdown) {
                    submenuDropdown.style.display = 'block';
                }
            });
            
            submenu.addEventListener('mouseleave', function() {
                const submenuDropdown = this.querySelector('.dropdown-menu');
                hideSubmenuTimeout = setTimeout(() => {
                    if (submenuDropdown) {
                        submenuDropdown.style.display = 'none';
                    }
                }, 100);
            });
        });
    });
</script>
