<?php

	add_action( 'interface_footer_sidebar', 'atg_display_footer_sidebar', 10 );
	/**
	 * Show widgets on Footer of the theme.
	 */
	function atg_display_footer_sidebar() {
		if( is_active_sidebar( 'atg_footer_sidebar' ) ) {
			?>

	<div class="widget-wrap">
	  <div class="container">
	    <div class="widget-area clearfix">
	        <?php
				if ( is_active_sidebar( 'atg_footer_sidebar' ) ) :
				dynamic_sidebar( 'atg_footer_sidebar' );
				endif;
				
				?>
	    </div>
	    <!-- .widget-area --> 
	  </div>
	  <!-- .container --> 
	</div>
	<!-- .widget-wrap -->
	<?php
		}
	}
?>
