<?php

$lang = pll_current_language();

$events_args = array(
	'post_type' => 'event',
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_key' => 'start_date',
	'posts_per_page' => -1
);

if( isset( $args['query'] ) ) {
	$events_args = array_merge( $events_args, $args['query'] );
}

$events = get_posts( $events_args );
?>

<?php if( $events ) { ?>

	<?php foreach( $events as $event ) { ?>

		<div class="row event <?= is_past( $event ) ? 'past' : ''; ?>">
		
			<div class="col col-12 col-md-5 col-lg-3">

				<div class="mb-md">
					<strong><?= get_dates( $event, $lang ); ?></strong>
					<div><?= get_times( $event ); ?></div>
				</div>

				<?php if( !is_past( $event ) ) { ?>
					<div class="mb-md">
						<a href="#" class="cal-link"></a>
						<div title="Add to Calendar" class="cal-link addeventatc">
							<?= pll__( 'Add to calendar' ); ?>
							<span class="start" aria-hidden="true">
								<?= date_format( date_create( get_field( 'start_date', $event ) ), 'm/d/Y' ); ?>
								<?= get_field( 'start_time', $event ); ?>
							</span>
							<span class="end" aria-hidden="true">
								<?= date_format( date_create( get_field( 'end_date', $event ) ), 'm/d/Y' ); ?>
								<?= get_field( 'end_time', $event ); ?>
							</span>
							<span class="timezone" aria-hidden="true">
								<?= get_field( 'timezone', $event ); ?>
							</span>
							<span class="title" aria-hidden="true">
								<?= $event->post_title; ?>
							</span>
							<span class="description" aria-hidden="true">
								<?= $event->post_content; ?>
							</span>
							<span class="location" aria-hidden="true">
								<?= $address; ?>
							</span>
						</div>
					</div>

					<?php if( $address = get_field( 'address', $event ) ) { ?>
						<div class="mb-md">
							<div><?= pll__( 'Location' ); ?>:</div>
							<a href="" class="event-type blue-text">
								<?= $address; ?>
							</a>
						</div>
					<?php } ?>

					<?php if( $registration = get_field( 'registration', $event ) ) { ?>
						<a href="<?= $registration; ?>" class="button">
							<?= pll__( 'Register' ); ?>
						</a>
					<?php } ?>

				<?php } ?>

			</div>

			<div class="col col-12 col-md-7 col-lg-9">

				<div class="event-content">

					<div class="event-title lg-text mb-md">
						<?= $event->post_title; ?>
					</div>

					<?php $event_types = get_the_terms( $event, 'event_type' );
					if( $event_types && sizeof( $event_types ) ) { ?>
						<div class="event-type d-table light-bg caps-text xs-text">
							<?= $event_types[0]->name; ?>
						</div>
					<?php } ?>

					<?php if( $content = get_the_content( null, false, $event ) ) { ?>
						<div class="event-content mt-xl">
							<?=  $content; ?>
						</div>
					<?php } ?>

				</div>

			</div>

		</div>

	<?php } ?>

<?php } ?>
