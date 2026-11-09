<?php
/**
 * Template Name: Phụ Kiện Ô Tô Chính Hãng (Danh Mục Phụ Kiện Hải Hà)
 * Description: Grouped by parent category (max 4 per category + Xem tất cả). If empty, display gentle un-bolded notification.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '02203 892 207';
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('phukien');

// Query parent accessory categories
$parent_cats = get_terms(array(
    'taxonomy'   => 'accessory_category',
    'parent'     => 0,
    'hide_empty' => false,
    'orderby'    => 'term_id',
    'order'      => 'ASC',
));

// Check each parent category for published child accessories (max 4 posts)
$categories_with_posts = array();
if (!empty($parent_cats) && !is_wp_error($parent_cats)) {
    foreach ($parent_cats as $pcat) {
        $posts_in_cat = get_posts(array(
            'post_type'      => 'garage_accessory',
            'posts_per_page' => 4, // Mỗi danh mục lớn chỉ hiển thị tối đa 4 bài
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'accessory_category',
                    'field'            => 'term_id',
                    'terms'            => $pcat->term_id,
                    'include_children' => true,
                ),
            ),
        ));

        if (!empty($posts_in_cat)) {
            $categories_with_posts[] = array(
                'term'        => $pcat,
                'accessories' => $posts_in_cat,
                'total'       => $pcat->count,
            );
        }
    }
}
?>

<!-- =========================================================================
     HERO BANNER (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay)
     ========================================================================= -->
<section class="phukien-hero-section" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container">
        <nav class="phukien-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php _e('Phụ Kiện Ô Tô', 'hieugara-motors'); ?></span>
        </nav>

        <div class="phukien-hero-content text-center">
            <h1 class="phukien-title">
                <?php _e('HỆ THỐNG PHỤ KIỆN & ĐỒ CHƠI Ô TÔ CHÍNH HÃNG', 'hieugara-motors'); ?>
            </h1>
            <p class="phukien-subtitle">
                <?php _e('Phân phối và lắp đặt phụ kiện xe hơi cắm giắc Zin theo tiêu chuẩn xưởng dịch vụ. Bảo hành điện tử chính hãng và hỗ trợ kỹ thuật tại xưởng Ô Tô Hải Hà.', 'hieugara-motors'); ?>
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     MAIN CONTENT
     ========================================================================= -->
<main id="primary" class="site-main page-phu-kien-portal" style="padding: 55px 0 85px; background: #F8FAFC; min-height: 50vh;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">

        <?php if (!empty($categories_with_posts)) : ?>
            <!-- LẶP QUA CÁC DANH MỤC LỚN CÓ PHỤ KIỆN (MỖI DANH MỤC TỐI ĐA 4 BÀI) -->
            <div style="display: flex; flex-direction: column; gap: 40px;">
                <?php foreach ($categories_with_posts as $item) : 
                    $cat_term        = $item['term'];
                    $cat_accessories = $item['accessories'];
                    $cat_link        = get_term_link($cat_term);
                ?>
                    <section class="phukien-cat-block" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 32px 32px 36px; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
                        
                        <!-- Tiêu đề danh mục lớn to + Nút xem tất cả -->
                        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; border-bottom: 2px solid #f1f5f9; padding-bottom: 18px; margin-bottom: 24px;">
                            <div style="max-width: 860px;">
                                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 800; color: #8C6239; letter-spacing: 1.5px; text-transform: uppercase;">
                                    DANH MỤC PHỤ KIỆN
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

                        <!-- Lưới tối đa 4 phụ kiện của danh mục này -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
                            <?php foreach ($cat_accessories as $acc) : 
                                $a_id    = $acc->ID;
                                $a_price = 'Liên hệ';
                                $a_link  = get_permalink($a_id);

                                if (has_post_thumbnail($a_id)) {
                                    $a_thumb = get_the_post_thumbnail_url($a_id, 'medium_large');
                                } else {
                                    $a_thumb = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-2.jpg';
                                }
                                if (function_exists('hieugara_normalize_local_media_urls')) {
                                    $a_thumb = hieugara_normalize_local_media_urls($a_thumb);
                                }
                            ?>
                                <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 16px rgba(0,0,0,0.03); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                    <div style="position: relative; height: 180px; overflow: hidden; background: #000;">
                                        <a href="<?php echo esc_url($a_link); ?>">
                                            <img src="<?php echo esc_url($a_thumb); ?>" alt="<?php echo esc_attr($acc->post_title); ?>" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>

                                    <div style="padding: 18px; display: flex; flex-direction: column; flex: 1;">
                                        <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 8px; text-transform: uppercase; line-height: 1.35;">
                                            <a href="<?php echo esc_url($a_link); ?>" style="color: inherit; text-decoration: none;">
                                                <?php echo esc_html($acc->post_title); ?>
                                            </a>
                                        </h3>

                                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; font-size: 0.78rem; font-family: 'Be Vietnam Pro', sans-serif;">
                                            <span style="background: #fff7ed; color: #c2410c; padding: 2px 8px; border-radius: 3px; font-weight: 700;">
                                                <i class="fa fa-tag" style="margin-right: 3px;"></i> <?php echo esc_html($a_price); ?>
                                            </span>
                                        </div>

                                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin: 0 0 14px; flex: 1;">
                                            <?php echo wp_trim_words(get_the_excerpt($a_id) ?: strip_tags($acc->post_content), 16, '...'); ?>
                                        </p>

                                        <div style="margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9; display: flex; gap: 8px;">
                                            <a href="<?php echo esc_url($a_link); ?>" style="flex: 1; text-align: center; padding: 8px 12px; background: #0f172a; color: #ffffff; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; border-radius: 4px;">
                                                <?php _e('Chi tiết', 'hieugara-motors'); ?> &rarr;
                                            </a>
                                            <a href="tel:0911211996" style="padding: 8px 12px; background: #C5A880; color: #141414; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.8rem; font-weight: 700; border-radius: 4px;" title="Gọi tư vấn">
                                                <i class="fa fa-phone"></i>
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
            <!-- THÔNG BÁO NHẸ NHÀNG, KHÔNG IN ĐẬM, KHÔNG NỔI BẬT GÌ CẢ -->
            <div class="empty-phukien-hub" style="max-width: 860px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 40px 32px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 16px; font-weight: 400;">
                    Danh mục phụ kiện và bảng giá đang được đồng bộ, cập nhật chi tiết trên website để đảm bảo độ tương thích chuẩn xác nhất theo từng dòng xe.
                </p>

                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 28px; font-weight: 400;">
                    Hệ thống Ô Tô Hải Hà vẫn cung cấp và lắp đặt hoàn thiện các dòng phụ kiện – đồ chơi xe hơi cắm giắc Zin 100% bình thường tại xưởng. Quý khách có nhu cầu tư vấn hoặc nhận báo giá ưu đãi cho xe của mình, xin vui lòng liên hệ trực tiếp hotline hoặc Zalo 24/7.
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
