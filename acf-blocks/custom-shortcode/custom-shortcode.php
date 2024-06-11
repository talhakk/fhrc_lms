<?php 
    $section_heading = (get_field( 'section_heading' )?get_field( 'section_heading' ):'');
    $custom_shortcode_name = (get_field( 'custom_shortcode_name' )?get_field( 'custom_shortcode_name' ):'');
    $included_ids = (get_field( 'included_ids' )? 'id="'.get_field( 'included_ids' ).'"' : '');
    $excluded_ids = (get_field( 'excluded_ids' ) ? 'exclude_ids="'.get_field( 'excluded_ids' ).'"' : '');
    $category = (get_field( 'category' ) ? 'category="'.get_field( 'category' ).'"' : '');
    $orderby = (get_field( 'orderby' ) ? 'orderby="'.get_field( 'orderby' ).'"' : '');
    $order_sort = (get_field( 'order_sort' ) ? 'order="'.get_field( 'order_sort' ).'"' : '');
    $count_or_limit = (get_field( 'count_or_limit' ) ? 'count="'.get_field( 'count_or_limit' ).'"' : '');
    $column_per_row = (get_field( 'column_per_row' ) ? 'column_per_row="'.get_field( 'column_per_row' ).'"' : '');
    $filter = (get_field( 'filter' ) ? 'course_filter="'.get_field( 'filter' ).'"' : '');
    $show_pagination = (get_field( 'show_pagination' ) ? 'show_pagination="'.get_field( 'show_pagination' ).'"' : '');
?>

<section class="starter-courses">
    <div class="container">
        <div class="inner">
            <div class="head small mb-5">
                <h2><?php echo ($section_heading?$section_heading:''); ?></h2>
            </div>
            <?php 
            // echo '['.$custom_shortcode_name.' '.$included_ids.' '.$excluded_ids.' '.$category.' '.$orderby.' '.$order_sort.' '.$count_or_limit.' '.$column_per_row.' '.$filter.' '.$show_pagination.']';exit();
                echo do_shortcode('['.$custom_shortcode_name.' '.$included_ids.' '.$excluded_ids.' '.$category.' '.$orderby.' '.$order_sort.' '.$count_or_limit.' '.$column_per_row.' '.$filter.' '.$show_pagination.']'); 
            ?>
        </div>
    </div>
</section>