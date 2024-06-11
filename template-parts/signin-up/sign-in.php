<section class="signing-form-wrapper sign-in">
    <div class="container">
        <div class="inner">
            <div class="welcome-note">
                <p>LOGIN</p>
            </div>
            <div class="head small">
                <h2>Welcome back! Log In</h2>
            </div>
            <form>
                <div class="row">
                    <div class="col-12">
                        <label>Email</label>
                        <input type="email" class="mb-3 form-control" placeholder="">
                    </div>
                    <div class="col-12">
                        <label>Password</label>
                        <div class="input-group mb-3">
                            <input id="password-1" type="password" class="form-control" placeholder="" aria-label="password" aria-describedby="password1">
                            <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <span class="forgot-password">
                    <a href="">Forgot Password</a>
                    <a href="">Reset</a>
                </span>
                    <a href="/student-dashboard" class="btn sign-in">Login</a>
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