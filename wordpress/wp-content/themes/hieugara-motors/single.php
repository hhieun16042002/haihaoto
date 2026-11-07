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

<div class="single-post-wrapper" style="background: #F9FAFB; padding: 40px 0 80px; min-height: 80vh;">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="single-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: 24px; font-size: 0.875rem; color: #6B7280;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #6B7280; text-decoration: none;"><i class="fa-solid fa-house"></i> Trang chủ</a>
            <span style="margin: 0 8px; color: #D1D5DB;">/</span>
            <a href="<?php echo esc_url(home_url('/blog/')); ?>" style="color: #6B7280; text-decoration: none;">Blog</a>
            <?php if ($main_cat) : ?>
                <span style="margin: 0 8px; color: #D1D5DB;">/</span>
                <a href="<?php echo esc_url(get_category_link($main_cat->term_id)); ?>" style="color: #6B7280; text-decoration: none;"><?php echo esc_html($main_cat->name); ?></a>
            <?php endif; ?>
            <span style="margin: 0 8px; color: #D1D5DB;">/</span>
            <span style="color: #141414; font-weight: 600;"><?php the_title(); ?></span>
        </nav>

        <div class="single-post-layout" style="display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 40px; align-items: start;">
            
            <!-- Main Content Column -->
            <main class="single-post-main" style="background: #FFFFFF; border-radius: 16px; padding: 36px 40px; border: 1px solid #E5E7EB; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                
                <!-- Article Header -->
                <header class="single-article-header" style="margin-bottom: 28px; border-bottom: 1px solid #F3F4F6; padding-bottom: 24px;">
                    <?php if ($main_cat) : ?>
                        <a href="<?php echo esc_url(get_category_link($main_cat->term_id)); ?>" class="post-cat-badge" style="display: inline-block; background: #FEF3C7; color: #92400E; font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 6px; text-decoration: none; margin-bottom: 14px; text-transform: uppercase;">
                            <i class="fa-solid fa-folder-open"></i> <?php echo esc_html($main_cat->name); ?>
                        </a>
                    <?php endif; ?>

                    <h1 class="single-post-title" style="font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: #141414; line-height: 1.35; margin-bottom: 16px;">
                        <?php the_title(); ?>
                    </h1>

                    <div class="single-post-meta-row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 20px; font-size: 0.875rem; color: #6B7280;">
                        <span><i class="fa-regular fa-calendar-check" style="color: #D97706; margin-right: 6px;"></i> <?php echo get_the_date('d/m/Y'); ?></span>
                        <span><i class="fa-solid fa-user-gear" style="color: #D97706; margin-right: 6px;"></i> Kỹ Sư Ô Tô Hải Hà</span>
                        <span><i class="fa-solid fa-award" style="color: #D97706; margin-right: 6px;"></i> 31 Năm Kinh Nghiệm</span>
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
                        <span style="font-weight: 600; color: #141414; font-size: 0.875rem;"><i class="fa-solid fa-tags" style="color: #D97706;"></i> Từ khóa:</span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" style="background: #F3F4F6; color: #4B5563; font-size: 0.8rem; padding: 4px 10px; border-radius: 6px; text-decoration: none; transition: background 0.2s;">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Garage CTA Box -->
                <div class="article-cta-box" style="margin-top: 40px; background: linear-gradient(135deg, #141414 0%, #1f2937 100%); border-radius: 14px; padding: 30px 32px; color: #FFFFFF; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px;">
                    <div style="flex: 1 1 320px;">
                        <span style="background: #FEF3C7; color: #92400E; font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 4px; text-transform: uppercase;">Tư Vấn Miễn Phí</span>
                        <h3 style="font-size: 1.3rem; font-weight: 800; color: #FFFFFF; margin: 10px 0 8px;">Cần tư vấn kỹ thuật hoặc bảo dưỡng xe?</h3>
                        <p style="color: #D1D5DB; font-size: 0.92rem; margin: 0; line-height: 1.5;">Kỹ thuật viên Ô Tô Hải Hà sẵn sàng kiểm tra, tư vấn chuẩn đoán và báo giá chi tiết minh bạch.</p>
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode(get_the_title()))); ?>" style="background: #FFB81C; color: #141414; font-weight: 700; padding: 12px 22px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-calendar-check"></i> Đặt Lịch Ngay
                        </a>
                        <a href="tel:<?php echo esc_attr($hotline_clean); ?>" style="background: transparent; color: #FFFFFF; border: 1.5px solid rgba(255,255,255,0.4); font-weight: 600; padding: 12px 18px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-phone"></i> Gọi <?php echo esc_html($hotline_phone); ?>
                        </a>
                    </div>
                </div>

            </main>

            <!-- Sidebar Column -->
            <aside class="single-post-sidebar" style="display: flex; flex-direction: column; gap: 24px;">

                <!-- Booking Widget -->
                <div class="sidebar-widget" style="background: #FFFFFF; border-radius: 14px; padding: 24px; border: 1px solid #E5E7EB; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #141414; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-calendar-days" style="color: #D97706;"></i> Đặt Hẹn Xưởng Hải Hà
                    </h3>
                    <p style="font-size: 0.875rem; color: #6B7280; line-height: 1.5; margin-bottom: 16px;">
                        Đặt lịch trước để được tiếp nhận nhanh chóng, không phải chờ đợi.
                    </p>
                    <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" style="display: block; text-align: center; background: #FFB81C; color: #141414; font-weight: 700; padding: 11px 16px; border-radius: 8px; text-decoration: none; transition: background 0.2s;">
                        <i class="fa-solid fa-calendar-plus"></i> Đặt Lịch Dịch Vụ
                    </a>
                </div>

                <!-- Hotline 24/7 Widget -->
                <div class="sidebar-widget" style="background: #FFFFFF; border-radius: 14px; padding: 24px; border: 1px solid #E5E7EB;">
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #141414; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-phone-volume" style="color: #DC2626;"></i> Hotline Cứu Hộ &amp; Kỹ Thuật
                    </h3>
                    <p style="font-size: 0.85rem; color: #6B7280; margin-bottom: 14px;">Trực tổng đài 24/7 cứu hộ khẩn cấp &amp; tư vấn kỹ thuật:</p>
                    <a href="tel:<?php echo esc_attr($hotline_clean); ?>" style="display: flex; align-items: center; justify-content: center; gap: 10px; background: #FEF2F2; color: #DC2626; font-weight: 800; font-size: 1.15rem; padding: 12px 16px; border-radius: 8px; text-decoration: none; border: 1px solid #FECACA;">
                        <i class="fa-solid fa-headset"></i> <?php echo esc_html($hotline_phone); ?>
                    </a>
                </div>

                <!-- Categories Widget -->
                <div class="sidebar-widget" style="background: #FFFFFF; border-radius: 14px; padding: 24px; border: 1px solid #E5E7EB;">
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #141414; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-folder-tree" style="color: #D97706;"></i> Chuyên Mục Bài Viết
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
                            <i class="fa-solid fa-book-open-reader" style="color: #D97706;"></i> Bài Viết Cùng Chuyên Mục
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 14px;">
                            <?php foreach ($related_posts as $r_post) : 
                                $r_thumb = get_post_meta($r_post->ID, '_custom_thumbnail_url', true);
                                if (has_post_thumbnail($r_post->ID)) {
                                    $r_thumb = get_the_post_thumbnail_url($r_post->ID, 'medium');
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
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.article-rich-content th {
    background: #141414;
    color: #FFFFFF;
    padding: 12px 14px;
    text-align: left;
    font-weight: 700;
    font-size: 0.9rem;
}
.article-rich-content td {
    padding: 12px 14px;
    border-bottom: 1px solid #E5E7EB;
    color: #374151;
}
.article-rich-content tr:nth-child(even) {
    background: #F9FAFB;
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

