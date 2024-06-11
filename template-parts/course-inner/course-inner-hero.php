<section class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
    <div class="overlay"></div>
    <div class="container">
        <div class="inner">
            <div class="welcome-note">
                <p>COURSE DESCRIPTION</p>
            </div>
            <div class="hero-details">
                <h1><?php the_title(); ?></h1>
                <?php 
                    the_content();                
                ?>
            </div>
            <div class="hero-btns">
                <!-- <a href="" class="btn">request Training</a>-->
                <!-- <a href="" class="btn">enroll now</a> -->
                <?php /*
                    $product_id = tutor_utils()->get_course_product_id();
                    $product    = wc_get_product( $product_id );

                    $is_logged_in             = is_user_logged_in();
                    $enable_guest_course_cart = tutor_utils()->get_option( 'enable_guest_course_cart' );
                    $required_loggedin_class  = '';
                    if ( ! $is_logged_in && ! $enable_guest_course_cart ) {
                        $required_loggedin_class = apply_filters( 'tutor_enroll_required_login_class', 'tutor-open-login-modal' );
                    }

                    if ( $product ) {
                        if ( tutor_utils()->is_course_added_to_cart( $product_id, true ) ) {
                            ?>
                                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="tutor-btn tutor-btn-outline-primary tutor-btn-lg tutor-btn-block tutor-woocommerce-view-cart">
                                    <?php esc_html_e( 'View Cart', 'tutor' ); ?>
                                </a>
                            <?php
                        } else {
                            $regular_price = wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
                            $sale_price    = wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) );
                            $tax_display   = get_option( 'woocommerce_tax_display_shop' );
                            ?>
                            <form action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="tutor-btn btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-add-to-cart-button <?php echo esc_attr( $required_loggedin_class ); ?>">
                                    <span class="btn-icon tutor-icon-cart-filled"></span>
                                    <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
                                </button>
                            </form>
                            <?php
                        }
                    } */ ?>
            </div>
        </div>
    </div>
</section>