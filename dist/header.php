<?php
$lang = pll_current_language();
?>
<!doctype html>
<html lang="<?= $lang; ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<div id="page">
			<a class="skip-link screen-reader-text" href="#content">
				<?php pll__( 'Skip to content' ); ?>
			</a>

			<header id="main-header" role="banner">
				<div class="container">
					<div class="row">
						<div class="col col-sm-7 col-md-auto">
							<a href="<?= esc_url( home_url( '/' ) ); ?>" id="site-logo">
								
								<img src="<?= get_template_directory_uri(); ?>/assets/images/logo-<?= $lang; ?>.svg" aria-hidden="true" />

								<div class="sr-only">
									<?= get_bloginfo( 'name' ); ?>:
									<?= get_bloginfo( 'description' ); ?>
								</div>

							</a>
						</div>
						<div class="col col-auto flex-sm-fill">

							<div class="icons">

								<div class="d-none d-md-flex justify-content-end">
									<?php if( $hal_url = get_field( 'hal_url', 'option' ) ) { ?>
										<a href="<?= $hal_url; ?>">
											<span class="sr-only"><?= pll__( 'Humanities Action Lab' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/hal.svg" />
										</a>
									<?php } ?>

									<?php if( $twitter_url = get_field( 'twitter_url', 'option' ) ) { ?>
										<a href="<?= $twitter_url; ?>">
											<span class="sr-only"><?= pll__( 'Twitter' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/twitter.svg" />
										</a>
									<?php } ?>

									<?php if( $instagram_url = get_field( 'instagram_url', 'option' ) ) { ?>
										<a href="<?= $instagram_url; ?>">
											<span class="sr-only"><?= pll__( 'Instagram' ); ?></span>
											<img src="<?= get_template_directory_uri(); ?>/assets/images/instagram.svg" />
										</a>
									<?php } ?>
								</div>

								<div class="d-flex d-md-none">

									<?php get_template_part( 'parts/nav', 'mobile' ); ?>

								</div>

							</div>

						</div>
					</div>
				</div>

				<nav id="main-nav" role="navigation" aria-label="<?= pll__( 'Main' ); ?>">
					<?php if( has_nav_menu( 'header' ) ) { ?>

						<ul>

							<?php
							$menu_locations = get_nav_menu_locations();
							$header_menu = get_term( $menu_locations['header'], 'nav_menu' );
							$header_menu_items = wp_get_nav_menu_items( $header_menu->term_id );
							foreach ( $header_menu_items as $i => $menu_item ) {
								if( get_post_parent() ) {
									$current = $menu_item->object_id == get_post_parent()->ID;
								} else {
									$current = $menu_item->object_id == get_queried_object_id();	
								}
								?>
								<li class="menu-item-button <?= $current ? 'current' : ''; ?> <?= is_front_page() && $i === 0 ? 'active' : ''; ?>">
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
			} else if( is_single() ) {
				$cover_name = $post->post_type;
			} ?>

			<?php if( isset( $cover_name ) ) { ?>

					<div class="cover" id="cover-<?= $cover_name; ?>">
						<?php if( $cover_name !== 'about' ) { ?>
							<?php get_template_part( 'parts/cover', $cover_name ); ?>
						<?php } ?>
					</div>

			<?php } ?>

			<div id="content">
