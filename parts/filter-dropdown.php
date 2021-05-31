<?php
if( isset( $args['type'] ) ) {

	$options = array();

	if( $args['type'] === 'taxonomy' ) {

		$terms = get_terms( array(
			'taxonomy' => $args['value'],
			'hide_empty' => true,
		) );

		if( is_array( $terms ) ) {

			foreach( $terms as $term ) {
				$options[$term->slug] = $term->name;
			}

		}

	}

	if( $args['type'] === 'post' ) {

		$posts = get_posts( array(
			'post_type' => $args['value'],
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		) );

		foreach( $posts as $post ) {
			$options[$post->post_name] = $post->post_title;
		}

	}

	if( $args['type'] === 'date' ) {
		$options['test'] = 'Test';
	}

} ?>

<?php if( isset( $options ) && sizeof( $options ) ) { ?>


	<div class="select-dropdown">

		<label for="<?= $args['value']; ?>" data-default="<?= $args['default']; ?>">
			<?= $args['default']; ?>
		</label>

		<select id="<?= $args['value']; ?>">

			<?php if( isset( $args['default'] ) ) { ?>
				<option value="" selected>
					---<?= pll__( 'None' ); ?>---
				</option>
			<?php } ?>

			<?php foreach ( $options as $slug => $name ) { ?>
					
				<option value="<?= $slug; ?>">
					<?= $name; ?>
				</option>

			<?php } ?>

		</select>

	</div>

<?php } ?>