<?php
/**
 * Enrollment list managements for the backend admin page
 *
 * @package Enrollment List.
 */

namespace TUTOR_ENROLLMENTS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use TUTOR\Backend_Page_Trait;
use Tutor\Helpers\QueryHelper;
use TUTOR\Input;
use TUTOR\User;
use Tutor\Models\CourseModel;
/**
 * Enrollment list managements for the backend admin page
 *
 * @package Enrollment List.
 */
class Extended_Enrollments_List extends Enrollments_List {

	/**
	 * Trait for utilities
	 *
	 * @var $page_title
	 */

	use Backend_Page_Trait;
	/**
	 * Page Title
	 *
	 * @var $page_title
	 */
	public $page_title;

	/**
	 * Bulk Action
	 *
	 * @var $bulk_action
	 */
	public $bulk_action = true;

	/**
	 * Handle dependencies
	 */
	public function __construct() {
		$this->page_title = __( 'Enrollment', 'tutor' );
		/**
		 * Handle bulk action
		 *
		 * @since v2.0.0
		 */
		add_action( 'wp_ajax_tutor_enrollment_bulk_action', array( $this, 'enrollment_bulk_action' ) );
	}

	/**
	 * Available tabs that will visible on the right side of page navbar
	 *
	 * @param string $course_id selected course id | optional.
	 * @param string $date selected date | optional.
	 * @param string $search search by user name or email | optional.
	 * @return array
	 * @since v2.0.0
	 */
	public function tabs_key_value( $course_id, $date, $search ): array {
		$url       = get_pagenum_link();
		$approved  = self::get_enrolled_number( 'completed', $course_id, $date, $search );
		$cancelled = self::get_enrolled_number( 'cancel', $course_id, $date, $search );
		$tabs      = array(
			array(
				'key'   => 'all',
				'title' => __( 'All', 'tutor-pro' ),
				'value' => $approved + $cancelled,
				'url'   => $url . '&data=all',
			),
			array(
				'key'   => 'approved',
				'title' => __( 'Approved', 'tutor-pro' ),
				'value' => $approved,
				'url'   => $url . '&data=approved',
			),
			array(
				'key'   => 'cancelled',
				'title' => __( 'Cancelled', 'tutor-pro' ),
				'value' => $cancelled,
				'url'   => $url . '&data=cancelled',
			),
		);
		return $tabs;
	}

	/**
	 * Prepare bulk actions that will show on dropdown options
	 *
	 * @return array
	 * @since v2.0.0
	 */
	public function prpare_bulk_actions(): array {
		$actions = array(
			$this->bulk_action_default(),
			array(
				'value'  => 'complete',
				'option' => __( 'Approve', 'tutor' ),
			),
			
			$this->bulk_action_cancel(),

			array(
				'value'  => 'generate_cirtificate',
				'option' => __( 'Generate Cirtificate', 'tutor' ),
			),
		);
		return $actions;
	}

