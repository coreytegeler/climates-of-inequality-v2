<?php
$locations_args = array(
	'post_type' => 'location',
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'post_title'
);

if( isset( $args['query'] ) ) {
	$locations_args = array_merge( $locations_args, $args['query'] );
}

$locations = get_posts( $locations_args );

if( $locations ) { ?>

	<?php foreach( $locations as $location ) {
		$location_name = $location->post_name;
		$story = get_story( $location );
		$map = get_field( 'map', $story );
		$map_src = get_template_directory_uri() . '/assets/images/maps/' . $location->post_name . '.png'; ?>

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
				<form class="action-form" id="sense-form" data-location="<?= $location->post_name; ?>">

					<fieldset>
						<label for="sense-comment-<?= $location_name;?>" class="sr-only">
							<?= pll__( 'What did you experience?' ); ?>
						</label>
						<textarea
							rows="8"
							id="sense-comment-<?= $location->post_name; ?>"
							placeholder="<?= strtoupper( pll__( 'What did you experience?' ) ); ?>
							"></textarea>
					</fieldset>

					<fieldset>
						<label for="sense-select-<?= $location_name;?>" class="sr-only">
							<?= pll__( 'Select sense' ); ?>
						</label>
						<?php $senses = array( 'taste', 'touch', 'see', 'smell', 'hear' ); ?>
						<ul role="radiogroup" class="radio-buttons senses-select" id="sense-select-<?= $location->post_name; ?>" data-field="sense">
							<?php foreach( $senses as $sense ) { ?>

								<li role="radio" class="sense-button" data-sense="<?= $sense; ?>" aria-checked="false" tabindex="0">
									<span class="sr-only"><?= $sense; ?></span>
								</li>

							<?php } ?>
						</ul>
						<button type="submit" class="button">
							<span><?= pll__( 'Submit' ); ?></span>
							<span><?= pll__( 'Submitted' ); ?>!</span>
						</button>
					</fieldset>

				</form>
			</div>
		</div>


		<?php
		comment_form( array(
			'title_reply' => null,
			'logged_in_as' => null,
			'comment_field' => '<input id="comment-field-' . $location->post_name . '" name="comment" type="hidden" value="' . date( DATE_W3C ) . '">',
			'id_form' => 'comment-form-' . $location->post_name,
			'label_submit' => pll__( 'Submit' )
		), $location->ID );
		?>

	<?php } ?>

<?php } ?>