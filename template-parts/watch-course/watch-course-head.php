<section class="watch-course-head">
    <div class="container">
        <div class="inner row gy-2">
            <div class="head small col-md-7">
                <a href=""><i class="fa-solid fa-arrow-left"></i></a>
                <div class="head-wrapper">
                    <h5>Complete Website Responsive Design: from Figma to Webflow to Website Design</h5>
                    <div class="course-information">
                        <p><i class="fa-regular fa-folder-closed"></i><span>6 Sections</span></p>
                        <p><i class="fa-regular fa-circle-play"></i><span>202 lectures</span></p>
                        <p><i class="fa-regular fa-clock"></i><span>19h 37m</span></p>
                    </div>
                </div>
            </div>
            <div class="head-btns col-md-5">
                <button type="button" class="btn link" data-bs-toggle="modal" data-bs-target="#writereviewmodal">
                    Write a Review
                </button>
                <button type="button" class="btn">Next lecture</button>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="writereviewmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="writereviewmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="writereviewmodalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="review-stars">
                    <span><strong class='text-message'>0</strong> (Good/Amazing)</span>
                    <section class='rating-widget'>
                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
                <form action="" class="review-form" onsubmit="return validateForm()">
                    <h3>feedback</h3>
                    <textarea required name="" id="" cols="30" rows="5" placeholder="Write down your feedback here..."></textarea>
                    <button type="submit" class="btn ms-auto d-flex align-items-center justify-content-between" id="review-submitted" >Submit Review <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5815 11.4567L4.74572 2.58866C4.6125 2.51406 4.45968 2.48189 4.30769 2.49647C4.1557 2.51104 4.01177 2.57166 3.89515 2.67022C3.77854 2.76878 3.69478 2.90058 3.65507 3.04802C3.61537 3.19546 3.62161 3.3515 3.67297 3.49529L6.65994 11.8588C6.7182 12.0219 6.7182 12.2002 6.65994 12.3633L3.67297 20.7269C3.62161 20.8706 3.61537 21.0267 3.65507 21.1741C3.69478 21.3216 3.77853 21.4534 3.89515 21.5519C4.01177 21.6505 4.1557 21.7111 4.30769 21.7257C4.45968 21.7403 4.6125 21.7081 4.74573 21.6335L20.5815 12.7655C20.6978 12.7003 20.7947 12.6053 20.8621 12.4903C20.9295 12.3753 20.965 12.2444 20.965 12.1111C20.965 11.9778 20.9295 11.8468 20.8621 11.7318C20.7947 11.6168 20.6978 11.5218 20.5815 11.4567Z" fill="white" />
                        <path d="M6.75 12.1111H12.75" stroke="#FF6636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   

    jQuery(document).ready(function($) {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = ratingValue;
            } else {
                msg = ratingValue;
            }
            responseMessage(msg);

        });

        function responseMessage(msg) {
            $('.text-message').html(msg);
        }
    });
</script>

<script>
    function validateForm() {
        var feedbackInput = document.getElementById('feedback');
        if (feedbackInput && feedbackInput.value.trim() === "") {
            // Display an error message or take any other actions
            alert("Please provide your feedback.");
            return false; // Prevent form submission
        }

        // Continue with form submission
        showSuccessMessage();
        return true;
    }

    function showSuccessMessage() {
        Swal.fire({
            title: 'Review Submitted',
            text: 'We’ve received your review',
            icon: 'success',
            confirmButtonText: 'Okay',
            customClass: {
                confirmButton: 'btn-alerts'
            }
        }).then(() => {
                $('.btn-close').trigger('click'); 
                $('.review-form')[0].reset();
        });
    }
</script>

<script>
    jQuery(document).ready(function($) {
        $(document).on('submit', '.review-form', function(e) {
            e.preventDefault(); // Prevent the default form submission
            validateForm();
        });
    });
</script>

