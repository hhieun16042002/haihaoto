<?php
/**
 * SEO-Optimized Search Results Template
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$search_query = trim(get_search_query());
global $wp_query;
$total_results = isset($wp_query->found_posts) ? intval($wp_query->found_posts) : 0;
$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$banner_bg     = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('services');
if (empty($banner_bg)) {
    $banner_bg = function_exists('hieugara_get_page_banner_url') ? hieugara_get_page_banner_url('services') : '';
}
?>

<!-- Schema.org BreadcrumbList & SearchResultsPage for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SearchResultsPage",
  "name": <?php echo wp_json_encode('Kết quả tìm kiếm cho: ' . $search_query . ' - Ôtô Hải Hà'); ?>,
  "url": <?php echo wp_json_encode(get_search_link($search_query)); ?>,
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Trang chủ",
        "item": <?php echo wp_json_encode(home_url('/')); ?>
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": <?php echo wp_json_encode('Tìm kiếm: ' . $search_query); ?>,
        "item": <?php echo wp_json_encode(get_search_link($search_query)); ?>
      }
    ]
  }
}
</script>

<main class="site-main seo-search-results-page">
    <!-- Hero Banner (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay) -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
        <div class="container" style="max-width: 1400px;">
            <nav class="portal-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <span class="current"><?php _e('Tìm kiếm', 'hieugara-motors'); ?></span>
            </nav>
            <h1 class="portal-page-title" style="margin: 0 auto;">
                <?php if ($search_query !== '') : ?>
                    <?php echo esc_html(sprintf(__('KẾT QUẢ TÌM KIẾM: “%s”', 'hieugara-motors'), $search_query)); ?>
                <?php else : ?>
                    <?php _e('KẾT QUẢ TÌM KIẾM', 'hieugara-motors'); ?>
                <?php endif; ?>
            </h1>
        </div>
    </section>

    <section class="seo-search-body">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="seo-results-grid">
                    <?php while (have_posts()) : the_post();
                        $pt = get_post_type();
                        $badge_label = 'THÔNG TIN';
                        if ($pt === 'garage_service') {
                            $badge_label = 'DỊCH VỤ KỸ THUẬT';
                        } elseif ($pt === 'post') {
                            $badge_label = 'CẨM NANG Ô TÔ';
                        } elseif ($pt === 'garage_accessory') {
                            $badge_label = 'PHỤ KIỆN XE';
                        }

                        // Determine thumbnail with reliable fallbacks so cards never lose their image
                        $card_thumb_html = '';
                        if (has_post_thumbnail()) {
                            $card_thumb_html = get_the_post_thumbnail(get_the_ID(), 'medium_large', array('loading' => 'lazy', 'alt' => get_the_title()));
                        } else {
                            $post_content = get_the_content();
                            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $post_content, $img_match)) {
                                $card_thumb_html = '<img src="' . esc_url($img_match[1]) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy">';
                            } elseif (function_exists('hieugara_get_current_page_banner')) {
                                $banner_fallback = hieugara_get_current_page_banner();
                                if ($banner_fallback) {
                                    $card_thumb_html = '<img src="' . esc_url($banner_fallback) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy">';
                                }
                            }
                            if (empty($card_thumb_html)) {
                                $default_img = get_template_directory_uri() . '/assets/images/banners/banner-ve-chung-toi.jpg';
                                $card_thumb_html = '<img src="' . esc_url($default_img) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy">';
                            }
                        }
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('seo-result-card'); ?>>
                            <a href="<?php the_permalink(); ?>" class="seo-result-thumb">
                                <?php echo $card_thumb_html; ?>
                                <span class="seo-result-badge"><?php echo esc_html($badge_label); ?></span>
                            </a>

                            <div class="seo-result-content">
                                <h2 class="seo-result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="seo-result-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 26, '...'); ?>
                                </p>
                                <div class="seo-result-footer">
                                    <a href="<?php the_permalink(); ?>" class="seo-result-link">
                                        <span>Xem chi tiết</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="seo-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'           => 2,
                        'prev_text'          => '<i class="fa-solid fa-chevron-left"></i> Trước',
                        'next_text'          => 'Tiếp <i class="fa-solid fa-chevron-right"></i>',
                        'screen_reader_text' => __('Phân trang', 'hieugara-motors'),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <div class="seo-empty-results">
                    <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <h2>Chưa tìm thấy kết quả khớp hoàn toàn với “<?php echo esc_html($search_query); ?>”</h2>
                    <p>Quý khách có thể tham khảo trực tiếp 6 nhóm dịch vụ mũi nhọn của Ôtô Hải Hà dưới đây hoặc liên hệ kỹ thuật viên để được tư vấn ngay:</p>
                    <div class="seo-fallback-pillars">
                        <a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-o-to/')); ?>">01. Bảo dưỡng ô tô định kỳ</a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/sua-chua-o-to/')); ?>">02. Sửa chữa máy, gầm &amp; hộp số</a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/dien-o-to-dieu-hoa/')); ?>">03. Điện, chẩn đoán ECU &amp; điều hòa</a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/dong-son-o-to/')); ?>">04. Đồng sơn phòng sấy &amp; thân vỏ</a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/cham-soc-nang-cap-o-to/')); ?>">05. Chăm sóc Detailing &amp; phụ kiện</a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-ho-tro-o-to/')); ?>">06. Cứu hộ giao thông 24/7</a>
                    </div>
                    <div class="seo-empty-actions">
                        <a href="tel:0911211996" class="seo-btn-amber" style="background: #D4B996; color: #141414;">GỌI TƯ VẤN: 0911 211 996</a>
                        <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="seo-btn-rescue">CỨU HỘ 24/7: <?php echo esc_html($rescue_phone); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
/* =========================================================================
   LUXURY SEARCH PAGINATION STYLING (MATCHING WORKSHOP DESIGN)
   ========================================================================= */
