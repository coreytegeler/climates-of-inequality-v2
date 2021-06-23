<?php
$page = get_trans( 'calendar' );
$lang = pll_current_language();
$today = current_time( 'Ymd' );
$current_location_args = array(
	'post_type' => 'location',
	'meta_key' => 'start_date',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'posts_per_page' => 1,
	'meta_query' => array(
		array(
			'key' => 'start_date',
			'compare' => '<=',
			'value' => $today,
		),
		array(
			'key' => 'end_date',
			'compare' => '>=',
			'value' => $today,
		)
	)
);

$current_location_arr = get_posts( $current_location_args ); ?>

<div class="cover-image position-sm-static" <?= post_bg( $page, 'large' ); ?>></div>

<?php if( sizeof( $current_location_arr ) ) {
	$current_location = $current_location_arr[0];
	$current_story = get_story( $current_location ); ?>

	<div class="cover-card">
		<div class="container">

			<div class="row">

				<div class="cover-content col col-12 col-md-8 back-blur white-alpha-bg mb-md">

					<div class="row">

						<div class="col col-8">
							<div class="caps-text sm-text">
								<?= pll__( 'Current Host' ); ?>:
							</div>

							<div class="pb-md d-md-none"></div>
							<div class="pb-md d-sm-none"></div>

							<h2 class="xl-text mb-md"><?= $current_location->post_title; ?></h2>
							<h3 class="lg-text mb-xl"><?= $current_story->post_title; ?></h3>

							<div class="mb-xs">
								<strong><?= pll__( 'Online exhibition only' ); ?></strong>
								<div><?= get_dates( $current_location, $lang ); ?></div>
							</div>

							<div>
								<a href="<?= get_permalink( $current_story ); ?>" class="xs-text blue-text caps-text">
									<?= pll__( 'See Local Story' ); ?>
								</a>
							</div>

						</div>

						<div class="col col-4">
							<div class="max-square">
								<div class="square" <?= post_bg( $current_story, 'medium' ); ?>>
									<div class="square-text">
										<span>
											<?= pll__( 'Local Story Event' ); ?>
										</span>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>

			<?php
			$upcoming_event_args = array(
				'post_type' => 'event',
				'meta_key' => 'start_date',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key' => 'location',
						'compare' => '=',
						'value' => $current_location->ID
					),
					array(
						'key' => 'start_date',
						'compare' => '>=',
						'value' => $today,
					),
				)
			);

			$upcoming_event_arr = get_posts( $upcoming_event_args );
			if( sizeof( $upcoming_event_arr ) ) {
				$upcoming_event = $upcoming_event_arr[0]; ?>

				<div class="row">
					<div class="cover-content col col-12 col-md-8 blue-bg white-text pt-md pb-md">
						<div class="xs-text caps-text">
							<?= pll__( 'Coming Up On' ); ?> <?= date('l', strtotime( get_field( 'start_date', $upcoming_event ) ) ); ?>:
						</div>

						<div class="mt-lg xl-text">
							<div><?= get_dates( $upcoming_event, $lang );?></div>
							<div><?= get_times( $upcoming_event );?></div>
						</div>
					</div>
				</div>

			<?php } ?>

			<div class="row d-none d-md-flex">
				<div class="cover-content col col-12 col-md-8 white-bg blue">
					<a href="#content" role="button" class="skip-to-content blue"></a>
				</div>
			</div>

		</div>

	</div>

<?php } ?>