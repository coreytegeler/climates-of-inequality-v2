<?php
$location = $args['location'];
$location_name = $location->post_name;
$story = get_story( $location );
$map = get_field( 'map', $story );
// $map_src = $map['sizes']['large'];
$map_src = get_template_directory_uri() . '/assets/images/maps/' . $location->post_name . '.png';
?>


<div id="sense-map" data-location="<?= $location->post_name; ?>">

	<div class="sense-map-prompt">
		<div><?= pll__( 'Roll over to discover some.' ); ?></div>
		<div><?= pll__( 'Click to add your experience.' ); ?></div>
	</div>

	<img src="<?= $map_src; ?>" alt="<?= pll__( 'Map of' ) ?> <?= $location->post_title; ?>"/>

	<?php
	$comments = get_comments( array(
		'post_id' => $location->ID,
		'status' => 'approve',
		'meta_key' => 'overlay',
		'meta_value' => 'sense',
	) );
	foreach( $comments as $index => $comment ) {
		$sense = get_field( 'sense', $comment );
		$text = get_field( 'sense_comment', $comment );
		$x = get_field( 'sense_pos_x', $comment );
		$y = get_field( 'sense_pos_y', $comment );
		$date = $comment->comment_date; ?>

		<div class="sense-marker"
				 data-sense="<?= $sense ?>"
				 data-index="<?= $index ?>"
				 style="left:<?= $x ?>%;top:<?= $y ?>%;">
		</div>
	<?php }	?>
	<div id="user-marker" class="sense-marker"></div>
</div>

<div class="row justify-content-center mt-lg">
	<div class="col col-12 col-md-8">
		<form id="sense-form" data-location="<?= $location->post_name; ?>">

			<fieldset>
				<label for="sense-comment-<?= $location_name;?>" class="sr-only">
					<?= pll__( 'What did you experience?' ); ?>
				</label>
				<textarea
					rows="8"
					id="sense-comment-<?= $location->post_name; ?>"
					placeholder="<?= strtoupper( pll__( 'What did you experience?' ) ); ?>
					"></textarea>

				<label for="sense-select-<?= $location_name;?>" class="sr-only">
					<?= pll__( 'Select sense' ); ?>
				</label>
				<?php $senses = array( 'taste', 'touch', 'see', 'smell', 'hear' ); ?>
				<ul role="radiogroup" class="senses-select" id="sense-select-<?= $location->post_name; ?>">
					<?php foreach( $senses as $sense ) { ?>

						<div role="radio" class="sense-button" data-sense="<?= $sense; ?>" aria-checked="false" tabindex="0">
							<span class="sr-only"><?= $sense; ?></span>
						</div>

					<?php } ?>
				</ul>
				<button type="submit" class="button">
					<?= pll__( 'Submit' ); ?>
				</button>
			</fieldset>

		</form>
	</div>
</div>
