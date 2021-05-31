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

	<?php foreach( $locations as $location ) { ?>

		<?php get_template_part( 'parts/map', 'sense', array(
			'location' => $location
		) ); ?>

		<?php comment_form( array(
			'title_reply' => null,
			'logged_in_as' => null,
			'comment_field' => '<input id="comment-field-' . $location->post_name . '" name="comment" type="hidden" value="' . date( DATE_W3C ) . '">',
			'id_form' => 'comment-form-' . $location->post_name,
			'label_submit' => pll__( 'Submit' )
		), $location->ID ); ?>

	<?php } ?>

<?php } ?>