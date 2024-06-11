<?php
$testimonial_slider_heading = (get_field('testimonial_slider_heading') ? get_field('testimonial_slider_heading') : '');
?>
<section class="instructor-slider">
    <div class="container">
        <div class="inner">
            <div class="head small mb-4 d-flex align-items-center justify-content-between">
                <h2><?php echo ($testimonial_slider_heading ? $testimonial_slider_heading : 'popular instructors'); ?></h2>
                <div class="navigation-btns">
                    <div class="swiper-button-prev " style="position: unset;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                            <path d="M11.4531 10.2484L17.5598 16.3684L11.4531 22.4884L13.3331 24.3684L21.3331 16.3684L13.3331 8.36841L11.4531 10.2484Z" fill="white" />
                        </svg>
                    </div>
                    <div class="swiper-button-next " style="position: unset;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                            <path d="M11.4531 10.2484L17.5598 16.3684L11.4531 22.4884L13.3331 24.3684L21.3331 16.3684L13.3331 8.36841L11.4531 10.2484Z" fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="swiper-section">
                <div class="swiper instructor pb-1">
                    <div class="swiper-wrapper">
                        <?php
                        // Get all users with the 'tutor_instructor' role
                        $instructor_users = get_users(array('role' => 'tutor_instructor'));

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
                            $total_students   = tutor_utils()->get_total_students_by_instructor($instructor_id);
                            $instructor_profile_link = tutor_utils()->get_tutor_dashboard_page_permalink($instructor_id);
                            $instructor_avatar = get_avatar($instructor_id, 150);
                        ?>
                            <div class="swiper-slide">
                                <a href="<?php echo site_url() . "/profile/" . $instructor->user_nicename; ?>" class=" w-100">
                                    <div class="instructor-card w-100">
                                        <!-- <img src="<?php echo ($instructor_profile_photo_src ? esc_url($instructor_profile_photo_src) : esc_url(content_url() . '/plugins/tutor/assets/images/profile-photo.png')); ?>" alt=""> -->
                                        <?php echo $instructor_avatar; ?>
                                        <div class="details">
                                            <h3><?php echo ($instructor_name ? $instructor_name : "&nbsp;"); ?></h3>
                                            <h6><?php echo (get_user_meta($instructor_id, '_tutor_profile_job_title', true) ? get_user_meta($instructor_id, '_tutor_profile_job_title', true) : "&nbsp;"); ?></h6>
                                            <span class="rating"><?php echo ($instructor_ratings->rating_avg ? $instructor_ratings->rating_avg : "No &nbsp;"); ?>
                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_2978_1557)">
                                                        <path d="M8.11271 12.0362L12.2327 14.5229L11.1394 9.8362L14.7794 6.68287L9.98604 6.2762L8.11271 1.8562L6.23938 6.2762L1.44604 6.68287L5.08604 9.8362L3.99271 14.5229L8.11271 12.0362Z" stroke="#B4690E" stroke-width="1.33333" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_2978_1557">
                                                            <rect width="16" height="16" fill="white" transform="translate(0.112793 0.522827)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                Instructor rating
                                            </span>
                                            <span class="black-span"><strong><?php echo ($total_students ? $total_students : "0 &nbsp;"); ?> </strong>students</span>
                                            <span class="black-span"><strong><?php echo ($count_courses ? $count_courses : "0 &nbsp;"); ?> </strong>courses</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        function handleArrowVisibility() {
            var totalSlides = $('.swiper.instructor .swiper-slide').length;
            var arrowR = $('.instructor-slider .swiper-button-next');
            var arrowL = $('.instructor-slider .swiper-button-prev');

            if (totalSlides > 4 || $(window).width() <= 1170) {
                arrowR.css('display', 'flex');
                arrowL.css('display', 'flex');
            } else {
                arrowR.css('display', 'none');
                arrowL.css('display', 'none');
            }
        }

        // Initial handling
        handleArrowVisibility();

        // Handle resizing
        $(window).resize(function() {
            handleArrowVisibility();
        });
    });

    var ins = new Swiper('.swiper.instructor', {
        loop: true,
        navigation: {
            nextEl: '.instructor-slider .swiper-button-next',
            prevEl: '.instructor-slider .swiper-button-prev'
        },
        slidesPerView: 1,
        breakpoints: {
            1170: {
                slidesPerView: 4,
                spaceBetween: 20
            },
            840: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10
            }
        }
    });
</script>