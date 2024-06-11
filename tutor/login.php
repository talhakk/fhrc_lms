<?php
/**
 * Display single login
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
	// Redirect to wp native login page.
	header( 'Location: ' . wp_login_url( tutor_utils()->get_current_url() ) );
	exit;
}

tutor_utils()->tutor_custom_header();
$login_url = tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ? '' : wp_login_url( tutor()->current_url );
?>

<?php
//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
do_action( 'tutor/template/login/before/wrap' );
?>
<section class="signing-form-wrapper sign-in">
    <div class="container">
        <div class="inner">
            <div class="welcome-note">
                <p>LOGIN</p>
            </div>
            <div class="head small">
                <h2>Welcome back!</h2>
            </div>
			<div <?php tutor_post_class( 'tutor-page-wrap' ); ?>>
				<!-- <div class="tutor-template-segment tutor-login-wrap"> -->

					<!-- <div class="tutor-login-form-wrapper"> -->
						<!-- <div class="tutor-fs-5 tutor-color-black tutor-mb-32">
							<?php esc_html_e( 'Hi, Welcome back!', 'tutor' ); ?>
						</div> -->
						<?php
							// load form template.
							// $login_form = trailingslashit( tutor()->path ) . 'templates/login-form.php';
							$login_form = get_template_directory() . '/tutor/login-form.php';
							// echo $login_form;
							tutor_load_template_from_custom_path(
								$login_form,
								false
							);
							?>
					<!-- </div> -->
					<?php do_action( 'tutor_after_login_form_wrapper' ); ?>
				<!-- </div> -->
			</div>
		</div>
	</div>
</section>
<?php //require_once get_template_directory() . '/acf-blocks/newsletters-form-block/newsletters-form.php'; ?>
<?php
	//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'tutor/template/login/after/wrap' );
	tutor_utils()->tutor_custom_footer();
?>
