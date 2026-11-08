<?php
/**
 * Ôtô Hải Hà - Quản Lý Phụ Kiện Ôtô (Full CRUD Admin Panel)
 * Nguồn phụ kiện & nội dung theo chuẩn META.vn (meta.vn/phu-kien-oto)
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Register Admin Menus for Accessories CRUD
 */
function hieugara_register_accessories_admin_menu() {
    // Register as a Submenu under "Phụ Kiện Ô Tô" post type (avoid duplicate top-level menu)
    add_submenu_page(
        'edit.php?post_type=garage_accessory',
        '⚡ Quản Lý Nhanh / Slider (META.vn)',
        '⚡ Quản Lý Nhanh',
        'manage_options',
        'hieugara-accessories-crud',
        'hieugara_render_accessories_crud_page'
    );

    // Submenu under Cài Đặt Giao Diện
    add_submenu_page(
        'hieugara-theme-settings',
        'Quản Lý Phụ Kiện Ôtô',
        '🛍️ Phụ Kiện Ôtô',
        'manage_options',
        'hieugara-accessories-crud',
        'hieugara_render_accessories_crud_page'
    );
}
add_action('admin_menu', 'hieugara_register_accessories_admin_menu', 20);

/**
 * 2. Enqueue Media & Styles for Accessories Admin
 */
