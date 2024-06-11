
<?php 
$image_position = get_field( 'image_position' );
$main_image = get_field( 'main_image' );
$tcwsib_title_note = get_field( 'tcwsib_title_note' );
$tcwsib_heading = get_field( 'tcwsib_heading' );
$tcwsib_description = get_field( 'tcwsib_description' );
$feature_columns = get_field( 'feature_columns' );
$tcwsib_features_list = get_field( 'tcwsib_features_list' );
$main_image_sec = '<div class="col-lg-6">
                <img class="w-100" src="'.(file_exists($main_image)?esc_url($main_image):esc_url(get_template_directory_uri() . "/assets/images/where-and-how.png")).'" alt="">
            </div>';
?>
<section class="where-and-how <?php echo ($feature_columns == 1 ? 'left-img' : ''); ?>">
    <div class="container">
        <div class="inner row align-items-center">
            <?php
                if (!$image_position) {
                    echo $main_image_sec;
                }
            ?>
            <div class="col-lg-6">
                <div class="content">
                    <div class="head small">
                        <h3><?php echo (isset($tcwsib_title_note)?$tcwsib_title_note:'');?></h3>
                        <h2><?php echo (isset($tcwsib_heading)?$tcwsib_heading:'');?></h2>
                    </div>
                    <p><?php echo (isset($tcwsib_description)?$tcwsib_description:'');?></p>
                    <?php
                        if (!empty($tcwsib_features_list)) {
                    ?>
                            <div class="where-how-cards">
                                	<?php 
                                    foreach ($tcwsib_features_list as $key => $value) { 
										if(!empty($value['feature_title']) && !empty($value['feature_icon_image']))	{?>
                                        <span>
                                            <img decoding="async" src="<?php echo !empty($value['feature_icon_image']) ? esc_url($value['feature_icon_image']) : esc_url(home_url('/wp-content/uploads/2024/05/Live.png')); ?>" alt="">
                                            <span class="service-desc">
                                            <?php echo (isset($value['feature_title'])?$value['feature_title']:'');?>
                                                <?php echo (isset($value['feature_description'])?'<p>'.$value['feature_description'].'</p>':'');?>
                                            </span>
                                        </span>
									<?php } 
									} ?>
                            </div>
                    <?php } ?>
                
                </div>
            </div>
            <?php
                if ($image_position) {
                    echo $main_image_sec;
                }
            ?>
        </div>
    </div>
</section>