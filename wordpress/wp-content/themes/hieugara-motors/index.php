<?php
/**
 * Blog Archive / Fallback Template
 * Displays a luxury hero header banner and responsive post grid.
 *
 * @package HieuGara_Motors
 */

get_header();

$raw_title  = is_category() ? single_cat_title('', false) : (is_tag() ? single_tag_title('', false) : __('Cẩm Nang &amp; Kỹ Thuật Ô Tô', 'hieugara-motors'));
$page_title = html_entity_decode($raw_title, ENT_QUOTES, 'UTF-8');
$page_desc  = is_category() ? category_description() : __('Tổng hợp kiến thức sửa chữa, quy trình bảo dưỡng chuẩn hãng và thiết bị công nghệ hiện đại tại Ô Tô Hải Hà.', 'hieugara-motors');

$banner_bg  = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('blog');
?>

<style>
@media (max-width: 768px) {
    .blog-archive-page .portal-hero-header {
        padding: 42px 14px 36px !important;
    }
    .blog-archive-page .portal-breadcrumb {
        font-size: clamp(0.64rem, 2.7vw, 0.78rem) !important;
        letter-spacing: 0.4px !important;
        gap: 5px !important;
        margin-bottom: 12px !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        justify-content: center !important;
        line-height: 1.3 !important;
    }
    .blog-archive-page .portal-breadcrumb a,
    .blog-archive-page .portal-breadcrumb span,
    .blog-archive-page .portal-breadcrumb .current {
        white-space: nowrap !important;
        display: inline-block !important;
    }
    .blog-archive-page .portal-page-title {
        white-space: nowrap !important;
        font-size: clamp(0.95rem, 4.5vw, 1.45rem) !important;
        line-height: 1.25 !important;
        letter-spacing: -0.01em !important;
        margin: 0 auto !important;
    }
}
</style>

<!-- Category / Archive Hero Header Banner (Đức Trí 226 Style) -->
<section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php _e('Cẩm nang &amp; Tin tức ô tô', 'hieugara-motors'); ?></a>
            <?php if (is_category() || is_tag()) : ?>
                <span class="sep">/</span>
                <span class="current"><?php echo esc_html($page_title); ?></span>
            <?php endif; ?>
        </nav>
        <h1 class="portal-page-title" style="margin-bottom: 0; text-transform: uppercase;">
            <?php echo esc_html(mb_strtoupper($page_title, 'UTF-8')); ?>
        </h1>
    </div>
</section>

<main id="primary" class="site-main blog-archive-page" style="background: #F8FAFC; min-height: 80vh;">
    <div class="container" style="padding-top: 55px; padding-bottom: 85px; max-width: 1200px; margin: 0 auto; padding-left: 20px; padding-right: 20px;">

        <?php if (have_posts()) : ?>
            <div class="hp-blog-grid">
                <?php while (have_posts()) : the_post(); 
                    $pid = get_the_ID();
                    $custom_thumb = get_post_meta($pid, '_custom_thumbnail_url', true);
                    if (has_post_thumbnail($pid)) {
                        $thumb_url = get_the_post_thumbnail_url($pid, 'large');
                    } elseif (!empty($custom_thumb)) {
                        $thumb_url = $custom_thumb;
                    } else {
                        $thumb_url = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-3.jpg';
                    }
                    if (function_exists('hieugara_normalize_local_media_urls')) {
                        $thumb_url = hieugara_normalize_local_media_urls($thumb_url);
                    }
                    $post_cats = get_the_category($pid);
                    $cat_name = !empty($post_cats) ? $post_cats[0]->name : 'Kỹ thuật ô tô';
                    $post_date = get_the_date('d/m/Y', $pid);
                ?>
                    <article class="hp-blog-card">
                        <a href="<?php the_permalink(); ?>" class="hp-blog-thumb" title="<?php echo esc_attr(get_the_title()); ?>">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                            <span class="hp-blog-card-cat"><i class="fa-solid fa-tag"></i> <?php echo esc_html($cat_name); ?></span>
                        </a>
                        <div class="hp-blog-body">
                            <div class="hp-blog-meta">
                                <span><i class="fa-regular fa-calendar-check"></i> <?php echo esc_html($post_date); ?></span>
                                <span><i class="fa-solid fa-user-gear"></i> Kỹ Sư Hải Hà</span>
                            </div>
                            <h2 class="hp-blog-title" style="font-size: 1.15rem;">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="hp-blog-excerpt">
                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24, '...')); ?>
                            </p>
                            <div class="hp-blog-footer">
                                <a href="<?php the_permalink(); ?>" class="hp-blog-readmore">
                                    <?php _e('Đọc chi tiết', 'hieugara-motors'); ?> <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 48px;" class="text-center">
                <?php the_posts_navigation(); ?>
            </div>

        <?php else : ?>
            <div class="text-center" style="background: #FFFFFF; border-radius: 16px; padding: 60px 24px; border: 1px solid #E5E7EB; max-width: 640px; margin: 0 auto; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="width: 72px; height: 72px; background: #F5EBE1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: #7A5C34;">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <h2 style="font-size: 1.4rem; color: #141414; font-weight: 700; margin-bottom: 10px;">
                    <?php _e('Chuyên mục đang được cập nhật', 'hieugara-motors'); ?>
                </h2>
                <p style="color: #6B7280; margin-bottom: 24px; line-height: 1.6;">
                    <?php _e('Kỹ thuật viên Ô Tô Hải Hà đang chuẩn bị nội dung chuyên môn cho chuyên mục này. Quý khách vui lòng tham khảo các bài viết khác hoặc liên hệ hotline để được tư vấn trực tiếp.', 'hieugara-motors'); ?>
                </p>
                <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-gara" style="background: #D4B996; color: #141414; font-weight: 700; padding: 10px 24px; border-radius: 8px; text-decoration: none;">
                        <?php _e('Xem Tất Cả Bài Viết', 'hieugara-motors'); ?>
                    </a>
                    <a href="tel:02203892207" class="btn-gara" style="background: #141414; color: #FFFFFF; font-weight: 700; padding: 10px 24px; border-radius: 8px; text-decoration: none;">
                        <i class="fa-solid fa-phone"></i> <?php _e('Gọi Tư Vấn Kỹ Thuật', 'hieugara-motors'); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
