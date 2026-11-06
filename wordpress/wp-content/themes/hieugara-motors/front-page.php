<?php
/**
 * Hải Hà ÔTô Service - ShiftUp Flagship Front Page
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

    <!-- 1B: LỢI ÍCH CHÍNH VÀ NÚT LIÊN HỆ (6 CORE BENEFITS + 3 CONTACT ACTION BUTTONS) -->
    <section class="shiftup-tuning-shop-section" id="loi-ich-chinh">
        <div class="container">
            
            <div class="tuning-shop-head text-center">
                <span class="tuning-shop-sub-label"><?php _e('TIÊU CHUẨN XƯỞNG DỊCH VỤ Ô TÔ TOÀN DIỆN', 'hieugara-motors'); ?></span>
                <h2 class="tuning-shop-title">HẢI HÀ ÔTÔ SERVICE & WORKSHOP</h2>
                <div class="tuning-shop-divider"></div>
            </div>

                        <div class="tuning-features-grid">
                
                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> KHOANG SƠN SẤY CHÂU ÂU</h3>
                        <p class="feature-desc">Phòng sấy hồng ngoại đối lưu khép kín, triệt tiêu bụi sơn 99.9%, bảo hành màu sơn 24 tháng theo biển số.</p>
                    </div>
                </div>

                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 2a7 7 0 0 1 7 7M12 12l4-2M12 12v7M8 10l4 2"/>
                            <circle cx="12" cy="12" r="2" fill="#ff4d24"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> CÂN CHỈNH GÓC ĐẶT HUNTER USA</h3>
                        <p class="feature-desc">Hệ thống máy Hunter HawkEye Elite 3D căn chỉnh camber, caster, toe-in chuẩn milimet, triệt tiêu nhao lái hoàn toàn.</p>
                    </div>
                </div>

                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="4" width="16" height="16" rx="2"/>
                            <rect x="9" y="9" width="6" height="6"/>
                            <path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> MÁY CHẨN ĐOÁN ECU ĐA NĂNG</h3>
                        <p class="feature-desc">Đọc live data, test cảm biến, coding hộp đen ECU cho các dòng xe Châu Âu: Mercedes, BMW, Audi, Porsche, Ford, Lexus.</p>
                    </div>
                </div>

                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> BẢO HÀNH ĐIỆN TỬ 24 THÁNG</h3>
                        <p class="feature-desc">Tra cứu lịch sử bảo dưỡng và thời hạn bảo hành phụ tùng trực tuyến 24/7 theo số biển số xe minh bạch.</p>
                    </div>
                </div>

                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/>
                            <path d="M15 18H9"/>
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/>
                            <circle cx="17" cy="18" r="2"/>
                            <circle cx="7" cy="18" r="2"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> CỨU HỘ GIAO THÔNG 24/7</h3>
                        <p class="feature-desc">Đội xe cứu hộ chuyên dụng sàn trượt cẩu kéo túc trực 24/7, có mặt thần tốc cứu hộ mọi tình huống sự cố trên đường.</p>
                    </div>
                </div>

                <div class="tuning-feature-card">
                    <div class="feature-icon-box">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff4d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <h3 class="feature-title"><span class="orange-bar">|</span> ĐỘI NGŨ 80 NHÂN SỰ CHUYÊN NGHIỆP</h3>
                        <p class="feature-desc">Kỹ sư trưởng và thợ máy trên 15 năm kinh nghiệm, liên tục được đào tạo quy trình bảo dưỡng xe đời mới.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =========================================================================
         MỤC 2: CÂU CHUYỆN 31 NĂM VÀ CÁC CON SỐ NỔI BẬT
         ========================================================================= -->
    <section class="shiftup-technicians-section" id="cau-chuyen-31-nam">
        <div class="container">
            
            <div class="tech-section-head text-center">
                <span class="tech-sub-label"><?php _e('CÂU CHUYỆN 31 NĂM HẢI HÀ ÔTÔ SERVICE (1995 - 2026)', 'hieugara-motors'); ?></span>
                <h2 class="tech-title">NGƯỜI THẬT • VIỆC THẬT • TRỌN CHỮ TÂM VỚI NGHỀ</h2>
                <div class="tuning-shop-divider"></div>
            </div>

            <!-- Founder Story & 31-Year Philosophy (Text-Only Editorial) -->
            <div class="founder-story-card">
                <div class="founder-story-header">
                    <span class="story-tag">NGƯỜI SÁNG LẬP &amp; KỸ SƯ TRƯỞNG</span>
                    <h3 class="story-founder-name">ÔNG NGUYỄN VĂN HẢI</h3>
                    <span class="story-since">Khởi dựng cơ nghiệp từ năm 1995 • Km 53+300 Quốc lộ 5, Hải Dương</span>
                </div>
                
                <div class="founder-quote-block">
                    <div class="quote-mark">“</div>
                    <p class="founder-quote-text">
                        Hơn <strong>31 năm trực tiếp cầm cờ lê</strong>, chẩn đoán và khắc phục hàng vạn ca bệnh khó cho các dòng xe từ cổ điển đến xe sang hiện đại. Khởi đầu từ năm 1995 tại mảnh đất Hải Dương, Hải Hà ÔTô luôn giữ trọn một tôn chỉ bất biến: 
                        <em class="highlight-quote">“Bắt đúng bệnh, sửa đúng chỗ, báo đúng giá – Tuyệt đối không vẽ việc làm khó khách hàng.”</em>
                    </p>
                </div>

                <div class="founder-signature-row">
                    <div class="sig-left">
                        <span class="sig-author">Nguyễn Văn Hải</span>
                        <span class="sig-role">Kỹ sư trưởng &bull; Người giữ lửa 31 năm</span>
                    </div>
                    <div class="sig-right">
                        <span class="sig-pledge"><i class="fa-solid fa-shield-halved text-orange"></i> Cam kết 100% phụ tùng OEM chính hãng &amp; bảo hành điện tử theo biển số</span>
                    </div>
                </div>
            </div>

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
         MỤC 3: LƯỚI DỊCH VỤ (KÈM BẢNG GIÁ NIÊM YẾT)
         ========================================================================= -->
    <!-- 3A: LƯỚI DỊCH VỤ CHUYÊN SÂU (ALL ABOUT CARS CAROUSEL) -->
    <section class="shiftup-all-about-cars-section" id="dich-vu">
        <div class="container">
            
            <div class="all-about-head">
                <div class="all-about-title-group">
                    <span class="all-about-sub-label"><?php _e('DỊCH VỤ & NĂNG LỰC KỸ THUẬT', 'hieugara-motors'); ?></span>
                    <h2 class="all-about-title">LƯỚI DỊCH VỤ CHUYÊN SÂU</h2>
                </div>
                <div class="all-about-arrows">
                    <button class="arrow-btn" id="allCarsPrevBtn" aria-label="<?php esc_attr_e('Trước', 'hieugara-motors'); ?>" title="<?php esc_attr_e('Trước', 'hieugara-motors'); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>
                    </button>
                    <button class="arrow-btn" id="allCarsNextBtn" aria-label="<?php esc_attr_e('Tiếp theo', 'hieugara-motors'); ?>" title="<?php esc_attr_e('Tiếp theo', 'hieugara-motors'); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 19M19 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>
                    </button>
                </div>
            </div>

            <div class="swiper all-about-swiper" id="allCarsTrack">
                <div class="swiper-wrapper">
                    <?php
                    $services_query = new WP_Query(array(
                        'post_type'      => 'garage_service',
                        'posts_per_page' => 12,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order date',
                        'order'          => 'ASC'
                    ));

                    if ($services_query->have_posts()) :
                        $card_i = 1;
                        while ($services_query->have_posts()) : $services_query->the_post();
                            $custom_img = get_post_meta(get_the_ID(), '_garage_custom_image', true);
                            if (has_post_thumbnail()) {
                                $card_img = get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb');
                            } elseif (!empty($custom_img)) {
                                $card_img = $custom_img;
                            } else {
                                $card_img = $shiftup_img . '/port-' . (($card_i % 4) + 1) . '.jpg';
                            }
                            $service_badge = get_post_meta(get_the_ID(), '_garage_tech_badge', true) ?: 'TIÊU CHUẨN XƯỞNG';
                            $card_i++;
                            ?>
                            <div class="swiper-slide">
                                <article class="about-card-item">
                                    <div class="card-image-wrap">
                                        <a href="<?php the_permalink(); ?>" class="card-img-link" aria-label="<?php the_title_attribute(); ?>">
                                            <img src="<?php echo esc_url($card_img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                            <div class="card-hover-overlay">
                                                <span class="view-detail-badge">+ <?php _e('XEM CHI TIẾT', 'hieugara-motors'); ?></span>
                                            </div>
                                        </a>
                                        <span class="card-tech-badge"><?php echo esc_html($service_badge); ?></span>
                                    </div>
                                    <h4 class="card-item-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <span class="orange-bar">|</span> <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p class="card-item-desc"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 16); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="card-learn-more-link">
                                        <span><?php _e('Chi tiết quy trình &amp; bảng giá', 'hieugara-motors'); ?></span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"/></svg>
                                    </a>
                                </article>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback Default Portfolio Items
                        $fallback_cards = array(
                            array(
                                'title' => 'BẢO DƯỠNG ĐỊNH KỲ 45 HẠNG MỤC',
                                'desc'  => 'Thay dầu động cơ chính hãng, kiểm tra an toàn hệ thống gầm lái, phanh, lốp và xóa lỗi hộp đen ECU.',
                                'img'   => $shiftup_img . '/port-1.jpg',
                                'badge' => 'TIÊU CHUẨN ĐỨC'
                            ),
                            array(
                                'title' => 'SỬA CHỮA ĐẠI TU ĐỘNG CƠ & HỘP SỐ',
                                'desc'  => 'Xử lý dứt điểm hao nhớt, khói đen, rung giật số, cân cam điện tử bằng dụng cụ chuyên dụng chính hãng.',
                                'img'   => $shiftup_img . '/port-2.jpg',
                                'badge' => 'KỸ THUẬT CHUYÊN SÂU'
                            ),
                            array(
                                'title' => 'CÂN CHỈNH GÓC LÁI HUNTER 3D',
                                'desc'  => 'Cân bằng động Hunter và chỉnh góc đặt bánh xe 3D triệt tiêu hiện tượng nhao lái, mòn vẹt lốp.',
                                'img'   => $shiftup_img . '/port-3.jpg',
                                'badge' => 'CÔNG NGHỆ MỸ'
                            ),
                            array(
                                'title' => 'ĐỒNG SƠN PHÒNG SẤY HẤP CAO CẤP',
                                'desc'  => 'Quy trình sơn sấy khép kín công nghệ Châu Âu, bảo hành màu sơn 24 tháng theo biển số.',
                                'img'   => $shiftup_img . '/port-4.jpg',
                                'badge' => 'SƠN GỐC NƯỚC'
                            )
                        );
                        foreach ($fallback_cards as $f) :
                            $f_link = home_url('/bang-gia/');
                            ?>
                            <div class="swiper-slide">
                                <article class="about-card-item">
                                    <div class="card-image-wrap">
                                        <a href="<?php echo esc_url($f_link); ?>" class="card-img-link" aria-label="<?php echo esc_attr($f['title']); ?>">
                                            <img src="<?php echo esc_url($f['img']); ?>" alt="<?php echo esc_attr($f['title']); ?>" loading="lazy">
                                            <div class="card-hover-overlay">
                                                <span class="view-detail-badge">+ <?php _e('XEM CHI TIẾT', 'hieugara-motors'); ?></span>
                                            </div>
                                        </a>
                                        <span class="card-tech-badge"><?php echo esc_html($f['badge']); ?></span>
                                    </div>
                                    <h4 class="card-item-title">
                                        <a href="<?php echo esc_url($f_link); ?>">
                                            <span class="orange-bar">|</span> <?php echo esc_html($f['title']); ?>
                                        </a>
                                    </h4>
                                    <p class="card-item-desc"><?php echo esc_html($f['desc']); ?></p>
                                    <a href="<?php echo esc_url($f_link); ?>" class="card-learn-more-link">
                                        <span><?php _e('Chi tiết quy trình &amp; bảng giá', 'hieugara-motors'); ?></span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"/></svg>
                                    </a>
                                </article>
                            </div>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </section>

    <!-- 3B: BẢNG GIÁ DỊCH VỤ NIÊM YẾT (3 GÓI BẢO DƯỠNG MINH BẠCH) -->
    <section class="shiftup-checkup-offers-section" id="bang-gia">
        <div class="container">
            
            <div class="checkup-head text-center">
                <span class="all-about-sub-label"><?php _e('BẢNG GIÁ DỊCH VỤ NIÊM YẾT', 'hieugara-motors'); ?></span>
                <h2 class="checkup-title">CHECK UP OFFERS • GÓI BẢO DƯỠNG ĐỊNH KỲ</h2>
                <p class="checkup-sub">Minh bạch chi phí 100%, sử dụng dầu nhớt và phụ tùng OEM chính hãng, không phát sinh phụ phí.</p>
            </div>

            <div class="checkup-pricing-grid">

                <!-- Plan 1: Basic 5.000km -->
                <div class="checkup-card">
                    <div class="card-img-wrap">
                        <img src="<?php echo esc_url($shiftup_img . '/pricing-1.jpg'); ?>" alt="Gói bảo dưỡng cơ bản" loading="lazy">
                    </div>
                    <div class="card-body">
                        <div class="card-cat-label">
                            <span>GÓI BẢO DƯỠNG</span>
                            <span class="sep-dot">•</span>
                            <span>CẤP 5.000 KM</span>
                        </div>
                        <div class="card-price-row">
                            <span class="price-val">550.000</span>
                            <span class="price-cur">đ</span>
                        </div>
                        <ul class="card-features-list">
                            <li><span class="orange-bar">|</span> Thay dầu động cơ chính hãng</li>
                            <li><span class="orange-bar">|</span> Vệ sinh lọc gió động cơ &amp; điều hòa</li>
                            <li><span class="orange-bar">|</span> Bổ sung nước làm mát, nước rửa kính</li>
                            <li><span class="orange-bar">|</span> Kiểm tra áp suất lốp &amp; siết lực ốc bánh</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp nhỏ 5.000km'))); ?>" class="checkup-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>+ ĐẶT LỊCH GÓI NÀY</span>
                        </a>
                    </div>
                </div>

                <!-- Plan 2: Medium 10.000km (Featured) -->
                <div class="checkup-card featured">
                    <div class="card-img-wrap">
                        <img src="<?php echo esc_url($shiftup_img . '/pricing-2.jpg'); ?>" alt="Gói bảo dưỡng trung bình" loading="lazy">
                    </div>
                    <div class="card-body">
                        <div class="card-cat-label">
                            <span class="text-orange">PHỔ BIẾN NHẤT</span>
                            <span class="sep-dot">•</span>
                            <span>CẤP 10.000 KM</span>
                        </div>
                        <div class="card-price-row">
                            <span class="price-val text-orange">1.250.000</span>
                            <span class="price-cur">đ</span>
                        </div>
                        <ul class="card-features-list">
                            <li><span class="orange-bar">|</span> Toàn bộ hạng mục cấp 5.000 km</li>
                            <li><span class="orange-bar">|</span> Thay mới lọc dầu động cơ chính hãng</li>
                            <li><span class="orange-bar">|</span> Bảo dưỡng &amp; tra mỡ hệ thống phanh 4 bánh</li>
                            <li><span class="orange-bar">|</span> Đảo lốp định kỳ chống mòn lệch</li>
                            <li><span class="orange-bar">|</span> Quét lỗi ECU bằng máy đọc chuyên sâu</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp trung bình 10.000km'))); ?>" class="checkup-btn featured-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>+ ĐẶT LỊCH GÓI NÀY</span>
                        </a>
                    </div>
                </div>

                <!-- Plan 3: Major 40.000km -->
                <div class="checkup-card">
                    <div class="card-img-wrap">
                        <img src="<?php echo esc_url($shiftup_img . '/pricing-3.jpg'); ?>" alt="Gói bảo dưỡng cấp lớn" loading="lazy">
                    </div>
                    <div class="card-body">
                        <div class="card-cat-label">
                            <span>GÓI TOÀN DIỆN</span>
                            <span class="sep-dot">•</span>
                            <span>CẤP 40.000 KM</span>
                        </div>
                        <div class="card-price-row">
                            <span class="price-val">5.800.000</span>
                            <span class="price-cur">đ</span>
                        </div>
                        <ul class="card-features-list">
                            <li><span class="orange-bar">|</span> Toàn bộ hạng mục cấp 10.000 km</li>
                            <li><span class="orange-bar">|</span> Thay dầu hộp số &amp; dầu cầu tự động</li>
                            <li><span class="orange-bar">|</span> Thay mới toàn bộ bugi Iridium cao cấp</li>
                            <li><span class="orange-bar">|</span> Thay dầu phanh DOT4 &amp; nước làm mát máy</li>
                            <li><span class="orange-bar">|</span> Cân chỉnh góc đặt bánh xe 3D Hunter</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp lớn 40.000km'))); ?>" class="checkup-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>+ ĐẶT LỊCH GÓI NÀY</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="checkup-footer-cta text-center" style="margin-top: 35px;">
                <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>" class="shiftup-rect-btn btn-white-view" style="display: inline-flex; align-items: center; gap: 8px;">
                    <span class="btn-orange-bar">|</span>
                    <span>XEM BẢNG GIÁ ĐẦY ĐỦ 6 NHÓM DỊCH VỤ &amp; DỰ TOÁN SƠN XE &rarr;</span>
                </a>
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
            $pano_banners = array(
                array(
                    'title'      => __('ĐỒNG SƠN SẤY HẤP', 'hieugara-motors'),
                    'desc'       => __('Quy trình sơn sấy khép kín công nghệ Châu Âu, bảo hành màu sơn 24 tháng theo biển số.', 'hieugara-motors'),
                    'img'        => $shiftup_img . '/banner-1.jpg',
                    'img_mobile' => get_template_directory_uri() . '/assets/images/slider/slide-son-xe.jpg',
                    'link'       => home_url('/bang-gia/#du-toan-son-xe')
                ),
                array(
                    'title'      => __('BẢO DƯỠNG ĐỊNH KỲ', 'hieugara-motors'),
                    'desc'       => __('Quy trình kiểm tra 45 hạng mục toàn diện, quét lỗi điện tử ECU và thay dầu máy chính hãng.', 'hieugara-motors'),
                    'img'        => $shiftup_img . '/banner-2.jpg',
                    'img_mobile' => $shiftup_img . '/slide-2.jpg',
                    'link'       => home_url('/dat-lich/?service=' . urlencode('Bảo Dưỡng Định Kỳ'))
                ),
                array(
                    'title'      => __('CHẨN ĐOÁN MÁY GẦM', 'hieugara-motors'),
                    'desc'       => __('Xử lý dứt điểm tiếng kêu gầm, căn chỉnh góc đặt bánh xe 3D Hunter triệt tiêu hoàn toàn nhao lái.', 'hieugara-motors'),
                    'img'        => $shiftup_img . '/banner-3.jpg',
                    'img_mobile' => get_template_directory_uri() . '/assets/images/shiftup/tech-about.jpg',
                    'link'       => home_url('/dat-lich/?service=' . urlencode('Chẩn Đoán Máy Gầm'))
                ),
                array(
                    'title'      => __('CHĂM SÓC XE DETAILING', 'hieugara-motors'),
                    'desc'       => __('Phủ bóng Ceramic Pro 9H kháng hóa chất, dán phim cách nhiệt 3M Crystalline và dán PPF cao cấp.', 'hieugara-motors'),
                    'img'        => $shiftup_img . '/banner-4.jpg',
                    'img_mobile' => get_template_directory_uri() . '/assets/images/slider/slide-detailing.jpg',
                    'link'       => home_url('/dat-lich/?service=' . urlencode('Detailing & Dán phim cách nhiệt'))
                )
            );

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

    <!-- 4B: FLANKED DIAGNOSTICS & THIẾT BỊ KIỂM ĐỊNH HIỆN ĐẠI -->
    <section class="shiftup-flanked-diagnostics">
        <div class="container">
            
            <div class="flanked-head text-center">
                <span class="flanked-sub-label"><?php _e('TRANG THIẾT BỊ ĐO KIỂM &amp; CHẨN ĐOÁN HIỆN ĐẠI', 'hieugara-motors'); ?></span>
                <h2 class="flanked-title">TIÊU CHUẨN XƯỞNG DỊCH VỤ CÔNG NGHỆ CAO</h2>
                <div class="tuning-shop-divider"></div>
            </div>

            <div class="diagnostics-tech-grid">
                
                <div class="diag-station-card">
                    <div class="diag-card-top">
                        <span class="station-code">STATION // 01</span>
                        <span class="station-badge">KIỂM ĐỊNH TỰ ĐỘNG</span>
                    </div>
                    <h3 class="station-title"><span class="orange-bar">|</span> BỆ THỬ LỰC PHANH ĐIỆN TỬ</h3>
                    <p class="station-desc">Bệ thử lực phanh con lăn tải trọng lớn tự động đo lực phanh 4 bánh, độ trượt bánh và độ lệch lực phanh giữa 2 bên theo đúng quy chuẩn đăng kiểm quốc gia.</p>
                    <div class="station-spec">
                        <span>Độ chính xác: <strong>±0.1%</strong></span>
                        <span>Xuất báo cáo: <strong>In đồ thị trực tiếp</strong></span>
                    </div>
                </div>

                <div class="diag-station-card">
                    <div class="diag-card-top">
                        <span class="station-code">STATION // 02</span>
                        <span class="station-badge">CÔNG NGHỆ HOA KỲ</span>
                    </div>
                    <h3 class="station-title"><span class="orange-bar">|</span> CÂN CHỈNH GÓC LÁI 3D HUNTER</h3>
                    <p class="station-desc">Hệ thống máy Hunter HawkEye Elite 3D với 4 camera độ phân giải cao quét bia ngắm mâm xe, cân chỉnh góc camber, caster, toe chuẩn xác từng milimet.</p>
                    <div class="station-spec">
                        <span>Thiết bị: <strong>Hunter USA HawkEye</strong></span>
                        <span>Cam kết: <strong>Triệt tiêu nhao lái 100%</strong></span>
                    </div>
                </div>

                <div class="diag-station-card">
                    <div class="diag-card-top">
                        <span class="station-code">STATION // 03</span>
                        <span class="station-badge">CÔNG NGHỆ KHÔNG THÁO TAPLO</span>
                    </div>
                    <h3 class="station-title"><span class="orange-bar">|</span> NỘI SOI ĐIỀU HÒA Ô TÔ</h3>
                    <p class="station-desc">Đầu camera siêu nhỏ luồn trực tiếp vào hốc dàn lạnh để kiểm tra rò rỉ gas, vệ sinh sạch ẩm mốc vi khuẩn và nạp gas R134a/R1234yf tinh khiết bảo vệ sức khỏe cả gia đình.</p>
                    <div class="station-spec">
                        <span>Phương pháp: <strong>Nội soi vi sóng</strong></span>
                        <span>Bảo hành: <strong>Gas lạnh tinh khiết 12T</strong></span>
                    </div>
                </div>

                <div class="diag-station-card">
                    <div class="diag-card-top">
                        <span class="station-code">STATION // 04</span>
                        <span class="station-badge">CHUYÊN SÂU CHÂU ÂU</span>
                    </div>
                    <h3 class="station-title"><span class="orange-bar">|</span> MÁY QUÉT HỘP ĐEN ECU CHUYÊN SÂU</h3>
                    <p class="station-desc">Đọc dữ liệu thời gian thực (live data), chẩn đoán mạch điện tử, xóa mã lỗi và lập trình thích ứng (coding/programming) cho Mercedes, BMW, Audi, Porsche, Lexus, Ford.</p>
                    <div class="station-spec">
                        <span>Dữ liệu: <strong>Hơn 90+ hãng xe toàn cầu</strong></span>
                        <span>Phần mềm: <strong>Chính hãng OEM Update</strong></span>
                    </div>
                </div>

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
