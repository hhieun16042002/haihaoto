<?php
/**
 * Ôtô Hải Hà - Quản Lý Menu Giới Thiệu (Full CRUD Admin Panel)
 * Cho phép Quản trị viên Thêm, Sửa, Xóa, Bật/Tắt và Sắp xếp các mục trong dropdown "GIỚI THIỆU"
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Giá Trị Mặc Định Của Menu Giới Thiệu (Đã loại bỏ Báo chí và Hệ thống chi nhánh theo yêu cầu)
 */
function hieugara_get_default_about_menu_items() {
    return array(
        1 => array(
            'id'     => 1,
            'title'  => 'Về Chúng Tôi',
            'link'   => home_url('/ve-chung-toi/'),
            'icon'   => 'fa-solid fa-building',
            'target' => '_self',
            'enable' => '1',
            'order'  => 1,
        ),
        2 => array(
            'id'     => 2,
            'title'  => 'Sự Kiện Hải Hà',
            'link'   => home_url('/ve-chung-toi/#su-kien'),
            'icon'   => 'fa-solid fa-bullhorn',
            'target' => '_self',
            'enable' => '1',
            'order'  => 2,
        ),
        3 => array(
            'id'     => 3,
            'title'  => 'Tiêu Chuẩn & Chứng Nhận Dịch Vụ',
            'link'   => home_url('/ve-chung-toi/#tieu-chuan'),
            'icon'   => 'fa-solid fa-certificate',
            'target' => '_self',
            'enable' => '1',
            'order'  => 3,
        ),
    );
}

/**
 * 2. Lấy Danh Sách Mục Menu Giới Thiệu
 */
function hieugara_get_about_menu_items() {
    $items = get_option('hieugara_about_menu_items');
    if ($items === false || !is_array($items)) {
        $items = hieugara_get_default_about_menu_items();
    }
    
    // Sort by order ascending
    uasort($items, function($a, $b) {
        $oa = isset($a['order']) ? intval($a['order']) : 0;
        $ob = isset($b['order']) ? intval($b['order']) : 0;
        if ($oa === $ob) return 0;
        return ($oa < $ob) ? -1 : 1;
    });

    return $items;
}

/**
 * 3. Đăng Ký Menu Quản Trị Trong WP-Admin
 */
function hieugara_register_about_menu_admin() {
    add_submenu_page(
        'hieugara-theme-settings',
        __('Quản Lý Menu Giới Thiệu', 'hieugara-motors'),
        __('📋 Menu Giới Thiệu (CRUD)', 'hieugara-motors'),
        'manage_options',
        'hieugara-about-menu-crud',
        'hieugara_render_about_menu_crud_page'
    );
}
add_action('admin_menu', 'hieugara_register_about_menu_admin', 22);

/**
 * 4. Xử Lý Các Thao Tác CRUD (Thêm, Sửa, Xóa, Bật/Tắt, Reset)
 */
