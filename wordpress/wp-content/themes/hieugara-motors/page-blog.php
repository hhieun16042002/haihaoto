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
?>

<main id="primary" class="site-main blog-archive-page" style="padding: 40px 0 80px; background: #F9FAFB; min-height: 80vh;">
    <div class="container">
        
        <!-- Breadcrumb -->
        <nav class="blog-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: 24px; font-size: 0.875rem; color: #6B7280;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #6B7280; text-decoration: none;"><i class="fa-solid fa-house"></i> Trang chủ</a>
            <span style="margin: 0 8px; color: #D1D5DB;">/</span>
            <span style="color: #141414; font-weight: 600;">Blog</span>
        </nav>

        <!-- Archive Header -->
        <div class="blog-sec-head text-center" style="margin-bottom: 36px;">
            <span class="blog-badge-tag"><i class="fa-solid fa-newspaper"></i> <?php _e('CẨM NANG &amp; KỸ THUẬT Ô TÔ', 'hieugara-motors'); ?></span>
            <h1 class="blog-heading-main" style="margin-bottom: 12px;">
                <span><?php _e('Cẩm Nang &amp; Kỹ Thuật Ô Tô', 'hieugara-motors'); ?></span>
            </h1>
            <div class="tuning-shop-divider"></div>
            <p class="blog-sec-sub" style="margin-bottom: 24px;">
                <?php _e('Tổng hợp kiến thức sửa chữa, quy trình bảo dưỡng chuẩn hãng và thiết bị công nghệ hiện đại tại Ô Tô Hải Hà.', 'hieugara-motors'); ?>
            </p>

            <!-- Category Pills -->
            <div class="blog-cat-pills">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="acc-pill-btn active">
                    <i class="fa-solid fa-border-all"></i> <?php _e('Tất Cả Bài Viết', 'hieugara-motors'); ?> (<?php echo esc_html($blog_query->found_posts); ?>)
                </a>
                <?php 
                $archive_cats = get_categories(array('hide_empty' => false));
                foreach ($archive_cats as $a_cat) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($a_cat->term_id)); ?>" class="acc-pill-btn">
                        <i class="fa-solid fa-folder-open"></i> <?php echo esc_html($a_cat->name); ?> (<?php echo esc_html($a_cat->count); ?>)
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

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
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <!-- Pagination -->
            <div style="margin-top: 48px;" class="text-center">
                <?php
                echo paginate_links(array(
                    'total'        => $blog_query->max_num_pages,
                    'current'      => $paged,
                    'prev_text'    => '<i class="fa-solid fa-chevron-left"></i> Trước',
                    'next_text'    => 'Sau <i class="fa-solid fa-chevron-right"></i>',
                    'type'         => 'plain',
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="text-center" style="background: #FFFFFF; border-radius: 16px; padding: 60px 24px; border: 1px solid #E5E7EB; max-width: 640px; margin: 0 auto;">
                <div style="width: 72px; height: 72px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: #D97706;">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <h2 style="font-size: 1.4rem; color: #141414; font-weight: 700; margin-bottom: 10px;">
                    <?php _e('Chưa có bài viết', 'hieugara-motors'); ?>
                </h2>
                <p style="color: #6B7280; margin-bottom: 24px; line-height: 1.6;">
                    <?php _e('Bài viết đang được cập nhật.', 'hieugara-motors'); ?>
                </p>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();

