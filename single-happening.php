<?php
get_header();
$happening = $post;
$location = get_field( 'location', $happening );
$story = get_story( $location );
?>

<div class="container">

	<div class="row justify-content-center">

		<div class="col col-12 col-sm-6 auto">
			
			<?= $happening->post_content; ?>

		</div>

	</div>

</div>

<?php get_template_part( 'parts/loop', 'happening', array(
	'title' => '',
	'count' => 6,
	'query' => array(
		'posts_per_page' => 6,
		'exclude' => array( $happening->ID )
	)
) ); ?>

<?php get_template_part( 'parts/loop', 'project', array(
	'title' => pll__( 'Related Projects' ),
	'story' => $story
) ); ?>


<?php get_footer(); ?>


