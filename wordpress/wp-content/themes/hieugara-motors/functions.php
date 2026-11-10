<?php
/**
 * Hiếu Gara Theme Functions and Definitions
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HIEUGARA_THEME_VERSION', '5.8.6');
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
    $req = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($req === 'tra-cuu-bao-hanh') {
        wp_safe_redirect(home_url('/dich-vu/'), 301);
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

// Default background banner images for 5 Commitments (Trang Về Chúng Tôi)
function hieugara_get_default_commit_bg($index) {
    $gallery_uri = get_template_directory_uri() . '/assets/images/gallery';
    $defaults = array(
        1 => $gallery_uri . '/haiha-gallery-1.jpg',
        2 => $gallery_uri . '/haiha-gallery-4.jpg',
        3 => $gallery_uri . '/haiha-gallery-2.jpg',
        4 => $gallery_uri . '/haiha-gallery-7.jpg',
        5 => $gallery_uri . '/haiha-gallery-5.jpg',
    );
    return isset($defaults[$index]) ? $defaults[$index] : '';
}

// Get active background banner image for commitment card $index
function hieugara_get_commit_bg($index) {
    $custom = get_option('hieugara_commit_bg_' . $index, '');
    if (!empty($custom)) {
        return $custom;
    }
    return hieugara_get_default_commit_bg($index);
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

// 2. Enqueue Assets (Ultra-Fast Optimized & Render-Blocking Free)
function hieugara_enqueue_scripts() {
    // FontAwesome Icons CDN
    wp_enqueue_style(
        'hieugara-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Main Stylesheet with automatic filemtime cache-busting
    $css_version = file_exists(HIEUGARA_THEME_DIR . '/assets/css/theme.css') 
        ? filemtime(HIEUGARA_THEME_DIR . '/assets/css/theme.css') 
        : HIEUGARA_THEME_VERSION;
    wp_enqueue_style(
        'hieugara-main-style',
        HIEUGARA_THEME_URI . '/assets/css/theme.css',
        array(),
        $css_version
    );

    // Main JS with automatic filemtime cache-busting
    $js_version = file_exists(HIEUGARA_THEME_DIR . '/assets/js/theme.js') 
        ? filemtime(HIEUGARA_THEME_DIR . '/assets/js/theme.js') 
        : HIEUGARA_THEME_VERSION;
    wp_enqueue_script(
        'hieugara-main-script',
        HIEUGARA_THEME_URI . '/assets/js/theme.js',
        array('jquery'),
        $js_version,
        true
    );

    // Instant.Page 5.2 (Apple-style instant prefetch on hover / touchstart)
    wp_enqueue_script(
        'hieugara-instantpage',
        HIEUGARA_THEME_URI . '/assets/js/instantpage.js',
        array(),
        '5.2.0',
        true
    );

    // Paint Calculator JS (Conditionally loaded ONLY on Pricing page to save bandwidth & CPU)
    if (is_page('bang-gia')) {
        wp_enqueue_script(
            'hieugara-paint-calc',
            HIEUGARA_THEME_URI . '/assets/js/paint-calculator.js',
            array('jquery'),
            HIEUGARA_THEME_VERSION,
            true
        );
    }

    wp_localize_script('hieugara-main-script', 'hieugara_vars', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('hieugara_ajax_nonce'),
        'site_url'  => site_url(),
        'theme_url' => HIEUGARA_THEME_URI
    ));
}
add_action('wp_enqueue_scripts', 'hieugara_enqueue_scripts');

// 2b. Defer non-critical scripts to eliminate render-blocking delays
function hieugara_defer_scripts($tag, $handle, $src) {
    if (is_admin()) return $tag;
    if (in_array($handle, array('hieugara-main-script', 'hieugara-paint-calc', 'garage-os-frontend-js'))) {
        if (strpos($tag, ' defer') === false) {
            return str_replace(' src=', ' defer src=', $tag);
        }
    }
    return $tag;
}
add_filter('script_loader_tag', 'hieugara_defer_scripts', 10, 3);

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
require_once HIEUGARA_THEME_DIR . '/inc/about-menu-crud.php';
require_once HIEUGARA_THEME_DIR . '/inc/seo-links-crud.php';
require_once HIEUGARA_THEME_DIR . '/inc/category-banner-meta.php';

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

// 5d. Universal Dynamic URL & Media Normalization (Zero Double Ports, Zero Double Slugs)
function hieugara_normalize_local_media_urls($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    $raw_host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? ($_SERVER['HTTP_HOST'] ?? 'localhost:8080');
    $current_host = 'localhost:8080';
    $is_tunnel = false;

    if (preg_match('/^[a-zA-Z0-9.\-]+(?::[0-9]+)?$/', $raw_host)) {
        $host_domain = strtolower(explode(':', $raw_host)[0]);
        if (
            $host_domain === 'localhost' ||
            $host_domain === '127.0.0.1' ||
            str_ends_with($host_domain, 'trycloudflare.com') ||
            str_ends_with($host_domain, 'ngrok-free.app') ||
            $host_domain === 'otohaiha.vn' ||
            str_ends_with($host_domain, '.otohaiha.vn')
        ) {
            if (str_ends_with($host_domain, 'trycloudflare.com') || str_ends_with($host_domain, 'ngrok-free.app')) {
                $current_host = $host_domain; // Public tunnels run on standard HTTPS 443 only
                $is_tunnel = true;
            } else {
                $current_host = $raw_host;
            }
        }
    }
    $is_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) ||
                $is_tunnel;
    $current_origin = ($is_https ? 'https' : 'http') . '://' . $current_host;

    // Single-pass regex replacements (matches entire protocol + host + any port sequence)
    $content = preg_replace('#https?://(?:localhost|127\.0\.0\.1)(?::\d+)*#i', $current_origin, $content);
    $content = preg_replace('#https?://[a-z0-9\-]+\.trycloudflare\.com(?::\d+)*#i', $current_origin, $content);
    $content = preg_replace('#https?://[a-z0-9\-]+\.ngrok-free\.app(?::\d+)*#i', $current_origin, $content);

    // Strict post-replacement sanitation
    if ($is_tunnel) {
        // Tunnels never accept port 8080 or any other custom port
        $content = preg_replace('#(https?://[a-z0-9\-]+\.(?:trycloudflare\.com|ngrok-free\.app))(?::\d+)+#i', '$1', $content);
    } else {
        // Localhost: collapse any duplicate port like :8080:8080 down to single :8080
        $content = preg_replace('/(?::8080){2,}/', ':8080', $content);
    }

    // Clean duplicate page slug anomalies (e.g. /ve-chung-toi/ve-chung-toi/ -> /ve-chung-toi/)
    $content = preg_replace('#(/ve-chung-toi)+/#', '/ve-chung-toi/', $content);
    $content = preg_replace('#(/dich-vu)+/#', '/dich-vu/', $content);
    $content = preg_replace('#(/phu-kien)+/#', '/phu-kien/', $content);
    $content = preg_replace('#(/blog)+/#', '/blog/', $content);

    return $content;
}
add_filter('the_content', 'hieugara_normalize_local_media_urls', 99);
add_filter('post_thumbnail_html', 'hieugara_normalize_local_media_urls', 99);
add_filter('wp_get_attachment_url', 'hieugara_normalize_local_media_urls', 99);
add_filter('wp_calculate_image_srcset', function($sources) {
    if (is_array($sources)) {
        foreach ($sources as &$src) {
            if (isset($src['url'])) {
                $src['url'] = hieugara_normalize_local_media_urls($src['url']);
            }
        }
    }
    return $sources;
}, 99);
add_filter('widget_text', 'hieugara_normalize_local_media_urls', 99);

// 5e. Helper: Sanitize navigation link to prevent duplicate relative slugs
function hieugara_sanitize_nav_url($url) {
    if (empty($url)) return '#';
    $url = trim($url);
    if (preg_match('/^(https?:\/\/|tel:|mailto:|javascript:|#)/i', $url)) {
        // Strip duplicate ports on tunnel domains
        if (strpos($url, 'trycloudflare.com') !== false || strpos($url, 'ngrok-free.app') !== false) {
            $url = preg_replace('#(https?://[a-z0-9\-]+\.(?:trycloudflare\.com|ngrok-free\.app))(?::\d+)+#i', '$1', $url);
        }
        return $url;
    }
    // Relative link without leading slash
    if (strpos($url, '/') !== 0) {
        $url = '/' . $url;
    }
    // Clean any accidental duplicate slugs
    $url = preg_replace('#(/ve-chung-toi)+/#', '/ve-chung-toi/', $url);
    $url = preg_replace('#(/dich-vu)+/#', '/dich-vu/', $url);
    $url = preg_replace('#(/phu-kien)+/#', '/phu-kien/', $url);
    $url = preg_replace('#(/blog)+/#', '/blog/', $url);
    
    return home_url($url);
}

// 5f. Automatic Ultra-Fast Page Cache Flushing on Updates
function hieugara_flush_page_cache() {
    $cache_dir = WP_CONTENT_DIR . '/cache/page-cache';
    if (is_dir($cache_dir)) {
        $files = glob($cache_dir . '/*.html');
        if (!empty($files)) {
            foreach ($files as $f) {
                if (is_file($f)) {
                    @unlink($f);
                }
            }
        }
    }
}
add_action('save_post', 'hieugara_flush_page_cache');
add_action('comment_post', 'hieugara_flush_page_cache');
add_action('wp_update_nav_menu', 'hieugara_flush_page_cache');
add_action('update_option_hieugara_options', 'hieugara_flush_page_cache');
add_action('update_option_hieugara_about_menu_items', 'hieugara_flush_page_cache');
add_action('update_option_hieugara_contact_menu_items', 'hieugara_flush_page_cache');

// 5g. Security Headers & X-Powered-By removal
function hieugara_send_security_headers() {
    if (!headers_sent()) {
        @header_remove('X-Powered-By');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(self), microphone=(), camera=()');
    }
}
add_action('send_headers', 'hieugara_send_security_headers');

// 5h. Prevent Canonical Port 8080 Redirects on Cloudflare Tunnels
function hieugara_fix_tunnel_canonical_redirect($redirect_url, $requested_url) {
    if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'trycloudflare.com') !== false) {
        // Prevent redirecting to port 8080 over external tunnel HTTPS
        if (strpos($redirect_url, ':8080') !== false) {
            return false;
        }
    }
    return $redirect_url;
}
add_filter('redirect_canonical', 'hieugara_fix_tunnel_canonical_redirect', 10, 2);



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
        return 'Xưởng dịch vụ VinFast tại Hải Phòng | Ô Tô Hải Hà';
    }
    return $title;
}
add_filter('pre_get_document_title', 'hieugara_vinfast_seo_title', 999);

// SEO Meta Description & Open Graph for VinFast Service Page
function hieugara_vinfast_seo_meta_tags() {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_uri === 'dich-vu/xe-vinfast') {
        $canonical = home_url('/dich-vu/xe-vinfast/');
        $desc = 'Ô Tô Hải Hà – đối tác dịch vụ VinFast tại KM3+500 Nguyễn Lương Bằng. Phụ tùng chính hãng, bảo dưỡng, sửa chữa, đồng sơn xe VinFast. Hotline: 02203 892 207.';
        $img = get_template_directory_uri() . '/assets/images/about/bien-vinfast-service-haiha.jpg';
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
        echo '<meta property="og:title" content="Xưởng dịch vụ VinFast tại Hải Phòng | Ô Tô Hải Hà">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    }
}
add_action('wp_head', 'hieugara_vinfast_seo_meta_tags', 1);

// =========================================================================
// 10. UNIVERSAL HERO BANNER SYSTEM (Ảnh xưởng Ôtô Hải Hà + Tùy biến Admin)
// =========================================================================

/**
 * Lấy URL ảnh banner theo từng trang cụ thể
 */
