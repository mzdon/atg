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
	get_sidebar( 'footer' );
}

/****************************************************************************************/
if ((1 != $options['disable_bottom']) && (!empty($options['social_phone'] ) || !empty($options['social_email'] ) || !empty($options['social_location']))) {
add_action( 'interface_footer', 'interface_footer_infoblog', 10 );
/**
 * Opens the footer infobox
 */
/****************************************************************************************/

add_action( 'interface_footer', 'interface_footer_div_close', 15 );
/**
 * Opens the site generator div.
 */
function interface_footer_div_close() {
	echo '</div> <!-- .container -->

	</div> <!-- .info-bar -->';
	} 
}
/****************************************************************************************/

add_action( 'interface_footer', 'interface_open_sitegenerator_div', 20 );
/**
 * Opens the site generator div.
 */
function interface_open_sitegenerator_div() {
	echo '

	<div id="site-generator">
				<div class="container clearfix">';
}

	/****************************************************************************************/
	
function atg_socialnetworks() {
	global $interface_theme_setting_value;
   	$options = $interface_theme_setting_value;

   	$elements = array();
		$elements = array( 	$options[ 'social_facebook' ], 
									$options[ 'social_twitter' ],
									$options[ 'social_googleplus' ],
									$options[ 'social_pinterest' ],
									$options[ 'social_youtube' ],
									$options[ 'social_vimeo' ],
									$options[ 'social_linkedin' ],
									$options[ 'social_flickr' ],
									$options[ 'social_tumblr' ],
									$options[ 'social_rss' ]
							 	);	

		$set_flags = 0;		
		if( !empty( $elements ) ) {
			foreach( $elements as $option) {
				if( !empty( $option ) ) {
					$set_flags = 1;
				}
				else {
					$set_flags = 0;
				}
				if( 1 == $set_flags ) {
					break;
				}
			}
		}
		
		$interface_socialnetworks = '';
	if ( ( 1 != $set_flags ) || ( 1 == $set_flags ) )  {
				$social_links = array(); 
				$social_links_name = array();
				$social_links_name = array( __( 'Facebook', 'interface' ), // __ double underscore gets the value for translation
											__( 'Twitter', 'interface' ),
											__( 'Google Plus', 'interface' ),
											__( 'Pinterest', 'interface' ),
											__( 'Youtube', 'interface' ),
											__( 'Vimeo', 'interface' ),
											__( 'LinkedIn', 'interface' ),
											__( 'Flickr', 'interface' ),
											__( 'Tumblr', 'interface' ),
											__( 'RSS', 'interface' )
											);
				$social_links = array( 	'Facebook' 		=> 'social_facebook',
												'Twitter' 		=> 'social_twitter',
												'Google-Plus'	=> 'social_googleplus',
												'Pinterest' 	=> 'social_pinterest',
												'You-tube'		=> 'social_youtube',
												'Vimeo'			=> 'social_vimeo',
												'linkedin'			=> 'social_linkedin',
												'Flickr'			=> 'social_flickr',
												'Tumblr'			=> 'social_tumblr',
												'RSS'				=> 'social_rss'  
											);
											
											
				
				
				$i=0;
				$a = '';
				foreach( $social_links as $key => $value ) {
					if ( !empty( $options[ $value ] ) ) {
						$a .=
							'<li class="'.strtolower($key).'"><a href="'.esc_url( $options[ $value ] ).'" title="'.sprintf( esc_attr__( '%1$s on %2$s', 'interface' ), get_bloginfo( 'name' ), $social_links_name[$i] ).'" target="_blank">'.'</a></li>';
					}
				$i++;	
				}
				
				if($i > 0)
				{
					$interface_socialnetworks .='<div class="social-profiles clearfix">
					<ul>';
					$interface_socialnetworks .= $a;
						
		
					$interface_socialnetworks .='
				</ul>
				</div><!-- .social-profiles -->';
				}	
		
	}
	echo $interface_socialnetworks;
}


add_action( 'interface_footer', 'atg_socialnetworks', 25 );



/****************************************************************************************/

add_action( 'interface_footer', 'interface_footer_info', 30 );
/**
 * function to show the footer info, copyright information
 */
function interface_footer_info() {         
   $output = '<div class="copyright">'.__( 'Copyright &copy;', 'interface' ).' '.interface_the_year().' ' .interface_site_link().' | ' . ' '.__( 'Theme by:', 'interface' ).' '.interface_themehorse_link().' | '.' '.__( 'Powered by:', 'interface' ).' '.interface_wp_link() .'</div><!-- .copyright -->';
   echo $output;
}
/****************************************************************************************/

add_action( 'interface_footer', 'interface_close_sitegenerator_div', 35 );
/**
 * Shows the back to top icon to go to top.
 */
function interface_close_sitegenerator_div() {
echo '</div><!-- .container -->	
			</div><!-- #site-generator -->';
}

/****************************************************************************************/

/*add_action( 'interface_footer', 'interface_backtotop_html', 40 );*/
/**
 * Shows the back to top icon to go to top.
 */
/*function interface_backtotop_html() {
	echo '<div class="back-to-top"><a href="#branding">'.__( ' ', 'interface' ).'</a></div>';
}*/

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