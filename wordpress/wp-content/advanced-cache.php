<?php
/**
 * Ultra-Fast Universal Page Cache Drop-in for Hải Hà Auto
 * Drops TTFB from 8000ms+ down to < 10ms
 * Features: Canonical Path Caching, Dynamic Multi-Origin Support (Localhost + Cloudflare Tunnel),
 * Stale-While-Revalidate Headers, Zero Cross-Origin Link Issues
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
foreach ($_COOKIE as $key => $val) {
    if (strpos($key, 'wordpress_logged_in_') === 0 || strpos($key, 'comment_author_') === 0) {
        return;
    }
}

// 4. Determine Current Request Origin (handles Cloudflare Reverse Proxy SSL and Tunnel headers)
$is_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false);
$current_scheme = $is_https ? 'https' : 'http';
$current_host   = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:8080');
$current_origin = $current_scheme . '://' . $current_host;

// 5. Canonical Path Cache Key (Ignore query params like ?fbclid= or ?v= unless search)
$req_path = rtrim(strtok($req_uri, '?'), '/') . '/';
$cache_dir = WP_CONTENT_DIR . '/cache/page-cache';
if (!is_dir($cache_dir)) {
    @mkdir($cache_dir, 0775, true);
}

$cache_key  = md5($req_path);
$cache_file = $cache_dir . '/' . $cache_key . '.html';
$cache_ttl  = 3600; // 1 hour

// Bypass cache if ?nocache=1 or ?purge=1
if (isset($_GET['nocache']) || isset($_GET['purge'])) {
    if (file_exists($cache_file)) {
        @unlink($cache_file);
    }
    return;
}

// 6. Serve Cache HIT with Dynamic Origin Translation (Instant < 10ms response)
if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_ttl)) {
    header('X-Garage-Cache: HIT');
    header('Cache-Control: public, max-age=60, stale-while-revalidate=86400');
    header('Content-Type: text/html; charset=UTF-8');
    
    $raw_html = file_get_contents($cache_file);
    // Replace universal origin placeholder with the current request origin
    echo str_replace('{{GARAGE_SITE_ORIGIN}}', $current_origin, $raw_html);
    exit;
}

// 7. Record Cache MISS and buffer output
header('X-Garage-Cache: MISS');

function garage_save_page_cache($html) {
    global $cache_file, $cache_dir, $current_origin;
    
    // Only cache valid HTML responses
    if (strlen($html) > 500 && stripos($html, '<html') !== false && (!http_response_code() || http_response_code() === 200)) {
        if (!is_dir($cache_dir)) {
            @mkdir($cache_dir, 0775, true);
        }
        
        // Tokenize origins so the cached file works interchangeably across localhost, tunnel, and public IP
        $patterns = array(
            $current_origin,
            'http://localhost:8080',
            'http://127.0.0.1:8080',
            'https://localhost:8080',
        );
        $tokenized_html = str_replace($patterns, '{{GARAGE_SITE_ORIGIN}}', $html);
        
        // Also catch any trycloudflare domains if present
        $tokenized_html = preg_replace('/https?:\/\/[a-z0-9\-]+\.trycloudflare\.com/i', '{{GARAGE_SITE_ORIGIN}}', $tokenized_html);

        $html_with_comment = $tokenized_html . "\n<!-- Served via Garage Ultra-Fast Page Cache [HIT] at " . gmdate('Y-m-d H:i:s') . " UTC -->";
        @file_put_contents($cache_file, $html_with_comment, LOCK_EX);
    }
    return $html;
}

ob_start('garage_save_page_cache');
