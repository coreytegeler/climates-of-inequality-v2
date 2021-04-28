<?php if( $resources = $args['resources'] ) { ?>
	<div class="container" id="resources">

		<?php if( isset( $args['title'] ) ) { ?>
			<h4><?= $args['title']; ?></h4>
		<?php } ?>

		<div class="row">
			<?php foreach( $resources as $resource ) { ?>
				
				<div class="thumb col col-12 col-md-6 col-lg-4">

					<a href="<?= $resource['url']; ?>" target="_blank">
						<div class="thumb-image" <?= media_bg( $resource['image'] ) ?>></div>
					</a>

					<div class="thumb-content">

						<div class="thumb-title">
							<a href="<?= $resource['url']; ?>" target="_blank">
								<?= $resource['title']; ?>
							</a>
						</div>

						<div class="mt-xs">
							<?= $resource['credit']; ?>
						</div>

						<div class="mt-xs">
							<?= date( 'Y', strtotime( $resource['date'] ) ); ?>
						</div>

						<div class="mt-xs">
							<?= wpautop( $resource['caption'] ); ?>
						</div>

						<?php if( $download = $resource['download'] ) { ?>
							<div class="mt-md">
								<a href="<?= $download; ?>" target="_blank" class="arrow-link d-inline">
									<?= pll__( 'Download' ); ?>
								</a>
							</div>
						<?php } ?>

					</div>

				</div>

			<?php } ?>
		</div>
	</div>
<?php } ?>
