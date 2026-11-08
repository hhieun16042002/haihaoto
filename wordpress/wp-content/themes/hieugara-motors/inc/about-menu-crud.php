<?php
/**
 * Ôtô Hải Hà - Quản Lý Menu & Điều Hướng Toàn Diện (Full Navigation & Submenu Manager)
 * 
 * Tính năng chính:
 * 1. Menu Admin riêng cấp 1 "🧭 Quản Lý Menu" trực quan, tiện lợi ngay thanh điều hướng trái.
 * 2. BẬT / TẮT hiển thị cho TẤT CẢ các mục Menu chính trên Header:
 *    - Trang Chủ, Giới Thiệu, Dịch Vụ, Phụ Kiện, Blog, Liên Hệ, Nút Cứu Hộ 24/7, Ô Tìm Kiếm SEO.
 *    - Tùy chỉnh nhãn chữ hiển thị (Label) cho từng mục.
 * 3. Quản lý danh mục / mục con của dropdown "GIỚI THIỆU" (Full CRUD: Thêm, Sửa, Xoá, Bật/Tắt, Sắp xếp).
 * 4. Quản lý danh mục / mục con của dropdown "LIÊN HỆ" (Full CRUD: Thêm, Sửa, Xoá, Bật/Tắt, Sắp xếp).
 * 5. Bật / Tắt mục Dịch Vụ Xe VinFast trong dropdown Dịch Vụ.
 * 6. Tùy biến nội dung & Bật/Tắt các khối trong trang "Về Chúng Tôi" (Giới thiệu).
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * =========================================================================
 * 1. GIÁ TRỊ MẶC ĐỊNH MENU GIỚI THIỆU & MENU LIÊN HỆ
 * =========================================================================
 */

function hieugara_get_default_about_menu_items() {
    return array(
        'item_1' => array(
            'id'     => 'item_1',
            'title'  => 'Về Chúng Tôi',
            'link'   => home_url('/ve-chung-toi/'),
            'icon'   => 'fa-solid fa-building',
            'target' => '_self',
            'enable' => '1',
            'order'  => 1,
        ),
        'item_2' => array(
            'id'     => 'item_2',
            'title'  => 'Sự Kiện Hải Hà',
            'link'   => home_url('/ve-chung-toi/#su-kien'),
            'icon'   => 'fa-solid fa-bullhorn',
            'target' => '_self',
            'enable' => '1',
            'order'  => 2,
        ),
        'item_3' => array(
            'id'     => 'item_3',
            'title'  => 'Tiêu Chuẩn & Chứng Nhận Dịch Vụ',
            'link'   => home_url('/ve-chung-toi/#tieu-chuan'),
            'icon'   => 'fa-solid fa-certificate',
            'target' => '_self',
            'enable' => '1',
            'order'  => 3,
        ),
    );
}

function hieugara_get_about_menu_items() {
    $items = get_option('hieugara_about_menu_items');
    if ($items === false || !is_array($items) || empty($items)) {
        $items = hieugara_get_default_about_menu_items();
    }
    
    // Sắp xếp theo order
    uasort($items, function($a, $b) {
        $oa = isset($a['order']) ? intval($a['order']) : 0;
        $ob = isset($b['order']) ? intval($b['order']) : 0;
        if ($oa === $ob) return 0;
        return ($oa < $ob) ? -1 : 1;
    });

    foreach ($items as &$item) {
        if (!empty($item['link']) && function_exists('hieugara_sanitize_nav_url')) {
            $item['link'] = hieugara_sanitize_nav_url($item['link']);
        }
    }

    return $items;
}

function hieugara_get_default_contact_menu_items() {
    return array(
        'item_1' => array(
            'id'     => 'item_1',
            'title'  => 'Hotline Tư Vấn: 02203 892 207',
            'link'   => 'tel:02203892207',
            'icon'   => 'fa-solid fa-phone-volume',
            'target' => '_self',
            'enable' => '1',
            'order'  => 1,
        ),
        'item_2' => array(
            'id'     => 'item_2',
            'title'  => 'Cứu Hộ 24/7: 0911 211 996',
            'link'   => 'tel:0911211996',
            'icon'   => 'fa-solid fa-truck-pickup',
            'target' => '_self',
            'enable' => '1',
            'order'  => 2,
        ),
        'item_3' => array(
            'id'     => 'item_3',
            'title'  => 'Gara Ô Tô Hải Hà',
            'link'   => home_url('/ve-chung-toi/'),
            'icon'   => 'fa-solid fa-location-dot',
            'target' => '_self',
            'enable' => '1',
            'order'  => 3,
        ),
        'item_4' => array(
            'id'     => 'item_4',
            'title'  => 'Hợp Tác Đối Tác & Bảo Hiểm',
            'link'   => home_url('/ve-chung-toi/#hop-tac'),
            'icon'   => 'fa-solid fa-handshake',
            'target' => '_self',
            'enable' => '1',
            'order'  => 4,
        ),
    );
}

function hieugara_get_contact_menu_items() {
    $items = get_option('hieugara_contact_menu_items');
    if ($items === false || !is_array($items) || empty($items)) {
        $items = hieugara_get_default_contact_menu_items();
    }
    
    uasort($items, function($a, $b) {
        $oa = isset($a['order']) ? intval($a['order']) : 0;
        $ob = isset($b['order']) ? intval($b['order']) : 0;
        if ($oa === $ob) return 0;
        return ($oa < $ob) ? -1 : 1;
    });

    foreach ($items as &$item) {
        if (!empty($item['link']) && function_exists('hieugara_sanitize_nav_url')) {
            $item['link'] = hieugara_sanitize_nav_url($item['link']);
        }
    }

    return $items;
}

/**
 * =========================================================================
 * 2. ĐĂNG KÝ MENU QUẢN TRỊ TRONG WP-ADMIN (MENU CẤP 1 RIÊNG)
 * =========================================================================
 */
function hieugara_register_navigation_admin_menu() {
    // Menu Cấp 1 "🧭 Quản Lý Menu"
    add_menu_page(
        __('Quản Lý Menu & Điều Hướng', 'hieugara-motors'),
        __('🧭 Quản Lý Menu', 'hieugara-motors'),
        'manage_options',
        'hieugara-nav-manager',
        'hieugara_render_nav_manager_page',
        'dashicons-menu-alt3',
        27
    );

    // Submenu 1: Bật / Tắt Menu Chính
    add_submenu_page(
        'hieugara-nav-manager',
        __('Bật / Tắt Menu Chính', 'hieugara-motors'),
        __('🎛️ Bật / Tắt Menu Chính', 'hieugara-motors'),
        'manage_options',
        'hieugara-nav-manager',
        'hieugara_render_nav_manager_page'
    );

    // Submenu 2: Menu Giới Thiệu
    add_submenu_page(
        'hieugara-nav-manager',
        __('Menu Giới Thiệu', 'hieugara-motors'),
        __('📋 Menu Giới Thiệu', 'hieugara-motors'),
        'manage_options',
        'hieugara-about-menu-crud',
        'hieugara_render_about_menu_redirect'
    );

    // Submenu 3: Menu Liên Hệ
    add_submenu_page(
        'hieugara-nav-manager',
        __('Menu Liên Hệ', 'hieugara-motors'),
        __('📞 Menu Liên Hệ', 'hieugara-motors'),
        'manage_options',
        'hieugara-contact-menu-crud',
        'hieugara_render_contact_menu_redirect'
    );

    // Submenu 4: Tùy Biến Trang Giới Thiệu
    add_submenu_page(
        'hieugara-nav-manager',
        __('Tùy Biến Trang Giới Thiệu', 'hieugara-motors'),
        __('🏢 Trang Về Chúng Tôi', 'hieugara-motors'),
        'manage_options',
        'hieugara-about-content',
        'hieugara_render_about_content_redirect'
    );
}
add_action('admin_menu', 'hieugara_register_navigation_admin_menu', 20);

