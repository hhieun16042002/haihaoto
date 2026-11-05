<?php
/**
 * Template Name: Dự Toán Chi Phí Lăn Bánh (Lexus Cost Calculator)
 *
 * @package Lexus_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding-top: 120px; min-height: 85vh;">
    <div class="container">
        
        <header class="section-header" style="margin-bottom: 50px;">
            <span class="subtitle-gold"><?php _e('CÔNG CỤ TÀI CHÍNH', 'lexus-motors'); ?></span>
            <h1 class="title-luxury" style="font-size: 2.75rem; margin-bottom: 16px;">
                <?php _e('DỰ TOÁN CHI PHÍ LĂN BÁNH & TRẢ GÓP', 'lexus-motors'); ?>
            </h1>
            <p class="section-desc">
                <?php _e('Tính toán chính xác lệ phí trước bạ, biển số và các khoản chi phí bắt buộc khi mua xe Lexus mới tại Việt Nam.', 'lexus-motors'); ?>
            </p>
        </header>

        <div class="calculator-card" style="margin-bottom: 80px;">
            <!-- Controls -->
            <div class="calc-controls">
                <h3 class="title-luxury" style="font-size: 1.25rem; margin-bottom: 24px;"><?php _e('1. Chọn Thông Số Xe & Tỉnh Thành', 'lexus-motors'); ?></h3>

                <div class="calc-form-group">
                    <label for="calc-car-select"><?php _e('Dòng xe Lexus:', 'lexus-motors'); ?></label>
                    <select id="calc-car-select" class="calc-select">
                        <?php
                        $calc_cars = new WP_Query(array(
                            'post_type'      => 'lexus_vehicle',
                            'posts_per_page' => 20,
                            'orderby'        => 'title',
                            'order'          => 'ASC'
                        ));

                        if ($calc_cars->have_posts()) :
                            while ($calc_cars->have_posts()) : $calc_cars->the_post();
                                $price = get_post_meta(get_the_ID(), '_lexus_price', true);
                                if (!empty($price)) :
                                    ?>
                                    <option value="<?php echo esc_attr($price); ?>"><?php the_title(); ?> (<?php echo lexus_format_price($price); ?>)</option>
                                    <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <option value="3430000000">Lexus RX 350 Luxury (3.430.000.000 VNĐ)</option>
                            <option value="9210000000">Lexus LX 600 VIP (9.210.000.000 VNĐ)</option>
                            <option value="2710000000">Lexus ES 250 F SPORT (2.710.000.000 VNĐ)</option>
                            <option value="3130000000">Lexus NX 350h Hybrid (3.130.000.000 VNĐ)</option>
                            <option value="8360000000">Lexus LS 500h Flagship (8.360.000.000 VNĐ)</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="calc-region-select"><?php _e('Tỉnh / Thành phố đăng ký:', 'lexus-motors'); ?></label>
                    <select id="calc-region-select" class="calc-select">
                        <option value="hanoi" selected>Hà Nội (Trước bạ 12% - Biển số 20.000.000 đ)</option>
                        <option value="hcm">TP. Hồ Chí Minh (Trước bạ 10% - Biển số 20.000.000 đ)</option>
                        <option value="quangninh">Quảng Ninh / Hải Phòng (Trước bạ 12% - Biển số 1.000.000 đ)</option>
                        <option value="other">Các Tỉnh / Thành phố khác (Trước bạ 10% - Biển số 1.000.000 đ)</option>
                    </select>
                </div>

                <div style="background: var(--bg-darkest); padding: 24px; border-radius: var(--radius-sm); border: 1px solid var(--border-subtle); margin-top: 30px;">
                    <span style="font-size: 0.8125rem; color: var(--accent-gold); font-weight: 700; text-transform: uppercase;"><?php _e('LƯU Ý PHÁP LÝ & ƯU ĐÃI:', 'lexus-motors'); ?></span>
                    <p style="font-size: 0.8125rem; color: var(--text-secondary); margin-top: 8px; line-height: 1.6;">
                        * Giá trên đã bao gồm thuế GTGT (VAT) và các khoản lệ phí bắt buộc theo luật định hiện hành.<br>
                        * Chưa bao gồm Bảo hiểm vật chất xe (thân vỏ) tự nguyện và các phụ kiện chính hãng kèm theo.<br>
                        * Liên hệ chuyên viên để nhận chính sách quà tặng và chiết khấu đặc quyền tốt nhất.
                    </p>
                </div>
            </div>

            <!-- Detailed Results Panel -->
            <div class="calc-results-panel">
                <h3 class="title-luxury" style="font-size: 1.25rem; margin-bottom: 20px; color: var(--accent-gold);"><?php _e('Chi Tiết Các Khoản Chi Phí', 'lexus-motors'); ?></h3>
                
                <div class="result-row">
                    <span><?php _e('1. Giá xe niêm yết (VAT):', 'lexus-motors'); ?></span>
                    <strong id="res-base-price">3.430.000.000 VNĐ</strong>
                </div>
                <div class="result-row">
                    <span><?php _e('2. Lệ phí trước bạ:', 'lexus-motors'); ?></span>
                    <strong id="res-reg-tax">411.600.000 VNĐ</strong>
                </div>
                <div class="result-row">
                    <span><?php _e('3. Phí đăng ký biển số:', 'lexus-motors'); ?></span>
                    <strong id="res-plate-fee">20.000.000 VNĐ</strong>
                </div>
                <div class="result-row">
                    <span><?php _e('4. Phí đăng kiểm lưu hành:', 'lexus-motors'); ?></span>
                    <strong id="res-inspection">340.000 VNĐ</strong>
                </div>
                <div class="result-row">
                    <span><?php _e('5. Phí sử dụng đường bộ (12 tháng):', 'lexus-motors'); ?></span>
                    <strong id="res-road-fee">1.560.000 VNĐ</strong>
                </div>
                <div class="result-row">
                    <span><?php _e('6. Bảo hiểm TNDS bắt buộc (12 tháng):', 'lexus-motors'); ?></span>
                    <strong id="res-tnds">480.700 VNĐ</strong>
                </div>

                <div class="result-row total-row">
                    <span><?php _e('TỔNG CHI PHÍ LĂN BÁNH:', 'lexus-motors'); ?></span>
                    <span id="res-total-cost">3.863.980.700 VNĐ</span>
                </div>

                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px dashed var(--border-medium);">
                    <span class="subtitle-gold" style="font-size: 0.6875rem;"><?php _e('PHƯƠNG ÁN TÀI CHÍNH TRẢ GÓP (VAY 70% TRONG 5 NĂM)', 'lexus-motors'); ?></span>
                    <div class="result-row" style="border: none; padding: 6px 0;">
                        <span><?php _e('Khoản thanh toán ban đầu (gồm chi phí lăn bánh):', 'lexus-motors'); ?></span>
                        <strong id="res-down-payment" style="color: var(--text-primary);">1.462.980.700 VNĐ</strong>
                    </div>
                    <div class="result-row" style="border: none; padding: 6px 0;">
                        <span><?php _e('Gốc + Lãi trả hàng tháng ước tính:', 'lexus-motors'); ?></span>
                        <strong id="res-monthly-loan" style="color: var(--accent-gold);">~58.000.000 VNĐ / tháng</strong>
                    </div>
                </div>

                <a href="#" class="btn-lexus btn-lexus-gold" style="width: 100%; margin-top: 30px;" data-open-modal="test-drive">
                    <?php _e('NHẬN BÁO GIÁ LĂN BÁNH CHI TIẾT QUA EMAIL', 'lexus-motors'); ?>
                </a>
            </div>
        </div>

    </div>
</main>

<?php
get_footer();

