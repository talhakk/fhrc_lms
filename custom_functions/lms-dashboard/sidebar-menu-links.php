<?php
/**
 *  Add nav items
 */
 function add_some_instructor_custom_links_dashboard($links){
    $is_instructor = current_user_can('tutor_instructor') || current_user_can('wpamelia_provider');

    // Add another custom tab
    $links['schedule-classes'] = [
        "title" =>	__('View Enrollments', 'tutor'),
        "icon" => "fa-regular fa-calendar-check",
    ];

    // Tab For Instructors (reusing above template because Tutor LMS not recognizes template inside a condition $is_instructor)
    if ($is_instructor && is_current_user_allowed()){
        $links['schedule-classes'] = [
            "title" =>	__('Schedule Classes', 'tutor'),
            "icon" => "fa-solid fa-chalkboard-user",
        ];
        return $links;
    }
	return $links;
}
add_filter('tutor_dashboard/nav_items', 'add_some_instructor_custom_links_dashboard');

/**
 * Filter Tutor LMS menu items for main instructors
 */
/*
function filter_tutor_dashboard_menu_items($menu_items) {
    // Check if the current user is allowed
    if (!is_current_user_allowed()) {
        // Remove or modify menu items if the user is not allowed
        unset($menu_items['my-courses']);
    }
    
    return $menu_items;
}

// Add the filter to modify the Tutor LMS dashboard menu
add_filter('tutor_dashboard/instructor_nav_items', 'filter_tutor_dashboard_menu_items');
*/