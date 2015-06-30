<?php
/**
 * Interface functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 * 
 * @package Theme Horse
 * @subpackage Interface
 * @since Interface 1.0
 */

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'interface_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function interface_scripts_styles_method() {

	global $interface_theme_default;
   $options = $interface_theme_default;

   /**
	 * Loads our main stylesheet.
	 */
	// Load our main stylesheet.
	wp_enqueue_style( 'interface_style', get_stylesheet_uri());

	
	
	wp_style_add_data( 'interface-ie', 'conditional', 'lt IE 9' ); 
	
	if ('on' == $options['site_design']) {
	//Css for responsive design
	wp_enqueue_style( 'interface-responsive', get_template_directory_uri() . '/css/responsive.css');
	}

	/**
	 * Register JQuery cycle js file for slider.
	 * Register Jquery fancybox js and css file for fancybox effect.
	 */
	wp_enqueue_script( 'jquery_cycle', JS_URL . '/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );

	
	/**
	 * Enqueue Slider setup js file.
	 * Enqueue Fancy Box setup js and css file.	 
	 */	
	if( ( is_home() || is_front_page() ) && "0" == $options[ 'disable_slider' ] ) {
		wp_enqueue_script( 'interface_slider', JS_URL . '/interface-slider-setting.js', array( 'jquery_cycle' ), false, true );
	}
  
	wp_enqueue_script( 'scripts', JS_URL. '/scripts.js', array('jquery') );
	wp_enqueue_script( 'jquery-masonry', false, array( 'jquery' ) );
	
    wp_enqueue_script( 'jquery_localscroll', '//cdnjs.cloudflare.com/ajax/libs/jquery-localScroll/1.3.5/jquery.localScroll.min.js' );
    wp_enqueue_script( 'jquery_scrollto', '//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.11/jquery.scrollTo.min.js' );

} 

/****************************************************************************************/

add_action( 'admin_print_scripts', 'interface_media_js',10 );
/**
 * Register scripts for image upload
 *
 * @uses wp_register_script
 * Hooked to admin_print_scripts action hook
 */
function interface_media_js() {
	
    wp_enqueue_script( 'interface_meta_upload_widget', ADMIN_JS_URL . '/add-image-script-widget.js', array( 'jquery','media-upload','thickbox' ) );
	
	
}


/****************************************************************************************/

add_filter( 'wp_page_menu', 'interface_wp_page_menu' );
/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function interface_wp_page_menu ( $page_markup ) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass = $matches[1];
	$replace = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup; 
}

/****************************************************************************************/

if ( ! function_exists( 'interface_pass_slider_effect_cycle_parameters' ) ) :
/**
 *Functions that Passes slider effect  parameters from php files to jquery file.  
 */
function interface_pass_slider_effect_cycle_parameters() {
    
    global $interface_theme_default;
    $options = $interface_theme_default;
	
	wp_register_script( 'interface_slider', JS_URL . '/interface-slider-setting.js' );

    $transition_effect = $options[ 'transition_effect' ];
    $transition_delay = $options[ 'transition_delay' ] * 1000;
    $transition_duration = $options[ 'transition_duration' ] * 1000;
    wp_localize_script( 
        'interface_slider',
        'atg_slider_value',
        array(
            'transition_effect' => $transition_effect,
            'transition_delay' => $transition_delay,
            'transition_duration' => $transition_duration
        )
    );
    
}
endif;


add_filter( 'body_class', 'interface_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function interface_body_class( $classes ) {
	global $post;	
	global $interface_theme_default;
	$options = $interface_theme_default;

	if( $post ) {
		$layout = get_post_meta( $post->ID,'interface_sidebarlayout', true ); 
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) {

		$themeoption_layout = $options[ 'default_layout' ];

		if( 'left-sidebar' == $themeoption_layout ) {
			$classes[] = 'left-sidebar-template';
		}
		elseif( 'right-sidebar' == $themeoption_layout  ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-full-width' == $themeoption_layout ) {
			$classes[] = 'full-width-template';
		}
			
		elseif( 'no-sidebar' == $themeoption_layout ) {
			$classes[] = 'no-sidebar-template';
		}
	}
	elseif( 'left-sidebar' == $layout ) {
      $classes[] = 'left-sidebar-template';
   }
   elseif( 'right-sidebar' == $layout ) {
		$classes[] = ''; //css blank
	}
	elseif( 'no-sidebar-full-width' == $layout ) {
		$classes[] = 'full-width-template';
	}
	
	elseif( 'no-sidebar' == $layout ) {
		$classes[] = 'no-sidebar-template'; //css for no-sidebar-template from <body >
	}
	if( is_home() || is_front_page())
	{
		
		if( is_page_template( 'page-templates/page-template-business.php' ) ) {
			
			$classes[] = 'business-layout';
		}else{
			$classes[] = '';        // css for home page with body class.
			}
	}

	if( is_page_template( 'page-templates/page-template-blog-image-medium.php' ) ) {
		$classes[] = 'blog-medium';
	}
	if( 'narrow-layout' == $options[ 'site_layout' ] ) {
		$classes[] = 'narrow-layout';
	}

	return $classes;
}

/****************************************************************************************/
add_action( 'pre_get_posts','interface_alter_home' );
/**
 * Alter the query for the main loop in home page
 *
 * @uses pre_get_posts hook
 */
function interface_alter_home( $query ){
	global $interface_theme_default;
	$options = $interface_theme_default;
	$cats = $options[ 'front_page_category' ];

	if ( $options[ 'exclude_slider_post'] != "0" && !empty( $options[ 'featured_post_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_post_slider' ];
		}
	}

	if ( !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $options[ 'front_page_category' ];
		}
	}
}

/**************************************************************************************/

require( get_template_directory() . '/inc/admin/interface-themedefaults-value.php' );

global $interface_theme_default;
$interface_theme_default = interface_theme_default_set( $interface_default );

function interface_theme_default_set( $interface_default) {
	$interface_theme_default = array_merge( $interface_default, (array) get_option( 'interface_theme_options', array() ) );
	return apply_filters( 'interface_theme_default', $interface_theme_default );
}



/**************************************************************************************/
require_once( ADMIN_DIR . '/interface-themedefaults-value.php' );
$interface_theme_setting_value = interface_theme_options_set_defaults( $interface_default );
function interface_theme_options_set_defaults( $interface_default) {
	global $interface_theme_setting_value;
	$interface_theme_setting_value = array_merge( $interface_default, (array) get_option( 'interface_theme_options', array() ) );
	return apply_filters( 'interface_theme_setting_value', $interface_theme_setting_value );
}

/**************************************************************************************/
?>