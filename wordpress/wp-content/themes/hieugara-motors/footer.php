<?php
/**
 * Ôtô Hải Hà - Modern Clean 4-Column Footer (Inspired by Đức Trí 226)
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

$phone_rescue   = '0911 211 996';
$phone_tech     = '0911 211 996';
$rescue_clean   = preg_replace('/[^0-9]/', '', $phone_rescue);
$tech_clean     = preg_replace('/[^0-9]/', '', $phone_tech);
$topbar_email   = get_option('hieugara_topbar_email', 'thanhotohaiha@gmail.com');
$warranty_url   = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
$footer_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png?v=' . HIEUGARA_THEME_VERSION;
?>

<!-- =========================================================================
     MODERN CLEAN 4-COLUMN FOOTER (INSPIRED BY ĐỨC TRÍ 226)
     ========================================================================= -->
<footer id="colophon" class="site-footer dt226-footer haiha-modern-footer">
    <div class="dt226-footer-top">
        <div class="container dt226-footer-grid">
            
            <!-- Cột 1: Thương hiệu & Thông tin liên hệ -->
            <div class="dt226-footer-col dt226-footer-brand">
                <div class="dt226-brand-heading-wrap">
                    <img src="<?php echo esc_url($footer_logo_url); ?>" alt="Ô Tô Hải Hà" width="46" height="46" class="dt226-footer-logo">
                    <div class="dt226-brand-text">
                        <span class="dt226-brand-sub">HỢP TÁC XÃ CƠ KHÍ</span>
                        <h3 class="dt226-brand-name">Ô TÔ HẢI HÀ</h3>
                    </div>
                </div>

                <ul class="dt226-footer-contact-list">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><strong>Địa chỉ:</strong> Km 3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn, TP. Hải Dương</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span><strong>Hotline &amp; Cứu hộ 24/7:</strong> <a href="tel:0911211996" class="dt226-hotline-highlight">0911 211 996</a></span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span><strong>Zalo tư vấn kỹ thuật:</strong> <a href="https://zalo.me/0911211996" target="_blank" rel="noopener">0911 211 996</a></span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($topbar_email); ?>"><?php echo esc_html($topbar_email); ?></a></span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span><strong>Giờ làm việc:</strong> Thứ 2 – Chủ Nhật: 07:30 – 18:00</span>
                    </li>
                </ul>
            </div>

            <!-- Cột 2: Dịch vụ trọng tâm -->
            <div class="dt226-footer-col">
                <h4 class="dt226-footer-title">DỊCH VỤ TRỌNG TÂM</h4>
                <ul class="dt226-footer-links">
                    <li>
                        <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>" class="dt226-link-highlight">
                            <span>Dịch vụ xe VinFast</span>
                            <span class="dt226-badge-mini">HÃNG</span>
                        </a>
                    </li>
                    <?php
                    $footer_cats = get_terms(array(
                        'taxonomy'   => 'service_category',
                        'parent'     => 0,
                        'hide_empty' => true,
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                    ));
                    if (!empty($footer_cats) && !is_wp_error($footer_cats)) :
                        foreach ($footer_cats as $f_cat) :
                            $f_link = home_url('/dich-vu/' . $f_cat->slug . '/');
                            $is_rescue = strpos($f_cat->slug, 'cuu-ho') !== false;
                    ?>
                        <li>
                            <a href="<?php echo esc_url($f_link); ?>">
                                <span><?php echo esc_html($f_cat->name); ?></span>
                                <?php if ($is_rescue) : ?>
                                    <span class="dt226-badge-mini dt226-badge-red">24/7</span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>

            <!-- Cột 3: Phụ kiện & Hỗ trợ -->
            <div class="dt226-footer-col">
                <h4 class="dt226-footer-title">PHỤ KIỆN &amp; HỖ TRỢ</h4>
                <ul class="dt226-footer-links">
                    <li>
                        <a href="<?php echo esc_url(home_url('/phu-kien/phu-kien-vinfast/')); ?>" class="dt226-link-highlight">
                            <span>Phụ kiện VinFast chính hãng</span>
                            <span class="dt226-badge-mini">MỚI</span>
                        </a>
                    </li>
                    <li><a href="<?php echo esc_url(home_url('/phu-kien/')); ?>">Phụ kiện ô tô &amp; Đồ chơi xe hơi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tra-cuu-bao-hanh/')); ?>">Tra cứu bảo hành điện tử</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">Quy chế hoạt động gara</a></li>
                    <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>">Chính sách bảo mật thông tin</a></li>
                    <li><a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">Đặt lịch bảo dưỡng &amp; Sửa chữa</a></li>
                </ul>
            </div>

            <!-- Cột 4: Cam kết chất lượng (Trust Badges kiểu Đức Trí 226) -->
            <div class="dt226-footer-col">
                <h4 class="dt226-footer-title">CAM KẾT CHẤT LƯỢNG</h4>
                <div class="dt226-footer-trust">
                    <div class="dt226-trust-badge">
                        <span class="dt226-badge-icon">&#10003;</span>
                        <div>
                            <strong>100% Phụ Tùng Chính Hãng</strong>
                            <p>Minh bạch tem mác, chứng từ &amp; bảo hành điện tử</p>
                        </div>
                    </div>
                    <div class="dt226-trust-badge">
                        <span class="dt226-badge-icon">&#10003;</span>
                        <div>
                            <strong>Báo Giá Công Khai Minh Bạch</strong>
                            <p>Khám xe kỹ lưỡng, khách duyệt mới tiến hành làm</p>
                        </div>
                    </div>
                    <div class="dt226-trust-badge">
                        <span class="dt226-badge-icon">&#10003;</span>
                        <div>
                            <strong>Kỹ Thuật Viên Chuẩn Hãng</strong>
                            <p>Đào tạo chuyên sâu xe xăng &amp; hệ thống điện cao áp VinFast</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bản quyền & Pháp lý (Tối giản, không slogan) -->
    <div class="dt226-footer-bottom">
        <div class="container dt226-bottom-inner">
            <div class="dt226-copyright-text">
                &copy; <?php echo date('Y'); ?> <strong>HỢP TÁC XÃ CƠ KHÍ HẢI HÀ</strong> &bull; Mã số thuế: <strong>0800016457</strong> &bull; Quản lý bởi Chi cục Thuế TP. Hải Dương.
            </div>
            <div class="dt226-bottom-actions">
                <button type="button" id="footerBackToTop" class="dt226-back-top-btn" aria-label="Lên đầu trang">
                    <span>Lên đầu trang</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="18 15 12 9 6 15"/></svg>
                </button>
            </div>
        </div>
    </div>
</footer>

<!-- =========================================================================
     LEXUS VIETNAM 3-COLUMN BOTTOM BAR (MOBILE) & FLOATING DOCK (DESKTOP)
     ========================================================================= -->
<div class="shiftup-floating-dock lexus-bottom-action-bar" id="shiftupFloatingDock">
    <!-- 1. Hotline Tư Vấn (0911 211 996) -->
    <a href="tel:0911211996" class="float-dock-pill dock-book" title="Hotline Ô Tô Hải Hà: 0911 211 996">
        <i class="fa-solid fa-phone-volume dock-fa-icon"></i>
        <span class="dock-text dock-text-desktop">HOTLINE: 0911 211 996</span>
        <span class="dock-text dock-text-mobile">0911 211 996</span>
    </a>

    <!-- 2. Cứu hộ 24/7 (0911 211 996) -->
    <a href="tel:0911211996" class="float-dock-pill dock-rescue" title="Gọi cứu hộ 24/7 khẩn cấp: 0911 211 996">
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
        <span class="dock-text dock-text-desktop">CỨU HỘ: 0911 211 996</span>
        <span class="dock-text dock-text-mobile">Cứu Hộ</span>
    </a>

    <!-- 3. Chat tư vấn kỹ thuật Zalo (0911 211 996) -->
    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="float-dock-pill dock-zalo" title="Chat Zalo: 0911 211 996">
        <span class="lexus-dock-svg" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H20V16H13L9 20V16H4V4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="8" y1="8.5" x2="16" y2="8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="8" y1="12" x2="13.5" y2="12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </span>
        <i class="fa-solid fa-comment-dots dock-fa-icon"></i>
        <span class="dock-text dock-text-desktop">ZALO: 0911 211 996</span>
        <span class="dock-text dock-text-mobile">Chat Zalo</span>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
