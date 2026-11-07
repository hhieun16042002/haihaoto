<?php
/**
 * Taxonomy Template for Service Categories (Category Hubs)
 * 100% Synchronized with WordPress Admin
 *
 * @package HieuGara_Motors
 */

get_header();

$current_term  = get_queried_object();
$term_id       = $current_term ? $current_term->term_id : 0;
$term_name     = $current_term ? $current_term->name : __('Danh Mục Dịch Vụ', 'hieugara-motors');
$term_desc     = $current_term ? $current_term->description : '';
$term_slug     = $current_term ? $current_term->slug : '';

$prestige_data = function_exists('hieugara_get_prestige_service_data') ? hieugara_get_prestige_service_data($term_slug) : array();

$page_title    = $term_name;
$badge         = !empty($prestige_data['badge']) ? $prestige_data['badge'] : __('TIÊU CHUẨN KỸ THUẬT ÔTÔ HẢI HÀ', 'hieugara-motors');

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');

// Query child services in this category from database
$child_services = array();
if ($term_id) {
    $child_services = get_posts(array(
        'post_type'      => 'garage_service',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy'         => 'service_category',
                'field'            => 'term_id',
                'terms'            => $term_id,
                'include_children' => true,
            ),
        ),
    ));
}

// Other categories for sidebar jump
$other_cats = get_terms(array(
    'taxonomy'   => 'service_category',
    'parent'     => 0,
    'hide_empty' => false,
    'exclude'    => array($term_id),
));
?>

<!-- Category Hero Header Banner -->
<section class="service-single-header" style="background: #0f1115; padding: 50px 0 40px; border-bottom: 3px solid #F5A300; position: relative;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
        <?php if (class_exists('HieuGara_SEO_Architecture')) : ?>
            <?php HieuGara_SEO_Architecture::render_breadcrumbs(); ?>
        <?php endif; ?>

        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
            <div style="max-width: 900px;">
                <div style="display: inline-block; background: #F5A300; color: #ffffff; font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                    <?php echo esc_html($badge); ?>
                </div>
                <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0 0 10px; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.3;">
                    <span style="color: #F5A300;">|</span> <?php echo esc_html($page_title); ?>
                </h1>
                <?php if (!empty($term_desc)) : ?>
                    <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.6; margin: 0; max-width: 820px;">
                        <?php echo esc_html($term_desc); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Emergency Contact Badge -->
            <div style="display: flex; gap: 14px; align-items: center;">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(245, 163, 0, 0.15); border: 1px solid #F5A300; color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase;">
                    <i class="fa fa-phone-volume" style="color: #F5A300;"></i>
                    <span>CỨU HỘ 24/7: <strong style="color: #F5A300;"><?php echo esc_html($rescue_phone); ?></strong></span>
                </a>
            </div>
        </div>
    </div>
