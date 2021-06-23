<?php
/* Template Name: Local Stories */
get_header();
$ls_page = get_trans( 'local-stories' );
?>

<div class="container mt-auto upcoming-hosts white-alpha-bg">
	<?php if( $upcoming_hosts = get_field( 'upcoming_hosts', $ls_page ) ) { ?>

		<div class="row d-lg-none">

			<div class="col col-6 pt-sm pb-sm xs-text caps-text d-flex">
				<div class="mt-auto mb-auto"><?= pll__( 'Upcoming Hosts' ); ?></div>
			</div>

			<div class="col col-6 pt-sm pb-sm d-flex">
				<a href="" class="arrow-link ml-auto">
					<span class="xs-text">
						<?= pll__( 'See All' ); ?>
					</span>
				</a>
			</div>

		</div>

		<div class="row">

			<div class="col col-sm-12 col-lg-8 col-xl-6 offset-sm-0 offset-lg-4 offset-xl-6">
				<ol class="row light-alpha-bg pb-sm">
					<?php foreach( $upcoming_hosts as $host ) {
						$location = $host['location'];
						$story = get_story( $location ); ?>

						<li role="article" class="thumb col col-12 col-sm-4">

							<a href="<?= the_permalink( $story ) ?>" class="thumb-link-wrapper">

								<div class="row">

									<div class="col col-5 col-sm-12">

										<div class="thumb-image square d-lg-none" <?= post_bg( $location ); ?>></div>

									</div>

									<div class="col col-7 col-sm-12">

										<div class="thumb-content">
											<div class="thumb-title">
												<?= $location->post_title; ?>
											</div>

											<div class="thumb-subtitle bold-text">
												<?= get_dates( $location ); ?>
											</div>

											<div class="thumb-subtitle">
												<?= get_field( 'address', $location ); ?>
											</div>
										</div>

									</div>

								</div>

							</a>

						</li>

					<?php } ?>
				</ol>
			</div>

		</div>
	<?php } ?>

	<h1 class="page-title"><?= pll__( 'Local Stories' ) ?></h1>

	<?php get_template_part( 'parts/loop', 'story' ); ?>

</div>

<?= get_footer(); ?>