function hieugara_get_page_banner_url($page_key = 'default') {
    $banners_dir_uri = get_template_directory_uri() . '/assets/images/banners';
    
    $defaults = array(
        'about'      => $banners_dir_uri . '/banner-ve-chung-toi.jpg',
        'phukien'    => $banners_dir_uri . '/banner-phu-kien.jpg',
        'services'   => $banners_dir_uri . '/banner-dich-vu.jpg',
        'vinfast'    => $banners_dir_uri . '/banner-vinfast.jpg',
        'banggia'    => $banners_dir_uri . '/banner-bang-gia.jpg',
        'datlich'    => $banners_dir_uri . '/banner-dat-lich.jpg',
        'blog'       => $banners_dir_uri . '/banner-blog.jpg',
        'contact'    => $banners_dir_uri . '/banner-lien-he.jpg',
        'default'    => $banners_dir_uri . '/banner-default.jpg',
    );

    $option_name = 'hieugara_banner_' . $page_key;
    $custom_url  = get_option($option_name, '');

    if (!empty($custom_url)) {
        if (function_exists('hieugara_normalize_local_media_urls')) {
            $custom_url = hieugara_normalize_local_media_urls($custom_url);
        }
        return $custom_url;
    }

    $fallback = $defaults[$page_key] ?? $defaults['default'];
    if (function_exists('hieugara_normalize_local_media_urls')) {
        $fallback = hieugara_normalize_local_media_urls($fallback);
    }
    return $fallback;
}

