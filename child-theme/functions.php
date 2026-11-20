
<?php
/**
 * Twenty Twenty-Five Child Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue parent and child theme stylesheets.
 */
function mcbc_child_enqueue_styles() {
    wp_enqueue_style(
        'twentytwentyfive-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'twentytwentyfive-child-style',
        get_stylesheet_uri(),
        array( 'twentytwentyfive-parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'mcbc_child_enqueue_styles' );
