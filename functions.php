<?php

add_action( 'atg_init', 'define_constants', 10 );

function define_constants() {

	/** Define Directory Location Constants */
	define( 'PARENT_DIR', get_template_directory() );
	define( 'CHILD_DIR', get_stylesheet_directory() );
	define( 'IMAGES_DIR', PARENT_DIR . '/images' );
	define( 'INC_DIR', PARENT_DIR. '/inc' );
	define( 'PARENT_CSS_DIR', PARENT_DIR. '/css' );
	define( 'ADMIN_DIR', INC_DIR . '/admin' );
	define( 'ADMIN_IMAGES_DIR', ADMIN_DIR . '/images' );
	define( 'ADMIN_JS_DIR', ADMIN_DIR . '/js' );
	define( 'ADMIN_CSS_DIR', ADMIN_DIR . '/css' );
	define( 'JS_DIR', PARENT_DIR . '/js' );
	define( 'CSS_DIR', PARENT_DIR . '/css' );	
	define( 'FUNCTIONS_DIR', INC_DIR . '/functions' );
	define( 'SHORTCODES_DIR', INC_DIR . '/footer_info' );
	define( 'STRUCTURE_DIR', INC_DIR . '/structure' );
	define( 'WIDGETS_DIR', INC_DIR . '/widgets' );

	/** Define URL Location Constants */
	define( 'PARENT_URL', get_template_directory_uri() );
	define( 'CHILD_URL', get_stylesheet_directory_uri() );
	define( 'IMAGES_URL', PARENT_URL . '/images' );
	define( 'INC_URL', PARENT_URL . '/inc' );
	define( 'ADMIN_URL', INC_URL . '/admin' );
	define( 'ADMIN_IMAGES_URL', ADMIN_URL . '/images' );
	define( 'ADMIN_JS_URL', ADMIN_URL . '/js' );
	define( 'ADMIN_CSS_URL', ADMIN_URL . '/css' );
	define( 'JS_URL', PARENT_URL . '/js' );
	define( 'CSS_URL', PARENT_URL . '/css' );
	define( 'FUNCTIONS_URL', INC_URL . '/functions' );
	define( 'SHORTCODES_URL', INC_URL . '/footer_info' );
	define( 'STRUCTURE_URL', INC_URL . '/structure' );
	define( 'WIDGETS_URL', INC_URL . '/widgets' );

}

add_action( 'atg_init', 'load_files', 15 );

function load_files() {
	/** 
	 * atg_add_files hook
	 *
	 * Adding other addtional files if needed.
	 */
	do_action( 'atg_add_files' );

	/** Load functions */
	require_once( FUNCTIONS_DIR . '/i18n.php' );
	require_once( FUNCTIONS_DIR . '/custom-header.php' );
	require_once( FUNCTIONS_DIR . '/functions.php' );
	require_once( FUNCTIONS_DIR . '/custom-style.php' );
	require_once( ADMIN_DIR . '/interface-themedefaults-value.php' );
	require_once( ADMIN_DIR . '/theme-option.php' );
	require_once( ADMIN_DIR . '/interface-metaboxes.php' );
	

	/** Load Shortcodes */
	require_once( SHORTCODES_DIR . '/interface-footer_info.php' );

	/** Load Structure */
	require_once( STRUCTURE_DIR . '/header-extensions.php' );
	require_once( STRUCTURE_DIR . '/sidebar-extensions.php' );
	require_once( STRUCTURE_DIR . '/footer-extensions.php' );
	
	require_once( STRUCTURE_DIR . '/landing.php' );
	require_once( STRUCTURE_DIR . '/menu.php' );
	require_once( STRUCTURE_DIR . '/masonry.php' );
	require_once( STRUCTURE_DIR . '/testimonial.php' );
	require_once( STRUCTURE_DIR . '/visual-highlight.php' );
	require_once( STRUCTURE_DIR . '/case-study.php' );
	require_once( STRUCTURE_DIR . '/quote.php' );
	require_once( STRUCTURE_DIR . '/contact.php' );

	/** Load Widgets and Widgetized Area */
	require_once( WIDGETS_DIR . '/interface_widgets.php' );
}

add_action( 'atg_init', 'core_functionality', 20 );
/**
 * Adding the core functionality of WordPess.
 *
 * @since 1.0
 */
function core_functionality() {
	/** 
	 * interface_add_functionality hook
	 *
	 * Adding other addtional functionality if needed.
	 */
	do_action( 'atg_add_functionality' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' ); 
 
	// This theme uses wp_nav_menu() in header menu location.
	register_nav_menu( 'primary', 'Primary Menu' );

	// Add Interface custom image sizes
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'featured-medium', 230, 160, true );
	add_image_size( 'slider-narrow', 1038, 500, true ); 		// used on Featured Slider on Homepage Header for narrow layout
	add_image_size( 'slider-wide', 1440, 500, true ); 			// used on Featured Slider on Homepage Header for wide layout
	add_image_size( 'gallery', 474, 342, true ); 				// used to show gallery all images
	add_image_size( 'icon', 100, 100, true );						//used for icon on business layout
	
}