function hieugara_render_about_menu_redirect() {
    echo '<script>window.location.href="' . admin_url('admin.php?page=hieugara-nav-manager&tab=about') . '";</script>';
}
function hieugara_render_contact_menu_redirect() {
    echo '<script>window.location.href="' . admin_url('admin.php?page=hieugara-nav-manager&tab=contact') . '";</script>';
}
function hieugara_render_about_content_redirect() {
    echo '<script>window.location.href="' . admin_url('admin.php?page=hieugara-nav-manager&tab=page_about') . '";</script>';
}

/**
 * =========================================================================
 * 3. XỬ LÝ ACTIONS (LƯU MASTER TOGGLES, CRUD GIỚI THIỆU, CRUD LIÊN HỆ, PAGE ABOUT)
 * =========================================================================
 */
function hieugara_handle_nav_manager_actions() {
    if (!isset($_POST['hieugara_nav_action']) && !isset($_GET['hieugara_nav_action'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die(__('Bạn không có quyền thực hiện thao tác này.', 'hieugara-motors'));
    }

    $action = sanitize_text_field($_POST['hieugara_nav_action'] ?? $_GET['hieugara_nav_action']);
    $tab    = sanitize_text_field($_POST['current_tab'] ?? $_GET['tab'] ?? 'master');

    // 1. Lưu Cấu Hình Bật/Tắt Menu Chính (Master Toggles)
    if ($action === 'save_master_nav') {
        check_admin_referer('hieugara_master_nav_nonce');

        // Bật / Tắt từng mục
        update_option('hieugara_nav_show_home', !empty($_POST['nav_show_home']) ? '1' : '0');
        update_option('hieugara_nav_show_about', !empty($_POST['nav_show_about']) ? '1' : '0');
        update_option('hieugara_nav_show_services', !empty($_POST['nav_show_services']) ? '1' : '0');
        update_option('hieugara_nav_show_vinfast', !empty($_POST['nav_show_vinfast']) ? '1' : '0');
        update_option('hieugara_nav_show_accessories', !empty($_POST['nav_show_accessories']) ? '1' : '0');
        update_option('hieugara_nav_show_blog', !empty($_POST['nav_show_blog']) ? '1' : '0');
        update_option('hieugara_nav_show_contact', !empty($_POST['nav_show_contact']) ? '1' : '0');
        update_option('hieugara_nav_show_rescue_btn', !empty($_POST['nav_show_rescue_btn']) ? '1' : '0');
        update_option('hieugara_nav_show_search', !empty($_POST['nav_show_search']) ? '1' : '0');

        // Nhãn tùy biến (Label)
        update_option('hieugara_nav_label_home', sanitize_text_field($_POST['nav_label_home'] ?? 'TRANG CHỦ'));
        update_option('hieugara_nav_label_about', sanitize_text_field($_POST['nav_label_about'] ?? 'GIỚI THIỆU'));
        update_option('hieugara_nav_label_services', sanitize_text_field($_POST['nav_label_services'] ?? 'DỊCH VỤ'));
        update_option('hieugara_nav_label_accessories', sanitize_text_field($_POST['nav_label_accessories'] ?? 'PHỤ KIỆN'));
        update_option('hieugara_nav_label_blog', sanitize_text_field($_POST['nav_label_blog'] ?? 'BLOG'));
        update_option('hieugara_nav_label_contact', sanitize_text_field($_POST['nav_label_contact'] ?? 'LIÊN HỆ'));

        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }

        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'master', 'msg' => 'master_saved'), admin_url('admin.php')));
        exit;
    }

    // 2. CRUD Menu Giới Thiệu
    $about_items = hieugara_get_about_menu_items();

    if ($action === 'save_about_item') {
        check_admin_referer('hieugara_about_item_nonce');

        $item_id = !empty($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : ('item_' . time());
        $title   = sanitize_text_field($_POST['title'] ?? '');
        $link    = esc_url_raw($_POST['link'] ?? '');
        $icon    = sanitize_text_field($_POST['icon'] ?? '');
        $target  = in_array($_POST['target'] ?? '_self', array('_self', '_blank')) ? $_POST['target'] : '_self';
        $order   = intval($_POST['order'] ?? 1);
        $enable  = !empty($_POST['enable']) ? '1' : '0';

        if (empty($title) || empty($link)) {
            wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'msg' => 'missing_fields'), admin_url('admin.php')));
            exit;
        }

        $about_items[$item_id] = array(
            'id'     => $item_id,
            'title'  => $title,
            'link'   => $link,
            'icon'   => $icon,
            'target' => $target,
            'order'  => $order,
            'enable' => $enable,
        );

        update_option('hieugara_about_menu_items', $about_items);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }

        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'msg' => 'about_saved'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'toggle_about_item') {
        check_admin_referer('hieugara_about_toggle_nonce');
        $item_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($about_items[$item_id])) {
            $about_items[$item_id]['enable'] = empty($about_items[$item_id]['enable']) ? '1' : '0';
            update_option('hieugara_about_menu_items', $about_items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'msg' => 'toggle_success'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'delete_about_item') {
        check_admin_referer('hieugara_about_del_nonce');
        $del_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($about_items[$del_id])) {
            unset($about_items[$del_id]);
            update_option('hieugara_about_menu_items', $about_items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'msg' => 'del_success'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'reset_about_defaults') {
        check_admin_referer('hieugara_about_reset_nonce');
        update_option('hieugara_about_menu_items', hieugara_get_default_about_menu_items());
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'msg' => 'reset_success'), admin_url('admin.php')));
        exit;
    }

    // 3. CRUD Menu Liên Hệ
    $contact_items = hieugara_get_contact_menu_items();

    if ($action === 'save_contact_item') {
        check_admin_referer('hieugara_contact_item_nonce');

        $item_id = !empty($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : ('item_' . time());
        $title   = sanitize_text_field($_POST['title'] ?? '');
        $link    = sanitize_text_field($_POST['link'] ?? '');
        $icon    = sanitize_text_field($_POST['icon'] ?? '');
        $target  = in_array($_POST['target'] ?? '_self', array('_self', '_blank')) ? $_POST['target'] : '_self';
        $order   = intval($_POST['order'] ?? 1);
        $enable  = !empty($_POST['enable']) ? '1' : '0';

        if (empty($title) || empty($link)) {
            wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'msg' => 'missing_fields'), admin_url('admin.php')));
            exit;
        }

        $contact_items[$item_id] = array(
            'id'     => $item_id,
            'title'  => $title,
            'link'   => $link,
            'icon'   => $icon,
            'target' => $target,
            'order'  => $order,
            'enable' => $enable,
        );

        update_option('hieugara_contact_menu_items', $contact_items);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }

        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'msg' => 'contact_saved'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'toggle_contact_item') {
        check_admin_referer('hieugara_contact_toggle_nonce');
        $item_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($contact_items[$item_id])) {
            $contact_items[$item_id]['enable'] = empty($contact_items[$item_id]['enable']) ? '1' : '0';
            update_option('hieugara_contact_menu_items', $contact_items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'msg' => 'toggle_success'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'delete_contact_item') {
        check_admin_referer('hieugara_contact_del_nonce');
        $del_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($contact_items[$del_id])) {
            unset($contact_items[$del_id]);
            update_option('hieugara_contact_menu_items', $contact_items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'msg' => 'del_success'), admin_url('admin.php')));
        exit;
    }

    if ($action === 'reset_contact_defaults') {
        check_admin_referer('hieugara_contact_reset_nonce');
        update_option('hieugara_contact_menu_items', hieugara_get_default_contact_menu_items());
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'msg' => 'reset_success'), admin_url('admin.php')));
        exit;
    }

    // 4. Lưu Tùy Biến Trang Về Chúng Tôi (Giới Thiệu)
    if ($action === 'save_about_page_content') {
        check_admin_referer('hieugara_about_page_nonce');

        update_option('hieugara_about_page_title', sanitize_text_field($_POST['about_page_title'] ?? 'Ôtô Hải Hà: 31 Năm Giữ Trọn Chữ Tâm Với Nghề'));
        update_option('hieugara_about_page_subtitle', sanitize_textarea_field($_POST['about_page_subtitle'] ?? ''));
        update_option('hieugara_about_show_story', !empty($_POST['about_show_story']) ? '1' : '0');
        update_option('hieugara_about_show_commitments', !empty($_POST['about_show_commitments']) ? '1' : '0');
        update_option('hieugara_about_years_exp', sanitize_text_field($_POST['about_years_exp'] ?? '31+'));
        update_option('hieugara_about_staff_count', sanitize_text_field($_POST['about_staff_count'] ?? '80+'));
        update_option('hieugara_about_parts_rate', sanitize_text_field($_POST['about_parts_rate'] ?? '100%'));

        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }

        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'page_about', 'msg' => 'page_about_saved'), admin_url('admin.php')));
        exit;
    }
}
add_action('admin_init', 'hieugara_handle_nav_manager_actions');

