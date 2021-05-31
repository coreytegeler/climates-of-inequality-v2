<?php

$lang = pll_current_language();
$single = isset( $args['single'] ) ? $args['single'] : null;

$locations_args = array(
	'post_type' => 'location',
	'posts_per_page' => isset( $single ) ? 1 : -1,
	'order' => 'ASC',
	'orderby' => 'meta_value',
	'meta_key' => 'start_date'
);

if( isset( $args['query'] ) ) {
	$locations_args = array_merge( $locations_args, $args['query'] );
}

$locations = get_posts( $locations_args );

if( $locations ) { ?>

	<?php if( isset( $args['title'] ) ) { ?>

		<?php if( isset( $single ) ) { ?>

			<div class="xs-text caps-text mt-xl mb-md"><?= $args['title']; ?></div>

		<?php } else { ?>

			<h4><?= $args['title']; ?></h4>

		<?php } ?>

	<?php } ?>

	<div class="row justify-content-center">

		<?php foreach ( $locations as $key => $location ) {
			$title = get_the_title( $location );
			$url = get_permalink( $location ); ?>
			
			<div class="thumb col <?= isset( $single ) ? 'col-12' : 'col-6 col-md-4 col-lg-2'; ?>">

				<a href="<?= $url ?>" class="thumb-link-wrapper">

					<div class="thumb-image square" <?= post_bg( $location ); ?>></div>

					<div class="thumb-content">

						<div class="thumb-title">
							<?= get_the_title( $location ); ?>
						</div>

						<div class="mt-sm">
							<strong><?= get_dates( $location ); ?></strong>
						</div>
						<div class="mt-xs">
							<?php if( $online = get_field( 'online', $location ) ) { ?>
								<strong>
									<?= pll__( 'Online exhibition only' ); ?>
								</strong>
							<?php } else { ?>
								<div class="blue-text">
									<?= get_field( 'address', $location ); ?>
								</div>
							<?php } ?>
						</div>

					</div>

				</a>
			</div>

		<?php } ?>

	</div>

<?php } ?>