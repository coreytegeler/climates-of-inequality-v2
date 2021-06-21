<?php
if( is_front_page() ) {
	$page = $post;
	$menu_locations = get_nav_menu_locations();
	$header_menu = get_term( $menu_locations['header'], 'nav_menu' );
	$header_menu_items = wp_get_nav_menu_items( $header_menu->term_id ); ?>

	<div id="cover-slideshow" class="slideshow" data-active="0" data-length="<?= sizeof( $header_menu_items ); ?>">

		<?php foreach( $header_menu_items as $i => $header_menu_item ) {
			$template_filename = get_page_template_slug( $header_menu_item->object_id );
			$template_name = str_replace( '.php', '', $template_filename );
			$cover_name = str_replace( 'page-', '', $template_name ); ?>
			<div class="cover-slide <?= $i === 0 ? 'active' : ''; ?>" id="cover-<?= $cover_name; ?>" data-index="<?= $i; ?>">
				<?php get_template_part( 'parts/cover', $cover_name ); ?>
			</div>
		<?php } ?>

		<div class="slideshow-arrow" data-direction="prev"></div>
		<div class="slideshow-arrow" data-direction="next"></div>

	</div>
<?php } ?>