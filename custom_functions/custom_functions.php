<?php
	add_filter('tutor_dashboard/nav_items', 'remove_some_links_dashboard');
	function remove_some_links_dashboard($links){
		unset($links['reviews']);
		// unset($links['enrolled-courses']);
		unset($links['my-quiz-attempts']);
		unset($links['purchase_history']);
		unset($links['question-answer']);
		unset($links['calendar']);
		return $links;
	}

	add_filter('tutor_dashboard/instructor_nav_items', 'remove_some_links');
	function remove_some_links($links) {
		unset($links['reviews']);
		unset($links['assignments']);
		unset($links['withdraw']);
		unset($links['quiz-attempts']);
		unset($links['calendar']);
		//unset($links['announcements']);
		unset($links['analytics']); 
		return $links;
	}

	add_filter('tutor_dashboard/nav_items', 'add_some_links_dashboard');
	function add_some_links_dashboard($links){

		$links['custom_link'] = [
			"title" =>	__('Help Request', 'tutor'),
			"url" => "/help-request-form",
			"icon" => "tutor-icon-question",

		];
		return $links;
	}

	add_filter('tutor_dashboard/instructor_nav_items', 'add_some_links_to_instructor_dashboard');
	function add_some_links_to_instructor_dashboard($links) {
			$is_instructor = current_user_can('tutor_instructor');
			if ($is_instructor){
			    $links['custom_link_courses_detail'] = [
			        "title" => __('Course Analytics', 'tutor'),
			        "url" => "/dashboard/analytics/courses/",
			        "icon" => "tutor-icon-book"
			    ];
			}
		    return $links;
		}
		// saving help request form data start here--------------------------------------------
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		    // Sanitize and validate form data
		    $email_address = filter_var(($_POST['email_address']??''), FILTER_VALIDATE_EMAIL);
		    $req_subject = sanitize_text_field($_POST['req_subject']);
		    $req_description = sanitize_textarea_field($_POST['req_description']);
		    
		    // Get current user ID
    		$current_user_id = get_current_user_id();
		    // Check if the title already exists for the current user
		    $existing_post = get_posts(array(
		        'post_type'      => 'helpdesk-support',
		        'title'     => $req_subject,
		        'author'         => $current_user_id,
		        'posts_per_page' => 1,
		        'fields'         => 'ids',
		        // 'compare' => 'and'
		    ));
