<?php
/**
 * Taxonomy Template for Service Categories (Category Hubs)
 * Handles: /dich-vu/bao-duong-o-to/, /dich-vu/sua-chua-o-to/, etc.
 *
 * @package HieuGara_Motors
 */

get_header();

$current_term = get_queried_object();
$term_name = $current_term ? $current_term->name : __('Dịch Vụ Ô Tô', 'hieugara-motors');
$term_desc = $current_term && !empty($current_term->description) ? $current_term->description : __('Hải Hà ÔTô Service cam kết tính minh bạch 100%: Quy trình kiểm định chuẩn hãng, phụ tùng chính hãng OEM, bảo hành điện tử theo biển số xe.', 'hieugara-motors');
$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$theme_uri     = get_template_directory_uri();
?>

<!-- Category Hero Header Banner -->
<section class="portal-hero-header category-hub-header">
    <div class="container">
        <?php if (class_exists('HieuGara_SEO_Architecture')) : ?>
            <?php HieuGara_SEO_Architecture::render_breadcrumbs(); ?>
        <?php endif; ?>

        <div class="category-hub-badge">
            <span class="badge-dot"></span>
            <span><?php _e('TIÊU CHUẨN KỸ THUẬT XƯỞNG HẢI HÀ', 'hieugara-motors'); ?></span>
        </div>

        <h1 class="portal-page-title category-hub-title">
            <span class="orange-bar">|</span> <?php echo esc_html($term_name); ?>
        </h1>
        <p class="portal-page-subtitle category-hub-subtitle">
            <?php echo esc_html($term_desc); ?>
        </p>

        <!-- Sibling Categories Navigation Pills -->
        <div class="category-sibling-pills">
            <?php
            $sibling_terms = get_terms(array(
                'taxonomy'   => 'service_category',
                'hide_empty' => false,
                'parent'     => 0,
                'orderby'    => 'term_id',
                'order'      => 'ASC'
            ));

            if (!empty($sibling_terms) && !is_wp_error($sibling_terms)) :
                foreach ($sibling_terms as $s) :
                    // Only show the 6 primary categories
                    $slug = HieuGara_SEO_Architecture::$legacy_map[$s->slug] ?? $s->slug;
                    $is_active = ($current_term && ($current_term->term_id === $s->term_id || $current_term->slug === $s->slug));
                    ?>
                    <a href="<?php echo esc_url(home_url('/dich-vu/' . $slug . '/')); ?>" class="sibling-pill <?php echo $is_active ? 'active' : ''; ?>">
                        <?php echo esc_html($s->name); ?>
                    </a>
                <?php endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<main id="primary" class="site-main category-hub-main" style="padding: 60px 0 90px; background: #0b0d12; min-height: 60vh;">
    <div class="container">

        <!-- Grid of Services under this category -->
        <div class="category-services-grid">
            <?php
            if (have_posts()) :
                $i = 1;
                while (have_posts()) : the_post();
                    $price    = get_post_meta(get_the_ID(), '_service_price', true) ?: (get_post_meta(get_the_ID(), '_garage_price_from', true) ?: 'Liên hệ báo giá');
                    $badge    = get_post_meta(get_the_ID(), '_garage_badge', true) ?: 'TIÊU CHUẨN XƯỞNG';
                    $duration = get_post_meta(get_the_ID(), '_service_duration', true) ?: '45 - 90 phút';
                    $warranty = get_post_meta(get_the_ID(), '_service_warranty', true) ?: '12 - 24 tháng';
                    
                    $img_pool = array('port-1.jpg', 'port-2.jpg', 'port-3.jpg', 'port-4.jpg', 'pricing-1.jpg', 'pricing-2.jpg', 'pricing-3.jpg');
                    $picked   = $img_pool[get_the_ID() % count($img_pool)];
                    $thumb    = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb') : $theme_uri . '/assets/images/shiftup/' . $picked;
                    ?>
                    <article class="cat-service-card">
                        <div class="cat-card-media">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </a>
                            <span class="cat-tech-badge"><?php echo esc_html($badge); ?></span>
                        </div>

                        <div class="cat-card-body">
                            <h2 class="cat-service-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <span class="orange-bar">|</span> <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="cat-service-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 18); ?>
                            </p>

                            <div class="cat-card-meta">
                                <span class="meta-item"><i class="fa-regular fa-clock text-orange"></i> <?php echo esc_html($duration); ?></span>
                                <span class="meta-item"><i class="fa-solid fa-shield-halved text-orange"></i> <?php echo esc_html($warranty); ?></span>
                            </div>

                            <div class="cat-card-footer">
                                <div class="cat-price-wrap">
                                    <span class="price-lbl"><?php _e('Chi phí từ:', 'hieugara-motors'); ?></span>
                                    <span class="price-val text-orange"><?php echo esc_html($price); ?></span>
                                </div>
                                <div class="cat-action-btns">
                                    <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode(get_the_title()))); ?>" class="cat-book-btn">
                                        <span class="btn-orange-bar">|</span>
                                        <span>+ <?php _e('ĐẶT LỊCH', 'hieugara-motors'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php
                endwhile;
                
                // Pagination
                the_posts_pagination(array(
                    'prev_text' => '&larr; ' . __('Trước', 'hieugara-motors'),
                    'next_text' => __('Tiếp theo', 'hieugara-motors') . ' &rarr;',
                ));
            else :
                ?>
                <div class="no-services-notice text-center" style="grid-column: 1 / -1; padding: 60px 20px; color: #94a3b8;">
                    <p><?php _e('Hiện chưa có dịch vụ nào trong nhóm này. Vui lòng liên hệ hotline để được kỹ sư trưởng tư vấn trực tiếp.', 'hieugara-motors'); ?></p>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="shiftup-rect-btn btn-dark-view" style="margin-top: 15px;">
                        <span>GỌI HOTLINE: <?php echo esc_html($rescue_phone); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Category Hub Bottom Fast Booking Strip -->
        <div class="category-hub-cta-banner">
            <div class="cta-banner-content">
                <span class="cta-eyebrow"><?php _e('CAM KẾT CHẤT LƯỢNG HẢI HÀ ÔTÔ SERVICE', 'hieugara-motors'); ?></span>
                <h3 class="cta-heading"><?php _e('BÁO ĐÚNG GIÁ • BẮT ĐÚNG BỆNH • BẢO HÀNH ĐIỆN TỬ 24 THÁNG', 'hieugara-motors'); ?></h3>
                <p class="cta-desc"><?php _e('Đặt lịch trực tuyến ngay để được ưu tiên khoang kỹ thuật và nhận ưu đãi giảm 10% công bảo dưỡng.', 'hieugara-motors'); ?></p>
            </div>
            <div class="cta-banner-actions">
                <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="hero-cta-btn btn-booking">
                    <span class="btn-orange-strip"></span>
                    <span>ĐẶT LỊCH HẸN TRỰC TUYẾN</span>
                </a>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="hero-cta-btn btn-rescue">
                    <span class="btn-pulse-dot"></span>
                    <span>CỨU HỘ: <?php echo esc_html($rescue_phone); ?></span>
                </a>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();

