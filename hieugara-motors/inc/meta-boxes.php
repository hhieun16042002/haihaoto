<?php
/**
 * Register Custom Meta Boxes for Garage Services
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_add_service_meta_boxes() {
    add_meta_box(
        'hieugara_service_details',
        __('Thông Tin Chi Tiết Gói Dịch Vụ', 'hieugara-motors'),
        'hieugara_render_service_meta_box',
        'garage_service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hieugara_add_service_meta_boxes');

function hieugara_render_service_meta_box($post) {
    wp_nonce_field('hieugara_save_service_meta', 'hieugara_service_meta_nonce');

    $price_from = get_post_meta($post->ID, '_garage_price_from', true);
    $duration   = get_post_meta($post->ID, '_garage_duration', true);
    $warranty   = get_post_meta($post->ID, '_garage_warranty', true);
    $badge      = get_post_meta($post->ID, '_garage_badge', true);
    $features   = get_post_meta($post->ID, '_garage_features', true);
    ?>
    <style>
        .gara-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px; }
        .gara-meta-field { display: flex; flex-direction: column; }
        .gara-meta-field label { font-weight: 600; margin-bottom: 5px; color: #0f172a; }
        .gara-meta-field input, .gara-meta-field textarea { padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 4px; }
        .gara-meta-field small { color: #64748b; margin-top: 4px; }
    </style>

    <div class="gara-meta-grid">
        <div class="gara-meta-field">
            <label for="garage_price_from"><?php _e('Giá dịch vụ từ (VNĐ):', 'hieugara-motors'); ?></label>
            <input type="text" id="garage_price_from" name="garage_price_from" value="<?php echo esc_attr($price_from); ?>" placeholder="VD: 500.000 đ hoặc Liên hệ">
            <small><?php _e('Hiển thị mức giá khởi điểm của gói dịch vụ', 'hieugara-motors'); ?></small>
        </div>

        <div class="gara-meta-field">
            <label for="garage_badge"><?php _e('Huy hiệu / Badge nổi bật:', 'hieugara-motors'); ?></label>
            <input type="text" id="garage_badge" name="garage_badge" value="<?php echo esc_attr($badge); ?>" placeholder="VD: LẤY TRONG NGÀY | BẢO HÀNH 2 NĂM">
        </div>

        <div class="gara-meta-field">
            <label for="garage_duration"><?php _e('Thời gian thi công ước tính:', 'hieugara-motors'); ?></label>
            <input type="text" id="garage_duration" name="garage_duration" value="<?php echo esc_attr($duration); ?>" placeholder="VD: 4 - 6 tiếng / 1 - 2 ngày">
        </div>

        <div class="gara-meta-field">
            <label for="garage_warranty"><?php _e('Thời hạn bảo hành:', 'hieugara-motors'); ?></label>
            <input type="text" id="garage_warranty" name="garage_warranty" value="<?php echo esc_attr($warranty); ?>" placeholder="VD: 12 tháng / 24 tháng">
        </div>
    </div>

    <div class="gara-meta-field" style="margin-top: 15px;">
        <label for="garage_features"><?php _e('Các điểm nổi bật / Hạng mục kiểm tra (Mỗi dòng 1 gạch đầu dòng):', 'hieugara-motors'); ?></label>
        <textarea id="garage_features" name="garage_features" rows="4" placeholder="Sơn phòng sấy đạt chuẩn công nghệ cao
Sử dụng sơn Dupont / PPG chính hãng
Miễn phí đánh bóng toàn bộ xe sau khi làm
Bảo hành không bong tróc, bay màu"><?php echo esc_textarea($features); ?></textarea>
    </div>
    <?php
}

function hieugara_save_service_meta($post_id) {
    if (!isset($_POST['hieugara_service_meta_nonce']) || !wp_verify_nonce($_POST['hieugara_service_meta_nonce'], 'hieugara_save_service_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'garage_price_from' => '_garage_price_from',
        'garage_badge'      => '_garage_badge',
        'garage_duration'   => '_garage_duration',
        'garage_warranty'   => '_garage_warranty',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    if (isset($_POST['garage_features'])) {
        update_post_meta($post_id, '_garage_features', sanitize_textarea_field($_POST['garage_features']));
    }
}
add_action('save_post_garage_service', 'hieugara_save_service_meta');

