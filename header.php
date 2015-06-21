<?php
/**
 * Displays the header section of the theme.
 *
 * @package Theme Horse
 * @subpackage Interface
 * @since Interface 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<?php
		do_action( 'atg_header' );

		/** 
		 * This hook is important for WordPress plugins and other many things
		 */
		wp_head();
	?>
	<script type="text/javascript">
		( function( $ ) {
			$( window ).load( function() {
				$( '#loading-cover' ).fadeOut( 1000 );
			} );
		})( jQuery );
	</script>
</head>

<body <?php body_class(); ?>>
<div id="loading-cover"></div>
<div class="wrapper">