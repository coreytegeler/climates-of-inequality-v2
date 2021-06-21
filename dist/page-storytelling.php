<?php
/* Template Name: Storytelling Series */
get_header();

$page = $post;
?>

<div class="container mb-xxl">

	<div class="row justify-content-center">

		<div class="col col-12 col-md-8">	

			<h4 class="mb-xl">
				<?=  $page->post_title; ?>
			</h4>

			<div id="post-content" class="lg-text mb-xxl">
				<?= $page->post_content; ?>
			</div>

		</div>


	</div>

</div>

<?php get_template_part( 'parts/loop', 'session', array(
	'page' => $page
) ); ?>



<?= get_footer(); ?>