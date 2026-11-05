(function($) {
    'use strict';

    $(document).ready(function() {
        var $form = $('#garage-lookup-form');
        var $input = $('#lookup-plate-input');
        var $btn = $('#lookup-btn');
        var $resultArea = $('#lookup-result-area');
        var $scanner = $('#laser-scanner');

        // Sample plate click
        $(document).on('click', '.btn-sample-plate', function() {
            var plate = $(this).data('plate');
            $input.val(plate);
            $form.trigger('submit');
        });

        // Form submit
        $form.on('submit', function(e) {
            e.preventDefault();
            var plate = $.trim($input.val());
            if (!plate) return;

            $btn.prop('disabled', true).css('opacity', '0.7');
            $scanner.slideDown(200);
            $resultArea.hide().empty();

            $.ajax({
                url: garageOsFrontend.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'garage_lookup_vehicle',
                    nonce: garageOsFrontend.nonce,
                    license_plate: plate
                },
                success: function(res) {
                    setTimeout(function() {
                        $btn.prop('disabled', false).css('opacity', '1');
                        $scanner.slideUp(150);

                        if (res.success) {
                            renderResults(res.data);
                        } else {
                            renderError(res.data && res.data.message ? res.data.message : 'Không tìm thấy hồ sơ xe.');
                        }
                    }, 400); // 400ms micro-pause for laser scanner effect
                },
                error: function() {
                    $btn.prop('disabled', false).css('opacity', '1');
                    $scanner.slideUp(150);
                    renderError('Lỗi kết nối máy chủ Garage OS. Vui lòng kiểm tra kết nối mạng.');
                }
            });
        });

        function renderResults(data) {
            var v = data.vehicle;
            var wars = data.warranties || [];
            var hist = data.history || [];

            var html = '';

            // 1. Vehicle Identity Master Card (Luxury Carbon/Dark look)
            html += '<div class="vehicle-identity-card">';
            html += '  <div class="id-left-col">';
            html += '    <div class="real-car-plate-badge">';
            html += '      <span class="flag-tag">VN</span>';
            html += '      <span>' + escapeHtml(v.license_plate) + '</span>';
            html += '    </div>';
            html += '    <h3 class="vehicle-master-title">' + escapeHtml(v.car_model) + '</h3>';
            html += '    <div class="vehicle-master-owner">';
            html += '      <span><i class="fa fa-user-shield" style="color:#e11d48;"></i> Chủ sở hữu: <strong>' + escapeHtml(v.owner_name) + '</strong></span>';
            html += '      <span>&bull;</span>';
            html += '      <span><i class="fa fa-circle-check" style="color:#10b981;"></i> Hồ sơ đã định danh</span>';
            html += '    </div>';
            html += '  </div>';
            html += '  <div class="vehicle-kpi-group">';
            html += '    <div class="kpi-tile">';
            html += '      <span class="kpi-tile-val">' + v.total_visits + '</span>';
            html += '      <span class="kpi-tile-lbl">Lần Vào Xưởng</span>';
            html += '    </div>';
            html += '    <div class="kpi-tile">';
            html += '      <span class="kpi-tile-val" style="color:#10b981;">' + v.active_warranties_count + '</span>';
            html += '      <span class="kpi-tile-lbl">Bảo Hành Còn Hạn</span>';
            html += '    </div>';
            html += '  </div>';
            html += '</div>';

            // 2. Warranties Section (VIP Passport)
            if (wars.length > 0) {
                html += '<div class="portal-section-head">';
                html += '  <h4 class="portal-section-title"><i class="fa fa-award"></i> Sổ Chứng Thư Bảo Hành Điện Tử</h4>';
                html += '  <span class="portal-section-badge">' + wars.length + ' chứng thư</span>';
                html += '</div>';

                html += '<div class="warranties-deck">';
                wars.forEach(function(w) {
                    var activeClass = w.is_active ? 'is-active' : '';
                    var statusPill = w.is_active
                        ? '<span class="passport-status-pill pill-active"><i class="fa fa-shield-check"></i> Hiệu lực (' + escapeHtml(w.duration_months) + ')</span>'
                        : '<span class="passport-status-pill pill-expired"><i class="fa fa-clock"></i> Đã hết hạn</span>';

                    html += '<div class="warranty-passport-card ' + activeClass + '">';
                    html += '  <div class="passport-top">';
                    html += '    <span class="passport-code">' + escapeHtml(w.warranty_code) + '</span>';
                    html += '    ' + statusPill;
                    html += '  </div>';
                    html += '  <h5 class="passport-title">' + escapeHtml(w.item_name) + '</h5>';
                    if (w.terms) {
                        html += '  <div class="passport-terms">' + escapeHtml(w.terms) + '</div>';
                    }
                    html += '  <div class="passport-dates-bar">';
                    html += '    <span>Ngày cấp: <strong>' + escapeHtml(w.start_date) + '</strong></span>';
                    html += '    <span>Hết hạn: <strong style="color:#e11d48;">' + escapeHtml(w.end_date) + '</strong></span>';
                    html += '  </div>';
                    html += '</div>';
                });
                html += '</div>';
            }

            // 3. History Timeline Section
            if (hist.length > 0) {
                html += '<div class="portal-section-head">';
                html += '  <h4 class="portal-section-title"><i class="fa fa-history"></i> Lịch Sử Sửa Chữa & Nhật Ký Kỹ Thuật</h4>';
                html += '  <span class="portal-section-badge">' + hist.length + ' hồ sơ RO</span>';
                html += '</div>';

                html += '<div class="history-timeline">';
                hist.forEach(function(h) {
                    html += '<div class="timeline-item">';
                    html += '  <div class="timeline-marker"></div>';
                    html += '  <div class="timeline-content-card">';
                    html += '    <div class="timeline-header">';
                    html += '      <div class="timeline-date-wrap">';
                    html += '        <span class="timeline-date"><i class="fa fa-calendar-day" style="color:#e11d48;"></i> ' + escapeHtml(h.reception_date) + '</span>';
                    html += '        <span class="timeline-ro">' + escapeHtml(h.order_code) + '</span>';
                    html += '      </div>';
                    html += '      <span class="timeline-cost">' + escapeHtml(h.total_amount) + '</span>';
                    html += '    </div>';

                    html += '    <div class="timeline-meta-chips">';
                    html += '      <span class="meta-chip"><i class="fa fa-gauge"></i> ODO: <strong>' + escapeHtml(h.odo) + '</strong></span>';
                    html += '      <span class="meta-chip"><i class="fa fa-warehouse"></i> ' + escapeHtml(h.bay) + '</span>';
                    html += '      <span class="meta-chip"><i class="fa fa-user-gear"></i> KTV Trưởng: <strong>' + escapeHtml(h.lead_tech) + '</strong></span>';
                    html += '    </div>';

                    html += '    <div class="timeline-service-desc"><strong>Hạng mục tiếp nhận:</strong> ' + escapeHtml(h.service) + '</div>';

                    if (h.parts && h.parts.length > 0) {
                        html += '    <table class="timeline-parts-table">';
                        html += '      <thead><tr><th>Vật Tư / Hạng Mục Công Việc</th><th style="text-align:center;">SL</th><th style="text-align:right;">Thành Tiền</th></tr></thead>';
                        html += '      <tbody>';
                        h.parts.forEach(function(p) {
                            var tagBadge = (p.type === 'labor') 
                                ? '<span style="color:#2563eb;font-size:11px;font-weight:700;margin-left:6px;">[Công thợ]</span>'
                                : '<span style="color:#16a34a;font-size:11px;font-weight:700;margin-left:6px;">[Phụ tùng chính hãng]</span>';

                            html += '      <tr>';
                            html += '        <td><strong>' + escapeHtml(p.name) + '</strong>' + tagBadge + '</td>';
                            html += '        <td style="text-align:center;">' + (p.quantity || 1) + '</td>';
                            html += '        <td style="text-align:right;"><strong>' + formatNumber(p.total) + ' đ</strong></td>';
                            html += '      </tr>';
                        });
                        html += '      </tbody>';
                        html += '    </table>';
                    }

                    html += '  </div>';
                    html += '</div>';
                });
                html += '</div>';
            }

            $resultArea.html(html).fadeIn(300);
            $('html, body').animate({
                scrollTop: $resultArea.offset().top - 90
            }, 500);
        }

        function renderError(message) {
            var html = '<div style="background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;padding:24px;border-radius:16px;text-align:center;box-shadow:0 4px 12px rgba(225,29,72,0.08);">' +
                       '<span style="font-size:32px;display:block;margin-bottom:10px;">⚠️</span>' +
                       '<h4 style="margin:0 0 6px 0;font-size:16px;font-weight:800;color:#e11d48;">Không tìm thấy dữ liệu xe</h4>' +
                       '<p style="margin:0;font-size:13px;line-height:1.6;color:#475569;">' + escapeHtml(message) + '</p>' +
                       '</div>';
            $resultArea.html(html).fadeIn(250);
        }

        function escapeHtml(str) {
            if (!str) return '';
            return $('<div>').text(str).html();
        }

        function formatNumber(num) {
            return (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Embedded Booking form handler
        $('#garage-embedded-booking-form').on('submit', function(e) {
            e.preventDefault();
            var $f = $(this);
            var $btn = $f.find('.btn-gos-submit-booking');
            var $feedback = $f.find('.booking-feedback-msg');

            $btn.prop('disabled', true).text('Đang gửi thông tin...');
            $feedback.hide().empty();

            var formData = $f.serializeArray();
            formData.push({ name: 'action', value: 'garage_submit_booking' });
            formData.push({ name: 'nonce', value: garageOsFrontend.nonce });

            $.ajax({
                url: garageOsFrontend.ajaxUrl,
                type: 'POST',
                data: $.param(formData),
                success: function(res) {
                    $btn.prop('disabled', false).text('Xác Nhận Đặt Lịch Ngay');
                    if (res.success) {
                        $feedback.html('<div style="background:#f0fdf4;color:#16a34a;padding:14px;border-radius:8px;font-weight:700;text-align:center;">' +
                            '✅ ' + escapeHtml(res.data.message) + '<br><small>Mã tiếp nhận: <strong>' + escapeHtml(res.data.booking_code) + '</strong></small></div>').fadeIn();
                        $f[0].reset();
                    } else {
                        $feedback.html('<div style="background:#fef2f2;color:#dc2626;padding:14px;border-radius:8px;font-weight:700;text-align:center;">' +
                            '❌ ' + escapeHtml(res.data.message) + '</div>').fadeIn();
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Xác Nhận Đặt Lịch Ngay');
                    $feedback.html('<div style="background:#fef2f2;color:#dc2626;padding:14px;border-radius:8px;font-weight:700;text-align:center;">' +
                        '❌ Không thể kết nối đến hệ thống đặt lịch. Vui lòng gọi Hotline!</div>').fadeIn();
                }
            });
        });
    });
})(jQuery);
