<?php
/**
 * Template Name: Đặt Lịch Dịch Vụ (Carpla Booking Portal)
 * The template for displaying the dedicated booking page.
 *
 * @package HieuGara_Motors
 */

get_header();

// Get parameters from URL if any
$pre_service = isset($_GET['service']) ? sanitize_text_field($_GET['service']) : '';
$pre_branch  = isset($_GET['branch']) ? sanitize_text_field($_GET['branch']) : '';
$pre_plate   = isset($_GET['plate']) ? sanitize_text_field($_GET['plate']) : '';
?>

<main id="primary" class="site-main page-booking-portal">

    <!-- Page Breadcrumb & Header -->
    <section class="portal-hero-header">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Đặt lịch tiếp nhận xe trực tuyến', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php _e('Đặt Lịch Dịch Vụ Ô Tô Chuẩn Carpla', 'hieugara-motors'); ?></h1>
            <p class="portal-page-subtitle">
                <?php _e('Chủ động lựa chọn khung giờ và chi nhánh xưởng gần bạn nhất. Hệ thống tự động giữ cầu nâng và chuẩn bị vật tư phụ tùng sẵn sàng đón xe.', 'hieugara-motors'); ?>
            </p>
        </div>
    </section>

    <!-- Main Booking Wizard Section -->
    <section class="booking-wizard-section" style="padding: 50px 0 80px; background: var(--slate-50);">
        <div class="container">
            <div class="booking-portal-layout">

                <!-- Left: 3-Step Interactive Booking Form -->
                <div class="booking-form-col">
                    <div class="wizard-card-box">

                        <!-- Wizard Steps Indicator -->
                        <div class="wizard-steps-indicator">
                            <div class="step-indicator-item active" data-step="1">
                                <span class="step-circle">1</span>
                                <span class="step-text"><?php _e('Dịch Vụ & Xe', 'hieugara-motors'); ?></span>
                            </div>
                            <div class="step-divider"></div>
                            <div class="step-indicator-item" data-step="2">
                                <span class="step-circle">2</span>
                                <span class="step-text"><?php _e('Thời Gian & Xưởng', 'hieugara-motors'); ?></span>
                            </div>
                            <div class="step-divider"></div>
                            <div class="step-indicator-item" data-step="3">
                                <span class="step-circle">3</span>
                                <span class="step-text"><?php _e('Thông Tin Chủ Xe', 'hieugara-motors'); ?></span>
                            </div>
                        </div>

                        <!-- Main AJAX Form -->
                        <form id="carpla-dedicated-booking-form" class="hieugara-ajax-form">
                            <?php wp_nonce_field('hieugara_ajax_nonce', 'security'); ?>

                            <!-- STEP 1: Dịch vụ & Dòng xe -->
                            <div class="wizard-step-pane active" id="wizard-step-1">
                                <h3 class="pane-title"><i class="fa fa-car"></i> <?php _e('Bước 1: Chọn Gói Dịch Vụ & Thông Tin Xe', 'hieugara-motors'); ?></h3>

                                <div class="form-group-block">
                                    <label class="form-label"><?php _e('Gói dịch vụ bạn muốn thực hiện (*)', 'hieugara-motors'); ?></label>
                                    <div class="service-radio-grid">
                                        <?php
                                        $service_options = [
                                            ['key' => 'Bảo dưỡng định kỳ', 'title' => 'Bảo dưỡng định kỳ', 'desc' => 'Cấp 5k, 10k, 20k, 40k km theo khuyến cáo hãng', 'icon' => 'fa-screwdriver-wrench'],
                                            ['key' => 'Đồng sơn sấy hấp công nghệ cao', 'title' => 'Đồng sơn công nghệ cao', 'desc' => 'Phục hồi vết xước, sơn sấy hấp Axalta phòng kín', 'icon' => 'fa-paint-roller'],
                                            ['key' => 'Sửa chữa máy - gầm - hộp số', 'title' => 'Sửa chữa máy - gầm', 'desc' => 'Chẩn đoán tiếng kêu gầm, đại tu máy, thước lái', 'icon' => 'fa-gears'],
                                            ['key' => 'Điện - Điều hòa ô tô chuyên sâu', 'title' => 'Điện & Điều hòa ô tô', 'desc' => 'Nội soi giàn lạnh, nạp ga, xử lý chập cháy điện', 'icon' => 'fa-snowflake'],
                                            ['key' => 'Detailing & Dán phim cách nhiệt', 'title' => 'Chăm sóc xe & Detailing', 'desc' => 'Phủ Ceramic Pro, dán phim cách nhiệt 3M, dán PPF', 'icon' => 'fa-wand-magic-sparkles'],
                                            ['key' => 'Khám xe & Cứu hộ bảo hiểm', 'title' => 'Cứu hộ & Bảo hiểm', 'desc' => 'Bồi thường bảo hiểm thân vỏ, cứu hộ xe 24/7', 'icon' => 'fa-shield-halved'],
                                        ];

                                        foreach ($service_options as $index => $opt) :
                                            $checked = ($pre_service === $opt['key'] || ($index === 0 && empty($pre_service))) ? 'checked' : '';
                                        ?>
                                            <label class="service-radio-card <?php echo $checked ? 'is-selected' : ''; ?>">
                                                <input type="radio" name="service_type" value="<?php echo esc_attr($opt['key']); ?>" <?php echo $checked; ?>>
                                                <div class="card-radio-content">
                                                    <div class="radio-icon"><i class="fa <?php echo esc_attr($opt['icon']); ?>"></i></div>
                                                    <div>
                                                        <strong class="radio-title"><?php echo esc_html($opt['title']); ?></strong>
                                                        <p class="radio-desc"><?php echo esc_html($opt['desc']); ?></p>
                                                    </div>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="form-row-2">
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Biển số xe của bạn (*)', 'hieugara-motors'); ?></label>
                                        <input type="text" name="license_plate" class="form-control" value="<?php echo esc_attr($pre_plate); ?>" placeholder="VD: 30H-888.88" style="text-transform:uppercase;font-weight:700;letter-spacing:1px;" required>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Hãng xe & Dòng xe (*)', 'hieugara-motors'); ?></label>
                                        <input type="text" name="car_model" class="form-control" placeholder="VD: Mazda CX-5 (2022)" required>
                                    </div>
                                </div>

                                <div class="wizard-btn-row">
                                    <button type="button" class="btn-carpla btn-carpla-primary btn-next-step" data-next="2">
                                        <span><?php _e('Tiếp theo: Chọn Thời Gian & Xưởng', 'hieugara-motors'); ?></span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 2: Thời gian & Xưởng -->
                            <div class="wizard-step-pane" id="wizard-step-2" style="display:none;">
                                <h3 class="pane-title"><i class="fa fa-warehouse"></i> <?php _e('Bước 2: Chọn Chi Nhánh Xưởng & Khung Giờ', 'hieugara-motors'); ?></h3>

                                <div class="form-field" style="margin-bottom: 20px;">
                                    <label class="form-label"><?php _e('Chọn cơ sở xưởng Ôtô Hải Hà tiếp nhận (*)', 'hieugara-motors'); ?></label>
                                    <select name="branch_location" class="form-control" style="font-weight: 600;">
                                        <option value="Trụ sở chính Ôtô Hải Hà">Trụ sở chính: Ôtô Hải Hà (Hải Dương &amp; Toàn quốc)</option>
                                        <option value="Dịch vụ cứu hộ kéo xe 24/7">Dịch vụ cứu hộ &amp; kéo xe 24/7 (Hotline: 0911 211 996)</option>
                                        <option value="Tiếp nhận sửa chữa lưu động">Tiếp nhận sửa chữa lưu động tại nhà / cơ quan</option>
                                    </select>
                                </div>

                                <div class="form-row-2">
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Ngày hẹn đưa xe đến (*)', 'hieugara-motors'); ?></label>
                                        <input type="date" name="booking_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Khung giờ đón tiếp (*)', 'hieugara-motors'); ?></label>
                                        <select name="booking_time" class="form-control">
                                            <option value="08:00">08:00 Sáng (Khung giờ vàng đầu ngày)</option>
                                            <option value="08:30" selected>08:30 Sáng (Ưu tiên tiếp nhận)</option>
                                            <option value="09:30">09:30 Sáng</option>
                                            <option value="11:00">11:00 Trưa</option>
                                            <option value="14:00">14:00 Chiều</option>
                                            <option value="15:30">15:30 Chiều</option>
                                            <option value="16:30">16:30 Chiều</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="wizard-btn-row">
                                    <button type="button" class="btn-carpla btn-carpla-outline btn-prev-step" data-prev="1">
                                        <i class="fa fa-arrow-left"></i> <span><?php _e('Quay lại', 'hieugara-motors'); ?></span>
                                    </button>
                                    <button type="button" class="btn-carpla btn-carpla-primary btn-next-step" data-next="3">
                                        <span><?php _e('Tiếp theo: Điền Thông Tin Chủ Xe', 'hieugara-motors'); ?></span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 3: Thông tin khách hàng & Ghi chú -->
                            <div class="wizard-step-pane" id="wizard-step-3" style="display:none;">
                                <h3 class="pane-title"><i class="fa fa-user-check"></i> <?php _e('Bước 3: Thông Tin Liên Hệ Của Bạn', 'hieugara-motors'); ?></h3>

                                <div class="form-row-2">
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Họ và tên của bạn (*)', 'hieugara-motors'); ?></label>
                                        <input type="text" name="customer_name" class="form-control" placeholder="VD: Nguyễn Hoàng Long" required>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label"><?php _e('Số điện thoại liên hệ (*)', 'hieugara-motors'); ?></label>
                                        <input type="tel" name="customer_phone" class="form-control" placeholder="0912 345 678" required>
                                    </div>
                                </div>

                                <div class="form-field" style="margin-bottom: 20px;">
                                    <label class="form-label"><?php _e('Yêu cầu kỹ thuật hoặc mô tả hiện trạng xe (nếu có):', 'hieugara-motors'); ?></label>
                                    <textarea name="customer_note" class="form-control" rows="3" placeholder="Ví dụ: Xe bị trầy xước cản trước bên phụ, gầm phát ra tiếng kêu khi đánh lái, cần lấy xe trong ngày..."></textarea>
                                </div>

                                <div class="wizard-btn-row">
                                    <button type="button" class="btn-carpla btn-carpla-outline btn-prev-step" data-prev="2">
                                        <i class="fa fa-arrow-left"></i> <span><?php _e('Quay lại', 'hieugara-motors'); ?></span>
                                    </button>
                                    <button type="submit" class="btn-carpla btn-carpla-primary btn-final-submit" style="padding: 14px 32px; font-size: 1rem;">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?php _e('HOÀN TẤT ĐẶT LỊCH HẸN NGAY', 'hieugara-motors'); ?></span>
                                    </button>
                                </div>

                                <div class="form-response-msg" style="display:none; margin-top: 20px;"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Workshop Commitment & Trust Sidebar -->
                <div class="booking-sidebar-col">
                    <div class="trust-sidebar-card">
                        <div class="trust-card-head">
                            <i class="fa fa-award" style="color: var(--brand-red); font-size: 1.5rem;"></i>
                            <h4><?php _e('Cam Kết Chất Lượng Ôtô Hải Hà Service', 'hieugara-motors'); ?></h4>
                        </div>
                        <ul class="trust-list">
                            <li>
                                <i class="fa fa-circle-check"></i>
                                <div>
                                    <strong>Không chờ đợi xếp hàng:</strong>
                                    <p>Cầu nâng thủy lực và cố vấn dịch vụ được sắp xếp sẵn sàng ngay khi xe đến xưởng.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle-check"></i>
                                <div>
                                    <strong>Báo giá điện tử minh bạch:</strong>
                                    <p>Khách hàng kiểm tra và duyệt bảng kê chi tiết phụ tùng & nhân công trước khi bắt đầu thi công.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle-check"></i>
                                <div>
                                    <strong>Chính sách bảo hành rõ ràng:</strong>
                                    <p>Cam kết bảo hành dịch vụ và phụ tùng thay thế từ 12 - 24 tháng bằng phiếu bảo hành và hóa đơn chính thức.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-circle-check"></i>
                                <div>
                                    <strong>Phòng chờ 5 sao cao cấp:</strong>
                                    <p>Máy lạnh tiện nghi, trà/cafe cao cấp và màn hình quan sát khoang thi công thời gian thực.</p>
                                </div>
                            </li>
                        </ul>

                        <div class="sidebar-hotline-box">
                            <span class="hotline-tag">CẦN HỖ TRỢ ĐẶT LỊCH NHANH?</span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_option('hieugara_hotline_phone', '0911211996'))); ?>" class="hotline-link">
                                <i class="fa fa-phone"></i> <?php echo esc_html(get_option('hieugara_hotline_phone', '0911 211 996')); ?>
                            </a>
                            <small>Hotline cứu hộ 24/7: <strong><?php echo esc_html(get_option('hieugara_rescue_phone', '0911 211 996')); ?></strong></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
