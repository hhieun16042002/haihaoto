<?php
/**
 * Template Name: Phụ Kiện Ô Tô Chính Hãng (Danh Mục Phụ Kiện Hải Hà)
 * Description: Grouped by parent category (max 4 per category + Xem tất cả). Mobile-first, responsive, 2-column e-commerce grid on phones.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = '0911 211 996';
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('phukien');

// Query parent accessory categories
$parent_cats = get_terms(array(
    'taxonomy'   => 'accessory_category',
    'parent'     => 0,
    'hide_empty' => false,
    'orderby'    => 'term_id',
    'order'      => 'ASC',
));

// Check each parent category for published child accessories (max 4 posts)
$categories_with_posts = array();
if (!empty($parent_cats) && !is_wp_error($parent_cats)) {
    foreach ($parent_cats as $pcat) {
        $posts_in_cat = get_posts(array(
            'post_type'      => 'garage_accessory',
            'posts_per_page' => 4, // Mỗi danh mục lớn hiển thị tối đa 4 bài đại diện
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'accessory_category',
                    'field'            => 'term_id',
                    'terms'            => $pcat->term_id,
                    'include_children' => true,
                ),
            ),
        ));

        if (!empty($posts_in_cat)) {
            $categories_with_posts[] = array(
                'term'        => $pcat,
                'accessories' => $posts_in_cat,
                'total'       => $pcat->count,
            );
        }
    }
}
?>

<!-- =========================================================================
     PAGE-SPECIFIC HIGH-PERFORMANCE RESPONSIVE STYLES
     ========================================================================= -->
<style>
/* Prevent horizontal overflow on entire mobile viewport */
html, body {
    overflow-x: hidden !important;
}

.page-phu-kien-portal {
    background: #F8FAFC;
    min-height: 60vh;
    padding: 30px 0 80px;
    overflow-x: hidden;
}

/* --- QUICK CATEGORY NAVIGATION PILLS --- */
.pk-quicknav-wrap {
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    position: sticky;
    top: 0;
    z-index: 40;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.pk-quicknav-scroll {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 0;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.pk-quicknav-scroll::-webkit-scrollbar {
    display: none;
}
.pk-nav-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
    border-radius: 999px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.82rem;
    font-weight: 700;
    white-space: nowrap;
    text-decoration: none;
    transition: all 0.2s ease;
    flex-shrink: 0;
}
.pk-nav-pill:hover,
.pk-nav-pill.is-active {
    background: #141414;
    color: #ffffff;
    border-color: #141414;
}
.pk-nav-pill .pk-nav-count {
    background: rgba(0, 0, 0, 0.08);
    color: inherit;
    font-size: 0.72rem;
    padding: 1px 6px;
    border-radius: 10px;
    font-weight: 800;
}
.pk-nav-pill:hover .pk-nav-count,
.pk-nav-pill.is-active .pk-nav-count {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}
.pk-nav-pill-vf {
    background: #FAF8F5;
    color: #8C6D3B;
    border-color: #E2DCD5;
}

/* --- MAIN CONTAINER & SECTIONS --- */
.pk-portal-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 16px;
    box-sizing: border-box;
}

.pk-categories-stack {
    display: flex;
    flex-direction: column;
    gap: 28px;
    margin-top: 24px;
}

.pk-cat-block {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 24px 28px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.03);
    scroll-margin-top: 60px;
}

/* --- CATEGORY HEADER --- */
.pk-cat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 14px;
    margin-bottom: 18px;
}
.pk-cat-header-left {
    min-width: 0;
    flex: 1;
}
.pk-cat-eyebrow {
    display: inline-block;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.7rem;
    font-weight: 800;
    color: #8C6239;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    margin-bottom: 2px;
}
.pk-cat-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 1.35rem;
    font-weight: 800;
    color: #141414;
    margin: 0;
    text-transform: uppercase;
    line-height: 1.3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.pk-cat-desc {
    font-size: 0.88rem;
    color: #64748b;
    margin: 4px 0 0;
    line-height: 1.5;
}
.pk-btn-viewall {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f8fafc;
    color: #141414;
    border: 1px solid #cbd5e1;
    padding: 8px 16px;
    border-radius: 20px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.82rem;
    font-weight: 700;
    text-decoration: none;
    text-transform: uppercase;
    white-space: nowrap;
    flex-shrink: 0;
    transition: all 0.2s ease;
}
.pk-btn-viewall:hover {
    background: #141414;
    color: #ffffff;
    border-color: #141414;
}

/* --- PRODUCT GRID (MOBILE 2-COL, DESKTOP 4-COL) --- */
.pk-product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

/* --- PRODUCT CARD --- */
.pk-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    text-decoration: none;
    color: inherit;
    position: relative;
}
.pk-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    border-color: #C5A880;
}

