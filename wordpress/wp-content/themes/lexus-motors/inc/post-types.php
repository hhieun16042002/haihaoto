<?php
/**
 * Register Custom Post Types and Taxonomies for Lexus Motors Theme
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function lexus_register_vehicle_post_type() {
    // 1. Taxonomy: Phân khúc xe (vehicle_segment)
    $segment_labels = array(
        'name'              => _x('Phân khúc xe', 'taxonomy general name', 'lexus-motors'),
        'singular_name'     => _x('Phân khúc', 'taxonomy singular name', 'lexus-motors'),
        'search_items'      => __('Tìm phân khúc', 'lexus-motors'),
        'all_items'         => __('Tất cả phân khúc', 'lexus-motors'),
        'parent_item'       => __('Phân khúc cha', 'lexus-motors'),
        'parent_item_colon' => __('Phân khúc cha:', 'lexus-motors'),
        'edit_item'         => __('Sửa phân khúc', 'lexus-motors'),
        'update_item'       => __('Cập nhật phân khúc', 'lexus-motors'),
        'add_new_item'      => __('Thêm phân khúc mới', 'lexus-motors'),
        'new_item_name'     => __('Tên phân khúc mới', 'lexus-motors'),
        'menu_name'         => __('Phân khúc xe', 'lexus-motors'),
    );

    register_taxonomy('vehicle_segment', array('lexus_vehicle'), array(
        'hierarchical'      => true,
        'labels'            => $segment_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'phan-khuc', 'with_front' => false),
    ));

    // 2. Custom Post Type: Dòng xe (lexus_vehicle)
    $vehicle_labels = array(
        'name'                  => _x('Dòng xe Lexus', 'Post type general name', 'lexus-motors'),
        'singular_name'         => _x('Dòng xe', 'Post type singular name', 'lexus-motors'),
        'menu_name'             => _x('Dòng xe Lexus', 'Admin Menu text', 'lexus-motors'),
        'name_admin_bar'        => _x('Dòng xe', 'Add New on Toolbar', 'lexus-motors'),
        'add_new'               => __('Thêm xe mới', 'lexus-motors'),
        'add_new_item'          => __('Thêm dòng xe mới', 'lexus-motors'),
        'new_item'              => __('Xe mới', 'lexus-motors'),
        'edit_item'             => __('Sửa dòng xe', 'lexus-motors'),
        'view_item'             => __('Xem dòng xe', 'lexus-motors'),
        'all_items'             => __('Tất cả dòng xe', 'lexus-motors'),
        'search_items'          => __('Tìm kiếm dòng xe', 'lexus-motors'),
        'not_found'             => __('Không tìm thấy xe nào.', 'lexus-motors'),
        'not_found_in_trash'    => __('Không có xe trong thùng rác.', 'lexus-motors'),
        'featured_image'        => __('Ảnh đại diện xe (Góc nghiêng 3/4)', 'lexus-motors'),
        'set_featured_image'    => __('Chọn ảnh đại diện xe', 'lexus-motors'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'lexus-motors'),
        'use_featured_image'    => __('Dùng làm ảnh đại diện', 'lexus-motors'),
    );

    $vehicle_args = array(
        'labels'             => $vehicle_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'dong-xe', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-car',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('lexus_vehicle', $vehicle_args);
}
add_action('init', 'lexus_register_vehicle_post_type');

