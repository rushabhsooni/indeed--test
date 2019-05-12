<?php

	add_action( 'widgets_init', 'register_wplab_unicum_posts_widget' );
	
	function register_wplab_unicum_posts_widget() {
		register_widget( 'wplab_unicum_posts_widget' );
	}
	
	class wplab_unicum_posts_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_posts_widget', 'description' => esc_html__('A widget that displays blog posts. ', 'wplab-unicum') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_posts_widget' );
		
			parent::__construct( 'wproto_posts_widget', esc_html__( '[UNICUM] Posts', 'wplab-unicum' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_unicum_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_unicum_core->view->load_partial( 'widgets/posts', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['query_type'] = isset( $new_instance['query_type'] ) ? strip_tags( $new_instance['query_type'] ) : 'recent';
			$instance['count'] = isset( $new_instance['count'] ) ? absint( $new_instance['count'] ) : 1;

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Recent Posts', 'wplab-unicum' ),
				'query_type' => 'recent',
				'count' => 4,
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-unicum'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'query_type' ) ); ?>"><?php esc_html_e('Display type:', 'wplab-unicum'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'query_type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'query_type' ) ); ?>" class="widefat">
					<option <?php echo $instance['query_type'] == 'recent' ? 'selected="selected"' : ''; ?> value="recent"><?php esc_html_e('Recent posts', 'wplab-unicum'); ?></option>
					<option <?php echo $instance['query_type'] == 'most_commented' ? 'selected="selected"' : ''; ?> value="most_commented"><?php esc_html_e('Most commented posts', 'wplab-unicum'); ?></option>
					<option <?php echo $instance['query_type'] == 'random' ? 'selected="selected"' : ''; ?> value="random"><?php esc_html_e('Random posts', 'wplab-unicum'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e('Posts count:', 'wplab-unicum'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" class="widefat">
					<?php for( $i=1; $i<11; $i++ ): ?>
					<option <?php echo $instance['count'] == $i ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</p>

			<?php
		}
		
	}