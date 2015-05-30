<?php
/**
 * Interface defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package Theme Horse
 * @subpackage Interface
 * @since Interface 1.0
 */
add_action( 'after_setup_theme', 'interface_setup' );
/**
 * This content width is based on the theme structure and style.
 */
 function interface_setup() {
	 	global $content_width;
		if ( ! isset( $content_width ) ){
			$content_width = 700;
		}
 }


add_action( 'interface_init', 'interface_constants', 10 );
/**
 * This function defines the Interface theme constants
 *
 * @since 1.0
 */
function interface_constants() {

	/** Define Directory Location Constants */
	define( 'INTERFACE_PARENT_DIR', get_template_directory() );
	define( 'INTERFACE_CHILD_DIR', get_stylesheet_directory() );
	define( 'INTERFACE_IMAGES_DIR', INTERFACE_PARENT_DIR . '/images' );
	define( 'INTERFACE_INC_DIR', INTERFACE_PARENT_DIR. '/inc' );
	define( 'INTERFACE_PARENT_CSS_DIR', INTERFACE_PARENT_DIR. '/css' );
	define( 'INTERFACE_ADMIN_DIR', INTERFACE_INC_DIR . '/admin' );
	define( 'INTERFACE_ADMIN_IMAGES_DIR', INTERFACE_ADMIN_DIR . '/images' );
	define( 'INTERFACE_ADMIN_JS_DIR', INTERFACE_ADMIN_DIR . '/js' );
	define( 'INTERFACE_ADMIN_CSS_DIR', INTERFACE_ADMIN_DIR . '/css' );
	define( 'INTERFACE_JS_DIR', INTERFACE_PARENT_DIR . '/js' );
	define( 'INTERFACE_CSS_DIR', INTERFACE_PARENT_DIR . '/css' );	
	define( 'INTERFACE_FUNCTIONS_DIR', INTERFACE_INC_DIR . '/functions' );
	define( 'INTERFACE_SHORTCODES_DIR', INTERFACE_INC_DIR . '/footer_info' );
	define( 'INTERFACE_STRUCTURE_DIR', INTERFACE_INC_DIR . '/structure' );
	if ( ! defined( 'INTERFACE_LANGUAGES_DIR' ) ) /** So we can define with a child theme */
		define( 'INTERFACE_LANGUAGES_DIR', INTERFACE_PARENT_DIR . '/languages' );
	define( 'INTERFACE_WIDGETS_DIR', INTERFACE_INC_DIR . '/widgets' );

	/** Define URL Location Constants */
	define( 'INTERFACE_PARENT_URL', get_template_directory_uri() );
	define( 'INTERFACE_CHILD_URL', get_stylesheet_directory_uri() );
	define( 'INTERFACE_IMAGES_URL', INTERFACE_PARENT_URL . '/images' );
	define( 'INTERFACE_INC_URL', INTERFACE_PARENT_URL . '/inc' );
	define( 'INTERFACE_ADMIN_URL', INTERFACE_INC_URL . '/admin' );
	define( 'INTERFACE_ADMIN_IMAGES_URL', INTERFACE_ADMIN_URL . '/images' );
	define( 'INTERFACE_ADMIN_JS_URL', INTERFACE_ADMIN_URL . '/js' );
	define( 'INTERFACE_ADMIN_CSS_URL', INTERFACE_ADMIN_URL . '/css' );
	define( 'INTERFACE_JS_URL', INTERFACE_PARENT_URL . '/js' );
	define( 'INTERFACE_CSS_URL', INTERFACE_PARENT_URL . '/css' );
	define( 'INTERFACE_FUNCTIONS_URL', INTERFACE_INC_URL . '/functions' );
	define( 'INTERFACE_SHORTCODES_URL', INTERFACE_INC_URL . '/footer_info' );
	define( 'INTERFACE_STRUCTURE_URL', INTERFACE_INC_URL . '/structure' );
	if ( ! defined( 'INTERFACE_LANGUAGES_URL' ) ) /** So we can predefine to child theme */
		define( 'INTERFACE_LANGUAGES_URL', INTERFACE_PARENT_URL . '/languages' );
	define( 'INTERFACE_WIDGETS_URL', INTERFACE_INC_URL . '/widgets' );

}

add_action( 'interface_init', 'interface_load_files', 15 );
/**
 * Loading the included files.
 *
 * @since 1.0
 */
