<?php /* Template Name: Support Requests */ ?>

<?php

get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/support-page/head-back-btn', 'page') ?>
    <?php echo get_template_part('template-parts/support-page/requests-table', 'page') ?>
</div>
<?php
get_footer();
