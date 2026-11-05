<?php
/**
 * Plugin Name: Garage OS - Hệ Thống Vận Hành Xưởng Ô Tô Toàn Diện
 * Plugin URI:  https://service.hieugara.vn
 * Description: Giải pháp số hóa toàn diện xưởng dịch vụ ô tô chuẩn Carpla: Quản lý Tiếp nhận, Kanban Khoang sửa chữa, Báo giá phụ tùng, Lập lệnh sửa chữa (RO), Sổ bảo hành điện tử & Tra cứu xe theo Biển số.
 * Version:     1.0.0
 * Author:      Hiếu Gara Tech Team
 * Author URI:  https://hieugara.vn
 * Text Domain: garage-os
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('GARAGE_OS_VERSION', '2.0.0');
define('GARAGE_OS_PATH', plugin_dir_path(__FILE__));
define('GARAGE_OS_URL', plugin_dir_url(__FILE__));

// PSR-4 Autoloader for GarageOS namespace
spl_autoload_register(function ($class) {
    $prefix = 'GarageOS\\';
    $base_dir = GARAGE_OS_PATH . 'includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// Activation Hook
register_activation_hook(__FILE__, function () {
    \GarageOS\Database\SchemaMigrator::migrate();
    \GarageOS\Data\SampleDataSeeder::seed();
    flush_rewrite_rules();
});

// Initialize plugin components
add_action('plugins_loaded', function () {
    if (is_admin()) {
        \GarageOS\Admin\AdminMenu::init();
    }
    \GarageOS\Frontend\Shortcodes::init();
    \GarageOS\Frontend\AjaxHandlers::init();
});

// Enqueue Admin Assets
add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos($hook, 'garage-os') !== false) {
        wp_enqueue_style('garage-os-admin-css', GARAGE_OS_URL . 'assets/css/admin-garage-os.css', [], GARAGE_OS_VERSION);
        wp_enqueue_script('garage-os-admin-js', GARAGE_OS_URL . 'assets/js/admin-garage-os.js', ['jquery'], GARAGE_OS_VERSION, true);

        wp_localize_script('garage-os-admin-js', 'garageOsAdmin', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('garage_os_admin_nonce'),
        ]);
    }
});

// Enqueue Frontend Assets
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('garage-os-frontend-css', GARAGE_OS_URL . 'assets/css/frontend-lookup.css', [], GARAGE_OS_VERSION);
    wp_enqueue_script('garage-os-frontend-js', GARAGE_OS_URL . 'assets/js/warranty-lookup.js', ['jquery'], GARAGE_OS_VERSION, true);

    wp_localize_script('garage-os-frontend-js', 'garageOsFrontend', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('garage_os_frontend_nonce'),
    ]);
});
