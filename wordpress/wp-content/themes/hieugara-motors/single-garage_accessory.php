<?php
/**
 * Single Template for Garage Accessories (single-garage_accessory.php)
 * Displays dedicated native accessory product detail page for Ôtô Hải Hà
 * 100% Internal to website - No external redirects
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '0911 211 996';

while (have_posts()) : the_post();
    $post_id    = get_the_ID();
    $title      = get_the_title();
    $is_vf      = get_post_meta($post_id, '_accessory_is_vinfast', true) === '1';
    $price      = get_post_meta($post_id, '_accessory_price', true) ?: 'Liên hệ';
    $old_price  = get_post_meta($post_id, '_accessory_old_price', true);
    $badge      = get_post_meta($post_id, '_accessory_badge', true) ?: ($is_vf ? 'ĐỐI TÁC CHÍNH HÃNG' : 'CHÍNH HÃNG');
    $brand      = get_post_meta($post_id, '_accessory_brand', true) ?: ($is_vf ? 'VinFast' : 'Chính Hãng Phân Phối');
    $warranty   = get_post_meta($post_id, '_accessory_warranty', true) ?: ($is_vf ? 'Chính hãng VinFast' : '12 tháng 1 đổi 1');
    $origin     = get_post_meta($post_id, '_accessory_origin', true) ?: ($is_vf ? 'Chính hãng VinFast' : 'Chính hãng phân phối');
    $sku        = get_post_meta($post_id, '_accessory_sku', true);
    $models     = get_post_meta($post_id, '_accessory_models', true) ?: array();
    if (!is_array($models) && !empty($models)) $models = array($models);
    $specs_raw  = get_post_meta($post_id, '_accessory_specs', true);

    $thumb = get_the_post_thumbnail_url($post_id, 'full');
    if (!$thumb) {
        $thumb = get_post_meta($post_id, '_accessory_img', true) ?: get_template_directory_uri() . '/assets/images/shiftup/center-car.jpg';
    }
    if (function_exists('hieugara_normalize_local_media_urls')) {
        $thumb = hieugara_normalize_local_media_urls($thumb);
    }

    $cat_terms = get_the_terms($post_id, 'accessory_category');
    $cat_name  = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0]->name : 'Phụ Kiện Ô Tô';
    $cat_slug  = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0]->slug : 'noi-that';
?>

<style>
/* ==========================================================================
   MOBILE & RESPONSIVE FIX FOR ACCESSORY SINGLE PAGE
   ========================================================================== */
html, body {
    overflow-x: hidden !important;
    max-width: 100vw !important;
}

.page-accessory-single {
    overflow-x: hidden !important;
    max-width: 100% !important;
}

/* Contain Grid & Columns */
.acc-single-grid {
    min-width: 0 !important;
    max-width: 100% !important;
}

.acc-left-col,
.acc-right-col {
    min-width: 0 !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}

/* Gallery & Featured Image: Frame/Contain properly */
.acc-gallery-container {
    max-width: 100% !important;
    overflow: hidden !important;
}

.acc-main-img-box {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    background: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    overflow: hidden !important;
    padding: 20px !important;
}

.acc-featured-img {
    max-width: 100% !important;
    max-height: 100% !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    transition: opacity 0.25s ease;
}

/* Interactive Thumbnails */
.acc-gallery-thumbs {
    max-width: 100% !important;
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch !important;
    display: flex !important;
    flex-wrap: nowrap !important;
    gap: 10px !important;
    padding-bottom: 6px !important;
    scrollbar-width: thin !important;
}

.acc-thumb-btn {
    flex-shrink: 0 !important;
    box-sizing: border-box !important;
}

.acc-thumb-btn img {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain !important;
    background: #ffffff !important;
}

