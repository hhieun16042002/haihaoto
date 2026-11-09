<?php
/**
 * SEO Information Architecture & Schema Markup for Ôtô Hải Hà
 *
 * Handles:
 * 1. Category Hub URL Rewrites: /dich-vu/[category-slug]/
 * 2. Automatic 301 Redirects from legacy URLs
 * 3. Schema.org JSON-LD (AutomotiveBusiness, Service, BreadcrumbList)
 * 4. Semantic Breadcrumbs Generator
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

class HieuGara_SEO_Architecture {

    // The 7 Canonical Service Hubs
    public static $category_slugs = array(
        'bao-duong-dinh-ky'         => '01. Bảo Dưỡng Định Kỳ',
        'sua-chua-dong-co-hop-so'   => '02. Sửa Chữa Động Cơ & Hộp Số',
        'gam-phanh-lop'             => '03. Gầm, Phanh & Lốp',
        'dien-dieu-hoa-dien-tu'     => '04. Điện, Điều Hòa & Điện Tử',
        'dong-son-than-vo'          => '05. Đồng Sơn & Thân Vỏ',
        'cham-soc-xe-detailing'     => '06. Chăm Sóc Xe & Detailing',
        'cuu-ho-24-7'               => '07. Cứu Hộ Ô Tô 24/7'
    );

    // Mapping legacy slugs to new canonical slugs
    public static $legacy_map = array(
        'bao-duong-o-to'              => 'bao-duong-sua-chua-o-to',
        'sua-chua-o-to'               => 'bao-duong-sua-chua-o-to',
        'dien-o-to-dieu-hoa'          => 'bao-duong-sua-chua-o-to',
        'dong-son-o-to'               => 'son-phuc-hoi-than-vo',
        'cham-soc-nang-cap-o-to'      => 'cham-soc-lam-dep-o-to',
        'cuu-ho-ho-tro-o-to'          => 'cuu-ho-o-to',
        'dong-son-than-vo'            => 'son-phuc-hoi-than-vo',
        'bao-duong-dinh-ky'           => 'bao-duong-sua-chua-o-to',
        'cham-soc-xe-detailing'       => 'cham-soc-lam-dep-o-to',
        'cuu-ho-24-7'                 => 'cuu-ho-o-to',
        'dien-va-dieu-hoa-o-to'       => 'bao-duong-sua-chua-o-to',
        'dong-son-va-ngoai-that-o-to' => 'son-phuc-hoi-than-vo',
        'cham-soc-va-nang-cap-o-to'   => 'cham-soc-lam-dep-o-to',
        'dich-vu-ho-tro-o-to'         => 'cuu-ho-o-to',
        'detailing-cham-soc-xe'       => 'cham-soc-lam-dep-o-to',
        'nang-cap-phu-kien'           => 'cham-soc-lam-dep-o-to',
        'dich-vu-ho-tro-cuu-ho'       => 'cuu-ho-o-to',
        'bao-duong'                   => 'bao-duong-sua-chua-o-to',
        'may-gam'                     => 'bao-duong-sua-chua-o-to',
        'dien-lanh'                   => 'bao-duong-sua-chua-o-to',
        'dong-son'                    => 'son-phuc-hoi-than-vo',
        'detailing'                   => 'cham-soc-lam-dep-o-to',
        'bao-hiem'                    => 'cuu-ho-o-to'
    );

    public static function init() {
        // Rewrite rules
        add_action('init', array(__CLASS__, 'register_rewrite_rules'), 20);

        // Auto-flush rewrite rules when service categories change in Admin
        add_action('created_service_category', array(__CLASS__, 'flush_rules_on_change'));
        add_action('edited_service_category', array(__CLASS__, 'flush_rules_on_change'));
        add_action('delete_service_category', array(__CLASS__, 'flush_rules_on_change'));

        // Template redirect for 301s
        add_action('template_redirect', array(__CLASS__, 'handle_301_redirects'));

        // Query vars
        add_filter('query_vars', array(__CLASS__, 'add_query_vars'));

        // Filter post_type_link for hierarchical URLs: /dich-vu/[cat-slug]/[service-slug]/
        add_filter('post_type_link', array(__CLASS__, 'filter_service_permalink'), 10, 2);

        // Inject Schema JSON-LD into wp_head
        add_action('wp_head', array(__CLASS__, 'output_json_ld_schema'), 5);
    }

    public static function flush_rules_on_change() {
        flush_rewrite_rules(false);
    }

    public static function get_all_category_slugs() {
        $terms = get_terms(array(
            'taxonomy'   => 'service_category',
            'hide_empty' => false,
            'fields'     => 'id=>slug',
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            return array_unique(array_merge(array_keys(self::$category_slugs), array_values($terms)));
        }
        return array_keys(self::$category_slugs);
    }

    public static function register_rewrite_rules() {
        $slugs = self::get_all_category_slugs();
        $slug_pattern = implode('|', array_map('preg_quote', $slugs));

        if (!empty($slug_pattern)) {
            // 1. Category Hub URL: /dich-vu/[category-slug]/
            add_rewrite_rule(
                '^dich-vu/(' . $slug_pattern . ')/?$',
                'index.php?service_category=$matches[1]',
                'top'
            );

            // 2. Pagination for Category Hub: /dich-vu/[category-slug]/page/2/
            add_rewrite_rule(
                '^dich-vu/(' . $slug_pattern . ')/page/([0-9]{1,})/?$',
                'index.php?service_category=$matches[1]&paged=$matches[2]',
                'top'
            );
        }

        // 3. Single Child Service: /dich-vu/[category-slug]/[service-slug]/
        add_rewrite_rule(
            '^dich-vu/([^/]+)/([^/]+)/?$',
            'index.php?garage_service=$matches[2]',
            'top'
        );
    }

    public static function filter_service_permalink($permalink, $post) {
        if (is_object($post) && $post->post_type === 'garage_service') {
            $terms = get_the_terms($post->ID, 'service_category');
            if (!empty($terms) && !is_wp_error($terms)) {
                $main_term = $terms[0];
                return home_url('/dich-vu/' . $main_term->slug . '/' . $post->post_name . '/');
            }
        }
        return $permalink;
    }

    public static function add_query_vars($vars) {
        $vars[] = 'service_category';
        return $vars;
    }

    public static function handle_301_redirects() {
        $uri = trim($_SERVER['REQUEST_URI'] ?? '', '/');
        // Clean query strings
        $path = parse_url($uri, PHP_URL_PATH) ?: $uri;
        $path = trim($path, '/');

        // Check legacy category slug redirect
        if ($path === 'category/he-thong-va-trang-thiet-bi') {
            wp_safe_redirect(home_url('/category/may-moc-trang-thiet-bi/'), 301);
            exit;
        }

        // Check if legacy /chuyen-muc-dich-vu/[slug]/
        if (preg_match('#^chuyen-muc-dich-vu/([^/]+)#', $path, $m)) {
            $old_slug = $m[1];
            $target_slug = self::$legacy_map[$old_slug] ?? (isset(self::$category_slugs[$old_slug]) ? $old_slug : '');
            if ($target_slug) {
                wp_safe_redirect(home_url('/dich-vu/' . $target_slug . '/'), 301);
                exit;
            }
        }

        // Check legacy slugs directly under /dich-vu/[legacy-slug]/
        if (preg_match('#^dich-vu/([^/]+)$#', $path, $m)) {
            $slug = $m[1];
            if (isset(self::$legacy_map[$slug])) {
                wp_safe_redirect(home_url('/dich-vu/' . self::$legacy_map[$slug] . '/'), 301);
                exit;
            }
        }
    }

    /**
     * Semantic Breadcrumb HTML & Schema Generator
     */
    public static function render_breadcrumbs() {
        $items = array();
        $items[] = array('name' => 'Trang chủ', 'url' => home_url('/'));

        if (is_front_page()) {
            return;
        }

        if (is_post_type_archive('garage_service')) {
            $items[] = array('name' => 'Dịch Vụ Ô Tô', 'url' => home_url('/dich-vu/'));
        } elseif (is_tax('service_category')) {
            $term = get_queried_object();
            $items[] = array('name' => 'Dịch Vụ Ô Tô', 'url' => home_url('/dich-vu/'));
            if ($term) {
                $items[] = array('name' => $term->name, 'url' => home_url('/dich-vu/' . $term->slug . '/'));
            }
        } elseif (is_singular('garage_service')) {
            $items[] = array('name' => 'Dịch Vụ Ô Tô', 'url' => home_url('/dich-vu/'));
            $terms = get_the_terms(get_the_ID(), 'service_category');
            if (!empty($terms) && !is_wp_error($terms)) {
                $main_term = $terms[0];
                $canonical_slug = self::$legacy_map[$main_term->slug] ?? $main_term->slug;
                $items[] = array('name' => $main_term->name, 'url' => home_url('/dich-vu/' . $canonical_slug . '/'));
            }
            $items[] = array('name' => get_the_title(), 'url' => get_permalink());
        } elseif (is_page()) {
            $items[] = array('name' => get_the_title(), 'url' => get_permalink());
        }

        if (empty($items)) {
            return;
        }

        echo '<nav class="hieugara-breadcrumb-nav" aria-label="Breadcrumb">';
        echo '<ol class="breadcrumb-list">';
        $last_idx = count($items) - 1;
        foreach ($items as $idx => $it) {
            echo '<li class="breadcrumb-item' . ($idx === $last_idx ? ' current' : '') . '">';
            if ($idx === $last_idx) {
                echo '<span aria-current="page">' . esc_html($it['name']) . '</span>';
            } else {
                echo '<a href="' . esc_url($it['url']) . '">' . esc_html($it['name']) . '</a>';
                echo '<span class="breadcrumb-sep">/</span>';
            }
            echo '</li>';
        }
        echo '</ol>';
        echo '</nav>';
    }

    /**
     * Output Rich JSON-LD Schemas (AutomotiveBusiness, Service, BreadcrumbList)
     */
    public static function output_json_ld_schema() {
        $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
        $hotline_phone = get_option('hieugara_hotline_phone', '0911 211 996');
        $theme_uri     = get_template_directory_uri();
        $logo_url      = $theme_uri . '/assets/images/haiha-logo.png';

        // 1. AutomotiveBusiness (LocalBusiness) on all pages
        $business_schema = array(
            '@context'         => 'https://schema.org',
            '@type'            => 'AutoRepair',
            '@id'              => home_url('/#business'),
            'name'             => 'Ôtô Hải Hà Service & Workshop',
            'alternateName'    => 'Ôtô Hải Hà',
            'url'              => home_url('/'),
            'logo'             => $logo_url,
            'image'            => $theme_uri . '/assets/images/shiftup/center-car.jpg',
            'telephone'        => $hotline_phone,
            'priceRange'       => '$$',
            'foundingDate'     => '1995',
            'address'          => array(
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Km3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn',
                'addressLocality' => 'Hải Dương',
                'addressRegion'   => 'Hải Dương',
                'postalCode'      => '170000',
                'addressCountry'  => 'VN'
            ),
            'geo'              => array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => 20.9818568,
                'longitude' => 106.3090623
            ),
            'openingHoursSpecification' => array(
                array(
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
                    'opens'     => '07:30',
                    'closes'    => '18:30'
                )
            ),
            'sameAs'           => array(
                'https://www.facebook.com/profile.php?id=100069673756551',
                'https://maps.google.com/?cid=15399047910545937753'
            )
        );

        echo "\n<!-- Schema.org AutomotiveBusiness -->\n";
        echo '<script type="application/ld+json">' . json_encode($business_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";

        // 2. BreadcrumbList Schema on subpages
        if (!is_front_page()) {
            $crumbs = array();
            $crumbs[] = array('@type' => 'ListItem', 'position' => 1, 'name' => 'Trang chủ', 'item' => home_url('/'));
            $pos = 2;

            if (is_tax('service_category') || is_singular('garage_service') || is_post_type_archive('garage_service')) {
                $crumbs[] = array('@type' => 'ListItem', 'position' => $pos++, 'name' => 'Dịch Vụ Ô Tô', 'item' => home_url('/dich-vu/'));
            }

            if (is_tax('service_category')) {
                $term = get_queried_object();
                if ($term) {
                    $crumbs[] = array('@type' => 'ListItem', 'position' => $pos++, 'name' => $term->name, 'item' => home_url('/dich-vu/' . $term->slug . '/'));
                }
            } elseif (is_singular('garage_service')) {
                $terms = get_the_terms(get_the_ID(), 'service_category');
                if (!empty($terms) && !is_wp_error($terms)) {
                    $canonical_slug = self::$legacy_map[$terms[0]->slug] ?? $terms[0]->slug;
                    $crumbs[] = array('@type' => 'ListItem', 'position' => $pos++, 'name' => $terms[0]->name, 'item' => home_url('/dich-vu/' . $canonical_slug . '/'));
                }
                $crumbs[] = array('@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title(), 'item' => get_permalink());
            } elseif (is_page()) {
                $crumbs[] = array('@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title(), 'item' => get_permalink());
            }

            $breadcrumb_schema = array(
                '@context'        => 'https://schema.org',
                '@type'           => 'BreadcrumbList',
                'itemListElement' => $crumbs
            );

            echo "<!-- Schema.org BreadcrumbList -->\n";
            echo '<script type="application/ld+json">' . json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
        }

        // 3. Service Schema on single garage_service
        if (is_singular('garage_service')) {
            $price = get_post_meta(get_the_ID(), '_service_price', true) ?: get_post_meta(get_the_ID(), '_garage_price_from', true);
            $service_schema = array(
                '@context'    => 'https://schema.org',
                '@type'       => 'Service',
                '@id'         => get_permalink() . '#service',
                'name'        => get_the_title(),
                'description' => wp_strip_all_tags(get_the_excerpt() ?: get_the_content()),
                'provider'    => array(
                    '@id'   => home_url('/#business'),
                    'name'  => 'Ôtô Hải Hà Service & Workshop'
                ),
                'areaServed'  => array(
                    '@type' => 'State',
                    'name'  => 'Hải Dương & Các tỉnh lân cận'
                ),
                'url'         => get_permalink()
            );

            if (!empty($price) && is_numeric(preg_replace('/[^0-9]/', '', $price))) {
                $service_schema['offers'] = array(
                    '@type'         => 'Offer',
                    'price'         => preg_replace('/[^0-9]/', '', $price),
                    'priceCurrency' => 'VND',
                    'availability'  => 'https://schema.org/InStock',
                    'url'           => get_permalink()
                );
            }

            echo "<!-- Schema.org Service -->\n";
            echo '<script type="application/ld+json">' . json_encode($service_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
        }
    }
}

HieuGara_SEO_Architecture::init();

