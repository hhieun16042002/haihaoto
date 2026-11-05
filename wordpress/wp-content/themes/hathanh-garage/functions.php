<?php
/**
 * Hà Thành Garage Theme Functions
 *
 * @package HaThanh_Garage
 */

if (!defined('ABSPATH')) {
    exit;
}

define('HATHANH_VERSION', '2.0.0');
define('HATHANH_DIR', get_template_directory());
define('HATHANH_URI', get_template_directory_uri());

function hathanh_setup() {
    load_theme_textdomain('hathanh-garage', HATHANH_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 70,
        'width'       => 260,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'primary' => __('Menu chính (Hà Thành)', 'hathanh-garage'),
        'footer'  => __('Menu Chân trang', 'hathanh-garage'),
    ));

    add_image_size('hathanh-service-thumb', 640, 420, true);
    add_image_size('hathanh-banner', 1600, 700, true);
}
add_action('after_setup_theme', 'hathanh_setup');

function hathanh_enqueue_scripts() {
    // Fonts: Barlow Condensed & Plus Jakarta Sans
    wp_enqueue_style(
        'hathanh-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,700;0,800;0,900;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Font Awesome 6
    wp_enqueue_style(
        'hathanh-fa',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Theme CSS
    wp_enqueue_style(
        'hathanh-style',
        HATHANH_URI . '/assets/css/theme.css',
        array(),
        HATHANH_VERSION
    );

    // Theme JS
    wp_enqueue_script(
        'hathanh-script',
        HATHANH_URI . '/assets/js/theme.js',
        array('jquery'),
        HATHANH_VERSION,
        true
    );

    wp_localize_script('hathanh-script', 'HaThanhAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('hathanh_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'hathanh_enqueue_scripts');

// Register Post Types if not handled by garage-os
function hathanh_register_post_types() {
    if (!post_type_exists('garage_service')) {
        register_post_type('garage_service', array(
            'labels' => array(
                'name'               => __('Dịch Vụ Gara', 'hathanh-garage'),
                'singular_name'      => __('Dịch Vụ', 'hathanh-garage'),
                'add_new'            => __('Thêm dịch vụ mới', 'hathanh-garage'),
                'add_new_item'       => __('Thêm dịch vụ mới', 'hathanh-garage'),
                'edit_item'          => __('Chỉnh sửa dịch vụ', 'hathanh-garage'),
            ),
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => array('slug' => 'dich-vu'),
            'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon'    => 'dashicons-hammer',
            'show_in_rest' => true
        ));
    }
}
add_action('init', 'hathanh_register_post_types');
