<?php
/**
 * Front menu custom walker
 **/
class wplab_unicum_front_nav_menu_walker extends Walker_Nav_Menu {

  function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		// check, whether there are children for the given ID and append it to the element with a (new) ID
		$element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
  
  function start_lvl(&$output, $depth = 0, $args = array()) {
  	global $_wplab_unicum_submenu_appear;
  	
    $indent = str_repeat("\t", $depth);
    
    $depth_str = '';
    
    $depth_str = 'sub-menu dl-submenu appear-on-' . $_wplab_unicum_submenu_appear;
    
    $output .= "\n$indent<ul class=\"$depth_str\">\n";
  }

	function start_el( &$output, $item, $depth = 0, $args = array(), $current_id = 0 ) {
		global $wp_query, $_wplab_unicum_submenu_appear;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'level-' . $depth;
		
		$_wplab_unicum_submenu_appear = 'right';
		
		if( $item->submenu_position ) {
			$_wplab_unicum_submenu_appear = $item->submenu_position;
		}
		
		if( $item->hasChildren ) {
			$classes[] = 'drop';
		}
		
		if( isset( $item->hide_desktop ) && $item->hide_desktop ) {
			$classes[] = 'hide-on-desktop';
		}
		
		if( isset( $item->hide_tablet ) && $item->hide_tablet ) {
			$classes[] = 'hide-on-tablet';
		}
		
		if( isset( $item->hide_phone ) && $item->hide_phone ) {
			$classes[] = 'hide-on-phone';
		}
		
		$posts_page_id = get_option('page_for_posts');
		
		if( $posts_page_id == $item->object_id ) {
			$classes[] = 'blog-menu-item';
			
			if( $wp_query->query_vars['post_type'] != '' || is_404() ) {
				$classes = array_diff( $classes, array( 'current_page_parent', 'current_page_item', 'current-menu-item' ));
			}
			
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$title_attr  	 = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes 	 = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes 	.= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
            
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
		$item_url = esc_attr( $item->url ); 
		
		$href_class = 'menu-item-href';
		
		if( isset( $item->one_page_link ) && $item->one_page_link ) {
			$href_class .= ' external';
		}
		
		$href_class = esc_attr( $href_class );
			
		if( isset( $item->dont_display_as_link ) && $item->dont_display_as_link ) {
			$item_output .= '<a class="' . $href_class . ' " ' . $title_attr . '>';
		} else {
			if ( $item_url != $current_url ) {
				$item_output .= '<a class="' . $href_class . '" '. $attributes .' ' . $title_attr . '>';
			} else {
				$item_output .= '<a class="' . $href_class . '" ' . $title_attr . '>';
			}			
		}
		
		if( $depth == 0 ) {
			$item_output .= '<span class="line_wrap"><span class="line"></span>';
		}

		$link_before = isset( $args->link_before ) ? $args->link_before : '';
		$link_after = isset( $args->link_after ) ? $args->link_after : '';

		$item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;
	
		if( $item->hasChildren ) {
			$item_output .= '<i class="submenu-icon"></i>';
		}

		if( $depth == 0 ) {
			$item_output .= '</span>';
		}
	
		$item_output .= '</a>';
		
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ); 
	}
}
