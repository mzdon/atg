<?php

	add_action( 'atg_landing', 'atg_render_landing' );
	
	function atg_render_landing() {
		$output = '<section id="section-landing" class="section-landing parallax"><div class="site-overlay"></div><div class="container clearfix"><div class="align-center welcome-content" id="welcome-content"><h2 id="headline" class="headline">';
		$output .= get_bloginfo( 'name' );
		$output .= '</h2><div id="sub-headline" class="sub-headline">';
		$output .= get_bloginfo( 'description' );
		$output .= '</div></div></div></section>';
		echo $output;
	}
	
?>