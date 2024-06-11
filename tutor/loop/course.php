<?php
/**
 * A single course loop
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

do_action( 'tutor_course/loop/before_content' );

do_action( 'tutor_course/loop/badge' );


do_action( 'tutor_course/loop/before_header' );
do_action( 'tutor_course/loop/header' );
do_action( 'tutor_course/loop/after_header' );


do_action( 'tutor_course/loop/start_content_wrap' );


// ---------------------------------------------------

// $terms = wp_get_post_terms( get_the_ID(), 'course-category' );

// if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
//     foreach ( $terms as $key => $term ) {
//         echo '<h6>'.$term->name . (count($terms) > ($key + 1) ? ', ':'').'</h6>'; // Output the term name
//     }
// }

// ---------------------------------------------------
do_action( 'tutor_course/loop/before_title' );
do_action( 'tutor_course/loop/title' );
do_action( 'tutor_course/loop/after_title' );

do_action( 'tutor_course/loop/before_rating' );
do_action( 'tutor_course/loop/rating' );
do_action( 'tutor_course/loop/after_rating' );

do_action( 'tutor_course/loop/before_meta' );
do_action( 'tutor_course/loop/meta' );
do_action( 'tutor_course/loop/after_meta' );


do_action( 'tutor_course/loop/before_excerpt' );
the_excerpt();
do_action( 'tutor_course/loop/excerpt' );
do_action( 'tutor_course/loop/after_excerpt' );
// ---------------------------------------------------
$course_price             = tutor_utils()->get_raw_course_price( get_the_ID() );
$publish_date = get_the_date('M d Y', get_the_ID());
?>
	<div class="post-details mt-auto">
		<center>
			<!-- <span class="price"><?php //echo (tutils()->price_type() != 'free' ? tutor_utils()->currency_symbol(). $course_price->sale_price:tutor_utils()->currency_symbol().'0.00');?></span> -->
		    <?php 
	            $course_duration = (get_post_meta(get_the_ID(), '_course_duration', true));
	            // print_r($course_duration);
	            if (is_array($course_duration)) {
	            	$convert_duration = convertHoursToMonthsWeeksDays($course_duration['hours'], $course_duration['minutes'], $course_duration['seconds']);
	            	if ($convert_duration['months'] > 0) {
	                $course_duration_str = $convert_duration['months'].' Month'.($convert_duration['months'] > 1 ? 's' : '');
		            } elseif ($convert_duration['weeks'] > 0) {
		                $course_duration_str = $convert_duration['weeks'].' Week'.($convert_duration['weeks'] > 1 ? 's' : '');
		            } elseif ($convert_duration['days'] > 0) {
		                $course_duration_str = $convert_duration['days'].' Day'.($convert_duration['days'] > 1 ? 's' : '');
		            } else {
		                $course_duration_str = ($course_duration['hours']?$course_duration['hours'].'hr ':'').($course_duration['minutes']?$course_duration['minutes'].'min ':''). ($course_duration['seconds']?$course_duration['seconds'].'sec ':'');
		            }
	            }
	            
	        ?>
	        <span class="duration"><?php echo (isset($course_duration_str)?$course_duration_str:'0 sec');?>&nbsp;|&nbsp;</span>
	        <span class="date"><?php echo ($publish_date? 'Publish date: '.$publish_date:''); ?></span>
		</center>
	    
	</div>
<?php
// ---------------------------------------------------

do_action( 'tutor_course/loop/end_content_wrap' );
do_action( 'tutor_course/loop/tutor_pagination' );

/**
 * Hooks for enrolled course progress
 * That will affected on dashboard enrolled course page
 *
 * @since 2.0.0
 */
do_action( 'tutor_course/loop/before_enrolled_progress' );
do_action( 'tutor_course/loop/enrolled_course_progress' );
do_action( 'tutor_course/loop/after_enrolled_progress' );

do_action( 'tutor_course/loop/before_footer' );
do_action( 'tutor_course/loop/footer' );
do_action( 'tutor_course/loop/after_footer' );

do_action( 'tutor_course/loop/after_content' );


