<?php
/**
 * Adds footer structures.
 *
 * @package 		Theme Horse
 * @subpackage 		Interface
 * @since 			Interface 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/interface
 */

/****************************************************************************************/
global $interface_theme_setting_value;
		$options = $interface_theme_setting_value;
add_action( 'interface_footer', 'interface_footer_widget_area', 5 );
/** 
 * Displays the footer widgets
 */
function interface_footer_widget_area() {
	echo '<div class="social-wrap"><div class="pre-social">Follow Artisan Trade Guild<span></span></div>';
	get_sidebar( 'footer' );
	echo '<div class="post-social"><span></span>Share Artisan Trade Guild</div></div>';

	$output = '<div class="copyright"><p>'.__( 'Copyright &copy;', 'interface' ).' Artisan Trade Guild, Inc. '.interface_the_year().' All Rights Reserved</p>';
	$output .= '<p>All photography is the sole property of Artisan Trade Guild, Inc. unless otherwise noted.</p>';
	$output .= '<p>No part of this website may be reproduced without Artisan Trade Guild, Inc.\'s express consent</p>';
	$output .= '<p>Backlinks are allowed.</p></div><!-- .copyright -->';
	echo $output;
}

add_action( 'interface_footer', 'interface_footer_div_close', 15 );
/**
 * Opens the site generator div.
 */
function interface_footer_div_close() {
	echo '</div> <!-- .container --></div> <!-- .info-bar -->';
}

/****************************************************************************************/

add_action( 'interface_after_footer', 'atg_landing_images' );

function atg_landing_images() {
	global $interface_theme_setting_value;
   	$options = $interface_theme_setting_value;
	$output = '<style type="text/css" rel="stylesheet">';
	if( !empty( $options[ 'featured_post_slider' ] ) ) {
		foreach( $options[ 'featured_post_slider' ] as $i => $uri ) {
			$uri = preg_replace( '/http:\/\/localhost/', '', $uri );
			$output .= '.landing-image' . $i . ' { background-image: url(\'' . $uri . '\');} ';
		}
	} else {
		$output .= '.section-landing { background-image: url(\'';
		$imgUrl = $options[ 'landing_image' ] ? $options[ 'landing_image' ] : INTERFACE_IMAGES_URL . '/background.jpg';
		$output .= $imgUrl . '\');}';
	}
	if( !empty( $options[ 'highlight_slider' ] ) ) {
		foreach( $options[ 'highlight_slider' ] as $i => $uri ) {
			$uri = preg_replace( '/http:\/\/localhost/', '', $uri );
			$output .= '.highlight-image' . $i . ' { background-image: url(\'' . $uri . '\');} ';
		}
	}
	$output .= '</style>';
	echo $output;
}

?>