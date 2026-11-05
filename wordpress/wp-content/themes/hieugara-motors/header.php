<?php
/**
 * The header for Hải Hà Auto Service
 * Exact Navigation matching User's Reference (otohathanh.com style without Tuyển dụng & Đào tạo)
 *
 * @package HieuGara_Motors
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Instant Transition Progress Loader -->
<div id="shiftupPageLoader" role="progressbar" aria-label="Đang tải trang"></div>

<?php
// Retrieve Theme Options (managed via Admin > Cài Đặt Giao Diện)
$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$tech_phone    = get_option('hieugara_tech_phone', '0915 041 989');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
$menu_search   = get_option('hieugara_menu_search_enable', '1');
?>

<!-- 2. Main Brand Header Row -->
<header class="main-brand-header">
    <div class="container brand-header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link">
            <div class="brand-logo-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>" alt="Hải Hà Auto Service" class="brand-logo-img" width="54" height="54">
            </div>
            <div class="brand-text-wrap">
                <div class="brand-title">HẢI HÀ <span class="text-orange">AUTO</span></div>
                <div class="brand-subtitle"><?php _e('CAR SERVICE & WORKSHOP', 'hieugara-motors'); ?></div>
            </div>
        </a>

        <!-- Right: Prominent Rescue 24/7 + High-Impact Hotline + Booking Button -->
        <div class="brand-header-actions">
            <!-- Mobile Quick Phone Call (Only visible on mobile screens) -->
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="mobile-quick-call" aria-label="<?php esc_attr_e('Gọi hotline cứu hộ', 'hieugara-motors'); ?>" title="<?php echo esc_attr($rescue_phone); ?>">
                <span class="mobile-call-pulse"></span>
                <i class="fa-solid fa-phone-volume"></i>
            </a>

            <!-- A. CỨU HỘ 24/7 NỔI BẬT CAO ĐỘ (Emergency Beacon Card - Desktop & Tablet) -->
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="header-rescue-card" title="<?php esc_attr_e('Gọi cứu hộ ô tô 24/7 khẩn cấp', 'hieugara-motors'); ?>">
                <div class="rescue-beacon-icon">
                    <span class="rescue-beacon-pulse"></span>
                    <i class="fa-solid fa-truck-pickup"></i>
                </div>
                <div class="rescue-card-details">
                    <div class="rescue-card-badge">
                        <span class="badge-text"><?php _e('CỨU HỘ 24/7', 'hieugara-motors'); ?></span>
                        <span class="badge-live-dot"></span>
                    </div>
                    <strong class="rescue-card-phone"><?php echo esc_html($rescue_phone); ?></strong>
                </div>
            </a>

            <!-- B. SỐ ĐIỆN THOẠI HOTLINE KỸ THUẬT NỔI BẬT -->
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline_phone)); ?>" class="brand-hotline-box" title="<?php esc_attr_e('Tổng đài tư vấn kỹ thuật & báo giá', 'hieugara-motors'); ?>">
                <div class="hotline-icon-circle">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
                <div class="hotline-text">
                    <small><?php _e('TỔNG ĐÀI KỸ THUẬT', 'hieugara-motors'); ?></small>
                    <strong class="hotline-phone-display"><?php echo esc_html($hotline_phone); ?></strong>
                </div>
            </a>

            <!-- C. ĐẶT LỊCH HẸN CTA -->
            <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="brand-btn-book">
                <span class="btn-plus">+</span>
                <span><?php _e('ĐẶT LỊCH HẸN', 'hieugara-motors'); ?></span>
            </a>

            <!-- Mobile Hamburger Toggle -->
            <button type="button" class="mobile-nav-toggle" id="mobileNavToggleBtn" aria-label="Mở danh mục điều hướng">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>
    </div>
</header>

<!-- Backdrop Overlay for Mobile Navigation Drawer -->
<div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>

<!-- 3. Navigation Bar (Desktop Sticky Strip & Mobile Drawer) -->
<nav class="custom-navbar-strip" id="mainStickyNavbar">
    <!-- Mobile Drawer Top Bar -->
    <div class="mobile-drawer-header">
        <div class="drawer-brand">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>" alt="Hải Hà Auto" width="40" height="40">
            <div class="drawer-brand-text">
                <span class="drawer-name">HẢI HÀ <strong class="text-orange">AUTO</strong></span>
                <small class="drawer-sub">TRUNG TÂM BẢO DƯỠNG &amp; SỬA CHỮA</small>
            </div>
        </div>
        <button type="button" class="mobile-drawer-close" id="mobileDrawerCloseBtn" aria-label="Đóng menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="container custom-navbar-inner">
        <?php if (has_nav_menu('primary')) : ?>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'custom-nav-menu',
                'fallback_cb'    => false,
                'depth'          => 2,
            ));
            ?>
        <?php else : ?>
        <ul class="custom-nav-menu">
            <!-- 1. TRANG CHỦ -->
            <li class="nav-item <?php echo is_front_page() ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link" title="TRANG CHỦ">
                    <?php _e('TRANG CHỦ', 'hieugara-motors'); ?>
                </a>
            </li>

            <!-- 2. GIỚI THIỆU ⌵ -->
            <li class="nav-item has-dropdown <?php echo is_page('ve-chung-toi') || is_page('garage-gan-ban') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="nav-link" title="GIỚI THIỆU">
                    <span><?php _e('GIỚI THIỆU', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>"><i class="fa fa-building-circle-check"></i> Về Chúng Tôi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#bao-chi')); ?>"><i class="fa fa-newspaper"></i> Báo Chí Nói Về Hải Hà Auto</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#su-kien')); ?>"><i class="fa fa-calendar-days"></i> Sự Kiện Hải Hà</a></li>
                    <li><a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>"><i class="fa fa-map-location-dot"></i> Hệ Thống Chi Nhánh Toàn Quốc</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#tieu-chuan')); ?>"><i class="fa fa-shield-halved"></i> Tiêu Chuẩn &amp; Chứng Nhận Dịch Vụ</a></li>
                </ul>
            </li>

            <!-- 3. DỊCH VỤ ⌵ -->
            <li class="nav-item has-dropdown has-mega-menu <?php echo is_post_type_archive('garage_service') || is_singular('garage_service') || is_page('bang-gia') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>" class="nav-link" title="DỊCH VỤ">
                    <span><?php _e('DỊCH VỤ', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <div class="nav-mega-dropdown">
                    <div class="mega-dropdown-grid mega-grid-6col">
                        <!-- Col 1: 01. BẢO DƯỠNG Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 01. BẢO DƯỠNG Ô TÔ</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-dinh-ky/')); ?>"><i class="fa-solid fa-clock-rotate-left text-orange"></i> <strong>Bảo dưỡng định kỳ</strong> (5k - 40k km)</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/thay-dau-va-loc-o-to/')); ?>"><i class="fa-solid fa-oil-can text-orange"></i> Thay dầu và lọc ô tô</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/kiem-tra-va-bao-duong-tong-quat/')); ?>"><i class="fa-solid fa-list-check text-orange"></i> Kiểm tra &amp; bảo dưỡng tổng quát</a></li>
                            </ul>
                        </div>

                        <!-- Col 2: 02. SỬA CHỮA Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 02. SỬA CHỮA Ô TÔ</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dong-co/')); ?>"><i class="fa-solid fa-gears text-orange"></i> <strong>Sửa chữa động cơ</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-hop-so-va-truyen-dong/')); ?>"><i class="fa-solid fa-arrows-split-up-and-left text-orange"></i> Sửa chữa hộp số &amp; truyền động</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-phanh/')); ?>"><i class="fa-solid fa-circle-dot text-orange"></i> Sửa chữa hệ thống phanh</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-gam-va-he-thong-treo/')); ?>"><i class="fa-solid fa-dharmachakra text-orange"></i> Sửa chữa gầm &amp; hệ thống treo</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-lai/')); ?>"><i class="fa-solid fa-crosshairs text-orange"></i> Sửa chữa hệ thống lái</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-xa-va-khi-thai/')); ?>"><i class="fa-solid fa-smog text-orange"></i> Sửa chữa hệ thống xả &amp; khí thải</a></li>
                            </ul>
                        </div>

                        <!-- Col 3: 03. ĐIỆN VÀ ĐIỀU HÒA Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 03. ĐIỆN &amp; ĐIỀU HÒA Ô TÔ</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dien-o-to/')); ?>"><i class="fa-solid fa-bolt text-orange"></i> <strong>Sửa chữa điện ô tô</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dien-tu-va-ecu/')); ?>"><i class="fa-solid fa-microchip text-orange"></i> Sửa chữa điện tử &amp; ECU</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dieu-hoa-o-to/')); ?>"><i class="fa-solid fa-snowflake text-orange"></i> <strong>Sửa chữa điều hòa ô tô</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/he-thong-lam-mat-o-to/')); ?>"><i class="fa-solid fa-fan text-orange"></i> Hệ thống làm mát ô tô</a></li>
                            </ul>
                        </div>

                        <!-- Col 4: 04. ĐỒNG SƠN VÀ NGOẠI THẤT Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 04. ĐỒNG SƠN &amp; NGOẠI THẤT</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/son-o-to/')); ?>"><i class="fa-solid fa-spray-can-sparkles text-orange"></i> <strong>Sơn ô tô (Sấy hấp vi tính)</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/go-han-va-sua-chua-than-vo/')); ?>"><i class="fa-solid fa-hammer text-orange"></i> Gò hàn &amp; sửa chữa thân vỏ</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-kinh-va-den-o-to/')); ?>"><i class="fa-solid fa-lightbulb text-orange"></i> Sửa chữa kính &amp; đèn ô tô</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to-sau-va-cham/')); ?>"><i class="fa-solid fa-car-burst text-orange"></i> Sửa chữa ô tô sau va chạm</a></li>
                            </ul>
                        </div>

                        <!-- Col 5: 05. CHĂM SÓC VÀ NÂNG CẤP Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 05. CHĂM SÓC &amp; NÂNG CẤP</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/cham-soc-va-lam-dep-xe-detailing/')); ?>"><i class="fa-solid fa-wand-magic-sparkles text-orange"></i> <strong>Chăm sóc &amp; làm đẹp xe (Detailing)</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/ve-sinh-noi-that-o-to/')); ?>"><i class="fa-solid fa-couch text-orange"></i> Vệ sinh nội thất ô tô</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/danh-bong-va-phu-ceramic/')); ?>"><i class="fa-solid fa-gem text-orange"></i> Đánh bóng &amp; phủ Ceramic 9H</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/phu-kien-va-nang-cap-o-to/')); ?>"><i class="fa-solid fa-sliders text-orange"></i> Phụ kiện &amp; nâng cấp ô tô</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/nang-cap-anh-sang-va-am-thanh/')); ?>"><i class="fa-solid fa-volume-high text-orange"></i> Nâng cấp ánh sáng &amp; âm thanh</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/phim-cach-nhiet-va-ppf/')); ?>"><i class="fa-solid fa-shield text-orange"></i> Phim cách nhiệt &amp; dán PPF</a></li>
                            </ul>
                        </div>

                        <!-- Col 6: 06. DỊCH VỤ HỖ TRỢ Ô TÔ -->
                        <div class="mega-dropdown-col">
                            <div class="mega-title"><span class="mega-dot"></span> 06. DỊCH VỤ HỖ TRỢ Ô TÔ</div>
                            <ul class="mega-list">
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-giao-thong-o-to/')); ?>"><i class="fa-solid fa-truck-pickup text-orange"></i> <strong>Cứu hộ giao thông ô tô 24/7</strong></a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/kiem-tra-xe-cu-truoc-khi-mua/')); ?>"><i class="fa-solid fa-magnifying-glass text-orange"></i> Kiểm tra xe cũ trước khi mua</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/dich-vu-dang-kiem-o-to/')); ?>"><i class="fa-solid fa-clipboard-check text-orange"></i> Dịch vụ đăng kiểm ô tô</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to-luu-dong/')); ?>"><i class="fa-solid fa-wrench text-orange"></i> Sửa chữa ô tô lưu động</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-xe-doanh-nghiep/')); ?>"><i class="fa-solid fa-building text-orange"></i> Bảo dưỡng xe doanh nghiệp</a></li>
                                <li><a href="<?php echo esc_url(home_url('/dich-vu/bao-hiem-va-bao-hanh-o-to/')); ?>"><i class="fa-solid fa-handshake text-orange"></i> Bảo hiểm &amp; bảo hành ô tô</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mega-dropdown-footer">
                        <span><i class="fa fa-shield-check text-green"></i> Hải Hà Ô Tô &bull; 31 năm giữ trọn chữ Tâm với nghề (1995 - <?php echo date('Y'); ?>) &bull; 80 nhân sự tận tâm</span>
                        <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>" class="mega-cta-link">Xem bảng giá toàn bộ 6 nhóm dịch vụ niêm yết &rarr;</a>
                    </div>
                </div>
            </li>

            <!-- 4. PHỤ KIỆN ⌵ -->
            <li class="nav-item has-dropdown">
                <a href="<?php echo esc_url(home_url('/bang-gia/#phu-tung')); ?>" class="nav-link" title="PHỤ KIỆN">
                    <span><?php _e('PHỤ KIỆN', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu nav-dropdown-grid-2col">
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-tv"></i> Màn Hình Android Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-video"></i> Camera Hành Trình Trước &amp; Sau</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-sun"></i> Phim Cách Nhiệt Ô Tô Chính Hãng</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-gauge"></i> Cảm Biến Áp Suất Lốp (TPMS)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-shield"></i> Dán PPF Bảo Vệ Sơn Xe</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-door-closed"></i> Cửa Hít Tự Động Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-car-rear"></i> Cốp Điện Ô Tô Thông Minh</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-lightbulb"></i> Độ Đèn Tăng Sáng Bi-LED/Laser</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>"><i class="fa fa-circle-notch"></i> Bọc Vô Lăng &amp; Thảm Lót Sàn 6D</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#dau-nhot')); ?>"><i class="fa fa-oil-can"></i> Dầu Nhớt &amp; Phụ Gia Cao Cấp</a></li>
                </ul>
            </li>

            <!-- 5. BLOG ⌵ -->
            <li class="nav-item has-dropdown">
                <a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>" class="nav-link" title="BLOG">
                    <span><?php _e('BLOG', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-wrench"></i> Chuyên Mục Bảo Dưỡng &amp; Sửa Chữa</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-fill-drip"></i> Chuyên Mục Sơn Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-spray-can-sparkles"></i> Chuyên Mục Chăm Sóc &amp; Làm Đẹp</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-newspaper"></i> Tin Tức Công Nghệ Ô Tô Mới</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-brain"></i> Kiến Thức &amp; Trải Nghiệm Xe</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-car"></i> Kinh Nghiệm Lái Xe An Toàn</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>"><i class="fa fa-triangle-exclamation"></i> Tin Tức An Toàn Giao Thông</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/')); ?>"><i class="fa fa-file-invoice-dollar"></i> Bảng Giá Dịch Vụ Niêm Yết</a></li>
                </ul>
            </li>

            <!-- 6. KHUYẾN MẠI -->
            <li class="nav-item">
                <a href="<?php echo esc_url(home_url('/bang-gia/#khuyen-mai')); ?>" class="nav-link" title="KHUYẾN MẠI">
                    <?php _e('KHUYẾN MẠI', 'hieugara-motors'); ?>
                </a>
            </li>

            <!-- 7. LIÊN HỆ ⌵ -->
            <li class="nav-item has-dropdown">
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="nav-link" title="LIÊN HỆ">
                    <span><?php _e('LIÊN HỆ', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/dat-lich/')); ?>"><i class="fa fa-calendar-check"></i> Đặt Lịch Hẹn Với Chúng Tôi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tra-cuu-bao-hanh/')); ?>"><i class="fa fa-id-card"></i> Tra Cứu Bảo Hành Điện Tử</a></li>
                    <li><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>"><i class="fa fa-phone text-orange"></i> Hotline Cứu Hộ 24/7: <?php echo esc_html($rescue_phone); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>"><i class="fa fa-location-dot"></i> Hệ Thống Chi Nhánh Toàn Quốc</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#hop-tac')); ?>"><i class="fa fa-handshake"></i> Hợp Tác Đối Tác &amp; Bảo Hiểm</a></li>
                </ul>
            </li>
        </ul>
        <?php endif; ?>

        <!-- Right: Rounded Pill Search Form (Có thể bật/tắt trong Admin) -->
        <?php if ($menu_search === '1' || $menu_search === true || $menu_search === 'yes') : ?>
        <form class="menu-search-pill" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" class="search-field" placeholder="Tìm kiếm dịch vụ, phụ tùng..." value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" aria-label="Tìm kiếm trên trang">
            <button type="submit" class="search-submit" aria-label="Nút tìm kiếm">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <?php endif; ?>
    </div>

    <!-- Mobile Drawer Bottom Actions -->
    <div class="mobile-drawer-bottom">
        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="drawer-btn-rescue">
            <i class="fa-solid fa-truck-pickup"></i>
            <span>CỨU HỘ 24/7: <strong><?php echo esc_html($rescue_phone); ?></strong></span>
        </a>
        <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="drawer-btn-book">
            <i class="fa-regular fa-calendar-check"></i>
            <span>ĐẶT LỊCH HẸN TRỰC TUYẾN</span>
        </a>
        <div class="drawer-meta-info">
            <span><i class="fa-solid fa-phone text-orange"></i> Hotline: <?php echo esc_html($hotline_phone); ?></span>
            <span><i class="fa-solid fa-envelope text-orange"></i> garaotohaiha@gmail.com</span>
        </div>
    </div>
</nav>
