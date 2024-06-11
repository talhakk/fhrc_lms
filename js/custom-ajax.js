$(document).ready(function () {
    eventButtonClick();
});

function displayEvents(datepicker, timepicker, zipcode, page) {

    spinnertwo();

    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            action: 'get_events_by_date',
            selected_datepicker: datepicker,
            selected_timepicker: timepicker,
            selected_zipcode: zipcode,
            page: page,
        },
        success: function (response) {

            $('.events-cards-new').empty();

            if (response.success) {
                var eventsArray = response.data.creating_events_html;

                for (var i = 0; i < eventsArray.length; i++) {
                    var event = eventsArray[i];
                    var title = event.title;
                    var image = event.image;
                    var event_time = event.event_time;
                    var formattedDate = event.formatted_date;
                    var eventUrl = event.event_url;

                    $('.events-cards-new').append(`
                    <div class="col-xl-3 col-md-4 col-sm-6">
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
                    $('.events-pagination-two').empty(); 
                } else {
                    $('.events-pagination-two').html(response.data.pagination);
                }
            } else {
                $('.events-cards-new').append(`
                <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card card-wrapper" style="max-height: 356px; height: 100%;  background-color:rgba(16, 70, 39, 1);">
                    <div class="content card-content" style="display: flex;
                    justify-content: center; align-items: center; color:white; font-size:22px; font-weight:bold;">
                        <p style="color:white; font-size:22px;">There is no Event</p>
                    </div> 
                </div>
            </div>
             `);
             $('.events-pagination-two').empty(); 
            }
        },
        error: function () {
            console.error('AJAX request failed.');
        },
    });
}


$(".coloredButton").on('click', '.select-event-button', function () {
    eventButtonClick()
});

$(document).on('click', '.events-pagination-two a', function (event) {
    event.preventDefault();

    var href = $(this).attr('href');
    var match = href.match(/\/page\/(\d+)\/?$/);
    var page = 1;

    if (match) {
        page = parseInt(match[1]);
    }

    var updatedHref = href.replace(/\/page\/(\d+)\/?$/, '/page/' + page + '/');
    $(this).attr('href', updatedHref);

    var datepicker = $('#datepicker').val();
    var formattedDate = formatDate(datepicker);
    var timepicker = $('.timepicker').val();
    var formattedTime = formatTime(timepicker);
    var zipcode = $('#selected-zipcode').val();
    displayEvents(formattedDate, formattedTime, zipcode, page);
});



function formatTime(timeString) {
    if (!timeString) {
        return '';
    }
    var time = new Date('2000-01-01 ' + timeString);
    return time.toTimeString().split(' ')[0];
}

function formatDate(inputDate) {
    if (!inputDate) {
        return '';
    }
    var date = new Date(inputDate);
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    var formattedDate = year + '-' + month + '-' + day;
    return formattedDate;
}

function eventButtonClick() {
    var datepicker = $('#datepicker').val();
    var timepicker = $('.timepicker').val();
    var zipcode = document.getElementById("selected-zipcode").value;
    var formattedDate = formatDate(datepicker);
    var formattedTime = formatTime(timepicker);

    displayEvents(formattedDate, formattedTime, zipcode, 1);
}

function spinnertwo() {
    $('.events-cards-new').html(`
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

