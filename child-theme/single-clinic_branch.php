
<?php
/**
 * Single Doctor Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="site-main doctor-detail-page">

    <?php
    while ( have_posts() ) :
        the_post();

        $doctor_id = get_the_ID();

        $specialty = get_post_meta(
            $doctor_id,
            'doctor_specialty',
            true
        );

        $phone = get_post_meta(
            $doctor_id,
            'doctor_phone',
            true
        );

        $branch_id = get_post_meta(
            $doctor_id,
            'doctor_branch_id',
            true
        );
        ?>

        <article <?php post_class( 'doctor-profile' ); ?>>

            <header class="doctor-profile-header">
                <h1><?php the_title(); ?></h1>

                <?php if ( $specialty ) : ?>
                    <p>
                        <strong>Specialty:</strong>
                        <?php echo esc_html( $specialty ); ?>
                    </p>
                <?php endif; ?>
            </header>

            <section class="doctor-profile-content">
                <?php the_content(); ?>

                <?php if ( $phone ) : ?>
                    <p>
                        <strong>Phone:</strong>
                        <?php echo esc_html( $phone ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $branch_id ) : ?>
                    <p>
                        <strong>Branch:</strong>
                        <a href="<?php echo esc_url( get_permalink( $branch_id ) ); ?>">
                            <?php echo esc_html( get_the_title( $branch_id ) ); ?>
                        </a>
                    </p>
                <?php endif; ?>
                

<?php
$booking_page = get_page_by_path( 'book-appointment' );

if ( $booking_page ) :
?>
    <div class="doctor-booking">
        <a class="booking-button"
           href="<?php echo esc_url( get_permalink( $booking_page->ID ) ); ?>">
            Book an Appointment
        </a>
    </div>
<?php endif; ?>

            </section>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
