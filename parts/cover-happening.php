<?php
$lang = pll_current_language();
$happening = $post;
$location = get_field( 'location', $happening );
?>
<div id="cover-image" <?= post_bg( $happening, 'large' ); ?>></div>

<div id="cover-card" class="container">
	<div class="row">

		<div id="cover-content" class="col col-10 col-md-8">

			<h3 class="mb-lg">
				<?= $happening->post_title; ?>
			</h3>

			<div class="mb-sm">
				<?= format_date( $happening->post_date, $lang ); ?>
			</div>

			<div class="xs-text caps-text blue-text">

				<?php
				$terms = get_the_terms( $happening, 'happening_theme' );
				foreach ( $terms as $term ) { ?>
					<span class="mr-sm">
						<?= $term->name; ?>
					</span>
				<?php } ?>

			</div>

			<div class="mt-md">

				<?php get_template_part( 'parts/slideshow', null, array(
					'slides' => get_field( 'media' )
				) ) ?>

			</div>

		</div>
	</div>
</div>
