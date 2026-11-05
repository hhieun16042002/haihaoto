<?php
/**
 * Hiếu Gara Service Front Page Template
 * Inspired by CARPLA SERVICE (service.carpla.vn)
 *
 * @package HieuGara_Motors
 */

get_header();

$services_query = new WP_Query(array(
    'post_type'      => 'garage_service',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC'
));
?>

<main id="primary" class="site-main">

    <!-- 1. Hero Section with Carpla Quick Booking Engine -->
    <section class="carpla-hero">
        <div class="container">
            <div class="hero-grid">
                <!-- Left: Branding & Value Proposition -->
                <div class="hero-info">
                    <div class="hero-tag">
                        <i class="fa fa-circle-check" style="color: var(--brand-red);"></i>
                        <span><?php _e('TIÊU CHUẨN XƯỞNG DỊCH VỤ Ô TÔ TOÀN DIỆN', 'hieugara-motors'); ?></span>
                    </div>

                    <h1 class="hero-title">
                        HỆ THỐNG XƯỞNG DỊCH VỤ Ô TÔ <span class="text-gradient">HIẾU GARA</span>
                    </h1>

                    <p class="hero-desc">
                        <?php _e('Chuyên môn hóa từ bảo dưỡng định kỳ, chẩn đoán sửa chữa máy gầm điện lạnh chuyên sâu đến phục hồi đồng sơn công nghệ cao với quy trình 6 bước chuẩn hóa, phụ tùng chính hãng và chi phí minh bạch.', 'hieugara-motors'); ?>
                    </p>

                    <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 30px;">
                        <a href="#dich-vu" class="btn-carpla btn-carpla-primary">
                            <?php _e('KHÁM PHÁ DỊCH VỤ', 'hieugara-motors'); ?> <i class="fa fa-arrow-right"></i>
                        </a>
                        <a href="#mang-luoi-xuong" class="btn-carpla btn-carpla-outline">
                            <i class="fa fa-location-dot"></i> <?php _e('TÌM XƯỞNG GẦN BẠN', 'hieugara-motors'); ?>
                        </a>
                    </div>

                    <div style="display: flex; gap: 32px; align-items: center; font-size: 0.875rem; color: var(--slate-600);">
                        <div><strong style="color: var(--slate-900); font-size: 1.25rem; display: block;">50.000+</strong> <?php _e('Lượt xe chăm sóc mỗi năm', 'hieugara-motors'); ?></div>
                        <div style="border-left: 1px solid var(--slate-200); padding-left: 32px;"><strong style="color: var(--slate-900); font-size: 1.25rem; display: block;">98.5%</strong> <?php _e('Khách hàng hài lòng', 'hieugara-motors'); ?></div>
                    </div>
                </div>

                <!-- Right: Carpla Floating Booking Engine Card -->
                <div class="hero-engine">
                    <div class="booking-engine-card">
                        <div class="engine-header">
                            <div>
                                <span style="font-size: 0.75rem; font-weight: 700; color: var(--brand-red); text-transform: uppercase; letter-spacing: 0.05em;"><?php _e('ĐẶT HẸN TIẾP NHẬN XE TRỰC TUYẾN', 'hieugara-motors'); ?></span>
                                <h3><?php _e('Đăng Ký Dịch Vụ Trong 1 Phút', 'hieugara-motors'); ?></h3>
                            </div>
                            <div style="width: 36px; height: 36px; background: var(--brand-red-light); color: var(--brand-red); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-bolt"></i>
                            </div>
                        </div>

                        <form class="hieugara-ajax-form">
                            <div class="engine-grid">
                                <div class="engine-field">
                                    <label><?php _e('Họ và tên của bạn (*)', 'hieugara-motors'); ?></label>
                                    <input type="text" name="customer_name" class="engine-input" required placeholder="VD: Nguyễn Văn A">
                                </div>
                                <div class="engine-field">
                                    <label><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                                    <input type="tel" name="customer_phone" class="engine-input" required placeholder="09xx xxx xxx">
                                </div>
                            </div>

                            <div class="engine-grid">
                                <div class="engine-field">
                                    <label><?php _e('Dòng xe của bạn', 'hieugara-motors'); ?></label>
                                    <input type="text" name="car_model" class="engine-input" placeholder="VD: Mazda 3, Vios, CR-V...">
                                </div>
                                <div class="engine-field">
                                    <label><?php _e('Gói dịch vụ cần làm', 'hieugara-motors'); ?></label>
                                    <select name="service_type" class="engine-select">
                                        <option value="Bảo dưỡng định kỳ"><?php _e('Bảo dưỡng định kỳ', 'hieugara-motors'); ?></option>
                                        <option value="Đồng sơn - Khắc phục vết xước"><?php _e('Đồng sơn - Khắc phục vết xước', 'hieugara-motors'); ?></option>
                                        <option value="Sửa chữa máy gầm"><?php _e('Sửa chữa máy gầm', 'hieugara-motors'); ?></option>
                                        <option value="Điện - Điều hòa ô tô"><?php _e('Điện - Điều hòa ô tô', 'hieugara-motors'); ?></option>
                                        <option value="Chăm sóc xe Detailing & PPF"><?php _e('Chăm sóc xe Detailing & PPF', 'hieugara-motors'); ?></option>
                                        <option value="Bồi thường bảo hiểm thân vỏ"><?php _e('Bồi thường bảo hiểm thân vỏ', 'hieugara-motors'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="engine-field" style="margin-bottom: 16px;">
                                <label><?php _e('Chọn xưởng dịch vụ tiếp nhận', 'hieugara-motors'); ?></label>
                                <select name="branch_location" class="engine-select">
                                    <option value="Xưởng Cầu Giấy (Số 500 Cầu Giấy, HN)">Xưởng Cầu Giấy - Số 500 Cầu Giấy, Hà Nội</option>
                                    <option value="Xưởng Tây Hồ (Số 685 Lạc Long Quân, HN)">Xưởng Tây Hồ - Số 685 Lạc Long Quân, Hà Nội</option>
                                    <option value="Xưởng Long Biên (Số 390 Nguyễn Văn Cừ, HN)">Xưởng Long Biên - Số 390 Nguyễn Văn Cừ, Hà Nội</option>
                                    <option value="Xưởng Hoàng Mai (Số 820 Giải Phóng, HN)">Xưởng Hoàng Mai - Số 820 Giải Phóng, Hà Nội</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-carpla btn-carpla-primary" style="width: 100%; padding: 14px;">
                                <i class="fa fa-calendar-check"></i> <?php _e('TÌM XƯỞNG & ĐẶT HẸN TIẾP NHẬN', 'hieugara-motors'); ?>
                            </button>
                            <div class="form-response-msg" style="display:none;"></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 4 Value Pillars -->
            <div class="pillars-row">
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fa fa-user-check"></i></div>
                    <div>
                        <div class="pillar-title"><?php _e('Kỹ thuật viên chứng chỉ', 'hieugara-motors'); ?></div>
                        <div class="pillar-subtitle"><?php _e('Đào tạo bài bản theo quy chuẩn hãng', 'hieugara-motors'); ?></div>
                    </div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fa fa-microchip"></i></div>
                    <div>
                        <div class="pillar-title"><?php _e('Thiết bị chẩn đoán cao cấp', 'hieugara-motors'); ?></div>
                        <div class="pillar-subtitle"><?php _e('Đọc quét lỗi ECU thế hệ mới', 'hieugara-motors'); ?></div>
                    </div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fa fa-certificate"></i></div>
                    <div>
                        <div class="pillar-title"><?php _e('100% Phụ tùng minh bạch', 'hieugara-motors'); ?></div>
                        <div class="pillar-subtitle"><?php _e('Nguồn gốc chính hãng & bảo hành 1-2 năm', 'hieugara-motors'); ?></div>
                    </div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon"><i class="fa fa-network-wired"></i></div>
                    <div>
                        <div class="pillar-title"><?php _e('Mạng lưới xưởng đồng bộ', 'hieugara-motors'); ?></div>
                        <div class="pillar-subtitle"><?php _e('Cầu nâng thủy lực & phòng sơn sấy Ý', 'hieugara-motors'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Core Services Grid -->
    <section class="section-services" id="dich-vu">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('DANH MỤC DỊCH VỤ TIÊU CHUẨN', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Dịch Vụ Ô Tô Toàn Diện Tại Hiếu Gara', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Cung cấp trọn gói các giải pháp kỹ thuật, chăm sóc và làm đẹp cho mọi dòng xe từ phổ thông đến hạng sang.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 28px;">
                <?php
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $price    = get_post_meta(get_the_ID(), '_garage_price_from', true);
                        $badge    = get_post_meta(get_the_ID(), '_garage_badge', true);
                        $warranty = get_post_meta(get_the_ID(), '_garage_warranty', true);
                        $features = hieugara_get_service_features(get_the_ID());
                        $thumb    = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb') : 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&q=80';
                        ?>
                        <article class="service-card-modern">
                            <div class="service-media-modern">
                                <?php if (!empty($badge)) : ?>
                                    <span class="service-pill-tag"><?php echo esc_html($badge); ?></span>
                                <?php endif; ?>
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </div>

                            <div class="service-body-modern">
                                <h3 class="service-title-modern"><?php the_title(); ?></h3>
                                
                                <div class="service-price-tag">
                                    <i class="fa fa-tag"></i> <?php echo esc_html($price ? $price : 'Liên hệ khảo sát'); ?>
                                </div>

                                <?php if (!empty($features)) : ?>
                                    <ul class="service-checklist">
                                        <?php foreach (array_slice($features, 0, 3) as $f) : ?>
                                            <li><i class="fa fa-check"></i> <span><?php echo esc_html($f); ?></span></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <div class="service-action-row">
                                    <a href="<?php the_permalink(); ?>" class="btn-carpla btn-carpla-outline" style="flex: 1; padding: 10px;">
                                        <?php _e('Chi tiết', 'hieugara-motors'); ?>
                                    </a>
                                    <a href="#" class="btn-carpla btn-carpla-primary" style="flex: 1; padding: 10px;" data-open-modal="booking" data-service-title="<?php the_title_attribute(); ?>">
                                        <?php _e('Đặt hẹn', 'hieugara-motors'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- 3. Carpla 6-Step Standardized Workflow -->
    <section class="section-workflow" id="quy-trinh-chuan">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('TIÊU CHUẨN DỊCH VỤ MINH BẠCH', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Quy Trình 6 Bước Chuẩn Hóa', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Đảm bảo tính chuẩn xác, đồng bộ và giúp chủ xe dễ dàng giám sát toàn bộ các khâu kỹ thuật.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="workflow-steps">
                <div class="workflow-card">
                    <div class="workflow-num">01</div>
                    <div class="workflow-title"><?php _e('Tiếp Nhận & Khảo Sát', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Ghi nhận triệu chứng, quét chẩn đoán mã lỗi toàn diện cùng chủ xe.', 'hieugara-motors'); ?></div>
                </div>

                <div class="workflow-card">
                    <div class="workflow-num">02</div>
                    <div class="workflow-title"><?php _e('Báo Giá Điện Tử', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Lập bảng kê chi tiết phụ tùng và công thợ minh bạch, không phát sinh.', 'hieugara-motors'); ?></div>
                </div>

                <div class="workflow-card">
                    <div class="workflow-num">03</div>
                    <div class="workflow-title"><?php _e('Xác Nhận & Thi Công', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Khách hàng đồng ý mới bắt đầu thi công đúng thông số kỹ thuật hãng.', 'hieugara-motors'); ?></div>
                </div>

                <div class="workflow-card">
                    <div class="workflow-num">04</div>
                    <div class="workflow-title"><?php _e('Kiểm Soát KCS', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Tổ trưởng kiểm tra chất lượng độc lập, chạy thử nghiệm thu gắt gao.', 'hieugara-motors'); ?></div>
                </div>

                <div class="workflow-card">
                    <div class="workflow-num">05</div>
                    <div class="workflow-title"><?php _e('Rửa Xe & Bàn Giao', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Rửa xe miễn phí, đối chiếu phụ tùng cũ đã thay thế và bàn giao chìa khóa.', 'hieugara-motors'); ?></div>
                </div>

                <div class="workflow-card">
                    <div class="workflow-num">06</div>
                    <div class="workflow-title"><?php _e('Chăm Sóc Hậu Mãi', 'hieugara-motors'); ?></div>
                    <div class="workflow-desc"><?php _e('Bảo hành điện tử, gọi điện nhắc lịch bảo dưỡng và hỗ trợ kỹ thuật 24/7.', 'hieugara-motors'); ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Interactive Paint & Body Estimator (Đồng sơn ô tô công nghệ cao) -->
    <section class="section-services" id="du-toan-son-xe" style="background: var(--white);">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('DỰ TOÁN CHI PHÍ TRỰC QUAN', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Công Cụ Tính Giá Sơn Gò Ô Tô Tức Thì', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Phòng sơn sấy khép kín tiêu chuẩn quốc tế, sử dụng sơn gốc nước Axalta cao cấp chuẩn màu xe 100%.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="paint-calc-layout">
                <div class="paint-selectors-col">
                    <h3 style="font-size: 1.125rem; font-weight: 800; color: var(--slate-900); margin-bottom: 6px;">
                        <i class="fa fa-hand-pointer" style="color: var(--brand-red);"></i> <?php _e('Bấm chọn vị trí cần sơn trên xe:', 'hieugara-motors'); ?>
                    </h3>
                    <p style="font-size: 0.8125rem; color: var(--slate-500); margin-bottom: 16px;">
                        <?php _e('Hệ thống tự động cộng dồn chi phí và tính toán thời gian thi công dự kiến.', 'hieugara-motors'); ?>
                    </p>

                    <div class="paint-part-selector">
                        <div class="paint-part-btn" data-part-key="can_truoc" data-part-name="Cản trước (Ba-đờ-xốc trước)" data-part-price="800000">
                            <span class="part-name"><?php _e('Cản trước', 'hieugara-motors'); ?></span>
                            <span class="part-price">800.000 đ</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="can_sau" data-part-name="Cản sau (Ba-đờ-xốc sau)" data-part-price="800000">
                            <span class="part-name"><?php _e('Cản sau', 'hieugara-motors'); ?></span>
                            <span class="part-price">800.000 đ</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="capo" data-part-name="Nắp Ca-pô trước" data-part-price="1200000">
                            <span class="part-name"><?php _e('Nắp Ca-pô', 'hieugara-motors'); ?></span>
                            <span class="part-price">1.200.000 đ</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="cop_sau" data-part-name="Cốp sau (Cửa hậu)" data-part-price="1000000">
                            <span class="part-name"><?php _e('Cửa Cốp sau', 'hieugara-motors'); ?></span>
                            <span class="part-price">1.000.000 đ</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="cua_xe" data-part-name="Cánh cửa xe (1 cánh)" data-part-price="700000">
                            <span class="part-name"><?php _e('Cánh cửa xe', 'hieugara-motors'); ?></span>
                            <span class="part-price">700.000 đ / cánh</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="tai_xe" data-part-name="Tai xe / Vè trước (1 bên)" data-part-price="500000">
                            <span class="part-name"><?php _e('Tai vè xe', 'hieugara-motors'); ?></span>
                            <span class="part-price">500.000 đ / bên</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="noc_xe" data-part-name="Nóc mui xe" data-part-price="1500000">
                            <span class="part-name"><?php _e('Nóc mui xe', 'hieugara-motors'); ?></span>
                            <span class="part-price">1.500.000 đ</span>
                        </div>
                        <div class="paint-part-btn" data-part-key="full_car" data-part-name="Gói sơn đổi màu / Sơn quây toàn bộ xe" data-part-price="16000000" style="border-color: var(--brand-red); background: var(--brand-red-light);">
                            <span class="part-name" style="color: var(--brand-red);"><i class="fa fa-star"></i> <?php _e('Sơn toàn bộ xe', 'hieugara-motors'); ?></span>
                            <span class="part-price">16.000.000 đ</span>
                        </div>
                    </div>
                </div>

                <div class="paint-summary-card">
                    <h3 style="font-size: 1.1875rem; color: #ffffff; margin-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 12px;">
                        <i class="fa fa-receipt" style="color: var(--brand-red);"></i> <?php _e('Bảng Dự Toán Chi Phí Sơn', 'hieugara-motors'); ?>
                    </h3>

                    <div id="paint-selected-items" style="min-height: 100px;">
                        <!-- Selected list -->
                    </div>

                    <div style="background: rgba(255,255,255,0.08); padding: 12px 16px; border-radius: var(--radius-sm); margin-top: 14px;">
                        <div style="font-size: 0.75rem; color: var(--slate-400); text-transform: uppercase; font-weight: 700;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></div>
                        <strong id="paint-duration-text" style="color: #ffffff; font-size: 0.9375rem;">4 - 6 tiếng (Lấy trong ngày)</strong>
                    </div>

                    <div class="paint-total-row">
                        <span style="font-size: 0.8125rem; text-transform: uppercase; color: var(--slate-400);"><?php _e('Tổng chi phí ước tính:', 'hieugara-motors'); ?></span>
                        <div id="paint-total-amount" class="paint-total-price">800.000 đ</div>
                    </div>

                    <a href="#dat-lich" class="btn-carpla btn-carpla-primary" style="width: 100%; text-align: center;" data-open-modal="booking" data-service-title="Sơn gò ô tô (Dự toán online)">
                        <i class="fa fa-calendar-check"></i> <?php _e('ĐẶT HẸN MANG XE TỚI XƯỞNG', 'hieugara-motors'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Nationwide Workshop Network (Mạng lưới xưởng dịch vụ) -->
    <section class="section-network" id="mang-luoi-xuong">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('MẠNG LƯỚI XƯỞNG DỊCH VỤ', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Hệ Thống Cơ Sở Tiêu Chuẩn Tại Hà Nội', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Mỗi trung tâm đều trang bị từ 6 đến 12 cầu nâng thủy lực, máy ra vào lốp tự động và phòng sơn sấy khép kín.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="network-grid">
                <div class="workshop-card">
                    <div class="workshop-header">
                        <div class="workshop-name">Cơ sở 1: Xưởng Cầu Giấy</div>
                        <span class="workshop-city-pill">Hà Nội</span>
                    </div>
                    <div class="workshop-address">
                        <i class="fa fa-map-pin" style="color: var(--brand-red);"></i> Số 500 đường Cầu Giấy, P. Dịch Vọng, Q. Cầu Giấy, Hà Nội
                    </div>
                    <div class="workshop-meta">
                        <span><i class="fa fa-warehouse"></i> 10 Cầu nâng</span>
                        <span><i class="fa fa-paint-roller"></i> 2 Phòng sơn sấy</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="tel:0988567890" class="btn-carpla btn-carpla-outline" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;">
                            <i class="fa fa-phone"></i> Gọi xưởng
                        </a>
                        <a href="#" class="btn-carpla btn-carpla-primary" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;" data-open-modal="booking" data-service-title="Cơ sở Cầu Giấy">
                            <i class="fa fa-calendar-alt"></i> Đặt hẹn
                        </a>
                    </div>
                </div>

                <div class="workshop-card">
                    <div class="workshop-header">
                        <div class="workshop-name">Cơ sở 2: Xưởng Tây Hồ</div>
                        <span class="workshop-city-pill">Hà Nội</span>
                    </div>
                    <div class="workshop-address">
                        <i class="fa fa-map-pin" style="color: var(--brand-red);"></i> Số 685 đường Lạc Long Quân, P. Phú Thượng, Q. Tây Hồ, Hà Nội
                    </div>
                    <div class="workshop-meta">
                        <span><i class="fa fa-warehouse"></i> 8 Cầu nâng</span>
                        <span><i class="fa fa-paint-roller"></i> 2 Phòng sơn sấy</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="tel:0988567890" class="btn-carpla btn-carpla-outline" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;">
                            <i class="fa fa-phone"></i> Gọi xưởng
                        </a>
                        <a href="#" class="btn-carpla btn-carpla-primary" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;" data-open-modal="booking" data-service-title="Cơ sở Tây Hồ">
                            <i class="fa fa-calendar-alt"></i> Đặt hẹn
                        </a>
                    </div>
                </div>

                <div class="workshop-card">
                    <div class="workshop-header">
                        <div class="workshop-name">Cơ sở 3: Xưởng Long Biên</div>
                        <span class="workshop-city-pill">Hà Nội</span>
                    </div>
                    <div class="workshop-address">
                        <i class="fa fa-map-pin" style="color: var(--brand-red);"></i> Số 390 đường Nguyễn Văn Cừ, P. Bồ Đề, Q. Long Biên, Hà Nội
                    </div>
                    <div class="workshop-meta">
                        <span><i class="fa fa-warehouse"></i> 12 Cầu nâng</span>
                        <span><i class="fa fa-paint-roller"></i> 3 Phòng sơn sấy</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="tel:0988567890" class="btn-carpla btn-carpla-outline" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;">
                            <i class="fa fa-phone"></i> Gọi xưởng
                        </a>
                        <a href="#" class="btn-carpla btn-carpla-primary" style="flex: 1; padding: 8px 12px; font-size: 0.8125rem;" data-open-modal="booking" data-service-title="Cơ sở Long Biên">
                            <i class="fa fa-calendar-alt"></i> Đặt hẹn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Insurance Partners -->
    <section class="section-partners" style="padding: 60px 0; background: var(--slate-50); border-top: 1px solid var(--slate-200);">
        <div class="container" style="text-align: center;">
            <div class="section-pill"><?php _e('BỒI THƯỜNG TRỌN GÓI', 'hieugara-motors'); ?></div>
            <h3 style="font-size: 1.375rem; font-weight: 800; color: var(--slate-900); text-transform: uppercase;">
                <?php _e('ĐỐI TÁC BẢO HIỂM THÂN VỎ LIÊN KẾT BỒI THƯỜNG TRỰC TIẾP', 'hieugara-motors'); ?>
            </h3>
            <p style="color: var(--slate-500); max-width: 600px; margin: 8px auto 0; font-size: 0.875rem;">
                <?php _e('Hỗ trợ khai báo hồ sơ bồi thường bảo hiểm thân vỏ từ A đến Z. Quý khách không phải thanh toán trước.', 'hieugara-motors'); ?>
            </p>

            <div class="partners-logos" style="display: flex; justify-content: center; gap: 32px; flex-wrap: wrap; margin-top: 24px;">
                <div class="partner-logo-item">BẢO VIỆT</div>
                <div class="partner-logo-item">PVI INSURANCE</div>
                <div class="partner-logo-item">BẢO HIỂM PTI</div>
                <div class="partner-logo-item">PJICO</div>
                <div class="partner-logo-item">LIBERTY</div>
                <div class="partner-logo-item">BIC</div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
