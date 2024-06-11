
<?php 
add_action( 'acf/init', 'freedomehouse_lms_custom_acf_init' );


function freedomehouse_lms_custom_acf_init() {

	/*check function exists*/
	if ( function_exists( 'acf_register_block' ) ) {

		/* New redesign blocks*/
		acf_register_block( array(
			'name'            => 'hero-block',
			'title'           => __( 'Hero block' ),
			'description'     => __( 'FHRC Hero Section' ),
			'render_template' => '/acf-blocks/hero-section-block/hero-section.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'keywords'        => array( 'heroblock', 'hero', '' ),
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		/* New redesign blocks*/
		acf_register_block( array(
			'name'            => 'featured-courses-block',
			'title'           => __( 'Featured Courses block' ),
			'description'     => __( 'Featured Courses block' ),
			'render_template' => '/acf-blocks/course-related-block/featured-courses-cards.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		/* New redesign blocks*/
		acf_register_block( array(
			'name'            => 'two-col-with-side-image-block',
			'title'           => __( 'Two column with (right or left) image block' ),
			'description'     => __( 'Two column with (right or left) image block' ),
			'render_template' => '/acf-blocks/two-col-block/two-col-with-side-image-block.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );
		/* New redesign blocks*/
		acf_register_block( array(
			'name'            => 'simple-text-block',
			'title'           => __( 'Simple text block' ),
			'description'     => __( 'Simple text block with heading, description and button which may full or container width' ),
			'render_template' => '/acf-blocks/simple-text-block/simple-text.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'courses-cards-block',
			'title'           => __( 'Courses cards block' ),
			'description'     => __( 'Courses cards block' ),
			'render_template' => '/acf-blocks/contact-us-block/contact-section.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'training-team-block',
			'title'           => __( 'Training team block' ),
			'description'     => __( 'Training team block' ),
			'render_template' => '/acf-blocks/training-team-block/training-team.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'newsletters-form-block',
			'title'           => __( 'Newsletter form block' ),
			'description'     => __( 'Newsletter form block' ),
			'render_template' => '/acf-blocks/newsletters-form-block/newsletters-form.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'testimonial-slider-block',
			'title'           => __( 'Instructor Testimonial slider block' ),
			'description'     => __( 'Instructor Testimonial slider block' ),
			'render_template' => '/acf-blocks/testimonial-slider-block/testimonial-slider.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'starter-courses-block',
			'title'           => __( 'Starter courses block' ),
			'description'     => __( 'Courses to get you started block.Where most polpular, new and trending courses listed' ),
			'render_template' => '/acf-blocks/course-related-block/starter-courses.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'custom-shortcode-block',
			'title'           => __( 'Custom Shortcode block' ),
			'description'     => __( 'Courses Shortcode block.Where you provide all the shortcode parameter' ),
			'render_template' => '/acf-blocks/custom-shortcode/custom-shortcode.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'home-hero-block-style', '/redesign/blocks/home-hero-block/home-hero-block.css', true, false );
				// assetEnqueue( 'home-hero-block-script', '/redesign/blocks/home-hero-block/home-hero-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'help-request-block',
			'title'           => __( 'Help Request form block' ),
			'description'     => __( 'Help Request form block.Where you provide all the Help request related data' ),
			'render_template' => '/acf-blocks/help-request-block/help-request-form.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'help-request-block-style', '/redesign/blocks/help-request-block/help-request-form.css', true, false );
				// assetEnqueue( 'help-request-form-script', '/redesign/blocks/help-request-block/help-request-form.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'request-table-block',
			'title'           => __( 'Request Table block' ),
			'description'     => __( 'Request Table block' ),
			'render_template' => '/acf-blocks/request-table-block/request-table-block.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'request-table-block-style', '/redesign/blocks/request-table-block/request-table-block.css', true, false );
				// assetEnqueue( 'request-table-block-script', '/redesign/blocks/request-table-block/request-table-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'calendar-gallery-module',
			'title'           => __( 'Calendar Gallery Module' ),
			'description'     => __( 'Calendar Gallery Module' ),
			'render_template' => '/acf-blocks/calendar-gallery-module/calendar-gallery-module.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'calendar-gallery-module-style', '/redesign/blocks/calendar-gallery-module/calendar-gallery-module.css', true, false );
				// assetEnqueue( 'calendar-gallery-module-script', '/redesign/blocks/calendar-gallery-module/calendar-gallery-module.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'calendar-block',
			'title'           => __( 'Calendar Block' ),
			'description'     => __( 'Calendar Block' ),
			'render_template' => '/acf-blocks/calendar-block/calendar-block.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'calendar-block-style', '/redesign/blocks/calendar-block/calendar-block.css', true, false );
				// assetEnqueue( 'calendar-block-script', '/redesign/blocks/calendar-block/calendar-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

		acf_register_block( array(
			'name'            => 'explore-events-block',
			'title'           => __( 'Explore Events' ),
			'description'     => __( 'Explore Events' ),
			'render_template' => '/acf-blocks/explore-events-block/explore-events-block.php',
			'enqueue_assets'  => function () {
				// assetEnqueue( 'explore-events-block-style', '/redesign/blocks/explore-events-block/explore-events-block.css', true, false );
				// assetEnqueue( 'explore-events-block-script', '/redesign/blocks/explore-events-block/explore-events-block.js', true, false );
			},

			'category'        => 'blocks',
			'icon'            => 'welcome-add-page',
			'multiple'        => true,
			'mode'            => 'edit',
		) );

    }
}

// add_filter( 'allowed_block_types', 'custom_allowed_block_types' );

// function custom_allowed_block_types( $allowed_blocks ) {
// 	return array(
//         'acf/hero-block',
//         // 'acf/fhrc-cpt-block',
//         'acf/two-col-with-side-image-block',
//         'acf/simple-text-block',
//         'acf/newsletters-form-block',
//         'acf/training-team-block',
//         'acf/testimonial-slider-block',
//         'acf/starter-courses-block',
//         'acf/custom-shortcode-block',
//         'acf/featured-courses-block',
//         'acf/help-request-form-block',
// 	);
// }
?>
