<?php
/**
 * Dedicated Custom Banner Image Manager for WordPress Categories
 * Allows users to add, edit, and delete hero banners directly when managing categories.
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get fallback banner URL for categories
 */
function hieugara_get_category_default_banner_url() {
    if (function_exists('hieugara_get_page_banner_url')) {
        return hieugara_get_page_banner_url('blog');
    }
    return get_template_directory_uri() . '/assets/images/banners/banner-blog.jpg';
}

/**
 * 1. Add Category Banner field on "Add New Category" screen (edit-tags.php?taxonomy=category)
 */
function hieugara_category_banner_add_form_field($taxonomy) {
    $default_banner = hieugara_get_category_default_banner_url();
    ?>
    <div class="form-field term-group hieugara-term-banner-wrap" style="background: #fdfdfd; padding: 14px; border: 1px solid #dcdcde; border-radius: 8px; margin-top: 15px; margin-bottom: 15px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
        <label for="hieugara_cat_banner_input" style="font-weight: 600; font-size: 13px; color: #1d2327; margin-bottom: 8px; display: block;">
            <span class="dashicons dashicons-format-image" style="vertical-align: text-bottom; margin-right: 4px; color: #c5a880;"></span>
            <?php _e('Ảnh Banner Đầu Trang (Hero Banner)', 'hieugara-motors'); ?>
        </label>
        
        <div class="banner-preview-box" style="margin-bottom: 10px; position: relative;">
            <img id="hieugara_cat_banner_preview" src="<?php echo esc_url($default_banner); ?>" style="max-width: 100%; height: 115px; width: 100%; object-fit: cover; border-radius: 6px; border: 1px solid #ccd0d4; display: block; background: #141414;" alt="Banner Preview">
            <span class="banner-status-badge" style="position: absolute; bottom: 6px; right: 6px; background: rgba(0,0,0,0.68); color: #fff; font-size: 11px; padding: 2px 7px; border-radius: 4px;"><?php _e('Xem trước', 'hieugara-motors'); ?></span>
        </div>

        <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 6px;">
            <input type="text" name="hieugara_category_banner" id="hieugara_cat_banner_input" value="" placeholder="<?php esc_attr_e('Chọn ảnh hoặc dán link ảnh banner...', 'hieugara-motors'); ?>" style="flex: 1;" />
            <button type="button" class="button button-secondary hieugara-cat-banner-upload-btn" style="white-space: nowrap;">
                <span class="dashicons dashicons-upload" style="vertical-align: middle; margin-top: -2px;"></span> <?php _e('Chọn ảnh', 'hieugara-motors'); ?>
            </button>
            <button type="button" class="button button-link-delete hieugara-cat-banner-remove-btn" style="display: none; white-space: nowrap;">
                <?php _e('Xóa', 'hieugara-motors'); ?>
            </button>
        </div>

        <p class="description" style="margin-top: 4px; font-size: 12px; color: #646970; line-height: 1.45;">
            <?php _e('Kích thước đề xuất: 1920x450px hoặc tỉ lệ 16:9 sắc nét. Nếu để trống, hệ thống sẽ sử dụng ảnh banner mặc định của Blog.', 'hieugara-motors'); ?>
        </p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'hieugara_category_banner_add_form_field');

/**
 * 2. Edit Category Banner field on "Edit Category" screen (term.php?taxonomy=category)
 */
