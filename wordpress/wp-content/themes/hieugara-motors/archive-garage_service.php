<?php
/**
 * Archive Template for Garage Services (/dich-vu/)
 * 100% Dynamic - Synchronized with WordPress Admin Categories & Services
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');

// Query all parent categories dynamically from database
$categories = get_terms(array(
    'taxonomy'   => 'service_category',
    'parent'     => 0,
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC',
));
?>

<!-- Portal Hero Banner -->
<section class="portal-hero-header" style="background: #0f1115; padding: 50px 0 45px; border-bottom: 3px solid #F5A300; position: relative;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
        <div class="portal-breadcrumb" style="display: flex; gap: 8px; align-items: center; font-size: 0.85rem; color: #94a3b8; margin-bottom: 15px; font-family: 'Chakra Petch', sans-serif; text-transform: uppercase;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #cbd5e1; text-decoration: none;"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span style="color: #64748b;">/</span>
            <span class="current" style="color: #F5A300; font-weight: 700;"><?php _e('Dịch vụ', 'hieugara-motors'); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
            <div style="max-width: 900px;">
                <div style="display: inline-block; background: #F5A300; color: #ffffff; font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                    <?php _e('TRUNG TÂM BẢO DƯỠNG & SỬA CHỮA Ô TÔ CAO CẤP', 'hieugara-motors'); ?>
                </div>
                <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 800; color: #ffffff; margin: 0 0 14px; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.25;">
                    <span style="color: #F5A300;">|</span> <?php _e('HỆ THỐNG DỊCH VỤ ÔTÔ HẢI HÀ', 'hieugara-motors'); ?>
                </h1>
                <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.6; margin: 0; max-width: 860px;">
                    Cung cấp đầy đủ các giải pháp chăm sóc, bảo dưỡng định kỳ, chẩn đoán điện tử chuyên sâu và phục hồi thân vỏ công nghệ cao theo quy chuẩn quốc tế tại Hải Dương.
                </p>
            </div>
            <div style="display: flex; gap: 12px; align-items: center;">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(245, 163, 0, 0.15); border: 1px solid #F5A300; color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase;">
                    <i class="fa fa-phone-volume" style="color: #F5A300;"></i>
                    <span>CỨU HỘ 24/7: <strong style="color: #F5A300;"><?php echo esc_html($rescue_phone); ?></strong></span>
                </a>
            </div>
        </div>

        <!-- Category Quick Jump Bar -->
        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <div style="margin-top: 32px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <?php foreach ($categories as $q_cat) : ?>
                    <a href="#cat-<?php echo esc_attr($q_cat->slug); ?>" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #e2e8f0; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 700; padding: 7px 14px; text-decoration: none; text-transform: uppercase; transition: all 0.2s ease;">
                        <?php echo esc_html($q_cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Dynamic Category Sections -->
<main id="primary" class="site-main" style="padding: 60px 0 90px; background: #F8FAFC;">
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
                <section id="cat-<?php echo esc_attr($cat->slug); ?>" style="margin-bottom: 70px; scroll-margin-top: 100px;">
                    
                    <!-- Section Header -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 14px;">
                        <div>
                            <h2 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0 0 6px; text-transform: uppercase;">
                                <span style="color: #F5A300;">|</span> <?php echo esc_html($cat->name); ?>
                                <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-left: 8px;">(<?php echo count($services); ?> dịch vụ)</span>
                            </h2>
                            <?php if (!empty($cat->description)) : ?>
                                <p style="margin: 0; color: #64748b; font-size: 0.95rem; max-width: 850px; line-height: 1.6;">
                                    <?php echo esc_html($cat->description); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo esc_url($cat_link); ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #F5A300; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; text-decoration: none;">
                            <span><?php _e('Xem chi tiết danh mục', 'hieugara-motors'); ?></span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <!-- Services Grid -->
                    <?php if (!empty($services)) : ?>
                        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
                            <?php foreach ($services as $srv) : 
                                $srv_id    = $srv->ID;
                                $price     = get_post_meta($srv_id, '_garage_price_from', true) ?: (get_post_meta($srv_id, '_service_price', true) ?: 'Liên hệ');
                                $duration  = get_post_meta($srv_id, '_garage_duration', true) ?: (get_post_meta($srv_id, '_service_duration', true) ?: '');
                                $warranty  = get_post_meta($srv_id, '_garage_warranty', true) ?: (get_post_meta($srv_id, '_service_warranty', true) ?: '');
                                $badge     = get_post_meta($srv_id, '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ';
                                $permalink = get_permalink($srv_id);

                                if (has_post_thumbnail($srv_id)) {
                                    $thumb = get_the_post_thumbnail_url($srv_id, 'medium_large');
                                } else {
                                    $custom_img = get_post_meta($srv_id, '_garage_custom_image', true);
                                    $thumb = !empty($custom_img) ? $custom_img : get_template_directory_uri() . '/assets/images/shiftup/slide-2.jpg';
                                }
                            ?>
                                <article class="service-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s ease, box-shadow 0.2s ease; position: relative;">
                                    <?php if (!empty($badge)) : ?>
                                        <span style="position: absolute; top: 12px; left: 12px; z-index: 2; background: #0f1115; color: #F5A300; font-family: 'Chakra Petch', sans-serif; font-size: 0.68rem; font-weight: 800; padding: 4px 10px; border-radius: 2px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #F5A300;">
                                            <?php echo esc_html($badge); ?>
                                        </span>
                                    <?php endif; ?>

                                    <div class="service-media" style="position: relative; height: 200px; overflow: hidden; background: #000;">
                                        <a href="<?php echo esc_url($permalink); ?>">
                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($srv->post_title); ?>" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                        </a>
                                    </div>

                                    <div class="service-body" style="padding: 22px; display: flex; flex-direction: column; flex: 1;">
                                        <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; text-transform: uppercase; line-height: 1.35;">
                                            <a href="<?php echo esc_url($permalink); ?>" style="color: inherit; text-decoration: none;">
                                                <?php echo esc_html($srv->post_title); ?>
                                            </a>
                                        </h3>

                                        <!-- Meta Pills -->
                                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; font-size: 0.8rem; font-family: 'Chakra Petch', sans-serif;">
                                            <span style="background: #fff7ed; color: #c2410c; padding: 3px 8px; border-radius: 3px; font-weight: 700;">
                                                <i class="fa fa-tag" style="margin-right: 4px;"></i> <?php echo esc_html($price); ?>
                                            </span>
                                            <?php if (!empty($duration)) : ?>
                                                <span style="background: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 3px; font-weight: 600;">
                                                    <i class="fa fa-clock" style="margin-right: 4px;"></i> <?php echo esc_html($duration); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6; margin: 0 0 18px; flex: 1;">
                                            <?php echo wp_trim_words(get_the_excerpt($srv_id) ?: strip_tags($srv->post_content), 18, '...'); ?>
                                        </p>

                                        <div class="service-card-footer" style="margin-top: auto; padding-top: 14px; border-top: 1px solid #f1f5f9; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo esc_url($permalink); ?>" style="flex: 1; text-align: center; padding: 10px 14px; background: #0f172a; color: #ffffff; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; border-radius: 3px;">
                                                <?php _e('Chi tiết', 'hieugara-motors'); ?> &rarr;
                                            </a>
                                            <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode($srv->post_title))); ?>" style="padding: 10px 14px; background: #F5A300; color: #ffffff; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; border-radius: 3px;" title="Đặt lịch hẹn cho dịch vụ này">
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
        <?php else : ?>
            <div style="background: #fff; padding: 40px; text-align: center; border: 1px solid #e2e8f0; border-radius: 4px;">
                <p style="color: #64748b; font-size: 1.1rem; margin-bottom: 16px;"><?php _e('Chưa có danh mục dịch vụ nào được cấu hình.', 'hieugara-motors'); ?></p>
                <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=service_category&post_type=garage_service')); ?>" class="shiftup-rect-btn btn-orange-solid">
                    <?php _e('Thêm danh mục trong Admin', 'hieugara-motors'); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