</section>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: #fbfbfb;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">

        <div class="service-detail-layout" style="display: grid; grid-template-columns: 2fr 1.15fr; gap: 48px; align-items: flex-start;">

            <!-- Left: Child Services List & Editorial Content -->
            <div class="service-detail-main">
                
                <!-- Child Services Section -->
                <div style="margin-bottom: 40px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px;">
                        <h2 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.35rem; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase;">
                            <i class="fa fa-wrench" style="color: #F5A300; margin-right: 8px;"></i>
                            <?php _e('CÁC GÓI DỊCH VỤ TRỌNG TÂM', 'hieugara-motors'); ?>
                            <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-left: 6px;">(<?php echo count($child_services); ?>)</span>
                        </h2>
                    </div>

                    <?php if (!empty($child_services)) : ?>
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 20px;">
                            <?php foreach ($child_services as $srv) : 
                                $s_id      = $srv->ID;
                                $s_price   = get_post_meta($s_id, '_garage_price_from', true) ?: (get_post_meta($s_id, '_service_price', true) ?: 'Liên hệ');
                                $s_dur     = get_post_meta($s_id, '_garage_duration', true) ?: (get_post_meta($s_id, '_service_duration', true) ?: '');
                                $s_badge   = get_post_meta($s_id, '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ';
                                $s_link    = get_permalink($s_id);

                                if (has_post_thumbnail($s_id)) {
                                    $s_thumb = get_the_post_thumbnail_url($s_id, 'medium_large');
                                } else {
                                    $s_c_img = get_post_meta($s_id, '_garage_custom_image', true);
                                    $s_thumb = !empty($s_c_img) ? $s_c_img : get_template_directory_uri() . '/assets/images/shiftup/slide-2.jpg';
                                }
                            ?>
                                <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 16px rgba(0,0,0,0.03); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                    <div style="position: relative; height: 180px; overflow: hidden; background: #000;">
                                        <a href="<?php echo esc_url($s_link); ?>">
                                            <img src="<?php echo esc_url($s_thumb); ?>" alt="<?php echo esc_attr($srv->post_title); ?>" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                        <?php if (!empty($s_badge)) : ?>
                                            <span style="position: absolute; top: 10px; left: 10px; background: #0f1115; color: #F5A300; font-family: 'Chakra Petch', sans-serif; font-size: 0.65rem; font-weight: 800; padding: 3px 8px; border-radius: 2px; text-transform: uppercase; border-left: 3px solid #F5A300;">
                                                <?php echo esc_html($s_badge); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div style="padding: 20px; display: flex; flex-direction: column; flex: 1;">
                                        <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; text-transform: uppercase; line-height: 1.35;">
                                            <a href="<?php echo esc_url($s_link); ?>" style="color: inherit; text-decoration: none;">
                                                <?php echo esc_html($srv->post_title); ?>
                                            </a>
                                        </h3>

                                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; font-size: 0.78rem; font-family: 'Chakra Petch', sans-serif;">
                                            <span style="background: #fff7ed; color: #c2410c; padding: 2px 8px; border-radius: 3px; font-weight: 700;">
                                                <i class="fa fa-tag" style="margin-right: 3px;"></i> <?php echo esc_html($s_price); ?>
                                            </span>
                                            <?php if (!empty($s_dur)) : ?>
                                                <span style="background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 3px; font-weight: 600;">
                                                    <i class="fa fa-clock" style="margin-right: 3px;"></i> <?php echo esc_html($s_dur); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0 0 16px; flex: 1;">
                                            <?php echo wp_trim_words(get_the_excerpt($s_id) ?: strip_tags($srv->post_content), 16, '...'); ?>
                                        </p>

                                        <div style="margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9; display: flex; gap: 8px;">
                                            <a href="<?php echo esc_url($s_link); ?>" style="flex: 1; text-align: center; padding: 9px 12px; background: #0f172a; color: #ffffff; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; border-radius: 3px;">
                                                <?php _e('Chi tiết', 'hieugara-motors'); ?> &rarr;
                                            </a>
                                            <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode($srv->post_title))); ?>" style="padding: 9px 12px; background: #F5A300; color: #ffffff; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; border-radius: 3px;" title="Đặt lịch hẹn">
                                                <i class="fa fa-calendar-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div style="background: #ffffff; border: 1px dashed #cbd5e1; padding: 28px; text-align: center; color: #94a3b8; font-size: 0.95rem;">
                            <?php _e('Chưa có dịch vụ con nào được gán vào danh mục này. Hãy thêm dịch vụ trong WP-Admin và chọn danh mục tương ứng.', 'hieugara-motors'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Editorial Content (if exists) -->
                <?php if (!empty($prestige_data['html'])) : ?>
                    <article style="background: #ffffff; padding: 36px; border: 1px solid #ebebeb; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 30px;">
                        <h2 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 0 0 20px; text-transform: uppercase; border-bottom: 2px solid #F5A300; padding-bottom: 10px;">
                            <span style="color: #F5A300;">|</span> <?php _e('THÔNG TIN CHUYÊN MÔN & QUY CHUẨN KỸ THUẬT', 'hieugara-motors'); ?>
                        </h2>
                        <div class="entry-content" style="line-height: 1.85; color: #334155; font-size: 1rem;">
                            <?php echo $prestige_data['html']; ?>
                        </div>
                    </article>
                <?php endif; ?>

                <!-- Workshop Guarantee Box -->
                <div style="padding: 24px; background: #ffffff; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <strong style="font-family: 'Chakra Petch', sans-serif; font-size: 1rem; color: #141414; display: block; margin-bottom: 4px;"><?php _e('CẦN TƯ VẤN KỸ THUẬT TRỰC TIẾP?', 'hieugara-motors'); ?></strong>
                        <span style="color: #5F6368; font-size: 0.9rem;"><?php _e('Đội ngũ kỹ thuật viên trưởng Ôtô Hải Hà hỗ trợ giải đáp trực tiếp 24/7.', 'hieugara-motors'); ?></span>
                    </div>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="shiftup-rect-btn btn-orange-solid" style="background: #F5A300; color: #fff; padding: 12px 24px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa fa-phone"></i> <?php echo esc_html($rescue_phone); ?>
                    </a>
                </div>

            </div>

            <!-- Right: Sticky Booking Form & Other Categories -->
            <aside class="service-sidebar" style="position: sticky; top: 120px;">
                <div style="background: #ffffff; border: 2px solid #141414; padding: 32px; box-shadow: 0 12px 30px rgba(0,0,0,0.08); margin-bottom: 30px;">
                    <div style="border-bottom: 2px solid #F5A300; padding-bottom: 16px; margin-bottom: 24px;">
                        <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; color: #F5A300; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('ÔTÔ HẢI HÀ SERVICE', 'hieugara-motors'); ?></span>
                        <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.35rem; font-weight: 800; color: #141414; text-transform: uppercase; margin: 6px 0 0;"><?php _e('ĐẶT HẸN DỊCH VỤ', 'hieugara-motors'); ?></h3>
                    </div>

                    <form class="hieugara-ajax-form">
                        <input type="hidden" name="service_type" value="<?php echo esc_attr($page_title); ?>">

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Họ và tên (*)', 'hieugara-motors'); ?></label>
                            <input type="text" name="customer_name" required placeholder="VD: Nguyễn Văn A" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                            <input type="tel" name="customer_phone" required placeholder="09xx xxx xxx" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Dòng xe / Đời xe', 'hieugara-motors'); ?></label>
                            <input type="text" name="car_model" placeholder="VD: Lexus RX350, Mercedes C200..." style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                        </div>

                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Xưởng tiếp nhận', 'hieugara-motors'); ?></label>
                            <select name="branch_location" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit; background: #fff;">
                                <option value="Trụ sở chính Ôtô Hải Hà">Trụ sở chính: Ôtô Hải Hà (Hải Dương)</option>
                                <option value="Tiếp nhận sửa chữa lưu động">Tiếp nhận sửa chữa lưu động tận nơi</option>
                                <option value="Cứu hộ giao thông 24/7">Cứu hộ kéo xe về xưởng 24/7 (Hotline: <?php echo esc_html($rescue_phone); ?>)</option>
                            </select>
                        </div>

                        <button type="submit" class="shiftup-rect-btn btn-orange-solid" style="width: 100%; padding: 15px; background: #F5A300; color: #fff; border: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.95rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; transition: background 0.2s ease;">
                            <span class="btn-orange-bar" style="color: #fff;">|</span> + <?php _e('XÁC NHẬN TIẾP NHẬN XE', 'hieugara-motors'); ?>
                        </button>
                        <div class="form-response-msg" style="display:none; margin-top: 12px; font-size: 0.9rem; padding: 10px; text-align: center;"></div>
                    </form>

                    <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.82rem; color: #666; line-height: 1.6;">
                        <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #F5A300;"></i> Kiểm tra tổng quát miễn phí 45 hạng mục.</p>
                        <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #F5A300;"></i> Báo giá trước minh bạch, khách duyệt mới làm.</p>
                        <p style="margin-bottom: 0;"><i class="fa fa-check" style="color: #F5A300;"></i> Bảo hành điện tử tra cứu theo biển số.</p>
                    </div>
                </div>

                <!-- Other Categories Widget -->
                <?php if (!empty($other_cats) && !is_wp_error($other_cats)) : ?>
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; padding: 24px; border-radius: 4px;">
                        <h4 style="font-family: 'Chakra Petch', sans-serif; font-size: 1rem; font-weight: 800; color: #0f172a; margin: 0 0 16px; text-transform: uppercase; border-bottom: 2px solid #F5A300; padding-bottom: 8px;">
                            <?php _e('DANH MỤC DỊCH VỤ KHÁC', 'hieugara-motors'); ?>
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <?php foreach ($other_cats as $oc) : ?>
                                <li style="margin-bottom: 8px;">
                                    <a href="<?php echo esc_url(home_url('/dich-vu/' . $oc->slug . '/')); ?>" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #f8fafc; color: #334155; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-radius: 3px; transition: all 0.2s ease;">
                                        <span><?php echo esc_html($oc->name); ?></span>
                                        <span style="color: #F5A300;">&rsaquo;</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </aside>

        </div>

    </div>
</main>

<?php
get_footer();
