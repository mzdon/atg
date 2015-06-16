<?php
	add_action( 'atg_quote', 'render_atg_quote' );

	function render_atg_quote() {
		echo '<section id="section-quote"><div class="quote-bg"></div>';
		echo '<div class="quote-text"><h1>Great art picks up where nature ends.</h1>';
		echo '<p class="credit">Marc Chagall</p></h3></div></section>';
	}
?>