<?php
/* Template Name: Exhibitions & Events */
get_header();

$page = $post;
?>

<div class="container">

	<div class="row">

		<div class="col col-2 d-none d-md-block">

			<?php get_template_part( 'parts/loop', 'location', array(
				'title' => 'Past Host',
				'single' => true,
				'query' => array(
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'start_date',
							'value' => date( 'Y/m/d' ),
							'compare' => '<',
							'type' => 'DATE'
						)
					)
				)
			) ); ?>
			
		</div>

		<div class="col col-12 col-md-8">

			<h4><?= pll__( 'Events & Programs' ); ?></h4>

			<div class="xl-text mb-xl">
				<?= wpautop( $page->post_content ); ?>
			</div>

			<?php get_template_part( 'parts/filter', 'dropdowns', array(
				'params' => isset( $args['params'] ) ? $args['params'] : null,
				'filters' => array(
					array(
						'default' => pll__( 'Location' ),
						'type' => 'post',
						'value' => 'location'
					),
					array(
						'default' => pll__( 'Topic' ),
						'type' => 'taxonomy',
						'value' => 'event_topic'
					),
					array(
						'default' => pll__( 'Learning Together' ),
						'type' => 'date',
						'value' => 'happening'
					)
				)
			) ); ?>

			<?php get_template_part( 'parts/filter', 'notice', null ); ?>

			<div id="loop" data-post-type="event">

				<?php get_template_part( 'parts/loop', 'event' ); ?>

			</div>

			<div class="blue-text caps-text sm-text mt-xxl mb-xxl text-center">
				<div role="button" id="toggle-past-button">
					<span class="hide">
						<?= pll__( 'Hide Past Events & Programs' ); ?>
					</span>
					<span class="show">
						<?= pll__( 'Show Past Events & Programs' ); ?>
					</span>
				</div>
			</div>


		</div>

		<div class="col col-2 d-none d-md-block">

			<?php get_template_part( 'parts/loop', 'location', array(
				'title' => 'Upcoming Host',
				'single' => true,
				'query' => array(
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'start_date',
							'value' => date( 'Y/m/d' ),
							'compare' => '>',
							'type' => 'DATE'
						)
					)
				)
			) ); ?>

		</div>

	</div>

</div>

<div class="container">
	<?php get_template_part( 'parts/loop', 'location', array(
		'title' => 'Upcoming Hosts',
		'query' => array(
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'start_date',
					'value' => date( 'Y/m/d' ),
					'compare' => '>',
					'type' => 'DATE'
				)
			)
		)
	) ); ?>
</div>

<div class="container">
	<?php get_template_part( 'parts/loop', 'location', array(
		'title' => 'Past Hosts',
		'query' => array(
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'end_date',
					'value' => date( 'Y/m/d' ),
					'compare' => '<',
					'type' => 'DATE'
				)
			)
		)
	) ); ?>
</div>

<?php get_footer(); ?>