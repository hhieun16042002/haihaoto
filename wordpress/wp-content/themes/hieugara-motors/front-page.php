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
                    <div class="dash-meta">
                        <span class="dash-num"><?php echo sprintf('%02d', $i + 1); ?></span>
                        <span class="dash-label"><?php echo esc_html(!empty($s['nav_tab']) ? $s['nav_tab'] : $s['title']); ?></span>
                    </div>
                    <span class="dash-progress-track"><span class="dash-progress-fill"></span></span>
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
         MỤC 4B: VỀ ÔTÔ HẢI HÀ & SỨ MỆNH (KOBAC CARS STYLE - 3 ẢNH THỰC TẾ)
         ========================================================================= -->
    <?php
    $kobac_imgs = function_exists('hieugara_get_about_kobac_images') ? hieugara_get_about_kobac_images() : array(
        'img_1' => $theme_uri . '/assets/images/about/haiha-about-facade.jpg',
        'img_2' => $theme_uri . '/assets/images/about/haiha-about-workshop.jpg',
        'img_3' => $theme_uri . '/assets/images/about/haiha-about-paintbooth.jpg',
    );
    ?>
    <section class="kobac-about-mission-section" id="ve-oto-hai-ha">
        <div class="kobac-bg-pattern" aria-hidden="true"></div>
        <div class="container">

            <!-- ROW 1: VỀ ÔTÔ HẢI HÀ (Text Left - Image 1 Right on Desktop | Heading -> Image 1 -> Text on Mobile) -->
            <div class="kobac-split-row kobac-row-about">
                <div class="kobac-col kobac-col-text kobac-anim-left">
                    <div class="kobac-head-block">
                        <h2 class="kobac-heading">VỀ ÔTÔ HẢI HÀ</h2>
                    </div>

                    <!-- Mobile-only Inline Image 1 right under Heading for native mobile editorial flow -->
                    <div class="kobac-mobile-inline-media">
                        <figure class="kobac-photo-card kobac-mobile-hero-card">
                            <img src="<?php echo esc_url($kobac_imgs['img_1']); ?>" alt="Mặt tiền Trung tâm Bảo dưỡng &amp; Sửa chữa Ôtô Hải Hà" loading="lazy" decoding="async">
                            <figcaption class="kobac-floating-badge">
                                <i class="fa-solid fa-location-dot"></i> Trung Tâm Bảo Dưỡng &amp; Sửa Chữa Ôtô Hải Hà
                            </figcaption>
                        </figure>
                    </div>

                    <div class="kobac-prose">
                        <p>Chúng tôi hiểu rằng, mỗi chiếc xe là một phần quan trọng của cuộc sống, mang theo những hành trình, kỷ niệm và sự an toàn của cả gia đình. Chính vì lý do đó, Ôtô Hải Hà đã dành hơn 31 năm (từ năm 1995) để không ngừng đổi mới và hoàn thiện nghệ thuật chăm sóc, bảo dưỡng và sửa chữa xe hơi, đặt sự chính xác và chữ Tâm người thợ làm kim chỉ nam.</p>
                        <p>Chúng tôi tiên phong đầu tư hệ thống trang thiết bị chẩn đoán hiện đại, chuẩn hóa quy trình bảo dưỡng và đồng sơn công nghệ cao nhằm tối ưu tốc độ và chất lượng dịch vụ mà vẫn giữ vững chuẩn mực khắt khe nhất. Với quy mô xưởng 2.500m², 28 khoang cầu nâng chuyên dụng và đội ngũ hơn 80 kỹ thuật viên lành nghề, Ôtô Hải Hà đã trở thành trung tâm bảo dưỡng – sửa chữa ô tô uy tín hàng đầu, khẳng định vị thế vững chắc trong lòng hàng chục nghìn chủ xe.</p>
                        <p>Lý do Ôtô Hải Hà tồn tại và phát triển bền vững suốt hơn 3 thập kỷ thật đơn giản: mang lại sự an tâm tuyệt đối cho chủ xe thông qua một dịch vụ minh bạch, không chỉ đạt chuẩn mà còn vượt qua mong đợi.</p>
                    </div>
                    <div class="kobac-btn-wrap kobac-desktop-only-btn">
                        <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="kobac-cta-btn">
                            <span>Về chúng tôi</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="kobac-col kobac-col-media kobac-anim-right kobac-desktop-media">
                    <div class="kobac-single-media-wrap">
                        <div class="kobac-decor-grid" aria-hidden="true"></div>
                        <figure class="kobac-photo-card kobac-photo-main-1">
                            <img src="<?php echo esc_url($kobac_imgs['img_1']); ?>" alt="Mặt tiền Trung tâm Bảo dưỡng &amp; Sửa chữa Ôtô Hải Hà" loading="lazy" decoding="async">
                            <figcaption class="kobac-floating-badge">
                                <i class="fa-solid fa-location-dot"></i> Trung Tâm Bảo Dưỡng &amp; Sửa Chữa Ôtô Hải Hà
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>

            <!-- ROW 2: SỨ MỆNH (Images 2 & 3 Left - Text Right on Desktop | Heading -> Bento Images 2 & 3 -> Text on Mobile) -->
            <div class="kobac-split-row kobac-row-mission">
                <div class="kobac-col kobac-col-media kobac-anim-left kobac-desktop-media">
                    <div class="kobac-dual-media-wrap">
                        <div class="kobac-decor-grid kobac-decor-left" aria-hidden="true"></div>
                        <figure class="kobac-photo-card kobac-photo-main-2">
                            <img src="<?php echo esc_url($kobac_imgs['img_2']); ?>" alt="Toàn cảnh khu vực xưởng dịch vụ quy mô 2.500m² tại Ôtô Hải Hà" loading="lazy" decoding="async">
                        </figure>
                        <figure class="kobac-photo-card kobac-photo-floating-3">
                            <img src="<?php echo esc_url($kobac_imgs['img_3']); ?>" alt="Phòng sơn sấy hồng ngoại tiêu chuẩn Châu Âu tại Ôtô Hải Hà" loading="lazy" decoding="async">
                            <figcaption class="kobac-floating-badge">
                                <i class="fa-solid fa-fire-flame-curved"></i> Phòng Sơn Sấy Hồng Ngoại Châu Âu
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="kobac-col kobac-col-text kobac-anim-right">
                    <div class="kobac-head-block">
                        <h2 class="kobac-heading">SỨ MỆNH</h2>
                    </div>

                    <!-- Mobile-only Bento Dual Media Grid right under Heading -->
                    <div class="kobac-mobile-inline-media">
                        <div class="kobac-mobile-bento-grid">
                            <figure class="kobac-photo-card kobac-bento-item">
                                <img src="<?php echo esc_url($kobac_imgs['img_2']); ?>" alt="Toàn cảnh khu vực xưởng dịch vụ quy mô 2.500m² tại Ôtô Hải Hà" loading="lazy" decoding="async">
                                <figcaption class="kobac-bento-cap"><i class="fa-solid fa-warehouse"></i> Xưởng Dịch Vụ 2.500m²</figcaption>
                            </figure>
                            <figure class="kobac-photo-card kobac-bento-item">
                                <img src="<?php echo esc_url($kobac_imgs['img_3']); ?>" alt="Phòng sơn sấy hồng ngoại tiêu chuẩn Châu Âu tại Ôtô Hải Hà" loading="lazy" decoding="async">
                                <figcaption class="kobac-bento-cap"><i class="fa-solid fa-fire-flame-curved"></i> Phòng Sơn Sấy Hồng Ngoại</figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="kobac-prose">
                        <p>Chúng tôi nhận thấy rằng tại thị trường Việt Nam, chủ xe thường phải đối mặt với nỗi lo về sự minh bạch trong báo giá, nguồn gốc phụ tùng không rõ ràng và chất lượng dịch vụ thiếu nhất quán. Đây là những rào cản lớn đối với sự an tâm khi sở hữu và bảo dưỡng xe.</p>
                        <blockquote class="kobac-quote-box">
                            Tại Ôtô Hải Hà, chúng tôi tin tưởng tuyệt đối vào triết lý: “Giấc mơ và uy tín được vẽ bằng trái tim người thợ thì nhất định sẽ chạm tới niềm tin trọn vẹn của khách hàng.”
                        </blockquote>
                        <p>Sứ mệnh của Ôtô Hải Hà là biến niềm tin này thành hành động thực tiễn trên từng chiếc xe xuất xưởng. Chúng tôi cam kết mang đến sự chăm sóc, bảo dưỡng, sửa chữa máy gầm và đồng sơn đạt chuẩn mực cao nhất, không chỉ dựa trên quy trình kỹ thuật nghiêm ngặt mà còn dựa trên sự chính trực và tận tâm tuyệt đối.</p>
                        <p>Chúng tôi không chỉ bảo dưỡng và sửa chữa xe; chúng tôi kiến tạo những hành trình bình an, nâng cao tuổi thọ và giá trị bền vững cho tài sản quý giá này. Mục tiêu cuối cùng là mang lại sự an tâm tuyệt đối cho chủ xe thông qua một dịch vụ không chỉ đạt chuẩn mà còn vượt qua mong đợi.</p>
                    </div>
                    <div class="kobac-btn-wrap">
                        <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="kobac-cta-btn">
                            <span>Về chúng tôi</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 4C: PHỤ KIỆN ÔTÔ CHÍNH HÃNG (HÀ THÀNH GARAGE STYLE)
         ========================================================================= -->
    <section class="shiftup-accessories-section index-accessory" id="phu-kien-chinh-hang">
        <div class="container">
            
            <div class="accessory-sec-head text-center">
                <h2 class="accessory-heading-main">
                    <span>PHỤ KIỆN ÔTÔ</span> <span class="text-black">CHÍNH HÃNG</span>
                </h2>
                <div class="tuning-shop-divider"></div>
                <p class="accessory-sec-sub">
                    100% Phụ kiện chính hãng META.vn &bull; Zestech &bull; Michelin &bull; Steelmate &bull; Bosch &bull; Philips &bull; Hỗ trợ lắp đặt tại xưởng Hải Hà
                </p>
            </div>

            <?php
            $accessories = function_exists('hieugara_get_native_accessories') ? hieugara_get_native_accessories() : array();
            if (empty($accessories)) {
                $raw_accessories = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
                foreach ($raw_accessories as $a_it) {
                    if (!empty($a_it['enable'])) {
                        $accessories[] = $a_it;
                    }
                }
            }
            if (empty($accessories) && function_exists('hieugara_get_default_accessories_items')) {
                $accessories = hieugara_get_default_accessories_items();
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
                                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Lắp đặt ' . $acc['title']))); ?>" class="btn-accessory-install" title="Đặt lịch lắp đặt phụ kiện này">
                                            Lắp đặt
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

            <!-- CTA View All Accessories Button -->
            <div class="accessory-bottom-cta text-center">
                <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>" class="btn-accessory-view-all">
                    <span>XEM TOÀN BỘ 16+ PHỤ KIỆN CHÍNH HÃNG</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
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
                        array('name' => 'Mercedes-Benz', 'logo' => $theme_uri . '/assets/images/brands/mercedes.svg?v=' . HIEUGARA_THEME_VERSION, 'grad' => 'linear-gradient(135deg, rgba(0,40,90,0.06), rgba(0,40,90,0.12))'),
                        array('name' => 'BMW',           'logo' => $theme_uri . '/assets/images/brands/bmw.svg?v=' . HIEUGARA_THEME_VERSION,      'grad' => 'linear-gradient(135deg, rgba(0,102,177,0.08), rgba(0,102,177,0.15))'),
                        array('name' => 'Audi',          'logo' => $theme_uri . '/assets/images/brands/audi.svg?v=' . HIEUGARA_THEME_VERSION,     'grad' => 'linear-gradient(135deg, rgba(226,0,26,0.08), rgba(20,20,20,0.12))'),
                        array('name' => 'Porsche',       'logo' => $theme_uri . '/assets/images/brands/porsche.svg?v=' . HIEUGARA_THEME_VERSION,  'grad' => 'linear-gradient(135deg, rgba(217,45,32,0.08), rgba(245,163,0,0.14))'),
                        array('name' => 'Lexus',         'logo' => $theme_uri . '/assets/images/brands/lexus.svg?v=' . HIEUGARA_THEME_VERSION,    'grad' => 'linear-gradient(135deg, rgba(0,82,204,0.08), rgba(0,31,92,0.12))'),
                        array('name' => 'Toyota',        'logo' => $theme_uri . '/assets/images/brands/toyota.svg?v=' . HIEUGARA_THEME_VERSION,   'grad' => 'linear-gradient(135deg, rgba(235,10,30,0.08), rgba(235,10,30,0.14))'),
                        array('name' => 'Hyundai',       'logo' => $theme_uri . '/assets/images/brands/hyundai.svg?v=' . HIEUGARA_THEME_VERSION,  'grad' => 'linear-gradient(135deg, rgba(0,75,147,0.08), rgba(0,75,147,0.15))'),
                        array('name' => 'Ford',          'logo' => $theme_uri . '/assets/images/brands/ford.svg?v=' . HIEUGARA_THEME_VERSION,     'grad' => 'linear-gradient(135deg, rgba(0,52,120,0.08), rgba(0,52,120,0.15))'),
                        array('name' => 'Honda',         'logo' => $theme_uri . '/assets/images/brands/honda.svg?v=' . HIEUGARA_THEME_VERSION,    'grad' => 'linear-gradient(135deg, rgba(228,5,33,0.08), rgba(228,5,33,0.14))'),
                        array('name' => 'Volkswagen',    'logo' => $theme_uri . '/assets/images/brands/volkswagen.svg?v=' . HIEUGARA_THEME_VERSION, 'grad' => 'linear-gradient(135deg, rgba(0,67,122,0.08), rgba(0,67,122,0.15))'),
                        array('name' => 'Nissan',        'logo' => $theme_uri . '/assets/images/brands/nissan.svg?v=' . HIEUGARA_THEME_VERSION,   'grad' => 'linear-gradient(135deg, rgba(195,0,47,0.08), rgba(195,0,47,0.14))'),
                        array('name' => 'Bosch',         'logo' => $theme_uri . '/assets/images/brands/bosch.svg?v=' . HIEUGARA_THEME_VERSION,    'grad' => 'linear-gradient(135deg, rgba(234,0,22,0.08), rgba(0,86,145,0.12))'),
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
