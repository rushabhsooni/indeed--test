<?php
	/**
	 * Utils helper
	 **/
	class wplab_unicum_utils {
		
		/**
		 * Make sure that Unyson is active
		 **/
		public static function is_unyson() {
			return defined('FW') && function_exists('fw_get_db_settings_option');
		}
		
		/**
		 * Make a CSS style string from params
		 * @param array
		 **/
		public static function get_styles( $styles, $unit = 'px' ) {
			
			$css_string = '';
			
			if( isset( $styles['width'] ) && $styles['width'] <> '' ) {
				$css_string .= 'width: ' . $styles['width'] . $unit . '; ';
			}
			
			if( isset( $styles['height'] ) && $styles['height'] <> '' ) {
				$css_string .= 'height: ' . $styles['height'] . $unit . '; ';
			}
			
			if( isset( $styles['top_margin'] ) && $styles['top_margin'] <> '' ) {
				$css_string .= 'margin-top: ' . $styles['top_margin'] . $unit . '; ';
			}
			
			if( isset( $styles['right_margin'] ) && $styles['right_margin'] <> '' ) {
				$css_string .= 'margin-right: ' . $styles['right_margin'] . $unit . '; ';
			}
			
			if( isset( $styles['bottom_margin'] ) && $styles['bottom_margin'] <> '' ) {
				$css_string .= 'margin-bottom: ' . $styles['bottom_margin'] . $unit . '; ';
			}
			
			if( isset( $styles['left_margin'] ) && $styles['left_margin'] <> '' ) {
				$css_string .= 'margin-left: ' . $styles['left_margin'] . $unit . '; ';
			}
			
			if( isset( $styles['top_padding'] ) && $styles['top_padding'] <> '' ) {
				$css_string .= 'padding-top: ' . $styles['top_padding'] . $unit . '; ';
			}
			
			if( isset( $styles['right_padding'] ) && $styles['right_padding'] <> '' ) {
				$css_string .= 'padding-right: ' . $styles['right_padding'] . $unit . '; ';
			}
			
			if( isset( $styles['bottom_padding'] ) && $styles['bottom_padding'] <> '' ) {
				$css_string .= 'padding-bottom: ' . $styles['bottom_padding'] . $unit . '; ';
			}
			
			if( isset( $styles['left_padding'] ) && $styles['left_padding'] <> '' ) {
				$css_string .= 'padding-left: ' . $styles['left_padding'] . $unit . ';';
			}
			
			return $css_string;
			
		}
		
		/**
		 * Get post categories list
		 **/
		public static function get_categories( $separator = ', ' ) {
			
			$post_type = get_post_type();
			
			switch( $post_type ) {
				default:
				case 'post':
					return wplab_unicum_utils::get_valid_category_list( $separator );
				break;
				case 'fw-portfolio':
					return get_the_term_list( get_the_ID(), 'fw-portfolio-category', '', $separator, '' );
				break;
			}
			
		}
		
		public static function get_valid_category_list( $separator = ', ' ) {
			$s = str_replace( ' rel="category"', '', get_the_category_list( $separator ) );
			$s = str_replace( ' rel="category tag"', '', $s );
			return $s;
		}
		
		public static function get_valid_tags_list( $separator = ', ' ) {
			$s = str_replace( ' rel="tag"', '', get_the_tag_list( '', $separator, '' ) );
			return $s;
		}
		
		/**
		 * Get post / page content classes
		 **/
		public static function get_content_classes() {
			
			$classes_string = '';
			
			// If Unyson Framework plugin is active
			if( self::is_unyson() && function_exists('fw_ext_sidebars_get_current_position') ) {
				
				$current_sidebar_position = fw_ext_sidebars_get_current_position();
				
				if( ! $current_sidebar_position or $current_sidebar_position == 'full' ) {
					$classes_string = 'col-md-12';
				} elseif( $current_sidebar_position == 'left' ) {
					$classes_string = 'col-md-8 col-md-offset-1';
				} else {
					$classes_string = 'col-md-8';
				}
				
			} else {
				$classes_string = 'col-md-8';
			}
			
			return $classes_string;
			
		}
		
		/**
		 * Remove shortcode from string
		 **/
		public static function strip_shortcode( $code, $content ) {
	    global $shortcode_tags;
	
	    $stack = $shortcode_tags;
	    $shortcode_tags = array( $code => 1 );
	
	    $content = strip_shortcodes( $content );
	
	    $shortcode_tags = $stack;
	    return $content;
		}
		
		/**
		 * Get post media from content
		 **/
		public static function get_media( $post_format ) {
			$header_media = '';
			if( in_array( $post_format, array( 'video', 'audio' ) )) {
				$post_content = get_post_field( 'post_content', get_the_ID() );
				
				$media = get_media_embedded_in_content( $post_content );
				if( isset( $media[0] ) && $media[0] <> '' ) {
					$header_media = $media[0];
				} else {
					$media_arr = preg_match('~\[vc_video\s+link\s*=\s*("|\')(?<url>.*?)\1\s*\]~i', $post_content, $matches );
					if( isset( $matches['url'] ) && $matches['url'] <> '' ) {
						$header_media = do_shortcode('[vc_video link="' . $matches['url'] . '"]');
					}
				}
		
			}
			return $header_media;
		}
		
		/**
		 * Get post gallery shortcode
		 **/
		public static function get_gallery() {
			$post_gallery = '';
			$content = get_post_field( 'post_content', get_the_ID() );
			if( has_shortcode( $content, 'gallery') ) {
				$post_gallery_arr = preg_match('/\[gallery ids=[^\]]+\]/', $content, $matches);
				$post_gallery = isset( $matches[0] ) ? $matches[0] : '';
				
			}
			return $post_gallery;
		}
		
		/**
		 * Get portfolio gallery
		 **/
		public static function get_portfolio_images() {
			if( function_exists('fw_ext_portfolio_get_gallery_images') ) {
				$portfolio_images = fw_ext_portfolio_get_gallery_images();
				if( !empty( $portfolio_images ) ):
					?>
					<div class="post-gallery">
						<div class="owl-carousel">
						<?php
						foreach ( $portfolio_images as $thumbnail ) {
							?>
							<div class="item">
								<img src="<?php echo esc_attr( $thumbnail['url'] ); ?>" alt="" />
							</div>
							<?php
						}
						?>
						</div>
					</div>
					<?php
				endif;	
			}			
		}
		
		/**
		 * Get first photo from content
		 **/
		public static function get_photo( $content ) {
			preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $content, $matches );
			$image = false;
			if ( isset( $matches ) ) {
				$image = $matches[1][0];
			}
			return $image;
		}
		
		/**
		 * String email into link
		 **/
		public static function emailize( $str ) {
	    //Detect and create email
	    $mail_pattern = "/([A-z0-9_-]+\@[A-z0-9_-]+\.)([A-z0-9\_\-\.]{1,}[A-z])/";
	    $str = preg_replace( $mail_pattern, '<a href="mailto:$1$2">$1$2</a>', $str );
	    return $str;
		}
		
		/**
		 * Sanitize HTML output
		 **/
		public static function sanitize_html( $html ) {
			$allowed_tags = wp_kses_allowed_html( 'post' );
			return wp_kses( $html, $allowed_tags );
		}
		
		/**
		 * Get all custom fonts from config
		 **/
		public static function get_all_custom_theme_fonts() {
			
			$custom_styles = get_option('wplab_unicum_theme_styles');
			
			$styles = array();
			
			if( isset( $custom_styles['font_picker'] ) && is_array( $custom_styles['font_picker'] ) && count( $custom_styles['font_picker'] ) > 0 ) {
				
				foreach( $custom_styles['font_picker'] as $k=>$picker ) {
					if( $picker['font_family'] <> '' ) {
						$styles[] = $picker['font_family'];
					}
				}
				
			}
			
			return array_unique( $styles );
			
		}
		
	}