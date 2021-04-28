<?php
$project = $post;
$story = get_field( 'local_story', $project );
$location = get_field( 'location', $story );
?>
<div id="cover-image" <?= post_bg( $story, 'large' ); ?>></div>

<div id="cover-card">
	<div class="row">
		<div class="col col-10 col-md-8">
			
			<header id="cover-header">
				<h2><?= $location->post_title; ?></h2>
				<h3><?= $story->post_title; ?></h3>
			</header>

			<div id="cover-content">
				
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

				<?php
				$embed = get_field( 'embed', $project );
				$slides = get_field( 'media', $project );
				$file = get_field( 'file', $project );
				$link = get_field( 'link', $project );
				?>

				<?php if ( $link ) { ?>

					<a href="<?= $link ?>" target="_blank">
						<?= pll__( 'View The Project' ) ?>
					</a>

				<?php } ?>


				<?php if ( $file ) { ?>

					<div class="pdf-viewer">
						<?= do_shortcode( '[pdf-embedder url="' . $file['url'] . '"]' ); ?>
					</div>

					<a href="<?= $file['url'] ?>" download>
						<?= pll__( 'Download The PDF' ) ?>
					</a>

				<?php } ?>


				<?php if( $embed ) {

					$caption = get_field( 'embed_caption', $project );
					$credit = get_field( 'embed_credit', $project ); ?>
					<figure class="mt-xl">
						<?= $embed; ?>
					</figure>
					<figcaption>

					</figcaption>

				<?php } ?>


				<?php if ( $slides && sizeof( $slides ) ) { ?>

					<div class="slideshow center">
						<div class="slides-wrapper sm-container center">
							<?php
							$slide_length = sizeof( $slides );
							foreach( $slides as $slide_index => $slide ) {
								$file = $slide['file'];
								$filetype = $file['type'];

								$text = $slide['text'];
								$embed = $slide['embed'];

								$is_first = $slide_index == 0;
								$is_last = $slide_index == $slide_length - 1;
							} ?>
						</div>
					</div>
				
				<?php } ?>

			</div>

		</div>
	</div>
</div>
