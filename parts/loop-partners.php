<?php

$lang = pll_current_language();

$stories_args = array(
	'post_type' => 'story',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'orderby' => 'post_title',
);

$stories = get_posts( $stories_args );


if( $stories ) { ?>

	<div class="container">

		<h4><?= pll__( 'Partners' ); ?></h4>

		<div class="row">

			<?php foreach ( $stories as $story ) {
				$title = get_the_title( $story );
				$source = get_field( 'source', $story );
				$location = get_field( 'location', $story );
				$location_id = $location->id;
				$url = get_permalink( $story );

				$partners = array();

				$exhibit_partner = get_field( 'exhibiting_partners', $location_id );
				$community_partner = get_field( 'community_partner', $location_id );
				$university_partner = get_field( 'university_partner', $location_id );

				$partners = array_merge( 
					$exhibit_partner ? $exhibit_partner : array(),
					$community_partner ? $community_partner : array(),
					$university_partner ? $university_partner : array()
				); ?>
				
				<div class="card col col-4">
					<div class="card-content">

						<div class="card-image"></div>

						<div class="card-header">
							<div class="card-title">
								<?= $title; ?>
							</div>

							<a href="<?= $url ?>" class="xs-text caps-text blue-text">
								<?= pll__( 'See Local Story' ); ?>
							</a>
						</div>

						<?php if( $partners ) { ?>
							<div class="sm-text caps-text">
								<?= pll__( 'Partners' ); ?>:
							</div>

							<div>

								<?php foreach( $partners as $key => $partner ) {
									if( is_object( $partner ) ) { ?>
										<div><?= $partner->post_title; ?></div>
									<?php } 
								} ?>

							</div>

						<?php } ?>

					</div>
				</div>

			<?php } ?>

		</div>

	</div>

<?php } ?>

