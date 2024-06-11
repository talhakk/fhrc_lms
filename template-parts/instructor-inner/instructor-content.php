<?php
/**
 * Template part for displaying team members
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package freedome-house
 */
?>
<?php
$sigle_member_id = $post->ID;
$memberImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<section class="instructor-inner">
    <div class="container">
        <div class="inner">
            <div class="welcome-note">
                <p>THE INSTRUCTOR</p>
            </div>
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="image-wrapper">
                        <img src="<?php echo $memberImg[0]; ?>" alt="">
                        <a href=""><span>Need Help?</span><span><i class="fa-regular fa-envelope"></i></span></a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="details">
                        <div class="head small">
                            <h2><?php echo get_the_title();?></h2>
                            <span class="member-designation"><?php echo get_field('team_member_designation'); ?></span>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /* ?>
<?php
              // Query arguments for retrieving all posts of the custom post type 'location-cpt'
              $args = array(
                  'post_type'      => 'training-team',
                  'post_status'    => 'publish',
                  'posts_per_page' => -1, // Set to -1 to retrieve all posts
                  'orderby' => 'ID', // Order by post ID
                  'order' => 'ASC', // Ascending order
                  'tax_query' => array(
                                        array(
                                            'taxonomy' => 'team-role',
                                            'field'    => 'slug',
                                            'terms'    => 'team-member', // Replace with your category slug
                                        ),
                                      ),
                  'post__not_in'   => array($sigle_member_id), // Exclude post with ID 123
              );

              // Create a new instance of WP_Query
              $our_team_cpt_query = new WP_Query($args);

              // Check if there are posts found
              if ($our_team_cpt_query->have_posts()) {
                  // Loop through each post
                $i = 1;
                while ($our_team_cpt_query->have_posts()) {
                  $our_team_cpt_query->the_post();
                  $post_id_lop = get_the_ID();
                  $memberImg_lop = wp_get_attachment_image_src( get_post_thumbnail_id($post_id_lop), 'full' );
            ?>
<section class="instructor-inner">
    <div class="container">
        <div class="inner">
            <!-- <div class="welcome-note">
                <p>THE INSTRUCTOR</p>
            </div> -->
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="image-wrapper">
                        <img src="<?php echo $memberImg_lop[0]; ?>" alt="">
                        <a href=""><span>Need Help?</span><span><i class="fa-regular fa-envelope"></i></span></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="details">
                        <div class="head small">
                            <h2><?php echo get_the_title();?></h2>
                            <span class="member-designation"><?php echo get_field('team_member_designation'); ?></span>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
          <?php 
              $i++;
                }
                  // Restore the global post data
                  wp_reset_postdata();
              } else {
                  // No posts found
                  echo 'No Team Member found.';
              }

            ?>
            <?php */ ?>
</section>