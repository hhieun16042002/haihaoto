<?php
namespace GarageOS\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class WorkOrderManager {

    public static function render() {
        if (!current_user_can('manage_options')) {
            wp_die(__('Bạn không có quyền truy cập trang quản lý này.', 'garage-os'));
        }

        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($action === 'print' && $id > 0) {
            self::render_print_view($id);
            return;
        }

        if ($action === 'new' || $action === 'edit') {
            self::render_form_view($id);
            return;
        }

        self::render_list_view();
    }

    private static function render_list_view() {
        global $wpdb;
        $table_orders = $wpdb->prefix . 'garage_work_orders';
        $orders = $wpdb->get_results("SELECT * FROM $table_orders ORDER BY id DESC");

        $status_map = [
            'receiving'     => '<span style="background:#f1f5f9;color:#475569;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">1. Tiếp nhận</span>',
            'quotation'     => '<span style="background:#fef3c7;color:#d97706;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">2. Khảo sát & Báo giá</span>',
            'in_progress'   => '<span style="background:#dbeafe;color:#1d4ed8;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">3. Đang thi công</span>',
            'quality_check' => '<span style="background:#f3e8ff;color:#7e22ce;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">4. Kiểm tra KCS</span>',
            'delivered'     => '<span style="background:#dcfce7;color:#15803d;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:700;">5. Đã bàn giao</span>',
        ];
        ?>
        <div class="wrap garage-os-wrap">
            <div class="garage-os-header">
                <div>
                    <span class="garage-badge-pill">Repair Orders Management</span>
                    <h1 class="garage-title">Hồ Sơ Xe & Lệnh Sửa Chữa (RO)</h1>
                    <p class="garage-subtitle">Quản lý toàn bộ lịch sử sửa chữa, vật tư phụ tùng, chi phí và trạng thái thi công của từng xe.</p>
                </div>
                <div class="garage-header-actions">
                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=new'); ?>" class="btn-garage-primary">
                        <span class="dashicons dashicons-plus-alt2"></span> Mở Lệnh Sửa Chữa Mới
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=garage-os-kanban'); ?>" class="btn-garage-secondary">
                        <span class="dashicons dashicons-grid-view"></span> Bảng Kanban
                    </a>
                </div>
            </div>

            <table class="garage-data-table">
                <thead>
                    <tr>
                        <th>Mã Lệnh (RO)</th>
                        <th>Biển Số</th>
                        <th>Khách Hàng</th>
                        <th>Dòng Xe & ODO</th>
                        <th>Khoang / KTV</th>
                        <th>Tổng Chi Phí</th>
                        <th>Thanh Toán</th>
                        <th>Trạng Thái</th>
                        <th style="text-align: right;">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9" style="text-align: center; padding: 24px;">Chưa có lệnh sửa chữa nào.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                            <tr>
                                <td><strong><?php echo esc_html($o->order_code); ?></strong></td>
                                <td><span class="plate-badge"><?php echo esc_html($o->license_plate); ?></span></td>
                                <td>
                                    <strong><?php echo esc_html($o->customer_name); ?></strong><br>
                                    <span style="color:#64748b;font-size:12px;"><?php echo esc_html($o->customer_phone); ?></span>
                                </td>
                                <td>
                                    <div><?php echo esc_html($o->car_model); ?></div>
                                    <div style="font-size:11px;color:#94a3b8;"><?php echo number_format($o->odo); ?> km</div>
                                </td>
                                <td>
                                    <div><strong><?php echo esc_html($o->bay_number); ?></strong></div>
                                    <div style="font-size:12px;color:#64748b;"><?php echo esc_html($o->technician_lead); ?></div>
                                </td>
                                <td>
                                    <strong style="color:var(--gos-primary);"><?php echo number_format($o->total_amount, 0, ',', '.'); ?> đ</strong>
                                </td>
                                <td>
                                    <span class="pay-badge pay-<?php echo esc_attr($o->payment_status); ?>">
                                        <?php 
                                            $labels = ['unpaid' => 'Chưa trả', 'deposit_paid' => 'Đã cọc', 'paid' => 'Đã thanh toán'];
                                            echo $labels[$o->payment_status] ?? $o->payment_status;
                                        ?>
                                    </span>
                                </td>
                                <td><?php echo $status_map[$o->work_status] ?? esc_html($o->work_status); ?></td>
                                <td style="text-align: right; white-space: nowrap;">
                                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=print&id=' . $o->id); ?>" target="_blank" class="btn-icon" title="In Phiếu / Báo Giá">
                                        <span class="dashicons dashicons-printer"></span>
                                    </a>
                                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=edit&id=' . $o->id); ?>" class="btn-icon" title="Chỉnh sửa">
                                        <span class="dashicons dashicons-edit"></span>
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

    private static function render_form_view($id = 0) {
        global $wpdb;
        $table_orders = $wpdb->prefix . 'garage_work_orders';

        // Handle POST save
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['garage_save_order'])) {
            check_admin_referer('garage_save_order_nonce');

            $order_code      = sanitize_text_field($_POST['order_code']);
            $customer_name   = sanitize_text_field($_POST['customer_name']);
            $customer_phone  = sanitize_text_field($_POST['customer_phone']);
            $license_plate   = strtoupper(trim(sanitize_text_field($_POST['license_plate'])));
            $car_model       = sanitize_text_field($_POST['car_model']);
            $odo             = intval($_POST['odo']);
            $bay_number      = sanitize_text_field($_POST['bay_number']);
            $technician_lead = sanitize_text_field($_POST['technician_lead']);
            $service_desc    = sanitize_textarea_field($_POST['service_description']);
            $work_status     = sanitize_text_field($_POST['work_status']);
            $payment_status  = sanitize_text_field($_POST['payment_status']);
            $notes           = sanitize_textarea_field($_POST['notes']);

            // Parse items
            $item_names  = $_POST['item_name'] ?? [];
            $item_types  = $_POST['item_type'] ?? [];
            $item_qtys   = $_POST['item_qty'] ?? [];
            $item_units  = $_POST['item_unit'] ?? [];
            $item_prices = $_POST['item_price'] ?? [];

            $parts_list = [];
            $labor_amount = 0;
            $parts_amount = 0;

            for ($i = 0; $i < count($item_names); $i++) {
                if (empty(trim($item_names[$i]))) continue;
                $name  = sanitize_text_field($item_names[$i]);
                $type  = sanitize_text_field($item_types[$i] ?? 'part');
                $qty   = floatval($item_qtys[$i] ?? 1);
                $unit  = sanitize_text_field($item_units[$i] ?? 'Cái');
                $price = floatval($item_prices[$i] ?? 0);
                $total = $qty * $price;

                if ($type === 'labor') {
                    $labor_amount += $total;
                } else {
                    $parts_amount += $total;
                }

                $parts_list[] = [
                    'name'     => $name,
                    'type'     => $type,
                    'quantity' => $qty,
                    'unit'     => $unit,
                    'price'    => $price,
                    'total'    => $total,
                ];
            }

            $discount_amount = floatval($_POST['discount_amount'] ?? 0);
            $total_amount = max(0, ($labor_amount + $parts_amount) - $discount_amount);

            $data = [
                'order_code'          => $order_code,
                'customer_name'       => $customer_name,
                'customer_phone'      => $customer_phone,
                'license_plate'       => $license_plate,
                'car_model'           => $car_model,
                'odo'                 => $odo,
                'technician_lead'     => $technician_lead,
                'bay_number'          => $bay_number,
                'service_description' => $service_desc,
                'parts_json'          => json_encode($parts_list, JSON_UNESCAPED_UNICODE),
                'labor_amount'        => $labor_amount,
                'parts_amount'        => $parts_amount,
                'discount_amount'     => $discount_amount,
                'total_amount'        => $total_amount,
                'payment_status'      => $payment_status,
                'work_status'         => $work_status,
                'notes'               => $notes,
            ];

            if ($id > 0) {
                $wpdb->update($table_orders, $data, ['id' => $id]);
                echo '<div class="notice notice-success is-dismissible"><p>Cập nhật Lệnh sửa chữa thành công!</p></div>';
            } else {
                $data['reception_date'] = current_time('mysql');
                $wpdb->insert($table_orders, $data);
                $id = $wpdb->insert_id;
                echo '<div class="notice notice-success is-dismissible"><p>Tạo mới Lệnh sửa chữa thành công!</p></div>';
            }
        }

