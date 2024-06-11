<?php /* Template Name: Training Calendar1 */ ?>

<?php

    get_header();
?>

<?php echo get_template_part('template-parts/training-calendar/calendar-hero' , 'page') ?>
<?php //echo get_template_part('template-parts/training-calendar/upcoming-events' , 'page') ?>
<?php echo get_template_part('template-parts/training-calendar/training-gallery' , 'page') ?>
<?php echo get_template_part('template-parts/home/newsletter' , 'page') ?>

<?php
get_footer();