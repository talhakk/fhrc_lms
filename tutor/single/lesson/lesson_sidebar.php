<?php
/**
 * Display Topics and Lesson lists for learn
 *
 * @package Tutor\Templates
 * @subpackage Single\Lesson
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

use TUTOR\Input;
use Tutor\Models\QuizModel;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$current_post_id = get_the_ID();
if ( ! empty( Input::post( 'lesson_id' ) ) ) {
	$current_post_id = Input::post( 'lesson_id' );
}

$current_post = $post;
$_is_preview  = get_post_meta( $current_post_id, '_is_preview', true );
$course_id    = tutor_utils()->get_course_id_by_subcontent( $post->ID );

$user_id                      = get_current_user_id();
$enable_qa_for_this_course    = get_post_meta( $course_id, '_tutor_enable_qa', true ) == 'yes';
$enable_q_and_a_on_course     = tutor_utils()->get_option( 'enable_q_and_a_on_course' ) && $enable_qa_for_this_course;
$is_enrolled                  = tutor_utils()->is_enrolled( $course_id );
$is_instructor_of_this_course = tutor_utils()->has_user_course_content_access( $user_id, $course_id );
$is_user_admin                = current_user_can( 'administrator' );
$is_public_course             = \TUTOR\Course_List::is_public( $course_id );


// Course Info.
$completion_mode     = tutor_utils()->get_option( 'course_completion_process' );
$is_course_completed = tutor_utils()->is_completed_course();
$retake_course       = tutor_utils()->can_user_retake_course();
// $course_progress     = tutor_utils()->get_course_completed_percent( $course_id, 0, true );
$course_stats       = tutor_utils()->get_course_completed_percent( $course_id, 0, true );
$completed_percent   = $course_stats['completed_percent'];
?>

<?php do_action( 'tutor_lesson/single/before/lesson_sidebar' ); ?>
<div class="course-content">
	<div class="tutor-course-single-sidebar-title tutor-d-flex tutor-justify-between">
		<div class="progress-bar-custom 	w-100">
			<div class="row">
				<div class="col-12">
					<h5><?php esc_html_e( 'Course Content', 'tutor' ); ?> <span class="Progress-percentage"><?php echo esc_attr( $completed_percent ); ?>% Completed</span></h5> 
				</div>
			</div>
			<?php /* ?>
            <div class="row">
				<div class="col-3">
					<div class="tutor-fs-6 tutor-color-secondary tutor-d-flex tutor-align-center tutor-justify-between">
	                    <span class="progress-steps">
	                        <?php echo esc_html( $course_stats['completed_count'] . '/' . $course_stats['total_count'] ); ?>
	                    </span>
	                    
	                </div>
				</div>
				<div class="col-5">
				</div>
				<div class="col-4">
					<span class="progress-percentage">
                        <?php echo esc_html( $completed_percent . '%' ); ?>
                        <?php esc_html_e( 'Complete', 'tutor' ); ?>
                    </span>
				</div>
			</div>
			<div class="bar list-item-progress">
			<?php */ ?>
                <div class="tutor-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $completed_percent ); ?>%;">
                    <span class="tutor-progress-value" area-hidden="true"></span>
                </div>
           <?php /* ?> </div> <?php */ ?>
        </div>
	</div>
</div>
<?php
$user_id            = get_current_user_id();
$course_id          = isset( $course_id ) ? (int) $course_id : 0;
$is_enrolled        = tutor_utils()->is_enrolled( $course_id );
$show_mark_complete = isset( $mark_as_complete ) ? $mark_as_complete : false;
?>
<?php if ( $is_enrolled ) : ?>
    <?php /* do_action( 'tutor_course/single/enrolled/before/lead_info/progress_bar' ); ?>
    <div class="tutor-fs-7 tutor-mr-20">
        <?php if ( true == get_tutor_option( 'enable_course_progress_bar' ) ) : ?>
            <span class="tutor-progress-content tutor-color-primary-60">
						<?php esc_html_e( 'Your Progress:', 'tutor' ); ?>
					</span>
            <span class="tutor-fs-7 tutor-fw-bold">
						<?php echo esc_html( $course_stats['completed_count'] ); ?>
					</span>
            <?php esc_html_e( 'of ', 'tutor' ); ?>
            <span class="tutor-fs-7 tutor-fw-bold">
						<?php echo esc_html( $course_stats['total_count'] ); ?>
					</span>
            (<?php echo esc_html( $course_stats['completed_percent'] . '%' ); ?>)
        <?php endif; ?>
    </div>
    <?php do_action( 'tutor_course/single/enrolled/after/lead_info/progress_bar' ); */ ?>
    <?php
    if ( $show_mark_complete ) {
        tutor_lesson_mark_complete_html();
    }
    do_action( 'tutor_after_lesson_completion_button', $course_id, $user_id, $is_course_completed, $course_stats );
    ?>