        $order = null;
        if ($id > 0) {
            $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_orders WHERE id = %d", $id));
        }

        $parts = $order ? (json_decode($order->parts_json, true) ?: []) : [];
        if (empty($parts)) {
            $parts = [
                ['name' => '', 'type' => 'labor', 'quantity' => 1, 'unit' => 'Công', 'price' => 0, 'total' => 0]
            ];
        }

        $generated_code = 'RO-' . date('Y') . '-' . str_pad(wp_rand(100, 9999), 4, '0', STR_PAD_LEFT);
        ?>
        <div class="wrap garage-os-wrap">
            <div class="garage-os-header">
                <div>
                    <span class="garage-badge-pill"><?php echo $id > 0 ? 'Cập Nhật Hồ Sơ' : 'Khởi Tạo Hồ Sơ'; ?></span>
                    <h1 class="garage-title"><?php echo $id > 0 ? 'Lệnh Sửa Chữa: ' . esc_html($order->order_code) : 'Tạo Lệnh Sửa Chữa Mới (RO)'; ?></h1>
                    <p class="garage-subtitle">Lập phiếu tiếp nhận xe, bóc tách phụ tùng, tính công kỹ thuật & bảo hành.</p>
                </div>
                <div>
                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders'); ?>" class="btn-garage-secondary">
                        <span class="dashicons dashicons-arrow-left-alt"></span> Quay Lại Danh Sách
                    </a>
                </div>
            </div>

