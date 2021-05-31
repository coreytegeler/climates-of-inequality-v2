<?php
$page = $post;
?>
<div id="cover-image" <?= post_bg( $page ); ?>></div>

<div class="container">

	<div id="highlight-text">

		<div class="row justify-content-center">
			<div class="col col-12 col-md-6 col-lg-8 col-xl-8 xl-text blue-text">

				<?= wpautop( $page->post_content ); ?>

			</div>
		</div>

	</div>

	<div class="row justify-content-around mt-lg">

		<?php $actions = array(
			'act' => pll__( 'Act Locally' ),
			'sense' => pll__( 'Sense Your Place' ),
			'design' => pll__( 'Design Your Green New Deal' )
		); ?>

		<?php foreach( $actions as $slug => $title ) { ?>
 	
 			<div class="col col-12 col-sm-8 col-lg-4 white-text text-center">

 				<div class="action-tab-button">

	 				<img src="<?= get_template_directory_uri(); ?>/assets/images/<?= $slug; ?>.gif" />

	 				<div class="caps-text mt-md">
	 					<?= $title; ?>
	 				</div>
	 				<div class="mt-sm">
	 					<?= get_field( $slug . '_desc', $page ); ?>
	 				</div>

	 			</div>

 			</div>

		<?php } ?>

	</div>
</div>