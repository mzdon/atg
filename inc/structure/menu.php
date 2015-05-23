<?php
	add_action( 'atg_menu', 'render_atg_menu' );
	
	function render_atg_menu() {
		$output =  '<section id="section-menu"><button class="menu-toggle">Responsive Menu</button><nav>';
		$args = array(
			'menu' => 'atg',
			'container_class' => 'atg-menu',
			'echo' => 0,
			'items_wrap' => '<ul class="nav-menu">%3$s</ul>'
			 
		);
		$output .= wp_nav_menu( $args );  //extract the content from apperance-> nav menu
		
		$categories = get_categories();
		if( !empty( $categories ) ) {
			$output .= '<div class="atg-menu"><ul class="nav-menu"><li class="category-filter" data-category="All"><a href="">All</a></li>';
			foreach( $categories as $category ) {
				$output .= '<li class="category-filter" data-category="' . $category->name . '"><a href="">' . $category->name . '</a></li>';
			}
			$output .= '</ul></div>';
		}
		
		$output .= '</nav></section>';
		
		echo $output;
	}
?>