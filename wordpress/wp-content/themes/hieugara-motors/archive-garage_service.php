<?php
/**
 * Archive Template for Garage Services (/dich-vu/)
 * 
 * Logic:
 * - Nhóm theo từng danh mục lớn (service_category).
 * - Danh mục nào có bài viết thì mới hiển thị (tên danh mục lớn to + tối đa 4 bài + nút "Xem tất cả").
 * - Nếu chưa có danh mục nào có bài viết: hiển thị thông báo nhẹ nhàng, thanh lịch, không in đậm, không nổi bật rực rỡ.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('services');

// Query parent service categories
$parent_cats = get_terms(array(
    'taxonomy'   => 'service_category',
    'parent'     => 0,
    'hide_empty' => true,
    'orderby'    => 'term_id',
    'order'      => 'ASC',
));

// Check each parent category for published child services (max 4 posts)
$categories_with_posts = array();
if (!empty($parent_cats) && !is_wp_error($parent_cats)) {
    foreach ($parent_cats as $pcat) {
        $raw_posts = get_posts(array(
            'post_type'      => 'garage_service',
            'posts_per_page' => 10,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'service_category',
                    'field'            => 'term_id',
                    'terms'            => $pcat->term_id,
                    'include_children' => true,
                ),
            ),
        ));

        $posts_in_cat = array();
        if (!empty($raw_posts)) {
            foreach ($raw_posts as $rp) {
                if ($rp->menu_order > 0 && strpos($rp->post_name, 'tong-quan-') !== 0) {
                    $posts_in_cat[] = $rp;
                }
                if (count($posts_in_cat) >= 4) break;
            }
        }

        if (!empty($posts_in_cat)) {
            $categories_with_posts[] = array(
                'term'     => $pcat,
                'services' => $posts_in_cat,
                'total'    => $pcat->count,
            );
        }
    }
}
?>

<!-- =========================================================================
     HERO BANNER (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay)
     ========================================================================= -->
<section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container" style="max-width: 1400px;">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php _e('Dịch Vụ', 'hieugara-motors'); ?></span>
        </nav>
        <h1 class="portal-page-title" style="margin: 0 auto;"><?php _e('HỆ THỐNG DỊCH VỤ ÔTÔ HẢI HÀ', 'hieugara-motors'); ?></h1>
    </div>
</section>

<!-- =========================================================================
     MAIN CONTENT
     ========================================================================= -->
<main id="primary" class="site-main" style="padding: 55px 0 85px; background: #F8FAFC; min-height: 50vh;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">

        <?php if (!empty($categories_with_posts)) : ?>
            <!-- LẶP QUA CÁC DANH MỤC LỚN CÓ BÀI VIẾT (MỖI DANH MỤC TỐI ĐA 4 BÀI) -->
            <div style="display: flex; flex-direction: column; gap: 40px;">
                <?php foreach ($categories_with_posts as $item) : 
                    $cat_term     = $item['term'];
                    $cat_services = $item['services'];
                    $cat_link     = get_term_link($cat_term);
                ?>
                    <section class="service-cat-block" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 32px 32px 36px; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
                        
                        <!-- Tiêu đề danh mục lớn to + Nút xem tất cả -->
                        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; border-bottom: 2px solid #f1f5f9; padding-bottom: 18px; margin-bottom: 24px;">
                            <div style="max-width: 860px;">
                                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 800; color: #8C6239; letter-spacing: 1.5px; text-transform: uppercase;">
                                    CHUYÊN MỤC DỊCH VỤ
                                </span>
                                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(1.4rem, 2.5vw, 1.85rem); font-weight: 800; color: #141414; margin: 4px 0 6px; text-transform: uppercase;">
                                    <?php echo esc_html($cat_term->name); ?>
                                </h2>
                                <?php if (!empty($cat_term->description)) : ?>
                                    <p style="font-size: 0.95rem; color: #64748b; margin: 0; line-height: 1.6;">
                                        <?php echo esc_html($cat_term->description); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <a href="<?php echo esc_url($cat_link); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #f8fafc; color: #141414; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-decoration: none; text-transform: uppercase; transition: all 0.2s;">
                                    <span>Xem tất cả</span> &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Lưới tối đa 4 bài viết của danh mục này -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
                            <?php foreach ($cat_services as $srv) : 
                                $s_id    = $srv->ID;
                                $s_price = 'Liên hệ';
                                $s_dur   = get_post_meta($s_id, '_garage_duration', true) ?: (get_post_meta($s_id, '_service_duration', true) ?: '');
                                $s_badge = get_post_meta($s_id, '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ';
                                $s_link  = get_permalink($s_id);

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
                                <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 16px rgba(0,0,0,0.03); transition: transform 0.2s ease, box-shadow 0.2s ease;">
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

                                    <div style="padding: 18px; display: flex; flex-direction: column; flex: 1;">
                                        <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 8px; text-transform: uppercase; line-height: 1.35;">
                                            <a href="<?php echo esc_url($s_link); ?>" style="color: inherit; text-decoration: none;">
                                                <?php echo esc_html($srv->post_title); ?>
                                            </a>
                                        </h3>

                                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0 0 14px; flex: 1;">
                                            <?php echo wp_trim_words(get_the_excerpt($s_id) ?: strip_tags($srv->post_content), 18, '...'); ?>
                                        </p>

                                        <div style="margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                                            <a href="<?php echo esc_url($s_link); ?>" style="color: #C5A880; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 6px; transition: opacity 0.2s ease;">
                                                <span><?php _e('Chi tiết', 'hieugara-motors'); ?></span> &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                    </section>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <!-- THÔNG BÁO NHẸ NHÀNG, KHÔNG IN ĐẬM, KHÔNG NỔI BẬT GÌ CẢ (THEO YÊU CẦU ẢNH 2) -->
            <div class="empty-service-hub" style="max-width: 860px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 40px 32px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 16px; font-weight: 400;">
                    Dữ liệu các gói dịch vụ đang được đồng bộ và cập nhật trên hệ thống website để đảm bảo thông tin kỹ thuật và bảng giá chính xác nhất theo từng dòng xe.
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
