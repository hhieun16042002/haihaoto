<?php
/**
 * Single Post Template for Blog Articles
 * Designed for Ô Tô Hải Hà with clean typography, responsive layout, and conversion CTA.
 *
 * @package HieuGara_Motors
 */

get_header();

while (have_posts()) : the_post();
    $post_id   = get_the_ID();
    $post_cats = get_the_category($post_id);
    $main_cat  = !empty($post_cats) ? $post_cats[0] : null;

    $custom_thumb = get_post_meta($post_id, '_custom_thumbnail_url', true);
    if (has_post_thumbnail($post_id)) {
        $thumb_url = get_the_post_thumbnail_url($post_id, 'full');
    } elseif (!empty($custom_thumb)) {
        $thumb_url = $custom_thumb;
    } else {
        $thumb_url = '';
    }
    if (function_exists('hieugara_normalize_local_media_urls') && !empty($thumb_url)) {
        $thumb_url = hieugara_normalize_local_media_urls($thumb_url);
    }

    $banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : (function_exists('hieugara_get_page_banner_url') ? hieugara_get_page_banner_url('blog') : '');
    if (empty($banner_bg)) {
        $banner_bg = get_template_directory_uri() . '/assets/images/banners/banner-blog.jpg';
    }

    $hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
    $hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

    // Related posts in same category
    $related_posts = array();
    if ($main_cat) {
        $related_posts = get_posts(array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'post__not_in'   => array($post_id),
            'category'       => $main_cat->term_id,
        ));
    }
?>

<style>
@media (max-width: 768px) {
    .single-post-page .portal-hero-header {
        padding: 42px 14px 36px !important;
    }
    .single-post-page .portal-breadcrumb {
        font-size: clamp(0.64rem, 2.7vw, 0.78rem) !important;
        letter-spacing: 0.4px !important;
        gap: 5px !important;
        margin-bottom: 12px !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        justify-content: center !important;
        line-height: 1.3 !important;
    }
    .single-post-page .portal-breadcrumb a,
    .single-post-page .portal-breadcrumb span,
    .single-post-page .portal-breadcrumb .current {
        white-space: nowrap !important;
        display: inline-block !important;
    }
    .single-post-page .portal-page-title {
        white-space: nowrap !important;
        font-size: clamp(0.95rem, 4.5vw, 1.45rem) !important;
        line-height: 1.25 !important;
        letter-spacing: -0.01em !important;
        margin: 0 auto !important;
    }
}
</style>