<?php endif; ?>

<?php
$topics = tutor_utils()->get_topics( $course_id );
$total_topics = $total_num_lessons = $total_course_seconds = 0;
if ( $topics->have_posts() ) {

	// Loop through topics.
	while ( $topics->have_posts() ) {
		$total_topics++;
		$topics->the_post();
		$topic_id        = get_the_ID();
		$topic_summery   = get_the_content();
		$total_contents  = tutor_utils()->count_completed_contents_by_topic( $topic_id );
		$lessons         = tutor_utils()->get_course_contents_by_topic( get_the_ID(), -1 );
		$is_topic_active = ! empty(
			array_filter(
				$lessons->posts,
				function ( $content ) use ( $current_post ) {
					return $content->ID == $current_post->ID;
				}
			)
		);
		?>
		<div class="tutor-course-topic tutor-course-topic-<?php echo esc_attr( $topic_id ); ?>">
			<div class="tutor-accordion-item-header<?php echo $is_topic_active ? ' is-active' : ''; ?>" tutor-course-single-topic-toggler>
				<div class="tutor-row tutor-gx-1">
					<div class="tutor-col">
						<div class="tutor-course-topic-title">
							<h2 class="accordion-header" id="headingOne">
								<?php the_title(); ?>
								<?php if ( true ) : ?>
									<?php if ( trim( $topic_summery ) ) : ?>
										<div class="tutor-course-topic-title-info tutor-ml-8">
											<div class="tooltip-wrap">
												<i class="tutor-course-topic-title-info-icon tutor-icon-circle-info-o"></i>
												<span class="tooltip-txt tooltip-bottom">
													<?php echo esc_textarea( $topic_summery ); ?>
												</span>
											</div>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</h2>
						</div>
						<div class="course-information">
							<p><i class="fa-regular fa-circle-play"></i><span class="topic-lectures-<?php echo $topic_id;?>"></span></p>
							<p><i class="fa-regular fa-clock"></i><span class="topic-duration-<?php echo $topic_id;?>"></span></p>
							<p class="progress"><i class="fa-solid fa-check-double"></i><span class="topic-completed-lessons-<?php echo $topic_id;?>"></span></p>
						</div>
					</div>

					<div class="tutor-col-auto tutor-align-self-center">
						<?php if ( isset( $total_contents['contents'] ) && $total_contents['contents'] > 0 ) : ?>
							<div class="tutor-course-topic-summary tutor-pl-8">
								<?php echo esc_html( isset( $total_contents['completed'] ) ? $total_contents['completed'] : 0 ); ?>/<?php echo esc_html( isset( $total_contents['contents'] ) ? $total_contents['contents'] : 0 ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="tutor-accordion-item-body <?php echo $is_topic_active ? '' : 'tutor-display-none'; ?>">
				<?php
				do_action( 'tutor/lesson_list/before/topic', $topic_id );
				$total_hours = $remaining_minutes = $remaining_seconds = $total_seconds = $num_lessons = $completed_lessons = $completed_lessons_percent = 0;
				// Loop through lesson, quiz, assignment, zoom lesson.
				while ( $lessons->have_posts() ) {
					$lessons->the_post();

					$show_permalink = ! $_is_preview || $is_enrolled || get_post_meta( $post->ID, '_is_preview', true ) || $is_public_course || $is_instructor_of_this_course;
					$show_permalink = apply_filters( 'tutor_course/single/content/show_permalink', $show_permalink, get_the_ID() );
					$lock_icon      = ! $show_permalink;
					$show_permalink = null === $show_permalink ? true : $show_permalink;

					if ( 'tutor_quiz' === $post->post_type ) {
						$quiz = $post;
						?>
						<div class="tutor-course-topic-item tutor-course-topic-item-quiz<?php echo ( get_the_ID() == $current_post->ID ) ? ' is-active' : ''; ?>" data-quiz-id="<?php echo esc_attr( $quiz->ID ); ?>">
							<a href="<?php echo $show_permalink ? esc_url( get_permalink( $quiz->ID ) ) : '#'; ?>" data-quiz-id="<?php echo esc_attr( $quiz->ID ); ?>">
								<div class="tutor-d-flex tutor-mr-32">
									<span class="tutor-course-topic-item-icon tutor-icon-quiz-o tutor-mr-8 tutor-mt-2" area-hidden="true"></span>
									<span class="tutor-course-topic-item-title tutor-fs-7 tutor-fw-medium">
										<?php echo esc_html( $quiz->post_title ); ?>
									</span>
								</div>
								<div class="tutor-d-flex tutor-ml-auto tutor-flex-shrink-0">
									<?php
									$time_limit   = (int) tutor_utils()->get_quiz_option( $quiz->ID, 'time_limit.time_value' );
									$last_attempt = ( new QuizModel() )->get_first_or_last_attempt( $quiz->ID );

									// $attempt_ended = is_object( $last_attempt ) && ( 'attempt_ended' === ( $last_attempt->attempt_status ) || $last_attempt->is_manually_reviewed ) ? true : false;

									$attempt_ended = is_object( $last_attempt ) && QuizModel::ATTEMPT_STARTED !== $last_attempt->attempt_status;
									$result_class  = '';

									$quiz_result = QuizModel::get_quiz_result( $quiz->ID );
									if ( $attempt_ended && QuizModel::ATTEMPT_STARTED !== $last_attempt->attempt_status ) {
										if ( 'fail' === $quiz_result ) {
											$result_class = 'tutor-check-fail';
										}
										if ( 'pending' === $quiz_result ) {
											$result_class = 'tutor-check-pending';
										}
									}

									if ( $time_limit ) {
										$time_type                             = tutor_utils()->get_quiz_option( $quiz->ID, 'time_limit.time_type' );
										 'minutes' == $time_type ? $time_limit = $time_limit * 60 : 0;
										 'hours' == $time_type ? $time_limit   = $time_limit * 3660 : 0;
										 'days' == $time_type ? $time_limit    = $time_limit * 86400 : 0;
										 'weeks' == $time_type ? $time_limit   = $time_limit * 86400 * 7 : 0;

										// To Fix: If time larger than 24 hours, the hour portion starts from 0 again. Fix later.
										$markup = '<span class="tutor-course-topic-item-duration tutor-fs-7 tutor-fw-medium tutor-color-muted tutor-mr-8">' . tutor_utils()->course_content_time_format( gmdate( 'H:i:s', $time_limit ) ) . '</span>';
										echo wp_kses(
											$markup,
											array(
												'span' => array( 'class' => true ),
											)
										);
									}
									?>

									<?php if ( ! $lock_icon ) : ?>
										<input 	type="checkbox"
												class="tutor-form-check-input tutor-form-check-circle <?php echo esc_attr( $result_class ); ?> checks"
												disabled="disabled"
												readonly="readonly"
												<?php echo esc_attr( $attempt_ended ? 'checked="checked"' : '' ); ?> />
									<?php else : ?>
										<i class="tutor-icon-lock-line tutor-fs-7 tutor-color-muted tutor-mr-4" area-hidden="true"></i>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } elseif ( 'tutor_assignments' === $post->post_type ) { ?>
						<div class="tutor-course-topic-item tutor-course-topic-item-assignment<?php echo esc_attr( get_the_ID() == $current_post->ID ? ' is-active' : '' ); ?>">
							<a href="<?php echo $show_permalink ? esc_url( get_permalink( $post->ID ) ) : '#'; ?>" data-assignment-id="<?php echo esc_attr( $post->ID ); ?>">
								<div class="tutor-d-flex tutor-mr-32">
									<span class="tutor-course-topic-item-icon tutor-icon-assignment tutor-mr-8" area-hidden="true"></span>
									<span class="tutor-course-topic-item-title tutor-fs-7 tutor-fw-medium">
										<?php echo esc_html( $post->post_title ); ?>
									</span>
								</div>
								<div class="tutor-d-flex tutor-ml-auto tutor-flex-shrink-0">
									<?php if ( $show_permalink ) : ?>
										<?php do_action( 'tutor/assignment/right_icon_area', $post, $lock_icon ); ?>
									<?php else : ?>
										<i class="tutor-icon-lock-line tutor-fs-7 tutor-color-muted tutor-mr-4" area-hidden="true"></i>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } elseif ( 'tutor_zoom_meeting' === $post->post_type ) { ?>
						<div class="tutor-course-topic-item tutor-course-topic-item-zoom<?php echo esc_attr( ( get_the_ID() == $current_post->ID ) ? ' is-active' : '' ); ?>">
							<a href="<?php echo $show_permalink ? esc_url( get_permalink( $post->ID ) ) : '#'; ?>">
								<div class="tutor-d-flex tutor-mr-32">
									<span class="tutor-course-topic-item-icon tutor-icon-brand-zoom-o tutor-mr-8 tutor-mt-2" area-hidden="true"></span>
									<span class="tutor-course-topic-item-title tutor-fs-7 tutor-fw-medium">
										<?php echo esc_html( $post->post_title ); ?>
									</span>
								</div>
								<div class="tutor-d-flex tutor-ml-auto tutor-flex-shrink-0">
									<?php if ( $show_permalink ) : ?>
										<?php do_action( 'tutor/zoom/right_icon_area', $post->ID, $lock_icon ); ?>
									<?php else : ?>
										<i class="tutor-icon-lock-line tutor-fs-7 tutor-color-muted tutor-mr-4" area-hidden="true"></i>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } elseif ( 'tutor-google-meet' === $post->post_type ) { ?>
						<div class="tutor-course-topic-item tutor-course-topic-item-zoom<?php echo esc_attr( get_the_ID() == $current_post->ID ? ' is-active' : '' ); ?>">
							<a href="<?php echo $show_permalink ? esc_url( get_permalink( $post->ID ) ) : '#'; ?>">
								<div class="tutor-d-flex tutor-mr-32">
									<span class="tutor-course-topic-item-icon tutor-icon-brand-google-meet tutor-mr-8 tutor-mt-2" area-hidden="true"></span>
									<span class="tutor-course-topic-item-title tutor-fs-7 tutor-fw-medium">
										<?php echo esc_html( $post->post_title ); ?>
									</span>
								</div>
								<div class="tutor-d-flex tutor-ml-auto tutor-flex-shrink-0">
									<?php if ( $show_permalink ) : ?>
										<?php do_action( 'tutor/google_meet/right_icon_area', $post->ID, false ); ?>
									<?php else : ?>
										<i class="tutor-icon-lock-line tutor-fs-7 tutor-color-muted tutor-mr-4" area-hidden="true"></i>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } else { ?>
						
						<?php
						$video     = tutor_utils()->get_video_info();
						$play_time = false;
						if ( $video ) {
							$play_time = $video->playtime;
							$topic_durations = $video->playtime.',';

							$video_durations = [$topic_durations];

							// Initialize total seconds
						
							// Loop through each video duration
							foreach ($video_durations as $duration) {
								// echo "<pre>"; print_r($duration);
							    // Split the duration into minutes and seconds
							    $time_col = explode(':', $duration);
							    if (count($time_col) == 2) {
							     	$duration = '00:'.$duration;
							     } elseif(count($time_col) == 1) {
							     	$duration = '00:00:'.$duration;
							     }

							    list($hours, $minutes, $seconds) = explode(":", $duration);
								// echo $hours.':'.$minutes.':'. $seconds;
							    // Convert minutes and seconds to total seconds and add to the total
							    $total_seconds += ((int)$hours * 3600) + ((int)$minutes * 60) + (int)$seconds;
							    $total_course_seconds += ((int)$hours * 3600) + ((int)$minutes * 60) + (int)$seconds;
							}
						}
							// Calculate total hours, minutes, and remaining seconds
							$total_hours = floor($total_seconds / 3600);
							$remaining_minutes = floor(($total_seconds % 3600) / 60);
							$remaining_seconds = $total_seconds % 60;
							// echo "Total Duration: " . sprintf('%02d:%02d:%02d', $total_hours, $remaining_minutes, $remaining_seconds);
						$num_lessons ++;
						$total_num_lessons ++;
						$is_completed_lesson = tutor_utils()->is_completed_lesson();
						if ($is_completed_lesson) {
							$completed_lessons ++;
						}
						$completed_lessons_percent = ($completed_lessons / $num_lessons)*100;
						?>
						<script type="text/javascript">
							jQuery('.topic-duration-<?php echo $topic_id;?>').html(' <?php echo ($total_hours?$total_hours.'hrs ':''). ($remaining_minutes?$remaining_minutes.'min ':''). ($remaining_seconds?$remaining_seconds. 'sec':'0'); ?>');
							jQuery('.topic-lectures-<?php echo $topic_id;?>').html(' <?php echo $num_lessons; ?> lectures');
							jQuery('.topic-completed-lessons-<?php echo $topic_id;?>').html(' &nbsp;<?php echo $completed_lessons_percent;?>% finish <span class="count">(<?php echo $completed_lessons.'/'.$num_lessons; ?>)</span>');
						</script>
						<div class="tutor-course-topic-item tutor-course-topic-item-lesson<?php echo esc_attr( get_the_ID() == $current_post->ID ? ' is-active' : '' ); ?>">
							<a href="<?php echo $show_permalink ? esc_url( get_the_permalink() ) : '#'; ?>" data-lesson-id="<?php the_ID(); ?>">
								<div class="tutor-d-flex tutor-mr-32">
									<?php
									$lesson_complete_icon = $is_completed_lesson ? 'checked' : '';
                                    $lesson_completed = $is_completed_lesson ? 'lesson_completed' : '';

									if ( ! $lock_icon ) {
										$markup = "<input $lesson_complete_icon type='checkbox' class='tutor-form-check-input tutor-form-check-circle checks ".$lesson_completed."' disabled readonly />";
										echo wp_kses(
											$markup,
											array(
												'input' => array(
													'checked' => true,
													'class' => true,
													'type' => true,
													'disabled' => true,
													'readonly' => true,
												),
											)
										);
									} else {
										$markup = '<i class="tutor-icon-lock-line tutor-fs-7 tutor-color-muted tutor-mr-4" area-hidden="true"></i>';
										echo wp_kses(
											$markup,
											array(
												'i' => array(
													'class' => true,
													'area-hidden' => true,
												),
											)
										);
									}
									?>
									<span class="tutor-course-topic-item-title tutor-fs-7 tutor-fw-medium">
										<?php the_title(); ?>
									</span>
								</div>

								<div class="tutor-d-flex tutor-ml-auto tutor-flex-shrink-0">
									<?php

									$tutor_lesson_type_icon = $play_time ? 'brand-youtube-bold' : 'document-text';
									$markup                 = '<span class="tutor-course-topic-item-icon tutor-icon-' . $tutor_lesson_type_icon . ' tutor-mr-8 tutor-mt-2" area-hidden="true"></span>';
									echo wp_kses(
										$markup,
										array(
											'span' => array(
												'class' => true,
												'area-hidden' => true,
											),
										)
									);

									if ( $play_time ) {
										$markup = "<span class='tutor-course-topic-item-duration tutor-fs-7 tutor-fw-medium tutor-color-muted tutor-mr-8'>" . tutor_utils()->get_optimized_duration( $play_time ) . '</span>';
										echo wp_kses(
											$markup,
											array(
												'span' => array( 'class' => true ),
											)
										);
									}
									?>
								</div>
							</a>
						</div>
						<?php
					}
				}
				$lessons->reset_postdata();
				do_action( 'tutor/lesson_list/after/topic', $topic_id );
				?>
			</div>
		</div>
		<?php
	}
	$topics->reset_postdata();

	$total_course_hours = floor($total_course_seconds / 3600);
	$total_course_minutes = floor(($total_course_seconds % 3600) / 60);
	$cal_course_seconds = $total_course_seconds % 60;

	$convertedTime = gmdate('H \h\r\s i \m\i\n\s s \s\e\c', mktime($total_course_hours, $total_course_minutes, $cal_course_seconds, 1, 1, 1970));
	?>
	<script type="text/javascript">
		jQuery('.total-course-topics').html(' <?php echo ($total_topics > 1 ? $total_topics.' Topics' : $total_topics.' Topic'); ?>');
		jQuery('.total-course-lessons').html(' <?php echo ($total_num_lessons > 1 ? $total_num_lessons.' Lectures' : $total_num_lessons.' Lecture'); ?>');
		jQuery('.total-course-time').html(' <?php echo ($convertedTime); ?>');
	</script>
	<?php
	wp_reset_postdata();
}
?>
<?php do_action( 'tutor_lesson/single/after/lesson_sidebar' ); ?>
