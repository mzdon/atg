<?php

	add_action( 'atg_landing', 'atg_landing_render' );
	
	function atg_landing_render() {
		global $interface_theme_setting_value;
		$options = $interface_theme_setting_value;
		
		/*$args = array( 
			'post_type' => 'attachment', 
			'orderby' => 'menu_order', 
			'order' => 'ASC', 
			'post_mime_type' => 'image',
			'post_status' => null, 
			'numberposts' => null, 
			'post_parent' => $post->ID 
		);

		$attachments = get_posts($args);
		if ($attachments) {
			foreach ( $attachments as $attachment ) {
				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
				$image_title = $attachment->post_title;
				$caption = $attachment->post_excerpt;
				$description = $image->post_content;
			}
		}
		
		<a href="<?php echo wp_get_attachment_url( $attachment->ID); ?>" rel="lightbox" title="<?php echo $image_title; ?>"><img src="<?php echo get_bloginfo('template_directory'); ?>/timthumb.php?h=75&w=75&zc=1&src=<?php echo wp_get_attachment_url( $attachment->ID , false ); ?>" alt="<?php echo $alt; ?>" width="75" height="75" border="0" /></a>*/
		
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
				//echo $key;
				//echo "Media: " . print_r( $posts, true );
				
				//die();
					
				$interface_featured_sliders .= '<div class="'.$classes.'">';
				$interface_featured_sliders .= '<figure class="section-landing landing-image'.$i.'"></figure>';
				if( $posts[ 0 ]->post_excerpt ) {
					$interface_featured_sliders .= '<div><div class="caption">' . $posts[ 0 ]->post_excerpt . '</div>';
					if( $posts[ 0 ]->post_content ) {
						$interface_featured_sliders .= '<div class="name">' . $posts[ 0 ]->post_content . '</div>';
					}
					$interface_featured_sliders .= '</div>';
				}
				$interface_featured_sliders .= '</div><!-- .slides -->';
			}
			$interface_featured_sliders .= '</div><!-- .slider-cycle -->';
			/*$interface_featured_sliders .= '<div class="container clearfix"><div class="aligncenter welcome-content" id="welcome-content"><h2 id="headline" class="headline">';
			$interface_featured_sliders .= get_bloginfo( 'title' );
			$interface_featured_sliders .= '</h2><div class="sub-headline">';
			$interface_featured_sliders .= get_bloginfo( 'description' );
			$interface_featured_sliders .= '</div></div></div>';*/
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