<?php
/**
 * Archive Template for Garage Services
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<!-- Portal Hero Banner -->
<section class="portal-hero-header">
    <div class="container">
        <div class="portal-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span>/</span>
            <span class="current"><?php _e('Hệ thống dịch vụ ô tô', 'hieugara-motors'); ?></span>
        </div>
        <h1 class="portal-page-title"><?php _e('TẤT CẢ DỊCH VỤ TẠI HẢI HÀ ÔTÔ', 'hieugara-motors'); ?></h1>
        <p class="portal-page-subtitle">
            <?php _e('Hải Hà Ô Tô (31 năm kinh nghiệm từ 1995 &bull; 80 nhân sự tận tâm): Cam kết 100% phụ tùng chính hãng OEM, quy trình sửa chữa chuẩn hãng và bảo hành điện tử theo biển số.', 'hieugara-motors'); ?>
        </p>
    </div>
</section>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: #f8fafc; min-height: 70vh;">
    <div class="container">

        <div class="services-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $price    = get_post_meta(get_the_ID(), '_service_price', true) ?: (get_post_meta(get_the_ID(), '_garage_price_from', true) ?: 'Liên hệ báo giá');
                    $badge    = get_post_meta(get_the_ID(), '_garage_badge', true) ?: 'CHUYÊN HÃNG';
                    $duration = get_post_meta(get_the_ID(), '_service_duration', true) ?: (get_post_meta(get_the_ID(), '_garage_duration', true) ?: '45 - 90 phút');
                    $warranty = get_post_meta(get_the_ID(), '_service_warranty', true) ?: (get_post_meta(get_the_ID(), '_garage_warranty', true) ?: '12 tháng');
                    $features = hieugara_get_service_features(get_the_ID());
                    $img_pool = array('port-1.jpg', 'port-2.jpg', 'port-3.jpg', 'port-4.jpg', 'pricing-1.jpg', 'pricing-2.jpg', 'pricing-3.jpg', 'slide-1.jpg', 'slide-2.jpg');
                    $picked   = $img_pool[get_the_ID() % count($img_pool)];
                    $thumb    = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb') : get_template_directory_uri() . '/assets/images/shiftup/' . $picked;
                    ?>
                    <article class="service-card">
                        <?php if (!empty($badge)) : ?>
                            <span class="service-badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>

                        <div class="service-media">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </div>

                        <div class="service-body">
                            <h2 class="service-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="service-price">
                                <i class="fa fa-tag"></i> <?php echo esc_html($price); ?>
                            </div>

                            <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?>
                            </p>

                            <div style="display: flex; gap: 14px; font-size: 0.8rem; color: #475569; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
                                <span><i class="fa fa-clock text-orange"></i> <?php echo esc_html($duration); ?></span>
                                <span><i class="fa fa-shield-halved text-orange"></i> <?php echo esc_html($warranty); ?></span>
                            </div>

                            <div class="service-card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn-gara btn-gara-outline-red">
                                    <?php _e('XEM CHI TIẾT', 'hieugara-motors'); ?> &rarr;
                                </a>
                                <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode(get_the_title()))); ?>" class="btn-gara btn-gara-red">
                                    <i class="fa fa-calendar-check"></i> <?php _e('ĐẶT HẸN', 'hieugara-motors'); ?>
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

