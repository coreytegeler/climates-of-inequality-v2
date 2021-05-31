<?php
$page = $post;
?>
<div id="cover-image" <?= post_bg( $page ); ?>>

	

</div>

<div id="cover-card" class="container">
	<div class="row">

		<div id="cover-content" class="col col-10 col-md-8">
			
			<h4>
				<?= $page->post_title; ?>
			</h4>

			<div class="xl-text pb-xl">
				<?= $page->post_content; ?>
			</div>

		</div>

		<a href="#content" role="button" id="skip-to-content" class="col col-10 col-md-8 white-bg blue"></a>

	</div>
</div>