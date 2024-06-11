<?php
    $newsletter_form_heading = get_field( 'newsletter_form_heading' );
    $newsletter_form_description = get_field( 'newsletter_form_description' );
    $form_shortcode_contend_string = (get_field( 'form_short-code_contend_string' )??'mc4wp_form');
    $form_shortcode_id = (get_field( 'form_short-code_id' )??'138');
?>
<section class="newsletter">
    <div class="container">
        <div class="inner">
            <div class="head small">
                <h2><?php echo (isset($newsletter_form_heading)?$newsletter_form_heading:'Join our list to learn more');?></h2>
                <?php echo (isset($newsletter_form_description)?$newsletter_form_description:'Sign up to get updates on courses and events');?>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php echo do_shortcode('['.$form_shortcode_contend_string.' id='.$form_shortcode_id.']'); ?>
                    <!-- <input type="email" placeholder="Email" class="form-control">
                    <a href="" class="btn">subscribe</a> -->
                </div>
            </div>
        </div>
    </div>
</section>