<div class="single-post-page">
    <!-- Universal Hero Banner for Blog Article -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
        <div class="container">
            <nav class="portal-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php _e('Cẩm nang &amp; Tin tức ô tô', 'hieugara-motors'); ?></a>
                <?php if ($main_cat) : ?>
                    <span class="sep">/</span>
                    <a href="<?php echo esc_url(get_category_link($main_cat->term_id)); ?>"><?php echo esc_html($main_cat->name); ?></a>
                <?php endif; ?>
            </nav>
            <h1 class="portal-page-title"><?php _e('CẨM NANG & KỸ THUẬT Ô TÔ', 'hieugara-motors'); ?></h1>
        </div>
    </section>

    <div class="single-post-wrapper" style="background: #F9FAFB; padding: 40px 0 80px; min-height: 80vh;">
        <div class="container">

            <div class="single-post-layout" style="display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 40px; align-items: start;">
            
            <!-- Main Content Column -->
            <div class="single-post-main-col" style="display: flex; flex-direction: column; gap: 28px;">
                <main class="single-post-main" style="background: #FFFFFF; border-radius: 16px; padding: 36px 40px; border: 1px solid #E5E7EB; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    
                    <!-- Article Header -->
                    <header class="single-article-header" style="margin-bottom: 28px; border-bottom: 1px solid #F3F4F6; padding-bottom: 24px;">
                        <?php if ($main_cat) : ?>
                            <a href="<?php echo esc_url(get_category_link($main_cat->term_id)); ?>" class="post-cat-badge" style="display: inline-block; background: #C5A880; color: #141414; font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 6px; text-decoration: none; margin-bottom: 14px; text-transform: uppercase;">
                                <?php echo esc_html($main_cat->name); ?>
                            </a>
                        <?php endif; ?>

                        <h1 class="single-post-title" style="font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: #141414; line-height: 1.35; margin-bottom: 16px;">
                            <?php the_title(); ?>
                        </h1>

                        <div class="single-post-meta-row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 20px; font-size: 0.875rem; color: #6B7280;">
                            <span><i class="fa-regular fa-calendar-check" style="color: #C5A880; margin-right: 6px;"></i> <?php echo get_the_date('d/m/Y'); ?></span>
                            <span><i class="fa-solid fa-user-gear" style="color: #C5A880; margin-right: 6px;"></i> Kỹ Sư Ô Tô Hải Hà</span>
                            <span><i class="fa-solid fa-award" style="color: #C5A880; margin-right: 6px;"></i> 31 Năm Kinh Nghiệm</span>
                        </div>
                    </header>

                    <?php if (!empty($thumb_url)) : ?>
                        <div class="single-post-featured-image" style="margin-bottom: 32px; border-radius: 12px; overflow: hidden; max-height: 480px; background: #111827;">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="width: 100%; height: auto; max-height: 480px; object-fit: cover; display: block;">
                        </div>
                    <?php endif; ?>

                    <!-- Article Body Content -->
                    <article class="single-post-content article-rich-content" style="font-size: 1.05rem; line-height: 1.8; color: #374151;">
                        <?php the_content(); ?>
                    </article>

                    <!-- Post Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                    ?>
                        <div class="post-tags-row" style="margin-top: 36px; padding-top: 20px; border-top: 1px solid #F3F4F6; display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                            <span style="font-weight: 600; color: #141414; font-size: 0.875rem;"><i class="fa-solid fa-tags" style="color: #C5A880;"></i> Từ khóa:</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" style="background: #F3F4F6; color: #4B5563; font-size: 0.8rem; padding: 4px 10px; border-radius: 6px; text-decoration: none; transition: background 0.2s;">
                                    #<?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </main>

                <!-- Garage CTA Box (Tách thành khối riêng nền trắng như ảnh mẫu) -->
                <div class="article-cta-box" style="background: #FFFFFF; border-radius: 16px; padding: 32px 36px; border: 1px solid #E5E7EB; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px;">
                    <div style="flex: 1 1 320px;">
                        <span style="background: #C5A880; color: #141414; font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Tư Vấn Kỹ Thuật Miễn Phí</span>
                        <h3 style="font-size: 1.3rem; font-weight: 800; color: #141414; margin: 10px 0 8px;">Cần tư vấn kỹ thuật hoặc bảo dưỡng xe?</h3>
                        <p style="color: #4B5563; font-size: 0.95rem; margin: 0; line-height: 1.6;">Kỹ thuật viên Ô Tô Hải Hà sẵn sàng kiểm tra, tư vấn chuẩn đoán và báo giá chi tiết minh bạch.</p>
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="tel:02203892207" style="background: #C5A880; color: #141414; font-weight: 700; padding: 12px 22px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; border: 1px solid #B89A74; box-shadow: 0 2px 8px rgba(197,168,128,0.35);">
                            <i class="fa-solid fa-phone-volume" style="color: #141414;"></i> Gọi Hotline: 02203 892 207
                        </a>
                        <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #FFFFFF; font-weight: 700; padding: 12px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 8px rgba(0,104,255,0.35); border: 1px solid #0056D2;">
                            <i class="fa-solid fa-comment-dots" style="color: #FFFFFF;"></i> Chat Zalo Tư Vấn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <aside class="single-post-sidebar" style="display: flex; flex-direction: column; gap: 24px;">

                <!-- Categories Widget -->
                <div class="sidebar-widget" style="background: #FFFFFF; border-radius: 14px; padding: 24px; border: 1px solid #E5E7EB;">
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #141414; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-folder-tree" style="color: #C5A880;"></i> Chuyên Mục Bài Viết
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                        <?php
                        $all_cats = get_categories(array('hide_empty' => false));
                        foreach ($all_cats as $cat_item) :
                        ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($cat_item->term_id)); ?>" style="display: flex; align-items: center; justify-content: space-between; color: #374151; text-decoration: none; font-size: 0.9rem; padding: 8px 12px; border-radius: 6px; background: #F9FAFB; transition: all 0.2s;">
                                    <span><i class="fa-solid fa-angle-right" style="color: #9CA3AF; margin-right: 8px; font-size: 0.75rem;"></i><?php echo esc_html($cat_item->name); ?></span>
                                    <span style="background: #E5E7EB; color: #6B7280; font-size: 0.75rem; font-weight: 700; padding: 2px 8px; border-radius: 9999px;"><?php echo esc_html($cat_item->count); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Related Posts Widget -->
                <?php if (!empty($related_posts)) : ?>
                    <div class="sidebar-widget" style="background: #FFFFFF; border-radius: 14px; padding: 24px; border: 1px solid #E5E7EB;">
                        <h3 style="font-size: 1.1rem; font-weight: 800; color: #141414; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-book-open-reader" style="color: #C5A880;"></i> Bài Viết Cùng Chuyên Mục
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 14px;">
                            <?php foreach ($related_posts as $r_post) : 
                                $r_thumb = '';
                                if (has_post_thumbnail($r_post->ID)) {
                                    $r_thumb = get_the_post_thumbnail_url($r_post->ID, 'medium');
                                    if (empty($r_thumb)) {
                                        $r_thumb = get_the_post_thumbnail_url($r_post->ID, 'full');
                                    }
                                }
                                if (empty($r_thumb)) {
                                    $custom = get_post_meta($r_post->ID, '_custom_thumbnail_url', true);
                                    if (!empty($custom)) {
                                        $r_thumb = $custom;
                                    }
                                }
                                if (empty($r_thumb)) {
                                    $r_thumb = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-3.jpg';
                                }
                                if (function_exists('hieugara_normalize_local_media_urls') && !empty($r_thumb)) {
                                    $r_thumb = hieugara_normalize_local_media_urls($r_thumb);
                                }
                            ?>
                                <a href="<?php echo esc_url(get_permalink($r_post->ID)); ?>" style="display: flex; gap: 12px; text-decoration: none; color: inherit; group">
                                    <?php if (!empty($r_thumb)) : ?>
                                        <div style="width: 72px; height: 54px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #111827;">
                                            <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php echo esc_attr(get_the_title($r_post->ID)); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>
                                    <div style="flex: 1;">
                                        <h4 style="font-size: 0.85rem; font-weight: 700; color: #141414; line-height: 1.35; margin: 0 0 4px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <?php echo esc_html(get_the_title($r_post->ID)); ?>
                                        </h4>
                                        <span style="font-size: 0.75rem; color: #9CA3AF;"><i class="fa-regular fa-clock"></i> <?php echo get_the_date('d/m/Y', $r_post->ID); ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </aside>

        </div>
    </div>