function hieugara_category_banner_edit_form_field($term, $taxonomy) {
    $current_banner = get_term_meta($term->term_id, 'hieugara_category_banner', true);
    $default_banner = hieugara_get_category_default_banner_url();
    $display_banner = !empty($current_banner) ? $current_banner : $default_banner;
    ?>
    <tr class="form-field term-group-wrap hieugara-term-banner-row">
        <th scope="row">
            <label for="hieugara_cat_banner_input" style="font-weight: 600;">
                <span class="dashicons dashicons-format-image" style="vertical-align: text-bottom; margin-right: 4px; color: #c5a880;"></span>
                <?php _e('Ảnh Banner Đầu Trang (Hero Banner)', 'hieugara-motors'); ?>
            </label>
        </th>
        <td>
            <div class="banner-preview-box" style="margin-bottom: 10px; max-width: 580px; position: relative;">
                <img id="hieugara_cat_banner_preview" src="<?php echo esc_url($display_banner); ?>" style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; border: 1px solid #ccd0d4; display: block; background: #141414; box-shadow: 0 2px 6px rgba(0,0,0,0.08);" alt="Banner Preview">
                <span class="banner-status-badge" style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.72); color: #fff; font-size: 11px; padding: 3px 8px; border-radius: 4px;">
                    <?php echo !empty($current_banner) ? __('Đang dùng ảnh riêng', 'hieugara-motors') : __('Đang dùng ảnh mặc định Blog', 'hieugara-motors'); ?>
                </span>
            </div>

            <div style="display: flex; gap: 10px; align-items: center; max-width: 580px; margin-bottom: 8px;">
                <input type="text" name="hieugara_category_banner" id="hieugara_cat_banner_input" value="<?php echo esc_attr($current_banner); ?>" placeholder="<?php esc_attr_e('Chưa đặt ảnh riêng (đang dùng ảnh mặc định Blog)...', 'hieugara-motors'); ?>" style="flex: 1;" />
                <button type="button" class="button button-secondary hieugara-cat-banner-upload-btn" style="white-space: nowrap;">
                    <span class="dashicons dashicons-upload" style="vertical-align: middle; margin-top: -2px;"></span> <?php _e('Chọn ảnh / Tải lên', 'hieugara-motors'); ?>
                </button>
                <button type="button" class="button button-link-delete hieugara-cat-banner-remove-btn" style="<?php echo empty($current_banner) ? 'display: none;' : ''; ?> white-space: nowrap;">
                    <?php _e('Xóa ảnh riêng', 'hieugara-motors'); ?>
                </button>
            </div>

            <p class="description" style="max-width: 580px; font-size: 12px; color: #646970; line-height: 1.45;">
                <?php _e('Ảnh nền Hero Banner xuất hiện trên cùng khi khách hàng xem chuyên mục này ngoài website. Kích thước khuyến nghị: 1920x450px hoặc tỉ lệ 16:9 chất lượng cao. Nếu bấm "Xóa ảnh riêng" và cập nhật, danh mục sẽ quay về ảnh mặc định của Blog.', 'hieugara-motors'); ?>
            </p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'hieugara_category_banner_edit_form_field', 10, 2);

/**
 * 3. Save Banner Meta on Category Creation or Update
 */
function hieugara_save_category_banner_meta($term_id) {
    if (isset($_POST['hieugara_category_banner'])) {
        $banner_url = trim(sanitize_text_field(wp_unslash($_POST['hieugara_category_banner'])));
        if (!empty($banner_url)) {
            update_term_meta($term_id, 'hieugara_category_banner', $banner_url);
        } else {
            delete_term_meta($term_id, 'hieugara_category_banner');
        }

        if (function_exists('hieugara_purge_page_cache')) {
            hieugara_purge_page_cache();
        }
    }
}
add_action('created_category', 'hieugara_save_category_banner_meta', 10, 1);
add_action('edited_category', 'hieugara_save_category_banner_meta', 10, 1);

/**
 * 4. Add "Ảnh Banner" column to Categories List Table
 */
function hieugara_add_category_banner_column($columns) {
    $new_cols = array();
    foreach ($columns as $key => $title) {
        $new_cols[$key] = $title;
        if ($key === 'name') {
            $new_cols['category_banner'] = __('Ảnh Banner', 'hieugara-motors');
        }
    }
    if (!isset($new_cols['category_banner'])) {
        $new_cols['category_banner'] = __('Ảnh Banner', 'hieugara-motors');
    }
    return $new_cols;
}
add_filter('manage_edit-category_columns', 'hieugara_add_category_banner_column');

/**
 * 5. Render Banner Column Content in Categories List Table
 */
function hieugara_render_category_banner_column($content, $column_name, $term_id) {
    if ($column_name === 'category_banner') {
        $banner = get_term_meta($term_id, 'hieugara_category_banner', true);
        if (!empty($banner)) {
            $normalized_url = function_exists('hieugara_normalize_local_media_urls') ? hieugara_normalize_local_media_urls($banner) : $banner;
            return '<div style="display:inline-flex; align-items:center; gap:8px;">' .
                   '<a href="' . esc_url(get_edit_term_link($term_id, 'category')) . '" title="' . esc_attr__('Bấm để đổi banner', 'hieugara-motors') . '">' .
                   '<img src="' . esc_url($normalized_url) . '" style="width: 80px; height: 42px; object-fit: cover; border-radius: 4px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: block;" alt="Banner">' .
                   '</a>' .
                   '<span style="font-size: 11px; color: #135e96; font-weight: 600;">' . __('Ảnh riêng', 'hieugara-motors') . '</span>' .
                   '</div>';
        } else {
            return '<span style="display:inline-block; padding: 2px 7px; background: #f0f0f1; color: #646970; border-radius: 4px; font-size: 11px; border: 1px dashed #c3c4c7;">' . __('Mặc định Blog', 'hieugara-motors') . '</span>';
        }
    }
    return $content;
}
add_filter('manage_category_custom_column', 'hieugara_render_category_banner_column', 10, 3);

