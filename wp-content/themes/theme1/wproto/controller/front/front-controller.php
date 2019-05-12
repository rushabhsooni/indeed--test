<?php
/**
 * Front side controller
 **/
class wplab_unicum_front_controller extends wplab_unicum_core_controller {
	
	function __construct() {

		// Add admin scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_styles' ) );
		
		// Modify a webste titl
		add_filter( 'wp_title',  array( $this, 'wp_title' ), 10, 2 );	
		
		// Add BODY classes
		add_filter( 'body_class', array( $this, 'body_classes' ));
		
		// Control RSS feed
		add_action( 'init', array( $this, 'setup_rss' ) );
		
		// add images to RSS feed
		add_filter( 'the_excerpt_rss', array( $this, 'add_featured_image_to_feed' ), 1000, 1);
		add_filter( 'the_content_feed', array( $this, 'add_featured_image_to_feed' ), 1000, 1);
		
		// Hide admin bar from non-admins if this required by theme settings
		add_action( 'after_setup_theme',  array( $this, 'remove_admin_bar' ) );

		// Custom search form
		add_filter( 'get_search_form', array( $this, 'custom_search_template' ) );
		
		// customize password protected post form
		add_filter( 'the_password_form', array( $this, 'customize_password_protect' ));

	}
	
	/**
	 * Add admin scripts
	 **/
	function add_scripts() {
		
		wp_enqueue_script( 'jquery' );
		
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
			
		// include all libs together
		wp_register_script( 'wproto-all-libs', get_template_directory_uri() . '/js/all_in_one_libs.min.js', array( 'jquery' ), _WPLAB_UNICUM_CACHE_TIME_, true );
		wp_enqueue_script( 'wproto-all-libs' );
		
		wp_register_script( 'youtube-background', get_template_directory_uri() . '/js/libs/jquery.youtubebackground.js', array( 'jquery' ), _WPLAB_UNICUM_CACHE_TIME_, true );
		wp_enqueue_script( 'youtube-background' );
		
		wp_register_script( 'dlmenu', get_template_directory_uri() . '/js/libs/jquery.dlmenu.js', array( 'jquery' ), _WPLAB_UNICUM_CACHE_TIME_, true );
		wp_enqueue_script( 'dlmenu' );
		
		wp_register_script( 'wproto-front', get_template_directory_uri() . '/js/front.min.js', array( 'jquery' ), _WPLAB_UNICUM_CACHE_TIME_, true );
		wp_enqueue_script( 'wproto-front' );
		
		$js_vars = array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'strSuccess' 		=> esc_html__('Success', 'wplab-unicum'),
			'strError' 			=> esc_html__('Error', 'wplab-unicum'),
		);
		
		wp_localize_script( 'wproto-front', 'wprotoEngineVars', $js_vars );
		
