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
    <!-- Hero Header (#141414 Dominant + #F5A300 Accent) -->
    <section class="portal-hero-header seo-search-hero">
        <div class="container">
            <nav class="seo-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
                <span class="sep">/</span>
                <span aria-current="page">Tìm kiếm</span>
            </nav>
            <h1 class="portal-hero-title">
                <?php if ($search_query !== '') : ?>
                    KẾT QUẢ TÌM KIẾM: <span class="search-kw-highlight">“<?php echo esc_html($search_query); ?>”</span>
                <?php else : ?>
                    TRA CỨU DỊCH VỤ &amp; PHỤ TÙNG Ô TÔ
                <?php endif; ?>
            </h1>
            <p class="portal-hero-lead">
                Tìm thấy <strong><?php echo esc_html($total_results); ?></strong> kết quả phù hợp trong hệ thống dịch vụ kỹ thuật, phụ tùng &amp; cẩm nang Ôtô Hải Hà.
            </p>

            <!-- Refined Search Box & Popular Tags -->
            <form class="seo-page-search-box" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" name="s" value="<?php echo esc_attr($search_query); ?>" placeholder="Nhập tên dịch vụ, hạng mục bảo dưỡng, phụ tùng cần tìm..." aria-label="Từ khóa tìm kiếm">
                <button type="submit" class="seo-search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>TÌM KIẾM</span>
                </button>
            </form>

            <div class="seo-popular-keywords">
                <span>Gợi ý nhanh:</span>
                <a href="<?php echo esc_url(home_url('/?s=Bảo+dưỡng+định+kỳ')); ?>">Bảo dưỡng định kỳ</a>
                <a href="<?php echo esc_url(home_url('/?s=Đồng+sơn+ô+tô')); ?>">Đồng sơn phòng sấy</a>
                <a href="<?php echo esc_url(home_url('/?s=Sửa+chữa+hộp+số')); ?>">Sửa chữa hộp số</a>
                <a href="<?php echo esc_url(home_url('/?s=Điều+hòa+ô+tô')); ?>">Điện &amp; điều hòa</a>
                <a href="<?php echo esc_url(home_url('/?s=Phủ+Ceramic')); ?>">Phủ Ceramic 9H</a>
                <a href="<?php echo esc_url(home_url('/?s=Cứu+hộ+24/7')); ?>">Cứu hộ 24/7</a>
            </div>
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
                        }
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('seo-result-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="seo-result-thumb">
                                    <?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?>
                                    <span class="seo-result-badge"><?php echo esc_html($badge_label); ?></span>
                                </a>
                            <?php else : ?>
                                <div class="seo-result-top-meta">
                                    <span class="seo-result-badge"><?php echo esc_html($badge_label); ?></span>
                                </div>
                            <?php endif; ?>

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
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Trước',
                        'next_text' => 'Tiếp <i class="fa-solid fa-chevron-right"></i>',
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
                        <a href="tel:02203892207" class="seo-btn-amber" style="background: #D4B996; color: #141414;">GỌI TƯ VẤN: 02203 892 207</a>
                        <a href="tel:<?php echo esc_attr($rescue_clean); ?>" class="seo-btn-rescue">CỨU HỘ 24/7: <?php echo esc_html($rescue_phone); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

