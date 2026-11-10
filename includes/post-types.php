<?php
/**
 * Register Branch Custom Post Type.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Branch post type.
 */
function mcbc_register_branch_post_type() {

    $labels = array(
        'name'               => 'Branches',
        'singular_name'      => 'Branch',
        'menu_name'          => 'Branches',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Branch',
        'edit_item'          => 'Edit Branch',
        'new_item'           => 'New Branch',
        'view_item'          => 'View Branch',
        'search_items'       => 'Search Branches',
        'not_found'          => 'No branches found',
        'not_found_in_trash' => 'No branches found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'branches' ),
    );

    register_post_type( 'clinic_branch', $args );
}
add_action( 'init', 'mcbc_register_branch_post_type' );


/**
 * Register Doctor post type.
 */
function mcbc_register_doctor_post_type() {

    $labels = array(
        'name'               => 'Doctors',
        'singular_name'      => 'Doctor',
        'menu_name'          => 'Doctors',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Doctor',
        'edit_item'          => 'Edit Doctor',
        'new_item'           => 'New Doctor',
        'view_item'          => 'View Doctor',
        'search_items'       => 'Search Doctors',
        'not_found'          => 'No doctors found',
        'not_found_in_trash' => 'No doctors found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'doctors' ),
    );

    register_post_type( 'clinic_doctor', $args );
}
add_action( 'init', 'mcbc_register_doctor_post_type' );
