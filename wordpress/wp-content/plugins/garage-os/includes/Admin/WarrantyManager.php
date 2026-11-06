<?php
namespace GarageOS\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class WarrantyManager {

    public static function render() {
        global $wpdb;
        $table_warranties = $wpdb->prefix . 'garage_warranties';

        // Check if creating new warranty
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['garage_save_warranty'])) {
            check_admin_referer('garage_save_warranty_nonce');

            $warranty_code   = sanitize_text_field($_POST['warranty_code']);
            $license_plate   = strtoupper(trim(sanitize_text_field($_POST['license_plate'])));
            $customer_name   = sanitize_text_field($_POST['customer_name']);
            $customer_phone  = sanitize_text_field($_POST['customer_phone']);
            $item_type       = sanitize_text_field($_POST['item_type']);
            $item_name       = sanitize_text_field($_POST['item_name']);
            $duration_months = intval($_POST['duration_months']);
            $start_date      = sanitize_text_field($_POST['start_date']);
            $terms           = sanitize_textarea_field($_POST['terms']);

            $end_date = date('Y-m-d', strtotime("+$duration_months months", strtotime($start_date)));

            $wpdb->insert($table_warranties, [
                'warranty_code'   => $warranty_code,
                'license_plate'   => $license_plate,
                'customer_name'   => $customer_name,
                'customer_phone'  => $customer_phone,
                'item_type'       => $item_type,
                'item_name'       => $item_name,
                'duration_months' => $duration_months,
                'start_date'      => $start_date,
                'end_date'        => $end_date,
                'terms'           => $terms,
                'status'          => 'active',
                'created_at'      => current_time('mysql'),
            ]);

            echo '<div class="notice notice-success is-dismissible"><p>Kích hoạt sổ bảo hành điện tử thành công!</p></div>';
        }

        $warranties = $wpdb->get_results("SELECT * FROM $table_warranties ORDER BY id DESC");
        $today = current_time('Y-m-d');
        ?>
        <div class="wrap garage-os-wrap">
            <div class="garage-os-header">
                <div>
                    <span class="garage-badge-pill">E-Warranty Passport</span>
                    <h1 class="garage-title">Sổ Bảo Hành Điện Tử Ô Tô</h1>
                    <p class="garage-subtitle">Quản lý chứng thư bảo hành chất lượng đồng sơn sấy hấp, phụ tùng chính hãng và dịch vụ detailing.</p>
                </div>
                <div>
                    <a href="#new-warranty-form" class="btn-garage-primary">
                        <span class="dashicons dashicons-plus-alt2"></span> Kích Hoạt Bảo Hành Mới
                    </a>
                </div>
            </div>

            <!-- Warranties Table -->
            <table class="garage-data-table" style="margin-bottom:30px;">
                <thead>
                    <tr>
                        <th>Mã Chứng Thư</th>
                        <th>Biển Số Xe</th>
                        <th>Chủ Xe & SĐT</th>
                        <th>Hạng Mục Bảo Hành</th>
                        <th>Thời Hạn (Tháng)</th>
                        <th>Hiệu Lực Từ - Đến</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($warranties)): ?>
                        <tr><td colspan="7" style="text-align: center; padding: 24px;">Chưa có sổ bảo hành nào được kích hoạt.</td></tr>
                    <?php else: ?>
                        <?php foreach ($warranties as $w): 
                            $is_active = ($w->status === 'active' && $w->end_date >= $today);
                        ?>
                            <tr>
                                <td><strong style="color:var(--gos-slate-900);"><?php echo esc_html($w->warranty_code); ?></strong></td>
                                <td><span class="plate-badge"><?php echo esc_html($w->license_plate); ?></span></td>
                                <td>
                                    <strong><?php echo esc_html($w->customer_name); ?></strong><br>
                                    <span style="color:#64748b;font-size:12px;"><?php echo esc_html($w->customer_phone); ?></span>
                                </td>
                                <td>
                                    <strong><?php echo esc_html($w->item_name); ?></strong>
                                    <div style="font-size:11px;color:#64748b;margin-top:2px;"><?php echo esc_html($w->terms); ?></div>
                                </td>
                                <td style="text-align:center;">
                                    <strong><?php echo esc_html($w->duration_months); ?> tháng</strong>
                                </td>
                                <td>
                                    <div>Từ: <?php echo date('d/m/Y', strtotime($w->start_date)); ?></div>
                                    <div>Đến: <strong><?php echo date('d/m/Y', strtotime($w->end_date)); ?></strong></div>
                                </td>
                                <td>
                                    <?php if ($is_active): ?>
                                        <span style="background:#dcfce7;color:#16a34a;padding:4px 8px;border-radius:4px;font-size:11px;font-weight:700;">Đang có hiệu lực</span>
                                    <?php else: ?>
                                        <span style="background:#fee2e2;color:#dc2626;padding:4px 8px;border-radius:4px;font-size:11px;font-weight:700;">Hết hạn</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Quick Issue Form -->
            <div id="new-warranty-form" style="background:#ffffff;padding:28px;border-radius:8px;border:1px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <h3 style="margin-top:0;padding-bottom:8px;border-bottom:2px solid #e11d48;font-size:16px;">Kích Hoạt Chứng Thư Bảo Hành Điện Tử Mới</h3>
                <form method="post" action="">
                    <?php wp_nonce_field('garage_save_warranty_nonce'); ?>
                    <input type="hidden" name="garage_save_warranty" value="1">

                    <div style="display:grid;grid-template-columns: repeat(3, 1fr);gap:18px;margin-bottom:18px;">
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Mã Bảo Hành</label>
                            <input type="text" name="warranty_code" value="WAR-<?php echo strtoupper(wp_generate_password(6, false)); ?>" required class="widefat" style="font-weight:700;">
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Biển Số Xe Được Bảo Hành</label>
                            <input type="text" name="license_plate" placeholder="Ví dụ: 30H-888.88" required class="widefat" style="text-transform:uppercase;font-weight:700;letter-spacing:1px;">
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Phân Loại Dịch Vụ</label>
                            <select name="item_type" class="widefat">
                                <option value="paint">Bảo hành Đồng Sơn sấy hấp</option>
                                <option value="part">Bảo hành Phụ tùng thay thế</option>
                                <option value="battery">Bảo hành Ắc quy & Điện lạnh</option>
                                <option value="film_detailing">Bảo hành Phim cách nhiệt & Detailing</option>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Tên Khách Hàng</label>
                            <input type="text" name="customer_name" required class="widefat">
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Số Điện Thoại</label>
                            <input type="text" name="customer_phone" required class="widefat">
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Thời Hạn Bảo Hành (Số tháng)</label>
                            <input type="number" name="duration_months" value="12" required class="widefat">
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns: 2fr 1fr;gap:18px;margin-bottom:18px;">
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Tên Hạng Mục / Chi Tiết Bảo Hành</label>
                            <input type="text" name="item_name" placeholder="Ví dụ: Bảo hành chất lượng bề mặt sơn cánh cửa & cản trước..." required class="widefat">
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Ngày Bắt Đầu</label>
                            <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required class="widefat">
                        </div>
                    </div>

                    <div style="margin-bottom:18px;">
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Điều Khoản & Cam Kết Bảo Hành</label>
                        <textarea name="terms" rows="2" class="widefat">Cam kết 1 đổi 1 hoặc xử lý miễn phí 100% nếu phát sinh lỗi kỹ thuật từ quy trình sửa chữa của Hải Hà ÔTô Service.</textarea>
                    </div>

                    <button type="submit" class="btn-garage-primary" style="padding:10px 20px;">
                        <span class="dashicons dashicons-shield"></span> Kích Hoạt Chứng Thư Ngay
                    </button>
                </form>
            </div>
        </div>
        <?php
    }
}
