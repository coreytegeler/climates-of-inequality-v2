<?php
$story = $post;
$location = get_field( 'location', $story );
?>
<div id="cover-image" <?= post_bg( $story, 'large' ); ?>></div>

<div id="cover-card">
	<div class="row">
		<div class="col col-10 col-md-6">
			<header id="cover-header">
				<h2><?= $location->post_title; ?></h2>
				<h3><?= $story->post_title; ?></h3>
				<!-- <div id="cover-toggle"></div> -->
			</header>
		</div>
	</div>
</div>
