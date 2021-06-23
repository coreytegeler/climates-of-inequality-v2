<?php
$story = $post;
$location = get_field( 'location', $story );
?>

<div class="cover-image position-sm-static" <?= post_bg( $story, 'large' ); ?>></div>

<div class="mt-nav d-none d-md-flex justify-content-end">
	<a href="<?= get_permalink( $hn_page ); ?>" class="hn-button mt-md mb-lg mr-lg">
		<div><?= pll__( 'What\'s Happening Now?' ); ?></div>
	</a>
</div>

<div class="cover-card container">

	<div class="row">
		
		<header class="cover-header back-blur col col-12 col-lg-8">
			<h1 class="xl-text"><?= $location->post_title; ?></h1>
			<h2 class="lg-text"><?= $story->post_title; ?></h2>
			<div>
				<a href="#content" role="button" class="skip-to-content col col-12 col-lg-8"></a>
			</div>
		</header>

	</div>
</div>