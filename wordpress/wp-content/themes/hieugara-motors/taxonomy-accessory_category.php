<?php
/**
 * Taxonomy Template for Accessory Categories
 * 100% Synchronized with WordPress Admin
 *
 * @package HieuGara_Motors
 */

get_header();

$current_term  = get_queried_object();
$term_id       = $current_term ? $current_term->term_id : 0;
$term_name     = $current_term ? $current_term->name : __('Danh Mục Phụ Kiện', 'hieugara-motors');
$term_desc     = $current_term ? $current_term->description : '';

$page_title    = $term_name;
$badge         = __('PHỤ KIỆN Ô TÔ CHÍNH HÃNG', 'hieugara-motors');

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('phukien');

// Query child accessories in this category from database
$child_accessories = array();
if ($term_id) {
    $child_accessories = get_posts(array(
        'post_type'      => 'garage_accessory',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy'         => 'accessory_category',
                'field'            => 'term_id',
                'terms'            => $term_id,
                'include_children' => true,
            ),
        ),
    ));
}
?>

<!-- Category Hero Header Banner (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay) -->
<section class="portal-hero-header phukien-hero-section" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><?php _e('Phụ Kiện', 'hieugara-motors'); ?></a>
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

<main id="primary" class="site-main page-phu-kien-portal" style="padding: 55px 0 85px; background: #F8FAFC; min-height: 50vh;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">

        <?php if (!empty($child_accessories)) : ?>
            <!-- CÓ BÀI VIẾT: HIỂN THỊ DANH SÁCH BÀI VIẾT PHỤ KIỆN -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px;">
                <?php foreach ($child_accessories as $acc) : 
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

        <?php else : ?>
            <!-- KHI CHƯA CÓ BÀI VIẾT: CHỈ HIỂN THỊ DUY NHẤT THÔNG BÁO NHẸ NHÀNG, KHÔNG IN ĐẬM, KHÔNG NỔI BẬT GÌ CẢ -->
            <div class="empty-phukien-hub" style="max-width: 860px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 40px 32px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 16px; font-weight: 400;">
                    Danh mục phụ kiện và bảng giá của chuyên mục này đang được đồng bộ, cập nhật chi tiết trên website để đảm bảo độ tương thích chuẩn xác nhất theo từng dòng xe.
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

