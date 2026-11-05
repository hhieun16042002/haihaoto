<?php
/**
 * Main Template File (Fallback)
 *
 * @package Lexus_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 140px 0 80px; min-height: 80vh;">
    <div class="container">
        <?php if (have_posts()) : ?>
            <header class="page-header" style="margin-bottom: 40px;">
                <h1 class="title-luxury" style="font-size: 2.5rem;"><?php single_post_title(); ?></h1>
            </header>

            <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px;">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('car-card'); ?> style="padding: 24px;">
                        <h2 style="font-size: 1.25rem; margin-bottom: 12px;">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: var(--text-secondary); margin-bottom: 16px;">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-lexus" style="align-self: flex-start; padding: 8px 16px; font-size: 0.75rem;">
                            <?php _e('Đọc tiếp →', 'lexus-motors'); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <div style="text-align: center; padding: 60px 0;">
                <h2 class="title-luxury"><?php _e('Không tìm thấy nội dung', 'lexus-motors'); ?></h2>
                <p style="color: var(--text-secondary); margin-top: 12px;"><?php _e('Vui lòng thử lại với từ khóa khác hoặc quay về trang chủ.', 'lexus-motors'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-lexus btn-lexus-gold" style="margin-top: 24px;">
                    <?php _e('Về Trang Chủ', 'lexus-motors'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