// print_r($req_subject);
// print_r($existing_post);exit();
// print_r($_FILES['attachments']['name']);exit();
		    if (empty($existing_post)) {
			    // Validate email address
			    if (!$email_address) {
			    	// $_SESSION['email_address_error'] = 'Please enter a valid email address.';
			    	set_transient( 'email_address_error', 'Please enter a valid email address.');
			    }

			    // Validate title and content
			    if (empty($req_subject)) {
			        // $_SESSION['req_subject_error'] = 'Please enter a title.';
			        set_transient( 'req_subject_error', 'Please enter a title.');
			    }

			    if (empty($req_description)) {
			        // $_SESSION['req_description_error'] = 'Please enter description.';
			        set_transient( 'req_description_error', 'Please enter description.');
			    }

			    // Handle file uploads
			    if (is_array($_FILES['attachments']['name'][0]) && !empty($_FILES['attachments']['name'][0])) {
			    	// echo "if";exit;
			        $attachments = $_FILES['attachments'];
			        $upload_files = array();

			        foreach ($attachments['name'] as $key => $attachment_name) {
			            // Validate file type (JPG or PNG)
			            $file_extension = strtolower(pathinfo($attachment_name, PATHINFO_EXTENSION));
			            if (!in_array($file_extension, array('jpg', 'jpeg', 'png'))) {
			                // $_SESSION['attachment_error'] = 'Only JPG and PNG files are allowed.';
			                set_transient( 'attachment_error', 'Only JPG and PNG files are allowed.');
			                break; // Exit loop if error found
			            }

			            // Validate file size (limit to 5MB)
			            $max_file_size = 5 * 1024 * 1024; // 5MB in bytes
			            if ($attachments['size'][$key] > $max_file_size) {
			                // $_SESSION['attachment_error'] = 'File size exceeds the maximum limit of 5MB.';
			                set_transient( 'attachment_error', 'File size exceeds the maximum limit of 5MB.');
			                break; // Exit loop if error found
			            }
			        }
			    }
// echo empty(get_transient( 'req_subject_error' )) ;
// echo empty(get_transient( 'req_description_error' )) ;
// echo empty(get_transient( 'attachment_error' )) ;
			    // Proceed if there are no errors
			    if (empty(get_transient( 'req_subject_error' )) && empty(get_transient( 'req_description_error' )) && empty(get_transient( 'attachment_error' ))) {
			        // Create post object
			        $new_post = array(
			            'post_title'    => $req_subject,
			            'post_content'  => $req_description,
			            'post_type'     => 'helpdesk-support', // Change to your custom post type
			            'post_status'   => 'publish'
			        );

			        // Insert the post into the database
			        $post_id = wp_insert_post($new_post);

			        // Check if post was successfully created
			        if ($post_id) {
			            // Handle file uploads (again) and attach files to the post
			            if (is_array($_FILES['attachments']['name'][0]) && !empty($_FILES['attachments']['name'][0])) {
				            foreach ($attachments['name'] as $key => $attachment_name) {
				                $file = array(
				                    'name'     => $attachment_name,
				                    'type'     => $attachments['type'][$key],
				                    'tmp_name' => $attachments['tmp_name'][$key],
				                    'error'    => $attachments['error'][$key],
				                    'size'     => $attachments['size'][$key]
				                );

				                $upload_file = wp_handle_upload($file, array('test_form' => false));
				                if (!isset($upload_file['error'])) {
				                    $attachment = array(
				                        'post_title'     => $attachment_name,
				                        'post_content'   => '',
				                        'post_type'      => 'attachment',
				                        'post_parent'    => $post_id,
				                        'post_mime_type' => $upload_file['type']
				                    );

				                    $attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $post_id);

				                    if (!is_wp_error($attachment_id)) {
				                        require_once(ABSPATH . 'wp-admin/includes/image.php');
				                        $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
				                        wp_update_attachment_metadata($attachment_id, $attachment_data);
				                        $upload_files[] = $attachment_id;
				                    }
				                }
				            }

				            // Update post meta with attachment IDs
				            if (!empty($upload_files)) {
				                update_post_meta($post_id, 'req_attachments', $upload_files);
				            }
				        }
						// if (isset($_POST['curr_user_id'])) {
					    // 	$curr_user_id = sanitize_textarea_field($_POST['curr_user_id']);
					    // 	update_post_meta($post_id, 'req_user_id', $curr_user_id);
					    // }

					    if ($email_address) {
					        $curr_user_email_address = sanitize_textarea_field($_POST['email_address']);
					    	update_post_meta($post_id, 'req_email_address', $curr_user_email_address);
					    }
					    set_transient( 'post_inserted_success', 1);
			            // wp_redirect(home_url('/thank-you')); // Redirect to a "thank you" page
	    				// exit; // Make sure to exit after redirecting
			        } else {
			            set_transient( 'something_went_error', 'Somthing went wrong! Try again.');
			    		set_transient( 'req_subject_old', $req_subject);
			    		set_transient( 'req_description_old', $req_description);
			        }
			    } else {
			    	set_transient( 'req_subject_old', $req_subject);
			    	set_transient( 'req_description_old', $req_description);
			    }
		    } else {
		    	// Title already exists for the current user
        		// $_SESSION['req_subject_unique_error'] = 'Subject must be unique.';
        		set_transient( 'req_subject_unique_error', 'Subject must be unique.');
        		set_transient( 'req_subject_old', $req_subject);
        		set_transient( 'req_description_old', $req_description);
		    }
		}
		// saving help request form data end here----------------------------------------------

		//showing help request meta fields at admin column start here---------------------------------------
		// Add custom columns to the post list table
		function custom_post_columns($columns) {
		    // Add columns for user name, email, and images
		    // $columns['user_name'] = 'User Name';
		    // $columns['user_email'] = 'User Email';
		    $columns['attached_images'] = 'Attached Images';
		    return $columns;
		}
		add_filter('manage_helpdesk-support_posts_columns', 'custom_post_columns');

		// Populate custom column data
		function custom_post_column_data($column, $post_id) {
		    switch ($column) {
		        // case 'user_name':
		        //     // Get user name based on req_user_id meta
		        //     $user_id = get_post_meta($post_id, 'req_user_id', true);
		        //     $user_info = get_userdata($user_id);
		        //     echo $user_info ? $user_info->display_name : 'N/A';
		        //     break;
		        // case 'user_email':
		        //     // Get user email based on req_user_id meta
		        //     $user_id = get_post_meta($post_id, 'req_user_id', true);
		        //     $user_info = get_userdata($user_id);
		        //     echo $user_info ? $user_info->user_email : 'N/A';
		        //     break;
		        case 'attached_images':
		            // Get attached images
		            $attachments = get_post_meta($post_id, 'req_attachments', true);
		            if (!empty($attachments)) {
		                foreach ($attachments as $attachment_id) {
		                    $attachment_url = wp_get_attachment_url($attachment_id);
		                    echo '<a href="'.esc_url($attachment_url).'" target="_blank" class="image-link"><img src="' . esc_url($attachment_url) . '" style="max-width: 50px;" /></a>';
		                }
		            } else {
		                echo 'No images attached';
		            }
		            break;
		    }
		}
		add_action('manage_helpdesk-support_posts_custom_column', 'custom_post_column_data', 10, 2);
		//showing help request meta fields at admin column END here--------------------------------------------

		//showing help request meta fields at admin post detail page start here--------------------------------
		// Add meta box to display user information and attached images
		function custom_meta_box() {
		    add_meta_box(
		        'custom-meta-box',
		        'Attached Files',
		        'custom_meta_box_callback',
		        'helpdesk-support',
		        'normal',
		        'high'
		    );
		}
		add_action('add_meta_boxes', 'custom_meta_box');

		// Callback function to render the meta box content
		function custom_meta_box_callback($post) {
		    // // Retrieve user information
		    // $user_id = get_post_meta($post->ID, 'req_user_id', true);
		    // $user_info = get_userdata($user_id);
		    
		    // Retrieve attached images
		    $attachments = get_post_meta($post->ID, 'req_attachments', true);
		    ?>

		    <div class="custom-meta-box">
		       <!--  <p><strong>User Name:</strong> <?php // echo $user_info ? $user_info->display_name : 'N/A'; ?></p>
		        <p><strong>User Email:</strong> <?php // echo $user_info ? $user_info->user_email : 'N/A'; ?></p> -->

		        <!-- <p><strong>Attached Images:</strong></p> -->
		        <div class="attached-images">
		            <?php if (!empty($attachments)) : ?>
		                <?php foreach ($attachments as $attachment_id) : ?>
		                    <?php $attachment_url = wp_get_attachment_url($attachment_id); ?>
		                    <img style="padding-right: 3px;" src="<?php echo esc_url($attachment_url); ?>" style="max-width: 200px; margin-bottom: 10px;" />
		                <?php endforeach; ?>
		            <?php else : ?>
		                <p>No images attached.</p>
		            <?php endif; ?>
		        </div>
		    </div>

		    <?php
		}
		//showing help request meta fields at admin post detail page END here--------------------------------

		// // admin help request post type column ordering START------------------------------------------------
		// // Modify columns for the custom post type
		// function custom_post_type_columns($columns) {
		//     // Remove the default date column
		//     unset($columns['date']);

		//     // Add the date column at the end
		//     $columns['date'] = __('Date');

		//     return $columns;
		// }
		// add_filter('manage_edit-helpdesk-support_columns', 'custom_post_type_columns');

		// // Modify the column order
		// function custom_column_order($columns) {
		//     $date = $columns['date']; // Get the date column
		//     unset($columns['date']); // Remove the date column
		//     $columns['date'] = $date; // Add the date column back at the end
		//     return $columns;
		// }
		// add_filter('manage_edit-helpdesk-support_sortable_columns', 'custom_column_order');
		// // admin help request post type column ordering END----------------------------------------------------


		add_action('template_redirect', 'redirect_to_login_if_not_logged_in');
		function redirect_to_login_if_not_logged_in() {
		    // Check if user is not logged in
		    if (!is_user_logged_in() && is_page('help-request-form')) {
		        // Redirect to login page
		        wp_redirect(home_url());
		        exit;
		    }
		}


