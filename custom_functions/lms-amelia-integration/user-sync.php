<?php
/* use for testing
 global $wpdb;
        $table_name = $wpdb->prefix . 'amelia_lms_integrate';

        // Store debug info
        $data = array(
            'course_id' => 0,
            'amelia_tag' => 'session is set' // Indicate session is set
        );

        // Insert the data into the database
        $result = $wpdb->insert(
            $table_name,
            $data,
            array(
                '%d', // course_id
                '%s'  // amelia_tag
            )
        );
*/
/**
 * Sync Amelia when user role changed from admin dashboard > Users
 */
add_action('set_user_role', 'sync_amelia_on_user_role_change', 10, 3);

function sync_amelia_on_user_role_change($user_id, $role, $old_roles) {
    // Debug log
    //error_log('User role changed for user ID: ' . $user_id . ' to role: ' . $role);
   // error_log('Old roles: ' . implode(', ', $old_roles));

    // Process the user data update for amelia
    global $wpdb;

    // Get the user data
    $user = get_userdata($user_id);
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $email = $user->user_email;

    // Get the updated roles
    $roles = $user->roles;

    // Determine the user type
    $user_type = 'customer'; // Default type
    if (in_array('subscriber', $roles)) {
        $user_type = 'customer';
        $user->remove_role('wpamelia-provider');
        $user->remove_role('tutor_instructor');
        $user->add_role('wpamelia-customer');
    } elseif(in_array('tutor_instructor', $roles) && in_array('wpamelia-provider', $roles)) {
        $user_type = 'provider';
        $user->remove_role('wpamelia-customer');
    } elseif (in_array('tutor_instructor', $roles) && !in_array('wpamelia-provider', $roles)) {
       
        $user_type = 'provider';
        $user->remove_role('wpamelia-customer');
        // Add the wpamelia-provider role to the user
        $user->add_role('wpamelia-provider');
        error_log('Added wpamelia-provider role to user ID: ' . $user_id);
    }elseif (!in_array('tutor_instructor', $roles) && in_array('wpamelia-provider', $roles)){
        $user_type = 'customer';
        $user->remove_role('wpamelia-provider');
        $user->add_role('wpamelia-customer');
        $user->add_role('subscriber');
    }elseif (in_array('administrator', $roles)) {
        error_log('User is an administrator, skipping update.');
        return; // Skip administrators
    }else{
        $user->remove_role('wpamelia-provider');
        $user->add_role('wpamelia-customer');
        $user->add_role('subscriber');
    }

    // Prepare data for update or insert
    $data = array(
        'firstName' => $first_name,
        'lastName' => $last_name,
        'email' => $email,
        'type' => $user_type,
        'externalId' => $user_id
    );

    // Prepare format for the data
    $format = array(
        '%s',  // firstName
        '%s',  // lastName
        '%s',  // email
        '%s',  // type
        '%d'   // externalId
    );

    // Check if a record with the given externalId exists
    $table_name = $wpdb->prefix . 'amelia_users';
    $existing_record = $wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE externalId = %d", $user_id)
    );

    if ($existing_record > 0) {
        // Update existing record
        $wpdb->update(
            $table_name,
            $data,
            array('externalId' => $user_id),
            $format,
            array('%d') // externalId
        );
        error_log('Successfully updated amelia_users table.');
    } else {
        // Insert new record
        $wpdb->insert(
            $table_name,
            $data,
            $format
        );
        error_log('Successfully inserted into amelia_users table.');
    }
}

/**
 * Set Unique Flag to identify user registration from Amelia Frontend booking
 */
 function set_amelia_register_session_flag($user) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Generate a unique identifier for this registration
    $unique_identifier = uniqid('amelia_', true);

    // Set the session variable
    $_SESSION['user_register_from_amelia_flag'] = $unique_identifier;

    // Optionally, store the unique identifier in an option for future reference (if needed)
    add_option('user_register_from_amelia_flag', $unique_identifier);
}

add_action('amelia_set_wp_user_for_new_customer', 'set_amelia_register_session_flag', 10, 1);

/**
 * Add a new Amelia user when wordpress user is created
 */

add_action('user_register', 'add_new_user_to_amelia_users', 10, 1);
function add_new_user_to_amelia_users($user_id) {
    // Ensure the session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Debug: Check if the session variable is set
    if (isset($_SESSION['user_register_from_amelia_flag'])) {
        
        return;

    } else {
        // Debug: Session variable is not set
       global $wpdb;

       // Get the user data
       $user = get_userdata($user_id);
       $first_name = $user->first_name;
       $last_name = $user->last_name;
       $email = $user->user_email;
   
       // Determine the user type
       $user_type = 'customer'; // Default type
       if (user_can($user_id, 'tutor_instructor')) {
           $user_type = 'provider';
       } elseif (user_can($user_id, 'administrator')) {
           return; // Skip administrators
       }
   
       // Prepare data for insertion
       $data = array(
           'status' => 'visible',
           'type' => $user_type,
           'externalId' => $user_id,
           'firstName' => $first_name,
           'lastName' => $last_name,
           'email' => $email,
           'translations' => json_encode(array('defaultLanguage' => 'en_US')),
       );
   
       // Insert data into wp_amelia_users table
       $table_name = $wpdb->prefix . 'amelia_users';
       $result = $wpdb->insert(
           $table_name,
           $data,
           array(
               '%s',  // status
               '%s',  // type
               '%d',  // externalId
               '%s',  // firstName
               '%s',  // lastName
               '%s',  // email
               '%s'   // translations
           )
       );
    }
}
/**
 * Update or Insert Amelia Employee when Wordpress user is updated
 */

