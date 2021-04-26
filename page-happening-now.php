<?php
/* Template Name: Happening Now */
get_header();
?>

<div id="loop-filter">

</div>

<div>
	<?php get_template_part( 'parts/loop', 'happenings', array(
		'title' => '',
		'query' => array(
			'posts_per_page' => -1,
		)
	) ); ?>
</div>

<?php get_footer(); ?>