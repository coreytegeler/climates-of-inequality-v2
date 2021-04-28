<?php if( $projects = get_field( 'projects', $args['story'] ) ) { ?>
	<div class="container" id="projects">

		<?php if( isset( $args['title'] ) ) { ?>
			<h4><?= $args['title']; ?></h4>
		<?php } ?>

		<div class="row">
			<?php foreach( $projects as $project ) { ?>
				
				<div class="thumb col col-12 col-md-6 col-lg-4">

					<a href="<?= get_permalink( $project ); ?>" class="thumb-link-wrapper">

						<div class="thumb-image" <?= post_bg( $project ) ?>></div>

						<div class="thumb-content">

							<div class="thumb-title">
								<?= $project->post_title; ?>
							</div>

							<div class="thumb-subtitle">
								<?= date( 'Y', strtotime( get_field( 'date', $project ) ) ); ?>
							</div>

						</div>

					</a>

				</div>

			<?php } ?>
		</div>
	</div>
<?php } ?>
