$(document).ready(function () {

    function displayCalendarEvents(selectedDate, page) {

        spinner();

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'get_calendar_events',
                selected_date: selectedDate,
                page: page,
            },
            success: function (response) {

                $('.events-cards').empty();

                if (response.success) {
                    var eventsArray = response.data.creating_events_html_data;

                    for (var i = 0; i < eventsArray.length; i++) {
                        var event = eventsArray[i];
                        var title = event.title;
                        var image = event.image;
                        var event_time = event.event_time;
                        var formattedDate = event.formatted_date;
                        var eventUrl = event.event_url;

                        $('.events-cards').append(`
                        <div class="col-sm-6">
                            <div class="card">
                                ${image}
                                <div class="content">
                                    <h3>${title}</h3>
                                    <p>${formattedDate}</p>
                                    <a href="${eventUrl}" class="btn">See more</a>
                                </div> 
                            </div>
                        </div>
                    `);
                    }
                    if (eventsArray.length <= 1) {
                        $('.events-pagination').empty(); 
                    } else {
                        $('.events-pagination').html(response.data.pagination);
                    }
                } else {
                    $('.events-cards').append(`
                    <div class="col-sm-6">
                    <div class="card card-wrapper" style="max-height: 356px; height: 100%;  background-color:rgba(16, 70, 39, 1);">
                        <div class="content card-content" style="display: flex;
                        justify-content: center; align-items: center; color:white; font-size:22px; font-weight:bold;">
                            <p style="color:white; font-size:22px; text-align: center;">There is no Event on this date.</p>
                        </div> 
                    </div>
                </div>
                 `);
                 $('.events-pagination').empty(); 
                }
            },
            error: function () {
                console.error('AJAX request failed.');
            },
        });
    }

    var activeDate = $(".tribe-events-calendar-month__day-cell--selected").find('h3 time').attr('datetime');

    displayCalendarEvents(activeDate, 1);

    $(document).on("click", ".tribe-events-calendar-month__day-cell--selected", function () {
        var selectedDate = $(this).find('h3 time').attr('datetime');
        displayCalendarEvents(selectedDate, 1);
    });

    $(document).on('click', '.events-pagination a', function (event) {
        event.preventDefault();
    
        var href = $(this).attr('href');
        var match = href.match(/\/page\/(\d+)\/?$/);
        var page = 1; 
    
        if (match) {
            page = parseInt(match[1]);
        }
    
        var updatedHref = ajax_object.ajax_url + '?page=' + page;
        $(this).attr('href', updatedHref);
    
        var selectedDate = $(".tribe-events-calendar-month__day-cell--selected").find('h3 time').attr('datetime');
        displayCalendarEvents(selectedDate, page);
    });
    


});


function spinner() {
    $('.events-cards').html(`
        <div class="spinner">
            <div class="react1"></div>
            <div class="react2"></div>
            <div class="react3"></div>
            <div class="react4"></div>
            <div class="react5"></div>
        </div>
    `);

    $('head').append(`
        <style>
            .spinner {
                position: absolute;
                transform: translate(-50%, -50%);
                top: 50%;
                left: 50%;
                width: 120px;
                height: 80px;
                text-align: center;
                font-size: 30px;
                z-index: 9999;
            }

            .spinner > div {
                background-color: #fff;
                height: 100%;
                width: 8px;
                display: inline-block;
                animation: meregang 1.2s infinite ease-in-out;
            }

            .spinner .react2 {
                animation-delay: -1.1s;
            }

            .spinner .react3 {
                animation-delay: -1s;
            }

            .spinner .react4 {
                animation-delay: -0.9s;
            }

            .spinner .react5 {
                animation-delay: -0.8s;
            }

            @keyframes meregang {
                0%, 40%, 100% {
                    transform: scaleY(0.4);
                }
                20% {
                    background-color: #104627;
                    transform: scaleY(1);
                }
            }
        </style>
    `);
}




