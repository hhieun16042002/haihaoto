<?php
/**
 * Template Name: Phụ Kiện Chính Hãng VinFast
 * Description: Danh mục phụ kiện chính hãng VinFast tại Ô Tô Hải Hà với bộ lọc dòng xe và nhóm phụ kiện
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '02203 892 207';
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

// Query all VinFast accessories
$vf_posts = get_posts(array(
    'post_type'      => 'garage_accessory',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'accessory_category',
            'field'    => 'slug',
            'terms'    => 'phu-kien-vinfast',
        ),
    ),
));

$models_list = array('VF 3', 'VF 5', 'VF 6', 'VF 7', 'VF 8', 'VF 9', 'Limo Green', 'Nerio Green', 'Minio Green', 'EC Van', 'Sạc');
$categories_list = array('Màn hình và giải trí', 'Camera', 'An toàn', 'Phim và bảo vệ sơn', 'Nội thất', 'Ngoại thất và đèn', 'Tiện ích');
?>

<?php
$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : '';
if (empty($banner_bg) || strpos($banner_bg, 'default') !== false) {
    $banner_bg = function_exists('hieugara_get_page_banner_url') ? hieugara_get_page_banner_url('vinfast') : get_template_directory_uri() . '/assets/images/banners/banner-vinfast.jpg';
}
?>

<!-- =========================================================================
     HERO BANNER: PHỤ KIỆN CHÍNH HÃNG VINFAST (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay)
     ========================================================================= -->
<section class="portal-hero-header phukien-hero-section" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><?php _e('Phụ kiện ô tô', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php _e('Phụ kiện VinFast', 'hieugara-motors'); ?></span>
        </nav>

        <h1 class="portal-page-title" style="margin-bottom: 0; text-transform: uppercase;">
            <?php _e('Phụ kiện chính hãng VinFast', 'hieugara-motors'); ?>
        </h1>
    </div>
</section>

<!-- =========================================================================
     MAIN CONTENT & PRODUCT GRID
     ========================================================================= -->
<main id="primary" class="site-main page-vf-portal">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">

        <!-- PRODUCT GRID -->
        <section id="vf-product-grid-section" class="vf-product-grid-wrap">
            <div class="vf-products-grid" id="vfProductsGrid">
                <?php if (!empty($vf_posts)) : ?>
                    <?php foreach ($vf_posts as $post) : 
                        $p_id = $post->ID;
                        $sku = get_post_meta($p_id, '_accessory_sku', true);
                        $models = get_post_meta($p_id, '_accessory_models', true) ?: array('Tất cả xe điện');
                        if (!is_array($models)) $models = array($models);
                        $cat_haiha = get_post_meta($p_id, '_accessory_category_haiha', true) ?: 'Tiện ích';
                        $img_url = get_post_meta($p_id, '_accessory_img', true);
                        if (!$img_url && has_post_thumbnail($p_id)) {
                            $img_url = get_the_post_thumbnail_url($p_id, 'medium_large');
                        }
                        if (!$img_url) {
                            $img_url = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-2.jpg';
                        }
                        $product_url = home_url('/phu-kien/phu-kien-vinfast/' . $post->post_name . '/');
                        $models_attr = esc_attr(implode('|', $models));
                    ?>
                        <article class="vf-product-card" 
                                 data-sku="<?php echo esc_attr($sku); ?>"
                                 data-models="<?php echo $models_attr; ?>"
                                 data-cat="<?php echo esc_attr($cat_haiha); ?>">
                            
                            <div class="vf-card-thumb">
                                <a href="<?php echo esc_url($product_url); ?>" title="<?php echo esc_attr($post->post_title); ?>">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($post->post_title); ?> – phụ kiện chính hãng VinFast tại Ô Tô Hải Hà" loading="lazy">
                                </a>
                                <span class="vf-badge-tag"><i class="fa-solid fa-certificate"></i> CHÍNH HÃNG</span>
                                <?php if (!empty($sku)) : ?>
                                    <span class="vf-sku-tag"><?php echo esc_html($sku); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="vf-card-body">
                                <div class="vf-card-meta">
                                    <span class="vf-cat-pill"><?php echo esc_html($cat_haiha); ?></span>
                                </div>

                                <h3 class="vf-card-title">
                                    <a href="<?php echo esc_url($product_url); ?>">
                                        <?php echo esc_html($post->post_title); ?>
                                    </a>
                                </h3>

                                <!-- Compatible Models Chips -->
                                <div class="vf-compatible-chips">
                                    <?php foreach (array_slice($models, 0, 4) as $m) : ?>
                                        <span class="vf-model-mini-chip"><?php echo esc_html($m); ?></span>
                                    <?php endforeach; ?>
                                    <?php if (count($models) > 4) : ?>
                                        <span class="vf-model-mini-chip">+<?php echo count($models) - 4; ?></span>
                                    <?php endif; ?>
                                </div>

                                <p class="vf-card-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt($p_id) ?: strip_tags($post->post_content), 14, '...'); ?>
                                </p>

                                <div class="vf-card-footer">
                                    <a href="<?php echo esc_url($product_url); ?>" class="vf-btn-detail">
                                        <span>Chi tiết</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                    <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="vf-btn-contact" title="Liên hệ báo giá và tư vấn lắp đặt">
                                        <i class="fa-solid fa-phone"></i>
                                        <span>Liên hệ</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="vf-no-products">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>Danh mục đang được cập nhật</h3>
                        <p>Các phụ kiện chính hãng VinFast đang được đồng bộ và cập nhật lên hệ thống. Quý khách vui lòng liên hệ hotline để nhận tư vấn trực tiếp.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Empty result message for JavaScript filtering -->
            <div id="vfEmptyFilterMsg" class="vf-no-products" style="display: none;">
                <i class="fa-solid fa-filter-circle-xmark"></i>
                <h3>Không tìm thấy phụ kiện phù hợp</h3>
                <p>Không có phụ kiện nào khớp với bộ lọc bạn đã chọn. Vui lòng thử chọn dòng xe hoặc nhóm phụ kiện khác.</p>
                <button type="button" class="btn-vf-primary" id="vfResetFromEmpty" style="margin-top: 16px;">
                    <i class="fa-solid fa-rotate-left"></i> Xem tất cả phụ kiện
                </button>
            </div>
        </section>

    </div>
</main>

<style>
/* Portal Hero Header (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay) */
@media (max-width: 768px) {
    .portal-hero-header.phukien-hero-section {
        padding: 42px 14px 36px !important;
    }
    .portal-hero-header .portal-breadcrumb {
        font-size: clamp(0.64rem, 2.7vw, 0.78rem) !important;
        letter-spacing: 0.4px !important;
        gap: 5px !important;
        margin-bottom: 12px !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        justify-content: center !important;
        line-height: 1.3 !important;
    }
    .portal-hero-header .portal-breadcrumb a,
    .portal-hero-header .portal-breadcrumb span,
    .portal-hero-header .portal-breadcrumb .current {
        white-space: nowrap !important;
        display: inline-block !important;
    }
    .portal-hero-header .portal-page-title {
        white-space: normal !important;
        font-size: clamp(1.2rem, 5vw, 1.8rem) !important;
        line-height: 1.25 !important;
        letter-spacing: -0.01em !important;
        margin: 0 auto !important;
    }
}

