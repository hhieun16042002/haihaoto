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

$phone_rescue  = '0911 211 996';
$phone_tech    = '0915 041 989';
$phone_landline= '02203 892 207';
$rescue_phone  = $phone_rescue;
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$tech_phone    = $phone_tech;
$tech_clean    = preg_replace('/[^0-9]/', '', $tech_phone);
$topbar_email  = get_option('hieugara_topbar_email', 'thanhotohaiha@gmail.com');
$warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
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
                            <?php $footer_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png?v=' . HIEUGARA_THEME_VERSION; ?>
                            <img src="<?php echo esc_url($footer_logo_url); ?>" alt="Ôtô Hải Hà" width="54" height="54">
                        </div>
                        <div class="footer-brand-heading">
                            <span class="brand-name">ÔTÔ <span class="brand-tag">HẢI HÀ</span></span>
                            <span class="brand-tagline">Uy tín - chất lượng - hiệu quả là sự tồn tại của doanh nghiệp</span>
                        </div>
                    </div>

                    <div class="footer-contact-block">
                        <h4 class="footer-col-title footer-contact-title">
                            LIÊN HỆ
                        </h4>
                        <!-- Unified Single Box for All Phone Numbers (Chỉ hiện SĐT & màu đen) -->
                        <div class="footer-contact-unified-box">
                            <div class="contact-box-lines">
                                <a href="tel:0911211996" class="contact-box-line" title="Gọi 0911 211 996">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0911 211 996</span>
                                </a>
                                <a href="tel:0915041989" class="contact-box-line" title="Gọi 0915 041 989">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0915 041 989</span>
                                </a>
                                <a href="tel:02203892207" class="contact-box-line" title="Gọi 02203 892 207">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>02203 892 207</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="footer-social-row">
                        <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="footer-zalo-pill" title="Chat Zalo: 0911 211 996">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span>Zalo: 0911 211 996</span>
                        </a>
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
                        DỊCH VỤ TRỌNG TÂM
                    </h4>
                    <ul class="footer-links-list footer-services-2col-mobile">
                        <!-- 1. Dịch Vụ Xe VinFast (First Item) -->
                        <li>
                            <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>" class="highlight-link vf-footer-link" style="color: #D4B996 !important; font-weight: 700;">
                                <span>Dịch vụ xe VinFast</span>
                                <span class="badge-mini" style="background:#D4B996;color:#141414;font-weight:800;">HÃNG</span>
                            </a>
                        </li>
                        <?php
                        $footer_cats = get_terms(array(
                            'taxonomy'   => 'service_category',
                            'parent'     => 0,
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                        ));
                        if (!empty($footer_cats) && !is_wp_error($footer_cats)) :
                            foreach ($footer_cats as $f_cat) :
                                $f_link = home_url('/dich-vu/' . $f_cat->slug . '/');
                                $is_rescue = strpos($f_cat->slug, 'cuu-ho') !== false;
                        ?>
                            <li>
                                <a href="<?php echo esc_url($f_link); ?>" class="<?php echo $is_rescue ? 'highlight-link' : ''; ?>">
                                    <span><?php echo esc_html($f_cat->name); ?></span>
                                    <?php if ($is_rescue) : ?>
                                        <span class="badge-mini">24/7</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>

                <!-- Column 3: Google Maps & Direct Navigation -->
                <div class="footer-col col-map">
                    <h4 class="footer-col-title">
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
                <span class="copy-text">© <?php echo date('Y'); ?> <strong>Ôtô Hải Hà</strong> — Uy tín - chất lượng - hiệu quả là sự tồn tại của doanh nghiệp.</span>
            </div>

            <div class="bottom-extra-links">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">Giới Thiệu</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>">Dịch Vụ</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>">Bảng Giá</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color: #D4B996; font-weight: 700;">Chính Sách Bảo Mật &amp; Pháp Lý</a>
                <span class="sep">•</span>
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/#lien-he')); ?>">Liên Hệ</a>
            </div>

            <!-- Legal Entity Compliance Block (Luật TMĐT 122/2025/QH15 & Nghị định 52/2013/NĐ-CP) -->
            <div style="font-size: 0.78rem; color: #94a3b8; margin: 12px 0 6px; line-height: 1.6; text-align: center;">
                <strong>Đơn vị chủ quản:</strong> TRUNG TÂM DỊCH VỤ KỸ THUẬT Ô TÔ HẢI HÀ (GARA Ô TÔ HẢI HÀ) &bull; 
                <strong>Địa chỉ:</strong> Km3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn, TP. Hải Dương &bull; 
                <strong>Tổng đài:</strong> 02203 892 207 &bull; <strong>Hotline cứu hộ:</strong> 0911 211 996
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
     LEXUS VIETNAM 3-COLUMN BOTTOM BAR (MOBILE) & FLOATING DOCK (DESKTOP)
     ========================================================================= -->
<div class="shiftup-floating-dock lexus-bottom-action-bar" id="shiftupFloatingDock">
    <!-- 1. Hotline Tư Vấn -->
    <a href="tel:02203892207" class="float-dock-pill dock-book" title="Hotline tư vấn dịch vụ Ô Tô Hải Hà">
        <i class="fa-solid fa-phone-volume dock-fa-icon"></i>
        <span class="dock-text dock-text-desktop">HOTLINE: 02203 892 207</span>
        <span class="dock-text dock-text-mobile">Tư Vấn</span>
    </a>

    <!-- 2. So sánh bảng giá / Cứu hộ 24/7 (Lexus Dual Arrows Icon) -->
    <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="float-dock-pill dock-rescue" title="Gọi cứu hộ 24/7 khẩn cấp: <?php echo esc_attr($rescue_phone); ?>">
        <div class="dock-pulse-beacon">
            <span class="pulse-ring"></span>
            <span class="pulse-dot"></span>
        </div>
        <span class="lexus-dock-svg" aria-hidden="true">
            <svg width="26" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 8.5H19M19 8.5L14.5 4M19 8.5L14.5 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24 15.5H9M9 15.5L13.5 11M9 15.5L13.5 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <i class="fa-solid fa-truck-pickup dock-fa-icon"></i>
        <span class="dock-text dock-text-desktop">CỨU HỘ: <?php echo esc_html($rescue_phone); ?></span>
        <span class="dock-text dock-text-mobile">Cứu Hộ 24/7</span>
    </a>

    <!-- 3. Chat tư vấn kỹ thuật Zalo (Lexus Square Chat Icon) -->
    <a href="https://zalo.me/<?php echo esc_attr($tech_clean); ?>" target="_blank" rel="noopener" class="float-dock-pill dock-zalo" title="Tư vấn kỹ thuật qua Zalo: <?php echo esc_attr($tech_phone); ?>">
        <span class="lexus-dock-svg" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H20V16H13L9 20V16H4V4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="8" y1="8.5" x2="16" y2="8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="8" y1="12" x2="13.5" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </span>
        <i class="fa-solid fa-comment-dots dock-fa-icon"></i>
        <span class="dock-text dock-text-desktop">ZALO KỸ THUẬT</span>
        <span class="dock-text dock-text-mobile">Chat Zalo</span>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
