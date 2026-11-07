<?php
/**
 * Archive Template for Garage Services (/dich-vu/)
 * Modeled after otohathanh.com/dich-vu.aspx with Luxury Workshop Styling
 * 100% Dynamic - Synchronized with WordPress Admin Categories & Services
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);

// Query all parent categories dynamically from database
$categories = get_terms(array(
    'taxonomy'   => 'service_category',
    'parent'     => 0,
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
));

// Query top 3 featured services for the Top Highlight Section (like otohathanh.com)
$featured_services = get_posts(array(
    'post_type'      => 'garage_service',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
));

$hero_srv = !empty($featured_services[0]) ? $featured_services[0] : null;
$sub1_srv = !empty($featured_services[1]) ? $featured_services[1] : null;
$sub2_srv = !empty($featured_services[2]) ? $featured_services[2] : null;
?>

<!-- =========================================================================
     PORTAL HERO BANNER
     ========================================================================= -->
<section class="portal-hero-header" style="background: #141414; padding: 45px 0 40px; border-bottom: 3px solid #C5A880; position: relative;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
        <div class="portal-breadcrumb" style="display: flex; gap: 8px; align-items: center; font-size: 0.85rem; color: #94a3b8; margin-bottom: 15px; font-family: 'Chakra Petch', sans-serif; text-transform: uppercase;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #cbd5e1; text-decoration: none;"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span style="color: #64748b;">/</span>
            <span class="current" style="color: #C5A880; font-weight: 700;"><?php _e('Dịch Vụ', 'hieugara-motors'); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
            <div style="max-width: 900px;">
                <div style="display: inline-block; background: #C5A880; color: #141414; font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px; border-radius: 2px;">
                    <?php _e('TRUNG TÂM BẢO DƯỠNG & SỬA CHỮA Ô TÔ HẢI DƯƠNG', 'hieugara-motors'); ?>
                </div>
                <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 800; color: #ffffff; margin: 0 0 14px; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.25;">
                    <span style="color: #C5A880;">|</span> <?php _e('HỆ THỐNG DỊCH VỤ ÔTÔ HẢI HÀ', 'hieugara-motors'); ?>
                </h1>
                <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.6; margin: 0; max-width: 860px;">
                    Quy trình dịch vụ chuyên nghiệp chuẩn công nghệ cao: Bảo dưỡng định kỳ, Sửa chữa máy gầm điện lạnh, Đồng sơn phòng sấy khép kín và Chăm sóc Detailing toàn diện tại Hải Dương.
                </p>
            </div>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <a href="tel:<?php echo esc_attr($rescue_clean); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #D92D20; border: 1px solid rgba(255,255,255,0.25); color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase; border-radius: 4px;">
                    <i class="fa fa-phone-volume"></i>
                    <span>CỨU HỘ 24/7: <strong><?php echo esc_html($rescue_phone); ?></strong></span>
                </a>
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #141414; border: 1.5px solid #C5A880; color: #C5A880; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 800; text-decoration: none; text-transform: uppercase; border-radius: 4px;">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span><?php _e('ĐẶT LỊCH HẸN', 'hieugara-motors'); ?></span>
                </a>
            </div>
        </div>

        <!-- Category Quick Jump Bar -->
        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <div style="margin-top: 30px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 18px;">
                <span style="display: inline-flex; align-items: center; color: #94a3b8; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-right: 6px;">
                    <i class="fa-solid fa-list-check" style="color: #C5A880; margin-right: 6px;"></i> Danh mục:
                </span>
                <?php foreach ($categories as $q_cat) : ?>
                    <a href="#cat-<?php echo esc_attr($q_cat->slug); ?>" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(197, 168, 128, 0.3); color: #e2e8f0; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 700; padding: 6px 14px; text-decoration: none; text-transform: uppercase; border-radius: 3px; transition: all 0.2s ease;">
                        <?php echo esc_html($q_cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- =========================================================================
     TOP FEATURED HIGHLIGHT GRID (NHƯ OTOHATHANH.COM)
     ========================================================================= -->
<?php if ($hero_srv) : 
    $hero_id        = $hero_srv->ID;
    $hero_permalink = get_permalink($hero_id);
    $hero_thumb     = has_post_thumbnail($hero_id) ? get_the_post_thumbnail_url($hero_id, 'large') : (get_post_meta($hero_id, '_garage_custom_image', true) ?: get_template_directory_uri() . '/assets/images/slider/slide-bao-duong.jpg');
    $hero_price     = get_post_meta($hero_id, '_garage_price_from', true) ?: 'Khảo sát miễn phí';
    $hero_badge     = get_post_meta($hero_id, '_garage_badge', true) ?: 'TIÊU ĐIỂM DỊCH VỤ';
    $hero_cats      = get_the_terms($hero_id, 'service_category');
    $hero_cat_name  = (!empty($hero_cats) && !is_wp_error($hero_cats)) ? $hero_cats[0]->name : 'Dịch vụ';
?>
<section class="services-featured-section" style="padding: 45px 0 25px; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
        <div style="margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between;">
            <h2 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.45rem; font-weight: 800; color: #141414; margin: 0; text-transform: uppercase;">
                <span style="color: #C5A880;">|</span> <?php _e('TIÊU ĐIỂM DỊCH VỤ NỔI BẬT', 'hieugara-motors'); ?>
            </h2>
            <span style="font-size: 0.85rem; color: #64748b; font-family: 'Chakra Petch', sans-serif; text-transform: uppercase;">Chuẩn hóa kỹ thuật Ôtô Hải Hà</span>
        </div>

        <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 24px;">
            
            <!-- Left Large Hero Card (col-lg-8 like Hà Thành) -->
            <article class="service-highlight-hero" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.3s ease;">
                <div style="position: relative; height: 320px; overflow: hidden; background: #141414;">
                    <a href="<?php echo esc_url($hero_permalink); ?>">
                        <img src="<?php echo esc_url($hero_thumb); ?>" alt="<?php echo esc_attr($hero_srv->post_title); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                    </a>
                    <span style="position: absolute; top: 16px; left: 16px; background: #D92D20; color: #fff; font-family: 'Chakra Petch', sans-serif; font-size: 0.72rem; font-weight: 800; padding: 5px 12px; border-radius: 3px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <?php echo esc_html($hero_badge); ?>
                    </span>
                    <span style="position: absolute; bottom: 16px; right: 16px; background: rgba(20, 20, 20, 0.9); color: #C5A880; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 800; padding: 6px 14px; border-radius: 3px; border: 1px solid #C5A880;">
                        <?php echo esc_html($hero_price); ?>
                    </span>
                </div>
                <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
                    <div style="display: flex; gap: 14px; align-items: center; font-size: 0.8rem; color: #64748b; margin-bottom: 10px; font-family: 'Chakra Petch', sans-serif;">
                        <span><i class="fa-solid fa-folder-open" style="color: #C5A880; margin-right: 4px;"></i> <?php echo esc_html($hero_cat_name); ?></span>
                        <span><i class="fa-solid fa-calendar-days" style="color: #64748b; margin-right: 4px;"></i> <?php echo get_the_date('d/m/Y', $hero_id); ?></span>
                    </div>
                    <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.35rem; font-weight: 800; color: #141414; margin: 0 0 12px; line-height: 1.35; text-transform: uppercase;">
                        <a href="<?php echo esc_url($hero_permalink); ?>" style="color: inherit; text-decoration: none;">
                            <?php echo esc_html($hero_srv->post_title); ?>
                        </a>
                    </h3>
                    <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin: 0 0 18px; flex: 1;">
                        <?php echo wp_trim_words(get_the_excerpt($hero_id) ?: strip_tags($hero_srv->post_content), 32, '...'); ?>
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 16px;">
                        <a href="<?php echo esc_url($hero_permalink); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #141414; font-family: 'Chakra Petch', sans-serif; font-size: 0.88rem; font-weight: 800; text-transform: uppercase; text-decoration: none;">
                            <span><?php _e('Xem chi tiết dịch vụ', 'hieugara-motors'); ?></span>
                            <span style="color: #C5A880;">&rarr;</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode($hero_srv->post_title))); ?>" style="background: #141414; border: 1px solid #C5A880; color: #C5A880; padding: 7px 14px; font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 800; text-decoration: none; text-transform: uppercase; border-radius: 3px;">
                            <?php _e('Đặt hẹn ngay', 'hieugara-motors'); ?>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Right 2 Stacked Cards (col-lg-4 like Hà Thành) -->
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <?php 
                $sub_items = array_filter(array($sub1_srv, $sub2_srv));
                foreach ($sub_items as $sub_s) : 
                    $sub_id        = $sub_s->ID;
                    $sub_permalink = get_permalink($sub_id);
                    $sub_thumb     = has_post_thumbnail($sub_id) ? get_the_post_thumbnail_url($sub_id, 'medium') : (get_post_meta($sub_id, '_garage_custom_image', true) ?: get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-3.jpg');
                    $sub_price     = get_post_meta($sub_id, '_garage_price_from', true) ?: 'Liên hệ';
                    $sub_cats      = get_the_terms($sub_id, 'service_category');
                    $sub_cat_name  = (!empty($sub_cats) && !is_wp_error($sub_cats)) ? $sub_cats[0]->name : 'Dịch vụ';
                ?>
                    <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; display: grid; grid-template-columns: 140px 1fr; box-shadow: 0 4px 15px rgba(0,0,0,0.04); flex: 1;">
                        <div style="position: relative; overflow: hidden; background: #141414;">
                            <a href="<?php echo esc_url($sub_permalink); ?>" style="display: block; width: 100%; height: 100%;">
                                <img src="<?php echo esc_url($sub_thumb); ?>" alt="<?php echo esc_attr($sub_s->post_title); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        </div>
                        <div style="padding: 16px 18px; display: flex; flex-direction: column; justify-content: center;">
                            <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.72rem; font-weight: 700; color: #C5A880; text-transform: uppercase; margin-bottom: 4px;">
                                <?php echo esc_html($sub_cat_name); ?>
                            </span>
                            <h4 style="font-family: 'Chakra Petch', sans-serif; font-size: 1rem; font-weight: 800; color: #141414; margin: 0 0 6px; line-height: 1.35; text-transform: uppercase;">
                                <a href="<?php echo esc_url($sub_permalink); ?>" style="color: inherit; text-decoration: none;">
                                    <?php echo esc_html($sub_s->post_title); ?>
                                </a>
                            </h4>
                            <p style="font-size: 0.82rem; color: #64748b; line-height: 1.5; margin: 0 0 10px;">
                                <?php echo wp_trim_words(get_the_excerpt($sub_id) ?: strip_tags($sub_s->post_content), 14, '...'); ?>
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <strong style="font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; color: #D92D20;"><?php echo esc_html($sub_price); ?></strong>
                                <a href="<?php echo esc_url($sub_permalink); ?>" style="font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; color: #141414; text-decoration: none; text-transform: uppercase;">
                                    <?php _e('Xem thêm', 'hieugara-motors'); ?> &raquo;
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     CATEGORY SECTIONS (4 CHUYÊN MỤC CHÍNH)
     ========================================================================= -->
<main id="primary" class="site-main" style="padding: 55px 0 85px; background: #F8FAFC;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">

        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <?php foreach ($categories as $cat) : 
                $services = get_posts(array(
                    'post_type'      => 'garage_service',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order title',
                    'order'          => 'ASC',
                    'tax_query'      => array(
                        array(
                            'taxonomy'         => 'service_category',
                            'field'            => 'term_id',
                            'terms'            => $cat->term_id,
                            'include_children' => true,
                        ),
                    ),
                ));
                $cat_link = home_url('/dich-vu/' . $cat->slug . '/');
            ?>
                <section id="cat-<?php echo esc_attr($cat->slug); ?>" style="margin-bottom: 65px; scroll-margin-top: 100px;">
                    
                    <!-- Category Section Header -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 14px;">
                        <div>
                            <h2 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.55rem; font-weight: 800; color: #141414; margin: 0 0 6px; text-transform: uppercase;">
                                <span style="color: #C5A880;">|</span> <?php echo esc_html($cat->name); ?>
                                <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-left: 8px;">(<?php echo count($services); ?> dịch vụ)</span>
                            </h2>
                            <?php if (!empty($cat->description)) : ?>
                                <p style="margin: 0; color: #64748b; font-size: 0.95rem; max-width: 850px; line-height: 1.6;">
                                    <?php echo esc_html($cat->description); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo esc_url($cat_link); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #141414; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; text-decoration: none;">
                            <span><?php _e('Xem toàn bộ chuyên mục', 'hieugara-motors'); ?></span>
                            <span style="color: #C5A880;">&rarr;</span>
                        </a>
                    </div>

                    <!-- Services 3-Column Card Grid -->
                    <?php if (!empty($services)) : ?>
                        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
                            <?php foreach ($services as $srv) : 
                                $srv_id    = $srv->ID;
                                $price     = get_post_meta($srv_id, '_garage_price_from', true) ?: 'Liên hệ';
                                $duration  = get_post_meta($srv_id, '_garage_duration', true) ?: '';
                                $warranty  = get_post_meta($srv_id, '_garage_warranty', true) ?: '';
                                $badge     = get_post_meta($srv_id, '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ';
                                $permalink = get_permalink($srv_id);

                                if (has_post_thumbnail($srv_id)) {
                                    $thumb = get_the_post_thumbnail_url($srv_id, 'medium_large');
                                } else {
                                    $custom_img = get_post_meta($srv_id, '_garage_custom_image', true);
                                    $thumb = !empty($custom_img) ? $custom_img : get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-1.jpg';
                                }
                            ?>
                                <article class="service-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.25s ease, box-shadow 0.25s ease; position: relative;">
                                    <?php if (!empty($badge)) : ?>
                                        <span style="position: absolute; top: 12px; left: 12px; z-index: 2; background: #141414; color: #C5A880; font-family: 'Chakra Petch', sans-serif; font-size: 0.68rem; font-weight: 800; padding: 4px 10px; border-radius: 2px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #C5A880;">
                                            <?php echo esc_html($badge); ?>
                                        </span>
                                    <?php endif; ?>

                                    <div class="service-media" style="position: relative; height: 210px; overflow: hidden; background: #141414;">
                                        <a href="<?php echo esc_url($permalink); ?>">
                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($srv->post_title); ?>" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.35s ease;">
                                        </a>
                                        <span style="position: absolute; bottom: 10px; right: 10px; background: rgba(20, 20, 20, 0.9); color: #C5A880; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 800; padding: 4px 10px; border-radius: 3px; border: 1px solid rgba(197, 168, 128, 0.4);">
                                            <?php echo esc_html($price); ?>
                                        </span>
                                    </div>

                                    <div class="service-body" style="padding: 22px; display: flex; flex-direction: column; flex: 1;">
                                        <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.15rem; font-weight: 800; color: #141414; margin: 0 0 10px; text-transform: uppercase; line-height: 1.35;">
                                            <a href="<?php echo esc_url($permalink); ?>" style="color: inherit; text-decoration: none;">
                                                <?php echo esc_html($srv->post_title); ?>
                                            </a>
                                        </h3>

                                        <!-- Meta Pills -->
                                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; font-size: 0.8rem; font-family: 'Chakra Petch', sans-serif;">
                                            <?php if (!empty($duration)) : ?>
                                                <span style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 3px; font-weight: 600;">
                                                    <i class="fa fa-clock" style="margin-right: 4px;"></i> <?php echo esc_html($duration); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (!empty($warranty)) : ?>
                                                <span style="background: #f0fdf4; color: #16a34a; padding: 3px 8px; border-radius: 3px; font-weight: 600;">
                                                    <i class="fa fa-shield-halved" style="margin-right: 4px;"></i> <?php echo esc_html($warranty); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6; margin: 0 0 18px; flex: 1;">
                                            <?php echo wp_trim_words(get_the_excerpt($srv_id) ?: strip_tags($srv->post_content), 20, '...'); ?>
                                        </p>

                                        <div class="service-card-footer" style="margin-top: auto; padding-top: 14px; border-top: 1px solid #f1f5f9; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo esc_url($permalink); ?>" style="flex: 1; text-align: center; padding: 10px 14px; background: #141414; color: #ffffff; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; border-radius: 3px; transition: background 0.2s ease;">
                                                <?php _e('Chi tiết', 'hieugara-motors'); ?> &rarr;
                                            </a>
                                            <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode($srv->post_title))); ?>" style="padding: 10px 14px; background: #C5A880; color: #141414; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 800; text-transform: uppercase; border-radius: 3px;" title="Đặt lịch hẹn cho dịch vụ này">
                                                <i class="fa fa-calendar-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div style="background: #fff; border: 1px dashed #cbd5e1; padding: 24px; text-align: center; color: #94a3b8; font-size: 0.95rem;">
                            <?php _e('Chưa có dịch vụ nào trong danh mục này. Bạn có thể thêm dịch vụ con trong trang quản trị WP-Admin.', 'hieugara-motors'); ?>
                        </div>
                    <?php endif; ?>

                </section>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Bottom Consultation & Booking Banner -->
        <div style="background: #141414; border-radius: 8px; border: 1px solid #C5A880; padding: 40px; color: #fff; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px; margin-top: 20px;">
            <div style="max-width: 750px;">
                <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 800; color: #C5A880; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 6px;">
                    <?php _e('HỖ TRỢ TƯ VẤN & BÁO GIÁ TRỰC TIẾP', 'hieugara-motors'); ?>
                </span>
                <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.6rem; font-weight: 800; color: #ffffff; text-transform: uppercase; margin: 0 0 10px;">
                    <?php _e('BẠN CẦN BÁO GIÁ CHÍNH XÁC THEO DÒNG XE CỦA MÌNH?', 'hieugara-motors'); ?>
                </h3>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                    Liên hệ ngay với cố vấn dịch vụ Ôtô Hải Hà qua Hotline <strong>0911 211 996</strong> hoặc Zalo để được kiểm tra và tư vấn kỹ thuật hoàn toàn miễn phí.
                </p>
            </div>
            <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
                <a href="https://zalo.me/<?php echo esc_attr($rescue_clean); ?>" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 14px 24px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 800; font-size: 0.9rem; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-comment-dots"></i> <?php _e('CHAT ZALO KỸ THUẬT', 'hieugara-motors'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" style="background: #C5A880; color: #141414; padding: 14px 24px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 800; font-size: 0.9rem; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-regular fa-calendar-check"></i> <?php _e('ĐẶT LỊCH HẸN TRỰC TUYẾN', 'hieugara-motors'); ?>
                </a>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();
