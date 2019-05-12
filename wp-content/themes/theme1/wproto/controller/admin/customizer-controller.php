<?php 
/**
 * Customizer controller
 **/
class wplab_unicum_customizer_controller extends wplab_unicum_core_controller {
	
	function __construct() {
		
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		
		// AJAX
		add_action( 'wp_ajax_wproto_get_customizer_stylesheet', array( $this, 'ajax_get_less_file' ) );
		add_action( 'wp_ajax_wproto_save_customizer_stylesheet', array( $this, 'ajax_save_less' ) );
		
	}
	
	/**
	 * Add customizer to menu
	 **/
	function add_admin_menu() {
		global $menu, $submenu;
		
		if ( current_user_can( 'edit_theme_options' ) ) {
			add_theme_page( esc_html__( 'Fonts and Colors', 'wplab-unicum' ), esc_html__( 'Fonts and Colors', 'wplab-unicum' ), 'edit_theme_options', 'theme_customizer', array( $this, 'display_customizer' ) );
		}
		
	}
	
	/**
	 * Display Customizer screen
	 **/
	function display_customizer() {
		global $wplab_unicum_core;
		$wplab_unicum_core->view->load_partial( 'settings/customizer', array() );
	}
	
	/**
	 * Save settings handler
	 **/
	function save() {
		
		$settings_array = array();
		$_POST = wp_unslash( $_POST );
		
		if( isset( $_POST['wproto_reset_to_defaults'] ) ) {
			update_option( 'wplab_unicum_custom_styles', 'no' );
			update_option( 'wplab_unicum_theme_styles', '' );
			
		} elseif( isset( $_POST['theme_styles'] ) && is_array( $_POST['theme_styles'] ) ) {
			update_option( 'wplab_unicum_custom_styles', 'yes' );
			update_option( 'wplab_unicum_theme_styles', $_POST['theme_styles'] );	
		}
			
		header( 'Location: ' . add_query_arg( array( 'updated' => 'true' ) ) );
		exit;
		
	}
	
	/**
	 * Get content of less file
	 **/
	function ajax_get_less_file() {
		global $wpl_exe_wp, $wplab_unicum_core;
		
		$file_content = $wplab_unicum_core->controller->io->read( get_template_directory() . '/css/front/customizer.less' );
		
		echo $file_content;
		die;
	}
	
	/**
	 * Save compiled LESS into file
	 **/
	function ajax_save_less() {
		global $wplab_unicum_core;
		
		$_POST = stripslashes_deep( $_POST );
		$stylesheet = $_POST['css'];

		$upload_dir = wp_upload_dir();
		
		$style_filename = $upload_dir['basedir'] . '/wplab_unicum_custom_css.css';
		
		// write to a file
		$wplab_unicum_core->controller->io->write( $style_filename, $stylesheet );	
		die;
	}
	
}