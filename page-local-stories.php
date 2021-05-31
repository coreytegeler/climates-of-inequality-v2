<?php
/* Template Name: Local Stories */
get_header();
$home_page = get_post( pll_get_post( get_page_by_path( 'home' )->ID ) );
?>

<?php if( $featured_locations = get_field( 'featured_locations', $home_page ) ) { 
	$featured_locations = array_slice( $featured_locations, 0, 3 ); ?>

	<div class="container mt-auto featured-locations white-alpha-bg">
		<div class="row">

			<div class="col col-sm-0 col-lg-4 col-xl-6"></div>

			<div class="col col-sm-12 col-lg-8 col-xl-6">
				<div class="row sm-gutter medium-alpha-bg pb-sm">
					<?php foreach( $featured_locations as $location ) { ?>

						<div class="thumb col col-12 col-sm-4">

							<a href="<?= the_permalink( $location ) ?>" class="thumb-link-wrapper white-bg">

								<div class="row">

									<div class="col col-5 col-sm-12">

										<div class="thumb-image square d-lg-none" <?= post_bg( $location ); ?>></div>

									</div>

									<div class="col col-7 col-sm-12">

										<div class="thumb-content">
											<div class="thumb-title">
												<?= $location->post_title; ?>
											</div>

											<div class="thumb-subtitle bold-text">
												<?= get_dates( $location ); ?>
											</div>

											<div class="thumb-subtitle">
												<?= get_field( 'address', $location ); ?>
											</div>
										</div>

									</div>

								</div>

							</a>

						</div>

					<?php } ?>
				</div>
			</div>

		</div>
	</div>
	
<?php } ?>


<?php get_template_part( 'parts/loop', 'story' ); ?>

<?= get_footer(); ?>