            <form method="post" action="" style="background:#ffffff;padding:28px;border-radius:8px;border:1px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <?php wp_nonce_field('garage_save_order_nonce'); ?>
                <input type="hidden" name="garage_save_order" value="1">

                <h3 style="margin-top:0;padding-bottom:8px;border-bottom:2px solid #e11d48;font-size:16px;">1. Thông Tin Tiếp Nhận Xe & Khách Hàng</h3>
                <div style="display:grid;grid-template-columns: repeat(3, 1fr);gap:18px;margin-bottom:24px;">
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Mã Lệnh Sửa Chữa (RO)</label>
                        <input type="text" name="order_code" value="<?php echo esc_attr($order ? $order->order_code : $generated_code); ?>" required class="widefat" style="font-weight:700;">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Biển Số Xe</label>
                        <input type="text" name="license_plate" value="<?php echo esc_attr($order ? $order->license_plate : ''); ?>" placeholder="Ví dụ: 30H-888.88" required class="widefat" style="text-transform:uppercase;font-weight:700;letter-spacing:1px;">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Dòng Xe / Phiên Bản / Đời</label>
                        <input type="text" name="car_model" value="<?php echo esc_attr($order ? $order->car_model : ''); ?>" placeholder="Ví dụ: Mazda CX-5 2.0 Premium (2022)" required class="widefat">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Tên Khách Hàng</label>
                        <input type="text" name="customer_name" value="<?php echo esc_attr($order ? $order->customer_name : ''); ?>" required class="widefat">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Số Điện Thoại</label>
                        <input type="text" name="customer_phone" value="<?php echo esc_attr($order ? $order->customer_phone : ''); ?>" required class="widefat">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Chỉ Số ODO (km hiện tại)</label>
                        <input type="number" name="odo" value="<?php echo esc_attr($order ? $order->odo : 10000); ?>" class="widefat">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns: repeat(2, 1fr);gap:18px;margin-bottom:24px;">
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Khoang Sửa Chữa Phân Bổ</label>
                        <select name="bay_number" class="widefat">
                            <?php 
                            $bays = ['Khoang Tiếp Nhận 01', 'Khoang Tiếp Nhận 02', 'Khoang Máy Gầm 01', 'Khoang Máy Gầm 02', 'Khoang Đồng Sơn 01', 'Khoang Đồng Sơn 02', 'Khoang Đồng Sơn 03', 'Phòng Detailing Vô Trùng', 'Cầu Kiểm Tra KCS'];
                            foreach ($bays as $b) {
                                echo '<option value="' . esc_attr($b) . '" ' . ($order && $order->bay_number === $b ? 'selected' : '') . '>' . esc_html($b) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Kỹ Thuật Viên Phụ Trách Chính (Lead Tech)</label>
                        <input type="text" name="technician_lead" value="<?php echo esc_attr($order ? $order->technician_lead : 'KTV Trưởng Phạm Văn Hiếu'); ?>" class="widefat">
                    </div>
                </div>

                <div style="margin-bottom:24px;">
                    <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Mô Tả Yêu Cầu Dịch Vụ & Hiện Trạng Xe Tiếp Nhận</label>
                    <textarea name="service_description" rows="3" class="widefat" placeholder="Ghi nhận hiện trạng trầy xước ban đầu, tiếng kêu động cơ, yêu cầu cụ thể của khách..."><?php echo esc_textarea($order ? $order->service_description : ''); ?></textarea>
                </div>

                <h3 style="margin-top:30px;padding-bottom:8px;border-bottom:2px solid #e11d48;font-size:16px;">2. Bảng Kê Vật Tư, Phụ Tùng & Nhân Công Sửa Chữa</h3>
                <table class="widefat fixed" id="items-table" style="margin-bottom:16px;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th style="width:40%;">Hạng Mục Công Việc / Tên Phụ Tùng</th>
                            <th style="width:15%;">Phân Loại</th>
                            <th style="width:10%;">Số Lượng</th>
                            <th style="width:10%;">Đơn Vị</th>
                            <th style="width:15%;">Đơn Giá (VNĐ)</th>
                            <th style="width:10%;text-align:right;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parts as $p): ?>
                            <tr>
                                <td><input type="text" name="item_name[]" value="<?php echo esc_attr($p['name']); ?>" placeholder="Tên phụ tùng / công..." class="widefat"></td>
                                <td>
                                    <select name="item_type[]" class="widefat">
                                        <option value="labor" <?php selected($p['type'] ?? '', 'labor'); ?>>Công thợ</option>
                                        <option value="part" <?php selected($p['type'] ?? '', 'part'); ?>>Phụ tùng</option>
                                        <option value="part_labor" <?php selected($p['type'] ?? '', 'part_labor'); ?>>Trọn gói</option>
                                    </select>
                                </td>
                                <td><input type="number" step="0.1" name="item_qty[]" value="<?php echo esc_attr($p['quantity'] ?? 1); ?>" class="widefat"></td>
                                <td><input type="text" name="item_unit[]" value="<?php echo esc_attr($p['unit'] ?? 'Cái'); ?>" class="widefat"></td>
                                <td><input type="number" name="item_price[]" value="<?php echo esc_attr($p['price'] ?? 0); ?>" class="widefat"></td>
                                <td style="text-align:right;"><button type="button" class="button remove-row-btn">&times;</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" class="button" id="add-row-btn"><span class="dashicons dashicons-plus"></span> Thêm Dòng Phụ Tùng / Công</button>

                <div style="display:grid;grid-template-columns: repeat(3, 1fr);gap:18px;margin-top:24px;background:#f8fafc;padding:16px;border-radius:6px;border:1px solid #e2e8f0;">
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Chiết Khấu / Ưu Đãi (VNĐ)</label>
                        <input type="number" name="discount_amount" value="<?php echo esc_attr($order ? $order->discount_amount : 0); ?>" class="widefat">
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Trạng Thái Thi Công</label>
                        <select name="work_status" class="widefat">
                            <option value="receiving" <?php selected($order ? $order->work_status : '', 'receiving'); ?>>1. Tiếp nhận & Thẩm định</option>
                            <option value="quotation" <?php selected($order ? $order->work_status : '', 'quotation'); ?>>2. Khảo sát & Báo giá</option>
                            <option value="in_progress" <?php selected($order ? $order->work_status : '', 'in_progress'); ?>>3. Đang thi công</option>
                            <option value="quality_check" <?php selected($order ? $order->work_status : '', 'quality_check'); ?>>4. Kiểm tra KCS</option>
                            <option value="delivered" <?php selected($order ? $order->work_status : '', 'delivered'); ?>>5. Hoàn tất bàn giao</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;font-size:13px;margin-bottom:4px;">Tình Trạng Thanh Toán</label>
                        <select name="payment_status" class="widefat">
                            <option value="unpaid" <?php selected($order ? $order->payment_status : '', 'unpaid'); ?>>Chưa thanh toán</option>
                            <option value="deposit_paid" <?php selected($order ? $order->payment_status : '', 'deposit_paid'); ?>>Đã đặt cọc</option>
                            <option value="paid" <?php selected($order ? $order->payment_status : '', 'paid'); ?>>Đã thanh toán đủ</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top:24px;text-align:right;">
                    <button type="submit" class="btn-garage-primary" style="padding:12px 24px;font-size:14px;">
                        <span class="dashicons dashicons-saved"></span> Lưu Hồ Sơ Lệnh Sửa Chữa
                    </button>
                </div>
            </form>

            <script>
            jQuery(document).ready(function($) {
                $('#add-row-btn').on('click', function() {
                    var rowHtml = '<tr>' +
                        '<td><input type="text" name="item_name[]" placeholder="Tên phụ tùng / công..." class="widefat"></td>' +
                        '<td><select name="item_type[]" class="widefat"><option value="labor">Công thợ</option><option value="part">Phụ tùng</option><option value="part_labor">Trọn gói</option></select></td>' +
                        '<td><input type="number" step="0.1" name="item_qty[]" value="1" class="widefat"></td>' +
                        '<td><input type="text" name="item_unit[]" value="Cái" class="widefat"></td>' +
                        '<td><input type="number" name="item_price[]" value="0" class="widefat"></td>' +
                        '<td style="text-align:right;"><button type="button" class="button remove-row-btn">&times;</button></td>' +
                        '</tr>';
                    $('#items-table tbody').append(rowHtml);
                });

                $(document).on('click', '.remove-row-btn', function() {
                    $(this).closest('tr').remove();
                });
            });
            </script>
        </div>
        <?php
    }