function interface_load_files() {
	/** 
	 * interface_add_files hook
	 *
	 * Adding other addtional files if needed.
	 */
	do_action( 'interface_add_files' );

	/** Load functions */
	require_once( INTERFACE_FUNCTIONS_DIR . '/i18n.php' );
	require_once( INTERFACE_FUNCTIONS_DIR . '/custom-header.php' );
	require_once( INTERFACE_FUNCTIONS_DIR . '/functions.php' );
	require_once( INTERFACE_FUNCTIONS_DIR . '/custom-style.php' );
	require_once( INTERFACE_ADMIN_DIR . '/interface-themedefaults-value.php' );
	require_once( INTERFACE_ADMIN_DIR . '/theme-option.php' );
	require_once( INTERFACE_ADMIN_DIR . '/interface-metaboxes.php' );
	

	/** Load Shortcodes */
	require_once( INTERFACE_SHORTCODES_DIR . '/interface-footer_info.php' );

	/** Load Structure */
	require_once( INTERFACE_STRUCTURE_DIR . '/header-extensions.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/searchform-extensions.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/sidebar-extensions.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/footer-extensions.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/content-extensions.php' );
	
	require_once( INTERFACE_STRUCTURE_DIR . '/landing.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/menu.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/masonry.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/testimonial.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/visual-highlight.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/case-study.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/quote.php' );
	require_once( INTERFACE_STRUCTURE_DIR . '/contact.php' );

	/** Load Widgets and Widgetized Area */
	require_once( INTERFACE_WIDGETS_DIR . '/interface_widgets.php' );
}

add_action( 'interface_init', 'interface_core_functionality', 20 );
/**
 * Adding the core functionality of WordPess.
 *
 * @since 1.0
 */
function interface_core_functionality() {
	/** 
	 * interface_add_functionality hook
	 *
	 * Adding other addtional functionality if needed.
	 */
	do_action( 'interface_add_functionality' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

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
	register_nav_menu( 'primary', __( 'Primary Menu', 'interface' ) );

	// Add Interface custom image sizes
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'featured-medium', 230, 160, true );
	add_image_size( 'slider-narrow', 1038, 500, true ); 		// used on Featured Slider on Homepage Header for narrow layout
	add_image_size( 'slider-wide', 1440, 500, true ); 			// used on Featured Slider on Homepage Header for wide layout
	add_image_size( 'gallery', 474, 342, true ); 				// used to show gallery all images
	add_image_size( 'icon', 100, 100, true );						//used for icon on business layout
	

	/**
	 * This theme supports custom background color and image
	 */
	add_theme_support( 'custom-background' );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );
}

/** 
 * interface_init hook
 *
 * Hooking some functions of functions.php file to this action hook.
 */
do_action( 'interface_init' );

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
		'name'               => 'Visual Highlights',
		'singular_name'      => 'Visual Highlight',
		'menu_name'          => 'Visual Highlights',
		'name_admin_bar'     => 'Visual Highlight',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Visual Highlight',
		'new_item'           => 'New Visual Highlight',
		'edit_item'          => 'Edit Visual Highlight',
		'view_item'          => 'View Visual Highlight',
		'all_items'          => 'All Visual Highlights',
		'search_items'       => 'Search Visual Highlights',
		'parent_item_colon'  => 'Parent Visual Highlights:',
		'not_found'          => 'No visual highlights found.',
		'not_found_in_trash' => 'No visual highlights found in Trash.'
	);
	
	$args = array_merge( $args, [ 'labels' => $labels ] );
	
	register_post_type( 'visual hightlight', $args );
	
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
	
	register_post_type( 'case studies', $args );
	
	$labels = array(
		'name'               => 'Quotes',
		'singular_name'      => 'Quote',
		'menu_name'          => 'Quotes',
		'name_admin_bar'     => 'Quote',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Quote',
		'new_item'           => 'New Quote',
		'edit_item'          => 'Edit Quote',
		'view_item'          => 'View Quote',
		'all_items'          => 'All Quotes',
		'search_items'       => 'Search Quotes',
		'parent_item_colon'  => 'Parent Quotes:',
		'not_found'          => 'No quotes found.',
		'not_found_in_trash' => 'No quotes found in Trash.'
	);
	
	$args = array_merge( $args, [ 'labels' => $labels ] );
	
	register_post_type( 'quotes', $args );
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function masonry_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'masonry_dimensions',
			'Masonry Dimensions',
			'masonry_dimensions_callback',
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

	echo '<label for="masonry_width">';
	echo 'Masonry Item Width in Units';
	echo '</label> ';
	echo '<input type="text" id="masonry_width" name="masonry_width" value="' . esc_attr( $width ) . '" size="25" /><br /><br />';
	
	$height = get_post_meta( $post->ID, 'masonry_height', true );

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
	}
	$height_data = ( int ) sanitize_text_field( $_POST['masonry_height'] );
	if( $height_data > 3 ) {
		$height_data = 3;
	}
	// Update the meta field in the database.
	update_post_meta( $post_id, 'masonry_width', $width_data );
	update_post_meta( $post_id, 'masonry_height', $height_data );
}
add_action( 'save_post', 'masonry_dimensions_save_data' );

?>