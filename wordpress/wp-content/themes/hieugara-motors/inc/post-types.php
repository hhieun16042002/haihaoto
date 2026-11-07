<?php
/**
 * Register Custom Post Types and Taxonomies for Hiếu Gara
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_register_service_post_type() {
    // 1. Taxonomy: Danh mục dịch vụ
    $cat_labels = array(
        'name'              => _x('Danh mục dịch vụ', 'taxonomy general name', 'hieugara-motors'),
        'singular_name'     => _x('Danh mục dịch vụ', 'taxonomy singular name', 'hieugara-motors'),
        'search_items'      => __('Tìm danh mục', 'hieugara-motors'),
        'all_items'         => __('Tất cả danh mục', 'hieugara-motors'),
        'parent_item'       => __('Danh mục cha', 'hieugara-motors'),
        'parent_item_colon' => __('Danh mục cha:', 'hieugara-motors'),
        'edit_item'         => __('Sửa danh mục', 'hieugara-motors'),
        'update_item'       => __('Cập nhật danh mục', 'hieugara-motors'),
        'add_new_item'      => __('Thêm danh mục mới', 'hieugara-motors'),
        'new_item_name'     => __('Tên danh mục mới', 'hieugara-motors'),
        'menu_name'         => __('Danh mục dịch vụ', 'hieugara-motors'),
    );

    register_taxonomy('service_category', array('garage_service'), array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'chuyen-muc-dich-vu', 'with_front' => false),
    ));

    // 2. Custom Post Type: Dịch vụ Gara (garage_service)
    $service_labels = array(
        'name'                  => _x('Dịch vụ Gara', 'Post type general name', 'hieugara-motors'),
        'singular_name'         => _x('Dịch vụ', 'Post type singular name', 'hieugara-motors'),
        'menu_name'             => _x('Dịch vụ Gara', 'Admin Menu text', 'hieugara-motors'),
        'name_admin_bar'        => _x('Dịch vụ', 'Add New on Toolbar', 'hieugara-motors'),
        'add_new'               => __('Thêm dịch vụ mới', 'hieugara-motors'),
        'add_new_item'          => __('Thêm gói dịch vụ mới', 'hieugara-motors'),
        'new_item'              => __('Dịch vụ mới', 'hieugara-motors'),
        'edit_item'             => __('Sửa dịch vụ', 'hieugara-motors'),
        'view_item'             => __('Xem dịch vụ', 'hieugara-motors'),
        'all_items'             => __('Tất cả dịch vụ', 'hieugara-motors'),
        'search_items'          => __('Tìm kiếm dịch vụ', 'hieugara-motors'),
        'not_found'             => __('Không tìm thấy dịch vụ nào.', 'hieugara-motors'),
        'not_found_in_trash'    => __('Không có dịch vụ trong thùng rác.', 'hieugara-motors'),
        'featured_image'        => __('Ảnh đại diện dịch vụ', 'hieugara-motors'),
        'set_featured_image'    => __('Chọn ảnh dịch vụ', 'hieugara-motors'),
        'remove_featured_image' => __('Xóa ảnh', 'hieugara-motors'),
        'use_featured_image'    => __('Dùng làm ảnh đại diện', 'hieugara-motors'),
    );

    $service_args = array(
        'labels'             => $service_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'dich-vu', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-hammer',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('garage_service', $service_args);

    // =========================================================================
    // 3. TAXONOMY & CUSTOM POST TYPE: PHỤ KIỆN Ô TÔ (garage_accessory)
    // Lưu trữ trực tiếp trên website, không điều hướng sang website khác
    // =========================================================================
    $acc_cat_labels = array(
        'name'              => _x('Danh mục phụ kiện', 'taxonomy general name', 'hieugara-motors'),
        'singular_name'     => _x('Danh mục phụ kiện', 'taxonomy singular name', 'hieugara-motors'),
        'search_items'      => __('Tìm danh mục phụ kiện', 'hieugara-motors'),
        'all_items'         => __('Tất cả danh mục phụ kiện', 'hieugara-motors'),
        'parent_item'       => __('Danh mục cha', 'hieugara-motors'),
        'parent_item_colon' => __('Danh mục cha:', 'hieugara-motors'),
        'edit_item'         => __('Sửa danh mục', 'hieugara-motors'),
        'update_item'       => __('Cập nhật danh mục', 'hieugara-motors'),
        'add_new_item'      => __('Thêm danh mục mới', 'hieugara-motors'),
        'new_item_name'     => __('Tên danh mục mới', 'hieugara-motors'),
        'menu_name'         => __('Danh mục phụ kiện', 'hieugara-motors'),
    );

    register_taxonomy('accessory_category', array('garage_accessory'), array(
        'hierarchical'      => true,
        'labels'            => $acc_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'danh-muc-phu-kien', 'with_front' => false),
    ));

    $acc_labels = array(
        'name'                  => _x('Phụ Kiện Ô Tô', 'Post type general name', 'hieugara-motors'),
        'singular_name'         => _x('Phụ Kiện', 'Post type singular name', 'hieugara-motors'),
        'menu_name'             => _x('Phụ Kiện Ô Tô', 'Admin Menu text', 'hieugara-motors'),
        'name_admin_bar'        => _x('Phụ Kiện', 'Add New on Toolbar', 'hieugara-motors'),
        'add_new'               => __('Thêm phụ kiện mới', 'hieugara-motors'),
        'add_new_item'          => __('Thêm sản phẩm phụ kiện mới', 'hieugara-motors'),
        'new_item'              => __('Phụ kiện mới', 'hieugara-motors'),
        'edit_item'             => __('Sửa phụ kiện', 'hieugara-motors'),
        'view_item'             => __('Xem phụ kiện trên web', 'hieugara-motors'),
        'all_items'             => __('Tất cả phụ kiện', 'hieugara-motors'),
        'search_items'          => __('Tìm kiếm phụ kiện', 'hieugara-motors'),
        'not_found'             => __('Không tìm thấy phụ kiện nào.', 'hieugara-motors'),
        'not_found_in_trash'    => __('Không có phụ kiện trong thùng rác.', 'hieugara-motors'),
        'featured_image'        => __('Ảnh sản phẩm phụ kiện', 'hieugara-motors'),
        'set_featured_image'    => __('Chọn ảnh sản phẩm', 'hieugara-motors'),
        'remove_featured_image' => __('Xóa ảnh', 'hieugara-motors'),
        'use_featured_image'    => __('Dùng làm ảnh đại diện', 'hieugara-motors'),
    );

    $acc_args = array(
        'labels'             => $acc_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'phu-kien-oto', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-car',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('garage_accessory', $acc_args);
}
add_action('init', 'hieugara_register_service_post_type');

// =========================================================================
// 4. META BOXES FOR GARAGE ACCESSORY (CRUD trong Admin WP)
// =========================================================================
function hieugara_add_accessory_meta_boxes() {
    add_meta_box(
        'hieugara_accessory_details',
        __('Thông Tin Giá Bán & Thông Số Phụ Kiện', 'hieugara-motors'),
        'hieugara_render_accessory_meta_box',
        'garage_accessory',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hieugara_add_accessory_meta_boxes');

function hieugara_render_accessory_meta_box($post) {
    wp_nonce_field('hieugara_save_accessory_meta', 'hieugara_accessory_nonce');

    $price       = get_post_meta($post->ID, '_accessory_price', true);
    $old_price   = get_post_meta($post->ID, '_accessory_old_price', true);
    $badge       = get_post_meta($post->ID, '_accessory_badge', true);
    $brand       = get_post_meta($post->ID, '_accessory_brand', true);
    $warranty    = get_post_meta($post->ID, '_accessory_warranty', true);
    $origin      = get_post_meta($post->ID, '_accessory_origin', true);
    $custom_img  = get_post_meta($post->ID, '_accessory_img', true);
    $specs       = get_post_meta($post->ID, '_accessory_specs', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 10px;">
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Giá bán hiện tại (VNĐ):</label>
            <input type="text" name="_accessory_price" value="<?php echo esc_attr($price); ?>" placeholder="VD: 3.690.000" style="width: 100%;">
            <small style="color: #64748b;">Giá hiển thị chính thức của sản phẩm</small>
        </div>
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Giá niêm yết cũ (gạch ngang):</label>
            <input type="text" name="_accessory_old_price" value="<?php echo esc_attr($old_price); ?>" placeholder="VD: 4.200.000" style="width: 100%;">
            <small style="color: #64748b;">Để trống nếu không có giảm giá</small>
        </div>
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Thương hiệu / Hãng:</label>
            <input type="text" name="_accessory_brand" value="<?php echo esc_attr($brand); ?>" placeholder="VD: Michelin, Zestech, 70mai..." style="width: 100%;">
        </div>
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Nhãn huy hiệu (Badge):</label>
            <input type="text" name="_accessory_badge" value="<?php echo esc_attr($badge); ?>" placeholder="VD: BÁN CHẠY, CHÍNH HÃNG, 100%..." style="width: 100%;">
        </div>
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Thời gian bảo hành:</label>
            <input type="text" name="_accessory_warranty" value="<?php echo esc_attr($warranty); ?>" placeholder="VD: 12 tháng 1 đổi 1" style="width: 100%;">
        </div>
        <div>
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Xuất xứ / Nguồn gốc:</label>
            <input type="text" name="_accessory_origin" value="<?php echo esc_attr($origin); ?>" placeholder="VD: Phân phối chính hãng META.vn" style="width: 100%;">
        </div>
        <div style="grid-column: span 2;">
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Đường dẫn ảnh sản phẩm (URL tùy chọn nếu không upload ảnh đại diện):</label>
            <input type="text" name="_accessory_img" value="<?php echo esc_attr($custom_img); ?>" placeholder="VD: http://.../michelin.jpg" style="width: 100%;">
        </div>
        <div style="grid-column: span 2;">
            <label style="font-weight: 700; display: block; margin-bottom: 5px;">Thông số kỹ thuật tóm tắt (Mỗi dòng một thông số dạng "Tên thông số: Giá trị"):</label>
            <textarea name="_accessory_specs" rows="5" style="width: 100%; font-family: monospace;"><?php echo esc_textarea($specs); ?></textarea>
            <small style="color: #64748b;">Ví dụ:<br>Độ phân giải: 4K UHD 3840 x 2160P<br>Cảm biến: Sony Starvis 2 IMX678<br>Góc quay: 150 độ rộng</small>
        </div>
    </div>
    <?php
}

function hieugara_save_accessory_meta($post_id) {
    if (!isset($_POST['hieugara_accessory_nonce']) || !wp_verify_nonce($_POST['hieugara_accessory_nonce'], 'hieugara_save_accessory_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('_accessory_price', '_accessory_old_price', '_accessory_badge', '_accessory_brand', '_accessory_warranty', '_accessory_origin', '_accessory_img');
    foreach ($fields as $f) {
        if (isset($_POST[$f])) {
            update_post_meta($post_id, $f, sanitize_text_field($_POST[$f]));
        }
    }
    if (isset($_POST['_accessory_specs'])) {
        update_post_meta($post_id, '_accessory_specs', sanitize_textarea_field($_POST['_accessory_specs']));
    }
}
add_action('save_post_garage_accessory', 'hieugara_save_accessory_meta');

// Admin Columns for garage_accessory
function hieugara_accessory_columns($columns) {
    $new_cols = array();
    $new_cols['cb'] = $columns['cb'];
    $new_cols['acc_thumb'] = __('Ảnh', 'hieugara-motors');
    $new_cols['title'] = __('Tên phụ kiện', 'hieugara-motors');
    $new_cols['acc_price'] = __('Giá bán', 'hieugara-motors');
    $new_cols['acc_brand'] = __('Thương hiệu', 'hieugara-motors');
    $new_cols['acc_badge'] = __('Nhãn', 'hieugara-motors');
    $new_cols['taxonomy-accessory_category'] = __('Danh mục', 'hieugara-motors');
    $new_cols['date'] = $columns['date'];
    return $new_cols;
}
add_filter('manage_garage_accessory_posts_columns', 'hieugara_accessory_columns');

function hieugara_accessory_custom_column($column, $post_id) {
    if ($column === 'acc_thumb') {
        $thumb = get_the_post_thumbnail_url($post_id, 'thumbnail');
        if (!$thumb) {
            $thumb = get_post_meta($post_id, '_accessory_img', true);
        }
        if ($thumb) {
            echo '<img src="' . esc_url($thumb) . '" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">';
        } else {
            echo '<span style="color:#94a3b8;">Không có ảnh</span>';
        }
    } elseif ($column === 'acc_price') {
        $price = get_post_meta($post_id, '_accessory_price', true);
        $old_price = get_post_meta($post_id, '_accessory_old_price', true);
        echo '<strong>' . esc_html($price ? $price . ' đ' : 'Liên hệ') . '</strong>';
        if ($old_price) {
            echo '<br><small style="color:#94a3b8; text-decoration: line-through;">' . esc_html($old_price) . ' đ</small>';
        }
    } elseif ($column === 'acc_brand') {
        echo esc_html(get_post_meta($post_id, '_accessory_brand', true) ?: '—');
    } elseif ($column === 'acc_badge') {
        $b = get_post_meta($post_id, '_accessory_badge', true);
        if ($b) {
            echo '<span style="background: #C5A880; color: #141414; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight: 700;">' . esc_html($b) . '</span>';
        } else {
            echo '—';
        }
    }
}
add_action('manage_garage_accessory_posts_custom_column', 'hieugara_accessory_custom_column', 10, 2);