jQuery(document).ready(function($) {
    // Wizard step switching
    $('.btn-next-step').on('click', function() {
        var nextStep = $(this).data('next');
        
        // Basic validation for step 1
        if (nextStep == 2) {
            var plate = $('input[name="license_plate"]').val();
            var model = $('input[name="car_model"]').val();
            if (!plate || !model) {
                alert('Vui lòng nhập Biển số xe và Dòng xe để tiếp tục.');
                return;
            }
        }

        $('.wizard-step-pane').hide();
        $('#wizard-step-' + nextStep).fadeIn(200);

        $('.step-indicator-item').removeClass('active');
        $('.step-indicator-item[data-step="' + nextStep + '"]').addClass('active');

        $('html, body').animate({
            scrollTop: $('.wizard-card-box').offset().top - 100
        }, 300);
    });

    $('.btn-prev-step').on('click', function() {
        var prevStep = $(this).data('prev');
        $('.wizard-step-pane').hide();
        $('#wizard-step-' + prevStep).fadeIn(200);

        $('.step-indicator-item').removeClass('active');
        $('.step-indicator-item[data-step="' + prevStep + '"]').addClass('active');
    });

    // Radio card highlight
    $('.service-radio-card input[type="radio"]').on('change', function() {
        $('.service-radio-card').removeClass('is-selected');
        $(this).closest('.service-radio-card').addClass('is-selected');
    });
});
</script>

<?php
get_footer();
