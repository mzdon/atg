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
}

?>
