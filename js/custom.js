
jQuery(document).ready(function($) {
    $(".btn-toggler").on("click", function() {
       $(this).toggleClass('active');
       $("header").toggleClass('mob-menu-active');
    });

    var fileInputElement = document.querySelector('.support-submition-form .details .input-group input[type="file"]');
    if (fileInputElement) {
        fileInputElement.addEventListener('change', function() {
            if (this.value) {
                var checkedElement = document.querySelector('.support-submition-form .details .input-group label .checked');
                if (checkedElement) {
                    checkedElement.classList.add('file-selected');
                }
            } else {
                var checkedElement = document.querySelector('.support-submition-form .details .input-group label .checked');
                if (checkedElement) {
                    checkedElement.classList.remove('file-selected');
                }
            }
        });
    }

    $(".dashboard-links").on("click", function() {
        $(".dashboard-menu").toggleClass('active');
    });
});


   ////////////////////////////////Rating JS////////////////////////////////////
    jQuery(document).ready(function($) {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('.tutor-ratings-stars i').on('mouseover', function() {
            var onStar = parseInt($(this).data('rating-value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('i.tutor-icon-star-bold').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('i.tutor-icon-star-bold').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('.tutor-ratings-stars i').on('click', function() {
            var onStar = parseInt($(this).data('rating-value'), 10); // The star currently selected
            var stars = $(this).parent().children('i.tutor-icon-star-bold');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            // var ratingValue = parseInt($('.tutor-ratings-stars i.selected').last().data('value'), 10);
            // alert(onStar);
            var msg = msg_val = "";
            if (onStar == '1') {
                msg = 'Poor';
                msg_val = '1';
            } else if (onStar == '2') {
                msg = 'Fair';
                msg_val = '2';
            } else if (onStar == '3') {
                msg = 'Good';
                msg_val = '3';
            } else if (onStar == '4') {
                msg = 'Excellent';
                msg_val = '4';
            } else if (onStar == '5') {
                msg = 'WOW!!!';
                msg_val = '5';
            } else {
                msg = 'Rate Here.';
                msg_val = '0';
            }
            responseMessage(msg);

        });

        function responseMessage(msg) {
            $('.text-message').html(msg);
            $('.text-message-value').html(msg_val);
        }
    });

   

    // jQuery(document).ready(function($) {

        /* //1. Visualizing things on Hover - See next part for action on click 
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


        // 2. Action to perform on click 
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

    jQuery(document).ready(function($) {
        $(document).on('submit', '.review-form', function(e) {
            e.preventDefault(); // Prevent the default form submission
            validateForm();
        });
    });
*/

// Function to create an observer that fires when a button with the text "Stripe" is added
function createStripeButtonObserver() {

    // Create a new MutationObserver instance
    const observer = new MutationObserver((mutationsList) => {
        for (const mutation of mutationsList) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                for (const node of mutation.addedNodes) {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        // Check if the added node or its descendants contain the button with the text "Stripe"
                        const stripeButton = findStripeButton(node);
                        if (stripeButton) {
                            // Optionally, disconnect the observer if you only want it to fire once
                            observer.disconnect();
                        }
                    }
                }
            }
        }
    });

    // Function to find a button with the text "Stripe" in a node or its descendants
    function findStripeButton(node) {
        console.log(node);
        if (node.matches('.am-dialog-el__main-container')) {
            if(document.getElementsByClassName('am-dialog-el__main-container')[0]){
                const nodeList = document.getElementsByClassName('am-dialog-el__main-container')[0].querySelectorAll('div.am-payments__method .am-payments__method-button');
                nodeList.forEach(node => {
                    const pElement = node.querySelector('p');
                    if (pElement && pElement.textContent.trim().toLowerCase() === 'stripe') {
                        pElement.textContent = "Credit Card Payment";
                    }
                });
            }
        }
        return null;
    }

    // Start observing the document body for child list changes
    observer.observe(document, {
        childList: true,
        subtree: true,
    });

    return observer;
}

// Function to initialize the observer on a specific page if a certain container has a certain class
function initObserverOnPage() {
    if (document.querySelector('.course-details')) {
        createStripeButtonObserver();
    }
}
// Wait for the DOM to fully load before initializing the observer
document.addEventListener('DOMContentLoaded', initObserverOnPage);