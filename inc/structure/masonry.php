<?php

add_action( 'atg_masonry', 'atg_render_masonry' );

function atg_render_masonry() {
	
	$output = '<section id="section-grid"><div class="clearfix grid full-width"><div class="grid-size"></div><div class="gutter-size"></div>';
	
	$args = array(
		'meta_key'   => 'display_priority',
		'orderby'    => 'meta_value_num id',
		'order'      => 'DESC',
		'nopaging'   => true
	);
	$query = new WP_Query( $args );

	while( $query->have_posts() ) {
		$query->the_post();
		$id = $query->post->ID;
		$meta = get_post_meta($id);
		$isAbout = false;
		$uncategorized = false;
		$text = false;
		$width = $meta[ 'masonry_width' ] ? $meta[ 'masonry_width' ][ 0 ] : 1;
		$height = $meta[ 'masonry_height' ] ? $meta[ 'masonry_height' ][ 0 ] : 1;
		$classes = array(
			"grid-item"
		);
		$categories = get_the_category( $id );
		foreach( $categories as $category ) {
			array_push( $classes, $category->slug );
			if( $category->slug == 'about-artisan' ) {
				$isAbout = true;
			}
			if( $category->slug == 'uncategorized' ) {
				$uncategorized = true;
			}
			if( $category->slug == 'text' ) {
				$text = true;
			}
		}

		if( $width > 1 ) {
			array_push( $classes, "width-".$width );
		}
		if( $height > 1 ) {
			array_push( $classes, "height-".$height );
		}

		if( class_exists('Dynamic_Featured_Image') ) {
     		global $dynamic_featured_image;
     		$imgs = $dynamic_featured_image->get_all_featured_images( );
 		}
		
		if( !empty( $imgs ) ) {
			$imgUrl = $imgs[ 0 ][ full ];
			if( !is_null( $imgs[ 1 ] ) ) {
				$fullImgUrl = $imgs[ 1 ][ full ];
			}
 		} else {
			$imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[ 0 ];
		}

		$output .= '<article id="' . $id . '" class="' . implode( " ", $classes ) . '">';
		if( $isAbout ) {
			$output .= '<div class="grid-item-wrapper" style="background-image: url(\'' . $imgUrl . '\');"><h6>' . get_the_title( $id ) . '</h6><p>' .get_the_content() . '</div>';
		} else if( $uncategorized ) {
			$output .= '<div class="grid-item-wrapper" style="background-image: url(\'' . $imgUrl . '\');"></div>';
		} else if( $text ) {
			$output .= '<a href="' . $imgUrl . '" rel="lightbox" class="grid-item-wrapper" title="' . get_the_title( $id ) . '" style="background-image: url(\'' . $imgUrl . '\');"><div class="title"><h2>' . get_the_title( $id ) . '</h2><p>' .get_the_content() . '</div></a>';
		}else {
			$output .= '<a href="' . ( $fullImgUrl ? $fullImgUrl : $imgUrl ) . '" rel="lightbox" class="grid-item-wrapper" title="' . get_the_title( $id ) . '" style="background-image: url(\'' . $imgUrl . '\');"><div class="shadow"></div><div class="title"><h2>' . get_the_title( $id ) . '</h2><p>' .get_the_content() . '</div></a>';
		}
		$output .= '</article>';

		unset( $fullImgUrl );
	}
	
	$output .= '</a></section>';
	
	echo $output;
}

?>