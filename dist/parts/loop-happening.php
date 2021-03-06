<?php
$lang = pll_current_language();

$happenings_args = array(
	'post_type' => 'happening',
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_key' => 'date',
);

if( isset( $args['query'] ) ) {
	$happenings_args = array_merge( $happenings_args, $args['query'] );
}

$happenings = get_posts( $happenings_args );
?>


<?php if( isset( $args['title'] ) ) { ?>

	<h4><?= $args['title']; ?></h4>

<?php } ?>

<?php if( $happenings ) { ?>

	<ol class="row">

		<?php foreach ( $happenings as $happening ) {
			$title = get_the_title( $happening );
			$story = get_field( 'story', $happening );
			$location = get_field( 'location', $story );
			$themes = get_the_terms( $happening, 'happening_theme' ); ?>
			
			<li itemscope
					itemtype="https://schema.org/Article"
					role="article"
					class="thumb col col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">

				<a href="<?= the_permalink( $happening ) ?>" class="thumb-link-wrapper">

					<div class="thumb-image square" <?= post_bg( $happening, 'medium' ); ?>></div>

					<div class="thumb-content">

						<div itemprop="name" class="thumb-title">
							<?= $title; ?>
						</div>

						<div itemprop="datePublished" class="thumb-subtitle mb-sm">
							<div><?= format_date( $happening->post_date ); ?></div>
						</div>

					</div>

				</a>

				<?php if( $location ) { ?>
					<div itemprop="contentLocation" class="xs-text blue-text caps-text">
						<?= $location->post_title; ?>
					</div>
				<?php } ?>

				<?php if( $themes ) { ?>
					<div itemprop="about" class="xs-text blue-text caps-text">
						<?php foreach( $themes as $index => $theme ) { ?>
							<div class="mb-xs"><?= $theme->name; ?></div>
						<?php } ?>
					</div>
				<?php } ?>

			</li>

		<?php } ?>

	</ol>

<?php } ?>