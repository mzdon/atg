<?php
/**
 * Adds header structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Interface
 * @since 			Interface 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/interface
 */

/****************************************************************************************/

add_action( 'atg_header', 'atg_add_meta_name', 5 );
/**
 * Add meta tags.
 */ 
function atg_add_meta_name() {
?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php  
 	global $interface_theme_setting_value;
      $options = $interface_theme_setting_value;
	   if ('on' == $options['site_design']) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php   } else{ ?>
<meta name="viewport" content="width=1078" />
<?php  }
}

/****************************************************************************************/

//add_action( 'interface_links', 'interface_add_links', 10 );
add_action( 'atg_header', 'atg_add_links', 10 );
/**
 * Adding link to stylesheet file
 *
 * @uses get_stylesheet_uri()
 */
function atg_add_links() {
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php
}

/****************************************************************************************/

// Load Favicon in Header Section
//add_action( 'interface_links', 'interface_favicon', 15 );
add_action( 'atg_header', 'atg_favicon', 15 );
// Load Favicon in Admin Section
add_action( 'admin_head', 'atg_favicon' );
/**
 * Get the favicon Image from theme options
 * display favicon
 * 
 */
function atg_favicon() {	
	
	$interface_favicon = '';
		global $interface_theme_setting_value;
      $options = $interface_theme_setting_value;

		if ( "0" == $options[ 'disable_favicon' ] ) {
			if ( !empty( $options[ 'favicon' ] ) ) {
				$interface_favicon .= '<link rel="shortcut icon" href="'.esc_url( $options[ 'favicon' ] ).'" type="image/x-icon" />';
			}
		}

	echo $interface_favicon ;	
}

/****************************************************************************************/

// Load webpageicon in Header Section
//add_action( 'interface_links', 'interface_webpage_icon', 20 );
add_action( 'atg_header', 'atg_webpage_icon', 20 );
/**
 * Get the webpageicon Image from theme options
 * display webpageicon
 *
 */
function atg_webpage_icon() {	
	
	$interface_webpage_icon = '';
		global $interface_theme_setting_value;
      $options = $interface_theme_setting_value;

		if ( "0" == $options[ 'disable_webpageicon' ] ) {
			if ( !empty( $options[ 'webpageicon' ] ) ) {
				$interface_webpage_icon .= '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $options[ 'webpageicon' ] ).'" />';
			}
		}
		
		
	echo $interface_webpage_icon ;	
}

/****************************************************************************************/

//add_action( 'interface_header', 'interface_headercontent_details', 10 );
add_action( 'atg_header', 'atg_header_setup', 25 );
/**
 * Shows Header content details
 *
 * Shows the site logo, title, description, searchbar, social icons and many more
 */
function atg_header_setup() {
	
	if( function_exists( 'interface_pass_slider_effect_cycle_parameters' ) ) {
		interface_pass_slider_effect_cycle_parameters();
	}

if ( ! function_exists( 'atg_home_slogan' ) ) :

/**
 * Display Home Slogan.
 *
 * Function that enable/disable the home slogan1 and home slogan2.
 */
function atg_home_slogan() {	
	global $interface_theme_setting_value;
   $options = $interface_theme_setting_value;
	
	$interface_home_slogan = '';
	if( !empty( $options[ 'home_slogan1' ] ) || !empty( $options[ 'home_slogan2' ] ) ) {
      
		if ( "0" == $options[ 'disable_slogan' ] ) {
			$interface_home_slogan .= '<section class="slogan-wrap"><div class="container"><div class="slogan">';
			if ( !empty( $options[ 'home_slogan1' ] ) ) {
				$interface_home_slogan .= esc_html( $options[ 'home_slogan1' ] );
			}
			if ( !empty( $options[ 'home_slogan2' ] ) ) {
				$interface_home_slogan .= '<span>'.esc_html( $options[ 'home_slogan2' ] ).'</span>';
			}
			$interface_home_slogan .= '</div><!-- .slogan -->';
			$interface_home_slogan .= '</div><!-- .container --></section><!-- .slogan-wrap -->';
		}
		
	}	
	echo $interface_home_slogan;
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'atg_breadcrumb' ) ) :
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function atg_breadcrumb() {
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb">';                
		bcn_display();               
		echo '</div> <!-- .breadcrumb -->'; 
	}   
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'atg_header_title' ) ) :
/**
 * Show the title in header
 *
 * @since Interface 1.0
 */
function atg_header_title() {
	if( is_archive() ) {
		$interface_header_title = single_cat_title( '', FALSE );
	}
	elseif( is_404() ) {
		$interface_header_title = __( 'Page NOT Found', 'interface' );
	}
	elseif( is_search() ) {
		$interface_header_title = __( 'Search Results', 'interface' );
	}
	elseif( is_page_template()  ) {
		$interface_header_title = get_the_title();
	}
	else {
		$interface_header_title = get_the_title();
	}

	return $interface_header_title;

}
endif;
}

?>
