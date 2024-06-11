<?php
/**
 * Template for displaying single lesson, assignment, quiz etc.
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

global $post;
//phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
$currentPost = $post;

$method_map = array(
	'lesson'     => 'tutor_lesson_content',
	'assignment' => 'tutor_assignment_content',
);

$content_id  = tutor_utils()->get_post_id();
$course_id   = tutor_utils()->get_course_id_by_subcontent( $content_id );
$contents    = tutor_utils()->get_course_prev_next_contents_by_id( $content_id );
$previous_id = $contents->previous_id;
$next_id     = $contents->next_id;
$user_id     = get_current_user_id();

$is_course_completed   = tutor_utils()->is_completed_course( $course_id, $user_id );
$enable_spotlight_mode = tutor_utils()->get_option( 'enable_spotlight_mode' );
//phpcs:ignore WordPress.PHP.DontExtract.extract_extract
extract( $data ); // $data variable consist $context, $html_content.

/**
 * Single course sidebar content
 *
 * @param boolean $echo echo the content or not.
 * @param string  $context device context (mobile/desktop).
 * @return string HTML output string.
 */
function tutor_course_single_sidebar( $echo = true, $context = 'desktop' ) {
	ob_start();
	tutor_load_template( 'single.lesson.lesson_sidebar', array( 'context' => $context ) );
	$output = apply_filters( 'tutor_lesson/single/lesson_sidebar', ob_get_clean() );

	if ( $echo ) {
		add_filter( 'wp_kses_allowed_html', 'tutor_kses_allowed_html', 10, 2 );
		echo wp_kses_post( $output );
		remove_filter( 'wp_kses_allowed_html', 'tutor_kses_allowed_html' );
	}

	return $output;
}

do_action( 'tutor/course/single/content/before/all', $course_id, $content_id );

get_tutor_header();

$show_mark_as_complete = false;

if ( tutor()->lesson_post_type === $post->post_type ) {
	$show_mark_as_complete = apply_filters( 'tutor_lesson_show_mark_as_complete', true );
}

?>

<?php do_action( 'tutor_' . $context . '/single/before/wrap' ); ?>
<section class="watch-course-head">
    <div class="container">
        <!-- <div class="inner"> -->
        	<div class="row gy-2">
        		<div class="head small col-md-7">
	                <a href="javascript:void(0)" onclick="window.history.back()"><i class="fa-solid fa-arrow-left"></i></a>
	                <div class="head-wrapper">
	                    <h5><?php the_title(); ?></h5>
	                    <div class="course-information">
	                        <p><i class="fa-regular fa-folder-closed"></i><span class="total-course-topics">0 Topics</span></p>
	                        <p><i class="fa-regular fa-circle-play"></i><span class="total-course-lessons">0 lectures</span></p>
	                        <p><i class="fa-regular fa-clock"></i><span class="total-course-time">0 min</span></p>
	                    </div>
	                </div>
	            </div>
	            <div class="head-btns col-md-5">
                    <?php
                    $is_enrolled = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );
                    if ( $is_enrolled ) : ?>
<!--                        <a href="#writereviewmodal" data-bs-toggle="modal" data-bs-target="#writereviewmodal" class="btn link">Write a Review</a>-->
                    <?php endif; ?>
	                <!-- <a href="" class="btn">Next lecture</a> -->
	                <?php tutor_load_template( 'single.common.next-previous', array( 'course_id' => $course_id ) ); ?>
	            </div>
        	</div>
        <!-- </div> -->
    </div>
</section>
<section class="lectures-details">
    <div class="container">
        <div class="inner">
            <div class="row g-0 w-100">
				<div class="tutor-course-single-content-wrapper row w-100 g-0 g-lg-3<?php echo $enable_spotlight_mode ? ' tutor-spotlight-mode' : ''; ?>">
					<div class="col-lg-7">
						<div id="tutor-single-entry-content" class="tutor-quiz-single-entry-wrap">
							<?php ( isset( $method_map[ $context ] ) && is_callable( $method_map[ $context ] ) ) ? $method_map[ $context ]() : 0; ?>
							<?php
								/**
								 * Note: $html_content comes from extracted $data variable
								 * $html_content consist dynamic HTML content which is loaded by tutor_load_template_from_custom_path
								 */
								echo isset( $html_content ) ? $html_content : ''; //phpcs:ignore 
							?>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="tutor-course-single-sidebar-wrapper tutor-<?php echo esc_attr( $context ); ?>-sidebar mb-5 mb-lg-0">
							<?php tutor_course_single_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Course Progressbar on sm/mobile  -->