add_action('tutor_after_approved_instructor', 'update_amelia_user_on_profile_update', 10, 1);
add_action('profile_update', 'update_amelia_user_on_profile_update', 10, 2);

function update_amelia_user_on_profile_update($user_id, $old_user_data = null) {
    // Ensure the session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Debug: Log entry into the function
    //error_log('Entered update_amelia_user_on_profile_update function for user_id: ' . $user_id);

    // Check if the session variable is set
    if (isset($_SESSION['user_register_from_amelia_flag'])) {
        // Unset the session variable after use
        unset($_SESSION['user_register_from_amelia_flag']);
        //error_log('Session variable user_register_from_amelia_flag was true and now has been unset.');

         // Mark this user as updated in the session
        if (!isset($_SESSION['amelia_signup_user_updated'])) {
            $_SESSION['amelia_signup_user_updated'] = array();
        }
        $_SESSION['amelia_signup_user_updated'][] = $user_id;

        return; // Ensure the function exits here
    } else {
        //error_log('Session variable user_register_from_amelia_flag is not set in update hook.');
    }

    // Check if the user has already been updated in the current session
    if (isset($_SESSION['amelia_signup_user_updated']) && in_array($user_id, $_SESSION['amelia_signup_user_updated'])) {
        //error_log('User ID ' . $user_id . ' has already been processed.');
        unset($_SESSION['amelia_signup_user_updated']);
        return;
    }

    // Process the user data update for amelia if the session variable is not set
    global $wpdb;

    // Get the user data
    $user = get_userdata($user_id);
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $email = $user->user_email;

    // Determine the user type
    $user_type = 'customer'; // Default type
    if ((user_can($user_id, 'tutor_instructor')) || (user_can($user_id, 'wpamelia-provider'))) {
        $user_type = 'provider';
    } elseif (user_can($user_id, 'administrator')) {
        error_log('User is an administrator, skipping update.');
        return; // Skip administrators
    }

    // Prepare data for update or insert
    $data = array(
        'firstName' => $first_name,
        'lastName' => $last_name,
        'email' => $email,
        'type' => $user_type,
        'externalId' => $user_id
    );

    // Prepare format for the data
    $format = array(
        '%s',  // firstName
        '%s',  // lastName
        '%s',  // email
        '%s',  // type
        '%d'   // externalId
    );

    // Check if a record with the given externalId exists
    $table_name = $wpdb->prefix . 'amelia_users';
    $existing_record = $wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE externalId = %d", $user_id)
    );

    if ($existing_record > 0) {
        // Update existing record
        $wpdb->update(
            $table_name,
            $data,
            array('externalId' => $user_id),
            $format,
            array('%d') // externalId
        );
       // error_log('Successfully updated amelia_users table.');
    } else {
        // Insert new record
        $wpdb->insert(
            $table_name,
            $data,
            $format
        );
        //error_log('Successfully inserted into amelia_users table.');
    }
}


/**
 * Delete Amelia user when Wordpress user deleted
 */

add_action('delete_user', 'delete_amelia_user_on_delete', 10, 1);

function delete_amelia_user_on_delete($user_id) {
    global $wpdb;

    // Step 1: Retrieve the Amelia customer ID
    $table_name = $wpdb->prefix . 'amelia_users';
    $customer_id = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE externalId = %d",
        $user_id
    ));

    if ($customer_id) {
        // Step 2: Find all bookings for this customer
        $bookings_table = $wpdb->prefix . 'amelia_customer_bookings';
        $bookings = $wpdb->get_results($wpdb->prepare(
            "SELECT id FROM $bookings_table WHERE customerId = %d",
            $customer_id
        ));

        if ($bookings) {
            // Prepare an array to hold booking IDs
            $booking_ids = array();

            foreach ($bookings as $booking) {
                $booking_ids[] = $booking->id;
            }

            // Step 3: Delete all entries in wp_amelia_customer_bookings_to_events_periods
            $bookings_to_events_periods_table = $wpdb->prefix . 'amelia_customer_bookings_to_events_periods';
            foreach ($booking_ids as $booking_id) {
                $wpdb->delete(
                    $bookings_to_events_periods_table,
                    array('customerBookingId' => $booking_id),
                    array('%d')
                );
            }

            // Step 4: Delete all entries in wp_amelia_customer_bookings
            foreach ($booking_ids as $booking_id) {
                $wpdb->delete(
                    $bookings_table,
                    array('id' => $booking_id),
                    array('%d')
                );
            }
        }

        // Step 5: Delete the customer from wp_amelia_users
        $wpdb->delete(
            $table_name,
            array('id' => $customer_id),
            array('%d')
        );
    }
}
