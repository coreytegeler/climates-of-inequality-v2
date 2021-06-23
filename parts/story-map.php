<?php
$story = $post;
$map_image = get_field( 'map', $story );
$map_markers = get_field( 'markers', $story );
?>

<div class="container">
	<div id="story-map" class="pt-lg">
		<div class="row no-gutter">
			<div id="story-map-base" class="col col-12 col-md-8">
				<img src="<?= $map_image['url'] ?>" alt=""/>
				<?php if ( $map_markers['mime_type'] === 'image/svg+xml' ) {

					file_get_contents(
						get_attached_file( $map_markers['ID'] ), false, stream_context_create( [
							'ssl' => array( 'allow_self_signed' => true )
						] )
					);

				} ?>
			</div>

			<div id="story-map-panel" class="col col-12 col-md-4">

				<?php $markers = get_field( 'playlist', $story );
				if( $markers ) {
					foreach( $markers as $index => $marker ) { ?>
						<div class="marker-panel <?= $index === 0 ? 'open' : null ?>" data-index="<?= $index + 1; ?>">

							<?php get_template_part( 'parts/slideshow', null, array(
								'slides' => $marker['media'],
								'marker' => $index + 1
							) ) ?>

						</div>
					<?php }
				} ?>
			</div>
		</div>
	</div>
</div>