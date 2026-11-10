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
        'title' => '<span class="ab-icon dashicons dashicons-car" style="color:#1d4ed8 !important;"></span> <strong style="color:#fff;font-weight:700;">ÔTÔ HẢI HÀ</strong>',
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
        echo '<div class="notice notice-success is-dismissible" style="border-left-color: #1d4ed8; padding: 12px 16px;">
            <p style="font-size: 15px; margin: 0; font-weight: 600; color: #1e3a8a;">
                <span class="dashicons dashicons-saved" style="vertical-align: middle; margin-right: 6px; color:#1d4ed8;"></span>
                ✅ ĐÃ LƯU THÔNG TIN LIÊN HỆ & TỰ ĐỘNG XÓA BỘ NHỚ ĐỆM THÀNH CÔNG!
            </p>
        </div>';
    }
}
add_action('admin_notices', 'hieugara_admin_customizer_notices');

// 4. Register Botble-Inspired Section Separators
function hieugara_register_botble_menu_separators() {
    global $menu;

    $separators = array(
        array('title' => 'TỔNG QUAN',             'id' => 'botble-sep-overview'),
        array('title' => 'HOẠT ĐỘNG XƯỞNG',       'id' => 'botble-sep-workshop'),
        array('title' => 'DỊCH VỤ & PHỤ KIỆN',    'id' => 'botble-sep-catalog'),
        array('title' => 'NỘI DUNG WEBSITE',      'id' => 'botble-sep-content'),
        array('title' => 'CẤU HÌNH & HỆ THỐNG',   'id' => 'botble-sep-system'),
    );

    foreach ($separators as $sep) {
        $menu[] = array(
            $sep['title'],
            'read',
            $sep['id'],
            '',
            'wp-menu-separator botble-menu-section ' . $sep['id']
        );
    }
}
add_action('admin_menu', 'hieugara_register_botble_menu_separators', 8);

// 5. Simplify & Reorder Admin Menu (Botble Clean Architecture)
function hieugara_reorder_admin_menu($menu_order) {
    return array(
        // Group 1: Tổng quan
        'botble-sep-overview',
        'index.php',                                    // Bảng Điều Khiển

        // Group 2: Hoạt động xưởng
        'botble-sep-workshop',
        'garage-os-bookings',                           // Lịch Hẹn Khách Hàng
        'garage-os-orders',                             // Đơn Sửa Chữa (RO)

        // Group 3: Dịch vụ, Phụ kiện & Thương hiệu (Botble Multi-Menu Architecture)
        'botble-sep-catalog',
        'edit.php?post_type=garage_service',            // Dịch Vụ Kỹ Thuật (Danh mục + Thêm mới + Sửa)
        'edit.php?post_type=garage_accessory',          // Phụ Kiện Ô Tô (Danh mục + Thêm mới + Sửa)
        'hieugara-brand-manager',                       // Quản Lý Thương Hiệu (2 Submenus: Logo Chạy + Đối Tác Toàn Diện)

        // Group 4: Nội dung website
        'botble-sep-content',
        'edit.php?post_type=page',                      // Quản Lý Trang Web
        'edit.php',                                     // Tin Tức & Bài Viết
        'hieugara-media-hub',                           // Thư Viện Ảnh Gara
        'upload.php',                                   // Kho Tệp Tin Media

        // Group 5: Cấu hình hệ thống
        'botble-sep-system',
        'hieugara-theme-settings',                      // Cài Đặt Hotline & Web
        'users.php',                                    // Tài Khoản & Thợ
        'options-general.php',                          // Cài Đặt Hệ Thống
        'themes.php',                                   // Giao Diện
        'plugins.php',                                  // Gói Mở Rộng
        'tools.php',                                    // Công Cụ
    );
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'hieugara_reorder_admin_menu');