function hieugara_handle_about_menu_crud_actions() {
    if (!isset($_POST['hieugara_about_action']) && !isset($_GET['hieugara_about_action'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die(__('Bạn không có quyền thực hiện thao tác này.', 'hieugara-motors'));
    }

    $action = sanitize_text_field($_POST['hieugara_about_action'] ?? $_GET['hieugara_about_action']);
    $items  = hieugara_get_about_menu_items();

    // ACTION: Reset về mặc định
    if ($action === 'reset_defaults') {
        check_admin_referer('hieugara_about_reset_nonce');
        $defaults = hieugara_get_default_about_menu_items();
        update_option('hieugara_about_menu_items', $defaults);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'msg' => 'reset_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Xóa 1 mục
    if ($action === 'delete_item') {
        check_admin_referer('hieugara_about_del_nonce');
        $del_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($items[$del_id])) {
            unset($items[$del_id]);
            update_option('hieugara_about_menu_items', $items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'msg' => 'del_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Bật / Tắt nhanh 1 mục
    if ($action === 'toggle_item') {
        check_admin_referer('hieugara_about_toggle_nonce');
        $item_id = sanitize_text_field($_GET['item_id'] ?? '');
        if (isset($items[$item_id])) {
            $items[$item_id]['enable'] = empty($items[$item_id]['enable']) ? '1' : '0';
            update_option('hieugara_about_menu_items', $items);
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
        }
        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'msg' => 'toggle_success'), admin_url('admin.php')));
        exit;
    }

    // ACTION: Lưu (Thêm mới hoặc Cập nhật)
    if ($action === 'save_item') {
        check_admin_referer('hieugara_about_save_nonce');

        $item_id = !empty($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : (string) time();
        $title   = sanitize_text_field($_POST['title'] ?? '');
        $link    = esc_url_raw($_POST['link'] ?? '');
        $icon    = sanitize_text_field($_POST['icon'] ?? '');
        $target  = in_array($_POST['target'] ?? '_self', array('_self', '_blank')) ? $_POST['target'] : '_self';
        $order   = intval($_POST['order'] ?? 1);
        $enable  = !empty($_POST['enable']) ? '1' : '0';

        if (empty($title) || empty($link)) {
            wp_safe_redirect(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'msg' => 'missing_fields'), admin_url('admin.php')));
            exit;
        }

        $items[$item_id] = array(
            'id'     => $item_id,
            'title'  => $title,
            'link'   => $link,
            'icon'   => $icon,
            'target' => $target,
            'order'  => $order,
            'enable' => $enable,
        );

        update_option('hieugara_about_menu_items', $items);
        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }

        wp_safe_redirect(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'msg' => 'save_success'), admin_url('admin.php')));
        exit;
    }
}
add_action('admin_init', 'hieugara_handle_about_menu_crud_actions');

/**
 * 5. Giao Diện Quản Trị CRUD Menu Giới Thiệu
 */
