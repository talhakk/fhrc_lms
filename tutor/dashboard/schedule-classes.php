<?php
/**
 * class bookings for Instructor Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */
$is_instructor = ((current_user_can('tutor_instructor') || current_user_can('wpamelia_provider'))&& is_current_user_allowed());

// Current user wordpress id
//$uid  = get_current_user_id();
if($is_instructor){
    echo 'Schedule Classes & View Enrollments';
    
    echo do_shortcode('[ameliaemployeepanel events=1]');
    // do something if(!is_current_user_allowed()){}
?>

<?php }else{  
     // if student / customer
    echo do_shortcode('[ameliacustomerpanel events=1]');  } ?>