// 6. Clean up Menu Items & Rename to Crisp Botble Enterprise Style (No double emojis!)
function hieugara_clean_admin_menu() {
    global $menu, $submenu, $wpdb;

    // Remove clutter menus & disable legacy duplicates
    remove_menu_page('edit-comments.php');            // No blog comments needed for garage
    remove_menu_page('garage-os-kanban');             // Đóng mục Kanban không dùng
    remove_menu_page('garage-os-warranties');         // Đóng mục Sổ Bảo Hành theo yêu cầu
    remove_menu_page('hieugara-accessories-crud');    // Xóa triệt để menu phụ kiện thứ 2 bị trùng
    remove_submenu_page('garage-os-bookings', 'garage-os-kanban');

    // Count pending bookings for notification badge
    $table_bookings = $wpdb->prefix . 'garage_bookings';
    $pending_count = 0;
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_bookings'") === $table_bookings) {
        $pending_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'pending'");
    }
    $booking_badge = $pending_count > 0 ? ' <span class="update-plugins count-' . $pending_count . '"><span class="plugin-count">' . $pending_count . '</span></span>' : '';

    // Rename default menu items to crisp, professional enterprise terms
    foreach ($menu as $key => $value) {
        if (isset($value[2])) {
            switch ($value[2]) {
                case 'index.php':
                    $menu[$key][0] = 'Bảng Điều Khiển';
                    $menu[$key][6] = 'dashicons-dashboard';
                    break;
                case 'garage-os-bookings':
                    $menu[$key][0] = 'Lịch Hẹn Khách Hàng' . $booking_badge;
                    $menu[$key][6] = 'dashicons-calendar-alt';
                    break;
                case 'garage-os-warranties':
                    $menu[$key][0] = 'Sổ Bảo Hành Điện Tử';
                    $menu[$key][6] = 'dashicons-shield';
                    break;
                case 'garage-os-orders':
                    $menu[$key][0] = 'Đơn Sửa Chữa';
                    $menu[$key][6] = 'dashicons-clipboard';
                    break;
                case 'edit.php?post_type=garage_service':
                    $menu[$key][0] = 'Dịch Vụ Kỹ Thuật';
                    $menu[$key][6] = 'dashicons-hammer';
                    break;
                case 'edit.php?post_type=garage_accessory':
                    $menu[$key][0] = 'Phụ Kiện Ô Tô';
                    $menu[$key][6] = 'dashicons-car';
                    break;
                case 'hieugara-brand-manager':
                    $menu[$key][0] = 'Quản Lý Thương Hiệu';
                    $menu[$key][6] = 'dashicons-awards';
                    break;
                case 'edit.php?post_type=page':
                    $menu[$key][0] = 'Quản Lý Trang Web';
                    $menu[$key][6] = 'dashicons-admin-page';
                    break;
                case 'edit.php':
                    $menu[$key][0] = 'Blog & Bài Viết';
                    $menu[$key][6] = 'dashicons-welcome-write-blog';
                    break;
                case 'hieugara-media-hub':
                    $menu[$key][0] = 'Thư Viện Ảnh Gara';
                    $menu[$key][6] = 'dashicons-images-alt2';
                    break;
                case 'upload.php':
                    $menu[$key][0] = 'Kho File Media';
                    $menu[$key][6] = 'dashicons-admin-media';
                    break;
                case 'hieugara-theme-settings':
                    $menu[$key][0] = 'Cài Đặt Hotline & Web';
                    $menu[$key][6] = 'dashicons-admin-generic';
                    break;
                case 'users.php':
                    $menu[$key][0] = 'Tài Khoản & Thợ';
                    $menu[$key][6] = 'dashicons-admin-users';
                    break;
                case 'options-general.php':
                    $menu[$key][0] = 'Cài Đặt Hệ Thống';
                    $menu[$key][6] = 'dashicons-admin-settings';
                    break;
                case 'themes.php':
                    $menu[$key][0] = 'Giao Diện';
                    $menu[$key][6] = 'dashicons-admin-appearance';
                    break;
                case 'plugins.php':
                    $menu[$key][0] = 'Gói Mở Rộng';
                    $menu[$key][6] = 'dashicons-admin-plugins';
                    break;
                case 'tools.php':
                    $menu[$key][0] = 'Công Cụ';
                    $menu[$key][6] = 'dashicons-admin-tools';
                    break;
            }
        }
    }

    // Rename Blog submenus for absolute clarity (CRUD + Categories)
    if (isset($submenu['edit.php'])) {
        foreach ($submenu['edit.php'] as $s_k => $s_v) {
            if ($s_v[2] === 'edit.php') {
                $submenu['edit.php'][$s_k][0] = 'Tất Cả Bài Viết';
            } elseif ($s_v[2] === 'post-new.php') {
                $submenu['edit.php'][$s_k][0] = 'Viết Bài Mới';
            } elseif (strpos($s_v[2], 'taxonomy=category') !== false) {
                $submenu['edit.php'][$s_k][0] = 'Chuyên Mục Blog';
            } elseif (strpos($s_v[2], 'taxonomy=post_tag') !== false) {
                $submenu['edit.php'][$s_k][0] = 'Thẻ Bài Viết (Tags)';
            }
        }
    }
}
add_action('admin_menu', 'hieugara_clean_admin_menu', 999);