// ======================= theme options menu start =====================


add_action("admin_menu","mythemeoptions");

function mythemeoptions(){
	// adding menu page here
	add_menu_page( "theme-options",
	 	"Theme Options",
	  	"manage_options",
	   	"theme-options",
	    "mycustom_options",
		"dashicons-admin-appearance"
	);
}

function mycustom_options(){
	//  linking our custom settings
	?>
	<h1>Theme Settings Page</h1>
	<span>
		<?php settings_errors()?>
	</span>
	<form action="options.php" method="POST">
		<?php 
		settings_fields( "section" );
		do_settings_sections("theme-options");
		submit_button();
		?>
	</form>
	<?php

}

function theme_option_setting() {
	// step1 this code basically provides an area where you register your fields
	add_settings_section( "section",
	 	"",
	  	NULL,
		"theme-options" );

		#step2 part 1
	
	add_settings_field( 
		"headerTextColor",
		"Navbar Text & button Text Color",
		"display_header_text_color",
		"theme-options",
		"section"
	);		
	add_settings_field( 
		"headerTextColorHover",
		"Navbar Text Hover & Button Background Color",
		"display_header_text_color_hover",
		"theme-options",
		"section"
	);	
	add_settings_field( 
		"headerBtnCTA",
		"Navbar Button Link",
		"display_headerBtnCTA",
		"theme-options",
		"section"
	);	

		#step2 part 2
	add_settings_field( 
		"footerLogoUrl",
	 	"Logo Url",
	  	"display_footerLogo_url",
	 	"theme-options",
	  	"section"
	);	
	add_settings_field( 
		"fbUrl",
	 	"Facebook Url",
	  	"display_fb_url",
	 	"theme-options",
	  	"section"
	);	

	add_settings_field( 
		"youTubeUrl",
	 	"YouTube Url",
	  	"display_youtube_url",
	 	"theme-options",
	  	"section"
	);	
	add_settings_field( 
		"twitterUrl",
	 	"Twitter Url",
	  	"display_twitter_url",
	 	"theme-options",
	  	"section"
	);	

	add_settings_field( 
		"instagramUrl",
	 	"Instagram Url",
	  	"display_instagram_url",
	 	"theme-options",
	  	"section"
	);	


	add_settings_field( 
		"copyRightText",
	 	"Copyright Text",
	  	"display_copyRightText",
	 	"theme-options",
	  	"section"
	);	

	add_settings_field( 
		"themecolorPicker",
	 	"Navbar and Footer Color",
	  	"display_theme_color",
	 	"theme-options",
	  	"section"
	);	



// step3 we need to add this setting to area
	register_setting( "section","headerTextColor");
	register_setting( "section","headerTextColorHover");
	register_setting( "section","headerBtnCTA");
	register_setting( "section","footerLogoUrl");
	register_setting( "section","fbUrl");
	register_setting( "section","youTubeUrl"); 
	register_setting( "section","twitterUrl"); 
	register_setting( "section","instagramUrl"); 
	register_setting( "section","copyRightText"); 
	register_setting( "section","themecolorPicker"); 
}

