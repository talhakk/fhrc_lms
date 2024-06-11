<section class="support-submition-form mt-3 mb-5 py-3 py-md-5">
    <div class="container">
        <div class="inner">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="details">
                        <div class="note mb-4 mb-md-5 ">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>Do not share sensitive information (attachments or text). Ex. Your credit card details or personal ID numbers.</span>
                        </div>
                        <form action="" class="support-request">
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control w-100" id="subject" placeholder="e.g I have an issue in my course videos">
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Description</label>
                                <textarea class="form-control w-100" id="Description" rows="7"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded" role="button" for="attachment"><i class="fa-solid fa-paperclip"></i>Attach File<i class="ms-2 checked fa-solid fa-check"></i></label>
                                <input type="file" class="file-input form-control" id="attachment">
                            </div>
                        </form>
                        <div class="submit-btn d-flex align-items-center justify-content-end">
                            <button id="success" class="btn">Send</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="image">
                        <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/form-support.png'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        $(document).on('click', '#success', function(e) {
            Swal.fire({
                title: 'Request Received',
                text: 'We’ve received your customer support request. We will get back to you as soon as possible',
                icon: 'success',
                confirmButtonText: 'Go to my support requests',
                customClass: {
                    confirmButton: 'btn-alerts'
                },
                preConfirm: function() {
                    // Redirect to your desired URL
                    window.location.href = '/support-requests';
                }
            });
        });

        $(document).on('click', '#error', function(e) {
            swal(
                'Error!',
                'You clicked the <b style="color:red;">error</b> button!',
                'error'
            )
        });
    });
</script>