<?php
/**
 * Lexus Front Page Template
 *
 * @package Lexus_Motors
 */

get_header();

// Fetch all vehicles for lineup
$vehicles_query = new WP_Query(array(
    'post_type'      => 'lexus_vehicle',
    'posts_per_page' => 12,
    'orderby'        => 'date',
    'order'          => 'DESC'
));

$featured_car = null;
if ($vehicles_query->have_posts()) {
    $featured_car = $vehicles_query->posts[0];
}
?>

<main id="primary" class="site-main">

    <!-- 1. Hero Banner -->
    <section class="lexus-hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <span class="subtitle-gold"><?php _e('TIÊN PHONG ĐIỆN HÓA & NGHỆ THUẬT CHẾ TÁC NHẬT BẢN', 'lexus-motors'); ?></span>
            <h1 class="hero-title title-luxury">
                <?php _e('TRẢI NGHIỆM ĐỈNH CAO CỦA SỰ HOÀN MỸ', 'lexus-motors'); ?>
            </h1>
            <p class="hero-subtitle">
                <?php _e('Khám phá thế hệ xe Lexus hoàn toàn mới, nơi công nghệ điện hóa tiên phong hòa quyện cùng nghệ thuật thủ công Takumi huyền thoại.', 'lexus-motors'); ?>
            </p>
            <div class="hero-actions">
                <a href="#dong-xe" class="btn-lexus btn-lexus-gold">
                    <?php _e('KHÁM PHÁ CÁC DÒNG XE', 'lexus-motors'); ?>
                </a>
                <a href="#du-toan-chi-phi" class="btn-lexus">
                    <?php _e('DỰ TOÁN CHI PHÍ', 'lexus-motors'); ?>
                </a>
            </div>

            <!-- Hero Featured Car Render -->
            <div class="hero-image-wrap">
                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=1400&q=85" alt="Lexus Flagship" class="hero-car-img">
            </div>
        </div>
    </section>

    <!-- 2. Vehicle Lineup Explorer (Bộ sưu tập dòng xe) -->
    <section class="section-lineup" id="dong-xe">
        <div class="container">
            <div class="section-header">
                <span class="subtitle-gold"><?php _e('BỘ SƯU TẬP LEXUS', 'lexus-motors'); ?></span>
                <h2 class="section-title title-luxury"><?php _e('CÁC DÒNG XE LEXUS THẾ HỆ MỚI', 'lexus-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Mỗi dòng xe Lexus là một kiệt tác thiết kế L-finesse, đem lại trải nghiệm lái êm ái và xúc cảm phấn khích chưa từng có.', 'lexus-motors'); ?>
                </p>
            </div>

            <!-- Lineup Filter Tabs -->
            <div class="lineup-tabs">
                <button type="button" class="tab-btn active" data-filter="all"><?php _e('Tất cả', 'lexus-motors'); ?></button>
                <button type="button" class="tab-btn" data-filter="sedan"><?php _e('Sedan Hạng Sang', 'lexus-motors'); ?></button>
                <button type="button" class="tab-btn" data-filter="suv"><?php _e('SUV Đẳng Cấp', 'lexus-motors'); ?></button>
                <button type="button" class="tab-btn" data-filter="electrified"><?php _e('Hybrid & Xe Điện', 'lexus-motors'); ?></button>
            </div>

            <!-- Cars Grid -->
            <div class="cars-grid">
                <?php
                if ($vehicles_query->have_posts()) :
                    while ($vehicles_query->have_posts()) : $vehicles_query->the_post();
                        $specs = lexus_get_vehicle_specs(get_the_ID());
                        $colors = lexus_get_vehicle_colors(get_the_ID());
                        $terms = get_the_terms(get_the_ID(), 'vehicle_segment');
                        $segment_slugs = '';
                        if ($terms && !is_wp_error($terms)) {
                            $slug_arr = wp_list_pluck($terms, 'slug');
                            $segment_slugs = implode(' ', $slug_arr);
                        }
                        
                        $car_img = !empty($colors) ? $colors[0]['image'] : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'lexus-car-thumb') : 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=700&q=80');
                        ?>
                        <article class="car-card" data-segments="<?php echo esc_attr($segment_slugs); ?>">
                            <?php if (!empty($specs['badge'])) : ?>
                                <span class="car-card-badge"><?php echo esc_html($specs['badge']); ?></span>
                            <?php endif; ?>

                            <div class="car-card-media">
                                <img src="<?php echo esc_url($car_img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </div>

                            <div class="car-card-body">
                                <h3 class="car-card-title"><?php the_title(); ?></h3>
                                <p class="car-card-tagline"><?php echo esc_html($specs['tagline'] ? $specs['tagline'] : get_the_excerpt()); ?></p>
                                
                                <div class="car-card-price">
                                    <small style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: normal;"><?php _e('Giá bán lẻ khuyến nghị:', 'lexus-motors'); ?></small>
                                    <?php echo lexus_format_price($specs['price']); ?>
                                </div>

                                <div class="car-specs-summary">
                                    <div class="spec-item">
                                        <small><?php _e('Động cơ', 'lexus-motors'); ?></small>
                                        <span><?php echo esc_html($specs['engine'] ? $specs['engine'] : 'Tiêu chuẩn'); ?></span>
                                    </div>
                                    <div class="spec-item">
                                        <small><?php _e('Công suất', 'lexus-motors'); ?></small>
                                        <span><?php echo esc_html($specs['horsepower'] ? $specs['horsepower'] : 'Tối ưu'); ?></span>
                                    </div>
                                    <div class="spec-item">
                                        <small><?php _e('Hộp số', 'lexus-motors'); ?></small>
                                        <span><?php echo esc_html($specs['transmission'] ? $specs['transmission'] : 'Direct-Shift'); ?></span>
                                    </div>
                                    <div class="spec-item">
                                        <small><?php _e('Tăng tốc', 'lexus-motors'); ?></small>
                                        <span><?php echo esc_html($specs['acceleration'] ? $specs['acceleration'] : 'Mượt mà'); ?></span>
                                    </div>
                                </div>

                                <div class="car-card-actions">
                                    <a href="<?php the_permalink(); ?>" class="btn-lexus" style="padding: 10px 16px; font-size: 0.75rem;">
                                        <?php _e('CHI TIẾT XE', 'lexus-motors'); ?>
                                    </a>
                                    <a href="#" class="btn-lexus btn-lexus-gold" style="padding: 10px 16px; font-size: 0.75rem;" data-open-modal="test-drive" data-car-model="<?php the_title_attribute(); ?>">
                                        <?php _e('LÁI THỬ', 'lexus-motors'); ?>
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

    <!-- 3. Featured Interactive Color Switcher -->
    <section class="section-color-switcher" id="chon-mau-xe">
        <div class="container">
            <div class="color-switcher-layout">
                <div class="car-display-stage">
                    <span class="subtitle-gold"><?php _e('TRẢI NGHIỆM ĐỔI MÀU NGOẠI THẤT TRỰC QUAN', 'lexus-motors'); ?></span>
                    <h3 class="title-luxury" style="font-size: 1.75rem; margin-bottom: 24px;">Lexus RX 350 Luxury</h3>
                    
                    <img id="featured-car-preview" src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80" alt="Lexus RX Preview" class="car-display-img">

                    <!-- Color Dots Controls -->
                    <div class="color-controls">
                        <div class="color-circle active" style="background-color: #f5f5f7;" 
                             data-color-name="Trắng Sonic Quartz" 
                             data-image="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80" 
                             data-target-img="#featured-car-preview" 
                             data-target-label="#featured-color-name" title="Trắng Sonic Quartz"></div>

                        <div class="color-circle" style="background-color: #111111;" 
                             data-color-name="Đen Sonic Agate" 
                             data-image="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80" 
                             data-target-img="#featured-car-preview" 
                             data-target-label="#featured-color-name" title="Đen Sonic Agate"></div>

                        <div class="color-circle" style="background-color: #555555;" 
                             data-color-name="Xám Sonic Chrome" 
                             data-image="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80" 
                             data-target-img="#featured-car-preview" 
                             data-target-label="#featured-color-name" title="Xám Sonic Chrome"></div>

                        <div class="color-circle" style="background-color: #8b0000;" 
                             data-color-name="Đỏ Red Mica" 
                             data-image="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=900&q=80" 
                             data-target-img="#featured-car-preview" 
                             data-target-label="#featured-color-name" title="Đỏ Red Mica"></div>
                    </div>

                    <div class="current-color-label">
                        <?php _e('Màu đang chọn: ', 'lexus-motors'); ?>
                        <strong id="featured-color-name" style="color: var(--accent-gold);">Trắng Sonic Quartz</strong>
                    </div>
                </div>

                <div class="color-switcher-info">
                    <span class="subtitle-gold"><?php _e('CÔNG NGHỆ SƠN SONIC ĐỘC BẢN', 'lexus-motors'); ?></span>
                    <h2 class="title-luxury" style="font-size: 2.25rem; margin-bottom: 20px;"><?php _e('Vẻ Đẹp Vĩnh Cửu Cùng Thời Gian', 'lexus-motors'); ?></h2>
                    <p style="color: var(--text-secondary); margin-bottom: 20px; line-height: 1.8;">
                        <?php _e('Công nghệ sơn Sonic độc quyền của Lexus áp dụng kỹ thuật lắng đọng chân không đa lớp với kích thước hạt siêu nhỏ. Các vảy nhôm được căn chỉnh song song tuyệt đối, phản chiếu ánh sáng rực rỡ dưới ánh nắng và tôn lên những đường dập nổi sắc sảo của thân xe.', 'lexus-motors'); ?>
                    </p>
                    <ul style="list-style: none; margin-bottom: 30px; color: var(--text-secondary);">
                        <li style="margin-bottom: 10px;">✦ <?php _e('Khả năng tự phục hồi vết xước dăm siêu nhỏ (Self-restoring coat).', 'lexus-motors'); ?></li>
                        <li style="margin-bottom: 10px;">✦ <?php _e('Độ bóng sâu và chiều sâu quang học vượt trội chuẩn triển lãm.', 'lexus-motors'); ?></li>
                        <li>✦ <?php _e('Được kiểm tra thủ công tỉ mỉ dưới mắt của các bậc thầy sơn Takumi.', 'lexus-motors'); ?></li>
                    </ul>
                    <a href="#dang-ky-lai-thu" class="btn-lexus btn-lexus-gold" data-open-modal="test-drive" data-car-model="Lexus RX 350 Luxury">
                        <?php _e('TRẢI NGHIỆM THỰC TẾ TẠI SHOWROOM', 'lexus-motors'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Takumi Craftsmanship & Heritage -->
    <section class="section-craftsmanship" id="trai-nghiem-lexus">
        <div class="container">
            <div class="craftsmanship-grid">
                <div class="craftsmanship-text">
                    <span class="subtitle-gold"><?php _e('TINH HOA CHẾ TÁC THỦ CÔNG NHẬT BẢN', 'lexus-motors'); ?></span>
                    <h2 class="title-luxury" style="font-size: 2.25rem; margin-bottom: 24px;">
                        <?php _e('Nghệ Nhân Bậc Thầy Takumi & Triết Lý Omotenashi', 'lexus-motors'); ?>
                    </h2>
                    <p>
                        <?php _e('Để đạt danh hiệu Takumi tại Lexus, một nghệ nhân phải cống hiến ít nhất 25 năm (khoảng 60.000 giờ) trau dồi tay nghề và vượt qua bài kiểm tra gấp chú mèo Origami bằng một tay trong vòng 90 giây.', 'lexus-motors'); ?>
                    </p>
                    <p>
                        <?php _e('Từng đường chỉ khâu thủ công trên da Semi-Aniline, ốp gỗ lạng Shimamoku hay kính cắt nghệ thuật Kiriko trên dòng sedan đầu bảng LS đều là minh chứng cho sự tôn sùng chủ nghĩa hoàn hảo và tinh thần hiếu khách Omotenashi – đón tiếp khách hàng như khách quý đến chơi nhà.', 'lexus-motors'); ?>
                    </p>

                    <blockquote class="craft-quote">
                        "Tại Lexus, chúng tôi không chỉ sản xuất những cỗ máy di chuyển. Chúng tôi kiến tạo những trải nghiệm lay động mọi giác quan."
                    </blockquote>

                    <a href="<?php echo esc_url(get_post_type_archive_link('lexus_vehicle')); ?>" class="btn-lexus">
                        <?php _e('KHÁM PHÁ CHI TIẾT TỪNG MẪU XE', 'lexus-motors'); ?>
                    </a>
                </div>

                <div class="craftsmanship-image">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80" alt="Takumi Lexus Craftsmanship" style="border-radius: var(--radius-md); box-shadow: var(--shadow-luxury);">
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Interactive Cost & Loan Estimator -->
    <section class="section-calculator" id="du-toan-chi-phi">
        <div class="container">
            <div class="section-header">
                <span class="subtitle-gold"><?php _e('CÔNG CỤ TÀI CHÍNH THÔNG MINH', 'lexus-motors'); ?></span>
                <h2 class="section-title title-luxury"><?php _e('DỰ TOÁN CHI PHÍ LĂN BÁNH & TRẢ GÓP', 'lexus-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Dự toán chi phí trọn gói chính xác theo quy định thuế và lệ phí biển số tại từng tỉnh thành Việt Nam.', 'lexus-motors'); ?>
                </p>
            </div>

            <div class="calculator-card">
                <!-- Controls -->
                <div class="calc-controls">
                    <h3 class="title-luxury" style="font-size: 1.25rem; margin-bottom: 24px;"><?php _e('Thông Tin Dự Toán', 'lexus-motors'); ?></h3>

                    <div class="calc-form-group">
                        <label for="calc-car-select"><?php _e('1. Chọn dòng xe Lexus:', 'lexus-motors'); ?></label>
                        <select id="calc-car-select" class="calc-select">
                            <option value="3430000000" selected>Lexus RX 350 Luxury (3.430.000.000 VNĐ)</option>
                            <option value="9210000000">Lexus LX 600 VIP (9.210.000.000 VNĐ)</option>
                            <option value="2710000000">Lexus ES 250 F SPORT (2.710.000.000 VNĐ)</option>
                            <option value="3130000000">Lexus NX 350h Hybrid (3.130.000.000 VNĐ)</option>
                            <option value="8360000000">Lexus LS 500h Flagship (8.360.000.000 VNĐ)</option>
                        </select>
                    </div>

                    <div class="calc-form-group">
                        <label for="calc-region-select"><?php _e('2. Khu vực đăng ký xe:', 'lexus-motors'); ?></label>
                        <select id="calc-region-select" class="calc-select">
                            <option value="hanoi" selected>Hà Nội (Trước bạ 12% - Biển số 20 triệu)</option>
                            <option value="hcm">TP. Hồ Chí Minh (Trước bạ 10% - Biển số 20 triệu)</option>
                            <option value="quangninh">Quảng Ninh / Hải Phòng / Lào Cai (Trước bạ 12% - Biển số 1 triệu)</option>
                            <option value="other">Tỉnh / Thành phố khác (Trước bạ 10% - Biển số 1 triệu)</option>
                        </select>
                    </div>

                    <div style="background: var(--bg-darkest); padding: 20px; border-radius: var(--radius-sm); border: 1px solid var(--border-subtle); margin-top: 30px;">
                        <span style="font-size: 0.8125rem; color: var(--accent-gold); font-weight: 700; text-transform: uppercase;"><?php _e('CHÍNH SÁCH DÀNH RIÊNG CHO CHỦ XE LEXUS:', 'lexus-motors'); ?></span>
                        <p style="font-size: 0.8125rem; color: var(--text-secondary); margin-top: 6px;">
                            ✦ Miễn phí bảo dưỡng định kỳ trong 3 năm hoặc 60.000 km đầu tiên.<br>
                            ✦ Bảo hành chính hãng 5 năm không giới hạn số km.<br>
                            ✦ Gói vay tài chính Lexus ưu đãi lãi suất cố định dài hạn.
                        </p>
                    </div>
                </div>

                <!-- Detailed Results -->
                <div class="calc-results-panel">
                    <h3 class="title-luxury" style="font-size: 1.25rem; margin-bottom: 20px; color: var(--accent-gold);"><?php _e('Bảng Kê Chi Phí Lăn Bánh', 'lexus-motors'); ?></h3>
                    
                    <div class="result-row">
                        <span><?php _e('Giá xe niêm yết:', 'lexus-motors'); ?></span>
                        <strong id="res-base-price">3.430.000.000 VNĐ</strong>
                    </div>
                    <div class="result-row">
                        <span><?php _e('Lệ phí trước bạ:', 'lexus-motors'); ?></span>
                        <strong id="res-reg-tax">411.600.000 VNĐ</strong>
                    </div>
                    <div class="result-row">
                        <span><?php _e('Phí cấp biển số:', 'lexus-motors'); ?></span>
                        <strong id="res-plate-fee">20.000.000 VNĐ</strong>
                    </div>
                    <div class="result-row">
                        <span><?php _e('Phí kiểm định:', 'lexus-motors'); ?></span>
                        <strong id="res-inspection">340.000 VNĐ</strong>
                    </div>
                    <div class="result-row">
                        <span><?php _e('Phí bảo trì đường bộ (1 năm):', 'lexus-motors'); ?></span>
                        <strong id="res-road-fee">1.560.000 VNĐ</strong>
                    </div>
                    <div class="result-row">
                        <span><?php _e('Bảo hiểm TNDS bắt buộc (1 năm):', 'lexus-motors'); ?></span>
                        <strong id="res-tnds">480.700 VNĐ</strong>
                    </div>

                    <div class="result-row total-row">
                        <span><?php _e('TỔNG CHI PHÍ LĂN BÁNH:', 'lexus-motors'); ?></span>
                        <span id="res-total-cost">3.863.980.700 VNĐ</span>
                    </div>

                    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px dashed var(--border-medium);">
                        <span class="subtitle-gold" style="font-size: 0.6875rem;"><?php _e('GỢI Ý MUA XE TRẢ GÓP (Vay 70% trong 5 năm)', 'lexus-motors'); ?></span>
                        <div class="result-row" style="border: none; padding: 6px 0;">
                            <span><?php _e('Số tiền trả trước (gồm lăn bánh):', 'lexus-motors'); ?></span>
                            <strong id="res-down-payment" style="color: var(--text-primary);">1.462.980.700 VNĐ</strong>
                        </div>
                        <div class="result-row" style="border: none; padding: 6px 0;">
                            <span><?php _e('Ước tính trả góp hàng tháng:', 'lexus-motors'); ?></span>
                            <strong id="res-monthly-loan" style="color: var(--accent-gold);">~58.000.000 VNĐ / tháng</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Embedded Test Drive Section -->
    <section class="section-test-drive" id="dang-ky-lai-thu">
        <div class="container">
            <div class="test-drive-form-wrap">
                <div style="text-align: center; margin-bottom: 36px;">
                    <span class="subtitle-gold"><?php _e('CHẠM VÀO GIÁC QUAN', 'lexus-motors'); ?></span>
                    <h2 class="title-luxury" style="font-size: 2rem; margin-bottom: 12px;"><?php _e('Đăng Ký Lái Thử Trực Tuyến', 'lexus-motors'); ?></h2>
                    <p style="color: var(--text-secondary); font-size: 0.9375rem;">
                        <?php _e('Hãy trải nghiệm cảm giác tĩnh lặng và khả năng bứt phá của động cơ Lexus ngay hôm nay.', 'lexus-motors'); ?>
                    </p>
                </div>

                <form class="lexus-ajax-form">
                    <div class="form-field">
                        <label><?php _e('Họ và tên của Quý khách (*)', 'lexus-motors'); ?></label>
                        <input type="text" name="customer_name" class="form-control" required placeholder="VD: Trần Hoàng Nam">
                    </div>

                    <div class="form-grid-2">
                        <div class="form-field">
                            <label><?php _e('Số điện thoại (*)', 'lexus-motors'); ?></label>
                            <input type="tel" name="customer_phone" class="form-control" required placeholder="09xx xxx xxx">
                        </div>
                        <div class="form-field">
                            <label><?php _e('Email nhận báo giá', 'lexus-motors'); ?></label>
                            <input type="email" name="customer_email" class="form-control" placeholder="email@domain.com">
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-field">
                            <label><?php _e('Dòng xe Quý khách quan tâm', 'lexus-motors'); ?></label>
                            <select name="car_model" class="form-control">
                                <option value="Lexus RX 350 Luxury">Lexus RX 350 Luxury</option>
                                <option value="Lexus LX 600 VIP">Lexus LX 600 VIP</option>
                                <option value="Lexus ES 250 F SPORT">Lexus ES 250 F SPORT</option>
                                <option value="Lexus NX 350h Hybrid">Lexus NX 350h Hybrid</option>
                                <option value="Lexus LS 500h Flagship">Lexus LS 500h Flagship</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label><?php _e('Showroom tiếp đón', 'lexus-motors'); ?></label>
                            <select name="dealer_city" class="form-control">
                                <option value="Hà Nội - Lexus Thăng Long">Lexus Thăng Long (Hà Nội)</option>
                                <option value="TP.HCM - Lexus Trung Tâm Sài Gòn">Lexus Trung Tâm Sài Gòn (TP.HCM)</option>
                                <option value="Lái thử tại nhà riêng">Yêu cầu lái thử tại tư gia</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label><?php _e('Ghi chú thêm', 'lexus-motors'); ?></label>
                        <input type="text" name="customer_note" class="form-control" placeholder="Thời gian thuận tiện nhất...">
                    </div>

                    <button type="submit" class="btn-lexus btn-lexus-gold" style="width: 100%; padding: 16px; font-size: 0.875rem;">
                        <?php _e('GỬI YÊU CẦU LÁI THỬ NGAY', 'lexus-motors'); ?>
                    </button>
                    <div class="form-response-msg" style="display:none;"></div>
                </form>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();