/**
 * 6. Enqueue Media Scripts and Admin JS for Category Screen
 */
function hieugara_category_banner_admin_assets($hook) {
    $screen = get_current_screen();
    if ($screen && $screen->taxonomy === 'category') {
        wp_enqueue_media();
        add_action('admin_footer', 'hieugara_category_banner_admin_inline_js');
    }
}
add_action('admin_enqueue_scripts', 'hieugara_category_banner_admin_assets');

function hieugara_category_banner_admin_inline_js() {
    $default_banner = hieugara_get_category_default_banner_url();
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var defaultFallback = <?php echo json_encode($default_banner); ?>;

        // Xử lý mở Media Library
        $(document).on('click', '.hieugara-cat-banner-upload-btn', function(e) {
            e.preventDefault();
            var $wrap = $(this).closest('.hieugara-term-banner-wrap, .hieugara-term-banner-row, td, .form-field');
            var $input = $wrap.find('#hieugara_cat_banner_input');
            var $preview = $wrap.find('#hieugara_cat_banner_preview');
            var $removeBtn = $wrap.find('.hieugara-cat-banner-remove-btn');
            var $status = $wrap.find('.banner-status-badge');

            var catBannerUploader = wp.media({
                title: '<?php echo esc_js(__('Chọn hoặc Tải lên Ảnh Banner Chuyên Mục', 'hieugara-motors')); ?>',
                button: { text: '<?php echo esc_js(__('Sử dụng làm Banner Chuyên Mục', 'hieugara-motors')); ?>' },
                multiple: false
            }).on('select', function() {
                var attachment = catBannerUploader.state().get('selection').first().toJSON();
                $input.val(attachment.url).trigger('change');
                $preview.attr('src', attachment.url);
                $removeBtn.show();
                if ($status.length) {
                    $status.text('<?php echo esc_js(__('Ảnh riêng đã chọn', 'hieugara-motors')); ?>');
                }
            }).open();
        });

        // Xử lý xóa ảnh
        $(document).on('click', '.hieugara-cat-banner-remove-btn', function(e) {
            e.preventDefault();
            var $wrap = $(this).closest('.hieugara-term-banner-wrap, .hieugara-term-banner-row, td, .form-field');
            $wrap.find('#hieugara_cat_banner_input').val('').trigger('change');
            $wrap.find('#hieugara_cat_banner_preview').attr('src', defaultFallback);
            $(this).hide();
            var $status = $wrap.find('.banner-status-badge');
            if ($status.length) {
                $status.text('<?php echo esc_js(__('Mặc định Blog', 'hieugara-motors')); ?>');
            }
        });

        // Xử lý khi người dùng gõ / paste trực tiếp URL vào ô input
        $(document).on('input change', '#hieugara_cat_banner_input', function() {
            var val = $(this).val().trim();
            var $wrap = $(this).closest('.hieugara-term-banner-wrap, .hieugara-term-banner-row, td, .form-field');
            var $preview = $wrap.find('#hieugara_cat_banner_preview');
            var $removeBtn = $wrap.find('.hieugara-cat-banner-remove-btn');
            var $status = $wrap.find('.banner-status-badge');

            if (val) {
                $preview.attr('src', val);
                $removeBtn.show();
                if ($status.length) {
                    $status.text('<?php echo esc_js(__('Ảnh riêng', 'hieugara-motors')); ?>');
                }
            } else {
                $preview.attr('src', defaultFallback);
                $removeBtn.hide();
                if ($status.length) {
                    $status.text('<?php echo esc_js(__('Mặc định Blog', 'hieugara-motors')); ?>');
                }
            }
        });

        // Tự động dọn sạch form sau khi thêm Chuyên mục mới bằng AJAX thành công
        $(document).ajaxComplete(function(event, xhr, settings) {
            if (settings && settings.data && typeof settings.data === 'string' && settings.data.indexOf('action=add-tag') !== -1) {
                var $input = $('#hieugara_cat_banner_input');
                if ($input.length) {
                    $input.val('');
                    $('#hieugara_cat_banner_preview').attr('src', defaultFallback);
                    $('.hieugara-cat-banner-remove-btn').hide();
                    var $status = $('.hieugara-term-banner-wrap .banner-status-badge');
                    if ($status.length) {
                        $status.text('<?php echo esc_js(__('Xem trước', 'hieugara-motors')); ?>');
                    }
                }
            }
        });
    });
    </script>
    <?php
}

