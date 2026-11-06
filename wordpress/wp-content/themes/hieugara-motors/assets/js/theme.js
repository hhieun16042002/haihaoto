/**
 * Hiếu Gara Motors - Main JavaScript
 * Standard: CARPLA SERVICE Platform (Single-Line Nav, Hero Command Console, Multi-Step Wizard)
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // ==========================================================================
        // 0. Turbo Navigation Progress Bar
        // ==========================================================================
        $(document).on('click', 'a', function() {
            var href = $(this).attr('href');
            var target = $(this).attr('target');
            if (!href || href.indexOf('#') === 0 || href.indexOf('tel:') === 0 || href.indexOf('mailto:') === 0 || href.indexOf('javascript:') === 0 || target === '_blank') {
                return;
            }
            if (this.origin === location.origin && this.pathname !== location.pathname) {
                $('#shiftupPageLoader').addClass('is-loading');
            }
        });
        window.addEventListener('pageshow', function() {
            $('#shiftupPageLoader').removeClass('is-loading');
        });

        // ==========================================================================
        // 1. Sticky Navigation Bar & Mobile Drawer
        // ==========================================================================
        var $mainNav = $('#mainStickyNavbar');
        var navOffsetTop = $mainNav.length ? $mainNav.offset().top : 100;

        $(window).on('scroll', function() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos > 120) {
                $mainNav.addClass('is-sticky');
            } else {
                $mainNav.removeClass('is-sticky');
            }
        });

        // Mobile Navigation Toggle & Drawer Controller
        function toggleMobileNav(open) {
            var $nav = $('#mainStickyNavbar');
            var $backdrop = $('#mobileNavBackdrop');
            var $toggle = $('.mobile-nav-toggle');
            var shouldOpen = (open !== undefined) ? open : !$nav.hasClass('mobile-nav-open');

            if (shouldOpen) {
                $nav.addClass('mobile-nav-open');
                $backdrop.addClass('is-visible');
                $toggle.addClass('is-active');
                $('body').addClass('mobile-menu-active');
            } else {
                $nav.removeClass('mobile-nav-open');
                $backdrop.removeClass('is-visible');
                $toggle.removeClass('is-active');
                $('body').removeClass('mobile-menu-active');
            }
        }

        $('.mobile-nav-toggle').on('click', function(e) {
            e.preventDefault();
            toggleMobileNav();
        });

        $('#mobileNavBackdrop, #mobileDrawerCloseBtn').on('click', function(e) {
            e.preventDefault();
            toggleMobileNav(false);
        });

        // Mobile Submenu Accordion (Click on item with dropdown on screens <= 992px)
        $(document).on('click', '.custom-nav-menu .has-dropdown > a', function(e) {
            if ($(window).width() <= 992) {
                var $parent = $(this).parent('.has-dropdown');
                if (!$parent.hasClass('open-submenu')) {
                    e.preventDefault();
                    $('.has-dropdown').not($parent).removeClass('open-submenu');
                    $parent.addClass('open-submenu');
                } else if ($(e.target).closest('.nav-caret').length) {
                    e.preventDefault();
                    $parent.removeClass('open-submenu');
                }
            }
        });

        // ==========================================================================
        // 2. LEXUS VIETNAM LUXURY BANNER SLIDER ENGINE
        // ==========================================================================
        var lexusCurrentSlide = 0;
        var $lexusSlides = $('.lexus-slide');
        var $lexusDashes = $('.lexus-dash-item');
        var totalLexusSlides = $lexusSlides.length;
        var lexusSliderTimer = null;
        var slideDuration = 6500; // 6.5s per slide

        function showLexusSlide(idx) {
            if (totalLexusSlides <= 1) return;
            if (idx >= totalLexusSlides) idx = 0;
            if (idx < 0) idx = totalLexusSlides - 1;
            lexusCurrentSlide = idx;

            // Transition slide
            $lexusSlides.removeClass('active');
            $lexusSlides.eq(lexusCurrentSlide).addClass('active');

            // Update dash pagination & restart progress bar animation
            $lexusDashes.removeClass('active');
            var $activeDash = $lexusDashes.eq(lexusCurrentSlide);
            $activeDash.addClass('active');

            // Force restart css progress fill animation
            var $fill = $activeDash.find('.dash-progress-fill');
            if ($fill.length) {
                var $clone = $fill.clone(true);
                $fill.replaceWith($clone);
            }
        }

        function startLexusSlider() {
            if (totalLexusSlides <= 1) return;
            clearInterval(lexusSliderTimer);
            lexusSliderTimer = setInterval(function() {
                showLexusSlide(lexusCurrentSlide + 1);
            }, slideDuration);
        }

        if (totalLexusSlides > 0) {
            startLexusSlider();

            $('#lexusPrevBtn').on('click', function(e) {
                e.preventDefault();
                clearInterval(lexusSliderTimer);
                showLexusSlide(lexusCurrentSlide - 1);
                startLexusSlider();
            });

            $('#lexusNextBtn').on('click', function(e) {
                e.preventDefault();
                clearInterval(lexusSliderTimer);
                showLexusSlide(lexusCurrentSlide + 1);
                startLexusSlider();
            });

            $('.lexus-dash-item').on('click', function(e) {
                e.preventDefault();
                var targetIdx = parseInt($(this).attr('data-to'), 10);
                clearInterval(lexusSliderTimer);
                showLexusSlide(targetIdx);
                startLexusSlider();
            });

            // Pause on hover
            $('#lexusHeroSlider').on('mouseenter', function() {
                clearInterval(lexusSliderTimer);
            }).on('mouseleave', function() {
                startLexusSlider();
            });

            // Touch Swipe Support
            var touchStartX = 0;
            var touchEndX = 0;
            var heroElem = document.getElementById('lexusHeroSlider');
            if (heroElem) {
                heroElem.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                heroElem.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    if (touchStartX - touchEndX > 50) {
                        // Swipe left -> Next slide
                        clearInterval(lexusSliderTimer);
                        showLexusSlide(lexusCurrentSlide + 1);
                        startLexusSlider();
                    } else if (touchEndX - touchStartX > 50) {
                        // Swipe right -> Prev slide
                        clearInterval(lexusSliderTimer);
                        showLexusSlide(lexusCurrentSlide - 1);
                        startLexusSlider();
                    }
                }, { passive: true });
            }
        }

        // ==========================================================================
        // 2B. ALL ABOUT CARS SWIPER CAROUSEL (ShiftUp Interactive Slider Replica)
        // With Mousewheel horizontal scrolling, Touch Drag & Prev/Next Arrows
        // ==========================================================================
        if ($('.all-about-swiper').length) {
            if (typeof Swiper !== 'undefined') {
                var allAboutSwiper = new Swiper('.all-about-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    loop: true,
                    grabCursor: true,
                    watchSlidesProgress: true,
                    speed: 650,
                    mousewheel: {
                        forceToAxis: true,
                        sensitivity: 1,
                        releaseOnEdges: true,
                    },
                    autoplay: {
                        delay: 4500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        prevEl: '#allCarsPrevBtn',
                        nextEl: '#allCarsNextBtn',
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 22
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 28
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 32
                        }
                    }
                });

                // Smooth wheel response directly forwarding to Swiper
                var swiperElem = document.querySelector('.all-about-swiper');
                if (swiperElem) {
                    swiperElem.addEventListener('wheel', function(e) {
                        if (Math.abs(e.deltaY) > 25) {
                            if (e.deltaY > 0) {
                                allAboutSwiper.slideNext();
                            } else {
                                allAboutSwiper.slidePrev();
                            }
                        }
                    }, { passive: true });
                }
            } else {
                // Fallback scroll
                $('#allCarsPrevBtn').on('click', function(e) {
                    e.preventDefault();
                    var $track = $('#allCarsTrack');
                    $track.animate({ scrollLeft: $track.scrollLeft() - 320 }, 300);
                });
                $('#allCarsNextBtn').on('click', function(e) {
                    e.preventDefault();
                    var $track = $('#allCarsTrack');
                    $track.animate({ scrollLeft: $track.scrollLeft() + 320 }, 300);
                });
            }
        }

        // ==========================================================================
        // 2C. FLANKED DIAGNOSTICS INTERACTION
        // ==========================================================================
        $('.flanked-diag-item').on('mouseenter click', function() {
            $('.flanked-diag-item').removeClass('active');
            $(this).addClass('active');

            // Quick surge pulse on center scanner laser
            $('.scanner-laser-bar').css('animation-duration', '1.2s');
            setTimeout(function() {
                $('.scanner-laser-bar').css('animation-duration', '2.6s');
            }, 1200);
        });

        // Trigger Hero Slider Entrance on Load
        setTimeout(function() {
            $('#shiftupHero').addClass('hero-appeared');
        }, 80);

        // ==========================================================================
        // 2D. FULL-PAGE BIDIRECTIONAL SCROLL ANIMATION SUITE (ShiftUp Interactive)
        // Re-triggers animations seamlessly in BOTH directions (scroll down & scroll up)
        // ==========================================================================
        var animatedSections = document.querySelectorAll(
            '.shiftup-tuning-shop-section, .shiftup-technicians-section, ' +
            '.shiftup-all-about-cars-section, .shiftup-panoramic-banners, ' +
            '.shiftup-flanked-diagnostics, .shiftup-accessories-section, .shiftup-checkup-offers-section, ' +
            '.shiftup-brand-marquee-section, .shiftup-workshops-booking-section, ' +
            '.shiftup-workshops-section, .shiftup-main-footer'
        );

        if ('IntersectionObserver' in window && animatedSections.length) {
            $('.shiftup-main-footer').addClass('anim-ready');
            var bidirectionalObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    var target = entry.target;
                    if (entry.isIntersecting) {
                        target.classList.add('is-inview');
                        if (target.classList.contains('shiftup-technicians-section')) {
                            target.classList.add('is-appeared');
                        }
                    } else {
                        // Crucial: Remove classes when leaving viewport so scrolling BACK UP re-triggers the animations!
                        var rect = target.getBoundingClientRect();
                        var winH = window.innerHeight || document.documentElement.clientHeight;
                        // Reset if element is substantially off-screen (above or below)
                        if (rect.bottom < -60 || rect.top > winH + 60) {
                            target.classList.remove('is-inview');
                            if (target.classList.contains('shiftup-technicians-section')) {
                                target.classList.remove('is-appeared');
                            }
                        }
                    }
                });
            }, {
                threshold: [0, 0.12, 0.25],
                rootMargin: '10px 0px -40px 0px'
            });

            animatedSections.forEach(function(section) {
                bidirectionalObserver.observe(section);
            });
        }

        // Secondary fallback and scroll velocity tracking
        var lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        $(window).on('scroll.bidirectionalNav', function() {
            var currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
            if (currentScrollY > lastScrollY) {
                $('body').addClass('scrolling-down').removeClass('scrolling-up');
            } else if (currentScrollY < lastScrollY) {
                $('body').addClass('scrolling-up').removeClass('scrolling-down');
            }
            lastScrollY = currentScrollY;
        });

        // Diagnostic items interaction
        $('.diag-item').on('mouseenter click', function() {
            $('.diag-item').removeClass('active');
            $(this).addClass('active');
        });

        // Quick sample plate click
        $('.sample-plate-pill').on('click', function(e) {
            e.preventDefault();
            var plate = $(this).attr('data-plate');
            $('#shiftup-plate-input').val(plate);
            $('#shiftup-plate-search-form').trigger('submit');
        });

        // ShiftUp Plate Search submission
        $('#shiftup-plate-search-form').on('submit', function(e) {
            e.preventDefault();
            var plate = $('#shiftup-plate-input').val().trim();
            if (!plate) return;
            window.location.href = '/tra-cuu-bao-hanh/?plate=' + encodeURIComponent(plate);
        });

        // Legacy Ha Thanh slider support (if present)
        var $slides = $('.ht-slide');
        var $dots = $('.ht-dot');
        var totalSlides = $slides.length;
        var sliderTimer = null;

        function showSlide(idx) {
            if (totalSlides <= 1) return;
            if (idx >= totalSlides) idx = 0;
            if (idx < 0) idx = totalSlides - 1;
            $slides.removeClass('active').eq(idx).addClass('active');
            $dots.removeClass('active').eq(idx).addClass('active');
        }

        if (totalSlides > 0) {
            sliderTimer = setInterval(function() { showSlide((currentSlide + 1) % totalSlides); }, 5500);
            $('.ht-slider-prev').on('click', function(e) { e.preventDefault(); showSlide(currentSlide - 1); });
            $('.ht-slider-next').on('click', function(e) { e.preventDefault(); showSlide(currentSlide + 1); });
            $('.ht-dot').on('click', function(e) { e.preventDefault(); showSlide(parseInt($(this).attr('data-slide'), 10)); });
        }

        // ==========================================================================
        // 2B. FLOATING DUAL-ACTION ENGINE DOCK (TỰ ĐỘNG NỔI TRÊN CHÂN HERO)
        // ==========================================================================
        $('.ht-dock-tab').on('click', function(e) {
            e.preventDefault();
            var dockKey = $(this).attr('data-dock');

            $('.ht-dock-tab').removeClass('active');
            $(this).addClass('active');

            if (dockKey === 'book') {
                $('#dockPaneBook').show();
                $('#dockPaneLookup').hide();
                $('#dockPaneEstimate').hide();
            } else if (dockKey === 'lookup') {
                $('#dockPaneBook').hide();
                $('#dockPaneLookup').show();
                $('#dockPaneEstimate').hide();
            } else if (dockKey === 'estimate') {
                $('#dockPaneBook').hide();
                $('#dockPaneLookup').hide();
                $('#dockPaneEstimate').show();
            }
        });

        // Sample plate tag click in dock
        $('.ht-sample-tag').on('click', function(e) {
            e.preventDefault();
            var plate = $(this).attr('data-plate');
            $('#dockPlateInput').val(plate);
        });

        // ==========================================================================
        // 3. Booking Wizard Steps (page-dat-lich.php)
        // ==========================================================================
        $('.service-radio-card input[type="radio"]').on('change', function() {
            $('.service-radio-card').removeClass('is-selected');
            $(this).closest('.service-radio-card').addClass('is-selected');
        });

        $('.btn-next-step').on('click', function(e) {
            e.preventDefault();
            var nextStep = $(this).attr('data-next');

            // Validation before advancing
            if (nextStep === '2') {
                var plate = $('input[name="license_plate"]').val();
                if (!plate || plate.trim() === '') {
                    alert('Vui lòng nhập Biển số xe của quý khách.');
                    $('input[name="license_plate"]').focus();
                    return;
                }
            } else if (nextStep === '3') {
                var date = $('input[name="booking_date"]').val();
                if (!date) {
                    alert('Vui lòng chọn ngày hẹn tiếp nhận xe.');
                    return;
                }
            }

            // Switch steps
            $('.wizard-step-pane').hide();
            $('#wizard-step-' + nextStep).fadeIn(250);

            // Update indicators
            $('.step-indicator-item').removeClass('active');
            $('.step-indicator-item[data-step="' + nextStep + '"]').addClass('active');

            for (var i = 1; i < parseInt(nextStep, 10); i++) {
                $('.step-indicator-item[data-step="' + i + '"]').addClass('completed');
            }

            $('html, body').animate({
                scrollTop: $('.wizard-card-box').offset().top - 90
            }, 300);
        });

        $('.btn-prev-step').on('click', function(e) {
            e.preventDefault();
            var prevStep = $(this).attr('data-prev');

            $('.wizard-step-pane').hide();
            $('#wizard-step-' + prevStep).fadeIn(250);

            $('.step-indicator-item').removeClass('active completed');
            $('.step-indicator-item[data-step="' + prevStep + '"]').addClass('active');

            for (var i = 1; i < parseInt(prevStep, 10); i++) {
                $('.step-indicator-item[data-step="' + i + '"]').addClass('completed');
            }

            $('html, body').animate({
                scrollTop: $('.wizard-card-box').offset().top - 90
            }, 300);
        });

        // ==========================================================================
        // 4. AJAX Booking Submission
        // ==========================================================================
        $('.hieugara-ajax-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('.btn-final-submit, button[type="submit"]');
            var $msgBox = $form.find('.form-response-msg');
            var originalText = $btn.html();

            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ĐANG XÁC NHẬN...');
            $msgBox.hide().empty();

            var formData = $form.serialize();
            formData += '&action=hieugara_submit_booking&security=' + (window.hieugara_vars ? window.hieugara_vars.nonce : '');

            $.ajax({
                url: window.hieugara_vars ? window.hieugara_vars.ajax_url : '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $msgBox.html(
                            '<div style="color: #15803d; background: #ecfdf5; border: 2px solid #10b981; padding: 20px; border-radius: 12px; margin-top: 20px; text-align: center;">' +
                            '<h4 style="font-size: 1.125rem; font-weight: 800; color: #15803d; margin-bottom: 6px;">🎉 ĐẶT LỊCH HẸN THÀNH CÔNG!</h4>' +
                            '<p style="margin: 0; font-size: 0.875rem; color: #334155;">' + response.data.message + '</p>' +
                            '</div>'
                        ).fadeIn();
                        $form[0].reset();
                    } else {
                        $msgBox.html(
                            '<div style="color: #b91c1c; background: #fff1f2; border: 1px solid #fecdd3; padding: 14px; border-radius: 8px; margin-top: 15px; font-weight: 600;">' +
                            '<i class="fa fa-exclamation-triangle"></i> ' + response.data.message +
                            '</div>'
                        ).fadeIn();
                    }
                },
                error: function() {
                    $msgBox.html(
                        '<div style="color: #b91c1c; background: #fff1f2; border: 1px solid #fecdd3; padding: 14px; border-radius: 8px; margin-top: 15px;">' +
                        'Hệ thống đang bận. Quý khách vui lòng gọi Hotline <strong>0123 456 789</strong> để được tiếp nhận ngay!' +
                        '</div>'
                    ).fadeIn();
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });

        // ==========================================================================
        
        // ==========================================================================
        // Ductri226 Mega Menu: Mobile Accordion Handler
        // ==========================================================================
        $(document).on('click', '.mega-cat', function(e) {
            if ($(window).width() <= 992) {
                var $group = $(this).closest('.mega-group');
                var $sub = $group.find('.mega-sub');
                if ($sub.length) {
                    e.preventDefault();
                    $group.toggleClass('is-open');
                }
            }
        });

        // SHIFTUP MEGA MENU: Mobile Accordion Toggle
        // ==========================================================================
        $(document).on('click', '.mega-group-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $card = $(this).closest('.mega-group-card');
            var isOpen = $card.hasClass('is-open');
            $card.toggleClass('is-open', !isOpen);
            $(this).attr('aria-expanded', !isOpen);
        });

        // ==========================================================================
        // SHIFTUP FOOTER: Smooth Back to Top Scroll
        // ==========================================================================
        $(document).on('click', '#footerBackToTop', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 650);
        });

    });

})(jQuery);
