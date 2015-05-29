<?php
	add_action( 'atg_menu', 'render_atg_menu' );
	
	function render_atg_menu() {
		$output =  '<section id="section-menu"><button class="menu-toggle">Responsive Menu</button><nav><div class="atg-menu"><ul class="nav-menu">';
		
		$categories = get_categories();
		if( !empty( $categories ) ) {
			$output .= '<li class="category-filter" data-category="All"><a href="">All</a></li>';
			foreach( $categories as $category ) {
				$output .= '<li class="category-filter" data-category="' . $category->name . '"><a href="">' . $category->name . '</a></li>';
			}
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