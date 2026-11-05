<?php
/**
 * Register Custom Post Types and Taxonomies for Hiếu Gara
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_register_service_post_type() {
    // 1. Taxonomy: Danh mục dịch vụ
    $cat_labels = array(
        'name'              => _x('Danh mục dịch vụ', 'taxonomy general name', 'hieugara-motors'),
        'singular_name'     => _x('Danh mục dịch vụ', 'taxonomy singular name', 'hieugara-motors'),
        'search_items'      => __('Tìm danh mục', 'hieugara-motors'),
        'all_items'         => __('Tất cả danh mục', 'hieugara-motors'),
        'parent_item'       => __('Danh mục cha', 'hieugara-motors'),
        'parent_item_colon' => __('Danh mục cha:', 'hieugara-motors'),
        'edit_item'         => __('Sửa danh mục', 'hieugara-motors'),
        'update_item'       => __('Cập nhật danh mục', 'hieugara-motors'),
        'add_new_item'      => __('Thêm danh mục mới', 'hieugara-motors'),
        'new_item_name'     => __('Tên danh mục mới', 'hieugara-motors'),
        'menu_name'         => __('Danh mục dịch vụ', 'hieugara-motors'),
    );

    register_taxonomy('service_category', array('garage_service'), array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'chuyen-muc-dich-vu', 'with_front' => false),
    ));

    // 2. Custom Post Type: Dịch vụ Gara (garage_service)
    $service_labels = array(
        'name'                  => _x('Dịch vụ Gara', 'Post type general name', 'hieugara-motors'),
        'singular_name'         => _x('Dịch vụ', 'Post type singular name', 'hieugara-motors'),
        'menu_name'             => _x('Dịch vụ Gara', 'Admin Menu text', 'hieugara-motors'),
        'name_admin_bar'        => _x('Dịch vụ', 'Add New on Toolbar', 'hieugara-motors'),
        'add_new'               => __('Thêm dịch vụ mới', 'hieugara-motors'),
        'add_new_item'          => __('Thêm gói dịch vụ mới', 'hieugara-motors'),
        'new_item'              => __('Dịch vụ mới', 'hieugara-motors'),
        'edit_item'             => __('Sửa dịch vụ', 'hieugara-motors'),
        'view_item'             => __('Xem dịch vụ', 'hieugara-motors'),
        'all_items'             => __('Tất cả dịch vụ', 'hieugara-motors'),
        'search_items'          => __('Tìm kiếm dịch vụ', 'hieugara-motors'),
        'not_found'             => __('Không tìm thấy dịch vụ nào.', 'hieugara-motors'),
        'not_found_in_trash'    => __('Không có dịch vụ trong thùng rác.', 'hieugara-motors'),
        'featured_image'        => __('Ảnh đại diện dịch vụ', 'hieugara-motors'),
        'set_featured_image'    => __('Chọn ảnh dịch vụ', 'hieugara-motors'),
        'remove_featured_image' => __('Xóa ảnh', 'hieugara-motors'),
        'use_featured_image'    => __('Dùng làm ảnh đại diện', 'hieugara-motors'),
    );

    $service_args = array(
        'labels'             => $service_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'dich-vu', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-hammer',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('garage_service', $service_args);
}
add_action('init', 'hieugara_register_service_post_type');

