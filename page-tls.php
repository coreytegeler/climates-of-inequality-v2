<?php
/* Template Name: Translocal Learning Studio */
get_header();

$page = $post;
$today = date_format( date_create(), 'Ymd' );
?>

<?php get_template_part( 'parts/nav', 'page', array(
	'sections' => array(
		'Overview',
		'Current Sessions',
		'Participants',
		'Upcoming Sessions',
		'Past Sessions'
	)
) ); ?>


<div class="container" id="overview">

	<div class="row">

		<div class="col col-2 d-none d-xxl-block">
		</div>

		<div class="col col-12 col-md-8 m-auto">

			<h4><?= pll__( 'Overview' ); ?></h4>

			<div id="post-content" class="lg-text">
				<?= $page->post_content; ?>
			</div>

			<div class="mt-xl">
				<a href="#" class="arrow-link">
					<?= pll__( 'Download Full Description' ); ?>
				</a>
			</div>

		</div>

		<div class="col col-12 col-md-8 col-xxl-2 m-auto">
			<?php
			$newsletter = get_field( 'newsletter', $page );
			?>

			<form class="mt-xl">

				<h5><?= $newsletter['title']; ?></h5>

				<div class="light-bg d-block">
					<?= wpautop( $newsletter['body'] ); ?>
				</div>

				<form>
					<input type="email" placeholder="<?= $newsletter['placeholder']; ?>">
					<button class="button">
						<?= $newsletter['button']; ?>
					</button>
				</form>

			</form>
		</div>

	</div>

</div>

<?php $current_session = get_terms( array(
	'taxonomy' => 'session',
	'hide_empty' => false,
	'number' => 1,
	'order' => 'ASC',
	'orderby' => 'meta_value',
	'meta_key' => 'start_date',
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'start_date',
			'value' => $today,
			'compare' => '<=',
			'type' => 'DATE'
		),
		array(
			'key' => 'end_date',
			'value' => $today,
			'compare' => '>=',
			'type' => 'DATE'
		)
	)
) ); ?>

<?php if( sizeof( $current_session ) ) { ?>
	<div class="container" id="current-sessions">
		<div clas="row">
			<div class="col col-12 col-md-8 m-auto">

				<h4><?= pll__( 'Current Sessions' ); ?></h4>

				<div class="xl-text mb-md">
					<?= $current_session[0]->name; ?>
				</div>

				<div>
					<?= $current_session[0]->description; ?>
				</div>


				<h4><?= pll__( 'Schedule' ); ?></h4>

				<?php get_template_part( 'parts/loop', 'event', array(
					'query' => array(
						'tax_query' => array( array(
							'taxonomy' => 'session',
							'field' => 'slug',
							'terms' => $current_session[0]->slug
						) )
					)
				) ); ?>

			</div>
		</div>
	</div>
<?php } ?>

<div class="container" id="participants">
	<div clas="row">
		<div class="col col-12 col-md-8 m-auto">

			<h4><?= pll__( 'Participants' ); ?></h4>

			<?= wpautop( get_field( 'participants' ) ); ?>

		</div>
	</div>
</div>

<div class="container" id="upcoming-sessions">
	<div clas="row">
		<div class="col col-12 col-md-8 m-auto">

			<h4><?= pll__( 'Upcoming Sessions' ); ?></h4>

			<?php $upcoming_sessions = get_terms( array(
				'taxonomy' => 'session',
				'hide_empty' => false,
				'number' => -1,
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'start_date',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'start_date',
						'value' => $today,
						'compare' => '>=',
						'type' => 'DATE'
					),
					array(
						'key' => 'end_date',
						'value' => $today,
						'compare' => '>=',
						'type' => 'DATE'
					)
				)
			) ); ?>

			<?php foreach( $upcoming_sessions as $upcoming_session ) { ?>

				<div class="xl-text mb-md">
					<?= $upcoming_session->name; ?>
				</div>

				<div class="mb-xl">
					<?= $upcoming_session->description; ?>
				</div>

				<?php get_template_part( 'parts/loop', 'event', array(
					'query' => array(
						'tax_query' => array( array(
							'taxonomy' => 'session',
							'field' => 'slug',
							'terms' => $upcoming_session->slug
						) )
					)
				) ); ?>

			<?php } ?>

		</div>
	</div>
</div>

<div class="container" id="past-sessions">
	<div clas="row">
		<div class="col col-12 col-md-8 m-auto">

			<h4><?= pll__( 'Past Sessions' ); ?></h4>

			<?php $past_sessions = get_terms( array(
				'taxonomy' => 'session',
				'hide_empty' => false,
				'number' => -1,
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'start_date',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'start_date',
						'value' => $today,
						'compare' => '<=',
						'type' => 'DATE'
					),
					array(
						'key' => 'end_date',
						'value' => $today,
						'compare' => '<=',
						'type' => 'DATE'
					)
				)
			) ); ?>

			<?php foreach( $past_sessions as $past_session ) { ?>

				<div class="xl-text mb-md">
					<?= $past_session->name; ?>
				</div>

				<div class="mb-xl">
					<?= $past_session->description; ?>
				</div>

				<?php get_template_part( 'parts/loop', 'event', array(
					'query' => array(
						'tax_query' => array( array(
							'taxonomy' => 'session',
							'field' => 'slug',
							'terms' => $past_session->slug
						) )
					)
				) ); ?>

			<?php } ?>

		</div>
	</div>
</div>


<?= get_footer(); ?>



