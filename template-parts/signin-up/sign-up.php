<section class="signing-form-wrapper">
    <div class="container">
        <div class="inner">
            <div class="welcome-note">
                <p>REGISTER TODAY</p>
            </div>
            <div class="head small">
                <h2>SIGN UP & START LEARNING</h2>
                <p>We have the best specialist in your region. Quality and professionalism is our slogan</p>
            </div>
            <form>
                <h3>Your Information</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <label>First name <span>*</span></label>
                        <input type="text" class="mb-3 form-control" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Last name <span>*</span></label>
                        <input type="text" class="mb-3 form-control" placeholder=" ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Email <span>*</span></label>
                        <input type="email" class="mb-3 form-control" placeholder="">
                    </div>
                    <div class="col-sm-6">
                        <label>Phone</label>
                        <input type="text" class="mb-3 form-control" placeholder=" ">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Password</label>
                        <div class="input-group mb-3">
                            <input id="password-1" type="password" class="form-control" placeholder="" aria-label="password" aria-describedby="password1">
                            <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Re-type Password</label>
                        <div class="input-group mb-3">
                            <input id="password_confirmation" type="password" class="form-control" placeholder="" aria-label="confirm-password" aria-describedby="password2">
                            <span data-target="#password_confirmation" class="password-show" id="password2"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>User Type</label>
                        <select class="form-select mb-3" aria-label="Default select example">
                            <option selected>Instructor</option>
                            <option value="1">Student</option>
                        </select>
                    </div>
                </div>
                <div class="check-wrapper mt-2 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            I accept terms and conditions.
                        </label>
                    </div>
                    <a href="/student-dashboard" class="btn">Register</a>
                </div>
            </form>
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