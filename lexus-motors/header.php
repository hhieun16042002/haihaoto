<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="lexus-header">
    <div class="container lexus-header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="lexus-brand">
            <svg width="40" height="30" viewBox="0 0 100 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Lexus Stylized Emblem -->
                <ellipse cx="50" cy="35" rx="46" ry="32" stroke="#c5a880" stroke-width="4"/>
                <path d="M30 20 L30 50 L68 50 M30 20 L72 20 L30 50" stroke="#f5f5f7" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="lexus-logo-text">LEXUS</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="lexus-nav">
            <div class="lexus-nav-item" data-mega-menu="true">
                <a href="<?php echo esc_url(get_post_type_archive_link('lexus_vehicle')); ?>"><?php _e('Dòng xe', 'lexus-motors'); ?> ▾</a>
            </div>
            <div class="lexus-nav-item">
                <a href="<?php echo esc_url(home_url('/#cong-nghe-hybrid')); ?>"><?php _e('Điện hóa', 'lexus-motors'); ?></a>
            </div>
            <div class="lexus-nav-item">
                <a href="<?php echo esc_url(home_url('/#trai-nghiem-lexus')); ?>"><?php _e('Trải nghiệm', 'lexus-motors'); ?></a>
            </div>
            <div class="lexus-nav-item">
                <a href="<?php echo esc_url(home_url('/#du-toan-chi-phi')); ?>"><?php _e('Dự toán chi phí', 'lexus-motors'); ?></a>
            </div>
            <div class="lexus-nav-item">
                <a href="<?php echo esc_url(home_url('/#lien-he')); ?>"><?php _e('Đại lý', 'lexus-motors'); ?></a>
            </div>
        </nav>

        <!-- Right CTA Actions -->
        <div class="header-actions">
            <a href="tel:18006868" class="header-hotline">
                <span style="color:#888;">HOTLINE:</span> 1800 6868
            </a>
            <a href="#dang-ky-lai-thu" class="btn-lexus btn-lexus-gold" data-open-modal="test-drive">
                <?php _e('Đăng ký lái thử', 'lexus-motors'); ?>
            </a>
        </div>
    </div>

    <!-- Mega Menu Dropdown -->
    <div id="lexus-mega-menu" class="lexus-mega-menu">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid var(--border-subtle); padding-bottom: 12px;">
                <span class="subtitle-gold" style="margin: 0;"><?php _e('KHÁM PHÁ CÁC MẪU XE LEXUS THẾ HỆ MỚI', 'lexus-motors'); ?></span>
                <a href="<?php echo esc_url(get_post_type_archive_link('lexus_vehicle')); ?>" style="font-size: 0.8125rem; color: var(--accent-gold); letter-spacing: 0.1em; text-transform: uppercase;">
                    <?php _e('Xem tất cả dòng xe →', 'lexus-motors'); ?>
                </a>
            </div>
            
            <div class="mega-menu-grid">
                <?php
                $mega_query = new WP_Query(array(
                    'post_type'      => 'lexus_vehicle',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));

                if ($mega_query->have_posts()) :
                    while ($mega_query->have_posts()) : $mega_query->the_post();
                        $specs = lexus_get_vehicle_specs(get_the_ID());
                        $colors = lexus_get_vehicle_colors(get_the_ID());
                        $thumb = !empty($colors) ? $colors[0]['image'] : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'lexus-car-thumb') : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=600&q=80');
                        ?>
                        <a href="<?php the_permalink(); ?>" class="mega-car-card">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                            <div class="mega-car-title"><?php the_title(); ?></div>
                            <div class="mega-car-price"><?php _e('Từ: ', 'lexus-motors'); ?><?php echo lexus_format_price($specs['price']); ?></div>
                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</header>

