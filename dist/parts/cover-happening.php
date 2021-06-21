<?php
$lang = pll_current_language();
$happening = $post;
$location = get_field( 'location', $happening );

$happenings_page = get_post( pll_get_post( get_page_by_path( 'happening-now' )->ID ) );
?>
<div class="cover-image" <?= post_bg( $happening, 'large' ); ?>></div>

<div class="cover-card container">
	<div class="row">

		<div class="cover-content col col-10 col-md-8">

			<a href="<?= get_permalink( $happenings_page ); ?>" class="arrow-link back">
				<?= pll__( 'Back to overview' ); ?>
			</a>

			<h1 class="mb-lg mt-xl lg-text">
				<?= $happening->post_title; ?>
			</h1>

			<div class="mb-sm">
				<?= format_date( $happening->post_date ); ?>
			</div>

			<div class="xs-text caps-text blue-text">

				<?php
				$terms = get_the_terms( $happening, 'happening_theme' );
				if( is_array( $happening ) ) {
					foreach ( $terms as $term ) { ?>
						<span class="mr-sm">
							<?= $term->name; ?>
						</span>
					<?php }
				} ?>

			</div>

			<div class="mt-md">

				<?php get_template_part( 'parts/slideshow', null, array(
					'slides' => get_field( 'media' )
				) ) ?>

			</div>

		</div>
	</div>
</div>