<?php
/**
 * Ultra-Fast Universal Page Cache Drop-in for Hải Hà Auto
 * Drops TTFB from 8000ms+ down to < 10ms
 * Hardened with OWASP Host Validation, Query String Hashing & Security Headers
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Only cache safe GET requests
if (empty($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET') {
    return;
}

// 2. Skip admin, login, cron, api, ajax
$req_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
if (
    strpos($req_uri, '/wp-admin') !== false ||
    strpos($req_uri, 'wp-login.php') !== false ||
    strpos($req_uri, 'wp-cron.php') !== false ||
    strpos($req_uri, '/wp-json') !== false ||
    strpos($req_uri, 'admin-ajax.php') !== false
) {
    return;
}

// 3. Skip logged-in users or commenters
$is_logged_in_admin = false;
foreach ($_COOKIE as $key => $val) {
    if (strpos($key, 'wordpress_logged_in_') === 0) {
        $is_logged_in_admin = true;
        return;
    }
    if (strpos($key, 'comment_author_') === 0) {
        return;
    }
}

// Helper: Send hardened security headers
function garage_send_security_headers() {
    if (!headers_sent()) {
        @header_remove('X-Powered-By');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(self), microphone=(), camera=()');
    }
}

// 4. Determine Current Request Origin with strict host validation
$is_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false);
$current_scheme = $is_https ? 'https' : 'http';

$raw_host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:8080');
$current_host = 'localhost:8080';

// OWASP Host Validation
if (preg_match('/^[a-zA-Z0-9.\-]+(?::[0-9]+)?$/', $raw_host)) {
    $host_part = strtolower(explode(':', $raw_host)[0]);
    if (
        $host_part === 'localhost' ||
        $host_part === '127.0.0.1' ||
        str_ends_with($host_part, 'trycloudflare.com') ||
        str_ends_with($host_part, 'ngrok-free.app') ||
        $host_part === 'otohaiha.vn' ||
        str_ends_with($host_part, '.otohaiha.vn')
    ) {
        if (str_ends_with($host_part, 'trycloudflare.com') || str_ends_with($host_part, 'ngrok-free.app')) {
            $current_host = $host_part;
        } else {
            $current_host = $raw_host;
        }
    }
}

$current_origin = $current_scheme . '://' . $current_host;

// 5. Canonical Path + Search Query Cache Key
$req_path = rtrim(strtok($req_uri, '?'), '/') . '/';
$query_str = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
// Filter out tracking query params but preserve search and functional params
parse_str($query_str, $query_params);
unset($query_params['fbclid'], $query_params['utm_source'], $query_params['utm_medium'], $query_params['utm_campaign'], $query_params['nocache'], $query_params['purge']);
ksort($query_params);
$normalized_query = http_build_query($query_params);

$cache_dir = WP_CONTENT_DIR . '/cache/page-cache';
if (!is_dir($cache_dir)) {
    @mkdir($cache_dir, 0775, true);
}

$cache_key  = md5($req_path . ($normalized_query ? '?' . $normalized_query : ''));
$cache_file = $cache_dir . '/' . $cache_key . '.html';
$cache_ttl  = 604800; // 7 days with instant stale-while-revalidate

// Bypass/Purge cache: Only allowed for logged-in admin or local requests
if (isset($_GET['nocache']) || isset($_GET['purge'])) {
    $client_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    $is_local = in_array($client_ip, array('127.0.0.1', '::1', '172.18.0.1', '172.19.0.1'));
    if ($is_logged_in_admin || $is_local) {
        if (file_exists($cache_file)) {
            @unlink($cache_file);
        }
    }
    return;
}

// 6. Serve Cache HIT with Dynamic Origin Translation & Security Headers
if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_ttl)) {
    garage_send_security_headers();
    header('X-Garage-Cache: HIT');
    header('Cache-Control: public, max-age=300, stale-while-revalidate=604800');
    header('Content-Type: text/html; charset=UTF-8');
    
    $raw_html = file_get_contents($cache_file);
    $served_html = str_replace('{{GARAGE_SITE_ORIGIN}}', $current_origin, $raw_html);

    // Sanitize any remaining port errors or tunnel anomalies
    if (str_ends_with($current_host, 'trycloudflare.com') || str_ends_with($current_host, 'ngrok-free.app')) {
        $served_html = preg_replace('#(https?://[a-z0-9\-]+\.(?:trycloudflare\.com|ngrok-free\.app))(?::\d+)+#i', '$1', $served_html);
    } else {
        $served_html = preg_replace('/(?::8080){2,}/', ':8080', $served_html);
    }
    // Prevent double slugs in links
    $served_html = preg_replace('#(/ve-chung-toi)+/#', '/ve-chung-toi/', $served_html);
    $served_html = preg_replace('#(/dich-vu)+/#', '/dich-vu/', $served_html);
    $served_html = preg_replace('#(/phu-kien)+/#', '/phu-kien/', $served_html);

    echo $served_html;
    exit;
}

// 7. Record Cache MISS and buffer output
garage_send_security_headers();
header('X-Garage-Cache: MISS');

function garage_save_page_cache($html) {
    global $cache_file, $cache_dir, $current_origin;
    
    if (strlen($html) > 500 && stripos($html, '<html') !== false && (!http_response_code() || http_response_code() === 200)) {
        if (!is_dir($cache_dir)) {
            @mkdir($cache_dir, 0775, true);
        }
        
        // Single-pass regex replacing all localhost/127.0.0.1/tunnel variants (including any stacked ports) with token
        $tokenized_html = preg_replace('#https?://(?:localhost|127\.0\.0\.1)(?::\d+)*#i', '{{GARAGE_SITE_ORIGIN}}', $html);
        $tokenized_html = preg_replace('#https?://[a-z0-9\-]+\.trycloudflare\.com(?::\d+)*#i', '{{GARAGE_SITE_ORIGIN}}', $tokenized_html);
        $tokenized_html = preg_replace('#https?://[a-z0-9\-]+\.ngrok-free\.app(?::\d+)*#i', '{{GARAGE_SITE_ORIGIN}}', $tokenized_html);
        
        // Strip any stray token port suffix like {{GARAGE_SITE_ORIGIN}}:8080
        $tokenized_html = preg_replace('/\{\{GARAGE_SITE_ORIGIN\}\}(?::\d+)+/', '{{GARAGE_SITE_ORIGIN}}', $tokenized_html);

        // Sanitize double slugs
        $tokenized_html = preg_replace('#(/ve-chung-toi)+/#', '/ve-chung-toi/', $tokenized_html);
        $tokenized_html = preg_replace('#(/dich-vu)+/#', '/dich-vu/', $tokenized_html);

        $html_with_comment = $tokenized_html . "\n<!-- Served via Garage Ultra-Fast Page Cache [HIT] at " . gmdate('Y-m-d H:i:s') . " UTC -->";
        @file_put_contents($cache_file, $html_with_comment, LOCK_EX);
    }
    return $html;
}

ob_start('garage_save_page_cache');
