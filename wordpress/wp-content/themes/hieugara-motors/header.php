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

<!-- 3. Unified Mega Menu Bar (Logo + Menu + Cứu Hộ 24/7 + Hotline Tư Vấn + Tìm Kiếm SEO on 1 Row) -->
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
                'depth'          => 3,
            ));
            ?>
        <?php else : ?>
        <ul class="custom-nav-menu">
            <?php
            // Master Navigation Toggles & Labels
            $h_show_home        = get_option('hieugara_nav_show_home', '1');
            $h_show_about       = get_option('hieugara_nav_show_about', '1');
            $h_show_services    = get_option('hieugara_nav_show_services', '1');
            $h_show_vinfast     = get_option('hieugara_nav_show_vinfast', '1');
            $h_show_accessories = get_option('hieugara_nav_show_accessories', '1');
            $h_show_blog        = get_option('hieugara_nav_show_blog', '1');
            $h_show_contact     = get_option('hieugara_nav_show_contact', '1');

            $h_label_home        = get_option('hieugara_nav_label_home', 'TRANG CHỦ');
            $h_label_about       = get_option('hieugara_nav_label_about', 'GIỚI THIỆU');
            $h_label_services    = get_option('hieugara_nav_label_services', 'DỊCH VỤ');
            $h_label_accessories = get_option('hieugara_nav_label_accessories', 'PHỤ KIỆN');
            $h_label_blog        = get_option('hieugara_nav_label_blog', 'BLOG');
            $h_label_contact     = get_option('hieugara_nav_label_contact', 'LIÊN HỆ');
            ?>

            <?php if ($h_show_home === '1') : ?>
            <!-- 1. TRANG CHỦ -->
            <li class="nav-item <?php echo is_front_page() ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_home); ?>">
                    <?php echo esc_html($h_label_home); ?>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($h_show_about === '1') : ?>
            <!-- 2. GIỚI THIỆU ⌵ (100% Dynamic CRUD from WP Admin) -->
            <li class="nav-item has-dropdown <?php echo is_page('ve-chung-toi') || is_page('garage-gan-ban') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_about); ?>">
                    <span><?php echo esc_html($h_label_about); ?></span>
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
                                <?php echo esc_html($a_item['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php if ($h_show_services === '1') : ?>
            <!-- 3. DỊCH VỤ ⌵ (Đồng bộ sổ dọc + Danh mục con chuẩn ductri226.vn) -->
            <li class="nav-item has-dropdown <?php echo is_post_type_archive('garage_service') || is_singular('garage_service') || is_tax('service_category') || is_page('bang-gia') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_services); ?>" aria-haspopup="true" aria-expanded="false">
                    <span><?php echo esc_html($h_label_services); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <?php if ($h_show_vinfast === '1') : ?>
                    <li class="has-sub-dropdown">
                        <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>">
                            <span><?php _e('Dịch Vụ Xe VinFast', 'hieugara-motors'); ?></span>
                            <i class="fa-solid fa-chevron-right sub-caret" aria-hidden="true"></i>
                        </a>
                        <ul class="nav-sub-dropdown">
                            <li>
                                <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>">
                                    <?php _e('Đối tác dịch vụ chính thức VinFast', 'hieugara-motors'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/#tiep-nhan')); ?>">
                                    <?php _e('Tư vấn kỹ thuật xe VinFast', 'hieugara-motors'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
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
                            $has_children = !empty($cat_services);
                    ?>
                            <li class="<?php echo $has_children ? 'has-sub-dropdown' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/dich-vu/' . $d_cat->slug . '/')); ?>">
                                    <span><?php echo esc_html(wp_specialchars_decode($d_cat->name, ENT_QUOTES)); ?></span>
                                    <?php if ($has_children) : ?>
                                        <i class="fa-solid fa-chevron-right sub-caret" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </a>
                                <?php if ($has_children) : ?>
                                    <ul class="nav-sub-dropdown">
                                        <?php foreach ($cat_services as $c_post) : ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_permalink($c_post->ID)); ?>">
                                                    <?php echo esc_html(wp_specialchars_decode($c_post->post_title, ENT_QUOTES)); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php if ($h_show_accessories === '1') : ?>
            <!-- 4. PHỤ KIỆN ⌵ -->
            <li class="nav-item has-dropdown <?php echo is_page('phu-kien') || is_singular('garage_accessory') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_accessories); ?>">
                    <span><?php echo esc_html($h_label_accessories); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <?php 
                    $nav_acc_cats = function_exists('hieugara_get_accessories_categories') ? hieugara_get_accessories_categories() : array();
                    foreach ($nav_acc_cats as $c_slug => $c_data) :
                    ?>
                        <li>
                            <a href="<?php echo esc_url(home_url('/phu-kien/#cat-' . $c_slug)); ?>">
                                <?php echo esc_html($c_data['short_name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php if ($h_show_blog === '1') : ?>
            <!-- 5. BLOG ⌵ -->
            <li class="nav-item has-dropdown <?php echo (is_page('blog') || is_home() || is_category() || is_singular('post')) ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_blog); ?>">
                    <span><?php echo esc_html($h_label_blog); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="<?php echo esc_url(home_url('/category/he-thong-va-trang-thiet-bi/')); ?>"><?php _e('Hệ Thống &amp; Trang Thiết Bị', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/cam-nang-bao-duong/')); ?>"><?php _e('Cẩm Nang Bảo Dưỡng Định Kỳ', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/kien-thuc-ky-thuat/')); ?>"><?php _e('Kiến Thức &amp; Kỹ Thuật Ô Tô', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/kinh-nghiem-lai-xe/')); ?>"><?php _e('Kinh Nghiệm Lái Xe An Toàn', 'hieugara-motors'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/tin-tuc-su-kien/')); ?>"><?php _e('Tin Tức &amp; Hoạt Động Gara', 'hieugara-motors'); ?></a></li>
                </ul>
            </li>
            <?php endif; ?>

            <?php if ($h_show_contact === '1') : ?>
            <!-- 6. LIÊN HỆ ⌵ -->
            <li class="nav-item has-dropdown">
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/#lien-he')); ?>" class="nav-link" title="<?php echo esc_attr($h_label_contact); ?>">
                    <span><?php echo esc_html($h_label_contact); ?></span>
                    <i class="fa-solid fa-chevron-down nav-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <?php
                    $contact_nav_items = function_exists('hieugara_get_contact_menu_items') ? hieugara_get_contact_menu_items() : array();
                    foreach ($contact_nav_items as $c_item) :
                        if (empty($c_item['enable'])) continue;
                    ?>
                        <li>
                            <a href="<?php echo esc_url($c_item['link']); ?>" target="<?php echo esc_attr($c_item['target'] ?? '_self'); ?>">
                                <?php echo esc_html($c_item['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

        <!-- Right: Cứu Hộ 24/7 + Tìm Kiếm Chuẩn SEO ở Cuối Cùng -->
        <div class="navbar-inline-actions">
            <?php if (get_option('hieugara_nav_show_rescue_btn', '1') === '1') : ?>
            <!-- 1. Cứu hộ 24/7 (Khẩn cấp #D92D20) -->
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="navbar-rescue-btn" title="Gọi cứu hộ ô tô 24/7 khẩn cấp: <?php echo esc_attr($rescue_phone); ?>">
                <span class="rescue-live-dot" aria-hidden="true"></span>
                <i class="fa-solid fa-truck-pickup" aria-hidden="true"></i>
                <span class="rescue-btn-text">
                    <small>CỨU HỘ 24/7</small>
                    <strong><?php echo esc_html($rescue_phone); ?></strong>
                </span>
            </a>
            <?php endif; ?>

            <!-- 2. Tìm kiếm chuẩn SEO ở cuối cùng -->
            <?php if (get_option('hieugara_nav_show_search', '1') === '1' && ($menu_search === '1' || $menu_search === true || $menu_search === 'yes')) : ?>
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
        <a href="tel:02203892207" class="drawer-btn-book" style="background: #D4B996; color: #141414;">
            <i class="fa-solid fa-phone"></i>
            <span>TỔNG ĐÀI TƯ VẤN: 02203 892 207</span>
        </a>
        <div class="drawer-meta-info">
            <span><i class="fa-solid fa-phone text-orange"></i> Hotline: <?php echo esc_html($hotline_phone); ?></span>
            <span><i class="fa-solid fa-envelope text-orange"></i> <?php echo esc_html($topbar_email); ?></span>
        </div>
    </div>
</nav>
