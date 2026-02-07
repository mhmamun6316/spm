$(document).ready(function () {

    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        offset: 100,
        once: true
    });

    // Navbar Scroll Effect
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 50) {
            $('#mainNavbar').addClass('scrolled');
        } else {
            $('#mainNavbar').removeClass('scrolled');
        }
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();

        var target = $(this).attr('href');
        var $target = $(target);

        if ($target.length) {
            var navbarHeight = $('.navbar').outerHeight();
            var targetPosition = $target.offset().top - navbarHeight;

            $('html, body').animate({
                scrollTop: targetPosition
            }, 800);

            // Close mobile menu if open
            var $navbarCollapse = $('.navbar-collapse');
            if ($navbarCollapse.hasClass('show')) {
                $navbarCollapse.collapse('hide');
            }
        }
    });

    // Video autoplay fallback for mobile devices
    var video = $('#heroVideo')[0];

    if (video) {
        // Try to play the video (some browsers block autoplay)
        var playPromise = video.play();

        if (playPromise !== undefined) {
            playPromise.catch(function (error) {
                console.log('Autoplay was prevented:', error);
                // You could add a play button overlay here if needed
            });
        }
    }

    // Add active class to current nav item based on scroll position
    $(window).on('scroll', function () {
        var current = '';

        $('section[id]').each(function () {
            var sectionTop = $(this).offset().top;
            var sectionHeight = $(this).outerHeight();

            if ($(window).scrollTop() >= (sectionTop - 200)) {
                current = $(this).attr('id');
            }
        });

        // Remove active from all nav links first
        $('.nav-link').removeClass('active');

        // Add active to matching nav link
        $('.nav-link').each(function () {
            var href = $(this).attr('href');
            if (href && href === '#' + current) {
                $(this).addClass('active');
            }
        });

        // Handle dropdown parent active state for Products
        if (current === 'products') {
            $('#productsDropdown').addClass('active');
        } else {
            $('#productsDropdown').removeClass('active');
        }
    });

    // Initialize Swiper for Certificates - Top Row (Right to Left)
    if ($('.certificates-swiper-top').length) {
        var swiperTop = new Swiper('.certificates-swiper-top', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            speed: 2000,
            direction: 'horizontal',
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    }

    // Initialize Swiper for Certificates - Bottom Row (Left to Right - Reversed)
    if ($('.certificates-swiper-bottom').length) {
        var swiperBottom = new Swiper('.certificates-swiper-bottom', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
                reverseDirection: true,
            },
            speed: 2000,
            direction: 'horizontal',
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    }

    // Initialize Category Swipers dynamically (finds all category swipers on the page)
    var categorySwipers = document.querySelectorAll('[class*="category-swiper-"]');
    categorySwipers.forEach(function (swiperEl) {
        // Extract the swiper number from the class name
        var classes = swiperEl.className.split(' ');
        var swiperClass = classes.find(function (c) { return c.match(/category-swiper-\d+/); });
        if (swiperClass) {
            var index = swiperClass.replace('category-swiper-', '');
            new Swiper(`.category-swiper-${index}`, {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: `.category-next-${index}`,
                    prevEl: `.category-prev-${index}`,
                },
                pagination: {
                    el: `.category-pagination-${index}`,
                    clickable: true,
                },
            });
        }
    });

    // Products dropdown hover functionality
    var $productsDropdown = $('.nav-item.dropdown');
    var $dropdownToggle = $productsDropdown.find('.dropdown-toggle');
    var $dropdownMenu = $productsDropdown.find('.dropdown-menu');
    var dropdownTimeout;
    var dropdownInstance;
    var isHoverEnabled = window.innerWidth > 992; // Enable hover only on desktop

    // Initialize dropdown instance
    if ($dropdownToggle.length) {
        dropdownInstance = new bootstrap.Dropdown($dropdownToggle[0]);
    }

    // Handle window resize
    $(window).on('resize', function () {
        isHoverEnabled = window.innerWidth > 992;
    });

    // Show dropdown on hover (desktop only)
    $productsDropdown.on('mouseenter', function () {
        if (isHoverEnabled) {
            clearTimeout(dropdownTimeout);
            if (dropdownInstance) {
                dropdownInstance.show();
            }
        }
    });

    // Hide dropdown on leave with delay (desktop only)
    $productsDropdown.on('mouseleave', function () {
        if (isHoverEnabled) {
            var self = this;
            dropdownTimeout = setTimeout(function () {
                if (dropdownInstance) {
                    dropdownInstance.hide();
                }
            }, 200);
        }
    });

    // Keep dropdown open when hovering over menu (desktop only)
    $dropdownMenu.on('mouseenter', function () {
        if (isHoverEnabled) {
            clearTimeout(dropdownTimeout);
        }
    });

    $dropdownMenu.on('mouseleave', function () {
        if (isHoverEnabled) {
            var self = this;
            dropdownTimeout = setTimeout(function () {
                if (dropdownInstance) {
                    dropdownInstance.hide();
                }
            }, 200);
        }
    });

    // About Us Carousel Text Animation
    var aboutCarousel = document.getElementById('aboutCarousel');
    if (aboutCarousel) {
        // Function to trigger animations
        function triggerCarouselAnimations() {
            var activeSlide = aboutCarousel.querySelector('.carousel-item.active');
            if (activeSlide) {
                var title = activeSlide.querySelector('.carousel-title');
                var subtitle = activeSlide.querySelector('.carousel-subtitle');

                if (title) {
                    title.style.animation = 'none';
                    setTimeout(function () {
                        title.style.animation = 'fadeInUp 0.8s ease-out 0.3s forwards';
                    }, 10);
                }

                if (subtitle) {
                    subtitle.style.animation = 'none';
                    setTimeout(function () {
                        subtitle.style.animation = 'fadeInUp 0.8s ease-out 0.6s forwards';
                    }, 10);
                }
            }
        }

        // Trigger animation on initial load
        setTimeout(function () {
            triggerCarouselAnimations();
        }, 300);

        aboutCarousel.addEventListener('slide.bs.carousel', function (e) {
            // Reset animations for all slides
            var allTitles = aboutCarousel.querySelectorAll('.carousel-title');
            var allSubtitles = aboutCarousel.querySelectorAll('.carousel-subtitle');

            allTitles.forEach(function (title) {
                title.style.animation = 'none';
                title.style.opacity = '0';
                title.style.transform = 'translateY(20px)';
            });

            allSubtitles.forEach(function (subtitle) {
                subtitle.style.animation = 'none';
                subtitle.style.opacity = '0';
                subtitle.style.transform = 'translateY(20px)';
            });
        });

        aboutCarousel.addEventListener('slid.bs.carousel', function (e) {
            // Trigger animations for new active slide
            setTimeout(function () {
                triggerCarouselAnimations();
            }, 50);
        });
    }

    // Newsletter Form Submission
    $('#newsletterForm').on('submit', function (e) {
        e.preventDefault();
        var email = $(this).find('input[type="email"]').val();

        if (email) {
            // Here you would typically send the email to your server
            // For now, we'll just show an alert
            alert('Thank you for subscribing! We will send updates to ' + email);
            $(this).find('input[type="email"]').val('');
        }
    });

    // Category Products Data
    var categoryProducts = {
        'knit': [
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Knit Product 1', subtitle: 'Premium Quality Knitwear' },
            { image: 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&h=1000&fit=crop', title: 'Knit Product 2', subtitle: 'Comfortable & Stylish' },
            { image: 'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=800&h=1000&fit=crop', title: 'Knit Product 3', subtitle: 'Modern Design' },
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Knit Product 4', subtitle: 'Classic Collection' }
        ],
        'women': [
            { image: 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&h=1000&fit=crop', title: 'Women Product 1', subtitle: 'Elegant Design' },
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Women Product 2', subtitle: 'Fashion Forward' },
            { image: 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=800&h=1000&fit=crop', title: 'Women Product 3', subtitle: 'Trendy Collection' }
        ],
        'nightwear and loungewear': [
            { image: 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=800&h=1000&fit=crop', title: 'Nightwear Product 1', subtitle: 'Comfortable Sleepwear' },
            { image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&h=1000&fit=crop', title: 'Nightwear Product 2', subtitle: 'Cozy Loungewear' },
            { image: 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?w=800&h=1000&fit=crop', title: 'Nightwear Product 3', subtitle: 'Relaxed Fit' }
        ],
        'denim': [
            { image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&h=1000&fit=crop', title: 'Denim Product 1', subtitle: 'Classic Denim' },
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Denim Product 2', subtitle: 'Vintage Style' },
            { image: 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&h=1000&fit=crop', title: 'Denim Product 3', subtitle: 'Modern Fit' }
        ],
        'shirts': [
            { image: 'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=800&h=1000&fit=crop', title: 'Shirt Product 1', subtitle: 'Formal Shirt' },
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Shirt Product 2', subtitle: 'Casual Style' },
            { image: 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&h=1000&fit=crop', title: 'Shirt Product 3', subtitle: 'Premium Quality' }
        ],
        'pants': [
            { image: 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?w=800&h=1000&fit=crop', title: 'Pants Product 1', subtitle: 'Slim Fit' },
            { image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&h=1000&fit=crop', title: 'Pants Product 2', subtitle: 'Comfortable Fit' },
            { image: 'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=800&h=1000&fit=crop', title: 'Pants Product 3', subtitle: 'Classic Style' }
        ],
        't-shirts': [
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'T-Shirt Product 1', subtitle: 'Cotton Blend' },
            { image: 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?w=800&h=1000&fit=crop', title: 'T-Shirt Product 2', subtitle: 'Comfortable Fit' },
            { image: 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=800&h=1000&fit=crop', title: 'T-Shirt Product 3', subtitle: 'Casual Style' }
        ],
        'dresses': [
            { image: 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800&h=1000&fit=crop', title: 'Dress Product 1', subtitle: 'Elegant Design' },
            { image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=1000&fit=crop', title: 'Dress Product 2', subtitle: 'Party Wear' },
            { image: 'https://images.unsplash.com/photo-1603252109303-2751441dd157?w=800&h=1000&fit=crop', title: 'Dress Product 3', subtitle: 'Casual Dress' }
        ],
        'jackets': [
            { image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800&h=1000&fit=crop', title: 'Jacket Product 1', subtitle: 'Winter Jacket' },
            { image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&h=1000&fit=crop', title: 'Jacket Product 2', subtitle: 'Leather Jacket' },
            { image: 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?w=800&h=1000&fit=crop', title: 'Jacket Product 3', subtitle: 'Casual Jacket' }
        ],
        'activewear': [
            { image: 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=800&h=1000&fit=crop', title: 'Activewear Product 1', subtitle: 'Sportswear' },
            { image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800&h=1000&fit=crop', title: 'Activewear Product 2', subtitle: 'Gym Wear' },
            { image: 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=800&h=1000&fit=crop', title: 'Activewear Product 3', subtitle: 'Athletic Wear' }
        ],
        'accessories': [
            { image: 'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?w=800&h=1000&fit=crop', title: 'Accessory Product 1', subtitle: 'Fashion Accessories' },
            { image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=1000&fit=crop', title: 'Accessory Product 2', subtitle: 'Stylish Design' },
            { image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800&h=1000&fit=crop', title: 'Accessory Product 3', subtitle: 'Premium Quality' }
        ],
        'footwear': [
            { image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=1000&fit=crop', title: 'Footwear Product 1', subtitle: 'Comfortable Shoes' },
            { image: 'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?w=800&h=1000&fit=crop', title: 'Footwear Product 2', subtitle: 'Sport Shoes' },
            { image: 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=800&h=1000&fit=crop', title: 'Footwear Product 3', subtitle: 'Casual Footwear' }
        ]
    };

    // Make category cards clickable - navigate to category page
    $('.category-card').on('click', function () {
        var categoryName = $(this).find('.category-name').text().toLowerCase();
        // Navigate to category page
        window.location.href = 'category.html?category=' + encodeURIComponent(categoryName);
    });

});
