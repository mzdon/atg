<?php

add_action( 'atg_contact', atg_contact_form );

function atg_contact_form() {
	echo '<section id="section-contact" class="clearfix">';
	echo do_shortcode( '[contact-form-7 id="64" title="Contact form 1"]' );
	echo '</section>';
}

?>