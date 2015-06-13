<?php

	add_action( 'atg_visual_highlight', 'atg_render_visual_highlight' );
	
	function atg_render_visual_highlight() {
		global $interface_theme_setting_value;
		$options = $interface_theme_setting_value;
		
		if( !empty( $options[ 'highlight_slider' ] ) ) {
			$highlight_sliders .= '<section id="section-visual-highlight" class="highlight-slider"><div class="highlight-cycle">';
			
			foreach( $options[ 'highlight_slider' ] as $i => $url ) {
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
				$highlight_sliders .= '<div class="slides"><figure class="highlight-image highlight-image'.$i.'"></figure>';
				
				/*if( $posts[ 0 ]->post_excerpt ) {
					$highlight_sliders .= '<div><div class="caption">' . $posts[ 0 ]->post_excerpt . '</div>';
					
					if( $posts[ 0 ]->post_content ) {
						$highlight_sliders .= '<div class="name">' . $posts[ 0 ]->post_content . '</div>';
					}
					$highlight_sliders .= '</div>';
				}*/
				$highlight_sliders .= '</div><!-- .slides -->';
			}
			$highlight_sliders .= '</div><!-- .slider-cycle --><nav id="highlight-controllers" class="clearfix"></nav><!-- #controllers --></section><!-- .featured-slider -->';
			
			echo $highlight_sliders;
		}
	}
	
?>