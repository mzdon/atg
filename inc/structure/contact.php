<?php

add_action( 'atg_contact', atg_contact_form );

function atg_contact_form() {
	$output = '<section id="section-contact" class="clearfix">';
	$output .= do_shortcode( '[contact-form-7 id="64" title="Contact form 1"]' );
	$output .= '</section>';
	
	echo $output;
}

?>