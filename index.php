<?php
/* Template Name: Home */
get_header();
?>

<?php get_template_part( 'parts/loop', 'press', array(
	'title' => pll__( 'In The News' ),
	'count' => 6
) ); ?>

<?php get_template_part( 'parts/loop', 'partners' ); ?>

<?php get_footer(); ?>