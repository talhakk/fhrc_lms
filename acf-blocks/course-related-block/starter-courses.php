<?php
$starter_courses_heading = (get_field('starter_courses_heading') ? get_field('starter_courses_heading') : '');
$starter_courses_tabs = (get_field('starter_courses_tabs') ? get_field('starter_courses_tabs') : '');
?>
<section class="starter-courses"> 
    <div class="container">
        <div class="inner">
            <div class="head small mb-5">
                <h2><?php echo ($starter_courses_heading ? $starter_courses_heading : ''); ?></h2>
            </div>
            <div class="courses-tabs">
                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <?php
                    foreach ($starter_courses_tabs as $key => $sc_value) {
                    ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo ($key == 0 ? ' active ' : ''); ?>" id="ex1-tab-<?php echo $key; ?>" data-bs-toggle="tab" href="#<?php echo trim($sc_value['taxonomy_slug']); ?>" role="tab" aria-controls="<?php echo trim($sc_value['taxonomy_slug']); ?>" aria-selected="true"><?php echo $sc_value['tab_title']; ?></a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
                <div class="tab-content" id="ex1-content">

                    <?php
                    foreach ($starter_courses_tabs as $key => $scc_value) {

                        $swiper_class = 'starter-' . $key;

                    ?>
                        <div class="tab-pane fade <?php echo ($key == 0 ? ' show active ' : ''); ?>" id="<?php echo trim($scc_value['taxonomy_slug']); ?>" role="tabpanel" aria-labelledby="ex1-tab-<?php echo $key; ?>">
                            <div class="featured-cards">
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
                                <div class="swiper <?php echo $swiper_class ?> px-2">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $args = array(
                                            'post_type' => 'courses',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'course-category',
                                                    'field'    => 'slug',
                                                    'terms'    => trim($scc_value['taxonomy_slug']),
                                                ),
                                            ),
                                        );

                                        $courses_query = new WP_Query($args);
                                        if ($courses_query->have_posts()) {
                                            while ($courses_query->have_posts()) {
                                                $courses_query->the_post();
                                                $c_post_id = get_the_ID();
                                                // Output the course information here
                                        ?>



                                                <div class="swiper-slide">
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <!-- ////////////////////// -->
                                                        <div class="tutor-card tutor-course-card mt-2">
                                                            <?php
                                                            $tutor_course_img_src = get_tutor_course_thumbnail_src();

                                                            if ($tutor_course_img_src) {
                                                                $tutor_course_img_src = get_tutor_course_thumbnail_src();
                                                            } else {
                                                                $tutor_course_img_src = '';
                                                            }

                                                            //print_r($tutor_course_img_src_url);

                                                            ?>
                                                            <div class="tutor-course-thumbnail">
                                                                <a href="<?php the_permalink(); ?>" class="tutor-d-block">
                                                                    <div class="tutor-ratio tutor-ratio-16x9">
                                                                        <img class="tutor-card-image-top" src="<?php echo $tutor_course_img_src; ?>" alt="<?php the_title(); ?>" loading="lazy">
                                                                    </div>
                                                                </a>
                                                                <?php do_action('tutor_after_course_loop_thumbnail_link', get_the_ID()); ?>
                                                            </div>
                                                            <div class="tutor-course-bookmark">
                                                                <a href="javascript:;" class="tutor-course-wishlist-btn save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary" data-course-id="<?php echo get_the_ID(); ?>">
                                                                    <i class="tutor-icon-bookmark-line"></i>
                                                                </a>
                                                            </div>
                                                            <div class="tutor-card-body">
                                                                <?php
                                                                do_action('tutor_course/loop/before_title');
                                                                do_action('tutor_course/loop/title');
                                                                do_action('tutor_course/loop/after_title');
                                                                ?>
                                                                <?php
                                                                do_action('tutor_course/loop/before_rating');
                                                                do_action('tutor_course/loop/rating');
                                                                do_action('tutor_course/loop/after_rating');
                                                                ?>
                                                                <?php
                                                                do_action('tutor_course/loop/before_meta');
                                                                do_action('tutor_course/loop/meta');
                                                                do_action('tutor_course/loop/after_meta');
                                                                ?>
                                                                <?php
                                                                $post_excerpt = get_the_excerpt(); // Assuming you want to assign the excerpt to a variable.
                                                                ?>
                                                                <p>
                                                                    <?php
                                                                    if (!empty($post_excerpt)) {
                                                                        echo $post_excerpt;
                                                                    } ?>
                                                                </p>


                                                                <!-- // --------------------------------------------------- -->
                                                                <?php
                                                                $course_price_str             = tutor_utils()->get_raw_course_price(get_the_ID());
                                                                $publish_date_str = get_the_date('M d Y', get_the_ID());
                                                                ?>
                                                                <div class="post-details mt-auto">
                                                                    <center>
                                                                        <!-- <span class="price"><?php //echo (tutils()->price_type() != 'free' ? tutor_utils()->currency_symbol() . $course_price_str->sale_price : tutor_utils()->currency_symbol() . '0.00'); ?></span> -->
                                                                        <?php
                                                                        $course_duration_str = (get_post_meta(get_the_ID(), '_course_duration', true));
                                                                        // print_r($course_duration);
                                                                        if (is_array($course_duration_str)) {
                                                                            $convert_duration_str = convertHoursToMonthsWeeksDays($course_duration_str['hours'], $course_duration_str['minutes'], $course_duration_str['seconds']);
                                                                            if ($convert_duration_str['months'] > 0) {
                                                                                $course_duration_string = $convert_duration_str['months'] . ' Month' . ($convert_duration_str['months'] > 1 ? 's' : '');
                                                                            } elseif ($convert_duration_str['weeks'] > 0) {
                                                                                $course_duration_string = $convert_duration_str['weeks'] . ' Week' . ($convert_duration['weeks'] > 1 ? 's' : '');
                                                                            } elseif ($convert_duration_str['days'] > 0) {
                                                                                $course_duration_string = $convert_duration_str['days'] . ' Day' . ($convert_duration_str['days'] > 1 ? 's' : '');
                                                                            } else {
                                                                                $course_duration_string = ($course_duration_str['hours'] ? $course_duration_str['hours'] . 'hr ' : '') . ($course_duration_str['minutes'] ? $course_duration_str['minutes'] . 'min ' : '') . ($course_duration_str['seconds'] ? $course_duration_str['seconds'] . 'sec ' : '');
                                                                            }
                                                                        }

                                                                        ?>
                                                                        <span class="duration"><?php echo (isset($course_duration_string) ? $course_duration_string : '0 sec'); ?>&nbsp;|&nbsp;</span>
                                                                        <span class="date"><?php echo ($publish_date_str? 'Publish date: '.$publish_date_str:''); ?></span>
                                                                    </center>
                                                                </div>
                                                                <!-- // --------------------------------------------------- -->
                                                            </div>
                                                            <div class="tutor-card-footer">
                                                            <?php
                                                           /* if ($scc_value['taxonomy_slug'] == 'on-site' || $scc_value['taxonomy_slug'] == 'online') { */?>
                                                                   <!--  <button class="btn w-100" onclick="window.location.href='<?php the_permalink(); ?>'">
                                                                            More Detail...
                                                                    </button> -->
                                                                    <a href="<?php the_permalink(); ?>" class="btn tutor-btn tutor-btn-outline-primary tutor-btn-md tutor-btn-block " target="_parent">More Details…
                                                                    </a>
                                                           <?php 
                                                           /* } else {
                                                                tutor_course_loop_price();
                                                            } */
                                                           ?>
                                                            </div>
                                                        </div>
                                                        <!-- ////////////////////// -->
                                                    </a>
                                                </div>
                                        <?php
                                            }
                                            wp_reset_postdata();
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo '<script>
                                        $(document).ready(function() {
                                            function handleArrowVisibility() {
                                                var totalSlides = $(".' . $swiper_class . ' .swiper-slide").length;
                                                var arrowR' . $key . ' = $(".featured-cards:has(.' . $swiper_class . ') .swiper-button-next");
                                                var arrowL' . $key . ' = $(".featured-cards:has(.' . $swiper_class . ') .swiper-button-prev");

                                                if (totalSlides > 4 || $(window).width() <= 991) {
                                                    arrowR' . $key . '.css("display", "flex");
                                                    arrowL' . $key . '.css("display", "flex");
                                                } else {
                                                    arrowR' . $key . '.css("display", "none");
                                                    arrowL' . $key . '.css("display", "none");
                                                }
                                            }

                                            // Initial handling
                                            handleArrowVisibility();

                                            // Handle resizing
                                            $(window).resize(function() {
                                                handleArrowVisibility();
                                            });
                                        });

                                        var ins = new Swiper(".' . $swiper_class . '", {
                                            loop: true,
                                            navigation: {
                                                nextEl: ".featured-cards:has(.' . $swiper_class . ') .swiper-button-next",
                                                prevEl: ".featured-cards:has(.' . $swiper_class . ') .swiper-button-prev"
                                            },
                                            slidesPerView: 1,
                                            spaceBetween: 20,
                                            breakpoints: {
                                                1170: {
                                                    slidesPerView: 4,
                                                    spaceBetween: 20
                                                },
                                                991: {
                                                    slidesPerView: 3,
                                                    spaceBetween: 20
                                                },
                                                680: {
                                                    slidesPerView: 2,
                                                    spaceBetween: 10
                                                }
                                            }
                                        });
                                    </script>';
                            ?>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>