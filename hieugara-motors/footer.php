<?php
/**
 * Hiếu Gara Service Footer
 * Inspired by CARPLA SERVICE
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Footer -->
<footer class="carpla-footer" id="lien-he">
    <div class="container">
        <div class="footer-cols">
            <!-- Brand & Info -->
            <div class="footer-col">
                <div class="carpla-brand" style="margin-bottom: 20px;">
                    <div class="brand-badge-logo" style="width: 36px; height: 36px; font-size: 1.1rem;">H</div>
                    <div>
                        <div class="brand-title" style="color: #ffffff; font-size: 1.1875rem;">HIẾU GARA <span style="color: var(--brand-red);">SERVICE</span></div>
                        <div class="brand-subtitle" style="color: #94a3b8;"><?php _e('HỆ THỐNG XƯỞNG DỊCH VỤ Ô TÔ', 'hieugara-motors'); ?></div>
                    </div>
                </div>
                <p style="font-size: 0.875rem; line-height: 1.7; margin-bottom: 20px; color: #94a3b8;">
                    <?php _e('Hệ thống xưởng dịch vụ ô tô toàn diện chuyên nghiệp. Áp dụng quy chuẩn quản lý chất lượng KCS đa tầng, phòng sơn sấy công nghệ cao và bảo dưỡng định kỳ chuẩn hãng.', 'hieugara-motors'); ?>
                </p>
                <div style="font-size: 0.875rem; color: #cbd5e1;">
                    <p style="margin-bottom: 6px;"><i class="fa fa-phone" style="color: var(--brand-red); width: 20px;"></i> Hotline Đặt Lịch: <strong>1900 99 88 65</strong></p>
                    <p style="margin-bottom: 6px;"><i class="fa fa-phone-volume" style="color: var(--brand-red); width: 20px;"></i> Cứu hộ 24/7: <strong>0988.567.890</strong></p>
                    <p><i class="fa fa-envelope" style="color: var(--brand-red); width: 20px;"></i> Email: <strong>service@hieugara.vn</strong></p>
                </div>
            </div>

            <!-- Service Quicklinks -->
            <div class="footer-col">
                <h4><?php _e('DỊCH VỤ CHÍNH', 'hieugara-motors'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Bảo dưỡng định kỳ 30 hạng mục', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Đồng sơn ô tô phòng sấy Ý', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Sửa chữa máy gầm chuyên sâu', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Sửa điện & điều hòa ô tô mát sâu', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Chăm sóc xe Detailing & Phủ Ceramic', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#du-toan-son-xe')); ?>"><?php _e('Dự toán chi phí sơn xe online', 'hieugara-motors'); ?></a></li>
                </ul>
            </div>

            <!-- Policy & Commitment -->
            <div class="footer-col">
                <h4><?php _e('CHÍNH SÁCH DỊCH VỤ', 'hieugara-motors'); ?></h4>
                <ul class="footer-links">
                    <li><a href="#"><?php _e('Bảo hành phụ tùng 12 - 24 tháng', 'hieugara-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Bảo hành sơn 24 - 36 tháng', 'hieugara-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Cam kết phụ tùng chính hãng 100%', 'hieugara-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Báo giá minh bạch trước khi làm', 'hieugara-motors'); ?></a></li>
                    <li><a href="#"><?php _e('Hỗ trợ hồ sơ bảo hiểm thân vỏ', 'hieugara-motors'); ?></a></li>
                </ul>
            </div>

            <!-- Workshop Locations -->
            <div class="footer-col">
                <h4><?php _e('MẠNG LƯỚI XƯỞNG HÀ NỘI', 'hieugara-motors'); ?></h4>
                <div style="font-size: 0.8125rem; color: #94a3b8; line-height: 1.6;">
                    <p style="margin-bottom: 10px;"><strong style="color: #ffffff;">Xưởng Cầu Giấy:</strong> Số 500 Cầu Giấy, Q. Cầu Giấy</p>
                    <p style="margin-bottom: 10px;"><strong style="color: #ffffff;">Xưởng Tây Hồ:</strong> Số 685 Lạc Long Quân, Q. Tây Hồ</p>
                    <p style="margin-bottom: 10px;"><strong style="color: #ffffff;">Xưởng Long Biên:</strong> Số 390 Nguyễn Văn Cừ, Q. Long Biên</p>
                    <p><strong style="color: #ffffff;">Xưởng Hoàng Mai:</strong> Số 820 Giải Phóng, Q. Hoàng Mai</p>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Hệ thống xưởng dịch vụ ô tô toàn diện tiêu chuẩn Carpla Service.', 'hieugara-motors'); ?>
            </div>
            <div style="display: flex; gap: 24px;">
                <a href="#"><?php _e('Điều khoản sử dụng', 'hieugara-motors'); ?></a>
                <a href="#"><?php _e('Chính sách bảo mật', 'hieugara-motors'); ?></a>
                <a href="#"><?php _e('Sơ đồ trang', 'hieugara-motors'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Carpla Actions -->
<div class="floating-carpla">
    <a href="https://zalo.me/0988567890" target="_blank" class="float-pill-btn float-pill-zalo" title="Chat Zalo Kỹ Thuật">
        <i class="fa-solid fa-comment-dots"></i> <span>Zalo Kỹ Thuật</span>
    </a>
    <a href="tel:0988567890" class="float-pill-btn float-pill-phone" title="Gọi Cứu Hộ / Đặt Hẹn">
        <i class="fa fa-phone"></i> <span>0988.567.890</span>
    </a>
</div>

<!-- Booking Modal -->
<div id="booking-modal" class="gara-modal">
    <div class="modal-content">
        <button type="button" class="modal-close" aria-label="Close">&times;</button>
        <span class="section-pill" style="margin-bottom: 8px;"><?php _e('ĐẶT LỊCH DỊCH VỤ TRỰC TUYẾN', 'hieugara-motors'); ?></span>
        <h3 style="font-size: 1.375rem; margin-bottom: 8px; font-weight: 800; color: var(--slate-900);"><?php _e('Tiếp Nhận & Báo Giá Xe Nhanh', 'hieugara-motors'); ?></h3>
        <p style="color: var(--slate-500); font-size: 0.875rem; margin-bottom: 20px;">
            <?php _e('Hiếu Gara sẽ chuẩn bị khoang sửa chữa và kỹ thuật viên đón tiếp chu đáo.', 'hieugara-motors'); ?>
        </p>

        <form class="hieugara-ajax-form">
            <div class="engine-field" style="margin-bottom: 12px;">
                <label><?php _e('Họ và tên Quý khách (*)', 'hieugara-motors'); ?></label>
                <input type="text" name="customer_name" class="engine-input" required placeholder="VD: Anh Nam, Chị Linh...">
            </div>

            <div class="engine-grid">
                <div class="engine-field">
                    <label><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                    <input type="tel" name="customer_phone" class="engine-input" required placeholder="09xx xxx xxx">
                </div>
                <div class="engine-field">
                    <label><?php _e('Dòng xe & Năm sản xuất', 'hieugara-motors'); ?></label>
                    <input type="text" name="car_model" class="engine-input" placeholder="VD: Mazda 3 2021...">
                </div>
            </div>

            <div class="engine-grid">
                <div class="engine-field">
                    <label><?php _e('Dịch vụ cần làm', 'hieugara-motors'); ?></label>
                    <select name="service_type" id="modal-service-select" class="engine-select">
                        <option value="Bảo dưỡng định kỳ"><?php _e('Bảo dưỡng định kỳ', 'hieugara-motors'); ?></option>
                        <option value="Đồng sơn ô tô công nghệ cao"><?php _e('Đồng sơn ô tô công nghệ cao', 'hieugara-motors'); ?></option>
                        <option value="Sửa chữa máy gầm"><?php _e('Sửa chữa máy gầm', 'hieugara-motors'); ?></option>
                        <option value="Sửa điện - điều hòa ô tô"><?php _e('Sửa điện - điều hòa ô tô', 'hieugara-motors'); ?></option>
                        <option value="Chăm sóc xe Detailing & PPF"><?php _e('Chăm sóc xe Detailing & PPF', 'hieugara-motors'); ?></option>
                        <option value="Bồi thường bảo hiểm thân vỏ"><?php _e('Bồi thường bảo hiểm thân vỏ', 'hieugara-motors'); ?></option>
                    </select>
                </div>
                <div class="engine-field">
                    <label><?php _e('Cơ sở xưởng tiếp đón', 'hieugara-motors'); ?></label>
                    <select name="branch_location" class="engine-select">
                        <option value="Xưởng Cầu Giấy (500 Cầu Giấy)">Xưởng Cầu Giấy (500 Cầu Giấy)</option>
                        <option value="Xưởng Tây Hồ (685 Lạc Long Quân)">Xưởng Tây Hồ (685 Lạc Long Quân)</option>
                        <option value="Xưởng Long Biên (390 Nguyễn Văn Cừ)">Xưởng Long Biên (390 Nguyễn Văn Cừ)</option>
                        <option value="Xưởng Hoàng Mai (820 Giải Phóng)">Xưởng Hoàng Mai (820 Giải Phóng)</option>
                    </select>
                </div>
            </div>

            <div class="engine-field" style="margin-bottom: 16px;">
                <label><?php _e('Ghi chú tình trạng xe', 'hieugara-motors'); ?></label>
                <input type="text" name="customer_note" class="engine-input" placeholder="VD: Cần kiểm tra phanh và điều hòa...">
            </div>

            <button type="submit" class="btn-carpla btn-carpla-primary" style="width: 100%; padding: 14px;">
                <i class="fa fa-calendar-check"></i> <?php _e('XÁC NHẬN ĐẶT LỊCH TIẾP NHẬN', 'hieugara-motors'); ?>
            </button>
            <div class="form-response-msg" style="display:none;"></div>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
