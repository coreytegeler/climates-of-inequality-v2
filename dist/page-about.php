<?php
/* Template Name: About */
get_header();
$page = $post;

$video = get_field( 'video', $page );
$team = get_field( 'team', $post );
$funders = get_field( 'funders_text', $post );
?>

<div class="container">

	<h1 class="page-title"><?= get_the_title(); ?></h1>

</div>

<?php if( $video ) { ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col col-12 col-md-8 col-lg-6">

				<figure class="wp-block-video">
					<video src="<?= $video; ?>"></video>
				</figure>

			</div>
		</div>
	</div>

<?php } ?>

<div class="container">

	<?php get_template_part( 'parts/nav', 'page', array(
		'sections' => array(
			'About The Projects',
			'Partners',
			'In The News',
			'Team',
			'Advisors',
			'Funders',
			'Local Supporters'
		)
	) ); ?>

</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col col-12 col-md-8 col-lg-6">

			<h4><?= pll__( 'About The Project' ); ?></h4>

			<div class="lg-text">
				<?= wpautop( $page->post_content ); ?>
			</div>

		</div>
	</div>
</div>

<?php get_template_part( 'parts/loop', 'partner', array(
	'title' => pll__( 'Locations' ),
	'count' => 3
) ); ?>

<?php get_template_part( 'parts/quotes' ); ?>


<?php get_template_part( 'parts/loop', 'press', array(
	'title' => pll__( 'In The News' ),
	'count' => 6
) ); ?>


<div class="container">

	<h4><?= pll__( 'Team' ); ?></h4>

</div>

	
<?php get_template_part( 'parts/loop', 'team', array(
	'title' => 'Humanities Action Lab Hub Staff',
	'field' => 'team',
	'show_image' => true
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


<div class="container" id="container-newsletter">

	<h4><?= get_field( 'newsletter_title' ); ?></h4>

	<a href="<?= get_field( 'newsletter_button_url' ); ?>" target="_blank" class="button m-auto">
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

