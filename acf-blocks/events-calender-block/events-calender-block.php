<section class="upcoming-events">

    <!-- Add this to your HTML form or input fields -->
    <form class="search-events-form">

        <div class="row">
            <div class="col-lg-3 p-4 margin-class">
                <div class="select-event-date d-flex flex-column">
                    <i class="fa-solid fa-calendar-days"></i>
                    <label for="selected-date" class="label-text">Selected Date:</label>
                    <input type="text" id="datepicker" size="30" placeholder="YYYY-MM-DD" name="date">
                </div>
            </div>
            <div class="col-lg-2 p-4 margin-class">
                <div class="select-event-time d-flex flex-column">
                    <i class="fa-regular fa-clock"></i>
                    <label for="selected-time">Selected Time:</label>
                    <input type="text" class="timepicker" name="time" />
                </div>
            </div>
            <div class="col-lg-2 p-4 margin-class">
                <div class="select-event-state d-flex flex-column">
                    <i class="fa-solid fa-map-marker-alt"></i>
                    <label for="selected-country">Selected Country:</label>
                    <input type="text" id="selected-country" name="country" />
                </div>
            </div>
            <div class="col-lg-2 p-4 margin-class">
                <div class="select-event-zip d-flex flex-column">
                    <i class="fa-solid fa-file-zipper"></i>
                    <label for="selected-zip">Selected Zip:</label>
                    <input type="text" id="selected-zipcode" name="zip" />
                </div>
            </div>
            <div class="col-lg-3 p-5 coloredButton">
                <div class="select-event-button d-flex flex-column">
                    <i class="fa-regular fa-circle-right"></i>
                    <button type="button" class="search-events-btn">Search For Events</button>
                </div>
            </div>
        </div>

    </form>


    <div class="container">
        <div class="inner">
            <div class="head small">
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
    .tribe-common-l-container .tribe-events-calendar-month-mobile-events {
        display: none;
    }

    .tribe-common-l-container .tribe-events-c-subscribe-dropdown__container {
        display: none;
    }
</style>

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