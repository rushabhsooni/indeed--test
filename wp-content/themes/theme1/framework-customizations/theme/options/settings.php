<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		fw()->theme->get_options( 'branding' ),
		fw()->theme->get_options( 'general' ),
		fw()->theme->get_options( 'header' ),
		fw()->theme->get_options( 'footer' ),
	);