/**
 * Tự động phát hiện trang hiện tại và trả về URL ảnh banner tương ứng
 */
function hieugara_get_current_page_banner() {
    // 1. Cho phép ghi đè bằng Ảnh Đại Diện (Featured Image) của trang/bài viết nếu có
    if (is_singular() && has_post_thumbnail()) {
        $feat = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if (!empty($feat)) {
            if (function_exists('hieugara_normalize_local_media_urls')) {
                $feat = hieugara_normalize_local_media_urls($feat);
            }
            return $feat;
        }
    }

    // 2. Trang Về Chúng Tôi & Đội Ngũ Kỹ Thuật
    if (is_page('ve-chung-toi') || is_page_template('page-ve-chung-toi.php') || is_page('doi-ngu-ky-thuat') || is_page_template('page-doi-ngu-ky-thuat.php')) {
        return hieugara_get_page_banner_url('about');
    }

    // 3. Trang Phụ Kiện Ô Tô
    if (is_page('phu-kien') || is_page_template('page-phu-kien.php')) {
        return hieugara_get_page_banner_url('phukien');
    }

    // 4. Trang Dịch Vụ Xe VinFast
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($request_uri === 'dich-vu/xe-vinfast' || is_page('xe-vinfast') || is_page_template('page-vinfast.php')) {
        return hieugara_get_page_banner_url('vinfast');
    }

    // 5. Trang Dịch Vụ & Danh Mục Dịch Vụ
    if (is_post_type_archive('garage_service') || is_tax('service_category') || is_singular('garage_service')) {
        return hieugara_get_page_banner_url('services');
    }

    // 6. Trang Bảng Giá & Dự Toán
    if (is_page('bang-gia') || is_page_template('page-bang-gia.php')) {
        return hieugara_get_page_banner_url('banggia');
    }

    // 7. Trang Đặt Lịch Tiếp Nhận Xe
    if (is_page('dat-lich') || is_page_template('page-dat-lich.php')) {
        return hieugara_get_page_banner_url('datlich');
    }

    // 7.5. Chuyên mục Blog / Tin tức (Category) - Hỗ trợ banner riêng cho từng danh mục
    if (is_category()) {
        $queried_cat = get_queried_object();
        if ($queried_cat && !empty($queried_cat->term_id)) {
            $cat_custom_banner = get_term_meta($queried_cat->term_id, 'hieugara_category_banner', true);
            if (!empty($cat_custom_banner)) {
                if (function_exists('hieugara_normalize_local_media_urls')) {
                    $cat_custom_banner = hieugara_normalize_local_media_urls($cat_custom_banner);
                }
                return $cat_custom_banner;
            }
        }
        return hieugara_get_page_banner_url('blog');
    }

    // 8. Trang Blog / Tin Tức
    if (is_home() || is_archive() || is_singular('post') || is_page('blog') || is_page_template('page-blog.php')) {
        return hieugara_get_page_banner_url('blog');
    }

    // 9. Trang Liên Hệ & Gara Gần Bạn
    if (is_page('garage-gan-ban') || is_page('lien-he') || is_page_template('page-garage-gan-ban.php') || is_page_template('page-lien-he.php')) {
        return hieugara_get_page_banner_url('contact');
    }

    // 10. Mặc định
    return hieugara_get_page_banner_url('default');
}

