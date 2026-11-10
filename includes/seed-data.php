<?php
/**
 * Seed demo data for HealthFirst Clinics.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display the seed data button in WordPress admin.
 */
function mcbc_seed_data_admin_notice() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( get_option( 'mcbc_seed_data_completed' ) ) {
        return;
    }

    $seed_url = wp_nonce_url(
        admin_url( 'admin-post.php?action=mcbc_seed_demo_data' ),
        'mcbc_seed_demo_data'
    );

    echo '<div class="notice notice-info">';
    echo '<p><strong>HealthFirst Demo Data:</strong> ';
    echo 'Create 9 branches and 27 doctors.</p>';
    echo '<p><a class="button button-primary" href="' . esc_url( $seed_url ) . '">Generate Demo Data</a></p>';
    echo '</div>';
}
add_action( 'admin_notices', 'mcbc_seed_data_admin_notice' );

/**
 * Generate demo branches and doctors.
 */
function mcbc_seed_demo_data() {

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You are not allowed to perform this action.' );
    }

    check_admin_referer( 'mcbc_seed_demo_data' );

    if ( get_option( 'mcbc_seed_data_completed' ) ) {
        wp_die( 'Demo data has already been generated.' );
    }

    $branches = array(
        array(
            'name' => 'HealthFirst Main Branch',
            'address' => 'Main Boulevard, Multan',
            'phone' => '061-111-100001',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Ahmed Khan', 'specialty' => 'Cardiology' ),
                array( 'name' => 'Dr. Sara Malik', 'specialty' => 'Dermatology' ),
                array( 'name' => 'Dr. Bilal Hussain', 'specialty' => 'Pediatrics' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Lahore Branch',
            'address' => 'Gulberg, Lahore',
            'phone' => '042-111-100002',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Ayesha Noor', 'specialty' => 'Gynecology' ),
                array( 'name' => 'Dr. Usman Ali', 'specialty' => 'Orthopedics' ),
                array( 'name' => 'Dr. Hina Shah', 'specialty' => 'Neurology' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Karachi Branch',
            'address' => 'Clifton, Karachi',
            'phone' => '021-111-100003',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Hamza Iqbal', 'specialty' => 'Cardiology' ),
                array( 'name' => 'Dr. Maryam Asif', 'specialty' => 'Pediatrics' ),
                array( 'name' => 'Dr. Fahad Raza', 'specialty' => 'ENT' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Islamabad Branch',
            'address' => 'F-8, Islamabad',
            'phone' => '051-111-100004',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Zainab Tariq', 'specialty' => 'Dermatology' ),
                array( 'name' => 'Dr. Omar Siddiqui', 'specialty' => 'Neurology' ),
                array( 'name' => 'Dr. Komal Javed', 'specialty' => 'Gynecology' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Faisalabad Branch',
            'address' => 'D Ground, Faisalabad',
            'phone' => '041-111-100005',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Saad Ahmed', 'specialty' => 'Orthopedics' ),
                array( 'name' => 'Dr. Iqra Saleem', 'specialty' => 'Cardiology' ),
                array( 'name' => 'Dr. Waleed Akram', 'specialty' => 'ENT' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Peshawar Branch',
            'address' => 'University Road, Peshawar',
            'phone' => '091-111-100006',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Mahnoor Khan', 'specialty' => 'Pediatrics' ),
                array( 'name' => 'Dr. Taimoor Shah', 'specialty' => 'Neurology' ),
                array( 'name' => 'Dr. Eman Fatima', 'specialty' => 'Dermatology' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Quetta Branch',
            'address' => 'Jinnah Road, Quetta',
            'phone' => '081-111-100007',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Rehan Ahmed', 'specialty' => 'ENT' ),
                array( 'name' => 'Dr. Nimra Yousaf', 'specialty' => 'Gynecology' ),
                array( 'name' => 'Dr. Danish Malik', 'specialty' => 'Cardiology' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Sialkot Branch',
            'address' => 'Paris Road, Sialkot',
            'phone' => '052-111-100008',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Laiba Hassan', 'specialty' => 'Orthopedics' ),
                array( 'name' => 'Dr. Haris Mahmood', 'specialty' => 'Pediatrics' ),
                array( 'name' => 'Dr. Anum Riaz', 'specialty' => 'Neurology' ),
            ),
        ),
        array(
            'name' => 'HealthFirst Bahawalpur Branch',
            'address' => 'Model Town, Bahawalpur',
            'phone' => '062-111-100009',
            'hours' => 'Monday-Saturday, 9 AM - 5 PM',
            'doctors' => array(
                array( 'name' => 'Dr. Shahzaib Noor', 'specialty' => 'Dermatology' ),
                array( 'name' => 'Dr. Mehwish Ali', 'specialty' => 'Cardiology' ),
                array( 'name' => 'Dr. Asad Rauf', 'specialty' => 'ENT' ),
            ),
        ),
    );

    $created_branches = 0;
    $created_doctors  = 0;

    foreach ( $branches as $branch ) {

        $existing_branches = get_posts(
            array(
                'post_type'      => 'clinic_branch',
                'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
                'title'          => $branch['name'],
                'posts_per_page' => 1,
            )
        );

        if ( ! empty( $existing_branches ) ) {
            $branch_id = $existing_branches[0]->ID;
        } else {
            $branch_id = wp_insert_post(
                array(
                    'post_type'   => 'clinic_branch',
                    'post_title'  => $branch['name'],
                    'post_status' => 'publish',
                ),
                true
            );

            if ( is_wp_error( $branch_id ) ) {
                continue;
            }

            $created_branches++;
        }

        update_post_meta( $branch_id, 'branch_address', $branch['address'] );
        update_post_meta( $branch_id, 'branch_phone', $branch['phone'] );
        update_post_meta( $branch_id, 'branch_opening_hours', $branch['hours'] );

        foreach ( $branch['doctors'] as $doctor ) {

            $existing_doctors = get_posts(
                array(
                    'post_type'      => 'clinic_doctor',
                    'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
                    'title'          => $doctor['name'],
                    'posts_per_page' => 1,
                )
            );

            if ( ! empty( $existing_doctors ) ) {
                $doctor_id = $existing_doctors[0]->ID;
            } else {
                $doctor_id = wp_insert_post(
                    array(
                        'post_type'   => 'clinic_doctor',
                        'post_title'  => $doctor['name'],
                        'post_status' => 'publish',
                    ),
                    true
                );

                if ( is_wp_error( $doctor_id ) ) {
                    continue;
                }

                $created_doctors++;
            }

            update_post_meta( $doctor_id, 'doctor_specialty', $doctor['specialty'] );
            update_post_meta( $doctor_id, 'doctor_branch_id', $branch_id );
            update_post_meta( $doctor_id, 'doctor_phone', '0300-1234567' );
        }
    }

    update_option( 'mcbc_seed_data_completed', 1 );

    wp_safe_redirect(
        add_query_arg(
            'mcbc_seeded',
            '1',
            admin_url( 'edit.php?post_type=clinic_branch' )
        )
    );
    exit;
}
add_action( 'admin_post_mcbc_seed_demo_data', 'mcbc_seed_demo_data' );

/**
 * Show completion message.
 */
function mcbc_seed_data_success_notice() {

    if ( isset( $_GET['mcbc_seeded'] ) && '1' === $_GET['mcbc_seeded'] ) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>HealthFirst demo data generation completed successfully!</p>';
        echo '</div>';
    }
}
add_action( 'admin_notices', 'mcbc_seed_data_success_notice' );