/** 
 * atg_init hook
 *
 * Hooking some functions of functions.php file to this action hook.
 */
do_action( 'atg_init' );

add_action( 'init', 'atg_init' );

function atg_init() {

	add_post_type_support( 'post', 'custom-fields' );
	
	$labels = array(
		'name'               => 'Testimonials',
		'singular_name'      => 'Testimonial',
		'menu_name'          => 'Testimonials',
		'name_admin_bar'     => 'Testimonial',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Testimonial',
		'new_item'           => 'New Testimonial',
		'edit_item'          => 'Edit Testimonial',
		'view_item'          => 'View Testimonial',
		'all_items'          => 'All Testimonials',
		'search_items'       => 'Search Testimonials',
		'parent_item_colon'  => 'Parent Testimonials:',
		'not_found'          => 'No testimonials found.',
		'not_found_in_trash' => 'No testimonials found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'taxonomies'         => array( 'category' ),
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'testimonial', $args );
	
	$labels = array(
		'name'               => 'Case Studies',
		'singular_name'      => 'Case Study',
		'menu_name'          => 'Case Studies',
		'name_admin_bar'     => 'Case Study',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Case Study',
		'new_item'           => 'New Case Study',
		'edit_item'          => 'Edit Case Study',
		'view_item'          => 'View Case Study',
		'all_items'          => 'All Case Studies',
		'search_items'       => 'Search Case Studies',
		'parent_item_colon'  => 'Parent Case Studies:',
		'not_found'          => 'No case studies found.',
		'not_found_in_trash' => 'No case studies found in Trash.'
	);
	
	$args = array_merge( $args, [ 'labels' => $labels ] );
	
	register_post_type( 'case_study', $args );
	
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function masonry_add_meta_box() {

	$screens = array( 'post', 'case_study' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'masonry_dimensions',
			'Masonry Dimensions',
			'masonry_dimensions_callback',
			$screen
		);
		
		add_meta_box(
			'display_priority',
			'Display Priority',
			'display_priority_callback',
			$screen
		);
		
	}
}
add_action( 'add_meta_boxes', 'masonry_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function masonry_dimensions_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'masonry_dimensions', 'masonry_dimensions_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$width = get_post_meta( $post->ID, 'masonry_width', true );
	
	if( is_null( $width ) || $width <= 0 ) {
		$width = 1;
	}

	echo '<label for="masonry_width">';
	echo 'Masonry Item Width in Units';
	echo '</label> ';
	echo '<input type="text" id="masonry_width" name="masonry_width" value="' . esc_attr( $width ) . '" size="25" /><br /><br />';
	
	$height = get_post_meta( $post->ID, 'masonry_height', true );
	
	if( is_null( $height ) || $height <= 0 ) {
		$height = 1;
	}

	echo '<label for="masonry_height">';
	echo 'Masonry Item Height in Units';
	echo '</label> ';
	echo '<input type="text" id="masonry_height" name="masonry_height" value="' . esc_attr( $height ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function masonry_dimensions_save_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['masonry_dimensions_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['masonry_dimensions_nonce'], 'masonry_dimensions' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST[ 'masonry_width' ] ) && ! isset( $_POST[ 'masonry_height' ] ) ) {
		return;
	}

	// Sanitize user input.
	$width_data = ( int ) sanitize_text_field( $_POST['masonry_width'] );
	if( $width_data > 5 ) {
		$width_data = 5;
	} else if ( $width_data <= 0 || is_null( $width_data ) ) {
		$width_data = 1;
	}
	$height_data = ( int ) sanitize_text_field( $_POST['masonry_height'] );
	if( $height_data > 3 ) {
		$height_data = 3;
	} else if ( $height_data <= 0 || is_null( $height_data )) {
		$height_data = 1;
	}
	// Update the meta field in the database.
	update_post_meta( $post_id, 'masonry_width', $width_data );
	update_post_meta( $post_id, 'masonry_height', $height_data );
}
add_action( 'save_post', 'masonry_dimensions_save_data' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function display_priority_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'display_priority', 'display_priority_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$priority = get_post_meta( $post->ID, 'display_priority', true );

	echo '<label for="display_priority">';
	echo 'Display Priority';
	echo '</label> ';
	echo '<input type="text" id="display_priority" name="display_priority" value="' . esc_attr( $priority ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function display_priority_save_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['display_priority_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['display_priority_nonce'], 'display_priority' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST[ 'display_priority' ] ) ) {
		return;
	}

	// Sanitize user input.
	$display_priority_data = ( int ) sanitize_text_field( $_POST['display_priority'] );
	if( $display_priority_data > 100 ) {
		$display_priority_data = 100;
	} else if ( $display_priority_data < 0 || is_null( $display_priority_data ) ) {
		$display_priority_data = 0;
	}
	// Update the meta field in the database.
	update_post_meta( $post_id, 'display_priority', $display_priority_data );
}
add_action( 'save_post', 'display_priority_save_data' );

?>