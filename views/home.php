<?php /* Template Name: Homepage */ ?>

<?php

    get_header();
?>

<?php echo get_template_part('template-parts/home/home-hero' , 'page') ?>
<?php //echo get_template_part('template-parts/home/featured-0cards' , 'page') ?>
<?php echo get_template_part('template-parts/home/trainings' , 'page') ?>
<?php echo get_template_part('template-parts/home/where-and-how' , 'page') ?>
<?php //echo get_template_part('template-parts/home/signup-cta' , 'page') ?>
<?php //echo get_template_part('template-parts/home/featured-cards' , 'page') ?>
<?php //echo get_template_part('template-parts/home/services-section' , 'page') ?>
<?php echo get_template_part('template-parts/home/newsletter' , 'page') ?>

<?php
get_footer();