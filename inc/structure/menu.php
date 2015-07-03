<?php
	add_action( 'atg_menu', 'render_atg_menu' );
	
	function render_atg_menu() {
		$output =  '<section id="section-menu"><button class="menu-toggle">Responsive Menu</button><nav><div class="atg-menu"><span class="menu-icon"></span><ul class="nav-menu">';
		
		$skip = [
			'uncategorized',
			'text',
			'no-lightbox'
		];
		$applications = [
			'tilework',
			'masonry',
			'flooring',
			'hardscaping'
		];
		$locations = [
			'bathroom',
			'kitchen',
			//'living-room',
			'homes',
			'outdoor'
		];

		$categories = get_categories();
		if( !empty( $categories ) ) {
			$output .= '<li class="category-filter" data-category="All"><a href="#section-grid">View All</a></li>';
			$applicationsOutputStart = '<li class="category-parent"><a href="">Applications</a><ul>';
			$applicationsOutput = '';
			$applicationsOutputEnd = '</ul></li>';
			$locationsOutputStart = '<li class="category-parent"><a href="">Locations</a><ul>';
			$locationsOutput = '';
			$locationsOutputEnd = '</ul></li>';
			foreach( $categories as $category ) {
				$str = '<li class="category-filter" data-category="' . $category->slug . '"><a href="#section-grid">' . $category->name . '</a></li>';
				if( in_array( $category->slug, $applications ) ) {
					$applicationsOutput .= $str;
				} else if ( in_array( $category->slug, $locations ) ) {
					$locationsOutput .= $str;
				} else if( !in_array( $category->slug, $skip ) ) {
					$output .= $str;
				}
				unset( $str );
			}
			$output .= $applicationsOutputStart . $applicationsOutput . $applicationsOutputEnd;
			$output .= $locationsOutputStart . $locationsOutput . $locationsOutputEnd;
		}
		
		$args = array(
			'menu' => 'atg',
			'container' => false,
			'echo' => 0,
			'items_wrap' => '%3$s'
		);
		$output .= wp_nav_menu( $args );  //extract the content from apperance-> nav menu
		
		$output .= '</ul></div></nav></section>';
		
		echo $output;
	}
?>