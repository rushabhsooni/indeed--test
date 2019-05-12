<?php

require_once get_template_directory() . '/library/tgm-plugin-activation/class-tgm-plugin-activation.php';	

/**
 * Backend controller
 **/
class wplab_unicum_backend_controller extends wplab_unicum_core_controller {
	
	function __construct() {
		
		// Install required plugins
		add_action( 'tgmpa_register', array( $this, 'register_plugins' ) );
		
		// Add admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_styles' ) );
		
		// Footer notice
		add_filter( 'admin_footer_text', array( $this, 'add_footer_info' ) );
		
		// Allow additional mime types
		add_filter( 'upload_mimes', array( $this, 'add_upload_types' ) );
		
		// disable wp admin for non-admins optionally
		add_action( 'admin_init', array( $this, 'disable_wp_admin_access' ) );
		
		// Demo notice
		add_action( 'admin_notices', array( $this, 'add_notices'));
		
		// Demo data
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'register_demo_data' ) );
		
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'ignore_upload_ext' ), 10, 4);
		
	}
	
	/**
	 * Install required plugins
	 **/
	function register_plugins() {
		
		$plugins = array(
			array(
				'name' 								=> 'Unyson',
				'slug' 								=> 'unyson',
				'version' 						=> '2.3.3',
				'required' 						=> true,
				'force_activation' 		=> false
			),
			array(
				'name' 								=> 'Mail Chimp',
				'slug' 								=> 'mailchimp-for-wp',
				'version' 						=> '2.3.10',
				'required' 						=> true,
				'force_activation' 		=> false
			),
			array(
				'name'     						=> 'Slider Revolution',
				'slug'     						=> 'revslider',
				'required' 						=> false,
				'version' 						=> '5.0.5',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'source' 							=> 'http://update.wplab.pro/third_party_plugins/revslider.zip'
			),
			array(
				'name'     						=> 'Envato Market',
				'slug'     						=> 'envato-market',
				'source'   						=> 'http://update.wplab.pro/third_party_plugins/envato-market.zip',
				'required' 						=> false,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false
			),
		);

		tgmpa( $plugins, array(
      'default_path' => '',                      // Default absolute path to pre-packaged plugins.
      'menu'         => 'tgmpa-install-plugins', // Menu slug.
      'has_notices'  => true,                    // Show admin notices or not.
      'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
      'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
      'is_automatic' => false,                   // Automatically activate plugins after installation or not.
      'message'      => '',                      // Message to output right before the plugins table.
      'strings'      => array(
        'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
        'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
        'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
        'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
        'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
        'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
        'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
        'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
        'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
        'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
        'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
        'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
        'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
      )
    ) );
		
	}
	
	/**
	 * Add admin scripts
	 **/
	function add_scripts() {
		
		$screen = get_current_screen();
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'wp-color-picker' );
		
		wp_enqueue_media();

		$allowed_tags = wp_kses_allowed_html( 'post' );

		$js_vars = array(
			'adminURL' => admin_url(),
			'strSelectImage' => esc_html__( 'Select an image', 'wplab-unicum' ),
			'strSelect' => esc_html__( 'Select', 'wplab-unicum' ),
			'siteDomain' => $_SERVER['SERVER_NAME'],
			'strPleaseWait' => esc_html__( 'Please, wait...', 'wplab-unicum' ),
			'strCompilingLess' => sprintf( wp_kses( __('Please wait until we\'re applying your custom styles into theme.<br/><br/>%s' ,'wplab-unicum'), $allowed_tags ), '<img id="wproto-big-loader-transp" width="24" height="24" src="' . get_template_directory_uri() . '/images/admin/ajax-loader.gif" alt="" /><br/><br/>'),
			'strCheckingReadability' => wp_kses( __('Checking correct work of <code>file_get_content()</code> function...', 'wplab-unicum'), $allowed_tags ),
			'strReadError' => __('Theme can not read stylesheet file. For first, check that <code>customizer.less</code> file exists on your server in <code>/css/</code> directory and it readable. If this does not help, <code>file_get_content()</code> function does not work properly on your hosting. This is not a theme bug, and You should contact your hosting provider to resolve that error.', 'wplab-unicum'),
			'strError' => esc_html__( 'Error', 'wplab-unicum' ),
			'strLoadingLessFile' => esc_html__('Loading LESS files...', 'wplab-unicum'),
			'strLoadingLessFileSuccess' => esc_html__('File loaded successfully.', 'wplab-unicum'),
			'strCompilationLess' => esc_html__('Compilation LESS variables into CSS...', 'wplab-unicum'),
			'strLessParseError' => esc_html__('Cannot parse LESS. That\'s why: ', 'wplab-unicum'),
			'strCompilationLessSuccess' => esc_html__('LESS code was successfully compiled.', 'wplab-unicum'),
			'strSavingLessIntoFile' => esc_html__('Saving stylesheet...', 'wplab-unicum'),
			'strRefreshing' => esc_html__('Submitting the form...', 'wplab-unicum'),
			'themeLessPath' => get_template_directory_uri() . '/css/front/less/',
			'strAllDone' => esc_html__( 'All done', 'wplab-unicum' ),
			'strErrorCustomCSSFile' => esc_html__('ERROR! Can not write custom CSS into file', 'wplab-unicum'),
		);

		if( isset( $_GET['page'] ) && $_GET['page'] == 'theme_customizer' ) {
			wp_register_script( 'less', get_template_directory_uri() . '/js/libs/less.min.js', false, _WPLAB_UNICUM_CACHE_TIME_, true );
			wp_enqueue_script( 'less', array( 'jquery' ) );
			wp_register_script( 'serialize-object', get_template_directory_uri() . '/js/libs/jquery.serialize-object.min.js', false, _WPLAB_UNICUM_CACHE_TIME_, true );
			wp_enqueue_script( 'serialize-object', array( 'jquery' ) );
		}	
		
		wp_register_script( 'theme-core-admin', get_template_directory_uri() . '/js/admin.js', false, _WPLAB_UNICUM_CACHE_TIME_, true );
		wp_localize_script( 'theme-core-admin', 'wprotoVars', $js_vars );
		
		wp_enqueue_script( 'theme-core-admin', array( 'jquery' ) );
		wp_localize_script( 'theme-core-admin', 'wprotoVars', $js_vars );
		
	}
	
	/**
	 * Add admin styles
	 **/
	function add_styles() {
		global $wp_styles;
		
		$screen = get_current_screen();
	
		wp_enqueue_style( 'theme-fonts', get_template_directory_uri() . '/css/front/fonts.css', false, _WPLAB_UNICUM_CACHE_TIME_ );	
		wp_enqueue_style( 'theme-core-admin', get_template_directory_uri() . '/css/admin/admin.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
				
		if( isset( $_GET['page'] ) && $_GET['page'] == 'theme_customizer' ) {
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/css/admin/ui/jquery-ui.min.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
		}	
		
	}
	
	/**
	 * Add footer info
	 **/
	function add_footer_info( $text ) {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		return $text . ' ' . sprintf( wp_kses( __('<i>Theme created by <a href="%s" target="_blank">WPlab.Pro</a></i>. If you love this theme, please support us and <a href="%s" target="_blank">rate it with &#9733;&#9733;&#9733;&#9733;&#9733;</a> on ThemeForest, it is so important for us!', 'wplab-unicum' ), $allowed_tags ), 'http://themeforest.net/user/wplab/?ref=wplab', 'http://themeforest.net/downloads' );
	}
	
	/**
	 * Allow additional mime types to upload
	 **/
	function add_upload_types( $existing_mimes ) {
		$existing_mimes['ico'] = 'image/vnd.microsoft.icon';
		$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
		$existing_mimes['woff2'] = 'application/x-woff';
		$existing_mimes['woff'] = 'application/x-woff';
		$existing_mimes['ttf'] = 'application/octet-stream';
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['mp4'] = 'video/mp4';
		$existing_mimes['ogv'] = 'video/ogg';
		$existing_mimes['webm'] = 'video/webm';
		$existing_mimes['svg'] = 'image/svg+xml';
		return $existing_mimes;
	}
	
	/**
	 * Disable access to WP admin for non-admins optionally
	 **/
	function disable_wp_admin_access() {
		if ( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'logout_non_admins' ), FILTER_VALIDATE_BOOLEAN ) && ! current_user_can( 'manage_options' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
  		wp_redirect( home_url() );
			exit;
		}
	}
	
	/**
	 * Add admin notices
	 **/
	function add_notices() {
		
		// demo data notice
		if( ! get_option('wplab_unicum_hide_activation_message') ):
			$this->view->load_partial( 'notice/activation' );
		endif;
		
	}
	
	/**
	 * Register demo data
	 **/
	function register_demo_data() {
		
		$curr_url = get_template_directory_uri();
		
    $demos_array = array(
      'unicum' => array(
        'title' => esc_html__('Unicum', 'wplab-unicum'),
        'screenshot' => $curr_url . '/images/demo.png',
        'preview_link' => 'http://themes.wplab.pro/unicum/',
      ),
    );

    $download_url = 'http://demo-data.wplab.pro/unicum/';

    foreach ($demos_array as $id => $data) {
        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
          'url' => $download_url,
          'file_id' => $id,
        ));
        $demo->set_title( $data['title']);
        $demo->set_screenshot( $data['screenshot']);
        $demo->set_preview_link( $data['preview_link']);

        $demos[ $demo->get_id() ] = $demo;

        unset( $demo );
    }

    return $demos;
	}
	
	function ignore_upload_ext( $checked, $file, $filename, $mimes ) {
		
		//we only need to worry if WP failed the first pass
		if(!$checked['type']){
			//rebuild the type info
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			$ext = $wp_filetype['ext'];
			$type = $wp_filetype['type'];
			$proper_filename = $filename;
	
			//preserve failure for non-svg images
			if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
				$ext = $type = false;
			}
	
			//everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.
	
			$checked = compact('ext','type','proper_filename');
		}
	
		return $checked;
		
	}
	
}