<?php
/**
 * Single Template for Garage Services - ShiftUp & Lexus Luxury Style
 * Displays full Prestige Automobile service detail content adapted for Ôtô Hải Hà
 *
 * @package HieuGara_Motors
 */

get_header();

while (have_posts()) : the_post();
    $post_slug     = get_post_field('post_name', get_the_ID());
    $prestige_data = function_exists('hieugara_get_prestige_service_data') ? hieugara_get_prestige_service_data($post_slug) : array();

    $page_title = !empty($prestige_data['title']) ? $prestige_data['title'] : get_the_title();
    $price      = !empty($prestige_data['price']) ? $prestige_data['price'] : (get_post_meta(get_the_ID(), '_service_price', true) ?: get_post_meta(get_the_ID(), '_garage_price_from', true));
    $badge      = !empty($prestige_data['badge']) ? $prestige_data['badge'] : (get_post_meta(get_the_ID(), '_garage_badge', true) ?: 'TIÊU CHUẨN ÔTÔ HẢI HÀ');
    $duration   = !empty($prestige_data['duration']) ? $prestige_data['duration'] : (get_post_meta(get_the_ID(), '_service_duration', true) ?: '45 - 90 phút');
    $warranty   = !empty($prestige_data['warranty']) ? $prestige_data['warranty'] : (get_post_meta(get_the_ID(), '_service_warranty', true) ?: '12 - 24 tháng');
    $thumb      = !empty($prestige_data['img']) ? $prestige_data['img'] : get_template_directory_uri() . '/assets/images/shiftup/slide-2.jpg';

    $hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
    $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
    ?>

    <!-- Service Header Banner -->
    <section class="service-single-header" style="background: #0f1115; padding: 50px 0 40px; border-bottom: 3px solid #1d4ed8; position: relative;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            <!-- Breadcrumbs -->
            <?php if (class_exists('HieuGara_SEO_Architecture')) : ?>
                <?php HieuGara_SEO_Architecture::render_breadcrumbs(); ?>
            <?php endif; ?>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
                <div style="max-width: 900px;">
                    <?php if (!empty($badge)) : ?>
                        <div style="display: inline-block; background: #1d4ed8; color: #ffffff; font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                            <?php echo esc_html($badge); ?>
                        </div>
                    <?php endif; ?>
                    <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; color: #ffffff; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.3;">
                        <span style="color: #1d4ed8;">|</span> <?php echo esc_html($page_title); ?>
                    </h1>
                </div>

                <!-- Emergency Contact Badge -->
                <div style="display: flex; gap: 14px; align-items: center;">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(29, 78, 216, 0.15); border: 1px solid #1d4ed8; color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase;">
                        <i class="fa fa-phone-volume" style="color: #1d4ed8;"></i>
                        <span>CỨU HỘ 24/7: <strong style="color: #1d4ed8;"><?php echo esc_html($rescue_phone); ?></strong></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Detail Content -->
    <main id="primary" class="site-main" style="padding: 60px 0 90px; background: #fbfbfb;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            
            <div style="display: grid; grid-template-columns: 2fr 1.15fr; gap: 48px; align-items: flex-start;">
                
                <!-- Left: Service Presentation -->
                <article class="service-detail-main" style="background: #ffffff; padding: 40px; border: 1px solid #ebebeb; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    
                    <!-- Key Service Metrics Bar -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; padding: 22px; background: #0f1115; border-radius: 4px; margin-bottom: 32px; border-left: 4px solid #1d4ed8;">
                        <div>
                            <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chi phí tham khảo:', 'hieugara-motors'); ?></small>
                            <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; font-weight: 800; color: #1d4ed8; margin-top: 4px;"><?php echo esc_html($price ? $price : 'Khảo sát báo giá miễn phí'); ?></div>
                        </div>
                        <?php if (!empty($duration)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 16px;">
                                <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; font-weight: 700; color: #ffffff; margin-top: 4px;"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($warranty)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 16px;">
                                <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chế độ bảo hành:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.05rem; font-weight: 700; color: #22c55e; margin-top: 4px;"><?php echo esc_html($warranty); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Main Hero Image -->
                    <div style="margin-bottom: 32px; overflow: hidden; background: #000; position: relative; border-radius: 4px;">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($page_title); ?>" style="width: 100%; height: auto; max-height: 480px; object-fit: cover; display: block;">
                    </div>

                    <!-- Body Content -->
                    <div class="entry-content" style="line-height: 1.85; color: #334155; font-size: 1.02rem;">
                        <?php
                        if (!empty($prestige_data['html'])) {
                            echo $prestige_data['html'];
                        } else {
                            the_content();
                        }
                        ?>
                    </div>

                    <!-- Workshop Guarantee Box -->
                    <div style="margin-top: 36px; padding: 24px; background: #f8fafc; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                        <div>
                            <strong style="font-family: 'Chakra Petch', sans-serif; font-size: 1rem; color: #0c1e3a; display: block; margin-bottom: 4px;"><?php _e('CẦN TƯ VẤN KỸ THUẬT CHUYÊN SÂU?', 'hieugara-motors'); ?></strong>
                            <span style="color: #64748b; font-size: 0.9rem;"><?php _e('Đội ngũ cố vấn dịch vụ Ôtô Hải Hà hỗ trợ trực tiếp 24/7 không qua trung gian.', 'hieugara-motors'); ?></span>
                        </div>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="shiftup-rect-btn btn-orange-solid" style="background: #1d4ed8; color: #fff; padding: 12px 24px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-phone"></i> <?php echo esc_html($rescue_phone); ?>
                        </a>
                    </div>
                </article>

                <!-- Right: Sticky Booking Form -->
                <aside class="service-sidebar" style="position: sticky; top: 120px;">
                    <div style="background: #ffffff; border: 2px solid #0a192f; padding: 32px; box-shadow: 0 12px 30px rgba(0,0,0,0.08);">
                        <div style="border-bottom: 2px solid #1d4ed8; padding-bottom: 16px; margin-bottom: 24px;">
                            <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; color: #1d4ed8; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('ÔTÔ HẢI HÀ SERVICE', 'hieugara-motors'); ?></span>
                            <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.35rem; font-weight: 800; color: #0a192f; text-transform: uppercase; margin: 6px 0 0;"><?php _e('ĐẶT HẸN DỊCH VỤ', 'hieugara-motors'); ?></h3>
                        </div>

                        <form class="hieugara-ajax-form">
                            <input type="hidden" name="service_type" value="<?php echo esc_attr($page_title); ?>">

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Họ và tên (*)', 'hieugara-motors'); ?></label>
                                <input type="text" name="customer_name" required placeholder="VD: Nguyễn Văn A" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                                <input type="tel" name="customer_phone" required placeholder="09xx xxx xxx" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Dòng xe / Đời xe', 'hieugara-motors'); ?></label>
                                <input type="text" name="car_model" placeholder="VD: Lexus RX350, Mercedes C200..." style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit;">
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; font-family: 'Chakra Petch', sans-serif; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; color: #222;"><?php _e('Xưởng tiếp nhận', 'hieugara-motors'); ?></label>
                                <select name="branch_location" style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; font-size: 0.95rem; font-family: inherit; background: #fff;">
                                    <option value="Trụ sở chính Ôtô Hải Hà">Trụ sở chính: Ôtô Hải Hà (Hải Dương)</option>
                                    <option value="Tiếp nhận sửa chữa lưu động">Tiếp nhận sửa chữa lưu động tận nơi</option>
                                    <option value="Cứu hộ giao thông 24/7">Cứu hộ kéo xe về xưởng 24/7 (Hotline: <?php echo esc_html($rescue_phone); ?>)</option>
                                </select>
                            </div>

                            <button type="submit" class="shiftup-rect-btn btn-orange-solid" style="width: 100%; padding: 15px; background: #1d4ed8; color: #fff; border: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.95rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; transition: background 0.2s ease;">
                                <span class="btn-orange-bar" style="color: #fff;">|</span> + <?php _e('XÁC NHẬN TIẾP NHẬN XE', 'hieugara-motors'); ?>
                            </button>
                            <div class="form-response-msg" style="display:none; margin-top: 12px; font-size: 0.9rem; padding: 10px; text-align: center;"></div>
                        </form>

                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.82rem; color: #666; line-height: 1.6;">
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #1d4ed8;"></i> Kiểm tra tổng quát miễn phí 45 hạng mục.</p>
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #1d4ed8;"></i> Báo giá trước minh bạch, khách duyệt mới làm.</p>
                            <p style="margin-bottom: 0;"><i class="fa fa-check" style="color: #1d4ed8;"></i> Bảo hành điện tử tra cứu theo biển số.</p>
                        </div>
                    </div>
                </aside>

            </div>

        </div>
    </main>

    <?php
endwhile;

get_footer();
