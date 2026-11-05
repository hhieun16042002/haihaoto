<?php
/**
 * Hải Hà Auto Service - ShiftUp Flagship Front Page
 * Exact 1:1 Architectural Clone from ShiftUp Car Workshop (Qode Interactive)
 * Minimalist White & Obsidian High-Contrast, Motorsport Typography (Chakra Petch & Be Vietnam Pro)
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
         SECTION 1: LEXUS FULL-WIDTH CINEMATIC HERO SLIDER (SERVICE PILLARS)
         Dynamic & Editable via WordPress Admin > Cài Đặt Giao Diện
         ========================================================================= -->
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
                <button class="lexus-dash-item <?php echo $i === 0 ? 'active' : ''; ?>" data-to="<?php echo $i; ?>">
                    <span class="dash-meta">
                        <span class="dash-num"><?php echo sprintf('%02d', $i + 1); ?></span>
                        <span class="dash-label"><?php echo esc_html(!empty($s['nav_tab']) ? $s['nav_tab'] : $s['title']); ?></span>
                    </span>
                    <span class="dash-progress-track">
                        <span class="dash-progress-fill"></span>
                    </span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 2: SHIFTUP SECTION 2 (PREMIUM CAR TUNING SHOP REPLICA)
         ========================================================================= -->
    <section class="shiftup-tuning-shop-section">
        <div class="container tuning-shop-grid">
            
            <!-- Left 35%: Big Bold Title -->
            <div class="tuning-title-col">
                <h2 class="tuning-title">
                    HỆ THỐNG XƯỞNG<br>
                    DỊCH VỤ Ô TÔ<br>
                    CHUYÊN NGHIỆP
                </h2>
            </div>

            <!-- Right 65%: Clean 3-Column / 2-Row Features with Orange Vertical Bar -->
            <div class="tuning-features-grid">
                
                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> PHÒNG SƠN AXALTA ĐỨC</h4>
                    <p class="feature-item-text">Phòng sơn sấy khép kín tiêu chuẩn Châu Âu, sơn gốc nước Dupont/Axalta chống bay màu 24 tháng.</p>
                </div>

                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> QUY TRÌNH 45 HẠNG MỤC</h4>
                    <p class="feature-item-text">Bảo dưỡng định kỳ các cấp 5.000km đến 40.000km, quét chẩn đoán ECU và kiểm tra an toàn miễn phí.</p>
                </div>

                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> CHẨN ĐOÁN ECU CHUYÊN SÂU</h4>
                    <p class="feature-item-text">Máy đọc lỗi hộp đen chuyên hãng cho Mercedes, BMW, Porsche, Audi, Lexus, Toyota, Hyundai...</p>
                </div>

                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> BẢO HÀNH ĐIỆN TỬ 24 THÁNG</h4>
                    <p class="feature-item-text">Mọi lượt xe đều được cấp mã bảo hành điện tử theo biển số, tra cứu lịch sử sửa chữa tức thì 24/7.</p>
                </div>

                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> 100% PHỤ TÙNG CHÍNH HÃNG</h4>
                    <p class="feature-item-text">Phụ tùng OEM có tem xuất xứ rõ ràng, báo giá minh bạch trước khi làm và không có chi phí ẩn.</p>
                </div>

                <div class="tuning-feature-item">
                    <h4 class="feature-item-title"><span class="orange-bar">|</span> CỨU HỘ 24/7: <?php echo esc_html($rescue_phone); ?></h4>
                    <p class="feature-item-text">Đội xe cứu hộ kéo sàn trượt trực chiến 24/7 toàn quốc, hỗ trợ giám định bảo hiểm thân vỏ trọn gói.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- =========================================================================
         SECTION 3: SHIFTUP SECTION 3 (AUTOMOTIVE TECHNICIANS REPLICA)
         Overlapping Dark Card with 4 Orange Square Corner Dots
         ========================================================================= -->
    <section class="shiftup-technicians-section">
        <div class="container technicians-wrap">
            
            <!-- Left: Wide Workshop Photo -->
            <div class="technicians-photo-frame">
                <img src="<?php echo esc_url($shiftup_img . '/tech-about.jpg?v=' . HIEUGARA_THEME_VERSION); ?>" alt="Đội ngũ kỹ thuật viên Hải Hà Auto" class="technicians-img" loading="lazy">
            </div>

            <!-- Right: Overlapping Dark Box with 4 Orange Square Corner Dots -->
            <div class="technicians-dark-card">
                <!-- 4 Corner Dots -->
                <span class="corner-dot dot-tl"></span>
                <span class="corner-dot dot-tr"></span>
                <span class="corner-dot dot-bl"></span>
                <span class="corner-dot dot-br"></span>

                <div class="card-inner">
                    <span class="card-kicker text-orange" style="font-family: 'Chakra Petch', sans-serif; font-size: 0.78rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 8px;">1995 — <?php echo date('Y'); ?> &bull; 31 NĂM GIỮ TRỌN CHỮ TÂM</span>
                    <h2 class="card-title">HẢI HÀ Ô TÔ: 31 NĂM VỚI NGHỀ</h2>
                    <p class="card-text" style="font-size: 0.95rem; line-height: 1.7; margin-bottom: 14px;">
                        <span class="bullet-square"></span>
                        Năm 1995, nhà sáng lập <strong>Nguyễn Hải Hà</strong> đặt những viên gạch đầu tiên với niềm tin giản dị: <em>mỗi chiếc xe đều xứng đáng được chăm sóc bằng cái tâm của người thợ</em>. 31 năm trôi qua, Hải Hà Ô Tô tự hào có đội ngũ <strong>80 nhân viên</strong> làm việc chuyên nghiệp, phục vụ tận tâm từ bảo dưỡng định kỳ đến những hạng mục sửa chữa tỉ mỉ nhất.
                    </p>
                    <p class="card-subtext" style="color: #cbd5e1; font-size: 0.88rem; line-height: 1.6; margin-bottom: 22px; border-left: 2px solid #ff4d24; padding-left: 12px;">
                        <em>"Tận tâm với từng chiếc xe, vững tin trên mọi hành trình."</em>
                    </p>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
                        <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" class="shiftup-rect-btn btn-dark-view">
                            <span class="btn-orange-bar">|</span>
                            <span>+ <?php _e('VỀ CHÚNG TÔI', 'hieugara-motors'); ?></span>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100069673756551" target="_blank" rel="noopener" class="shiftup-rect-btn" style="background: #1877f2; border-color: #1877f2; color: #ffffff;" title="Theo dõi Fanpage Hải Hà Ô Tô trên Facebook">
                            <i class="fa-brands fa-facebook-f" style="margin-right: 6px;"></i>
                            <span>FANPAGE FB</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         SECTION 4: SHIFTUP SECTION 4 (ALL ABOUT CARS REPLICA - SWIPER CAROUSEL)
         Mousewheel Horizontal Scroll + Touch Drag + Dynamic WP Admin CRUD
         ========================================================================= -->
    <section class="shiftup-all-about-cars-section" id="dich-vu">
        <div class="container">
            
            <!-- Head with Title and Minimalist Carousel Arrows on Right -->
            <div class="all-about-head">
                <div class="all-about-title-group">
                    <span class="all-about-sub-label"><?php _e('DỊCH VỤ & NĂNG LỰC KỸ THUẬT', 'hieugara-motors'); ?></span>
                    <h2 class="all-about-title">ALL ABOUT CARS</h2>
                </div>
                <div class="all-about-arrows">
                    <button class="arrow-btn" id="allCarsPrevBtn" aria-label="<?php esc_attr_e('Trước', 'hieugara-motors'); ?>" title="<?php esc_attr_e('Trước', 'hieugara-motors'); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>
                    </button>
                    <button class="arrow-btn" id="allCarsNextBtn" aria-label="<?php esc_attr_e('Tiếp theo', 'hieugara-motors'); ?>" title="<?php esc_attr_e('Tiếp theo', 'hieugara-motors'); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>
                    </button>
                </div>
            </div>

            <!-- Dynamic Swiper Container with Mousewheel & Touch Drag -->
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
                            $badge = get_post_meta(get_the_ID(), '_garage_badge', true);
                            $price = get_post_meta(get_the_ID(), '_garage_price_from', true);
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
                                        <?php if (!empty($badge)) : ?>
                                            <span class="card-tech-badge"><?php echo esc_html($badge); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="card-item-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <span class="orange-bar">|</span> <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p class="card-item-desc"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 16); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="card-learn-more-link">
                                        <span><?php _e('Chi tiết quy trình & bảng giá', 'hieugara-motors'); ?></span>
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
                                'title' => 'CHẨN ĐOÁN ECU ĐỘNG CƠ',
                                'desc'  => 'Đọc dữ liệu cảm biến thời gian thực, quét lỗi toàn diện hệ thống điều khiển điện tử.',
                                'img'   => $shiftup_img . '/port-1.jpg',
                                'badge' => 'TIÊU CHUẨN ĐỨC'
                            ),
                            array(
                                'title' => 'CÀI ĐẶT HỘP ĐIỀU KHIỂN',
                                'desc'  => 'Coding & programming hộp đen cho xe Châu Âu: Mercedes, BMW, Audi, Porsche, Volkswagen.',
                                'img'   => $shiftup_img . '/port-2.jpg',
                                'badge' => 'CODING CHÂU ÂU'
                            ),
                            array(
                                'title' => 'CÂN CHỈNH MÂM LỐP HUNTER',
                                'desc'  => 'Cân bằng động Hunter và chỉnh góc đặt bánh xe 3D triệt tiêu hiện tượng nhao lái, mòn vẹt lốp.',
                                'img'   => $shiftup_img . '/port-3.jpg',
                                'badge' => 'CÔNG NGHỆ MỸ'
                            ),
                            array(
                                'title' => 'ĐỒNG SƠN PHÒNG SẤY HẤP',
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
                                        <span><?php _e('Chi tiết quy trình & bảng giá', 'hieugara-motors'); ?></span>
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

    <!-- =========================================================================
         SECTION 5: SHIFTUP SECTION 5 (4 FULL-WIDTH PANORAMIC BANNERS)
         Text-on-hover Glassmorphism Blur & Dual-Layer Sliding Title/Text
         (Identical to ShiftUp "Fuel System Cleaner" Replica)
         ========================================================================= -->
    <section class="shiftup-panoramic-banners">
        <div class="pano-banners-grid">

            <?php
            $pano_banners = array(
                array(
                    'title' => __('ĐỒNG SƠN SẤY HẤP', 'hieugara-motors'),
                    'desc'  => __('Quy trình sơn sấy khép kín công nghệ Châu Âu, bảo hành màu sơn 24 tháng theo biển số.', 'hieugara-motors'),
                    'img'   => $shiftup_img . '/banner-1.jpg',
                    'link'  => home_url('/bang-gia/#du-toan-son-xe')
                ),
                array(
                    'title' => __('BẢO DƯỠNG ĐỊNH KỲ', 'hieugara-motors'),
                    'desc'  => __('Quy trình kiểm tra 45 hạng mục toàn diện, quét lỗi điện tử ECU và thay dầu máy chính hãng.', 'hieugara-motors'),
                    'img'   => $shiftup_img . '/banner-2.jpg',
                    'link'  => home_url('/dat-lich/?service=' . urlencode('Bảo Dưỡng Định Kỳ'))
                ),
                array(
                    'title' => __('CHẨN ĐOÁN MÁY GẦM', 'hieugara-motors'),
                    'desc'  => __('Xử lý dứt điểm tiếng kêu gầm, căn chỉnh góc đặt bánh xe 3D Hunter triệt tiêu hoàn toàn nhao lái.', 'hieugara-motors'),
                    'img'   => $shiftup_img . '/banner-3.jpg',
                    'link'  => home_url('/dat-lich/?service=' . urlencode('Chẩn Đoán Máy Gầm'))
                ),
                array(
                    'title' => __('CHĂM SÓC XE DETAILING', 'hieugara-motors'),
                    'desc'  => __('Phủ bóng Ceramic Pro 9H kháng hóa chất, dán phim cách nhiệt 3M Crystalline và dán PPF cao cấp.', 'hieugara-motors'),
                    'img'   => $shiftup_img . '/banner-4.jpg',
                    'link'  => home_url('/dat-lich/?service=' . urlencode('Detailing & Dán phim cách nhiệt'))
                )
            );

            foreach ($pano_banners as $p) :
            ?>
                <div class="pano-banner-col">
                    <!-- High-Res Background Image that zooms on hover -->
                    <div class="pano-bg-img" style="background-image: url('<?php echo esc_url($p['img']); ?>');"></div>
                    
                    <!-- Base Gradient Darkness -->
                    <div class="pano-base-overlay"></div>

                    <!-- ShiftUp Frosted Glass Blur Overlay -->
                    <div class="pano-blur-overlay"></div>

                    <!-- Clickable full column link -->
                    <a href="<?php echo esc_url($p['link']); ?>" class="pano-full-link" aria-label="<?php echo esc_attr($p['title']); ?>"></a>

                    <!-- Interactive Content with ShiftUp Lift Up Animation -->
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
         SECTION 6: SHIFTUP SECTION 6 (INTERACTIVE DIAGNOSTICS FLANKED)
         2 Left Items + Center Chassis Scanner + 2 Right Items
         ========================================================================= -->
    <section class="shiftup-flanked-diagnostics">
        <div class="container">
            <div class="flanked-grid">

                <!-- Left 2 Items -->
                <div class="flanked-side-col">
                    <div class="flanked-diag-item active">
                        <h4 class="diag-item-title"><span class="orange-bar">|</span> HỆ THỐNG PHANH &amp; ABS</h4>
                        <p class="diag-item-text">Kiểm tra láng đĩa phanh chống rung giật, thay dầu phanh tuần hoàn chân không áp suất cao.</p>
                    </div>

                    <div class="flanked-diag-item">
                        <h4 class="diag-item-title"><span class="orange-bar">|</span> CÂN CHỈNH GÓC LÁI HUNTER 3D</h4>
                        <p class="diag-item-text">Đo góc nghiêng Camber, Caster, Toe bằng camera quang học 3D chuẩn xác, triệt tiêu nhao lái.</p>
                    </div>
                </div>

                <!-- Center: High-Tech Vertical Vehicle Component -->
                <div class="flanked-center-col">
                    <div class="center-scanner-box">
                        <img src="<?php echo esc_url($shiftup_img . '/center-car.jpg'); ?>" alt="Kiểm tra hệ thống gầm máy ô tô" class="center-scanner-img" loading="lazy">
                        <div class="scanner-laser-bar"></div>
                    </div>
                </div>

                <!-- Right 2 Items -->
                <div class="flanked-side-col">
                    <div class="flanked-diag-item">
                        <h4 class="diag-item-title"><span class="orange-bar">|</span> NỘI SOI ĐIỀU HÒA Ô TÔ</h4>
                        <p class="diag-item-text">Nội soi giàn lạnh không cần tháo taplo, khử khuẩn ẩm mốc, nạp gas R134a/R1234yf tinh khiết.</p>
                    </div>

                    <div class="flanked-diag-item">
                        <h4 class="diag-item-title"><span class="orange-bar">|</span> QUÉT LỖI HỘP ĐEN ECU</h4>
                        <p class="diag-item-text">Đọc live data stream, kiểm tra kim phun, bugi, áp suất buồng đốt và xóa mã lỗi hệ thống.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 7: SHIFTUP SECTION 10 (CHECK UP OFFERS / 3 PRICING TABLES)
         3 Pricing Tables with Top Image, Separator, and + Buttons
         ========================================================================= -->
    <section class="shiftup-checkup-offers-section" id="bang-gia">
        <div class="container">
            
            <div class="checkup-head text-center">
                <h2 class="checkup-title">CHECK UP OFFERS</h2>
                <p class="checkup-sub">Bảng giá gói bảo dưỡng định kỳ niêm yết minh bạch 100%, không phát sinh phụ phí.</p>
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
                            <li><span class="orange-bar">|</span> Toàn bộ hạng mục cấp 5.000km</li>
                            <li><span class="orange-bar">|</span> Thay mới lọc dầu động cơ OEM</li>
                            <li><span class="orange-bar">|</span> Vệ sinh &amp; bảo dưỡng phanh 4 bánh</li>
                            <li><span class="orange-bar">|</span> Đảo lốp định kỳ chống mòn vẹt</li>
                            <li><span class="orange-bar">|</span> Quét chẩn đoán lỗi ECU toàn xe</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp trung bình 10.000km'))); ?>" class="checkup-btn btn-primary-featured">
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
                            <span>TOÀN DIỆN</span>
                            <span class="sep-dot">•</span>
                            <span>CẤP 40.000 KM</span>
                        </div>
                        <div class="card-price-row">
                            <span class="price-val">5.800.000</span>
                            <span class="price-cur">đ</span>
                        </div>
                        <ul class="card-features-list">
                            <li><span class="orange-bar">|</span> Toàn bộ hạng mục cấp trung bình lớn</li>
                            <li><span class="orange-bar">|</span> Thay dầu phanh, dầu trợ lực, dầu hộp số</li>
                            <li><span class="orange-bar">|</span> Thay nước làm mát động cơ tuần hoàn</li>
                            <li><span class="orange-bar">|</span> Thay bu-gi đánh lửa &amp; kiểm tra curoa</li>
                            <li><span class="orange-bar">|</span> Nội soi bảo dưỡng giàn lạnh điều hòa</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp lớn 40.000km'))); ?>" class="checkup-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>+ ĐẶT LỊCH GÓI NÀY</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =========================================================================
         SECTION 8: PARTNERS & LUXURY CAR BRANDS MARQUEE (Continuous Ticker)
         Replaces Warranty Search, Fully Editable & Managed via WordPress Admin
         ========================================================================= -->
    <?php
    $brand_logos = function_exists('hieugara_get_brand_logos') ? hieugara_get_brand_logos() : array();
    $active_brands = array();
    foreach ($brand_logos as $b) {
        if (!empty($b['enable']) && !empty($b['logo'])) {
            $active_brands[] = $b;
        }
    }
    if (empty($active_brands) && function_exists('hieugara_get_default_brand_logos')) {
        $active_brands = array_values(hieugara_get_default_brand_logos());
    }
    ?>
    <section class="shiftup-brand-marquee-section" id="doi-tac-thuong-hieu">
        <div class="container marquee-head-container">
            <div class="marquee-head text-center">
                <span class="marquee-sub-label"><?php _e('TIÊU CHUẨN KỸ THUẬT QUỐC TẾ', 'hieugara-motors'); ?></span>
                <h2 class="marquee-title"><span class="orange-bar">|</span> ĐỐI TÁC &amp; THƯƠNG HIỆU ĐỒNG HÀNH</h2>
                <p class="marquee-desc"><?php _e('Hải Hà Auto Service chuyên sâu bảo dưỡng, đại tu và cung cấp phụ tùng OEM chính hãng cho các dòng xe hàng đầu thế giới.', 'hieugara-motors'); ?></p>
            </div>
        </div>

        <div class="marquee-strip-wrap">
            <div class="brand-marquee" style="mask-image: linear-gradient(to right, transparent 0%, black 12%, black 88%, transparent 100%); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 12%, black 88%, transparent 100%);">
                <div class="brand-marquee-track">
                    <!-- First group of logos -->
                    <div class="brand-marquee-group">
                        <?php foreach ($active_brands as $b) : ?>
                            <a href="<?php echo esc_url(!empty($b['url']) ? $b['url'] : '#'); ?>" <?php echo !empty($b['url']) && $b['url'] !== '#' ? 'target="_blank" rel="noopener"' : ''; ?> class="brand-capsule-card" title="<?php echo esc_attr($b['name']); ?>">
                                <div class="capsule-gradient-bg" style="background-image: linear-gradient(135deg, <?php echo esc_attr(!empty($b['grad1']) ? $b['grad1'] : '#0f172a'); ?> 0%, <?php echo esc_attr(!empty($b['grad2']) ? $b['grad2'] : '#334155'); ?> 100%);"></div>
                                <img src="<?php echo esc_url($b['logo']); ?>" alt="<?php echo esc_attr($b['name']); ?>" loading="lazy" class="brand-logo-img">
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Duplicate group for seamless infinite CSS loop -->
                    <div class="brand-marquee-group" aria-hidden="true">
                        <?php foreach ($active_brands as $b) : ?>
                            <a href="<?php echo esc_url(!empty($b['url']) ? $b['url'] : '#'); ?>" <?php echo !empty($b['url']) && $b['url'] !== '#' ? 'target="_blank" rel="noopener"' : ''; ?> class="brand-capsule-card" title="<?php echo esc_attr($b['name']); ?>">
                                <div class="capsule-gradient-bg" style="background-image: linear-gradient(135deg, <?php echo esc_attr(!empty($b['grad1']) ? $b['grad1'] : '#0f172a'); ?> 0%, <?php echo esc_attr(!empty($b['grad2']) ? $b['grad2'] : '#334155'); ?> 100%);"></div>
                                <img src="<?php echo esc_url($b['logo']); ?>" alt="<?php echo esc_attr($b['name']); ?>" loading="lazy" class="brand-logo-img">
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SECTION 9: WORKSHOP NETWORK (3 Chi Nhánh Xưởng)
         ========================================================================= -->
    <section class="shiftup-workshops-section" id="mang-luoi-xuong">
        <div class="container">
            <div class="workshops-head">
                <h2 class="workshops-title"><span class="orange-bar">|</span> HỆ THỐNG XƯỞNG DỊCH VỤ HẢI HÀ AUTO</h2>
                <a href="<?php echo esc_url(home_url('/garage-gan-ban/')); ?>" class="workshops-all-link">Xem tất cả 7 chi nhánh &rarr;</a>
            </div>

            <div class="workshops-3col-grid">
                
                <div class="ws-clean-card">
                    <span class="ws-city-tag">TRỤ SỞ CHÍNH // HẢI HÀ</span>
                    <h3 class="ws-name">Gara Ô Tô Hải Hà</h3>
                    <p class="ws-address">Trung tâm chẩn đoán, sửa chữa máy gầm, điều hòa &amp; phòng sơn sấy hấp</p>
                    <div class="ws-info-line"><i class="fa fa-phone text-orange"></i> Tổng đài: <strong><?php echo esc_html($hotline_phone); ?></strong></div>
                    <div class="ws-info-line"><i class="fa fa-truck-pickup text-orange"></i> Cứu hộ 24/7: <strong><?php echo esc_html($rescue_phone); ?></strong></div>
                    <div class="ws-actions">
                        <a href="<?php echo esc_url(home_url('/dat-lich/?branch=' . urlencode('Trụ sở Gara Hải Hà'))); ?>" class="ws-link-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>+ ĐẶT LỊCH</span>
                        </a>
                        <a href="https://maps.google.com/?cid=15399047910545937753" target="_blank" rel="noopener" class="ws-link-btn ghost">
                            <span>BẢN ĐỒ</span>
                        </a>
                    </div>
                </div>

                <div class="ws-clean-card">
                    <span class="ws-city-tag">KỸ THUẬT &amp; BÁO GIÁ</span>
                    <h3 class="ws-name">Tư Vấn Kỹ Thuật Trực Tuyến</h3>
                    <p class="ws-address">Đội ngũ kỹ sư trưởng hỗ trợ chẩn đoán từ xa, tư vấn mã phụ tùng OEM</p>
                    <div class="ws-info-line"><i class="fa fa-wrench text-orange"></i> Kỹ thuật: <strong>0915 041 989</strong></div>
                    <div class="ws-info-line"><i class="fa-solid fa-comment-dots text-orange"></i> Zalo: <strong>0911 211 996</strong></div>
                    <div class="ws-actions">
                        <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="ws-link-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>CHAT ZALO</span>
                        </a>
                        <a href="tel:0915041989" class="ws-link-btn ghost">
                            <span>GỌI KỸ THUẬT</span>
                        </a>
                    </div>
                </div>

                <div class="ws-clean-card">
                    <span class="ws-city-tag">CỨU HỘ &amp; LƯU ĐỘNG</span>
                    <h3 class="ws-name">Cứu Hộ Giao Thông 24/7</h3>
                    <p class="ws-address">Trực ban cứu hộ kéo xe sàn trượt, kích bình ắc quy, thay lốp dự phòng</p>
                    <div class="ws-info-line"><i class="fa fa-truck-pickup text-orange"></i> Trực ban: <strong>0911 211 996</strong></div>
                    <div class="ws-info-line"><i class="fa fa-phone text-orange"></i> Bàn xưởng: <strong>02203 892 207</strong></div>
                    <div class="ws-actions">
                        <a href="tel:0911211996" class="ws-link-btn">
                            <span class="btn-orange-bar">|</span>
                            <span>GỌI 24/7</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/dat-lich/')); ?>" class="ws-link-btn ghost">
                            <span>ĐẶT HẸN</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
