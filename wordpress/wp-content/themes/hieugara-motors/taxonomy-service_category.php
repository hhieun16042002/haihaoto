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

$page_title    = $term_name;
$badge         = __('TIÊU CHUẨN KỸ THUẬT ÔTÔ HẢI HÀ', 'hieugara-motors');

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');

// Query child services in this category from database
$child_services = array();
$overview_post  = null;
$overview_html  = '';
if ($term_id) {
    $raw_services = get_posts(array(
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

    if (!empty($raw_services)) {
        foreach ($raw_services as $cs) {
            if ($cs->menu_order === 0 || strpos($cs->post_name, 'tong-quan-') === 0) {
                $overview_post = $cs;
            } else {
                $child_services[] = $cs;
            }
        }
    }

    $overview_html = get_term_meta($term_id, '_overview_html', true);
    if (empty($overview_html) && $overview_post) {
        $overview_html = $overview_post->post_content;
    }
    if (!empty($overview_html)) {
        $overview_html = apply_filters('the_content', $overview_html);
    }
}

// Other categories for sidebar jump
$other_cats = get_terms(array(
    'taxonomy'   => 'service_category',
    'parent'     => 0,
    'hide_empty' => true,
    'exclude'    => array($term_id),
));

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('services');
?>

<!-- Category Hero Header Banner (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay) -->
<section class="portal-hero-header service-single-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>"><?php _e('Dịch Vụ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php echo esc_html($page_title); ?></span>
        </nav>

        <div style="display: inline-block; background: rgba(197, 168, 128, 0.2); border: 1px solid #C5A880; color: #D4B996; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.72rem; font-weight: 800; padding: 4px 14px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 12px; border-radius: 20px;">
            <?php echo esc_html($badge); ?>
        </div>

        <h1 class="portal-page-title" style="margin: 0 auto 12px;">
            <?php echo esc_html($page_title); ?>
        </h1>

        <?php if (!empty($term_desc)) : ?>
            <p class="portal-page-subtitle">
                <?php echo esc_html($term_desc); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: #fbfbfb; min-height: 50vh;">
    <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">

        <?php if (!empty($child_services)) : ?>
            <!-- CÓ BÀI VIẾT: HIỂN THỊ DANH SÁCH BÀI VIẾT DỊCH VỤ -->
            <div class="service-detail-layout" style="display: grid; grid-template-columns: 2fr 1.15fr; gap: 48px; align-items: flex-start;">

                <!-- Left: Child Services List -->
                <div class="service-detail-main">
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px;">
                        <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.35rem; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase;">
                            <i class="fa fa-wrench" style="color: #C5A880; margin-right: 8px;"></i>
                            <?php echo esc_html($page_title); ?>
                            <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-left: 6px;">(<?php echo count($child_services); ?>)</span>
                        </h2>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 20px;">
                        <?php foreach ($child_services as $srv) : 
                            $s_id      = $srv->ID;
                            $s_price   = 'Liên hệ';
                            $s_dur     = get_post_meta($s_id, '_garage_duration', true) ?: (get_post_meta($s_id, '_service_duration', true) ?: '');
                            $s_badge   = get_post_meta($s_id, '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ';
                            $s_link    = get_permalink($s_id);

                            if (has_post_thumbnail($s_id)) {
                                $s_thumb = get_the_post_thumbnail_url($s_id, 'medium_large');
                            } else {
                                $s_c_img = get_post_meta($s_id, '_garage_custom_image', true);
                                $s_thumb = !empty($s_c_img) ? $s_c_img : get_template_directory_uri() . '/assets/images/shiftup/slide-2.jpg';
                            }
                            if (function_exists('hieugara_normalize_local_media_urls')) {
                                $s_thumb = hieugara_normalize_local_media_urls($s_thumb);
                            }
                        ?>
                            <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 16px rgba(0,0,0,0.03); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div style="position: relative; height: 180px; overflow: hidden; background: #000;">
                                    <a href="<?php echo esc_url($s_link); ?>">
                                        <img src="<?php echo esc_url($s_thumb); ?>" alt="<?php echo esc_attr($srv->post_title); ?>" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                    <?php if (!empty($s_badge)) : ?>
                                        <span style="position: absolute; top: 10px; left: 10px; background: #0f1115; color: #C5A880; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.65rem; font-weight: 800; padding: 3px 8px; border-radius: 2px; text-transform: uppercase; border-left: 3px solid #C5A880;">
                                            <?php echo esc_html($s_badge); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div style="padding: 20px; display: flex; flex-direction: column; flex: 1;">
                                    <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; text-transform: uppercase; line-height: 1.35;">
                                        <a href="<?php echo esc_url($s_link); ?>" style="color: inherit; text-decoration: none;">
                                            <?php echo esc_html($srv->post_title); ?>
                                        </a>
                                    </h3>

                                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0 0 16px; flex: 1;">
                                        <?php echo wp_trim_words(get_the_excerpt($s_id) ?: strip_tags($srv->post_content), 18, '...'); ?>
                                    </p>

                                    <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                                        <a href="<?php echo esc_url($s_link); ?>" style="display: block; width: 100%; text-align: center; padding: 10px 14px; background: #0f172a; color: #C5A880; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; border-radius: 4px; transition: all 0.2s ease;">
                                            <?php _e('Chi tiết', 'hieugara-motors'); ?> &rarr;
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <?php if (!empty($overview_html)) : ?>
                        <div class="category-overview-wrap" style="margin-top: 45px; padding-top: 35px; border-top: 2px solid #e2e8f0;">
                            <div class="entry-content" style="line-height: 1.85; color: #334155; font-size: 1.02rem;">
                                <?php echo $overview_html; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Right: Direct Support & Other Categories -->
                <aside class="service-sidebar" style="position: sticky; top: 120px;">
                    <div style="background: #ffffff; border: 2px solid #141414; padding: 32px; box-shadow: 0 12px 30px rgba(0,0,0,0.08); margin-bottom: 30px; border-radius: 8px;">
                        <div style="border-bottom: 2px solid #D4B996; padding-bottom: 16px; margin-bottom: 20px;">
                            <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 800; color: #D4B996; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('ÔTÔ HẢI HÀ SERVICE', 'hieugara-motors'); ?></span>
                            <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.35rem; font-weight: 800; color: #141414; text-transform: uppercase; margin: 6px 0 0;"><?php _e('TƯ VẤN & BÁO GIÁ DỊCH VỤ', 'hieugara-motors'); ?></h3>
                        </div>

                        <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin-bottom: 20px;">
                            Quý khách vui lòng liên hệ trực tiếp với Cố vấn dịch vụ Ô Tô Hải Hà qua Hotline hoặc Zalo để được hỗ trợ kiểm tra xe và nhận báo giá ưu đãi nhanh nhất.
                        </p>

                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="tel:0911211996" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 15px; background: #D4B996; color: #141414; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.95rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; border-radius: 4px; box-shadow: 0 4px 12px rgba(212,185,150,0.3);">
                                <i class="fa-solid fa-phone-volume"></i> Gọi Ngay: 0911 211 996
                            </a>

                            <a href="tel:02203892207" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 13px; background: #141414; color: #ffffff; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.9rem; font-weight: 700; text-decoration: none; border-radius: 4px;">
                                <i class="fa-solid fa-headset"></i> Tổng Đài: 02203 892 207
                            </a>

                            <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 13px; background: #0068FF; color: #ffffff; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.9rem; font-weight: 700; text-decoration: none; border-radius: 4px;">
                                <i class="fa-solid fa-comment-dots"></i> Chat Zalo Kỹ Thuật
                            </a>
                        </div>

                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.82rem; color: #666; line-height: 1.6;">
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #C5A880;"></i> Kiểm tra tổng quát miễn phí 45 hạng mục.</p>
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #C5A880;"></i> Báo giá trước minh bạch, khách duyệt mới làm.</p>
                            <p style="margin-bottom: 0;"><i class="fa fa-check" style="color: #C5A880;"></i> Bảo hành dài hạn minh bạch bằng hóa đơn &amp; tem kiểm định.</p>
                        </div>
                    </div>

                    <!-- Other Categories Widget -->
                    <?php if (!empty($other_cats) && !is_wp_error($other_cats)) : ?>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; padding: 24px; border-radius: 4px;">
                            <h4 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1rem; font-weight: 800; color: #0f172a; margin: 0 0 16px; text-transform: uppercase; border-bottom: 2px solid #C5A880; padding-bottom: 8px;">
                                <?php _e('DANH MỤC DỊCH VỤ KHÁC', 'hieugara-motors'); ?>
                            </h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach ($other_cats as $oc) : ?>
                                    <li style="margin-bottom: 8px;">
                                        <a href="<?php echo esc_url(home_url('/dich-vu/' . $oc->slug . '/')); ?>" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #f8fafc; color: #334155; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-radius: 3px; transition: all 0.2s ease;">
                                            <span><?php echo esc_html($oc->name); ?></span>
                                            <span style="color: #C5A880;">&rsaquo;</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </aside>

            </div>

        <?php else : ?>
            <!-- KHI CHƯA CÓ BÀI VIẾT: CHỈ HIỂN THỊ DUY NHẤT THÔNG BÁO NHẸ NHÀNG, KHÔNG IN ĐẬM, KHÔNG NỔI BẬT GÌ CẢ -->
            <div class="empty-service-hub" style="max-width: 860px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 40px 32px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 16px; font-weight: 400;">
                    Dữ liệu chi tiết của chuyên mục này đang được đồng bộ và cập nhật trên hệ thống website để đảm bảo thông tin kỹ thuật và bảng giá chính xác nhất theo từng dòng xe.
                </p>

                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 28px; font-weight: 400;">
                    Hệ thống xưởng dịch vụ Ô Tô Hải Hà vẫn tiếp nhận xe, bảo dưỡng định kỳ và sửa chữa toàn diện bình thường tại xưởng: KM3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn, TP. Hải Dương. Mọi nhu cầu tư vấn kỹ thuật hoặc báo giá thực tế, quý khách vui lòng liên hệ hotline hoặc Zalo để được cố vấn hỗ trợ nhanh nhất 24/7.
                </p>

                <!-- Các nút liên hệ hỗ trợ nhẹ nhàng -->
                <div style="display: flex; justify-content: center; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <a href="tel:0911211996" style="background: #141414; color: #ffffff; padding: 10px 20px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-phone-volume"></i> Hotline: 0911 211 996
                    </a>
                    <a href="tel:02203892207" style="background: #f8fafc; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-headset"></i> Tổng Đài: 02203 892 207
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 10px 20px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-comment-dots"></i> Chat Zalo
                    </a>
                </div>

            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
