<?php

	add_action( 'atg_case_study', 'render_atg_case_study' );

	function render_atg_case_study() {
		file_put_contents('/tmp/out.txt', "atg_case_study called\n");
		if( function_exists( 'render_atg_masonry' ) ) {
			file_put_contents('/tmp/out.txt', "render_atg_masonry exists\n", FILE_APPEND);
			render_atg_masonry( 'case_study' );
		}
	}

?>