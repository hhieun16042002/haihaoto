<?php
namespace GarageOS\Frontend;

if (!defined('ABSPATH')) {
    exit;
}

class AjaxHandlers {

    public static function init() {
        // Vehicle / Warranty lookup (public & logged in)
        add_action('wp_ajax_garage_lookup_vehicle', [__CLASS__, 'lookup_vehicle']);
        add_action('wp_ajax_nopriv_garage_lookup_vehicle', [__CLASS__, 'lookup_vehicle']);

        // Frontend Booking submit (public & logged in)
        add_action('wp_ajax_garage_submit_booking', [__CLASS__, 'submit_booking']);
        add_action('wp_ajax_nopriv_garage_submit_booking', [__CLASS__, 'submit_booking']);

        // Admin actions
        add_action('wp_ajax_garage_update_order_status', [__CLASS__, 'update_order_status']);
        add_action('wp_ajax_garage_confirm_booking', [__CLASS__, 'confirm_booking']);
    }

    public static function lookup_vehicle() {
        check_ajax_referer('garage_os_frontend_nonce', 'nonce');

        $plate_raw = isset($_POST['license_plate']) ? sanitize_text_field($_POST['license_plate']) : '';
        $plate = strtoupper(trim($plate_raw));

        if (empty($plate)) {
            wp_send_json_error(['message' => 'Vui lòng nhập biển số xe cần tra cứu.']);
        }

        // Clean plate for flexible search (remove dots, dashes, spaces)
        $clean_search = preg_replace('/[^A-Z0-9]/i', '', $plate);

        global $wpdb;
        $table_orders     = $wpdb->prefix . 'garage_work_orders';
        $table_warranties = $wpdb->prefix . 'garage_warranties';

        // Search orders by plate or like
        $orders = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_orders WHERE REPLACE(REPLACE(REPLACE(license_plate, '-', ''), '.', ''), ' ', '') LIKE %s ORDER BY reception_date DESC",
            '%' . $wpdb->esc_like($clean_search) . '%'
        ));

        // Search warranties
        $warranties = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_warranties WHERE REPLACE(REPLACE(REPLACE(license_plate, '-', ''), '.', ''), ' ', '') LIKE %s ORDER BY end_date DESC",
            '%' . $wpdb->esc_like($clean_search) . '%'
        ));

        if (empty($orders) && empty($warranties)) {
            wp_send_json_error([
                'message' => 'Không tìm thấy hồ sơ kỹ thuật cho biển số xe "' . esc_html($plate) . '". Quý khách vui lòng kiểm tra lại biển số hoặc liên hệ hotline 0123 456 789 để được hỗ trợ tra cứu trực tiếp.'
            ]);
        }

        // Get latest vehicle info
        $first_order = !empty($orders) ? $orders[0] : null;
        $first_war   = !empty($warranties) ? $warranties[0] : null;

        $car_model = $first_order ? $first_order->car_model : 'Xe ô tô tiêu chuẩn';
        $owner_name = $first_order ? $first_order->customer_name : ($first_war ? $first_war->customer_name : '');
        $display_plate = $first_order ? $first_order->license_plate : ($first_war ? $first_war->license_plate : $plate);

        // Format orders history
        $history = [];
        foreach ($orders as $o) {
            $parts = json_decode($o->parts_json, true) ?: [];
            $history[] = [
                'order_code'     => $o->order_code,
                'reception_date' => date('d/m/Y', strtotime($o->reception_date)),
                'delivery_date'  => $o->delivery_date ? date('d/m/Y', strtotime($o->delivery_date)) : 'Đang xử lý',
                'odo'            => number_format($o->odo) . ' km',
                'service'        => $o->service_description,
                'parts'          => $parts,
                'lead_tech'      => $o->technician_lead,
                'bay'            => $o->bay_number,
                'work_status'    => $o->work_status,
                'total_amount'   => number_format($o->total_amount, 0, ',', '.') . ' đ',
            ];
        }

        // Format warranties
        $today = current_time('Y-m-d');
        $war_list = [];
        foreach ($warranties as $w) {
            $is_active = ($w->status === 'active' && $w->end_date >= $today);
            $war_list[] = [
                'warranty_code'   => $w->warranty_code,
                'item_name'       => $w->item_name,
                'item_type'       => $w->item_type,
                'duration_months' => $w->duration_months . ' tháng',
                'start_date'      => date('d/m/Y', strtotime($w->start_date)),
                'end_date'        => date('d/m/Y', strtotime($w->end_date)),
                'terms'           => $w->terms,
                'is_active'       => $is_active,
            ];
        }

        wp_send_json_success([
            'vehicle' => [
                'license_plate' => $display_plate,
                'car_model'     => $car_model,
                'owner_name'    => $owner_name,
                'total_visits'  => count($orders),
                'active_warranties_count' => count(array_filter($war_list, function($w) { return $w['is_active']; })),
            ],
            'warranties' => $war_list,
            'history'    => $history,
        ]);
    }

    public static function submit_booking() {
        check_ajax_referer('garage_os_frontend_nonce', 'nonce');

        $name    = sanitize_text_field($_POST['name'] ?? '');
        $phone   = sanitize_text_field($_POST['phone'] ?? '');
        $plate   = strtoupper(trim(sanitize_text_field($_POST['plate'] ?? '')));
        $model   = sanitize_text_field($_POST['model'] ?? '');
        $service = sanitize_text_field($_POST['service'] ?? '');
        $date    = sanitize_text_field($_POST['date'] ?? current_time('Y-m-d'));
        $time    = sanitize_text_field($_POST['time'] ?? '08:30');
        $branch  = sanitize_text_field($_POST['branch'] ?? 'Chi nhánh Cầu Giấy');
        $notes   = sanitize_textarea_field($_POST['notes'] ?? '');

        if (empty($name) || empty($phone) || empty($plate)) {
            wp_send_json_error(['message' => 'Vui lòng điền đủ Tên, Số điện thoại và Biển số xe.']);
        }

        global $wpdb;
        $table_bookings = $wpdb->prefix . 'garage_bookings';
        $booking_code   = 'HG-BK-' . wp_rand(1000, 9999);

        $inserted = $wpdb->insert($table_bookings, [
            'booking_code'      => $booking_code,
            'customer_name'     => $name,
            'customer_phone'    => $phone,
            'license_plate'     => $plate,
            'car_model'         => $model ?: 'Chưa xác định',
            'service_requested' => $service ?: 'Bảo dưỡng / Kiểm tra tổng quát',
            'branch'            => $branch,
            'booking_date'      => $date,
            'booking_time'      => $time,
            'notes'             => $notes,
            'status'            => 'pending',
            'created_at'        => current_time('mysql'),
        ]);

        if ($inserted) {
            wp_send_json_success([
                'message'      => 'Đặt lịch bảo dưỡng thành công! Cố vấn dịch vụ Hải Hà Auto sẽ liên hệ xác nhận trong ít phút.',
                'booking_code' => $booking_code
            ]);
        } else {
            wp_send_json_error(['message' => 'Lỗi lưu thông tin đặt hẹn. Vui lòng thử lại.']);
        }
    }

    public static function update_order_status() {
        check_ajax_referer('garage_os_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Bạn không có quyền thực hiện.']);
        }

        $order_id = intval($_POST['order_id'] ?? 0);
        $status   = sanitize_text_field($_POST['status'] ?? '');

        $valid_statuses = ['receiving', 'quotation', 'in_progress', 'quality_check', 'delivered'];
        if (!in_array($status, $valid_statuses, true) || $order_id <= 0) {
            wp_send_json_error(['message' => 'Dữ liệu không hợp lệ.']);
        }

        global $wpdb;
        $table_orders = $wpdb->prefix . 'garage_work_orders';

        $update_data = [
            'work_status' => $status,
            'updated_at'  => current_time('mysql'),
        ];
        if ($status === 'delivered') {
            $update_data['delivery_date'] = current_time('mysql');
        }

        $updated = $wpdb->update($table_orders, $update_data, ['id' => $order_id]);

        if ($updated !== false) {
            wp_send_json_success(['message' => 'Đã cập nhật trạng thái khoang!']);
        } else {
            wp_send_json_error(['message' => 'Không thể cập nhật cơ sở dữ liệu.']);
        }
    }

    public static function confirm_booking() {
        check_ajax_referer('garage_os_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Bạn không có quyền thực hiện.']);
        }

        $booking_id = intval($_POST['booking_id'] ?? 0);
        if ($booking_id <= 0) {
            wp_send_json_error(['message' => 'Mã lịch hẹn không hợp lệ.']);
        }

        global $wpdb;
        $table_bookings = $wpdb->prefix . 'garage_bookings';
        $table_orders   = $wpdb->prefix . 'garage_work_orders';

        $b = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_bookings WHERE id = %d", $booking_id));
        if (!$b) {
            wp_send_json_error(['message' => 'Không tìm thấy lịch hẹn.']);
        }

        // Update booking status
        $wpdb->update($table_bookings, ['status' => 'confirmed'], ['id' => $booking_id]);

        // Create RO
        $order_code = 'RO-' . date('Y') . '-' . str_pad(wp_rand(100, 9999), 4, '0', STR_PAD_LEFT);
        $wpdb->insert($table_orders, [
            'order_code'          => $order_code,
            'booking_id'          => $booking_id,
            'customer_name'       => $b->customer_name,
            'customer_phone'      => $b->customer_phone,
            'license_plate'       => $b->license_plate,
            'car_model'           => $b->car_model,
            'odo'                 => 0,
            'reception_date'      => current_time('mysql'),
            'technician_lead'     => 'KTV Trưởng Tiếp Nhận',
            'bay_number'          => 'Khoang Tiếp Nhận 01',
            'service_description' => $b->service_requested . ' (Ghi chú khách: ' . $b->notes . ')',
            'parts_json'          => json_encode([], JSON_UNESCAPED_UNICODE),
            'labor_amount'        => 0,
            'parts_amount'        => 0,
            'discount_amount'     => 0,
            'total_amount'        => 0,
            'payment_status'      => 'unpaid',
            'work_status'         => 'receiving',
            'notes'               => 'Tiếp nhận từ lịch hẹn ' . $b->booking_code,
            'created_at'          => current_time('mysql'),
            'updated_at'          => current_time('mysql'),
        ]);

        wp_send_json_success(['message' => 'Đã tiếp nhận lịch hẹn và tạo Lệnh sửa chữa ' . $order_code]);
    }
}