.pk-card-thumb-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    background: #f8fafc;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    box-sizing: border-box;
}
.pk-card-thumb-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.25s ease;
}
.pk-card:hover .pk-card-thumb-wrap img {
    transform: scale(1.04);
}

.pk-card-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    background: rgba(20, 20, 20, 0.85);
    color: #D4B996;
    border: 1px solid rgba(212, 185, 150, 0.4);
    font-size: 0.62rem;
    font-weight: 800;
    padding: 2px 6px;
    border-radius: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    z-index: 2;
}

.pk-card-body {
    padding: 12px 14px 14px;
    display: flex;
    flex-direction: column;
    flex: 1;
    background: #ffffff;
}

.pk-card-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 6px;
    text-transform: uppercase;
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.7em;
}
.pk-card:hover .pk-card-title {
    color: #8C6239;
}

.pk-card-excerpt {
    font-size: 0.8rem;
    color: #64748b;
    line-height: 1.45;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.pk-card-price-row {
    margin-top: auto;
    padding-top: 8px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.pk-card-price {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.82rem;
    font-weight: 800;
    color: #8C6239;
}
.pk-card-cta {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.78rem;
    font-weight: 700;
    color: #141414;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s ease;
}
.pk-card:hover .pk-card-cta {
    color: #8C6239;
}

/* Mobile bottom button for category */
.pk-cat-mobile-viewall {
    display: none;
    margin-top: 14px;
}
.pk-mobile-viewall-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 10px 14px;
    background: #f1f5f9;
    color: #141414;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.82rem;
    font-weight: 700;
    text-decoration: none;
    text-transform: uppercase;
}

/* --- CONSULTATION FOOTER BANNER --- */
.pk-consult-banner {
    margin-top: 40px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 30px 24px;
    text-align: center;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
}
.pk-consult-banner h3 {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: #141414;
    margin: 0 0 8px;
    text-transform: uppercase;
}
.pk-consult-banner p {
    font-size: 0.92rem;
    color: #64748b;
    max-width: 680px;
    margin: 0 auto 20px;
    line-height: 1.6;
}
.pk-consult-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}
.pk-btn-hotline {
    background: #141414;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.pk-btn-zalo {
    background: #0068FF;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* =========================================================================
   RESPONSIVE BREAKPOINTS (TABLET & MOBILE)
   ========================================================================= */
@media (max-width: 1024px) {
    .pk-product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
}

@media (max-width: 768px) {
    .page-phu-kien-portal {
        padding: 16px 0 60px;
    }
    .pk-portal-container {
        padding: 0 12px;
    }
    .pk-categories-stack {
        gap: 18px;
        margin-top: 14px;
    }
    .pk-cat-block {
        padding: 16px 12px 18px;
        border-radius: 10px;
    }
    .pk-cat-header {
        padding-bottom: 10px;
        margin-bottom: 12px;
    }
    .pk-cat-title {
        font-size: 1.15rem;
    }
    .pk-btn-viewall {
        padding: 6px 12px;
        font-size: 0.75rem;
    }
    .pk-card-body {
        padding: 10px;
    }
}

/* PHONE VIEWPORT (<= 640px): 2 COLUMNS COMPACT & PERFECT */
@media (max-width: 640px) {
    .pk-product-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
    }
    .pk-card-thumb-wrap {
        padding: 6px;
    }
    .pk-card-badge {
        font-size: 0.58rem;
        padding: 2px 4px;
        top: 6px;
        left: 6px;
    }
    .pk-card-body {
        padding: 8px 8px 10px;
    }
    .pk-card-title {
        font-size: 0.82rem;
        margin-bottom: 4px;
        height: 2.7em;
        line-height: 1.35;
    }
    .pk-card-excerpt {
        display: none !important; /* Hide excerpt on small phones for ultra-clean look */
    }
    .pk-card-price-row {
        padding-top: 6px;
    }
    .pk-card-price {
        font-size: 0.75rem;
    }
    .pk-card-cta span {
        display: none; /* Icon-only CTA on small cards */
    }
    .pk-card-cta i {
        font-size: 0.75rem;
    }
    .pk-btn-viewall {
        display: none; /* Hide header viewall button on phone, show bottom full-width button */
    }
    .pk-cat-mobile-viewall {
        display: block; /* Show convenient full-width tap target below the 4 cards */
    }
    .pk-consult-banner {
        padding: 22px 16px;
        margin-top: 24px;
    }
    .pk-consult-banner h3 {
        font-size: 1.1rem;
    }
    .pk-consult-actions {
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }
    .pk-btn-hotline,
    .pk-btn-zalo {
        width: 100%;
        justify-content: center;
        padding: 12px 16px;
        box-sizing: border-box;
    }
}

