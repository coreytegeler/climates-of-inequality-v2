<?php
/* Template Name: Take Action */

$args = array(
	'child_of' => $post->ID,
	'order' => 'DESC',
	'sort_column' => 'menu_order'
);
$child = get_pages( $args )[1];
wp_redirect( get_permalink( $child ), 301 );
exit;
?>