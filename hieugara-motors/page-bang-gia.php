<?php
/**
 * Template Name: Bảng Giá Dịch Vụ (Hiếu Gara Price Table)
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: var(--bg-light);">
    <div class="container">
        
        <div class="section-header">
            <span class="section-tag"><?php _e('NIÊM YẾT MINH BẠCH', 'hieugara-motors'); ?></span>
            <h1 class="section-title"><?php _e('BẢNG GIÁ DỊCH VỤ TẠI HIẾU GARA', 'hieugara-motors'); ?></h1>
            <p class="section-desc">
                <?php _e('Cam kết báo giá trước khi làm. Không phát sinh chi phí. Bảo hành uy tín bằng văn bản cho mọi hạng mục.', 'hieugara-motors'); ?>
            </p>
        </div>

        <div style="max-width: 960px; margin: 0 auto; background: #ffffff; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); border: 1px solid var(--border-color); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: var(--navy-dark); color: #ffffff;">
                        <th style="padding: 18px 24px; font-family: var(--font-heading);"><?php _e('Hạng mục dịch vụ', 'hieugara-motors'); ?></th>
                        <th style="padding: 18px 24px; font-family: var(--font-heading);"><?php _e('Đơn giá tham khảo', 'hieugara-motors'); ?></th>
                        <th style="padding: 18px 24px; font-family: var(--font-heading);"><?php _e('Bảo hành', 'hieugara-motors'); ?></th>
                        <th style="padding: 18px 24px; font-family: var(--font-heading); text-align: right;"><?php _e('Đặt hẹn', 'hieugara-motors'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 16px 24px;"><strong>Sơn dặm vá cản trước / cản sau</strong><br><small style="color: var(--text-muted);">Sơn phòng sấy Ý, lấy ngay sau 4 tiếng</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">400.000 - 800.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">24 tháng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Sơn dặm cản trước/sau">Chọn</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color); background: var(--bg-light);">
                        <td style="padding: 16px 24px;"><strong>Sơn cánh cửa / Tai xe / Cốp sau</strong><br><small style="color: var(--text-muted);">Khử gỉ, bả matit chuẩn form, sơn lót & sơn bóng</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">600.000 - 1.000.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">24 tháng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Sơn cánh cửa / Tai vè">Chọn</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 16px 24px;"><strong>Sơn đổi màu toàn bộ xe / Sơn quây</strong><br><small style="color: var(--text-muted);">Tháo dỡ chi tiết, sơn sấy đa lớp, bóng sâu bền màu</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">14.000.000 - 22.000.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">36 tháng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Sơn quây đổi màu xe">Chọn</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color); background: var(--bg-light);">
                        <td style="padding: 16px 24px;"><strong>Bảo dưỡng cấp nhỏ (5.000 km)</strong><br><small style="color: var(--text-muted);">Thay dầu máy + Kiểm tra miễn phí 30 hạng mục gầm phanh</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">550.000 - 850.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">Phụ tùng chính hãng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Bảo dưỡng cấp 5.000 km">Chọn</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 16px 24px;"><strong>Bảo dưỡng cấp trung bình lớn (20.000 - 40.000 km)</strong><br><small style="color: var(--text-muted);">Dầu máy, lọc dầu, lọc gió, bảo dưỡng 4 phanh, vệ sinh kim phun</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">1.800.000 - 3.500.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">12 tháng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Bảo dưỡng cấp 20.000 - 40.000 km">Chọn</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color); background: var(--bg-light);">
                        <td style="padding: 16px 24px;"><strong>Vệ sinh dàn lạnh nội soi & Nạp gas</strong><br><small style="color: var(--text-muted);">Camera nội soi không tháo taplo, khử sạch mùi hôi</small></td>
                        <td style="padding: 16px 24px; color: var(--primary-red); font-weight: 700;">600.000 - 1.200.000 đ</td>
                        <td style="padding: 16px 24px; color: #10b981; font-weight: 600;">12 tháng</td>
                        <td style="padding: 16px 24px; text-align: right;"><a href="#" class="btn-gara btn-gara-red" style="padding: 6px 14px; font-size: 0.75rem;" data-open-modal="booking" data-service-title="Vệ sinh dàn lạnh & nạp gas">Chọn</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</main>

<?php
get_footer();

