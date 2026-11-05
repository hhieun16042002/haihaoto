<?php
/**
 * Main Template File (Fallback)
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: var(--bg-light); min-height: 80vh;">
    <div class="container">
        
        <?php if (have_posts()) : ?>
            <header class="section-header">
                <h1 class="section-title"><?php single_post_title(); ?></h1>
            </header>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('service-card'); ?> style="padding: 24px;">
                        <h2 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--navy-dark);">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: var(--text-secondary); margin-bottom: 20px; font-size: 0.9375rem;">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-gara btn-gara-outline-red" style="padding: 8px 16px; font-size: 0.75rem; align-self: flex-start;">
                            <?php _e('Đọc tiếp →', 'hieugara-motors'); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <div style="text-align: center; padding: 60px 0;">
                <h2 style="font-size: 1.75rem; color: var(--navy-dark);"><?php _e('Không tìm thấy nội dung', 'hieugara-motors'); ?></h2>
                <p style="color: var(--text-secondary); margin-top: 12px;"><?php _e('Vui lòng thử lại với từ khóa khác hoặc quay về trang chủ.', 'hieugara-motors'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-gara btn-gara-red" style="margin-top: 24px;">
                    <?php _e('Về Trang Chủ', 'hieugara-motors'); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();