<?php
	// Get total content count.
	$course_stats = tutor_utils()->get_course_completed_percent( $course_id, 0, true );

	// Is Lesstion Complete.
	$is_completed_lesson = tutor_utils()->is_completed_lesson();
?>

<?php if ( ! \TUTOR\Course_List::is_public( $course_id ) ) : ?>
	<div class="tutor-spotlight-mobile-progress-complete tutor-px-20 tutor-py-16 tutor-mt-20 tutor-d-xl-none tutor-d-none">
		<div class="tutor-row tutor-align-center">
			<div class="tutor-spotlight-mobile-progress-left <?php echo ! $is_completed_lesson ? 'tutor-col-sm-8 tutor-col-6' : 'tutor-col-12'; ?>">
				<div class="tutor-fs-7 tutor-color-muted">
					<?php echo esc_html( $course_stats['completed_percent'] ) . '% '; ?><span><?php esc_html_e( 'Complete', 'tutor' ); ?></span>
				</div>
				<div class="list-item-progress tutor-my-16">
					<div class="tutor-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $course_stats['completed_percent'] ); ?>%;">
						<span class="tutor-progress-value" area-hidden="true"></span>
					</div>
				</div>
			</div>

			<div class="tutor-spotlight-mobile-progress-right tutor-col-sm-4 tutor-col-6">
				<?php
				if ( ! $is_completed_lesson && $show_mark_as_complete ) {
					tutor_lesson_mark_complete_html();
				}
				do_action( 'tutor_after_lesson_completion_button', $course_id, $user_id, $is_course_completed, $course_stats );
				?>
			</div>

		</div>
	</div>
    <?php
        do_action( 'tutor_course/single/enrolled/before/reviews' );
        $is_enrolled = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );
//        echo $course_id."course_id<br>";
//        echo get_current_user_id()."get_current_user_id<br>";
//        print_r($is_enrolled) ; echo "is_enrolled<br>";
        $my_rating       = tutor_utils()->get_reviews_by_user( 0, 0, 150, false, $course_id, array( 'approved', 'hold' ) );
        if ( $is_enrolled ) : ?>
	<!-- Modal -->
	<div class="modal fade" id="writereviewmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="writereviewmodalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 id="writereviewmodalLabel">Write a Review</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
                    <div class="tutor-course-enrolled-review-wrap tutor-pt-16">
                        <div class="tutor-write-review-form" style="display: block;">
                            <form method="post">
                                <div class="tutor-star-rating-container">
                                    <input type="hidden" name="course_id" value="<?php echo esc_attr( $course_id ); ?>"/>
                                    <input type="hidden" name="review_id" value="<?php echo esc_attr( $my_rating ? $my_rating->comment_ID : '' ); ?>"/>
                                    <input type="hidden" name="action" value="tutor_place_rating"/>
                                    <div class="tutor-form-group">
                                        <span class='text-message'><strong class='text-message-value'></strong> (Rate Here Please.)</span>
                                        <div class="tutor-ratings tutor-ratings-lg tutor-ratings-selectable" tutor-ratings-selectable>
                                            <?php
                                                tutor_utils()->star_rating_generator( tutor_utils()->get_rating_value( $my_rating ? $my_rating->rating : 0 ) );
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tutor-form-group">
                                        <textarea name="review" placeholder="<?php esc_html_e( 'write a review', 'tutor' ); ?>"><?php echo stripslashes( $my_rating ? $my_rating->comment_content : '' ); //phpcs:ignore ?></textarea>
                                    </div>
                                    <div class="tutor-form-group">
                                        <button type="submit" class="tutor_submit_review_btn tutor-btn tutor-btn-primary">
                                            <?php esc_html_e( 'Submit Review', 'tutor' ); ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
        <?php endif; ?>

    <?php do_action( 'tutor_course/single/enrolled/after/reviews' ); ?>
<?php endif; ?>
<?php
do_action( 'tutor_' . $context . '/single/after/wrap' );

get_tutor_footer();