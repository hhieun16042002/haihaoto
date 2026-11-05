/**
 * Hiếu Gara - Auto Body Paint Estimator (Dự toán chi phí sơn gò ô tô)
 * Interactive Panel Synchronization (CARPLA SERVICE Standard)
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        var selectedParts = {};

        function formatVND(number) {
            return new Intl.NumberFormat('vi-VN').format(number) + ' đ';
        }

        function updatePaintEstimate() {
            var total = 0;
            var partCount = 0;
            var $list = $('#paint-selected-items');
            $list.empty();

            $.each(selectedParts, function(key, item) {
                total += item.price;
                partCount++;
                $list.append(
                    '<div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8125rem; margin-bottom: 6px; color: #e2e8f0; background: rgba(255,255,255,0.07); padding: 8px 12px; border-radius: 6px;">' +
                        '<span>' + item.name + '</span>' +
                        '<strong style="color: #38bdf8;">' + formatVND(item.price) + '</strong>' +
                    '</div>'
                );
            });

            if (partCount === 0) {
                $list.html('<div style="color: #94a3b8; font-size: 0.8125rem; font-style: italic; padding: 12px 0;">Chưa chọn bộ phận nào. Vui lòng bấm chọn các vị trí cần sơn ở danh sách bên trái.</div>');
                $('#paint-total-amount').text('0 đ');
                $('#paint-duration-text').text('Chưa chọn bộ phận');
            } else {
                $('#paint-total-amount').text(formatVND(total));
                if (partCount <= 2) {
                    $('#paint-duration-text').text('4 - 6 tiếng (Sơn sấy nhanh lấy trong ngày)');
                } else if (partCount <= 5) {
                    $('#paint-duration-text').text('1 - 2 ngày làm việc (Phòng sấy Axalta)');
                } else {
                    $('#paint-duration-text').text('3 - 5 ngày (Sơn quây tiêu chuẩn phòng sấy Đức)');
                }
            }
        }

        // Click on button selector
        $('.paint-part-btn').on('click', function() {
            var $btn = $(this);
            var partKey = $btn.attr('data-part-key');
            var partName = $btn.attr('data-part-name');
            var partPrice = parseInt($btn.attr('data-part-price'), 10) || 0;

            if (selectedParts[partKey]) {
                delete selectedParts[partKey];
                $btn.removeClass('is-selected selected');
            } else {
                if (partKey === 'full_car') {
                    selectedParts = {};
                    $('.paint-part-btn').removeClass('is-selected selected');
                } else if (selectedParts['full_car']) {
                    delete selectedParts['full_car'];
                    $('.paint-part-btn[data-part-key="full_car"]').removeClass('is-selected selected');
                }

                selectedParts[partKey] = {
                    name: partName,
                    price: partPrice
                };
                $btn.addClass('is-selected selected');
            }

            updatePaintEstimate();
        });

        // Initialize default selections (Cản trước)
        var $defaultPart = $('.paint-part-btn[data-part-key="can_truoc"]');
        if ($defaultPart.length) {
            $defaultPart.trigger('click');
        }

    });

})(jQuery);
