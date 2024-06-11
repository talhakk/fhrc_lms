<section class="course-video">
    <div class="container">
        <div class="inner">
            <!-- <div class="video-wrapper"> -->

<?php
$course_id     = get_the_ID();
$course_rating = tutor_utils()->get_course_rating( $course_id );
$is_enrolled   = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );
$course_nav_item = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id );
$is_mobile       = wp_is_mobile();
// tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail();
tutor_utils()->has_video_in_single() ? tutor_course_video() : '';
if (tutor_utils()->has_video_in_single()){
    $mt = 'tutor-mt-32';
} else {
    $mt = '';
}
?>
                <?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>

                <?php if ( $is_mobile && 'top' === $enrollment_box_position ) : ?>
                    <div class="tutor-mt-32">
                        <?php tutor_load_template( 'single.course.course-entry-box' ); ?>
                    </div>
                <?php endif; ?>

                <div class="tutor-course-details-tab <?php echo $mt;?>">
                    <?php if ( is_array( $course_nav_item ) && count( $course_nav_item ) > 1 ) : ?>
                        <div class="tutor-is-sticky">
                            <?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_item ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="tutor-tab tutor-pt-24">
                        <?php foreach ( $course_nav_item as $key => $subpage ) : ?>
                            <div id="tutor-course-details-tab-<?php echo esc_attr( $key ); ?>" class="tutor-tab-item<?php echo 'info' == $key ? ' is-active' : ''; ?>">
                                <?php
                                    do_action( 'tutor_course/single/tab/' . $key . '/before' );

                                    $method = $subpage['method'];
                                if ( is_string( $method ) ) {
                                    $method();
                                } else {
                                    $_object = $method[0];
                                    $_method = $method[1];
                                    $_object->$_method( get_the_ID() );
                                }

                                    do_action( 'tutor_course/single/tab/' . $key . '/after' );
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
            <!-- </div> -->
        </div>
    </div>
</section>