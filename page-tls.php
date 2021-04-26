<?php
/* Template Name: Translocal Learning Studio */
get_header();

$page = $post;
?>

<?php get_template_part( 'parts/cover', 'learning-together', array(
	'page' => $page,
) ); ?>

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

		<div class="col col-2 d-none d-md-block">
		</div>

		<div class="col col-12 col-md-8">	

			<h4><?= pll__( 'Overview' ); ?></h4>

			<?= $page->post_content; ?>

		</div>

		<div class="col col-2 d-none d-md-block">
			<form class="mt-xl">
				<h5><?= pll__( 'Newsletter Sign-up' ); ?></h5>
				<button><?= pll__( 'Subscribe' ); ?></button>
			</form>
		</div>

	</div>

</div>


<div class="container" id="current-sessions">

	<h4><?= pll__( 'Current Sessions' ); ?></h4>

	<div class="xl-text mb-md">
		{Session name}
	</div>

	<div>
		{Session description}
	</div>


	<h4><?= pll__( 'Schedule' ); ?></h4>

	<?php
	get_template_part( 'parts/loop', 'events', array(
		'posts_per_page' => 10,
		'meta_query' => array(
			array(
				// 'key' => 'start_date',
				// 'compare' => '>',
				// 'value' => current_time( 'Ymd' ),
			)
		)
	) ); ?>

</div>

<div class="container" id="participants">

	<h4><?= pll__( 'Participants' ); ?></h4>

</div>

<div class="container" id="upcoming-sessions">

	<h4><?= pll__( 'Upcoming Sessions' ); ?></h4>

</div>

<div class="container" id="past-sessions">

	<h4><?= pll__( 'Past Sessions' ); ?></h4>

</div>


<?= get_footer(); ?>



