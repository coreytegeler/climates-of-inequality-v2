<?php
/* Template Name: Exhibitions & Events */
get_header();

$page = $post;
?>

<div class="container">

	<div class="row">

		<div class="col col-2 d-none d-md-block">
			
		</div>

		<div class="col col-12 col-md-8">

			<h4><?= pll__( 'Events & Programs' ); ?></h4>

			<div class="xl-text mb-xl">
				<?= $page->post_content; ?>
			</div>

			<?php get_template_part( 'parts/loop', 'events' ); ?>


		</div>

		<div class="col col-2 d-none d-md-block">

		</div>

	</div>

</div>

<?php get_footer(); ?>