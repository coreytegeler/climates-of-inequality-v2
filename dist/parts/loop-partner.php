<?php

$lang = pll_current_language();

$locations_args = array(
	'post_type' => 'location',
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'post_title',
);

$locations = get_posts( $locations_args );


if( $locations ) { ?>

	<div class="container">

		<h4><?= pll__( 'Partners' ); ?></h4>

		<ol class="row masonry sm-gutter">

			<?php foreach ( $locations as $location ) {
				$location_id = $location->id;
				$story = get_story( $location );
				$source = get_field( 'source', $story );
				$url = get_permalink( $story );

				$partners = array();

				$exhibit_partner = get_field( 'exhibiting_partners', $location );
				$community_partner = get_field( 'community_partners', $location );
				$university_partner = get_field( 'university_partners', $location );

				$partners = array_merge( 
					$exhibit_partner ? $exhibit_partner : array(),
					$community_partner ? $community_partner : array(),
					$university_partner ? $university_partner : array()
				); ?>

				<div class="gutter-sizer"></div>
				
				<li role="article" class="card col col-12 col-sm-6 col-md-4">
					<div class="card-content">

						<div class="card-image"></div>

						<div class="card-header">
							<div class="card-title">
								<?= $location->post_title; ?>
							</div>

							<a href="<?= $url ?>" class="xs-text caps-text blue-text">
								<?= pll__( 'See Local Story' ); ?>
							</a>
						</div>

						<?php if( $partners ) { ?>
							<div class="sm-text caps-text mt-sm mb-sm">
								<?= pll__( 'Partners' ); ?>:
							</div>

							<ul class="no-style">

								<?php foreach( $partners as $partner ) {
									if( is_object( $partner ) ) { ?>
										<li><?= $partner->post_title; ?></li>
									<?php } 
								} ?>

							</ul>

						<?php } ?>

					</div>
				</li>

			<?php } ?>

		</ol>

	</div>

<?php } ?>

