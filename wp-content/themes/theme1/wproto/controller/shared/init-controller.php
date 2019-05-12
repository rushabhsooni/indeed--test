<?php
/**
 * Theme init
 **/
class wplab_unicum_init_controller extends wplab_unicum_core_controller {
	
	function __construct() {
		
		// add theme support
		add_action( 'init', array( $this, 'add_theme_support'));
		
		// register menus
		add_action( 'init', array( $this, 'register_menus'));
		
		// register sidebars
		add_action( 'widgets_init', array( $this, 'register_sidebars'));
		
	}
	
	/**
	 * Add theme support
	 **/
	function add_theme_support() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );		
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'audio', 'link', 'image', 'chat' ) );
		add_theme_support( 'post-thumbnails' );
		
		remove_post_type_support( 'page', 'comments' );
		remove_post_type_support( 'page', 'thumbnail' );
	}
	
	/**
	 * Register theme menus
	 **/
	function register_menus() {
		register_nav_menus( array(
			'header_menu' => esc_html__('Header Menu', 'wplab-unicum'),
			'one_page_home_menu' => esc_html__('One-page Home Menu', 'wplab-unicum'),
		));
	}
	
	/**
	 * Register theme sidebars
	 **/
	function register_sidebars() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'wplab-unicum' ),
			'id'            => 'sidebar-right',
			'description'   => esc_html__( 'Appears in the right side of the site.', 'wplab-unicum' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'wplab-unicum' ),
			'id'            => 'sidebar-left',
			'description'   => esc_html__( 'Appears in the left side of the site.', 'wplab-unicum' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area', 'wplab-unicum' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'wplab-unicum' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
	}
	
}