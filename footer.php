<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FHRC_LMS
 */
?>

<footer id="freedom-footer">
    <div class="container">
        <div class="inner">
            <div class="row gy-4">
                <div class="col-xl-3 col-lg-6 col-md-6 ">
                    <div class="footer-info">
                        <div class="footer-logos">
                            <a href="#"><img class="w-100" src="<?php the_field('freedom_house_logo_image', 'option'); ?>" alt=""></a>
                        </div>
                        <div class="carf-details">
                            <a target="_blank" href="https://www.carf.org/home/"><img src="<?php the_field('freedom_house_carf_image', 'option'); ?>" alt=""></a>
                            <p>
                                <?php the_field('freedom_house_carf_text', 'option'); ?> </p>
                        </div>
                        <div class="carf-details">
                            <a target="_blank" href="http://bit.ly/2Lpqlaq"><img src="<?php the_field('freedom_house_nhsc_badge', 'option'); ?>" alt=""></a>
                            <p>
                                <?php the_field('freedom_house_nhsc_text', 'option'); ?> </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="custom-wrapper-content">
                        <h5>

                            <?php the_field('footer_contact_main_heading', 'option'); ?> </h5>
                        <?php if (have_rows('footer_contact_list_items', 'option')) : ?>
                            <ul class="nav flex-column">
                                <?php while (have_rows('footer_contact_list_items', 'option')) :
                                    the_row(); ?>
                                    <li class="mb-2">
                                        <?php the_sub_field('contact_heading_label', 'option'); ?>: <a href="<?php the_sub_field('link_url', 'option'); ?>" class="p-0">
                                            <?php the_sub_field('link_text', 'option'); ?> </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="custom-wrapper-cnt">
                        <div class="map" style="overflow: hidden;">
                            <iframe src="<?php the_field('footer_map_iframe_src', 'option'); ?>" width="1000" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between footer-copyright align-items-center">
                <p><?php the_field('copy_rights_text', 'option'); ?></p>
                <ul class="list-unstyled d-flex">
                    <?php 
                        $footer_pages_rows = get_field('footer_pages_links', 'option');
                        if($footer_pages_rows)
                        {
                            foreach($footer_pages_rows as $row)
                            {
                                echo '<li><a href="' . $row['page_link']['url'] . '" class="' . $row['custom_class'] . '">' . $row['page_link']['title'] . '</a></li>';
                            }
                        }
                    ?>
                    <!-- <li><a href="">Terms &amp; Conditions</a></li>
                    <li><a rel="privacy-policy" href="">Privacy Policy</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<?php
wp_footer(); ?>
</body>

</html>