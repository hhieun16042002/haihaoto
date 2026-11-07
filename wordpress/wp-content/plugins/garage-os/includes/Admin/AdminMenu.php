<?php
namespace GarageOS\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class AdminMenu {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'register_menus']);
    }

    public static function register_menus() {
        // Main Menu: Bookings (Lịch Hẹn)
        add_menu_page(
            'Lịch Hẹn Dịch Vụ Khách Hàng',
            'Lịch Hẹn Dịch Vụ',
            'manage_options',
            'garage-os-bookings',
            [__CLASS__, 'render_bookings'],
            'dashicons-calendar-alt',
            26
        );

        // Submenu: Bookings
        add_submenu_page(
            'garage-os-bookings',
            'Danh Sách Lịch Hẹn Khách Hàng',
            'Lịch Hẹn Khách Hàng',
            'manage_options',
            'garage-os-bookings',
            [__CLASS__, 'render_bookings']
        );

        // Submenu: Work Orders (RO)
        add_submenu_page(
            'garage-os-bookings',
            'Lệnh Sửa Chữa & Báo Giá (RO)',
            'Lệnh Sửa Chữa (RO)',
            'manage_options',
            'garage-os-orders',
            [__CLASS__, 'render_orders']
        );
    }

    public static function render_kanban() {
        // Closed / disabled as requested
        wp_die(__('Chức năng Tiến độ Khoang xe (Kanban) hiện đã được tạm đóng theo yêu cầu quản trị.', 'garage-os'));
    }

    public static function render_orders() {
        WorkOrderManager::render();
    }

    public static function render_bookings() {
        BookingManager::render();
    }

    public static function render_warranties() {
        WarrantyManager::render();
    }
}
