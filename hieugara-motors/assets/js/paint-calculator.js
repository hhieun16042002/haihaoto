/**
 * Hiếu Gara - Auto Body Paint Estimator (Dự toán chi phí sơn gò ô tô)
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
                $list.append('<div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 8px; color: #cbd5e1;"><span>' + item.name + '</span><strong style="color: #ffffff;">' + formatVND(item.price) + '</strong></div>');
            });

            if (partCount === 0) {
                $list.html('<div style="color: #94a3b8; font-size: 0.875rem; font-style: italic;">Chưa chọn bộ phận nào. Vui lòng bấm chọn các vị trí cần sơn ở bên trái.</div>');
                $('#paint-total-amount').text('0 đ');
                $('#paint-duration-text').text('--');
            } else {
                $('#paint-total-amount').text(formatVND(total));
                if (partCount <= 2) {
                    $('#paint-duration-text').text('4 - 6 tiếng (Lấy trong ngày)');
                } else if (partCount <= 5) {
                    $('#paint-duration-text').text('1 - 2 ngày làm việc');
                } else {
                    $('#paint-duration-text').text('3 - 5 ngày (Sơn quây tiêu chuẩn phòng sấy)');
                }
            }
        }

        $('.paint-part-btn').on('click', function() {
            var $btn = $(this);
            var partKey = $btn.attr('data-part-key');
            var partName = $btn.attr('data-part-name');
            var partPrice = parseInt($btn.attr('data-part-price'), 10) || 0;

            if (selectedParts[partKey]) {
                delete selectedParts[partKey];
                $btn.removeClass('selected');
            } else {
                // Special case: if selecting 'full_car', clear other parts
                if (partKey === 'full_car') {
                    selectedParts = {};
                    $('.paint-part-btn').removeClass('selected');
                } else if (selectedParts['full_car']) {
                    delete selectedParts['full_car'];
                    $('.paint-part-btn[data-part-key="full_car"]').removeClass('selected');
                }

                selectedParts[partKey] = {
                    name: partName,
                    price: partPrice
                };
                $btn.addClass('selected');
            }

            updatePaintEstimate();
        });

        // Initialize default selections (VD: Cản trước)
        var $defaultPart = $('.paint-part-btn[data-part-key="can_truoc"]');
        if ($defaultPart.length) {
            $defaultPart.trigger('click');
        }

    });

})(jQuery);