// 7. Inject Botble Section Headers & Top Brand Card
function hieugara_admin_botble_sidebar_script() {
    ?>
    <script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            var titles = {
                'botble-sep-overview': 'TỔNG QUAN',
                'botble-sep-workshop': 'HOẠT ĐỘNG XƯỞNG',
                'botble-sep-catalog':  'DỊCH VỤ, PHỤ KIỆN & ĐỐI TÁC',
                'botble-sep-content':  'NỘI DUNG WEBSITE',
                'botble-sep-system':   'HỆ THỐNG & CẤU HÌNH'
            };

            $.each(titles, function(cls, label) {
                var $el = $('#adminmenu li.' + cls);
                if ($el.length) {
                    $el.addClass('botble-section-item').html('<div class="botble-section-label"><span>' + label + '</span></div>');
                }
            });

            // Prepend Botble-style Workspace Brand Header with Collapse Toggle
            if (!$('#adminmenu .botble-brand-card').length) {
                var brandHtml = '<li class="botble-brand-card">' +
                    '<div class="botble-brand-inner">' +
                        '<div class="botble-brand-badge"><span class="dashicons dashicons-car"></span></div>' +
                        '<div class="botble-brand-info">' +
                            '<strong class="botble-brand-title">ÔTÔ HẢI HÀ</strong>' +
                            '<span class="botble-brand-tag">WORKSHOP CMS</span>' +
                        '</div>' +
                        '<button type="button" id="botble-sidebar-toggle" class="botble-collapse-toggle" title="Thu gọn / Mở rộng menu">' +
                            '<span class="dashicons dashicons-menu-alt3"></span>' +
                        '</button>' +
                    '</div>' +
                '</li>';
                $('#adminmenu').prepend(brandHtml);
            }

            // Click Handler for Top Collapse / Expand Sidebar Toggle
            $(document).on('click', '#botble-sidebar-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $wpCollapse = $('#collapse-button');
                if ($wpCollapse.length) {
                    $wpCollapse.trigger('click');
                } else {
                    $('body').toggleClass('folded');
                }
            });

            // Accordion Toggle for Menu Items with Submenus (Sổ ra / Đóng vào)
            $(document).on('click', '#adminmenu > li.wp-has-submenu > a.menu-top', function(e) {
                // If sidebar is collapsed (folded), let native hover flyout work
                if ($('body').hasClass('folded')) {
                    return;
                }

                var $parentLi = $(this).closest('li.wp-has-submenu');
                var $sub = $parentLi.find('> .wp-submenu');

                if ($sub.length) {
                    e.preventDefault();

                    var isOpen = ($parentLi.hasClass('botble-open') || $parentLi.hasClass('wp-menu-open') || $parentLi.hasClass('wp-has-current-submenu')) && !$parentLi.hasClass('botble-closed');

                    if (isOpen) {
                        // Đóng vào
                        $parentLi.removeClass('botble-open wp-menu-open').addClass('botble-closed');
                        $sub.slideUp(160);
                    } else {
                        // Sổ ra độc lập (KHÔNG tự động đóng các menu khác)
                        $parentLi.removeClass('botble-closed').addClass('botble-open');
                        $sub.slideDown(160);
                    }
                }
            });
        });
    })(jQuery);
    </script>
    <?php
}
add_action('admin_footer', 'hieugara_admin_botble_sidebar_script');

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

    // Total accessories count
    $total_accessories = 0;
    $acc_count = wp_count_posts('garage_accessory');
    if (!empty($acc_count->publish)) {
        $total_accessories = (int) $acc_count->publish;
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
                <p>Địa chỉ: Km3 + 500, Nguyễn Lương Bằng, Lê Thanh Nghị, Hải Phòng 170000, Việt Nam | Cứu hộ 24/7 toàn miền Bắc</p>
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

            <a href="<?php echo admin_url('edit.php?post_type=garage_accessory'); ?>" class="hub-kpi-card kpi-green">
                <div class="kpi-icon"><span class="dashicons dashicons-admin-appearance"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Phụ Kiện Ô Tô</span>
                    <strong class="kpi-num"><?php echo esc_html($total_accessories); ?></strong>
                    <span class="kpi-sub">Sản phẩm trên web</span>
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
            <a href="<?php echo admin_url('admin.php?page=hieugara-brand-manager'); ?>" class="shortcut-box">
                <span class="sc-icon dashicons dashicons-awards"></span>
                <strong>Quản Lý Thương Hiệu</strong>
                <small>Logo hãng xe chạy &amp; Đối tác VinFast</small>
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
        ÔTÔ HẢI HÀ SERVICE — Km3 + 500, Nguyễn Lương Bằng, Lê Thanh Nghị, Hải Phòng 170000, Việt Nam | Hotline: <strong>0911 211 996</strong> | Bản quyền © ' . date('Y') . '
    </span>';
}
add_filter('admin_footer_text', 'hieugara_custom_admin_footer');
