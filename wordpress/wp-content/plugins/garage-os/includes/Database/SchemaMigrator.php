<?php
namespace GarageOS\Database;

if (!defined('ABSPATH')) {
    exit;
}

class SchemaMigrator {

    public static function migrate() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // 1. Table Bookings
        $table_bookings = $wpdb->prefix . 'garage_bookings';
        $sql_bookings = "CREATE TABLE $table_bookings (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            booking_code varchar(32) NOT NULL,
            customer_name varchar(120) NOT NULL,
            customer_phone varchar(20) NOT NULL,
            customer_email varchar(100) DEFAULT '',
            license_plate varchar(20) NOT NULL,
            car_model varchar(120) NOT NULL,
            service_requested varchar(200) NOT NULL,
            branch varchar(100) DEFAULT 'Chi nhánh Hà Nội',
            booking_date date NOT NULL,
            booking_time varchar(20) DEFAULT '08:30',
            notes text NULL,
            status varchar(30) DEFAULT 'pending',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY booking_code (booking_code),
            KEY license_plate (license_plate),
            KEY customer_phone (customer_phone),
            KEY status (status)
        ) $charset_collate;";
        dbDelta($sql_bookings);

        // 2. Table Work Orders
        $table_orders = $wpdb->prefix . 'garage_work_orders';
        $sql_orders = "CREATE TABLE $table_orders (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            order_code varchar(32) NOT NULL,
            booking_id bigint(20) unsigned DEFAULT 0,
            customer_name varchar(120) NOT NULL,
            customer_phone varchar(20) NOT NULL,
            license_plate varchar(20) NOT NULL,
            car_model varchar(120) NOT NULL,
            odo int(11) DEFAULT 0,
            reception_date datetime DEFAULT CURRENT_TIMESTAMP,
            delivery_date datetime DEFAULT NULL,
            technician_lead varchar(150) DEFAULT 'KTV Trưởng',
            bay_number varchar(100) DEFAULT 'Khoang 01',
            service_description text NULL,
            parts_json longtext DEFAULT NULL,
            labor_amount bigint(20) DEFAULT 0,
            parts_amount bigint(20) DEFAULT 0,
            discount_amount bigint(20) DEFAULT 0,
            total_amount bigint(20) DEFAULT 0,
            payment_status varchar(30) DEFAULT 'unpaid',
            work_status varchar(30) DEFAULT 'receiving',
            notes text NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY order_code (order_code),
            KEY license_plate (license_plate),
            KEY work_status (work_status),
            KEY payment_status (payment_status)
        ) $charset_collate;";
        dbDelta($sql_orders);

        // 3. Table Warranties
        $table_warranties = $wpdb->prefix . 'garage_warranties';
        $sql_warranties = "CREATE TABLE $table_warranties (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            warranty_code varchar(32) NOT NULL,
            work_order_id bigint(20) unsigned DEFAULT 0,
            license_plate varchar(20) NOT NULL,
            customer_name varchar(120) NOT NULL,
            customer_phone varchar(20) NOT NULL,
            item_type varchar(50) DEFAULT 'paint',
            item_name varchar(255) NOT NULL,
            duration_months int(11) DEFAULT 12,
            start_date date NOT NULL,
            end_date date NOT NULL,
            terms text NULL,
            status varchar(30) DEFAULT 'active',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY warranty_code (warranty_code),
            KEY license_plate (license_plate),
            KEY status (status)
        ) $charset_collate;";
        dbDelta($sql_warranties);

        update_option('garage_os_db_version', '1.0.0');
    }
}
