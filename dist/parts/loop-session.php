<?php if( $sessions = get_field( 'sessions', $args['page'] ) ) { ?>
	<div class="container" id="sessions">

		<div class="row">
			<?php foreach( $sessions as $session ) { ?>
				
				<div class="thumb col col-12 col-md-6 col-lg-4">

					<a href="<?= $session['url']; ?>" target="_blank">
						<div class="thumb-image" <?= media_bg( $session['image'], 'medium' ) ?>></div>
					</a>

					<div class="thumb-content">

						<div class="thumb-title">
							<a href="<?= $session['url']; ?>" target="_blank">
								<?= $session['title']; ?>
							</a>
						</div>

						<div class="mt-md">
							<?= $session['credit']; ?>
						</div>

						<div class="mt-md">
							<?= format_date( $session['date'] ); ?>
						</div>

						<div class="mt-md">
							<?= $session['caption']; ?>
						</div>

						<div class="mt-md caps-text blue-text xs-text">
							<?= pll__( 'Storytelling' ); ?>
						</div>

						<div class="mt-md">
							<a href="<?= $session['url']; ?>" target="_blank" class="arrow-link d-inline">
								<?php if( $session['embed'] ) {
									echo pll__( 'Watch' );
								} else {
									echo pll__( 'Go To Website' );
								} ?>
							</a>
						</div>

					</div>

				</div>

			<?php } ?>
		</div>
	</div>
<?php } ?>
