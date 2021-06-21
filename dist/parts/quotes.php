<?php if( have_rows( 'quotes' ) ) { ?>
	<div class="container" id="pov">

		<?php if( isset( $args['title'] ) ) {
			$title = $args['title'];
		} else {
			$title = get_field( 'quotes_title' );
		} ?>

		<?php if( $title ) { ?>
			<h4><?= $title; ?></h4>
		<?php } ?>

		<div class="row">
			<?php while( have_rows( 'quotes' ) ) {
				the_row();
				$text = get_sub_field( 'text' );

				if( $partner = get_sub_field( 'partner' ) ) {
					$attribution = $partner->post_title;
				} else {
					$attribution = get_sub_field( 'attribution' );
				} ?>
				
				<div class="col col-quote col-12 col-md-6 col-lg-5">

					<blockquote>
						<div class="inner md-text blue-text">
							<?= wpautop( $text ); ?>
						</div>
						<cite class="sm-text">
					  	<?= $attribution; ?>
					  </cite>
				  </blockquote>
					
				</div>

			<?php } ?>
		</div>
	</div>
<?php } ?>