<?php

$back_button_heading = get_field('back_button_heading') ? get_field('back_button_heading') : '';
$back_button_text = get_field('back_button_text') ? get_field('back_button_text') : '';

$back_button_text_anchor = get_field('back_button_text_anchor');

if (is_array($back_button_text_anchor)) {
    $back_button_text_anchor_url = isset($back_button_text_anchor['url']) ? $back_button_text_anchor['url'] : '';
    $back_button_text_anchor_target = isset($back_button_text_anchor['target']) ? $back_button_text_anchor['target'] : '';
    $back_button_text_anchor_title = isset($back_button_text_anchor['title']) ? $back_button_text_anchor['title'] : '';
} else {
    $back_button_text_anchor_url = '';
    $back_button_text_anchor_target = '';
    $back_button_text_anchor_title = '';
}

$warning_message = get_field('warning_message') ? get_field('warning_message') : '';

$right_image = get_field('right_image');

if (is_array($right_image)) {
    $right_image_url = isset($right_image['url']) ? $right_image['url'] : '';
} else {
    $right_image_url = '';
}

$help_request_form_shortcode = get_field('help_request_form_shortcode');
if($help_request_form_shortcode){
    $help_request_form_shortcode = get_field('help_request_form_shortcode');
}else{
    $help_request_form_shortcode = '';
}

$current_user_id = get_current_user_id();

?>

<?php if(!empty($current_user_id)) { ?>

<section class="head-back-btn">
    <div class="container">
        <div class="inner">
            <div class="head small">
                <div class="head-wrapper">
                    <div class="onclick-arrow-wrap">
                        <a href="javascript:void(0)" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></a>
                        <?php if (!empty($back_button_heading)) { ?>
                            <h2><?php echo $back_button_heading ?></h2>
                        <?php } ?>
                    </div>
                    <?php if (!empty($back_button_text)) { ?>
                        <p class="pt-3"><?php echo $back_button_text ?><br>
                            <?php if (!empty($back_button_text_anchor)) { ?>
                                <a <?php if (!empty($back_button_text_anchor_url)) { ?> href="<?php echo $back_button_text_anchor_url ?>" <?php } ?> <?php if (!empty($back_button_text_anchor_target)) { ?> target="<?php echo $back_button_text_anchor_target ?>" <?php } ?>>
                                    <?php if (!empty($back_button_text_anchor_title)) {
                                        echo $back_button_text_anchor_title;
                                    } ?></a>
                            <?php } ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="support-submition-form mt-3 mb-5 py-3 py-md-5">
    <div class="container">
        <div class="inner">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="details">
                        <div class="note mb-4 mb-md-5 ">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <?php if (!empty($warning_message)) { ?>
                                <span><?php echo $warning_message ?></span>
                            <?php } ?>
                        </div>
                        <?php echo do_shortcode($help_request_form_shortcode) ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="image">
                        <img class="w-100" src="<?php echo $right_image_url; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<style>
    .wpcf7-spinner{
        display: none;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        $(document).on('click', '#success', function(e) {
            Swal.fire({
                title: 'Request Received',
                text: 'We’ve received your customer support request. We will get back to you as soon as possible',
                icon: 'success',
                confirmButtonText: 'Go to my support requests',
                customClass: {
                    confirmButton: 'btn-alerts'
                },
                preConfirm: function() {
                    // Redirect to your desired URL
                    window.location.href = '/support-requests';
                }
            });
        });

        $(document).on('click', '#error', function(e) {
            swal(
                'Error!',
                'You clicked the <b style="color:red;">error</b> button!',
                'error'
            )
        });
    });
</script>