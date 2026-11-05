<?php
/**
 * Single Template for Garage Services - Carpla Clean Layout
 *
 * @package HieuGara_Motors
 */

get_header();

while (have_posts()) : the_post();
    $price    = get_post_meta(get_the_ID(), '_garage_price_from', true);
    $badge    = get_post_meta(get_the_ID(), '_garage_badge', true);
    $duration = get_post_meta(get_the_ID(), '_garage_duration', true);
    $warranty = get_post_meta(get_the_ID(), '_garage_warranty', true);
    $features = hieugara_get_service_features(get_the_ID());
    $thumb    = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=1200&q=80';
    ?>

    <main id="primary" class="site-main" style="padding: 40px 0 80px; background: var(--slate-50);">
        <div class="container">
            
            <!-- Breadcrumbs -->
            <div style="font-size: 0.8125rem; color: var(--slate-500); margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--slate-700);"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('garage_service')); ?>" style="color: var(--slate-700);"><?php _e('Dịch vụ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <strong style="color: var(--slate-900);"><?php the_title(); ?></strong>
            </div>

            <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 40px; align-items: flex-start;">
                <!-- Main Content -->
                <article class="service-detail-main" style="background: var(--white); padding: 36px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); border: 1px solid var(--slate-200);">
                    <?php if (!empty($badge)) : ?>
                        <div class="section-pill" style="margin-bottom: 12px;"><?php echo esc_html($badge); ?></div>
                    <?php endif; ?>

                    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--slate-900); margin-bottom: 16px;"><?php the_title(); ?></h1>

                    <!-- Key Service Metrics Bar -->
                    <div style="display: flex; gap: 24px; padding: 18px 24px; background: var(--slate-50); border-radius: var(--radius-md); border: 1px solid var(--slate-200); margin-bottom: 28px; flex-wrap: wrap;">
                        <div>
                            <small style="color: var(--slate-500); font-size: 0.75rem; text-transform: uppercase; font-weight: 700;"><?php _e('Chi phí tham khảo:', 'hieugara-motors'); ?></small>
                            <div style="font-size: 1.25rem; font-weight: 800; color: var(--brand-red);"><?php echo esc_html($price ? $price : 'Khảo sát miễn phí'); ?></div>
                        </div>
                        <?php if (!empty($duration)) : ?>
                            <div style="border-left: 1px solid var(--slate-200); padding-left: 24px;">
                                <small style="color: var(--slate-500); font-size: 0.75rem; text-transform: uppercase; font-weight: 700;"><?php _e('Thời gian thi công:', 'hieugara-motors'); ?></small>
                                <div style="font-size: 1rem; font-weight: 700; color: var(--slate-800);"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($warranty)) : ?>
                            <div style="border-left: 1px solid var(--slate-200); padding-left: 24px;">
                                <small style="color: var(--slate-500); font-size: 0.75rem; text-transform: uppercase; font-weight: 700;"><?php _e('Thời hạn bảo hành:', 'hieugara-motors'); ?></small>
                                <div style="font-size: 1rem; font-weight: 700; color: #10b981;"><?php echo esc_html($warranty); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Image -->
                    <div style="margin-bottom: 30px; border-radius: var(--radius-md); overflow: hidden;">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>

                    <!-- Checklist -->
                    <?php if (!empty($features)) : ?>
                        <div style="background: var(--brand-red-light); border: 1px solid rgba(225,29,72,0.15); border-radius: var(--radius-md); padding: 24px; margin-bottom: 32px;">
                            <h3 style="font-size: 1rem; font-weight: 800; color: var(--brand-red); margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <i class="fa fa-clipboard-check"></i> <?php _e('TIÊU CHUẨN THI CÔNG & CAM KẾT CHẤT LƯỢNG:', 'hieugara-motors'); ?>
                            </h3>
                            <ul style="list-style: none;">
                                <?php foreach ($features as $f) : ?>
                                    <li style="margin-bottom: 8px; display: flex; align-items: flex-start; gap: 10px; font-weight: 600; color: var(--slate-800); font-size: 0.9375rem;">
                                        <i class="fa fa-circle-check" style="color: var(--brand-red); margin-top: 4px;"></i>
                                        <span><?php echo esc_html($f); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Body Content -->
                    <div class="entry-content" style="line-height: 1.8; color: var(--slate-600); font-size: 1rem;">
                        <?php the_content(); ?>
                    </div>
                </article>

                <!-- Sidebar Direct Booking Engine -->
                <aside class="service-sidebar">
                    <div class="booking-engine-card" style="position: sticky; top: 100px;">
                        <div class="engine-header">
                            <div>
                                <span style="font-size: 0.75rem; font-weight: 700; color: var(--brand-red); text-transform: uppercase;"><?php _e('TIẾP NHẬN XE TRỰC TIẾP', 'hieugara-motors'); ?></span>
                                <h3><?php _e('Đặt Lịch Cho Gói Dịch Vụ Này', 'hieugara-motors'); ?></h3>
                            </div>
                        </div>

                        <form class="hieugara-ajax-form">
                            <input type="hidden" name="service_type" value="<?php the_title_attribute(); ?>">

                            <div class="engine-field" style="margin-bottom: 12px;">
                                <label><?php _e('Họ và tên (*)', 'hieugara-motors'); ?></label>
                                <input type="text" name="customer_name" class="engine-input" required placeholder="VD: Anh Tuấn">
                            </div>

                            <div class="engine-field" style="margin-bottom: 12px;">
                                <label><?php _e('Số điện thoại (*)', 'hieugara-motors'); ?></label>
                                <input type="tel" name="customer_phone" class="engine-input" required placeholder="09xx xxx xxx">
                            </div>

                            <div class="engine-field" style="margin-bottom: 12px;">
                                <label><?php _e('Dòng xe của bạn', 'hieugara-motors'); ?></label>
                                <input type="text" name="car_model" class="engine-input" placeholder="VD: Tucson, Vios, CX-5...">
                            </div>

                            <div class="engine-field" style="margin-bottom: 16px;">
                                <label><?php _e('Cơ sở tiếp nhận thuận tiện', 'hieugara-motors'); ?></label>
                                <select name="branch_location" class="engine-select">
                                    <option value="Xưởng Cầu Giấy (500 Cầu Giấy)">Xưởng Cầu Giấy (500 Cầu Giấy, HN)</option>
                                    <option value="Xưởng Tây Hồ (685 Lạc Long Quân)">Xưởng Tây Hồ (685 Lạc Long Quân, HN)</option>
                                    <option value="Xưởng Long Biên (390 Nguyễn Văn Cừ)">Xưởng Long Biên (390 Nguyễn Văn Cừ, HN)</option>
                                    <option value="Xưởng Hoàng Mai (820 Giải Phóng)">Xưởng Hoàng Mai (820 Giải Phóng, HN)</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-carpla btn-carpla-primary" style="width: 100%; padding: 14px;">
                                <i class="fa fa-calendar-check"></i> <?php _e('ĐẶT HẸN TIẾP NHẬN NGAY', 'hieugara-motors'); ?>
                            </button>
                            <div class="form-response-msg" style="display:none;"></div>
                        </form>

                        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--slate-100); font-size: 0.8125rem; color: var(--slate-500);">
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #10b981;"></i> Miễn phí kiểm tra tổng quát 30 hạng mục.</p>
                            <p style="margin-bottom: 6px;"><i class="fa fa-check" style="color: #10b981;"></i> Báo giá trước, khách duyệt mới bắt đầu làm.</p>
                            <p><i class="fa fa-check" style="color: #10b981;"></i> Bảo hành điện tử tra cứu tiện lợi.</p>
                        </div>
                    </div>
                </aside>
            </div>

        </div>
    </main>

    <?php
endwhile;

get_footer();
