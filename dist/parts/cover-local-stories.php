<?php
$page = get_trans( 'local-stories' );
$home_page = get_trans( 'home' );
$hn_page = get_trans( 'happening-now' );
$map = get_field( 'map', 'option' );
$map = get_template_directory_uri() . '/assets/images/map.svg';
?>
<div class="cover-image cover-map">
	<div class="row">
		<div class="col col-12 col-md-12 col-lg-10 col-xl-8">
			<?php get_svg( $map ); ?>
		</div>
	</div>
</div>
	
<div class="container pt-nav mt-md mt-lg-0 mb-auto d-none d-md-block">
	<a href="<?= get_permalink( $hn_page ); ?>" class="hn-button mt-lg">
		<div><?= pll__( 'What\'s Happening Now?' ); ?></div>
	</a>
</div>

<div class="container highlight-text d-flex align-items-center mt-0">
	<div class="row pt-md pb-md">
		<div class="col col-12 col-md-10 col-lg-8 col-xl-6 offset-lg-4 offset-xl-6 xl-text">
			<?= wpautop( $page->post_content ); ?>
		</div>
	</div>
</div>


<?php
// MOVE THIS FIELD TO LS PAGE
if( $featured_locations = get_field( 'featured_locations', $home_page ) ) { 
	$featured_locations = array_slice( $featured_locations, 0, 3 ); ?>

	<div class="container d-none d-lg-block featured-locations">
		<div class="row">

			<div class="col col-0 col-sm-0 col-lg-4 col-xl-6"></div>

			<div class="col col-12 col-sm-12 col-lg-8 col-xl-6">
				<div class="row sm-gutter light-alpha-bg">

					<div class="col col-6 pt-sm pb-sm xs-text caps-text d-flex">
						<div class="mt-auto mb-auto"><?= pll__( 'Upcoming Hosts' ); ?></div>
					</div>

					<div class="col col-6 pt-sm pb-sm d-flex">
						<a href="" class="arrow-link ml-auto">
							<span class="xs-text">
								<?= pll__( 'See All' ); ?>
							</span>
						</a>
					</div>

					<?php foreach( $featured_locations as $location ) {
						$story = get_story( $location ); ?>

						<div class="thumb col col-12 col-sm-4">

							<a href="<?= the_permalink( $story ) ?>" class="thumb-link-wrapper" aria-hidden="true" tabindex="-1">

								<div class="thumb-image square" <?= post_bg( $story ); ?>>
									<div class="square-label">
										<?= pll__( 'Local Story Event' ); ?>
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
