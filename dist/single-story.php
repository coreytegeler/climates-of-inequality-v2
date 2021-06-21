<?php
get_header();
$story = $post;
$location = get_field( 'location', $story );
$statement = get_field( 'statement', $story );
$team = get_field( 'team', $story );
$funders = get_field( 'funders_text', $story );
?>

<div class="container">

	<div class="row">

		<div class="col col-2 d-none d-md-block">
			
			<?php get_template_part( 'parts/loop', 'location', array(
				'title' => 'Upcoming Events & Programs',
				'single' => true,
				'query' => array(
					'include' => array( $location->ID )
					// 'meta_query' => array(
					// 	'key' => 'location',
					// 	'value' => $location->ID,
					// )
				)
			) ); ?>

		</div>

		<div class="col col-12 col-md-8">
			
			<h4><?= pll__( 'The Problem' ); ?></h4>
			<?= get_field( 'problems', $story ) ?>

			
			<h4><?= pll__( 'The Roots' ); ?></h4>
			<?= get_field( 'roots', $story ) ?>

			
			<h4><?= pll__( 'The Solutions' ); ?></h4>
			<?= get_field( 'solutions', $story ) ?>

		</div>

	</div>

</div>

<?php get_template_part( 'parts/nav', 'page', array(
	'sections' => array(
		'Projects',
		'Contributors'
	)
) ); ?>

<?php get_template_part( 'parts/story-map' ); ?>

<?php get_template_part( 'parts/quotes', null, array(
	'title' => pll__( 'Our Point of View' )
) ); ?>

<div class="container" id="projects">

	<?php get_template_part( 'parts/loop', 'project', array(
		'title' => pll__( 'Projects' ),
		'story' => $story
	) ); ?>
	
</div>


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


