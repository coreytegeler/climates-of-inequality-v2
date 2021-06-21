<?php
/* Template Name: Resources */
get_header();

$page = $post;

$groups = get_terms( array(
	'taxonomy' => 'resource_group',
	'hide_empty' => false,
	'number' => false,
	'order' => 'ASC',
	'orderby' => 'tax_position'
) );

$sections = array();
foreach ( $groups as $group ) {
	$sections[] = $group->name;
} ?>

<?php get_template_part( 'parts/nav', 'page', array(
	'sections' => $sections
) ); ?>

<?php foreach( $groups as $group ) {
	get_template_part( 'parts/loop', 'resource', array(
		'title' => $group->name,
		'slug' => $group->slug,
	) );
} ?>


<?= get_footer(); ?>