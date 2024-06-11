<?php
/**
 * Tutor login form template
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.1
 */

use TUTOR\Ajax;

$lost_pass = apply_filters( 'tutor_lostpassword_url', wp_lostpassword_url() );
/**
 * Get login validation errors & print
 *
 * @since 2.1.3
 */
$login_errors = get_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY ) ? get_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY ) : array();
foreach ( $login_errors as $login_error ) {
	?>
	<div class="tutor-alert tutor-warning tutor-mb-12" style="display:block; grid-gap: 0px 10px;">
		<?php
		echo wp_kses(
			$login_error,
			array(
				'strong' => true,
				'a'      => array(
					'href'  => true,
					'class' => true,
					'id'    => true,
				),
				'p'      => array(
					'class' => true,
					'id'    => true,
				),
				'div'    => array(
					'class' => true,
					'id'    => true,
				),
			)
		);
		?>
	</div>
	<?php
}

do_action( 'tutor_before_login_form' );
?>
	<form id="tutor-login-form" method="post">
		<div class="row">
	<?php if ( is_single_course() ) : ?>
		<input type="hidden" name="tutor_course_enroll_attempt" value="<?php echo esc_attr( get_the_ID() ); ?>">
	<?php endif; ?>
	<?php tutor_nonce_field(); ?>
	<input type="hidden" name="tutor_action" value="tutor_user_login" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_url( apply_filters( 'tutor_after_login_redirect_url', tutor()->current_url ) ); ?>" />

	<div class="col-12">
        <label>Email</label>
        <!-- <input type="email" class="mb-3 form-control" placeholder=""> -->
        <input type="text" class="mb-3 tutor-form-control-- form-control" placeholder="<?php esc_html_e( 'Username or Email Address', 'tutor' ); ?>" name="log" value="" size="20" required/>
    </div>
	<!-- <div class="tutor-mb-20">
		<input type="text" class="tutor-form-control" placeholder="<?php esc_html_e( 'Username or Email Address', 'tutor' ); ?>" name="log" value="" size="20" required/>
	</div> -->

	 <div class="col-12">
        <label>Password</label>
        <div class="input-group mb-3">
            <!-- <input id="password-1" type="password" class="form-control" placeholder="" aria-label="password" aria-describedby="password1"> -->
            <input type="password" id="password-1" class="tutor-form-control-- form-control" placeholder="<?php esc_html_e( 'Password', 'tutor' ); ?>" name="pwd" value="" size="20" required/>
            <span data-target="#password-1" class="password-show" id="password1"><i class="fa-regular fa-eye-slash"></i></span>
        </div>
    </div>
	<!-- <div class="tutor-mb-32">
		<input type="password" class="tutor-form-control" placeholder="<?php esc_html_e( 'Password', 'tutor' ); ?>" name="pwd" value="" size="20" required/>
	</div> -->

	<div class="tutor-login-error"></div>
	<?php
		do_action( 'tutor_login_form_middle' );
		do_action( 'login_form' );
		apply_filters( 'login_form_middle', '', '' );
	?>
	<div class="tutor-d-flex tutor-justify-between tutor-align-center tutor-mb-40">
		<div class="tutor-form-check">
			<input id="tutor-login-agmnt-1" type="checkbox" class="tutor-form-check-input tutor-bg-black-40" name="rememberme" value="forever" />
			<label for="tutor-login-agmnt-1" class="tutor-fs-7 tutor-color-muted">
				<?php esc_html_e( 'Keep me signed in', 'tutor' ); ?>
			</label>
		</div>
		<span class="forgot-password">
			<a href="<?php echo esc_url( $lost_pass ); ?>" class="tutor-btn tutor-btn-ghost">
				<?php esc_html_e( 'I forgot my password?', 'tutor' ); ?>
			</a>
			<a href="javascript:void(0)" class="reset">Reset</a>
        </span>
	</div>

	<?php do_action( 'tutor_login_form_end' ); ?>
	<button type="submit" class="btn sign-in">
		<?php esc_html_e( 'LogIn', 'tutor' ); ?>
	</button>
	<!-- <button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-block">
		<?php //esc_html_e( 'Sign In', 'tutor' ); ?>
	</button> -->
	
	
	<?php if ( get_option( 'users_can_register', false ) ) : ?>
		<?php
			$url_arg = array(
				'redirect_to' => tutor()->current_url,
			);
			if ( is_single_course() ) {
				$url_arg['enrol_course_id'] = get_the_ID();
			}
			?>
		<div class="tutor-text-center tutor-fs-6 tutor-color-secondary tutor-mt-20 mt-2 reg-link">
			<?php esc_html_e( 'Don\'t have an account?', 'tutor' ); ?>&nbsp;
			<a href="<?php echo esc_url( add_query_arg( $url_arg, tutor_utils()->student_register_url() ) ); ?>" class="tutor-btn tutor-btn-link">
				<?php esc_html_e( 'Register Now', 'tutor' ); ?>
			</a>
		</div>
	<?php endif; ?>
	<?php do_action( 'tutor_after_sign_in_button' ); ?>
		</div>
	</form>
<?php
do_action( 'tutor_after_login_form' );
if ( ! tutor_utils()->is_tutor_frontend_dashboard() ) : ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var { __ } = wp.i18n;
		var loginModal = document.querySelector('.tutor-modal.tutor-login-modal');
		var errors = <?php echo wp_json_encode( $login_errors ); ?>;
		if (loginModal && errors.length) {
			loginModal.classList.add('tutor-is-active');
		}
	});
</script>
<?php endif; ?>
<?php delete_transient( Ajax::LOGIN_ERRORS_TRANSIENT_KEY ); ?>
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

    jQuery(".reset").click(function($) {
    	jQuery(this).closest('form').find("input[type=text], input[type=password], input[type=email], textarea").val("");
	});
</script>
