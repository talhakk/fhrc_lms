<?php 
    $hero_welcome_note = get_field( 'hero_welcome_note' );
    $hero_heading_text = get_field( 'hero_heading_text' );
    $hero_description = get_field( 'hero_description' );
    $hero_buttons_links = get_field( 'hero_buttons_links' );

    $hero_section_image = get_field('hero_section_image');
    if($hero_section_image && is_array($hero_section_image) && isset($hero_section_image['url'])){
        $hero_section_image_url = $hero_section_image['url'];
    }else{
        $hero_section_image_url = '';
    }
?>
<section class="hero" style="background-image: url(<?php echo $hero_section_image_url; ?>);">
    <div class="overlay"></div>
    <div class="container">
        <div class="inner">
            <?php if ($hero_welcome_note) { ?>
            <div class="welcome-note">
                <p>
                    <?php echo $hero_welcome_note; ?>
                </p>
            </div>
            <?php } ?>
            <?php if ($hero_heading_text) { ?>
            <div class="hero-details">
                <h1><?php echo $hero_heading_text; ?></h1>
                <?php if ($hero_description) { ?>
                    <p><?php echo $hero_description; ?></p>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="hero-btns">
                <?php if(!empty($hero_buttons_links)) {
                        // print_r($hero_buttons_links);
                        foreach ($hero_buttons_links as $key => $value) {
                             if (!empty($value)) { ?>
                                <a href="<?php echo $value['label_and_link']['url'];?>" target="<?php echo $value['label_and_link']['target'];?>" class="btn <?php echo $value['extra_classes'];?>"><?php echo $value['label_and_link']['title'];?></a>
                            <?php 
                            }
                         }
                        ?>
                        <!-- <a href="" class="btn">Upcoming Training</a>
                        <a href="" class="btn">Registration</a>
                        <a href="" class="btn">Resource Library</a> -->
                <?php } ?>
            </div>
        </div>
    </div>
</section>