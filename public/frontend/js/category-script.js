$(document).ready(function () {

    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        offset: 100,
        once: true
    });

    // Navbar Scroll Effect - Always scrolled on category page
    $('#mainNavbar').addClass('scrolled');

    $(window).on('scroll', function () {
        // Keep scrolled class always on category page
        $('#mainNavbar').addClass('scrolled');
    });

    // Products dropdown hover functionality (same as main page)
    var $productsDropdown = $('.nav-item.dropdown');
    var $dropdownToggle = $productsDropdown.find('.dropdown-toggle');
    var $dropdownMenu = $productsDropdown.find('.dropdown-menu');
    var dropdownTimeout;
    var dropdownInstance;
    var isHoverEnabled = window.innerWidth > 992;

    if ($dropdownToggle.length) {
        dropdownInstance = new bootstrap.Dropdown($dropdownToggle[0]);
    }

    $(window).on('resize', function () {
        isHoverEnabled = window.innerWidth > 992;
    });

    $productsDropdown.on('mouseenter', function () {
        if (isHoverEnabled) {
            clearTimeout(dropdownTimeout);
            if (dropdownInstance) {
                dropdownInstance.show();
            }
        }
    });

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

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        var target = $(this).attr('href');
        if (target && target !== '#' && $(target).length) {
            e.preventDefault();
            var navbarHeight = $('.navbar').outerHeight();
            var targetPosition = $(target).offset().top - navbarHeight;

            $('html, body').animate({
                scrollTop: targetPosition
            }, 800);
        }
    });

});
