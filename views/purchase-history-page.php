<?php /* Template Name: Purchase History */ ?>

<?php

    get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/dashboard/dashboard-Nav' , 'page') ?>
    <?php echo get_template_part('template-parts/dashboard/purchase-history' , 'page') ?>
</div>
<?php
get_footer();