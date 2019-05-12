<?php

	add_action( 'widgets_init', 'register_wplab_unicum_social_icons_widget' );
	
	function register_wplab_unicum_social_icons_widget() {
		register_widget( 'wplab_unicum_social_icons_widget' );
	}
	
	class wplab_unicum_social_icons_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_social_icons_widget', 'description' => esc_html__('A widget that displays social icons.', 'wplab-unicum') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_social_icons_widget' );
		
			parent::__construct( 'wproto_social_icons_widget', esc_html__( '[UNICUM] Social Icons', 'wplab-unicum' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_unicum_core;
			
			$data = array();
			$data['title'] = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_unicum_core->view->load_partial( 'widgets/social_icons', $data );

		}
		
	}