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

<!-- =========================================================================
     HERO BANNER: PHỤ KIỆN CHÍNH HÃNG VINFAST (VinFast Blue Theme Accent)
     ========================================================================= -->
<section class="vf-hero-section">
    <div class="vf-hero-overlay"></div>
    <div class="container vf-hero-container">
        <nav class="vf-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>"><?php _e('Phụ kiện ô tô', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current"><?php _e('Phụ kiện VinFast', 'hieugara-motors'); ?></span>
        </nav>

        <div class="vf-hero-content text-center">
            <div class="vf-hero-badge">
                <i class="fa-solid fa-shield-halved"></i> ĐỐI TÁC DỊCH VỤ CHÍNH HÃNG VINFAST
            </div>
            <h1 class="vf-hero-title">
                Phụ kiện chính hãng VinFast tại Ô Tô Hải Hà
            </h1>
            <p class="vf-hero-subtitle">
                Hệ sinh thái phụ kiện ô tô điện chuẩn hãng VinFast – Lắp đặt cắm giắc zin 100%, bảo hành chính hãng, kỹ thuật viên được chứng nhận tiêu chuẩn VinFast.
            </p>
            <div class="vf-hero-actions">
                <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="btn-vf-primary">
                    <i class="fa-solid fa-phone"></i>
                    <span>Liên hệ tư vấn lắp đặt: <?php echo esc_html($hotline_phone); ?></span>
                </a>
                <a href="#vf-product-grid-section" class="btn-vf-secondary">
                    <span>Xem danh mục phụ kiện</span>
                    <i class="fa-solid fa-arrow-down"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     MAIN CONTENT & INTERACTIVE FILTER CHIPS
     ========================================================================= -->
<main id="primary" class="site-main page-vf-portal">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">

        <!-- FILTER TOOLBAR -->
        <div class="vf-filter-card" id="vf-filter-card">
            <!-- Filter by Model -->
            <div class="vf-filter-group">
                <div class="vf-filter-label">
                    <i class="fa-solid fa-car-side"></i> <strong>Lọc theo dòng xe:</strong>
                </div>
                <div class="vf-filter-chips" id="vfModelChips">
                    <button type="button" class="vf-chip active" data-filter="all">Tất cả xe (<?php echo count($vf_posts); ?>)</button>
                    <?php foreach ($models_list as $m_name) : ?>
                        <button type="button" class="vf-chip" data-model="<?php echo esc_attr($m_name); ?>">
                            <?php echo esc_html($m_name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Filter by 7 Categories -->
            <div class="vf-filter-group" style="margin-top: 14px; padding-top: 14px; border-top: 1px dashed #e2e8f0;">
                <div class="vf-filter-label">
                    <i class="fa-solid fa-layer-group"></i> <strong>Nhóm phụ kiện Hải Hà:</strong>
                </div>
                <div class="vf-filter-chips" id="vfCategoryChips">
                    <button type="button" class="vf-chip active" data-cat="all">Tất cả nhóm</button>
                    <?php foreach ($categories_list as $cat_label) : ?>
                        <button type="button" class="vf-chip" data-cat="<?php echo esc_attr($cat_label); ?>">
                            <?php echo esc_html($cat_label); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Result Count & Reset -->
            <div class="vf-filter-status">
                <span id="vfCountDisplay">Đang hiển thị <strong><?php echo count($vf_posts); ?></strong> phụ kiện chính hãng</span>
                <button type="button" id="vfResetFilters" class="vf-btn-reset" style="display: none;">
                    <i class="fa-solid fa-rotate-left"></i> Đặt lại bộ lọc
                </button>
            </div>
        </div>

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
/* VinFast Official Brand Styling */
.vf-hero-section {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #002d62 50%, #0057b8 100%);
    color: #ffffff;
    padding: 60px 0 70px;
    border-bottom: 3px solid #0072ce;
}
.vf-breadcrumb {
    font-size: 0.85rem;
    margin-bottom: 24px;
    color: rgba(255,255,255,0.7);
}
.vf-breadcrumb a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    transition: color 0.2s;
}
.vf-breadcrumb a:hover {
    color: #60a5fa;
}
.vf-breadcrumb .sep {
    margin: 0 8px;
    color: rgba(255,255,255,0.4);
}
.vf-breadcrumb .current {
    color: #ffffff;
    font-weight: 700;
}
.vf-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 114, 206, 0.35);
    border: 1px solid rgba(96, 165, 250, 0.45);
    padding: 6px 16px;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: #bfdbfe;
    margin-bottom: 16px;
    text-transform: uppercase;
}
.vf-hero-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: clamp(1.8rem, 3.5vw, 2.7rem);
    font-weight: 800;
    line-height: 1.25;
    margin: 0 auto 16px;
    max-width: 900px;
    color: #ffffff;
}
.vf-hero-subtitle {
    font-size: clamp(0.95rem, 1.5vw, 1.1rem);
    color: #cbd5e1;
    max-width: 780px;
    margin: 0 auto 28px;
    line-height: 1.65;
}
.vf-hero-actions {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}
.btn-vf-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #0072ce;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(0, 114, 206, 0.4);
    border: none;
    cursor: pointer;
}
.btn-vf-primary:hover {
    background: #0057b8;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 114, 206, 0.5);
}
.btn-vf-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    color: #ffffff;
    border: 1px solid rgba(255,255,255,0.25);
    padding: 12px 20px;
    border-radius: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
}
.btn-vf-secondary:hover {
    background: rgba(255,255,255,0.2);
    color: #ffffff;
}

