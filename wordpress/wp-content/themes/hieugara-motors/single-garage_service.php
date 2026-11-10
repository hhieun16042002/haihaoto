<?php
/**
 * Single Template for Garage Services - ShiftUp & Lexus Luxury Style
 * Matching otohathanh.com Child Service Architecture
 * 100% Dynamic & Editable from WordPress Admin
 *
 * @package HieuGara_Motors
 */

get_header();

while (have_posts()) : the_post();
    $post_id   = get_the_ID();
    $post_slug = get_post_field('post_name', $post_id);

    // Primary Data from WP Admin
    $page_title = get_the_title();
    $meta_price = get_post_meta($post_id, '_garage_price_from', true) ?: get_post_meta($post_id, '_service_price', true);
    $price      = !empty($meta_price) ? $meta_price : 'Liên hệ';

    $meta_badge = get_post_meta($post_id, '_garage_badge', true);
    $badge      = !empty($meta_badge) ? $meta_badge : 'TIÊU CHUẨN ÔTÔ HẢI HÀ';

    $meta_duration = get_post_meta($post_id, '_garage_duration', true) ?: get_post_meta($post_id, '_service_duration', true);
    $duration      = !empty($meta_duration) ? $meta_duration : '45 - 90 phút';

    $meta_warranty = get_post_meta($post_id, '_garage_warranty', true) ?: get_post_meta($post_id, '_service_warranty', true);
    $warranty      = !empty($meta_warranty) ? $meta_warranty : '12 - 24 tháng';

    // Featured Image
    $meta_custom_img = get_post_meta($post_id, '_garage_custom_image', true);
    if (has_post_thumbnail($post_id)) {
        $thumb = get_the_post_thumbnail_url($post_id, 'large');
    } elseif (!empty($meta_custom_img)) {
        $thumb = $meta_custom_img;
    } else {
        $thumb = get_template_directory_uri() . '/assets/images/slider/slide-bao-duong.jpg';
    }
    if (function_exists('hieugara_normalize_local_media_urls')) {
        $thumb = hieugara_normalize_local_media_urls($thumb);
    }

    $hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
    $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
    $rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
    $features_raw  = get_post_meta($post_id, '_garage_features', true);

    // Category
    $service_terms = get_the_terms($post_id, 'service_category');
    $current_term  = (!empty($service_terms) && !is_wp_error($service_terms)) ? $service_terms[0] : null;

    // Sibling services in same category
    $related_services = array();
    if ($current_term) {
        $raw_related = get_posts(array(
            'post_type'      => 'garage_service',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'post__not_in'   => array($post_id),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'service_category',
                    'field'    => 'term_id',
                    'terms'    => $current_term->term_id,
                ),
            ),
        ));
        $related_services = array_filter($raw_related, function($r) {
            return $r->menu_order > 0 && strpos($r->post_name, 'tong-quan-') !== 0;
        });
        $related_services = array_slice($related_services, 0, 8);
    }

    $banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('services');
    if (empty($banner_bg)) {
        $banner_bg = !empty($thumb) ? $thumb : get_template_directory_uri() . '/assets/images/banners/banner-dich-vu.jpg';
    }
    ?>

    <!-- Service Header Banner (Đức Trí 226 Style / VinFast Style: Nền ảnh xưởng sắc nét + Dark Overlay) -->
    <section class="portal-hero-header service-single-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px; text-align: center;">
            <!-- Breadcrumbs -->
            <nav class="portal-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>"><?php _e('Dịch Vụ', 'hieugara-motors'); ?></a>
                <?php if ($current_term) : ?>
                    <span class="sep">/</span>
                    <a href="<?php echo esc_url(home_url('/dich-vu/' . $current_term->slug . '/')); ?>"><?php echo esc_html($current_term->name); ?></a>
                <?php endif; ?>
                <span class="sep">/</span>
                <span class="current"><?php echo esc_html($page_title); ?></span>
            </nav>

            <h1 class="portal-page-title" style="margin: 0 auto;">
                <?php echo esc_html($page_title); ?>
            </h1>
        </div>
    </section>

    <!-- Main Detail Content -->
    <main id="primary" class="site-main" style="padding: 55px 0 85px; background: #F8FAFC;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: flex-start;">
                
                <!-- Left: Service Presentation -->
                <article class="service-detail-main" style="background: #ffffff; padding: 36px 40px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    
                    <!-- Key Service Metrics Bar (Màu be chủ đạo của website) -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; padding: 20px 24px; background: #FBF8F3; border: 1px solid #E2E8F0; border-left: 4px solid #C5A880; border-radius: 6px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                        <div>
                            <small style="color: #8C6239; font-size: 0.72rem; text-transform: uppercase; font-family: 'Be Vietnam Pro', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chi phí khởi điểm:', 'hieugara-motors'); ?></small>
                            <div style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.15rem; font-weight: 800; color: #8C6239; margin-top: 4px;"><?php echo esc_html($price); ?></div>
                        </div>
                        <?php if (!empty($duration)) : ?>
                            <div style="border-left: 1px solid #E2E8F0; padding-left: 16px;">
                                <small style="color: #8C6239; font-size: 0.72rem; text-transform: uppercase; font-family: 'Be Vietnam Pro', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.05rem; font-weight: 800; color: #141414; margin-top: 4px;"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($warranty)) : ?>
                            <div style="border-left: 1px solid #E2E8F0; padding-left: 16px;">
                                <small style="color: #8C6239; font-size: 0.72rem; text-transform: uppercase; font-family: 'Be Vietnam Pro', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chế độ bảo hành:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.05rem; font-weight: 800; color: #16A34A; margin-top: 4px;"><?php echo esc_html($warranty); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Main Hero Image -->
                    <div style="margin-bottom: 30px; overflow: hidden; background: #141414; border-radius: 6px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($page_title); ?>" style="width: 100%; height: auto; max-height: 460px; object-fit: cover; display: block;">
                    </div>

                    <!-- Highlights & Features (if configured by Admin) -->
                    <?php if (!empty($features_raw)) : 
                        $feature_lines = array_filter(array_map('trim', explode("\n", $features_raw)));
                        if (!empty($feature_lines)) : ?>
                            <div style="background: #fdfbf7; border: 1px solid #fed7aa; border-left: 4px solid #C5A880; padding: 20px 24px; margin-bottom: 30px; border-radius: 4px;">
                                <h4 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.1rem; font-weight: 800; color: #141414; margin: 0 0 12px; text-transform: uppercase;">
                                    <i class="fa-solid fa-circle-check" style="color: #C5A880; margin-right: 6px;"></i> <?php _e('Cam kết & Điểm nổi bật dịch vụ', 'hieugara-motors'); ?>
                                </h4>
                                <ul style="margin: 0; padding-left: 20px; color: #334155; line-height: 1.8;">
                                    <?php foreach ($feature_lines as $f_line) : ?>
                                        <li style="margin-bottom: 6px;"><?php echo esc_html($f_line); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; 
                    endif; ?>

                    <!-- Body Content from WP Admin (WYSIWYG) -->
                    <div class="entry-content" style="line-height: 1.85; color: #334155; font-size: 1.02rem;">
                        <?php the_content(); ?>
                    </div>
                </article>

                <!-- Right: Sticky Sidebar -->
                <aside class="service-sidebar" style="position: sticky; top: 110px; display: flex; flex-direction: column; gap: 24px;">
                    
                    <!-- 1. Related Services in same category (Like Hà Thành) -->
                    <?php if (!empty($related_services)) : ?>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
                            <h4 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.1rem; font-weight: 800; color: #141414; margin: 0 0 16px; padding-bottom: 10px; border-bottom: 2px solid #C5A880; text-transform: uppercase;">
                                <i class="fa-solid fa-layer-group" style="color: #C5A880; margin-right: 6px;"></i> <?php _e('Dịch Vụ Cùng Chuyên Mục', 'hieugara-motors'); ?>
                            </h4>
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                                <?php foreach ($related_services as $rel) : 
                                    $rel_dur = get_post_meta($rel->ID, '_garage_price_from', true) ?: 'Liên hệ';
                                ?>
                                    <li style="border-bottom: 1px dashed #f1f5f9; padding-bottom: 10px;">
                                        <a href="<?php echo esc_url(get_permalink($rel->ID)); ?>" style="color: #1e293b; text-decoration: none; font-size: 0.9rem; font-weight: 600; display: block; line-height: 1.45; transition: color 0.2s ease;">
                                            &bull; <?php echo esc_html($rel->post_title); ?>
                                        </a>
                                        <small style="color: #C5A880; font-family: 'Be Vietnam Pro', sans-serif; font-weight: 700; font-size: 0.78rem;"><?php echo esc_html($rel_dur); ?></small>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- 2. Direct Support & Hotline Card (Replaced Booking Form) -->
                    <div style="background: #ffffff; border: 2px solid #141414; border-radius: 8px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.06);">
                        <div style="border-bottom: 2px solid #C5A880; padding-bottom: 14px; margin-bottom: 20px;">
                            <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.72rem; font-weight: 800; color: #D4B996; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('ÔTÔ HẢI HÀ SERVICE', 'hieugara-motors'); ?></span>
                            <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #141414; text-transform: uppercase; margin: 4px 0 0;"><?php _e('TƯ VẤN & BÁO GIÁ DỊCH VỤ', 'hieugara-motors'); ?></h3>
                        </div>

                        <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin-bottom: 20px;">
                            Quý khách vui lòng liên hệ trực tiếp với Cố vấn dịch vụ Ô Tô Hải Hà qua số điện thoại hoặc Zalo để được kiểm tra, tư vấn kỹ thuật và báo giá nhanh nhất.
                        </p>

                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="tel:02203892207" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 14px; background: #D4B996; color: #141414; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.92rem; font-weight: 800; letter-spacing: 0.8px; text-transform: uppercase; text-decoration: none; border-radius: 4px; box-shadow: 0 4px 12px rgba(212,185,150,0.3);">
                                <i class="fa-solid fa-phone-volume"></i> Gọi Ngay: 02203 892 207
                            </a>

                            <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 13px; background: #0068FF; color: #ffffff; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.9rem; font-weight: 700; text-decoration: none; border-radius: 4px;">
                                <i class="fa-solid fa-comment-dots"></i> Chat Zalo Kỹ Thuật
                            </a>
                        </div>
                    </div>

                </aside>

            </div>

        </div>
    </main>

    <?php
endwhile;

get_footer();
