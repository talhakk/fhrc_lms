<?php

function build_custom_query($post_type = '', $length = -1, $start = 0, $search = '', $taxonomy = '', $field = 'slug', $term = '', $OrderBy = 'id', $OrderQuerry = 'asc', $post_status = 'publish')
{
	$args = array(
		'post_type' => $post_type,
		'orderby' => $OrderBy,
		'order' => $OrderQuerry,
		'post_status' => $post_status,
	);
    // if (is_user_logged_in() && !current_user_can('administrator')) {
		
	// 	$current_user_id = get_current_user_id();
	// 	$args['author'] = $current_user_id;
	// }
	if ($length) {
		$args['posts_per_page'] = $length;
	}
	if ($start) {
		$args['offset'] = $start;
	}
	if ($search) {
		$args['s'] = $search;
	}
	if ($term && $taxonomy && $field) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field' => $field,
				'terms' => $term,
			),
		);
	}
	return $args;
}
?>