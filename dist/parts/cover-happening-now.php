<?php
$page = get_trans( 'happening-now' );
?>

<div class="cover-image" <?= post_bg( $page ); ?>></div>

<div class="cover-card container">
	<div class="row">

		<div class="cover-content col col-12 col-md-8">
			
			<h1 class="page-title">
				<?= $page->post_title; ?>
			</h4>

			<div class="xl-text pb-xl pl-md pr-md">
				<?= $page->post_content; ?>
			</div>

		</div>

		<div class="col col-12 col-md-8 white-bg d-none d-md-block">
			<a href="#content" role="button" class="skip-to-content blue"></a>
		</div>

	</div>
</div>