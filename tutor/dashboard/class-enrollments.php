<?php
/**
 * Onsite Class bookings for Instructor Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */
$is_instructor = current_user_can('tutor_instructor') || current_user_can('wpamelia_provider');

if ($is_instructor){
    // if instructor / employee
    echo do_shortcode('[ameliaemployeepanel events=1 profile-hidden=1]');
    if(!is_current_user_allowed()){
        echo '';
    }
} else {
    // if student / customer
    echo '<h3>Your Onsite Classes</h3>';
    echo do_shortcode('[ameliacustomerpanel events=1]'); 
    echo '<style>.am-cabinet-dashboard-header {
        display:none!important;
     }</style>';
}



