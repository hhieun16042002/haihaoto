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
    $price      = !empty($meta_price) ? $meta_price : 'Khảo sát báo giá miễn phí';

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
        $related_services = get_posts(array(
            'post_type'      => 'garage_service',
            'posts_per_page' => 8,
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
    }
    ?>

    <!-- Service Header Banner -->
    <section class="service-single-header" style="background: #141414; padding: 45px 0 35px; border-bottom: 3px solid #C5A880; position: relative;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            <!-- Breadcrumbs -->
            <div class="portal-breadcrumb" style="display: flex; gap: 8px; align-items: center; font-size: 0.85rem; color: #94a3b8; margin-bottom: 14px; font-family: 'Chakra Petch', sans-serif; text-transform: uppercase; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #cbd5e1; text-decoration: none;"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span style="color: #64748b;">/</span>
                <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>" style="color: #cbd5e1; text-decoration: none;"><?php _e('Dịch Vụ', 'hieugara-motors'); ?></a>
                <?php if ($current_term) : ?>
                    <span style="color: #64748b;">/</span>
                    <a href="<?php echo esc_url(home_url('/dich-vu/' . $current_term->slug . '/')); ?>" style="color: #C5A880; text-decoration: none;"><?php echo esc_html($current_term->name); ?></a>
                <?php endif; ?>
                <span style="color: #64748b;">/</span>
                <span class="current" style="color: #ffffff; font-weight: 700;"><?php echo esc_html($page_title); ?></span>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
                <div style="max-width: 900px;">
                    <?php if (!empty($badge)) : ?>
                        <div style="display: inline-block; background: #C5A880; color: #141414; font-family: 'Chakra Petch', sans-serif; font-size: 0.72rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 10px; border-radius: 2px;">
                            <?php echo esc_html($badge); ?>
                        </div>
                    <?php endif; ?>
                    <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.3;">
                        <span style="color: #C5A880;">|</span> <?php echo esc_html($page_title); ?>
                    </h1>
                </div>

                <!-- Emergency Contact Badge -->
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <a href="tel:<?php echo esc_attr($rescue_clean); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #D92D20; border: 1px solid rgba(255,255,255,0.25); color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase; border-radius: 4px;">
                        <i class="fa fa-phone-volume"></i>
                        <span>CỨU HỘ 24/7: <strong><?php echo esc_html($rescue_phone); ?></strong></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Detail Content -->
    <main id="primary" class="site-main" style="padding: 55px 0 85px; background: #F8FAFC;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: flex-start;">
                
                <!-- Left: Service Presentation -->
                <article class="service-detail-main" style="background: #ffffff; padding: 36px 40px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    
                    <!-- Key Service Metrics Bar -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; padding: 20px 24px; background: #141414; border-radius: 6px; margin-bottom: 30px; border-left: 4px solid #C5A880;">
                        <div>
                            <small style="color: #94a3b8; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chi phí khởi điểm:', 'hieugara-motors'); ?></small>
                            <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.15rem; font-weight: 800; color: #C5A880; margin-top: 4px;"><?php echo esc_html($price); ?></div>
                        </div>
                        <?php if (!empty($duration)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.12); padding-left: 16px;">
                                <small style="color: #94a3b8; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; font-weight: 700; color: #ffffff; margin-top: 4px;"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($warranty)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.12); padding-left: 16px;">
                                <small style="color: #94a3b8; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chế độ bảo hành:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; font-weight: 700; color: #22c55e; margin-top: 4px;"><?php echo esc_html($warranty); ?></div>
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
                                <h4 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 800; color: #141414; margin: 0 0 12px; text-transform: uppercase;">
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

                    <!-- Workshop Guarantee Box -->
                    <div style="margin-top: 36px; padding: 24px; background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 6px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                        <div>
                            <strong style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; color: #141414; display: block; margin-bottom: 4px;"><?php _e('CẦN TƯ VẤN KỸ THUẬT & BÁO GIÁ TRỰC TIẾP?', 'hieugara-motors'); ?></strong>
                            <span style="color: #64748b; font-size: 0.92rem;"><?php _e('Cố vấn dịch vụ Ôtô Hải Hà hỗ trợ kiểm tra xe và tư vấn giải pháp 24/7.', 'hieugara-motors'); ?></span>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                            <a href="tel:<?php echo esc_attr($rescue_clean); ?>" style="background: #141414; color: #C5A880; border: 1px solid #C5A880; padding: 12px 20px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 800; font-size: 0.9rem; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fa fa-phone"></i> <?php echo esc_html($rescue_phone); ?>
                            </a>
                            <a href="https://zalo.me/<?php echo esc_attr($rescue_clean); ?>" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 12px 20px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 800; font-size: 0.9rem; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-comment-dots"></i> <?php _e('Chat Zalo', 'hieugara-motors'); ?>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Right: Sticky Sidebar -->
                <aside class="service-sidebar" style="position: sticky; top: 110px; display: flex; flex-direction: column; gap: 24px;">
                    
                    <!-- 1. Related Services in same category (Like Hà Thành) -->
                    <?php if (!empty($related_services)) : ?>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
                            <h4 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 800; color: #141414; margin: 0 0 16px; padding-bottom: 10px; border-bottom: 2px solid #C5A880; text-transform: uppercase;">
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
                                        <small style="color: #C5A880; font-family: 'Chakra Petch', sans-serif; font-weight: 700; font-size: 0.78rem;"><?php echo esc_html($rel_dur); ?></small>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- 2. Sticky Booking Form Card -->
                    <div style="background: #ffffff; border: 2px solid #141414; border-radius: 8px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.06);">
                        <div style="border-bottom: 2px solid #C5A880; padding-bottom: 14px; margin-bottom: 20px;">
                            <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.72rem; font-weight: 800; color: #C5A880; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('ÔTÔ HẢI HÀ SERVICE', 'hieugara-motors'); ?></span>
                            <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.25rem; font-weight: 800; color: #141414; text-transform: uppercase; margin: 4px 0 0;"><?php _e('ĐẶT HẸN DỊCH VỤ', 'hieugara-motors'); ?></h3>
                        </div>

                        <form class="hieugara-ajax-form">
                            <input type="hidden" name="service_type" value="<?php echo esc_attr($page_title); ?>">

                            <div style="margin-bottom: 14px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Họ và tên (*)', 'hieugara-motors'); ?></label>
                                <input type="text" name="customer_name" required placeholder="VD: Nguyễn Văn A" style="width: 100%; padding: 11px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit; border-radius: 4px;">
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                                <input type="tel" name="customer_phone" required placeholder="09xx xxx xxx" style="width: 100%; padding: 11px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit; border-radius: 4px;">
                            </div>

                            <div style="margin-bottom: 14px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Dòng xe / Đời xe', 'hieugara-motors'); ?></label>
                                <input type="text" name="car_model" placeholder="VD: Lexus RX350, Camry, Ranger..." style="width: 100%; padding: 11px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit; border-radius: 4px;">
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Hình thức phục vụ', 'hieugara-motors'); ?></label>
                                <select name="branch_location" style="width: 100%; padding: 11px 14px; border: 1px solid #ccc; font-size: 0.92rem; font-family: inherit; background: #fff; border-radius: 4px;">
                                    <option value="Trụ sở chính Ôtô Hải Hà">Xưởng chính: Km 3 + 500 Nguyễn Lương Bằng, Hải Dương</option>
                                    <option value="Tiếp nhận sửa chữa lưu động">Sửa chữa lưu động tận nơi</option>
                                    <option value="Cứu hộ giao thông 24/7">Cứu hộ cẩu kéo 24/7 (Hotline: <?php echo esc_html($rescue_phone); ?>)</option>
                                </select>
                            </div>

                            <button type="submit" class="shiftup-rect-btn btn-orange-solid" style="width: 100%; padding: 14px; background: #141414; color: #C5A880; border: 1.5px solid #C5A880; font-family: 'Chakra Petch', sans-serif; font-size: 0.92rem; font-weight: 800; letter-spacing: 0.8px; text-transform: uppercase; cursor: pointer; border-radius: 4px; transition: background 0.2s ease;">
                                + <?php _e('XÁC NHẬN TIẾP NHẬN XE', 'hieugara-motors'); ?>
                            </button>
                            <div class="form-response-msg" style="display:none; margin-top: 12px; font-size: 0.9rem; padding: 10px; text-align: center;"></div>
                        </form>

                        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #eee; font-size: 0.82rem; color: #64748b; line-height: 1.6;">
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #C5A880;"></i> Khám xe &amp; tư vấn miễn phí.</p>
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #C5A880;"></i> Báo giá trước minh bạch, khách duyệt mới làm.</p>
                            <p style="margin-bottom: 0;"><i class="fa fa-check" style="color: #C5A880;"></i> Bảo hành dài hạn minh bạch bằng hóa đơn &amp; tem kiểm định.</p>
                        </div>
                    </div>

                </aside>

            </div>

        </div>
    </main>

    <?php
endwhile;

get_footer();
