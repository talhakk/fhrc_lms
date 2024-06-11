<section class="edit-profile">
    <div class="container">
        <div class="inner">
            <div class="personal-info-wrapper">
                <div class="edit-profile-pic">
                <img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt="">
                    <div class="input-group mb-3">
                        <label class="input-group-text rounded" role="button" for="attachment"><i class="fa-solid fa-camera"></i></label>
                        <input type="file" class="file-input form-control" id="attachment">
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <input type="text" class="mb-3 form-control" placeholder="Firsr Name">
                        </div>
                        <div class="col-md-6">
                            <label> </label>
                            <input type="text" class="mb-3 form-control" placeholder="Last Name">
                        </div>
                        <div class="col-12">
                            <label>Username</label>
                            <input type="text" class="mb-3 form-control" placeholder="Enter Your Username">
                        </div>
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" class="mb-3 form-control" placeholder="Email Address">
                        </div>
                        <div class="col-12">
                            <label>Title</label>
                            <input type="Text" class="mb-3 form-control" maxlength="50" placeholder="Your tittle, proffesion or small biography">
                        </div>
                    </div>
                    <a href="" class="btn sign-in">Save Changes</a>
                </form>
            </div>
            <div class="row gy-4 mt-3">
                <div class="col-md-6">
                    <form>
                        <h3>notification</h3>
                        <div class="row gy-2">
                            <div class="col-12">
                                <div class="check-wrapper">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I want to know who buy my course.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="check-wrapper">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                        <label class="form-check-label" for="flexCheckDefault1">
                                            I want to know who write a review on my course.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="check-wrapper">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            I want to know who commented on my lecture.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn mt-3 sign-in">Save Changes</a>
                    </form>
                </div>
                <div class="col-md-6">
                    <form>
                        <h3>Change password</h3>
                        <div class="row">
                            <div class="col-12">
                                <label>Current Password</label>
                                <div class="input-group mb-3">
                                    <input id="password-1" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password1">
                                    <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>New Password</label>
                                <div class="input-group mb-3">
                                    <input id="password-1" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="password1">
                                    <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input id="password-1" type="password" class="form-control" placeholder="Confirm Password" aria-label="password" aria-describedby="password1">
                                    <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn sign-in">Save Changes</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        $(".password-show").on("click", function() {
            var target = $($(this).data("target"));
            var inputType = target.attr("type");
            var eyeIcon = $(this).find("i");
            // Toggle between password and text type
            if (inputType === "password") {
                target.attr("type", "text");
                eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                target.attr("type", "password");
                eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });
    });
</script>