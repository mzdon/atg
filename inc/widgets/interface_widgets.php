<?php
/**
 * Contains footer widget area definition.
 *
 * @package Theme Horse
 * @subpackage Interface
 * @since Interface 1.0
 */

/****************************************************************************************/

add_action( 'widgets_init', 'atg_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function atg_widgets_init() {

	/** 
	 * Registering footer sidebar 1
	 * For upgrade compatible reason footer id not kept interface_footer_column1
	 */
	register_sidebar( array(
		'name' 				=> 'Footer',
		'id' 				=> 'atg_footer_sidebar',
		'description'   	=> 'Shows widgets at footer.',
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h1 class="widget-title">',
		'after_title'   	=> '</h1>'
	) );
}

?>
