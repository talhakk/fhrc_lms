<section class="upcoming-events">
    <div class="container">
        <div class="inner-two">
            <div class="head small pt-4">
                <h2>Featured Events</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="events-cards-two row gy-4">
                        <?php

                        $featured_events = tribe_get_events(array(
                            'featured' => true,
                        ));

                        if ($featured_events) {
                            foreach ($featured_events as $event) {
                                $post_id = $event->ID;
                                $title = $event->post_title;
                                $image = get_the_post_thumbnail($post_id);
                                $event_date = tribe_get_start_date($post_id, true, 'Y-m-d H:i:s');
                                $formatted_date = date('F j, Y', strtotime($event_date));
                                $event_url = get_permalink($post_id);
                                $event_time = tribe_get_start_time($post_id, 'g:i A');

                                $venue_details = tribe_get_venue_details($post_id);
                                $venue_address = isset($venue_details['address']) ? $venue_details['address'] : '';

                        ?>

                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="card h-100">
                                        <?php echo $image; ?>
                                        <div class="content">
                                            <h3><?php echo $title; ?></h3>
                                            <p><?php echo $formatted_date; ?></p>
                                            <a href="<?php echo $event_url; ?>" class="btn">See more</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="head small pt-5">
            <h2>Search Events</h2>
        </div>
        <form class="search-events-form">

            <div class="row" style="border-radius: 20px;">
                <div class="col-lg-3 p-4 margin-class">
                    <div class="select-event-date d-flex flex-column">
                        <i class="fa-solid fa-calendar-days"></i>
                        <label for="selected-date" class="label-text">Selected Date:</label>
                        <input type="text" id="datepicker" size="30" placeholder="YYYY-MM-DD" name="date" style="border-radius: 5px;
    border: 0.7px solid rgba(16, 70, 39, 0.25);">
                    </div>
                </div>
                <div class="col-lg-3 p-4 margin-class">
                    <div class="select-event-time d-flex flex-column">
                        <i class="fa-regular fa-clock"></i>
                        <label for="selected-time">Selected Time:</label>
                        <input type="text" class="timepicker" name="time" style="border-radius: 5px;
    border: 0.7px solid rgba(16, 70, 39, 0.25);" />
                    </div>
                </div>
                <div class="col-lg-3 p-4 margin-class">
                    <div class="select-event-state d-flex flex-column">
                        <i class="fa-solid fa-file-zipper"></i>
                        <label for="selected-zipcode">Selected ZipCode:</label>
                        <input type="text" id="selected-zipcode" name="zipcode" style="border-radius: 5px;
    border: 0.7px solid rgba(16, 70, 39, 0.25);" />
                    </div>
                </div>
                <div class="col-lg-3 p-5 coloredButton" style="border-radius: 0 20px 20px 0;">
                    <div class="select-event-button d-flex flex-column">
                        <i class="fa-regular fa-circle-right"></i>
                        <button type="button" class="search-events-btn">Search For Events</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="col-lg-12">
            <div class="events-cards-new row gy-4 position-relative h-100" style="min-height: 360px; margin-bottom:30px;">
            </div>
            <div class="events-pagination-two pt-4 pb-4 text-center">
            </div>
        </div>

</section>

<script>
    $(function() {
        $("#datepicker").datepicker({
            defaultDate: null
        });
    });


    (function($) {
        $(function() {
            $('input.timepicker').timepicker();
        });
    })(jQuery);
</script>