<?php /* Template Name: Course inner */ ?>

<?php

    get_header();
?>

<?php echo get_template_part('template-parts/course-inner/course-inner-hero' , 'page') ?>
<?php echo get_template_part('template-parts/course-inner/course-details' , 'page') ?>
<?php echo get_template_part('template-parts/course-inner/course-inner-video' , 'page') ?>
<?php echo get_template_part('template-parts/home/newsletter' , 'page') ?>

<?php
get_footer();