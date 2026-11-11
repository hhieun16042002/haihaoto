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

        // 1-Click GPS Location Retrieval
        $(document).on('click', '#rescueGetGpsBtn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $status = $('#rescueGpsStatus');

            if (!navigator.geolocation) {
                $status.html('<span class="gps-status-badge error"><i class="fa-solid fa-circle-exclamation"></i> Trình duyệt không hỗ trợ GPS tự động. Vui lòng nhập địa chỉ bên dưới:</span>');
                $('#rescueManualAddress').focus();
                return;
            }

            if (rescueState.isLocating) return;
            rescueState.isLocating = true;

            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> <span>Đang định vị vệ tinh...</span>');
            $status.html('<span class="gps-status-badge locating"><i class="fa-solid fa-spinner fa-spin"></i> Đang kết nối vệ tinh GPS...</span>');

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    rescueState.isLocating = false;
                    $btn.prop('disabled', false);
                    rescueState.lat = pos.coords.latitude;
                    rescueState.lng = pos.coords.longitude;
                    rescueState.accuracy = Math.round(pos.coords.accuracy);

                    var latStr = rescueState.lat.toFixed(5);
                    var lngStr = rescueState.lng.toFixed(5);
                    var mapsUrl = 'https://maps.google.com/?q=' + rescueState.lat + ',' + rescueState.lng;

                    $btn.addClass('is-success').html('<i class="fa-solid fa-circle-check"></i> <span>Đã lấy tọa độ GPS</span>');
                    $status.html(
                        '<span class="gps-status-badge success">' +
                        '<i class="fa-solid fa-location-dot"></i> ' + latStr + ', ' + lngStr + ' (±' + rescueState.accuracy + 'm) ' +
                        '<a href="' + mapsUrl + '" target="_blank" rel="noopener" class="gps-maps-link">Xem bản đồ</a>' +
                        '</span>'
                    );

                    var currentManual = $('#rescueManualAddress').val().trim();
                    if (!currentManual) {
                        $('#rescueManualAddress').val('Tọa độ GPS: ' + latStr + ', ' + lngStr + ' (Sai số ~' + rescueState.accuracy + 'm)');
                    }
                },
                function(err) {
                    rescueState.isLocating = false;
                    $btn.prop('disabled', false).html('<i class="fa-solid fa-crosshairs"></i> <span>Thử lấy lại GPS</span>');
                    var errMsg = 'Không lấy được GPS';
                    if (err.code === 1) {
                        errMsg = 'Bạn đã từ chối quyền truy cập vị trí';
                    } else if (err.code === 2) {
                        errMsg = 'Tín hiệu GPS không khả dụng';
                    } else if (err.code === 3) {
                        errMsg = 'Quá thời gian kết nối GPS';
                    }
                    $status.html('<span class="gps-status-badge error"><i class="fa-solid fa-circle-exclamation"></i> ' + errMsg + '. Vui lòng nhập địa chỉ bên dưới:</span>');
                    $('#rescueManualAddress').focus();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 12000,
                    maximumAge: 30000
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

    });

})(jQuery);