add_action( "admin_init", "theme_option_setting");

function display_header_text_color(){
	?>
	<input type="color" name="headerTextColor" value="<?php echo get_option( "headerTextColor")?>" id="headerTextColor">
	<?php
}

function display_header_text_color_hover(){
	?>
	<input type="color" name="headerTextColorHover" value="<?php echo get_option( "headerTextColorHover")?>" id="headerTextColorHover">
	<?php
}

function display_headerBtnCTA(){
	?>
	<input type="text" name="headerBtnCTA" id="headerBtnCTA" value="<?php echo get_option( "headerBtnCTA")?>">
	<?php
}

function display_footerLogo_url(){
	?>
	<input type="text" name="footerLogoUrl" id="footerLogoUrl" value="<?php echo get_option( "footerLogoUrl")?>">
	<?php
}

function display_fb_url(){
	?>
	<input type="text" name="fbUrl" id="fbUrl" value="<?php echo get_option( "fbUrl")?>">
	<?php
}

function display_youtube_url(){
	?>
	<input type="text" name="youTubeUrl" id="youTubeUrl" value="<?php echo get_option( "youTubeUrl")?>">
	<?php
}


function display_twitter_url(){
	?>
	<input type="text" name="twitterUrl" id="twitterUrl" value="<?php echo get_option( "twitterUrl")?>">
	<?php
}


function display_instagram_url(){
	?>
	<input type="text" name="instagramUrl" id="instagramUrl" value="<?php echo get_option( "instagramUrl")?>">
	<?php
}

function display_copyRightText(){
	?>
	<input type="text" name="copyRightText" id="copyRightText" value="<?php echo get_option( "copyRightText")?>">
	<?php
}

function display_theme_color(){
	?>
	<input type="color" name="themecolorPicker" value="<?php echo get_option( "themecolorPicker")?>" id="themecolorPicker">

	<?php
}


// ======================= theme options menu end =====================

function my_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf_json';
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );



