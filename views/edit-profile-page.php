<?php /* Template Name: Edit Profile */ ?>

<?php

    get_header();
?>
<div class="dashboard-page">
    <?php echo get_template_part('template-parts/dashboard/dashboard-Nav' , 'page') ?>
    <?php echo get_template_part('template-parts/dashboard/edit-profile' , 'page') ?>
</div>
<?php
get_footer();