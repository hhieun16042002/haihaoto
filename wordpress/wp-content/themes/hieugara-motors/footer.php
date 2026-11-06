<?php
/**
 * Ôtô Hải Hà - ShiftUp Luxury Workshop Footer
 * Matching ShiftUp Car Workshop Design System
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$tech_phone    = get_option('hieugara_tech_phone', '0915 041 989');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$topbar_email  = get_option('hieugara_topbar_email', 'garaotohaiha@gmail.com');
$topbar_hours  = get_option('hieugara_topbar_hours', '07:30 - 18:30 (T2 - CN)');
$warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$tech_clean    = preg_replace('/[^0-9]/', '', $tech_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);
?>

<!-- =========================================================================
     SHIFTUP LUXURY WORKSHOP FOOTER (STREAMLINED LIGHT LUXURY 3-COLUMN)
     ========================================================================= -->
<footer class="shiftup-main-footer" id="shiftupFooter">

    <!-- Main Footer 3 Columns -->
    <div class="footer-main-body">
        <div class="container">
            <div class="footer-grid-3col">

                <!-- Column 1: Brand, Slogan & Quick Contacts -->
                <div class="footer-col col-brand">
                    <div class="footer-brand-wrap">
                        <div class="footer-brand-logo">
                            <?php $footer_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'; ?>
                            <img src="<?php echo esc_url($footer_logo_url); ?>" alt="Ôtô Hải Hà" width="54" height="54">
                        </div>
                        <div class="footer-brand-heading">
                            <span class="brand-name">ÔTÔ <span class="brand-tag">HẢI HÀ</span></span>
                            <span class="brand-tagline">Uy tín chất lượng làm nên thương hiệu</span>
                        </div>
                    </div>

                    <p class="footer-brand-desc">
                        <strong>Ôtô Hải Hà (1995 - <?php echo date('Y'); ?>):</strong> 31 năm kinh nghiệm bảo dưỡng, sửa chữa máy gầm, điện điều hòa và đồng sơn công nghệ cao với đội ngũ 80 nhân sự tận tâm.
                    </p>

                    <div class="footer-contact-chips">
                        <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="contact-chip">
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <small>TỔNG ĐÀI XƯỞNG</small>
                                <strong><?php echo esc_html($hotline_phone); ?></strong>
                            </div>
                        </a>
                        <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="contact-chip chip-rescue">
                            <i class="fa-solid fa-truck-pickup"></i>
                            <div>
                                <small>CỨU HỘ 24/7</small>
                                <strong><?php echo esc_html($rescue_phone); ?></strong>
                            </div>
                        </a>
                        <a href="tel:<?php echo esc_attr($tech_clean); ?>" class="contact-chip">
                            <i class="fa-solid fa-wrench"></i>
                            <div>
                                <small>KỸ THUẬT &amp; ĐẶT LỊCH</small>
                                <strong><?php echo esc_html($tech_phone); ?></strong>
                            </div>
                        </a>
                        <div class="contact-chip">
                            <i class="fa-solid fa-clock"></i>
                            <div>
                                <small>GIỜ LÀM VIỆC</small>
                                <span><?php echo esc_html($topbar_hours); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="footer-social-row">
                        <a href="https://www.facebook.com/profile.php?id=100069673756551" target="_blank" rel="noopener" class="footer-fb-pill">
                            <i class="fa-brands fa-facebook-f"></i>
                            <span>Fanpage Ôtô Hải Hà</span>
                        </a>
                        <a href="mailto:<?php echo esc_attr($topbar_email); ?>" class="footer-mail-pill">
                            <i class="fa-solid fa-envelope"></i>
                            <span><?php echo esc_html($topbar_email); ?></span>
                        </a>
                    </div>
                </div>

                <!-- Column 2: 6 Core Service Pillars & Quick Links -->
                <div class="footer-col col-services">
                    <h4 class="footer-col-title">
                        <span class="title-square"></span>
                        DỊCH VỤ TRỌNG TÂM
                    </h4>
                    <ul class="footer-links-list footer-services-2col-mobile">
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-o-to/')); ?>">
                                <span>01. Bảo Dưỡng Ô Tô Định Kỳ</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to/')); ?>">
                                <span>02. Sửa Chữa Máy, Gầm &amp; Hộp Số</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/dien-o-to-dieu-hoa/')); ?>">
                                <span>03. Điện, Chẩn Đoán ECU &amp; Điều Hòa</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/dong-son-o-to/')); ?>">
                                <span>04. Đồng Sơn Phòng Sấy &amp; Thân Vỏ</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/cham-soc-nang-cap-o-to/')); ?>">
                                <span>05. Chăm Sóc Detailing &amp; Phụ Kiện</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-ho-tro-o-to/')); ?>" class="highlight-link">
                                <span>06. Cứu Hộ Giao Thông 24/7</span>
                                <span class="badge-mini">24/7</span>
                            </a>
                        </li>
                    </ul>

                    <div class="footer-quick-actions">
                        <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="footer-action-link">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span>Đặt lịch hẹn trực tuyến</span>
                        </a>
                        <a href="<?php echo esc_url($warranty_url); ?>" class="footer-action-link">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Tra cứu bảo hành điện tử</span>
                        </a>
                    </div>
                </div>

                <!-- Column 3: Google Maps & Direct Navigation -->
                <div class="footer-col col-map">
                    <h4 class="footer-col-title">
                        <span class="title-square"></span>
                        BẢN ĐỒ CHỈ ĐƯỜNG
                    </h4>
                    <div class="footer-map-card">
                        <div class="footer-map-frame">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.4117844346224!2d106.2953139!3d20.9359722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31359b66f542968b%3A0xd5b45cb9b6b0359!2zR2FyYSDDlCB0w7QgSOG6o2kgSMOg!5e0!3m2!1svi!2s!4v1793862274528!5m2!1svi!2s" 
                                width="100%" 
                                height="175" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="strict-origin-when-cross-origin"
                                title="Bản đồ chỉ đường Ôtô Hải Hà">
                            </iframe>
                        </div>

                        <div class="map-card-info">
                            <div class="map-info-row">
                                <div class="map-badge-wrap">
                                    <span class="map-live-dot"></span>
                                    <strong class="map-loc-title">GARAGE ÔTÔ HẢI HÀ</strong>
                                </div>
                                <a href="https://maps.google.com/?cid=15399047910545937753" target="_blank" rel="noopener" class="map-direct-btn">
                                    <span>Chỉ đường</span>
                                    <i class="fa-solid fa-location-arrow"></i>
                                </a>
                            </div>
                            <p class="map-loc-desc">
                                Km 3 + 500 Đường Nguyễn Lương Bằng, TP. Hải Dương
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom Strip -->
    <div class="footer-bottom-bar">
        <div class="container footer-bottom-inner">
            <div class="bottom-copyright">
                <span class="copy-text">© <?php echo date('Y'); ?> <strong>Ôtô Hải Hà</strong> — Uy tín chất lượng làm nên thương hiệu.</span>
            </div>

            <div class="bottom-extra-links">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">Giới Thiệu</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>">Dịch Vụ</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>">Bảng Giá</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">Liên Hệ</a>
            </div>

            <div class="bottom-back-to-top">
                <button type="button" id="footerBackToTop" class="back-to-top-btn" aria-label="Lên đầu trang">
                    <span class="btn-top-text">LÊN ĐẦU</span>
                    <span class="btn-top-icon"><i class="fa-solid fa-arrow-up"></i></span>
                </button>
            </div>
        </div>
    </div>

</footer>

<!-- =========================================================================
     SHIFTUP HIGH-TECH FLOATING ACTION DOCK (Fixed Bottom-Right)
     ========================================================================= -->
<div class="shiftup-floating-dock" id="shiftupFloatingDock">
    <!-- Hotline Cứu Hộ 24/7 -->
    <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="float-dock-pill dock-rescue" title="Gọi cứu hộ 24/7 khẩn cấp: <?php echo esc_attr($rescue_phone); ?>">
        <div class="dock-pulse-beacon">
            <span class="pulse-ring"></span>
            <span class="pulse-dot"></span>
        </div>
        <i class="fa-solid fa-truck-pickup"></i>
        <span class="dock-text">CỨU HỘ: <?php echo esc_html($rescue_phone); ?></span>
    </a>

    <!-- Zalo Kỹ Thuật -->
    <a href="https://zalo.me/<?php echo esc_attr($tech_clean); ?>" target="_blank" rel="noopener" class="float-dock-pill dock-zalo" title="Tư vấn kỹ thuật qua Zalo: <?php echo esc_attr($tech_phone); ?>">
        <i class="fa-solid fa-comment-dots"></i>
        <span class="dock-text">ZALO KỸ THUẬT</span>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
