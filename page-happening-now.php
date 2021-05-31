<?php
/* Template Name: Happening Now */
get_header();
?>

<div class="container">

	<div class="row justify-content-center">

		<div class="col col-12 col-lg-10 col-xl-8">

			<?php get_template_part( 'parts/filter', 'dropdowns', array(
				'params' => isset( $args['params'] ) ? $args['params'] : null,
				'filters' => array(
					array(
						'default' => pll__( 'Theme' ),
						'type' => 'taxonomy',
						'value' => 'happening_theme'
					),
					array(
						'default' => pll__( 'Location' ),
						'type' => 'post',
						'value' => 'location'
					),
					array(
						'default' => pll__( 'Date' ),
						'type' => 'date',
						'value' => 'happening'
					)
				)
			) ); ?>

		</div>

	</div>

	<?php get_template_part( 'parts/filter', 'notice', null ); ?>

</div>

<div class="container" id="loop" data-post-type="happening">

	<?php get_template_part( 'parts/loop', 'happening', array(
		'query' => array(
			'posts_per_page' => -1,
		)
	) ); ?>

</div>


<?php get_footer(); ?>