<?php
$page = $post;
// $lang = pll_current_language();
$about_page = get_post( pll_get_post( get_page_by_path( 'about' )->ID ) );
?>
<div id="cover-image" <?= post_bg( $page ); ?>></div>

<div class="container d-flex align-items-center" id="highlight-text">
	<div class="row mt-xxl">
		<div class="col col-0 col-lg-4"></div>
		<div class="col col-12 col-lg-8 xl-text blue-text">

			<?= wpautop( $page->post_content ); ?>

			<div class="row mt-sm">
				<div class="col col-6">
					<a href="<?= get_permalink( $about_page ); ?>" class="button">
						<?= pll__( 'Learn More About Us' ); ?>
					</a>
				</div>
				<div class="col col-6">
					<div id="close">
						<?= pll__( 'Close' ); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>