(function($) {
    'use strict';

    $(document).ready(function() {

        // 1. View Toggles (Kanban vs Bay Floorplan Map)
        $('.view-toggle-btn').on('click', function() {
            var view = $(this).data('view');
            $('.view-toggle-btn').removeClass('active');
            $(this).addClass('active');

            if (view === 'kanban') {
                $('#view-floorplan-map').hide();
                $('#view-kanban-board').fadeIn(200);
            } else {
                $('#view-kanban-board').hide();
                $('#view-floorplan-map').fadeIn(200);
            }
        });

        // 2. Drag and Drop Support for Kanban Cards
        var draggedCard = null;

        $(document).on('dragstart', '.kanban-card', function(e) {
            draggedCard = this;
            $(this).addClass('is-dragging');
            e.originalEvent.dataTransfer.setData('text/plain', $(this).data('order-id'));
            e.originalEvent.dataTransfer.effectAllowed = 'move';
        });

        $(document).on('dragend', '.kanban-card', function() {
            $(this).removeClass('is-dragging');
            $('.drop-zone').removeClass('drag-over');
            draggedCard = null;
        });

        $(document).on('dragover', '.drop-zone', function(e) {
            e.preventDefault();
            e.originalEvent.dataTransfer.dropEffect = 'move';
            $(this).addClass('drag-over');
        });

        $(document).on('dragleave', '.drop-zone', function() {
            $(this).removeClass('drag-over');
        });

        $(document).on('drop', '.drop-zone', function(e) {
            e.preventDefault();
            var $zone = $(this);
            $zone.removeClass('drag-over');

            if (!draggedCard) return;

            var $card = $(draggedCard);
            var orderId = $card.data('order-id');
            var newStatus = $zone.data('status');
            var currentStatus = $card.find('.change-status-select').val();

            if (newStatus === currentStatus) return; // No change

            // Move DOM immediately
            $zone.find('.kanban-empty').remove();
            $zone.prepend($card);
            $card.find('.change-status-select').val(newStatus);

            // Trigger AJAX update
            updateOrderStatus(orderId, newStatus, $card);
        });

        // 3. Dropdown change status
        $(document).on('change', '.change-status-select', function() {
            var $select = $(this);
            var orderId = $select.data('id');
            var newStatus = $select.val();
            var $card = $select.closest('.kanban-card');

            var $targetCol = $('#col-' + newStatus);
            if ($targetCol.length) {
                $targetCol.find('.kanban-empty').remove();
                $targetCol.prepend($card);
            }

            updateOrderStatus(orderId, newStatus, $card);
        });

        function updateOrderStatus(orderId, newStatus, $card) {
            $card.css('opacity', '0.6');

            $.ajax({
                url: garageOsAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'garage_update_order_status',
                    nonce: garageOsAdmin.nonce,
                    order_id: orderId,
                    status: newStatus
                },
                success: function(res) {
                    $card.css('opacity', '1');
                    if (res.success) {
                        $card.css('border-color', '#10b981');
                        setTimeout(function() {
                            $card.css('border-color', '');
                        }, 1200);
                    } else {
                        alert(res.data && res.data.message ? res.data.message : 'Có lỗi khi cập nhật trạng thái');
                        window.location.reload();
                    }
                },
                error: function() {
                    $card.css('opacity', '1');
                    alert('Lỗi kết nối máy chủ Garage OS');
                }
            });
        }

        // 4. Booking quick confirm
        $(document).on('click', '.btn-confirm-booking', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var bookingId = $btn.data('id');

            if (!confirm('Xác nhận tiếp nhận lịch hẹn này và mở Lệnh sửa chữa (RO)?')) {
                return;
            }

            $btn.prop('disabled', true).text('Đang xử lý...');

            $.ajax({
                url: garageOsAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'garage_confirm_booking',
                    nonce: garageOsAdmin.nonce,
                    booking_id: bookingId
                },
                success: function(res) {
                    if (res.success) {
                        alert('Xác nhận thành công! Lệnh sửa chữa mới đã được phân bổ vào khoang.');
                        window.location.reload();
                    } else {
                        alert(res.data ? res.data.message : 'Lỗi xử lý');
                        $btn.prop('disabled', false).text('Tiếp Nhận & Mở RO');
                    }
                }
            });
        });

    });
})(jQuery);
