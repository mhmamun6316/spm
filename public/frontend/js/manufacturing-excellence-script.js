$(document).ready(function() {
    
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        offset: 100,
        once: true
    });

    // Navbar Scroll Effect - Always scrolled on manufacturing excellence page
    $('#mainNavbar').addClass('scrolled');
    
    $(window).on('scroll', function() {
        // Keep scrolled class always on manufacturing excellence page
        $('#mainNavbar').addClass('scrolled');
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
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

    // Products dropdown hover functionality
    var $productsDropdown = $('.nav-item.dropdown');
    var $dropdownToggle = $productsDropdown.find('.dropdown-toggle');
    var $dropdownMenu = $productsDropdown.find('.dropdown-menu');
    var dropdownTimeout;
    var dropdownInstance;
    var isHoverEnabled = window.innerWidth > 992;

    if ($dropdownToggle.length) {
        dropdownInstance = new bootstrap.Dropdown($dropdownToggle[0]);
    }

    $(window).on('resize', function() {
        isHoverEnabled = window.innerWidth > 992;
    });

    $productsDropdown.on('mouseenter', function() {
        if (isHoverEnabled) {
            clearTimeout(dropdownTimeout);
            if (dropdownInstance) {
                dropdownInstance.show();
            }
        }
    });

    $productsDropdown.on('mouseleave', function() {
        if (isHoverEnabled) {
            var self = this;
            dropdownTimeout = setTimeout(function() {
                if (dropdownInstance) {
                    dropdownInstance.hide();
                }
            }, 200);
        }
    });

    $dropdownMenu.on('mouseenter', function() {
        if (isHoverEnabled) {
            clearTimeout(dropdownTimeout);
        }
    });

    $dropdownMenu.on('mouseleave', function() {
        if (isHoverEnabled) {
            var self = this;
            dropdownTimeout = setTimeout(function() {
                if (dropdownInstance) {
                    dropdownInstance.hide();
                }
            }, 200);
        }
    });

    // Parallax effect for hero section on scroll
    $(window).on('scroll', function() {
        var scrolled = $(window).scrollTop();
        var heroSection = $('.manufacturing-hero-section');
        var heroHeight = heroSection.outerHeight();
        
        if (scrolled < heroHeight) {
            var parallaxSpeed = scrolled * 0.5;
            $('.manufacturing-hero-section .hero-zoom-image').css('transform', 'translateY(' + parallaxSpeed + 'px) scale(' + (1 + scrolled * 0.0003) + ')');
        }
    });

});

