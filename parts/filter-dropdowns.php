<?php if( isset( $args['filters'] ) ) { ?>

	<div id="loop-filter">

		<?php foreach( $args['filters'] as $filter ) {
			get_template_part( 'parts/filter-dropdown', null, $filter );
		} ?>

	</div>

<?php } ?>