/* ULTRA SMALL PHONES (<= 375px e.g. iPhone SE) */
@media (max-width: 375px) {
    .pk-portal-container {
        padding: 0 8px;
    }
    .pk-cat-block {
        padding: 12px 8px 14px;
    }
    .pk-product-grid {
        gap: 8px !important;
    }
    .pk-card-title {
        font-size: 0.78rem;
    }
}
</style>

<!-- =========================================================================
     HERO BANNER
     ========================================================================= -->
<section class="phukien-hero-section" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container">
        <nav class="phukien-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php _e('Phụ Kiện Ô Tô', 'hieugara-motors'); ?></span>
        </nav>

        <div class="phukien-hero-content text-center">
            <h1 class="phukien-title" style="margin: 0 auto 10px;">
                <?php _e('HỆ THỐNG PHỤ KIỆN Ô TÔ CHÍNH HÃNG', 'hieugara-motors'); ?>
            </h1>
            <p class="phukien-subtitle" style="margin: 0 auto; color: rgba(255,255,255,0.85); font-size: 0.95rem;">
                <?php _e('Cung cấp &amp; lắp đặt phụ kiện, đồ chơi xe hơi chuẩn Zin 100% bảo hành uy tín tại Hải Dương', 'hieugara-motors'); ?>
            </p>
        </div>
    </div>
</section>

<!-- =========================================================================
     STICKY QUICK CATEGORY NAVIGATION (MOBILE & DESKTOP)
     ========================================================================= -->
<?php if (!empty($categories_with_posts)) : ?>
<nav class="pk-quicknav-wrap" aria-label="Điều hướng nhanh danh mục phụ kiện">
    <div class="pk-portal-container">
        <div class="pk-quicknav-scroll">
            <?php foreach ($categories_with_posts as $idx => $item) : 
                $cat_term = $item['term'];
            ?>
                <a href="#cat-<?php echo esc_attr($cat_term->slug); ?>" class="pk-nav-pill <?php echo $idx === 0 ? 'is-active' : ''; ?>">
                    <span><?php echo esc_html($cat_term->name); ?></span>
                    <span class="pk-nav-count"><?php echo esc_html($item['total']); ?></span>
                </a>
            <?php endforeach; ?>
            <a href="<?php echo esc_url(home_url('/phu-kien/phu-kien-vinfast/')); ?>" class="pk-nav-pill pk-nav-pill-vf">
                <i class="fa-solid fa-shield-halved" style="color: #C5A880;"></i>
                <span>Phụ Kiện VinFast</span>
            </a>
        </div>
    </div>
</nav>
<?php endif; ?>

<!-- =========================================================================
     MAIN CONTENT
     ========================================================================= -->
