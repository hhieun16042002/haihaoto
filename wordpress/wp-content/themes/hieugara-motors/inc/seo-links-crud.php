<?php
/**
 * Ôtô Hải Hà - Quản Lý Đường Dẫn & Tùy Biến SEO Toàn Diện (SEO Permalinks & Links Manager)
 * 
 * Tính năng chính:
 * 1. Menu riêng "🔗 Đường Dẫn" tại WP-Admin với giao diện hiện đại, trực quan, full CRUD.
 * 2. Tự động ghi nhận & đồng bộ liên kết khi có bài viết, trang, dịch vụ, phụ kiện, danh mục mới.
 * 3. Nút "Quét & Đồng Bộ Toàn Bộ" tự động thu thập tất cả link hiện có trên website.
 * 4. Tùy biến SEO chuyên sâu cho từng link: SEO Title, Meta Description, Focus Keywords, Canonical, OG Image, Robots.
 * 5. Hỗ trợ chuyển hướng 301/302 Redirect khi đổi URL hoặc tạo alias link.
 * 6. Live Google SERP Preview mô phỏng hiển thị trên kết quả tìm kiếm Google.
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

class HieuGara_SEO_Links_Manager {

    public static $table_name;

    public static function init() {
        global $wpdb;
        self::$table_name = $wpdb->prefix . 'garage_seo_links';

        // 1. Tạo bảng khi khởi chạy
        add_action('init', array(__CLASS__, 'check_and_create_table'));

        // 2. Đăng ký Menu WP-Admin
        add_action('admin_menu', array(__CLASS__, 'register_admin_menu'));

        // 3. Xử lý các thao tác CRUD
        add_action('admin_init', array(__CLASS__, 'handle_crud_actions'));

        // 4. Hook tự động lưu link khi có nội dung mới (Auto-Sync on creation)
        add_action('save_post', array(__CLASS__, 'auto_sync_post_link'), 20, 2);
        add_action('created_term', array(__CLASS__, 'auto_sync_term_link'), 20, 3);
        add_action('edited_term', array(__CLASS__, 'auto_sync_term_link'), 20, 3);

        // 5. Hook Frontend SEO & 301 Redirects
        add_action('template_redirect', array(__CLASS__, 'handle_frontend_redirects'), 1);
        add_action('wp_head', array(__CLASS__, 'inject_frontend_seo_meta'), 1);
        add_filter('pre_get_document_title', array(__CLASS__, 'filter_frontend_title'), 99);
    }

    /**
     * Tạo bảng CSDL lưu trữ đường dẫn & SEO
     */
    public static function check_and_create_table() {
        global $wpdb;
        $table = self::$table_name;

        $installed_ver = get_option('hieugara_seo_links_db_ver', '0');
        if ($installed_ver === '1.0.0') {
            return;
        }

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            url_path varchar(255) NOT NULL,
            title varchar(255) NOT NULL DEFAULT '',
            source_type varchar(50) NOT NULL DEFAULT 'custom',
            object_id bigint(20) unsigned NULL DEFAULT NULL,
            seo_title varchar(255) NULL DEFAULT NULL,
            seo_desc text NULL DEFAULT NULL,
            seo_keywords varchar(255) NULL DEFAULT NULL,
            canonical_url varchar(500) NULL DEFAULT NULL,
            og_image varchar(500) NULL DEFAULT NULL,
            robots varchar(50) NOT NULL DEFAULT 'index,follow',
            redirect_url varchar(500) NULL DEFAULT NULL,
            redirect_code int(4) NOT NULL DEFAULT 0,
            status varchar(20) NOT NULL DEFAULT 'active',
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY url_path (url_path),
            KEY source_type (source_type),
            KEY object_id (object_id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        update_option('hieugara_seo_links_db_ver', '1.0.0');

        // Quét tự động lần đầu nếu bảng trống
        $count = $wpdb->get_var("SELECT COUNT(*) FROM $table");
        if (intval($count) === 0) {
            self::sync_all_existing_links();
        }
    }

    /**
     * Đăng ký Top-Level Menu trong WP-Admin
     */
    public static function register_admin_menu() {
        add_menu_page(
            __('Quản Lý Đường Dẫn & SEO', 'hieugara-motors'),
            __('🔗 Đường Dẫn', 'hieugara-motors'),
            'manage_options',
            'hieugara-seo-links',
            array(__CLASS__, 'render_admin_page'),
            'dashicons-admin-links',
            26
        );
    }

    /**
     * Chuẩn hoá đường dẫn URL thành dạng tương đối (ví dụ: /dich-vu/bao-duong/)
     */
    public static function sanitize_url_path($url) {
        if (empty($url)) return '/';
        $path = parse_url($url, PHP_URL_PATH);
        if (empty($path)) $path = '/';
        if ($path !== '/') {
            $path = '/' . trim($path, '/') . '/';
        }
        return $path;
    }

    /**
     * Tự động thêm / cập nhật đường dẫn khi lưu Post / Page / Service / Accessory
     */
    public static function auto_sync_post_link($post_id, $post) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return;
        if (empty($post) || !in_array($post->post_status, array('publish', 'private'))) return;

        $allowed_types = array('page', 'post', 'garage_service', 'garage_accessory');
        if (!in_array($post->post_type, $allowed_types)) return;

        $permalink = get_permalink($post_id);
        if (!$permalink) return;

        $url_path = self::sanitize_url_path($permalink);
        $title    = !empty($post->post_title) ? $post->post_title : 'Không có tiêu đề #' . $post_id;
        $type     = $post->post_type;

        // Tự động lấy ảnh thumbnail làm OG Image mặc định nếu có
        $og_image = '';
        if (has_post_thumbnail($post_id)) {
            $og_image = get_the_post_thumbnail_url($post_id, 'large');
        }

        global $wpdb;
        $table = self::$table_name;

        $existing = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE (object_id = %d AND source_type = %s) OR url_path = %s LIMIT 1",
            $post_id, $type, $url_path
        ));

        if ($existing) {
            $wpdb->update(
                $table,
                array(
                    'url_path'   => $url_path,
                    'title'      => $title,
                    'updated_at' => current_time('mysql'),
                ),
                array('id' => $existing->id),
                array('%s', '%s', '%s'),
                array('%d')
            );
        } else {
            $default_desc = !empty($post->post_excerpt) ? wp_strip_all_tags($post->post_excerpt) : wp_trim_words(wp_strip_all_tags($post->post_content), 28, '...');
            $wpdb->insert(
                $table,
                array(
                    'url_path'     => $url_path,
                    'title'        => $title,
                    'source_type'  => $type,
                    'object_id'    => $post_id,
                    'seo_title'    => $title . ' | Ôtô Hải Hà Service',
                    'seo_desc'     => $default_desc,
                    'seo_keywords' => 'gara ô tô hải dương, sửa chữa ô tô hải hà, ' . mb_strtolower($title, 'UTF-8'),
                    'og_image'     => $og_image,
                    'robots'       => 'index,follow',
                    'status'       => 'active',
                    'created_at'   => current_time('mysql'),
                    'updated_at'   => current_time('mysql'),
                ),
                array('%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
            );
        }
    }

    /**
     * Tự động thêm / cập nhật khi tạo hoặc sửa danh mục
     */
    public static function auto_sync_term_link($term_id, $tt_id, $taxonomy) {
        $allowed_tax = array('category', 'service_category', 'accessory_category');
        if (!in_array($taxonomy, $allowed_tax)) return;

        $term = get_term($term_id, $taxonomy);
        if (!$term || is_wp_error($term)) return;

        $term_link = get_term_link($term, $taxonomy);
        if (is_wp_error($term_link)) return;

        $url_path = self::sanitize_url_path($term_link);
        $title    = $term->name;

        global $wpdb;
        $table = self::$table_name;

        $existing = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE (object_id = %d AND source_type = %s) OR url_path = %s LIMIT 1",
            $term_id, $taxonomy, $url_path
        ));

        if ($existing) {
            $wpdb->update(
                $table,
                array(
                    'url_path'   => $url_path,
                    'title'      => $title,
                    'updated_at' => current_time('mysql'),
                ),
                array('id' => $existing->id),
                array('%s', '%s', '%s'),
                array('%d')
            );
        } else {
            $wpdb->insert(
                $table,
                array(
                    'url_path'     => $url_path,
                    'title'        => $title,
                    'source_type'  => $taxonomy,
                    'object_id'    => $term_id,
                    'seo_title'    => $title . ' - Chuyên Mục Dịch Vụ | Ôtô Hải Hà',
                    'seo_desc'     => !empty($term->description) ? wp_strip_all_tags($term->description) : 'Danh mục ' . $title . ' tại Trung tâm Dịch vụ Kỹ thuật Ôtô Hải Hà.',
                    'seo_keywords' => mb_strtolower($title, 'UTF-8') . ', dịch vụ ô tô hải dương',
                    'robots'       => 'index,follow',
                    'status'       => 'active',
                    'created_at'   => current_time('mysql'),
                    'updated_at'   => current_time('mysql'),
                ),
                array('%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
            );
        }
    }

    /**
     * Quét và đồng bộ toàn bộ liên kết trên toàn bộ website
     */
    public static function sync_all_existing_links() {
        global $wpdb;
        $table = self::$table_name;
        $count = 0;

        // 1. Trang chủ và các trang cố định
        $static_pages = array(
            '/' => 'Trang Chủ - Ôtô Hải Hà',
            '/blog/' => 'Blog Cẩm Nang & Kỹ Thuật Ô Tô',
            '/phu-kien/' => 'Phụ Kiện & Đồ Chơi Xe Hơi Cao Cấp',
            '/ve-chung-toi/' => 'Về Chúng Tôi - Ôtô Hải Hà',
            '/bang-gia/' => 'Bảng Giá Dịch Vụ Minh Bạch',
            '/vinfast/' => 'VinFast Service Partner Hải Hà',
            '/tra-cuu-bao-hanh/' => 'Tra Cứu Bảo Hành Điện Tử',
            '/chinh-sach-bao-mat/' => 'Chính Sách Bảo Mật & Bảo Vệ Dữ Liệu',
            '/garage-gan-ban/' => 'Hệ Thống Trung Tâm Ôtô Hải Hà',
        );

        foreach ($static_pages as $path => $page_title) {
            $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE url_path = %s", $path));
            if (!$exists) {
                $wpdb->insert(
                    $table,
                    array(
                        'url_path'     => $path,
                        'title'        => $page_title,
                        'source_type'  => 'page',
                        'object_id'    => null,
                        'seo_title'    => $page_title . ' | Dịch Vụ Chuẩn Hãng',
                        'seo_desc'     => 'Trung tâm Bảo dưỡng, Sửa chữa & Chăm sóc xe hơi chuyên nghiệp Ôtô Hải Hà tại Hải Dương.',
                        'seo_keywords' => 'gara ô tô hải dương, bảo dưỡng ô tô, sửa chữa xe hơi',
                        'robots'       => 'index,follow',
                        'status'       => 'active',
                        'created_at'   => current_time('mysql'),
                        'updated_at'   => current_time('mysql'),
                    )
                );
                $count++;
            }
        }

        // 2. Tất cả Posts, Pages, Services, Accessories
        $all_posts = get_posts(array(
            'post_type'      => array('page', 'post', 'garage_service', 'garage_accessory'),
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ));

        foreach ($all_posts as $p) {
            $permalink = get_permalink($p->ID);
            if (!$permalink) continue;

            $path = self::sanitize_url_path($permalink);
            $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE url_path = %s", $path));

            if (!$exists) {
                self::auto_sync_post_link($p->ID, $p);
                $count++;
            }
        }

        // 3. Tất cả Taxonomy Terms
        $taxes = array('category', 'service_category', 'accessory_category');
        foreach ($taxes as $tax) {
            $terms = get_terms(array(
                'taxonomy'   => $tax,
                'hide_empty' => false,
            ));
            if (!is_wp_error($terms) && is_array($terms)) {
                foreach ($terms as $t) {
                    $tlink = get_term_link($t, $tax);
                    if (is_wp_error($tlink)) continue;
                    $path = self::sanitize_url_path($tlink);
                    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE url_path = %s", $path));
                    if (!$exists) {
                        self::auto_sync_term_link($t->term_id, $t->term_taxonomy_id, $tax);
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    /**
     * Xử lý CRUD Actions trong Admin
     */
    public static function handle_crud_actions() {
        if (!isset($_GET['page']) || $_GET['page'] !== 'hieugara-seo-links') {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        global $wpdb;
        $table = self::$table_name;

        // 1. ACTION: ĐỒNG BỘ TOÀN BỘ LIÊN KẾT (Sync All)
        if (isset($_GET['action']) && $_GET['action'] === 'sync_all') {
            check_admin_referer('hieugara_sync_all_nonce');
            $added = self::sync_all_existing_links();
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
            wp_safe_redirect(admin_url('admin.php?page=hieugara-seo-links&msg=synced&count=' . intval($added)));
            exit;
        }

        // 2. ACTION: XÓA LIÊN KẾT (Delete)
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['link_id'])) {
            check_admin_referer('hieugara_del_link_nonce');
            $del_id = intval($_GET['link_id']);
            $wpdb->delete($table, array('id' => $del_id), array('%d'));
            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }
            wp_safe_redirect(admin_url('admin.php?page=hieugara-seo-links&msg=deleted'));
            exit;
        }

        // 3. ACTION: LƯU / CẬP NHẬT LIÊN KẾT (Save / Edit)
        if (isset($_POST['hieugara_save_link_nonce']) && wp_verify_nonce($_POST['hieugara_save_link_nonce'], 'hieugara_save_link_action')) {
            $link_id      = isset($_POST['link_id']) ? intval($_POST['link_id']) : 0;
            $url_path     = self::sanitize_url_path($_POST['url_path'] ?? '');
            $title        = sanitize_text_field($_POST['title'] ?? '');
            $source_type  = sanitize_text_field($_POST['source_type'] ?? 'custom');
            $seo_title    = sanitize_text_field($_POST['seo_title'] ?? '');
            $seo_desc     = sanitize_textarea_field($_POST['seo_desc'] ?? '');
            $seo_keywords = sanitize_text_field($_POST['seo_keywords'] ?? '');
            $canonical_url= esc_url_raw($_POST['canonical_url'] ?? '');
            $og_image     = esc_url_raw($_POST['og_image'] ?? '');
            $robots       = sanitize_text_field($_POST['robots'] ?? 'index,follow');
            $redirect_url = esc_url_raw($_POST['redirect_url'] ?? '');
            $redirect_code= intval($_POST['redirect_code'] ?? 0);
            $status       = sanitize_text_field($_POST['status'] ?? 'active');

            if (empty($url_path) || $url_path === '/') {
                if ($source_type !== 'page' || empty($title)) {
                    $url_path = '/';
                }
            }

            $data = array(
                'url_path'      => $url_path,
                'title'         => $title,
                'source_type'   => $source_type,
                'seo_title'     => $seo_title,
                'seo_desc'      => $seo_desc,
                'seo_keywords'  => $seo_keywords,
                'canonical_url' => $canonical_url,
                'og_image'      => $og_image,
                'robots'        => $robots,
                'redirect_url'  => $redirect_url,
                'redirect_code' => $redirect_code,
                'status'        => $status,
                'updated_at'    => current_time('mysql'),
            );

            if ($link_id > 0) {
                // Update
                $wpdb->update($table, $data, array('id' => $link_id));
                $msg = 'updated';
            } else {
                // Insert New
                $data['created_at'] = current_time('mysql');
                $wpdb->insert($table, $data);
                $msg = 'created';
            }

            if (function_exists('hieugara_purge_page_cache')) {
                hieugara_purge_page_cache();
            }

            wp_safe_redirect(admin_url('admin.php?page=hieugara-seo-links&msg=' . $msg));
            exit;
        }
    }

    /**
     * Frontend 301 / 302 Redirect Handler
     */
    public static function handle_frontend_redirects() {
        if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
            return;
        }

        $current_path = self::sanitize_url_path($_SERVER['REQUEST_URI'] ?? '/');
        global $wpdb;
        $table = self::$table_name;

        $record = $wpdb->get_row($wpdb->prepare(
            "SELECT redirect_url, redirect_code, status FROM $table WHERE url_path = %s AND status = 'active'",
            $current_path
        ));

        if ($record && !empty($record->redirect_url) && in_array(intval($record->redirect_code), array(301, 302))) {
            $target = $record->redirect_url;
            if (strpos($target, 'http') !== 0) {
                $target = home_url($target);
            }
            wp_redirect($target, intval($record->redirect_code));
            exit;
        }
    }

    /**
     * Frontend SEO Meta Tags Injection (wp_head)
     */
    public static function inject_frontend_seo_meta() {
        if (is_admin()) return;

        $current_path = self::sanitize_url_path($_SERVER['REQUEST_URI'] ?? '/');
        global $wpdb;
        $table = self::$table_name;

        $record = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE url_path = %s AND status = 'active'",
            $current_path
        ));

        if (!$record) return;

        echo "\n<!-- Ô Tô Hải Hà - Custom SEO Engine -->\n";

        if (!empty($record->seo_desc)) {
            echo '<meta name="description" content="' . esc_attr($record->seo_desc) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($record->seo_desc) . '">' . "\n";
        }

        if (!empty($record->seo_keywords)) {
            echo '<meta name="keywords" content="' . esc_attr($record->seo_keywords) . '">' . "\n";
        }

        if (!empty($record->robots)) {
            echo '<meta name="robots" content="' . esc_attr($record->robots) . '">' . "\n";
        }

        if (!empty($record->canonical_url)) {
            $canon = $record->canonical_url;
            if (strpos($canon, 'http') !== 0) {
                $canon = home_url($canon);
            }
            echo '<link rel="canonical" href="' . esc_url($canon) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url($canon) . '">' . "\n";
        }

        if (!empty($record->og_image)) {
            $og_img = $record->og_image;
            if (strpos($og_img, 'http') !== 0) {
                $og_img = home_url($og_img);
            }
            echo '<meta property="og:image" content="' . esc_url($og_img) . '">' . "\n";
        }

        if (!empty($record->seo_title)) {
            echo '<meta property="og:title" content="' . esc_attr($record->seo_title) . '">' . "\n";
        }

        echo "<!-- End Ô Tô Hải Hà SEO Engine -->\n\n";
    }

    /**
     * Filter document title if custom SEO title is set
     */
    public static function filter_frontend_title($title) {
        if (is_admin()) return $title;

        $current_path = self::sanitize_url_path($_SERVER['REQUEST_URI'] ?? '/');
        global $wpdb;
        $table = self::$table_name;

        $custom_title = $wpdb->get_var($wpdb->prepare(
            "SELECT seo_title FROM $table WHERE url_path = %s AND status = 'active' AND seo_title IS NOT NULL AND seo_title != ''",
            $current_path
        ));

        if (!empty($custom_title)) {
            return esc_html($custom_title);
        }

        return $title;
    }

    /**
     * Render Admin Dashboard & Full CRUD Page
     */
    public static function render_admin_page() {
        global $wpdb;
        $table = self::$table_name;

        // Current Action / Mode
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'list';
        $edit_id = isset($_GET['link_id']) ? intval($_GET['link_id']) : 0;
        $item_to_edit = null;

        if ($action === 'edit' && $edit_id > 0) {
            $item_to_edit = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $edit_id));
        }

        // Filter & Search Params
        $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
        $type_filter = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';

        // Query Stats
        $total_links = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table");
        $service_links = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE source_type = 'garage_service'");
        $accessory_links = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE source_type = 'garage_accessory'");
        $post_links = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE source_type = 'post'");
        $redirect_links = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE redirect_code > 0");

        // Build list query
        $where = array("1=1");
        $params = array();

        if (!empty($search)) {
            $where[] = "(title LIKE %s OR url_path LIKE %s OR seo_title LIKE %s OR seo_keywords LIKE %s)";
            $wild = '%' . $wpdb->esc_like($search) . '%';
            $params[] = $wild;
            $params[] = $wild;
            $params[] = $wild;
            $params[] = $wild;
        }

        if (!empty($type_filter)) {
            $where[] = "source_type = %s";
            $params[] = $type_filter;
        }

        $where_sql = implode(' AND ', $where);
        $total_items = (int) $wpdb->get_var(
            !empty($params) ? $wpdb->prepare("SELECT COUNT(*) FROM $table WHERE $where_sql", $params) : "SELECT COUNT(*) FROM $table WHERE $where_sql"
        );

        $per_page = 20;
        $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $offset = ($paged - 1) * $per_page;
        $total_pages = ceil($total_items / $per_page);

        $order_sql = "ORDER BY updated_at DESC LIMIT $offset, $per_page";
        $list_query = !empty($params)
            ? $wpdb->prepare("SELECT * FROM $table WHERE $where_sql $order_sql", $params)
            : "SELECT * FROM $table WHERE $where_sql $order_sql";

        $items = $wpdb->get_results($list_query);

        // Include Media Uploader Scripts
        wp_enqueue_media();
        ?>
        <div class="wrap hieugara-seo-links-wrap" style="max-width: 1400px; margin: 20px auto 40px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
            
            <!-- Header Banner -->
            <div style="background: linear-gradient(135deg, #111827 0%, #1f2937 100%); color: #fff; padding: 24px 32px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.12); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h1 style="color: #fff; margin: 0 0 6px 0; font-size: 24px; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                        <span class="dashicons dashicons-admin-links" style="font-size: 28px; width: 28px; height: 28px; color: #D4AF37;"></span>
                        Quản Lý Đường Dẫn &amp; Tùy Biến SEO Toàn Diện
                    </h1>
                    <p style="margin: 0; color: #9ca3af; font-size: 14px;">
                        Tất cả URL của website (Dịch vụ, Phụ kiện, Bài viết, Trang, Danh mục) được gom về một mối để bạn tùy biến chuẩn SEO và tự động đồng bộ khi có link mới.
                    </p>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hieugara-seo-links&action=sync_all'), 'hieugara_sync_all_nonce')); ?>" class="button button-primary" style="background: #D4AF37; border-color: #c59f2d; color: #111; font-weight: 700; padding: 6px 18px; height: auto;" onclick="return confirm('Hệ thống sẽ quét toàn bộ bài viết, trang, dịch vụ, phụ kiện và danh mục để tự động nạp liên kết còn thiếu. Bạn có muốn tiếp tục?');">
                        <span class="dashicons dashicons-update" style="margin-top: 3px;"></span> Quét &amp; Đồng Bộ Toàn Bộ Liên Kết
                    </a>
                    <?php if ($action !== 'add') : ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links&action=add')); ?>" class="button button-secondary" style="font-weight: 700; padding: 6px 16px; height: auto;">
                            <span class="dashicons dashicons-plus-alt2" style="margin-top: 3px;"></span> Thêm Đường Dẫn Mới
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Messages / Alerts -->
            <?php if (isset($_GET['msg'])) : ?>
                <?php if ($_GET['msg'] === 'synced') : ?>
                    <div class="notice notice-success is-dismissible" style="border-left-color: #10b981;">
                        <p><strong> Thành công!</strong> Đã quét và tự động nạp thêm <strong><?php echo intval($_GET['count'] ?? 0); ?></strong> liên kết mới vào hệ thống quản lý.</p>
                    </div>
                <?php elseif ($_GET['msg'] === 'created') : ?>
                    <div class="notice notice-success is-dismissible" style="border-left-color: #10b981;">
                        <p><strong> Đã tạo mới!</strong> Đường dẫn và thông số SEO đã được lưu thành công vào CSDL.</p>
                    </div>
                <?php elseif ($_GET['msg'] === 'updated') : ?>
                    <div class="notice notice-success is-dismissible" style="border-left-color: #10b981;">
                        <p><strong> Đã cập nhật!</strong> Thông số SEO của đường dẫn đã được tối ưu và cập nhật.</p>
                    </div>
                <?php elseif ($_GET['msg'] === 'deleted') : ?>
                    <div class="notice notice-warning is-dismissible">
                        <p><strong> Đã xoá!</strong> Đường dẫn đã được loại bỏ khỏi danh sách quản lý SEO.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Statistics Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
                <div style="background: #fff; padding: 18px 20px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase;">Tổng Liên Kết</div>
                    <div style="font-size: 28px; font-weight: 800; color: #111827; margin-top: 4px;"><?php echo number_format_i18n($total_links); ?></div>
                </div>
                <div style="background: #fff; padding: 18px 20px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase;">Dịch Vụ &amp; Phụ Kiện</div>
                    <div style="font-size: 28px; font-weight: 800; color: #0284c7; margin-top: 4px;"><?php echo number_format_i18n($service_links + $accessory_links); ?></div>
                </div>
                <div style="background: #fff; padding: 18px 20px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase;">Bài Viết Máy Móc/Blog</div>
                    <div style="font-size: 28px; font-weight: 800; color: #10b981; margin-top: 4px;"><?php echo number_format_i18n($post_links); ?></div>
                </div>
                <div style="background: #fff; padding: 18px 20px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase;">Chuyển Hướng 301/302</div>
                    <div style="font-size: 28px; font-weight: 800; color: #f59e0b; margin-top: 4px;"><?php echo number_format_i18n($redirect_links); ?></div>
                </div>
            </div>

            <?php if ($action === 'add' || $action === 'edit') : ?>
                <!-- ==========================================
                     FORM THÊM MỚI / CHỈNH SỬA (CREATE / UPDATE)
                     ========================================== -->
                <div style="background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; padding: 28px 32px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f3f4f6; padding-bottom: 16px; margin-bottom: 24px;">
                        <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: #111827;">
                            <?php echo $action === 'edit' ? '✏️ Chỉnh Sửa Tối Ưu SEO Cho Đường Dẫn' : '➕ Thêm Đường Dẫn / Liên Kết Mới'; ?>
                        </h2>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links')); ?>" class="button">← Quay Lại Danh Sách</a>
                    </div>

                    <form method="post" action="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links')); ?>" id="seoLinkForm">
                        <?php wp_nonce_field('hieugara_save_link_action', 'hieugara_save_link_nonce'); ?>
                        <input type="hidden" name="link_id" value="<?php echo esc_attr($item_to_edit->id ?? 0); ?>">

                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
                            <!-- Cột Trái: Thông số cốt lõi -->
                            <div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 700; margin-bottom: 6px; color: #374151;">
                                        Đường dẫn tương đối (URL Path) <span style="color: #ef4444;">*</span>
                                    </label>
                                    <div style="display: flex; align-items: center;">
                                        <span style="background: #f3f4f6; border: 1px solid #d1d5db; border-right: none; padding: 8px 12px; border-radius: 6px 0 0 6px; color: #6b7280; font-size: 14px; font-family: monospace;">
                                            <?php echo esc_html(home_url()); ?>
                                        </span>
                                        <input type="text" name="url_path" id="url_path" value="<?php echo esc_attr($item_to_edit->url_path ?? '/'); ?>" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 0 6px 6px 0; font-size: 14px; font-family: monospace;" placeholder="/duong-dan-cua-ban/">
                                    </div>
                                    <p style="font-size: 12px; color: #6b7280; margin: 4px 0 0;">Ví dụ: <code>/dich-vu/bao-duong-o-to-dinh-ky/</code> hoặc <code>/khuyen-mai-thang-11/</code></p>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 700; margin-bottom: 6px; color: #374151;">
                                        Tên / Tiêu đề đại diện <span style="color: #ef4444;">*</span>
                                    </label>
                                    <input type="text" name="title" id="title" value="<?php echo esc_attr($item_to_edit->title ?? ''); ?>" required style="width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" placeholder="Ví dụ: Bảo Dưỡng Ô Tô Định Kỳ Hải Hà">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <label style="font-weight: 700; color: #374151;">Tiêu Đề SEO (SEO Title)</label>
                                        <span id="seo_title_count" style="font-size: 12px; color: #6b7280;">0 / 60 ký tự (Khuyên dùng 50-60)</span>
                                    </div>
                                    <input type="text" name="seo_title" id="seo_title" value="<?php echo esc_attr($item_to_edit->seo_title ?? ''); ?>" style="width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" placeholder="Tiêu đề chuẩn SEO xuất hiện trên Google Search...">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <label style="font-weight: 700; color: #374151;">Mô Tả SEO (Meta Description)</label>
                                        <span id="seo_desc_count" style="font-size: 12px; color: #6b7280;">0 / 160 ký tự (Khuyên dùng 140-160)</span>
                                    </div>
                                    <textarea name="seo_desc" id="seo_desc" rows="3" style="width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" placeholder="Đoạn mô tả ngắn gọn, hấp dẫn xuất hiện dưới tiêu đề khi tìm kiếm trên Google..."><?php echo esc_textarea($item_to_edit->seo_desc ?? ''); ?></textarea>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 700; margin-bottom: 6px; color: #374151;">Từ Khóa Mục Tiêu (Focus Keywords)</label>
                                    <input type="text" name="seo_keywords" id="seo_keywords" value="<?php echo esc_attr($item_to_edit->seo_keywords ?? ''); ?>" style="width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;" placeholder="Các từ khóa cách nhau bởi dấu phẩy, ví dụ: bảo dưỡng ô tô, gara hải dương">
                                </div>

                                <!-- SERP PREVIEW BOX (Google Search Simulator) -->
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 20px; margin-top: 24px;">
                                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                                        <span class="dashicons dashicons-search" style="font-size: 16px; width: 16px; height: 16px;"></span> Mô Phỏng Hiển Thị Trên Google (SERP Preview)
                                    </div>
                                    <div style="background: #fff; padding: 16px; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                                        <div style="font-size: 13px; color: #202124; display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                                            <span style="display: inline-block; width: 18px; height: 18px; border-radius: 50%; background: #D4AF37; color: #fff; text-align: center; line-height: 18px; font-size: 10px; font-weight: bold;">H</span>
                                            <span style="font-size: 14px; font-weight: 600; color: #202124;">Ôtô Hải Hà Service</span>
                                            <span style="color: #5f6368; font-size: 12px;" id="serp_url_preview"><?php echo esc_html(home_url($item_to_edit->url_path ?? '/')); ?></span>
                                        </div>
                                        <div id="serp_title_preview" style="font-size: 18px; color: #1a0dab; font-weight: 600; line-height: 1.3; margin-bottom: 4px; cursor: pointer;">
                                            <?php echo esc_html(!empty($item_to_edit->seo_title) ? $item_to_edit->seo_title : ($item_to_edit->title ?? 'Tiêu đề trang web')); ?>
                                        </div>
                                        <div id="serp_desc_preview" style="font-size: 14px; color: #4d5156; line-height: 1.4;">
                                            <?php echo esc_html(!empty($item_to_edit->seo_desc) ? $item_to_edit->seo_desc : 'Đoạn mô tả SEO của liên kết sẽ xuất hiện tại đây khi người dùng tìm kiếm trên Google...'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cột Phải: Phân loại, Canonical, Redirect & Ảnh -->
                            <div>
                                <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                                    <h3 style="margin: 0 0 14px 0; font-size: 15px; font-weight: 700; color: #111827;">Thiết Lập Xuất Bản</h3>
                                    
                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Loại Nguồn (Source Type)</label>
                                        <select name="source_type" style="width: 100%; border-radius: 6px; padding: 6px 10px;">
                                            <option value="custom" <?php selected($item_to_edit->source_type ?? '', 'custom'); ?>>Tùy Chỉnh (Custom Link)</option>
                                            <option value="garage_service" <?php selected($item_to_edit->source_type ?? '', 'garage_service'); ?>>Dịch Vụ (Garage Service)</option>
                                            <option value="garage_accessory" <?php selected($item_to_edit->source_type ?? '', 'garage_accessory'); ?>>Phụ Kiện (Garage Accessory)</option>
                                            <option value="post" <?php selected($item_to_edit->source_type ?? '', 'post'); ?>>Bài Viết / Cẩm Nang</option>
                                            <option value="page" <?php selected($item_to_edit->source_type ?? '', 'page'); ?>>Trang Tĩnh (Page)</option>
                                            <option value="service_category" <?php selected($item_to_edit->source_type ?? '', 'service_category'); ?>>Danh Mục Dịch Vụ</option>
                                            <option value="category" <?php selected($item_to_edit->source_type ?? '', 'category'); ?>>Chuyên Mục Blog</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Trạng Thái</label>
                                        <select name="status" style="width: 100%; border-radius: 6px; padding: 6px 10px;">
                                            <option value="active" <?php selected($item_to_edit->status ?? 'active', 'active'); ?>>Hoạt Động (Active)</option>
                                            <option value="inactive" <?php selected($item_to_edit->status ?? '', 'inactive'); ?>>Tạm Tắt (Inactive)</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Thẻ Meta Robots</label>
                                        <select name="robots" style="width: 100%; border-radius: 6px; padding: 6px 10px;">
                                            <option value="index,follow" <?php selected($item_to_edit->robots ?? 'index,follow', 'index,follow'); ?>>index, follow (Cho phép Google lập chỉ mục)</option>
                                            <option value="noindex,follow" <?php selected($item_to_edit->robots ?? '', 'noindex,follow'); ?>>noindex, follow (Không lập chỉ mục)</option>
                                            <option value="noindex,nofollow" <?php selected($item_to_edit->robots ?? '', 'noindex,nofollow'); ?>>noindex, nofollow (Chặn hoàn toàn)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Canonical URL</label>
                                        <input type="text" name="canonical_url" value="<?php echo esc_attr($item_to_edit->canonical_url ?? ''); ?>" style="width: 100%; border-radius: 6px; font-size: 13px; font-family: monospace;" placeholder="Mặc định để trống (tự nhận URL này)">
                                    </div>
                                </div>

                                <!-- Redirect 301/302 Settings -->
                                <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                                    <h3 style="margin: 0 0 10px 0; font-size: 15px; font-weight: 700; color: #92400e;">Chuyển Hướng (Redirect 301/302)</h3>
                                    <p style="font-size: 12px; color: #78350f; margin: 0 0 12px;">Dùng khi bạn muốn đổi URL cũ sang URL mới mà không làm mất thứ hạng Google.</p>

                                    <div style="margin-bottom: 12px;">
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Mã Chuyển Hướng</label>
                                        <select name="redirect_code" style="width: 100%; border-radius: 6px;">
                                            <option value="0" <?php selected(intval($item_to_edit->redirect_code ?? 0), 0); ?>>Không chuyển hướng (0)</option>
                                            <option value="301" <?php selected(intval($item_to_edit->redirect_code ?? 0), 301); ?>>301 - Chuyển vĩnh viễn (Khuyên dùng cho SEO)</option>
                                            <option value="302" <?php selected(intval($item_to_edit->redirect_code ?? 0), 302); ?>>302 - Chuyển tạm thời</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: 600; margin-bottom: 4px; font-size: 13px;">Đích Đến (Target URL)</label>
                                        <input type="text" name="redirect_url" value="<?php echo esc_attr($item_to_edit->redirect_url ?? ''); ?>" style="width: 100%; border-radius: 6px; font-size: 13px;" placeholder="Ví dụ: /dich-vu-moi/ hoặc https://...">
                                    </div>
                                </div>

                                <!-- Open Graph Image (Ảnh chia sẻ mạng xã hội) -->
                                <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px;">
                                    <h3 style="margin: 0 0 10px 0; font-size: 15px; font-weight: 700; color: #111827;">Ảnh Chia Sẻ (OG:Image)</h3>
                                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 10px;">
                                        <input type="text" name="og_image" id="og_image_input" value="<?php echo esc_attr($item_to_edit->og_image ?? ''); ?>" style="width: 100%; font-size: 13px;" placeholder="https://...">
                                        <button type="button" class="button" id="upload_og_btn">Chọn Ảnh</button>
                                    </div>
                                    <div id="og_image_preview" style="margin-top: 10px; border-radius: 6px; overflow: hidden; max-height: 140px; background: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                                        <?php if (!empty($item_to_edit->og_image)) : ?>
                                            <img src="<?php echo esc_url($item_to_edit->og_image); ?>" style="width: 100%; height: auto; max-height: 140px; object-fit: cover;">
                                        <?php else : ?>
                                            <span style="color: #9ca3af; font-size: 12px; padding: 20px;">Chưa chọn ảnh đại diện SEO</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid #f3f4f6; display: flex; justify-content: flex-end; gap: 12px;">
                            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links')); ?>" class="button button-large">Hủy Bỏ</a>
                            <button type="submit" class="button button-primary button-large" style="background: #D4AF37; border-color: #c59f2d; color: #111; font-weight: 700;">
                                <?php echo $action === 'edit' ? '💾 Lưu Cập Nhật SEO' : '➕ Tạo Mới Đường Dẫn'; ?>
                            </button>
                        </div>
                    </form>
                </div>

                <script>
                jQuery(document).ready(function($) {
                    // Character Counters
                    function updateCounters() {
                        var t = $('#seo_title').val() || '';
                        var d = $('#seo_desc').val() || '';
                        $('#seo_title_count').text(t.length + ' / 60 ký tự');
                        $('#seo_desc_count').text(d.length + ' / 160 ký tự');
                        
                        // Update SERP preview
                        $('#serp_title_preview').text(t || $('#title').val() || 'Tiêu đề trang web');
                        $('#serp_desc_preview').text(d || 'Đoạn mô tả SEO của liên kết sẽ xuất hiện tại đây khi người dùng tìm kiếm trên Google...');
                        var path = $('#url_path').val() || '/';
                        $('#serp_url_preview').text('<?php echo esc_js(home_url()); ?>' + (path.charAt(0) === '/' ? path : '/' + path));
                    }

                    $('#seo_title, #seo_desc, #title, #url_path').on('input', updateCounters);
                    updateCounters();

                    // Media Uploader
                    var mediaUploader;
                    $('#upload_og_btn').click(function(e) {
                        e.preventDefault();
                        if (mediaUploader) {
                            mediaUploader.open();
                            return;
                        }
                        mediaUploader = wp.media({
                            title: 'Chọn Ảnh Đại Diện SEO / Mạng Xã Hội',
                            button: { text: 'Dùng ảnh này' },
                            multiple: false
                        });
                        mediaUploader.on('select', function() {
                            var attachment = mediaUploader.state().get('selection').first().toJSON();
                            $('#og_image_input').val(attachment.url);
                            $('#og_image_preview').html('<img src="' + attachment.url + '" style="width: 100%; height: auto; max-height: 140px; object-fit: cover;">');
                        });
                        mediaUploader.open();
                    });
                });
                </script>

            <?php else : ?>

                <!-- ==========================================
                     BẢNG DANH SÁCH LIÊN KẾT (READ)
                     ========================================== -->
                <div style="background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    
                    <!-- Search & Filter Bar -->
                    <form method="get" action="<?php echo esc_url(admin_url('admin.php')); ?>" style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center; justify-content: space-between;">
                        <input type="hidden" name="page" value="hieugara-seo-links">
                        <div style="display: flex; gap: 10px; align-items: center; flex: 1; max-width: 600px;">
                            <input type="search" name="s" value="<?php echo esc_attr($search); ?>" placeholder="Tìm kiếm theo URL, tiêu đề hoặc từ khóa..." style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #d1d5db; font-size: 14px;">
                            <select name="type" style="padding: 7px 12px; border-radius: 6px; border: 1px solid #d1d5db;">
                                <option value="">Tất Cả Loại Nguồn</option>
                                <option value="garage_service" <?php selected($type_filter, 'garage_service'); ?>>Dịch Vụ</option>
                                <option value="garage_accessory" <?php selected($type_filter, 'garage_accessory'); ?>>Phụ Kiện</option>
                                <option value="post" <?php selected($type_filter, 'post'); ?>>Bài Viết / Cẩm Nang</option>
                                <option value="page" <?php selected($type_filter, 'page'); ?>>Trang Tĩnh</option>
                                <option value="service_category" <?php selected($type_filter, 'service_category'); ?>>Danh Mục Dịch Vụ</option>
                                <option value="custom" <?php selected($type_filter, 'custom'); ?>>Tùy Chỉnh (Custom)</option>
                            </select>
                            <button type="submit" class="button button-primary">Lọc</button>
                            <?php if (!empty($search) || !empty($type_filter)) : ?>
                                <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links')); ?>" class="button">Đặt Lại</a>
                            <?php endif; ?>
                        </div>
                        <div style="color: #6b7280; font-size: 13px;">
                            Hiển thị <strong><?php echo count($items); ?></strong> / <strong><?php echo $total_items; ?></strong> liên kết
                        </div>
                    </form>

                    <!-- Table -->
                    <div style="overflow-x: auto;">
                        <table class="wp-list-table widefat fixed striped table-view-list" style="border: 1px solid #e5e7eb; border-radius: 8px;">
                            <thead>
                                <tr>
                                    <th style="width: 28%;">Tiêu Đề &amp; Loại</th>
                                    <th style="width: 24%;">Đường Dẫn (URL Path)</th>
                                    <th style="width: 28%;">Tối Ưu SEO (Title / Snippet)</th>
                                    <th style="width: 8%; text-align: center;">Chỉ Mục</th>
                                    <th style="width: 12%; text-align: right;">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($items)) : ?>
                                    <?php foreach ($items as $item) : 
                                        $full_url = home_url($item->url_path);
                                        $type_badges = array(
                                            'garage_service'   => array('label' => 'Dịch Vụ', 'bg' => '#e0f2fe', 'color' => '#0369a1'),
                                            'garage_accessory' => array('label' => 'Phụ Kiện', 'bg' => '#fef3c7', 'color' => '#b45309'),
                                            'post'             => array('label' => 'Bài Viết', 'bg' => '#dcfce7', 'color' => '#15803d'),
                                            'page'             => array('label' => 'Trang', 'bg' => '#f3e8ff', 'color' => '#7e22ce'),
                                            'service_category' => array('label' => 'Danh Mục DV', 'bg' => '#e0e7ff', 'color' => '#4338ca'),
                                            'category'         => array('label' => 'Chuyên Mục', 'bg' => '#fae8ff', 'color' => '#a21caf'),
                                            'custom'           => array('label' => 'Tùy Chỉnh', 'bg' => '#f1f5f9', 'color' => '#475569'),
                                        );
                                        $badge = $type_badges[$item->source_type] ?? $type_badges['custom'];
                                    ?>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                                    <span style="background: <?php echo $badge['bg']; ?>; color: <?php echo $badge['color']; ?>; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">
                                                        <?php echo esc_html($badge['label']); ?>
                                                    </span>
                                                    <?php if (intval($item->redirect_code) > 0) : ?>
                                                        <span style="background: #fee2e2; color: #b91c1c; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 4px;">
                                                            301 Chuyển hướng
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <strong style="font-size: 14px; color: #111827;">
                                                    <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links&action=edit&link_id=' . $item->id)); ?>">
                                                        <?php echo esc_html($item->title); ?>
                                                    </a>
                                                </strong>
                                            </td>
                                            <td>
                                                <div style="font-family: monospace; font-size: 13px; color: #1e293b; word-break: break-all;">
                                                    <?php echo esc_html($item->url_path); ?>
                                                </div>
                                                <?php if (intval($item->redirect_code) > 0 && !empty($item->redirect_url)) : ?>
                                                    <div style="font-size: 11px; color: #dc2626; margin-top: 2px;">
                                                        ➔ Chuyển đến: <code><?php echo esc_html($item->redirect_url); ?></code>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div style="font-size: 13px; font-weight: 600; color: #1a0dab; margin-bottom: 2px; line-height: 1.3;">
                                                    <?php echo esc_html(!empty($item->seo_title) ? $item->seo_title : $item->title); ?>
                                                </div>
                                                <div style="font-size: 12px; color: #64748b; line-height: 1.3; max-height: 34px; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php echo esc_html(!empty($item->seo_desc) ? $item->seo_desc : '— Chưa có mô tả SEO —'); ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if (strpos($item->robots, 'noindex') !== false) : ?>
                                                    <span style="color: #ef4444; font-weight: 700; font-size: 12px;">Noindex</span>
                                                <?php else : ?>
                                                    <span style="color: #10b981; font-weight: 700; font-size: 12px;">Index</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">
                                                    <a href="<?php echo esc_url($full_url); ?>" target="_blank" class="button button-small" title="Xem liên kết ngoài frontend">
                                                        <span class="dashicons dashicons-external" style="font-size: 14px; width: 14px; height: 14px; margin-top: 3px;"></span>
                                                    </a>
                                                    <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-seo-links&action=edit&link_id=' . $item->id)); ?>" class="button button-small" style="font-weight: 600;">
                                                        Sửa SEO
                                                    </a>
                                                    <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hieugara-seo-links&action=delete&link_id=' . $item->id), 'hieugara_del_link_nonce')); ?>" class="button button-small" style="color: #ef4444;" onclick="return confirm('Bạn có chắc muốn xóa cấu hình SEO của đường dẫn này?');">
                                                        Xóa
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 36px 20px; color: #6b7280;">
                                            <span class="dashicons dashicons-info" style="font-size: 24px; width: 24px; height: 24px; color: #9ca3af; margin-bottom: 8px;"></span>
                                            <div>Chưa tìm thấy liên kết nào phù hợp với bộ lọc.</div>
                                            <div style="margin-top: 10px;">
                                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hieugara-seo-links&action=sync_all'), 'hieugara_sync_all_nonce')); ?>" class="button button-primary">
                                                    🔄 Quét &amp; Đồng Bộ Toàn Bộ Ngay
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1) : ?>
                        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="font-size: 13px; color: #6b7280;">
                                Trang <strong><?php echo $paged; ?></strong> / <strong><?php echo $total_pages; ?></strong>
                            </div>
                            <div style="display: flex; gap: 4px;">
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <a href="<?php echo esc_url(add_query_arg(array('paged' => $i, 's' => $search, 'type' => $type_filter), admin_url('admin.php?page=hieugara-seo-links'))); ?>" class="button <?php echo $i === $paged ? 'button-primary' : ''; ?>" style="min-width: 32px; text-align: center;">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>
        <?php
    }
}

// Khởi chạy hệ thống Quản lý Đường dẫn & SEO
HieuGara_SEO_Links_Manager::init();
