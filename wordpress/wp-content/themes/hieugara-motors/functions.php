<?php
/**
 * Hiếu Gara Theme Functions and Definitions
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HIEUGARA_THEME_VERSION', '5.2.0');
define('HIEUGARA_THEME_DIR', get_template_directory());
define('HIEUGARA_THEME_URI', get_template_directory_uri());

// 0. Performance: Remove WordPress bloat from <head>
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Prevent PHP notices/warnings from leaking into front-end HTML layout
if (!is_admin() && !defined('DOING_CRON')) {
    @ini_set('display_errors', 0);
    // Prevent WordPress background update checks from stalling frontend page loads
    add_filter('pre_site_transient_update_core', '__return_null');
    add_filter('pre_site_transient_update_plugins', '__return_null');
    add_filter('pre_site_transient_update_themes', '__return_null');
}

// Global Theme Contact & Option Helpers
add_action('init', function() {
    if (get_option('blogname') !== 'Ôtô Hải Hà Service') {
        update_option('blogname', 'Ôtô Hải Hà Service');
    }
});
function hieugara_rescue_phone() {
    return get_option('hieugara_rescue_phone', '0911 211 996');
}
function hieugara_hotline_phone() {
    return get_option('hieugara_hotline_phone', '02203 892 207');
}
function hieugara_tech_phone() {
    return get_option('hieugara_tech_phone', '0915 041 989');
}
function hieugara_warranty_url() {
    return get_option('hieugara_warranty_url', home_url('/tra-cuu-bao-hanh/'));
}

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
    // FontAwesome Icons CDN
    wp_enqueue_style(
        'hieugara-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Swiper Carousel CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.1.14'
    );

    // Main Stylesheet with automatic filemtime cache-busting
    $css_version = file_exists(HIEUGARA_THEME_DIR . '/assets/css/theme.css') 
        ? filemtime(HIEUGARA_THEME_DIR . '/assets/css/theme.css') 
        : HIEUGARA_THEME_VERSION;
    wp_enqueue_style(
        'hieugara-main-style',
        HIEUGARA_THEME_URI . '/assets/css/theme.css',
        array('swiper-css'),
        $css_version
    );

    // Swiper Carousel JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.1.14',
        true
    );

    // Main JS with automatic filemtime cache-busting
    $js_version = file_exists(HIEUGARA_THEME_DIR . '/assets/js/theme.js') 
        ? filemtime(HIEUGARA_THEME_DIR . '/assets/js/theme.js') 
        : HIEUGARA_THEME_VERSION;
    wp_enqueue_script(
        'hieugara-main-script',
        HIEUGARA_THEME_URI . '/assets/js/theme.js',
        array('jquery', 'swiper-js'),
        $js_version,
        true
    );

    // Instant Speculative Preloader (0ms Page Transitions)
    wp_enqueue_script(
        'hieugara-instantpage',
        HIEUGARA_THEME_URI . '/assets/js/instantpage.js',
        array(),
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
require_once HIEUGARA_THEME_DIR . '/inc/theme-settings.php';
require_once HIEUGARA_THEME_DIR . '/inc/admin-customizer.php';
require_once HIEUGARA_THEME_DIR . '/inc/seo-architecture.php';
require_once HIEUGARA_THEME_DIR . '/inc/prestige-service-content.php';

// 4. Helper Functions
function hieugara_get_service_features($post_id) {
    $raw = get_post_meta($post_id, '_garage_features', true);
    if (empty($raw)) {
        return array();
    }
    return array_filter(array_map('trim', explode("\n", str_replace("\r", "", $raw))));
}

// 5. Automatic Page Cache Invalidation on Save
function hieugara_purge_page_cache() {
    $cache_dir = WP_CONTENT_DIR . '/cache/page-cache';
    if (is_dir($cache_dir)) {
        $files = glob($cache_dir . '/*');
        if ($files) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }
    }
}
add_action('save_post', 'hieugara_purge_page_cache');
add_action('after_switch_theme', 'hieugara_purge_page_cache');


