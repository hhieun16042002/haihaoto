/**
 * Lexus Luxury Automotive Theme - Main JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // 1. Header Scroll Effect
        var $header = $('.lexus-header');
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        });

        // 2. Mega Menu Toggle
        var $megaTrigger = $('[data-mega-menu]');
        var $megaMenu = $('#lexus-mega-menu');
        var megaTimeout;

        $megaTrigger.on('mouseenter', function() {
            clearTimeout(megaTimeout);
            $megaMenu.addClass('is-active');
        });

        $megaTrigger.on('mouseleave', function() {
            megaTimeout = setTimeout(function() {
                if (!$megaMenu.is(':hover')) {
                    $megaMenu.removeClass('is-active');
                }
            }, 200);
        });

        $megaMenu.on('mouseleave', function() {
            $megaMenu.removeClass('is-active');
        });

        // Close mega menu on escape
        $(document).on('keyup', function(e) {
            if (e.key === "Escape") {
                $megaMenu.removeClass('is-active');
                $('.lexus-modal').removeClass('is-open');
            }
        });

        // 3. Vehicle Lineup Tabs Filtering
        $('.tab-btn').on('click', function() {
            var filter = $(this).attr('data-filter');

            $('.tab-btn').removeClass('active');
            $(this).addClass('active');

            if (filter === 'all') {
                $('.car-card').fadeIn(300);
            } else {
                $('.car-card').each(function() {
                    var segments = $(this).attr('data-segments') || '';
                    if (segments.indexOf(filter) !== -1) {
                        $(this).fadeIn(300);
                    } else {
                        $(this).fadeOut(200);
                    }
                });
            }
        });

        // 4. Interactive Color Switcher
        $('.color-circle').on('click', function() {
            var $btn = $(this);
            var newImg = $btn.attr('data-image');
            var colorName = $btn.attr('data-color-name');
            var targetImgId = $btn.attr('data-target-img');
            var targetLabelId = $btn.attr('data-target-label');

            // Set active class on sibling circles
            $btn.siblings().removeClass('active');
            $btn.addClass('active');

            // Update Image with cross-fade
            var $img = $(targetImgId);
            if ($img.length && newImg) {
                $img.css('opacity', 0.2);
                setTimeout(function() {
                    $img.attr('src', newImg);
                    $img.css('opacity', 1);
                }, 200);
            }

            // Update Label
            if (targetLabelId && colorName) {
                $(targetLabelId).text(colorName);
            }
        });

        // 5. Test Drive Modal
        $('[data-open-modal="test-drive"]').on('click', function(e) {
            e.preventDefault();
            var carModel = $(this).attr('data-car-model');
            if (carModel) {
                $('#modal-car-model').val(carModel);
            }
            $('#test-drive-modal').addClass('is-open');
        });

        $('.modal-close, .lexus-modal').on('click', function(e) {
            if ($(e.target).hasClass('lexus-modal') || $(e.target).hasClass('modal-close')) {
                $('.lexus-modal').removeClass('is-open');
            }
        });

        // 6. Test Drive Form AJAX Submission
        $('.lexus-ajax-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var $msgBox = $form.find('.form-response-msg');
            var originalBtnText = $btn.text();

            $btn.prop('disabled', true).text('ĐANG XỬ LÝ...');
            $msgBox.hide().removeClass('success error');

            var formData = $form.serialize();
            formData += '&action=lexus_submit_test_drive&security=' + (window.lexus_vars ? window.lexus_vars.nonce : '');

            $.ajax({
                url: window.lexus_vars ? window.lexus_vars.ajax_url : '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $msgBox.html('<div style="color: #c5a880; padding: 12px; background: rgba(197,168,128,0.1); border: 1px solid #c5a880; border-radius: 4px; margin-top: 15px;">' + response.data.message + '</div>').fadeIn();
                        $form[0].reset();
                        setTimeout(function() {
                            $('.lexus-modal').removeClass('is-open');
                        }, 3500);
                    } else {
                        $msgBox.html('<div style="color: #ef4444; padding: 12px; background: rgba(239,68,68,0.1); border: 1px solid #ef4444; border-radius: 4px; margin-top: 15px;">' + response.data.message + '</div>').fadeIn();
                    }
                },
                error: function() {
                    $msgBox.html('<div style="color: #ef4444; padding: 12px; margin-top: 15px;">Hệ thống bận, vui lòng thử lại hoặc gọi Hotline.</div>').fadeIn();
                },
                complete: function() {
                    $btn.prop('disabled', false).text(originalBtnText);
                }
            });
        });

    });

})(jQuery);

