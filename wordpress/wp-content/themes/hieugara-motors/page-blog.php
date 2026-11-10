<?php
/**
 * Template Name: Blog Archive Page
 * Template for displaying all blog posts at /blog/
 *
 * @package HieuGara_Motors
 */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$blog_query = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC'
));

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('blog');
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

<main id="primary" class="site-main blog-archive-page" style="background: #F8FAFC; min-height: 80vh;">

    <!-- Page Breadcrumb & Header (Đức Trí 226 Style Hero Banner) -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
        <div class="container">
            <nav class="portal-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <span class="current"><?php _e('Cẩm nang &amp; Tin tức ô tô', 'hieugara-motors'); ?></span>
            </nav>
            <h1 class="portal-page-title"><?php _e('CẨM NANG & KỸ THUẬT Ô TÔ', 'hieugara-motors'); ?></h1>
        </div>
    </section>

    <div class="container" style="padding-top: 55px; padding-bottom: 85px; max-width: 1200px; margin: 0 auto; padding-left: 20px; padding-right: 20px;">

        <?php if ($blog_query->have_posts()) : ?>
            <div class="hp-blog-grid">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); 
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

            <!-- Pagination -->
            <?php if ($blog_query->max_num_pages > 1) : ?>
                <div class="pagination-wrapper" style="text-align: center; margin-top: 40px;">
                    <?php
                    echo paginate_links(array(
                        'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total'        => $blog_query->max_num_pages,
                        'current'      => max(1, get_query_var('paged')),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf('<i></i> %1$s', __('&laquo; Trước', 'hieugara-motors')),
                        'next_text'    => sprintf('%1$s <i></i>', __('Sau &raquo;', 'hieugara-motors')),
                    ));
                    ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <!-- THÔNG BÁO NHẸ NHÀNG, KHÔNG IN ĐẬM, KHÔNG NỔI BẬT GÌ CẢ -->
            <div class="empty-blog-hub" style="max-width: 860px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 40px 32px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 18px; font-weight: 400;">
                    Chuyên mục cẩm nang kinh nghiệm xe và tin tức kỹ thuật Ô Tô Hải Hà đang trong quá trình biên tập và cập nhật các bài viết chuyên môn mới nhất.
                </p>

                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 28px; font-weight: 400;">
                    Quý khách cần tìm hiểu quy trình bảo dưỡng, thông số kỹ thuật hoặc tư vấn chăm sóc xe hơi, vui lòng liên hệ trực tiếp với đội ngũ kỹ thuật viên trưởng Ô Tô Hải Hà để được hỗ trợ 24/7.
                </p>

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
