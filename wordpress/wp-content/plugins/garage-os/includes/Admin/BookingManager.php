<?php
namespace GarageOS\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class BookingManager {

    public static function render() {
        if (!current_user_can('manage_options')) {
            wp_die(__('Bạn không có quyền truy cập trang quản lý này.', 'garage-os'));
        }
        global $wpdb;
        $table_bookings = $wpdb->prefix . 'garage_bookings';

        // Check if there are actions like delete or mark completed
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($action === 'delete' && $id > 0 && check_admin_referer('garage_booking_action')) {
            $wpdb->delete($table_bookings, ['id' => $id]);
            echo '<div class="notice notice-success is-dismissible"><p>Đã xóa lịch hẹn thành công.</p></div>';
        }

        $bookings = $wpdb->get_results("SELECT * FROM $table_bookings ORDER BY booking_date DESC, id DESC");
        ?>
        <div class="wrap garage-os-wrap">
            <div class="garage-os-header">
                <div>
                    <span class="garage-badge-pill">Tiếp nhận dịch vụ</span>
                    <h1 class="garage-title">Danh Sách Lịch Hẹn Khách Hàng</h1>
                    <p class="garage-subtitle">Lịch hẹn được đặt trực tuyến qua website hoặc nhân viên lễ tân ghi nhận.</p>
                </div>
                <div>
                    <a href="<?php echo admin_url('admin.php?page=garage-os-kanban'); ?>" class="btn-garage-secondary">
                        <span class="dashicons dashicons-arrow-left-alt"></span> Về Khoang Sửa Chữa
                    </a>
                </div>
            </div>

            <table class="garage-data-table">
                <thead>
                    <tr>
                        <th>Mã Hẹn</th>
                        <th>Biển Số Xe</th>
                        <th>Thông Tin Khách Hàng</th>
                        <th>Dòng Xe & Dịch Vụ Yêu Cầu</th>
                        <th>Chi Nhánh Tiếp Nhận</th>
                        <th>Thời Gian Hẹn</th>
                        <th>Trạng Thái</th>
                        <th style="text-align: right;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bookings)): ?>
                        <tr><td colspan="8" style="text-align: center; padding: 24px;">Chưa có lịch hẹn nào.</td></tr>
                    <?php else: ?>
                        <?php foreach ($bookings as $b): 
                            $status_badges = [
                                'pending'     => '<span style="background:#fee2e2;color:#dc2626;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">Chờ xác nhận</span>',
                                'confirmed'   => '<span style="background:#fef3c7;color:#d97706;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">Đã xác nhận</span>',
                                'in_progress' => '<span style="background:#eff6ff;color:#2563eb;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">Đang làm việc</span>',
                                'completed'   => '<span style="background:#dcfce7;color:#16a34a;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">Hoàn tất</span>',
                            ];
                        ?>
                            <tr>
                                <td><strong style="color:var(--gos-slate-900);"><?php echo esc_html($b->booking_code); ?></strong></td>
                                <td><span class="plate-badge"><?php echo esc_html($b->license_plate); ?></span></td>
                                <td>
                                    <strong><?php echo esc_html($b->customer_name); ?></strong><br>
                                    <span style="color:#64748b;font-size:12px;"><?php echo esc_html($b->customer_phone); ?></span>
                                </td>
                                <td>
                                    <div style="font-weight:600;"><?php echo esc_html($b->car_model); ?></div>
                                    <div style="color:#475569;font-size:12px;"><?php echo esc_html($b->service_requested); ?></div>
                                    <?php if ($b->notes): ?>
                                        <div style="color:#94a3b8;font-size:11px;font-style:italic;">Ghi chú: <?php echo esc_html($b->notes); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo esc_html($b->branch); ?></td>
                                <td>
                                    <strong><?php echo date('d/m/Y', strtotime($b->booking_date)); ?></strong><br>
                                    <span style="color:#64748b;font-size:12px;"><?php echo esc_html($b->booking_time); ?></span>
                                </td>
                                <td><?php echo $status_badges[$b->status] ?? esc_html($b->status); ?></td>
                                <td style="text-align: right;">
                                    <?php if ($b->status === 'pending' || $b->status === 'confirmed'): ?>
                                        <button type="button" class="btn-garage-primary btn-confirm-booking" data-id="<?php echo esc_attr($b->id); ?>" style="padding:4px 10px;font-size:11px;">
                                            Tiếp Nhận & Mở RO
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=garage-os-bookings&action=delete&id=' . $b->id), 'garage_booking_action'); ?>" 
                                       onclick="return confirm('Bạn chắc chắn muốn xóa lịch hẹn này?');" 
                                       class="btn-icon" style="display:inline-flex;margin-left:4px;">
                                        <span class="dashicons dashicons-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