.btn-vf-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #141414;
    color: #ffffff;
    padding: 13px 26px;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    border: none;
    cursor: pointer;
}
.btn-vf-primary:hover {
    background: #C5A880;
    color: #141414;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(197, 168, 128, 0.35);
}

/* Page Layout */
.page-vf-portal {
    background: #FAF8F5;
    padding: 45px 0 85px;
    min-height: 60vh;
}

/* Products Grid */
.vf-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}
@media (max-width: 1200px) {
    .vf-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .vf-products-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 480px) {
    .vf-products-grid { grid-template-columns: 1fr; }
}

/* Product Card */
.vf-product-card {
    background: #ffffff;
    border: 1px solid #e7e5e4;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    transition: all 0.25s ease;
}
.vf-product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.07);
    border-color: #C5A880;
}
.vf-card-thumb {
    position: relative;
    height: 200px;
    background: #fafaf9;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.vf-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 12px;
    transition: transform 0.3s ease;
}
.vf-product-card:hover .vf-card-thumb img {
    transform: scale(1.05);
}
.vf-badge-tag {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #141414;
    color: #C5A880;
    border: 1px solid #C5A880;
    font-size: 0.68rem;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.vf-sku-tag {
    position: absolute;
    bottom: 8px;
    right: 8px;
    background: rgba(15, 23, 42, 0.75);
    color: #f1f5f9;
    font-size: 0.68rem;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}
.vf-card-body {
    padding: 18px 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.vf-card-meta {
    margin-bottom: 6px;
}
.vf-cat-pill {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    color: #8C6D3B;
    background: #F4EFE6;
    padding: 2px 8px;
    border-radius: 3px;
}
.vf-card-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.95rem;
    font-weight: 800;
    line-height: 1.4;
    margin: 0 0 10px;
    color: #141414;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.8em;
}
.vf-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}
.vf-card-title a:hover {
    color: #C5A880;
}
.vf-compatible-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin-bottom: 10px;
}
.vf-model-mini-chip {
    font-size: 0.68rem;
    font-weight: 700;
    background: #f5f5f4;
    color: #57534e;
    border: 1px solid #e7e5e4;
    padding: 2px 6px;
    border-radius: 3px;
}
.vf-card-excerpt {
    font-size: 0.82rem;
    color: #78716c;
    line-height: 1.5;
    margin: 0 0 14px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.vf-card-footer {
    display: flex;
    gap: 8px;
    padding-top: 14px;
    border-top: 1px solid #f5f5f4;
    margin-top: auto;
}
.vf-btn-detail {
    flex: 1;
    text-align: center;
    padding: 8px 10px;
    background: #f5f5f4;
    color: #1c1917;
    border: 1px solid #e7e5e4;
    border-radius: 4px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.8rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s;
}
.vf-btn-detail:hover {
    background: #141414;
    color: #ffffff;
    border-color: #141414;
}
.vf-btn-contact {
    flex: 1;
    text-align: center;
    padding: 8px 10px;
    background: #C5A880;
    color: #141414;
    border-radius: 4px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.8rem;
    font-weight: 800;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s;
}
.vf-btn-contact:hover {
    background: #141414;
    color: #ffffff;
}

/* Empty State */
.vf-no-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    border: 1px dashed #cbd5e1;
    border-radius: 12px;
}
.vf-no-products i {
    font-size: 3rem;
    color: #94a3b8;
    margin-bottom: 14px;
}
.vf-no-products h3 {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    color: #141414;
    margin-bottom: 8px;
}
.vf-no-products p {
    font-size: 0.95rem;
    color: #78716c;
    max-width: 500px;
    margin: 0 auto;
}
</style>

<?php get_footer(); ?>