/* Filter Card */
.page-vf-portal {
    background: #f8fafc;
    padding: 40px 0 80px;
    min-height: 60vh;
}
.vf-filter-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 28px;
    margin-bottom: 35px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
}
.vf-filter-label {
    font-size: 0.88rem;
    color: #334155;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.vf-filter-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.vf-chip {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #cbd5e1;
    padding: 6px 14px;
    border-radius: 20px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
.vf-chip:hover {
    background: #e2e8f0;
    border-color: #94a3b8;
    color: #0f172a;
}
.vf-chip.active {
    background: #0072ce;
    color: #ffffff;
    border-color: #0072ce;
    box-shadow: 0 2px 8px rgba(0, 114, 206, 0.3);
}
.vf-filter-status {
    margin-top: 16px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.86rem;
    color: #64748b;
}
.vf-btn-reset {
    background: none;
    border: none;
    color: #0072ce;
    font-weight: 700;
    font-size: 0.84rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
}
.vf-btn-reset:hover {
    text-decoration: underline;
}

/* Products Grid */
.vf-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
}
@media (max-width: 1200px) {
    .vf-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .vf-products-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .vf-filter-card { padding: 16px; }
}
@media (max-width: 480px) {
    .vf-products-grid { grid-template-columns: 1fr; }
}

/* Product Card */
.vf-product-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 3px 12px rgba(0,0,0,0.03);
    transition: all 0.25s ease;
}
.vf-product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.08);
    border-color: #93c5fd;
}
.vf-card-thumb {
    position: relative;
    height: 200px;
    background: #f8fafc;
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
    background: #0072ce;
    color: #ffffff;
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
    padding: 16px;
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
    color: #0369a1;
    background: #e0f2fe;
    padding: 2px 8px;
    border-radius: 3px;
}
.vf-card-title {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 0.95rem;
    font-weight: 800;
    line-height: 1.4;
    margin: 0 0 10px;
    color: #0f172a;
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
    color: #0072ce;
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
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    padding: 2px 6px;
    border-radius: 3px;
}
.vf-card-excerpt {
    font-size: 0.82rem;
    color: #64748b;
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
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
    margin-top: auto;
}
.vf-btn-detail {
    flex: 1;
    text-align: center;
    padding: 8px 10px;
    background: #f8fafc;
    color: #1e293b;
    border: 1px solid #cbd5e1;
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
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
}
.vf-btn-contact {
    flex: 1;
    text-align: center;
    padding: 8px 10px;
    background: #0072ce;
    color: #ffffff;
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
.vf-btn-contact:hover {
    background: #0057b8;
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
    color: #0f172a;
    margin-bottom: 8px;
}
.vf-no-products p {
    font-size: 0.95rem;
    color: #64748b;
    max-width: 500px;
    margin: 0 auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modelChips = document.querySelectorAll('#vfModelChips .vf-chip');
    const catChips = document.querySelectorAll('#vfCategoryChips .vf-chip');
    const products = document.querySelectorAll('.vf-product-card');
    const countDisplay = document.getElementById('vfCountDisplay');
    const resetBtn = document.getElementById('vfResetFilters');
    const emptyMsg = document.getElementById('vfEmptyFilterMsg');
    const resetEmptyBtn = document.getElementById('vfResetFromEmpty');

    let selectedModel = 'all';
    let selectedCat = 'all';

    function filterProducts() {
        let visibleCount = 0;

        products.forEach(card => {
            const cardModels = (card.getAttribute('data-models') || '').split('|');
            const cardCat = card.getAttribute('data-cat') || '';

            const matchModel = (selectedModel === 'all') || 
                               cardModels.includes(selectedModel) || 
                               cardModels.includes('Tất cả xe điện');

            const matchCat = (selectedCat === 'all') || (cardCat === selectedCat);

            if (matchModel && matchCat) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (countDisplay) {
            countDisplay.innerHTML = 'Đang hiển thị <strong>' + visibleCount + '</strong> phụ kiện phù hợp';
        }

        if (visibleCount === 0) {
            if (emptyMsg) emptyMsg.style.display = 'block';
        } else {
            if (emptyMsg) emptyMsg.style.display = 'none';
        }

        if (selectedModel !== 'all' || selectedCat !== 'all') {
            if (resetBtn) resetBtn.style.display = 'inline-flex';
        } else {
            if (resetBtn) resetBtn.style.display = 'none';
        }
    }

    modelChips.forEach(chip => {
        chip.addEventListener('click', function() {
            modelChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            selectedModel = this.getAttribute('data-model') || 'all';
            filterProducts();
        });
    });

    catChips.forEach(chip => {
        chip.addEventListener('click', function() {
            catChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            selectedCat = this.getAttribute('data-cat') || 'all';
            filterProducts();
        });
    });

    function resetAll() {
        selectedModel = 'all';
        selectedCat = 'all';
        modelChips.forEach(c => c.classList.remove('active'));
        catChips.forEach(c => c.classList.remove('active'));
        if (modelChips[0]) modelChips[0].classList.add('active');
        if (catChips[0]) catChips[0].classList.add('active');
        filterProducts();
    }

    if (resetBtn) resetBtn.addEventListener('click', resetAll);
    if (resetEmptyBtn) resetEmptyBtn.addEventListener('click', resetAll);
});
</script>

<?php get_footer(); ?>

