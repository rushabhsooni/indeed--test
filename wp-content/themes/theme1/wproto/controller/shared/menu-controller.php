<?php
/**
 *	Theme menus controller
 **/
class wplab_unicum_menu_controller extends wplab_unicum_core_controller {
	
	function __construct() {
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_menu_custom_fields' ) );
		add_filter( 'nav_menu_css_class', array( $this, 'fix_front_menu_class' ), 10, 2);
		
		if( is_admin() ) {
			// save menu custom fields
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_menu_custom_fields'), 10, 3 );
			// edit menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_menu_walker'), 10, 2 );
		}
		
	}
	
	/**
	 * Add custom fields values
	 **/
	function add_menu_custom_fields( $menu_item ) {
		$menu_item->submenu_position = get_post_meta( $menu_item->ID, '_menu_item_submenu_position', true );
		$menu_item->dont_display_as_link = get_post_meta( $menu_item->ID, '_menu_item_dont_display_as_link', true );
		$menu_item->one_page_link = get_post_meta( $menu_item->ID, '_menu_item_one_page_link', true );
		$menu_item->hide_desktop = get_post_meta( $menu_item->ID, '_menu_item_hide_desktop', true );
		$menu_item->hide_tablet = get_post_meta( $menu_item->ID, '_menu_item_hide_tablet', true );
		$menu_item->hide_phone = get_post_meta( $menu_item->ID, '_menu_item_hide_phone', true );
		return $menu_item;
	}
	
	
	/**
	 * Fix taxonomy highlight at front
	 **/
	function fix_front_menu_class( $classes, $item ) {
		global $wp_query;
		
		$tax = isset( $wp_query->query_vars['taxonomy'] ) ? $wp_query->query_vars['taxonomy'] : NULL;
		
		if( $tax != NULL ) {

  		if ( $item->object_id == get_option('page_for_posts') ) {
    		$key = array_search( 'current_page_parent', $classes );
      		if ( false !== $key )
        		unset( $classes[ $key ] );
     	}
		}
		
		return $classes;
		
	}
	
	/**
	 * Update menu custom fields
	 **/
	function update_menu_custom_fields( $menu_id, $menu_item_db_id, $args ) {
		
		$allowed_tags = wp_kses_allowed_html( 'post' );
		
		$item_value = isset( $_REQUEST['menu_item_submenu_position'][$menu_item_db_id] ) ? $_REQUEST['menu_item_submenu_position'][$menu_item_db_id] : 'left';	
		update_post_meta( $menu_item_db_id, '_menu_item_submenu_position', wp_kses( $item_value, $allowed_tags ) );
		
		$item_value = isset( $_REQUEST['menu_item_dont_display_as_link'][$menu_item_db_id] ) ? (bool)$_REQUEST['menu_item_dont_display_as_link'][$menu_item_db_id] : false;	
		update_post_meta( $menu_item_db_id, '_menu_item_dont_display_as_link', wp_kses( $item_value, $allowed_tags ) );
		
		$item_value = isset( $_REQUEST['menu_item_one_page_link'][$menu_item_db_id] ) ? (bool)$_REQUEST['menu_item_one_page_link'][$menu_item_db_id] : false;	
		update_post_meta( $menu_item_db_id, '_menu_item_one_page_link', wp_kses( $item_value, $allowed_tags ) );
		
		$item_value = isset( $_REQUEST['menu_item_large_desktop'][$menu_item_db_id] ) ? (bool)$_REQUEST['menu_item_hide_desktop'][$menu_item_db_id] : false;
		update_post_meta( $menu_item_db_id, '_menu_item_large_desktop', wp_kses( $item_value, $allowed_tags ) );

		$item_value = isset( $_REQUEST['menu_item_hide_tablet'][$menu_item_db_id] ) ? (bool)$_REQUEST['menu_item_hide_tablet'][$menu_item_db_id] : false;
		update_post_meta( $menu_item_db_id, '_menu_item_hide_tablet', wp_kses( $item_value, $allowed_tags ) );

		$item_value = isset( $_REQUEST['menu_item_hide_phone'][$menu_item_db_id] ) ? (bool)$_REQUEST['menu_item_hide_phone'][$menu_item_db_id] : false;
		update_post_meta( $menu_item_db_id, '_menu_item_hide_phone', wp_kses( $item_value, $allowed_tags ) );

	}
	
	/**
	 * Edit menu
	 **/
	function edit_menu_walker( $walker, $menu_id ) {
		return 'wplab_unicum_admin_nav_menu_walker';
	}
	
}