.seo-pagination {
    margin: 48px 0 24px;
    padding-top: 32px;
    border-top: 1px solid #e2e8f0;
    width: 100%;
    clear: both;
    display: flex;
    justify-content: center;
    align-items: center;
}

.seo-pagination .navigation.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.seo-pagination .screen-reader-text {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

.seo-pagination .nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0 auto;
}

.seo-pagination .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 14px;
    background: #ffffff;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    box-sizing: border-box;
    cursor: pointer;
}

.seo-pagination a.page-numbers:hover {
    background: #141414;
    color: #D4B996;
    border-color: #141414;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(20, 20, 20, 0.15);
}

/* Active / Current Page Number */
.seo-pagination .page-numbers.current {
    background: #141414 !important;
    color: #ffffff !important;
    border-color: #141414 !important;
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(20, 20, 20, 0.2);
    cursor: default;
    pointer-events: none;
}

/* Previous / Next buttons */
.seo-pagination a.page-numbers.prev,
.seo-pagination a.page-numbers.next {
    padding: 0 18px;
    gap: 8px;
    font-size: 0.88rem;
    font-weight: 700;
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #0f172a;
}

.seo-pagination a.page-numbers.prev:hover,
.seo-pagination a.page-numbers.next:hover {
    background: #141414;
    color: #ffffff;
    border-color: #141414;
}

/* Dots ellipsis */
.seo-pagination .page-numbers.dots {
    border: none;
    background: transparent;
    box-shadow: none;
    min-width: 28px;
    color: #94a3b8;
    cursor: default;
    padding: 0;
}

/* Mobile Responsive Breakpoint */
@media (max-width: 640px) {
    .seo-pagination {
        margin: 32px 0 16px;
        padding-top: 20px;
    }
    .seo-pagination .nav-links {
        gap: 6px;
    }
    .seo-pagination .page-numbers {
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        font-size: 0.82rem;
        border-radius: 6px;
    }
    .seo-pagination a.page-numbers.prev,
    .seo-pagination a.page-numbers.next {
        padding: 0 12px;
        font-size: 0.78rem;
        gap: 6px;
    }
}
</style>

<?php get_footer(); ?>

