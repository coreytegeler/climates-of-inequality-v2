<?php
get_header();
$project = $post;
$story = get_field( 'local_story', $project );
// $statement = get_field( 'statement', $story );
// $team = get_field( 'team', $story );
// $funders = get_field( 'funders_text', $story );
?>


<?php get_template_part( 'parts/loop', 'project', array(
	'title' => pll__( 'Projects' ),
	'story' => $story
) ); ?>


<div class="container" id="contributors">

	<h4><?= pll__( 'Contributors' ); ?></h4>

	<div class="row">

		<?php if( $university_contribs = get_field( 'university_contribs', $story ) ) { ?>

			<div class="col col-12 col-sm-6 col-md-4">
				<h4><?= pll__( 'University Partners' ); ?></h4>
			 	<?php foreach( $university_contribs as $contrib ) {
					$partner = $contrib['partner'];
					$groups = $contrib['groups']; ?>

					<div class="mb-xl">
						<h3 class="mb-md"><?= $partner->post_title  ?></h3>

						<?php foreach( $groups as $group ) { ?>
							<div class="mb-md">
								<div><strong><?= $group['group'] ?></strong></div>

								<?php $contribs = sort_contribs( $group['contribs'] );
								foreach( $contribs as $index => $contrib ) { ?>

									<?= $contrib['name'] . add_comma( $index, $contribs ) ?>

								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

		<?php } ?>

		<?php if( $community_contribs = get_field( 'community_contribs', $story ) ) { ?>

			<div class="col col-12 col-sm-6 col-md-4">
				<h4><?= pll__( 'Community Partners' ); ?></h4>
				
			 	<?php foreach( $community_contribs as $contrib ) {
					$partner = get_post( $contrib['partner'] ); ?>

					<div class="mb-xl">
						<h3 class="mb-md"><?= $partner->post_title  ?></h3>

						<?php $contribs = sort_contribs( $contrib['contribs'] );
						if( $contribs ) { ?>
							<div>
								<?php foreach( $contribs as $index => $contrib ) { ?>

									<div><?= $contrib['name'] ?></div>

								<?php } ?>
							</div>
						<?php } ?>
					</div>

				<?php } ?>
			</div>

		<?php } ?>


		<?php if( $supporters = get_field( 'supporters', $story ) ) { ?>

			<div class="col col-12 col-sm-6 col-md-4">
				<h4><?= pll__( 'Local Supporters' ); ?></h4>
			 	<?php foreach( $supporters as $supporter ) { ?>
			 		<div class="mb-xl"><?= $supporter['name'] ?></div>
			 	<?php } ?>
			</div>

		<?php } ?>

	</div>
</div>


<?php if( $funders = get_field( 'funders', $story ) ) { ?>

	<div class="container" id="contributors">
		<h4><?= pll__( 'Local Funders' ); ?></h4>
		<div class="row">
		 	<?php foreach( $funders as $funder ) { ?>
		 		<div class="col col-12 col-sm-6 col-md-3">
		 			<?= $funder['name'] ?>
		 		</div>
		 	<?php } ?>
		</div>
	</div>

<?php } ?>


<?php get_footer(); ?>


