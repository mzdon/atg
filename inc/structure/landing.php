<?php

	add_action( 'atg_landing', 'atg_landing_render' );
	
	function atg_landing_render() {
		global $interface_theme_setting_value;
		$options = $interface_theme_setting_value;
		
		if( !empty( $options[ 'featured_post_slider' ] ) ) {
			$interface_featured_sliders = '';

			if( 'narrow-layout' == $options[ 'site_layout' ] ) {
				$slider_size = 'slider-narrow';
			} else {
				$slider_size = 'slider-wide';
			}
			
			$interface_featured_sliders .= '<section id="section-landing" class="section-landing parallax featured-slider"><div class="site-overlay"></div><div class="slider-cycle">';
			foreach( $options[ 'featured_post_slider' ] as $i => $url ) {
				if ( 1 == $i ) {
					$classes = "slides displayblock"; 
				} else { 
					$classes = "slides displaynone"; 
				}
				$interface_featured_sliders .= '<div class="'.$classes.'">';
				$interface_featured_sliders .= '<figure class="section-landing landing-image'.$i.'"></figure>';
				$interface_featured_sliders .= '</div><!-- .slides -->';
			}
			$interface_featured_sliders .= '</div><!-- .slider-cycle -->';
			$interface_featured_sliders .= '<div class="container clearfixS"><div class="aligncenter welcome-content" id="welcome-content"><h2 id="headline" class="headline">';
			$interface_featured_sliders .= get_bloginfo( 'title' );
			$interface_featured_sliders .= '</h2><div class="sub-headline">';
			$interface_featured_sliders .= get_bloginfo( 'description' );
			$interface_featured_sliders .= '</div></div></div>';
			$interface_featured_sliders .= '<nav id="controllers" class="clearfix"></nav><!-- #controllers --></section><!-- .featured-slider -->';
			
			echo $interface_featured_sliders;
		} else {
			$output = '<section id="section-landing" class="section-landing parallax"><div class="site-overlay"></div><div class="container clearfix"><div class="align-center welcome-content" id="welcome-content"><h2 id="headline" class="headline">';
			$output .= get_bloginfo( 'name' );
			$output .= '</h2><div id="sub-headline" class="sub-headline">';
			$output .= get_bloginfo( 'description' );
			$output .= '</div></div></div></section>';
			echo $output;
		}
	}
	
?>