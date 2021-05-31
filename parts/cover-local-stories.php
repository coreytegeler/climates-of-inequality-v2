<?php
$page = $post;
$home_page = get_post( pll_get_post( get_page_by_path( 'home' )->ID ) );
$map = get_field( 'map', 'option' );
?>
<div id="cover-image" <?= media_bg( $map ); ?>></div>

<div class="container d-flex align-items-center" id="highlight-text">
	<div class="row mt-xxl">
		<div class="col col-0 col-sm-0 col-lg-4 col-xl-6"></div>
		<div class="col col-12 col-sm-12 col-lg-8 col-xl-6 xl-text">
			<?= wpautop( $home_page->post_content ); ?>
		</div>
	</div>
</div>


<?php if( $featured_locations = get_field( 'featured_locations', $home_page ) ) { 
	$featured_locations = array_slice( $featured_locations, 0, 3 ); ?>

	<div class="container mt-auto d-none d-lg-block featured-locations">
		<div class="row">

			<div class="col col-0 col-sm-0 col-lg-4 col-xl-6"></div>

			<div class="col col-12 col-sm-12 col-lg-8 col-xl-6">
				<div class="row sm-gutter medium-alpha-bg">

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

					<?php foreach( $featured_locations as $location ) { ?>

						<div class="thumb col col-12 col-sm-4">

							<a href="<?= the_permalink( $location ) ?>" class="thumb-link-wrapper">

								<div class="thumb-image square" <?= post_bg( $location ); ?>>
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
