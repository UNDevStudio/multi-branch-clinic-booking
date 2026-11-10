<?php
/**
 * Plugin Name: Multi-Branch Clinic Booking
 * Description: A clinic booking platform with Branch and Doctor management.
 * Version: 1.0.0
 * Author: UNDevStudio
 * Text Domain: multi-branch-clinic-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load custom post type registrations.
require_once plugin_dir_path( __FILE__ ) . 'includes/post-types.php';

// Load custom field registrations.
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-fields.php';

// Load demo seed data functionality.
require_once plugin_dir_path( __FILE__ ) . 'includes/seed-data.php';