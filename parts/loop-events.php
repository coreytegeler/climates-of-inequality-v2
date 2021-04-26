<?php

$lang = pll_current_language();

$events_args = array(
	'post_type' => 'event',
	// 'order' => 'DESC',
	// 'orderby' => 'meta_value',
	// 'meta_key' => 'start_date',
);

if( isset( $args['query'] ) ) {
	$events_args = array_merge( $events_args, $args['query'] );
}

$events = get_posts( $events_args );
?>

<?php if( $events ) { ?>

	<div class="container">

		<?php foreach( $events as $event ) { ?>

			<div class="row event">
			
				<div class="col col-12 col-md-5 col-lg-3">

					<div class="mb-md">
						<strong><?= get_dates( $event, $lang ); ?></strong>
						<div><?= get_times( $event ); ?></div>
					</div>

					<div class="mb-md">
						<a href="#" class="cal-link">
							<?= pll__( 'Add to calendar' ); ?>
						</a>
					</div>

					<?php if( $address = get_field( 'address', $event ) ) { ?>
						<div class="mb-md">
							<div><?= pll__( 'Location' ); ?>:</div>
							<a href="" class="event-type blue-text">
								<?= $address; ?>
							</a>
						</div>
					<?php } ?>

					<a href="#" class="button">
						<?= pll__( 'Register' ); ?>
					</a>

				</div>

				<div class="col col-12 col-md-7 col-lg-9">

					<div class="event-content">

						<div class="event-title lg-text mb-md">
							<?= $event->post_title; ?>
						</div>

						<?php $event_types = get_the_terms( $event, 'event_type' );
						if( $event_types && sizeof( $event_types ) ) { ?>
							<div class="event-type light-bg caps-text xs-text">
								<?= $event_types[0]->name; ?>
							</div>
						<?php } ?>
							
						<?php if( $excerpt = $event->post_excerpt ) { ?>
							<div class="event-excerpt mt-xl">
								<?= wpautop( $excerpt ); ?>
							</div>
						<?php } ?>

						<?php if( $video = get_field( 'video', $event ) ) { ?>
							<div class="event-video mt-md">

								<p>
									<?= pll__( 'Recording of this session:' ); ?>
								</p>

								<?= $video; ?>
							</div>
						<?php } ?>

					</div>

				</div>

			</div>

		<?php } ?>

	</div>

<?php } ?>
