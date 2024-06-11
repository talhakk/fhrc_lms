<?php /* Template Name: Student Dashboard */ ?>

<?php

    get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/dashboard/dashboard-Nav' , 'page') ?>
    <?php echo get_template_part('template-parts/dashboard/student-dashboard-btns' , 'page') ?>
    <?php echo get_template_part('template-parts/dashboard/dashboard-course-slider' , 'page') ?>
</div>
<?php
get_footer();