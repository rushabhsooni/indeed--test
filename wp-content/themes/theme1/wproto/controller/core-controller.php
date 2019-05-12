<?php

/**
 * Primary core controller
 **/
class wplab_unicum_core_controller {
	
	public $model;
	public $view;
	public $controller;
	
	/**
	 * Enter point for a framework
	 * @param array
	 **/
	public function run() {
		
		// Start the session
		if( ! session_id() ) {
			@session_start();
		}
		
		// Translation support
		load_theme_textdomain( 'wplab-unicum', get_template_directory() . '/languages' );
		
		// Theme activation & deactivation
		add_action( 'init', array( $this, 'activation_hook'));
		add_action( 'switch_theme', array( $this, 'deactivation_hook' ));
		
		// Load core classes
		$this->_dispatch();
		
		// Route $_GET/$_POST actions
		add_action( 'parse_request', array( $this, 'delegate_to_controller_action' ), 1 );
		add_action( 'admin_init', array( $this, 'delegate_to_controller_action' ), 1 );

	}
	
	/**
	 * Do some stuff when plugin was just activated
	 **/
	public function activation_hook() {
		global $pagenow, $wp_version;
		
		if( version_compare( PHP_VERSION, '5.2.6', '<' ) ) {
			wp_die( sprintf( esc_html__( 'Cannot activate the theme. PHP version >= 5.2.6 is required. Your PHP version: %s', 'wplab-unicum' ), PHP_VERSION ) );
		}
	
		if( version_compare( $wp_version, '4.2', '<' ) ) {
			wp_die( sprintf( esc_html__( 'Cannot activate the theme. WordPress version >= 4.2 is required. Your WordPress version: %s', 'wplab-unicum' ), $wp_version ) );
		}
	
		flush_rewrite_rules( true );
		wp_cache_flush();
		
	}
	
	/**
	 * Deactivation hook
	 **/
	public function deactivation_hook() {
		
		flush_rewrite_rules( true );
		
	}
	
	/**
	 * Autoload and instantiate all application
	 * classes neccessary for this plugin
	 **/
	private function _dispatch() {
		$this->model =		  new stdClass();
		$this->view =				new stdClass();
		$this->controller =	new stdClass();

		// Manually load dependency classes first
		require_once get_template_directory() . '/wproto/view/view.php';

		// Manually instantiate dependency classes first
		$this->view = new wplab_unicum_view();
		$this->controller->base = $this;

		require_once get_template_directory() . '/wproto/model/database.php';
		$this->model->database = new wplab_unicum_database();
		
		require_once get_template_directory() . '/wproto/model/post.php';
		$this->model->post = new wplab_unicum_post();
		
		require_once get_template_directory() . '/wproto/model/slider.php';
		$this->model->slider = new wplab_unicum_slider();
		
		require_once get_template_directory() . '/wproto/controller/shared/io-controller.php';
		$this->controller->io = new wplab_unicum_io_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/init-controller.php';
		$this->controller->init = new wplab_unicum_init_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/menu-controller.php';
		$this->controller->menu = new wplab_unicum_menu_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/ajax-controller.php';
		$this->controller->ajax = new wplab_unicum_ajax_controller();
		
		if( is_admin() ) {
			// Controllers for admin part only
			require_once get_template_directory() . '/wproto/controller/admin/backend-controller.php';
			$this->controller->backend = new wplab_unicum_backend_controller();
			
			require_once get_template_directory() . '/wproto/controller/admin/customizer-controller.php';
			$this->controller->customizer = new wplab_unicum_customizer_controller();
			
		} else {
			// Controllers for front-end part only
			require_once get_template_directory() . '/wproto/controller/front/front-controller.php';
			$this->controller->front = new wplab_unicum_front_controller();
			
			require_once get_template_directory() . '/wproto/controller/front/shortcodes-controller.php';
			$this->controller->shortcodes = new wplab_unicum_shortcodes_controller();
			
		}
		
		$this->_autoload_directory( 'helper', '/', false );
		$this->_autoload_directory( 'widget', '/', false );

		// Inject models, view and controllers from this base
		// controller into all OTHER controllers & models
		foreach ( $this->controller as $controller ) {
			$controller->_inject_application_classes( $this->model, $this->view, $this->controller );
		}
	}
	
	/**
	 * Autoload all scripts in a directory
	 * @param string
	 * @param string
	 * @param bool
	 **/
	private function _autoload_directory( $layer, $dir = '/', $load_class = true ) {

		$directory = get_template_directory() . '/wproto/' . $layer . $dir;
		$handle = opendir( $directory );

		while ( false !== ( $file = readdir( $handle))) {
			
			if ( is_file( $directory . $file)) {
				// Figure out class name from file name
				$class = str_replace('.php', '', $file);
				
				$class = 'wplab_unicum_' . str_replace('-', '_', $class ) . '';
				$shortClass = str_replace( 'wplab_unicum_', '', $class );
				$shortClass = str_replace( '_' . $layer, '', $shortClass);

				if( $load_class ) {
					// Avoid recursion
					if ( $class != get_class( $this) ) {
						// Include and instantiate class
						require_once $directory . $file;
						$this->$layer->$shortClass = new $class();
					}
				} else {
					require_once $directory . $file;
				}

			}
		}
		
	}
	
	/**
	 * Inject models, view and controllers
	 * into all other controllers to make
	 * them callable from there
	 * @param object
	 * @param object
	 * @param object
	 **/
	private function _inject_application_classes( $model, $view, $controller ) {
		$this->model = $model;
		$this->view = $view;
		$this->controller = $controller;
	}
	
	/**
	 * Parse custom request using our own routing,
	 * i.e. $_GET['wplab_unicum_action'] or $_POST['wplab_unicum_action'],
	 * and then delegate to appropriate controller
	 * action.
	 *
	 * Example 1: '/?wplab_unicum_action=front_controller-view'
	 * Example 2: '/wp-admin/index.php?wplab_unicum_action=admin_settings-save'
	 **/
	public function delegate_to_controller_action() {
		if ( isset( $_POST['wplab_unicum_action'] ) ) {
			$action = $_POST['wplab_unicum_action'];
		} elseif ( isset( $_GET['wplab_unicum_action'] ) ) {
			$action = $_GET['wplab_unicum_action'];
		}

		if ( isset( $action ) ) {
			$controller_and_action = explode( '-', $action );

			if ( count( $controller_and_action ) == 2 ) {
				//! TODO: Learn from popular frameworks how they secure this bit here!
				$controller = 'wplab_unicum_' . $controller_and_action[0] . '_controller';
				$short_controller = $controller_and_action[0];
				$action = $controller_and_action[1];

				if ( class_exists( $controller ) && method_exists( $controller , $action ) ) {
					call_user_func( array( $this->controller->$short_controller, $action ) );
				} 
			}
		}
	}
	
	/**
	 * Get a model
	 **/
	function model( $name ) {
		
		$class = 'wplab_unicum_' . $name;
		
		if( !isset( $this->_model->$class ) ) {
			$directory = get_template_directory() . '/wproto/model/';
			require_once $directory . $name . '.php';
			
			@$this->_model->$name = new $class();
			
			return $this->_model->$name;
		} else {
			return $this->_model->$name;
		}
		
	}
	
}