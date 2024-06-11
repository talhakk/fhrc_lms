<?php /* Template Name: Wish List */ ?>

<?php

get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/dashboard/dashboard-Nav', 'page') ?>
    <?php echo get_template_part('template-parts/dashboard/wish-list-slider', 'page') ?>
</div>
<?php
get_footer();