/**
 * =========================================================================
 * 4. GIAO DIỆN QUẢN TRỊ TRUNG TÂM (MASTER NAVIGATION & SUBMENUS MANAGER)
 * =========================================================================
 */
function hieugara_render_nav_manager_page() {
    $current_tab = sanitize_text_field($_GET['tab'] ?? 'master');
    $msg         = sanitize_text_field($_GET['msg'] ?? '');

    // Master Nav Values
    $show_home        = get_option('hieugara_nav_show_home', '1');
    $show_about       = get_option('hieugara_nav_show_about', '1');
    $show_services    = get_option('hieugara_nav_show_services', '1');
    $show_vinfast     = get_option('hieugara_nav_show_vinfast', '1');
    $show_accessories = get_option('hieugara_nav_show_accessories', '1');
    $show_blog        = get_option('hieugara_nav_show_blog', '1');
    $show_contact     = get_option('hieugara_nav_show_contact', '1');
    $show_rescue_btn  = get_option('hieugara_nav_show_rescue_btn', '1');
    $show_search      = get_option('hieugara_nav_show_search', '1');

    $label_home        = get_option('hieugara_nav_label_home', 'TRANG CHỦ');
    $label_about       = get_option('hieugara_nav_label_about', 'GIỚI THIỆU');
    $label_services    = get_option('hieugara_nav_label_services', 'DỊCH VỤ');
    $label_accessories = get_option('hieugara_nav_label_accessories', 'PHỤ KIỆN');
    $label_blog        = get_option('hieugara_nav_label_blog', 'BLOG');
    $label_contact     = get_option('hieugara_nav_label_contact', 'LIÊN HỆ');

    // About Menu Items
    $about_items = hieugara_get_about_menu_items();
    $edit_about_item = null;
    if ($current_tab === 'about' && isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['item_id'])) {
        $edit_id = sanitize_text_field($_GET['item_id']);
        if (isset($about_items[$edit_id])) {
            $edit_about_item = $about_items[$edit_id];
        }
    }

    // Contact Menu Items
    $contact_items = hieugara_get_contact_menu_items();
    $edit_contact_item = null;
    if ($current_tab === 'contact' && isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['item_id'])) {
        $edit_id = sanitize_text_field($_GET['item_id']);
        if (isset($contact_items[$edit_id])) {
            $edit_contact_item = $contact_items[$edit_id];
        }
    }

    // Page About Content Values
    $about_p_title     = get_option('hieugara_about_page_title', 'Ôtô Hải Hà: 31 Năm Giữ Trọn Chữ Tâm Với Nghề');
    $about_p_subtitle  = get_option('hieugara_about_page_subtitle', 'Khởi nguồn từ năm 1995 bởi nhà sáng lập ông Nguyễn Hải Hà. 31 năm trôi qua, niềm tin "chăm sóc xe bằng cái tâm người thợ" vẫn là kim chỉ nam trong từng công việc chúng tôi làm mỗi ngày.');
    $about_show_story  = get_option('hieugara_about_show_story', '1');
    $about_show_commit = get_option('hieugara_about_show_commitments', '1');
    $about_years_exp   = get_option('hieugara_about_years_exp', '31+');
    $about_staff_count = get_option('hieugara_about_staff_count', '80+');
    $about_parts_rate  = get_option('hieugara_about_parts_rate', '100%');
    ?>

    <div class="wrap hieugara-admin-wrap" style="max-width: 1250px; margin: 25px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

        <!-- Header Hero Banner -->
        <div style="background: linear-gradient(135deg, #141414 0%, #1e293b 100%); color: #fff; padding: 28px 32px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <span style="background: #F5A300; color: #141414; padding: 6px 12px; border-radius: 6px; font-weight: 800; font-size: 13px; letter-spacing: 0.5px;">NAVIGATION OS</span>
                        <h1 style="margin: 0; color: #fff; font-size: 24px; font-weight: 800; display: inline-block;">
                            🧭 Quản Lý Menu &amp; Điều Hướng Toàn Diện
                        </h1>
                    </div>
                    <p style="margin: 0; color: #94A3B8; font-size: 14px; max-width: 780px;">
                        Tùy biến bật/tắt toàn bộ các nút Menu trên thanh Header, quản lý danh mục &amp; liên kết con (Giới Thiệu, Liên Hệ, Dịch Vụ) với đầy đủ thao tác Thêm, Sửa, Xoá và Bật/Tắt tức thì.
                    </p>
                </div>
                <div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.25); color: #fff; font-weight: 600; padding: 8px 16px; height: auto; border-radius: 6px; text-decoration: none;">
                        <span class="dashicons dashicons-external" style="margin-top: 2px;"></span> Xem Website Thực Tế
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert Notifications -->
        <?php if ($msg === 'master_saved') : ?>
            <div class="notice notice-success is-dismissible" style="padding: 12px 16px; border-left-color: #10B981;">
                <p><strong>✓ Đã lưu thành công cấu hình Bật/Tắt Menu Chính! Toàn bộ thay đổi đã cập nhật ra Header website.</strong></p>
            </div>
        <?php elseif ($msg === 'about_saved') : ?>
            <div class="notice notice-success is-dismissible" style="padding: 12px 16px; border-left-color: #10B981;">
                <p><strong>✓ Đã lưu thành công mục trong Menu Giới Thiệu!</strong></p>
            </div>
        <?php elseif ($msg === 'contact_saved') : ?>
            <div class="notice notice-success is-dismissible" style="padding: 12px 16px; border-left-color: #10B981;">
                <p><strong>✓ Đã lưu thành công mục trong Menu Liên Hệ!</strong></p>
            </div>
        <?php elseif ($msg === 'page_about_saved') : ?>
            <div class="notice notice-success is-dismissible" style="padding: 12px 16px; border-left-color: #10B981;">
                <p><strong>✓ Đã lưu nội dung và cài đặt hiển thị cho Trang Về Chúng Tôi (Giới Thiệu)!</strong></p>
            </div>
        <?php elseif ($msg === 'toggle_success') : ?>
            <div class="notice notice-info is-dismissible" style="padding: 12px 16px;">
                <p><strong>✓ Đã chuyển đổi trạng thái Bật / Tắt hiển thị thành công!</strong></p>
            </div>
        <?php elseif ($msg === 'del_success') : ?>
            <div class="notice notice-warning is-dismissible" style="padding: 12px 16px;">
                <p><strong>✓ Đã xóa mục khỏi menu thành công!</strong></p>
            </div>
        <?php elseif ($msg === 'reset_success') : ?>
            <div class="notice notice-info is-dismissible" style="padding: 12px 16px;">
                <p><strong>✓ Đã khôi phục toàn bộ danh sách mục về mặc định ban đầu!</strong></p>
            </div>
        <?php elseif ($msg === 'missing_fields') : ?>
            <div class="notice notice-error is-dismissible" style="padding: 12px 16px;">
                <p><strong>⚠️ Lỗi: Vui lòng điền đầy đủ Tiêu đề và Đường dẫn (URL) liên kết!</strong></p>
            </div>
        <?php endif; ?>

        <!-- Nav Tabs -->
        <h2 class="nav-tab-wrapper" style="margin-bottom: 25px; border-bottom: 2px solid #E2E8F0;">
            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=master')); ?>" 
               class="nav-tab <?php echo $current_tab === 'master' ? 'nav-tab-active' : ''; ?>" 
               style="font-size: 14px; font-weight: 700; padding: 10px 18px;">
                🎛️ Bật / Tắt Menu Chính
            </a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=about')); ?>" 
               class="nav-tab <?php echo $current_tab === 'about' ? 'nav-tab-active' : ''; ?>" 
               style="font-size: 14px; font-weight: 700; padding: 10px 18px;">
                📋 Menu Giới Thiệu (<?php echo count($about_items); ?>)
            </a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=contact')); ?>" 
               class="nav-tab <?php echo $current_tab === 'contact' ? 'nav-tab-active' : ''; ?>" 
               style="font-size: 14px; font-weight: 700; padding: 10px 18px;">
                📞 Menu Liên Hệ (<?php echo count($contact_items); ?>)
            </a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=page_about')); ?>" 
               class="nav-tab <?php echo $current_tab === 'page_about' ? 'nav-tab-active' : ''; ?>" 
               style="font-size: 14px; font-weight: 700; padding: 10px 18px;">
                🏢 Trang Về Chúng Tôi (Giới Thiệu)
            </a>
        </h2>

        <!-- TAB 1: MASTER NAV TOGGLES -->
        <?php if ($current_tab === 'master') : ?>
            <div style="background: #fff; border-radius: 12px; border: 1px solid #E2E8F0; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="margin-bottom: 20px;">
                    <h3 style="margin: 0 0 8px 0; font-size: 18px; color: #1E293B; font-weight: 800;">
                        Bảng Điều Khiển Bật / Tắt Các Nút Trên Thanh Header
                    </h3>
                    <p style="margin: 0; color: #64748B; font-size: 13px;">
                        Bạn có thể ẩn hoàn toàn bất kỳ mục nào khỏi Header chỉ bằng công tắc Bật/Tắt, hoặc đổi tên hiển thị (nhãn chữ) ra bên ngoài website.
                    </p>
                </div>

                <form method="POST" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=master')); ?>">
                    <?php wp_nonce_field('hieugara_master_nav_nonce'); ?>
                    <input type="hidden" name="hieugara_nav_action" value="save_master_nav">
                    <input type="hidden" name="current_tab" value="master">

                    <table class="wp-list-table widefat fixed striped" style="border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden;">
                        <thead>
                            <tr style="background: #F8FAFC; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">
                                <th style="width: 50px; text-align: center; font-weight: 700;">#</th>
                                <th style="width: 220px; font-weight: 700;">Mục Điều Hướng</th>
                                <th style="width: 140px; text-align: center; font-weight: 700;">Bật / Tắt Hiển Thị</th>
                                <th style="font-weight: 700;">Tùy Chỉnh Tên Nhãn Ngoài Web</th>
                                <th style="width: 220px; font-weight: 700;">Ghi Chú &amp; Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 1. TRANG CHỦ -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">01</td>
                                <td>
                                    <strong style="color: #0F172A; font-size: 14px;">Trang Chủ</strong><br>
                                    <small style="color: #64748B;">Đường dẫn: <code>/</code></small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_home" value="1" <?php checked('1', $show_home); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_home" value="<?php echo esc_attr($label_home); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 12px;">Link về trang chủ chính của website</span>
                                </td>
                            </tr>

                            <!-- 2. GIỚI THIỆU -->
                            <tr style="background: #FFFBEB;">
                                <td style="text-align: center; font-weight: 700; color: #D97706;">02</td>
                                <td>
                                    <strong style="color: #D97706; font-size: 14px;">Giới Thiệu ⌵</strong><br>
                                    <small style="color: #92400E;">Có dropdown menu con</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_about" value="1" <?php checked('1', $show_about); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_about" value="<?php echo esc_attr($label_about); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=about')); ?>" class="button button-small" style="background: #D97706; color: #fff; border-color: #B45309; font-weight: 600;">
                                        Quản lý <?php echo count($about_items); ?> mục con &rarr;
                                    </a>
                                </td>
                            </tr>

                            <!-- 3. DỊCH VỤ -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">03</td>
                                <td>
                                    <strong style="color: #0F172A; font-size: 14px;">Dịch Vụ ⌵</strong><br>
                                    <small style="color: #64748B;">Mega menu dịch vụ xưởng</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_services" value="1" <?php checked('1', $show_services); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_services" value="<?php echo esc_attr($label_services); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #334155; cursor: pointer;">
                                        <input type="checkbox" name="nav_show_vinfast" value="1" <?php checked('1', $show_vinfast); ?>>
                                        <span>Hiện mục <strong>"Xe VinFast"</strong> trong menu</span>
                                    </label>
                                </td>
                            </tr>

                            <!-- 4. PHỤ KIỆN -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">04</td>
                                <td>
                                    <strong style="color: #0F172A; font-size: 14px;">Phụ Kiện ⌵</strong><br>
                                    <small style="color: #64748B;">Phụ kiện &amp; đồ chơi xe</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_accessories" value="1" <?php checked('1', $show_accessories); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_accessories" value="<?php echo esc_attr($label_accessories); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 12px;">Tự động tải danh mục phụ kiện</span>
                                </td>
                            </tr>

                            <!-- 5. BLOG -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">05</td>
                                <td>
                                    <strong style="color: #0F172A; font-size: 14px;">Blog ⌵</strong><br>
                                    <small style="color: #64748B;">Kiến thức kỹ thuật</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_blog" value="1" <?php checked('1', $show_blog); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_blog" value="<?php echo esc_attr($label_blog); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 12px;">Chứa các chuyên mục bài viết kỹ thuật</span>
                                </td>
                            </tr>

                            <!-- 6. LIÊN HỆ -->
                            <tr style="background: #F0FDF4;">
                                <td style="text-align: center; font-weight: 700; color: #16A34A;">06</td>
                                <td>
                                    <strong style="color: #16A34A; font-size: 14px;">Liên Hệ ⌵</strong><br>
                                    <small style="color: #166534;">Có dropdown menu con</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_contact" value="1" <?php checked('1', $show_contact); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="nav_label_contact" value="<?php echo esc_attr($label_contact); ?>" class="regular-text" style="font-weight: 700; padding: 6px 10px; border-radius: 6px;">
                                </td>
                                <td>
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=contact')); ?>" class="button button-small" style="background: #16A34A; color: #fff; border-color: #15803D; font-weight: 600;">
                                        Quản lý <?php echo count($contact_items); ?> mục con &rarr;
                                    </a>
                                </td>
                            </tr>

                            <!-- 7. NÚT CỨU HỘ 24/7 -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #DC2626;">07</td>
                                <td>
                                    <strong style="color: #DC2626; font-size: 14px;">Nút Cứu Hộ 24/7 (Đỏ)</strong><br>
                                    <small style="color: #991B1B;">Nút gọi khẩn cấp bên phải</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_rescue_btn" value="1" <?php checked('1', $show_rescue_btn); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 13px;">Hiển thị nút đỏ nổi bật <code>CỨU HỘ 24/7: 0911 211 996</code></span>
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 12px;">Số điện thoại chỉnh tại Cài đặt Giao diện</span>
                                </td>
                            </tr>

                            <!-- 8. Ô TÌM KIẾM -->
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">08</td>
                                <td>
                                    <strong style="color: #0F172A; font-size: 14px;">Ô Tìm Kiếm Chuẩn SEO</strong><br>
                                    <small style="color: #64748B;">Khung search pill bo tròn</small>
                                </td>
                                <td style="text-align: center;">
                                    <label class="hieugara-switch" style="display: inline-block;">
                                        <input type="checkbox" name="nav_show_search" value="1" <?php checked('1', $show_search); ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 13px;">Khung tìm kiếm dịch vụ, phụ tùng kèm danh sách gợi ý tag</span>
                                </td>
                                <td>
                                    <span style="color: #64748B; font-size: 12px;">Nằm ở góc phải ngoài cùng thanh Menu</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="margin-top: 25px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="button button-primary button-hero" style="background: #141414; border-color: #141414; font-weight: 700; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                            💾 Lưu Toàn Bộ Cấu Hình Menu Chính
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <!-- TAB 2: MENU GIỚI THIỆU -->
        <?php if ($current_tab === 'about') : ?>
            <div style="background: #fff; border-radius: 12px; border: 1px solid #E2E8F0; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #1E293B;">
                            📋 Danh Sách Mục Trong Menu "GIỚI THIỆU"
                        </h3>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <button type="button" class="button button-primary" onclick="hieugaraOpenAboutModal(null);" style="background: #10B981; border-color: #059669; font-weight: 700; border-radius: 6px; padding: 6px 16px; height: auto; box-shadow: 0 2px 6px rgba(16,185,129,0.25);">
                            ➕ Thêm Mục Giới Thiệu Mới
                        </button>
                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'hieugara_nav_action' => 'reset_about_defaults'), admin_url('admin.php')), 'hieugara_about_reset_nonce')); ?>" 
                           class="button" 
                           onclick="return confirm('Bạn có chắc muốn khôi phục danh sách mục Giới Thiệu về mặc định?');"
                           style="color: #64748B; font-size: 12px; border-radius: 6px; padding: 6px 12px; height: auto;">
                            🔄 Khôi phục mặc định
                        </a>
                    </div>
                </div>

                <table class="wp-list-table widefat fixed striped" style="border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden; width: 100%;">
                    <thead>
                        <tr style="background: #F8FAFC; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                            <th style="width: 50px; text-align: center; font-weight: 700;">STT</th>
                            <th style="width: 260px; font-weight: 700;">Tiêu Đề Mục</th>
                            <th style="font-weight: 700;">Liên Kết (URL)</th>
                            <th style="width: 100px; text-align: center; font-weight: 700;">Trạng Thái</th>
                            <th style="width: 200px; text-align: center; font-weight: 700;">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($about_items)) : ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 35px; color: #94A3B8;">
                                    Chưa có mục nào trong menu Giới Thiệu. Bấm nút <strong>"➕ Thêm Mục Giới Thiệu Mới"</strong> ở trên để thêm!
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($about_items as $it_id => $it) : 
                                $is_active = !empty($it['enable']);
                            ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 700; color: #64748B;">
                                        <?php echo esc_html($it['order'] ?? 1); ?>
                                    </td>
                                    <td>
                                        <strong style="color: #0F172A; font-size: 14px;"><?php echo esc_html($it['title']); ?></strong>
                                        <?php if (!empty($it['icon'])) : ?>
                                            <br><small style="color: #64748B; font-size: 11.5px;"><i class="<?php echo esc_attr($it['icon']); ?>"></i> <code><?php echo esc_html($it['icon']); ?></code></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo esc_url($it['link']); ?>" target="_blank" style="color: #2563EB; font-size: 13px; text-decoration: none; word-break: break-all;">
                                            <?php echo esc_html($it['link']); ?>
                                        </a>
                                        <?php if (($it['target'] ?? '_self') === '_blank') : ?>
                                            <span style="font-size: 10px; background: #E0E7FF; color: #3730A3; padding: 2px 6px; border-radius: 4px; margin-left: 6px;">Tab mới</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($is_active) : ?>
                                            <span style="background: #DEF7EC; color: #03543F; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">Hiển Thị</span>
                                        <?php else : ?>
                                            <span style="background: #F3F4F6; color: #6B7280; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">Đã Ẩn</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="button button-small" 
                                           onclick='hieugaraOpenAboutModal(<?php echo json_encode($it); ?>);'
                                           style="font-size: 12px; font-weight: 700; border-radius: 5px; color: #1D4ED8; border-color: #93C5FD; background: #EFF6FF; margin-right: 4px;">
                                            ✏️ Sửa
                                        </button>

                                        <?php if (strpos($it['link'] ?? '', 've-chung-toi') !== false || $it_id === 'item_about_us') : ?>
                                            <a href="<?php echo esc_url(admin_url('post.php?post=88&action=edit')); ?>" class="button button-small" style="font-size: 11px; font-weight: 700; border-radius: 5px; color: #92400E; border-color: #FCD34D; background: #FEF3C7; margin-right: 4px;" title="Soạn thảo nội dung và hình ảnh bài viết">
                                                📝 Sửa bài &amp; ảnh
                                            </a>
                                        <?php endif; ?>
                                        
                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'hieugara_nav_action' => 'toggle_about_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_about_toggle_nonce')); ?>" 
                                           class="button button-small" style="font-size: 12px; border-radius: 5px; margin-right: 4px;" title="Bật/Tắt hiển thị">
                                            <?php echo $is_active ? 'Ẩn' : 'Bật'; ?>
                                        </a>

                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'about', 'hieugara_nav_action' => 'delete_about_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_about_del_nonce')); ?>" 
                                           class="button button-small" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa mục: <?php echo esc_attr($it['title']); ?>?');"
                                           style="font-size: 12px; color: #DC2626; border-radius: 5px; border-color: #FCA5A5;">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- TAB 3: MENU LIÊN HỆ -->
        <?php if ($current_tab === 'contact') : ?>
            <div style="background: #fff; border-radius: 12px; border: 1px solid #E2E8F0; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #1E293B;">
                            📞 Danh Sách Mục Trong Menu "LIÊN HỆ"
                        </h3>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <button type="button" class="button button-primary" onclick="hieugaraOpenContactModal(null);" style="background: #10B981; border-color: #059669; font-weight: 700; border-radius: 6px; padding: 6px 16px; height: auto; box-shadow: 0 2px 6px rgba(16,185,129,0.25);">
                            ➕ Thêm Mục Liên Hệ Mới
                        </button>
                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'hieugara_nav_action' => 'reset_contact_defaults'), admin_url('admin.php')), 'hieugara_contact_reset_nonce')); ?>" 
                           class="button" 
                           onclick="return confirm('Bạn có chắc muốn khôi phục danh sách mục Liên Hệ về mặc định?');"
                           style="color: #64748B; font-size: 12px; border-radius: 6px; padding: 6px 12px; height: auto;">
                            🔄 Khôi phục mặc định
                        </a>
                    </div>
                </div>

                <table class="wp-list-table widefat fixed striped" style="border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden; width: 100%;">
                    <thead>
                        <tr style="background: #F8FAFC; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                            <th style="width: 50px; text-align: center; font-weight: 700;">STT</th>
                            <th style="width: 260px; font-weight: 700;">Tiêu Đề Mục</th>
                            <th style="font-weight: 700;">Liên Kết / Hotline</th>
                            <th style="width: 100px; text-align: center; font-weight: 700;">Trạng Thái</th>
                            <th style="width: 200px; text-align: center; font-weight: 700;">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($contact_items)) : ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 35px; color: #94A3B8;">
                                    Chưa có mục nào trong menu Liên Hệ. Bấm nút <strong>"➕ Thêm Mục Liên Hệ Mới"</strong> ở trên để thêm!
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($contact_items as $it_id => $it) : 
                                $is_active = !empty($it['enable']);
                            ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 700; color: #64748B;">
                                        <?php echo esc_html($it['order'] ?? 1); ?>
                                    </td>
                                    <td>
                                        <strong style="color: #0F172A; font-size: 14px;"><?php echo esc_html($it['title']); ?></strong>
                                        <?php if (!empty($it['icon'])) : ?>
                                            <br><small style="color: #64748B; font-size: 11.5px;"><i class="<?php echo esc_attr($it['icon']); ?>"></i> <code><?php echo esc_html($it['icon']); ?></code></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo esc_url($it['link']); ?>" style="color: #2563EB; font-size: 13px; text-decoration: none; word-break: break-all;">
                                            <?php echo esc_html($it['link']); ?>
                                        </a>
                                        <?php if (($it['target'] ?? '_self') === '_blank') : ?>
                                            <span style="font-size: 10px; background: #E0E7FF; color: #3730A3; padding: 2px 6px; border-radius: 4px; margin-left: 6px;">Tab mới</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($is_active) : ?>
                                            <span style="background: #DEF7EC; color: #03543F; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">Hiển Thị</span>
                                        <?php else : ?>
                                            <span style="background: #F3F4F6; color: #6B7280; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">Đã Ẩn</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="button button-small" 
                                           onclick='hieugaraOpenContactModal(<?php echo json_encode($it); ?>);'
                                           style="font-size: 12px; font-weight: 700; border-radius: 5px; color: #1D4ED8; border-color: #93C5FD; background: #EFF6FF; margin-right: 4px;">
                                            ✏️ Sửa
                                        </button>
                                        
                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'hieugara_nav_action' => 'toggle_contact_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_contact_toggle_nonce')); ?>" 
                                           class="button button-small" style="font-size: 12px; border-radius: 5px; margin-right: 4px;" title="Bật/Tắt hiển thị">
                                            <?php echo $is_active ? 'Ẩn' : 'Bật'; ?>
                                        </a>

                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-nav-manager', 'tab' => 'contact', 'hieugara_nav_action' => 'delete_contact_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_contact_del_nonce')); ?>" 
                                           class="button button-small" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa mục: <?php echo esc_attr($it['title']); ?>?');"
                                           style="font-size: 12px; color: #DC2626; border-radius: 5px; border-color: #FCA5A5;">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- TAB 4: TÙY BIẾN TRANG VỀ CHÚNG TÔI (GIỚI THIỆU) -->
        <?php if ($current_tab === 'page_about') : ?>
            <div style="background: #fff; border-radius: 12px; border: 1px solid #E2E8F0; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="margin-bottom: 20px;">
                    <h3 style="margin: 0 0 8px 0; font-size: 18px; color: #1E293B; font-weight: 800;">
                        🏢 Tùy Biến Nội Dung &amp; Khối Hiển Thị Trang "Về Chúng Tôi" (Giới Thiệu)
                    </h3>
                    <p style="margin: 0; color: #64748B; font-size: 13px;">
                        Đường dẫn trang: <code>/ve-chung-toi/</code>. Cho phép chỉnh sửa tiêu đề chính, slogan triết lý và bật/tắt từng phân đoạn trên trang.
                    </p>
                </div>

                <!-- Callout Banner: Trình Soạn Thảo WordPress Cho Về Chúng Tôi -->
                <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; padding: 22px 24px; border-radius: 10px; margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; border: 1px solid #334155; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
                    <div style="max-width: 650px;">
                        <h4 style="margin: 0 0 8px 0; font-size: 16px; color: #F5A300; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                            <span>📝</span> Bạn muốn thêm chữ, chèn ảnh, căn lề trái / phải / giữa như một dịch vụ?
                        </h4>
                        <p style="margin: 0; color: #cbd5e1; font-size: 13.5px; line-height: 1.6;">
                            Trang <strong>Về Chúng Tôi</strong> nay đã được kết nối trực tiếp với <strong>Trình soạn thảo WordPress</strong>. Bạn có thể tự do gõ thêm câu chữ, bấm <em>"Thêm Media"</em> tải ảnh mới, đổi vị trí ảnh bất kỳ đâu, căn chữ bao quanh ảnh hoặc tạo album ảnh cực kỳ dễ dàng!
                        </p>
                    </div>
                    <a href="<?php echo esc_url(admin_url('post.php?post=88&action=edit')); ?>" class="button button-primary" style="background: #F5A300; border-color: #F5A300; color: #141414; font-weight: 800; font-size: 13.5px; padding: 12px 22px; height: auto; text-decoration: none; border-radius: 6px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(245, 163, 0, 0.35);">
                        ✏️ Mở Trình Soạn Thảo Để Sửa Bài &amp; Ảnh Ngay &rarr;
                    </a>
                </div>

                <form method="POST" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=page_about')); ?>">
                    <?php wp_nonce_field('hieugara_about_page_nonce'); ?>
                    <input type="hidden" name="hieugara_nav_action" value="save_about_page_content">
                    <input type="hidden" name="current_tab" value="page_about">

                    <table class="form-table" style="max-width: 900px;">
                        <tr>
                            <th scope="row" style="font-weight: 700; color: #334155;">Tiêu Đề Trang Chính</th>
                            <td>
                                <input type="text" name="about_page_title" value="<?php echo esc_attr($about_p_title); ?>" class="large-text" style="font-weight: 700; padding: 8px 12px; border-radius: 6px;">
                                <p class="description">Tiêu đề lớn xuất hiện trên đầu trang Về Chúng Tôi.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-weight: 700; color: #334155;">Đoạn Giới Thiệu &amp; Slogan</th>
                            <td>
                                <textarea name="about_page_subtitle" rows="3" class="large-text" style="padding: 8px 12px; border-radius: 6px;"><?php echo esc_textarea($about_p_subtitle); ?></textarea>
                                <p class="description">Đoạn text mô tả kim chỉ nam "chăm sóc xe bằng cái tâm người thợ".</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-weight: 700; color: #334155;">Khối "Hành Trình Lịch Sử &amp; Đội Ngũ"</th>
                            <td>
                                <label class="hieugara-switch">
                                    <input type="checkbox" name="about_show_story" value="1" <?php checked('1', $about_show_story); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hieugara-switch-desc">Bật để hiển thị phần lịch sử 31 năm, câu chuyện người sáng lập và hình ảnh kỹ thuật viên xưởng.</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-weight: 700; color: #334155;">Khối "5 Cam Kết Vàng"</th>
                            <td>
                                <label class="hieugara-switch">
                                    <input type="checkbox" name="about_show_commitments" value="1" <?php checked('1', $about_show_commit); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <span class="hieugara-switch-desc">Bật để hiển thị 5 cam kết minh bạch phụ tùng, báo giá chuẩn, bảo hành dài hạn.</span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-weight: 700; color: #334155;">Thông Số Nổi Bật (3 Cột)</th>
                            <td>
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                                    <div>
                                        <label style="display: block; font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px;">Năm Đồng Hành</label>
                                        <input type="text" name="about_years_exp" value="<?php echo esc_attr($about_years_exp); ?>" style="width: 100%; font-weight: 700; border-radius: 6px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px;">Quy Mô Nhân Sự</label>
                                        <input type="text" name="about_staff_count" value="<?php echo esc_attr($about_staff_count); ?>" style="width: 100%; font-weight: 700; border-radius: 6px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 12px; font-weight: 600; color: #64748B; margin-bottom: 4px;">Phụ Tùng Chuẩn</label>
                                        <input type="text" name="about_parts_rate" value="<?php echo esc_attr($about_parts_rate); ?>" style="width: 100%; font-weight: 700; border-radius: 6px;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top: 25px; border-top: 1px solid #E2E8F0; padding-top: 20px;">
                        <button type="submit" class="button button-primary" style="background: #141414; border-color: #141414; font-weight: 700; padding: 8px 24px; height: auto; border-radius: 6px;">
                            💾 Lưu Tùy Biến Trang Về Chúng Tôi
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <!-- ============================================================== -->
        <!-- POPUP MODAL: THÊM / CHỈNH SỬA MỤC GIỚI THIỆU -->
        <!-- ============================================================== -->
        <div id="aboutModalOverlay" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(5px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;" onclick="if(event.target === this) hieugaraCloseAboutModal();">
            <div style="background: #ffffff; border-radius: 14px; width: 100%; max-width: 540px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3); border: 1px solid #E2E8F0; overflow: hidden; animation: hieugaraFadeIn 0.2s ease-out;">
                
                <!-- Modal Header -->
                <div style="background: #1E293B; color: #fff; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">📋</span>
                        <h3 id="aboutModalTitle" style="margin: 0; color: #fff; font-size: 17px; font-weight: 800;">
                            Chỉnh Sửa Mục Giới Thiệu
                        </h3>
                    </div>
                    <button type="button" onclick="hieugaraCloseAboutModal();" style="background: transparent; border: none; color: #94A3B8; font-size: 24px; cursor: pointer; line-height: 1; padding: 0;" title="Đóng cửa sổ">&times;</button>
                </div>

                <!-- Modal Body Form -->
                <form method="POST" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=about')); ?>" style="padding: 24px;">
                    <?php wp_nonce_field('hieugara_about_item_nonce'); ?>
                    <input type="hidden" name="hieugara_nav_action" value="save_about_item">
                    <input type="hidden" name="current_tab" value="about">
                    <input type="hidden" name="item_id" id="about_item_id" value="">

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Tiêu đề hiển thị <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="title" id="about_title" required placeholder="VD: Về Chúng Tôi, Đội Ngũ Kỹ Sư..." style="width: 100%; border-radius: 6px; padding: 10px 12px; font-size: 14px; font-weight: 600; border: 1px solid #CBD5E1;">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Đường dẫn liên kết (URL) <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="link" id="about_link" required placeholder="VD: /ve-chung-toi/ hoặc https://..." style="width: 100%; border-radius: 6px; padding: 10px 12px; font-size: 13.5px; border: 1px solid #CBD5E1;">
                        <small style="color: #64748B; font-size: 11px;">Có thể điền link nội bộ (<code>/ve-chung-toi/</code>) hoặc link neo (<code>/ve-chung-toi/#su-kien</code>).</small>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Icon FontAwesome (Tùy chọn)
                        </label>
                        <input type="text" name="icon" id="about_icon" placeholder="VD: fa-solid fa-building" style="width: 100%; border-radius: 6px; padding: 8px 12px; font-size: 13px; border: 1px solid #CBD5E1;">
                        <small style="color: #64748B; font-size: 11px;">VD: <code>fa-solid fa-building</code>, <code>fa-solid fa-bullhorn</code>, <code>fa-solid fa-certificate</code></small>
                    </div>

                    <div style="margin-bottom: 18px; display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                                Thứ tự hiển thị
                            </label>
                            <input type="number" name="order" id="about_order" value="1" min="1" max="99" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #CBD5E1;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                                Mở cửa sổ
                            </label>
                            <select name="target" id="about_target" style="width: 100%; border-radius: 6px; height: 38px; border: 1px solid #CBD5E1;">
                                <option value="_self">Cùng trang (_self)</option>
                                <option value="_blank">Tab mới (_blank)</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px; background: #F8FAFC; padding: 12px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <label style="display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 13.5px; color: #1E293B; cursor: pointer;">
                            <input type="checkbox" name="enable" id="about_enable" value="1" checked style="width: 18px; height: 18px;">
                            <span>Kích hoạt hiển thị trong Dropdown Giới Thiệu</span>
                        </label>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #E2E8F0; padding-top: 18px;">
                        <button type="button" onclick="hieugaraCloseAboutModal();" class="button" style="padding: 8px 18px; height: auto; border-radius: 6px; font-weight: 600;">
                            Hủy Bỏ
                        </button>
                        <button type="submit" id="aboutModalSubmitBtn" class="button button-primary" style="background: #10B981; border-color: #059669; font-weight: 700; padding: 8px 24px; height: auto; border-radius: 6px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                            💾 Lưu Thay Đổi
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- POPUP MODAL: THÊM / CHỈNH SỬA MỤC LIÊN HỆ -->
        <!-- ============================================================== -->
        <div id="contactModalOverlay" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(5px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;" onclick="if(event.target === this) hieugaraCloseContactModal();">
            <div style="background: #ffffff; border-radius: 14px; width: 100%; max-width: 540px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3); border: 1px solid #E2E8F0; overflow: hidden; animation: hieugaraFadeIn 0.2s ease-out;">
                
                <!-- Modal Header -->
                <div style="background: #1E293B; color: #fff; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">📞</span>
                        <h3 id="contactModalTitle" style="margin: 0; color: #fff; font-size: 17px; font-weight: 800;">
                            Chỉnh Sửa Mục Liên Hệ
                        </h3>
                    </div>
                    <button type="button" onclick="hieugaraCloseContactModal();" style="background: transparent; border: none; color: #94A3B8; font-size: 24px; cursor: pointer; line-height: 1; padding: 0;" title="Đóng cửa sổ">&times;</button>
                </div>

                <!-- Modal Body Form -->
                <form method="POST" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-nav-manager&tab=contact')); ?>" style="padding: 24px;">
                    <?php wp_nonce_field('hieugara_contact_item_nonce'); ?>
                    <input type="hidden" name="hieugara_nav_action" value="save_contact_item">
                    <input type="hidden" name="current_tab" value="contact">
                    <input type="hidden" name="item_id" id="contact_item_id" value="">

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Tiêu đề hiển thị <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="title" id="contact_title" required placeholder="VD: Hotline Tư Vấn, Cứu Hộ 24/7..." style="width: 100%; border-radius: 6px; padding: 10px 12px; font-size: 14px; font-weight: 600; border: 1px solid #CBD5E1;">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Đường dẫn liên kết hoặc Số điện thoại <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="link" id="contact_link" required placeholder="VD: tel:02203892207 hoặc /ve-chung-toi/" style="width: 100%; border-radius: 6px; padding: 10px 12px; font-size: 13.5px; border: 1px solid #CBD5E1;">
                        <small style="color: #64748B; font-size: 11px;">Số điện thoại gọi trực tiếp: <code>tel:0911211996</code> hoặc link nội bộ: <code>/ve-chung-toi/</code></small>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                            Icon FontAwesome (Tùy chọn)
                        </label>
                        <input type="text" name="icon" id="contact_icon" placeholder="VD: fa-solid fa-phone" style="width: 100%; border-radius: 6px; padding: 8px 12px; font-size: 13px; border: 1px solid #CBD5E1;">
                    </div>

                    <div style="margin-bottom: 18px; display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                                Thứ tự hiển thị
                            </label>
                            <input type="number" name="order" id="contact_order" value="1" min="1" max="99" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #CBD5E1;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">
                                Mở cửa sổ
                            </label>
                            <select name="target" id="contact_target" style="width: 100%; border-radius: 6px; height: 38px; border: 1px solid #CBD5E1;">
                                <option value="_self">Cùng trang (_self)</option>
                                <option value="_blank">Tab mới (_blank)</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px; background: #F8FAFC; padding: 12px 14px; border-radius: 8px; border: 1px solid #E2E8F0;">
                        <label style="display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 13.5px; color: #1E293B; cursor: pointer;">
                            <input type="checkbox" name="enable" id="contact_enable" value="1" checked style="width: 18px; height: 18px;">
                            <span>Kích hoạt hiển thị trong Dropdown Liên Hệ</span>
                        </label>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #E2E8F0; padding-top: 18px;">
                        <button type="button" onclick="hieugaraCloseContactModal();" class="button" style="padding: 8px 18px; height: auto; border-radius: 6px; font-weight: 600;">
                            Hủy Bỏ
                        </button>
                        <button type="submit" id="contactModalSubmitBtn" class="button button-primary" style="background: #10B981; border-color: #059669; font-weight: 700; padding: 8px 24px; height: auto; border-radius: 6px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                            💾 Lưu Thay Đổi
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- JAVASCRIPT ĐIỀU KHIỂN MODAL POPUP -->
        <!-- ============================================================== -->
        <script>
        function hieugaraOpenAboutModal(item) {
            var overlay = document.getElementById('aboutModalOverlay');
            var titleEl = document.getElementById('aboutModalTitle');
            var submitBtn = document.getElementById('aboutModalSubmitBtn');

            if (item) {
                titleEl.innerHTML = '✏️ Chỉnh Sửa Mục: <span style="color: #FCD34D;">' + (item.title || '') + '</span>';
                submitBtn.innerHTML = '💾 Cập Nhật Mục';
                document.getElementById('about_item_id').value = item.id || '';
                document.getElementById('about_title').value = item.title || '';
                document.getElementById('about_link').value = item.link || '';
                document.getElementById('about_icon').value = item.icon || 'fa-solid fa-angle-right';
                document.getElementById('about_order').value = item.order || 1;
                document.getElementById('about_target').value = item.target || '_self';
                document.getElementById('about_enable').checked = (item.enable === '1' || item.enable === 1);
            } else {
                titleEl.innerHTML = '➕ Thêm Mục Giới Thiệu Mới';
                submitBtn.innerHTML = '➕ Thêm Vào Menu';
                document.getElementById('about_item_id').value = '';
                document.getElementById('about_title').value = '';
                document.getElementById('about_link').value = '';
                document.getElementById('about_icon').value = 'fa-solid fa-angle-right';
                document.getElementById('about_order').value = '<?php echo count($about_items) + 1; ?>';
                document.getElementById('about_target').value = '_self';
                document.getElementById('about_enable').checked = true;
            }

            overlay.style.display = 'flex';
            setTimeout(function() {
                document.getElementById('about_title').focus();
            }, 50);
        }

        function hieugaraCloseAboutModal() {
            var overlay = document.getElementById('aboutModalOverlay');
            if (overlay) overlay.style.display = 'none';
        }

        function hieugaraOpenContactModal(item) {
            var overlay = document.getElementById('contactModalOverlay');
            var titleEl = document.getElementById('contactModalTitle');
            var submitBtn = document.getElementById('contactModalSubmitBtn');

            if (item) {
                titleEl.innerHTML = '✏️ Chỉnh Sửa Mục: <span style="color: #FCD34D;">' + (item.title || '') + '</span>';
                submitBtn.innerHTML = '💾 Cập Nhật Mục';
                document.getElementById('contact_item_id').value = item.id || '';
                document.getElementById('contact_title').value = item.title || '';
                document.getElementById('contact_link').value = item.link || '';
                document.getElementById('contact_icon').value = item.icon || 'fa-solid fa-phone';
                document.getElementById('contact_order').value = item.order || 1;
                document.getElementById('contact_target').value = item.target || '_self';
                document.getElementById('contact_enable').checked = (item.enable === '1' || item.enable === 1);
            } else {
                titleEl.innerHTML = '➕ Thêm Mục Liên Hệ Mới';
                submitBtn.innerHTML = '➕ Thêm Vào Menu';
                document.getElementById('contact_item_id').value = '';
                document.getElementById('contact_title').value = '';
                document.getElementById('contact_link').value = '';
                document.getElementById('contact_icon').value = 'fa-solid fa-phone';
                document.getElementById('contact_order').value = '<?php echo count($contact_items) + 1; ?>';
                document.getElementById('contact_target').value = '_self';
                document.getElementById('contact_enable').checked = true;
            }

            overlay.style.display = 'flex';
            setTimeout(function() {
                document.getElementById('contact_title').focus();
            }, 50);
        }

        function hieugaraCloseContactModal() {
            var overlay = document.getElementById('contactModalOverlay');
            if (overlay) overlay.style.display = 'none';
        }

        // Đóng modal khi bấm Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hieugaraCloseAboutModal();
                hieugaraCloseContactModal();
            }
        });

        // Tự động mở modal nếu trang được tải với param action=edit
        <?php if ($current_tab === 'about' && !empty($edit_about_item)) : ?>
        window.addEventListener('DOMContentLoaded', function() {
            hieugaraOpenAboutModal(<?php echo json_encode($edit_about_item); ?>);
        });
        <?php endif; ?>

        <?php if ($current_tab === 'contact' && !empty($edit_contact_item)) : ?>
        window.addEventListener('DOMContentLoaded', function() {
            hieugaraOpenContactModal(<?php echo json_encode($edit_contact_item); ?>);
        });
        <?php endif; ?>
        </script>

        <style>
        @keyframes hieugaraFadeIn {
            from { opacity: 0; transform: scale(0.96) translateY(-10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        </style>

    </div>
    <?php
}