<main id="primary" class="site-main page-phu-kien-portal">
    <div class="pk-portal-container">

        <?php if (!empty($categories_with_posts)) : ?>
            <!-- STACK CÁC DANH MỤC LỚN (MỖI DANH MỤC ĐẠI DIỆN 4 SẢN PHẨM) -->
            <div class="pk-categories-stack">
                <?php foreach ($categories_with_posts as $item) : 
                    $cat_term        = $item['term'];
                    $cat_accessories = $item['accessories'];
                    $cat_link        = get_term_link($cat_term);
                    $is_vf_cat       = (strpos($cat_term->slug, 'vinfast') !== false);
                ?>
                    <section class="pk-cat-block" id="cat-<?php echo esc_attr($cat_term->slug); ?>">
                        
                        <!-- Header Danh mục -->
                        <div class="pk-cat-header">
                            <div class="pk-cat-header-left">
                                <span class="pk-cat-eyebrow">DANH MỤC PHỤ KIỆN</span>
                                <h2 class="pk-cat-title">
                                    <a href="<?php echo esc_url($cat_link); ?>" style="color: inherit; text-decoration: none;">
                                        <?php echo esc_html($cat_term->name); ?>
                                    </a>
                                </h2>
                                <?php if (!empty($cat_term->description)) : ?>
                                    <p class="pk-cat-desc">
                                        <?php echo esc_html($cat_term->description); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <!-- Nút Xem tất cả trên Desktop / Tablet -->
                            <a href="<?php echo esc_url($cat_link); ?>" class="pk-btn-viewall">
                                <span>Xem tất cả (<?php echo esc_html($item['total']); ?>)</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Lưới phụ kiện (2 cột trên Mobile, 4 cột trên Desktop) -->
                        <div class="pk-product-grid">
                            <?php foreach ($cat_accessories as $acc) : 
                                $a_id    = $acc->ID;
                                $a_link  = get_permalink($a_id);
                                $a_badge = $is_vf_cat ? 'VINFAST' : 'ZIN 100%';

                                if (has_post_thumbnail($a_id)) {
                                    $a_thumb = get_the_post_thumbnail_url($a_id, 'medium_large');
                                } else {
                                    $a_thumb = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-2.jpg';
                                }
                                if (function_exists('hieugara_normalize_local_media_urls')) {
                                    $a_thumb = hieugara_normalize_local_media_urls($a_thumb);
                                }
                            ?>
                                <a href="<?php echo esc_url($a_link); ?>" class="pk-card" title="<?php echo esc_attr($acc->post_title); ?>">
                                    <div class="pk-card-thumb-wrap">
                                        <span class="pk-card-badge"><?php echo esc_html($a_badge); ?></span>
                                        <img src="<?php echo esc_url($a_thumb); ?>" alt="<?php echo esc_attr($acc->post_title); ?>" loading="lazy">
                                    </div>

                                    <div class="pk-card-body">
                                        <h3 class="pk-card-title">
                                            <?php echo esc_html($acc->post_title); ?>
                                        </h3>

                                        <p class="pk-card-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt($a_id) ?: strip_tags($acc->post_content), 12, '...'); ?>
                                        </p>

                                        <div class="pk-card-price-row">
                                            <span class="pk-card-price">Liên hệ</span>
                                            <span class="pk-card-cta">
                                                <span>Chi tiết</span>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <!-- Nút xem tất cả tiện dụng cho màn hình Mobile (dưới 4 card) -->
                        <div class="pk-cat-mobile-viewall">
                            <a href="<?php echo esc_url($cat_link); ?>" class="pk-mobile-viewall-btn">
                                <span>Xem tất cả <?php echo esc_html($cat_term->name); ?> (<?php echo esc_html($item['total']); ?>)</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                    </section>
                <?php endforeach; ?>
            </div>

            <!-- Banner Tư Vấn Kỹ Thuật Cuối Trang -->
            <div class="pk-consult-banner">
                <h3>Tư Vấn &amp; Lắp Đặt Phụ Kiện Chuẩn Zin Theo Xe</h3>
                <p>
                    Ô Tô Hải Hà cung cấp và thi công phụ kiện, đồ chơi xe hơi chính hãng với quy trình kỹ thuật chuẩn xác, không cắt trích dây, bảo hành điện tử minh bạch.
                </p>
                <div class="pk-consult-actions">
                    <a href="tel:0911211996" class="pk-btn-hotline">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span>Hotline: 0911 211 996</span>
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="pk-btn-zalo">
                        <i class="fa-solid fa-comment-dots"></i>
                        <span>Nhắn Tin Zalo Tư Vấn</span>
                    </a>
                </div>
            </div>

        <?php else : ?>
            <!-- Khối thông báo khi chưa có dữ liệu phụ kiện -->
            <div style="max-width: 800px; margin: 40px auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 40px 24px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <p style="font-size: 1rem; color: #475569; line-height: 1.8; margin: 0 0 16px;">
                    Danh mục phụ kiện và bảng giá đang được đồng bộ chi tiết theo từng dòng xe. Quý khách vui lòng liên hệ hotline hoặc Zalo để được báo giá và hỗ trợ trực tiếp.
                </p>
                <div class="pk-consult-actions" style="margin-top: 20px;">
                    <a href="tel:0911211996" class="pk-btn-hotline">
                        <i class="fa-solid fa-phone-volume"></i> Hotline: 0911 211 996
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="pk-btn-zalo">
                        <i class="fa-solid fa-comment-dots"></i> Chat Zalo
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<!-- Smooth active nav pills on scroll -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var pills = document.querySelectorAll('.pk-nav-pill[href^="#"]');
    var sections = [];
    pills.forEach(function(pill) {
        var targetId = pill.getAttribute('href').substring(1);
        var sec = document.getElementById(targetId);
        if (sec) {
            sections.push({ el: sec, pill: pill });
        }
    });

    if (sections.length > 0) {
        window.addEventListener('scroll', function() {
            var scrollPos = window.scrollY + 120;
            sections.forEach(function(item) {
                var top = item.el.offsetTop;
                var height = item.el.offsetHeight;
                if (scrollPos >= top && scrollPos < top + height) {
                    pills.forEach(function(p) { p.classList.remove('is-active'); });
                    item.pill.classList.add('is-active');
                    // Scroll active pill into view smoothly inside nav scroll
                    var parent = item.pill.parentElement;
                    if (parent) {
                        var pillLeft = item.pill.offsetLeft;
                        var pillWidth = item.pill.offsetWidth;
                        var parentScroll = parent.scrollLeft;
                        var parentWidth = parent.offsetWidth;
                        if (pillLeft < parentScroll || (pillLeft + pillWidth) > (parentScroll + parentWidth)) {
                            parent.scrollTo({ left: pillLeft - 20, behavior: 'smooth' });
                        }
                    }
                }
            });
        }, { passive: true });
    }
});
</script>

<?php
get_footer();
