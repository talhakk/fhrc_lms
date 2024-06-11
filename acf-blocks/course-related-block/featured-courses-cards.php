
  <?php
    $fcb_heading = get_field('fcb_heading');
    $fcb_sub_heading = get_field('fcb_sub_heading');
    $fcb_query_parameter = get_field('query_parameter');
    $fcb_number_of_cards_in_row = get_field('number_of_cards_in_row');
    $query_limit = ($fcb_query_parameter['query_limit'] ? $fcb_query_parameter['query_limit'] : '-1');

    switch ($fcb_number_of_cards_in_row) {
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

    $fcb_taxonomy = (isset($fcb_query_parameter['tax_query'][0]['taxonomy']) ? $fcb_query_parameter['tax_query'][0]['taxonomy'] : '');
    $field = (isset($fcb_query_parameter['tax_query'][0]['field']) ? $fcb_query_parameter['tax_query'][0]['field'] : '');
    $terms = (isset($fcb_query_parameter['tax_query'][0]['terms']) ? $fcb_query_parameter['tax_query'][0]['terms'] : '');
    ?>
  <section class="training-cards">
      <div class="container">
          <div class="inner">
              <div class="head d-flex justify-content-between align-items-center px-2">
                  <h2><?php echo (isset($fcb_heading) ? $fcb_heading : ''); ?></h2>
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

              <div class="d-flex align-items-center">
                  <div class="swiper featured px-2 w-100">
                      <div class="swiper-wrapper">
                          <?php
                            // $args_tt = build_custom_query($post_type, $length, $start, $search, $fcb_taxonomy, $fcb_field, $term, $OrderBy, $OrderQuerry, $post_status);
                            // $args_tt = build_custom_query('training-team', 
                            // $fcb_query_parameter['query_limit'], 
                            // $fcb_query_parameter['query_offset'], 
                            // $fcb_query_parameter['search_argument'], 
                            // $fcb_taxonomy, 
                            // $fcb_field, 
                            // $fcb_terms, 
                            // $fcb_query_parameter['query_order_by'], 
                            // $fcb_query_parameter['order_sort'],  
                            // $fcb_query_parameter['post_status']);
                            $args_tt = array(
                                'post_type'      => 'courses',
                                'post_status'    => 'publish',
                                'no_found_rows'  => true,
                                'posts_per_page' => $query_limit,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'course-category',
                                        'field' => 'slug',
                                        'terms' => 'featured-course',
                                    ),
                                ),
                            );
                            $query_fc = new WP_Query($args_tt);
                            $total_records = $query_fc->found_posts;
                            if ($query_fc->have_posts()) {
                                while ($query_fc->have_posts()) {
                                    $query_fc->the_post();
                                    $post_id = get_the_ID();
                                    $backgroundImg_fc = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                                    // print_r($backgroundImg_fc);
                            ?>
                                  <div class="swiper-slide">
                                      <div class="training-card">
                                          <div class="thumnail">
                                              <img class="w-100" src="<?php echo (!empty($backgroundImg_fc[0]) ? esc_url($backgroundImg_fc[0]) : esc_url(plugins_url() . '/tutor/assets/images/placeholder.svg')); ?>" alt="">
                                          </div>
                                          <div class="content">
                                              <h3><?php the_title(); ?></h3>
                                              <p><?php //the_excerpt(); 
                                                    $excerpt = get_the_excerpt($post_id);
                                                    $excerpt = substr($excerpt, 0,170);
                                                    echo $excerpt.'...';
                                              ?></p>
                                              <div class="training-btn align-items-center justify-content-center">
                                                  <a href="<?php echo get_the_permalink(); ?>" class="btn">learn more</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                          <?php
                                }
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
              var totalSlides = $('.swiper.featured .swiper-slide').length;
              var arrowR = $('.swiper-button-lock.swiper-button-next');
              var arrowL = $('.swiper-button-lock.swiper-button-prev');

              if (totalSlides > 3 || $(window).width() <= 991) {
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



      var ins = new Swiper('.swiper.featured', {
          loop: true,
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev'
          },
          slidesPerView: 1,
          spaceBetween: 10,
          breakpoints: {
              991: {
                  slidesPerView: 3,
                  spaceBetween: 20
              },
              767: {
                  slidesPerView: 2,
                  spaceBetween: 10
              }
          }
      });
  </script>