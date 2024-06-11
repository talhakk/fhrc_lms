<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FHRC_LMS
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
	<link href="https://fonts.cdnfonts.com/css/century-schoolbook" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">

	<?php wp_head();
	include 'assets/css/theme_options.php';
	?>
	<!-- jQuery library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://vjs.zencdn.net/7.10.2/video.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/2.6.1/Youtube.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header class="landing-site-header signed-in">
			<div class="container">
				<div class="inner">
					<div class="logo">
						<a href="/">
							<?php
							$header_image = get_header_image();
							$custom_logo_id = get_theme_mod('custom_logo');
							$image_url = wp_get_attachment_image_url($custom_logo_id, 'full');
							if ($custom_logo_id) { ?>
								<img src="<?php echo $image_url ?>" alt="Header Image">
							<?php } else { ?>
								<img src="<?php echo esc_url($header_image); ?>" alt="Header Image">
							<?php } ?>
						</a>
					</div>
					<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>
					<!---Toggler--->
					<div class="menu-toggler ms-auto me-1" id="menu-toggler">
						<button class="btn-toggler" type="button">
							<i class="fa-solid fa-bars-staggered"></i>
						</button>
					</div>
					<!---Toggler--->
					<?php if (is_user_logged_in()) : ?>
						<div class="desktop-dashboard-nav">
							<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>
						</div>
					<?php else : ?>
						<div class="header-btns">
							<a href="<?php echo home_url('/dashboard'); ?>" class="btn link">Login</a>
							<a href="<?php echo home_url('/student-registration'); ?>" class="btn">Register Today</a>
						</div>
					<?php endif; ?>

					
					<!---Mobile Menu--->
					<div class="mobile-nav">
						<div class="container">
							<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>

							<?php if (is_user_logged_in()) : ?>
								<!-- Code to display when the user is logged in -->
							<?php else : ?>
								<div class="header-btns">
									<a href="<?php echo home_url('/dashboard'); ?>" class="btn link">Login</a>
									<a href="<?php echo home_url('/student-registration'); ?>" class="btn">Register Today</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>