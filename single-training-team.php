<?php
/**
 * The template for displaying all our team members
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-service
 *
 * @package freedome-house
 */

get_header();
?>
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part('template-parts/instructor-inner/instructor-content' , get_post_type());

            the_post_navigation(
             array(
                 'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'freedome-house' ) . '</span> <span class="nav-title">%title</span>',
                 'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'freedome-house' ) . '</span> <span class="nav-title">%title</span>',
             )
            );

        endwhile; // End of the loop.
        ?>
<?php
get_footer();