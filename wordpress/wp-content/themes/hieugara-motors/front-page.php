<?php
/**
 * Ôtô Hải Hà Service - ShiftUp Flagship Front Page
 * Exact 1:1 Architectural Clone from ShiftUp Car Workshop (Qode Interactive)
 * Minimalist White & Obsidian High-Contrast, Unified Be Vietnam Pro Typography
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
$tech_phone    = get_option('hieugara_tech_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
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
            <?php foreach ($active_slides as $i => $s) : 
                $slide_img_url = function_exists('hieugara_normalize_local_media_urls') ? hieugara_normalize_local_media_urls($s['image']) : $s['image'];
            ?>
            <div class="lexus-slide <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>">
                <div class="lexus-slide-bg" style="background-image: url('<?php echo esc_url(add_query_arg('v', HIEUGARA_THEME_VERSION, $slide_img_url)); ?>');"></div>
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

                        <?php if (!empty($s['btn_text'])) : 
                            $slide_btn_url = !empty($s['btn_url']) ? $s['btn_url'] : home_url('/bang-gia/');
                            if (function_exists('hieugara_normalize_local_media_urls')) {
                                $slide_btn_url = hieugara_normalize_local_media_urls($slide_btn_url);
                            }
                        ?>
                        <div class="lexus-slide-actions">
                            <a href="<?php echo esc_url($slide_btn_url); ?>" class="lexus-outline-btn">
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
         MỤC MỚI: ĐỐI TÁC DỊCH VỤ CHÍNH THỨC VINFAST (NGAY SAU HERO)
         ========================================================================= -->
    <section class="hp-vinfast-hero-partner" id="vinfast-partnership">
        <div class="container">
            <div class="hp-vf-grid">
                <!-- Text Left (on desktop) / Top (on mobile) -->
                <div class="hp-vf-content">
                    <span class="hp-vf-eyebrow">XƯỞNG DỊCH VỤ VINFAST TẠI HẢI PHÒNG</span>
                    <h2 class="hp-vf-heading">Ô Tô Hải Hà – Đối tác dịch vụ chính thức của VinFast</h2>
                    <p class="hp-vf-paragraph">
                        Từ tháng 08/2026, Ô Tô Hải Hà chính thức hợp tác với VinFast, cung cấp phụ tùng chính hãng và dịch vụ sửa chữa, bảo dưỡng, đồng sơn cho xe VinFast. Đội ngũ của chúng tôi kết hợp 31 năm kinh nghiệm sửa chữa với kỹ thuật viên xe điện được đào tạo bài bản, phục vụ mọi dòng xe xăng, dầu, điện và hybrid.
                    </p>
                    <ul class="hp-vf-checklist">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Phụ tùng chính hãng VinFast</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Kỹ thuật viên xe điện</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Bảo dưỡng, sửa chữa, đồng sơn</span>
                        </li>
                    </ul>
                    <div class="hp-vf-actions">
                        <a href="tel:0911211996" class="hp-vf-btn-primary">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span>Tư vấn kỹ thuật: 0911 211 996</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>" class="hp-vf-btn-outline">
                            <span>Chi tiết dịch vụ xe VinFast</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Photo Right (on desktop) / Stacked below text (on mobile) -->
                <div class="hp-vf-photo-wrap">
                    <div class="hp-vf-frame">
                        <img src="<?php echo esc_url($theme_uri . '/assets/images/about/bien-vinfast-service-haiha.jpg'); ?>" alt="Biển VinFast Service tại gara Ô Tô Hải Hà" width="600" height="400" loading="lazy" class="hp-vf-img">
                        <div class="hp-vf-badge">
                            <span class="hp-vf-badge-sub">ĐỐI TÁC DỊCH VỤ CHÍNH THỨC</span>
                            <strong class="hp-vf-badge-title">VINFAST SERVICE</strong>
                        </div>
                    </div>
                </div>
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
                    <p class="stat-desc">Garage uy tín lâu năm hàng đầu tại Hải Dương, khẳng định chất lượng qua hơn 3 thập kỷ phục vụ tận tâm.</p>
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
         MỤC 4C: BLOG & BÀI VIẾT KỸ THUẬT (Ô TÔ HẢI HÀ)
         ========================================================================= -->
    <section class="shiftup-blog-section index-blog" id="blog-bai-viet">
        <div class="container">
            
            <div class="blog-sec-head text-center" style="margin-bottom: 32px;">
                <h2 class="blog-heading-main">
                    <span>MÁY MÓC KỸ THUẬT</span> <span class="text-black">TẠI Ô TÔ HẢI HÀ</span>
                </h2>
            </div>

            <?php
            $hp_posts = get_posts(array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC'
            ));
            ?>

            <?php if (!empty($hp_posts)) : ?>
                <div class="hp-blog-grid">
                    <?php foreach ($hp_posts as $hp_post) : 
                        $pid = $hp_post->ID;
                        $custom_thumb = get_post_meta($pid, '_custom_thumbnail_url', true);
                        if (has_post_thumbnail($pid)) {
                            $thumb_url = get_the_post_thumbnail_url($pid, 'large');
                        } elseif (!empty($custom_thumb)) {
                            $thumb_url = $custom_thumb;
                        } else {
                            $thumb_url = get_template_directory_uri() . '/assets/images/gallery/haiha-gallery-3.jpg';
                        }
                        if (function_exists('hieugara_normalize_local_media_urls')) {
                            $thumb_url = hieugara_normalize_local_media_urls($thumb_url);
                        }
                        $post_cats = get_the_category($pid);
                        $cat_name = !empty($post_cats) ? $post_cats[0]->name : 'Kỹ thuật ô tô';
                        $cat_link = !empty($post_cats) ? get_category_link($post_cats[0]->term_id) : home_url('/blog/');
                        $post_date = get_the_date('d/m/Y', $pid);
                    ?>
                        <article class="hp-blog-card">
                            <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="hp-blog-thumb" title="<?php echo esc_attr(get_the_title($pid)); ?>">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($pid)); ?>" loading="lazy">
                                <span class="hp-blog-card-cat"><i class="fa-solid fa-tag"></i> <?php echo esc_html($cat_name); ?></span>
                            </a>
                            <div class="hp-blog-body">
                                <div class="hp-blog-meta">
                                    <span><i class="fa-regular fa-calendar-check"></i> <?php echo esc_html($post_date); ?></span>
                                    <span><i class="fa-solid fa-user-gear"></i> Kỹ Sư Hải Hà</span>
                                </div>
                                <h3 class="hp-blog-title">
                                    <a href="<?php echo esc_url(get_permalink($pid)); ?>" title="<?php echo esc_attr(get_the_title($pid)); ?>">
                                        <?php echo esc_html(get_the_title($pid)); ?>
                                    </a>
                                </h3>
                                <p class="hp-blog-excerpt">
                                    <?php 
                                    $excerpt = get_the_excerpt($pid);
                                    echo esc_html(wp_trim_words($excerpt, 24, '...'));
                                    ?>
                                </p>
                                <div class="hp-blog-footer">
                                    <a href="<?php echo esc_url(get_permalink($pid)); ?>" class="hp-blog-readmore">
                                        <?php _e('Đọc chi tiết', 'hieugara-motors'); ?> <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="text-center" style="margin-top: 40px;">
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn-gara btn-gara-outline" style="border-color: #141414; color: #141414; font-weight: 700; padding: 12px 32px; border-radius: 8px;">
                        <i class="fa-solid fa-layer-group"></i> <?php _e('Xem Tất Cả Bài Viết &amp; Cẩm Nang', 'hieugara-motors'); ?>
                    </a>
                </div>
            <?php else : ?>
                <div class="text-center" style="padding: 40px 20px; background: #fff; border-radius: 12px; border: 1px solid #e5e7eb;">
                    <p style="color: #6b7280; margin: 0;"><?php _e('Chưa có bài viết mới. Vui lòng quay lại sau.', 'hieugara-motors'); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 5: ĐỐI TÁC & CÁC DÒNG XE PHỤC VỤ (BRAND MARQUEE)
         ========================================================================= -->
    <section class="shiftup-brand-marquee-section" id="dong-xe-phuc-vu">
        <div class="container">
            <div class="marquee-head text-center">
                <h3 class="marquee-title"><?php _e('CÁC DÒNG XE CHÚNG TÔI PHỤC VỤ', 'hieugara-motors'); ?></h3>
            </div>

            <!-- VinFast Official Service Partner Highlighted Separation -->
            <div class="marquee-vinfast-partner-spotlight">
                <div class="vf-spotlight-inner">
                    <div class="vf-spotlight-badge">
                        <span>ĐỐI TÁC DỊCH VỤ CHÍNH THỨC</span>
                    </div>
                    <div class="vf-spotlight-brand">
                        <img src="<?php echo esc_url($theme_uri . '/assets/images/brands/vinfast.svg?v=' . HIEUGARA_THEME_VERSION); ?>" alt="VinFast" class="vf-spotlight-logo" width="38" height="30">
                        <div class="vf-spotlight-titles">
                            <strong>VINFAST VIỆT NAM</strong>
                            <small>Xưởng tiếp nhận bảo dưỡng, sửa chữa &amp; phụ tùng chính hãng</small>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/dich-vu/xe-vinfast/')); ?>" class="vf-spotlight-btn">
                        <span>Chi tiết dịch vụ xe VinFast</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="marquee-strip-wrap">
            <div class="brand-marquee">
                <div class="brand-marquee-track">
                    <?php
                    $raw_brands = function_exists('hieugara_get_brand_logos') ? hieugara_get_brand_logos() : array();
                    $brands = array();
                    if (!empty($raw_brands)) {
                        foreach ($raw_brands as $rb) {
                            if (!empty($rb['enable'])) {
                                $g1 = !empty($rb['grad1']) ? $rb['grad1'] : '#0c1e3a';
                                $g2 = !empty($rb['grad2']) ? $rb['grad2'] : '#334155';
                                $brands[] = array(
                                    'name' => $rb['name'],
                                    'logo' => function_exists('hieugara_normalize_local_media_urls') ? hieugara_normalize_local_media_urls($rb['logo']) : $rb['logo'],
                                    'grad' => 'linear-gradient(135deg, ' . $g1 . ', ' . $g2 . ')',
                                    'url'  => !empty($rb['url']) ? $rb['url'] : '#',
                                );
                            }
                        }
                    }
                    // Fallback if empty
                    if (empty($brands)) {
                        $brands = array(
                            array('name' => 'Mercedes-Benz', 'logo' => $theme_uri . '/assets/images/brands/mercedes.svg?v=' . HIEUGARA_THEME_VERSION, 'grad' => 'linear-gradient(135deg, rgba(0,40,90,0.06), rgba(0,40,90,0.12))'),
                            array('name' => 'BMW',           'logo' => $theme_uri . '/assets/images/brands/bmw.svg?v=' . HIEUGARA_THEME_VERSION,      'grad' => 'linear-gradient(135deg, rgba(0,102,177,0.08), rgba(0,102,177,0.15))'),
                            array('name' => 'VinFast',       'logo' => $theme_uri . '/assets/images/brands/vinfast.svg?v=' . HIEUGARA_THEME_VERSION,  'grad' => 'linear-gradient(135deg, #0f172a, #c5161d)'),
                            array('name' => 'Audi',          'logo' => $theme_uri . '/assets/images/brands/audi.svg?v=' . HIEUGARA_THEME_VERSION,     'grad' => 'linear-gradient(135deg, rgba(226,0,26,0.08), rgba(20,20,20,0.12))'),
                            array('name' => 'Porsche',       'logo' => $theme_uri . '/assets/images/brands/porsche.svg?v=' . HIEUGARA_THEME_VERSION,  'grad' => 'linear-gradient(135deg, rgba(217,45,32,0.08), rgba(245,163,0,0.14))'),
                            array('name' => 'Toyota',        'logo' => $theme_uri . '/assets/images/brands/toyota.svg?v=' . HIEUGARA_THEME_VERSION,   'grad' => 'linear-gradient(135deg, rgba(235,10,30,0.08), rgba(235,10,30,0.14))'),
                        );
                    }
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
