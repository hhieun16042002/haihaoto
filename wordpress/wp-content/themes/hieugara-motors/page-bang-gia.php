<?php
/**
 * Template Name: Bảng Giá Dịch Vụ & Dự Toán Sơn Gò (Carpla Price Portal)
 * The template for displaying the dedicated service price list and paint estimator.
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main page-price-portal">

    <!-- Page Breadcrumb & Header -->
    <section class="portal-hero-header">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Bảng giá dịch vụ tiêu chuẩn', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php _e('Bảng Giá Niêm Yết & Dự Toán Sơn Gò Ô Tô', 'hieugara-motors'); ?></h1>
            <p class="portal-page-subtitle">
                <?php _e('Hải Hà Auto Service cam kết tính minh bạch 100%: Giá dịch vụ đã bao gồm công thợ kỹ thuật, phụ tùng chính hãng và không phát sinh bất kỳ chi phí ẩn nào.', 'hieugara-motors'); ?>
            </p>
        </div>
    </section>

    <!-- SECTION 1: Bảng Giá Bảo Dưỡng Định Kỳ Theo Cấp (Carpla Standards) -->
    <section class="price-tables-section">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('BẢO DƯỠNG ĐỊNH KỲ CHUYÊN NGHIỆP', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Bảng Giá Bảo Dưỡng Theo Cấp KM', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Quy trình kiểm tra 45 hạng mục chuẩn hãng, sử dụng dầu nhớt tổng hợp cao cấp và phụ tùng thay thế chính hãng.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="maintenance-tiers-grid">
                <!-- Tier 1: Cấp Nhỏ (5.000km) -->
                <div class="tier-card">
                    <div class="tier-badge">CẤP 1 (5.000 KM)</div>
                    <h3 class="tier-name">Bảo Dưỡng Cấp Nhỏ</h3>
                    <div class="tier-price">Từ 550.000 đ</div>
                    <p class="tier-desc">Dành cho xe chạy mốc 5.000km, 15.000km, 25.000km, 35.000km...</p>
                    <ul class="tier-checklist">
                        <li><i class="fa fa-check"></i> Thay dầu động cơ tổng hợp chính hãng</li>
                        <li><i class="fa fa-check"></i> Kiểm tra & vệ sinh lọc gió động cơ, lọc gió điều hòa</li>
                        <li><i class="fa fa-check"></i> Bổ sung nước rửa kính, nước làm mát</li>
                        <li><i class="fa fa-check"></i> Kiểm tra áp suất lốp & siết lực ốc bánh xe</li>
                        <li><i class="fa fa-check"></i> Kiểm tra hệ thống đèn tín hiệu & ắc quy</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp nhỏ 5.000km'))); ?>" class="btn-carpla btn-carpla-outline tier-btn">
                        Đặt Lịch Cấp 5.000km
                    </a>
                </div>

                <!-- Tier 2: Cấp Trung Bình (10.000km) -->
                <div class="tier-card featured">
                    <div class="featured-ribbon">PHỔ BIẾN NHẤT</div>
                    <div class="tier-badge">CẤP 2 (10.000 KM)</div>
                    <h3 class="tier-name">Bảo Dưỡng Cấp Trung Bình</h3>
                    <div class="tier-price">Từ 1.250.000 đ</div>
                    <p class="tier-desc">Dành cho xe chạy mốc 10.000km, 30.000km, 50.000km, 70.000km...</p>
                    <ul class="tier-checklist">
                        <li><i class="fa fa-check"></i> Toàn bộ hạng mục của Cấp 5.000km</li>
                        <li><i class="fa fa-check"></i> Thay mới lọc dầu động cơ chính hãng</li>
                        <li><i class="fa fa-check"></i> Vệ sinh & bảo dưỡng hệ thống phanh 4 bánh</li>
                        <li><i class="fa fa-check"></i> Đảo lốp định kỳ chống mòn lệch</li>
                        <li><i class="fa fa-check"></i> Quét chẩn đoán lỗi ECU toàn xe bằng máy đọc lỗi</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp trung bình 10.000km'))); ?>" class="btn-carpla btn-carpla-primary tier-btn">
                        Đặt Lịch Cấp 10.000km
                    </a>
                </div>

                <!-- Tier 3: Cấp Trung Bình Lớn (20.000km) -->
                <div class="tier-card">
                    <div class="tier-badge">CẤP 3 (20.000 KM)</div>
                    <h3 class="tier-name">Bảo Dưỡng Cấp Trung Bình Lớn</h3>
                    <div class="tier-price">Từ 2.450.000 đ</div>
                    <p class="tier-desc">Dành cho xe chạy mốc 20.000km, 60.000km, 100.000km...</p>
                    <ul class="tier-checklist">
                        <li><i class="fa fa-check"></i> Toàn bộ hạng mục của Cấp 10.000km</li>
                        <li><i class="fa fa-check"></i> Thay mới lọc gió động cơ & lọc gió điều hòa</li>
                        <li><i class="fa fa-check"></i> Vệ sinh họng hút & kim phun nhiên liệu</li>
                        <li><i class="fa fa-check"></i> Cân bằng động 4 bánh xe</li>
                        <li><i class="fa fa-check"></i> Kiểm tra rô-tuyn, cao su giảm chấn, giảm xóc</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp trung bình lớn 20.000km'))); ?>" class="btn-carpla btn-carpla-outline tier-btn">
                        Đặt Lịch Cấp 20.000km
                    </a>
                </div>

                <!-- Tier 4: Cấp Lớn (40.000km) -->
                <div class="tier-card">
                    <div class="tier-badge">CẤP 4 (40.000 KM)</div>
                    <h3 class="tier-name">Bảo Dưỡng Cấp Lớn Toàn Diện</h3>
                    <div class="tier-price">Từ 5.800.000 đ</div>
                    <p class="tier-desc">Dành cho xe chạy mốc 40.000km, 80.000km, 120.000km...</p>
                    <ul class="tier-checklist">
                        <li><i class="fa fa-check"></i> Toàn bộ hạng mục của Cấp 20.000km</li>
                        <li><i class="fa fa-check"></i> Thay dầu phanh, dầu trợ lực lái, dầu hộp số</li>
                        <li><i class="fa fa-check"></i> Thay nước làm mát động cơ tuần hoàn</li>
                        <li><i class="fa fa-check"></i> Thay bu-gi đánh lửa & kiểm tra dây curoa</li>
                        <li><i class="fa fa-check"></i> Nội soi bảo dưỡng giàn lạnh điều hòa ô tô</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Bảo dưỡng cấp lớn 40.000km'))); ?>" class="btn-carpla btn-carpla-outline tier-btn">
                        Đặt Lịch Cấp 40.000km
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 1B: 12 DANH MỤC DỊCH VỤ KỸ THUẬT Ô TÔ CHUYÊN NGHIỆP -->
    <section class="section-12-services" id="danh-muc-dich-vu">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 40px;">
                <div class="section-pill" style="display: inline-block; background: rgba(255, 77, 36, 0.1); color: #ff4d24; border: 1px solid rgba(255, 77, 36, 0.3); padding: 4px 14px; border-radius: 20px; font-weight: 700; font-size: 0.8rem; margin-bottom: 12px; font-family: 'Chakra Petch', sans-serif;">
                    HỆ THỐNG 6 NHÓM DỊCH VỤ Ô TÔ TOÀN DIỆN
                </div>
                <h2 class="section-title" style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-bottom: 10px; font-family: 'Chakra Petch', sans-serif;">
                    Danh Mục Dịch Vụ Kỹ Thuật Ô Tô Chuyên Nghiệp
                </h2>
                <p class="section-desc" style="color: #64748b; max-width: 760px; margin: 0 auto; font-size: 0.95rem;">
                    Hải Hà Ô Tô (31 năm kinh nghiệm từ 1995 &bull; 80 nhân sự tận tâm) phân chia hệ thống dịch vụ thành 6 nhóm chuẩn SEO giúp khách hàng dễ dàng tra cứu quy trình, thời gian xử lý và bảng giá minh bạch.
                </p>
            </div>

            <div class="services-12-cards-grid">
                <?php
                $cat_icons = array(
                    'bao-duong-o-to'            => 'fa-clock-rotate-left',
                    'bao-duong-dinh-ky'         => 'fa-clock-rotate-left',
                    'thay-dau-va-loc-o-to'      => 'fa-oil-can',
                    'kiem-tra-va-bao-duong-tong-quat' => 'fa-list-check',
                    'sua-chua-o-to'             => 'fa-gears',
                    'sua-chua-dong-co'          => 'fa-gears',
                    'sua-chua-hop-so-va-truyen-dong' => 'fa-arrows-split-up-and-left',
                    'sua-chua-he-thong-phanh'   => 'fa-circle-dot',
                    'sua-chua-gam-va-he-thong-treo' => 'fa-dharmachakra',
                    'sua-chua-he-thong-lai'     => 'fa-crosshairs',
                    'sua-chua-he-thong-xa-va-khi-thai' => 'fa-smog',
                    'dien-va-dieu-hoa-o-to'     => 'fa-bolt',
                    'sua-chua-dien-o-to'        => 'fa-bolt',
                    'sua-chua-dien-tu-va-ecu'   => 'fa-microchip',
                    'sua-chua-dieu-hoa-o-to'    => 'fa-snowflake',
                    'he-thong-lam-mat-o-to'     => 'fa-fan',
                    'dong-son-va-ngoai-that-o-to' => 'fa-spray-can-sparkles',
                    'son-o-to'                  => 'fa-spray-can-sparkles',
                    'go-han-va-sua-chua-than-vo'=> 'fa-hammer',
                    'sua-chua-kinh-va-den-o-to' => 'fa-lightbulb',
                    'sua-chua-o-to-sau-va-cham' => 'fa-car-burst',
                    'cham-soc-va-nang-cap-o-to' => 'fa-wand-magic-sparkles',
                    'cham-soc-va-lam-dep-xe-detailing' => 'fa-wand-magic-sparkles',
                    've-sinh-noi-that-o-to'     => 'fa-couch',
                    'danh-bong-va-phu-ceramic'  => 'fa-gem',
                    'phu-kien-va-nang-cap-o-to' => 'fa-sliders',
                    'nang-cap-anh-sang-va-am-thanh' => 'fa-volume-high',
                    'phim-cach-nhiet-va-ppf'    => 'fa-shield',
                    'dich-vu-ho-tro-o-to'       => 'fa-truck-pickup',
                    'cuu-ho-giao-thong-o-to'    => 'fa-truck-pickup',
                    'kiem-tra-xe-cu-truoc-khi-mua' => 'fa-magnifying-glass',
                    'dich-vu-dang-kiem-o-to'    => 'fa-clipboard-check',
                    'sua-chua-o-to-luu-dong'    => 'fa-wrench',
                    'bao-duong-xe-doanh-nghiep' => 'fa-building',
                    'bao-hiem-va-bao-hanh-o-to' => 'fa-handshake'
                );

                $services_query = new WP_Query(array(
                    'post_type'              => 'garage_service',
                    'posts_per_page'         => 30,
                    'orderby'                => 'ID',
                    'order'                  => 'ASC',
                    'no_found_rows'          => true,
                    'update_post_meta_cache' => true,
                    'update_post_term_cache' => true,
                ));

                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $badge = get_post_meta(get_the_ID(), '_garage_badge', true) ?: 'CHUYÊN HÃNG';
                        $price = get_post_meta(get_the_ID(), '_service_price', true) ?: (get_post_meta(get_the_ID(), '_garage_price', true) ?: 'Liên hệ');
                        $duration = get_post_meta(get_the_ID(), '_service_duration', true) ?: (get_post_meta(get_the_ID(), '_garage_duration', true) ?: '45 - 90 phút');
                        $warranty = get_post_meta(get_the_ID(), '_service_warranty', true) ?: (get_post_meta(get_the_ID(), '_garage_warranty', true) ?: '12 tháng');
                        $features = hieugara_get_service_features(get_the_ID());

                        $terms = get_the_terms(get_the_ID(), 'service_category');
                        $cat_slug = ($terms && !is_wp_error($terms)) ? $terms[0]->slug : 'bao-duong-dinh-ky';
                        $icon = isset($cat_icons[$cat_slug]) ? $cat_icons[$cat_slug] : 'fa-wrench';
                ?>
                    <div class="service-12-card">
                        <div class="card-head">
                            <div class="head-left">
                                <span class="card-icon-box"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></span>
                                <div>
                                    <span class="card-badge"><?php echo esc_html($badge); ?></span>
                                    <h3 class="card-service-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-meta-row">
                            <div class="meta-item">
                                <small>GIÁ THAM KHẢO</small>
                                <strong class="price-val"><?php echo esc_html($price); ?></strong>
                            </div>
                            <div class="meta-item">
                                <small>THỜI GIAN</small>
                                <span><i class="fa fa-clock"></i> <?php echo esc_html($duration); ?></span>
                            </div>
                            <div class="meta-item">
                                <small>BẢO HÀNH</small>
                                <span><i class="fa fa-shield-halved text-orange"></i> <?php echo esc_html($warranty); ?></span>
                            </div>
                        </div>

                        <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>

                        <?php if (!empty($features)) : ?>
                        <ul class="card-feature-list">
                            <?php foreach (array_slice($features, 0, 4) as $feat) : ?>
                                <li><i class="fa fa-check text-orange"></i> <span><?php echo esc_html($feat); ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <div class="card-action-btns">
                            <a href="<?php the_permalink(); ?>" class="btn-detail-link">
                                <span>Xem quy trình &amp; dấu hiệu</span> &rarr;
                            </a>
                            <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode(get_the_title()))); ?>" class="btn-book-service">
                                <i class="fa fa-calendar-check"></i> Đặt lịch ngay
                            </a>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 2: Interactive Paint Estimator (360° Car Body Estimator) -->
    <section class="section-paint-estimator" id="du-toan-son-xe">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('DỰ TOÁN CHI PHÍ TRỰC QUAN', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Công Cụ Tính Giá Sơn Gò Ô Tô Tức Thì', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Phòng sơn sấy khép kín tiêu chuẩn Đức, sử dụng sơn gốc nước Axalta cao cấp chuẩn màu 100%. Bấm chọn vị trí cần sơn để xem giá ngay.', 'hieugara-motors'); ?>
                </p>
            </div>

            <!-- Selectors and Live Receipt Layout -->
            <div class="paint-calc-layout">
                <div class="paint-selectors-col">
                    <div class="paint-panel-intro">
                        <span class="blueprint-badge"><i class="fa fa-crosshairs"></i> <?php _e('CHỌN BỘ PHẬN THÂN VỎ CẦN SƠN DẶM / GÒ HÀN', 'hieugara-motors'); ?></span>
                        <p><?php _e('Bấm vào từng vị trí để chọn hoặc bỏ chọn. Hệ thống tự động tính thời gian sấy hấp và chi phí chuẩn.', 'hieugara-motors'); ?></p>
                    </div>

                    <div class="paint-part-selector">
                        <div class="paint-part-btn" data-part-key="can_truoc" data-part-name="Cản trước (Ba-đờ-xốc trước)" data-part-price="800000">
                            <div class="part-icon"><i class="fa fa-car-side"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Cản trước (Ba-đờ-xốc trước)', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Sơn dặm hoặc sơn toàn phần cản trước</span>
                            </div>
                            <span class="part-price">800.000 đ</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="can_sau" data-part-name="Cản sau (Ba-đờ-xốc sau)" data-part-price="800000">
                            <div class="part-icon"><i class="fa fa-car-side"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Cản sau (Ba-đờ-xốc sau)', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Khắc phục xước xát góc đuôi xe</span>
                            </div>
                            <span class="part-price">800.000 đ</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="capo" data-part-name="Nắp Ca-pô trước" data-part-price="1200000">
                            <div class="part-icon"><i class="fa fa-shield"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Nắp Ca-pô trước', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Sơn sấy nhiệt độ chuẩn bóng gương</span>
                            </div>
                            <span class="part-price">1.200.000 đ</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="cop_sau" data-part-name="Cốp sau (Cửa hậu)" data-part-price="1000000">
                            <div class="part-icon"><i class="fa fa-box-archive"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Cửa Cốp sau', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Cốp mở sau xe sedan hoặc SUV</span>
                            </div>
                            <span class="part-price">1.000.000 đ</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="cua_xe" data-part-name="Cánh cửa xe (1 cánh)" data-part-price="700000">
                            <div class="part-icon"><i class="fa fa-door-open"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Cánh cửa xe', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Cửa trước/sau (đơn giá tính theo 1 cánh)</span>
                            </div>
                            <span class="part-price">700.000 đ / cánh</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="tai_xe" data-part-name="Tai xe / Vè trước (1 bên)" data-part-price="500000">
                            <div class="part-icon"><i class="fa fa-circle-dot"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Tai vè trước (1 bên)', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Tai vè hông bánh xe trước trái/phải</span>
                            </div>
                            <span class="part-price">500.000 đ / bên</span>
                        </div>

                        <div class="paint-part-btn" data-part-key="noc_xe" data-part-name="Nóc mui xe" data-part-price="1500000">
                            <div class="part-icon"><i class="fa fa-arrows-up-to-line"></i></div>
                            <div class="part-info">
                                <span class="part-name"><?php _e('Nóc mui xe', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Mui trần trên nóc xe</span>
                            </div>
                            <span class="part-price">1.500.000 đ</span>
                        </div>

                        <div class="paint-part-btn featured-paint-pkg" data-part-key="full_car" data-part-name="Gói sơn đổi màu / Sơn quây toàn bộ xe" data-part-price="16000000">
                            <div class="part-icon" style="color: var(--brand-red);"><i class="fa fa-star"></i></div>
                            <div class="part-info">
                                <span class="part-name" style="color: var(--brand-red); font-weight: 800;"><?php _e('Gói sơn quây đổi màu toàn xe', 'hieugara-motors'); ?></span>
                                <span class="part-sub">Bảo hành 24 tháng, tặng gói phủ bóng Ceramic 9H</span>
                            </div>
                            <span class="part-price" style="color: var(--brand-red); font-weight: 900;">16.000.000 đ</span>
                        </div>
                    </div>
                </div>

                <!-- Receipt Box -->
                <div class="paint-summary-card">
                    <div class="summary-head">
                        <span class="summary-tag"><i class="fa fa-receipt"></i> HÓA ĐƠN DỰ TOÁN</span>
                        <h3 class="summary-title"><?php _e('Chi Phí Sơn Dự Kiến', 'hieugara-motors'); ?></h3>
                    </div>

                    <div id="paint-selected-items" class="summary-items-list">
                        <!-- Dynamic items -->
                    </div>

                    <div class="summary-meta-box">
                        <div class="meta-label"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></div>
                        <strong id="paint-duration-text" class="meta-value">Chưa chọn bộ phận</strong>
                    </div>

                    <div class="summary-total-row">
                        <span class="total-lbl"><?php _e('TỔNG DỰ TOÁN:', 'hieugara-motors'); ?></span>
                        <strong id="paint-total-amount" class="total-val">0 đ</strong>
                    </div>

                    <div class="summary-guarantee-note">
                        <i class="fa fa-shield-check" style="color: #10b981;"></i>
                        <span>Bảo hành chất lượng sơn không bong tróc 24 tháng theo biển số điện tử.</span>
                    </div>

                    <div style="margin-top: 20px;">
                        <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Đồng sơn sấy hấp công nghệ cao'))); ?>" class="btn-carpla btn-carpla-primary btn-summary-book">
                            <i class="fa fa-calendar-check"></i> <?php _e('ĐẶT HẸN PHÒNG SƠN NGAY', 'hieugara-motors'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
