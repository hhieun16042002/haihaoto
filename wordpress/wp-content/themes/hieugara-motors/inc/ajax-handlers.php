<?php
/**
 * AJAX Handlers for Hải Hà ÔTô Service Booking
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_handle_booking_submission() {
    check_ajax_referer('hieugara_ajax_nonce', 'security');

    $name     = isset($_POST['customer_name']) ? sanitize_text_field($_POST['customer_name']) : '';
    $phone    = isset($_POST['customer_phone']) ? sanitize_text_field($_POST['customer_phone']) : '';
    $car      = isset($_POST['car_model']) ? sanitize_text_field($_POST['car_model']) : '';
    $service  = isset($_POST['service_type']) ? sanitize_text_field($_POST['service_type']) : '';
    $branch   = isset($_POST['branch_location']) ? sanitize_text_field($_POST['branch_location']) : '';
    $date     = isset($_POST['booking_date']) ? sanitize_text_field($_POST['booking_date']) : '';
    $note     = isset($_POST['customer_note']) ? sanitize_textarea_field($_POST['customer_note']) : '';

    if (empty($name) || empty($phone)) {
        wp_send_json_error(array('message' => __('Vui lòng nhập họ tên và số điện thoại liên hệ.', 'hieugara-motors')));
    }

    $lead = array(
        'id'        => uniqid('hieugara_'),
        'timestamp' => current_time('mysql'),
        'name'      => $name,
        'phone'     => $phone,
        'car'       => $car,
        'service'   => $service,
        'branch'    => $branch,
        'date'      => $date,
        'note'      => $note,
    );

    $all_leads = get_option('hieugara_booking_leads', array());
    array_unshift($all_leads, $lead);
    if (count($all_leads) > 100) {
        $all_leads = array_slice($all_leads, 0, 100);
    }
    update_option('hieugara_booking_leads', $all_leads);

    // Sync into Garage OS table if installed
    global $wpdb;
    $garage_bookings_table = $wpdb->prefix . 'garage_bookings';
    if ($wpdb->get_var("SHOW TABLES LIKE '$garage_bookings_table'") === $garage_bookings_table) {
        $wpdb->insert($garage_bookings_table, [
            'booking_code'      => 'HG-BK-' . wp_rand(1000, 9999),
            'customer_name'     => $name,
            'customer_phone'    => $phone,
            'license_plate'     => isset($_POST['license_plate']) ? sanitize_text_field($_POST['license_plate']) : 'CHƯA ĐK',
            'car_model'         => $car ?: 'Chưa xác định',
            'service_requested' => $service ?: 'Bảo dưỡng định kỳ',
            'branch'            => $branch ?: 'Chi nhánh Cầu Giấy',
            'booking_date'      => !empty($date) ? $date : current_time('Y-m-d'),
            'booking_time'      => '08:30',
            'notes'             => $note,
            'status'            => 'pending',
            'created_at'        => current_time('mysql'),
        ]);
    }

    // Send email to admin
    $admin_email = get_option('admin_email');
    $subject = sprintf('[Hải Hà ÔTô] Đặt lịch dịch vụ mới: %s (%s)', $name, $phone);
    $body = "Họ và tên: {$name}\nSố điện thoại: {$phone}\nDòng xe: {$car}\nDịch vụ: {$service}\nChi nhánh: {$branch}\nNgày hẹn: {$date}\nGhi chú: {$note}\nThời gian gửi: " . current_time('d/m/Y H:i:s');
    @wp_mail($admin_email, $subject, $body);

    wp_send_json_success(array(
        'message' => __('Đặt hẹn thành công! Kỹ thuật viên Hải Hà ÔTô sẽ gọi điện xác nhận và chuẩn bị cầu nâng đón xe của Quý khách.', 'hieugara-motors')
    ));
}
add_action('wp_ajax_hieugara_submit_booking', 'hieugara_handle_booking_submission');
add_action('wp_ajax_nopriv_hieugara_submit_booking', 'hieugara_handle_booking_submission');

