<nav id="mobile-nav" role="navigation">

	<button class="burger" aria-expanded="false">
		<div class="sr-only">Menu</div>
	</button>

	<div class="inner">

		<?php if( has_nav_menu( 'header' ) ) { ?>

			<ul class="pt-xxl pb-xxl">

				<?php
				$menu_locations = get_nav_menu_locations();
				$header_menu = get_term( $menu_locations['header'], 'nav_menu' );
				$header_menu_items = wp_get_nav_menu_items( $header_menu->term_id );
				foreach ( $header_menu_items as $key => $menu_item ) {
					$current = $menu_item->object_id == get_queried_object_id(); ?>
					<li class="menu-item <?= $current ? 'current' : ''; ?>">
						<a href="<?= $menu_item->url; ?>">
							<span class="white-text"><?= $menu_item->title; ?></span>
						</a>
					</li>

				<?php } ?>

			</ul>

		<?php } ?>
		<div class="icons">
			<div class="d-flex">

				<?php if( $twitter_url = get_field( 'twitter_url', 'option' ) ) { ?>
					<a href="<?= $twitter_url; ?>">
						<img src="<?= get_template_directory_uri(); ?>/assets/images/twitter-white.svg" />
					</a>
				<?php } ?>

				<?php if( $instagram_url = get_field( 'instagram_url', 'option' ) ) { ?>
					<a href="<?= $instagram_url; ?>">
						<img src="<?= get_template_directory_uri(); ?>/assets/images/instagram-white.svg" />
					</a>
				<?php } ?>

			</div>
		</div>

	</div>

</nav>