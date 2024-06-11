<?php /* Template Name: Request inner */ ?>

<?php

get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/request-inner/head-back-btn', 'page') ?>
    <?php echo get_template_part('template-parts/request-inner/request-details', 'page') ?>
</div>
<?php
get_footer();
