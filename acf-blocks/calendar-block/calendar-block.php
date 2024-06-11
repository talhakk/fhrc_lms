<section class="upcoming-events">
    <?php
    $args = array(
        'post_type'      => 'tribe_events',
        'posts_per_page' => 1,
    );

    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) : $wp_query->the_post();

            $post_id = get_the_ID();
            $title = get_the_title($post_id);
            $image = get_the_post_thumbnail($post_id);
            $event_date = tribe_get_start_date($post_id, true, 'Y-m-d H:i:s');
            $formatted_date = date('F j, Y', strtotime($event_date));
            $event_url = get_permalink($post_id);
            $event_time = tribe_get_start_time($post_id, false, 'g:ia');
            $event_venue = tribe_get_venue($post_id);
            $event_address = tribe_get_address($post_id);
    ?>

            <div class="calendar-btns">
                <div class="wrapper">
                    <a href="<?php echo $event_url ?>"><i class="fa-solid fa-calendar-days"></i><?php echo $formatted_date; ?></a>
                    <a href="<?php echo $event_url ?>"><i class="fa-regular fa-clock"></i>Start time <?php echo $event_time; ?></a>
                    <!-- <a href=""><i class="fa-solid fa-location-dot"></i><?php //echo $event_venue . ', ' . $event_address; 
                                                                            ?></a>  -->
                    <a href="<?php echo $event_url ?>"><i class="fa-solid fa-location-dot"></i><?php echo $event_address; ?></a>
                    <a href="<?php echo $event_url ?>" class="registeration-btn"><i class="fa-regular fa-circle-right"></i>Read More...</a>
                </div>
            </div>

    <?php
        endwhile;
        wp_reset_postdata();
    }
    ?>

    <div class="container">
        <div class="inner">
            <div class="head small pt-5">
                <h2>events</h2>
            </div>
            <div class="row mb-4">
                <div class="col-lg-7">
                    <div class="events-cards row gy-4 position-relative h-100">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="datepicker">
                        <?php echo do_shortcode('[tribe_events]') ?>
                    </div>
                </div>
            </div>
            <div class="events-pagination pt-4 pb-4 text-center">
            </div>
        </div>
    </div>
</section>

<style>
    .tribe-common .tribe-common-l-container .tribe-events-header .tribe-events-header__events-bar {
        display: none;
    }

    .tribe-common .tribe-common-l-container .tribe-events-c-top-bar .tribe-events-c-top-bar__datepicker {
        text-align: center;
        display: flex;
        justify-content: center;
    }
</style>