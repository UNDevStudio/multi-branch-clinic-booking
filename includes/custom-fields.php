<?php
/**
 * Native custom fields for Branch and Doctor post types.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register native post meta fields.
 */
function mcbc_register_custom_fields() {

    $string_fields = array(
        'clinic_branch' => array(
            'branch_address',
            'branch_phone',
            'branch_opening_hours',
        ),
        'clinic_doctor' => array(
            'doctor_specialty',
            'doctor_phone',
        ),
    );

    foreach ( $string_fields as $post_type => $fields ) {
        foreach ( $fields as $field ) {
            register_post_meta(
                $post_type,
                $field,
                array(
                    'type'              => 'string',
                    'single'            => true,
                    'show_in_rest'      => true,
                    'sanitize_callback' => 'sanitize_text_field',
                    'auth_callback'     => function ( $allowed, $meta_key, $post_id ) {
                        return current_user_can( 'edit_post', $post_id );
                    },
                )
            );
        }
    }

    register_post_meta(
        'clinic_doctor',
        'doctor_branch_id',
        array(
            'type'              => 'integer',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'absint',
            'auth_callback'     => function ( $allowed, $meta_key, $post_id ) {
                return current_user_can( 'edit_post', $post_id );
            },
        )
    );
}
add_action( 'init', 'mcbc_register_custom_fields' );


/**
 * Add custom meta boxes.
 */
function mcbc_add_custom_meta_boxes() {

    add_meta_box(
        'mcbc_branch_details',
        'Branch Details',
        'mcbc_branch_meta_box_callback',
        'clinic_branch',
        'normal',
        'high'
    );

    add_meta_box(
        'mcbc_doctor_details',
        'Doctor Details',
        'mcbc_doctor_meta_box_callback',
        'clinic_doctor',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mcbc_add_custom_meta_boxes' );


/**
 * Branch meta box.
 */
function mcbc_branch_meta_box_callback( $post ) {

    wp_nonce_field(
        'mcbc_save_custom_fields',
        'mcbc_custom_fields_nonce'
    );

    $address = get_post_meta( $post->ID, 'branch_address', true );
    $phone   = get_post_meta( $post->ID, 'branch_phone', true );
    $hours   = get_post_meta( $post->ID, 'branch_opening_hours', true );
    ?>

    <p>
        <label for="branch_address"><strong>Branch Address</strong></label>
        <input type="text"
            id="branch_address"
            name="branch_address"
            value="<?php echo esc_attr( $address ); ?>"
            class="widefat">
    </p>

    <p>
        <label for="branch_phone"><strong>Branch Phone</strong></label>
        <input type="text"
            id="branch_phone"
            name="branch_phone"
            value="<?php echo esc_attr( $phone ); ?>"
            class="widefat">
    </p>

    <p>
        <label for="branch_opening_hours"><strong>Opening Hours</strong></label>
        <input type="text"
            id="branch_opening_hours"
            name="branch_opening_hours"
            value="<?php echo esc_attr( $hours ); ?>"
            class="widefat">
    </p>

    <?php
}


/**
 * Doctor meta box.
 */
function mcbc_doctor_meta_box_callback( $post ) {

    wp_nonce_field(
        'mcbc_save_custom_fields',
        'mcbc_custom_fields_nonce'
    );

    $specialty = get_post_meta( $post->ID, 'doctor_specialty', true );
    $phone     = get_post_meta( $post->ID, 'doctor_phone', true );
    $branch_id = get_post_meta( $post->ID, 'doctor_branch_id', true );

    $branches = get_posts(
        array(
            'post_type'      => 'clinic_branch',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        )
    );
    ?>

    <p>
        <label for="doctor_specialty"><strong>Doctor Specialty</strong></label>
        <input type="text"
            id="doctor_specialty"
            name="doctor_specialty"
            value="<?php echo esc_attr( $specialty ); ?>"
            class="widefat">
    </p>

    <p>
        <label for="doctor_phone"><strong>Doctor Phone</strong></label>
        <input type="text"
            id="doctor_phone"
            name="doctor_phone"
            value="<?php echo esc_attr( $phone ); ?>"
            class="widefat">
    </p>

    <p>
        <label for="doctor_branch_id"><strong>Select Branch</strong></label>

        <select id="doctor_branch_id"
            name="doctor_branch_id"
            class="widefat">

            <option value="">Select a Branch</option>

            <?php foreach ( $branches as $branch ) : ?>
                <option
                    value="<?php echo esc_attr( $branch->ID ); ?>"
                    <?php selected( $branch_id, $branch->ID ); ?>>
                    <?php echo esc_html( $branch->post_title ); ?>
                </option>
            <?php endforeach; ?>

        </select>
    </p>

    <?php
}


/**
 * Save custom field values.
 */
function mcbc_save_custom_fields( $post_id ) {

    if ( ! isset( $_POST['mcbc_custom_fields_nonce'] ) ) {
        return;
    }

    $nonce = sanitize_text_field(
        wp_unslash( $_POST['mcbc_custom_fields_nonce'] )
    );

    if ( ! wp_verify_nonce( $nonce, 'mcbc_save_custom_fields' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $post_type = get_post_type( $post_id );

    $fields = array(
        'clinic_branch' => array(
            'branch_address',
            'branch_phone',
            'branch_opening_hours',
        ),
        'clinic_doctor' => array(
            'doctor_specialty',
            'doctor_phone',
        ),
    );

    if ( isset( $fields[ $post_type ] ) ) {

        foreach ( $fields[ $post_type ] as $field ) {

            if ( isset( $_POST[ $field ] ) ) {

                update_post_meta(
                    $post_id,
                    $field,
                    sanitize_text_field(
                        wp_unslash( $_POST[ $field ] )
                    )
                );
            }
        }
    }

    if (
        'clinic_doctor' === $post_type &&
        isset( $_POST['doctor_branch_id'] )
    ) {
        $branch_id = absint( $_POST['doctor_branch_id'] );

        if (
            $branch_id > 0 &&
            'clinic_branch' === get_post_type( $branch_id )
        ) {
            update_post_meta(
                $post_id,
                'doctor_branch_id',
                $branch_id
            );
        } else {
            delete_post_meta(
                $post_id,
                'doctor_branch_id'
            );
        }
    }
}
add_action( 'save_post', 'mcbc_save_custom_fields' );