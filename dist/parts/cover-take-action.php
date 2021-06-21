<?php
$page = get_trans( 'take-action' );
?>
<div class="cover-image" <?= post_bg( $page ); ?>></div>

<div class="container d-flex flex-direction-column">

	<div class="m-auto">
		<div class="highlight-text mt-nav pt-sm h-auto">
			<div class="row justify-content-center">
				<div class="col col-12 col-lg-8 col-xl-8 xl-text blue-text">

					<?= wpautop( $page->post_content ); ?>

				</div>
			</div>
		</div>

		<div class="row justify-content-around mt-lg mb-md">

			<?php $action_slugs = array(
				'act-locally',
				'sense-your-place',
				'design-your-green-new-deal'
			); ?>

			<?php foreach( $action_slugs as $action_slug ) {
				$action_short = substr( $action_slug, 0, strpos( $action_slug, "-" ) );
				$action_page = get_trans( 'take-action/' . $action_slug ); ?>
	 	
	 			<div class="col col-8 col-md-6 col-lg-4 white-text text-center">

	 				<a href="<?= get_permalink( $action_page ); ?>" class="action-tab-button">

		 				<img src="<?= get_template_directory_uri(); ?>/assets/images/<?= $action_short; ?>.gif" />

		 				<div class="caps-text mt-md">
		 					<?= $action_page->post_title; ?>
		 				</div>
		 				<div class="mt-sm mb-lg">
		 					<?= get_field( $action_short . '_desc', $page ); ?>
		 				</div>

		 			</a>

	 			</div>

			<?php } ?>

		</div>
	</div>
</div>