		if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'smooth_scrolling' ), FILTER_VALIDATE_BOOLEAN ) ) {
			wp_enqueue_script( 'wproto-smoothscroll', get_template_directory_uri() . '/js/libs/SmoothScroll.min.js', array( 'jquery' ), _WPLAB_UNICUM_CACHE_TIME_, true );
		}
		
	}
	
	/**
	 * Add admin styles
	 **/
	function add_styles() {
		global $wp_styles;
	
		if( wplab_unicum_utils::is_unyson() && fw_get_db_settings_option( 'page_preloader/style' ) == 'css' ) {
			wp_enqueue_style( 'theme-loaders', get_template_directory_uri() . '/css/libs/loaders.min.css', false, _WPLAB_UNICUM_CACHE_TIME_ );	
		}
	
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/libs/animate.min.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/libs/font-awesome.min.css', false, _WPLAB_UNICUM_CACHE_TIME_ );	
	
		// Custom fonts
		$custom_google_fonts = wplab_unicum_utils::get_all_custom_theme_fonts();
		$custom_google_fonts_string = '';
		
		$font_subsets = array();
		$font_styles = array();
		
		if( wplab_unicum_utils::is_unyson() ) {
			
			// Additional font subsets
			$font_subsets_settings = fw_get_db_settings_option( 'font_subsets' );
			
			if( is_array( $font_subsets_settings ) && !empty( $font_subsets_settings ) ) {
				foreach( $font_subsets_settings as $k=>$v ) {
					if( $v === true ) {
						$font_subsets[] = $k;
					}
				}
			}
			
			// Additional font styles
			$font_styles_settings = fw_get_db_settings_option( 'font_styles' );
			
			if( is_array( $font_styles_settings ) && !empty( $font_styles_settings ) ) {
				foreach( $font_styles_settings as $k=>$v ) {
					if( $v === true ) {
						$font_styles[] = $k;
					}
				}
			}
			
		} else {
			$font_subsets = array('latin');
			$font_styles = array('300', '400', '600', '700', '800', '300italic', '400italic');
		}

		if( is_array( $custom_google_fonts ) && ! empty( $custom_google_fonts ) > 0 ) {
			
			foreach( $custom_google_fonts as $k=>$font ) {
				$custom_google_fonts_string .= $font . ':' . implode( ',', $font_styles ) . '|';
			}
			
			$custom_google_fonts_string .= '&subset=' . implode( ',', $font_subsets );
			
			wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=' . $custom_google_fonts_string );
			
		}
	
		wp_enqueue_style( 'theme-fonts', get_template_directory_uri() . '/css/front/fonts.css', false, _WPLAB_UNICUM_CACHE_TIME_ );	
		
		if( get_option('wplab_unicum_custom_styles') === 'yes' ) {
			$upload_dir = wp_upload_dir();
			wp_enqueue_style( 'theme-front', $upload_dir['baseurl'] . '/wplab_unicum_custom_css.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
		} else {
			wp_enqueue_style( 'theme-front', get_template_directory_uri() . '/css/front/skin.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
		}		
		
		wp_enqueue_style( 'theme-images', get_template_directory_uri() . '/css/front/images.css', false, _WPLAB_UNICUM_CACHE_TIME_ );
		
		if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'menu_linethrough_effect' ), FILTER_VALIDATE_BOOLEAN ) === false ) {
			wp_add_inline_style( 'theme-front', '#header-nav span.line { display: none !important; }' );
		}
		
	}
	
	/**
	 * Title filter
	 **/
	function wp_title( $title, $sep ) {
		global $paged, $page;
	
		if ( is_feed() )
			return $title;

		if( is_home() || is_front_page() )
			return $title;

		return $title . ' ' . $sep . ' ' . get_bloginfo( 'description' );
			
	}	 
	
	/**
	 * Add custom body classes
	 **/
	function body_classes( $classes ) {
		
		// If Unyson Framework is enabled
		if( wplab_unicum_utils::is_unyson() ) {
			
			/**
			 * Preloader
			 **/
			if( fw_get_db_settings_option( 'page_preloader/style' ) != 'hidden' ) {
				$classes[] = 'preloader';
			}
			
			/**
			 * GoTop link
			 **/
			if( filter_var( fw_get_db_settings_option( 'go_top_link' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'go-top';
			}
			
			/**
			 * Header scrolling
			 **/
			if( filter_var( fw_get_db_settings_option( 'header_scrolling/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'fixed-header';
			}
			
			if( filter_var( fw_get_db_settings_option( 'header_scrolling/true/header_scrolling_alt' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'fixed-header-alt-style';
			}
			
			/**
			 * Sidebar position
			 **/
		 	if( function_exists('fw_ext_sidebars_get_current_position') ) {
			 	$current_sidebar_position = fw_ext_sidebars_get_current_position();
				$classes[] = 'sidebar-' . $current_sidebar_position;	
		 	} else {
		 		$classes[] = 'sidebar-right';	
		 	}
			
			/**
			 * Parallax footer
			 **/
			if( filter_var( fw_get_db_settings_option( 'footer_parallax' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'parallax-footer';
			}

			/**
			 * Additional settings for a single posts
			 **/
			if( is_single() || is_home() || is_page() ) {
				
				$post_id = is_home() ? get_option( 'page_for_posts' ) : get_the_ID();
				
				/**
				 * Intro header
				 **/
				if( filter_var( fw_get_db_post_option( $post_id, 'intro_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$classes[] = 'transparent-header';
					$classes[] = 'intro-header';
				}
				
			}
			
			/**
			 * Additional settings for pages
			 **/
			if( is_page() ) {
				
				/**
				 * One-page menu
				 **/
				if( filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$classes[] = 'one-page';
				}
				
			}
			
		}
		
		return $classes;
	}
	
	/**
	 * Enable or disable RSS feed
	 **/
	function setup_rss() {
		
		if( wplab_unicum_utils::is_unyson() && ! filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
			remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
			remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
			remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
			
			add_action( 'do_feed', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rdf', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss2', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_atom', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss2_comments', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_atom_comments', array( $this, 'disable_rss_feed' ), 1);
		}
		
	}
	
	/**
	 * Disable RSS feed
	 **/
	function disable_rss_feed() {
		wp_die( esc_html__( 'RSS Feed was disabled by administrator', 'wplab-unicum' ) );
	}
	
	/**
	 * Add thumbnails to RSS feed
	 **/
	function add_featured_image_to_feed( $content ) {
		global $post;
		
		if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_settings_option( 'rss_feed/display_thumbnails_in_rss' ), FILTER_VALIDATE_BOOLEAN ) ) {
			
			if ( has_post_thumbnail( $post->ID ) ){
				$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 800, 600 ) );
				$content = '<!-- POST THUMBNAIL --><img src="' . $img_src[0] . '" width="400" alt="" />' . $content;
			}
			
		}
		
		return $content;
	}
	
	/**
	 * Hide admin bar if it disabled in settings
	 **/
	function remove_admin_bar() {
		
		if ( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'hide_admin_bar' ), FILTER_VALIDATE_BOOLEAN ) && !current_user_can('delete_pages') && !is_admin()) {
			show_admin_bar( false );
		}
		
	}
	
	/**
	 * Custom search template
	 **/
	function custom_search_template() {
		ob_start();
		include get_stylesheet_directory() . '/search-form.php';
		return ob_get_clean();
	}
	
	/**
	 * Customize password form
	 **/
	function customize_password_protect() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . esc_html__( "To view this protected post, enter the password below:", "wplab-unicum" ) . '</p>
    <p><input class="pass" placeholder="' . esc_html__( "Type here post password", "wplab-unicum" ) . '" name="post_password" id="' . $label . '" type="password" maxlength="20" /></p><p><input type="submit" name="Submit" value="' . esc_html__( "Submit", "wplab-unicum" ) . '" /></p>
    </form>
    ';
    return $o;
	}
	
}