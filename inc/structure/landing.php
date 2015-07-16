<?php

	add_action( 'atg_landing', 'atg_landing_render' );
	
	function atg_landing_render() {
		global $interface_theme_setting_value;
		$options = $interface_theme_setting_value;

		$output = '<section id="section-landing" class="section-landing parallax featured-slider">';
		$output .= '<video src="' . get_template_directory_uri() . '/videos/header.mp4" loop>Your browser does not support the <code>video</code> html tag!</video>';
		$output .= '</section>';
		echo $output;

		/*if( !empty( $options[ 'featured_post_slider' ] ) ) {
			$interface_featured_sliders .= '<section id="section-landing" class="section-landing parallax featured-slider"><div class="slider-cycle">';

			foreach( $options[ 'featured_post_slider' ] as $i => $url ) {

				if( $url == '' ) {
					continue;
				}

				$match = preg_match( "/\/([^\/]*)\.(?:png|jpg)$/", $url, $matches );
				
				if( $match ) {
					$key = $matches[ 1 ];
				}
				
				$args = array(
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'name' => $key
				);
				$posts = get_posts( $args );
				$interface_featured_sliders .= '<div class="slides"><figure class="section-landing landing-image'.$i.'"></figure>';
				
				if( $posts[ 0 ]->post_excerpt ) {
					$interface_featured_sliders .= '<div><div class="caption">' . $posts[ 0 ]->post_excerpt . '</div>';
					
					if( $posts[ 0 ]->post_content ) {
						$interface_featured_sliders .= '<div class="name">' . $posts[ 0 ]->post_content . '</div>';
					}
					$interface_featured_sliders .= '</div>';
				}
				$interface_featured_sliders .= '</div><!-- .slides -->';
			}
			$interface_featured_sliders .= '</div><!-- .slider-cycle --><!--<nav id="controllers" class="clearfix"></nav>--><!-- #controllers --></section><!-- .featured-slider -->';
			
			echo $interface_featured_sliders;
		} else if( false ) {
			$output = '<section id="section-landing" class="section-landing parallax"><div class="site-overlay"></div><div class="container clearfix"><div class="align-center welcome-content" id="welcome-content"><h2 id="headline" class="headline">';
			$output .= get_bloginfo( 'name' );
			$output .= '</h2><div id="sub-headline" class="sub-headline">';
			$output .= get_bloginfo( 'description' );
			$output .= '</div></div></div></section>';
			echo $output;
		}*/
	}
	
?>