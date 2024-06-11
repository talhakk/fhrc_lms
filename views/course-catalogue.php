<?php /* Template Name: Course Catalogue */ ?>

<?php

    get_header();
?>

<?php echo get_template_part('template-parts/course-catalogue/course-catalogue-hero' , 'page') ?>
<?php echo get_template_part('template-parts/course-catalogue/starter-courses' , 'page') ?>
<?php echo get_template_part('template-parts/course-catalogue/all-courses' , 'page') ?>
<?php echo get_template_part('template-parts/course-catalogue/instructor-slider' , 'page') ?>

<?php
get_footer();