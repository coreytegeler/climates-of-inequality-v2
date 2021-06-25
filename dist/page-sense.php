<?php
/* Template Name: Take Action Subpage */
get_header();
?>

<?php get_template_part( 'parts/action', null, array(
		'action' => get_field( 'action_type' )
	)
); ?>

<?php get_footer(); ?>