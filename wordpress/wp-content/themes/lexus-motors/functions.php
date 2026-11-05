<?php
/**
 * Lexus Motors Theme Functions and Definitions
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

define('LEXUS_THEME_VERSION', '1.0.0');
define('LEXUS_THEME_DIR', get_template_directory());
define('LEXUS_THEME_URI', get_template_directory_uri());

// 1. Theme Setup
function lexus_theme_setup() {
    load_theme_textdomain('lexus-motors', LEXUS_THEME_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Menu chính (Lexus Header)', 'lexus-motors'),
        'footer'  => __('Menu Chân trang', 'lexus-motors'),
    ));

    // Custom Image Sizes
    add_image_size('lexus-car-thumb', 600, 380, true);
    add_image_size('lexus-car-hero', 1400, 800, false);
}
add_action('after_setup_theme', 'lexus_theme_setup');

// 2. Enqueue Scripts & Styles
function lexus_enqueue_scripts() {
    // Google Fonts (Cinzel + Plus Jakarta Sans)
    wp_enqueue_style(
        'lexus-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Theme Main CSS
    wp_enqueue_style(
        'lexus-theme-style',
        LEXUS_THEME_URI . '/assets/css/theme.css',
        array(),
        LEXUS_THEME_VERSION
    );

    // Theme Core JavaScript
    wp_enqueue_script(
        'lexus-theme-script',
        LEXUS_THEME_URI . '/assets/js/theme.js',
        array('jquery'),
        LEXUS_THEME_VERSION,
        true
    );

    // Car Cost Calculator Script
    wp_enqueue_script(
        'lexus-calculator-script',
        LEXUS_THEME_URI . '/assets/js/calculator.js',
        array('jquery'),
        LEXUS_THEME_VERSION,
        true
    );

    // Localize data for AJAX
    wp_localize_script('lexus-theme-script', 'lexus_vars', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('lexus_ajax_nonce'),
        'site_url'   => site_url(),
        'theme_url'  => LEXUS_THEME_URI
    ));
}
add_action('wp_enqueue_scripts', 'lexus_enqueue_scripts');

// 3. Include Core Modules
require_once LEXUS_THEME_DIR . '/inc/post-types.php';
require_once LEXUS_THEME_DIR . '/inc/meta-boxes.php';
require_once LEXUS_THEME_DIR . '/inc/ajax-handlers.php';
require_once LEXUS_THEME_DIR . '/inc/sample-data.php';

// 4. Helper Functions
function lexus_format_price($price) {
    if (empty($price) || !is_numeric($price)) {
        return __('Liên hệ', 'lexus-motors');
    }
    return number_format($price, 0, ',', '.') . ' VNĐ';
}

function lexus_get_vehicle_colors($post_id) {
    $raw = get_post_meta($post_id, '_lexus_colors_data', true);
    if (empty($raw)) {
        return array();
    }

    $lines = explode("\n", str_replace("\r", "", $raw));
    $colors = array();

    foreach ($lines as $line) {
        $parts = array_map('trim', explode('|', $line));
        if (count($parts) >= 3) {
            $colors[] = array(
                'name'  => $parts[0],
                'hex'   => $parts[1],
                'image' => $parts[2]
            );
        }
    }

    return $colors;
}

function lexus_get_vehicle_specs($post_id) {
    return array(
        'price'        => get_post_meta($post_id, '_lexus_price', true),
        'badge'        => get_post_meta($post_id, '_lexus_badge', true),
        'tagline'      => get_post_meta($post_id, '_lexus_tagline', true),
        'engine'       => get_post_meta($post_id, '_lexus_engine', true),
        'horsepower'   => get_post_meta($post_id, '_lexus_horsepower', true),
        'torque'       => get_post_meta($post_id, '_lexus_torque', true),
        'acceleration' => get_post_meta($post_id, '_lexus_acceleration', true),
        'transmission' => get_post_meta($post_id, '_lexus_transmission', true),
        'fuel'         => get_post_meta($post_id, '_lexus_fuel_economy', true),
        'brochure'     => get_post_meta($post_id, '_lexus_brochure_url', true),
    );
}

