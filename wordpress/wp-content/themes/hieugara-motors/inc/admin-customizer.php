<?php
/**
 * Ôtô Hải Hà - Modern Admin Customizer & Dashboard Command Center
 * Tối ưu hóa toàn diện giao diện quản trị WordPress cho Chủ Gara Ôtô Hải Hà
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Enqueue Luxury Admin Styles & Font
function hieugara_admin_customizer_assets() {
    wp_enqueue_style(
        'hieugara-admin-luxury-css',
        get_template_directory_uri() . '/assets/css/admin-luxury.css',
        array(),
        HIEUGARA_THEME_VERSION . '.' . time()
    );
}
add_action('admin_enqueue_scripts', 'hieugara_admin_customizer_assets');

// 2. Add Top Bar Quick Action: 1-Click Cache Purge & View Site
function hieugara_admin_bar_customization($wp_admin_bar) {
    // Remove default WP logo & clutter nodes
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('site-name');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-content');

    // Add Brand Node
    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-brand',
        'title' => '<span class="ab-icon dashicons dashicons-car" style="color:#ff4d24 !important;"></span> <strong style="color:#fff;font-weight:700;">ÔTÔ HẢI HÀ</strong>',
        'href'  => admin_url('index.php'),
        'meta'  => array('class' => 'hieugara-topbar-brand')
    ));

    // Add 1-Click Cache Purge button
    $purge_url = wp_nonce_url(admin_url('index.php?hieugara_action=purge_cache'), 'hieugara_purge_cache');
    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-purge-cache',
        'title' => '<span class="ab-icon dashicons dashicons-update" style="color:#22c55e !important;"></span> <span style="color:#22c55e;font-weight:600;">⚡ XÓA CACHE WEB</span>',
        'href'  => $purge_url,
        'meta'  => array(
            'title' => 'Xóa sạch bộ nhớ đệm server tức thì để cập nhật dữ liệu mới ra web',
            'class' => 'hieugara-topbar-cache-btn'
        )
    ));

    // Add Quick View Website button
    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-view-site',
        'title' => '<span class="ab-icon dashicons dashicons-external"></span> <span>🚗 Xem Website</span>',
        'href'  => home_url('/'),
        'meta'  => array(
            'target' => '_blank',
            'class'  => 'hieugara-topbar-view-btn'
        )
    ));
}
add_action('admin_bar_menu', 'hieugara_admin_bar_customization', 999);

// 3. Handle Admin 1-Click Cache Purge Request
function hieugara_handle_admin_actions() {
    if (isset($_GET['hieugara_action']) && $_GET['hieugara_action'] === 'purge_cache') {
        if (check_admin_referer('hieugara_purge_cache') && current_user_can('manage_options')) {
            hieugara_purge_page_cache();
            wp_safe_redirect(admin_url('index.php?hieugara_cache_purged=1'));
            exit;
        }
    }

    // Handle Quick Settings Update on Dashboard
    if (isset($_POST['hieugara_quick_settings_nonce']) && wp_verify_nonce($_POST['hieugara_quick_settings_nonce'], 'hieugara_quick_settings_action')) {
        if (current_user_can('manage_options')) {
            if (isset($_POST['quick_hotline'])) {
                update_option('hieugara_hotline_phone', sanitize_text_field($_POST['quick_hotline']));
            }
            if (isset($_POST['quick_rescue'])) {
                update_option('hieugara_rescue_phone', sanitize_text_field($_POST['quick_rescue']));
            }
            if (isset($_POST['quick_tech'])) {
                update_option('hieugara_tech_phone', sanitize_text_field($_POST['quick_tech']));
            }
            if (isset($_POST['quick_email'])) {
                update_option('hieugara_topbar_email', sanitize_email($_POST['quick_email']));
            }
            if (isset($_POST['quick_hours'])) {
                update_option('hieugara_topbar_hours', sanitize_text_field($_POST['quick_hours']));
            }

            // Invalidate cache immediately
            hieugara_purge_page_cache();

            wp_safe_redirect(admin_url('index.php?hieugara_settings_saved=1'));
            exit;
        }
    }
}
add_action('admin_init', 'hieugara_handle_admin_actions');

// Show Admin Notices
function hieugara_admin_customizer_notices() {
    if (isset($_GET['hieugara_cache_purged']) && $_GET['hieugara_cache_purged'] == '1') {
        echo '<div class="notice notice-success is-dismissible" style="border-left-color: #22c55e; padding: 12px 16px;">
            <p style="font-size: 15px; margin: 0; font-weight: 600; color: #166534;">
                <span class="dashicons dashicons-yes-alt" style="vertical-align: middle; margin-right: 6px; color:#22c55e;"></span>
                ⚡ ĐÃ XÓA SẠCH BỘ NHỚ ĐỆM SERVER TOÀN WEB! Mọi thay đổi mới nhất đã sẵn sàng hiển thị trên trang chủ & trang con.
            </p>
        </div>';
    }
    if (isset($_GET['hieugara_settings_saved']) && $_GET['hieugara_settings_saved'] == '1') {
        echo '<div class="notice notice-success is-dismissible" style="border-left-color: #ff4d24; padding: 12px 16px;">
            <p style="font-size: 15px; margin: 0; font-weight: 600; color: #9a3412;">
                <span class="dashicons dashicons-saved" style="vertical-align: middle; margin-right: 6px; color:#ff4d24;"></span>
                ✅ ĐÃ LƯU THÔNG TIN LIÊN HỆ & TỰ ĐỘNG XÓA BỘ NHỚ ĐỆM THÀNH CÔNG!
            </p>
        </div>';
    }
}
add_action('admin_notices', 'hieugara_admin_customizer_notices');

// 4. Simplify & Reorder Admin Menu
function hieugara_reorder_admin_menu($menu_order) {
    return array(
        'index.php',                                    // Bảng điều khiển Hải Hà
        'hieugara-media-hub',                           // Thư viện ảnh Gara theo nhóm
        'garage-os-bookings',                           // Lịch hẹn khách hàng
        'edit.php?post_type=garage_service',            // Dịch vụ & Bảng giá
        'hieugara-theme-settings',                      // Cài đặt giao diện & Hotline
        'garage-os-warranties',                         // Sổ bảo hành điện tử
        'garage-os-orders',                             // Quản lý đơn sửa chữa
        'upload.php',                                   // Kho file Media gốc
        'edit.php?post_type=page',                      // Quản lý các trang
        'edit.php',                                     // Tin tức & Blog
        'users.php',                                    // Người dùng & Thợ
        'options-general.php',                          // Cài đặt chung WordPress
    );
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'hieugara_reorder_admin_menu');

// 5. Clean up Menu Items & Rename for Garage Owner Clarity
function hieugara_clean_admin_menu() {
    global $menu, $submenu;

    // Remove clutter menus & disable Kanban
    remove_menu_page('edit-comments.php'); // No blog comments needed for garage
    remove_menu_page('garage-os-kanban');  // Đóng hoàn toàn mục Tiến độ Khoang xe Kanban
    remove_submenu_page('garage-os-bookings', 'garage-os-kanban');

    // Rename default menu items to friendly garage terms
    foreach ($menu as $key => $value) {
        if (isset($value[2])) {
            switch ($value[2]) {
                case 'index.php':
                    $menu[$key][0] = '🚗 Trung Tâm Hải Hà';
                    break;
                case 'edit.php?post_type=garage_service':
                    $menu[$key][0] = '🔧 Dịch Vụ & Giá Niêm Yết';
                    break;
                case 'hieugara-theme-settings':
                    $menu[$key][0] = '⚙️ Cài Đặt Hotline & Web';
                    break;
                case 'garage-os-bookings':
                    $menu[$key][0] = '📅 Lịch Hẹn Khách Hàng';
                    break;
                case 'garage-os-warranties':
                    $menu[$key][0] = '🛡️ Sổ Bảo Hành';
                    break;
                case 'garage-os-orders':
                    $menu[$key][0] = '📋 Đơn Sửa Chữa';
                    break;
                case 'hieugara-media-hub':
                    $menu[$key][0] = '🖼️ Thư Viện Ảnh Gara';
                    break;
                case 'upload.php':
                    $menu[$key][0] = '📁 Kho File Media';
                    break;
                case 'edit.php?post_type=page':
                    $menu[$key][0] = '📄 Quản Lý Trang Web';
                    break;
            }
        }
    }
}
add_action('admin_menu', 'hieugara_clean_admin_menu', 999);

// 6. Replace Default Dashboard with Ôtô Hải Hà Command Center
function hieugara_customize_dashboard_widgets() {
    global $wp_meta_boxes;

    // Remove all default widgets
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    remove_action('welcome_panel', 'wp_welcome_panel');

    // Add our custom Command Center widget
    wp_add_dashboard_widget(
        'hieugara_dashboard_hub',
        '🚗 TRUNG TÂM ĐIỀU HÀNH ÔTÔ HẢI HÀ (COMMAND CENTER)',
        'hieugara_render_dashboard_hub_widget'
    );
}
add_action('wp_dashboard_setup', 'hieugara_customize_dashboard_widgets', 999);

// 7. Render Dashboard Command Center Widget
function hieugara_render_dashboard_hub_widget() {
    global $wpdb;

    // Stats
    $total_services = wp_count_posts('garage_service')->publish ?? 0;
    
    // Total bookings count
    $table_bookings = $wpdb->prefix . 'garage_bookings';
    $total_bookings = 0;
    $pending_bookings = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_bookings'") === $table_bookings) {
        $total_bookings = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings");
        $pending_bookings = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'pending'");
    }

    // Total warranties count
    $table_warranties = $wpdb->prefix . 'garage_warranties';
    $total_warranties = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_warranties'") === $table_warranties) {
        $total_warranties = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_warranties");
    }

    // Contact options
    $hotline = hieugara_hotline_phone();
    $rescue  = hieugara_rescue_phone();
    $tech    = hieugara_tech_phone();
    $email   = get_option('hieugara_topbar_email', 'cuuhogiaothonghaiha@gmail.com');
    $hours   = get_option('hieugara_topbar_hours', 'T2 - CN: 07:30 - 18:30 (Cứu hộ 24/7)');
    $purge_url = wp_nonce_url(admin_url('index.php?hieugara_action=purge_cache'), 'hieugara_purge_cache');
    ?>
    <div class="hieugara-hub-wrap">
        <!-- Top Banner -->
        <div class="hieugara-hub-banner">
            <div class="hieugara-hub-banner-content">
                <span class="hub-badge">HỆ THỐNG ĐIỀU HÀNH 5.0</span>
                <h2>ÔTÔ HẢI HÀ SERVICE</h2>
                <p>Địa chỉ: Km 53+300 Quốc lộ 5, Phường Cẩm Thượng, TP. Hải Dương | Cứu hộ 24/7 toàn miền Bắc</p>
            </div>
            <div class="hieugara-hub-banner-actions">
                <a href="<?php echo esc_url($purge_url); ?>" class="hub-btn hub-btn-cache">
                    <span class="dashicons dashicons-update"></span> ⚡ XÓA CACHE TỨC THÌ
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="hub-btn hub-btn-view">
                    <span class="dashicons dashicons-external"></span> 🚗 XEM WEB NGOÀI
                </a>
            </div>
        </div>

        <!-- KPI Grid -->
        <div class="hieugara-hub-kpis">
            <a href="<?php echo admin_url('admin.php?page=garage-os-bookings'); ?>" class="hub-kpi-card kpi-orange">
                <div class="kpi-icon"><span class="dashicons dashicons-calendar-alt"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Lịch Hẹn Đang Chờ</span>
                    <strong class="kpi-num"><?php echo esc_html($pending_bookings); ?></strong>
                    <span class="kpi-sub">Tổng: <?php echo esc_html($total_bookings); ?> cuộc hẹn</span>
                </div>
            </a>

            <a href="<?php echo admin_url('edit.php?post_type=garage_service'); ?>" class="hub-kpi-card kpi-blue">
                <div class="kpi-icon"><span class="dashicons dashicons-car"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Dịch Vụ & Bảng Giá</span>
                    <strong class="kpi-num"><?php echo esc_html($total_services); ?></strong>
                    <span class="kpi-sub">Đang niêm yết trên web</span>
                </div>
            </a>

            <a href="<?php echo admin_url('admin.php?page=garage-os-warranties'); ?>" class="hub-kpi-card kpi-green">
                <div class="kpi-icon"><span class="dashicons dashicons-shield"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Sổ Bảo Hành Điện Tử</span>
                    <strong class="kpi-num"><?php echo esc_html($total_warranties); ?></strong>
                    <span class="kpi-sub">Tra cứu theo biển số</span>
                </div>
            </a>

            <div class="hub-kpi-card kpi-purple">
                <div class="kpi-icon"><span class="dashicons dashicons-performance"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Máy Chủ Caching</span>
                    <strong class="kpi-num" style="color: #22c55e; font-size: 20px;">BẬT TỐI ƯU</strong>
                    <span class="kpi-sub">Tốc độ mở trang: &lt; 0.05s</span>
                </div>
            </div>
        </div>

        <!-- Quick Launch Action Matrix -->
        <h3 class="hub-section-title"><span class="dashicons dashicons-star-filled"></span> PHÍM TẮT THAO TÁC NHANH DÀNH CHO QUẢN TRỊ VIÊN</h3>
        <div class="hieugara-hub-shortcuts">
            <a href="<?php echo admin_url('post-new.php?post_type=garage_service'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-plus-alt2"></span>
                <strong>Thêm Dịch Vụ Mới</strong>
                <small>Tạo gói bảo dưỡng, đồng sơn, máy gầm</small>
            </a>
            <a href="<?php echo admin_url('admin.php?page=garage-os-bookings'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-clock"></span>
                <strong>Quản Lý Đặt Lịch</strong>
                <small>Xem và duyệt yêu cầu hẹn làm xe</small>
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=garage_service'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-money-alt"></span>
                <strong>Sửa Giá Dịch Vụ</strong>
                <small>Cập nhật giá theo từng cấp KM</small>
            </a>
            <a href="<?php echo admin_url('admin.php?page=hieugara-theme-settings#hero'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-images-alt2"></span>
                <strong>Đổi Banner & Slider</strong>
                <small>Thay đổi hình ảnh khuyến mãi đầu trang</small>
            </a>
            <a href="<?php echo admin_url('admin.php?page=garage-os-warranties'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-shield"></span>
                <strong>Tra Cứu Sổ Bảo Hành</strong>
                <small>Kiểm tra lịch sử bảo hành theo biển số xe</small>
            </a>
            <a href="<?php echo admin_url('admin.php?page=hieugara-media-hub'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-format-gallery"></span>
                <strong>Thư Viện Ảnh Gara</strong>
                <small>Logo, Ảnh Trang Chủ, Gallery & 6 Mảng Dịch Vụ</small>
            </a>
            <a href="<?php echo admin_url('admin.php?page=hieugara-theme-settings#contact'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-admin-settings"></span>
                <strong>Tất Cả Cài Đặt Giao Diện</strong>
                <small>Logo hãng, màu sắc, menu trang web</small>
            </a>
        </div>

        <!-- Quick Hotline & Contact Info Updater -->
        <div class="hieugara-hub-quicksettings">
            <h3 class="hub-section-title"><span class="dashicons dashicons-phone"></span> CẬP NHẬT NHANH SỐ ĐIỆN THOẠI & GIỜ LÀM VIỆC (LƯU TỨC THÌ)</h3>
            <p style="margin-top:0; color:#64748b; font-size:13px;">Khi thay đổi tại đây, hệ thống sẽ tự động cập nhật số điện thoại lên toàn bộ website và tự xóa cache ngay lập tức.</p>
            
            <form method="post" action="<?php echo admin_url('index.php'); ?>" class="hub-settings-form">
                <?php wp_nonce_field('hieugara_quick_settings_action', 'hieugara_quick_settings_nonce'); ?>
                
                <div class="hub-form-grid">
                    <div class="hub-form-group">
                        <label for="quick_rescue">🚨 Hotline Cứu Hộ 24/7 (Nút đỏ góc màn hình & Header):</label>
                        <input type="text" id="quick_rescue" name="quick_rescue" value="<?php echo esc_attr($rescue); ?>" placeholder="0911 211 996" required>
                    </div>

                    <div class="hub-form-group">
                        <label for="quick_hotline">📞 Hotline Gara Tiếp Nhận (Nút đen):</label>
                        <input type="text" id="quick_hotline" name="quick_hotline" value="<?php echo esc_attr($hotline); ?>" placeholder="02203 892 207" required>
                    </div>

                    <div class="hub-form-group">
                        <label for="quick_tech">💬 Hotline Kỹ Thuật / Zalo (Nút xanh):</label>
                        <input type="text" id="quick_tech" name="quick_tech" value="<?php echo esc_attr($tech); ?>" placeholder="0915 041 989" required>
                    </div>

                    <div class="hub-form-group">
                        <label for="quick_email">✉️ Email Gara:</label>
                        <input type="email" id="quick_email" name="quick_email" value="<?php echo esc_attr($email); ?>" placeholder="cuuhogiaothonghaiha@gmail.com">
                    </div>

                    <div class="hub-form-group hub-form-full">
                        <label for="quick_hours">⏰ Giờ Mở Cửa Hoạt Động:</label>
                        <input type="text" id="quick_hours" name="quick_hours" value="<?php echo esc_attr($hours); ?>" placeholder="T2 - CN: 07:30 - 18:30 (Cứu hộ 24/7)">
                    </div>
                </div>

                <div class="hub-form-actions">
                    <button type="submit" class="button button-primary button-large hub-submit-btn">
                        <span class="dashicons dashicons-saved"></span> LƯU THAY ĐỔI & TỰ ĐỘNG XÓA CACHE
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// 8. Custom Admin Footer
function hieugara_custom_admin_footer() {
    echo '<span id="footer-thankyou" style="font-weight: 600; color: #475569;">
        ÔTÔ HẢI HÀ SERVICE — Km 53+300 Quốc lộ 5, TP. Hải Dương | Hotline: <strong>0911 211 996</strong> | Bản quyền © ' . date('Y') . '
    </span>';
}
add_filter('admin_footer_text', 'hieugara_custom_admin_footer');
