<?php
/**
 * Import VinFast Accessories into WordPress
 * Run via: docker exec -i garaxe_wordpress php /var/www/html/scripts/import_vinfast_wp.php
 * or from workspace: docker exec -i garaxe_wordpress php wp-content/themes/hieugara-motors/scripts/import_vinfast_wp.php
 */

// Load WordPress
$wp_load = dirname(__DIR__) . '/wordpress/wp-load.php';
if (!file_exists($wp_load)) {
    $wp_load = '/var/www/html/wp-load.php';
}
if (!file_exists($wp_load)) {
    die("Cannot find wp-load.php\n");
}
require_once $wp_load;

echo "=== STARTING VINFAST ACCESSORIES IMPORT ===\n";

$json_file = dirname(__DIR__) . '/data/vinfast-accessories.json';
if (!file_exists($json_file)) {
    $json_file = '/var/www/html/wp-content/themes/hieugara-motors/../../data/vinfast-accessories.json';
}
if (!file_exists($json_file)) {
    // Check fallback path inside container
    $json_file = '/var/www/html/data/vinfast-accessories.json';
}
if (!file_exists($json_file)) {
    // Check relative from current dir
    $json_file = __DIR__ . '/../../data/vinfast-accessories.json';
}

if (!file_exists($json_file)) {
    die("Data file not found: $json_file\n");
}

$data = json_decode(file_get_contents($json_file), true);
if (empty($data)) {
    die("No products found in JSON.\n");
}

echo "Found " . count($data) . " products to import.\n";

// 1. Ensure 'phu-kien-vinfast' term exists in accessory_category
$vf_term = get_term_by('slug', 'phu-kien-vinfast', 'accessory_category');
if (!$vf_term) {
    $insert_term = wp_insert_term(
        'Phụ kiện VinFast',
        'accessory_category',
        array(
            'slug'        => 'phu-kien-vinfast',
            'description' => 'Phụ kiện chính hãng VinFast tại Ô Tô Hải Hà - Đối tác dịch vụ ủy quyền của VinFast'
        )
    );
    if (is_wp_error($insert_term)) {
        die("Error creating term: " . $insert_term->get_error_message() . "\n");
    }
    $vf_term_id = $insert_term['term_id'];
    echo "Created term 'phu-kien-vinfast' (ID: $vf_term_id)\n";
} else {
    $vf_term_id = $vf_term->term_id;
    echo "Existing term 'phu-kien-vinfast' found (ID: $vf_term_id)\n";
}

// Category slug mapping for the 7 Hai Ha groups
$haiha_cat_slugs = array(
    'Màn hình và giải trí' => 'man-hinh-va-giai-tri',
    'Camera'               => 'camera-o-to',
    'An toàn'              => 'an-toan-o-to',
    'Phim và bảo vệ sơn'   => 'phim-va-bao-ve-son',
    'Nội thất'             => 'noi-that-o-to',
    'Ngoại thất và đèn'    => 'ngoai-that-va-den',
    'Tiện ích'             => 'tien-ich-o-to'
);

// Map of slug to term_id
$haiha_term_ids = array();
foreach ($haiha_cat_slugs as $label => $slug) {
    $term = get_term_by('slug', $slug, 'accessory_category');
    if ($term) {
        $haiha_term_ids[$label] = $term->term_id;
    } else {
        $new_term = wp_insert_term($label, 'accessory_category', array('slug' => $slug));
        if (!is_wp_error($new_term)) {
            $haiha_term_ids[$label] = $new_term['term_id'];
        }
    }
}

$imported = 0;
$updated = 0;

foreach ($data as $item) {
    $sku = sanitize_text_field($item['sku']);
    $name = sanitize_text_field($item['name']);
    $slug = sanitize_title($item['slug'] ?: $name);

    // Find existing post by SKU or slug
    $existing = get_posts(array(
        'post_type'      => 'garage_accessory',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'meta_key'       => '_accessory_sku',
        'meta_value'     => $sku
    ));

    $post_data = array(
        'post_title'   => $name,
        'post_name'    => $slug,
        'post_content' => wp_kses_post($item['description_html']),
        'post_excerpt' => sanitize_textarea_field($item['short_description']),
        'post_status'  => 'publish',
        'post_type'    => 'garage_accessory',
    );

    if (!empty($existing)) {
        $post_id = $existing[0]->ID;
        $post_data['ID'] = $post_id;
        wp_update_post($post_data);
        $updated++;
    } else {
        $post_id = wp_insert_post($post_data);
        if (is_wp_error($post_id)) {
            echo "Error inserting post for SKU $sku: " . $post_id->get_error_message() . "\n";
            continue;
        }
        $imported++;
    }

    // Set Meta fields - STRICTLY NO PRICE
    update_post_meta($post_id, '_accessory_sku', $sku);
    update_post_meta($post_id, '_accessory_brand', 'VinFast');
    update_post_meta($post_id, '_accessory_origin', 'Chính hãng VinFast');
    update_post_meta($post_id, '_accessory_badge', 'Đối tác chính hãng');
    update_post_meta($post_id, '_accessory_warranty', 'Chính hãng VinFast');
    update_post_meta($post_id, '_accessory_price', 'Liên hệ'); // NO NUMERICAL PRICE!
    delete_post_meta($post_id, '_accessory_old_price'); // Ensure old price does not exist
    update_post_meta($post_id, '_accessory_is_vinfast', '1');
    update_post_meta($post_id, '_accessory_models', $item['models']);
    update_post_meta($post_id, '_accessory_specs', $item['specifications']);
    update_post_meta($post_id, '_accessory_category_haiha', $item['category_haiha']);

    // Images
    $img_urls = array();
    if (!empty($item['images'])) {
        foreach ($item['images'] as $imgObj) {
            $img_urls[] = $imgObj['url'];
        }
        update_post_meta($post_id, '_accessory_gallery', $img_urls);
        update_post_meta($post_id, '_accessory_img', $img_urls[0]);

        // Attach WordPress featured image if file exists locally
        $rel_path = ltrim($img_urls[0], '/');
        $full_path = ABSPATH . $rel_path;
        if (file_exists($full_path)) {
            $filetype = wp_check_filetype(basename($full_path), null);
            $attachment_title = sanitize_text_field($name . ' – phụ kiện chính hãng VinFast tại Ô Tô Hải Hà');
            
            // Check if attachment already exists
            $att_id = get_post_meta($post_id, '_thumbnail_id', true);
            if (!$att_id || !get_post($att_id)) {
                $attachment = array(
                    'guid'           => home_url('/' . $rel_path),
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => $attachment_title,
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $full_path, $post_id);
                if (!is_wp_error($attach_id)) {
                    set_post_thumbnail($post_id, $attach_id);
                    update_post_meta($attach_id, '_wp_attachment_image_alt', $attachment_title);
                }
            }
        }
    }

    echo "Processed [$sku]: $name\n";

    // Taxonomy assignment
    $terms_to_assign = array($vf_term_id);
    if (!empty($haiha_term_ids[$item['category_haiha']])) {
        $terms_to_assign[] = $haiha_term_ids[$item['category_haiha']];
    }
    wp_set_object_terms($post_id, $terms_to_assign, 'accessory_category', false);
}

echo "=== IMPORT COMPLETE ===\n";
echo "New products inserted: $imported\n";
echo "Existing products updated: $updated\n";
echo "Total processed: " . ($imported + $updated) . "\n";

