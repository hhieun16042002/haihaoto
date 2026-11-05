<?php
/**
 * AJAX Handlers for Test Drive & Inquiries
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function lexus_handle_test_drive_submission() {
    check_ajax_referer('lexus_ajax_nonce', 'security');

    $name           = isset($_POST['customer_name']) ? sanitize_text_field($_POST['customer_name']) : '';
    $phone          = isset($_POST['customer_phone']) ? sanitize_text_field($_POST['customer_phone']) : '';
    $email          = isset($_POST['customer_email']) ? sanitize_email($_POST['customer_email']) : '';
    $car_model      = isset($_POST['car_model']) ? sanitize_text_field($_POST['car_model']) : '';
    $preferred_date = isset($_POST['preferred_date']) ? sanitize_text_field($_POST['preferred_date']) : '';
    $dealer_city    = isset($_POST['dealer_city']) ? sanitize_text_field($_POST['dealer_city']) : '';
    $note           = isset($_POST['customer_note']) ? sanitize_textarea_field($_POST['customer_note']) : '';

    if (empty($name) || empty($phone)) {
        wp_send_json_error(array('message' => __('Vui lòng nhập họ tên và số điện thoại của bạn.', 'lexus-motors')));
    }

    // Save submission to WP Options ledger (or send email)
    $submission = array(
        'id'        => uniqid('lexus_td_'),
        'timestamp' => current_time('mysql'),
        'name'      => $name,
        'phone'     => $phone,
        'email'     => $email,
        'car_model' => $car_model,
        'date'      => $preferred_date,
        'dealer'    => $dealer_city,
        'note'      => $note,
    );

    $all_submissions = get_option('lexus_test_drive_leads', array());
    array_unshift($all_submissions, $submission);
    // Keep last 100 leads
    if (count($all_submissions) > 100) {
        $all_submissions = array_slice($all_submissions, 0, 100);
    }
    update_option('lexus_test_drive_leads', $all_submissions);

    // Optional admin notification email
    $admin_email = get_option('admin_email');
    $subject = sprintf('[Lexus Lead] Đăng ký lái thử xe mới từ %s (%s)', $name, $phone);
    $body = "Họ và tên: {$name}\nSố điện thoại: {$phone}\nEmail: {$email}\nDòng xe quan tâm: {$car_model}\nĐại lý / Khu vực: {$dealer_city}\nNgày dự kiến: {$preferred_date}\nGhi chú: {$note}\nThời gian: " . current_time('d/m/Y H:i:s');
    @wp_mail($admin_email, $subject, $body);

    wp_send_json_success(array(
        'message' => __('Cảm ơn quý khách! Chuyên viên tư vấn Lexus sẽ liên hệ trong ít phút để xác nhận lịch lái thử.', 'lexus-motors')
    ));
}
add_action('wp_ajax_lexus_submit_test_drive', 'lexus_handle_test_drive_submission');
add_action('wp_ajax_nopriv_lexus_submit_test_drive', 'lexus_handle_test_drive_submission');

