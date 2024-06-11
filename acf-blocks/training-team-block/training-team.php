<?php 
    $ttb_heading = get_field( 'ttb_heading' );
    $ttb_sub_heading = get_field( 'ttb_sub_heading' );
    $query_parameter = get_field( 'query_parameter' );
    $number_of_cards_in_row = get_field( 'number_of_cards_in_row' );

    switch ($number_of_cards_in_row) {
        case '1':
            $col = '12';
            break;
        case '2':
            $col = '6';
            break;
        case '3':
            $col = '4';
            break;
        case '4':
            $col = '3';
            break;
        
        default:
            $col = '4';
            break;
    }
    $query_limit = $query_parameter['query_limit'];
    $query_offset = $query_parameter['query_offset'];
    $search_argument = $query_parameter['search_argument'];
    $query_order_by = $query_parameter['query_order_by'];
    $order_sort = $query_parameter['order_sort'];
    $post_status = $query_parameter['post_status'];
?>
<section class="our-team">
    <div class="container">
        <div class="inner">
            <div class="head text-center no-border">
                <h2 class="mb-2"><?php echo (isset($ttb_heading)?$ttb_heading:'');?></h2>
                <h3><?php echo (isset($ttb_sub_heading)?$ttb_sub_heading:'');?></h3>
            </div>
            <div class="team-cards row gy-4">
                <?php
                    // Get all users with the 'tutor_instructor' role
                    $instructor_users = get_users(array('role' => 'tutor_instructor', 'number' => 10, '_tutor_instructor_status' => 'approved', 'orderby' => 'ID', 'order' => 'ASC'));

                    // Loop through the instructors
                    foreach ($instructor_users as $instructor) {
                        // Access instructor details
                        $instructor_id = $instructor->ID;
                        $instructor_name = $instructor->display_name;
                        $instructor_email = $instructor->user_email;

                        // Get the list of courses for the instructor
                        $courses = tutor_utils()->get_instructor_courses($instructor_id);
                        $instructor_ratings = tutor_utils()->get_instructor_ratings($instructor_id);
                        $count_courses = count(tutor_utils()->get_courses_by_instructor($instructor_id));
                        $total_students   = tutor_utils()->get_total_students_by_instructor( $instructor_id );
                        $instructor_profile_link = tutor_utils()->get_tutor_dashboard_page_permalink($instructor_id);
                        $instructor_avatar = get_avatar($instructor_id, 150);
                        $bio      = get_user_meta( $instructor_id, '_tutor_profile_bio', true );
                        ?>
                        <div class="col-lg-<?php echo $col;?> col-sm-6">
                            <div class="card">
                                    <a href="<?php echo site_url()."/profile/".$instructor->user_nicename; ?>"><?php echo $instructor_avatar;?>
                                    </a>
                                <div class="content">
                                    <h3><a href="<?php echo site_url()."/profile/".$instructor->user_nicename; ?>"><?php echo ($instructor_name?$instructor_name:"&nbsp;");?></a></h3>
                                    <h6><?php echo (get_user_meta( $instructor_id, '_tutor_profile_job_title', true)?get_user_meta( $instructor_id, '_tutor_profile_job_title', true):"&nbsp;");?></h6>
                                    <?php echo $bio; ?>
                                    <a href="<?php echo site_url()."/profile/".$instructor->user_nicename; ?>" class="btn link read_more_desc_link" id="">Show more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>