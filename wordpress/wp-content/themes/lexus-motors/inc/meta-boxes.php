<?php
/**
 * Register Custom Meta Boxes for Lexus Vehicles
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function lexus_add_vehicle_meta_boxes() {
    add_meta_box(
        'lexus_vehicle_specs',
        __('Thông Số Kỹ Thuật & Giá Bán (Lexus Luxury Specs)', 'lexus-motors'),
        'lexus_render_vehicle_specs_meta_box',
        'lexus_vehicle',
        'normal',
        'high'
    );

    add_meta_box(
        'lexus_vehicle_colors',
        __('Bộ Sưu Tập Màu Ngoại Thất (Color Switcher)', 'lexus-motors'),
        'lexus_render_vehicle_colors_meta_box',
        'lexus_vehicle',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'lexus_add_vehicle_meta_boxes');

function lexus_render_vehicle_specs_meta_box($post) {
    wp_nonce_field('lexus_save_vehicle_meta', 'lexus_vehicle_meta_nonce');

    $price         = get_post_meta($post->ID, '_lexus_price', true);
    $tagline       = get_post_meta($post->ID, '_lexus_tagline', true);
    $engine        = get_post_meta($post->ID, '_lexus_engine', true);
    $horsepower    = get_post_meta($post->ID, '_lexus_horsepower', true);
    $torque        = get_post_meta($post->ID, '_lexus_torque', true);
    $acceleration  = get_post_meta($post->ID, '_lexus_acceleration', true);
    $transmission  = get_post_meta($post->ID, '_lexus_transmission', true);
    $fuel_economy  = get_post_meta($post->ID, '_lexus_fuel_economy', true);
    $brochure_url  = get_post_meta($post->ID, '_lexus_brochure_url', true);
    $badge         = get_post_meta($post->ID, '_lexus_badge', true);
    ?>
    <style>
        .lexus-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px; }
        .lexus-meta-field { display: flex; flex-direction: column; }
        .lexus-meta-field label { font-weight: 600; margin-bottom: 5px; color: #1d2327; }
        .lexus-meta-field input { padding: 8px 12px; border: 1px solid #8c8f94; border-radius: 4px; }
        .lexus-meta-field small { color: #646970; margin-top: 4px; }
    </style>

    <div class="lexus-meta-grid">
        <div class="lexus-meta-field">
            <label for="lexus_price"><?php _e('Giá niêm yết (VNĐ):', 'lexus-motors'); ?></label>
            <input type="number" id="lexus_price" name="lexus_price" value="<?php echo esc_attr($price); ?>" placeholder="VD: 3430000000">
            <small><?php _e('Nhập số nguyên, không dấu chấm phẩy (VD: 3430000000 = 3,430,000,000 VNĐ)', 'lexus-motors'); ?></small>
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_badge"><?php _e('Huy hiệu / Badge nổi bật:', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_badge" name="lexus_badge" value="<?php echo esc_attr($badge); ?>" placeholder="VD: HYBRID | F SPORT | HOÀN TOÀN MỚI">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_tagline"><?php _e('Thông điệp dòng xe (Tagline):', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_tagline" name="lexus_tagline" value="<?php echo esc_attr($tagline); ?>" placeholder="VD: Khẳng định vị thế dẫn đầu">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_engine"><?php _e('Động cơ:', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_engine" name="lexus_engine" value="<?php echo esc_attr($engine); ?>" placeholder="VD: 2.4L Turbo 4 xi-lanh / 2.5L Hybrid">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_horsepower"><?php _e('Công suất cực đại (HP):', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_horsepower" name="lexus_horsepower" value="<?php echo esc_attr($horsepower); ?>" placeholder="VD: 275 mã lực @ 6,000 vòng/phút">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_torque"><?php _e('Mô-men xoắn cực đại (Nm):', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_torque" name="lexus_torque" value="<?php echo esc_attr($torque); ?>" placeholder="VD: 430 Nm @ 1,700 - 3,600 vòng/phút">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_acceleration"><?php _e('Tăng tốc 0 - 100 km/h:', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_acceleration" name="lexus_acceleration" value="<?php echo esc_attr($acceleration); ?>" placeholder="VD: 7.6 giây">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_transmission"><?php _e('Hộp số:', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_transmission" name="lexus_transmission" value="<?php echo esc_attr($transmission); ?>" placeholder="VD: Tự động 8 cấp Direct-Shift">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_fuel_economy"><?php _e('Tiêu thụ nhiên liệu kết hợp:', 'lexus-motors'); ?></label>
            <input type="text" id="lexus_fuel_economy" name="lexus_fuel_economy" value="<?php echo esc_attr($fuel_economy); ?>" placeholder="VD: 8.5L / 100km">
        </div>

        <div class="lexus-meta-field">
            <label for="lexus_brochure_url"><?php _e('Đường dẫn tải Catalogue (PDF):', 'lexus-motors'); ?></label>
            <input type="url" id="lexus_brochure_url" name="lexus_brochure_url" value="<?php echo esc_attr($brochure_url); ?>" placeholder="https://...">
        </div>
    </div>
    <?php
}

function lexus_render_vehicle_colors_meta_box($post) {
    $colors_raw = get_post_meta($post->ID, '_lexus_colors_data', true);
    ?>
    <p><?php _e('Nhập danh sách màu ngoại thất (mỗi màu 1 dòng theo cú pháp: <code>Tên màu | Mã màu Hex (#...) | Link ảnh xe</code>):', 'lexus-motors'); ?></p>
    <textarea name="lexus_colors_data" rows="5" style="width: 100%; font-family: monospace;" placeholder="Trắng Sonic Quartz | #f4f4f4 | https://...
Đen Sonic Agate | #111111 | https://...
Xám Sonic Chrome | #555555 | https://..."><?php echo esc_textarea($colors_raw); ?></textarea>
    <small><?php _e('Ví dụ: <code>Trắng Sonic Quartz | #f5f5f7 | https://domain.com/car-white.png</code>', 'lexus-motors'); ?></small>
    <?php
}

function lexus_save_vehicle_meta($post_id) {
    if (!isset($_POST['lexus_vehicle_meta_nonce']) || !wp_verify_nonce($_POST['lexus_vehicle_meta_nonce'], 'lexus_save_vehicle_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'lexus_price'        => '_lexus_price',
        'lexus_badge'        => '_lexus_badge',
        'lexus_tagline'      => '_lexus_tagline',
        'lexus_engine'       => '_lexus_engine',
        'lexus_horsepower'   => '_lexus_horsepower',
        'lexus_torque'       => '_lexus_torque',
        'lexus_acceleration' => '_lexus_acceleration',
        'lexus_transmission' => '_lexus_transmission',
        'lexus_fuel_economy' => '_lexus_fuel_economy',
        'lexus_brochure_url' => '_lexus_brochure_url',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    if (isset($_POST['lexus_colors_data'])) {
        update_post_meta($post_id, '_lexus_colors_data', sanitize_textarea_field($_POST['lexus_colors_data']));
    }
}
add_action('save_post_lexus_vehicle', 'lexus_save_vehicle_meta');