/* Mobile Devices (<= 768px) */
@media (max-width: 768px) {
    .acc-single-header {
        padding: 12px 0 !important;
    }

    .acc-breadcrumb {
        font-size: 0.78rem !important;
        line-height: 1.5 !important;
        word-break: break-word !important;
    }

    .acc-single-body {
        padding: 16px 0 30px !important;
    }

    .acc-single-body .container {
        padding-left: 14px !important;
        padding-right: 14px !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }

    .acc-single-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 20px !important;
        width: 100% !important;
    }

    /* Bo ảnh chính */
    .acc-main-img-box {
        height: 300px !important;
        min-height: 250px !important;
        padding: 16px !important;
        border-radius: 12px !important;
    }

    .acc-featured-img {
        max-height: 268px !important;
    }

    .acc-badge-pill {
        top: 10px !important;
        right: 10px !important;
        font-size: 0.7rem !important;
        padding: 4px 10px !important;
    }

    /* Bo thumbnails */
    .acc-gallery-thumbs {
        gap: 8px !important;
    }

    .acc-thumb-btn {
        width: 62px !important;
        height: 62px !important;
        padding: 2px !important;
        border-radius: 6px !important;
    }

    /* Bo bảng thông số kỹ thuật (Specs Card & Table) */
    .acc-specs-card {
        padding: 18px 14px !important;
        border-radius: 12px !important;
        margin-bottom: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
    }

    .specs-heading {
        font-size: 1.1rem !important;
        margin-bottom: 14px !important;
        padding-bottom: 10px !important;
    }

    .acc-specs-table {
        display: block !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .acc-specs-table tbody {
        display: block !important;
        width: 100% !important;
    }

    .acc-specs-table tr {
        display: flex !important;
        flex-direction: column !important;
        padding: 10px 12px !important;
        margin-bottom: 8px !important;
        border: 1px solid #eef2f6 !important;
        border-radius: 8px !important;
        background: #f8fafc !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .acc-specs-table tr:nth-child(even) {
        background: #ffffff !important;
    }

    .acc-specs-table th {
        display: block !important;
        width: 100% !important;
        padding: 0 0 4px 0 !important;
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        color: #64748b !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        border: none !important;
    }

    .acc-specs-table td {
        display: block !important;
        width: 100% !important;
        padding: 0 !important;
        font-size: 0.88rem !important;
        color: #0f172a !important;
        line-height: 1.55 !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        border: none !important;
    }

    /* Bo khối bài viết / Đánh giá chi tiết (Content Card) */
    .acc-content-card {
        padding: 18px 14px !important;
        border-radius: 12px !important;
        margin-bottom: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
    }

    .content-heading {
        font-size: 1.1rem !important;
        margin-bottom: 14px !important;
        padding-bottom: 10px !important;
    }

    .acc-prose-body {
        font-size: 0.9rem !important;
        line-height: 1.65 !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
    }

    .acc-prose-body img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
    }

    /* Bo khối Đặt mua / Liên hệ (Sticky Card -> Full Card) */
    .acc-right-col {
        position: static !important;
        width: 100% !important;
    }

    .acc-buy-card-sticky {
        padding: 18px 14px !important;
        border-radius: 12px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .acc-buy-title {
        font-size: 1.25rem !important;
        line-height: 1.35 !important;
        word-break: break-word !important;
    }

    .acc-price-main .current-num {
        font-size: 1.6rem !important;
    }

    .acc-cta-stack {
        width: 100% !important;
        gap: 8px !important;
    }

    .btn-acc-primary-book,
    .btn-acc-zalo,
    .btn-acc-call {
        width: 100% !important;
        padding: 12px 8px !important;
        font-size: 0.82rem !important;
        line-height: 1.35 !important;
        white-space: normal !important;
        text-align: center !important;
        box-sizing: border-box !important;
        justify-content: center !important;
    }

    /* Bo Sản phẩm phụ kiện liên quan */
    .acc-related-section {
        padding: 36px 0 60px !important;
    }

    .related-title {
        font-size: 1.35rem !important;
    }

    .phukien-products-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
        width: 100% !important;
    }

    .phukien-card {
        border-radius: 10px !important;
        overflow: hidden !important;
    }

    .phukien-card-img-wrap {
        height: 130px !important;
        padding: 8px !important;
        background: #ffffff !important;
    }

    .phukien-card-img-wrap img {
        max-width: 90% !important;
        max-height: 90% !important;
        object-fit: contain !important;
    }

    .phukien-card-body {
        padding: 10px !important;
    }

    .phukien-card-title {
        font-size: 0.85rem !important;
        line-height: 1.35 !important;
        min-height: 2.7em !important;
        margin-bottom: 6px !important;
        word-break: break-word !important;
    }

    .phukien-card-badge {
        font-size: 0.65rem !important;
        padding: 2px 6px !important;
        top: 8px !important;
        right: 8px !important;
    }

    .phukien-card-pricing .price-current {
        font-size: 0.95rem !important;
    }
}
</style>

