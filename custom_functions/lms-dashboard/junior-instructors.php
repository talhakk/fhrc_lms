<?php
/**
 * Add select field in theme options to select main users
 */
function acf_load_user_field_choices($field) {
    
    // Reset choices
    $field['choices'] = array();
    
    // Get all users
    $users = get_users();

    // Loop through each user and add to field 'choices'
    foreach ($users as $user) {
        $user_id = $user->ID;
        $first_name = $user->first_name;
        $last_name = $user->last_name;

        // Combine the user ID and the full name
        $label = $user_id . ' : ' . $first_name . ' ' . $last_name;
        $value = $user_id;

        // Add to choices array
        $field['choices'][$value] = $label;
    }

    // Return the field
    return $field;
}

// Replace 'main_allowed_instructors' with the actual name of your ACF field
add_filter('acf/load_field/name=main_allowed_instructors', 'acf_load_user_field_choices');

/**
 * Get Main Instructors List
 */
function is_current_user_allowed() {
    // Get the current user ID
    $current_user_id = get_current_user_id();
    
    // Retrieve the allowed instructors from the ACF field
    $allowed_instructors = get_field('main_allowed_instructors', 'option');
    
    // Ensure it's an array
    $allowed_instructors = is_array($allowed_instructors) ? $allowed_instructors : array($allowed_instructors);
    
    // Check if the current user ID is in the allowed instructors array
    return in_array($current_user_id, $allowed_instructors);
}