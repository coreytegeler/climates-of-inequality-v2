<?php
$page = $post;
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

$current_location_arr = get_posts( $current_location_args );

if( sizeof( $current_location_arr ) ) {
	$current_location = $current_location_arr[0];
	$current_story = get_story( $current_location ); ?>

	<div id="cover-image" <?= post_bg( $page, 'large' ); ?>></div>

	<div id="cover-card">
		<div class="row">
			<div class="col col-10 col-md-8 col-lg-6">

				<header id="cover-header">

					<div class="row">

						<div class="col col-8">
							<div class="caps-text sm-text">
								<?= pll__( 'Current Host' ); ?>:
							</div>

							<h2><?= $current_location->post_title; ?></h2>
							<h3 class="mb-lg"><?= $current_story->post_title; ?></h3>

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
							<div class="square" <?= post_bg( $current_story, 'medium' ); ?>>
								<div class="square-text">
									<span>
										<?= pll__( 'Local Story Event' ); ?>
									</span>
								</div>
							</div>
						</div>

					</div>

				</header>

				<div id="cover-content" class="blue-bg white-text mt-md">
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

						<div class="xs-text caps-text">
							<?= pll__( 'Coming Up On' ); ?> <?= date('l', strtotime( get_field( 'start_date', $upcoming_event ) ) ); ?>:
						</div>

						<div class="mt-lg xl-text">
							<div><?= get_dates( $upcoming_event, $lang );?></div>
							<div><?= get_times( $upcoming_event );?></div>
						</div>

					<?php } ?>
				</div>


			</div>
		</div>
	</div>
<?php } ?>
