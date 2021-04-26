<!doctype html>
<html lang="<?= pll_current_language(); ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content">
				<?php pll__( 'Skip to content' ); ?>
			</a>

			<header id="main-header" role="banner">
				<div class="container">
					<div class="row">
						<div class="col">
							<a href="<?= esc_url( home_url( '/' ) ); ?>">
								<div id="header-title">
									<?= get_bloginfo( 'name' ); ?>
								</div>
								<div id="header-tagline">
									<?= get_bloginfo( 'description' ); ?>
								</div>
							</a>
						</div>
						<div class="col">

							<div id="header-icons">

								<?php if( get_field( 'hal_url', 'option' ) ) { ?>
									<a href="<?= get_field( 'hal_url', 'option' ); ?>">
										<img src="<?= get_field( 'hal_logo', 'option' ); ?>" />
									</a>
								<?php } ?>

								<?php if( get_field( 'twitter_url', 'option' ) ) { ?>
									<a href="<?= get_field( 'twitter_url', 'option' ); ?>">
										<img src="<?= get_field( 'twitter_logo', 'option' ); ?>" />
									</a>
								<?php } ?>

								<?php if( get_field( 'instagram_url', 'option' ) ) { ?>
									<a href="<?= get_field( 'instagram_url', 'option' ); ?>">
										<img src="<?= get_field( 'instagram_logo', 'option' ); ?>" />
									</a>
								<?php } ?>

							</div>

						</div>
					</div>
				</div>
				<nav id="main-nav" role="navigation" aria-label="<?= pll__( 'Main' ); ?>">
					<?php if( has_nav_menu( 'header' ) ) { ?>

						<ul id="header-menu">

							<?php
							$menu_locations = get_nav_menu_locations();
							$header_menu = get_term( $menu_locations['header'], 'nav_menu' );
							$header_menu_items = wp_get_nav_menu_items( $header_menu->term_id );
							foreach ( $header_menu_items as $key => $menu_item ) {
								$current = $menu_item->object_id == get_queried_object_id(); ?>
								<li class="menu-item <?= $current ? 'current' : ''; ?>">
									<a href="<?= $menu_item->url; ?>">
										<span><?= $menu_item->title; ?></span>
									</a>
								</li>

							<?php } ?>

						</ul>

					<?php } ?>
				</nav>

			</header>

			
			<?php
			if( is_page() ) {
				if( $parent = $post->post_parent ) {
					$template_filename = get_page_template_slug( $parent );
				} else {
					$template_filename = get_page_template_slug();
				}
				$template_name = str_replace( '.php', '', $template_filename );
				$cover_name = str_replace( 'page-', '', $template_name );
			}

			if( is_single() ) {
				$cover_name = $post->post_type;
			} ?>

			<div id="cover">
				<?php get_template_part( 'parts/cover', $cover_name ); ?>
			</div>


