<?php if( have_rows( $args['field'] ) ) { ?>
	<div class="container" id="<?= $args['field']; ?>">
		<h4><?= pll__( $args['title'] ); ?></h4>
		<div class="row">
			<?php while( have_rows( $args['field'] ) ) {
				the_row();
				$name = $title = $affiliation = null;
				$image_id = get_sub_field( 'image' );
				$group = get_sub_field( 'person' );
				if( $group ) {
					$name = $group['name'];
					$title = $group['title'];
				} else {
					$name = get_sub_field( 'name' );
					$title = get_sub_field( 'title' );
					$affiliation = get_sub_field( 'affiliation' );
				} ?>
				
				<div class="thumb col col-12 col-md-6 col-lg-3">

					<?php if ( $image_id ) { ?>
						<div class="thumb-image" <?= media_bg( $image_id ) ?>></div>
					<?php } ?>

					<div class="thumb-content">

						<?php if( $name ) { ?>
							<div class="thumb-title">
								<?= $name; ?>
							</div>
						<?php } ?>	

						<?php if( $title ) { ?>
							<div class="thumb-subtitle">
								<?= $title; ?>
							</div>
						<?php } ?>

						<?php if( $affiliation ) { ?>
							<div class="thumb-subtitle">
								<?= $affiliation; ?>
							</div>
						<?php } ?>

					</div>

				</div>

			<?php } ?>
		</div>
	</div>
<?php } ?>
