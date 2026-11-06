<?php
/**
 * Template Name: Tra Cứu Bảo Hành Điện Tử (Carpla E-Warranty Portal)
 * The template for displaying the dedicated warranty and vehicle history portal.
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main page-warranty-portal">

    <!-- Page Breadcrumb & Header -->
    <section class="portal-hero-header">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Tra cứu bảo hành điện tử', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php _e('Cổng Tra Cứu Hồ Sơ Xe & Sổ Bảo Hành Điện Tử', 'hieugara-motors'); ?></h1>
            <p class="portal-page-subtitle">
                <?php _e('Toàn bộ lịch sử bảo dưỡng định kỳ, nhật ký sửa chữa kỹ thuật và chứng thư bảo hành chất lượng đồng sơn tại Ôtô Hải Hà Service đều được số hóa trực tuyến theo biển số xe.', 'hieugara-motors'); ?>
            </p>
        </div>
    </section>

    <!-- Interactive Lookup Widget Section -->
    <section class="lookup-interactive-section" style="padding: 50px 0 70px; background: #ffffff;">
        <div class="container">
            <?php echo do_shortcode('[garage_warranty_lookup]'); ?>
        </div>
    </section>

    <!-- Warranty Policy & Standards Information -->
    <section class="warranty-policy-section" style="padding: 60px 0 80px; background: var(--slate-50); border-top: 1px solid var(--slate-200);">
        <div class="container">
            <div class="section-header" style="margin-bottom: 40px;">
                <div class="section-pill"><?php _e('CHÍNH SÁCH BẢO HÀNH CHUẨN CARPLA', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('Quyền Lợi & Cam Kết Bảo Hành Chính Hãng', 'hieugara-motors'); ?></h2>
                <p class="section-desc">
                    <?php _e('Ôtô Hải Hà cam kết mang đến sự an tâm tuyệt đối trên mọi cung đường cho chủ xe với chính sách bảo hành rõ ràng, minh bạch.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="policy-cards-grid">
                <div class="policy-card">
                    <div class="policy-icon" style="background: #fff1f2; color: #e11d48;">
                        <i class="fa fa-paint-roller"></i>
                    </div>
                    <h3>Bảo Hành Đồng Sơn Sấy Hấp (12 - 24 Tháng)</h3>
                    <p>Cam kết chất lượng sơn gốc nước Axalta tiêu chuẩn phòng sấy nhiệt độ Đức. Bảo hành 100% không bay màu, bong tróc, nứt nẻ hoặc rộp bề mặt sơn.</p>
                    <ul class="policy-list">
                        <li><i class="fa fa-check"></i> Bảo hành màu sơn đồng nhất 99.8%</li>
                        <li><i class="fa fa-check"></i> Xử lý sơn dặm lại miễn phí nếu lỗi kỹ thuật</li>
                        <li><i class="fa fa-check"></i> Áp dụng trên toàn bộ chi nhánh xưởng</li>
                    </ul>
                </div>

                <div class="policy-card">
                    <div class="policy-icon" style="background: #eff6ff; color: #2563eb;">
                        <i class="fa fa-gears"></i>
                    </div>
                    <h3>Bảo Hành Phụ Tùng Thay Thế (6 - 12 Tháng)</h3>
                    <p>100% phụ tùng thay thế đều có tem kiểm định chính hãng từ nhà sản xuất (Toyota, Mazda, Hyundai, Mercedes...). Đổi mới 1:1 nếu có lỗi kỹ thuật.</p>
                    <ul class="policy-list">
                        <li><i class="fa fa-check"></i> Phụ tùng chính hãng có nguồn gốc hóa đơn</li>
                        <li><i class="fa fa-check"></i> Bảo hành ắc quy 12 tháng đổi mới</li>
                        <li><i class="fa fa-check"></i> Lọc nhớt, gioăng phớt bảo hành theo km</li>
                    </ul>
                </div>

                <div class="policy-card">
                    <div class="policy-icon" style="background: #f0fdf4; color: #16a34a;">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h3>Không Cần Giữ Sổ Giấy & Thẻ Cứng</h3>
                    <p>Chỉ cần đọc biển số xe khi đến bất kỳ cơ sở nào trong hệ thống xưởng Ôtô Hải Hà Service toàn quốc, kỹ thuật viên sẽ tra cứu được toàn bộ hồ sơ kỹ thuật.</p>
                    <ul class="policy-list">
                        <li><i class="fa fa-check"></i> Tra cứu tức thì trong 3 giây</li>
                        <li><i class="fa fa-check"></i> Nhắc hẹn bảo dưỡng qua SMS/Zalo</li>
                        <li><i class="fa fa-check"></i> Hỗ trợ kỹ thuật 24/7 khi cần cứu hộ</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
