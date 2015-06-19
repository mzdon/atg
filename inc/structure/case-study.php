<?php

	add_action( 'atg_case_study', 'render_atg_case_study' );

	function render_atg_case_study() {
		if( function_exists( 'render_atg_masonry' ) ) {
			render_atg_masonry( 'case_study' );
		}
	}

?>