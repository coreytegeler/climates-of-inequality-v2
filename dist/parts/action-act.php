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
	$story = get_story( $location ); ?>


	<!-- DO I NEED THIS DATA ATTR? -->
	<div id="" data-location="<?= $location->post_name; ?>">




	</div>

	<div class="row justify-content-center mt-lg">
		<div class="col col-12 col-md-8">
			<form class="action-form" id="act-form" data-location="<?= $location->post_name; ?>">

				<fieldset>

					<label class="xl-text" for="act-select-<?= $location_slug;?>">
						<?= get_field( 'local_issue', $location ); ?>
					</label>

					<div class="light-bg">
						<ul role="radiogroup" class="radio-buttons act-vote-buttons" id="act-select-<?= $location_slug; ?>" data-field="act_vote">

							<li role="radio" class="act-vote-button" data-vote="yes" aria-checked="false" tabindex="0">
								<div><?= pll__( 'Yes' ); ?></div>
							</li>

							<li role="radio" class="act-vote-button" data-vote="no" aria-checked="false" tabindex="0">
								<div><?= pll__( 'No' ); ?></div>
							</li>

						</ul>
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
		'meta_value' => 'act'
	) );

	$yes = $no = $total = 0;

	foreach( $comments as $comment ) {
		$value = get_field( 'act_vote', $comment );
		if( $value === 'yes' ) {
			$yes++;
			$total++;
		}
		if( $value === 'no' ) {
			$no++;
			$total++;
		}
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
<div class="pt-xxl"></div>
<div class="container mt-xxl pb-xl blue-bg white-text">
	<h4><?= pll__( 'Results For' ); ?> <?= $location_name; ?></h4>

	<div id="act-vote-graph" class="">
		<div class="vote-bar yes" style="height:<?= $curr_result['yesPer'] ?>%" data-count="<?= $curr_result['yes'] ?>">
		</div>
		<div class="vote-bar no" style="height:<?= $curr_result['noPer'] ?>%" data-count="<?= $curr_result['no'] ?>">
		</div>
	</div>
	<div id="act-vote-percents" class="">
		<div class="vote-percent yes" style="height:<?= $curr_result['yesPer'] ?>%" data-count="<?= $curr_result['yes'] ?>">
			<?= $curr_result['yesPer'] ?>%
		</div>
		<div class="vote-percent no" style="height:<?= $curr_result['noPer'] ?>%" data-count="<?= $curr_result['no'] ?>">
			<?= $curr_result['noPer'] ?>%
		</div>
	</div>

	<div class="mt-xl">

		<h4 class="white-text"><?= pll__( 'All Local Issues' ); ?></h4>

		<?php foreach ( $results as $result ) { ?>

			<div class="mb-xl">
				<div class="caps-text sm-text"><?= $result['title'] ?></div>
				<div class="lg-text">
					<?= strip_tags( $result['issue'] ); ?>
				</div>
				<div class="d-flex">
					<div class="mr-md">
						<?= pll__( 'Yes' ) . ': '; ?>
						<span class="vote-result-label yes"><?= $result['yes'] ?>%</span>
					</div>
					<div>
						<?= pll__( 'No' ) . ': '; ?>
						<span class="vote-result-label no"><?= $result['no'] ?>%</span>
					</div>
				</div>
			</div>

		<?php } ?>

	</div>

</div>