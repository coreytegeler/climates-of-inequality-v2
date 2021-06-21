<?php
$project = $post;
$story = get_field( 'local_story', $project );
$location = get_field( 'location', $story );

$hn_page = get_trans( 'happening-now' );
?>
<div class="cover-image" <?= post_bg( $story, 'large' ); ?>></div>

<div class="mt-nav d-none d-md-flex justify-content-end">
	<a href="<?= get_permalink( $hn_page ); ?>" class="hn-button mt-md mb-lg mr-lg">
		<div><?= pll__( 'What\'s Happening Now?' ); ?></div>
	</a>
</div>

<div class="cover-card container flex-direction-column">

	<div class="row">

		<header class="cover-header back-blur col col-12 col-lg-8">

			<a href="<?= get_permalink( $story ); ?>" class="arrow-link back">
				<?= pll__( 'Back To Local Story' ); ?>
			</a>

			<h2 class="xl-text mt-xl"><?= $location->post_title; ?></h2>
			<h3 class="lg-text"><?= $story->post_title; ?></h3>
		</header>

		<div class="cover-content col col-12 col-lg-8">
			
			<h4>
				<?= pll__( 'Project' ); ?>
			</h4>

			<h1 class="md-text mb-md">
				<?= $project->post_title; ?>
			</h1>

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
