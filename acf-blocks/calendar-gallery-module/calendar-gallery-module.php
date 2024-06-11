<?php

$calendar_gallery_images_slider = get_field('calendar_gallery_repeater');

?>

<section class="training-gallery">
    <div class="container">
        <div class="inner">
            <div class="head small">
                <h2>OUR GALLERY</h2>
            </div>
        </div>
    </div>

    <div class="row g-0">

        <?php
        $index = 0;

        if (have_rows('calendar_gallery_repeater')) :
            while (have_rows('calendar_gallery_repeater')) : the_row();

                $calendar_gallery_images_slider = get_sub_field('calendar_gallery_images_slider');
                if ($calendar_gallery_images_slider && isset($calendar_gallery_images_slider['url'])) {
                    $calendar_gallery_images_slider_url = $calendar_gallery_images_slider['url'];
                } else {
                    $calendar_gallery_images_slider_url = "";
                }

        ?>
                <div class="column">
                    <a href="<?php echo $calendar_gallery_images_slider_url ?>" data-fancybox="gallery" class="hover-shadow">
                        <img src="<?php echo $calendar_gallery_images_slider_url ?>" style="width:100%">
                    </a>
                </div>
        <?php
                $index++;
            endwhile;
        endif;
        ?>
    </div>
</section>

<script>
    Fancybox.bind("[data-fancybox]", {
    });
</script>

<style>
    .fancybox__slide.has-image>.fancybox__content {
        width: 100% !important;
        min-height: 100%;
    }
</style>