</div>
</div>

<style>
/* Rich article styling */
.article-rich-content h2 {
    font-size: 1.45rem;
    font-weight: 800;
    color: #141414;
    margin: 32px 0 16px;
    padding-bottom: 8px;
    border-bottom: 2px solid #FEF3C7;
}
.article-rich-content h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
    margin: 24px 0 12px;
}
.article-rich-content p {
    margin-bottom: 16px;
}
.article-rich-content ul, .article-rich-content ol {
    margin: 16px 0 20px 24px;
}
.article-rich-content li {
    margin-bottom: 8px;
}
.article-rich-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
    font-size: 0.95rem;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.article-rich-content th,
.article-rich-content table th,
.article-rich-content .table-styled th,
.article-rich-content .table-styled thead tr {
    background: #D4B996 !important;
    color: #141414 !important;
    padding: 12px 14px;
    text-align: left;
    font-weight: 800;
    font-size: 0.9rem;
    border: 1px solid #c4a782 !important;
}
.article-rich-content .table-styled th * {
    color: #141414 !important;
}
.article-rich-content td {
    padding: 12px 14px;
    border: 1px solid #E5E7EB;
    color: #374151;
}
.article-rich-content tr:nth-child(even) td {
    background: #F9FAFB;
}
.blog-cta-box,
.article-series-badge {
    display: none !important;
}
.article-rich-content figure {
    margin: 28px 0;
    text-align: center;
}
.article-rich-content img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
}
.article-rich-content figcaption {
    font-size: 0.85rem;
    color: #6B7280;
    margin-top: 8px;
    font-style: italic;
}
@media (max-width: 991px) {
    .single-post-layout {
        grid-template-columns: 1fr !important;
    }
    .single-post-main {
        padding: 24px 20px !important;
    }
}
</style>

<?php
endwhile;

get_footer();

