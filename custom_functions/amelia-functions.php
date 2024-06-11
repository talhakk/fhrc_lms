<?php
/**
 * Require Amelia Booking Plugin on Theme Activation
 */
function check_amelia_plugin() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (!is_plugin_active('ameliabooking/ameliabooking.php')) {
        add_action('admin_notices', 'amelia_plugin_notice');
    }
}
add_action('after_switch_theme', 'check_amelia_plugin');

function amelia_plugin_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php _e('This theme requires the Amelia booking plugin to be installed and activated.', 'FreedomHouseLMS'); ?></p>
    </div>
    <?php
}
/**
 * Create Amelia & Tutor LMS integration Table (wp_amelia_lms_integrate)
 */
function create_amelia_lms_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'amelia_lms_integrate';
    
    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        // SQL to create the table
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            course_id int(11) NOT NULL,
            amelia_tag longtext NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        // Include the WordPress upgrade file to get dbDelta function
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_switch_theme', 'create_amelia_lms_table');

/**
 * Change amelia event booking data view on single product pages.
 */
function ameliaeventslistbooking_shortcode_change_view($events) {
    foreach ($events as &$event) {
        if (!isset($event['locationId']) && !isset($event['location']) && !isset($event['customLocation'])) {
            // Append 'Virtual' to the event name
            $event['name'] .= ' Virtual Class';
        }
    }
    return $events;
}
// to perform an action on above
//add_action('amelia_get_events', 'ameliaeventslistbooking_shortcode_change_view', 10, 1);
add_filter('amelia_get_events_filter', 'ameliaeventslistbooking_shortcode_change_view', 10, 1);

/**
 * Modify Amelia Event CSV Template
 */
function modify_amelia_csv_event_export($row, $event, $separate)
{
    global $wpdb;

    // Add event details as new columns in the row
    $row['Class Name'] = $event['name'];
    
    // Retrieve the organizer's name using the organizerId
    $organizer_id = $event['organizerId'];

    // Query the wp_amelia_users table to get the organizer's details
    $organizer = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT firstName, lastName FROM wp_amelia_users WHERE id = %d",
            $organizer_id
        )
    );

    // Check if the organizer exists and combine first and last names
    if ($organizer) {
        $organizer_name = $organizer->firstName . ' ' . $organizer->lastName;
        $row['Organizer Name'] = $organizer_name;
    } else {
        $row['Organizer Name'] = 'N/A'; // Default value if no organizer found
    }
    
    // Retrieve event start and end times from the periods array
    if (!empty($event['periods'])) {
        $row['Class Start Time'] = $event['periods'][0]['periodStart'];
        $row['Class End Time'] = $event['periods'][0]['periodEnd'];
    } else {
        $row['Class Start Time'] = '';
        $row['Class End Time'] = '';
    }
    $row['Attended whole training?  Y/N'] = '';
    $row['Date certificate emailed'] = '';

     // if class is free change labels for Payment Method and Status
     if (isset($row['Payment Method']) && $row['Payment Amount'] === '$0.00') {
        $row['Payment Method'] = 'none';
        if (isset($row['Payment Status'])){
            $row['Payment Status'] = 'none';
        }
    }

    return $row;
}

add_filter('amelia_before_csv_export_event', 'modify_amelia_csv_event_export', 10, 3);

/**
 * Enroll in Course 
 */
function course_enroll_by_event_booking($appointment)
{
    global $wpdb;
    // Extract event ID
    $eventId = $appointment['event']['id'];
    $table_name = $wpdb->prefix . 'amelia_events_tags';
    // Query to get the amelia_tag for the current course
    $amelia_tag_name = $wpdb->get_var($wpdb->prepare(
        "SELECT name FROM $table_name WHERE eventId = %d",
        $eventId
    ));
    $table_name_2 = $wpdb->prefix . 'amelia_lms_integrate';
    // Query to get the amelia_tag for the current course
    $course_id = $wpdb->get_var($wpdb->prepare(
        "SELECT course_id FROM $table_name_2 WHERE amelia_tag = %s",
        $amelia_tag_name
    ));
    $current_user_id = get_current_user_id();
    $is_enrolled = tutor_utils()->is_enrolled( $course_id, $current_user_id );
    if ($is_enrolled) {
        $enrollment_result = tutor_utils()->do_enroll( $course_id,0 ,$current_user_id );
    }
    // do action
}
add_action('amelia_after_booking_added', 'course_enroll_by_event_booking', 10, 1);