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

// Check each parent category for published child accessories (max 3 posts per category row)
$categories_with_posts = array();
if (!empty($parent_cats) && !is_wp_error($parent_cats)) {
    foreach ($parent_cats as $pcat) {
        $posts_in_cat = get_posts(array(
            'post_type'      => 'garage_accessory',
            'posts_per_page' => 3, // Mỗi danh mục lớn hiển thị tối đa 3 bài đại diện (1 hàng 3 sản phẩm)
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
/* Prevent horizontal overflow on mobile viewports */
@media (max-width: 768px) {
    html, body {
        overflow-x: hidden !important;
    }
}
/* Enable position: sticky for sidebar on desktop viewports */
@media (min-width: 992px) {
    html,
    html body {
        overflow-x: visible !important;
    }
}

.page-phu-kien-portal {
    background: #F8FAFC;
    min-height: 60vh;
    padding: 30px 0 80px;
}

/* --- MAIN 2-COLUMN LAYOUT & SIDEBAR FILTER --- */
.pk-portal-container {
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 20px;
    box-sizing: border-box;
}

.pk-layout-grid {
    display: flex;
    gap: 28px;
    align-items: flex-start;
}

/* --- LEFT SIDEBAR: BỘ LỌC TÌM KIẾM --- */
.pk-sidebar-col {
    width: 270px;
    flex-shrink: 0;
    align-self: stretch;
}

.pk-filter-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px 18px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.03);
    position: sticky;
    top: 105px;
    max-height: calc(100vh - 125px);
    overflow-y: auto;
    scrollbar-width: thin;
}

.pk-filter-card::-webkit-scrollbar {
    width: 4px;
}
.pk-filter-card::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 4px;
}

/* 1. Header */
.pk-filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}

.pk-filter-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 800;
    color: #141414;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.pk-filter-title i {
    color: #C5A880;
    font-size: 0.95rem;
}

.pk-filter-reset {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    color: #94a3b8;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    transition: color 0.2s ease;
}

.pk-filter-reset:hover {
    color: #C5A880;
    text-decoration: underline;
}

/* 2. Search Box */
.pk-filter-search {
    position: relative;
    margin-bottom: 18px;
}

.pk-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 0.82rem;
    pointer-events: none;
}

.pk-search-input {
    width: 100%;
    box-sizing: border-box;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 9px 30px 9px 34px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.84rem;
    color: #141414;
    transition: all 0.2s ease;
}

.pk-search-input:focus {
    background: #ffffff;
    border-color: #C5A880;
    outline: none;
    box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.15);
}

.pk-search-input::placeholder {
    color: #94a3b8;
    font-size: 0.82rem;
}

.pk-search-clear {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 1.1rem;
    color: #94a3b8;
    cursor: pointer;
    padding: 0 4px;
    line-height: 1;
}

/* 3. Group: Nhóm sản phẩm */
.pk-filter-group {
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
}

.pk-group-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
    margin-bottom: 10px;
}

.pk-group-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    color: #141414;
}

.pk-group-chevron {
    font-size: 0.75rem;
    color: #64748b;
    transition: transform 0.25s ease;
}

.pk-filter-group.is-collapsed .pk-group-chevron {
    transform: rotate(180deg);
}

.pk-filter-group.is-collapsed .pk-group-body {
    display: none;
}

/* Category Menu List - NO CHECKBOXES, NO NUMBERS */
.pk-cat-menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.pk-cat-menu-item {
    margin: 0;
}

.pk-cat-menu-link {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 8px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    color: #334155;
    text-decoration: none;
    transition: all 0.2s ease;
}

.pk-cat-menu-link:hover {
    background: #f8fafc;
    color: #141414;
    padding-left: 16px;
}

.pk-cat-menu-item.is-active .pk-cat-menu-link {
    background: #F3ECE1;
    color: #141414;
    font-weight: 700;
}

.pk-cat-menu-vf .pk-cat-menu-link {
    color: #8C6D3B;
}

.pk-cat-menu-vf .pk-cat-menu-link:hover {
    background: #FAF8F5;
    color: #8C6D3B;
}

/* --- RIGHT MAIN CONTENT COLUMN --- */
.pk-content-col {
    flex: 1;
    min-width: 0;
}

.pk-categories-stack {
    display: flex;
    flex-direction: column;
    gap: 28px;
    margin-top: 0;
}

