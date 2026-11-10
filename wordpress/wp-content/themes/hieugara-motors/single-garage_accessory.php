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

                    <!-- Trust Bar Under Image -->
                    <div class="acc-trust-strip">
                        <div class="trust-cell">
                            <i class="fa-solid fa-shield-halved text-gold"></i>
                            <div>
                                <strong>100% Chính Hãng</strong>
                                <small>Hoàn tiền 100% nếu phát hiện giả</small>
                            </div>
                        </div>
                        <div class="trust-cell">
                            <i class="fa-solid fa-rotate-left text-gold"></i>
                            <div>
                                <strong>Bảo Hành 1 Đổi 1</strong>
                                <small><?php echo esc_html($warranty); ?></small>
                            </div>
                        </div>
                        <div class="trust-cell">
                            <i class="fa-solid fa-wrench text-gold"></i>
                            <div>
                                <strong>Lắp Đặt Tại Xưởng</strong>
                                <small>Kỹ thuật viên tay nghề cao</small>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications Table -->
                    <?php if (!empty($specs_raw)) : ?>
                    <div class="acc-specs-card">
                        <h2 class="specs-heading"><i class="fa-solid fa-list-check text-gold mr-2"></i> Thông Số Kỹ Thuật Chi Tiết</h2>
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
                        <h2 class="content-heading"><i class="fa-solid fa-circle-info text-gold mr-2"></i> Giới Thiệu &amp; Đánh Giá Chi Tiết</h2>
                        <div class="acc-prose-body">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Workshop Installation Guarantee -->
                    <div class="acc-workshop-guarantee">
                        <h3><i class="fa-solid fa-medal text-gold"></i> Tiêu Chuẩn Thi Công Lắp Đặt Tại Ôtô Hải Hà</h3>
                        <ul>
                            <li><i class="fa-solid fa-check text-green"></i> <strong>Không cắt trích dây zin:</strong> Cắm giắc zin 100% tương thích theo từng đời xe, giữ nguyên chính sách bảo hành điện của hãng xe.</li>
                            <li><i class="fa-solid fa-check text-green"></i> <strong>Cầu chì bảo vệ độc lập:</strong> Trang bị cầu chì an toàn chống chập cháy và tụt áp ắc quy.</li>
                            <li><i class="fa-solid fa-check text-green"></i> <strong>Căn chỉnh chuẩn mực:</strong> Căn góc camera 360/hành trình và kiểm tra áp suất lốp bằng máy đo điện tử chuyên dụng.</li>
                            <li><i class="fa-solid fa-check text-green"></i> <strong>Bảo hành điện tử:</strong> Kích hoạt mã QR bảo hành điện tử toàn quốc, lưu lịch sử sửa chữa minh bạch.</li>
                        </ul>
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

                        <!-- Price Box -->
                        <?php if ($is_vf || $price === 'Liên hệ') : ?>
                            <div class="acc-price-box vf-contact-price-box" style="background: linear-gradient(135deg, rgba(0, 114, 206, 0.08) 0%, rgba(0, 87, 184, 0.03) 100%); border-left: 4px solid #0072ce; padding: 16px 18px; border-radius: 6px; margin: 16px 0;">
                                <div style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.15rem; font-weight: 800; color: #0057b8; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-headset"></i>
                                    <span>LIÊN HỆ BÁO GIÁ VÀ LẮP ĐẶT</span>
                                </div>
                                <small style="display: block; color: #64748b; font-size: 0.82rem; margin-top: 6px; line-height: 1.5;">Tư vấn đúng chủng loại theo từng phiên bản xe – Hỗ trợ kỹ thuật cắm giắc zin tiêu chuẩn nhà máy tại xưởng Ô Tô Hải Hà</small>
                            </div>
                        <?php else : ?>
                            <div class="acc-price-box">
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
                        <div class="acc-cta-stack">
                            <a href="tel:02203892207" class="btn-acc-primary-book" title="Tư vấn lắp đặt phụ kiện này" style="background: #0072ce; color: #ffffff;">
                                <i class="fa-solid fa-phone-volume mr-2"></i>
                                <span>TỔNG ĐÀI TƯ VẤN: 02203 892 207</span>
                            </a>
                            
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="btn-acc-call" title="Gọi hotline tư vấn nhanh">
                                <i class="fa-solid fa-phone-volume mr-2"></i>
                                <span>HOTLINE KỸ THUẬT: <strong><?php echo esc_html($rescue_phone); ?></strong></span>
                            </a>

                            <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="btn-acc-zalo" title="Chat Zalo với kỹ thuật viên" style="background: #0068ff; color: #ffffff;">
                                <i class="fa-solid fa-comment-dots mr-2"></i>
                                <span>CHAT ZALO TƯ VẤN LẮP ĐẶT</span>
                            </a>

                            <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="btn-acc-book-modal" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #0f172a; color: #ffffff; text-decoration: none; padding: 12px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-transform: uppercase;">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>ĐẶT HẸN LẮP ĐẶT TẠI XƯỞNG</span>
                            </a>
                        </div>

                        <!-- Highlights Box -->
                        <div class="acc-perks-box">
                            <h4>ƯU ĐÃI &amp; HỖ TRỢ KÈM THEO:</h4>
                            <ul>
                                <li><i class="fa-solid fa-circle-dot text-gold"></i> Miễn phí công kiểm tra tổng quát xe khi lắp phụ kiện</li>
                                <li><i class="fa-solid fa-circle-dot text-gold"></i> Miễn phí cân chỉnh và hướng dẫn sử dụng chi tiết</li>
                                <li><i class="fa-solid fa-circle-dot text-gold"></i> Hỗ trợ giao hàng COD tận nơi toàn quốc kiểm tra trước khi thanh toán</li>
                            </ul>
                        </div>

                        <!-- Garage Contact Strip -->
                        <div class="acc-garage-contact">
                            <div><i class="fa-solid fa-location-dot text-gold mr-1"></i> Xưởng: Km3 + 500, Nguyễn Lương Bằng, Lê Thanh Nghị, Hải Phòng 170000, Việt Nam</div>
                            <div><i class="fa-solid fa-clock text-gold mr-1"></i> Làm việc: 7h30 - 18h30 (Tất cả các ngày trong tuần)</div>
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
                                <span class="price-current"><?php echo esc_html($rel_price); ?> <sup>đ</sup></span>
                                <?php if (!empty($rel_old)) : ?>
                                    <span class="price-old"><?php echo esc_html($rel_old); ?> <sup>đ</sup></span>
                                <?php endif; ?>
                            </div>

                            <div class="phukien-card-actions">
                                <a href="<?php echo esc_url(get_permalink($rel_id)); ?>" class="btn-pk-book">
                                    Xem Chi Tiết
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

