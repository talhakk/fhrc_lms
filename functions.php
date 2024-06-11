<?php

/**
 * FHRC_LMS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FHRC_LMS
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

require_once get_template_directory()."/tutor/classes/Course_Filter.php";
require_once get_template_directory()."/tutor/classes/Enrollments_List.php";
// require_once get_template_directory()."/tutor/classes/Certificate.php";
require_once "custom_functions/acf_blocks_registration.php";
require_once "custom_functions/query_functions.php";
require_once "custom_functions/custom_functions.php";
require_once get_template_directory()."/custom_functions/amelia-functions.php";

/**
 * Load Files related to Tutor LMS & Amelia Sync
 */

require_once get_template_directory()."/custom_functions/lms-amelia-integration/amelia-tags-lms-course-sync.php";
require_once get_template_directory()."/custom_functions/lms-amelia-integration/user-sync.php";

/**
 * Load Files related to Tutor LMS Dashboard
 */
 require_once get_template_directory()."/custom_functions/lms-dashboard/profile-css-js.php";
 require_once get_template_directory()."/custom_functions/lms-dashboard/sidebar-menu-links.php";
 require_once get_template_directory()."/custom_functions/lms-dashboard/junior-instructors.php";

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'    => 'Theme General Settings',
		'menu_title'    => 'Theme Options',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'theme-general-settings',
	));
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function FHRC_LMS_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on FHRC_LMS, use a find and replace
		* to change 'FHRC_LMS' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('FHRC_LMS', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'FHRC_LMS'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'FHRC_LMS_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'FHRC_LMS_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function FHRC_LMS_content_width()
{
	$GLOBALS['content_width'] = apply_filters('FHRC_LMS_content_width', 640);
}
add_action('after_setup_theme', 'FHRC_LMS_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function FHRC_LMS_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Donation', 'FHRC_LMS'),
			'id'            => 'donation',
			'description'   => esc_html__('Add widgets here.', 'FHRC_LMS'),
			'before_widget' => '<div class="card-body">',
			'after_widget'  => '</div>',
			'before_title'  => ' <h5 class="card-title">',
			'after_title'   => '</h5>',
		)
	);
}
add_action('widgets_init', 'FHRC_LMS_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function FHRC_LMS_scripts()
{

	wp_enqueue_style('font-awesome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2');
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2');
	wp_enqueue_style('FHRC_LMS-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('FHRC_LMS-style', 'rtl', 'replace');

	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '5.0.2', true);
	wp_enqueue_script('FHRC_LMS-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/js/custom.js');


	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action('wp_enqueue_scripts', 'FHRC_LMS_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Filter to remove default Paragrapg Tags
add_filter('wpcf7_autop_or_not', '__return_false');


$current_user = wp_get_current_user();
$current_id = $current_user->ID;

function customize_comment_avatar($avatar, $id_or_email, $size, $default, $alt)
{

	if (is_object($id_or_email) && isset($id_or_email->comment_ID)) {

		$comment = $id_or_email;


		if (!empty($comment->comment_author_email)) {

			$avatar_image = get_avatar($comment->comment_author_email, $size);

			$author_name = get_comment_author($comment);

			$avatar = '<div class="comment-author-avatar">' . $avatar_image . '</div>';
			$avatar .= '<div class="comment-author-name">' . $author_name . '</div>';
		}
	}

	return $avatar;
}
add_filter('get_avatar', 'customize_comment_avatar', 10, 5);

// Code For Ticketing Module
add_action('wpcf7_before_send_mail', 'save_my_form_data_to_my_cpt', 1, 3);
function save_my_form_data_to_my_cpt($contact_form)
{
	global $current_id;

	$contact_form = WPCF7_ContactForm::get_current();
	$contact_form_id = $contact_form->id;

	$submission = WPCF7_Submission::get_instance();
	if (!$submission) {
		return $contact_form;
	}
	$posted_data = $submission->get_posted_data();

	$new_post = array();

	$new_post['post_type'] = 'form-submission';

	$new_post['post_status'] = 'publish';

	if (isset($posted_data['subjectfield']) && !empty($posted_data['subjectfield'])) {
		$new_post['post_title'] = $posted_data['subjectfield'];
	} else {
		$new_post['post_title'] = '';
	}

	if (isset($posted_data['description']) && !empty($posted_data['description'])) {
		$new_post['post_content'] = $posted_data['description'];
	} else {
		$new_post['post_content'] = '';
	}


	$new_post['post_author'] = $current_id;


	if ($post_id = wp_insert_post($new_post)) {

		// Update ACF field with current user ID
		update_field('current_user_id', $current_id, $post_id);


		$uploadedFiles = $submission->uploaded_files();

		if (!empty($uploadedFiles['attachmentfile'])) {
			foreach ($uploadedFiles['attachmentfile'] as $file_path) {

				$file = file_get_contents($file_path);
				$image_name = basename($file_path);
				$imageUpload = wp_upload_bits(basename($file_path), null, $file);

				require_once(ABSPATH . 'wp-admin/includes/admin.php');

				$filename = $imageUpload['file'];
				$attachment = array(
					'post_mime_type' => $imageUpload['type'],
					'post_parent' => $post_id,
					'post_title' => $posted_data['field_title'] . ' - ' .
						$posted_data['field_contributor'],
					'post_content' => $posted_data['field_info'],
					'post_status' => 'inherit'
				);

				$attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
				if (!is_wp_error($attachment_id)) {
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					$attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);

					wp_update_attachment_metadata($attachment_id, $attachment_data);
					set_post_thumbnail($post_id, $attachment_id);

					update_field('ad_image', $attachment_id, $post_id);
				}
			}
		}
	}
}

function enqueue_custom_scripts()
{
	// Enqueue the first AJAX script
	wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/js/calendar-ajax.js', array('jquery'), null, true);
	wp_localize_script('custom-ajax', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	// Enqueue the first AJAX script
	wp_enqueue_script('custom-ajax-two', get_template_directory_uri() . '/js/custom-ajax.js', array('jquery'), '1.1.0', true);
	wp_localize_script('custom-ajax-two', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode)
{

	$args = array(
		'post_type' => 'tribe_venue',
		'meta_query' => array(
			array(
				'key' => '_VenueZip',
				'value' => $selected_zipcode,
				'compare' => '=',
			)
		)
	);

	$venues_query = new WP_Query($args);

	$venue_ids = array();

	if ($venues_query->have_posts()) {
		while ($venues_query->have_posts()) {
			$venues_query->the_post();
			$venue_ids[] = get_the_ID();
		}
		wp_reset_postdata();
	}

	$formatted_datetime = $selected_datepicker . ' ' . $selected_timepicker;

	if (!empty($venue_ids)) {

		$meta_query = array();

		if (!empty($selected_datepicker) && !empty($selected_timepicker)) {

			$venueeventquery = array(
				'relation' => 'AND',
				array(
					'key' => '_EventVenueID',
					'value' => $venue_ids,
					'compare' => 'IN',
					'type' => 'NUMERIC'
				),
				array(
					'key'     => '_EventStartDate',
					'value'   => $formatted_datetime,
					'compare' => '=',
					'type'    => 'DATETIME',
				)
			);

			array_push($meta_query, $venueeventquery);

		} else if (empty($selected_datepicker) && !empty($selected_timepicker)) {;

			$venueeventquerytwo = array(
				'relation' => 'AND',
				array(
					'key' => '_EventVenueID',
					'value' => $venue_ids,
					'compare' => 'IN',
					'type' => 'NUMERIC'
				),
				array(
					'key'     => '_EventStartDate',
					'value'   => $selected_timepicker,
					'compare' => '=',
					'type'    => 'TIME',
				)
			);

			array_push($meta_query, $venueeventquerytwo);

		} else if(!empty($selected_datepicker) && empty($selected_timepicker)){

			$venueeventquerytwo = array(
				'relation' => 'AND',
				array(
					'key' => '_EventVenueID',
					'value' => $venue_ids,
					'compare' => 'IN',
					'type' => 'NUMERIC'
				),
				array(
					'key'     => '_EventStartDate',
					'value'   => $selected_datepicker,
					'compare' => '=',
					'type'    => 'DATE',
				)
			);

			array_push($meta_query, $venueeventquerytwo);

		}

		return $meta_query;

	} else if (empty($venue_ids)) {

		$meta_query = array();

		if (!empty($selected_datepicker)) {

			$date_query = array(
				'key'     => '_EventStartDate',
				'value'   => $selected_datepicker,
				'compare' => '=',
				'type'    => 'DATE',
			);
			array_push($meta_query, $date_query);
		}

		if (!empty($selected_timepicker)) {

			$time_query = array(
				'key'     => '_EventStartDate',
				'value'   => $selected_timepicker,
				'compare' => '=',
				'type'    => 'TIME',
			);
			array_push($meta_query, $time_query);
		}

		if (!empty($selected_datepicker) && !empty($selected_timepicker)) {

			$time_date_querry = array(
				'key'     => '_EventStartDate',
				'value'   => $formatted_datetime,
				'compare' => '=',
				'type'    => 'DATETIME',
			);
			array_push($meta_query, $time_date_querry);
		}

		if (!empty($selected_datepicker) && !empty($selected_timepicker) && !empty($selected_zipcode)) {

			$meta_query = '';
			return $meta_query;
		}

		if (empty($selected_datepicker) && empty($selected_timepicker) && !empty($selected_zipcode)) {

			$meta_query = '';
			return $meta_query;
		}

		if (empty($selected_datepicker) && !empty($selected_timepicker) && !empty($selected_zipcode)) {

			$meta_query = '';
			return $meta_query;
		}

		if (!empty($selected_datepicker) && empty($selected_timepicker) && !empty($selected_zipcode)) {

			$meta_query = '';
			return $meta_query;
		}

		return $meta_query;
	} else {

		$meta_query = '';
		return $meta_query;
	}
}

add_action('wp_ajax_nopriv_get_events_by_date', 'get_events_by_date');
add_action('wp_ajax_get_events_by_date', 'get_events_by_date');


function get_events_by_date()
{

	$selected_datepicker = $_POST['selected_datepicker'];
	$selected_timepicker = $_POST['selected_timepicker'];
	$selected_zipcode = $_POST['selected_zipcode'];

	if ($selected_datepicker && $selected_timepicker && $selected_zipcode) {

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		if ($meta_query_date == "") {
			$query = events_query($meta_query_date, true);
		} else {
			$query = events_query($meta_query_date);
		}

	} else if ($selected_datepicker && empty($selected_timepicker) && empty($selected_zipcode)) {

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		$query = events_query($meta_query_date);

	} else if (empty($selected_datepicker) && $selected_timepicker && empty($selected_zipcode)) {

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		$query = events_query($meta_query_date);
	} else if ($selected_datepicker && $selected_timepicker && empty($selected_zipcode)) {
	

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		$query = events_query($meta_query_date);
	} else if (empty($selected_datepicker) && empty($selected_timepicker) && $selected_zipcode) {
		

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		if ($meta_query_date == "") {
			$query = events_query($meta_query_date, true);
		} else {
			$query = events_query($meta_query_date);
		}
	} else if ($selected_datepicker && empty($selected_timepicker) && $selected_zipcode) {
		

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		if ($meta_query_date == "") {
			$query = events_query($meta_query_date, true);
		} else {
			$query = events_query($meta_query_date);
		}
	} else if (empty($selected_datepicker) && $selected_timepicker && $selected_zipcode) {
		

		$meta_query_date = get_events_venue_ids($selected_datepicker, $selected_timepicker, $selected_zipcode);
		if ($meta_query_date == "") {
			$query = events_query($meta_query_date, true);
		} else {
			$query = events_query($meta_query_date);
		}
	} else {

		$query = events_query();
	}

	$events_data = array();


	if ($query->have_posts()) {
		while ($query->have_posts()) {

			$query->the_post();

			$post_id = get_the_ID();
			$title = get_the_title($post_id);
			$image = get_the_post_thumbnail();
			$event_date = tribe_get_start_date($post_id, true, 'Y-m-d H:i:s');
			$formatted_date = date('d-F-y', strtotime($event_date));
			$event_url = get_permalink($post_id);
			$event_time = tribe_get_start_time($post_id, 'F j \@ g:i a');

			$event_data = array(
				'post_id'         => $post_id,
				'title'           => $title,
				'image'           => $image,
				'formatted_date'  => $formatted_date,
				'event_time'      => $event_time,
				'event_url'  	  => $event_url,
			);

			$events_data[] = $event_data;
		}

		wp_reset_postdata();

		$page = $_POST['page'];

		$total = $query->max_num_pages;

		$pagination = paginate_links(array(
			'total' => $total,
			'current' => $page,
		));

		$combined_data = array(
			'creating_events_html' => $events_data,
			'pagination'           => $pagination,
		);

		wp_send_json_success($combined_data);
	} else {

		wp_send_json_error('No events found for the selected date');
	}
}

function events_query($meta_query_date = null, $onlyCountryFlag = false)
{
	if ($meta_query_date != '' && $onlyCountryFlag == false) {

		$page = $_POST['page'];

		$args = array(
			'post_type'      => 'tribe_events',
			'posts_per_page' => 8,
			'paged'          => $page,
			'meta_query'     => array(
				'relation' => 'AND',
				$meta_query_date,
			),
		);

		$query = new WP_Query($args);
	} else {

		if ($onlyCountryFlag) {
			$args = array();
		} else {
			$page = $_POST['page'];
			$args = array(
				'post_type'      => 'tribe_events',
				'posts_per_page' => 8,
				'paged'          => $page,
			);
		}

		$query = new WP_Query($args);
	}


	return $query;
}


add_action('wp_ajax_nopriv_get_calendar_events', 'get_calendar_events');
add_action('wp_ajax_get_calendar_events', 'get_calendar_events');

function get_calendar_events()
{

	$page = $_POST['page'];
	$selected_date = $_POST['selected_date'];

	$meta_query_date = array(
		'key'     => '_EventStartDate',
		'value'   => date('Y-m-d', strtotime($selected_date)),
		'compare' => '=',
		'type'    => 'DATE',
	);

	$calendarArgs = array(
		'post_type'      => 'tribe_events',
		'posts_per_page' => 4,
		'paged'          => $page,
		'meta_query'     => array($meta_query_date),
	);

	$query = new WP_Query($calendarArgs);

	if ($query->have_posts()) {
		$events_data = array();

		while ($query->have_posts()) {
			$query->the_post();

			$post_id = get_the_ID();
			$title = get_the_title($post_id);
			$image = get_the_post_thumbnail($post_id);
			$event_date = tribe_get_start_date($post_id, true, 'Y-m-d H:i:s');
			$formatted_date = date('d-F-y', strtotime($event_date));
			$event_url = get_permalink($post_id);
			$event_time = tribe_get_start_time($post_id, 'F j \@ g:i a');

			$event_data = array(
				'post_id'         => $post_id,
				'title'           => $title,
				'image'           => $image,
				'formatted_date'  => $formatted_date,
				'event_time'      => $event_time,
				'event_url'       => $event_url,
			);

			$events_data[] = $event_data;
		}

		wp_reset_postdata();

		$total = $query->max_num_pages;

		$pagination = paginate_links(array(
			'total'      => $total,
			'current'    => $page
		));

		$combined_data = array(
			'creating_events_html_data' => $events_data,
			'pagination'           => $pagination,
		);

		wp_send_json_success($combined_data);
	} else {
		wp_send_json_error('No events found for the selected date');
	}
}
