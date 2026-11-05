<?php
/**
 * Archive Template for Garage Services
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: var(--bg-light); min-height: 80vh;">
    <div class="container">
        
        <div class="section-header">
            <span class="section-tag"><?php _e('BẢNG DỊCH VỤ TOÀN DIỆN', 'hieugara-motors'); ?></span>
            <h1 class="section-title"><?php _e('TẤT CẢ DỊCH VỤ TẠI HIẾU GARA', 'hieugara-motors'); ?></h1>
            <p class="section-desc">
                <?php _e('Cam kết phụ tùng chính hãng, quy trình sửa chữa minh bạch, bảo hành dài hạn với chi phí tối ưu nhất.', 'hieugara-motors'); ?>
            </p>
        </div>

        <div class="services-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $price    = get_post_meta(get_the_ID(), '_garage_price_from', true);
                    $badge    = get_post_meta(get_the_ID(), '_garage_badge', true);
                    $features = hieugara_get_service_features(get_the_ID());
                    $thumb    = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb') : 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&q=80';
                    ?>
                    <article class="service-card">
                        <?php if (!empty($badge)) : ?>
                            <span class="service-badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>

                        <div class="service-media">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </div>

                        <div class="service-body">
                            <h2 class="service-title" style="font-size: 1.25rem;"><?php the_title(); ?></h2>
                            
                            <div class="service-price">
                                <i class="fa fa-tag"></i> <?php echo esc_html($price ? $price : 'Liên hệ báo giá'); ?>
                            </div>

                            <?php if (!empty($features)) : ?>
                                <ul class="service-features-list">
                                    <?php foreach (array_slice($features, 0, 3) as $feat) : ?>
                                        <li><i class="fa fa-check-circle"></i> <span><?php echo esc_html($feat); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <div class="service-card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn-gara btn-gara-outline-red" style="padding: 10px 14px; font-size: 0.75rem;">
                                    <?php _e('XEM CHI TIẾT', 'hieugara-motors'); ?>
                                </a>
                                <a href="#" class="btn-gara btn-gara-red" style="padding: 10px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="<?php the_title_attribute(); ?>">
                                    <i class="fa fa-calendar-alt"></i> <?php _e('ĐẶT HẸN', 'hieugara-motors'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php
                endwhile;
                the_posts_navigation();
            else :
                ?>
                <p style="text-align: center; color: var(--text-secondary);"><?php _e('Chưa có dịch vụ nào.', 'hieugara-motors'); ?></p>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php
get_footer();

