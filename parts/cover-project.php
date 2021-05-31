<?php
$project = $post;
$story = get_field( 'local_story', $project );
$location = get_field( 'location', $story );
?>
<div id="cover-image" <?= post_bg( $story, 'large' ); ?>></div>

<div id="cover-card" class="container">
	<div class="row">

		<header id="cover-header" class="col col-10 col-md-8">
			<h2><?= $location->post_title; ?></h2>
			<h3><?= $story->post_title; ?></h3>
		</header>

		<div id="cover-content" class="col col-10 col-md-8">
			
			<h4>
				<?= pll__( 'Project' ); ?>
			</h4>

			<h3 class="mb-md">
				<?= $project->post_title; ?>
			</h3>

			<div class="mb-md">
				<?= date( 'Y', strtotime( get_field( 'date', $project ) ) ); ?>
			</div>

			<?php if( $content = $project->post_content ) { ?>
				<div>
					<?= $content; ?>
				</div>
			<?php } ?>

			<div class="mt-md">

				<?php get_template_part( 'parts/slideshow', null, array(
					'slides' => get_field( 'media' )
				) ) ?>

			</div>

		</div>

	</div>
</div>
