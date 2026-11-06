<?php
/**
 * Ôtô Hải Hà Service - ShiftUp Flagship Front Page
 * Exact 1:1 Architectural Clone from ShiftUp Car Workshop (Qode Interactive)
 * Minimalist White & Obsidian High-Contrast, Motorsport Typography (Chakra Petch & Be Vietnam Pro)
 *
 * Reordered 6 Primary Homepage Sections:
 * 1. Hero, lợi ích chính và nút liên hệ
 * 2. Câu chuyện 31 năm và các con số nổi bật
 * 3. Lưới dịch vụ (kèm bảng giá niêm yết)
 * 4. Quy trình và năng lực xưởng bằng ảnh thật
 * 5. Các dòng xe phục vụ
 * 6. Bản đồ, địa chỉ và form đặt lịch
 *
 * @package HieuGara_Motors
 */

get_header();
$theme_uri     = get_template_directory_uri();
$shiftup_img   = $theme_uri . '/assets/images/shiftup';
$slider_img    = $theme_uri . '/assets/images/slider';
$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$tech_phone    = get_option('hieugara_tech_phone', '0915 041 989');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$warranty_url  = get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
?>

<main id="primary" class="site-main shiftup-main-page">

    <!-- =========================================================================
         MỤC 1: HERO, LỢI ÍCH CHÍNH VÀ NÚT LIÊN HỆ
         ========================================================================= -->
    <!-- 1A: HERO SLIDER -->
    <?php
    $slides = function_exists('hieugara_get_slides') ? hieugara_get_slides() : array();
    $active_slides = array();
    if (!empty($slides)) {
        foreach ($slides as $idx => $s) {
            if (!empty($s['enable'])) {
                $active_slides[] = $s;
            }
        }
    }
    if (empty($active_slides) && function_exists('hieugara_get_default_slides')) {
        $active_slides = array_values(hieugara_get_default_slides());
    }
    ?>
    <section class="lexus-banner-slider" id="lexusHeroSlider">
        <div class="lexus-slides-container">
            <?php foreach ($active_slides as $i => $s) : ?>
            <div class="lexus-slide <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>">
                <div class="lexus-slide-bg" style="background-image: url('<?php echo esc_url(add_query_arg('v', HIEUGARA_THEME_VERSION, $s['image'])); ?>');"></div>
                <div class="lexus-slide-overlay"></div>
                <div class="container lexus-slide-container">
                    <div class="lexus-slide-content">
                        <?php if (!empty($s['eyebrow'])) : ?>
                        <div class="lexus-eyebrow">
                            <span class="lexus-gold-bar"></span>
                            <span><?php echo esc_html($s['eyebrow']); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($i === 0) : ?>
                        <h1 class="lexus-slide-title">
                            <?php echo esc_html($s['title']); ?>
                        </h1>
                        <?php else : ?>
                        <h2 class="lexus-slide-title">
                            <?php echo esc_html($s['title']); ?>
                        </h2>
                        <?php endif; ?>

                        <?php if (!empty($s['desc'])) : ?>
                        <p class="lexus-slide-desc">
                            <?php echo esc_html($s['desc']); ?>
                        </p>
                        <?php endif; ?>

                        <?php if (!empty($s['btn_text'])) : ?>
                        <div class="lexus-slide-actions">
                            <a href="<?php echo esc_url(!empty($s['btn_url']) ? $s['btn_url'] : home_url('/bang-gia/')); ?>" class="lexus-outline-btn">
                                <span><?php echo esc_html($s['btn_text']); ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Lexus Navigation Chevrons -->
        <button class="lexus-nav-arrow lexus-prev-btn" id="lexusPrevBtn" aria-label="Slide trước">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button class="lexus-nav-arrow lexus-next-btn" id="lexusNextBtn" aria-label="Slide tiếp theo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>

        <!-- Lexus Horizontal Dash Pagination Bar (Exact Lexus Vietnam Style) -->
        <div class="lexus-pagination-bar">
            <div class="container lexus-pagination-inner">
                <?php foreach ($active_slides as $i => $s) : ?>
                <button class="lexus-dash-item <?php echo $i === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $i; ?>" aria-label="<?php echo esc_attr($s['title']); ?>">
                    <span class="dash-index"><?php echo sprintf('%02d', $i + 1); ?></span>
                    <span class="dash-label"><?php echo esc_html($s['title']); ?></span>
                    <span class="dash-progress-line"><span class="dash-fill"></span></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         MỤC 2: CÁC CON SỐ NỔI BẬT
         ========================================================================= -->
    <section class="shiftup-technicians-section" id="cau-chuyen-31-nam">
        <div class="container">

            <!-- 4 CON SỐ NỔI BẬT (MILESTONE STAT COUNTERS) -->
            <div class="milestone-stats-grid">
                <div class="milestone-stat-card">
                    <div class="stat-number-wrap">
                        <span class="stat-number">31</span><span class="stat-plus">+</span>
                    </div>
                    <div class="stat-divider"></div>
                    <h4 class="stat-title">NĂM UY TÍN (1995 - 2026)</h4>
                    <p class="stat-desc">Garage gia truyền lâu đời nhất, khẳng định chất lượng qua 3 thập kỷ phục vụ tận tâm.</p>
                </div>

                <div class="milestone-stat-card">
                    <div class="stat-number-wrap">
                        <span class="stat-number">80</span><span class="stat-plus">+</span>
                    </div>
                    <div class="stat-divider"></div>
                    <h4 class="stat-title">NHÂN SỰ &amp; KỸ THUẬT VIÊN</h4>
                    <p class="stat-desc">100% thợ có chứng chỉ tay nghề cao, được đào tạo bài bản và chuyên môn hóa từng khoang.</p>
                </div>

                <div class="milestone-stat-card">
                    <div class="stat-number-wrap">
                        <span class="stat-number">28</span><span class="stat-plus">+</span>
                    </div>
                    <div class="stat-divider"></div>
                    <h4 class="stat-title">CẦU NÂNG &amp; KHOANG KỸ THUẬT</h4>
                    <p class="stat-desc">Mặt bằng xưởng quy mô 2.500m², đầy đủ khoang chẩn đoán, cân lái 3D và buồng sấy hấp.</p>
                </div>

                <div class="milestone-stat-card">
                    <div class="stat-number-wrap">
                        <span class="stat-number">35.000</span><span class="stat-plus">+</span>
                    </div>
                    <div class="stat-divider"></div>
                    <h4 class="stat-title">LƯỢT XE TIN CHỌN HÀNG NĂM</h4>
                    <p class="stat-desc">Tỉ lệ khách hàng quay lại định kỳ đạt trên 92%, là đối tác bảo dưỡng của nhiều đội xe lớn.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 4: QUY TRÌNH VÀ NĂNG LỰC XƯỞNG BẰNG ẢNH THẬT
         ========================================================================= -->
    <!-- 4A: 4 FULL-WIDTH PANORAMIC REAL PHOTO BANNERS -->
    <section class="shiftup-panoramic-banners" id="quy-trinh-nang-luc">
        <div class="pano-banners-grid">

            <?php
            $pano_banners = function_exists('hieugara_get_pano_banners') ? hieugara_get_pano_banners() : array();
            foreach ($pano_banners as $p) :
            ?>
                <div class="pano-banner-col">
                    <div class="pano-bg-img pano-bg-desktop" style="background-image: url('<?php echo esc_url($p['img']); ?>');"></div>
                    <div class="pano-bg-img pano-bg-mobile" style="background-image: url('<?php echo esc_url($p['img_mobile']); ?>');"></div>
                    <div class="pano-base-overlay"></div>
                    <div class="pano-blur-overlay"></div>
                    <a href="<?php echo esc_url($p['link']); ?>" class="pano-full-link" aria-label="<?php echo esc_attr($p['title']); ?>"></a>

                    <div class="pano-content-wrap">
                        <div class="pano-content-inner">
                            <div class="pano-title-wrap">
                                <h3 class="pano-title pano-title-ghost"><?php echo esc_html($p['title']); ?></h3>
                                <h3 class="pano-title pano-title-slide"><?php echo esc_html($p['title']); ?></h3>
                            </div>
                            <div class="pano-text-wrap">
                                <p class="pano-text pano-text-ghost"><?php echo esc_html($p['desc']); ?></p>
                                <p class="pano-text pano-text-slide"><?php echo esc_html($p['desc']); ?></p>
                            </div>
                        </div>

                        <div class="pano-btn-wrap">
                            <a href="<?php echo esc_url($p['link']); ?>" class="pano-action-btn" aria-label="<?php echo esc_attr($p['title']); ?>">
                                <span class="btn-plus-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 4B: GALLERY - HÌNH ẢNH ÔTÔ HẢI HÀ (PRESTIGE AUTOMOBILE STYLE)
         ========================================================================= -->
    <section class="shiftup-gallery-section" id="hinh-anh-oto-hai-ha">
        <div class="container">
            <div class="gallery-sec-head text-center">
                <h5 class="gallery-eyebrow">GALLERY</h5>
                <h2 class="gallery-heading-main">
                    <strong>HÌNH ẢNH <span class="text-orange">ÔTÔ HẢI HÀ</span></strong>
                </h2>
                <div class="gallery-heading-divider"></div>
            </div>

            <?php
            $raw_gallery = function_exists('hieugara_get_gallery_items') ? hieugara_get_gallery_items() : array();
            $gallery_items = array();
            if (!empty($raw_gallery)) {
                foreach ($raw_gallery as $g_item) {
                    if (!empty($g_item['enable']) && !empty($g_item['img'])) {
                        $gallery_items[] = $g_item;
                    }
                }
            }
            ?>

            <div class="prestige-gallery-grid">
                <?php foreach ($gallery_items as $idx => $g) : ?>
                    <div class="prestige-gallery-col">
                        <a href="<?php echo esc_url($g['img']); ?>" class="prestige-gallery-box" data-gallery-idx="<?php echo $idx; ?>" title="<?php echo esc_attr($g['title']); ?>">
                            <div class="prestige-gallery-img-wrap">
                                <img src="<?php echo esc_url($g['img']); ?>" alt="<?php echo esc_attr($g['title']); ?>" loading="lazy" decoding="async">
                                <div class="prestige-gallery-overlay">
                                    <span class="gallery-zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                                    <span class="gallery-caption-text"><?php echo esc_html($g['title']); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Lightbox Modal for Gallery -->
        <div class="haiha-gallery-lightbox" id="haihaGalleryLightbox" aria-hidden="true">
            <button type="button" class="lightbox-close-btn" id="haihaLightboxClose" aria-label="Đóng ảnh">&times;</button>
            <button type="button" class="lightbox-nav-btn lightbox-prev" id="haihaLightboxPrev" aria-label="Ảnh trước"><i class="fa-solid fa-chevron-left"></i></button>
            <div class="lightbox-Stage">
                <img src="" alt="" id="haihaLightboxImg">
                <div class="lightbox-caption" id="haihaLightboxCaption"></div>
            </div>
            <button type="button" class="lightbox-nav-btn lightbox-next" id="haihaLightboxNext" aria-label="Ảnh tiếp theo"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var boxes = Array.prototype.slice.call(document.querySelectorAll('.prestige-gallery-box'));
            var lightbox = document.getElementById('haihaGalleryLightbox');
            var lbImg = document.getElementById('haihaLightboxImg');
            var lbCap = document.getElementById('haihaLightboxCaption');
            var btnClose = document.getElementById('haihaLightboxClose');
            var btnPrev = document.getElementById('haihaLightboxPrev');
            var btnNext = document.getElementById('haihaLightboxNext');
            var currentIdx = 0;

            if (!boxes.length || !lightbox) return;

            function showImage(idx) {
                currentIdx = (idx + boxes.length) % boxes.length;
                var target = boxes[currentIdx];
                lbImg.src = target.getAttribute('href');
                lbCap.textContent = target.getAttribute('title') || '';
                lightbox.classList.add('is-open');
                lightbox.setAttribute('aria-hidden', 'false');
            }

            function closeLightbox() {
                lightbox.classList.remove('is-open');
                lightbox.setAttribute('aria-hidden', 'true');
                lbImg.src = '';
            }

            boxes.forEach(function(box, i) {
                box.addEventListener('click', function(e) {
                    e.preventDefault();
                    showImage(i);
                });
            });

            btnClose.addEventListener('click', closeLightbox);
            btnPrev.addEventListener('click', function(e) { e.stopPropagation(); showImage(currentIdx - 1); });
            btnNext.addEventListener('click', function(e) { e.stopPropagation(); showImage(currentIdx + 1); });
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) closeLightbox();
            });
            document.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('is-open')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') showImage(currentIdx - 1);
                if (e.key === 'ArrowRight') showImage(currentIdx + 1);
            });
        });
        </script>
    </section>

    <!-- =========================================================================
         MỤC 4C: PHỤ KIỆN ÔTÔ CHÍNH HÃNG (HÀ THÀNH GARAGE STYLE)
         ========================================================================= -->
    <section class="shiftup-accessories-section index-accessory" id="phu-kien-chinh-hang">
        <div class="container">
            
            <div class="accessory-sec-head text-center">
                <h2 class="accessory-heading-main">
                    <span>PHỤ KIỆN ÔTÔ</span> <span class="text-orange">CHÍNH HÃNG</span>
                </h2>
                <div class="tuning-shop-divider"></div>
            </div>

            <?php
            $raw_accessories = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
            $accessories = array();
            foreach ($raw_accessories as $a_it) {
                if (!empty($a_it['enable'])) {
                    $accessories[] = $a_it;
                }
            }
            ?>

            <div class="accessory-slider-wrap">
                <button class="acc-nav-btn acc-prev" id="allCarsPrevBtn" aria-label="Trước">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="swiper all-about-swiper" id="allCarsTrack">
                    <div class="swiper-wrapper">
                        <?php foreach ($accessories as $acc) : ?>
                            <div class="swiper-slide">
                                <article class="accessory-item">
                                    <a href="<?php echo esc_url($acc['link']); ?>" title="<?php echo esc_attr($acc['title']); ?>" class="accessory-img-box">
                                        <?php if (!empty($acc['badge'])) : ?>
                                            <span class="accessory-badge"><?php echo esc_html($acc['badge']); ?></span>
                                        <?php endif; ?>
                                        <img src="<?php echo esc_url($acc['img']); ?>" alt="<?php echo esc_attr($acc['title']); ?>" loading="lazy">
                                    </a>
                                    <h3 class="accessory-title">
                                        <a href="<?php echo esc_url($acc['link']); ?>" title="<?php echo esc_attr($acc['title']); ?>">
                                            <?php echo esc_html($acc['title']); ?>
                                        </a>
                                    </h3>
                                    <div class="accessory-price">
                                        <span class="price-current"><?php echo esc_html($acc['price']); ?> <sup>đ</sup></span>
                                        <?php if (!empty($acc['old_price'])) : ?>
                                            <span class="price-old"><?php echo esc_html($acc['old_price']); ?> <sup>đ</sup></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="accessory-action">
                                        <a href="<?php echo esc_url($acc['link']); ?>" title="<?php echo esc_attr($acc['title']); ?>" class="btn-accessory-detail">
                                            Chi tiết
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button class="acc-nav-btn acc-next" id="allCarsNextBtn" aria-label="Tiếp theo">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 5: CÁC DÒNG XE PHỤC VỤ (BRAND MARQUEE)
         ========================================================================= -->
    <section class="shiftup-brand-marquee-section" id="dong-xe-phuc-vu">
        <div class="container">
            <div class="marquee-head text-center">
                <span class="marquee-sub"><?php _e('CÁC DÒNG XE PHỤC VỤ TẠI XƯỞNG', 'hieugara-motors'); ?></span>
                <h3 class="marquee-title"><?php _e('TIẾP NHẬN BẢO DƯỠNG &amp; SỬA CHỮA MỌI THƯƠNG HIỆU XE', 'hieugara-motors'); ?></h3>
            </div>
        </div>

        <div class="marquee-strip-wrap">
            <div class="brand-marquee">
                <div class="brand-marquee-track">
                    <?php
                    $brands = array(
                        array('name' => 'Mercedes-Benz', 'logo' => $theme_uri . '/assets/images/brands/mercedes.svg', 'grad' => 'linear-gradient(135deg, rgba(0,0,0,0.06), rgba(0,0,0,0.12))'),
                        array('name' => 'BMW',           'logo' => $theme_uri . '/assets/images/brands/bmw.svg',      'grad' => 'linear-gradient(135deg, rgba(0,102,177,0.08), rgba(0,102,177,0.15))'),
                        array('name' => 'Audi',          'logo' => $theme_uri . '/assets/images/brands/audi.svg',     'grad' => 'linear-gradient(135deg, rgba(187,10,48,0.08), rgba(0,0,0,0.12))'),
                        array('name' => 'Porsche',       'logo' => $theme_uri . '/assets/images/brands/porsche.svg',  'grad' => 'linear-gradient(135deg, rgba(213,0,0,0.08), rgba(255,215,0,0.12))'),
                        array('name' => 'Lexus',         'logo' => $theme_uri . '/assets/images/brands/lexus.svg',    'grad' => 'linear-gradient(135deg, rgba(30,30,30,0.08), rgba(200,200,200,0.12))'),
                        array('name' => 'Toyota',        'logo' => $theme_uri . '/assets/images/brands/toyota.svg',   'grad' => 'linear-gradient(135deg, rgba(235,10,30,0.08), rgba(0,0,0,0.1))'),
                        array('name' => 'Hyundai',       'logo' => $theme_uri . '/assets/images/brands/hyundai.svg',  'grad' => 'linear-gradient(135deg, rgba(0,44,95,0.08), rgba(0,44,95,0.15))'),
                        array('name' => 'Ford',          'logo' => $theme_uri . '/assets/images/brands/ford.svg',     'grad' => 'linear-gradient(135deg, rgba(0,52,120,0.08), rgba(0,52,120,0.15))'),
                        array('name' => 'Honda',         'logo' => $theme_uri . '/assets/images/brands/honda.svg',    'grad' => 'linear-gradient(135deg, rgba(204,0,0,0.08), rgba(0,0,0,0.1))'),
                        array('name' => 'Volkswagen',    'logo' => $theme_uri . '/assets/images/brands/volkswagen.svg', 'grad' => 'linear-gradient(135deg, rgba(0,30,80,0.08), rgba(0,30,80,0.15))'),
                        array('name' => 'Nissan',        'logo' => $theme_uri . '/assets/images/brands/nissan.svg',   'grad' => 'linear-gradient(135deg, rgba(195,0,25,0.08), rgba(0,0,0,0.1))'),
                        array('name' => 'Bosch',         'logo' => $theme_uri . '/assets/images/brands/bosch.svg',    'grad' => 'linear-gradient(135deg, rgba(234,0,41,0.08), rgba(0,0,0,0.1))'),
                    );
                    ?>
                    <div class="brand-marquee-group">
                        <?php foreach ($brands as $b) : ?>
                            <div class="brand-capsule-card" title="<?php echo esc_attr($b['name']); ?>">
                                <div class="capsule-gradient-bg" style="background: <?php echo esc_attr($b['grad']); ?>;"></div>
                                <img src="<?php echo esc_url($b['logo']); ?>" alt="<?php echo esc_attr($b['name']); ?>" loading="lazy" class="brand-logo-img">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="brand-marquee-group" aria-hidden="true">
                        <?php foreach ($brands as $b) : ?>
                            <div class="brand-capsule-card" title="<?php echo esc_attr($b['name']); ?>">
                                <div class="capsule-gradient-bg" style="background: <?php echo esc_attr($b['grad']); ?>;"></div>
                                <img src="<?php echo esc_url($b['logo']); ?>" alt="<?php echo esc_attr($b['name']); ?>" loading="lazy" class="brand-logo-img">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
