<?php
/**
 * The header for Ôtô Hải Hà Service
 * Exact Navigation matching User's Reference (otohathanh.com style without Tuyển dụng & Đào tạo)
 *
 * @package HieuGara_Motors
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <?php $site_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png?v=' . HIEUGARA_THEME_VERSION; ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url($site_logo_url); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url($site_logo_url); ?>">
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
$tech_phone    = get_option('hieugara_tech_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
$topbar_email  = get_option('hieugara_topbar_email', 'thanhotohaiha@gmail.com');
$warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
$menu_search   = get_option('hieugara_menu_search_enable', '1');
?>

<!-- Schema.org WebSite + SearchAction for SEO Sitelinks Search Box -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Ôtô Hải Hà - Trung Tâm Bảo Dưỡng & Sửa Chữa Ô Tô Chuyên Nghiệp",
  "alternateName": "Gara Ô Tô Hải Hà",
  "url": "<?php echo esc_url(home_url('/')); ?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "<?php echo esc_url(home_url('/?s={search_term_string}')); ?>"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>

<!-- 2. Mobile-Only Top Brand Bar (Hidden on Desktop >= 992px; Desktop uses Unified Mega Menu Bar) -->
<header class="main-brand-header mobile-only-brand-header">
    <div class="container brand-header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link">
            <div class="brand-logo-wrap">
                <img src="<?php echo esc_url($site_logo_url); ?>" alt="Ôtô Hải Hà Service" class="brand-logo-img" width="46" height="46">
            </div>
            <div class="brand-text-wrap">
                <div class="brand-title">ÔTÔ <span class="text-orange">HẢI HÀ</span></div>
            </div>
        </a>

        <!-- Right: Mobile Quick Rescue Call + Hamburger Toggle -->
        <div class="brand-header-actions">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="mobile-quick-call" aria-label="<?php esc_attr_e('Gọi hotline cứu hộ 24/7', 'hieugara-motors'); ?>" title="Cứu hộ 24/7: <?php echo esc_attr($rescue_phone); ?>">
                <span class="mobile-call-pulse"></span>
                <i class="fa-solid fa-phone-volume"></i>
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

<!-- 3. Unified Mega Menu Bar (Logo + Menu + Cứu Hộ 24/7 + Đặt Lịch + Tìm Kiếm SEO on 1 Row) -->
<nav class="custom-navbar-strip" id="mainStickyNavbar" aria-label="Điều hướng chính">
    <!-- Mobile Drawer Top Bar -->
    <div class="mobile-drawer-header">
        <div class="drawer-brand">
            <img src="<?php echo esc_url($site_logo_url); ?>" alt="Ôtô Hải Hà" width="40" height="40">
            <div class="drawer-brand-text">
                <span class="drawer-name">ÔTÔ <strong class="text-orange">HẢI HÀ</strong></span>
                <small class="drawer-sub">Uy tín - chất lượng - hiệu quả là sự tồn tại của doanh nghiệp</small>
            </div>
        </div>
        <button type="button" class="mobile-drawer-close" id="mobileDrawerCloseBtn" aria-label="Đóng menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="container custom-navbar-inner">
        <!-- Left: Inline Brand Logo on Mega Menu Bar (Desktop) -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-inline-brand" title="Ôtô Hải Hà - Trang chủ">
            <img src="<?php echo esc_url($site_logo_url); ?>" alt="Ôtô Hải Hà" class="navbar-brand-img" width="44" height="44">
            <div class="navbar-brand-text">
                <span class="navbar-brand-name">ÔTÔ <span class="brand-accent">HẢI HÀ</span></span>
                <small class="navbar-brand-sub">GARAGE SERVICE</small>
            </div>
        </a>

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

            <!-- 2. GIỚI THIỆU ⌵ (100% Dynamic CRUD from WP Admin) -->
            <li class="nav-item has-dropdown <?php echo is_page('ve-chung-toi') || is_page('garage-gan-ban') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="nav-link" title="GIỚI THIỆU">
                    <span><?php _e('GIỚI THIỆU', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <?php
                    $about_nav_items = function_exists('hieugara_get_about_menu_items') ? hieugara_get_about_menu_items() : array();
                    foreach ($about_nav_items as $a_item) :
                        if (empty($a_item['enable'])) continue;
                    ?>
                        <li>
                            <a href="<?php echo esc_url($a_item['link']); ?>" target="<?php echo esc_attr($a_item['target'] ?? '_self'); ?>">
                                <?php if (!empty($a_item['icon'])) : ?>
                                    <i class="<?php echo esc_attr($a_item['icon']); ?>" style="color: #FFB81C; margin-right: 6px; width: 16px; text-align: center;"></i>
                                <?php endif; ?>
                                <?php echo esc_html($a_item['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
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
                        <!-- 1. Dịch Vụ Xe VinFast (First Item) -->
                        <div class="mega-group mega-group-vinfast">
                            <a class="mega-cat mega-parent mega-parent-vinfast" href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>" style="background: rgba(255, 184, 28, 0.08); border-left: 3px solid #FFB81C;">
                                <span class="vf-menu-badge" style="background:#FFB81C;color:#141414;font-size:10px;font-weight:800;padding:2px 6px;border-radius:4px;margin-right:6px;">VINFAST</span>
                                <span style="font-weight:700;color:#ffffff;"><?php _e('Dịch vụ xe VinFast', 'hieugara-motors'); ?></span>
                                <span class="mega-arrow">›</span>
                            </a>
                            <div class="mega-sub">
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>">
                                    <strong style="color:#FFB81C;">⚡ Đối tác dịch vụ chính thức VinFast</strong>
                                    <small>Bảo dưỡng, sửa chữa, đồng sơn, phụ tùng</small>
                                </a>
                                <a class="mega-subcat" href="<?php echo esc_url(home_url('/dat-lich/?model=Xe%20VinFast&service=vinfast')); ?>">
                                    <span>Đặt lịch xe VinFast ưu tiên</span>
                                    <small>Tiếp nhận khoang riêng</small>
                                </a>
                            </div>
                        </div>

                        <?php
                        $dynamic_cats = get_terms(array(
                            'taxonomy'   => 'service_category',
                            'parent'     => 0,
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                        ));

                        if (!empty($dynamic_cats) && !is_wp_error($dynamic_cats)) :
                            foreach ($dynamic_cats as $d_cat) :
                                $cat_services = get_posts(array(
                                    'post_type'      => 'garage_service',
                                    'posts_per_page' => 8,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'menu_order title',
                                    'order'          => 'ASC',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy'         => 'service_category',
                                            'field'            => 'term_id',
                                            'terms'            => $d_cat->term_id,
                                            'include_children' => true,
                                        ),
                                    ),
                                ));
                                ?>
                                <div class="mega-group">
                                    <a class="mega-cat mega-parent" href="<?php echo esc_url(home_url('/dich-vu/' . $d_cat->slug . '/')); ?>">
                                        <span><?php echo esc_html($d_cat->name); ?></span>
                                        <span class="mega-arrow">›</span>
                                    </a>
                                    <div class="mega-sub">
                                        <?php if (!empty($cat_services)) : ?>
                                            <?php foreach ($cat_services as $c_post) : 
                                                $dur = get_post_meta($c_post->ID, '_garage_duration', true) ?: get_post_meta($c_post->ID, '_service_duration', true);
                                                if (empty($dur)) {
                                                    $dur = get_post_meta($c_post->ID, '_garage_price_from', true) ?: get_post_meta($c_post->ID, '_service_price', true);
                                                }
                                            ?>
                                                <a class="mega-subcat" href="<?php echo esc_url(get_permalink($c_post->ID)); ?>">
                                                    <span><?php echo esc_html($c_post->post_title); ?></span>
                                                    <?php if (!empty($dur)) : ?>
                                                        <small><?php echo esc_html($dur); ?></small>
                                                    <?php endif; ?>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <span style="font-size: 0.8rem; color: #94a3b8; padding: 6px 12px; display: block;"><?php _e('Đang cập nhật...', 'hieugara-motors'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>

                </div>
            </li>

            <!-- 4. PHỤ KIỆN ⌵ -->
            <li class="nav-item has-dropdown <?php echo is_page('phu-kien') || is_singular('garage_accessory') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>" class="nav-link" title="PHỤ KIỆN Ô TÔ CHÍNH HÃNG">
                    <span><?php _e('PHỤ KIỆN', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu nav-dropdown-grid-2col">
                    <li style="grid-column: 1 / -1;"><a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><strong class="text-gold">★ Xem Tất Cả Phụ Kiện Chính Hãng</strong></a></li>
                    <?php 
                    $nav_acc_cats = function_exists('hieugara_get_accessories_categories') ? hieugara_get_accessories_categories() : array();
                    foreach ($nav_acc_cats as $c_slug => $c_data) :
                    ?>
                        <li>
                            <a href="<?php echo esc_url(home_url('/phu-kien/#cat-' . $c_slug)); ?>">
                                <i class="<?php echo esc_attr($c_data['icon']); ?> mr-1 text-gold"></i> <?php echo esc_html($c_data['short_name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <!-- 5. BLOG ⌵ -->
            <li class="nav-item has-dropdown <?php echo (is_home() || is_category() || is_singular('post')) ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link" title="BLOG KỸ THUẬT">
                    <span><?php _e('BLOG', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><strong style="color: #FFB81C;">★</strong> <?php _e('Tất Cả Bài Viết &amp; Cẩm Nang', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/may-moc-trang-thiet-bi/')); ?>"><strong style="color: #FFB81C;">⚡</strong> <?php _e('Máy Móc &amp; Trang Thiết Bị', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/cam-nang-bao-duong/')); ?>"><?php _e('Cẩm Nang Bảo Dưỡng Định Kỳ', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/kien-thuc-ky-thuat/')); ?>"><?php _e('Kiến Thức &amp; Kỹ Thuật Ô Tô', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/kinh-nghiem-lai-xe/')); ?>"><?php _e('Kinh Nghiệm Lái Xe An Toàn', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/tin-tuc-su-kien/')); ?>"><?php _e('Tin Tức &amp; Hoạt Động Gara', 'hieugara-motors'); ?></a></li>
                </ul>
            </li>

            <!-- 6. LIÊN HỆ ⌵ -->
            <li class="nav-item has-dropdown <?php echo is_page('dat-lich') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="nav-link" title="LIÊN HỆ">
                    <span><?php _e('LIÊN HỆ', 'hieugara-motors'); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/dat-lich/')); ?>">Đặt Lịch Hẹn Với Chúng Tôi</a></li>
                    <li><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>">Hotline Cứu Hộ 24/7: <?php echo esc_html($rescue_phone); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>">Hệ Thống Garage Hải Hà</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ve-chung-toi/#hop-tac')); ?>">Hợp Tác Đối Tác &amp; Bảo Hiểm</a></li>
                </ul>
            </li>
        </ul>
        <?php endif; ?>

        <!-- Right: Cứu Hộ 24/7 + Tìm Kiếm Chuẩn SEO ở Cuối Cùng -->
        <div class="navbar-inline-actions">
            <!-- 1. Cứu hộ 24/7 (Khẩn cấp #D92D20) -->
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="navbar-rescue-btn" title="Gọi cứu hộ ô tô 24/7 khẩn cấp: <?php echo esc_attr($rescue_phone); ?>">
                <span class="rescue-live-dot" aria-hidden="true"></span>
                <i class="fa-solid fa-truck-pickup" aria-hidden="true"></i>
                <span class="rescue-btn-text">
                    <small>CỨU HỘ 24/7</small>
                    <strong><?php echo esc_html($rescue_phone); ?></strong>
                </span>
            </a>

            <!-- 2. Tìm kiếm chuẩn SEO ở cuối cùng -->
            <?php if ($menu_search === '1' || $menu_search === true || $menu_search === 'yes') : ?>
            <div class="seo-search-wrap">
                <form class="menu-search-pill" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" aria-label="Tìm kiếm dịch vụ và phụ tùng ô tô">
                    <label for="seoMenuSearchInput" class="screen-reader-text">Tìm kiếm dịch vụ, phụ tùng ô tô tại Ôtô Hải Hà</label>
                    <input type="search" id="seoMenuSearchInput" class="search-field" placeholder="Tìm dịch vụ, phụ tùng..." value="<?php echo esc_attr(get_search_query()); ?>" name="s" inputmode="search" enterkeyhint="search" autocomplete="off" aria-label="Tìm kiếm dịch vụ, phụ tùng ô tô">
                    <button type="submit" class="search-submit" aria-label="Tìm kiếm">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    </button>
                </form>
                <div class="seo-search-suggestions" aria-label="Gợi ý tìm kiếm phổ biến">
                    <div class="seo-suggest-title">Từ khóa tìm kiếm phổ biến</div>
                    <div class="seo-suggest-tags">
                        <a href="<?php echo esc_url(home_url('/?s=Bảo+dưỡng+định+kỳ')); ?>">Bảo dưỡng định kỳ</a>
                        <a href="<?php echo esc_url(home_url('/?s=Đồng+sơn+ô+tô')); ?>">Đồng sơn phòng sấy</a>
                        <a href="<?php echo esc_url(home_url('/?s=Sửa+chữa+động+cơ')); ?>">Sửa chữa động cơ</a>
                        <a href="<?php echo esc_url(home_url('/?s=Điều+hòa+ô+tô')); ?>">Điện &amp; điều hòa</a>
                        <a href="<?php echo esc_url(home_url('/?s=Phủ+Ceramic')); ?>">Phủ Ceramic 9H</a>
                        <a href="<?php echo esc_url(home_url('/?s=Cứu+hộ+24/7')); ?>">Cứu hộ 24/7</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
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
            <span><i class="fa-solid fa-envelope text-orange"></i> <?php echo esc_html($topbar_email); ?></span>
        </div>
    </div>
</nav>
