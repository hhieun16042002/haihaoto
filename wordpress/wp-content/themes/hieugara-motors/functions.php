<?php
/**
 * Hiếu Gara Theme Functions and Definitions
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HIEUGARA_THEME_VERSION', '5.7.8');
define('HIEUGARA_THEME_DIR', get_template_directory());
define('HIEUGARA_THEME_URI', get_template_directory_uri());

// 0. Turbo Performance: Enable gzip output compression for all HTML documents (shrinks HTML from ~140KB to ~22KB)
if (!ini_get('zlib.output_compression') && !headers_sent()) {
    @ini_set('zlib.output_compression', 'On');
    @ini_set('zlib.output_compression_level', '5');
}

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

// Block REST API User Enumeration (/wp-json/wp/v2/users) for unauthenticated visitors
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        $endpoints['/wp/v2/users'][0]['permission_callback'] = function() {
            return current_user_can('list_users');
        };
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        $endpoints['/wp/v2/users/(?P<id>[\d]+)'][0]['permission_callback'] = function() {
            return current_user_can('list_users');
        };
    }
    return $endpoints;
});

// Block author enumeration via /?author=1 and author archives
add_action('init', function() {
    if (!is_admin() && isset($_GET['author'])) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
});
add_action('template_redirect', function() {
    if (is_author() && !is_admin()) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
    if (is_page('tra-cuu-bao-hanh')) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
});

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
    return get_option('hieugara_hotline_phone', '0911 211 996');
}
function hieugara_tech_phone() {
    return get_option('hieugara_tech_phone', '0911 211 996');
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
require_once HIEUGARA_THEME_DIR . '/inc/brand-manager.php';
require_once HIEUGARA_THEME_DIR . '/inc/theme-settings.php';
require_once HIEUGARA_THEME_DIR . '/inc/admin-customizer.php';
require_once HIEUGARA_THEME_DIR . '/inc/seo-architecture.php';
require_once HIEUGARA_THEME_DIR . '/inc/prestige-service-content.php';
require_once HIEUGARA_THEME_DIR . '/inc/media-hub.php';
require_once HIEUGARA_THEME_DIR . '/inc/sample-accessories.php';

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
add_action('updated_option', 'hieugara_purge_page_cache');

// 5b. Auto-create 'phu-kien' page if not exists
function hieugara_ensure_phu_kien_page() {
    if (!get_option('hieugara_phu_kien_page_init_v2')) {
        $existing = get_page_by_path('phu-kien');
        if (!$existing) {
            wp_insert_post(array(
                'post_title'     => 'Phụ Kiện Ô Tô Chính Hãng',
                'post_name'      => 'phu-kien',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'page_template'  => 'page-phu-kien.php',
                'comment_status' => 'closed',
            ));
        }
        update_option('hieugara_phu_kien_page_init_v2', 1);
        hieugara_purge_page_cache();
    }
}
add_action('init', 'hieugara_ensure_phu_kien_page');

// 5c. Initialize & Seed Accessories System (Saved directly into WordPress)
function hieugara_init_accessories_system() {
    if (!get_option('hieugara_accessories_seeded_v1')) {
        if (function_exists('hieugara_seed_accessories_posts')) {
            hieugara_seed_accessories_posts();
        }
        flush_rewrite_rules(false);
        update_option('hieugara_accessories_seeded_v1', 1);
        hieugara_purge_page_cache();
    }
}
add_action('init', 'hieugara_init_accessories_system', 20);

// 5d. Universal Dynamic Image URL Translation (Localhost + Tunnel + Public Domain)
function hieugara_normalize_local_media_urls($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    $current_host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? ($_SERVER['HTTP_HOST'] ?? 'localhost:8080');
    $is_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $current_origin = ($is_https ? 'https' : 'http') . '://' . $current_host;

    $patterns = array(
        'http://localhost:8080',
        'http://127.0.0.1:8080',
        'https://localhost:8080',
    );
    $content = str_replace($patterns, $current_origin, $content);
    $content = preg_replace('/https?:\/\/[a-z0-9\-]+\.trycloudflare\.com/i', $current_origin, $content);

    return $content;
}
add_filter('the_content', 'hieugara_normalize_local_media_urls', 99);
add_filter('post_thumbnail_html', 'hieugara_normalize_local_media_urls', 99);
add_filter('wp_get_attachment_url', 'hieugara_normalize_local_media_urls', 99);

// 6. SEO Search Optimization: Include Services, Accessories, Posts & Pages in Frontend Search
function hieugara_seo_search_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('garage_service', 'garage_accessory', 'post', 'page'));
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'hieugara_seo_search_query');

// 7. Route /dich-vu/xe-vinfast/ directly to page-vinfast.php
function hieugara_route_vinfast_service_page() {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_uri === 'dich-vu/xe-vinfast') {
        global $wp_query;
        $wp_query->is_page = true;
        $wp_query->is_singular = true;
        $wp_query->is_404 = false;
        status_header(200);
        include get_template_directory() . '/page-vinfast.php';
        exit;
    }
}
add_action('template_redirect', 'hieugara_route_vinfast_service_page', 1);

// SEO Document Title for VinFast Service Page
function hieugara_vinfast_seo_title($title) {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_uri === 'dich-vu/xe-vinfast') {
        return 'Trung tâm tiếp nhận bảo dưỡng & sửa chữa VinFast tại Hải Phòng | Ô Tô Hải Hà';
    }
    return $title;
}
add_filter('pre_get_document_title', 'hieugara_vinfast_seo_title', 999);

// SEO Meta Description & Open Graph for VinFast Service Page
function hieugara_vinfast_seo_meta_tags() {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_uri === 'dich-vu/xe-vinfast') {
        $canonical = home_url('/dich-vu/xe-vinfast/');
        $desc = 'Ô Tô Hải Hà – Trung tâm tiếp nhận bảo dưỡng & sửa chữa hợp tác với VinFast tại Hải Phòng. Phụ tùng chính hãng, bảo dưỡng, sửa chữa, đồng sơn xe VinFast. Đặt lịch ngay.';
        $img = get_template_directory_uri() . '/assets/images/about/haiha-about-workshop.jpg';
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
        echo '<meta property="og:title" content="Trung tâm tiếp nhận bảo dưỡng & sửa chữa VinFast tại Hải Phòng | Ô Tô Hải Hà">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    }
}
add_action('wp_head', 'hieugara_vinfast_seo_meta_tags', 1);




