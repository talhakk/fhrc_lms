<?php
/**
 * Template for displaying single lesson
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */
get_header();
tutor_load_template_from_custom_path( __DIR__ . '/single-content-loader.php', array( 'context' => 'lesson' ), false );
get_footer();