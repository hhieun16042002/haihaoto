<?php
/**
 * Hiếu Gara Theme Functions and Definitions
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HIEUGARA_THEME_VERSION', '1.0.0');
define('HIEUGARA_THEME_DIR', get_template_directory());
define('HIEUGARA_THEME_URI', get_template_directory_uri());

// 1. Theme Setup
function hieugara_theme_setup() {
    load_theme_textdomain('hieugara-motors', HIEUGARA_THEME_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'primary' => __('Menu chính (Hiếu Gara)', 'hieugara-motors'),
        'footer'  => __('Menu Chân trang', 'hieugara-motors'),
    ));

    add_image_size('garage-service-thumb', 600, 400, true);
    add_image_size('garage-banner', 1400, 600, true);
}
add_action('after_setup_theme', 'hieugara_theme_setup');

// 2. Enqueue Assets
function hieugara_enqueue_scripts() {
    // Google Fonts (Montserrat & Plus Jakarta Sans)
    wp_enqueue_style(
        'hieugara-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // FontAwesome Icons CDN
    wp_enqueue_style(
        'hieugara-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Main Stylesheet
    wp_enqueue_style(
        'hieugara-main-style',
        HIEUGARA_THEME_URI . '/assets/css/theme.css',
        array(),
        HIEUGARA_THEME_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'hieugara-main-script',
        HIEUGARA_THEME_URI . '/assets/js/theme.js',
        array('jquery'),
        HIEUGARA_THEME_VERSION,
        true
    );

    // Paint Calculator JS
    wp_enqueue_script(
        'hieugara-paint-calc',
        HIEUGARA_THEME_URI . '/assets/js/paint-calculator.js',
        array('jquery'),
        HIEUGARA_THEME_VERSION,
        true
    );

    wp_localize_script('hieugara-main-script', 'hieugara_vars', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('hieugara_ajax_nonce'),
        'site_url'  => site_url(),
        'theme_url' => HIEUGARA_THEME_URI
    ));
}
add_action('wp_enqueue_scripts', 'hieugara_enqueue_scripts');

// 3. Module Includes
require_once HIEUGARA_THEME_DIR . '/inc/post-types.php';
require_once HIEUGARA_THEME_DIR . '/inc/meta-boxes.php';
require_once HIEUGARA_THEME_DIR . '/inc/ajax-handlers.php';
require_once HIEUGARA_THEME_DIR . '/inc/sample-services.php';

// 4. Helper Functions
function hieugara_get_service_features($post_id) {
    $raw = get_post_meta($post_id, '_garage_features', true);
    if (empty($raw)) {
        return array();
    }
    return array_filter(array_map('trim', explode("\n", str_replace("\r", "", $raw))));
}

