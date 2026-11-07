<?php
/**
 * Ôtô Hải Hà - Theme Options & Management Panel
 * Cho phép Quản trị viên bật/tắt Topbar, chỉnh sửa Banner Slider, quản lý Hotline, Cứu hộ và Menu
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Register Admin Menu
function hieugara_add_admin_menu() {
    add_menu_page(
        __('Cài Đặt Giao Diện', 'hieugara-motors'),
        __('Cài Đặt Giao Diện', 'hieugara-motors'),
        'manage_options',
        'hieugara-theme-settings',
        'hieugara_render_theme_settings_page',
        'dashicons-car',
        59
    );
}
add_action('admin_menu', 'hieugara_add_admin_menu');

// 2. Enqueue Media & Styles for Settings Page
function hieugara_admin_settings_assets($hook) {
    if ($hook !== 'toplevel_page_hieugara-theme-settings') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style('hieugara-admin-style', get_template_directory_uri() . '/assets/css/admin-settings.css', array(), HIEUGARA_THEME_VERSION);
}
add_action('admin_enqueue_scripts', 'hieugara_admin_settings_assets');

// 3. Register Settings with Sanitization Callbacks
function hieugara_register_theme_settings() {
    $str_san = array('sanitize_callback' => 'sanitize_text_field');

    // Topbar & Header Options
    register_setting('hieugara_settings_group', 'hieugara_topbar_enable', $str_san);
    register_setting('hieugara_settings_group', 'hieugara_topbar_email', array('sanitize_callback' => 'sanitize_email'));
    register_setting('hieugara_settings_group', 'hieugara_topbar_hours', $str_san);
    register_setting('hieugara_settings_group', 'hieugara_topbar_system', $str_san);
    register_setting('hieugara_settings_group', 'hieugara_rescue_phone', $str_san);
    register_setting('hieugara_settings_group', 'hieugara_hotline_phone', $str_san);
    register_setting('hieugara_settings_group', 'hieugara_warranty_url', array('sanitize_callback' => 'esc_url_raw'));
    register_setting('hieugara_settings_group', 'hieugara_menu_search_enable', $str_san);

    // Banner Slider Data
    register_setting('hieugara_settings_group', 'hieugara_slider_slides');

    // Brand Logos Marquee Data (Continuous Ticker)
    register_setting('hieugara_settings_group', 'hieugara_brand_logos');

    // Gallery Images Data (Hình Ảnh Ôtô Hải Hà)
    register_setting('hieugara_settings_group', 'hieugara_gallery_items');
}
add_action('admin_init', 'hieugara_register_theme_settings');

// 3A. Helper to Get Default Gallery Items (Hình Ảnh Ôtô Hải Hà)
function hieugara_get_default_gallery_items() {
    $gallery_uri = get_template_directory_uri() . '/assets/images/gallery';
    return array(
        1 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-1.jpg',
            'title'  => 'Đội ngũ kỹ thuật viên Ôtô Hải Hà kiểm tra & sửa chữa khoang máy',
        ),
        2 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-2.jpg',
            'title'  => 'Khu vực đồng sơn & hệ thống Phòng Sơn Cao Cấp 1 - 2 - 3',
        ),
        3 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-6.jpg',
            'title'  => 'Xe sang Mercedes-Maybach tại Phòng Sơn Sấy Cao Cấp Ôtô Hải Hà',
        ),
        4 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-7.jpg',
            'title'  => 'Hệ thống cầu nâng & Căn chỉnh độ chụm 3D Hunter cho dòng xe sang',
        ),
        5 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-4.jpg',
            'title'  => 'Không gian xưởng dịch vụ sửa chữa & bảo dưỡng rộng rãi hiện đại',
        ),
        6 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-5.jpg',
            'title'  => 'Phòng sơn sấy tiêu chuẩn Châu Âu thi công sơn xe Porsche Panamera',
        ),
        7 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-8.jpg',
            'title'  => 'Hệ thống sấy hồng ngoại trong phòng sơn khép kín tại Ôtô Hải Hà',
        ),
        8 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-9.jpg',
            'title'  => 'Căn chỉnh thước lái & góc đặt bánh xe bằng máy Hunter USA',
        ),
        9 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-11.jpg',
            'title'  => 'Kiểm tra & cân chỉnh độ chụm 3D chính xác từng milimet',
        ),
        10 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-10.jpg',
            'title'  => 'Hệ thống bệ kiểm tra gầm và căn chỉnh độ chụm công nghệ cao',
        ),
        11 => array(
            'enable' => '1',
            'img'    => $gallery_uri . '/haiha-gallery-3.jpg',
            'title'  => 'Dịch vụ cứu hộ giao thông sàn trượt 24/7 Ôtô Hải Hà',
        ),
    );
}

function hieugara_get_gallery_items() {
    $saved    = get_option('hieugara_gallery_items');
    $defaults = hieugara_get_default_gallery_items();

    if ($saved === false || !is_array($saved)) {
        return $defaults;
    }

    $items = array();
    foreach ($saved as $k => $item) {
        if (!empty($item['img']) || !empty($item['title'])) {
            $items[$k] = array(
                'enable' => isset($item['enable']) ? '1' : '0',
                'img'    => esc_url_raw($item['img']),
                'title'  => sanitize_text_field($item['title']),
            );
        }
    }
    return $items;
}

// 3B. Helper to Get Default Brand Logos (13 Luxury Car Brands & Auto Components)
if (!function_exists('hieugara_get_default_brand_logos')) {
function hieugara_get_default_brand_logos() {
    $theme_uri = get_template_directory_uri();
    $brand_dir = $theme_uri . '/assets/images/brands';

    return array(
        1 => array(
            'id'     => 1,
            'enable' => '1',
            'name'   => 'Mercedes-Benz',
            'logo'   => $brand_dir . '/mercedes.svg',
            'grad1'  => '#0c1e3a',
            'grad2'  => '#334155',
            'url'    => 'https://www.mercedes-benz.com.vn/',
        ),
        2 => array(
            'id'     => 2,
            'enable' => '1',
            'name'   => 'BMW',
            'logo'   => $brand_dir . '/bmw.svg',
            'grad1'  => '#0066b1',
            'grad2'  => '#38bdf8',
            'url'    => 'https://www.bmw.vn/',
        ),
        3 => array(
            'id'     => 3,
            'enable' => '1',
            'name'   => 'Audi',
            'logo'   => $brand_dir . '/audi.svg',
            'grad1'  => '#bb0a30',
            'grad2'  => '#60a5fa',
            'url'    => 'https://www.audi.vn/',
        ),
        4 => array(
            'id'     => 4,
            'enable' => '1',
            'name'   => 'Porsche',
            'logo'   => $brand_dir . '/porsche.svg',
            'grad1'  => '#b91c1c',
            'grad2'  => '#f59e0b',
            'url'    => 'https://www.porsche.com/vietnam/',
        ),
        5 => array(
            'id'     => 5,
            'enable' => '1',
            'name'   => 'Lexus',
            'logo'   => $brand_dir . '/lexus.svg',
            'grad1'  => '#18181b',
            'grad2'  => '#52525b',
            'url'    => 'https://www.lexus.com.vn/',
        ),
        6 => array(
            'id'     => 6,
            'enable' => '1',
            'name'   => 'Toyota',
            'logo'   => $brand_dir . '/toyota.svg',
            'grad1'  => '#dc2626',
            'grad2'  => '#2563eb',
            'url'    => 'https://www.toyota.com.vn/',
        ),
        7 => array(
            'id'     => 7,
            'enable' => '1',
            'name'   => 'Hyundai',
            'logo'   => $brand_dir . '/hyundai.svg',
            'grad1'  => '#002c5f',
            'grad2'  => '#0284c7',
            'url'    => 'https://hyundai.thanhcong.vn/',
        ),
        8 => array(
            'id'     => 8,
            'enable' => '1',
            'name'   => 'Ford',
            'logo'   => $brand_dir . '/ford.svg',
            'grad1'  => '#003478',
            'grad2'  => '#2563eb',
            'url'    => 'https://www.ford.com.vn/',
        ),
        9 => array(
            'id'     => 9,
            'enable' => '1',
            'name'   => 'Honda',
            'logo'   => $brand_dir . '/honda.svg',
            'grad1'  => '#cc0000',
            'grad2'  => '#2563eb',
            'url'    => 'https://www.honda.com.vn/',
        ),
        10 => array(
            'id'     => 10,
            'enable' => '1',
            'name'   => 'Bosch Automotive',
            'logo'   => $brand_dir . '/bosch.svg',
            'grad1'  => '#005691',
            'grad2'  => '#0284c7',
            'url'    => 'https://www.bosch.com.vn/',
        ),
        11 => array(
            'id'     => 11,
            'enable' => '1',
            'name'   => '3M Automotive',
            'logo'   => $brand_dir . '/3m.svg',
            'grad1'  => '#2563eb',
            'grad2'  => '#1d4ed8',
            'url'    => 'https://www.3m.com.vn/',
        ),
        12 => array(
            'id'     => 12,
            'enable' => '1',
            'name'   => 'Volkswagen',
            'logo'   => $brand_dir . '/volkswagen.svg',
            'grad1'  => '#001e50',
            'grad2'  => '#0284c7',
            'url'    => 'https://vw.com.vn/',
        ),
    );
}
}

// 3C. Helper to Get Active Brand Logos
if (!function_exists('hieugara_get_brand_logos')) {
function hieugara_get_brand_logos() {
    $saved = get_option('hieugara_brand_logos');
    $defaults = hieugara_get_default_brand_logos();

    if ($saved === false || empty($saved) || !is_array($saved)) {
        return $defaults;
    }

    $brands = array();
    foreach ($saved as $k => $item) {
        if (!empty($item['name']) || !empty($item['logo'])) {
            $brands[$k] = array(
                'id'     => isset($item['id']) ? $item['id'] : $k,
                'enable' => isset($item['enable']) ? $item['enable'] : '0',
                'name'   => sanitize_text_field($item['name']),
                'logo'   => function_exists('hieugara_normalize_local_media_urls') ? hieugara_normalize_local_media_urls($item['logo']) : esc_url_raw($item['logo']),
                'grad1'  => !empty($item['grad1']) ? sanitize_hex_color($item['grad1']) : '#0c1e3a',
                'grad2'  => !empty($item['grad2']) ? sanitize_hex_color($item['grad2']) : '#334155',
                'url'    => !empty($item['url']) ? esc_url_raw($item['url']) : '#',
            );
        }
    }
    return !empty($brands) ? $brands : $defaults;
}
}

// 4. Helper to Get Default Slides
function hieugara_get_default_slides() {
    $theme_uri = get_template_directory_uri();
    $slider_img = $theme_uri . '/assets/images/slider';

    return array(
        1 => array(
            'enable'   => '1',
            'eyebrow'  => 'QUY TRÌNH 45 HẠNG MỤC • 100% PHỤ TÙNG CHÍNH HÃNG',
            'title'    => 'BẢO DƯỠNG & SỬA CHỮA Ô TÔ',
            'nav_tab'  => 'BẢO DƯỠNG & SỬA CHỮA',
            'desc'     => 'Hệ thống 28 cầu nâng thủy lực tiêu chuẩn châu Âu, máy chẩn đoán ECU chuyên sâu cho Mercedes, BMW, Audi, Lexus, Porsche, Toyota... Đội ngũ kỹ sư trưởng giàu kinh nghiệm.',
            'btn_text' => 'TÌM HIỂU THÊM',
            'btn_url'  => home_url('/bang-gia/'),
            'image'    => $slider_img . '/slide-bao-duong.jpg',
        ),
        2 => array(
            'enable'   => '1',
            'eyebrow'  => 'DETAILING CHUYÊN NGHIỆP • CÔNG NGHỆ CHUYỂN GIAO NHẬT BẢN',
            'title'    => 'CHĂM SÓC & LÀM ĐẸP Ô TÔ',
            'nav_tab'  => 'CHĂM SÓC & LÀM ĐẸP',
            'desc'     => 'Phủ bóng Ceramic Pro 9H bảo vệ sơn xe toàn diện, dán phim cách nhiệt 3M Crystalline chính hãng, dán PPF tự phục hồi vết xước và dọn nội thất khử khuẩn Ozone chuyên sâu.',
            'btn_text' => 'TÌM HIỂU THÊM',
            'btn_url'  => home_url('/bang-gia/'),
            'image'    => $slider_img . '/slide-detailing.jpg',
        ),
        3 => array(
            'enable'   => '1',
            'eyebrow'  => 'SƠN GỐC NƯỚC CHÍNH HÃNG AXALTA • BẢO HÀNH 24 THÁNG',
            'title'    => 'SƠN PHỤC HỒI & NÂNG CẤP THÂN VỎ',
            'nav_tab'  => 'SƠN PHỤC HỒI THÂN VỎ',
            'desc'     => 'Khôi phục nguyên trạng màu sơn xe nguyên bản 100%. Phòng sấy hấp hồng ngoại khép kín, buồng khử bụi tuần hoàn đảm bảo độ bóng sâu và độ bền màu vượt thời gian.',
            'btn_text' => 'TÌM HIỂU THÊM',
            'btn_url'  => home_url('/bang-gia/#du-toan-son-xe'),
            'image'    => $slider_img . '/slide-son-xe.jpg',
        ),
        4 => array(
            'enable'   => '1',
            'eyebrow'  => 'CỨU HỘ 24/7 TOÀN QUỐC • BẢO HÀNH ĐIỆN TỬ MINH BẠCH',
            'title'    => 'CỨU HỘ 24/7 & BẢO LÃNH BẢO HIỂM',
            'nav_tab'  => 'CỨU HỘ & BẢO HIỂM',
            'desc'     => 'Đội xe cứu hộ chuyên dụng túc trực 24/7 sẵn sàng ứng cứu mọi sự cố. Liên kết bảo lãnh sửa chữa tất cả các hãng bảo hiểm lớn và tra cứu bảo hành điện tử theo biển số.',
            'btn_text' => 'TÌM HIỂU THÊM',
            'btn_url'  => home_url('/tra-cuu-bao-hanh/'),
            'image'    => $slider_img . '/slide-cuu-ho.jpg',
        ),
    );
}

// 5. Helper to Get Active Slides
function hieugara_get_slides() {
    $saved = get_option('hieugara_slider_slides');
    $defaults = hieugara_get_default_slides();

    if (empty($saved) || !is_array($saved)) {
        return $defaults;
    }

    $slides = array();
    foreach ($defaults as $i => $default) {
        $slide_img = !empty($saved[$i]['image']) ? $saved[$i]['image'] : $default['image'];
        $slide_btn = !empty($saved[$i]['btn_url']) ? $saved[$i]['btn_url'] : $default['btn_url'];
        if (function_exists('hieugara_normalize_local_media_urls')) {
            $slide_img = hieugara_normalize_local_media_urls($slide_img);
            $slide_btn = hieugara_normalize_local_media_urls($slide_btn);
        }
        if (strpos($slide_btn, '/dat-lich/') !== false) {
            $slide_btn = home_url('/bang-gia/');
        }
        $slides[$i] = array(
            'enable'   => isset($saved[$i]['enable']) ? $saved[$i]['enable'] : $default['enable'],
            'eyebrow'  => !empty($saved[$i]['eyebrow']) ? $saved[$i]['eyebrow'] : $default['eyebrow'],
            'title'    => !empty($saved[$i]['title']) ? $saved[$i]['title'] : $default['title'],
            'nav_tab'  => !empty($saved[$i]['nav_tab']) ? $saved[$i]['nav_tab'] : $default['nav_tab'],
            'desc'     => !empty($saved[$i]['desc']) ? $saved[$i]['desc'] : $default['desc'],
            'btn_text' => !empty($saved[$i]['btn_text']) ? $saved[$i]['btn_text'] : $default['btn_text'],
            'btn_url'  => $slide_btn,
            'image'    => $slide_img,
        );
    }
    return $slides;
}

// 6. Render Settings Page
function hieugara_render_theme_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $topbar_enable = get_option('hieugara_topbar_enable', '0');
    $topbar_email  = get_option('hieugara_topbar_email', 'service@haiha-auto.vn');
    $topbar_hours  = get_option('hieugara_topbar_hours', '08:00 - 18:00 (T2 - CN)');
    $topbar_system = get_option('hieugara_topbar_system', 'Hệ thống xưởng dịch vụ toàn quốc');
    $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
    $hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
    $warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
    $menu_search   = get_option('hieugara_menu_search_enable', '1');

    $slides = hieugara_get_slides();
    $brands = hieugara_get_brand_logos();
    $gallery_items = hieugara_get_gallery_items();
    ?>
    <div class="wrap hieugara-admin-wrap">
        <h1 class="hieugara-admin-title">
            <span class="dashicons dashicons-car"></span>
            <?php _e('Cài Đặt Giao Diện Ôtô Hải Hà Service', 'hieugara-motors'); ?>
        </h1>
        <p class="description">
            <?php _e('Tùy biến nhanh thanh tiện ích trên cùng, thông tin hotline/cứu hộ, banner slider và quản lý menu hiển thị ngoài trang chủ.', 'hieugara-motors'); ?>
        </p>

        <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong><?php _e('✓ Đã lưu thành công tất cả cài đặt giao diện!', 'hieugara-motors'); ?></strong></p>
            </div>
            <?php
            // Tự động xóa page cache sau khi lưu
            hieugara_purge_page_cache();
            ?>
        <?php endif; ?>

        <form method="post" action="options.php" class="hieugara-settings-form">
            <?php settings_fields('hieugara_settings_group'); ?>

            <!-- TAB 1: DÒNG TIỆN ÍCH TRÊN CÙNG & HOTLINE -->
            <div class="hieugara-card">
                <div class="card-header">
                    <h2><span class="dashicons dashicons-admin-appearance"></span> 1. Dòng Tiện Ích Trên Cùng (Topbar) &amp; Thông Tin Liên Hệ</h2>
                </div>
                <div class="card-body">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('Bật / Tắt dòng trên cùng (Topbar)', 'hieugara-motors'); ?></th>
                            <td>
                                <label class="hieugara-switch">
                                    <input type="checkbox" name="hieugara_topbar_enable" value="1" <?php checked('1', $topbar_enable); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hieugara-switch-desc"><?php _e('Bật để hiển thị dòng đen tiện ích ở trên cùng website (Tắt để ẩn hoàn toàn).', 'hieugara-motors'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Hotline Cứu Hộ 24/7 (Nổi bật)', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="text" name="hieugara_rescue_phone" value="<?php echo esc_attr($rescue_phone); ?>" class="regular-text" style="font-weight: bold; color: #1d4ed8;">
                                <p class="description"><?php _e('Số điện thoại cứu hộ khẩn cấp 24/7 (hiển thị nổi bật với icon chớp đèn ở Header và Topbar).', 'hieugara-motors'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Số Điện Thoại Hotline Kỹ Thuật', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="text" name="hieugara_hotline_phone" value="<?php echo esc_attr($hotline_phone); ?>" class="regular-text" style="font-weight: bold;">
                                <p class="description"><?php _e('Số tổng đài tư vấn kỹ thuật & báo giá trên Header chính.', 'hieugara-motors'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Email tiếp nhận', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="email" name="hieugara_topbar_email" value="<?php echo esc_attr($topbar_email); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Giờ tiếp nhận dịch vụ', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="text" name="hieugara_topbar_hours" value="<?php echo esc_attr($topbar_hours); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Thông điệp hệ thống', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="text" name="hieugara_topbar_system" value="<?php echo esc_attr($topbar_system); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Link Tra cứu bảo hành điện tử', 'hieugara-motors'); ?></th>
                            <td>
                                <input type="url" name="hieugara_warranty_url" value="<?php echo esc_attr($warranty_url); ?>" class="regular-text">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- TAB 2: QUẢN LÝ THANH MENU -->
            <div class="hieugara-card">
                <div class="card-header">
                    <h2><span class="dashicons dashicons-menu"></span> 2. Cấu Hình &amp; Chỉnh Sửa Thanh Menu</h2>
                </div>
                <div class="card-body">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('Ô tìm kiếm trên menu', 'hieugara-motors'); ?></th>
                            <td>
                                <label class="hieugara-switch">
                                    <input type="checkbox" name="hieugara_menu_search_enable" value="1" <?php checked('1', $menu_search); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hieugara-switch-desc"><?php _e('Hiển thị ô tìm kiếm bo tròn pill [Tìm kiếm.... 🔍] ở cuối menu.', 'hieugara-motors'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Chỉnh sửa các mục Menu', 'hieugara-motors'); ?></th>
                            <td>
                                <div class="menu-guidance-box">
                                    <p><strong>Thanh menu hiện đang hỗ trợ 2 chế độ:</strong></p>
                                    <ul>
                                        <li><strong>Chế độ Mặc định:</strong> Đầy đủ 7 danh mục cân đối (TRANG CHỦ, GIỚI THIỆU ⌵, DỊCH VỤ ⌵, PHỤ KIỆN ⌵, BLOG ⌵, KHUYẾN MẠI, LIÊN HỆ ⌵) với Mega-menu 3 cột chuyên nghiệp.</li>
                                        <li><strong>Chế độ Tùy biến WordPress:</strong> Bạn có thể tự thêm, xóa, sửa, đổi tên hoặc kéo thả thứ tự bất kỳ mục nào trực tiếp tại trình quản lý menu chuẩn của WordPress.</li>
                                    </ul>
                                    <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="button button-primary" target="_blank">
                                        <span class="dashicons dashicons-external" style="margin-top: 4px;"></span> <?php _e('Mở Trình Quản Lý Menu (Giao diện -> Menus)', 'hieugara-motors'); ?>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- TAB 3: CHỈNH SỬA BANNER SLIDER (LEXUS STYLE) -->
            <div class="hieugara-card">
                <div class="card-header">
                    <h2><span class="dashicons dashicons-images-alt2"></span> 3. Chỉnh Sửa Banner Slider (Phong cách Lexus Vietnam)</h2>
                </div>
                <div class="card-body">
                    <p class="description" style="margin-bottom: 20px;">
                        <?php _e('Tùy biến tiêu đề, mô tả, nút bấm và ảnh nền cho từng slide. Có thể dán trực tiếp link ảnh hoặc bấm "Chọn ảnh từ Thư viện" để tải ảnh mới lên.', 'hieugara-motors'); ?>
                    </p>

                    <div class="slides-accordion">
                        <?php foreach ($slides as $idx => $s) : ?>
                            <div class="slide-item-box">
                                <div class="slide-item-header">
                                    <h3>
                                        <span class="slide-num-badge">Slide <?php echo esc_html($idx); ?></span>
                                        <span class="slide-title-preview"><?php echo esc_html($s['title']); ?></span>
                                    </h3>
                                    <label class="slide-enable-toggle">
                                        <input type="checkbox" name="hieugara_slider_slides[<?php echo $idx; ?>][enable]" value="1" <?php checked('1', $s['enable']); ?>>
                                        <span><?php _e('Kích hoạt slide này', 'hieugara-motors'); ?></span>
                                    </label>
                                </div>
                                <div class="slide-item-content">
                                    <div class="slide-fields-grid">
                                        <div class="slide-field-group">
                                            <label><strong><?php _e('Tiêu đề nhỏ trên cùng (Eyebrow)', 'hieugara-motors'); ?>:</strong></label>
                                            <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][eyebrow]" value="<?php echo esc_attr($s['eyebrow']); ?>" class="widefat">
                                        </div>

                                        <div class="slide-field-group">
                                            <label><strong><?php _e('Tiêu đề chính (Title)', 'hieugara-motors'); ?>:</strong></label>
                                            <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][title]" value="<?php echo esc_attr($s['title']); ?>" class="widefat" style="font-weight: 700; color: #111;">
                                        </div>

                                        <div class="slide-field-group">
                                            <label><strong><?php _e('Nhãn trên thanh phân trang dưới (Dash label)', 'hieugara-motors'); ?>:</strong></label>
                                            <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][nav_tab]" value="<?php echo esc_attr($s['nav_tab']); ?>" class="widefat">
                                        </div>

                                        <div class="slide-field-group">
                                            <label><strong><?php _e('Mô tả ngắn (Description)', 'hieugara-motors'); ?>:</strong></label>
                                            <textarea name="hieugara_slider_slides[<?php echo $idx; ?>][desc]" rows="2" class="widefat"><?php echo esc_textarea($s['desc']); ?></textarea>
                                        </div>

                                        <div class="slide-field-row-2col">
                                            <div class="slide-field-group">
                                                <label><strong><?php _e('Chữ trên nút (Button text)', 'hieugara-motors'); ?>:</strong></label>
                                                <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][btn_text]" value="<?php echo esc_attr($s['btn_text']); ?>" class="widefat">
                                            </div>
                                            <div class="slide-field-group">
                                                <label><strong><?php _e('Đường dẫn nút (Button URL)', 'hieugara-motors'); ?>:</strong></label>
                                                <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][btn_url]" value="<?php echo esc_attr($s['btn_url']); ?>" class="widefat">
                                            </div>
                                        </div>

                                        <div class="slide-field-group slide-image-picker-group">
                                            <label><strong><?php _e('Hình ảnh nền (Kích thước đề xuất: 1920x1080px)', 'hieugara-motors'); ?>:</strong></label>
                                            <div class="image-preview-row">
                                                <div class="img-thumb-box">
                                                    <img src="<?php echo esc_url($s['image']); ?>" id="preview-slide-<?php echo $idx; ?>" alt="Preview" style="max-height: 85px; border-radius: 4px; border: 1px solid #ccc; display: block;">
                                                </div>
                                                <div class="img-input-box" style="flex: 1;">
                                                    <input type="text" name="hieugara_slider_slides[<?php echo $idx; ?>][image]" id="input-slide-<?php echo $idx; ?>" value="<?php echo esc_attr($s['image']); ?>" class="widefat" style="margin-bottom: 6px;">
                                                    <button type="button" class="button hieugara-upload-btn" data-target-input="#input-slide-<?php echo $idx; ?>" data-target-preview="#preview-slide-<?php echo $idx; ?>">
                                                        <span class="dashicons dashicons-upload" style="margin-top: 3px;"></span> <?php _e('Chọn ảnh từ Thư viện Media', 'hieugara-motors'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- TAB 4: QUẢN LÝ MỤC ALL ABOUT CARS (DỊCH VỤ & DỰ ÁN GARA) -->
            <div class="hieugara-card">
                <div class="card-header">
                    <h2><span class="dashicons dashicons-hammer"></span> 4. Quản Lý Mục "ALL ABOUT CARS" (Thêm, Sửa, Xoá &amp; Cập Nhật Dịch Vụ)</h2>
                </div>
                <div class="card-body">
                    <p class="description" style="margin-bottom: 20px;">
                        <?php _e('Mục <strong>"ALL ABOUT CARS"</strong> trên trang chủ hoạt động dưới dạng thanh trượt Swiper chuyên nghiệp (hỗ trợ lăn chuột ngang và vuốt cảm ứng). Dữ liệu được đồng bộ trực tiếp từ loại bài viết <strong>Dịch Vụ Gara</strong>. Bạn có thể thêm không giới hạn, chỉnh sửa nội dung, đổi hình ảnh hoặc xóa dịch vụ bất kỳ lúc nào.', 'hieugara-motors'); ?>
                    </p>

                    <div style="display: flex; gap: 14px; margin-bottom: 24px; flex-wrap: wrap;">
                        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=garage_service')); ?>" class="button button-primary button-hero" style="display: inline-flex; align-items: center; gap: 6px; background: #1d4ed8; border-color: #1d4ed8;">
                            <span class="dashicons dashicons-plus-alt2"></span>
                            <span><?php _e('THÊM DỊCH VỤ MỚI', 'hieugara-motors'); ?></span>
                        </a>
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=garage_service')); ?>" class="button button-secondary button-hero" style="display: inline-flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-list-view"></span>
                            <span><?php _e('QUẢN LÝ TẤT CẢ DỊCH VỤ (SỬA / XÓA)', 'hieugara-motors'); ?></span>
                        </a>
                        <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=service_category&post_type=garage_service')); ?>" class="button button-secondary button-hero" style="display: inline-flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-tag"></span>
                            <span><?php _e('DANH MỤC DỊCH VỤ', 'hieugara-motors'); ?></span>
                        </a>
                    </div>

                    <!-- Live Services List Preview in Admin -->
                    <div style="background: #fafafa; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px;">
                        <h3 style="margin-top: 0; font-size: 1rem; color: #0c1e3a; display: flex; align-items: center; justify-content: space-between;">
                            <span><?php _e('Các dịch vụ hiện đang hiển thị trên thanh trượt All About Cars:', 'hieugara-motors'); ?></span>
                            <?php
                            $services_admin_list = get_posts(array(
                                'post_type'      => 'garage_service',
                                'posts_per_page' => 20,
                                'post_status'    => 'publish',
                                'orderby'        => 'menu_order date',
                                'order'          => 'ASC'
                            ));
                            ?>
                            <span style="font-size: 0.82rem; background: #0c1e3a; color: #fff; padding: 2px 10px; border-radius: 12px;">
                                <?php echo count($services_admin_list); ?> dịch vụ
                            </span>
                        </h3>

                        <?php if (!empty($services_admin_list)) : ?>
                            <table class="widefat striped" style="border: 1px solid #cbd5e1; margin-top: 12px;">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;"><?php _e('Ảnh', 'hieugara-motors'); ?></th>
                                        <th><?php _e('Tên Dịch Vụ', 'hieugara-motors'); ?></th>
                                        <th><?php _e('Huy hiệu (Badge)', 'hieugara-motors'); ?></th>
                                        <th><?php _e('Giá tham khảo', 'hieugara-motors'); ?></th>
                                        <th style="width: 160px; text-align: right;"><?php _e('Hành động', 'hieugara-motors'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($services_admin_list as $srv_item) :
                                        $s_thumb = has_post_thumbnail($srv_item->ID) ? get_the_post_thumbnail_url($srv_item->ID, 'thumbnail') : get_post_meta($srv_item->ID, '_garage_custom_image', true);
                                        $s_badge = get_post_meta($srv_item->ID, '_garage_badge', true);
                                        $s_price = get_post_meta($srv_item->ID, '_garage_price_from', true);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php if ($s_thumb) : ?>
                                                    <img src="<?php echo esc_url($s_thumb); ?>" alt="Thumb" style="width: 50px; height: 35px; object-fit: cover; border-radius: 3px; display: block;">
                                                <?php else : ?>
                                                    <div style="width: 50px; height: 35px; background: #e2e8f0; border-radius: 3px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #64748b;">No img</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><a href="<?php echo esc_url(get_edit_post_link($srv_item->ID)); ?>" style="color: #0c1e3a;"><?php echo esc_html($srv_item->post_title); ?></a></strong>
                                                <div style="font-size: 0.8rem; color: #64748b;">
                                                    <a href="<?php echo esc_url(get_permalink($srv_item->ID)); ?>" target="_blank" style="color: #0284c7;">Xem trang chi tiết ↗</a>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($s_badge) : ?>
                                                    <span style="display: inline-block; background: #fff0ed; color: #1d4ed8; border: 1px solid #ffcdbf; padding: 2px 8px; border-radius: 3px; font-size: 0.75rem; font-weight: 700;"><?php echo esc_html($s_badge); ?></span>
                                                <?php else : ?>
                                                    <span style="color: #94a3b8; font-size: 0.8rem;">—</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong style="color: #1d4ed8;"><?php echo esc_html($s_price ? $s_price : 'Miễn phí khảo sát'); ?></strong>
                                            </td>
                                            <td style="text-align: right;">
                                                <a href="<?php echo esc_url(get_edit_post_link($srv_item->ID)); ?>" class="button button-small">
                                                    <span class="dashicons dashicons-edit" style="margin-top: 3px;"></span> Sửa
                                                </a>
                                                <a href="<?php echo esc_url(get_delete_post_link($srv_item->ID)); ?>" class="button button-small" onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này không?');" style="color: #dc2626;">
                                                    <span class="dashicons dashicons-trash" style="margin-top: 3px;"></span> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p style="color: #64748b; font-style: italic;"><?php _e('Chưa có bài viết dịch vụ nào. Bấm vào "Thêm dịch vụ mới" để tạo bài viết đầu tiên.', 'hieugara-motors'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- TAB 5: QUẢN LÝ ĐỐI TÁC & THƯƠNG HIỆU (BRAND LOGOS INFINITE MARQUEE) -->
            <div class="hieugara-card" id="hieugara-brands-card">
                <div class="card-header" style="display: flex; align-items: center; justify-content: space-between; background: #0c1e3a; color: #ffffff; border-bottom: 2px solid #1d4ed8;">
                    <h2 style="color: #ffffff; display: flex; align-items: center; gap: 8px; margin: 0; font-size: 1rem;">
                        <span class="dashicons dashicons-star-filled" style="color: #1d4ed8;"></span>
                        5. Quản Lý Đối Tác &amp; Thương Hiệu (Brand Logos Infinite Marquee)
                    </h2>
                    <span style="font-size: 0.75rem; background: #1d4ed8; color: #ffffff; padding: 3px 12px; border-radius: 9999px; font-weight: 800; letter-spacing: 0.5px;">
                        MARQUEE TICKER VÔ TẬN
                    </span>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #1d4ed8; padding: 14px 18px; border-radius: 4px; margin-bottom: 20px;">
                        <p style="margin: 0; font-size: 0.88rem; color: #334155; line-height: 1.5;">
                            Thanh logo các thương hiệu xe và đối tác phụ tùng chạy tự động vô tận ngoài trang chủ (thay thế khối tra cứu bảo hành). Bạn có thể <strong>Thêm thương hiệu mới, sửa tên/logo/màu gradient, bật/tắt hoặc xóa</strong> bất kỳ thương hiệu nào. Rê chuột vào từng ô xem trước bên dưới để thấy hiệu ứng gradient và logo phát sáng!
                        </p>
                    </div>

                    <!-- Brand Cards CRUD Table -->
                    <table class="widefat striped" id="brand-logos-table" style="border: 1px solid #cbd5e1; border-radius: 4px; overflow: hidden; margin-bottom: 18px;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="width: 50px; text-align: center; font-weight: 700;">STT</th>
                                <th style="width: 140px; text-align: center; font-weight: 700;">Xem trước</th>
                                <th style="width: 180px; font-weight: 700;">Tên Thương Hiệu</th>
                                <th style="font-weight: 700;">Logo (URL hoặc Thư Viện Media)</th>
                                <th style="width: 150px; font-weight: 700;">Màu Gradient Hover</th>
                                <th style="width: 180px; font-weight: 700;">Website Liên Kết</th>
                                <th style="width: 70px; text-align: center; font-weight: 700;">Bật</th>
                                <th style="width: 60px; text-align: center; font-weight: 700;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="brand-logos-tbody">
                            <?php
                            $b_num = 0;
                            foreach ($brands as $b_key => $b_item) :
                                $b_num++;
                                $b_en    = !empty($b_item['enable']) ? '1' : '0';
                                $b_nm    = !empty($b_item['name']) ? $b_item['name'] : '';
                                $b_lg    = !empty($b_item['logo']) ? $b_item['logo'] : '';
                                $b_g1    = !empty($b_item['grad1']) ? $b_item['grad1'] : '#0c1e3a';
                                $b_g2    = !empty($b_item['grad2']) ? $b_item['grad2'] : '#334155';
                                $b_link  = !empty($b_item['url']) ? $b_item['url'] : '#';
                            ?>
                            <tr class="brand-row" data-index="<?php echo esc_attr($b_key); ?>">
                                <td style="text-align: center; vertical-align: middle; font-weight: 800; color: #64748b;">
                                    <span class="brand-row-num"><?php echo $b_num; ?></span>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="brand-capsule-preview" style="display: inline-flex; align-items: center; justify-content: center; width: 110px; height: 55px; border-radius: 9999px; background: #ffffff; border: 1.5px solid #e2e8f0; overflow: hidden; position: relative; box-shadow: 0 1px 4px rgba(0,0,0,0.06); cursor: pointer; transition: all 0.3s ease;">
                                        <div class="capsule-bg-preview" style="position: absolute; inset: 0; background: linear-gradient(135deg, <?php echo esc_attr($b_g1); ?>, <?php echo esc_attr($b_g2); ?>); opacity: 0; transition: opacity 0.35s ease;"></div>
                                        <img src="<?php echo esc_url($b_lg); ?>" alt="<?php echo esc_attr($b_nm); ?>" class="brand-img-preview" style="max-height: 26px; max-width: 65px; object-fit: contain; position: relative; z-index: 2; transition: filter 0.3s ease;">
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <input type="text" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][name]" value="<?php echo esc_attr($b_nm); ?>" class="regular-text brand-name-input" style="width: 100%; font-weight: 700;" placeholder="Tên hãng xe...">
                                </td>
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <input type="text" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][logo]" value="<?php echo esc_attr($b_lg); ?>" class="regular-text brand-logo-field" style="width: 100%; font-size: 0.82rem;" placeholder="https://... hoặc chọn ảnh">
                                        <button type="button" class="button button-secondary brand-upload-media-btn" title="Chọn ảnh từ Thư viện">
                                            <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span>
                                        </button>
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <input type="color" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][grad1]" value="<?php echo esc_attr($b_g1); ?>" class="brand-color-1" title="Màu gradient 1" style="width: 34px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                                        <input type="color" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][grad2]" value="<?php echo esc_attr($b_g2); ?>" class="brand-color-2" title="Màu gradient 2" style="width: 34px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <input type="url" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][url]" value="<?php echo esc_attr($b_link); ?>" class="regular-text" style="width: 100%; font-size: 0.82rem;" placeholder="https://...">
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="hieugara_brand_logos[<?php echo esc_attr($b_key); ?>][enable]" value="1" <?php checked('1', $b_en); ?>>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="button button-link-delete brand-remove-row-btn" style="color: #dc2626; cursor: pointer;" title="Xóa thương hiệu này">
                                        <span class="dashicons dashicons-trash" style="font-size: 18px;"></span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Add New Brand & Template Actions -->
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 14px;">
                        <button type="button" class="button button-primary button-hero" id="btn-add-brand-item" style="display: inline-flex; align-items: center; gap: 6px; background: #0c1e3a; border-color: #0c1e3a; font-size: 0.88rem;">
                            <span class="dashicons dashicons-plus-alt"></span>
                            <span><?php _e('THÊM THƯƠNG HIỆU MỚI', 'hieugara-motors'); ?></span>
                        </button>

                        <span style="font-size: 0.82rem; color: #64748b; font-style: italic;">
                            <?php _e('* Sau khi thêm, sửa hoặc xóa, bấm "LƯU TẤT CẢ CÀI ĐẶT" bên dưới để áp dụng ra trang chủ.', 'hieugara-motors'); ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- TAB 6: QUẢN LÝ GALLERY - HÌNH ẢNH ÔTÔ HẢI HÀ (THÊM, SỬA, XÓA) -->
            <div class="hieugara-card" id="hieugara-gallery-card">
                <div class="card-header" style="display: flex; align-items: center; justify-content: space-between; background: #0c1e3a; color: #ffffff; border-bottom: 2px solid #1d4ed8;">
                    <h2 style="color: #ffffff; display: flex; align-items: center; gap: 8px; margin: 0; font-size: 1rem;">
                        <span class="dashicons dashicons-format-gallery" style="color: #1d4ed8;"></span>
                        6. Quản Lý Mục "GALLERY – HÌNH ẢNH ÔTÔ HẢI HÀ" (Thêm, Sửa, Xóa Ảnh Trang Chủ)
                    </h2>
                    <span style="font-size: 0.75rem; background: #1d4ed8; color: #ffffff; padding: 3px 12px; border-radius: 9999px; font-weight: 800; letter-spacing: 0.5px;">
                        GALLERY TRANG CHỦ
                    </span>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #1d4ed8; padding: 14px 18px; border-radius: 4px; margin-bottom: 20px;">
                        <p style="margin: 0; font-size: 0.88rem; color: #334155; line-height: 1.5;">
                            Quản lý toàn bộ hình ảnh hiển thị trong mục <strong>GALLERY – HÌNH ẢNH ÔTÔ HẢI HÀ</strong> nằm phía trên mục Phụ kiện ngoài trang chủ. Bạn có thể <strong>Thêm ảnh mới (tải lên từ máy tính/Thư viện Media), sửa chú thích ảnh, bật/tắt hiển thị hoặc xóa</strong> bất kỳ ảnh nào.
                        </p>
                    </div>

                    <table class="widefat striped" id="gallery-items-table" style="border: 1px solid #cbd5e1; border-radius: 4px; overflow: hidden; margin-bottom: 18px;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="width: 50px; text-align: center; font-weight: 700;">STT</th>
                                <th style="width: 140px; text-align: center; font-weight: 700;">Ảnh Xem Trước</th>
                                <th style="font-weight: 700;">Mô Tả / Chú Thích Ảnh (Hiển thị khi rê chuột &amp; phóng to)</th>
                                <th style="font-weight: 700;">Đường Dẫn Ảnh (URL hoặc Chọn từ Thư Viện Media)</th>
                                <th style="width: 70px; text-align: center; font-weight: 700;">Hiển thị</th>
                                <th style="width: 60px; text-align: center; font-weight: 700;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="gallery-items-tbody">
                            <?php
                            $g_num = 0;
                            foreach ($gallery_items as $g_key => $g_item) :
                                $g_num++;
                                $g_en    = !empty($g_item['enable']) ? '1' : '0';
                                $g_img   = !empty($g_item['img']) ? $g_item['img'] : '';
                                $g_title = !empty($g_item['title']) ? $g_item['title'] : '';
                            ?>
                            <tr class="gallery-row" data-index="<?php echo esc_attr($g_key); ?>">
                                <td style="text-align: center; vertical-align: middle; font-weight: 800; color: #64748b;">
                                    <span class="gallery-row-num"><?php echo $g_num; ?></span>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <img src="<?php echo esc_url($g_img); ?>" alt="" class="gallery-img-preview" style="width: 110px; height: 68px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; display: inline-block; background: #0c1e3a;">
                                </td>
                                <td style="vertical-align: middle;">
                                    <input type="text" name="hieugara_gallery_items[<?php echo esc_attr($g_key); ?>][title]" value="<?php echo esc_attr($g_title); ?>" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="Nhập mô tả hình ảnh...">
                                </td>
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <input type="text" name="hieugara_gallery_items[<?php echo esc_attr($g_key); ?>][img]" value="<?php echo esc_attr($g_img); ?>" class="regular-text gallery-img-field" style="width: 100%; font-size: 0.82rem;" placeholder="https://... hoặc bấm nút chọn ảnh">
                                        <button type="button" class="button button-secondary gallery-upload-media-btn" title="Chọn hoặc tải ảnh lên từ Thư viện">
                                            <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span> Chọn ảnh
                                        </button>
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <input type="checkbox" name="hieugara_gallery_items[<?php echo esc_attr($g_key); ?>][enable]" value="1" <?php checked('1', $g_en); ?>>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="button button-link-delete gallery-remove-row-btn" style="color: #dc2626; cursor: pointer;" title="Xóa hình ảnh này">
                                        <span class="dashicons dashicons-trash" style="font-size: 18px;"></span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-top: 14px;">
                        <button type="button" class="button button-primary button-hero" id="btn-add-gallery-item" style="display: inline-flex; align-items: center; gap: 6px; background: #1d4ed8; border-color: #1d4ed8; font-size: 0.88rem;">
                            <span class="dashicons dashicons-plus-alt"></span>
                            <span><?php _e('THÊM HÌNH ẢNH MỚI VÀO GALLERY', 'hieugara-motors'); ?></span>
                        </button>

                        <span style="font-size: 0.82rem; color: #64748b; font-style: italic;">
                            <?php _e('* Sau khi thêm, sửa hoặc xóa ảnh, bấm "LƯU TẤT CẢ CÀI ĐẶT" bên dưới để cập nhật ra trang chủ.', 'hieugara-motors'); ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="hieugara-submit-bar">
                <?php submit_button(__('LƯU TẤT CẢ CÀI ĐẶT', 'hieugara-motors'), 'primary large', 'submit', false); ?>
            </div>
        </form>
    </div>

    <!-- Media Uploader & Brand CRUD Script -->
    <script>
    jQuery(document).ready(function($) {
        // 1. Slider Image Upload
        $('.hieugara-upload-btn').on('click', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var targetInput = $btn.data('target-input');
            var targetPreview = $btn.data('target-preview');

            var customUploader = wp.media({
                title: 'Chọn ảnh Banner Slider',
                button: { text: 'Sử dụng ảnh này' },
                multiple: false
            }).on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                $(targetInput).val(attachment.url);
                $(targetPreview).attr('src', attachment.url);
            }).open();
        });

        // 2. Brand Capsule Hover Effect in Admin
        $(document).on('mouseenter', '.brand-capsule-preview', function() {
            var $card = $(this);
            var $row = $card.closest('tr');
            var g1 = $row.find('.brand-color-1').val();
            var g2 = $row.find('.brand-color-2').val();
            $card.find('.capsule-bg-preview').css({
                'background': 'linear-gradient(135deg, ' + g1 + ', ' + g2 + ')',
                'opacity': '1'
            });
            $card.find('.brand-img-preview').css('filter', 'brightness(0) invert(1)');
        }).on('mouseleave', '.brand-capsule-preview', function() {
            $(this).find('.capsule-bg-preview').css('opacity', '0');
            $(this).find('.brand-img-preview').css('filter', 'none');
        });

        // 3. Brand Logo Media Uploader
        $(document).on('click', '.brand-upload-media-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var $input = $row.find('.brand-logo-field');
            var $previewImg = $row.find('.brand-img-preview');

            var brandUploader = wp.media({
                title: 'Chọn Logo Thương Hiệu',
                button: { text: 'Chọn làm Logo' },
                multiple: false
            }).on('select', function() {
                var attachment = brandUploader.state().get('selection').first().toJSON();
                $input.val(attachment.url);
                $previewImg.attr('src', attachment.url);
            }).open();
        });

        // 4. Live Update Logo Preview on Input Change
        $(document).on('input change', '.brand-logo-field', function() {
            var val = $(this).val();
            $(this).closest('tr').find('.brand-img-preview').attr('src', val);
        });

        // 5. Delete Brand Row
        $(document).on('click', '.brand-remove-row-btn', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa thương hiệu này khỏi thanh chạy trang chủ không?')) {
                $(this).closest('tr').fadeOut(250, function() {
                    $(this).remove();
                    // Re-number rows
                    $('#brand-logos-tbody tr').each(function(idx) {
                        $(this).find('.brand-row-num').text(idx + 1);
                    });
                });
            }
        });

        // 6. Add New Brand Row
        $('#btn-add-brand-item').on('click', function(e) {
            e.preventDefault();
            var newId = 'brand_' + Date.now();
            var nextNum = $('#brand-logos-tbody tr').length + 1;

            var newRow = `
            <tr class="brand-row" data-index="${newId}">
                <td style="text-align: center; vertical-align: middle; font-weight: 800; color: #64748b;">
                    <span class="brand-row-num">${nextNum}</span>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <div class="brand-capsule-preview" style="display: inline-flex; align-items: center; justify-content: center; width: 110px; height: 55px; border-radius: 9999px; background: #ffffff; border: 1.5px solid #e2e8f0; overflow: hidden; position: relative; box-shadow: 0 1px 4px rgba(0,0,0,0.06); cursor: pointer; transition: all 0.3s ease;">
                        <div class="capsule-bg-preview" style="position: absolute; inset: 0; background: linear-gradient(135deg, #0c1e3a, #334155); opacity: 0; transition: opacity 0.35s ease;"></div>
                        <img src="" alt="" class="brand-img-preview" style="max-height: 26px; max-width: 65px; object-fit: contain; position: relative; z-index: 2; transition: filter 0.3s ease;">
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <input type="text" name="hieugara_brand_logos[${newId}][name]" value="Thương hiệu mới" class="regular-text brand-name-input" style="width: 100%; font-weight: 700;" placeholder="Tên hãng xe...">
                </td>
                <td style="vertical-align: middle;">
                    <div style="display: flex; gap: 6px; align-items: center;">
                        <input type="text" name="hieugara_brand_logos[${newId}][logo]" value="" class="regular-text brand-logo-field" style="width: 100%; font-size: 0.82rem;" placeholder="https://... hoặc chọn ảnh">
                        <button type="button" class="button button-secondary brand-upload-media-btn" title="Chọn ảnh từ Thư viện">
                            <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span>
                        </button>
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <div style="display: flex; gap: 6px; align-items: center;">
                        <input type="color" name="hieugara_brand_logos[${newId}][grad1]" value="#0c1e3a" class="brand-color-1" title="Màu gradient 1" style="width: 34px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                        <input type="color" name="hieugara_brand_logos[${newId}][grad2]" value="#334155" class="brand-color-2" title="Màu gradient 2" style="width: 34px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <input type="url" name="hieugara_brand_logos[${newId}][url]" value="#" class="regular-text" style="width: 100%; font-size: 0.82rem;" placeholder="https://...">
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="checkbox" name="hieugara_brand_logos[${newId}][enable]" value="1" checked>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button type="button" class="button button-link-delete brand-remove-row-btn" style="color: #dc2626; cursor: pointer;" title="Xóa thương hiệu này">
                        <span class="dashicons dashicons-trash" style="font-size: 18px;"></span>
                    </button>
                </td>
            </tr>
            `;

            $('#brand-logos-tbody').append(newRow);
            $('html, body').animate({
                scrollTop: $('#brand-logos-tbody tr:last-child').offset().top - 120
            }, 300);
        });

        // 7. Gallery Image Media Uploader
        $(document).on('click', '.gallery-upload-media-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var $input = $row.find('.gallery-img-field');
            var $previewImg = $row.find('.gallery-img-preview');

            var galleryUploader = wp.media({
                title: 'Chọn Hình Ảnh Gallery Ôtô Hải Hà',
                button: { text: 'Sử dụng hình ảnh này' },
                multiple: false
            }).on('select', function() {
                var attachment = galleryUploader.state().get('selection').first().toJSON();
                $input.val(attachment.url);
                $previewImg.attr('src', attachment.url);
            }).open();
        });

        // 8. Live Update Gallery Preview on Input Change
        $(document).on('input change', '.gallery-img-field', function() {
            var val = $(this).val();
            $(this).closest('tr').find('.gallery-img-preview').attr('src', val);
        });

        // 9. Delete Gallery Row
        $(document).on('click', '.gallery-remove-row-btn', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này khỏi Gallery trang chủ không?')) {
                $(this).closest('tr').fadeOut(250, function() {
                    $(this).remove();
                    $('#gallery-items-tbody tr').each(function(idx) {
                        $(this).find('.gallery-row-num').text(idx + 1);
                    });
                });
            }
        });

        // 10. Add New Gallery Row
        $('#btn-add-gallery-item').on('click', function(e) {
            e.preventDefault();
            var newId = 'gal_' + Date.now();
            var nextNum = $('#gallery-items-tbody tr').length + 1;

            var newGalRow = `
            <tr class="gallery-row" data-index="${newId}">
                <td style="text-align: center; vertical-align: middle; font-weight: 800; color: #64748b;">
                    <span class="gallery-row-num">${nextNum}</span>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <img src="" alt="" class="gallery-img-preview" style="width: 110px; height: 68px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; display: inline-block; background: #0c1e3a;">
                </td>
                <td style="vertical-align: middle;">
                    <input type="text" name="hieugara_gallery_items[${newId}][title]" value="Hình ảnh xưởng dịch vụ Ôtô Hải Hà" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="Nhập mô tả hình ảnh...">
                </td>
                <td style="vertical-align: middle;">
                    <div style="display: flex; gap: 6px; align-items: center;">
                        <input type="text" name="hieugara_gallery_items[${newId}][img]" value="" class="regular-text gallery-img-field" style="width: 100%; font-size: 0.82rem;" placeholder="https://... hoặc bấm nút chọn ảnh">
                        <button type="button" class="button button-secondary gallery-upload-media-btn" title="Chọn hoặc tải ảnh lên từ Thư viện">
                            <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span> Chọn ảnh
                        </button>
                    </div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <input type="checkbox" name="hieugara_gallery_items[${newId}][enable]" value="1" checked>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button type="button" class="button button-link-delete gallery-remove-row-btn" style="color: #dc2626; cursor: pointer;" title="Xóa hình ảnh này">
                        <span class="dashicons dashicons-trash" style="font-size: 18px;"></span>
                    </button>
                </td>
            </tr>
            `;

            $('#gallery-items-tbody').append(newGalRow);
            $('html, body').animate({
                scrollTop: $('#gallery-items-tbody tr:last-child').offset().top - 120
            }, 300);
        });
    });
    </script>
    <?php
}

