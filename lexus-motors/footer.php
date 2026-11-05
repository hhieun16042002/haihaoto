<?php
/**
 * Lexus Motors Theme Footer
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Footer -->
<footer class="lexus-footer" id="lien-he">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand & Showrooms -->
            <div class="footer-col">
                <div class="lexus-brand" style="margin-bottom: 20px;">
                    <span class="lexus-logo-text" style="font-size: 1.25rem;">LEXUS VIỆT NAM</span>
                </div>
                <p style="color: var(--text-secondary); font-size: 0.875rem; margin-bottom: 24px; line-height: 1.7;">
                    <?php _e('Trải nghiệm đỉnh cao của sự hoàn mỹ. Khám phá dải sản phẩm xe sang tiên phong, công nghệ điện hóa Hybrid thông minh và dịch vụ hiếu khách Omotenashi chuẩn mực Nhật Bản.', 'lexus-motors'); ?>
                </p>
                <div style="font-size: 0.875rem; color: var(--text-secondary);">
                    <p style="margin-bottom: 8px;"><strong style="color: var(--text-primary);"><?php _e('Hà Nội:', 'lexus-motors'); ?></strong> Lexus Thăng Long - Ngã tư Phạm Hùng & Dương Đình Nghệ, Cầu Giấy</p>
                    <p><strong style="color: var(--text-primary);"><?php _e('TP. Hồ Chí Minh:', 'lexus-motors'); ?></strong> Lexus Trung Tâm Sài Gòn - 264 Trần Hưng Đạo, P. Nguyễn Cư Trinh, Quận 1</p>
                </div>
            </div>

            <!-- Vehicle Links -->
            <div class="footer-col">
                <h4><?php _e('DÒNG XE', 'lexus-motors'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('lexus_vehicle')); ?>"><?php _e('Tất cả dòng xe', 'lexus-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dong-xe')); ?>"><?php _e('Lexus RX (SUV hạng sang)', 'lexus-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dong-xe')); ?>"><?php _e('Lexus LX 600 (Chuyên cơ)', 'lexus-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dong-xe')); ?>"><?php _e('Lexus ES (Sedan lịch lãm)', 'lexus-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dong-xe')); ?>"><?php _e('Lexus NX 350h (Hybrid)', 'lexus-motors'); ?></a></li>
                </ul>
            </div>

            <!-- Services & Experience -->
            <div class="footer-col">
                <h4><?php _e('DỊCH VỤ & BẢO HÀNH', 'lexus-motors'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/#du-toan-chi-phi')); ?>"><?php _e('Dự toán chi phí lăn bánh', 'lexus-motors'); ?></a></li>
                    <li><a href="#" data-open-modal="test-drive"><?php _e('Đăng ký lái thử xe', 'lexus-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Bảo dưỡng miễn phí 3 năm', 'lexus-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Bảo hành 5 năm không giới hạn km', 'lexus-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Bảo hành Pin Hybrid 7 năm', 'lexus-motors'); ?></a></li>
                </ul>
            </div>

            <!-- Hotline & Booking -->
            <div class="footer-col">
                <h4><?php _e('HỖ TRỢ KHÁCH HÀNG', 'lexus-motors'); ?></h4>
                <p style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 16px;">
                    <?php _e('Liên hệ đường dây nóng 24/7 để nhận tư vấn chi tiết từ chuyên gia sản phẩm Lexus.', 'lexus-motors'); ?>
                </p>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--accent-gold); margin-bottom: 20px; font-family: var(--font-display);">
                    1800 6868
                </div>
                <a href="#dang-ky-lai-thu" class="btn-lexus btn-lexus-gold" style="width: 100%;" data-open-modal="test-drive">
                    <?php _e('YÊU CẦU TƯ VẤN NGAY', 'lexus-motors'); ?>
                </a>
            </div>
        </div>

        <!-- Bottom Legal -->
        <div class="footer-bottom">
            <div>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Bản quyền thuộc về Lexus Việt Nam. Tất cả các quyền được bảo lưu.', 'lexus-motors'); ?>
            </div>
            <div style="display: flex; gap: 24px;">
                <a href="#"><?php _e('Chính sách bảo mật', 'lexus-motors'); ?></a>
                <a href="#"><?php _e('Điều khoản sử dụng', 'lexus-motors'); ?></a>
                <a href="#"><?php _e('Sơ đồ trang', 'lexus-motors'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Global Test Drive Modal -->
<div id="test-drive-modal" class="lexus-modal">
    <div class="modal-content">
        <button type="button" class="modal-close" aria-label="Close">&times;</button>
        <span class="subtitle-gold"><?php _e('TRẢI NGHIỆM ĐỈNH CAO', 'lexus-motors'); ?></span>
        <h3 class="title-luxury" style="font-size: 1.5rem; margin-bottom: 16px;"><?php _e('Đăng Ký Lái Thử Xe Lexus', 'lexus-motors'); ?></h3>
        <p style="color: var(--text-secondary); font-size: 0.875rem; margin-bottom: 24px;">
            <?php _e('Quý khách vui lòng cung cấp thông tin để nhân viên Lexus phục vụ đón tiếp chu đáo nhất.', 'lexus-motors'); ?>
        </p>

        <form class="lexus-ajax-form">
            <div class="form-field">
                <label><?php _e('Họ và tên của Quý khách (*)', 'lexus-motors'); ?></label>
                <input type="text" name="customer_name" class="form-control" required placeholder="VD: Nguyễn Văn A">
            </div>

            <div class="form-grid-2">
                <div class="form-field">
                    <label><?php _e('Số điện thoại (*)', 'lexus-motors'); ?></label>
                    <input type="tel" name="customer_phone" class="form-control" required placeholder="09xx xxx xxx">
                </div>
                <div class="form-field">
                    <label><?php _e('Email nhận thông tin', 'lexus-motors'); ?></label>
                    <input type="email" name="customer_email" class="form-control" placeholder="email@domain.com">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-field">
                    <label><?php _e('Dòng xe muốn trải nghiệm', 'lexus-motors'); ?></label>
                    <select name="car_model" id="modal-car-model" class="form-control">
                        <option value="Lexus RX 350 Luxury">Lexus RX 350 Luxury</option>
                        <option value="Lexus LX 600 VIP">Lexus LX 600 VIP</option>
                        <option value="Lexus ES 250 F SPORT">Lexus ES 250 F SPORT</option>
                        <option value="Lexus NX 350h Hybrid">Lexus NX 350h Hybrid</option>
                        <option value="Lexus LS 500h Flagship">Lexus LS 500h Flagship</option>
                    </select>
                </div>
                <div class="form-field">
                    <label><?php _e('Đại lý đón tiếp', 'lexus-motors'); ?></label>
                    <select name="dealer_city" class="form-control">
                        <option value="Hà Nội - Lexus Thăng Long">Lexus Thăng Long (Hà Nội)</option>
                        <option value="TP.HCM - Lexus Trung Tâm Sài Gòn">Lexus Trung Tâm Sài Gòn (TP.HCM)</option>
                        <option value="Lái thử tại nhà riêng">Yêu cầu lái thử tại nhà riêng</option>
                    </select>
                </div>
            </div>

            <div class="form-field">
                <label><?php _e('Ghi chú hoặc yêu cầu đặc biệt', 'lexus-motors'); ?></label>
                <input type="text" name="customer_note" class="form-control" placeholder="Thời gian thuận tiện lái thử...">
            </div>

            <button type="submit" class="btn-lexus btn-lexus-gold" style="width: 100%; margin-top: 10px;">
                <?php _e('XÁC NHẬN ĐĂNG KÝ TRẢI NGHIỆM', 'lexus-motors'); ?>
            </button>
            <div class="form-response-msg" style="display:none;"></div>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>

