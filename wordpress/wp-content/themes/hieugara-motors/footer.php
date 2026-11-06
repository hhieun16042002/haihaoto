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
     SHIFTUP LUXURY WORKSHOP FOOTER
     ========================================================================= -->
<footer class="shiftup-main-footer" id="shiftupFooter">

    <!-- Main Footer 4 Columns -->
    <div class="footer-main-body">
        <div class="container">
            <div class="footer-grid-4col">

                <!-- Column 1: Brand & Contact Info -->
                <div class="footer-col col-brand">
                    <div class="footer-brand-wrap">
                        <div class="footer-brand-logo">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>" alt="Ôtô Hải Hà" width="50" height="50">
                        </div>
                        <div class="footer-brand-heading">
                            <span class="brand-name">ÔTÔ <span class="brand-tag">HẢI HÀ</span></span>
                            <span class="brand-tagline">TRUNG TÂM BẢO DƯỠNG &amp; SỬA CHỮA Ô TÔ CHUYÊN NGHIỆP</span>
                        </div>
                    </div>

                    <p class="footer-brand-desc">
                        <strong>Ôtô Hải Hà: 31 năm giữ trọn chữ Tâm với nghề (1995 - <?php echo date('Y'); ?>).</strong> Khởi nguồn từ cái tâm người thợ của nhà sáng lập Nguyễn Hải Hà, ngày nay Hải Hà tự hào sở hữu đội ngũ 80 nhân sự chuyên nghiệp, phục vụ tận tâm trên từng chiếc xe của bạn.
                    </p>

                    <div class="footer-social-strip" style="margin-bottom: 20px;">
                        <a href="https://www.facebook.com/profile.php?id=100069673756551" target="_blank" rel="noopener" class="footer-fb-btn" style="display: inline-flex; align-items: center; gap: 10px; background: #1877f2; color: #ffffff; padding: 8px 16px; border-radius: 4px; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none; transition: transform 0.2s, background 0.2s;">
                            <i class="fa-brands fa-facebook-f" style="font-size: 1.05rem;"></i>
                            <span>Fanpage Ôtô Hải Hà</span>
                            <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem; opacity: 0.8;"></i>
                        </a>
                    </div>

                    <div class="footer-quick-contacts">
                        <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="quick-contact-item">
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <small>TỔNG ĐÀI TIẾP NHẬN XƯỞNG</small>
                                <strong><?php echo esc_html($hotline_phone); ?></strong>
                            </div>
                        </a>
                        <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="quick-contact-item">
                            <i class="fa-solid fa-truck-pickup"></i>
                            <div>
                                <small>HOTLINE CỨU HỘ 24/7</small>
                                <strong><?php echo esc_html($rescue_phone); ?></strong>
                            </div>
                        </a>
                        <a href="tel:<?php echo esc_attr($tech_clean); ?>" class="quick-contact-item">
                            <i class="fa-solid fa-wrench"></i>
                            <div>
                                <small>HỖ TRỢ KỸ THUẬT &amp; ĐẶT LỊCH</small>
                                <strong><?php echo esc_html($tech_phone); ?></strong>
                            </div>
                        </a>
                        <a href="mailto:<?php echo esc_attr($topbar_email); ?>" class="quick-contact-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div>
                                <small>EMAIL LIÊN HỆ</small>
                                <span><?php echo esc_html($topbar_email); ?></span>
                            </div>
                        </a>
                        <div class="quick-contact-item">
                            <i class="fa-solid fa-clock"></i>
                            <div>
                                <small>THỜI GIAN LÀM VIỆC</small>
                                <span><?php echo esc_html($topbar_hours); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: 6 SEO Master Service Categories -->
                <div class="footer-col col-services">
                    <h4 class="footer-col-title">
                        <span class="title-square"></span>
                        HỆ THỐNG DỊCH VỤ Ô TÔ
                    </h4>
                    <ul class="footer-links-list">
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-dinh-ky/')); ?>">
                                <span>01. Bảo Dưỡng Ô Tô (Định Kỳ &amp; Thay Dầu)</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dong-co/')); ?>">
                                <span>02. Sửa Chữa Ô Tô (Máy, Hộp Số, Phanh, Gầm)</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dien-o-to/')); ?>">
                                <span>03. Điện &amp; Điều Hòa Ô Tô (ECU &amp; Làm Mát)</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/son-o-to/')); ?>">
                                <span>04. Đồng Sơn &amp; Ngoại Thất (Sấy Hấp &amp; Gò Hàn)</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/cham-soc-va-lam-dep-xe-detailing/')); ?>">
                                <span>05. Chăm Sóc &amp; Nâng Cấp (Detailing &amp; PPF)</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-giao-thong-o-to/')); ?>" class="highlight-link">
                                <span>06. Dịch Vụ Hỗ Trợ Ô Tô (Cứu Hộ 24/7 &amp; Đăng Kiểm)</span>
                                <span class="badge-mini">24/7</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Policies & Warranties -->
                <div class="footer-col col-policies">
                    <h4 class="footer-col-title">
                        <span class="title-square"></span>
                        CHÍNH SÁCH &amp; CAM KẾT
                    </h4>
                    <ul class="footer-links-list">
                        <li>
                            <a href="<?php echo esc_url($warranty_url); ?>" class="highlight-link">
                                <span>Tra Cứu Bảo Hành Điện Tử</span>
                                <span class="badge-mini">HOT</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>">
                                <span>Bảng Giá Dịch Vụ Niêm Yết</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">
                                <span>Quy Chuẩn Kiểm Định KCS 5 Cấp</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/ve-chung-toi/#cam-ket')); ?>">
                                <span>Cam Kết Phụ Tùng OEM Chính Hãng</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/ve-chung-toi/#chinh-sach-bao-hanh')); ?>">
                                <span>Bảo Hành Màu Sơn Sấy Hấp 24 Tháng</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">
                                <span>Đặt Hẹn Trực Tuyến Tiết Kiệm 30 Phút</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/ve-chung-toi/#bao-hiem')); ?>">
                                <span>Hỗ Trợ Giám Định Bảo Hiểm Thân Vỏ</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>">
                                <span>Tìm Đường Đến Ôtô Hải Hà</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Google Maps Interactive Embed -->
                <div class="footer-col col-map">
                    <h4 class="footer-col-title">
                        <span class="title-square"></span>
                        BẢN ĐỒ GARA HẢI HÀ
                    </h4>
                    <div class="footer-map-card">
                        <!-- Responsive Google Maps Embed -->
                        <div class="footer-map-frame">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.4117844346224!2d106.2953139!3d20.9359722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31359b66f542968b%3A0xd5b45cb9b6b0359!2zR2FyYSDDlCB0w7QgSOG6o2kgSMOg!5e0!3m2!1svi!2s!4v1793862274528!5m2!1svi!2s" 
                                width="100%" 
                                height="220" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="strict-origin-when-cross-origin"
                                title="Bản đồ chỉ đường Ôtô Hải Hà">
                            </iframe>
                        </div>

                        <div class="map-card-info">
                            <div class="map-badge-wrap">
                                <span class="map-live-dot"></span>
                                <strong class="map-loc-title">ÔTÔ HẢI HÀ</strong>
                            </div>
                            <p class="map-loc-desc">
                                Xưởng dịch vụ chẩn đoán kỹ thuật, sửa chữa máy gầm, điều hòa &amp; phòng sơn sấy hấp.
                            </p>
                            <div class="map-loc-hotlines">
                                <span><i class="fa-solid fa-phone text-orange"></i> <?php echo esc_html($hotline_phone); ?></span>
                                <span class="sep">•</span>
                                <span><i class="fa-solid fa-truck-pickup text-orange"></i> <?php echo esc_html($rescue_phone); ?></span>
                            </div>
                            <a href="https://maps.google.com/?cid=15399047910545937753" target="_blank" rel="noopener" class="map-direct-btn">
                                <span>Mở Google Maps chỉ đường</span>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
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
                <span class="copy-text">© <?php echo date('Y'); ?> <strong>Ôtô Hải Hà</strong>. Trung tâm bảo dưỡng, sửa chữa &amp; đồng sơn ô tô chuyên nghiệp.</span>
            </div>

            <div class="bottom-extra-links">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">Về Chúng Tôi</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>">Báo Giá Dịch Vụ</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url($warranty_url); ?>">Bảo Hành Điện Tử</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">Đặt Lịch Sửa Chữa</a>
            </div>

            <div class="bottom-back-to-top">
                <button type="button" id="footerBackToTop" class="back-to-top-btn" aria-label="Lên đầu trang">
                    <span class="btn-top-text">LÊN ĐẦU TRANG</span>
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
