<?php
/**
 * The header for Hải Hà ÔTô Service
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
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>" alt="Hải Hà ÔTô Service" class="brand-logo-img" width="54" height="54">
            </div>
            <div class="brand-text-wrap">
                <div class="brand-title">HẢI HÀ <span class="text-orange">ÔTÔ</span></div>
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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/haiha-logo.png?v=4.6.0'); ?>" alt="Hải Hà ÔTô" width="40" height="40">
            <div class="drawer-brand-text">
                <span class="drawer-name">HẢI HÀ <strong class="text-orange">ÔTÔ</strong></span>
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
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>">Về Chúng Tôi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#bao-chi')); ?>">Báo Chí Nói Về Hải Hà ÔTô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#su-kien')); ?>">Sự Kiện Hải Hà</a></li>
                    <li><a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>">Hệ Thống Chi Nhánh Toàn Quốc</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#tieu-chuan')); ?>">Tiêu Chuẩn &amp; Chứng Nhận Dịch Vụ</a></li>
                </ul>
            </li>

            <!-- 3. DỊCH VỤ ⌲ (DUCTRI226 MEGA MENU STYLE) -->
            <li class="nav-item has-dropdown has-mega <?php echo is_post_type_archive('garage_service') || is_singular('garage_service') || is_tax('service_category') || is_page('bang-gia') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>" class="nav-link" title="HỆ THỐNG DỊCH VỤ Ô TÔ HẢI HÀ" aria-haspopup="true" aria-expanded="false">
                    <span><?php _e('DỊCH VỤ', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>
                </a>
                <div class="mega-menu" role="region" aria-label="Menu dịch vụ ô tô">
                    <div class="mega-inner">

                        <!-- Group 1: 01. BẢO DƯỠNG Ô TÔ -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/bao-duong-o-to/')); ?>">
                                <span>01. BẢO DƯỠNG Ô TÔ</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/bao-duong-dinh-ky/')); ?>">
                                    <span>Bảo dưỡng định kỳ theo số km</span>
                                    <small>5k-40k km</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/thay-dau-va-loc-o-to/')); ?>">
                                    <span>Thay dầu &amp; lọc dầu chính hãng</span>
                                    <small>OEM</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/kiem-tra-va-bao-duong-tong-quat/')); ?>">
                                    <span>Kiểm tra &amp; bảo dưỡng tổng quát</span>
                                    <small>45 mục</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-phanh/')); ?>">
                                    <span>Kiểm tra &amp; bảo dưỡng phanh</span>
                                    <small>Hunter</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dieu-hoa-o-to/')); ?>">
                                    <span>Bảo dưỡng điều hòa ô tô</span>
                                    <small>Nội soi</small>
                                </a>
                            </div>
                        </div>

                        <!-- Group 2: 02. SỬA CHỮA Ô TÔ -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to/')); ?>">
                                <span>02. SỬA CHỮA Ô TÔ</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dong-co/')); ?>">
                                    <span>Sửa chữa &amp; đại tu động cơ</span>
                                    <small>Chuyên sâu</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-hop-so-va-truyen-dong/')); ?>">
                                    <span>Sửa chữa hộp số tự động &amp; sàn</span>
                                    <small>AT/MT</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-phanh/')); ?>">
                                    <span>Sửa chữa hệ thống phanh ABS</span>
                                    <small>An toàn</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-gam-va-he-thong-treo/')); ?>">
                                    <span>Sửa chữa gầm &amp; hệ thống treo</span>
                                    <small>Giảm xóc</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-lai/')); ?>">
                                    <span>Sửa chữa hệ thống lái &amp; thước lái</span>
                                    <small>3D</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-he-thong-xa-va-khi-thai/')); ?>">
                                    <span>Sửa chữa hệ thống xả &amp; khí thải</span>
                                    <small>Catalytic</small>
                                </a>
                            </div>
                        </div>

                        <!-- Group 3: 03. ĐIỆN Ô TÔ & ĐIỀU HÒA -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/dien-o-to-dieu-hoa/')); ?>">
                                <span>03. ĐIỆN &amp; ĐIỀU HÒA</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dien-o-to/')); ?>">
                                    <span>Sửa chữa điện ô tô &amp; thân xe</span>
                                    <small>Scan</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dien-tu-va-ecu/')); ?>">
                                    <span>Kiểm tra, coding &amp; sửa ECU</span>
                                    <small>Châu Âu</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-dieu-hoa-o-to/')); ?>">
                                    <span>Sửa chữa &amp; nạp gas điều hòa</span>
                                    <small>R134a</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/he-thong-lam-mat-o-to/')); ?>">
                                    <span>Chẩn đoán lỗi máy &amp; làm mát</span>
                                    <small>Két nước</small>
                                </a>
                            </div>
                        </div>

                        <!-- Group 4: 04. ĐỒNG SƠN & NGOẠI THẤT -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/dong-son-o-to/')); ?>">
                                <span>04. ĐỒNG SƠN &amp; THÂN VỎ</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/son-o-to/')); ?>">
                                    <span>Sơn ô tô phòng sấy vi tính</span>
                                    <small>Châu Âu</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/go-han-va-sua-chua-than-vo/')); ?>">
                                    <span>Gò hàn &amp; sửa chữa thân vỏ</span>
                                    <small>Nắn sườn</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-kinh-va-den-o-to/')); ?>">
                                    <span>Sửa chữa kính &amp; phục hồi đèn</span>
                                    <small>Đánh bóng</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to-sau-va-cham/')); ?>">
                                    <span>Phục hồi xe sau tai nạn va chạm</span>
                                    <small>Bảo hiểm</small>
                                </a>
                            </div>
                        </div>

                        <!-- Group 5: 05. CHĂM SÓC & NÂNG CẤP -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/cham-soc-nang-cap-o-to/')); ?>">
                                <span>05. CHĂM SÓC &amp; NÂNG CẤP</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/cham-soc-va-lam-dep-xe-detailing/')); ?>">
                                    <span>Detailing chăm sóc làm đẹp xe</span>
                                    <small>Auto Spa</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/ve-sinh-noi-that-o-to/')); ?>">
                                    <span>Vệ sinh nội thất &amp; khoang máy</span>
                                    <small>Hơi nóng</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/danh-bong-va-phu-ceramic/')); ?>">
                                    <span>Đánh bóng &amp; phủ Ceramic 9H</span>
                                    <small>Bảo vệ</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/phu-kien-va-nang-cap-o-to/')); ?>">
                                    <span>Phụ kiện &amp; nâng cấp option</span>
                                    <small>Tiện ích</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/nang-cap-anh-sang-va-am-thanh/')); ?>">
                                    <span>Nâng cấp ánh sáng Bi-LED &amp; loa</span>
                                    <small>Laser</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/phim-cach-nhiet-va-ppf/')); ?>">
                                    <span>Dán phim cách nhiệt 3M &amp; PPF</span>
                                    <small>Chống nóng</small>
                                </a>
                            </div>
                        </div>

                        <!-- Group 6: 06. DỊCH VỤ HỖ TRỢ & CỨU HỘ -->
                        <div class="mega-group">
                            <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-ho-tro-o-to/')); ?>">
                                <span>06. HỖ TRỢ &amp; CỨU HỘ</span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-giao-thong-o-to/')); ?>">
                                    <span>Cứu hộ giao thông ô tô 24/7</span>
                                    <small>Sàn trượt</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/kiem-tra-xe-cu-truoc-khi-mua/')); ?>">
                                    <span>Kiểm tra xe cũ trước khi mua</span>
                                    <small>Check test</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/dich-vu-dang-kiem-o-to/')); ?>">
                                    <span>Dịch vụ hỗ trợ đăng kiểm ô tô</span>
                                    <small>Trọn gói</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to-luu-dong/')); ?>">
                                    <span>Sửa chữa &amp; kích bình lưu động</span>
                                    <small>Tận nơi</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/bao-duong-xe-doanh-nghiep/')); ?>">
                                    <span>Bảo dưỡng xe doanh nghiệp</span>
                                    <small>Hợp đồng</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/bao-hiem-va-bao-hanh-o-to/')); ?>">
                                    <span>Bảo hiểm &amp; bảo hành điện tử</span>
                                    <small>24 tháng</small>
                                </a>
                            </div>
                        </div>

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
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Màn Hình Android Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Camera Hành Trình Trước &amp; Sau</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Phim Cách Nhiệt Ô Tô Chính Hãng</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Cảm Biến Áp Suất Lốp (TPMS)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Dán PPF Bảo Vệ Sơn Xe</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Cửa Hít Tự Động Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Cốp Điện Ô Tô Thông Minh</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Độ Đèn Tăng Sáng Bi-LED/Laser</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">Bọc Vô Lăng &amp; Thảm Lót Sàn 6D</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/#dau-nhot')); ?>">Dầu Nhớt &amp; Phụ Gia Cao Cấp</a></li>
                </ul>
            </li>

            <!-- 5. BLOG ⌵ -->
            <li class="nav-item has-dropdown">
                <a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>" class="nav-link" title="BLOG">
                    <span><?php _e('BLOG', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Chuyên Mục Bảo Dưỡng &amp; Sửa Chữa</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Chuyên Mục Sơn Ô Tô</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Chuyên Mục Chăm Sóc &amp; Làm Đẹp</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Tin Tức Công Nghệ Ô Tô Mới</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Kiến Thức &amp; Trải Nghiệm Xe</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Kinh Nghiệm Lái Xe An Toàn</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#danh-gia-chuyen-sau')); ?>">Tin Tức An Toàn Giao Thông</a></li>
                    <li><a href="<?php echo esc_url(home_url('/bang-gia/')); ?>">Bảng Giá Dịch Vụ Niêm Yết</a></li>
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
                    <li><a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">Đặt Lịch Hẹn Với Chúng Tôi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/tra-cuu-bao-hanh/')); ?>">Tra Cứu Bảo Hành Điện Tử</a></li>
                    <li><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>">Hotline Cứu Hộ 24/7: <?php echo esc_html($rescue_phone); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>">Hệ Thống Chi Nhánh Toàn Quốc</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#hop-tac')); ?>">Hợp Tác Đối Tác &amp; Bảo Hiểm</a></li>
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
