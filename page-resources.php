<?php
/* Template Name: Resources */
get_header();

$page = $post;
$groups = get_field( 'groups', $page );
$sections = array();
foreach ( $groups as $group ) {
	$sections[] = $group['title'];
}
$sections[] = pll__( 'Why Does History Matter?' );
?>

<?php get_template_part( 'parts/nav', 'page', array(
	'sections' => $sections
) ); ?>

<?php foreach( $groups as $group ) {
		get_template_part( 'parts/loop', 'resource', array(
		'title' => $group['title'],
		'resources' => $group['resources'],
	) );
} ?>


<?= get_footer(); ?>