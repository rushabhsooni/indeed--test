<?php
	/**
   * Post model
   **/
	class wplab_unicum_post extends wplab_unicum_database {                     
		/**
		 * Get items
		 * @return object
		 **/
		function get( $args = array() ) {
			global $post;
			
			 $type = isset( $args['type'] ) ? $args['type'] : 'all';
			 $limit = isset( $args['limit'] ) ? $args['limit'] : 3;
			 $category = isset( $args['category'] ) ? $args['category'] : '';
			 $order = isset( $args['order'] ) ? $args['order'] : 'date';
			 $sort = isset( $args['sort'] ) ? $args['sort'] : 'DESC';
			 $post_type = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
			 $tax_name = isset( $args['tax_name'] ) ? $args['tax_name'] : 'category';
			 $featured_only = isset( $args['featured_only'] ) ? $args['featured_only'] : false;
			 $sticky_only = isset( $args['sticky_only'] ) ? $args['sticky_only'] : false;
			 $with_thumbnail_only = isset( $args['with_thumbnail_only'] ) ? $args['with_thumbnail_only'] : false;
			 $paged = isset( $args['paged'] ) ? $args['paged'] : 1;
			 $term_field = isset( $args['term_field'] ) ? $args['term_field'] : 'slug';
			 $exclude_current_post = isset( $args['exclude_current_post'] ) ? $args['exclude_current_post'] : false;
			
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $limit,
				'order' => $sort,
				'orderby' => $order,
				'paged' => $paged
			);
			
			if( isset( $args['post_count'] ) ) {
				$args['post_count'] = (int)$args['post_count'];
			}
			
			if( $exclude_current_post ) {
				$args['post__not_in'] = isset( $post->ID ) ? array( $post->ID ) : array();
			}
			
			if( ! $sticky_only ) {
				$args['ignore_sticky_posts'] = 1;
			}
			
			if( $type == 'category' || $type == 'only' ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $tax_name,
						'field' => $term_field,
						'terms' => $category
					)
				);
			}
			
			if( $type == 'category_except' || $type == 'all_except' || $type == 'except' ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $tax_name,
						'field' => $term_field,
						'terms' => $category,
						'operator' => 'NOT IN'
					)
				);
			}
			
			if( $featured_only ) {
				$args['meta_query'][] = array(
					'key' => 'featured',
					'value' => true
				);
			}
			
			if( $with_thumbnail_only ) {
				$args['meta_query'][] = array(
					'key' => '_thumbnail_id'
				);
			}
			
			if( $sticky_only ) {
				$args['post__in'] = get_option( 'sticky_posts' );
			}
			
			return new WP_Query( $args );
			
		}
		
		/**
		 * Get all posts
		 **/
		function get_all_posts( $post_type ) {
			global $post;
			
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'nopaging' => true
			);
			
			return new WP_Query( $args );
		}
		
		/**
		 * Get popular posts
		 **/
 		function get_popular_posts( $post_type, $limit ) {
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $limit,
				'order' => 'DESC',
				'ignore_sticky_posts' => true,
				'orderby' => 'comment_count'
			);
			
			return new WP_Query( $args );
 		}
 		
 		/**
 		 * Get recent posts
 		 **/
		function get_recent_posts( $post_type, $limit ) {
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $limit,
				'order' => 'DESC',
				'ignore_sticky_posts' => true
			);
			
			return new WP_Query( $args );
		}
		
		/**
		 * Get related posts
		 **/
 		function get_related_posts( $primary_post_id, $limit, $taxonomy = 'category', $with_thumbnail_only = false ) {
 			
 			$terms = wp_get_post_terms( $primary_post_id, $taxonomy );
 			
 			$response = false;
 			
			if( count( $terms ) > 0 ) {
				
				$post_type = get_post_type( $primary_post_id );
				$post_terms_ids = array();
				
				foreach( $terms as $term ) {
					$post_terms_ids[] = $term->term_id;
				}
				
				$args = array(
					'post_type' => $post_type,
					'post_status' => 'publish',
					'posts_per_page' => $limit,
					'order' => 'DESC',
					'orderby' => 'rand',
					'ignore_sticky_posts' => true,
					'post__not_in' => array( $primary_post_id ),
					'tax_query' => array(
						'relation' => 'OR',
						array(
							'taxonomy' => $taxonomy,
							'field' => 'id',
							'terms' => $post_terms_ids
						)
					)
				);
				
				if( $with_thumbnail_only ) {
					$args['meta_query'][] = array(
						'key' => '_thumbnail_id'
					);
				}
				
				$response = new WP_Query( $args );
				
			}
 			
 			return $response;
 		}
		
		/**
		 * Get random posts
		 **/
		function get_random_posts( $post_type, $limit, $with_thumbnail_only = false ) {
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $limit,
				'ignore_sticky_posts' => true,
				'orderby' => 'rand'
			);
			
			if( $with_thumbnail_only ) {
				$args['meta_query'][] = array(
					'key' => '_thumbnail_id'
				);
			}
			
			return new WP_Query( $args );
		}
		
		/**
		 * Return custom fields in a nice way
		 **/
		function get_post_custom( $post_id ) {
			$custom_fields = get_post_custom( $post_id );
			$return = array();
			if( is_array( $custom_fields ) && count( $custom_fields ) > 0 ) {
				foreach( $custom_fields as $k=>$v ) {
					if( $k[0] != '_' )
						$return[$k] = $v[0];
				}
			}
			return (object)$return;
		}
                
	}