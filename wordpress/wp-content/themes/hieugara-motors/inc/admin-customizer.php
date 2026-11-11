<?php
/**
 * Ôtô Hải Hà - Modern Admin Customizer & Dashboard Command Center
 * Tối ưu hóa toàn diện giao diện quản trị WordPress cho Chủ Gara Ôtô Hải Hà
 * Thiết kế thân thiện, dễ nhìn, dễ thao tác (Senior-friendly UI)
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
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('command-palette');
    $wp_admin_bar->remove_node('menu-toggle');
    $wp_admin_bar->remove_node('customize');

    $site_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png';

    // Add Brand Node with Authentic Hải Hà Logo (With strict inline dimensions so it NEVER blows up anywhere)
    $brand_logo_img = '<img src="' . esc_url($site_logo_url) . '" alt="Ôtô Hải Hà" class="hieugara-topbar-logo-img" width="22" height="22" style="width:22px!important;height:22px!important;max-width:22px!important;max-height:22px!important;min-width:22px!important;min-height:22px!important;object-fit:contain!important;border-radius:50%!important;background:#ffffff!important;padding:1px!important;vertical-align:middle!important;display:inline-block!important;margin-right:6px!important;box-shadow:0 1px 3px rgba(0,0,0,0.3)!important;">';

    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-brand',
        'title' => $brand_logo_img . '<strong class="hieugara-topbar-title" style="color:#ffffff!important;font-weight:800!important;font-size:13px!important;letter-spacing:0.5px!important;">ÔTÔ HẢI HÀ</strong>',
        'href'  => admin_url('index.php'),
        'meta'  => array('class' => 'hieugara-topbar-brand')
    ));

    // Add 1-Click Cache Purge button (Clear, friendly, works on both frontend and admin)
    $purge_redirect = is_admin() ? admin_url('index.php?hieugara_action=purge_cache') : add_query_arg('hieugara_action', 'purge_cache');
    $purge_url = wp_nonce_url($purge_redirect, 'hieugara_purge_cache');

    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-purge-cache',
        'title' => '<span class="btn-text" style="font-weight:700!important;font-size:12px!important;">⚡ LÀM MỚI WEB (XÓA CACHE)</span>',
        'href'  => $purge_url,
        'meta'  => array(
            'title' => 'Bấm vào đây để làm mới web ngay lập tức sau khi sửa nội dung',
            'class' => 'hieugara-topbar-cache-btn'
        )
    ));

    // Context-aware Navigation Button:
    // If in Admin -> Link to Frontend ("🚗 Xem Trang Chủ Website")
    // If on Frontend -> Link to Admin Dashboard ("⚙️ Vào Bảng Quản Trị")
    if (is_admin()) {
        $nav_title = '<span class="btn-text" style="font-weight:700!important;font-size:12px!important;">🚗 Xem Trang Chủ Website</span>';
        $nav_url   = home_url('/');
        $nav_target = '_blank';
    } else {
        $nav_title = '<span class="btn-text" style="font-weight:700!important;font-size:12px!important;">⚙️ Vào Bảng Quản Trị</span>';
        $nav_url   = admin_url('index.php');
        $nav_target = '_self';
    }

    $wp_admin_bar->add_node(array(
        'id'    => 'hieugara-view-site',
        'title' => $nav_title,
        'href'  => $nav_url,
        'meta'  => array(
            'target' => $nav_target,
            'class'  => 'hieugara-topbar-view-btn'
        )
    ));

    // Customize user greeting node to fix any corrupted characters
    $user_id = get_current_user_id();
    $my_account = $wp_admin_bar->get_node('my-account');
    if ($my_account) {
        $avatar = get_avatar($user_id, 24, '', 'Quản Trị Viên', array('class' => 'topbar-user-avatar', 'extra_attr' => 'style="width:24px!important;height:24px!important;border-radius:50%!important;vertical-align:middle!important;margin-left:6px!important;"'));
        $my_account->title = '<span class="admin-greeting-text" style="font-size:13px!important;color:#cbd5e1!important;">Xin chào, <strong style="color:#ffffff!important;font-weight:700!important;margin-left:3px!important;">Quản Trị Viên</strong></span> ' . $avatar;
        $wp_admin_bar->add_node($my_account);
    }
}
add_action('admin_bar_menu', 'hieugara_admin_bar_customization', 999);

// Frontend Admin Bar Styling when Admin is logged in
function hieugara_frontend_admin_bar_styles() {
    if (is_admin_bar_showing()) {
        ?>
        <style id="hieugara-frontend-adminbar-css">
        #wpadminbar {
            background: linear-gradient(90deg, #070d18 0%, #0f172a 100%) !important;
            border-bottom: 2px solid #2563eb !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25) !important;
        }
        #wp-admin-bar-command-palette,
        #wp-admin-bar-menu-toggle,
        #wp-admin-bar-customize {
            display: none !important;
        }
        #wpadminbar .hieugara-topbar-brand .ab-item {
            display: inline-flex !important;
            align-items: center !important;
            padding: 0 14px 0 10px !important;
        }
        #wpadminbar .hieugara-topbar-logo-img {
            width: 22px !important;
            height: 22px !important;
            max-width: 22px !important;
            max-height: 22px !important;
            min-width: 22px !important;
            min-height: 22px !important;
            object-fit: contain !important;
            border-radius: 50% !important;
            background: #ffffff !important;
            padding: 1px !important;
            vertical-align: middle !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3) !important;
            margin-right: 6px !important;
            display: inline-block !important;
        }
        #wpadminbar .hieugara-topbar-title {
            color: #ffffff !important;
            font-weight: 800 !important;
            font-size: 13px !important;
        }
        #wpadminbar .hieugara-topbar-cache-btn .ab-item {
            background: rgba(34, 197, 94, 0.18) !important;
            border: 1px solid rgba(34, 197, 94, 0.45) !important;
            border-radius: 6px !important;
            margin: 4px 6px !important;
            height: 24px !important;
            line-height: 24px !important;
            padding: 0 12px !important;
            color: #4ade80 !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        #wpadminbar .hieugara-topbar-cache-btn .ab-item:hover {
            background: #16a34a !important;
            color: #ffffff !important;
        }
        #wpadminbar .hieugara-topbar-view-btn .ab-item {
            background: rgba(37, 99, 235, 0.22) !important;
            border: 1px solid rgba(37, 99, 235, 0.45) !important;
            border-radius: 6px !important;
            margin: 4px 6px !important;
            height: 24px !important;
            line-height: 24px !important;
            padding: 0 12px !important;
            color: #93c5fd !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        #wpadminbar .hieugara-topbar-view-btn .ab-item:hover {
            background: #2563eb !important;
            color: #ffffff !important;
        }
        #wpadminbar #wp-admin-bar-my-account .display-name {
            margin-left: 5px !important;
            font-weight: 700 !important;
            color: #ffffff !important;
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'hieugara_frontend_admin_bar_styles');

// Translate default Howdy to Vietnamese Xin chào
add_filter('gettext', function($translation, $text) {
    if ($text === 'Howdy, %s') {
        return 'Xin chào, %s';
    }
    return $translation;
}, 10, 2);

// 3. Handle Admin 1-Click Cache Purge Request
function hieugara_handle_admin_actions() {
    if (isset($_GET['hieugara_action']) && $_GET['hieugara_action'] === 'purge_cache') {
        if (check_admin_referer('hieugara_purge_cache') && current_user_can('manage_options')) {
            hieugara_purge_page_cache();
            $redirect_url = is_admin() ? admin_url('index.php?hieugara_cache_purged=1') : remove_query_arg(array('hieugara_action', '_wpnonce'), wp_get_referer() ? wp_get_referer() : home_url('/?hieugara_cache_purged=1'));
            wp_safe_redirect($redirect_url);
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
add_action('init', 'hieugara_handle_admin_actions');

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

// 4. Register 3 Clear, Intuitive Senior-Friendly Section Separators
function hieugara_register_botble_menu_separators() {
    global $menu;

    $separators = array(
        array('title' => 'TỔNG QUAN',             'id' => 'botble-sep-overview'),
        array('title' => 'QUẢN LÝ NỘI DUNG',      'id' => 'botble-sep-catalog'),
        array('title' => 'CÀI ĐẶT WEBSITE',       'id' => 'botble-sep-system'),
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

// 5. Simplify & Reorder Admin Menu into 3 Intuitive Groups
function hieugara_register_redirection_menu() {
    add_menu_page(
        'Chuyển Hướng 301',
        'Chuyển Hướng 301',
        'manage_options',
        'tools.php?page=redirection.php',
        '',
        'dashicons-randomize',
        75
    );
}
add_action('admin_menu', 'hieugara_register_redirection_menu', 9);

function hieugara_reorder_admin_menu($menu_order) {
    return array(
        // Group 1: Tổng quan
        'botble-sep-overview',
        'index.php',                                    // Bảng Điều Khiển

        // Group 2: Quản lý nội dung & sản phẩm
        'botble-sep-catalog',
        'edit.php?post_type=garage_accessory',          // Phụ Kiện Ô Tô (Ưu tiên đưa lên đầu)
        'edit.php?post_type=garage_service',            // Dịch Vụ Gara
        'edit.php',                                     // Blog & Tin Tức
        'hieugara-media-hub',                           // Thư Viện Ảnh Gara
        'hieugara-brand-manager',                       // Logo Hãng Xe Đối Tác
        'edit.php?post_type=page',                      // Quản Lý Trang Web

        // Group 3: Cài đặt website
        'botble-sep-system',
        'hieugara-theme-settings',                      // Cài Đặt Hotline & Web
        'tools.php?page=redirection.php',               // Chuyển Hướng 301 (Tự động bắt link cũ)
        'plugins.php',                                  // Cài Đặt Plugin
        'users.php',                                    // Tài Khoản Quản Trị
    );
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'hieugara_reorder_admin_menu');

// 6. Clean up Menu Items & Rename to Clear Vietnamese Terms
function hieugara_clean_admin_menu() {
    global $menu, $submenu;

    // Remove technical clutter & unneeded menus that confuse users
    remove_menu_page('garage-os-orders');             // Ẩn đơn tiếp nhận ERP không dùng
    remove_menu_page('garage-os-kanban');             // Đóng mục Kanban không dùng
    remove_menu_page('garage-os-warranties');         // Đóng mục Sổ Bảo Hành
    remove_menu_page('garage-os-bookings');           // Xóa menu Lịch Hẹn
    remove_menu_page('hieugara-accessories-crud');    // Xóa menu phụ kiện thứ 2 bị trùng
    remove_menu_page('edit-comments.php');            // Không dùng bình luận blog
    remove_menu_page('tools.php');                    // Công cụ kỹ thuật phức tạp
    remove_menu_page('themes.php');                   // Tùy biến qua Cài Đặt Hotline & Web
    remove_menu_page('upload.php');                   // Đã có Thư Viện Ảnh Gara trực quan
    remove_menu_page('options-general.php');          // Tránh cấu hình nhầm URL hệ thống
    remove_menu_page('options-permalink.php');        // Ẩn menu đường dẫn
    remove_menu_page('nav-menus.php');                // Ẩn menu quản lý menu WP
    remove_menu_page('hieugara-seo-links');           // Đã tích hợp trong Cài Đặt Hotline & Web
    remove_menu_page('hieugara-nav-manager');         // Đã tích hợp trong Cài Đặt Hotline & Web
    remove_submenu_page('index.php', 'update-core.php'); // Ẩn mục Updates của WP

    // Remove any leftover native WordPress blank separators so only our 3 section headers remain
    foreach ($menu as $k => $v) {
        if (isset($v[4]) && strpos($v[4], 'wp-menu-separator') !== false && strpos($v[4], 'botble-sep-') === false) {
            unset($menu[$k]);
        }
    }

    // Rename default menu items to crisp, clear Vietnamese terms
    foreach ($menu as $key => $value) {
        if (isset($value[2])) {
            switch ($value[2]) {
                case 'index.php':
                    $menu[$key][0] = 'Bảng Điều Khiển';
                    $menu[$key][6] = 'dashicons-dashboard';
                    break;
                case 'edit.php?post_type=garage_accessory':
                    $menu[$key][0] = 'Phụ Kiện Ô Tô';
                    $menu[$key][6] = 'dashicons-car';
                    break;
                case 'edit.php?post_type=garage_service':
                    $menu[$key][0] = 'Dịch Vụ Gara';
                    $menu[$key][6] = 'dashicons-hammer';
                    break;
                case 'edit.php':
                    $menu[$key][0] = 'Bài Viết & Tin Tức';
                    $menu[$key][6] = 'dashicons-welcome-write-blog';
                    break;
                case 'hieugara-media-hub':
                    $menu[$key][0] = 'Thư Viện Ảnh Gara';
                    $menu[$key][6] = 'dashicons-images-alt2';
                    break;
                case 'hieugara-brand-manager':
                    $menu[$key][0] = 'Logo Hãng Xe Đối Tác';
                    $menu[$key][6] = 'dashicons-awards';
                    break;
                case 'edit.php?post_type=page':
                    $menu[$key][0] = 'Quản Lý Trang Web';
                    $menu[$key][6] = 'dashicons-admin-page';
                    break;
                case 'hieugara-theme-settings':
                    $menu[$key][0] = 'Cài Đặt Hotline & Web';
                    $menu[$key][6] = 'dashicons-admin-generic';
                    break;
                case 'tools.php?page=redirection.php':
                    $menu[$key][0] = 'Chuyển Hướng 301';
                    $menu[$key][6] = 'dashicons-randomize';
                    break;
                case 'plugins.php':
                    $menu[$key][0] = 'Cài Đặt Plugin';
                    $menu[$key][6] = 'dashicons-admin-plugins';
                    break;
                case 'users.php':
                    $menu[$key][0] = 'Tài Khoản Quản Trị';
                    $menu[$key][6] = 'dashicons-admin-users';
                    break;
            }
        }
    }

    // Rename Plugins submenus
    if (isset($submenu['plugins.php'])) {
        foreach ($submenu['plugins.php'] as $s_k => $s_v) {
            if ($s_v[2] === 'plugins.php') {
                $submenu['plugins.php'][$s_k][0] = 'Plugin Đã Cài Đặt';
            } elseif ($s_v[2] === 'plugin-install.php') {
                $submenu['plugins.php'][$s_k][0] = '➕ Cài Plugin Mới';
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
                $submenu['edit.php'][$s_k][0] = 'Chuyên Mục Tin Tức';
            } elseif (strpos($s_v[2], 'taxonomy=post_tag') !== false) {
                $submenu['edit.php'][$s_k][0] = 'Thẻ Bài Viết (Tags)';
            }
        }
    }

    // Rename Accessory submenus
    if (isset($submenu['edit.php?post_type=garage_accessory'])) {
        foreach ($submenu['edit.php?post_type=garage_accessory'] as $s_k => $s_v) {
            if ($s_v[2] === 'edit.php?post_type=garage_accessory') {
                $submenu['edit.php?post_type=garage_accessory'][$s_k][0] = 'Tất Cả Phụ Kiện';
            } elseif ($s_v[2] === 'post-new.php?post_type=garage_accessory') {
                $submenu['edit.php?post_type=garage_accessory'][$s_k][0] = 'Thêm Phụ Kiện Mới';
            } elseif (strpos($s_v[2], 'taxonomy=accessory_category') !== false) {
                $submenu['edit.php?post_type=garage_accessory'][$s_k][0] = 'Danh Mục Phụ Kiện';
            }
        }
    }

    // Rename Service submenus
    if (isset($submenu['edit.php?post_type=garage_service'])) {
        foreach ($submenu['edit.php?post_type=garage_service'] as $s_k => $s_v) {
            if ($s_v[2] === 'edit.php?post_type=garage_service') {
                $submenu['edit.php?post_type=garage_service'][$s_k][0] = 'Tất Cả Dịch Vụ';
            } elseif ($s_v[2] === 'post-new.php?post_type=garage_service') {
                $submenu['edit.php?post_type=garage_service'][$s_k][0] = 'Thêm Dịch Vụ Mới';
            } elseif (strpos($s_v[2], 'taxonomy=service_category') !== false) {
                $submenu['edit.php?post_type=garage_service'][$s_k][0] = 'Nhóm Dịch Vụ';
            }
        }
    }
}
add_action('admin_menu', 'hieugara_clean_admin_menu', 999);

// 7. Inject Section Headers & Top Brand Card
function hieugara_admin_botble_sidebar_script() {
    $site_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png';
    ?>
    <script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            var titles = {
                'botble-sep-overview': 'TỔNG QUAN',
                'botble-sep-catalog':  'QUẢN LÝ NỘI DUNG',
                'botble-sep-system':   'CÀI ĐẶT WEBSITE'
            };

            $.each(titles, function(cls, label) {
                var $el = $('#adminmenu li.' + cls);
                if ($el.length) {
                    $el.addClass('botble-section-item').html('<div class="botble-section-label"><span>' + label + '</span></div>');
                }
            });

            // Prepend Workspace Brand Header with Official Hải Hà Logo
            if (!$('#adminmenu .botble-brand-card').length) {
                var brandHtml = '<li class="botble-brand-card">' +
                    '<div class="botble-brand-inner">' +
                        '<div class="botble-brand-badge"><img src="<?php echo esc_url($site_logo_url); ?>" alt="Ôtô Hải Hà" class="botble-brand-logo-img"></div>' +
                        '<div class="botble-brand-info">' +
                            '<strong class="botble-brand-title">ÔTÔ HẢI HÀ</strong>' +
                            '<span class="botble-brand-tag">QUẢN TRỊ WEBSITE</span>' +
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
                        $parentLi.removeClass('botble-open wp-menu-open').addClass('botble-closed');
                        $sub.slideUp(160);
                    } else {
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

// 8. Replace Default Dashboard with Ôtô Hải Hà Command Center
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

// 9. Render Dashboard Command Center Widget
function hieugara_render_dashboard_hub_widget() {
    // Stats
    $total_services = (int) (wp_count_posts('garage_service')->publish ?? 0);
    $total_accessories = (int) (wp_count_posts('garage_accessory')->publish ?? 0);
    $total_posts = (int) (wp_count_posts('post')->publish ?? 0);

    // Contact options & Site Logo
    $site_logo_url = function_exists('hieugara_get_site_logo') ? hieugara_get_site_logo() : get_template_directory_uri() . '/assets/images/haiha-logo.png';
    $hotline = hieugara_hotline_phone();
    $rescue  = hieugara_rescue_phone();
    $tech    = hieugara_tech_phone();
    $email   = get_option('hieugara_topbar_email', 'cuuhogiaothonghaiha@gmail.com');
    $hours   = get_option('hieugara_topbar_hours', 'T2 - CN: 07:30 - 18:30 (Cứu hộ 24/7)');
    $purge_url = wp_nonce_url(admin_url('index.php?hieugara_action=purge_cache'), 'hieugara_purge_cache');
    ?>
    <div class="hieugara-hub-wrap">
        <!-- Top Banner with Official Brand Logo -->
        <div class="hieugara-hub-banner">
            <div class="hieugara-hub-banner-main">
                <div class="hieugara-hub-banner-logo">
                    <img src="<?php echo esc_url($site_logo_url); ?>" alt="Ôtô Hải Hà" class="hub-banner-logo-img">
                </div>
                <div class="hieugara-hub-banner-content">
                    <span class="hub-badge">HỆ THỐNG QUẢN LÝ ÔTÔ HẢI HÀ</span>
                    <h2>TRUNG TÂM QUẢN TRỊ WEBSITE</h2>
                    <p>Giao diện trực quan, dễ dùng cho mọi lứa tuổi — Thay đổi nội dung, phụ kiện, số điện thoại & hình ảnh tức thì.</p>
                </div>
            </div>
            <div class="hieugara-hub-banner-actions">
                <a href="<?php echo esc_url($purge_url); ?>" class="hub-btn hub-btn-cache" title="Bấm vào đây để làm mới web ngay lập tức">
                    <span class="dashicons dashicons-update"></span> ⚡ LÀM MỚI WEB (XÓA CACHE)
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="hub-btn hub-btn-view">
                    <span class="dashicons dashicons-external"></span> 🚗 XEM TRANG CHỦ WEBSITE
                </a>
            </div>
        </div>

        <!-- 3 Balanced Metric Cards (KPIs) -->
        <div class="hieugara-hub-kpis">
            <a href="<?php echo admin_url('edit.php?post_type=garage_accessory'); ?>" class="hub-kpi-card kpi-green">
                <div class="kpi-icon"><span class="dashicons dashicons-car"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Phụ Kiện Ô Tô</span>
                    <strong class="kpi-num"><?php echo esc_html($total_accessories); ?></strong>
                    <span class="kpi-sub">Sản phẩm phụ kiện đang bán</span>
                </div>
                <div class="kpi-arrow"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
            </a>

            <a href="<?php echo admin_url('edit.php?post_type=garage_service'); ?>" class="hub-kpi-card kpi-blue">
                <div class="kpi-icon"><span class="dashicons dashicons-hammer"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Dịch Vụ Gara</span>
                    <strong class="kpi-num"><?php echo esc_html($total_services); ?></strong>
                    <span class="kpi-sub">Gói sửa chữa & bảo dưỡng xe</span>
                </div>
                <div class="kpi-arrow"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
            </a>

            <a href="<?php echo admin_url('edit.php'); ?>" class="hub-kpi-card kpi-purple">
                <div class="kpi-icon"><span class="dashicons dashicons-welcome-write-blog"></span></div>
                <div class="kpi-info">
                    <span class="kpi-label">Bài Viết & Tin Tức</span>
                    <strong class="kpi-num"><?php echo esc_html($total_posts); ?></strong>
                    <span class="kpi-sub">Bài viết kinh nghiệm & mẹo xe</span>
                </div>
                <div class="kpi-arrow"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
            </a>
        </div>

        <!-- 6 Balanced Quick Action Cards (Lưới 3 cột x 2 hàng hoàn hảo) -->
        <h3 class="hub-section-title"><span class="dashicons dashicons-star-filled"></span> PHÍM TẮT THAO TÁC 1 CHẠM DÀNH CHO QUẢN TRỊ VIÊN</h3>
        <div class="hieugara-hub-shortcuts">
            <a href="<?php echo admin_url('post-new.php?post_type=garage_accessory'); ?>" class="shortcut-box sc-box-green">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-car"></span></div>
                <strong>➕ Thêm Phụ Kiện Mới</strong>
                <small>Đăng camera, màn hình, thảm sàn, phụ kiện VinFast...</small>
            </a>

            <a href="<?php echo admin_url('post-new.php?post_type=garage_service'); ?>" class="shortcut-box sc-box-blue">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-hammer"></span></div>
                <strong>➕ Thêm Dịch Vụ Mới</strong>
                <small>Thêm gói bảo dưỡng, cứu hộ, đồng sơn mới lên web</small>
            </a>

            <a href="<?php echo admin_url('admin.php?page=hieugara-theme-settings#hero'); ?>" class="shortcut-box sc-box-amber">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-images-alt2"></span></div>
                <strong>🖼️ Thay Banner & Slider</strong>
                <small>Thay đổi hình ảnh lớn chạy đầu trang chủ & banner</small>
            </a>

            <a href="<?php echo admin_url('admin.php?page=hieugara-theme-settings#contact'); ?>" class="shortcut-box sc-box-red">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-phone"></span></div>
                <strong>📞 Cài Đặt Hotline & Địa Chỉ</strong>
                <small>Đổi số điện thoại cứu hộ, hotline xưởng, địa chỉ & email</small>
            </a>

            <a href="<?php echo admin_url('post-new.php'); ?>" class="shortcut-box sc-box-purple">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-edit-large"></span></div>
                <strong>✍️ Viết Bài Tin Tức / Blog</strong>
                <small>Đăng bài viết mẹo xe, kinh nghiệm lái xe và tin tức</small>
            </a>

            <a href="<?php echo admin_url('admin.php?page=hieugara-brand-manager'); ?>" class="shortcut-box sc-box-teal">
                <div class="sc-icon-wrap"><span class="sc-icon dashicons dashicons-awards"></span></div>
                <strong>🏷️ Quản Lý Logo Hãng Xe</strong>
                <small>Logo hãng xe hợp tác & đối tác VinFast chạy trang chủ</small>
            </a>
        </div>

        <!-- Quick Hotline & Contact Info Updater -->
        <div class="hieugara-hub-quicksettings">
            <div class="hub-qs-header">
                <div class="hub-qs-title-wrap">
                    <h3 class="hub-section-title" style="margin:0;"><span class="dashicons dashicons-phone"></span> CẬP NHẬT NHANH SỐ ĐIỆN THOẠI & GIỜ LÀM VIỆC (LƯU TỨC THÌ)</h3>
                    <p style="margin:4px 0 0 0; color:#64748b; font-size:13.5px;">Chỉ cần sửa số điện thoại tại đây và nhấn nút Lưu, website sẽ tự động cập nhật ngay lập tức.</p>
                </div>
            </div>
            
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
                        <label for="quick_email">✉️ Email Xưởng Gara:</label>
                        <input type="email" id="quick_email" name="quick_email" value="<?php echo esc_attr($email); ?>" placeholder="cuuhogiaothonghaiha@gmail.com">
                    </div>

                    <div class="hub-form-group hub-form-full">
                        <label for="quick_hours">⏰ Thời Gian Hoạt Động Của Xưởng:</label>
                        <input type="text" id="quick_hours" name="quick_hours" value="<?php echo esc_attr($hours); ?>" placeholder="T2 - CN: 07:30 - 18:30 (Cứu hộ 24/7)">
                    </div>
                </div>

                <div class="hub-form-actions">
                    <button type="submit" class="button button-primary button-large hub-submit-btn">
                        <span class="dashicons dashicons-saved"></span> 💾 LƯU THAY ĐỔI & LÀM MỚI TOÀN BỘ WEBSITE NGAY
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// 10. Custom Admin Footer
function hieugara_custom_admin_footer() {
    echo '<span id="footer-thankyou" style="font-weight: 600; color: #475569;">
        ÔTÔ HẢI HÀ SERVICE — Km3 + 500, Nguyễn Lương Bằng, Lê Thanh Nghị, Hải Phòng 170000, Việt Nam | Hotline: <strong>0911 211 996</strong> | Bản quyền © ' . date('Y') . '
    </span>';
}
add_filter('admin_footer_text', 'hieugara_custom_admin_footer');
