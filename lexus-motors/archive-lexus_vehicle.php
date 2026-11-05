<?php
/**
 * Archive Template for Lexus Vehicles
 *
 * @package Lexus_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding-top: 120px; min-height: 80vh;">
    <div class="container">
        
        <header class="section-header" style="margin-bottom: 40px;">
            <span class="subtitle-gold"><?php _e('BẢNG GIÁ & DÒNG XE', 'lexus-motors'); ?></span>
            <h1 class="title-luxury" style="font-size: 2.75rem; margin-bottom: 16px;">
                <?php _e('TẤT CẢ DÒNG XE LEXUS CHÍNH HÃNG', 'lexus-motors'); ?>
            </h1>
            <p class="section-desc">
                <?php _e('Bảng giá niêm yết và thông số kỹ thuật mới nhất của các dòng xe Lexus phân phối chính thức tại Việt Nam.', 'lexus-motors'); ?>
            </p>
        </header>

        <!-- Segment Filter Tabs -->
        <div class="lineup-tabs" style="margin-bottom: 50px;">
            <button type="button" class="tab-btn active" data-filter="all"><?php _e('Tất cả dòng xe', 'lexus-motors'); ?></button>
            <button type="button" class="tab-btn" data-filter="sedan"><?php _e('Sedan', 'lexus-motors'); ?></button>
            <button type="button" class="tab-btn" data-filter="suv"><?php _e('SUV', 'lexus-motors'); ?></button>
            <button type="button" class="tab-btn" data-filter="electrified"><?php _e('Hybrid & Điện hóa', 'lexus-motors'); ?></button>
        </div>

        <!-- Vehicle Grid -->
        <div class="cars-grid" style="margin-bottom: 80px;">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $specs = lexus_get_vehicle_specs(get_the_ID());
                    $colors = lexus_get_vehicle_colors(get_the_ID());
                    $terms = get_the_terms(get_the_ID(), 'vehicle_segment');
                    $segment_slugs = '';
                    if ($terms && !is_wp_error($terms)) {
                        $slug_arr = wp_list_pluck($terms, 'slug');
                        $segment_slugs = implode(' ', $slug_arr);
                    }
                    $car_img = !empty($colors) ? $colors[0]['image'] : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'lexus-car-thumb') : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=700&q=80');
                    ?>
                    <article class="car-card" data-segments="<?php echo esc_attr($segment_slugs); ?>">
                        <?php if (!empty($specs['badge'])) : ?>
                            <span class="car-card-badge"><?php echo esc_html($specs['badge']); ?></span>
                        <?php endif; ?>

                        <div class="car-card-media">
                            <img src="<?php echo esc_url($car_img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </div>

                        <div class="car-card-body">
                            <h2 class="car-card-title"><?php the_title(); ?></h2>
                            <p class="car-card-tagline"><?php echo esc_html($specs['tagline'] ? $specs['tagline'] : get_the_excerpt()); ?></p>
                            
                            <div class="car-card-price">
                                <small style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: normal;"><?php _e('Giá bán lẻ khuyến nghị:', 'lexus-motors'); ?></small>
                                <?php echo lexus_format_price($specs['price']); ?>
                            </div>

                            <div class="car-specs-summary">
                                <div class="spec-item">
                                    <small><?php _e('Động cơ', 'lexus-motors'); ?></small>
                                    <span><?php echo esc_html($specs['engine'] ? $specs['engine'] : 'Tiêu chuẩn'); ?></span>
                                </div>
                                <div class="spec-item">
                                    <small><?php _e('Công suất', 'lexus-motors'); ?></small>
                                    <span><?php echo esc_html($specs['horsepower'] ? $specs['horsepower'] : 'Tối ưu'); ?></span>
                                </div>
                                <div class="spec-item">
                                    <small><?php _e('Hộp số', 'lexus-motors'); ?></small>
                                    <span><?php echo esc_html($specs['transmission'] ? $specs['transmission'] : 'Direct-Shift'); ?></span>
                                </div>
                                <div class="spec-item">
                                    <small><?php _e('Tăng tốc', 'lexus-motors'); ?></small>
                                    <span><?php echo esc_html($specs['acceleration'] ? $specs['acceleration'] : 'Mượt mà'); ?></span>
                                </div>
                            </div>

                            <div class="car-card-actions">
                                <a href="<?php the_permalink(); ?>" class="btn-lexus" style="padding: 10px 16px; font-size: 0.75rem;">
                                    <?php _e('XEM CHI TIẾT', 'lexus-motors'); ?>
                                </a>
                                <a href="#" class="btn-lexus btn-lexus-gold" style="padding: 10px 16px; font-size: 0.75rem;" data-open-modal="test-drive" data-car-model="<?php the_title_attribute(); ?>">
                                    <?php _e('LÁI THỬ', 'lexus-motors'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php
                endwhile;
                the_posts_navigation();
            else :
                ?>
                <p style="text-align: center; color: var(--text-secondary);"><?php _e('Chưa có dòng xe nào trong hệ thống.', 'lexus-motors'); ?></p>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php
get_footer();

