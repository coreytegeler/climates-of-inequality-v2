<?php if( isset( $args['slides'] ) && is_array( $args['slides'] ) ) { ?>

	<div class="slideshow" data-active="0" data-length="<?= sizeof( $args['slides'] ); ?>">

		<div class="slides-wrapper">

			<?php foreach ( $args['slides'] as $index => $slide ) { ?>

				<div class="slide media <?= $index ? '' : 'active' ?>" data-index="<?= $index; ?>">

					<?php if( $file = $slide['file'] ) { ?>

						<figure>

							<img src="<?= $file['sizes']['medium_large']; ?>"/>

							<figcaption>
								<?= wp_get_attachment_caption( $file['ID'] ); ?>
							</figcaption>

						</figure>

					<?php } ?>

				</div>

			<?php } ?>

			<?php if( sizeof( $args['slides'] ) ) { ?>

				<div class="slideshow-arrows">

					<div class="slideshow-arrow" data-direction="prev"></div>
					<div class="slideshow-arrow" data-direction="next"></div>

					<?php if( isset( $args['marker'] ) ) { ?>
						<div class="marker">
							<span><?= $args['marker']; ?></span>
						</div>
					<?php } ?>

				</div>

			<?php } ?>

		</div>

		<div id="captions-wrapper" aria-hidden="true">

			<?php foreach ( $args['slides'] as $index => $slide ) { ?>

				<div class="slide caption <?= $index ? '' : 'active' ?>" data-index="<?= $index; ?>">

					<?php if( $file = $slide['file'] ) { ?>

						<?= wp_get_attachment_caption( $file['ID'] ); ?>

					<?php } ?>

				</div>

			<?php } ?>

		</div>

	</div>

<?php } ?>