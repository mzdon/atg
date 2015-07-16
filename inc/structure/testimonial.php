<?php

	add_action( 'atg_testimonial', 'render_atg_testimonial' );

	function render_atg_testimonial() {
		$args = [
			'post_type' => 'testimonial',
		];

		$query = new WP_Query( $args );

		$output = '<section id="section-testimonial">';

		if( $query->have_posts() ) {
			$post = $query->the_post();

			$categories = get_the_category( );
			$category_string = '';
			foreach( $categories as $category ) {
				if( strlen( $category_string ) > 0 ) {
					$category_string .= ' & ';
				}
				$category_string .= $category->slug;
			}

			$imgs = array();
			if( class_exists('Dynamic_Featured_Image') ) {
	     		global $dynamic_featured_image;
	     		$imgs = $dynamic_featured_image->get_all_featured_images( );
	 		}

	 		$output .= '<div class="testimonial clearfix">';
	 		$output .= build_text_markup( $post, $category_string );
	 		$output .= build_image_markup( $imgs );
	 		$output .= '</div>';
		}

		$output .= '</section>';

		echo $output;
	}

	function build_text_markup( $post, $cat_string ) {
		$output = '<div class="main">';
		$output .= '<div class="content"><h2>' . get_the_title() . '</h2>';
		$output .= '<h4>' . $cat_string . '</h4>';
		$output .= '<p>' . get_the_content() . '</p></div>';
		$output .= '<div class="top-right"></div><div class="top-left"></div><div class="bottom-right"></div><div class="bottom-left"></div></div>';

		return $output;
	}

	function build_image_markup( $imgs ) {
		$output = '';
		if( !empty( $imgs ) ) {
			$output .= '<div class="testimonial-cycle clearfix">';
			foreach( $imgs as $img ) {
				$output .= '<figure class="testimonial-img" style="background-image: url(\' ' . $img['full'] . ' \');"></figure>';
			}
			$output .= '</div><div class="pattern"></div><span id="left-button"></span><span id="right-button"></span>';
		}
		return $output;
	}

?>