<?php
/* Template Name: Take Action */
get_header();
?>

<div class="container mt-xxl pt-xxl">

	<?php $actions = array(
		'act' => pll__( 'Act Locally' ),
		'sense' => pll__( 'Sense Your Place' ),
		'design' => pll__( 'Design Your Green New Deal' )
	); ?>

	<?php foreach( $actions as $slug => $title ) { ?>

		<div class="action-tab-content <?= $slug === 'sense' ? 'active' : null; ?>">

			<h2 class="text-center mb-md">
				<?= pll__( $title ); ?>
			</h2>

			<?php get_template_part( 'parts/action', $slug ); ?>

		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>

