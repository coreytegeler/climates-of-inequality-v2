<?php
//////////////////////////////////////////////
/////////////////////INIT/////////////////////
//////////////////////////////////////////////
add_theme_support( 'title-tag' );

function is_dev() {
	return $_SERVER["SERVER_ADDR"] === '::1';
}

function coi_scripts() {
	$ver = wp_get_theme()->get( 'Version' );
	$root_path = get_template_directory_uri();

	$style_path = $root_path . '/assets/style' . ( is_dev() ? '' : '.min' ) . '.css';
	$script_path = $root_path . '/assets/script' . ( is_dev() ? '' : '.min' ) . '.js';

	wp_enqueue_style( 'bootstrap-reboot', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-reboot.min.css' );
	wp_enqueue_style( 'bootstrap-grid', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-grid.min.css' );
	// wp_enqueue_script( 'interact', 'https://unpkg.com/interactjs/dist/interact.min.js' );
	// wp_enqueue_script( 'd3', 'https://d3js.org/d3.v4.min.js' );
	// wp_enqueue_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js' );
	// wp_enqueue_script( 'jquery', get_template_directory_uri() . '/jquery.min.js', array(), '3.4.1', true );
	// wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/jquery-ui.min.js', array( 'jquery' ), '1.12.1', true );

	wp_enqueue_style( 'coi-style', $style_path, array(), $ver );
	wp_enqueue_script( 'coi-script', $script_path, array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'coi_scripts' );

function admin_styles() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'admin_styles' );

function add_query_vars_filter( $vars ){
	$vars[] = 'loc';
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function get_results( $args ) {
	$results = array();
	$result_IDs = array();
	$all_results = get_posts( $args );
	foreach( $all_results as $index => $result ) {
		$result_type = $result->post_type;
		$related_results = array();
		$related_args = array();
		if( !in_array( $result->ID, $result_IDs ) ) {
			array_push( $results, $result );
			array_push( $result_IDs, $result->ID );
		}
		switch( $result_type ) {
			case 'partner':
				$related_args = array(
					'post_type' => 'location',
					'posts_per_page' => -1,
					'meta_query' => array(
						'relation' => 'OR',
						array(
							'key' => 'exhibiting_partners',
							'value' => $result->ID,
							'compare' => 'LIKE'
						),
						array(
							'key' => 'community_partners',
							'value' => $result->ID,
							'compare' => 'LIKE'
						),
						array(
							'key' => 'university_partners',
							'value' => $result->ID,
							'compare' => 'LIKE'
						)
					)
				);
				$related_results = get_results( $related_args );
				break;
			case 'location':
				$related_args = array(
					'post_type' => 'story',
					'posts_per_page' => -1,
					'meta_key' => 'location',
					'meta_value' => $result->ID
				);
				$related_results = get_results( $related_args );
				break;
			case 'project':
				$story = get_field( 'local_story', $result );
				if( $story ) {
					$related_results[] = $story;
					$loc = get_field( 'location', $story );
					if( $loc ) {
						$related_results[] = $loc;
					}
				}
				break;
		}
		if( sizeof( $related_results ) ) {
			foreach( $related_results as $related_result ) {
				if( !in_array( $related_result->ID, $result_IDs ) ) {
					array_push( $results, $related_result );
					array_push( $result_IDs, $related_result->ID );
				}
			}
		}
	}
	// $results = order_results( $results );
	return $results;
}

// function order_results( $results ) {
// 	foreach( $results ) {

// 	}
// }

function search_extend( $query ) {
 	if( $query->get( 's' ) ) {
		$query->set( 'post_type', array(
			'story',
			'location',
			'project',
			'page',
			'partner',
			'happening',
			'event',
		) );
  }
}
add_filter('pre_get_posts', 'search_extend');

// function search_join( $join ) {
// 	global $wpdb;

// 	if ( is_search() ) {    
// 		$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
// 	}

// 	return $join;
// }
// add_filter('posts_join', 'search_join' );


// function search_where( $where ) {
// 	global $pagenow, $wpdb;

// 	if ( is_search() ) {
// 		$where = preg_replace(
// 			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
// 			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)"
// 		, $where );
// 	}

// 	return $where;
// }
// add_filter( 'posts_where', 'search_where' );

// function search_distinct( $where ) {
// 	global $wpdb;

// 	if ( is_search() ) {
// 		return "DISTINCT";
// 	}

// 	return $where;
// }
// add_filter( 'posts_distinct', 'search_distinct' );


//////////////////////////////////////////////
//////////////////POST TYPES//////////////////
//////////////////////////////////////////////

function register_locations() {
	register_post_type( 'location',
		array(
			'labels' => array(
				'name'               => __( 'Locations', 'post type general name' ),
				'singular_name'      => __( 'Location', 'post type singular name' ),
				'menu_name'          => __( 'Locations', 'admin menu' ),
				'name_admin_bar'     => __( 'Location', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'location' ),
				'add_new_item'       => __( 'Add New Location' ),
				'new_item'           => __( 'New Location' ),
				'edit_item'          => __( 'Edit Location' ),
				'view_item'          => __( 'View Location' ),
				'all_items'          => __( 'All Locations' ),
				'search_items'       => __( 'Search Locations' ),
				'parent_item_colon'  => __( 'Parent Locations:' ),
				'not_found'          => __( 'No locations found.' ),
				'not_found_in_trash' => __( 'No locations found in Trash.' )
			),
			'menu_position' => 4,
			'menu_icon' => 'dashicons-location',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail', 'comments' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_locations' );

function register_events() {
	register_post_type( 'event',
		array(
			'labels' => array(
				'name'               => __( 'Events', 'post type general name' ),
				'singular_name'      => __( 'Event', 'post type singular name' ),
				'menu_name'          => __( 'Events', 'admin menu' ),
				'name_admin_bar'     => __( 'Event', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'event' ),
				'add_new_item'       => __( 'Add New Event' ),
				'new_item'           => __( 'New Event' ),
				'edit_item'          => __( 'Edit Event' ),
				'view_item'          => __( 'View Event' ),
				'all_items'          => __( 'All Events' ),
				'search_items'       => __( 'Search Events' ),
				'parent_item_colon'  => __( 'Parent Events:' ),
				'not_found'          => __( 'No events found.' ),
				'not_found_in_trash' => __( 'No events found in Trash.' )
			),
			'menu_position' => 5,
			'menu_icon' => 'dashicons-calendar-alt',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail', 'excerpt' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_events' );

function register_stories() {
	register_post_type( 'story',
		array(
			'labels' => array(
				'name'               => __( 'Local Stories', 'post type general name' ),
				'singular_name'      => __( 'Local Story', 'post type singular name' ),
				'menu_name'          => __( 'Local Stories', 'admin menu' ),
				'name_admin_bar'     => __( 'Local Story', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'event' ),
				'add_new_item'       => __( 'Add New Local Story' ),
				'new_item'           => __( 'New Local Story' ),
				'edit_item'          => __( 'Edit Local Story' ),
				'view_item'          => __( 'View Local Story' ),
				'all_items'          => __( 'All Local Stories' ),
				'search_items'       => __( 'Search Local Stories' ),
				'parent_item_colon'  => __( 'Parent Local Stories:' ),
				'not_found'          => __( 'No events found.' ),
				'not_found_in_trash' => __( 'No events found in Trash.' )
			),
			'menu_position' => 6,
			'menu_icon' => 'dashicons-book-alt',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_stories' );

function register_projects() {
	register_post_type( 'project',
		array(
			'labels' => array(
				'name'               => __( 'Projects', 'post type general name' ),
				'singular_name'      => __( 'Project', 'post type singular name' ),
				'menu_name'          => __( 'Projects', 'admin menu' ),
				'name_admin_bar'     => __( 'Project', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'project' ),
				'add_new_item'       => __( 'Add New Project' ),
				'new_item'           => __( 'New Project' ),
				'edit_item'          => __( 'Edit Project' ),
				'view_item'          => __( 'View Project' ),
				'all_items'          => __( 'All Projects' ),
				'search_items'       => __( 'Search Projects' ),
				'parent_item_colon'  => __( 'Parent Projects:' ),
				'not_found'          => __( 'No projects found.' ),
				'not_found_in_trash' => __( 'No projects found in Trash.' )
			),
			'menu_position' => 7,
			'menu_icon' => 'dashicons-art',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail', 'editor' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'register_projects' );

function register_partners() {
	register_post_type( 'partner',
		array(
			'labels' => array(
				'name'               => __( 'Partners', 'post type general name' ),
				'singular_name'      => __( 'Partner', 'post type singular name' ),
				'menu_name'          => __( 'Partners', 'admin menu' ),
				'name_admin_bar'     => __( 'Partner', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'partner' ),
				'add_new_item'       => __( 'Add New Partner' ),
				'new_item'           => __( 'New Partner' ),
				'edit_item'          => __( 'Edit Partner' ),
				'view_item'          => __( 'View Partner' ),
				'all_items'          => __( 'All Partners' ),
				'search_items'       => __( 'Search Partners' ),
				'parent_item_colon'  => __( 'Parent Partners:' ),
				'not_found'          => __( 'No partners found.' ),
				'not_found_in_trash' => __( 'No partners found in Trash.' )
			),
			'menu_position' => 8,
			'menu_icon' => 'dashicons-groups',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_partners' );

function register_press() {
	register_post_type( 'press',
		array(
			'labels' => array(
				'name'               => __( 'Press', 'post type general name' ),
				'singular_name'      => __( 'Press', 'post type singular name' ),
				'menu_name'          => __( 'Press', 'admin menu' ),
				'name_admin_bar'     => __( 'Press', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'press' ),
				'add_new_item'       => __( 'Add New Press' ),
				'new_item'           => __( 'New Press' ),
				'edit_item'          => __( 'Edit Press' ),
				'view_item'          => __( 'View Press' ),
				'all_items'          => __( 'All Press' ),
				'search_items'       => __( 'Search Press' ),
				'parent_item_colon'  => __( 'Parent Press:' ),
				'not_found'          => __( 'No press found.' ),
				'not_found_in_trash' => __( 'No press found in Trash.' )
			),
			'menu_position' => 9,
			'menu_icon' => 'dashicons-admin-links',
			'public' => true,
			'has_archive' => true,
			'hierarchical' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_press' );

function register_happenings() {
	register_post_type( 'happening',
		array(
			'labels' => array(
				'name'               => __( 'Happenings', 'post type general name' ),
				'singular_name'      => __( 'Happening', 'post type singular name' ),
				'menu_name'          => __( 'Happenings', 'admin menu' ),
				'name_admin_bar'     => __( 'Happening', 'add new on admin bar' ),
				'add_new'            => __( 'Add New', 'happening' ),
				'add_new_item'       => __( 'Add New Happening' ),
				'new_item'           => __( 'New Happening' ),
				'edit_item'          => __( 'Edit Happening' ),
				'view_item'          => __( 'View Happening' ),
				'all_items'          => __( 'All Happenings' ),
				'search_items'       => __( 'Search Happenings' ),
				'parent_item_colon'  => __( 'Parent Happenings:' ),
				'not_found'          => __( 'No happenings found.' ),
				'not_found_in_trash' => __( 'No happenings found in Trash.' )
			),
			'menu_position' => 9,
			'menu_icon' => 'dashicons-megaphone',
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'thumbnail', 'editor' ),
			'show_in_rest' => true
		)
	);
}
add_action( 'init', 'register_happenings' );

//////////////////////////////////////////////
//////////////////TAXONOMIES//////////////////
//////////////////////////////////////////////

function register_partner_types() {
	$partner_type_args = array(
		'labels' => array(
			'name'              => _x( 'Partner Type', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Partner Type', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Partner Types', 'textdomain' ),
			'all_items'         => __( 'All Partner Types', 'textdomain' ),
			'parent_item'       => __( 'Parent Partner Type', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Partner Type:', 'textdomain' ),
			'edit_item'         => __( 'Edit Partner Type', 'textdomain' ),
			'update_item'       => __( 'Update Partner Type', 'textdomain' ),
			'add_new_item'      => __( 'Add New Partner Type', 'textdomain' ),
			'new_item_name'     => __( 'New Partner Type Name', 'textdomain' ),
			'menu_name'         => __( 'Partner Types', 'textdomain' ),
		),
		'hierarchical' => true,
		'show_uri' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
	);
	register_taxonomy( 'partner_type', array( 'partner' ), $partner_type_args );
}
add_action( 'init', 'register_partner_types' );

function register_happening_themes() {
	$happening_theme_args = array(
		'labels' => array(
			'name'              => _x( 'Theme', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Theme', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Themes', 'textdomain' ),
			'all_items'         => __( 'All Themes', 'textdomain' ),
			'parent_item'       => __( 'Parent Theme', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Theme:', 'textdomain' ),
			'edit_item'         => __( 'Edit Theme', 'textdomain' ),
			'update_item'       => __( 'Update Theme', 'textdomain' ),
			'add_new_item'      => __( 'Add New Theme', 'textdomain' ),
			'new_item_name'     => __( 'New Theme Name', 'textdomain' ),
			'menu_name'         => __( 'Themes', 'textdomain' ),
		),
		'hierarchical' => true,
		'show_uri' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
	);
	register_taxonomy( 'happening_theme', array( 'happening' ), $happening_theme_args );
}
add_action( 'init', 'register_happening_themes' );

function register_event_types() {
	$event_type_args = array(
		'labels' => array(
			'name'              => _x( 'Type', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Types', 'textdomain' ),
			'all_items'         => __( 'All Types', 'textdomain' ),
			'parent_item'       => __( 'Parent Type', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Type:', 'textdomain' ),
			'edit_item'         => __( 'Edit Type', 'textdomain' ),
			'update_item'       => __( 'Update Type', 'textdomain' ),
			'add_new_item'      => __( 'Add New Type', 'textdomain' ),
			'new_item_name'     => __( 'New Type Name', 'textdomain' ),
			'menu_name'         => __( 'Types', 'textdomain' ),
		),
		'hierarchical' => true,
		'show_uri' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
	);
	register_taxonomy( 'event_type', array( 'event' ), $event_type_args );
}
add_action( 'init', 'register_event_types' );


//////////////////////////////////////////////
/////////////////////MENUS////////////////////
//////////////////////////////////////////////

function register_menus() {
	register_nav_menus( array(
		'header' => 'Header Menu',
		'footer' => 'Footer Menu'
	));
}
add_action( 'after_setup_theme', 'register_menus' );

//////////////////////////////////////////////
//////////////////ADMIN PANEL/////////////////
//////////////////////////////////////////////

function remove_menus() {
	remove_menu_page( 'jetpack' );
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_menus' );

// function remove_editors() {
	// remove_post_type_support( 'location', 'editor' );
	// remove_post_type_support( 'story', 'editor' );
	// remove_post_type_support( 'event', 'editor' );
	// remove_post_type_support( 'partner', 'editor' );
	// remove_post_type_support( 'project', 'editor' );
	// remove_post_type_support( 'press', 'editor' );
	// remove_post_type_support( 'page', 'editor' );
// }
// add_action( 'init', 'remove_editors', 100 );



// function enable_gutenberg_post_type( $can_edit, $post_type ) {
// 	global $post;
// 	if ( empty( $post->ID ) ) return $can_edit;
// 	if ( in_array( $post_type, array( 'happening', 'event' ) ) ) {
// 		return true;
// 	} else {
// 		return false;
// 	}
// 	return $can_edit;
// }
// add_filter( 'use_block_editor_for_post_type', 'enable_gutenberg_post_type', 10, 2 );

if( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();	
}

//////////////////////////////////////////////
/////////////////////MEDIA////////////////////
//////////////////////////////////////////////

add_theme_support( 'post-thumbnails', array( 'post', 'page', 'story', 'project', 'location', 'happening' ) );


function add_file_types_to_uploads( $file_types ){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action( 'upload_mimes', 'add_file_types_to_uploads' );


//////////////////////////////////////////////
/////////////////////UTILS////////////////////
//////////////////////////////////////////////

function slugify( $str ) {
	$slug = urlencode( $str );
	$slug = preg_replace( "/[0-9]+/", "", $str );
	$slug = preg_replace( "/-+/", "-", $slug);
	$slug = preg_replace( "/ +/", "-", $slug);
	$slug = trim( $slug, "/[\n]+/" );
	$slug = strtolower( $slug );
	return $slug;
}

function add_comma( $index, $arr ) {
	return $index < sizeof( $arr ) - 1 ? ", " : "";
}

function get_story( $location ) {
	$args = array(
		'post_type' => 'story',
		'meta_key' => 'location',
		'meta_value' => $location->ID,
		'posts_per_page' => 1
	);

	$stories = get_posts( $args );

	if( is_array( $stories ) && sizeof( $stories ) ) {
		return $stories[0];
	} else {
		return false;
	}
}

function get_home() {
	$lang = pll_current_language();
	switch( $lang ) {
		case 'en':
			$home_slug = 'home';
			break;
		case 'es':
			$home_slug = 'principal';
			break;
	}
	$home_page = get_page_by_path( $home_slug );
	return $home_page;
}

function sort_contribs( $contribs ) {
	if( $contribs && is_array( $contribs ) ) {
		usort( $contribs, function ( $a, $b ) {
			$a_split = explode(' ', $a['name']);
			$a_surname = array_pop( $a_split );
			$b_split = explode(' ', $b['name']);
			$b_surname = array_pop( $b_split );
			return $a_surname <=> $b_surname;
		});
	}
	return $contribs;
}

function get_venue( $obj ) {
	$partner = get_field( 'partner', $obj );
	if( $partner ){
		return $partner->post_title;
	} else {
		return get_field( 'venue_name', $obj );
	}
}

function format_date( $date, $lang ) {
	$obj = $date ? date_create( $date ) : null;

	$day = $obj ? date_format( $obj, 'd' ) : null;
	$month = pll__( $obj ? date_format( $obj, 'F' ) : null );
	$year = $obj ? date_format( $obj, 'Y' ) : null;

	if( $lang == 'en' ) {
		$date_str = $month . ' ' . $day . ', ' . $year;
	} else if( $lang == 'es' ) {
		$date_str = $day . ' ' . $month . ', ' . $year;
	}

	return $date_str;
}

function get_dates( $post, $lang ) {
	$hide_days = get_field( 'hide_days', $post );

	$start_str = get_field( 'start_date', $post );
	$end_str = get_field( 'end_date', $post );

	if( !$start_str && !$end_str ) {
		return false;
	}

	$start_obj = $start_str ? date_create( $start_str ) : null;
	$end_obj = $end_str ? date_create( $end_str ) : null;

	// $start_date = '';
	$start_day = $start_obj ? date_format( $start_obj, 'd' ) : null;
	$start_month = pll__( $start_obj ? date_format( $start_obj, 'F' ) : null );
	$start_year = $start_obj ? date_format( $start_obj, 'Y' ) : null;

	// $end_date = '';
	$end_day = $end_obj ? date_format( $end_obj, 'd' ) : null;
	$end_month = pll__( $end_obj ? date_format( $end_obj, 'F' ) : null );
	$end_year = $end_obj ? date_format( $end_obj, 'Y' ) : null;

	$same_year = $start_year == $end_year;

	if( $hide_days ) {
		$start_date = $start_month;
	} else if( $lang == 'en' ) {
		$start_date = $start_month . ' ' . $start_day;
	} else if( $lang == 'es' ) {
		$start_date = $start_day . ' ' . $start_month;
	}


	if( $hide_days ) {
		$end_date = $end_month;
	} else if( $lang == 'en' ) {
		$end_date = $end_month . ' ' . $end_day;
	} else if( $lang == 'es' ) {
		$end_date = $end_day . ' ' . $end_month;
	}

	if( !$end_str ) {
		$dates_str = $start_date . ', ' . $start_year;
	} else if( $same_year ) {
		$dates_str = $start_date . '&mdash;' . $end_date . ', ' . $end_year;	
	} else {
		$dates_str = $start_date . ', ' . $start_year . '&mdash;' . $end_date . ', ' . $end_year;
	}

	return $dates_str;
}

function get_times( $post ) {
	$start_time = get_field( 'start_time', $post );
	$end_time = get_field( 'end_time', $post );
	$span = $start_time . ( $end_time ? '—' . $end_time : '' );
	return $span;
}

function the_cover_caption( $post = null ) {
	if( !$post ) {
		return;
	}
	$cover_caption = get_field( 'cover_caption', $post );
	$cover_credit = get_field( 'cover_credit', $post );
	if( $cover_caption || $cover_credit ) {
		echo '<div class="cover-caption sm-padding">';
			if( $cover_caption ) {
				echo '<div>' . $cover_caption . '</div>';
			}
			if( $cover_credit ) {
				echo '<div>' . $cover_credit . '</div>';
			}
		echo '</div>';
	}
}

function post_bg( $post = null, $size = null ) {
	$thumb_id = get_post_thumbnail_id( $post );
	return media_bg( $thumb_id, $size );
}

function media_bg( $thumb_id = null, $size = 'medium' ) {
	$thumb_src = wp_get_attachment_image_src( $thumb_id, $size, true )[0];
	if( $thumb_src ) {
		return bg( $thumb_src );
	} else {
		return false;
	}
}

function bg( $thumb_src = null ) {
	return 'style="background-image: url(' . $thumb_src . ')"';
}

function sortByCount( $a, $b ) {
	return $b['count'] - $a['count'];
}

function stringTruncate( $string, $length ) {
	$length = abs( ( int ) $length);
	if( strlen( $string ) > $length ) {
		$string = preg_replace( "/^(.{1,$length})(\s.*|$)/s", '\\1...', $string );
	}
	return( $string );
}

//////////////////////////////////////////////
/////////////////TRANSLATIONS/////////////////
//////////////////////////////////////////////

pll_register_string( 'Custom', 'About', 'Page' );
pll_register_string( 'Custom', 'Connect your community', 'Page' );
pll_register_string( 'Custom', 'Local Stories', 'Page' );
pll_register_string( 'Custom', 'Take action', 'Page' );
pll_register_string( 'Custom', 'Traveling exhibitions and events', 'Page' );
pll_register_string( 'Custom', 'Why history matters', 'Page' );
pll_register_string( 'Custom', 'Community Partners', 'Partners' );
pll_register_string( 'Custom', 'Exhibit Partners', 'Partners' );
pll_register_string( 'Custom', 'University Partners', 'Partners' );
pll_register_string( 'Custom', 'All Local Issues', 'Subheader' );
pll_register_string( 'Custom', 'Case Study', 'Subheader' );
pll_register_string( 'Custom', 'Contributors', 'Subheader' );
pll_register_string( 'Custom', 'Funders', 'Subheader' );
pll_register_string( 'Custom', 'In The News', 'Subheader' );
pll_register_string( 'Custom', 'Local Supporters', 'Subheader' );
pll_register_string( 'Custom', 'Map "Playlist"', 'Subheader' );
pll_register_string( 'Custom', 'Our partners', 'Subheader' );
pll_register_string( 'Custom', 'Our Point of View', 'Subheader' );
pll_register_string( 'Custom', 'Partners', 'Subheader' );
pll_register_string( 'Custom', 'Points of View', 'Subheader' );
pll_register_string( 'Custom', 'Press', 'Subheader' );
pll_register_string( 'Custom', 'Resources', 'Subheader' );
pll_register_string( 'Custom', 'Results', 'Subheader' );
pll_register_string( 'Custom', 'Select 3 aspects', 'Subheader' );
pll_register_string( 'Custom', 'Team', 'Subheader' );
pll_register_string( 'Custom', 'The Problem', 'Subheader' );
pll_register_string( 'Custom', 'The Roots', 'Subheader' );
pll_register_string( 'Custom', 'The Solutions', 'Subheader' );
pll_register_string( 'Custom', 'What did you experience?', 'Subheader' );
pll_register_string( 'Custom', 'Stories of Environmental Justice', 'Subheader' );
pll_register_string( 'Custom', 'Happening Now', 'Subheader' );
pll_register_string( 'Custom', 'Choose your location', 'Text' );
pll_register_string( 'Custom', 'Choose your location above to vote on issues.', 'Text' );
pll_register_string( 'Custom', 'Click to add your experience', 'Text' );
pll_register_string( 'Custom', 'Exhibition Open', 'Text' );
pll_register_string( 'Custom', 'Exhibtion', 'Text' );
pll_register_string( 'Custom', 'More About This Map', 'Text' );
pll_register_string( 'Custom', 'Learn more and vote here', 'Text' );
pll_register_string( 'Custom', 'No', 'Text' );
pll_register_string( 'Custom', 'Roll over to discover some.', 'Text' );
pll_register_string( 'Custom', 'See results', 'Text' );
pll_register_string( 'Custom', 'Select sense', 'Text' );
pll_register_string( 'Custom', 'Submit', 'Text' );
pll_register_string( 'Custom', 'Survey says', 'Text' );
pll_register_string( 'Custom', 'View The Project', 'Text' );
pll_register_string( 'Custom', 'Download Project PDF', 'Text' );
pll_register_string( 'Custom', 'View more events', 'Text' );
pll_register_string( 'Custom', 'Yes', 'Text' );
pll_register_string( 'Custom', 'You said', 'Text' );
pll_register_string( 'Custom', 'Upcoming Events', 'Text' );
pll_register_string( 'Custom', 'Past Events', 'Text' );
pll_register_string( 'Custom', 'Happening Now', 'Text' );
pll_register_string( 'Custom', 'by', 'Text' );
pll_register_string( 'Custom', 'Published on', 'Text' );
pll_register_string( 'Custom', 'January', 'Month' );
pll_register_string( 'Custom', 'February', 'Month' );
pll_register_string( 'Custom', 'March', 'Month' );
pll_register_string( 'Custom', 'April', 'Month' );
pll_register_string( 'Custom', 'May', 'Month' );
pll_register_string( 'Custom', 'June', 'Month' );
pll_register_string( 'Custom', 'July', 'Month' );
pll_register_string( 'Custom', 'August', 'Month' );
pll_register_string( 'Custom', 'September', 'Month' );
pll_register_string( 'Custom', 'October', 'Month' );
pll_register_string( 'Custom', 'November', 'Month' );
pll_register_string( 'Custom', 'December', 'Month' );


//////////////////////////////////////////////
/////////////////////OTHER////////////////////
//////////////////////////////////////////////

remove_filter ('acf_the_content', 'wpautop');

//////////////////////////////////////////////
////////////////////ENDING////////////////////
//////////////////////////////////////////////