function hieugara_render_about_menu_crud_page() {
    $items = hieugara_get_about_menu_items();

    $edit_item = null;
    if (isset($_GET['action']) && $_GET['action'] === 'edit' && !empty($_GET['item_id'])) {
        $edit_id = sanitize_text_field($_GET['item_id']);
        if (isset($items[$edit_id])) {
            $edit_item = $items[$edit_id];
        }
    }

    $msg = sanitize_text_field($_GET['msg'] ?? '');
    $total_items  = count($items);
    $active_items = count(array_filter($items, fn($it) => !empty($it['enable'])));
    ?>
    <div class="wrap hieugara-admin-wrap" style="max-width: 1200px; margin: 25px auto;">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #141414 0%, #1f2937 100%); color: #fff; padding: 28px 32px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <span style="background: #D4B996; color: #141414; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 4px; text-transform: uppercase;">Quản Lý Menu Header</span>
                    <h1 style="color: #fff; font-size: 24px; font-weight: 800; margin: 8px 0 6px;">📋 Danh Mục "GIỚI THIỆU" (CRUD Trực Quan)</h1>
                    <p style="color: #9CA3AF; margin: 0; font-size: 14px;">Tự do Thêm mới, Chỉnh sửa, Bật/Tắt, Sắp xếp thứ tự hoặc Xóa các mục trong menu xổ xuống "GIỚI THIỆU" của website.</p>
                </div>
                <div>
                    <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'hieugara_about_action' => 'reset_defaults'), admin_url('admin.php')), 'hieugara_about_reset_nonce')); ?>" 
                       class="button" 
                       onclick="return confirm('Bạn có chắc muốn khôi phục về danh mục chuẩn ban đầu?');"
                       style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); font-weight: 600; padding: 6px 16px; border-radius: 6px;">
                        ↺ Khôi Phục Mặc Định
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if ($msg === 'save_success') : ?>
            <div class="notice notice-success is-dismissible"><p><strong>Thành công:</strong> Đã lưu thông tin mục menu thành công và xóa cache website.</p></div>
        <?php elseif ($msg === 'del_success') : ?>
            <div class="notice notice-success is-dismissible"><p><strong>Đã xóa:</strong> Đã xóa mục menu thành công.</p></div>
        <?php elseif ($msg === 'toggle_success') : ?>
            <div class="notice notice-info is-dismissible"><p><strong>Đã cập nhật:</strong> Đã thay đổi trạng thái hiển thị của mục menu.</p></div>
        <?php elseif ($msg === 'reset_success') : ?>
            <div class="notice notice-warning is-dismissible"><p><strong>Đã khôi phục:</strong> Đã đưa danh mục Giới Thiệu về 3 mục chuẩn ban đầu.</p></div>
        <?php elseif ($msg === 'missing_fields') : ?>
            <div class="notice notice-error is-dismissible"><p><strong>Lỗi:</strong> Vui lòng nhập đầy đủ Tiêu đề và Đường dẫn Link.</p></div>
        <?php endif; ?>

        <!-- Stats Bar -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
            <div style="background: #fff; padding: 18px 20px; border-radius: 10px; border: 1px solid #E5E7EB; border-left: 4px solid #141414;">
                <span style="color: #6B7280; font-size: 13px; font-weight: 600;">Tổng số mục menu</span>
                <h3 style="margin: 5px 0 0; font-size: 26px; font-weight: 800; color: #141414;"><?php echo esc_html($total_items); ?></h3>
            </div>
            <div style="background: #fff; padding: 18px 20px; border-radius: 10px; border: 1px solid #E5E7EB; border-left: 4px solid #10B981;">
                <span style="color: #6B7280; font-size: 13px; font-weight: 600;">Đang hiển thị trên Web</span>
                <h3 style="margin: 5px 0 0; font-size: 26px; font-weight: 800; color: #10B981;"><?php echo esc_html($active_items); ?></h3>
            </div>
            <div style="background: #fff; padding: 18px 20px; border-radius: 10px; border: 1px solid #E5E7EB; border-left: 4px solid #EF4444;">
                <span style="color: #6B7280; font-size: 13px; font-weight: 600;">Đang tạm ẩn</span>
                <h3 style="margin: 5px 0 0; font-size: 26px; font-weight: 800; color: #EF4444;"><?php echo esc_html($total_items - $active_items); ?></h3>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 380px; gap: 25px; align-items: start;">
            
            <!-- Table List (Left) -->
            <div style="background: #fff; border-radius: 10px; border: 1px solid #E5E7EB; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="padding: 16px 20px; border-bottom: 1px solid #E5E7EB; background: #F9FAFB; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #141414;">Danh Sách Mục Menu Hiện Tại</h3>
                    <span style="font-size: 12px; color: #6B7280;">Hiển thị trực tiếp trong dropdown "GIỚI THIỆU"</span>
                </div>

                <table class="wp-list-table widefat fixed striped table-view-list" style="border: none;">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">Thứ tự</th>
                            <th style="width: 220px;">Tiêu đề hiển thị</th>
                            <th>Đường dẫn liên kết (URL)</th>
                            <th style="width: 100px; text-align: center;">Trạng thái</th>
                            <th style="width: 160px; text-align: right;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)) : ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: #6B7280;">Chưa có mục nào. Hãy dùng form bên phải để thêm mới.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($items as $it_id => $it) : 
                                $is_active = !empty($it['enable']);
                            ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 700; color: #141414;"><?php echo esc_html($it['order'] ?? 1); ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <?php if (!empty($it['icon'])) : ?>
                                                <i class="<?php echo esc_attr($it['icon']); ?>" style="color: #D97706; width: 18px; text-align: center;"></i>
                                            <?php endif; ?>
                                            <strong><?php echo esc_html($it['title']); ?></strong>
                                            <?php if (($it['target'] ?? '_self') === '_blank') : ?>
                                                <span title="Mở trong tab mới" style="font-size: 10px; background: #E5E7EB; color: #374151; padding: 2px 5px; border-radius: 3px;">Tab mới</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo esc_url($it['link']); ?>" target="_blank" style="color: #2563EB; font-family: monospace; font-size: 12px; text-decoration: none; word-break: break-all;">
                                            <?php echo esc_html($it['link']); ?> ↗
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($is_active) : ?>
                                            <span style="background: #DEF7EC; color: #03543F; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 9999px;">Đang hiện</span>
                                        <?php else : ?>
                                            <span style="background: #F3F4F6; color: #6B7280; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 9999px;">Tạm ẩn</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="<?php echo esc_url(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'action' => 'edit', 'item_id' => $it_id), admin_url('admin.php'))); ?>" 
                                           class="button button-small" style="font-size: 12px;">Sửa</a>
                                        
                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'hieugara_about_action' => 'toggle_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_about_toggle_nonce')); ?>" 
                                           class="button button-small" style="font-size: 12px;" title="Bật/Tắt hiển thị">
                                            <?php echo $is_active ? 'Ẩn' : 'Hiện'; ?>
                                        </a>

                                        <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('page' => 'hieugara-about-menu-crud', 'hieugara_about_action' => 'delete_item', 'item_id' => $it_id), admin_url('admin.php')), 'hieugara_about_del_nonce')); ?>" 
                                           class="button button-small button-link-delete" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa mục: <?php echo esc_attr($it['title']); ?>?');"
                                           style="font-size: 12px; color: #DC2626;">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form Add/Edit (Right) -->
            <div style="background: #fff; border-radius: 10px; border: 1px solid #E5E7EB; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; font-size: 16px; font-weight: 800; color: #141414; padding-bottom: 12px; border-bottom: 1px solid #E5E7EB;">
                    <?php echo $edit_item ? '✏️ Chỉnh Sửa Mục Menu' : '➕ Thêm Mục Menu Mới'; ?>
                </h3>

                <form method="POST" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-about-menu-crud')); ?>">
                    <?php wp_nonce_field('hieugara_about_save_nonce'); ?>
                    <input type="hidden" name="hieugara_about_action" value="save_item">
                    <?php if ($edit_item) : ?>
                        <input type="hidden" name="item_id" value="<?php echo esc_attr($edit_item['id']); ?>">
                    <?php endif; ?>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 6px;">
                            Tiêu đề hiển thị <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="title" required value="<?php echo esc_attr($edit_item['title'] ?? ''); ?>" placeholder="VD: Về Chúng Tôi, Đội Ngũ Kỹ Sư..." style="width: 100%; border-radius: 6px; padding: 8px 12px;">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 6px;">
                            Đường dẫn liên kết (URL) <span style="color: #DC2626;">*</span>
                        </label>
                        <input type="text" name="link" required value="<?php echo esc_attr($edit_item['link'] ?? ''); ?>" placeholder="VD: /ve-chung-toi/ hoặc https://..." style="width: 100%; border-radius: 6px; padding: 8px 12px;">
                        <small style="color: #6B7280; font-size: 11px;">Có thể điền link trang nội bộ hoặc link neo hashtag (#su-kien).</small>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 6px;">
                            Icon FontAwesome (Tùy chọn)
                        </label>
                        <input type="text" name="icon" value="<?php echo esc_attr($edit_item['icon'] ?? 'fa-solid fa-angle-right'); ?>" placeholder="VD: fa-solid fa-building" style="width: 100%; border-radius: 6px; padding: 8px 12px;">
                        <small style="color: #6B7280; font-size: 11px;">VD: <code>fa-solid fa-building</code>, <code>fa-solid fa-bullhorn</code>, <code>fa-solid fa-certificate</code></small>
                    </div>

                    <div style="margin-bottom: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 6px;">
                                Thứ tự ưu tiên
                            </label>
                            <input type="number" name="order" value="<?php echo esc_attr($edit_item['order'] ?? (count($items) + 1)); ?>" min="1" max="99" style="width: 100%; border-radius: 6px; padding: 8px 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 6px;">
                                Cửa sổ mở link
                            </label>
                            <select name="target" style="width: 100%; border-radius: 6px; height: 38px;">
                                <option value="_self" <?php selected($edit_item['target'] ?? '_self', '_self'); ?>>Cùng tab (_self)</option>
                                <option value="_blank" <?php selected($edit_item['target'] ?? '_self', '_blank'); ?>>Tab mới (_blank)</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 22px;">
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 13px; color: #374151; cursor: pointer;">
                            <input type="checkbox" name="enable" value="1" <?php checked($edit_item['enable'] ?? '1', '1'); ?>>
                            <span>Kích hoạt hiển thị trên Menu website</span>
                        </label>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="button button-primary" style="background: #141414; border-color: #141414; font-weight: 700; padding: 6px 20px; height: auto;">
                            <?php echo $edit_item ? 'Cập Nhật Mục' : 'Thêm Vào Menu'; ?>
                        </button>

                        <?php if ($edit_item) : ?>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-about-menu-crud')); ?>" class="button">Hủy</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <?php
}

