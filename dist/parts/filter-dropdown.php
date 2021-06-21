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
		$lang = pll_current_language();

		$posts = get_posts( array(
			'post_type' => $args['value'],
			'posts_per_page' => -1,
			'order' => 'DESC',
			'orderby' => 'meta_value_num',
			// 'orderby' => 'meta_value',
			'meta_key' => 'date'
		) );

		foreach( $posts as $post ) {

			$date = null;
			if( in_array( $post->post_type, array( 'happening' ) ) ) {
				$date = get_field( 'date', $post );
			}
			if( in_array( $post->post_type, array( 'location', 'event' ) ) ) {
				$date = get_field( 'start_date', $post );
			}
			if( $date ) {

				$date_obj = date_create( $date );

				$month = pll__( date_format( $date_obj, 'F' ) );
				$year = date_format( $date_obj, 'Y' );

				$date_key = date_format( $date_obj, 'Y-m' );
				if( !isset( $options[$date_key] ) ) {
					$options[$date_key] = $month . ', ' . $year;
				}

			}
		}
	}

} ?>

<?php if( isset( $options ) && sizeof( $options ) ) {
	if( $args['type'] === 'date' ) {
		$id = 'date';
	} else {
		$id = $args['value'];
	} ?>


	<div class="select-dropdown">

		<label for="<?= $id; ?>" data-default="<?= $args['default']; ?>" aria-hidden="true">
			<?= $args['default']; ?>
		</label>

		<select id="<?= $id; ?>">

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