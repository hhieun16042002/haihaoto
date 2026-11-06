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

            <!-- NÚT LIÊN HỆ TRỰC TIẾP (HIGH-IMPACT MOTORSPORT CTA BAR) -->
            <div class="hero-contact-actions-bar">
                <div class="contact-actions-inner">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="hero-cta-btn btn-rescue">
                        <span class="btn-pulse-dot"></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>GỌI CỨU HỘ 24/7: <?php echo esc_html($rescue_phone); ?></span>
                    </a>
                    <a href="#dat-lich-nhanh" class="hero-cta-btn btn-booking">
                        <span class="btn-orange-strip"></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/><line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/></svg>
                        <span>ĐẶT LỊCH HẸN TRỰC TUYẾN</span>
                    </a>
                    <a href="https://zalo.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" target="_blank" rel="noopener" class="hero-cta-btn btn-zalo">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.145 2 11.258c0 2.922 1.488 5.534 3.81 7.218-.166.974-.75 2.926-.81 3.167-.098.397.147.45.31.341.21-.14 2.815-1.921 3.86-2.651.9.274 1.848.425 2.83.425 5.523 0 10-4.145 10-9.258S17.523 2 12 2z"/></svg>
                        <span>CHAT ZALO KỸ THUẬT</span>
                    </a>
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
                    'img_mobile' => get_template_directory_uri() . '/assets/images/slider/slide-bao-duong.jpg',
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
                <p class="marquee-desc"><?php _e('Từ các dòng xe sang Châu Âu cao cấp đến xe phổ thông gia đình, đội ngũ kỹ thuật viên Hải Hà ÔTô đều có thiết bị chuyên dụng và phụ tùng chuẩn hãng đáp ứng.', 'hieugara-motors'); ?></p>
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

    <!-- =========================================================================
         MỤC 6: BẢN ĐỒ, ĐỊA CHỈ VÀ FORM ĐẶT LỊCH
         ========================================================================= -->
    <section class="shiftup-workshops-booking-section" id="dat-lich-nhanh">
        <div class="container">
            
            <div class="section-head-dark text-center">
                <span class="section-sub-tag"><?php _e('HỆ THỐNG XƯỞNG DỊCH VỤ &amp; ĐẶT LỊCH HẸN TRỰC TUYẾN', 'hieugara-motors'); ?></span>
                <h2 class="section-title-white">TRỤ SỞ XƯỞNG DỊCH VỤ &amp; ĐẶT LỊCH TIẾP NHẬN XE</h2>
                <p class="section-desc-light">Đội ngũ kỹ thuật viên Hải Hà ÔTô sẵn sàng phục vụ quý khách nhanh chóng, chu đáo và minh bạch 100%.</p>
                <div class="tuning-shop-divider"></div>
            </div>

            <div class="workshop-booking-dual-layout">
                
                <!-- Left: Workshop Information Cards -->
                <div class="ws-info-column">
                    
                    <div class="ws-primary-card">
                        <div class="ws-badge-row">
                            <span class="ws-status-live"><span class="live-dot"></span> ĐANG MỞ CỬA</span>
                            <span class="ws-type-tag">TRỤ SỞ CHÍNH HẢI DƯƠNG</span>
                        </div>
                        <h3 class="ws-main-name">Hải Hà ÔTô Service &amp; Workshop</h3>
                        <p class="ws-main-addr">
                            <i class="fa-solid fa-location-dot text-orange"></i>
                            <strong>Km 53+300 Quốc lộ 5</strong> (Chiều Hà Nội - Hải Phòng), Phường Cẩm Thượng, TP. Hải Dương
                        </p>
                        
                        <div class="ws-hotline-strip">
                            <div class="hotline-box rescue">
                                <span class="hotline-lbl">CỨU HỘ GIAO THÔNG 24/7</span>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="hotline-num"><?php echo esc_html($rescue_phone); ?></a>
                            </div>
                            <div class="hotline-box desk">
                                <span class="hotline-lbl">TỔNG ĐÀI ĐẶT LỊCH / BÀN XƯỞNG</span>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline_phone)); ?>" class="hotline-num"><?php echo esc_html($hotline_phone); ?></a>
                            </div>
                        </div>

                        <div class="ws-hours-row">
                            <i class="fa-regular fa-clock text-orange"></i>
                            <span>Giờ làm việc: <strong>07:30 – 18:30</strong> (Tất cả các ngày trong tuần, kể cả Thứ 7 &amp; Chủ Nhật)</span>
                        </div>

                        <div class="ws-quick-actions">
                            <a href="https://maps.google.com/?cid=15399047910545937753" target="_blank" rel="noopener" class="ws-action-btn map-btn">
                                <i class="fa-solid fa-diamond-turn-right"></i>
                                <span>Chỉ đường Google Maps</span>
                            </a>
                            <a href="https://zalo.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" target="_blank" rel="noopener" class="ws-action-btn zalo-btn">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span>Chat Zalo Báo Giá</span>
                            </a>
                        </div>
                    </div>

                    <!-- Interactive Google Map Embed -->
                    <div class="ws-map-embed-wrapper">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.2687595353154!2d106.30906231540166!3d20.981856794754593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31359b3bb895b6a7%3A0xd56d47bf1b28d699!2zR2FyYSBPdG8gSOG6o2kgSMOg!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" 
                            width="100%" 
                            height="240" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Bản đồ chỉ đường Gara Ô Tô Hải Hà">
                        </iframe>
                    </div>

                </div>

                <!-- Right: Streamlined Fast Booking Form with Direct AJAX Submit -->
                <div class="ws-booking-column">
                    <div class="fast-booking-card" id="homeFastBookingCard">
                        <div class="booking-card-head">
                            <div class="booking-head-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="#ff4d24" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke="#ff4d24" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke="#ff4d24" stroke-width="2"/><line x1="3" y1="10" x2="21" y2="10" stroke="#ff4d24" stroke-width="2"/></svg>
                            </div>
                            <div>
                                <h3 class="booking-card-title">PHIẾU ĐẶT HẸN TIẾP NHẬN XE</h3>
                                <p class="booking-card-subtitle">Không phải chờ đợi • Nhận ngay ưu đãi giảm 10% công bảo dưỡng</p>
                            </div>
                        </div>

                        <form id="homeFastBookingForm" class="home-fast-booking-form">
                            <input type="hidden" name="action" value="garage_submit_booking">
                            <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('garage_os_frontend_nonce')); ?>">
                            <input type="hidden" name="branch" value="Trụ sở chính Hải Hà ÔTô (Km 53+300 QL5)">

                            <div class="form-row-dual">
                                <div class="form-group">
                                    <label class="form-label" for="hb_name">Họ và tên của bạn <span class="required">*</span></label>
                                    <input type="text" id="hb_name" name="name" class="form-control" placeholder="Nguyễn Văn A" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="hb_phone">Số điện thoại liên hệ <span class="required">*</span></label>
                                    <input type="tel" id="hb_phone" name="phone" class="form-control" placeholder="09xx xxx xxx" required>
                                </div>
                            </div>

                            <div class="form-row-dual">
                                <div class="form-group">
                                    <label class="form-label" for="hb_plate">Biển số xe ô tô <span class="required">*</span></label>
                                    <input type="text" id="hb_plate" name="plate" class="form-control" placeholder="Ví dụ: 34A-123.45" required style="text-transform: uppercase;">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="hb_model">Dòng xe / Đời xe</label>
                                    <input type="text" id="hb_model" name="model" class="form-control" placeholder="Ví dụ: Mazda CX-5, Camry...">
                                </div>
                            </div>

                            <div class="form-row-dual">
                                <div class="form-group">
                                    <label class="form-label" for="hb_service">Dịch vụ yêu cầu</label>
                                    <select id="hb_service" name="service" class="form-control form-select">
                                        <option value="Bảo dưỡng định kỳ theo cấp km">Bảo dưỡng định kỳ theo cấp km (5k - 40k km)</option>
                                        <option value="Kiểm tra chẩn đoán tiếng kêu gầm máy">Kiểm tra chẩn đoán tiếng kêu gầm máy</option>
                                        <option value="Cân chỉnh góc lái 3D Hunter">Cân chỉnh góc lái 3D Hunter &amp; Lực phanh</option>
                                        <option value="Đồng sơn sấy hấp &amp; Bảo hiểm">Đồng sơn sấy hấp &amp; Bảo hiểm xe tai nạn</option>
                                        <option value="Bảo dưỡng điều hòa &amp; Nội soi lạnh">Bảo dưỡng điều hòa &amp; Nội soi dàn lạnh</option>
                                        <option value="Detailing, Phủ Ceramic, Dán PPF/Phim">Detailing, Phủ Ceramic, Dán PPF/Phim cách nhiệt</option>
                                        <option value="Cứu hộ giao thông &amp; Sửa chữa lưu động">Cứu hộ giao thông &amp; Sửa chữa lưu động</option>
                                        <option value="Khác">Hạng mục khác (Ghi chú chi tiết bên dưới)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="hb_date">Ngày dự kiến đến xưởng</label>
                                    <input type="date" id="hb_date" name="date" class="form-control" value="<?php echo esc_attr(date('Y-m-d')); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="hb_notes">Ghi chú tình trạng xe hoặc yêu cầu riêng</label>
                                <textarea id="hb_notes" name="notes" rows="2" class="form-control form-textarea" placeholder="Mô tả hiện tượng xe (rung lắc, điều hòa không mát, lịch bảo dưỡng cấp lớn...)"></textarea>
                            </div>

                            <div class="booking-submit-wrap">
                                <button type="submit" id="hb_submit_btn" class="booking-submit-button">
                                    <span class="btn-orange-strip"></span>
                                    <span class="btn-text">XÁC NHẬN ĐẶT LỊCH HẸN TIẾP NHẬN XE</span>
                                    <span class="btn-arrow">&rarr;</span>
                                </button>
                            </div>

                            <div id="hb_feedback_msg" class="booking-feedback-msg" style="display: none;"></div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX handling for the Home Fast Booking Form
    const bookingForm = document.getElementById('homeFastBookingForm');
    const feedbackMsg = document.getElementById('hb_feedback_msg');
    const submitBtn   = document.getElementById('hb_submit_btn');

    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').textContent = 'ĐANG GỬI THÔNG TIN...';

            const formData = new FormData(bookingForm);

            fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                feedbackMsg.style.display = 'block';
                if (data.success) {
                    feedbackMsg.className = 'booking-feedback-msg success';
                    feedbackMsg.innerHTML = '<strong>ĐẶT LỊCH THÀNH CÔNG!</strong> Mã phiếu: #' + (data.data?.booking_id || 'OK') + '. Kỹ sư trưởng Hải Hà ÔTô sẽ liên hệ xác nhận trong vòng 10 phút.';
                    bookingForm.reset();
                } else {
                    feedbackMsg.className = 'booking-feedback-msg error';
                    feedbackMsg.textContent = data.data?.message || 'Có lỗi xảy ra, vui lòng gọi trực tiếp hotline 0911 211 996!';
                }
            })
            .catch(err => {
                feedbackMsg.style.display = 'block';
                feedbackMsg.className = 'booking-feedback-msg error';
                feedbackMsg.textContent = 'Lỗi kết nối máy chủ! Vui lòng gọi trực tiếp 0911 211 996.';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text').textContent = 'XÁC NHẬN ĐẶT LỊCH HẸN TIẾP NHẬN XE';
            });
        });
    }
});
</script>

<?php
get_footer();
