<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package freedome-house
 */

get_header();
?>
<main id="primary" class="site-main">
	<style>
		body:has(.fourOfour) .hero .inner {
			min-height: calc(100vh - 121.8px) !important;
			justify-content: flex-start !important;
			padding-top: 100px !important;
			align-items: center !important;
			background-position: center !important;
			background-size: contain !important;
			background-repeat: no-repeat !important;
		}

		.container {
			max-width: 1842px;
			width: 95%;
		}

		.news-story-hero .welcome-note {
			max-width: 886px !important;
			width: 100%;
			position: relative;
		}

		.news-story-hero .welcome-note p {
			color: #000 !important;
			text-transform: uppercase;
			font-size: 24px !important;
			letter-spacing: 5px !important;
			font-style: normal !important;
			font-weight: 600 !important;
		}

		.news-story-hero .welcome-note::before {
			content: '';
			height: 3px !important;
			max-width: 886px;
			width: 100%;
			background-color: #000;
			position: absolute;
			left: 0;
			bottom: 0;
			opacity: 1;
		}

		.news-story-hero .welcome-note::after {
			content: '';
			height: 3px !important;
			max-width: 886px;
			width: 100%;
			background-color: #000;
			position: absolute;
			left: 0;
			top: 0;
			opacity: 1;
		}

		.news-story-hero .page-hero-heading {
			margin: 50px 0 0px 0 !important;
		}

		.news-story-hero .page-hero-heading h1 {
			color: #000 !important;
			text-transform: uppercase;
		}

		.hero {
			position: relative;
			background-position: top center;
			background-repeat: no-repeat;
			background-size: cover;
			text-shadow: 3px 3px 5px rgb(0 0 0 / 50%);
		}

		.btn-global {
			color: #ffffff;
			text-align: center;
			border-radius: 5.227px;
			border: none;
			background: #104627;
			min-height: 45px;
			font-style: normal;
			font-weight: 500;
			line-height: 25.091px;
			min-width: 155px;
			padding: 10px 15px;
			transition: all 0.3s ease-in-out;
		}
	</style>


	<section class="hero page-hero news-story-hero fourOfour">
		<div class="container">
			<div class="inner" style="background-image:url('<?php echo get_template_directory_uri() . '/images/404-bg.png' ?>')">
				<div class="welcome-note">
					<p>
						PAGE NOT FOUND
					</p>
				</div>
				<div class="hero-heading page-hero-heading">
					<h1>
						Oops!
					</h1>
				</div>
				<div class="page-hero-details mt-5">
					<p class="text-dark">we’re sorry. the page you requested could no be found
						Please go back to the home page</p>
				</div>
				<button type="button" onclick="window.location.href='<?php echo home_url(); ?>';" class="btn-header btn-global mt-4">Learn More</button>
			</div>
		</div>
	</section>
</main><!-- #main -->