<?php

add_action( 'atg_visual_highlight', 'atg_render_visual_highlight' );

function atg_render_visual_highlight() {
	
	$output = '<section id="section-visual-highlight" class="highlight-slider"><div class="highlight-cycle">';
	
	$args = array(
		'post_type' => 'visual_highlight'
	);
	$query = new WP_Query( $args );

	if( $query->have_posts() ) {
		$query->the_post();
		$id = $query->post->ID;
		$meta = get_post_meta($id);
		
		if( class_exists('Dynamic_Featured_Image') ) {
			global $dynamic_featured_image;
			$images = $dynamic_featured_image->get_featured_images( $id );
		} else {
			echo "No Dynamic Featured Image Class";
			die();
		}
		
		foreach( $images as $i => $image ) {
			$output .= '<figure class="visual-image-' . $i . '"></figure>';
		}
	}
	
	$output .= '</div></section>';
	
	echo $output;
}

?>