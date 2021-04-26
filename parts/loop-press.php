<?php

$lang = pll_current_language();

$press_items_args = array(
	'post_type' => 'press',
	'posts_per_page' => $args['count'],
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_key' => 'date',
);

$press_items = get_posts( $press_items_args );


if( $press_items ) { ?>

	<div class="container">

		<h4><?= $args['title']; ?></h4>

		<div class="row">

			<?php foreach ( $press_items as $key => $press_item ) {
				$title = get_the_title( $press_item );
				$source = get_field( 'source', $press_item );
				$date = format_date( get_field( 'date', $press_item ), $lang );
				$url = get_field( 'url', $press_item ); ?>
				
				<div class="thumb col col-12 col-md-6 col-lg-4">

					<a href="<?= $url ?>" target="_blank">

						<div class="thumb-image" <?= post_bg( $press_item ); ?>></div>

						<div class="thumb-content">

							<div class="thumb-title">
								<?= $title; ?>
							</div>

							<div class="thumb-subtitle">
								<div><?= $source ?></div>
								<div><?= $date ?></div>
							</div>


						</div>

					</a>
				</div>

			<?php } ?>

		</div>

	</div>

<?php } ?>

