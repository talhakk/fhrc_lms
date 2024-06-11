<section class="upcoming-events">
    <div class="container">
        <div class="inner">
            <div class="head small">
                <h2>events</h2>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="events-cards row gy-4">
                        <div class="col-sm-6">
                            <div class="card">
                            <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/CardMedia.png'); ?>" alt="">
                            <div class="content">
                                <h3>Event Name</h3>
                                <p>01-Feb+ruary-2024</p>
                                <a href="" class="btn">See more</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                            <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/CardMedia.png'); ?>" alt="">
                            <div class="content">
                                <h3>Event Name</h3>
                                <p>01-Feb+ruary-2024</p>
                                <a href="" class="btn">See more</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                            <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/CardMedia.png'); ?>" alt="">
                            <div class="content">
                                <h3>Event Name</h3>
                                <p>01-Feb+ruary-2024</p>
                                <a href="" class="btn">See more</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                            <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/CardMedia.png'); ?>" alt="">
                            <div class="content">
                                <h3>Event Name</h3>
                                <p>01-Feb+ruary-2024</p>
                                <a href="" class="btn">See more</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="pagination">
                                <li class="page-prev">
                                    <a href="" aria-label="Previous">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M12.8415 13.825L9.02484 10L12.8415 6.175L11.6665 5L6.6665 10L11.6665 15L12.8415 13.825Z" fill="#2D2F31" />
                                        </svg>
                                    </a>
                                </li>
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                                <li><a href="">...</a></li>
                                <li><a href="">20</a></li>
                                <li class="page-next">
                                    <a href="" aria-label="Next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M7.1582 6.175L10.9749 10L7.1582 13.825L8.3332 15L13.3332 10L8.3332 5L7.1582 6.175Z" fill="#2D2F31" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="datepicker">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Datepickers.png'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
/*    .events-wrapper {
    display: flex;
}

.event-cards {
    width: 50%;
    padding: 20px;
    box-sizing: border-box;
}

.calendar {
    width: 50%;
    padding: 20px;
    box-sizing: border-box;
}*/

</style>
<div class="events-wrapper">
    <div class="row">
        <!-- <div class="event-cards col-md-6">
            <?php// echo do_shortcode('[tribe_events view="list"]'); ?>
        </div> -->

        <div class="calendar col-md-12">
            <?php echo do_shortcode('[tribe_events view="month"]'); ?>
        </div>
    </div>
    
</div>

<!-- <script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.tribe-events-calendar-month__day-date-link').on('click', function() {
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        var date = $(this).find('.tribe-events-calendar-month__day-date-daynum').attr('datetime');
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'load_events_by_date',
                date: date
            },
            success: function(response) {
                var events = JSON.parse(response);
                displayEvents(events);
            }
        });
    });

    function displayEvents(events) {
        var eventCardsHtml = '';
        events.forEach(function(event) {
            eventCardsHtml += '<div class="event-card">';
            eventCardsHtml += '<h3>' + event.title + '</h3>';
            eventCardsHtml += '<p>' + event.content + '</p>';
            // Add more event details as needed
            eventCardsHtml += '</div>';
        });
        $('.event-cards').html(eventCardsHtml);
    }
});
</script> -->


