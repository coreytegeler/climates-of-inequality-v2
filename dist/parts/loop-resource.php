<?php
$resources_args = array(
	'post_type' => 'resource',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_key' => 'date',
	'tax_query' => array(
		array(
			'taxonomy' => 'resource_group',
			'field' => 'slug',
			'terms' => $args['slug']
		)
	)
);

$resources = get_posts( $resources_args );
?>

<?php if( sizeof( $resources ) ) { ?>
	<div class="container" id="<?= slugify( $args['title'] ); ?>">

		<?php if( isset( $args['title'] ) ) { ?>
			<h4><?= $args['title']; ?></h4>
		<?php } ?>

		<ol class="row">
			<?php foreach( $resources as $resource ) { ?>

				<li itemscope
						itemtype="https://schema.org/DigitalDocument"
						role="article"
						class="thumb col col-12 col-md-6 col-lg-4"  >

					<div class="thumb-image" <?= post_bg( $resource ) ?>></div>

					<div class="thumb-content">

						<?php if( $args['slug'] !== 'why-does-history-matter' ) { ?>

							<div itemprop="name" class="thumb-title">
								<?= $resource->post_title; ?>
							</div>

							<?php if( $credit = get_field( 'credit', $resource ) ) { ?>
								<div itemprop="author" class="mt-md">
									<?= $credit; ?>
								</div>
							<?php } ?>

							<?php if( $date = get_field( 'date', $resource ) ) { ?>
								<time itemprop="datepublished" datetime="<?= get_datetime( $date ); ?>" class="mt-md">
									<?= format_date( $date ); ?>
								</time>
							<?php } ?>

							<?php if( $caption = get_field( 'caption', $resource ) ) { ?>
								<div itemprop="description" class="mt-md">
									<?= wpautop( $caption ); ?>
								</div>
							<?php } ?>

							<div class="mt-md caps-text blue-text xs-text">
								<?#= $resource['category']; ?>
							</div>

							<?php if( $file = get_field( 'file', $resource ) ) { ?>
								<div class="mt-md">
									<a href="<?= $file; ?>" itemprop="url" target="_blank" class="arrow-link d-inline">
										<?= pll__( 'Download' ); ?>
									</a>
								</div>
							<?php } ?>

						<?php } else { ?>

							<div itemprop="name">
								<?= $resource->post_title; ?>
							</div>

							<?php if( $content = $resource->post_content ) { ?>
								<div itemprop="description" class="mt-md blue-text lg-text">
									<?= wpautop( $content ); ?>
								</div>
							<?php } ?>

							<?php if( $credit = get_field( 'credit', $resource ) ) { ?>
								<div itemprop="author" class="mt-sm">
									<?= wpautop( $credit ); ?>
								</div>
							<?php } ?>


						<?php } ?>

					</div>

				</li>

			<?php } ?>
		</ol>

	</div>
<?php } ?>