// =========================================================================
// 11. VINFAST ACCESSORIES ROUTING, PERMALINKS & SEO
// =========================================================================

// Route /phu-kien/phu-kien-vinfast/ and /phu-kien/phu-kien-vinfast/{slug}/
function hieugara_route_vinfast_accessory_pages() {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    // 1. VinFast Accessories Portal
    if ($request_uri === 'phu-kien/phu-kien-vinfast') {
        global $wp_query;
        $wp_query->is_page = true;
        $wp_query->is_singular = true;
        $wp_query->is_404 = false;
        status_header(200);
        include get_template_directory() . '/page-phu-kien-vinfast.php';
        exit;
    }

    // 2. VinFast Accessory Product Single
    if (preg_match('#^phu-kien/phu-kien-vinfast/([^/]+)$#', $request_uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        $acc_posts = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'garage_accessory',
            'post_status'    => 'publish',
            'posts_per_page' => 1
        ));

        if (!empty($acc_posts)) {
            global $wp_query, $post;
            $post = $acc_posts[0];
            $wp_query->queried_object = $post;
            $wp_query->queried_object_id = $post->ID;
            $wp_query->is_single = true;
            $wp_query->is_singular = true;
            $wp_query->is_404 = false;
            $wp_query->posts = array($post);
            $wp_query->post = $post;
            $wp_query->post_count = 1;
            status_header(200);
            setup_postdata($post);
            include get_template_directory() . '/single-garage_accessory.php';
            exit;
        }
    }
}
add_action('template_redirect', 'hieugara_route_vinfast_accessory_pages', 2);

