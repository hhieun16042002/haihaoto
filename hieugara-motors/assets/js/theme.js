/**
 * Hiếu Gara Motors - Main JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // 1. Booking Modal Trigger
        $('[data-open-modal="booking"]').on('click', function(e) {
            e.preventDefault();
            var serviceTitle = $(this).attr('data-service-title');
            if (serviceTitle) {
                $('#modal-service-select').val(serviceTitle);
            }
            $('#booking-modal').addClass('is-open');
        });

        $('.modal-close, .gara-modal').on('click', function(e) {
            if ($(e.target).hasClass('gara-modal') || $(e.target).hasClass('modal-close')) {
                $('.gara-modal').removeClass('is-open');
            }
        });

        $(document).on('keyup', function(e) {
            if (e.key === "Escape") {
                $('.gara-modal').removeClass('is-open');
            }
        });

        // 2. Service Tabs Filter (if present)
        $('.service-tab-btn').on('click', function() {
            var filter = $(this).attr('data-filter');
            $('.service-tab-btn').removeClass('active');
            $(this).addClass('active');

            if (filter === 'all') {
                $('.service-card').fadeIn(300);
            } else {
                $('.service-card').each(function() {
                    var cats = $(this).attr('data-category') || '';
                    if (cats.indexOf(filter) !== -1) {
                        $(this).fadeIn(300);
                    } else {
                        $(this).fadeOut(200);
                    }
                });
            }
        });

        // 3. AJAX Booking Submission
        $('.hieugara-ajax-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var $msgBox = $form.find('.form-response-msg');
            var originalText = $btn.text();

            $btn.prop('disabled', true).text('ĐANG GỬI THÔNG TIN...');
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
                        $msgBox.html('<div style="color: #15803d; background: #dcfce7; border: 1px solid #86efac; padding: 14px; border-radius: 4px; margin-top: 15px; font-weight: 600;"><i class="fa fa-check-circle"></i> ' + response.data.message + '</div>').fadeIn();
                        $form[0].reset();
                        setTimeout(function() {
                            $('.gara-modal').removeClass('is-open');
                        }, 3500);
                    } else {
                        $msgBox.html('<div style="color: #b91c1c; background: #fee2e2; border: 1px solid #fca5a5; padding: 14px; border-radius: 4px; margin-top: 15px;"><i class="fa fa-exclamation-triangle"></i> ' + response.data.message + '</div>').fadeIn();
                    }
                },
                error: function() {
                    $msgBox.html('<div style="color: #b91c1c; background: #fee2e2; padding: 14px; border-radius: 4px; margin-top: 15px;">Có lỗi xảy ra khi gửi. Quý khách vui lòng gọi Hotline để được hỗ trợ tức thì!</div>').fadeIn();
                },
                complete: function() {
                    $btn.prop('disabled', false).text(originalText);
                }
            });
        });

    });

})(jQuery);

