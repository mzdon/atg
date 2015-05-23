<?php

add_action( 'atg_masonry', 'atg_render_masonry' );

function atg_render_masonry() {
	
	$output = '<section id="section-masonry"><div class="clearfix masonry full-width"><div class="grid-size"></div><div class="gutter-size"></div>';

	while( have_posts() ) {
		the_post();
		$id = get_the_ID();
		$meta = get_post_meta($id);
		$width = $meta[ 'masonry_width' ] ? $meta[ 'masonry_width' ][ 0 ] : 1;
		$height = $meta[ 'masonry_height' ] ? $meta[ 'masonry_height' ][ 0 ] : 1;
		$classes = array(
			"masonry-item"
		);
		$categories = get_the_category( $id );
		foreach( $categories as $category ) {
			array_push( $classes, $category->name );
		}
		if( $width > 1 ) {
			array_push( $classes, "width-".$width );
		}
		if( $height > 1 ) {
			array_push( $classes, "height-".$height );
		}
		$output .= '<article id="' . $id . '" class="' . implode( " ", $classes ) . '"><a href="' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[ 0 ] . '" rel="lightbox" class="masonry-item-wrapper" title="' . get_the_title( $id ) . '"><div class="title"><h2>' . get_the_title( $id ) . '</h2></div></a>';
		$size = array(
			500,
			500
		);
		$output .= get_the_post_thumbnail( $id, $size, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) );
		
		$output .= '</article>';
	}
	
	$output .= '</a></section>';
	
	echo $output;
}

?>