<?php
	
	if ( ! isset( $content_width ) ) $content_width = 320;

	// Define necessary constants
	
	// Define cache time for scripts and styles
	define( '_WPLAB_UNICUM_CACHE_TIME_', '140220170928');
	
	// Load config
	require_once get_template_directory() . '/wproto/config.php';
	
	// Dump function
	if( !function_exists( 'wp_dump' ) ) {
		function wp_dump() {
			if ( func_num_args() > 0 ) {
				
				$args = func_get_args();
				
				foreach( $args as $arg ) {
					echo '<pre>';
					var_dump( $arg );
					echo '</pre>';
				}
				
			}
		}
	}
	
	// Instantiate base controller that will autoload
	// all application classes. 
	require_once get_template_directory() . '/wproto/controller/core-controller.php';

	// Start the core
	$wplab_unicum_core = new wplab_unicum_core_controller();	
	$wplab_unicum_core->run();