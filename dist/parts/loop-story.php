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

	<ol class="row">

		<?php foreach ( $stories as $key => $story ) {
			$title = get_the_title( $story );
			$location = get_field( 'location', $story );
			$source = get_field( 'source', $story );
			$url = get_permalink( $story ); ?>
			
			<li role="article" class="thumb col col-12 col-md-6 col-lg-4">

				<a href="<?= $url ?>" class="thumb-link-wrapper">

					<div class="thumb-image" <?= post_bg( $story, 'medium' ); ?>></div>

					<div class="thumb-content">

						<div class="thumb-title">
							<?= get_the_title( $location ); ?>
						</div>

						<div class="thumb-subtitle">
							<div><?= $title ?></div>
						</div>


					</div>

				</a>
			</li>

		<?php } ?>

	</ol>

<?php } ?>