<?php
/**
 * Single Template for Garage Services - ShiftUp & Lexus Luxury Style
 *
 * @package HieuGara_Motors
 */

get_header();

while (have_posts()) : the_post();
    $price      = get_post_meta(get_the_ID(), '_service_price', true) ?: get_post_meta(get_the_ID(), '_garage_price_from', true);
    $badge      = get_post_meta(get_the_ID(), '_garage_badge', true) ?: 'TIÊU CHUẨN CHÂU ÂU';
    $duration   = get_post_meta(get_the_ID(), '_service_duration', true) ?: (get_post_meta(get_the_ID(), '_garage_duration', true) ?: '45 - 90 phút');
    $warranty   = get_post_meta(get_the_ID(), '_service_warranty', true) ?: (get_post_meta(get_the_ID(), '_garage_warranty', true) ?: '12 - 24 tháng');
    $custom_img = get_post_meta(get_the_ID(), '_garage_custom_image', true);
    $features   = hieugara_get_service_features(get_the_ID());

    if (has_post_thumbnail()) {
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } elseif (!empty($custom_img)) {
        $thumb = $custom_img;
    } else {
        $img_pool = array('port-1.jpg', 'port-2.jpg', 'port-3.jpg', 'port-4.jpg', 'pricing-1.jpg', 'pricing-2.jpg', 'pricing-3.jpg', 'slide-1.jpg', 'slide-2.jpg');
        $picked   = $img_pool[get_the_ID() % count($img_pool)];
        $thumb = get_template_directory_uri() . '/assets/images/shiftup/' . $picked;
    }

    $hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
    $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
    ?>

    <!-- Service Header Banner -->
    <section class="service-single-header" style="background: #0f1115; padding: 50px 0 40px; border-bottom: 3px solid #ff4d24; position: relative;">
        <div class="container" style="max-width: 1360px; margin: 0 auto; padding: 0 20px;">
            <!-- Breadcrumbs -->
            <?php if (class_exists('HieuGara_SEO_Architecture')) : ?>
                <?php HieuGara_SEO_Architecture::render_breadcrumbs(); ?>
            <?php else : ?>
                <div class="service-breadcrumbs" style="font-family: 'Chakra Petch', sans-serif; font-size: 0.82rem; color: #888888; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; text-transform: uppercase;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #bbbbbb; text-decoration: none;"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                    <span style="color: #ff4d24;">/</span>
                    <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>" style="color: #bbbbbb; text-decoration: none;"><?php _e('Dịch vụ Gara', 'hieugara-motors'); ?></a>
                    <span style="color: #ff4d24;">/</span>
                    <span style="color: #ff4d24; font-weight: 700;"><?php the_title(); ?></span>
                </div>
            <?php endif; ?>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
                <div>
                    <?php if (!empty($badge)) : ?>
                        <div style="display: inline-block; background: #ff4d24; color: #ffffff; font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; padding: 4px 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                            <?php echo esc_html($badge); ?>
                        </div>
                    <?php endif; ?>
                    <h1 style="font-family: 'Chakra Petch', sans-serif; font-size: clamp(1.8rem, 3.5vw, 2.75rem); font-weight: 800; color: #ffffff; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">
                        <span style="color: #ff4d24;">|</span> <?php the_title(); ?>
                    </h1>
                </div>

                <!-- Emergency Contact Badge -->
                <div style="display: flex; gap: 14px; align-items: center;">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 77, 36, 0.15); border: 1px solid #ff4d24; color: #ffffff; padding: 10px 18px; font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; text-transform: uppercase;">
                        <i class="fa fa-phone-volume" style="color: #ff4d24;"></i>
                        <span>CỨU HỘ 24/7: <strong style="color: #ff4d24;"><?php echo esc_html($rescue_phone); ?></strong></span>
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
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; padding: 22px; background: #0f1115; border-radius: 4px; margin-bottom: 32px; border-left: 4px solid #ff4d24;">
                        <div>
                            <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Chi phí tham khảo:', 'hieugara-motors'); ?></small>
                            <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.25rem; font-weight: 800; color: #ff4d24; margin-top: 4px;"><?php echo esc_html($price ? $price : 'Khảo sát báo giá miễn phí'); ?></div>
                        </div>
                        <?php if (!empty($duration)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 16px;">
                                <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 700; color: #ffffff; margin-top: 4px;"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($warranty)) : ?>
                            <div style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 16px;">
                                <small style="color: #999999; font-size: 0.72rem; text-transform: uppercase; font-family: 'Chakra Petch', sans-serif; font-weight: 700; letter-spacing: 0.5px;"><?php _e('Thời hạn bảo hành:', 'hieugara-motors'); ?></small>
                                <div style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 700; color: #22c55e; margin-top: 4px;"><?php echo esc_html($warranty); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Main Hero Image -->
                    <div style="margin-bottom: 36px; overflow: hidden; background: #000; position: relative;">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: auto; max-height: 520px; object-fit: cover; display: block;">
                    </div>

                    <!-- Technical Checklist -->
                    <?php if (!empty($features)) : ?>
                        <div style="background: #fff8f6; border: 1px solid #ffd4cc; padding: 28px; margin-bottom: 36px; position: relative;">
                            <div style="position: absolute; top: -12px; left: 24px; background: #ff4d24; color: #fff; font-family: 'Chakra Petch', sans-serif; font-size: 0.72rem; font-weight: 800; padding: 2px 10px; letter-spacing: 1px; text-transform: uppercase;">
                                TIÊU CHUẨN XƯỞNG HẢI HÀ
                            </div>
                            <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.1rem; font-weight: 800; color: #000000; margin: 4px 0 16px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <span style="color: #ff4d24;">|</span> <?php _e('TIÊU CHUẨN KỸ THUẬT & QUY TRÌNH THỰC HIỆN:', 'hieugara-motors'); ?>
                            </h3>
                            <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr; gap: 12px;">
                                <?php foreach ($features as $f) : ?>
                                    <li style="display: flex; align-items: flex-start; gap: 12px; font-weight: 600; color: #1e293b; font-size: 0.95rem; line-height: 1.5;">
                                        <i class="fa fa-check-square" style="color: #ff4d24; margin-top: 3px; font-size: 1.1rem;"></i>
                                        <span><?php echo esc_html($f); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Body Content -->
                    <div class="entry-content" style="line-height: 1.85; color: #374151; font-size: 1.02rem;">
                        <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.25rem; font-weight: 800; color: #000000; text-transform: uppercase; margin: 30px 0 16px; border-bottom: 2px solid #f0f0f0; padding-bottom: 8px;">
                            <span style="color: #ff4d24;">|</span> <?php _e('TỔNG QUAN & NĂNG LỰC TRIỂN KHAI', 'hieugara-motors'); ?>
                        </h3>
                        <?php the_content(); ?>
                    </div>

                    <!-- Workshop Guarantee Box -->
                    <div style="margin-top: 40px; padding: 24px; background: #f8fafc; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                        <div>
                            <strong style="font-family: 'Chakra Petch', sans-serif; font-size: 1rem; color: #0f172a; display: block; margin-bottom: 4px;"><?php _e('CẦN TƯ VẤN KỸ THUẬT CHUYÊN SÂU?', 'hieugara-motors'); ?></strong>
                            <span style="color: #64748b; font-size: 0.9rem;"><?php _e('Kỹ sư trưởng Hải Hà ÔTô hỗ trợ trực tiếp 24/7 không qua trung gian.', 'hieugara-motors'); ?></span>
                        </div>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline_phone)); ?>" class="shiftup-rect-btn btn-orange-solid" style="background: #ff4d24; color: #fff; padding: 12px 24px; text-decoration: none; font-family: 'Chakra Petch', sans-serif; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-phone"></i> <?php echo esc_html($hotline_phone); ?>
                        </a>
                    </div>
                </article>

                <!-- Right: Sticky Booking Form -->
                <aside class="service-sidebar" style="position: sticky; top: 120px;">
                    <div style="background: #ffffff; border: 2px solid #000000; padding: 32px; box-shadow: 0 12px 30px rgba(0,0,0,0.08);">
                        <div style="border-bottom: 2px solid #ff4d24; padding-bottom: 16px; margin-bottom: 24px;">
                            <span style="font-family: 'Chakra Petch', sans-serif; font-size: 0.75rem; font-weight: 800; color: #ff4d24; text-transform: uppercase; letter-spacing: 1.5px;"><?php _e('TIẾP NHẬN XE TẬN NƠI', 'hieugara-motors'); ?></span>
                            <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.35rem; font-weight: 800; color: #000000; text-transform: uppercase; margin: 6px 0 0;"><?php _e('ĐẶT HẸN DỊCH VỤ', 'hieugara-motors'); ?></h3>
                        </div>

                        <form class="hieugara-ajax-form">
                            <input type="hidden" name="service_type" value="<?php the_title_attribute(); ?>">

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
                                    <option value="Trụ sở chính Gara Ô tô Hải Hà">Trụ sở chính: Gara Ô tô Hải Hà (Hải Dương)</option>
                                    <option value="Tiếp nhận sửa chữa lưu động">Tiếp nhận sửa chữa lưu động tận nơi</option>
                                    <option value="Cứu hộ giao thông 24/7">Cứu hộ kéo xe về xưởng 24/7 (Hotline: <?php echo esc_html($rescue_phone); ?>)</option>
                                </select>
                            </div>

                            <button type="submit" class="shiftup-rect-btn btn-orange-solid" style="width: 100%; padding: 15px; background: #ff4d24; color: #fff; border: none; font-family: 'Chakra Petch', sans-serif; font-size: 0.95rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; transition: background 0.2s ease;">
                                <span class="btn-orange-bar" style="color: #fff;">|</span> + <?php _e('XÁC NHẬN TIẾP NHẬN XE', 'hieugara-motors'); ?>
                            </button>
                            <div class="form-response-msg" style="display:none; margin-top: 12px; font-size: 0.9rem; padding: 10px; text-align: center;"></div>
                        </form>

                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eee; font-size: 0.82rem; color: #666; line-height: 1.6;">
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #ff4d24;"></i> Kiểm tra tổng quát miễn phí 45 hạng mục.</p>
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #ff4d24;"></i> Báo giá trước minh bạch, khách duyệt mới làm.</p>
                            <p style="margin-bottom: 0;"><i class="fa fa-check" style="color: #ff4d24;"></i> Bảo hành điện tử tra cứu theo biển số.</p>
                        </div>
                    </div>
                </aside>

            </div>

            <!-- Related Services Carousel / Grid -->
            <div style="margin-top: 70px; padding-top: 50px; border-top: 1px solid #ebebeb;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h3 style="font-family: 'Chakra Petch', sans-serif; font-size: 1.6rem; font-weight: 800; color: #000000; text-transform: uppercase; margin: 0;">
                        <span style="color: #ff4d24;">|</span> <?php _e('CÁC GÓI DỊCH VỤ LIÊN QUAN KHÁC', 'hieugara-motors'); ?>
                    </h3>
                    <a href="<?php echo esc_url(home_url('/#dich-vu')); ?>" style="font-family: 'Chakra Petch', sans-serif; font-size: 0.85rem; font-weight: 700; color: #ff4d24; text-decoration: none; text-transform: uppercase;">
                        <?php _e('TẤT CẢ DỊCH VỤ →', 'hieugara-motors'); ?>
                    </a>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
                    <?php
                    $related = new WP_Query(array(
                        'post_type'      => 'garage_service',
                        'posts_per_page' => 4,
                        'post__not_in'   => array(get_the_ID()),
                        'orderby'        => 'rand'
                    ));
                    if ($related->have_posts()) :
                        while ($related->have_posts()) : $related->the_post();
                            $r_custom = get_post_meta(get_the_ID(), '_garage_custom_image', true);
                            $r_thumb  = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'garage-service-thumb') : ($r_custom ? $r_custom : get_template_directory_uri() . '/assets/images/shiftup/port-2.jpg');
                            ?>
                            <div class="about-card-item" style="border: 1px solid #eee; padding: 14px; background: #fff;">
                                <div class="card-image-wrap" style="height: 180px; margin-bottom: 14px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>
                                <h4 class="card-item-title" style="font-size: 0.9rem;">
                                    <a href="<?php the_permalink(); ?>"><span class="orange-bar">|</span> <?php the_title(); ?></a>
                                </h4>
                                <p class="card-item-desc" style="font-size: 0.85rem;"><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 12); ?></p>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </main>

    <?php
endwhile;

get_footer();