function hieugara_accessories_crud_assets($hook) {
    if (strpos($hook, 'hieugara-accessories-crud') === false) {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'hieugara_accessories_crud_assets');

/**
 * 3. Handle CRUD Actions (Create, Update, Delete, Reorder, Reset)
 */
function hieugara_handle_accessories_crud_actions() {
    if (!isset($_POST['hieugara_acc_action']) && !isset($_GET['hieugara_acc_action'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die(__('Bạn không có quyền thực hiện thao tác này.', 'hieugara-motors'));
    }

    $action = sanitize_text_field($_POST['hieugara_acc_action'] ?? $_GET['hieugara_acc_action']);

    // ACTION: Reset to META.vn Defaults
    if ($action === 'reset_defaults') {
        check_admin_referer('hieugara_acc_reset_nonce');
        $defaults = function_exists('hieugara_get_default_accessories_items') ? hieugara_get_default_accessories_items() : array();
        update_option('hieugara_accessories_items', $defaults);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-accessories-crud', 'msg' => 'reset_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Delete Single Item
    if ($action === 'delete_item') {
        check_admin_referer('hieugara_acc_del_nonce');
        $del_id = sanitize_text_field($_GET['item_id'] ?? '');
        $items = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
        if (isset($items[$del_id])) {
            unset($items[$del_id]);
            update_option('hieugara_accessories_items', $items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-accessories-crud', 'msg' => 'del_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Move Up / Move Down
    if ($action === 'reorder_item') {
        check_admin_referer('hieugara_acc_reorder_nonce');
        $item_id = sanitize_text_field($_GET['item_id'] ?? '');
        $dir = sanitize_text_field($_GET['direction'] ?? '');
        $items = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();

        $keys = array_keys($items);
        $idx = array_search($item_id, $keys);

        if ($idx !== false) {
            if ($dir === 'up' && $idx > 0) {
                $temp = $keys[$idx - 1];
                $keys[$idx - 1] = $keys[$idx];
                $keys[$idx] = $temp;
            } elseif ($dir === 'down' && $idx < count($keys) - 1) {
                $temp = $keys[$idx + 1];
                $keys[$idx + 1] = $keys[$idx];
                $keys[$idx] = $temp;
            }
            $reordered = array();
            foreach ($keys as $k) {
                $reordered[$k] = $items[$k];
            }
            update_option('hieugara_accessories_items', $reordered);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-accessories-crud', 'msg' => 'reorder_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Add New Item
    if ($action === 'add_item') {
        check_admin_referer('hieugara_acc_save_nonce');
        $items = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
        
        $new_uid = 'acc_' . time() . '_' . wp_rand(100, 999);
        $new_item = array(
            'enable'    => isset($_POST['new_enable']) ? '1' : '0',
            'title'     => sanitize_text_field($_POST['new_title'] ?? 'Phụ kiện ô tô mới'),
            'badge'     => sanitize_text_field($_POST['new_badge'] ?? 'CHÍNH HÃNG'),
            'price'     => sanitize_text_field($_POST['new_price'] ?? 'Liên hệ'),
            'old_price' => sanitize_text_field($_POST['new_old_price'] ?? ''),
            'img'       => esc_url_raw($_POST['new_img'] ?? ''),
            'link'      => !empty($_POST['new_link']) ? esc_url_raw($_POST['new_link']) : 'https://meta.vn/phu-kien-oto/',
        );

        $items[$new_uid] = $new_item;
        update_option('hieugara_accessories_items', $items);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-accessories-crud', 'msg' => 'add_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Save All Existing Items (Batch Update)
    if ($action === 'save_all_items') {
        check_admin_referer('hieugara_acc_save_nonce');
        if (isset($_POST['hieugara_items']) && is_array($_POST['hieugara_items'])) {
            $cleaned = array();
            foreach ($_POST['hieugara_items'] as $id => $it) {
                if (!empty($it['title'])) {
                    $cleaned[$id] = array(
                        'enable'    => isset($it['enable']) ? '1' : '0',
                        'title'     => sanitize_text_field($it['title']),
                        'badge'     => sanitize_text_field($it['badge'] ?? ''),
                        'price'     => sanitize_text_field($it['price'] ?? ''),
                        'old_price' => sanitize_text_field($it['old_price'] ?? ''),
                        'img'       => esc_url_raw($it['img'] ?? ''),
                        'link'      => !empty($it['link']) ? esc_url_raw($it['link']) : 'https://meta.vn/phu-kien-oto/',
                    );
                }
            }
            update_option('hieugara_accessories_items', $cleaned);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-accessories-crud', 'msg' => 'save_success'), admin_url('admin.php')));
        exit;
    }
}
add_action('admin_init', 'hieugara_handle_accessories_crud_actions');

/**
 * 4. Render Accessories CRUD Admin Dashboard Page
 */
function hieugara_render_accessories_crud_page() {
    $items = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
    $total_items   = count($items);
    $active_items  = 0;
    foreach ($items as $it) {
        if (!empty($it['enable'])) {
            $active_items++;
        }
    }
    $hidden_items = $total_items - $active_items;

    $msg = sanitize_text_field($_GET['msg'] ?? '');
    ?>
    <style>
        .acc-wrap {
            max-width: 1380px;
            margin: 20px 20px 40px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .acc-hero {
            background: linear-gradient(135deg, #141414 0%, #1e1e1e 65%, #2a2215 100%);
            color: #ffffff;
            border-radius: 12px;
            padding: 28px 32px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-left: 6px solid #F5A300;
        }
        .acc-hero h1 {
            color: #ffffff;
            font-size: 26px;
            font-weight: 700;
            margin: 0 0 6px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .acc-hero p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            margin: 0;
        }
        .acc-hero a.meta-link {
            color: #F5A300;
            text-decoration: underline;
            font-weight: 600;
        }
        .acc-stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(4px);
        }
        .acc-stat-pill strong {
            color: #F5A300;
            font-size: 16px;
        }
        .acc-top-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn-gold {
            background: #F5A300 !important;
            color: #141414 !important;
            border: none !important;
            font-weight: 700 !important;
            padding: 9px 20px !important;
            border-radius: 6px !important;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(245, 163, 0, 0.35);
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-gold:hover {
            background: #e09400 !important;
            color: #141414 !important;
        }
        .btn-dark {
            background: #141414 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            font-weight: 600 !important;
            padding: 9px 18px !important;
            border-radius: 6px !important;
            cursor: pointer;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-dark:hover {
            background: #2a2a2a !important;
            color: #ffffff !important;
        }
        .acc-alert-notice {
            background: #dcfce7;
            border-left: 4px solid #16a34a;
            color: #15803d;
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* New Item Creator Form Box */
        .acc-creator-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 28px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        .acc-creator-card h2 {
            margin: 0 0 16px 0;
            font-size: 18px;
            font-weight: 700;
            color: #141414;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 12px;
        }
        .acc-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }
        .acc-field-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .acc-field-group input[type="text"],
        .acc-field-group input[type="url"] {
            width: 100%;
            height: 38px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .acc-field-group input:focus {
            border-color: #F5A300;
            box-shadow: 0 0 0 1px #F5A300;
            outline: none;
        }
        /* Catalog Items Grid */
        .acc-catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 22px;
            margin-bottom: 30px;
        }
        .acc-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            position: relative;
        }
        .acc-card:hover {
            border-color: #F5A300;
            box-shadow: 0 10px 24px rgba(245, 163, 0, 0.15);
            transform: translateY(-2px);
        }
        .acc-card-head {
            background: #141414;
            color: #ffffff;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 600;
        }
        .acc-card-head .item-order {
            background: #F5A300;
            color: #141414;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 11px;
        }
        .acc-card-thumb-wrap {
            position: relative;
            height: 200px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-bottom: 1px solid #e2e8f0;
        }
        .acc-card-thumb-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .acc-badge-chip {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #F5A300;
            color: #141414;
            font-weight: 800;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        }
        .acc-card-body {
            padding: 18px;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .acc-card-foot {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .acc-reorder-btns {
            display: flex;
            gap: 6px;
        }
        .btn-mini {
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            cursor: pointer;
        }
        .btn-mini:hover {
            background: #f1f5f9;
            color: #141414;
        }
        .btn-del-mini {
            color: #dc2626 !important;
            border-color: #fca5a5 !important;
        }
        .btn-del-mini:hover {
            background: #fee2e2 !important;
        }
    </style>

    <div class="wrap acc-wrap">
        
        <!-- TOP NOTICES -->
        <?php if ($msg === 'save_success') : ?>
            <div class="acc-alert-notice">✅ Đã lưu cập nhật tất cả phụ kiện ô tô thành công! Trang chủ và bộ nhớ đệm đã được làm mới tức thì.</div>
        <?php elseif ($msg === 'add_success') : ?>
            <div class="acc-alert-notice">🎉 Đã thêm mới phụ kiện ô tô thành công vào thanh trượt trang chủ!</div>
        <?php elseif ($msg === 'del_success') : ?>
            <div class="acc-alert-notice">🗑️ Đã xóa sản phẩm phụ kiện ô tô khỏi hệ thống.</div>
        <?php elseif ($msg === 'reorder_success') : ?>
            <div class="acc-alert-notice">🔄 Đã cập nhật lại thứ tự hiển thị của phụ kiện trên thanh trượt!</div>
        <?php elseif ($msg === 'reset_success') : ?>
            <div class="acc-alert-notice">✨ Đã khôi phục hoàn toàn danh mục phụ kiện ô tô mẫu chuẩn theo META.vn (meta.vn/phu-kien-oto)!</div>
        <?php endif; ?>

        <!-- HERO HEADER -->
        <div class="acc-hero">
            <div>
                <h1><span>🛍️</span> QUẢN LÝ PHỤ KIỆN ÔTÔ</h1>
                <p>Quản lý toàn bộ danh mục sản phẩm hiển thị tại mục <strong>Phụ Kiện Ôtô Chính Hãng</strong> trên trang chủ. Dữ liệu chuẩn lấy cảm hứng từ <a href="https://meta.vn/phu-kien-oto/" target="_blank" rel="noopener" class="meta-link">META.vn/phu-kien-oto ↗</a></p>
            </div>
            <div class="acc-top-actions">
                <span class="acc-stat-pill">Tổng: <strong><?php echo esc_html($total_items); ?></strong></span>
                <span class="acc-stat-pill">Hiển thị: <strong style="color: #22c55e;"><?php echo esc_html($active_items); ?></strong></span>
                <span class="acc-stat-pill">Đang ẩn: <strong style="color: #ef4444;"><?php echo esc_html($hidden_items); ?></strong></span>
                
                <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('hieugara_acc_action' => 'reset_defaults')), 'hieugara_acc_reset_nonce')); ?>" 
                   class="btn-dark" 
                   onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục Phụ kiện ô tô mẫu chuẩn theo META.vn không? Tất cả sản phẩm hiện tại sẽ được thay bằng mẫu META.vn.');">
                    🔄 Khôi Phục Mẫu META.vn
                </a>
                <a href="<?php echo esc_url(home_url('/#phu-kien-chinh-hang')); ?>" target="_blank" class="btn-gold">
                    👁️ Xem Trên Trang Chủ ↗
                </a>
            </div>
        </div>

        <!-- 1. FORM CREATE (THÊM PHỤ KIỆN MỚI) -->
        <div class="acc-creator-card">
            <h2>➕ Thêm Phụ Kiện Ôtô Mới (Chuẩn META.vn)</h2>
            <form method="post" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-accessories-crud')); ?>">
                <?php wp_nonce_field('hieugara_acc_save_nonce'); ?>
                <input type="hidden" name="hieugara_acc_action" value="add_item">

                <div class="acc-form-grid">
                    <div class="acc-field-group" style="grid-column: span 2;">
                        <label>Tên phụ kiện / Sản phẩm <span style="color: red;">*</span>:</label>
                        <input type="text" name="new_title" required placeholder="VD: Camera hành trình 70mai A810S 4K HDR Omni hoặc Bơm lốp Michelin M2567...">
                    </div>
                    <div class="acc-field-group">
                        <label>Huy hiệu nổi bật (Badge):</label>
                        <input type="text" name="new_badge" placeholder="VD: BÁN CHẠY, CHÍNH HÃNG, GIẢM 15%, MICHELIN...">
                    </div>
                    <div class="acc-field-group">
                        <label>Giá bán hiện tại (VNĐ) <span style="color: red;">*</span>:</label>
                        <input type="text" name="new_price" required placeholder="VD: 1.180.000 hoặc 3.690.000">
                    </div>
                    <div class="acc-field-group">
                        <label>Giá niêm yết / Giá cũ (VNĐ):</label>
                        <input type="text" name="new_old_price" placeholder="VD: 1.450.000 (để trống nếu không có)">
                    </div>
                    <div class="acc-field-group" style="grid-column: span 2;">
                        <label>Link chi tiết sản phẩm / Đặt hàng:</label>
                        <input type="url" name="new_link" value="https://meta.vn/phu-kien-oto/" placeholder="https://meta.vn/phu-kien-oto/ hoặc link tư vấn...">
                    </div>
                    <div class="acc-field-group" style="grid-column: span 2;">
                        <label>Hình ảnh sản phẩm (URL hoặc tải lên từ thư viện):</label>
                        <div style="display: flex; gap: 8px;">
                            <input type="text" name="new_img" id="new_item_img" placeholder="https://...">
                            <button type="button" class="button acc-pick-img-btn" data-target="#new_item_img" data-preview="#new_preview_img">🖼️ Chọn Ảnh</button>
                        </div>
                        <div id="new_preview_img" style="margin-top: 8px; width: 80px; height: 60px; border: 1px dashed #cbd5e1; border-radius: 4px; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #f8fafc;">
                            <span style="font-size: 11px; color: #94a3b8;">Xem trước</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                    <label style="font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                        <input type="checkbox" name="new_enable" value="1" checked> Hiển thị trên thanh trượt trang chủ ngay lập tức
                    </label>
                    <button type="submit" class="btn-gold">
                        💾 Thêm Sản Phẩm Này
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. BATCH UPDATE & EDIT / DELETE / REORDER (DANH SÁCH & CHỈNH SỬA) -->
        <form method="post" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-accessories-crud')); ?>">
            <?php wp_nonce_field('hieugara_acc_save_nonce'); ?>
            <input type="hidden" name="hieugara_acc_action" value="save_all_items">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: #141414;">
                    📦 Danh Sách Phụ Kiện Ôtô Hiện Có (<?php echo esc_html($total_items); ?> sản phẩm)
                </h2>
                <button type="submit" class="btn-gold" style="font-size: 14px; padding: 10px 24px !important;">
                    💾 LƯU TẤT CẢ THAY ĐỔI
                </button>
            </div>

            <div class="acc-catalog-grid">
                <?php 
                $count = 0;
                foreach ($items as $item_id => $it) : 
                    $count++;
                    $is_enabled = !empty($it['enable']);
                ?>
                    <div class="acc-card" id="acc-card-<?php echo esc_attr($item_id); ?>" style="<?php echo !$is_enabled ? 'opacity: 0.65; border-color: #cbd5e1;' : ''; ?>">
                        
                        <!-- HEAD: ORDER & STATUS -->
                        <div class="acc-card-head">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span class="item-order">#<?php echo esc_html($count); ?></span>
                                <span>ID: <?php echo esc_html($item_id); ?></span>
                            </div>
                            <label style="color: #ffffff; cursor: pointer; font-size: 12px; margin: 0; display: inline-flex; align-items: center; gap: 4px;">
                                <input type="checkbox" name="hieugara_items[<?php echo esc_attr($item_id); ?>][enable]" value="1" <?php checked(true, $is_enabled); ?>> 
                                <?php echo $is_enabled ? 'Đang bật' : 'Đang ẩn'; ?>
                            </label>
                        </div>

                        <!-- THUMBNAIL WITH BADGE -->
                        <div class="acc-card-thumb-wrap">
                            <?php if (!empty($it['badge'])) : ?>
                                <span class="acc-badge-chip" id="badge_preview_<?php echo esc_attr($item_id); ?>"><?php echo esc_html($it['badge']); ?></span>
                            <?php endif; ?>
                            <img src="<?php echo esc_url($it['img']); ?>" id="thumb_prev_<?php echo esc_attr($item_id); ?>" alt="">
                        </div>

                        <!-- BODY INPUTS -->
                        <div class="acc-card-body">
                            <div class="acc-field-group">
                                <label>Tên sản phẩm:</label>
                                <input type="text" name="hieugara_items[<?php echo esc_attr($item_id); ?>][title]" value="<?php echo esc_attr($it['title']); ?>" required>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <div class="acc-field-group">
                                    <label>Giá bán (VNĐ):</label>
                                    <input type="text" name="hieugara_items[<?php echo esc_attr($item_id); ?>][price]" value="<?php echo esc_attr($it['price']); ?>" required>
                                </div>
                                <div class="acc-field-group">
                                    <label>Giá cũ (VNĐ):</label>
                                    <input type="text" name="hieugara_items[<?php echo esc_attr($item_id); ?>][old_price]" value="<?php echo esc_attr($it['old_price'] ?? ''); ?>" placeholder="Không có">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <div class="acc-field-group">
                                    <label>Huy hiệu (Badge):</label>
                                    <input type="text" name="hieugara_items[<?php echo esc_attr($item_id); ?>][badge]" value="<?php echo esc_attr($it['badge'] ?? ''); ?>" placeholder="VD: BÁN CHẠY">
                                </div>
                                <div class="acc-field-group">
                                    <label>Đổi ảnh:</label>
                                    <button type="button" class="button acc-pick-img-btn" style="width: 100%; height: 38px;" data-target="#inp_img_<?php echo esc_attr($item_id); ?>" data-preview="#thumb_prev_<?php echo esc_attr($item_id); ?>">🖼️ Đổi Ảnh</button>
                                </div>
                            </div>

                            <input type="hidden" name="hieugara_items[<?php echo esc_attr($item_id); ?>][img]" id="inp_img_<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr($it['img']); ?>">

                            <div class="acc-field-group">
                                <label>Đường dẫn chi tiết / Đặt hàng:</label>
                                <input type="url" name="hieugara_items[<?php echo esc_attr($item_id); ?>][link]" value="<?php echo esc_attr($it['link'] ?? 'https://meta.vn/phu-kien-oto/'); ?>">
                            </div>
                        </div>

                        <!-- FOOT ACTIONS: REORDER & DELETE -->
                        <div class="acc-card-foot">
                            <div class="acc-reorder-btns">
                                <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('hieugara_acc_action' => 'reorder_item', 'item_id' => $item_id, 'direction' => 'up')), 'hieugara_acc_reorder_nonce')); ?>" class="btn-mini" title="Di chuyển lên trước">⬆️ Lên</a>
                                <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('hieugara_acc_action' => 'reorder_item', 'item_id' => $item_id, 'direction' => 'down')), 'hieugara_acc_reorder_nonce')); ?>" class="btn-mini" title="Di chuyển xuống sau">⬇️ Xuống</a>
                            </div>

                            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('hieugara_acc_action' => 'delete_item', 'item_id' => $item_id)), 'hieugara_acc_del_nonce')); ?>" 
                               class="btn-mini btn-del-mini" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm «<?php echo esc_js($it['title']); ?>» không?');">
                               🗑️ Xóa
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: right; margin-top: 20px;">
                <button type="submit" class="btn-gold" style="font-size: 15px; padding: 12px 32px !important;">
                    💾 LƯU TẤT CẢ THAY ĐỔI
                </button>
            </div>
        </form>

    </div>

    <!-- NATIVE WP MEDIA UPLOADER INTEGRATION JS -->
    <script>
    jQuery(document).ready(function($) {
        $('.acc-pick-img-btn').on('click', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $(btn.data('target'));
            var previewBox = $(btn.data('preview'));

            var frame = wp.media({
                title: 'Chọn Ảnh Phụ Kiện Ôtô (Chuẩn META.vn)',
                button: { text: 'Dùng ảnh này' },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                if (previewBox.is('img')) {
                    previewBox.attr('src', attachment.url);
                } else {
                    previewBox.html('<img src="' + attachment.url + '" style="width: 100%; height: 100%; object-fit: cover;">');
                }
            });

            frame.open();
        });
    });
    </script>
    <?php
}