// Filter Permalinks for VinFast Accessories
function hieugara_vinfast_accessory_post_link($post_link, $post) {
    if (is_object($post) && $post->post_type === 'garage_accessory') {
        $is_vf = get_post_meta($post->ID, '_accessory_is_vinfast', true);
        if ($is_vf === '1') {
            return home_url('/phu-kien/phu-kien-vinfast/' . $post->post_name . '/');
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'hieugara_vinfast_accessory_post_link', 10, 2);

// Document Title for VinFast Accessories
function hieugara_vinfast_accessory_document_title($title) {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    if ($request_uri === 'phu-kien/phu-kien-vinfast') {
        return 'Phụ kiện chính hãng VinFast tại Ô Tô Hải Hà | Đối tác dịch vụ ủy quyền';
    }

    if (preg_match('#^phu-kien/phu-kien-vinfast/([^/]+)$#', $request_uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        $acc_posts = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'garage_accessory',
            'post_status'    => 'publish',
            'posts_per_page' => 1
        ));
        if (!empty($acc_posts)) {
            return esc_html($acc_posts[0]->post_title) . ' chính hãng VinFast | Ô Tô Hải Hà';
        }
    }

    return $title;
}
add_filter('pre_get_document_title', 'hieugara_vinfast_accessory_document_title', 999);

// SEO Meta Description, Canonical & Product Schema (WITHOUT offers or price)
function hieugara_vinfast_accessory_head_meta() {
    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    // Archive portal meta
    if ($request_uri === 'phu-kien/phu-kien-vinfast') {
        $canonical = home_url('/phu-kien/phu-kien-vinfast/');
        $desc = 'Hệ sinh thái phụ kiện ô tô điện chính hãng VinFast tại Ô Tô Hải Hà - Đối tác dịch vụ VinFast ủy quyền tại Hải Phòng. Lắp đặt cắm giắc zin, bảo hành chính hãng.';
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
        echo '<meta property="og:title" content="Phụ kiện chính hãng VinFast tại Ô Tô Hải Hà | Đối tác dịch vụ ủy quyền">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
        return;
    }

    // Single product meta & schema
    if (preg_match('#^phu-kien/phu-kien-vinfast/([^/]+)$#', $request_uri, $matches)) {
        $slug = sanitize_title($matches[1]);
        $acc_posts = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'garage_accessory',
            'post_status'    => 'publish',
            'posts_per_page' => 1
        ));

        if (!empty($acc_posts)) {
            $p = $acc_posts[0];
            $canonical = home_url('/phu-kien/phu-kien-vinfast/' . $slug . '/');
            $raw_desc = get_the_excerpt($p->ID) ?: strip_tags($p->post_content);
            // Clean any price text if any
            $clean_desc = preg_replace('/\b\d{1,3}(?:[.,]\d{3})+(?:\s*(?:vnđ|vnd|đ|₫))?\b/i', '', $raw_desc);
            $clean_desc = wp_trim_words($clean_desc, 25, '...');
            if (mb_strlen($clean_desc) > 155) {
                $clean_desc = mb_substr($clean_desc, 0, 152) . '...';
            }

            $thumb = get_post_meta($p->ID, '_accessory_img', true) ?: get_the_post_thumbnail_url($p->ID, 'full');
            $sku = get_post_meta($p->ID, '_accessory_sku', true);

            echo '<meta name="description" content="' . esc_attr($clean_desc) . '">' . "\n";
            echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr($p->post_title) . ' chính hãng VinFast | Ô Tô Hải Hà">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($clean_desc) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
            if ($thumb) {
                echo '<meta property="og:image" content="' . esc_url($thumb) . '">' . "\n";
            }

            // Schema WITHOUT any offers or price
            $schema = array(
                '@context'    => 'https://schema.org/',
                '@type'       => 'Product',
                'name'        => $p->post_title . ' chính hãng VinFast',
                'description' => $clean_desc,
                'brand'       => array(
                    '@type' => 'Brand',
                    'name'  => 'VinFast'
                )
            );
            if (!empty($sku)) {
                $schema['sku'] = $sku;
                $schema['mpn'] = $sku;
            }
            if ($thumb) {
                $schema['image'] = array(esc_url($thumb));
            }
            echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        }
    }
}
add_action('wp_head', 'hieugara_vinfast_accessory_head_meta', 1);

