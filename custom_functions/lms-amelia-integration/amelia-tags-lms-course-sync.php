<?php
/**
 * Create or Update Amelia Tags when Course is Created or Updated
 */
add_action('save_post', 'create_or_update_amelia_tag_on_course_save', 10, 2);

function create_or_update_amelia_tag_on_course_save($post_ID,$post) {
     // Only proceed if the post type is 'course'
     if ($post->post_type !== 'courses') {
        return;
    }
    global $wpdb;

    // Retrieve the terms (categories) associated with the course
    $terms = get_the_terms($post_ID, 'course-category'); // Adjust the taxonomy name if different

    // Initialize a flag to track if the course has the desired category
    $has_desired_category = false;
    
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            // Check if the term slug is 'onsite' or 'online'
            if (($term->slug == 'on-site')||($term->slug == 'online')) {
                $has_desired_category = true;
                break;
            }
        }
    }

    // Only proceed if the course has the desired category
    if ($has_desired_category) {
       
        // Get course details
        $course_title = get_the_title($post_ID);

        // Append the $post_ID to $course_title with a space
        $course_title_with_id = $course_title . ' ' . $post_ID;

        // Return early if the course title is the default placeholder
        if ($course_title == 'New Course') {
            return;
        }

        // Prepare data for insertion or update in amelia_lms_integrate table
        $data = array(
            'course_id' => $post_ID,
            'amelia_tag' => $course_title_with_id // Append post ID to course title
        );

        // Check if the record already exists
        $table_name = $wpdb->prefix . 'amelia_lms_integrate';
        $existing_record_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $table_name WHERE course_id = %d",
            $post_ID
        ));

        if ($existing_record_id) {
            // Get previous amelia_tag before update, and update wp_amelia_events_tags table where amelia_tag is equal to name column
            $previous_amelia_tag = $wpdb->get_var($wpdb->prepare(
                "SELECT amelia_tag FROM $table_name WHERE course_id = %d",
                $post_ID
            ));

            // Update the existing record
            $result = $wpdb->update(
                $table_name,
                $data,
                array('id' => $existing_record_id),
                array(
                    '%d',   // course_id as integer
                    '%s'    // amelia_tag as string
                ),
                array('%d')
            );

            if ($result === false) {
                error_log('Failed to update data in wp_amelia_lms_integrate: ' . $wpdb->last_error);
            } else {
               

                // Update the wp_amelia_events_tags table
                $result_tag_update = $wpdb->update(
                    $wpdb->prefix . 'amelia_events_tags',
                    array('name' => $course_title_with_id),
                    array('name' => $previous_amelia_tag, 'eventId' => 0),
                    array('%s'),
                    array('%s', '%d')
                );

            }
        } else {
            // Insert a new record
            $result = $wpdb->insert(
                $table_name,
                $data,
                array(
                    '%d',   // course_id as integer
                    '%s'    // amelia_tag as string
                )
            );

            if ($result === false) {
                error_log('Failed to insert data into wp_amelia_lms_integrate: ' . $wpdb->last_error);
            } else {

                // Also insert into wp_amelia_events_tags table
                $event_tag_data = array(
                    'eventId' => 0,
                    'name' => $course_title_with_id
                );

                $result_tag = $wpdb->insert(
                    $wpdb->prefix . 'amelia_events_tags',
                    $event_tag_data,
                    array(
                        '%d',  // eventId as integer
                        '%s'   // name as string
                    )
                );

            }
        }
    }
}

/**
 * Delete Amelia Events Related to Tutor LMS course via tag
 */
add_action('before_delete_post', 'delete_amelia_events_on_course_delete');

function delete_amelia_events_on_course_delete($postid) {
    // Get the post object
    $post = get_post($postid);

    // Check if the post object exists and if it's of the 'courses' post type
    if ($post && $post->post_type === 'courses') {
        // Retrieve the terms (categories) associated with the course
        $terms = get_the_terms($postid, 'course-category');

        // Initialize a flag to track if the course has the desired category
        $has_desired_category = false;

        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                // Check if the term slug is 'on-site' or 'online'
                if ($term->slug == 'on-site' || $term->slug == 'online') {
                    $has_desired_category = true;
                    break;
                }
            }
        }

        // Only proceed if the course has the desired category
        if ($has_desired_category) {
            global $wpdb;

            // Get the event IDs from wp_amelia_events_tags table
            $event_ids = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT eventId FROM {$wpdb->prefix}amelia_events_tags WHERE name = %s",
                    $post->post_title . ' ' . $postid
                )
            );

            // If there are event IDs to delete
            if (!empty($event_ids)) {
                // Convert the array of event IDs to a comma-separated string
                $event_ids_str = implode(',', array_map('intval', $event_ids));

                // Delete entries from wp_amelia_events_periods table
                $wpdb->query(
                    "DELETE FROM {$wpdb->prefix}amelia_events_periods WHERE eventId IN ($event_ids_str)"
                );

                // Delete entries from wp_amelia_events table
                $wpdb->query(
                    "DELETE FROM {$wpdb->prefix}amelia_events WHERE id IN ($event_ids_str)"
                );
            }

            // Delete matching entries from wp_amelia_events_tags table
            $wpdb->delete(
                $wpdb->prefix . 'amelia_events_tags',
                array('name' => $post->post_title . ' ' . $postid),
                array('%s')
            );

            // Delete matching entry from wp_amelia_lms_integrate table
            $wpdb->delete(
                $wpdb->prefix . 'amelia_lms_integrate',
                array('course_id' => $postid),
                array('%d')
            );
        }
    }
}