    private static function render_print_view($id) {
        global $wpdb;
        $table_orders = $wpdb->prefix . 'garage_work_orders';
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_orders WHERE id = %d", $id));

        if (!$order) {
            wp_die('Không tìm thấy lệnh sửa chữa!');
        }

        $parts = json_decode($order->parts_json, true) ?: [];
        ?>
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <title>Lệnh Sửa Chữa <?php echo esc_html($order->order_code); ?> - Hải Hà ÔTô</title>
            <style>
                body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #1e293b; background: #fff; margin: 0; padding: 20px; font-size: 13px; }
                .sheet { max-width: 800px; margin: 0 auto; border: 1px solid #e2e8f0; padding: 30px; }
                .header-table { width: 100%; border-bottom: 2px solid #e11d48; padding-bottom: 15px; margin-bottom: 20px; }
                .logo-title { font-size: 20px; font-weight: 900; color: #0f172a; text-transform: uppercase; margin: 0; }
                .logo-sub { color: #e11d48; font-weight: 700; font-size: 12px; margin: 2px 0 0; }
                .doc-title { text-align: center; font-size: 18px; font-weight: 800; margin: 15px 0 5px; text-transform: uppercase; color: #0f172a; }
                .doc-code { text-align: center; color: #64748b; font-size: 12px; margin-bottom: 20px; }
                .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #f8fafc; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 12px; }
                .info-row { margin-bottom: 5px; }
                .info-label { font-weight: 600; color: #475569; width: 110px; display: inline-block; }
                .parts-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                .parts-table th { background: #0f172a; color: #fff; font-size: 11px; padding: 8px 10px; text-align: left; }
                .parts-table td { border-bottom: 1px solid #e2e8f0; padding: 8px 10px; font-size: 12px; }
                .total-box { margin-left: auto; width: 300px; margin-bottom: 30px; font-size: 13px; }
                .total-row { display: flex; justify-content: space-between; padding: 4px 0; }
                .grand-total { font-weight: 800; font-size: 16px; color: #e11d48; border-top: 2px solid #0f172a; padding-top: 8px; margin-top: 4px; }
                .sign-row { display: grid; grid-template-columns: 1fr 1fr 1fr; text-align: center; margin-top: 40px; }
                .sign-space { height: 70px; }
                @media print {
                    .sheet { border: none; padding: 0; }
                    .no-print { display: none !important; }
                }
            </style>
        </head>
        <body>
            <div class="no-print" style="max-width:800px;margin:0 auto 15px;display:flex;justify-content:space-between;">
                <button onclick="window.print()" style="background:#e11d48;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer;font-weight:bold;">In Phiếu Này (Print RO)</button>
                <button onclick="window.close()" style="background:#64748b;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer;">Đóng Tab</button>
            </div>

            <div class="sheet">
                <table class="header-table">
                    <tr>
                        <td style="width:60%;">
                            <h1 class="logo-title">HẢI HÀ ÔTÔ SERVICE</h1>
                            <p class="logo-sub">HỆ THỐNG XƯỞNG DỊCH VỤ Ô TÔ TOÀN QUỐC (CHUẨN CARPLA)</p>
                            <div style="font-size:11px;color:#64748b;margin-top:4px;">
                                Hotline Kỹ Thuật: 0988.888.999 &bull; Đ/c: Số 18 Cầu Giấy, Q. Cầu Giấy, TP. Hà Nội
                            </div>
                        </td>
                        <td style="text-align:right;vertical-align:top;">
                            <div style="display:inline-block;border:2px solid #000;background:#fef08a;padding:6px 14px;border-radius:4px;font-weight:900;font-size:16px;letter-spacing:1px;">
                                <?php echo esc_html($order->license_plate); ?>
                            </div>
                            <div style="font-size:11px;color:#64748b;margin-top:6px;">
                                Ngày: <?php echo date('d/m/Y H:i', strtotime($order->reception_date)); ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="doc-title">PHIẾU TIẾP NHẬN & LỆNH SỬA CHỮA Ô TÔ (RO)</div>
                <div class="doc-code">Mã Số: <strong><?php echo esc_html($order->order_code); ?></strong> &bull; Khoang Phụ Trách: <?php echo esc_html($order->bay_number); ?></div>

                <div class="info-grid">
                    <div>
                        <div class="info-row"><span class="info-label">Chủ xe / Lái xe:</span> <strong><?php echo esc_html($order->customer_name); ?></strong></div>
                        <div class="info-row"><span class="info-label">Số điện thoại:</span> <?php echo esc_html($order->customer_phone); ?></div>
                        <div class="info-row"><span class="info-label">KTV Trưởng:</span> <?php echo esc_html($order->technician_lead); ?></div>
                    </div>
                    <div>
                        <div class="info-row"><span class="info-label">Dòng xe:</span> <strong><?php echo esc_html($order->car_model); ?></strong></div>
                        <div class="info-row"><span class="info-label">Chỉ số ODO:</span> <?php echo number_format($order->odo); ?> km</div>
                        <div class="info-row"><span class="info-label">Hiện trạng:</span> <?php echo esc_html($order->service_description); ?></div>
                    </div>
                </div>

                <table class="parts-table">
                    <thead>
                        <tr>
                            <th style="width:35px;">STT</th>
                            <th>Nội Dung Chi Tiết Phụ Tùng & Hạng Mục Công Việc</th>
                            <th style="width:70px;text-align:center;">ĐVT</th>
                            <th style="width:50px;text-align:center;">SL</th>
                            <th style="width:110px;text-align:right;">Đơn Giá (đ)</th>
                            <th style="width:120px;text-align:right;">Thành Tiền (đ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stt = 1;
                        foreach ($parts as $p): 
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $stt++; ?></td>
                                <td>
                                    <strong><?php echo esc_html($p['name']); ?></strong>
                                    <?php if (($p['type'] ?? '') === 'labor'): ?>
                                        <span style="font-size:10px;color:#2563eb;font-weight:600;">(Nhân công)</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align:center;"><?php echo esc_html($p['unit'] ?? 'Cái'); ?></td>
                                <td style="text-align:center;"><?php echo esc_html($p['quantity'] ?? 1); ?></td>
                                <td style="text-align:right;"><?php echo number_format($p['price'] ?? 0, 0, ',', '.'); ?></td>
                                <td style="text-align:right;"><strong><?php echo number_format($p['total'] ?? 0, 0, ',', '.'); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="total-box">
                    <div class="total-row"><span>Tiền công thợ:</span> <span><?php echo number_format($order->labor_amount, 0, ',', '.'); ?> đ</span></div>
                    <div class="total-row"><span>Tiền vật tư, phụ tùng:</span> <span><?php echo number_format($order->parts_amount, 0, ',', '.'); ?> đ</span></div>
                    <?php if ($order->discount_amount > 0): ?>
                        <div class="total-row" style="color:#16a34a;"><span>Chiết khấu ưu đãi:</span> <span>-<?php echo number_format($order->discount_amount, 0, ',', '.'); ?> đ</span></div>
                    <?php endif; ?>
                    <div class="total-row grand-total"><span>TỔNG CỘNG:</span> <span><?php echo number_format($order->total_amount, 0, ',', '.'); ?> đ</span></div>
                </div>

                <div class="sign-row">
                    <div>
                        <strong>KHÁCH HÀNG KÝ DUYỆT</strong>
                        <div style="font-size:11px;color:#64748b;">(Đồng ý nội dung báo giá & phụ tùng)</div>
                        <div class="sign-space"></div>
                        <div><?php echo esc_html($order->customer_name); ?></div>
                    </div>
                    <div>
                        <strong>KỸ THUẬT VIÊN TRƯỞNG</strong>
                        <div style="font-size:11px;color:#64748b;">(Cam kết tiêu chuẩn chất lượng KCS)</div>
                        <div class="sign-space"></div>
                        <div><?php echo esc_html($order->technician_lead); ?></div>
                    </div>
                    <div>
                        <strong>GIÁM ĐỐC XƯỞNG DỊCH VỤ</strong>
                        <div style="font-size:11px;color:#64748b;">(Duyệt xuất kho phụ tùng & bàn giao)</div>
                        <div class="sign-space"></div>
                        <div>Hải Hà ÔTô</div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}
