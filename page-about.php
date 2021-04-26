<?php
/* Template Name: About */
// set_query_var( 'body_classes', $body_classes );
get_header();

$statement = get_field( 'statement', $post );
$team = get_field( 'team', $post );
$funders = get_field( 'funders_text', $post );
?>

<div class="container">

	<h1><?= get_the_title(); ?></h1>

</div>

<div class="container">

	<div class="row justify-content-center">

		<div class="col col-12 col-md-8 col-lg-6">
			<?= $statement; ?>
		</div>

	</div>

</div>


<div class="container">

	<h4><?= pll__( 'Team' ); ?></h4>

</div>

	

<?php get_template_part( 'parts/loop', 'team', array(
	'title' => 'Humanities Action Lab Hub Staff',
	'field' => 'team'
 ) ); ?>

<?php get_template_part( 'parts/loop', 'team', array(
	'title' => 'Advisors',
	'field' => 'advisors'
 ) ); ?>

 <?php get_template_part( 'parts/loop', 'team', array(
	'title' => 'Funders',
	'field' => 'funders'
 ) ); ?>

<?php get_template_part( 'parts/loop', 'team', array(
	'title' => 'Local Supporters',
	'field' => 'supporters'
) ); ?>

<?php get_template_part( 'parts/quotes' ); ?>


<div class="container" id="container-newsletter">

	<h4><?= get_field( 'newsletter_title' ); ?></h4>

	<a href="<?= get_field( 'newsletter_button_url' ); ?>" target="_blank" class="button">
		<?= get_field( 'newsletter_button_text' ); ?>
	</a>

	<div class="row justify-content-center">
		<div class="col col-12 col-sm-6">
			<p>
				<?= get_field( 'newsletter_text' ); ?>
			</p>
		</div>
	</div>

</div>

<?php get_footer(); ?>

