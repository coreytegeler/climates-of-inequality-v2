<?php

$locations_args = array(
	'post_type' => 'location',
	'order' => 'ASC',
	'orderby' => 'post_title'
);

if( isset( $args['query'] ) ) {
	$location_args = array_merge( $locations_args, $args['query'] );
	$location_args['posts_per_page'] = 1;
}

$location = get_posts( $location_args );

if( sizeof( $location ) > 0 ) {
	$location = $location[0];
	$location_slug = $location->post_name;
	$location_name = $location->post_title;
	$story = get_story( $location );
	$aspects = get_field( 'aspects', $args['page'] ); ?>

	<div class="row justify-content-center mt-lg">
		<div class="col col-12 col-md-8">
			<form class="action-form" id="design-form" data-location="<?= $location->post_name; ?>">

				<fieldset>

					<label class="xl-text" for="design-select-<?= $location_slug;?>">
						<?= wpautop( $args['page']->post_content ); ?>
					</label>

					<div class="light-bg">

						<h4><?= pll__( 'Select 3 Aspects' ); ?></h4>

						<?php if( $aspects ) { ?>

							<ol role="radiogroup" class="radio-buttons design-vote-buttons" id="design-select-<?= $location_slug; ?>" data-field="design_vote">

								<?php foreach( $aspects as $index => $aspect ) { ?>
									<li role="radio" class="design-vote-button" data-vote="<?= $index; ?>" aria-checked="false" tabindex="0">
										<div><?= $aspect['aspect']; ?></div>
									</li>
								<?php } ?>

							</ol>

						<?php } ?>

						<button type="submit" class="button">
							<span><?= pll__( 'Submit' ); ?></span>
							<span><?= pll__( 'Submitted' ); ?>!</span>
						</button>
					</div>
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
}


$locations_args['posts_per_page'] = -1;
$locations = get_posts( $locations_args );
$results = array();


foreach ( $locations as  $location ) {

	$comments = get_comments( array(
		'post_id' => $location->ID,
		'status' => 'approve',
		'meta_key' => 'overlay',
		'meta_value' => 'design'
	) );

	$yes = $no = $total = 0;

	foreach( $comments as $comment ) {
		$value = get_field( 'design_vote', $comment );
	}


	$results[$location->post_name] = array(
		'title' => $location->post_title,
		'issue' => get_field( 'local_issue', $location ),
		'yes' => $yes,
		'no' => $no,
		'yesPer' => round( $total ? $yes / $total * 100 : 0 ),
		'noPer' => round( $total ? $no / $total * 100 : 0 )
	);

} ?>

<?php
$curr_result = $results[$location_slug];

?>
<div class="container mt-xxl pb-xl blue-bg white-text">

	<h4 class="white-text"><?= pll__( 'All Local Issues' ); ?></h4>

	<?php foreach ( $results as $result ) { ?>

		<div class="mb-xl">
			<div class="caps-text sm-text"><?= $result['title'] ?></div>
			
		</div>

	<?php } ?>

</div>