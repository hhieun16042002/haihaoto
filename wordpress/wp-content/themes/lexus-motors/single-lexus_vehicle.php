<?php
/**
 * Single Template for Lexus Vehicles
 *
 * @package Lexus_Motors
 */

get_header();

while (have_posts()) : the_post();
    $specs = lexus_get_vehicle_specs(get_the_ID());
    $colors = lexus_get_vehicle_colors(get_the_ID());
    $default_img = !empty($colors) ? $colors[0]['image'] : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=1200&q=85');
    $default_color_name = !empty($colors) ? $colors[0]['name'] : 'Màu tiêu chuẩn';
    ?>

    <main id="primary" class="site-main" style="padding-top: 100px;">
        
        <!-- Car Hero & Header -->
        <section class="single-car-hero" style="padding: 40px 0 60px; background: radial-gradient(circle at 50% 30%, #1c1c20 0%, #070707 80%);">
            <div class="container">
                <div style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                    <?php if (!empty($specs['badge'])) : ?>
                        <span class="subtitle-gold" style="margin-bottom: 8px;"><?php echo esc_html($specs['badge']); ?></span>
                    <?php endif; ?>
                    
                    <h1 class="title-luxury" style="font-size: 3rem; margin-bottom: 12px;"><?php the_title(); ?></h1>
                    
                    <?php if (!empty($specs['tagline'])) : ?>
                        <p style="font-size: 1.125rem; color: var(--text-secondary); margin-bottom: 16px;"><?php echo esc_html($specs['tagline']); ?></p>
                    <?php endif; ?>

                    <div style="font-size: 1.75rem; color: var(--accent-gold); font-weight: 700; margin-bottom: 24px;">
                        <small style="font-size: 0.875rem; color: var(--text-muted); font-weight: normal;"><?php _e('Giá niêm yết từ: ', 'lexus-motors'); ?></small>
                        <?php echo lexus_format_price($specs['price']); ?>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                        <a href="#" class="btn-lexus btn-lexus-gold" data-open-modal="test-drive" data-car-model="<?php the_title_attribute(); ?>">
                            <?php _e('ĐĂNG KÝ LÁI THỬ XE', 'lexus-motors'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/#du-toan-chi-phi')); ?>" class="btn-lexus">
                            <?php _e('DỰ TOÁN CHI PHÍ LĂN BÁNH', 'lexus-motors'); ?>
                        </a>
                        <?php if (!empty($specs['brochure']) && $specs['brochure'] !== '#') : ?>
                            <a href="<?php echo esc_url($specs['brochure']); ?>" class="btn-lexus btn-lexus-outline-gold" target="_blank">
                                <?php _e('TẢI BROCHURE (PDF)', 'lexus-motors'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Interactive Color Showcase for this car -->
                <div class="car-display-stage" style="max-width: 960px; margin: 0 auto;">
                    <img id="single-car-preview" src="<?php echo esc_url($default_img); ?>" alt="<?php the_title_attribute(); ?>" class="car-display-img" style="max-width: 800px;">

                    <?php if (!empty($colors)) : ?>
                        <div class="color-controls" style="margin-top: 30px;">
                            <?php foreach ($colors as $index => $color) : ?>
                                <div class="color-circle <?php echo $index === 0 ? 'active' : ''; ?>" 
                                     style="background-color: <?php echo esc_attr($color['hex']); ?>;" 
                                     data-color-name="<?php echo esc_attr($color['name']); ?>" 
                                     data-image="<?php echo esc_url($color['image']); ?>" 
                                     data-target-img="#single-car-preview" 
                                     data-target-label="#single-car-color-name" 
                                     title="<?php echo esc_attr($color['name']); ?>"></div>
                            <?php endforeach; ?>
                        </div>

                        <div class="current-color-label" style="margin-top: 16px;">
                            <?php _e('Màu ngoại thất: ', 'lexus-motors'); ?>
                            <strong id="single-car-color-name" style="color: var(--accent-gold);"><?php echo esc_html($default_color_name); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Technical Specifications Table -->
        <section style="padding: 80px 0; background: var(--bg-surface);">
            <div class="container">
                <div class="section-header">
                    <span class="subtitle-gold"><?php _e('THÔNG SỐ KỸ THUẬT TIÊU CHUẨN', 'lexus-motors'); ?></span>
                    <h2 class="title-luxury" style="font-size: 2rem;"><?php _e('NĂNG LỰC VẬN HÀNH VƯỢT TRỘI', 'lexus-motors'); ?></h2>
                </div>

                <div style="max-width: 860px; margin: 0 auto; background: var(--bg-darkest); border: 1px solid var(--border-medium); border-radius: var(--radius-md); overflow: hidden;">
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Loại động cơ:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['engine'] ? $specs['engine'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Công suất cực đại:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['horsepower'] ? $specs['horsepower'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Mô-men xoắn cực đại:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['torque'] ? $specs['torque'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Thời gian tăng tốc 0 - 100 km/h:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['acceleration'] ? $specs['acceleration'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Hộp số:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['transmission'] ? $specs['transmission'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px;">
                        <span><?php _e('Mức tiêu thụ nhiên liệu kết hợp:', 'lexus-motors'); ?></span>
                        <strong><?php echo esc_html($specs['fuel'] ? $specs['fuel'] : 'Đang cập nhật'); ?></strong>
                    </div>
                    <div class="result-row" style="padding: 16px 24px; border-bottom: none;">
                        <span><?php _e('Hệ thống an toàn chủ động:', 'lexus-motors'); ?></span>
                        <strong style="color: var(--accent-gold);"><?php _e('Lexus Safety System+ 3.0 (PCS, DRCC, LTA, AHS)', 'lexus-motors'); ?></strong>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vehicle Detailed Story/Content -->
        <section style="padding: 80px 0; background: var(--bg-darkest);">
            <div class="container" style="max-width: 860px;">
                <div class="entry-content" style="color: var(--text-secondary); line-height: 1.9; font-size: 1.0625rem;">
                    <h2 class="title-luxury" style="font-size: 1.75rem; color: var(--text-primary); margin-bottom: 20px;">
                        <?php _e('Về dòng xe ', 'lexus-motors'); ?><?php the_title(); ?>
                    </h2>
                    <?php the_content(); ?>
                </div>

                <!-- Booking CTA Card -->
                <div style="background: var(--bg-surface-elevated); border: 1px solid var(--border-gold); border-radius: var(--radius-md); padding: 40px; margin-top: 60px; text-align: center;">
                    <span class="subtitle-gold"><?php _e('ƯU ĐÃI ĐẶC QUYỀN THÁNG NÀY', 'lexus-motors'); ?></span>
                    <h3 class="title-luxury" style="font-size: 1.75rem; margin-bottom: 16px;">
                        <?php _e('Sở Hữu ', 'lexus-motors'); ?><?php the_title(); ?> <?php _e('Hôm Nay', 'lexus-motors'); ?>
                    </h3>
                    <p style="color: var(--text-secondary); margin-bottom: 24px;">
                        <?php _e('Tặng gói bảo dưỡng 3 năm miễn phí, hỗ trợ thủ tục đăng ký xe tận nhà và giao xe bằng chuyên cơ mặt đất.', 'lexus-motors'); ?>
                    </p>
                    <a href="#" class="btn-lexus btn-lexus-gold" data-open-modal="test-drive" data-car-model="<?php the_title_attribute(); ?>">
                        <?php _e('LIÊN HỆ BÁO GIÁ & ĐẶT LỊCH LÁI THỬ', 'lexus-motors'); ?>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <?php
endwhile;

get_footer();

