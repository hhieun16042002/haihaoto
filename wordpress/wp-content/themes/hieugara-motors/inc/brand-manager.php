<?php
/**
 * Ôtô Hải Hà - Quản Lý Thương Hiệu & Đối Tác Chiến Lược
 * Quản lý 2 mục riêng biệt:
 * 1. Logo Hãng Xe Đối Tác (Chạy dải marquee trang chủ)
 * 2. Thương Hiệu Hợp Tác Toàn Diện (Khối VIP VinFast & Dịch vụ xe điện / xe xăng)
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

// =========================================================================
// 1. DATA HELPERS - MARQUEE BRANDS
// =========================================================================

if (!function_exists('hieugara_get_default_brand_logos')) {
    function hieugara_get_default_brand_logos() {
        $theme_uri = get_template_directory_uri();
        $brand_dir = $theme_uri . '/assets/images/brands';
        $v = defined('HIEUGARA_THEME_VERSION') ? HIEUGARA_THEME_VERSION : '2.0.0';

        return array(
            1 => array(
                'id'     => 1,
                'enable' => '1',
                'name'   => 'Mercedes-Benz',
                'logo'   => $brand_dir . '/mercedes.svg?v=' . $v,
                'grad1'  => '#00285a',
                'grad2'  => '#001a3d',
                'url'    => 'https://www.mercedes-benz.com.vn/',
            ),
            2 => array(
                'id'     => 2,
                'enable' => '1',
                'name'   => 'BMW',
                'logo'   => $brand_dir . '/bmw.svg?v=' . $v,
                'grad1'  => '#0066b1',
                'grad2'  => '#0284c7',
                'url'    => 'https://www.bmw.vn/',
            ),
            3 => array(
                'id'     => 3,
                'enable' => '1',
                'name'   => 'Audi',
                'logo'   => $brand_dir . '/audi.svg?v=' . $v,
                'grad1'  => '#e2001a',
                'grad2'  => '#141414',
                'url'    => 'https://www.audi.vn/',
            ),
            4 => array(
                'id'     => 4,
                'enable' => '1',
                'name'   => 'Porsche',
                'logo'   => $brand_dir . '/porsche.svg?v=' . $v,
                'grad1'  => '#d92d20',
                'grad2'  => '#f5a300',
                'url'    => 'https://www.porsche.com/vietnam/',
            ),
            5 => array(
                'id'     => 5,
                'enable' => '1',
                'name'   => 'Lexus',
                'logo'   => $brand_dir . '/lexus.svg?v=' . $v,
                'grad1'  => '#0052cc',
                'grad2'  => '#001f5c',
                'url'    => 'https://www.lexus.com.vn/',
            ),
            6 => array(
                'id'     => 6,
                'enable' => '1',
                'name'   => 'Toyota',
                'logo'   => $brand_dir . '/toyota.svg?v=' . $v,
                'grad1'  => '#eb0a1e',
                'grad2'  => '#991b1b',
                'url'    => 'https://www.toyota.com.vn/',
            ),
            7 => array(
                'id'     => 7,
                'enable' => '1',
                'name'   => 'VinFast',
                'logo'   => $brand_dir . '/vinfast.svg?v=' . $v,
                'grad1'  => '#0f172a',
                'grad2'  => '#c5161d',
                'url'    => 'https://vinfastauto.com/',
            ),
            8 => array(
                'id'     => 8,
                'enable' => '1',
                'name'   => 'Hyundai',
                'logo'   => $brand_dir . '/hyundai.svg?v=' . $v,
                'grad1'  => '#004b93',
                'grad2'  => '#0369a1',
                'url'    => 'https://hyundai.thanhcong.vn/',
            ),
            9 => array(
                'id'     => 9,
                'enable' => '1',
                'name'   => 'Ford',
                'logo'   => $brand_dir . '/ford.svg?v=' . $v,
                'grad1'  => '#003478',
                'grad2'  => '#1d4ed8',
                'url'    => 'https://www.ford.com.vn/',
            ),
            10 => array(
                'id'     => 10,
                'enable' => '1',
                'name'   => 'Honda',
                'logo'   => $brand_dir . '/honda.svg?v=' . $v,
                'grad1'  => '#e40521',
                'grad2'  => '#b91c1c',
                'url'    => 'https://www.honda.com.vn/',
            ),
            11 => array(
                'id'     => 11,
                'enable' => '1',
                'name'   => 'Volkswagen',
                'logo'   => $brand_dir . '/volkswagen.svg?v=' . $v,
                'grad1'  => '#00437a',
                'grad2'  => '#0284c7',
                'url'    => 'https://vw.com.vn/',
            ),
            12 => array(
                'id'     => 12,
                'enable' => '1',
                'name'   => 'Nissan',
                'logo'   => $brand_dir . '/nissan.svg?v=' . $v,
                'grad1'  => '#c3002f',
                'grad2'  => '#881337',
                'url'    => 'https://www.nissanvietnam.vn/',
            ),
            13 => array(
                'id'     => 13,
                'enable' => '1',
                'name'   => 'Bosch',
                'logo'   => $brand_dir . '/bosch.svg?v=' . $v,
                'grad1'  => '#ea0016',
                'grad2'  => '#005691',
                'url'    => 'https://www.bosch.com.vn/',
            ),
        );
    }
}

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
                    'id'     => isset($item['id']) ? (int) $item['id'] : (int) $k,
                    'enable' => !empty($item['enable']) ? '1' : '0',
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

// =========================================================================
// 2. DATA HELPERS - COMPREHENSIVE STRATEGIC PARTNER (VINFAST)
// =========================================================================

if (!function_exists('hieugara_get_default_comprehensive_partner')) {
    function hieugara_get_default_comprehensive_partner() {
        $theme_uri = get_template_directory_uri();
        $brand_dir = $theme_uri . '/assets/images/brands';
        $v = defined('HIEUGARA_THEME_VERSION') ? HIEUGARA_THEME_VERSION : '2.0.0';

        return array(
            'enable'             => '1',
            'brand_name'         => 'VinFast Việt Nam',
            'partner_badge'      => 'ĐỐI TÁC HỢP TÁC TOÀN DIỆN & TIÊU CHUẨN DỊCH VỤ XE ĐIỆN',
            'headline'           => 'TRUNG TÂM TIẾP NHẬN BẢO DƯỠNG & SỬA CHỮA VINFAST TẠI HẢI DƯƠNG',
            'subheadline'        => 'Ôtô Hải Hà tự hào là đơn vị tiên phong hợp tác kỹ thuật toàn diện cùng VinFast. Đáp ứng trọn gói từ dịch vụ xe điện (EV) thế hệ mới đến các dòng xe xăng cao cấp, trang bị trạm sạc tiêu chuẩn và 100% linh phụ kiện chính hãng.',
            'logo_url'           => $brand_dir . '/vinfast.svg?v=' . $v,
            'hero_image'         => '',
            'supported_models'   => 'VF 3, VF 5 Plus, VF 6, VF 7, VF 8, VF 9, VF e34, Fadil, Lux A2.0, Lux SA2.0, President',
            'stat_1_val'         => '100%',
            'stat_1_lbl'         => 'Phụ Tùng Tiêu Chuẩn Hãng',
            'stat_2_val'         => '24/7',
            'stat_2_lbl'         => 'Cứu Hộ Pin & Xe Lưu Động',
            'stat_3_val'         => '4.5 Tấn',
            'stat_3_lbl'         => 'Cầu Nâng EV Chuyên Dụng',
            'stat_4_val'         => '12 Tháng',
            'stat_4_lbl'         => 'Bảo Hành Điện Tử Minh Bạch',
            'perk_1_title'       => 'Kỹ Thuật Viên Đạt Chứng Chỉ Xe Điện (EV)',
            'perk_1_desc'        => 'Đội ngũ chuyên gia được đào tạo bài bản, am hiểu sâu về hệ thống truyền động điện, pin cao thế và mạch biến tần an toàn.',
            'perk_2_title'       => 'Chẩn Đoán Phần Mềm & Trạm Sạc Tiêu Chuẩn',
            'perk_2_desc'        => 'Máy quét chẩn đoán chuyên dụng cập nhật firmware mới nhất, hạ tầng trạm sạc nhanh tại xưởng luôn sẵn sàng phục vụ.',
            'perk_3_title'       => '100% Linh Kiện & Phụ Tùng Chuẩn VinFast',
            'perk_3_desc'        => 'Linh kiện thay thế, phụ kiện chính hãng, dầu phanh xe điện, dung dịch làm mát pin cao áp có nguồn gốc truy xuất rõ ràng.',
            'perk_4_title'       => 'Cứu Hộ Kéo Xe Sàn Trượt 24/7 Toàn Miền Bắc',
            'perk_4_desc'        => 'Đội cứu hộ cơ động 24/7 kích pin, hỗ trợ xử lý sự cố trên cao tốc Hà Nội - Hải Phòng, Quốc Lộ 5 và toàn tỉnh Hải Dương.',
            'cta_booking_text'   => 'Gọi Tư Vấn VinFast',
            'cta_booking_url'    => 'tel:02203892207',
            'cta_hotline_text'   => 'Hotline Kỹ Thuật: 0911 211 996',
            'cta_hotline_tel'    => '0911211996',
            'cta_accessory_text' => 'Xem Phụ Kiện Xe VinFast',
            'cta_accessory_url'  => home_url('/phu-kien/'),
        );
    }
}

if (!function_exists('hieugara_get_comprehensive_partner')) {
    function hieugara_get_comprehensive_partner() {
        $saved = get_option('hieugara_comprehensive_partner');
        $defaults = hieugara_get_default_comprehensive_partner();

        if ($saved === false || empty($saved) || !is_array($saved)) {
            return $defaults;
        }

        return wp_parse_args($saved, $defaults);
    }
}

// =========================================================================
// 3. REGISTER ADMIN MENUS (2 SUBMENUS LIKE DỊCH VỤ & PHỤ KIỆN)
// =========================================================================

function hieugara_register_brand_admin_menu() {
    // Top-level Menu
    add_menu_page(
        __('Quản Lý Thương Hiệu & Đối Tác', 'hieugara-motors'),
        __('Quản Lý Thương Hiệu', 'hieugara-motors'),
        'manage_options',
        'hieugara-brand-manager',
        'hieugara_render_brand_logos_page',
        'dashicons-awards',
        25
    );

    // Submenu 1: Logo Hãng Xe Đối Tác (Chạy Ticker Trang Chủ)
    add_submenu_page(
        'hieugara-brand-manager',
        __('Logo Hãng Xe Đối Tác (Chạy Trang Chủ)', 'hieugara-motors'),
        __('Logo Hãng Xe Đối Tác', 'hieugara-motors'),
        'manage_options',
        'hieugara-brand-manager',
        'hieugara_render_brand_logos_page'
    );

    // Submenu 2: Đối Tác Toàn Diện (VinFast)
    add_submenu_page(
        'hieugara-brand-manager',
        __('Thương Hiệu Hợp Tác Toàn Diện (VinFast)', 'hieugara-motors'),
        __('Đối Tác Toàn Diện', 'hieugara-motors'),
        'manage_options',
        'hieugara-brand-comprehensive',
        'hieugara_render_comprehensive_partner_page'
    );
}
add_action('admin_menu', 'hieugara_register_brand_admin_menu');

// Enqueue WP Media & Assets for Brand Manager
function hieugara_brand_manager_admin_assets($hook) {
    if (strpos($hook, 'hieugara-brand') !== false) {
        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }
}
add_action('admin_enqueue_scripts', 'hieugara_brand_manager_admin_assets');

// =========================================================================
// 4. SUBMENU 1: RENDER MARQUEE BRAND LOGOS MANAGEMENT PAGE
// =========================================================================

function hieugara_render_brand_logos_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Bạn không có quyền truy cập trang này.', 'hieugara-motors'));
    }

    $notice = '';

    // Handle Form Save
    if (isset($_POST['hieugara_save_brand_logos']) && check_admin_referer('hieugara_save_brand_logos_nonce')) {
        if (isset($_POST['hieugara_reset_default_brands'])) {
            delete_option('hieugara_brand_logos');
            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Đã khôi phục thành công danh sách 13 thương hiệu tiêu chuẩn (Bao gồm VinFast)!</strong></p></div>';
        } else {
            $submitted_brands = isset($_POST['brand_items']) && is_array($_POST['brand_items']) ? $_POST['brand_items'] : array();
            $sanitized = array();
            $index = 1;

            foreach ($submitted_brands as $item) {
                if (!empty($item['name'])) {
                    $sanitized[$index] = array(
                        'id'     => $index,
                        'enable' => !empty($item['enable']) ? '1' : '0',
                        'name'   => sanitize_text_field($item['name']),
                        'logo'   => esc_url_raw($item['logo']),
                        'grad1'  => !empty($item['grad1']) ? sanitize_hex_color($item['grad1']) : '#0c1e3a',
                        'grad2'  => !empty($item['grad2']) ? sanitize_hex_color($item['grad2']) : '#334155',
                        'url'    => !empty($item['url']) ? esc_url_raw($item['url']) : '#',
                    );
                    $index++;
                }
            }

            update_option('hieugara_brand_logos', $sanitized);
            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Đã lưu cấu hình danh sách logo hãng xe thành công!</strong> Dải logo chạy trên trang chủ đã được cập nhật ngay lập tức.</p></div>';
        }
    }

    $brands = hieugara_get_brand_logos();
    ?>
    <div class="wrap hieugara-brand-admin-wrap" style="max-width: 1200px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-awards" style="font-size: 30px; width: 30px; height: 30px; color: #2563eb;"></span>
                    Logo Hãng Xe Đối Tác (Chạy Trang Chủ)
                </h1>
                <p style="margin: 4px 0 0; color: #64748b; font-size: 0.92rem;">
                    Quản lý danh sách logo các hãng xe hiển thị ở dải băng chuyền vô tận (infinite marquee) trên trang chủ.
                </p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-brand-comprehensive')); ?>" class="button button-secondary" style="font-weight: 600;">
                    <span class="dashicons dashicons-shield" style="margin-top: 4px;"></span> Chuyển Sang: Đối Tác Toàn Diện
                </a>
                <a href="<?php echo esc_url(home_url('/#dong-xe-phuc-vu')); ?>" target="_blank" class="button button-secondary" style="font-weight: 600;">
                    <span class="dashicons dashicons-external" style="margin-top: 4px;"></span> Xem Trên Web
                </a>
            </div>
        </div>

        <?php echo $notice; ?>

        <form method="post" action="" id="brand-logos-form">
            <?php wp_nonce_field('hieugara_save_brand_logos_nonce'); ?>

            <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 24px;">
                <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; color: #ffffff;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="dashicons dashicons-car" style="color: #60a5fa; font-size: 22px;"></span>
                        <strong style="font-size: 1.05rem;">Danh Sách Logo Thương Hiệu Đang Hoạt Động (<?php echo count($brands); ?> Hãng)</strong>
                    </div>
                    <button type="button" id="btn-add-brand-row" class="button button-primary" style="background: #2563eb; border-color: #1d4ed8; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                        <span class="dashicons dashicons-plus-alt2" style="margin-top: 4px;"></span> Thêm Hãng Xe Mới
                    </button>
                </div>

                <div style="overflow-x: auto; padding: 12px;">
                    <table class="wp-list-table widefat fixed striped" style="border: none; border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center; font-weight: 700; color: #475569;">STT</th>
                                <th style="width: 100px; text-align: center; font-weight: 700; color: #475569;">Xem Trước</th>
                                <th style="width: 220px; font-weight: 700; color: #475569;">Tên Thương Hiệu</th>
                                <th style="font-weight: 700; color: #475569;">Đường Dẫn Logo (SVG/PNG)</th>
                                <th style="width: 140px; font-weight: 700; color: #475569;">Màu Gradient</th>
                                <th style="width: 200px; font-weight: 700; color: #475569;">Liên Kết (URL)</th>
                                <th style="width: 80px; text-align: center; font-weight: 700; color: #475569;">Bật</th>
                                <th style="width: 70px; text-align: center; font-weight: 700; color: #475569;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="brand-rows-container">
                            <?php 
                            $row_idx = 0;
                            foreach ($brands as $k => $b) : 
                                $row_idx++;
                                $b_name = esc_attr($b['name']);
                                $b_logo = esc_url($b['logo']);
                                $b_grad1 = esc_attr($b['grad1']);
                                $b_grad2 = esc_attr($b['grad2']);
                                $b_url  = esc_attr($b['url']);
                                $b_en   = !empty($b['enable']) ? 1 : 0;
                            ?>
                            <tr class="brand-row-item" data-index="<?php echo $row_idx; ?>" style="vertical-align: middle;">
                                <td style="text-align: center; font-weight: 700; color: #94a3b8;" class="brand-stt">
                                    <?php echo $row_idx; ?>
                                </td>
                                <td style="text-align: center;">
                                    <div class="brand-thumb-preview" style="width: 60px; height: 42px; border-radius: 6px; background: linear-gradient(135deg, <?php echo $b_grad1; ?>, <?php echo $b_grad2; ?>); display: inline-flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                        <?php if (!empty($b_logo)): ?>
                                            <img src="<?php echo $b_logo; ?>" alt="<?php echo $b_name; ?>" style="max-height: 32px; max-width: 52px; object-fit: contain;">
                                        <?php else: ?>
                                            <span class="dashicons dashicons-format-image" style="color: #cbd5e1;"></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="brand_items[<?php echo $row_idx; ?>][name]" value="<?php echo $b_name; ?>" class="regular-text" style="width: 100%; font-weight: 700; color: #0f172a;" placeholder="Tên hãng xe (vd: VinFast, BMW...)">
                                </td>
                                <td>
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <input type="text" name="brand_items[<?php echo $row_idx; ?>][logo]" value="<?php echo $b_logo; ?>" class="regular-text brand-logo-input" style="width: 100%; font-size: 0.85rem;" placeholder="https://... hoặc chọn file SVG/PNG">
                                        <button type="button" class="button button-secondary btn-upload-brand-media" title="Chọn file từ Thư viện Media">
                                            <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <input type="color" name="brand_items[<?php echo $row_idx; ?>][grad1]" value="<?php echo $b_grad1; ?>" class="color-picker-input-1" title="Màu 1" style="width: 32px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                                        <input type="color" name="brand_items[<?php echo $row_idx; ?>][grad2]" value="<?php echo $b_grad2; ?>" class="color-picker-input-2" title="Màu 2" style="width: 32px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">
                                    </div>
                                </td>
                                <td>
                                    <input type="url" name="brand_items[<?php echo $row_idx; ?>][url]" value="<?php echo $b_url; ?>" class="regular-text" style="width: 100%; font-size: 0.85rem;" placeholder="https://...">
                                </td>
                                <td style="text-align: center;">
                                    <label class="switch" style="cursor: pointer;">
                                        <input type="checkbox" name="brand_items[<?php echo $row_idx; ?>][enable]" value="1" <?php checked($b_en, 1); ?>>
                                    </label>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="button button-link-delete btn-remove-brand-row" style="color: #ef4444; cursor: pointer;" title="Xóa thương hiệu này">
                                        <span class="dashicons dashicons-trash" style="font-size: 19px;"></span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div style="padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <button type="submit" name="hieugara_reset_default_brands" value="1" class="button" style="color: #64748b;" onclick="return confirm('Bạn có chắc muốn khôi phục lại 13 thương hiệu mặc định (bao gồm VinFast)? Mọi sửa đổi tùy biến sẽ được reset.');">
                            <span class="dashicons dashicons-backup" style="margin-top: 4px;"></span> Khôi Phục 13 Hãng Tiêu Chuẩn
                        </button>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" name="hieugara_save_brand_logos" value="1" class="button button-primary button-hero" style="background: #2563eb; border-color: #1d4ed8; font-weight: 700; padding: 0 28px;">
                            <span class="dashicons dashicons-saved" style="margin-top: 6px;"></span> LƯU THAY ĐỔI LOGO
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Media Uploader
        $(document).on('click', '.btn-upload-brand-media', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var $input = $row.find('.brand-logo-input');
            var $thumb = $row.find('.brand-thumb-preview');

            var customUploader = wp.media({
                title: 'Chọn hoặc Tải lên Logo Thương Hiệu (SVG/PNG)',
                button: { text: 'Sử dụng Logo này' },
                multiple: false
            }).on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                $input.val(attachment.url).trigger('change');
                $thumb.html('<img src="' + attachment.url + '" style="max-height: 32px; max-width: 52px; object-fit: contain;">');
            }).open();
        });

        // Add New Row
        $('#btn-add-brand-row').on('click', function(e) {
            e.preventDefault();
            var nextIdx = $('#brand-rows-container tr.brand-row-item').length + 1;
            var html = '<tr class="brand-row-item" data-index="' + nextIdx + '" style="vertical-align: middle;">' +
                '<td style="text-align: center; font-weight: 700; color: #94a3b8;" class="brand-stt">' + nextIdx + '</td>' +
                '<td style="text-align: center;">' +
                    '<div class="brand-thumb-preview" style="width: 60px; height: 42px; border-radius: 6px; background: linear-gradient(135deg, #0f172a, #2563eb); display: inline-flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">' +
                        '<span class="dashicons dashicons-format-image" style="color: #cbd5e1;"></span>' +
                    '</div>' +
                '</td>' +
                '<td><input type="text" name="brand_items[' + nextIdx + '][name]" value="Hãng xe mới" class="regular-text" style="width: 100%; font-weight: 700; color: #0f172a;" placeholder="Tên hãng xe..."></td>' +
                '<td>' +
                    '<div style="display: flex; gap: 6px; align-items: center;">' +
                        '<input type="text" name="brand_items[' + nextIdx + '][logo]" value="" class="regular-text brand-logo-input" style="width: 100%; font-size: 0.85rem;" placeholder="https://... hoặc chọn file">' +
                        '<button type="button" class="button button-secondary btn-upload-brand-media"><span class="dashicons dashicons-upload" style="margin-top: 4px;"></span></button>' +
                    '</div>' +
                '</td>' +
                '<td>' +
                    '<div style="display: flex; gap: 6px; align-items: center;">' +
                        '<input type="color" name="brand_items[' + nextIdx + '][grad1]" value="#0f172a" class="color-picker-input-1" style="width: 32px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">' +
                        '<input type="color" name="brand_items[' + nextIdx + '][grad2]" value="#2563eb" class="color-picker-input-2" style="width: 32px; height: 32px; padding: 0; border: none; cursor: pointer; border-radius: 4px;">' +
                    '</div>' +
                '</td>' +
                '<td><input type="url" name="brand_items[' + nextIdx + '][url]" value="#" class="regular-text" style="width: 100%; font-size: 0.85rem;" placeholder="https://..."></td>' +
                '<td style="text-align: center;"><input type="checkbox" name="brand_items[' + nextIdx + '][enable]" value="1" checked></td>' +
                '<td style="text-align: center;"><button type="button" class="button button-link-delete btn-remove-brand-row" style="color: #ef4444; cursor: pointer;"><span class="dashicons dashicons-trash" style="font-size: 19px;"></span></button></td>' +
            '</tr>';
            $('#brand-rows-container').append(html);
        });

        // Remove Row
        $(document).on('click', '.btn-remove-brand-row', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa thương hiệu này khỏi danh sách?')) {
                $(this).closest('tr').fadeOut(200, function() {
                    $(this).remove();
                    $('#brand-rows-container tr.brand-row-item').each(function(i) {
                        $(this).find('.brand-stt').text(i + 1);
                    });
                });
            }
        });
    });
    </script>
    <?php
}

// =========================================================================
// 5. SUBMENU 2: RENDER COMPREHENSIVE STRATEGIC PARTNER (VINFAST) PAGE
// =========================================================================

function hieugara_render_comprehensive_partner_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Bạn không có quyền truy cập trang này.', 'hieugara-motors'));
    }

    $notice = '';

    // Handle Form Save
    if (isset($_POST['hieugara_save_comprehensive_partner']) && check_admin_referer('hieugara_save_comprehensive_partner_nonce')) {
        if (isset($_POST['hieugara_reset_default_partner'])) {
            delete_option('hieugara_comprehensive_partner');
            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Đã khôi phục thành công cấu hình mặc định Đối Tác Toàn Diện VinFast!</strong></p></div>';
        } else {
            $data = array(
                'enable'             => !empty($_POST['enable']) ? '1' : '0',
                'brand_name'         => sanitize_text_field($_POST['brand_name']),
                'partner_badge'      => sanitize_text_field($_POST['partner_badge']),
                'headline'           => sanitize_text_field($_POST['headline']),
                'subheadline'        => sanitize_textarea_field($_POST['subheadline']),
                'logo_url'           => esc_url_raw($_POST['logo_url']),
                'hero_image'         => esc_url_raw($_POST['hero_image']),
                'supported_models'   => sanitize_text_field($_POST['supported_models']),
                'stat_1_val'         => sanitize_text_field($_POST['stat_1_val']),
                'stat_1_lbl'         => sanitize_text_field($_POST['stat_1_lbl']),
                'stat_2_val'         => sanitize_text_field($_POST['stat_2_val']),
                'stat_2_lbl'         => sanitize_text_field($_POST['stat_2_lbl']),
                'stat_3_val'         => sanitize_text_field($_POST['stat_3_val']),
                'stat_3_lbl'         => sanitize_text_field($_POST['stat_3_lbl']),
                'stat_4_val'         => sanitize_text_field($_POST['stat_4_val']),
                'stat_4_lbl'         => sanitize_text_field($_POST['stat_4_lbl']),
                'perk_1_title'       => sanitize_text_field($_POST['perk_1_title']),
                'perk_1_desc'        => sanitize_textarea_field($_POST['perk_1_desc']),
                'perk_2_title'       => sanitize_text_field($_POST['perk_2_title']),
                'perk_2_desc'        => sanitize_textarea_field($_POST['perk_2_desc']),
                'perk_3_title'       => sanitize_text_field($_POST['perk_3_title']),
                'perk_3_desc'        => sanitize_textarea_field($_POST['perk_3_desc']),
                'perk_4_title'       => sanitize_text_field($_POST['perk_4_title']),
                'perk_4_desc'        => sanitize_textarea_field($_POST['perk_4_desc']),
                'cta_booking_text'   => sanitize_text_field($_POST['cta_booking_text']),
                'cta_booking_url'    => esc_url_raw($_POST['cta_booking_url']),
                'cta_hotline_text'   => sanitize_text_field($_POST['cta_hotline_text']),
                'cta_hotline_tel'    => sanitize_text_field($_POST['cta_hotline_tel']),
                'cta_accessory_text' => sanitize_text_field($_POST['cta_accessory_text']),
                'cta_accessory_url'  => esc_url_raw($_POST['cta_accessory_url']),
            );

            update_option('hieugara_comprehensive_partner', $data);
            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Đã cập nhật thành công cấu hình Đối Tác Toàn Diện VinFast!</strong> Nội dung trang chủ đã được làm mới.</p></div>';
        }
    }

    $p = hieugara_get_comprehensive_partner();
    ?>
    <div class="wrap hieugara-brand-admin-wrap" style="max-width: 1200px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-shield" style="font-size: 30px; width: 30px; height: 30px; color: #e11d48;"></span>
                    Thương Hiệu Hợp Tác Toàn Diện (VinFast)
                </h1>
                <p style="margin: 4px 0 0; color: #64748b; font-size: 0.92rem;">
                    Quản lý toàn bộ nội dung khối VIP Thương Hiệu Hợp Tác Toàn Diện nằm ngay dưới dải logo chạy trên trang chủ.
                </p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-brand-manager')); ?>" class="button button-secondary" style="font-weight: 600;">
                    <span class="dashicons dashicons-awards" style="margin-top: 4px;"></span> Chuyển Sang: Logo Hãng Xe
                </a>
                <a href="<?php echo esc_url(home_url('/#doi-tac-toan-dien')); ?>" target="_blank" class="button button-secondary" style="font-weight: 600;">
                    <span class="dashicons dashicons-external" style="margin-top: 4px;"></span> Xem Trên Web
                </a>
            </div>
        </div>

        <?php echo $notice; ?>

        <form method="post" action="" id="comprehensive-partner-form">
            <?php wp_nonce_field('hieugara_save_comprehensive_partner_nonce'); ?>

            <!-- Panel 1: Switch & General Identity -->
            <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
                <div style="background: linear-gradient(135deg, #0f172a, #881337); padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; color: #ffffff;">
                    <strong style="font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-admin-settings" style="color: #fb7185;"></span>
                        1. Kích Hoạt & Nhận Diện Thương Hiệu Đối Tác
                    </strong>
                    <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; cursor: pointer; color: #ffffff;">
                        <input type="checkbox" name="enable" value="1" <?php checked(!empty($p['enable']), 1); ?>>
                        Hiển thị mục này trên trang chủ
                    </label>
                </div>

                <div style="padding: 24px;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
                        <div>
                            <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Tên Đối Tác Chiến Lược:</label>
                            <input type="text" name="brand_name" value="<?php echo esc_attr($p['brand_name']); ?>" class="regular-text" style="width: 100%; font-weight: 700;" placeholder="vd: VinFast Việt Nam">
                        </div>

                        <div>
                            <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Huy Hiệu / Tagline Đối Tác:</label>
                            <input type="text" name="partner_badge" value="<?php echo esc_attr($p['partner_badge']); ?>" class="regular-text" style="width: 100%; color: #b91c1c; font-weight: 700;" placeholder="vd: ĐỐI TÁC HỢP TÁC TOÀN DIỆN...">
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Tiêu Đề Lớn (Headline):</label>
                        <input type="text" name="headline" value="<?php echo esc_attr($p['headline']); ?>" class="regular-text" style="width: 100%; font-size: 1.1rem; font-weight: 800;" placeholder="vd: TRUNG TÂM TIẾP NHẬN BẢO DƯỠNG & SỬA CHỮA VINFAST...">
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Nội Dung Giới Thiệu Đối Tác:</label>
                        <textarea name="subheadline" rows="3" class="large-text" style="width: 100%; line-height: 1.6;"><?php echo esc_textarea($p['subheadline']); ?></textarea>
                    </div>

                    <div style="margin-top: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
                        <div>
                            <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Logo Đối Tác (SVG / PNG):</label>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <input type="text" id="partner_logo_url" name="logo_url" value="<?php echo esc_attr($p['logo_url']); ?>" class="regular-text" style="width: 100%; font-size: 0.85rem;">
                                <button type="button" id="btn_upload_partner_logo" class="button button-secondary" title="Chọn từ Media">
                                    <span class="dashicons dashicons-upload" style="margin-top: 4px;"></span>
                                </button>
                            </div>
                            <div style="margin-top: 8px; padding: 10px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; text-align: center;">
                                <img id="partner_logo_preview" src="<?php echo esc_url($p['logo_url']); ?>" alt="Logo Preview" style="max-height: 48px; max-width: 180px; object-fit: contain;">
                            </div>
                        </div>

                        <div>
                            <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Danh Sách Dòng Xe Tiếp Nhận (Ngăn cách bởi dấu phẩy):</label>
                            <textarea name="supported_models" rows="4" class="large-text" style="width: 100%; font-size: 0.9rem;" placeholder="VF 3, VF 5 Plus, VF 6, VF 7, VF 8, VF 9, VF e34..."><?php echo esc_textarea($p['supported_models']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 2: 4 Stats -->
            <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
                <div style="background: linear-gradient(135deg, #1e293b, #334155); padding: 16px 20px; color: #ffffff;">
                    <strong style="font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-chart-bar" style="color: #38bdf8;"></span>
                        2. Bốn Chỉ Số Ấn Tượng & Cam Kết
                    </strong>
                </div>

                <div style="padding: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 4px;">Chỉ số 1 (Số / Tỷ lệ):</label>
                        <input type="text" name="stat_1_val" value="<?php echo esc_attr($p['stat_1_val']); ?>" style="width: 100%; font-weight: 800; font-size: 1.1rem; color: #2563eb; margin-bottom: 6px;" placeholder="vd: 100%">
                        <input type="text" name="stat_1_lbl" value="<?php echo esc_attr($p['stat_1_lbl']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="vd: Phụ Tùng Tiêu Chuẩn Hãng">
                    </div>

                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 4px;">Chỉ số 2 (Số / Tỷ lệ):</label>
                        <input type="text" name="stat_2_val" value="<?php echo esc_attr($p['stat_2_val']); ?>" style="width: 100%; font-weight: 800; font-size: 1.1rem; color: #e11d48; margin-bottom: 6px;" placeholder="vd: 24/7">
                        <input type="text" name="stat_2_lbl" value="<?php echo esc_attr($p['stat_2_lbl']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="vd: Cứu Hộ Pin & Xe Lưu Động">
                    </div>

                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 4px;">Chỉ số 3 (Số / Tỷ lệ):</label>
                        <input type="text" name="stat_3_val" value="<?php echo esc_attr($p['stat_3_val']); ?>" style="width: 100%; font-weight: 800; font-size: 1.1rem; color: #059669; margin-bottom: 6px;" placeholder="vd: 4.5 Tấn">
                        <input type="text" name="stat_3_lbl" value="<?php echo esc_attr($p['stat_3_lbl']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="vd: Cầu Nâng EV Chuyên Dụng">
                    </div>

                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 4px;">Chỉ số 4 (Số / Tỷ lệ):</label>
                        <input type="text" name="stat_4_val" value="<?php echo esc_attr($p['stat_4_val']); ?>" style="width: 100%; font-weight: 800; font-size: 1.1rem; color: #d97706; margin-bottom: 6px;" placeholder="vd: 12 Tháng">
                        <input type="text" name="stat_4_lbl" value="<?php echo esc_attr($p['stat_4_lbl']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="vd: Bảo Hành Minh Bạch">
                    </div>
                </div>
            </div>

            <!-- Panel 3: 4 Key Perks / Strengths -->
            <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
                <div style="background: linear-gradient(135deg, #1e293b, #334155); padding: 16px 20px; color: #ffffff;">
                    <strong style="font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-yes-alt" style="color: #4ade80;"></span>
                        3. Bốn Trụ Cột Năng Lực & Dịch Vụ Xe Điện VinFast
                    </strong>
                </div>

                <div style="padding: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                    <!-- Perk 1 -->
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Trụ Cột 1 (Kỹ thuật viên & An toàn):</label>
                        <input type="text" name="perk_1_title" value="<?php echo esc_attr($p['perk_1_title']); ?>" style="width: 100%; font-weight: 700; margin-bottom: 8px;" placeholder="Tiêu đề...">
                        <textarea name="perk_1_desc" rows="3" style="width: 100%; font-size: 0.85rem; line-height: 1.5;" placeholder="Mô tả chi tiết..."><?php echo esc_textarea($p['perk_1_desc']); ?></textarea>
                    </div>

                    <!-- Perk 2 -->
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Trụ Cột 2 (Hạ tầng & Chẩn đoán):</label>
                        <input type="text" name="perk_2_title" value="<?php echo esc_attr($p['perk_2_title']); ?>" style="width: 100%; font-weight: 700; margin-bottom: 8px;" placeholder="Tiêu đề...">
                        <textarea name="perk_2_desc" rows="3" style="width: 100%; font-size: 0.85rem; line-height: 1.5;" placeholder="Mô tả chi tiết..."><?php echo esc_textarea($p['perk_2_desc']); ?></textarea>
                    </div>

                    <!-- Perk 3 -->
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Trụ Cột 3 (Phụ tùng chính hãng):</label>
                        <input type="text" name="perk_3_title" value="<?php echo esc_attr($p['perk_3_title']); ?>" style="width: 100%; font-weight: 700; margin-bottom: 8px;" placeholder="Tiêu đề...">
                        <textarea name="perk_3_desc" rows="3" style="width: 100%; font-size: 0.85rem; line-height: 1.5;" placeholder="Mô tả chi tiết..."><?php echo esc_textarea($p['perk_3_desc']); ?></textarea>
                    </div>

                    <!-- Perk 4 -->
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Trụ Cột 4 (Cứu hộ pin 24/7):</label>
                        <input type="text" name="perk_4_title" value="<?php echo esc_attr($p['perk_4_title']); ?>" style="width: 100%; font-weight: 700; margin-bottom: 8px;" placeholder="Tiêu đề...">
                        <textarea name="perk_4_desc" rows="3" style="width: 100%; font-size: 0.85rem; line-height: 1.5;" placeholder="Mô tả chi tiết..."><?php echo esc_textarea($p['perk_4_desc']); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Panel 4: CTAs -->
            <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; margin-bottom: 24px; overflow: hidden;">
                <div style="background: linear-gradient(135deg, #1e293b, #334155); padding: 16px 20px; color: #ffffff;">
                    <strong style="font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-external" style="color: #fbbf24;"></span>
                        4. Ba Nút Bấm Hành Động (CTA Buttons)
                    </strong>
                </div>

                <div style="padding: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Nút 1: Hotline / Tư Vấn Kỹ Thuật:</label>
                        <input type="text" name="cta_booking_text" value="<?php echo esc_attr($p['cta_booking_text']); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="Tên nút...">
                        <input type="text" name="cta_booking_url" value="<?php echo esc_attr($p['cta_booking_url']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="Link (#shiftup-booking-anchor)">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Nút 2: Hotline Hỗ Trợ Xe Điện:</label>
                        <input type="text" name="cta_hotline_text" value="<?php echo esc_attr($p['cta_hotline_text']); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="Tên nút...">
                        <input type="text" name="cta_hotline_tel" value="<?php echo esc_attr($p['cta_hotline_tel']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="Số điện thoại (0911211996)">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Nút 3: Phụ Kiện Xe VinFast:</label>
                        <input type="text" name="cta_accessory_text" value="<?php echo esc_attr($p['cta_accessory_text']); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="Tên nút...">
                        <input type="text" name="cta_accessory_url" value="<?php echo esc_attr($p['cta_accessory_url']); ?>" style="width: 100%; font-size: 0.85rem;" placeholder="Link (/phu-kien/)">
                    </div>
                </div>

                <div style="padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <button type="submit" name="hieugara_reset_default_partner" value="1" class="button" style="color: #64748b;" onclick="return confirm('Bạn có chắc muốn khôi phục lại nội dung mặc định của VinFast?');">
                            <span class="dashicons dashicons-backup" style="margin-top: 4px;"></span> Khôi Phục Mặc Định VinFast
                        </button>
                    </div>
                    <div>
                        <button type="submit" name="hieugara_save_comprehensive_partner" value="1" class="button button-primary button-hero" style="background: #e11d48; border-color: #be123c; font-weight: 700; padding: 0 28px;">
                            <span class="dashicons dashicons-saved" style="margin-top: 6px;"></span> LƯU CẤU HÌNH ĐỐI TÁC TOÀN DIỆN
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#btn_upload_partner_logo').on('click', function(e) {
            e.preventDefault();
            var customUploader = wp.media({
                title: 'Chọn hoặc Tải lên Logo Đối Tác (SVG/PNG)',
                button: { text: 'Sử dụng Logo này' },
                multiple: false
            }).on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                $('#partner_logo_url').val(attachment.url).trigger('change');
                $('#partner_logo_preview').attr('src', attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}
