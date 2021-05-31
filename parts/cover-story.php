<?php
$story = $post;
$location = get_field( 'location', $story );
?>
<div id="cover-image" <?= post_bg( $story, 'large' ); ?>></div>

<div id="cover-card" class="container">
	<div class="row">

		<header id="cover-header" class="col col-10 col-md-8">
			<h2><?= $location->post_title; ?></h2>
			<h3><?= $story->post_title; ?></h3>
			<div>
				<a href="#content" role="button" id="skip-to-content" class="col col-10 col-md-8 light-alpha-bg"></a>
			</div>
		</header>

	</div>
</div>
