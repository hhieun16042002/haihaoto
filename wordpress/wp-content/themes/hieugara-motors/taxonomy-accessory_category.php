<?php
/**
 * Taxonomy Template for Accessory Categories
 * 100% Synchronized with WordPress Admin & Mobile-First Responsive
 *
 * @package HieuGara_Motors
 */

get_header();

$current_term  = get_queried_object();
$term_id       = $current_term ? $current_term->term_id : 0;
$term_name     = $current_term ? $current_term->name : __('Danh Mục Phụ Kiện', 'hieugara-motors');
$term_desc     = $current_term ? $current_term->description : '';

$page_title    = $term_name;
$badge         = __('PHỤ KIỆN Ô TÔ CHÍNH HÃNG', 'hieugara-motors');

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('phukien');

// Query child accessories in this category from database
$child_accessories = array();
if ($term_id) {
    $child_accessories = get_posts(array(
        'post_type'      => 'garage_accessory',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy'         => 'accessory_category',
                'field'            => 'term_id',
                'terms'            => $term_id,
                'include_children' => true,
            ),
        ),
    ));
}
?>

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

.pk-portal-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 16px;
    box-sizing: border-box;
}

/* --- PRODUCT GRID (MOBILE 2-COL, TABLET 3-COL, DESKTOP 4-COL) --- */
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
}

/* Consultation Banner */
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

/* RESPONSIVE BREAKPOINTS */
@media (max-width: 1024px) {
    .pk-product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
}
@media (max-width: 768px) {
    .page-phu-kien-portal {
        padding: 20px 0 60px;
    }
    .pk-portal-container {
        padding: 0 12px;
    }
}
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
    .pk-card-price-row {
        padding-top: 6px;
    }
    .pk-card-price {
        font-size: 0.75rem;
    }
    .pk-card-cta span {
        display: none;
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
@media (max-width: 375px) {
    .pk-portal-container {
        padding: 0 8px;
    }
    .pk-product-grid {
        gap: 8px !important;
    }
    .pk-card-title {
        font-size: 0.78rem;
    }
}
</style>

<!-- Category Hero Header Banner -->
<section class="portal-hero-header phukien-hero-section" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><?php _e('Phụ Kiện', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php echo esc_html($page_title); ?></span>
        </nav>

        <div style="display: inline-block; background: rgba(197, 168, 128, 0.2); border: 1px solid #C5A880; color: #D4B996; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.72rem; font-weight: 800; padding: 4px 14px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 12px; border-radius: 20px;">
            <?php echo esc_html($badge); ?>
        </div>

        <h1 class="portal-page-title" style="margin: 0 auto 12px;">
            <?php echo esc_html($page_title); ?>
        </h1>

        <?php if (!empty($term_desc)) : ?>
            <p class="portal-page-subtitle">
                <?php echo esc_html($term_desc); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<main id="primary" class="site-main page-phu-kien-portal">
    <div class="pk-portal-container">

        <?php if (!empty($child_accessories)) : ?>
            <!-- LƯỚI PHỤ KIỆN (2 CỘT TRÊN MOBILE, 4 CỘT TRÊN DESKTOP) -->
            <div class="pk-product-grid">
                <?php foreach ($child_accessories as $acc) : 
                    $a_id    = $acc->ID;
                    $a_link  = get_permalink($a_id);
                    $is_vf   = (strpos($term_name, 'VinFast') !== false);
                    $a_badge = $is_vf ? 'VINFAST' : 'ZIN 100%';

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

            <!-- Banner Tư Vấn Kỹ Thuật Cuối Trang -->
            <div class="pk-consult-banner">
                <h3>Tư Vấn &amp; Báo Giá Phụ Kiện Theo Xe</h3>
                <p>
                    Quý khách có nhu cầu lắp đặt hoặc báo giá chính xác cho dòng xe của mình, hãy liên hệ ngay với kỹ thuật viên Ô Tô Hải Hà để được kiểm tra tương thích và phục vụ tận tâm.
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
            <!-- Khi chưa có bài viết -->
            <div style="max-width: 800px; margin: 40px auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 40px 24px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <p style="font-size: 1rem; color: #475569; line-height: 1.85; margin: 0 0 16px;">
                    Danh mục phụ kiện và bảng giá của chuyên mục này đang được đồng bộ, cập nhật chi tiết trên website để đảm bảo độ tương thích chuẩn xác nhất theo từng dòng xe.
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

<?php
get_footer();
