/**
 * Hiếu Gara Motors - Main JavaScript
 * Standard: CARPLA SERVICE Platform (Single-Line Nav, Hero Command Console, Multi-Step Wizard)
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // ==========================================================================
        // 0. Ductri226-Grade Turbo Instant Navigation & Hover Prefetcher
        // ==========================================================================
        var prefetchedUrls = new Set();
        function prefetchUrl(url) {
            if (!url || prefetchedUrls.has(url)) return;
            try {
                var parsed = new URL(url, window.location.origin);
                if (parsed.origin !== window.location.origin) return;
                if (parsed.pathname.indexOf('/wp-admin') === 0 || parsed.pathname.indexOf('/wp-login') === 0) return;
                prefetchedUrls.add(url);
                if (window.fetch) {
                    fetch(url, { priority: 'low' }).catch(function(){});
                } else {
                    var link = document.createElement('link');
                    link.rel = 'prefetch';
                    link.href = url;
                    document.head.appendChild(link);
                }
            } catch(e) {}
        }

        // Prefetch on hover (desktop, >65ms intent) or touchstart (mobile)
        var hoverTimer = null;
        $(document).on('mouseenter', 'a', function() {
            var href = $(this).attr('href');
            if (href && href.indexOf('#') !== 0 && href.indexOf('tel:') !== 0 && href.indexOf('mailto:') !== 0 && href.indexOf('javascript:') !== 0) {
                hoverTimer = setTimeout(function() {
                    prefetchUrl(href);
                }, 65);
            }
        }).on('mouseleave', 'a', function() {
            if (hoverTimer) clearTimeout(hoverTimer);
        });

        $(document).on('touchstart', 'a', function() {
            var href = $(this).attr('href');
            if (href && href.indexOf('#') !== 0 && href.indexOf('tel:') !== 0 && href.indexOf('mailto:') !== 0) {
                prefetchUrl(href);
            }
        });

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
        // 1. Sticky Navigation Bar & Mobile Drawer (Ductri226 Scroll Elevate)
        // ==========================================================================
        var $mainNav = $('#mainStickyNavbar');
        var $mobileHeader = $('.mobile-only-brand-header');

        function handleNavScroll() {
            var scrollPos = $(window).scrollTop();
            if ($(window).width() >= 992) {
                if (scrollPos > 24) {
                    $mainNav.addClass('is-sticky is-scrolled');
                } else {
                    $mainNav.removeClass('is-sticky is-scrolled');
                }
            } else {
                $mainNav.removeClass('is-sticky is-scrolled');
                if (scrollPos > 15) {
                    $mobileHeader.addClass('is-scrolled');
                } else {
                    $mobileHeader.removeClass('is-scrolled');
                }
            }
        }
        $(window).on('scroll resize touchmove passive-scroll', handleNavScroll);
        handleNavScroll();

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
                } else if ($(e.target).closest('.nav-caret').length || $(this).attr('href') === '#') {
                    e.preventDefault();
                    $parent.removeClass('open-submenu');
                }
            }
        });

        // Mobile Nested Sub-Dropdown Accordion (Danh mục con trong Dịch Vụ on screens <= 992px)
        $(document).on('click', '.custom-nav-menu .has-sub-dropdown > a', function(e) {
            if ($(window).width() <= 992) {
                var $subParent = $(this).parent('.has-sub-dropdown');
                if (!$subParent.hasClass('open-sub-dropdown')) {
                    e.preventDefault();
                    $subParent.siblings('.has-sub-dropdown').removeClass('open-sub-dropdown');
                    $subParent.addClass('open-sub-dropdown');
                } else if ($(e.target).closest('.sub-caret').length) {
                    e.preventDefault();
                    $subParent.removeClass('open-sub-dropdown');
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
                var rawIdx = $(this).attr('data-slide-index') !== undefined ? $(this).attr('data-slide-index') : $(this).attr('data-to');
                var targetIdx = parseInt(rawIdx, 10);
                if (!isNaN(targetIdx)) {
                    clearInterval(lexusSliderTimer);
                    showLexusSlide(targetIdx);
                    startLexusSlider();
                }
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
            var allAboutSwiper = window.hieuGaraAccessorySwiper;
            if (!allAboutSwiper && typeof Swiper !== 'undefined') {
                allAboutSwiper = new Swiper('.all-about-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    loop: true,
                    grabCursor: true,
                    watchSlidesProgress: true,
                    speed: 500,
                    autoplay: {
                        delay: 4500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 24
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 28
                        }
                    }
                });
                window.hieuGaraAccessorySwiper = allAboutSwiper;
            }

            // Always wire up Prev & Next buttons directly
            $(document).off('click', '#allCarsPrevBtn').on('click', '#allCarsPrevBtn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var sw = window.hieuGaraAccessorySwiper || allAboutSwiper;
                if (sw && typeof sw.slidePrev === 'function') {
                    sw.slidePrev(400);
                } else {
                    var el = document.getElementById('allCarsTrack');
                    if (el) el.scrollBy({ left: -320, behavior: 'smooth' });
                }
            });

            $(document).off('click', '#allCarsNextBtn').on('click', '#allCarsNextBtn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var sw = window.hieuGaraAccessorySwiper || allAboutSwiper;
                if (sw && typeof sw.slideNext === 'function') {
                    sw.slideNext(400);
                } else {
                    var el = document.getElementById('allCarsTrack');
                    if (el) el.scrollBy({ left: 320, behavior: 'smooth' });
                }
            });

            // Smooth wheel response directly forwarding to Swiper
            var swiperElem = document.querySelector('.all-about-swiper');
            if (swiperElem) {
                swiperElem.addEventListener('wheel', function(e) {
                    if (Math.abs(e.deltaY) > 25) {
                        var sw = window.hieuGaraAccessorySwiper || allAboutSwiper;
                        if (sw && typeof sw.slideNext === 'function') {
                            if (e.deltaY > 0) {
                                sw.slideNext(400);
                            } else {
                                sw.slidePrev(400);
                            }
                        }
                    }
                }, { passive: true });
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
            $('#lexusHeroSlider').addClass('hero-entered is-inview');
        }, 60);

        // ==========================================================================
        // 2D. FULL-PAGE BIDIRECTIONAL SCROLL ANIMATION SUITE (ShiftUp Interactive)
        // Re-triggers animations seamlessly in BOTH directions (scroll down & scroll up)
        // ==========================================================================
        function animateMilestoneCounters(sectionEl) {
            var counters = sectionEl.querySelectorAll('.milestone-stat-card .stat-number');
            counters.forEach(function(counter, idx) {
                if (!counter.dataset.targetVal) {
                    counter.dataset.targetVal = counter.textContent.trim();
                }
                var rawTarget = counter.dataset.targetVal;
                var hasDot = rawTarget.indexOf('.') !== -1;
                var numericTarget = parseInt(rawTarget.replace(/[^0-9]/g, ''), 10);
                if (isNaN(numericTarget) || numericTarget <= 0) return;

                counter.textContent = '0';
                var startTime = null;
                var duration = 1450;
                var delayMs = idx * 120;

                setTimeout(function() {
                    function step(timestamp) {
                        if (!startTime) startTime = timestamp;
                        var progress = Math.min((timestamp - startTime) / duration, 1);
                        // EaseOutExpo curve
                        var eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                        var currentVal = Math.round(numericTarget * eased);
                        if (hasDot) {
                            counter.textContent = currentVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        } else {
                            counter.textContent = currentVal.toString();
                        }
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            counter.textContent = rawTarget;
                        }
                    }
                    window.requestAnimationFrame(step);
                }, delayMs);
            });
        }

        var techSectionEl = document.querySelector('.shiftup-technicians-section');
        function checkMilestoneStatsViewport() {
            if (!techSectionEl) return;
            var rect = techSectionEl.getBoundingClientRect();
            var winH = window.innerHeight || document.documentElement.clientHeight;
            var scrollY = window.pageYOffset || document.documentElement.scrollTop;

            // Section is comfortably inside the user's active reading area
            var isVisibleNow = (rect.top <= winH * 0.80) && (rect.bottom >= 110);
            // Reset if user scrolled back to the top hero or scrolled completely past it
            var shouldReset = (rect.top > winH * 0.86) || (rect.bottom < 70) || (scrollY < 30 && rect.top > winH * 0.58);

            if (shouldReset) {
                if (techSectionEl.classList.contains('is-inview')) {
                    techSectionEl.classList.remove('is-inview', 'is-appeared');
                }
            } else if (isVisibleNow) {
                if (!techSectionEl.classList.contains('is-inview')) {
                    techSectionEl.classList.add('is-inview', 'is-appeared');
                    animateMilestoneCounters(techSectionEl);
                }
            }
        }

        var animatedSections = document.querySelectorAll(
            '.lexus-banner-slider, .shiftup-tuning-shop-section, ' +
            '.shiftup-all-about-cars-section, .shiftup-panoramic-banners, .kobac-about-mission-section, .shiftup-gallery-section, ' +
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
                        if (target.classList.contains('lexus-banner-slider')) {
                            target.classList.add('hero-entered');
                        }
                    } else {
                        // Crucial: Remove classes when leaving viewport so scrolling BACK UP re-triggers the animations!
                        var rect = target.getBoundingClientRect();
                        var winH = window.innerHeight || document.documentElement.clientHeight;
                        // Reset if element is substantially off-screen (above or below)
                        if (rect.bottom < -40 || rect.top > winH + 40) {
                            target.classList.remove('is-inview');
                            if (target.classList.contains('lexus-banner-slider')) {
                                target.classList.remove('hero-entered');
                            }
                        }
                    }
                });
            }, {
                threshold: [0, 0.08, 0.2],
                rootMargin: '20px 0px -30px 0px'
            });

            animatedSections.forEach(function(section) {
                bidirectionalObserver.observe(section);
            });
        } else {
            // Fallback for older browsers without IntersectionObserver
            $(animatedSections).addClass('is-inview hero-entered is-appeared');
        }

        // Run Milestone check on load & scroll
        setTimeout(checkMilestoneStatsViewport, 180);
        $(window).on('scroll.milestoneCheck resize.milestoneCheck', checkMilestoneStatsViewport);

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
                            '<h4 style="font-size: 1.125rem; font-weight: 800; color: #15803d; margin-bottom: 6px;">🎉 TIẾP NHẬN YÊU CẦU THÀNH CÔNG!</h4>' +
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
                        'Hệ thống đang bận. Quý khách vui lòng gọi Hotline <strong>0911 211 996</strong> để được tiếp nhận ngay!' +
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

        // ==========================================================================
        // EMERGENCY RESCUE 24/7 (1-CLICK GPS SHARE & ZALO DISPATCH)
        // ==========================================================================
        var rescueState = {
            lat: null,
            lng: null,
            accuracy: null,
            isLocating: false
        };

        function showRescueToast(msg, type) {
            var $toast = $('#rescueToast');
            if (!$toast.length) return;
            $toast.removeClass('success info error').addClass(type || 'info').html(msg).stop(true, true).fadeIn(200);
            setTimeout(function() {
                $toast.fadeOut(400);
            }, 6000);
        }

        function openRescueModal() {
            var $backdrop = $('#rescueModalBackdrop');
            if (!$backdrop.length) return;
            $backdrop.addClass('is-open').attr('aria-hidden', 'false');
            $('body').addClass('rescue-modal-open');
        }

        function closeRescueModal() {
            var $backdrop = $('#rescueModalBackdrop');
            if (!$backdrop.length) return;
            $backdrop.removeClass('is-open').attr('aria-hidden', 'true');
            $('body').removeClass('rescue-modal-open');
        }

        // Trigger Modal Open from any rescue button
        $(document).on('click', '.js-open-rescue-modal', function(e) {
            e.preventDefault();
            openRescueModal();
        });

        // Close Modal via close button or backdrop click
        $(document).on('click', '#rescueModalClose', function(e) {
            e.preventDefault();
            closeRescueModal();
        });

        $(document).on('click', '.hieugara-rescue-modal-box', function(e) {
            e.stopPropagation();
        });

        $(document).on('click', '#rescueModalBackdrop', function(e) {
            if (e.target === this) {
                closeRescueModal();
            }
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                if ($('#rescueModalBackdrop').hasClass('is-open')) {
                    closeRescueModal();
                }
            }
        });

        // Quick Landmark Chips
        $(document).on('click', '.landmark-chip', function(e) {
            e.preventDefault();
            var place = $(this).data('place') || $(this).text().trim();
            var $input = $('#rescueManualAddress');
            var current = $input.val().trim();
            if (!current || current.indexOf('Tọa độ GPS') === 0) {
                $input.val(place);
            } else if (current.indexOf(place) === -1) {
                $input.val(current + ' - ' + place);
            }
            $input.focus();
        });

        // 1-Click GPS Location Retrieval (Fast, Accurate & Non-blocking)
        $(document).on('click', '#rescueGetGpsBtn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $status = $('#rescueGpsStatus');

            if (!navigator.geolocation) {
                $status.html('<span class="gps-status-badge error"><i class="fa-solid fa-circle-exclamation"></i> Thiết bị không hỗ trợ GPS. Vui lòng nhập địa chỉ bên dưới:</span>');
                $('#rescueManualAddress').focus();
                return;
            }

            if (rescueState.isLocating) return;
            rescueState.isLocating = true;

            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> <span>Đang dò GPS...</span>');
            $status.html('<span class="gps-status-badge locating"><i class="fa-solid fa-spinner fa-spin"></i> Đang kết nối vệ tinh định vị...</span>');

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    rescueState.isLocating = false;
                    $btn.prop('disabled', false);
                    rescueState.lat = pos.coords.latitude;
                    rescueState.lng = pos.coords.longitude;

                    var rawAcc = pos.coords.accuracy;
                    var accMeters = Math.round(rawAcc);
                    if (accMeters <= 2 || isNaN(accMeters) || accMeters === 0) {
                        accMeters = 2; // Real-world optimal GPS fix
                    }
                    rescueState.accuracy = accMeters;

                    var latStr = rescueState.lat.toFixed(5);
                    var lngStr = rescueState.lng.toFixed(5);
                    var mapsUrl = 'https://maps.google.com/?q=' + rescueState.lat + ',' + rescueState.lng;

                    $btn.addClass('is-success').html('<i class="fa-solid fa-circle-check"></i> <span>Đã lấy tọa độ</span>');

                    var badgeHtml = '';
                    if (accMeters <= 5) {
                        badgeHtml = '<span class="gps-status-badge success">' +
                            '<i class="fa-solid fa-satellite-dish"></i> Chuẩn GPS (±' + accMeters + 'm): ' + latStr + ', ' + lngStr + ' ' +
                            '<a href="' + mapsUrl + '" target="_blank" rel="noopener" class="gps-maps-link">Xem bản đồ</a>' +
                            '</span>';
                    } else if (accMeters <= 30) {
                        badgeHtml = '<span class="gps-status-badge success">' +
                            '<i class="fa-solid fa-location-dot"></i> Tọa độ GPS (±' + accMeters + 'm): ' + latStr + ', ' + lngStr + ' ' +
                            '<a href="' + mapsUrl + '" target="_blank" rel="noopener" class="gps-maps-link">Xem bản đồ</a>' +
                            '</span>';
                    } else {
                        badgeHtml = '<span class="gps-status-badge locating">' +
                            '<i class="fa-solid fa-wifi"></i> Vị trí mạng Wi-Fi (sai số ~' + accMeters + 'm) ' +
                            '<a href="' + mapsUrl + '" target="_blank" rel="noopener" class="gps-maps-link">Xem bản đồ</a>' +
                            '</span>';
                    }
                    $status.html(badgeHtml);

                    // Non-blocking reverse geocoding to human street address
                    if (window.fetch) {
                        var controller = window.AbortController ? new AbortController() : null;
                        var fetchTimer = setTimeout(function() { if (controller) controller.abort(); }, 2500);

                        fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + rescueState.lat + '&lon=' + rescueState.lng + '&accept-language=vi', {
                            signal: controller ? controller.signal : undefined
                        })
                        .then(function(res) { return res.json(); })
                        .then(function(data) {
                            clearTimeout(fetchTimer);
                            if (data && data.address) {
                                var parts = [];
                                if (data.address.road) parts.push(data.address.road);
                                if (data.address.suburb || data.address.quarter) parts.push(data.address.suburb || data.address.quarter);
                                if (data.address.city || data.address.county || data.address.town) parts.push(data.address.city || data.address.county || data.address.town);
                                var formatted = parts.join(', ');
                                if (formatted && !$('#rescueManualAddress').val().trim()) {
                                    $('#rescueManualAddress').val(formatted);
                                }
                            }
                        })
                        .catch(function() {
                            clearTimeout(fetchTimer);
                            if (!$('#rescueManualAddress').val().trim()) {
                                $('#rescueManualAddress').val('Tọa độ GPS: ' + latStr + ', ' + lngStr + ' (Sai số ~' + accMeters + 'm)');
                            }
                        });
                    } else {
                        if (!$('#rescueManualAddress').val().trim()) {
                            $('#rescueManualAddress').val('Tọa độ GPS: ' + latStr + ', ' + lngStr + ' (Sai số ~' + accMeters + 'm)');
                        }
                    }
                },
                function(err) {
                    rescueState.isLocating = false;
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-crosshairs"></i> <span>Thử lấy lại GPS</span>');
                    var errMsg = 'Không lấy được GPS tự động';
                    if (err.code === 1) {
                        errMsg = 'Chưa cấp quyền vị trí cho trình duyệt';
                    } else if (err.code === 2) {
                        errMsg = 'Tín hiệu GPS yếu hoặc thiết bị không có GPS';
                    } else if (err.code === 3) {
                        errMsg = 'Hết thời gian chờ GPS';
                    }
                    $status.html('<span class="gps-status-badge error"><i class="fa-solid fa-circle-exclamation"></i> ' + errMsg + '. Vui lòng nhập địa chỉ / chọn mốc bên dưới:</span>');
                    $('#rescueManualAddress').focus();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 6000,
                    maximumAge: 0
                }
            );
        });

        // Vehicle Issue Chips Toggle
        $(document).on('click', '.rescue-issue-chip', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            if ($('.rescue-issue-chip.active').length === 0) {
                $(this).addClass('active');
            }
        });

        // Build Emergency Message Payload
        function buildEmergencyMessage() {
            var issues = $('.rescue-issue-chip.active').map(function() {
                return $(this).data('issue') || $(this).text().trim();
            }).get();
            var issueStr = issues.length > 0 ? issues.join(', ') : 'Cần cứu hộ khẩn cấp';

            var locStr = '';
            if (rescueState.lat && rescueState.lng) {
                var mapsUrl = 'https://maps.google.com/?q=' + rescueState.lat + ',' + rescueState.lng;
                locStr = mapsUrl + ' (Tọa độ: ' + rescueState.lat.toFixed(6) + ', ' + rescueState.lng.toFixed(6) + ')';
            }
            var manualLoc = $('#rescueManualAddress').val().trim();
            if (manualLoc) {
                locStr = locStr ? (locStr + ' | Địa chỉ bổ sung: ' + manualLoc) : manualLoc;
            }
            if (!locStr) {
                locStr = 'Chưa xác định (Cần gọi lại để xác nhận địa chỉ)';
            }

            var phone = $('#rescueUserPhone').val().trim() || 'Chưa cung cấp';
            var car = $('#rescueUserCar').val().trim() || 'Chưa cung cấp';

            var msg = '🚨 YÊU CẦU CỨU HỘ GIAO THÔNG 24/7 - GARA Ô TÔ HẢI HÀ\n' +
                      '━━━━━━━━━━━━━━━━━━━━━\n' +
                      '• Sự cố xe: ' + issueStr + '\n' +
                      '• Vị trí: ' + locStr + '\n' +
                      '• Số điện thoại khách: ' + phone + '\n' +
                      '• Xe / Biển số: ' + car + '\n' +
                      '━━━━━━━━━━━━━━━━━━━━━\n' +
                      '👉 Kính đề nghị gara điều phối xe cứu hộ hỗ trợ khẩn cấp!';

            return {
                text: msg,
                issue: issueStr,
                location: locStr,
                phone: phone,
                car: car
            };
        }

        // Zalo Dispatch
        $(document).on('click', '#rescueDispatchZaloBtn', function(e) {
            e.preventDefault();
            var payload = buildEmergencyMessage();

            // Copy to clipboard
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(payload.text).catch(function() {});
            } else {
                try {
                    var $temp = $('<textarea>');
                    $('body').append($temp);
                    $temp.val(payload.text).select();
                    document.execCommand('copy');
                    $temp.remove();
                } catch(e) {}
            }

            showRescueToast('✅ Đã sao chép nội dung vị trí & mở Zalo cứu hộ Hải Hà!', 'success');

            // Open Zalo
            var zaloUrl = 'https://zalo.me/0911211996';
            setTimeout(function() {
                window.open(zaloUrl, '_blank');
            }, 300);
        });

        // SMS Fallback Dispatch
        $(document).on('click', '#rescueDispatchSmsBtn', function(e) {
            e.preventDefault();
            var payload = buildEmergencyMessage();
            var smsUrl = 'sms:0911211996?body=' + encodeURIComponent(payload.text);
            window.location.href = smsUrl;
        });

        // ==========================================================================
        // SMART VEHICLE DIAGNOSTICS & MAINTENANCE CHECKLIST (NHÓM 1)
        // ==========================================================================
        
        // 1. Tab Switching
        $(document).on('click', '.smart-tool-tab', function(e) {
            e.preventDefault();
            var targetTab = $(this).data('tab');
            $('.smart-tool-tab').removeClass('active').attr('aria-selected', 'false');
            $(this).addClass('active').attr('aria-selected', 'true');
            
            $('.smart-tool-panel').removeClass('active');
            $('#panel-' + targetTab).addClass('active');
        });

        // 2. Maintenance Checklist Logic
        var maintState = {
            km: '5000',
            engine: 'gasoline'
        };

        var maintData = {
            '5000': {
                name: 'Cấp 1 (5.000 km)',
                desc: 'Bảo dưỡng cấp nhỏ định kỳ - Kiểm tra an toàn căn bản',
                items: {
                    gasoline: [
                        'Thay dầu động cơ chính hãng đúng tiêu chuẩn và độ nhớt',
                        'Vệ sinh lọc gió động cơ & lọc gió điều hòa cabin',
                        'Kiểm tra và châm thêm nước làm mát, nước rửa kính',
                        'Kiểm tra áp suất lốp & độ mòn hoa lốp 4 bánh',
                        'Soi gầm nhanh 12 điểm an toàn (xì dầu, rách cao su, rô-tuyn)',
                        'Kiểm tra toàn bộ hệ thống đèn chiếu sáng và gạt mưa'
                    ],
                    diesel: [
                        'Thay dầu động cơ chuyên dụng cho máy dầu Diesel',
                        'Xả nước lắng cặn đáy cốc lọc nhiên liệu Diesel',
                        'Vệ sinh lọc gió động cơ & lọc gió điều hòa cabin',
                        'Kiểm tra nước làm mát động cơ & nước rửa kính',
                        'Kiểm tra áp suất lốp & độ mòn hoa lốp 4 bánh',
                        'Soi gầm nhanh 12 điểm an toàn gầm bệ'
                    ],
                    electric: [
                        'Quét chẩn đoán tình trạng pack pin cao áp & cell pin qua cổng OBD-II',
                        'Kiểm tra dung dịch làm mát pack pin cao áp & mô tơ điện',
                        'Kiểm tra hệ thống phanh tái sinh năng lượng (Regenerative Braking)',
                        'Vệ sinh & bôi trơn bảo dưỡng cụm phanh đĩa 4 bánh',
                        'Vệ sinh lọc gió điều hòa cabin',
                        'Kiểm tra áp suất lốp & cân bằng động bánh xe điện'
                    ]
                }
            },
            '10000': {
                name: 'Cấp 2 (10.000 km)',
                desc: 'Bảo dưỡng cấp trung bình - Đảo lốp & bảo dưỡng phanh',
                items: {
                    gasoline: [
                        'Tất cả hạng mục bảo dưỡng của cấp 5.000 km',
                        'Thay mới cốc lọc dầu (lọc nhớt) động cơ chính hãng',
                        'Đảo lốp 4 bánh & cân bằng động bánh xe chống rung vô lăng',
                        'Vệ sinh và bảo dưỡng toàn diện hệ thống phanh 4 bánh',
                        'Đo dòng khởi động & kiểm tra ắc quy bằng máy Midtronics',
                        'Kiểm tra độ rơ thước lái, hệ thống treo và thanh cân bằng'
                    ],
                    diesel: [
                        'Tất cả hạng mục bảo dưỡng của cấp 5.000 km',
                        'Thay mới cốc lọc nhớt động cơ Diesel chuyên dụng',
                        'Đảo lốp 4 bánh & cân bằng động điện tử 4 bánh',
                        'Vệ sinh & bảo dưỡng toàn bộ hệ thống phanh 4 bánh',
                        'Kiểm tra ắc quy công suất lớn của máy dầu',
                        'Kiểm tra hệ thống treo, rô-tuyn gầm & giảm xóc'
                    ],
                    electric: [
                        'Tất cả hạng mục kiểm tra của cấp 5.000 km',
                        'Đảo lốp 4 bánh & cân bằng động bánh xe điện',
                        'Kiểm tra độ mòn má phanh & đĩa phanh 4 bánh',
                        'Cập nhật phần mềm ECU hệ thống điều khiển nếu có phiên bản mới',
                        'Kiểm tra bình ắc quy 12V phụ trợ cho hệ thống điện',
                        'Kiểm tra các đường ống dẫn môi chất làm mát pin'
                    ]
                }
            },
            '20000': {
                name: 'Cấp 3 (20.000 km)',
                desc: 'Bảo dưỡng cấp trung bình lớn - Cân chỉnh góc đặt bánh xe Hunter',
                items: {
                    gasoline: [
                        'Tất cả hạng mục bảo dưỡng của cấp 10.000 km',
                        'Thay mới lọc gió động cơ & lọc gió điều hòa kháng khuẩn',
                        'Cân chỉnh góc đặt bánh xe điện tử bằng dàn máy Hunter (USA)',
                        'Vệ sinh họng hút gió, bướm ga và cảm biến khí nạp (MAF)',
                        'Kiểm tra chất lượng dầu phanh, dầu trợ lực lái & nước làm mát',
                        'Kiểm tra gầm tổng thể 28 điểm tiêu chuẩn kỹ thuật Hải Hà'
                    ],
                    diesel: [
                        'Tất cả hạng mục bảo dưỡng của cấp 10.000 km',
                        'Thay mới lọc gió động cơ & lọc gió điều hòa than hoạt tính',
                        'Cân chỉnh góc đặt bánh xe điện tử Hunter (USA)',
                        'Vệ sinh bướm ga và cảm biến áp suất đường ống nạp Turbo',
                        'Kiểm tra tình trạng van luân hồi khí xả EGR máy dầu',
                        'Kiểm tra tổng thể hệ thống truyền động và gầm bệ 28 điểm'
                    ],
                    electric: [
                        'Tất cả hạng mục bảo dưỡng của cấp 10.000 km',
                        'Cân chỉnh góc đặt bánh xe Hunter chống nhao lái & mòn lốp lệch',
                        'Thay mới lọc gió điều hòa than hoạt tính cao cấp',
                        'Kiểm tra độ kín khít vỏ pack pin chống nước tiêu chuẩn IP68',
                        'Kiểm tra hệ thống giảm xóc và thanh giằng chịu tải trọng pin nặng',
                        'Bảo dưỡng tổng thể hệ thống cơ cấu phanh và trợ lực phanh điện'
                    ]
                }
            },
            '40000': {
                name: 'Cấp 4 (40.000 km)',
                desc: 'Bảo dưỡng cấp lớn toàn diện - Thay các loại dầu truyền động & lọc',
                items: {
                    gasoline: [
                        'Tất cả hạng mục bảo dưỡng của cấp 20.000 km',
                        'Thay mới dầu hộp số (số sàn / số tự động AT / CVT) & dầu cầu',
                        'Thay mới toàn bộ dầu phanh DOT4 tuần hoàn',
                        'Thay mới nước làm mát động cơ tuần hoàn',
                        'Thay mới lọc nhiên liệu xăng chính hãng',
                        'Thay mới bộ bu-gi đánh lửa (Iridium / Platinum)',
                        'Vệ sinh kim phun điện tử và buồng đốt bằng máy chuyên dụng',
                        'Siết lại toàn bộ ốc gầm theo tiêu chuẩn lực xiết nhà sản xuất'
                    ],
                    diesel: [
                        'Tất cả hạng mục bảo dưỡng của cấp 20.000 km',
                        'Thay mới dầu hộp số và dầu cầu trước / sau',
                        'Thay mới cốc lọc nhiên liệu Diesel chính hãng',
                        'Thay mới dầu phanh DOT4 & nước làm mát tuần hoàn',
                        'Vệ sinh giàn kim phun dầu áp suất cao Common Rail',
                        'Vệ sinh van EGR và họng nạp muội than máy dầu',
                        'Siết lại toàn bộ hệ thống gầm theo bảng lực siết kỹ thuật'
                    ],
                    electric: [
                        'Tất cả hạng mục bảo dưỡng của cấp 20.000 km',
                        'Thay mới dung dịch làm mát pin cao áp chuyên dụng',
                        'Thay mới dầu bôi trơn cụm truyền động mô-tơ điện',
                        'Thay mới dầu phanh điện tử tuần hoàn',
                        'Kiểm tra chuyên sâu độ thoái hóa pin (SOH) và cân bằng cell pin',
                        'Kiểm tra bảo dưỡng toàn bộ hệ thống cáp điện cam cao áp',
                        'Siết lại toàn bộ khung gầm đỡ khối pin cao áp'
                    ]
                }
            },
            '80000': {
                name: 'Cấp 80.000 km+ (Đại Tu Định Kỳ)',
                desc: 'Đại tu bảo dưỡng tổng thể - Đưa xe về trạng thái vận hành như mới',
                items: {
                    gasoline: [
                        'Tất cả hạng mục bảo dưỡng cấp lớn 40.000 km',
                        'Thay dây curoa tổng, bi tăng tỳ, kiểm tra bơm nước làm mát',
                        'Kiểm tra & thay thế cao su chân máy, chân hộp số nếu bị nứt lún',
                        'Nội soi làm sạch giàn lạnh điều hòa bằng công nghệ không tháo taplo',
                        'Kiểm tra phục hồi hệ thống giảm xóc và thanh giằng gầm',
                        'Đo áp suất buồng đốt từng xi lanh kiểm tra độ kín xéc-măng',
                        'Thay thế các ống cao su dẫn nước làm mát và dẫn dầu lão hóa'
                    ],
                    diesel: [
                        'Tất cả hạng mục bảo dưỡng cấp lớn 40.000 km',
                        'Thay mới bộ dây curoa cam / xích cam và curoa tổng',
                        'Cân chỉnh áp suất bơm cao áp và kim phun máy dầu',
                        'Vệ sinh bầu lọc khí thải DPF và van luân hồi khí xả EGR',
                        'Nội soi làm sạch hệ thống giàn lạnh điều hòa',
                        'Kiểm tra thay thế cao su chân máy dầu và đệm giảm chấn',
                        'Đại tu bảo dưỡng hệ thống phanh và gầm bệ toàn diện'
                    ],
                    electric: [
                        'Tất cả hạng mục bảo dưỡng của cấp 40.000 km',
                        'Kiểm tra và kiểm định lại toàn bộ hệ thống ngắt điện an toàn tự động',
                        'Vệ sinh khử khuẩn nội soi giàn lạnh điều hòa nhiệt độ cabin',
                        'Kiểm tra độ rơ của trục láp và các khớp cầu truyền động',
                        'Kiểm định toàn bộ hệ thống cách điện của pack pin và mô tơ',
                        'Bảo dưỡng hệ thống giảm xóc khí nén / thủy lực xe điện',
                        'Cân chỉnh lại toàn bộ hệ thống cảm biến hỗ trợ lái ADAS'
                    ]
                }
            }
        };

        function renderMaintChecklist() {
            var km = maintState.km;
            var engine = maintState.engine;
            var pack = maintData[km];
            if (!pack) return;

            var engineNames = {
                gasoline: 'Động Cơ Xăng',
                diesel: 'Động Cơ Dầu (Diesel)',
                electric: 'Xe Điện VinFast'
            };

            var items = (pack.items && pack.items[engine]) ? pack.items[engine] : pack.items.gasoline;

            $('#maintSelectedTitle').text('GÓI BẢO DƯỠNG ' + pack.name.toUpperCase() + ' — ' + engineNames[engine].toUpperCase());

            var html = '';
            for (var i = 0; i < items.length; i++) {
                html += '<div class="maint-check-item">' +
                    '<span>' + items[i] + '</span>' +
                    '</div>';
            }
            $('#maintItemsGrid').html(html);

            // Toggle VinFast Notice
            if (engine === 'electric') {
                $('#vfElectricNotice').slideDown(200);
            } else {
                $('#vfElectricNotice').slideUp(200);
            }

            // Update Zalo CTA button
            var zaloMsg = 'Chào Gara Ôtô Hải Hà, tôi muốn tư vấn gói ' + pack.name + ' cho xe ' + engineNames[engine] + '. Xưởng báo giúp tôi các hạng mục và sắp xếp lịch kiểm tra nhé!';
            var zaloUrl = 'https://zalo.me/0911211996';
            $('#maintZaloBtn').attr('href', zaloUrl).off('click.maint').on('click.maint', function(e) {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(zaloMsg).catch(function() {});
                }
            });
        }

        // Click Km Chip
        $(document).on('click', '.km-chip', function(e) {
            e.preventDefault();
            $('.km-chip').removeClass('active');
            $(this).addClass('active');
            maintState.km = $(this).data('km').toString();
            renderMaintChecklist();
        });

        // Click Engine Chip
        $(document).on('click', '.engine-chip', function(e) {
            e.preventDefault();
            $('.engine-chip').removeClass('active');
            $(this).addClass('active');
            maintState.engine = $(this).data('engine');
            renderMaintChecklist();
        });

        // 3. Symptom Checker Logic
        var symptomData = {
            ac: {
                title: 'Điều hòa không mát / Chỉ ra gió nóng',
                severity: 'warning',
                severityText: '🟡 Cần xử lý sớm',
                cause: 'Thiếu gas lạnh do rò rỉ ti van hoặc phớt đầu lốc, lốc lạnh (máy nén) không đóng ly hợp từ, tắc phin lọc ga hoặc dàn nóng bám đầy bụi đất không giải nhiệt được.',
                solution: 'Đo áp suất ga cao áp & thấp áp bằng đồng hồ chuyên dụng, nội soi dàn lạnh khử mùi, kiểm tra điện điều khiển ngắt lốc và xịt rửa vệ sinh dàn nóng tản nhiệt.',
                zaloMsg: 'Chào Ôtô Hải Hà, xe tôi đang bị: Điều hòa không mát, chỉ ra gió nóng. Kỹ sư tư vấn giúp tôi nguyên nhân và cách khắc phục nhé!'
            },
            underbody: {
                title: 'Gầm kêu lục cục khi qua gờ giảm tốc',
                severity: 'danger',
                severityText: '🔴 Nguy hiểm - Cần kiểm tra ngay',
                cause: 'Rách cao su đệm càng A, vỡ bi bát bèo giảm xóc, lỏng rô-tuyn cân bằng hoặc rơ lỏng thanh giằng thước lái. Để lâu có thể rơi rô-tuyn mất lái.',
                solution: 'Đưa xe lên cầu nâng thủy lực soi gầm 28 điểm tại Hải Hà, dùng thiết bị chuyên dụng kiểm tra độ rơ của từng khớp rô-tuyn, thay thế linh kiện mòn và siết lực chuẩn.',
                zaloMsg: 'Chào Ôtô Hải Hà, xe tôi đang bị: Gầm kêu lục cục khi đi đường xóc / qua gờ giảm tốc. Xưởng tư vấn kiểm tra giúp tôi với!'
            },
            steering: {
                title: 'Vô lăng rung lắc / Nhao lái sang bên',
                severity: 'warning',
                severityText: '🟡 Nên xử lý ngay',
                cause: 'Mất chì cân bằng động bánh xe, lốp bị chửa/mòn vẹt không đều, hoặc sai lệch các góc đặt bánh xe (Camber, Caster, Toe) do sụp ổ gà.',
                solution: 'Cân bằng động điện tử 4 bánh và cân chỉnh độ chụm góc đặt bánh xe bằng dàn máy quang học 3D Hunter (Hoa Kỳ) tại Ôtô Hải Hà (xong trong 20 phút).',
                zaloMsg: 'Chào Ôtô Hải Hà, xe tôi bị: Vô lăng rung lắc khi chạy tốc độ cao / nhao lái sang một bên. Nhờ xưởng hỗ trợ tư vấn cân chỉnh Hunter!'
            },
            brake: {
                title: 'Phanh rít két két / Đạp phanh bị sâu',
                severity: 'danger',
                severityText: '🔴 Cực kỳ nguy hiểm - Dễ mất phanh',
                cause: 'Má phanh mòn hết đến cữ cảnh báo kim loại, đĩa phanh bị gờ xước / cong vênh nhiệt, hoặc cúp-pen phanh bị xì dầu gây hụt áp lực dầu phanh.',
                solution: 'Kiểm tra độ dày má phanh, láng phẳng mặt đĩa phanh bằng máy tự động chống rung giật, thay dầu phanh tuần hoàn DOT4 và xả e hệ thống phanh an toàn.',
                zaloMsg: 'Chào Ôtô Hải Hà, xe tôi đang bị: Phanh có tiếng kêu rít két két / bàn đạp phanh bị sâu. Kỹ sư hỗ trợ tôi gấp nhé!'
            },
            start: {
                title: 'Đề dai khó nổ / Chết máy đột ngột',
                severity: 'danger',
                severityText: '🔴 Khẩn cấp - Dễ nằm đường',
                cause: 'Bình ắc quy tụt áp / hỏng cọc bình, máy phát điện (Dynamo) không nạp, chổi than củ đề mòn, hoặc tắc lọc nhiên liệu / yếu bơm xăng.',
                solution: 'Đo dòng khởi động CCA của ắc quy bằng máy Midtronics, kiểm tra điện áp sạc máy phát và đo áp suất nhiên liệu đường ống nạp để xử lý triệt để.',
                zaloMsg: 'Chào Ôtô Hải Hà, xe tôi đang bị: Đề dai khó nổ / chết máy bất ngờ. Xưởng tư vấn kiểm tra giúp tôi với!'
            },
            check_engine: {
                title: 'Đèn Check Engine sáng (Đèn cá vàng)',
                severity: 'warning',
                severityText: '🟡 Cần cắm máy quét lỗi OBD-II',
                cause: 'Cảm biến oxy / cảm biến đo gió (MAF) bẩn hoặc hỏng, bỏ máy (misfire bu-gi/mobin), hỏng van luân hồi khí xả EGR hoặc thủng ống nạp khí.',
                solution: 'Kỹ sư trưởng Hải Hà kết nối máy chẩn đoán đa năng chuyên hãng quét mã lỗi DTC chuẩn xác, đọc dữ liệu live-data và kiểm tra xóa lỗi miễn phí.',
                zaloMsg: 'Chào Ôtô Hải Hà, taplo xe tôi đang sáng đèn Check Engine cá vàng. Nhờ xưởng tư vấn quét mã lỗi giúp tôi!'
            }
        };

        function renderSymptomDetail(key) {
            var data = symptomData[key] || symptomData.ac;
            var html = '<div class="diag-header-row">' +
                '<div class="diag-title-wrap">' +
                '<h4 class="diag-symptom-title">' + data.title + '</h4>' +
                '<span class="diag-severity-pill ' + data.severity + '">' + data.severityText + '</span>' +
                '</div>' +
                '</div>' +
                '<div class="diag-body-grid">' +
                '<div class="diag-col-box">' +
                '<h5 class="diag-col-heading cause"><i class="fa-solid fa-triangle-exclamation"></i> Nguyên nhân tiềm ẩn:</h5>' +
                '<p class="diag-col-text">' + data.cause + '</p>' +
                '</div>' +
                '<div class="diag-col-box">' +
                '<h5 class="diag-col-heading solution"><i class="fa-solid fa-wrench"></i> Giải pháp từ Kỹ Sư Hải Hà:</h5>' +
                '<p class="diag-col-text">' + data.solution + '</p>' +
                '</div>' +
                '</div>' +
                '<div class="diag-action-bar">' +
                '<a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="diag-zalo-btn" id="diagZaloBtn">' +
                '<i class="fa-solid fa-comment-dots"></i> <span>Nhờ Kỹ Sư Trưởng Hải Hà Tư Vấn Hiện Tượng Này Qua Zalo</span>' +
                '</a>' +
                '<a href="tel:02203892207" class="diag-call-btn">' +
                '<i class="fa-solid fa-phone"></i> <span>Hotline Kỹ Thuật: <strong>02203 892 207</strong></span>' +
                '</a>' +
                '</div>';

            $('#diagnosisDetailCard').html(html);

            $('#diagZaloBtn').off('click.diag').on('click.diag', function() {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(data.zaloMsg).catch(function() {});
                }
            });
        }

        // Click Symptom Card
        $(document).on('click', '.symptom-card', function(e) {
            e.preventDefault();
            $('.symptom-card').removeClass('active');
            $(this).addClass('active');
            var key = $(this).data('symptom');
            renderSymptomDetail(key);
        });

        // Initialize Tools if container exists
        if ($('.haiha-smart-tools-section').length) {
            renderMaintChecklist();
            renderSymptomDetail('ac');
        }

    });

})(jQuery);
