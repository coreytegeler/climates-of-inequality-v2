<div class="container">

	<?php if( isset( $args['filters'] ) ) { ?>

		<div class="row justify-content-center">

			<div class="col col-12 col-lg-10 col-xl-8">

				<div id="loop-filter">

					<?php foreach( $args['filters'] as $filter ) {
						get_template_part( 'parts/dropdown', null, $filter );
					} ?>

				</div>

			</div>

		</div>

	<?php } ?>

	<div id="filter-notice" class="row caps-text xs-text pb-md" aria-hidden="true">

		<div class="col col-6">
			<span><?= pll__( 'Filter' ); ?>:</span>
			<span id="filter-list" class="blue-text"></span>
			
		</div>

		<div class="col col-6 blue-text">
			<div id="filter-reset">
				<?= pll__( 'Reset Filter' ); ?>
			</div>
		</div>

	</div>

</div>