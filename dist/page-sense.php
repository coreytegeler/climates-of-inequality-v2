<?php
/* Template Name: Sense Your Place */
get_header();
?>

<div class="container mt-xxl pt-xxl">

	<h2 class="text-center mb-md">
		<?= pll__( $title ); ?>
	</h2>

	<?php get_template_part( 'parts/filter', 'dropdowns', array(
		'params' => isset( $args['params'] ) ? $args['params'] : null,
		'filters' => array(
			array(
				'default' => pll__( 'Location' ),
				'type' => 'post',
				'value' => 'location'
			)
		)
	) ); ?>

	<?php get_template_part( 'parts/filter', 'notice', null ); ?>

	<div id="loop" data-post-type="map">
		
		<?php get_template_part( 'parts/loop', 'map', array(
			'query' => array(
				'name' => 'albany-ny'
			)
		) ); ?>

	</div>

</div>

<?php get_footer(); ?>



