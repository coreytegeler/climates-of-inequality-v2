<?php if( isset( $args['filters'] ) ) { ?>

	<div id="loop-filter" class="row">

		<?php foreach( $args['filters'] as $filter ) { ?>
			<div class="col col-12 col-sm-<?= 12 / sizeof( $args['filters'] ) ?>">
				<?php get_template_part( 'parts/filter-dropdown', null, $filter ); ?>
			</div>

		<?php } ?>

	</div>

<?php } ?>