<?php

	add_action( 'widgets_init', 'register_wplab_unicum_logo_widget' );
	
	function register_wplab_unicum_logo_widget() {
		register_widget( 'wplab_unicum_logo_widget' );
	}
	
	class wplab_unicum_logo_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_logo_widget', 'description' => esc_html__('A widget that displays website logo and description.', 'wplab-unicum') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_logo_widget' );
		
			parent::__construct( 'wproto_logo_widget', esc_html__( '[UNICUM] Logo', 'wplab-unicum' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_unicum_core;
			
			$data = array();
			$data['title'] = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_unicum_core->view->load_partial( 'widgets/logo', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$allowed_tags = wp_kses_allowed_html( 'post' );
			$instance['logo_url'] = wp_kses( $new_instance['logo_url'], $allowed_tags );
			$instance['logo_2x_url'] = isset( $new_instance['logo_2x_url'] ) ? wp_kses( $new_instance['logo_2x_url'], $allowed_tags ) : '';
			$instance['logo_width'] = absint( $new_instance['logo_width'] );
			$instance['description'] = wp_kses( $new_instance['description'], wp_kses_allowed_html( 'post' ) );
		
			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'logo_url' => '',
				'logo_2x_url' => '',
				'logo_width' => '',
				'description' => '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label><?php esc_html_e('Logo URL', 'wplab-unicum'); ?></label>:<br/>
				<input type="text" style="width: 50%" id="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_url' ) ); ?>" value="<?php echo esc_attr( $instance['logo_url'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" class="button wproto-image-selector"><?php esc_html_e( 'Upload', 'wplab-unicum' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" class="button wproto-image-remover"><?php esc_html_e( 'Remove', 'wplab-unicum' ); ?></a>
			</p>
			<p>
				<label><?php esc_html_e('Logo URL for Retina Displays', 'wplab-unicum'); ?></label>:<br/>
				<input type="text" style="width: 50%" id="<?php echo esc_attr( $this->get_field_id( 'logo_2x_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_2x_url' ) ); ?>" value="<?php echo esc_attr( $instance['logo_2x_url'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo esc_attr( $this->get_field_id( 'logo_2x_url' ) ); ?>" class="button wproto-image-selector"><?php esc_html_e( 'Upload', 'wplab-unicum' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo esc_attr( $this->get_field_id( 'logo_2x_url' ) ); ?>" class="button wproto-image-remover"><?php esc_html_e( 'Remove', 'wplab-unicum' ); ?></a>
			</p>
			<p>
				<label><?php esc_html_e('Logo width', 'wplab-unicum'); ?></label>:<br/>
				<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'logo_width' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'logo_width' ) ); ?>" value="<?php echo esc_attr( $instance['logo_width'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e('Description text', 'wplab-unicum'); ?></label>:<br/>
				<textarea style="width: 100%; height: 140px;" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
			</p>
			<?php
		}
		
	}