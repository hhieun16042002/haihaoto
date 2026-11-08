<?php
/**
 * Template Name: Về Chúng Tôi (About Hiếu Gara Service)
 * The template for displaying the company about page.
 *
 * @package HieuGara_Motors
 */

get_header();

$about_p_title     = get_option('hieugara_about_page_title', 'Ôtô Hải Hà: 31 Năm Giữ Trọn Chữ Tâm Với Nghề');
$about_p_subtitle  = get_option('hieugara_about_page_subtitle', 'Khởi nguồn từ năm 1995 bởi nhà sáng lập ông Nguyễn Hải Hà. 31 năm trôi qua, niềm tin "chăm sóc xe bằng cái tâm người thợ" vẫn là kim chỉ nam trong từng công việc chúng tôi làm mỗi ngày.');
$about_show_story  = get_option('hieugara_about_show_story', '1');
$about_show_commit = get_option('hieugara_about_show_commitments', '1');
$about_years_exp   = get_option('hieugara_about_years_exp', '31+');
$about_staff_count = get_option('hieugara_about_staff_count', '80+');
$about_parts_rate  = get_option('hieugara_about_parts_rate', '100%');
?>

<main id="primary" class="site-main page-about-portal">

    <!-- Page Breadcrumb & Header -->
    <section class="portal-hero-header">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Về chúng tôi', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php echo esc_html($about_p_title); ?></h1>
            <?php if (!empty($about_p_subtitle)) : ?>
            <p class="portal-page-subtitle">
                <?php echo nl2br(esc_html($about_p_subtitle)); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($about_show_story === '1') : ?>
    <!-- Company Story & Mission -->
    <section class="about-story-section" id="su-kien" style="padding: 70px 0; background: #ffffff;">
        <div class="container">
            <div class="about-story-grid">
                <div class="about-story-content">
                    <span class="story-tag"><i class="fa fa-award"></i> HÀNH TRÌNH <?php echo esc_html($about_years_exp); ?> NĂM (1995 — <?php echo date('Y'); ?>)</span>
                    <h2 style="font-size: 2rem; line-height: 1.35; margin-bottom: 20px; color: #141414;"><?php echo esc_html($about_p_title); ?></h2>
                    
                    <p style="font-size: 1.05rem; line-height: 1.8; color: #334155; margin-bottom: 16px;">
                        Năm 1995, nhà sáng lập ông <strong>Nguyễn Hải Hà</strong> đặt những viên gạch đầu tiên cho Ôtô Hải Hà với một niềm tin giản dị: <em>mỗi chiếc xe đều xứng đáng được chăm sóc bằng cái tâm của người thợ</em>. 31 năm đã trôi qua, niềm tin ấy vẫn là kim chỉ nam trong từng công việc chúng tôi làm mỗi ngày.
                    </p>
                    
                    <p style="font-size: 1.05rem; line-height: 1.8; color: #334155; margin-bottom: 16px;">
                        Qua hơn ba thập kỷ, biết bao thế hệ xe đã lăn bánh qua gara, mang theo những câu chuyện và kinh nghiệm quý giá cho nghề. Nhưng điều chúng tôi trân trọng nhất là sự tin tưởng của khách hàng. Bởi chúng tôi hiểu rằng, giao xe cho gara không chỉ là giao một phương tiện, mà còn là gửi gắm sự an tâm trên mỗi hành trình của bạn và gia đình.
                    </p>

                    <p style="font-size: 1.05rem; line-height: 1.8; color: #334155; margin-bottom: 16px;">
                        Ngày nay, Ôtô Hải Hà tự hào có <strong>đội ngũ <?php echo esc_html($about_staff_count); ?> nhân viên</strong> làm việc chuyên nghiệp và phục vụ tận tâm, cung cấp đầy đủ các dịch vụ sửa chữa và bảo dưỡng ô tô. Từ lần bảo dưỡng định kỳ đến những hạng mục sửa chữa cần sự tỉ mỉ, mọi nhu cầu của chiếc xe đều được chăm lo tại một địa chỉ duy nhất.
                    </p>

                    <blockquote style="border-left: 4px solid #F5A300; background: #F5F5F5; padding: 14px 20px; font-weight: 700; color: #1e3a8a; font-size: 1.05rem; margin-bottom: 26px; border-radius: 0 6px 6px 0;">
                        "Ôtô Hải Hà: Tận tâm với từng chiếc xe, vững tin trên mọi hành trình."
                    </blockquote>

                    <div style="display: flex; flex-wrap: wrap; gap: 14px; align-items: center; margin-bottom: 30px;">
                        <a href="https://www.facebook.com/profile.php?id=100069673756551" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; gap: 10px; background: #1877f2; color: #ffffff; padding: 12px 24px; border-radius: 6px; font-size: 0.95rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 14px rgba(24, 119, 242, 0.35); transition: transform 0.2s;">
                            <i class="fa-brands fa-facebook" style="font-size: 1.3rem;"></i>
                            <span>Theo dõi Fanpage Ôtô Hải Hà trên Facebook &rarr;</span>
                        </a>
                        <a href="tel:02203892207" style="display: inline-flex; align-items: center; gap: 8px; background: #D4B996; color: #141414; padding: 12px 22px; border-radius: 6px; font-size: 0.95rem; font-weight: 700; text-decoration: none;">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span>Tư vấn: 02203 892 207</span>
                        </a>
                    </div>

                    <div class="about-highlights-row">
                        <div class="hl-item">
                            <strong><?php echo esc_html($about_years_exp); ?></strong>
                            <span>Năm đồng hành (1995-<?php echo date('Y'); ?>)</span>
                        </div>
                        <div class="hl-item">
                            <strong><?php echo esc_html($about_staff_count); ?></strong>
                            <span>Nhân sự tận tâm &amp; chuyên môn cao</span>
                        </div>
                        <div class="hl-item">
                            <strong><?php echo esc_html($about_parts_rate); ?></strong>
                            <span>Phụ tùng chuẩn &amp; Bảo hành an tâm</span>
                        </div>
                    </div>
                </div>

                <div class="about-story-media">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/shiftup/tech-about.jpg?v=' . HIEUGARA_THEME_VERSION); ?>" alt="Kỹ thuật viên xưởng dịch vụ Ôtô Hải Hà" class="story-img-main" style="border-radius: 8px; box-shadow: 0 16px 36px rgba(0,0,0,0.15);">
                    <div class="story-floating-badge" style="background: #141414; color: #ffffff; border: 1px solid rgba(245, 163, 0, 0.4);">
                        <i class="fa fa-shield-heart" style="color: #F5A300;"></i>
                        <div>
                            <strong style="color: #F5A300;">CHỮ TÂM VỚI NGHỀ</strong>
                            <small style="color: #94a3b8;">Ôtô Hải Hà từ 1995 &bull; <?php echo esc_html($about_staff_count); ?> nhân sự tận tâm</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($about_show_commit === '1') : ?>
    <!-- 5 Cam Kết "Vàng" -->
    <section class="commitments-section" id="tieu-chuan">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('NGUYÊN TẮC HOẠT ĐỘNG', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('5 Cam Kết "Vàng" Từ Ôtô Hải Hà', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Kim chỉ nam trong mọi hoạt động tiếp nhận xe và phục vụ khách hàng trên toàn bộ hệ thống xưởng.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="commitments-grid">
                <div class="commit-card">
                    <div class="commit-num">01</div>
                    <h4>100% Phụ Tùng Chính Hãng</h4>
                    <p>Mọi linh kiện, dầu nhớt và phụ tùng thay thế đều có tem kiểm định, hóa đơn xuất xứ rõ ràng. Hoàn tiền 100% nếu phát hiện hàng giả, hàng nhái.</p>
                </div>
                <div class="commit-card">
                    <div class="commit-num">02</div>
                    <h4>Báo Giá Chuẩn & Không Phát Sinh</h4>
                    <p>Khách hàng duyệt bảng kê chi tiết phụ tùng và công thợ trước khi tiến hành. Tuyệt đối không phát sinh chi phí khi chưa được đồng ý.</p>
                </div>
                <div class="commit-card">
                    <div class="commit-num">03</div>
                    <h4>Bảo Hành Dài Hạn Minh Bạch</h4>
                    <p>Cam kết chất lượng bằng văn bản và phiếu bảo hành chính thức. Chế độ bảo hành đồng sơn lên đến 24 tháng và bảo hành phụ tùng chính hãng.</p>
                </div>
                <div class="commit-card">
                    <div class="commit-num">04</div>
                    <h4>Đúng Hẹn Bàn Giao Xe</h4>
                    <p>Quy trình thi công được giám sát chặt chẽ trên bảng điều độ khoang xưởng Garage OS, đảm bảo xe được bàn giao đúng giờ đã hẹn.</p>
                </div>
                <div class="commit-card">
                    <div class="commit-num">05</div>
                    <h4>Đồng Hành Trọn Vẹn 24/7</h4>
                    <p>Hỗ trợ cứu hộ giao thông khẩn cấp, nhắc hẹn bảo dưỡng định kỳ và hỗ trợ thủ tục giám định bảo hiểm thân vỏ miễn phí trọn gói.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 48px;">
                <a href="tel:02203892207" class="btn-carpla btn-carpla-primary" style="padding: 14px 36px; font-weight: 800; background: #D4B996; color: #141414;">
                    <i class="fa-solid fa-phone-volume"></i> <?php _e('GỌI TƯ VẤN DỊCH VỤ: 02203 892 207', 'hieugara-motors'); ?>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php
get_footer();
