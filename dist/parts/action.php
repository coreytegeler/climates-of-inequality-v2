<?php $page = $post; ?>

<div class="container mt-xxl pt-xxl">

	<h2 class="text-center xl-text mb-md">
		<?= pll__( $page->post_title ); ?>
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

	<?#php get_template_part( 'parts/filter', 'notice', null ); ?>

	<div id="loop" data-post-type="<?= $args['action']; ?>">
		
		<?php get_template_part( 'parts/action', $args['action'], array(
			'page' => $page,
			'query' => array(
				'name' => 'albany-ny'
			)
		) ); ?>

	</div>

</div>