function convertHoursToMonthsWeeksDays($hours, $minutes, $seconds) {
    // Convert total seconds to total hours
    $totalHours = $hours + ($minutes / 60) + ($seconds / 3600);

    // Define workday and workweek hours
    $workdayHours = 8;
    $workweekHours = 40;

    // Calculate total workdays
    $totalWorkdays = $totalHours / $workdayHours;

    // Calculate total workweeks
    $totalWorkweeks = $totalHours / $workweekHours;

    // Calculate months, weeks, and days
    $months = floor($totalWorkdays / 20);  // Assuming 20 workdays in a month
    $remainingDays = $totalWorkdays % 20;

    $weeks = floor($remainingDays / 5);
    $days = $remainingDays % 5;

    return array(
        'months' => $months,
        'weeks' => $weeks,
        'days' => $days,
    );
}

// // Example usage
// $duration = convertHoursToMonthsWeeksDays(160, 30, 0); // 160 hours, 30 minutes
// print_r($duration);


// CODE FOR ALLOW SVG FILE TYPE
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }
    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action( 'admin_head', 'fix_svg' );


//enqueuing style to admin side, admin side css changes
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
    wp_enqueue_style( 'admin_css_side_bar', get_template_directory_uri() . '/assets/css/admin-side-style.css', false, '1.0.0' );
}

function my_login_stylesheet() {
    wp_enqueue_style( 'admin_login_css_side_bar', get_template_directory_uri() . '/assets/css/admin-side-style.css', false, rand(1,5).'.'.rand(1,7).'.'.rand(1,9) );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

add_filter( 'tutor_preferred_video_sources', 'customize_video_source_titles', 10, 1 );
function customize_video_source_titles( $video_sources ) {
	// Modify the titles as needed
	$video_sources['html5']['title'] = __( 'Upload Your Video', 'your-text-domain' );
	// Add or modify other video source titles as necessary

	return $video_sources;
}

add_filter(
    'tribe_events_views_v2_show_latest_past_events_view',
    function( $show, $view_slug, $view_object ) {
        return false;
    },
    10,
    3
);

	function check_server_uri_string($target_strings) {
	    // Get the current URI
	    $current_uri = $_SERVER['REQUEST_URI'];

	    // Loop through the target strings to check if any of them is in the URI
	    foreach ($target_strings as $string) {
	        if (strpos($current_uri, $string) !== false) {
	            // If the string is found, return 'active' class
	            return 'active';
	        }
	    }

	    // Return empty string if no target string is found in the URI
	    return '';
	}

	add_action( 'init', 'add_active_class' );
	function add_active_class(){
		$check_str = ['dashboard/analytics'];
		if (check_server_uri_string($check_str) == 'active') {
			?>
			<script>
				document.addEventListener('DOMContentLoaded', function() {
				    // Select all elements with the class and add 'active' to their class lists
				    var elements = document.querySelectorAll('.tutor-dashboard-menu-custom_link_courses_detail');
				    elements.forEach(function(element) {
				        element.classList.add('active');
				    });
				});
			</script>
			<?php
		}
	}

	// Define a function to send email notification when course is completed
	function send_course_completion_email_to_student( $course_id, $student_id ) {
	    // Get student email
	    $student_email = get_userdata( $student_id )->user_email;

	    // Get course title
	    $course_title = get_the_title( $course_id );

	    // Prepare email subject and message
	    $subject = 'Congratulations! You have completed the course: ' . $course_title;
	    $message = 'Dear Student,<br><br>';
	    $message .= 'Congratulations! You have successfully completed the course: <strong>' . $course_title . '</strong>.<br><br>';
	    $message .= 'Thank you for your dedication and hard work.<br><br>';
	    $message .= 'Best regards,<br>';
	    $message .= 'Your Course Instructor';

	    // Set email headers to send as plain text
	    $headers = array(
	        'Content-Type: text/plain; charset=UTF-8',
	    );

	    // Send email
	    wp_mail( $student_email, $subject, $message, $headers );
	}
	add_action( 'tutor_course_complete_after', 'send_course_completion_email_to_student', 10, 2 );



	function get_course_categories() {
	    $args = array(
	        'taxonomy'   => 'course-category',
	        'post_type'  => 'courses',
	        'hide_empty' => false, // Set to true if you only want terms that are assigned to courses
	    );

	    $terms = get_terms($args);

	    return $terms;
	}

	// Add this shortcode to display course categories wherever needed
	add_shortcode('course_categories', 'get_course_categories');

?>