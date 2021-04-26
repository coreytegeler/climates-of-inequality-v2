<?php

$lang = pll_current_language();

$happenings_args = array(
	'post_type' => 'happening',
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_key' => 'date',
);

if( isset( $args['query'] ) ) {
	$happenings_args = array_merge( $happenings_args, $args['query'] );
}

$happenings = get_posts( $happenings_args );


if( $happenings ) { ?>

	<div class="container">

		<h4><?= $args['title']; ?></h4>

		<div class="row">

			<?php foreach ( $happenings as $happening ) {
				$title = get_the_title( $happening );
				$story = get_field( 'story', $happening );
				$location = get_field( 'location', $story );
				$themes = get_the_terms( $happening, 'happening_theme' ); ?>
				
				<div class="thumb col col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

					<a href="<?= the_permalink( $happening ) ?>">

						<div class="thumb-image square" <?= post_bg( $happening ); ?>></div>

						<div class="thumb-content">

							<div class="thumb-title">
								<?= $title; ?>
							</div>

							<div class="thumb-subtitle mb-sm">
								<div><?= format_date( $happening->post_date, $lang ); ?></div>
							</div>

							<?php if( $location ) { ?>
								<div class="xs-text blue-text caps-text">
									<?= $location->post_title; ?>
								</div>
							<?php } ?>

							<?php if( $themes ) { ?>
								<div class="xs-text blue-text caps-text">
									<?php foreach( $themes as $index => $theme ) { ?>
										<div class="mb-xs"><?= $theme->name; ?></div>
									<?php } ?>
								</div>
							<?php } ?>

						</div>

					</a>
				</div>

			<?php } ?>

		</div>

	</div>

<?php } ?>

