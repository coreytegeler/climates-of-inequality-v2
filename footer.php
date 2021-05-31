			<footer>
				<div class="container">
					<div class="row flex-column-reverse flex-sm-row">

						<div class="col flex-1">
							
							<?= get_field( 'footer', 'option' ); ?>

						</div>

						<div class="col col-auto">

							<nav class="icons">

								<div class="d-flex justify-content-sm-end">
									<?php if( $hal_url = get_field( 'hal_url', 'option' ) ) { ?>
										<a href="<?= $hal_url; ?>">
											<span class="sr-only"><?= pll__( 'Humanities Actin Lab' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/hal.svg" alt=""/>
										</a>
									<?php } ?>

									<?php if( $twitter_url = get_field( 'twitter_url', 'option' ) ) { ?>
										<a href="<?= $twitter_url; ?>">
											<span class="sr-only"><?= pll__( 'Twitter' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/twitter.svg" alt=""/>
										</a>
									<?php } ?>

									<?php if( $instagram_url = get_field( 'instagram_url', 'option' ) ) { ?>
										<a href="<?= $instagram_url; ?>">
											<span class="sr-only"><?= pll__( 'Instagram' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/instagram.svg" alt=""/>
										</a>
									<?php } ?>
								</div>

							</nav>

						</div>

					</div>
				</div>
			</footer>

		</div>
		<?php wp_footer(); ?>
	</body>
</html>