/* No results state */
.pk-no-results {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 48px 24px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.02);
}
.pk-no-results i {
    font-size: 2.2rem;
    color: #cbd5e1;
    margin-bottom: 12px;
}
.pk-no-results p {
    font-size: 0.95rem;
    color: #64748b;
    margin: 0 0 16px;
}
.pk-btn-reset-search {
    background: #141414;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s ease;
}
.pk-btn-reset-search:hover {
    background: #C5A880;
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

/* --- PRODUCT GRID (MOBILE 2-COL, DESKTOP 3-COL) --- */
.pk-product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
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
    padding-top: 10px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.pk-card-cta {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #C5A880;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s ease, transform 0.2s ease;
}
.pk-card:hover .pk-card-cta {
    color: #8C6239;
    transform: translateX(3px);
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
@media (max-width: 1200px) {
    .pk-product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
}

@media (max-width: 991px) {
    .pk-layout-grid {
        flex-direction: column;
        gap: 18px;
    }
    .pk-sidebar-col {
        width: 100%;
    }
    .pk-filter-card {
        position: static;
        max-height: none;
        padding: 16px 14px;
    }
    .pk-cat-menu-list {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 6px;
    }
    .pk-cat-menu-link {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .pk-cat-menu-link:hover,
    .pk-cat-menu-item.is-active .pk-cat-menu-link {
        background: #141414;
        color: #ffffff;
        border-color: #141414;
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
    /* CTA visible on mobile */
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
            <h1 class="phukien-title" style="margin: 0 auto;">
                <?php _e('HỆ THỐNG PHỤ KIỆN Ô TÔ CHÍNH HÃNG', 'hieugara-motors'); ?>
            </h1>
        </div>
    </div>
</section>

<!-- =========================================================================
     MAIN CONTENT (WITH LEFT SIDEBAR FILTER - LAYOUT REFERENCED FROM IMAGE 2)
     ========================================================================= -->
<main id="primary" class="site-main page-phu-kien-portal">
    <div class="pk-portal-container">
        
        <div class="pk-layout-grid">
            
            <!-- LEFT SIDEBAR: BỘ LỌC TÌM KIẾM (NO CHECKBOXES, NO NUMBERS) -->
            <aside class="pk-sidebar-col" id="pkSidebar">
                <div class="pk-filter-card">
                    
                    <!-- 1. Header with Funnel Icon & Reset Button -->
                    <div class="pk-filter-header">
                        <div class="pk-filter-title">
                            <i class="fa-solid fa-filter"></i>
                            <span>BỘ LỌC TÌM KIẾM</span>
                        </div>
                        <button type="button" class="pk-filter-reset" id="pkFilterReset">
                            Thiết lập lại
                        </button>
                    </div>

                    <!-- 2. Search Box with Search Icon -->
                    <div class="pk-filter-search">
                        <i class="fa-solid fa-magnifying-glass pk-search-icon"></i>
                        <input 
                            type="text" 
                            id="pkSearchInput" 
                            class="pk-search-input" 
                            placeholder="Tìm theo từ khóa, tên..."
                            autocomplete="off"
                        >
                        <button type="button" id="pkSearchClear" class="pk-search-clear" style="display:none;" aria-label="Xóa tìm kiếm">&times;</button>
                    </div>

                    <!-- 3. Category Group Section (Nhóm sản phẩm) -->
                    <div class="pk-filter-group" id="pkFilterGroup">
                        <div class="pk-group-header" id="pkGroupToggle">
                            <span class="pk-group-title">Nhóm sản phẩm</span>
                            <i class="fa-solid fa-chevron-up pk-group-chevron"></i>
                        </div>
                        <div class="pk-group-body" id="pkGroupBody">
                            <ul class="pk-cat-menu-list">
                                <?php if (!empty($categories_with_posts)) : ?>
                                    <?php 
                                    $first_active = true;
                                    foreach ($categories_with_posts as $idx => $item) : 
                                        $cat_term = $item['term'];
                                        // Ẩn Phụ Kiện VinFast khỏi menu theo yêu cầu
                                        if (strpos($cat_term->slug, 'vinfast') !== false) {
                                            continue;
                                        }
                                        $active_class = $first_active ? 'is-active' : '';
                                        $first_active = false;
                                    ?>
                                        <li class="pk-cat-menu-item <?php echo $active_class; ?>" data-slug="<?php echo esc_attr($cat_term->slug); ?>">
                                            <a href="#cat-<?php echo esc_attr($cat_term->slug); ?>" class="pk-cat-menu-link">
                                                <span><?php echo esc_html($cat_term->name); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </aside>

            <!-- RIGHT MAIN CONTENT COLUMN -->
            <div class="pk-content-col">

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

                        <!-- Lưới phụ kiện (2 cột trên Mobile, 3 cột trên Desktop) -->
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
                                            <span class="pk-card-cta">
                                                <span>Chi tiết</span> &rarr;
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

            <!-- Empty state for search -->
            <div id="pkNoResults" class="pk-no-results" style="display: none;">
                <i class="fa-solid fa-box-open"></i>
                <p>Không tìm thấy phụ kiện nào phù hợp với từ khóa của bạn.</p>
                <button type="button" class="pk-btn-reset-search" id="pkBtnResetSearch">Xem tất cả phụ kiện</button>
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

        </div><!-- /.pk-content-col -->
    </div><!-- /.pk-layout-grid -->

    </div><!-- /.pk-portal-container -->
</main>

<!-- Sidebar interactions: Smooth scroll, scrollspy, live search & accordion -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Smooth scroll on category link click
    var catLinks = document.querySelectorAll('.pk-cat-menu-link[href^="#cat-"]');
    catLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetEl = document.getElementById(targetId);
            if (targetEl) {
                var headerOffset = 85;
                var elementPosition = targetEl.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                // Update active state
                document.querySelectorAll('.pk-cat-menu-item').forEach(function(item) {
                    item.classList.remove('is-active');
                });
                this.closest('.pk-cat-menu-item').classList.add('is-active');
            }
        });
    });

    // 2. Scrollspy for Category Sections
    var sections = [];
    catLinks.forEach(function(link) {
        var targetId = link.getAttribute('href').substring(1);
        var sec = document.getElementById(targetId);
        if (sec) {
            sections.push({ el: sec, link: link });
        }
    });

    if (sections.length > 0) {
        window.addEventListener('scroll', function() {
            var scrollPos = window.scrollY + 220;
            sections.forEach(function(item) {
                var top = item.el.offsetTop;
                var height = item.el.offsetHeight;
                if (scrollPos >= top && scrollPos < top + height) {
                    document.querySelectorAll('.pk-cat-menu-item').forEach(function(p) {
                        p.classList.remove('is-active');
                    });
                    item.link.closest('.pk-cat-menu-item').classList.add('is-active');
                }
            });
        }, { passive: true });
    }

    // 3. Accordion toggle for "Nhóm sản phẩm"
    var groupToggle = document.getElementById('pkGroupToggle');
    var filterGroup = document.getElementById('pkFilterGroup');
    if (groupToggle && filterGroup) {
        groupToggle.addEventListener('click', function() {
            filterGroup.classList.toggle('is-collapsed');
        });
    }

    // 4. Real-time Live Search
    var searchInput = document.getElementById('pkSearchInput');
    var searchClear = document.getElementById('pkSearchClear');
    var filterReset = document.getElementById('pkFilterReset');
    var btnResetSearch = document.getElementById('pkBtnResetSearch');
    var noResultsBox = document.getElementById('pkNoResults');
    var catBlocks = document.querySelectorAll('.pk-cat-block');
    var cards = document.querySelectorAll('.pk-card');

    function filterProducts(query) {
        query = query.trim().toLowerCase();
        
        if (query.length > 0) {
            if (searchClear) searchClear.style.display = 'block';
        } else {
            if (searchClear) searchClear.style.display = 'none';
        }

        var totalVisibleCards = 0;

        catBlocks.forEach(function(block) {
            var blockCards = block.querySelectorAll('.pk-card');
            var blockVisibleCount = 0;

            blockCards.forEach(function(card) {
                if (!query) {
                    card.style.display = '';
                    blockVisibleCount++;
                    totalVisibleCards++;
                    return;
                }

                var title = (card.querySelector('.pk-card-title') || {}).innerText || '';
                var excerpt = (card.querySelector('.pk-card-excerpt') || {}).innerText || '';
                var badge = (card.querySelector('.pk-card-badge') || {}).innerText || '';
                var text = (title + ' ' + excerpt + ' ' + badge).toLowerCase();

                if (text.indexOf(query) !== -1) {
                    card.style.display = '';
                    blockVisibleCount++;
                    totalVisibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (!query) {
                block.style.display = '';
            } else {
                block.style.display = (blockVisibleCount > 0) ? '' : 'none';
            }
        });

        if (noResultsBox) {
            noResultsBox.style.display = (query && totalVisibleCards === 0) ? 'block' : 'none';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterProducts(this.value);
        });
    }

    function resetSearch() {
        if (searchInput) {
            searchInput.value = '';
        }
        filterProducts('');
        window.scrollTo({
            top: (document.getElementById('primary') || {}).offsetTop || 0,
            behavior: 'smooth'
        });
    }

    if (searchClear) {
        searchClear.addEventListener('click', resetSearch);
    }
    if (filterReset) {
        filterReset.addEventListener('click', resetSearch);
    }
    if (btnResetSearch) {
        btnResetSearch.addEventListener('click', resetSearch);
    }
});
</script>

<?php
get_footer();