<main id="primary" class="site-main page-accessory-single <?php echo $is_vf ? 'page-vf-accessory-single' : ''; ?>">

    <!-- Header Breadcrumbs -->
    <section class="acc-single-header">
        <div class="container">
            <nav class="acc-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><?php _e('Phụ kiện ô tô', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <?php if ($is_vf) : ?>
                    <a href="<?php echo esc_url(home_url('/phu-kien/phu-kien-vinfast/')); ?>"><?php _e('Phụ kiện VinFast', 'hieugara-motors'); ?></a>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/phu-kien/?cat=' . $cat_slug)); ?>"><?php echo esc_html($cat_name); ?></a>
                <?php endif; ?>
                <span class="sep">/</span>
                <span class="current"><?php echo esc_html($title); ?></span>
            </nav>
        </div>
    </section>

    <!-- Product Showcase -->
    <section class="acc-single-body">
        <div class="container">
            <div class="acc-single-grid">

                <!-- Left Column: Image & In-Depth Details -->
                <div class="acc-left-col">
                    
                    <!-- Gallery Container -->
                    <div class="acc-gallery-container" style="margin-bottom: 24px;">
                        <!-- Product Image Viewer -->
                        <div class="acc-main-img-box">
                            <?php if (!empty($badge)) : ?>
                                <span class="acc-badge-pill"><?php echo esc_html($badge); ?></span>
                            <?php endif; ?>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>" class="acc-featured-img" id="accMainFeaturedImg">
                        </div>

                        <!-- Interactive Thumbnails -->
                        <?php 
                        $gallery = get_post_meta($post_id, '_accessory_gallery', true);
                        if (!empty($gallery) && is_array($gallery) && count($gallery) > 1) :
                            if (function_exists('hieugara_normalize_local_media_urls')) {
                                $gallery = array_map('hieugara_normalize_local_media_urls', $gallery);
                            }
                        ?>
                        <div class="acc-gallery-thumbs" id="accGalleryThumbs">
                            <?php foreach ($gallery as $g_idx => $g_img) : ?>
                                <button type="button" class="acc-thumb-btn <?php echo $g_idx === 0 ? 'active' : ''; ?>" data-src="<?php echo esc_url($g_img); ?>" aria-label="Xem ảnh <?php echo $g_idx + 1; ?>">
                                    <img src="<?php echo esc_url($g_img); ?>" alt="Ảnh thumbnail <?php echo $g_idx + 1; ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Specifications Table -->
                    <?php if (!empty($specs_raw)) : ?>
                    <div class="acc-specs-card">
                        <h2 class="specs-heading">Thông Số Kỹ Thuật Chi Tiết</h2>
                        <table class="acc-specs-table">
                            <tbody>
                                <?php if (!empty($sku)) : ?>
                                <tr>
                                    <th>Mã phụ kiện (SKU)</th>
                                    <td><strong style="font-family: monospace; color: #0057b8;"><?php echo esc_html($sku); ?></strong></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Thương hiệu</th>
                                    <td><?php echo esc_html($brand); ?></td>
                                </tr>
                                <?php if (!empty($models)) : ?>
                                <tr>
                                    <th>Dòng xe tương thích</th>
                                    <td>
                                        <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                            <?php foreach ((array)$models as $m_chip) : ?>
                                                <span style="display: inline-block; background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 0.75rem; padding: 2px 7px; border-radius: 3px;"><?php echo esc_html($m_chip); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Bảo hành</th>
                                    <td><?php echo esc_html($warranty); ?></td>
                                </tr>
                                <tr>
                                    <th>Xuất xứ</th>
                                    <td><?php echo esc_html($origin); ?></td>
                                </tr>
                                <?php 
                                if (is_array($specs_raw)) {
                                    foreach ($specs_raw as $s_item) {
                                        $k = is_array($s_item) ? ($s_item['key'] ?? '') : '';
                                        $v = is_array($s_item) ? ($s_item['value'] ?? '') : '';
                                        if ($k && $v) {
                                            echo '<tr><th>' . esc_html($k) . '</th><td>' . esc_html($v) . '</td></tr>';
                                        }
                                    }
                                } else {
                                    $specs_lines = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $specs_raw))));
                                    foreach ($specs_lines as $s_line) {
                                        $parts = explode(':', $s_line, 2);
                                        if (count($parts) === 2) {
                                            echo '<tr><th>' . esc_html(trim($parts[0])) . '</th><td>' . esc_html(trim($parts[1])) . '</td></tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

                    <!-- In-depth Product Content -->
                    <div class="acc-content-card">
                        <h2 class="content-heading">Giới Thiệu &amp; Đánh Giá Chi Tiết</h2>
                        <div class="acc-prose-body">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Sticky Purchasing Card -->
                <div class="acc-right-col">
                    <div class="acc-buy-card-sticky">
                        
                        <div class="acc-cat-tag"><?php echo esc_html($is_vf ? 'Phụ kiện chính hãng VinFast' : $cat_name); ?></div>
                        <h1 class="acc-buy-title"><?php echo esc_html($title); ?></h1>

                        <div class="acc-brand-row">
                            <span>Thương hiệu: <strong><?php echo esc_html($brand); ?></strong></span>
                            <span class="sep">&bull;</span>
                            <span class="stock-status"><i class="fa-solid fa-circle-check text-green"></i> Sẵn hàng tại Hải Hà</span>
                        </div>

                        <?php if (!empty($models)) : ?>
                        <div style="margin: 10px 0 14px;">
                            <div style="font-size: 0.78rem; font-weight: 700; color: #64748b; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">Dòng xe tương thích:</div>
                            <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                                <?php foreach ((array)$models as $m_it) : ?>
                                    <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 700; background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 4px;"><?php echo esc_html($m_it); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!$is_vf && $price !== 'Liên hệ') : ?>
                            <div class="acc-price-box" style="margin: 16px 0;">
                                <div class="acc-price-main">
                                    <span class="current-num"><?php echo esc_html($price); ?></span>
                                    <span class="currency">đ</span>
                                </div>
                                <?php if (!empty($old_price)) : ?>
                                    <div class="acc-price-old">
                                        <span class="old-num"><?php echo esc_html($old_price); ?> đ</span>
                                        <span class="discount-pill">Tiết kiệm giá tốt</span>
                                    </div>
                                <?php endif; ?>
                                <small class="tax-note">Đã bao gồm VAT &amp; Hỗ trợ công lắp đặt cơ bản tại xưởng</small>
                            </div>
                        <?php endif; ?>

                        <!-- Primary CTA Buttons -->
                        <div class="acc-cta-stack" style="margin-top: 18px; margin-bottom: 0;">
                            <a href="tel:02203892207" class="btn-acc-primary-book" title="Tư vấn lắp đặt phụ kiện này" style="background: #C5A880; color: #141414; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; gap: 10px;">
                                <i class="fa-solid fa-phone-volume"></i>
                                <span>02203 892 207</span>
                            </a>

                            <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="btn-acc-zalo" title="Zalo tư vấn lắp đặt" style="background: #0068ff; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; gap: 10px;">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span>ZALO TƯ VẤN LẮP ĐẶT</span>
                            </a>

                            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="btn-acc-book-modal" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #0f172a; color: #ffffff; text-decoration: none; padding: 12px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-transform: uppercase;">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>LIÊN HỆ ĐẾN XƯỞNG LẮP ĐẶT</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Accessories Section -->
    <?php
    $related = get_posts(array(
        'post_type'      => 'garage_accessory',
        'post_status'    => 'publish',
        'posts_per_page' => 4,
        'post__not_in'   => array($post_id),
        'tax_query'      => !empty($cat_terms) ? array(
            array(
                'taxonomy' => 'accessory_category',
                'field'    => 'term_id',
                'terms'    => $cat_terms[0]->term_id,
            ),
        ) : '',
    ));

    if (empty($related)) {
        $related = get_posts(array(
            'post_type'      => 'garage_accessory',
            'post_status'    => 'publish',
            'posts_per_page' => 4,
            'post__not_in'   => array($post_id),
        ));
    }

    if (!empty($related)) :
    ?>
    <section class="acc-related-section">
        <div class="container">
            <div class="section-heading-wrap text-center">
                <span class="sub-pill">PHỤ KIỆN TƯƠNG THÍCH</span>
                <h3 class="related-title">SẢN PHẨM PHỤ KIỆN LIÊN QUAN</h3>
                <div class="gold-divider"></div>
            </div>

            <div class="phukien-products-grid">
                <?php foreach ($related as $rel) : 
                    $rel_id    = $rel->ID;
                    $rel_thumb = get_the_post_thumbnail_url($rel_id, 'full') ?: (get_post_meta($rel_id, '_accessory_img', true) ?: $thumb);
                    $rel_price = get_post_meta($rel_id, '_accessory_price', true) ?: 'Liên hệ';
                    $rel_old   = get_post_meta($rel_id, '_accessory_old_price', true);
                    $rel_badge = get_post_meta($rel_id, '_accessory_badge', true) ?: 'CHÍNH HÃNG';
                ?>
                    <article class="phukien-card">
                        <?php if (!empty($rel_badge)) : ?>
                            <span class="phukien-card-badge"><?php echo esc_html($rel_badge); ?></span>
                        <?php endif; ?>

                        <div class="phukien-card-img-wrap">
                            <img src="<?php echo esc_url($rel_thumb); ?>" alt="<?php echo esc_attr($rel->post_title); ?>" loading="lazy">
                        </div>

                        <div class="phukien-card-body">
                            <h4 class="phukien-card-title">
                                <a href="<?php echo esc_url(get_permalink($rel_id)); ?>">
                                    <?php echo esc_html($rel->post_title); ?>
                                </a>
                            </h4>

                            <div class="phukien-card-pricing">
                                <?php 
                                $is_contact_price = (mb_strtolower(trim($rel_price), 'UTF-8') === 'liên hệ' || empty($rel_price));
                                if ($is_contact_price) : ?>
                                    <span class="price-current is-contact-price" style="color: #C5A880; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.15rem;"><?php _e('Liên hệ', 'hieugara-motors'); ?></span>
                                <?php else : ?>
                                    <span class="price-current"><?php echo esc_html($rel_price); ?> <sup>đ</sup></span>
                                <?php endif; ?>
                                <?php if (!empty($rel_old)) : ?>
                                    <span class="price-old"><?php echo esc_html($rel_old); ?> <sup>đ</sup></span>
                                <?php endif; ?>
                            </div>

                            <div class="phukien-card-actions" style="margin-top: auto; padding-top: 12px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-start; align-items: center;">
                                <a href="<?php echo esc_url(get_permalink($rel_id)); ?>" class="btn-pk-detail-link" style="color: #C5A880; text-decoration: none; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 6px; transition: color 0.2s ease;">
                                    <span><?php _e('Chi tiết', 'hieugara-motors'); ?></span> &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var thumbBtns = document.querySelectorAll('#accGalleryThumbs .acc-thumb-btn');
    var mainImg = document.getElementById('accMainFeaturedImg');
    if (thumbBtns.length && mainImg) {
        thumbBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                thumbBtns.forEach(function(b) { b.classList.remove('active'); });
                btn.classList.add('active');
                var newSrc = btn.getAttribute('data-src');
                if (newSrc) {
                    mainImg.style.opacity = '0.5';
                    mainImg.src = newSrc;
                    mainImg.onload = function() {
                        mainImg.style.opacity = '1';
                    };
                }
            });
        });
    }
});
</script>

<?php
endwhile;
get_footer();