	/**
	 * Count enrolled number by status & filters
	 * Count all enrollment | approved | cancelled
	 *
	 * @param string $status | required.
	 * @param string $course_id selected course id | optional.
	 * @param string $date selected date | optional.
	 * @param string $search_term search by user name or email | optional.
	 * @return int
	 * @since v2.0.0
	 */
	protected static function get_enrolled_number( string $status, $course_id = '', $date = '', $search_term = '' ): int {
		global $wpdb;
		$status      = sanitize_text_field( $status );
		$course_id   = sanitize_text_field( $course_id );
		$date        = sanitize_text_field( $date );
		$search_term = sanitize_text_field( $search_term );

		$search_term = '%' . $wpdb->esc_like( $search_term ) . '%';

		// add course id in where clause.
		$course_query = '';
		if ( '' !== $course_id ) {
			$course_query = "AND course.ID = $course_id";
		}

		// add date in where clause.
		$date_query = '';
		if ( '' !== $date ) {
			$date_query = "AND DATE(enrol.post_date) = CAST('$date' AS DATE) ";
		}

		$count = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*)
					FROM 	{$wpdb->posts} enrol
							INNER JOIN {$wpdb->posts} course
									ON enrol.post_parent = course.ID
							INNER JOIN {$wpdb->users} student
									ON enrol.post_author = student.ID
					WHERE 	enrol.post_type = %s
							AND enrol.post_status = %s
							{$date_query}
							{$course_query}
							AND ( enrol.ID LIKE %s OR student.display_name LIKE %s OR student.user_email LIKE %s OR course.post_title LIKE %s )
					",
				'tutor_enrolled',
				$status,
				$search_term,
				$search_term,
				$search_term,
				$search_term
			)
		);
		return $count ? $count : 0;
	}

	/**
	 * Handle bulk action for enrolment list
	 *
	 * @since 2.0.0
	 *
	 * @return void JSON response.
	 */
	public function enrollment_bulk_action() {
		tutor_utils()->checking_nonce();

		$status   = Input::post( 'bulk-action', '' );
		$bulk_ids = Input::post( 'bulk-ids', '' );
		$bulk_ids = explode( ',', $bulk_ids );
		$bulk_ids = array_filter(
			$bulk_ids,
			function( $id ) {
				return is_numeric( $id );
			}
		);

		if ( 'delete' === $status ) {
			self::delete_cancelled_enrollment( $bulk_ids );
		} else {
			self::update_enrollments( $status, $bulk_ids );
		}

		wp_send_json_success();
	}

	/**
	 * Delete only cancelled enrollment
	 *
	 * @since 2.2.4
	 *
	 * @param array $bulk_ids id list.
	 *
	 * @return void
	 */
	public static function delete_cancelled_enrollment( $bulk_ids ) {
		if ( ! User::is_admin() ) {
			wp_send_json_error( array( 'message' => __( 'Unauthorized action', 'tutor-pro' ) ) );
		}

		global $wpdb;
		$ids_str = QueryHelper::prepare_in_clause( $bulk_ids );

		// Delete course progress for selected ids.
		foreach ( $bulk_ids as $id ) {
			$course_id  = get_post_field( 'post_parent', $id );
			$student_id = get_post_field( 'post_author', $id );

			if ( $course_id && $student_id ) {
				tutor_utils()->delete_course_progress( $course_id, $student_id );
			}
		}

		// Now delete selected cancelled enrollments.
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM {$wpdb->posts}
				WHERE ID IN ($ids_str)
				AND post_type = %s
				AND post_status = %s
			",
				'tutor_enrolled',
				'cancel'
			)
		);
	}

	/**
	 * Execute bulk action for enrollment list ex: complete | cancel
	 *
	 * @param string $status hold status for updating.
	 * @param array  $enrollment_ids ids that need to update.
	 * @return bool
	 * @since v2.0.0
	 */
	public static function update_enrollments( string $status, array $enrollment_ids ): bool {
		global $wpdb;
		$enrollment_ids_in = implode( ',', $enrollment_ids );
		$status            = 'complete' === $status ? 'completed' : $status;
		if ($status == 'generate_cirtificate') {
			foreach ($enrollment_ids as $enrol_id) {
				$user_id = get_post_field('post_author', $enrol_id);
				$course_id = get_post_field('post_parent', $enrol_id);
				CourseModel::mark_course_as_completed( $course_id, $user_id );
			}
		} else {
			$post_table        = $wpdb->posts;
			$update            = $wpdb->query(
				$wpdb->prepare(
					" UPDATE {$post_table}
					SET post_status = %s
					WHERE ID IN ($enrollment_ids_in)
				",
					$status
				)
			);
		}
		
		// Run action hook.
		foreach ( $enrollment_ids as $id ) {
			do_action( 'tutor_enrollment/after/' . $status, $id );
		}

		return true;
	}
}
