<?php
$page = $post;
$parent = get_post( $post->post_parent );
?>

<div id="cover-image" <?= post_bg( $parent ); ?>>

	<div class="container d-flex align-items-center" id="highlight-text">
	<div class="row mt-xxl">
		<div class="col col-0 col-sm-0 col-lg-4 col-xl-6"></div>
		<div class="col col-12 col-sm-12 col-lg-8 col-xl-6 xl-text">
			<?= wpautop( $parent->post_content ); ?>
		</div>
	</div>
</div>

	<nav id="sub-nav" role="navigation" aria-label="<?= pll__( 'Subpages' ); ?>">
		<?php if( has_nav_menu( 'header' ) ) { ?>

			<ul>

				<?php $siblings_args = array(
					'child_of' => $parent->ID,
					'sort_order' => 'DESC'
				);
				$siblings = get_pages( $siblings_args );
				foreach ( $siblings as $sibling ) {
					$current = $sibling->ID == get_queried_object_id(); ?>

					<li class="menu-item-button <?= $current ? 'current' : ''; ?>">
						<a href="<?= get_permalink( $sibling ); ?>">
							<span><?= $sibling->post_title; ?></span>
						</a>
					</li>

				<?php } ?>

			</ul>

		<?php } ?>
	</nav>

</div>
