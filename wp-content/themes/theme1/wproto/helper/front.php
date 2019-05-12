<?php
	/**
	 * Front helper
	 **/
	class wplab_unicum_front {
		
		/**
		 * Page preloader
		 **/
		public static function preloader() {
			
			$preloader_style = 'hidden';
			
			// If Unyson Framework is enabled
			if( wplab_unicum_utils::is_unyson() ) {
				$preloader_style = fw_get_db_settings_option( 'page_preloader/style' );
				$css_preloader_style = fw_get_db_settings_option( 'page_preloader/css/css_preloader_style' );
			}
			
			if( $preloader_style == 'theme' ):
			?>
			<div id="preloader">
				<div class="timer"></div>
			</div>
			<?php
			elseif( $preloader_style == 'css' && $css_preloader_style <> '' ):
			?>
			<div id="preloader">
				<div id="preloader-inner" class="loader-inner <?php echo esc_attr( $css_preloader_style ); ?>"></div>
			</div>
			<?php
			elseif( $preloader_style == 'custom' ):
			
				$preloader_img 				= esc_attr( fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image/url' ) );
				$preloader_img_retina = esc_attr( fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_2x/url' ) );
				$preloader_img_retina = $preloader_img_retina == '' ? 'data-no-retina' : 'data-at2x="' . $preloader_img_retina . '"';
				
				$preloader_width = fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_width' );
				$preloader_height = fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_height' );
				
				$preloader_style = wplab_unicum_utils::get_styles( array(
					'width'				=> esc_attr( $preloader_width ),
					'height'			=> esc_attr( $preloader_height ),
					'top_margin' 	=> '-' . $preloader_height / 2,
					'left_margin' => '-' . $preloader_width / 2,
				));
				
			?>
			<div id="preloader" class="custom">
				<img src="<?php echo $preloader_img; ?>" <?php echo $preloader_img_retina; ?> style="<?php echo esc_attr( $preloader_style ); ?>" alt="" />
			</div>
			<?php
			endif;
		}
		
		/**
		 * Hero block for single post / single portfolio
		 **/
		public static function hero_head() {
			
			// If Unyson Framework is enabled
			if( wplab_unicum_utils::is_unyson() && ( is_home() || is_page() || is_single() || is_singular('fw-portfolio') ) ):
				global $post;
				$post_id = is_home() ? get_option( 'page_for_posts' ) : get_the_ID();
			
				$hero_header_enabled = fw_get_db_post_option( $post_id, 'intro_header/enabled' );
				$hero_header_image = fw_get_db_post_option( $post_id, 'intro_header/1/intro_header_image/url' );
			
				if( $hero_header_enabled && $hero_header_image <> '' ):
				?>
				<!--
					Intro section for blog post
				-->
				<div id="hero" class="intro" style="background-image: url(<?php echo esc_attr( $hero_header_image ); ?>);">
				
					<div class="container intro-text">
						<div class="row">
							<div class="col-md-12">
							
								<h1><?php echo get_the_title( $post_id ); ?></h1>
								
								<?php if( !is_home() ): ?>
								
								<?php
									$cats_string = '';
									$post_categories = wplab_unicum_utils::get_categories();
									$cats_string = $post_categories <> '' ? '<span class="delimeter">/</span>' . esc_html__( 'In', 'wplab-unicum') . ' ' . $post_categories : ''; 
								?>
								
								<p class="post-data">
									<?php esc_html_e( 'by', 'wplab-unicum'); ?> <a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo the_author_meta( 'display_name', $post->post_author ); ?></a> <span class="delimeter">/</span> <?php the_time( get_option('date_format')); ?> <?php echo $cats_string; ?> <span class="delimeter">/</span> <a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php comments_number( esc_html__('No comments', 'wplab-unicum'), esc_html__('1 comment', 'wplab-unicum'), esc_html__('% comments', 'wplab-unicum') ); ?></a>
								</p>
							
								<?php endif; ?>
							
							</div>
						</div>
					</div>
					
					<a href="javascript:;" id="skip-intro"></a>
				
				</div>
				<?php
				endif;
			
			endif;
			
		}
		
		/**
		 * Website logo
		 **/
		public static function logo() {
			
			$logo_type = 'title';
			$blog_name = esc_html( get_bloginfo('name') );
			$description = esc_html( get_bloginfo('description') );
			
			// If Unyson Framework is enabled
			if( wplab_unicum_utils::is_unyson() ) {
				$logo_type = fw_get_db_settings_option( 'header_logo_type/logo_type' );
			}

			// If logo type is a "site title"
			if( $logo_type == 'title' ):
				?>
				<a <?php if( !is_front_page() ): ?>href="<?php echo site_url(); ?>"<?php endif; ?> class="logo logo-title"><?php echo $blog_name; ?></a>
				<?php
			// If logo type is a "site title and tagline"
			elseif( $logo_type == 'title_and_tagline' ):
				?>
				<a <?php if( !is_front_page() ): ?>href="<?php echo site_url(); ?>"<?php endif; ?> class="logo logo-title-tagline"><span class="title"><?php echo $blog_name; ?></span><span class="tagline"><?php echo $description; ?></span></a>
				<?php
			// If logo type is an "image"
			elseif( $logo_type == 'image' ):
			
				$logo_img 				= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_image/url' ) );
				$logo_img_retina 	= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_image_2x/url' ) );
				$logo_img_retina 	= $logo_img_retina == '' ? 'data-no-retina' : 'data-at2x="' . $logo_img_retina . '"';
				
				$logo_style = wplab_unicum_utils::get_styles( array(
					'width' 				=> esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_width' ) ),
					'height' 				=> esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_height' ) ),
					'top_margin' 		=> esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_margin_top' ) ),
					'right_margin' 	=> esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_margin_right' ) ),
					'bottom_margin' => esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_margin_bottom' ) ),
					'left_margin' 	=> esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_margin_left' ) ),
				));
			
				?>
				<a <?php if( !is_front_page() ): ?>href="<?php echo site_url(); ?>"<?php endif; ?> class="logo logo-image"><img style="<?php echo esc_attr( $logo_style ); ?>" src="<?php echo $logo_img; ?>" <?php echo $logo_img_retina; ?> alt="<?php echo esc_attr( $blog_name ); ?> &ndash; <?php echo esc_attr( $description ); ?>" /></a>
				<?php
			endif;
		}
		
		/**
		 * Website menu
		 **/
		public static function menu() {
			
			$menu_id = '';
			$logo_style = 'title';
			$menu_location = 'header_menu';
			
			// If Unyson Framework is enabled			
			if( wplab_unicum_utils::is_unyson() ) {
				$logo_style = fw_get_db_settings_option( 'header_logo_type/logo_type' );
				
				if( is_page() ) {
					$menu_id = fw_get_db_post_option( get_the_ID(), 'page_menu' );
				}
				
				if( filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu' ), FILTER_VALIDATE_BOOLEAN ) && $menu_id == '' ) {
					$menu_location = 'one_page_home_menu';
				}
				
			}
			
			?>
			<!--
				Navigation
			-->
			<?php if( wplab_unicum_utils::is_unyson() ): ?>
				<nav id="header-nav" <?php if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/enabled' ), FILTER_VALIDATE_BOOLEAN ) ): ?>data-scroll-offset="<?php echo esc_attr( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/1/scroll_offset' ) ); ?>" data-scroll-speed="<?php echo esc_attr( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/1/scroll_speed' ) ); ?>" data-scroll-easing="<?php echo esc_attr( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/1/scroll_easing' ) ); ?>"<?php endif; ?> class="dl-menuwrapper logo-style-<?php echo esc_attr( $logo_style ); ?>" data-back-label="<?php esc_html_e( 'Back', 'wplab-unicum'); ?>">
			<?php else: ?>
				<nav id="header-nav" class="dl-menuwrapper logo-style-<?php echo esc_attr( $logo_style ); ?>" data-back-label="<?php esc_html_e( 'Back', 'wplab-unicum'); ?>"> 
			<?php endif; ?>
			
				<!--
					Toggle menu for mobile devices
					this element is hidden for desktop and large monitors
				-->
				<a href="javascript:;" id="mobile-menu-toggler" class="dl-trigger"><span><?php esc_html_e( 'Toggle Menu', 'wplab-unicum'); ?></span></a>
			
				<?php
					wp_nav_menu( array(
						'menu' => $menu_id,
						'theme_location' => $menu_location,
						'walker' => new wplab_unicum_front_nav_menu_walker,
						'menu_id' => 'header-menu',
						'fallback_cb' => false,
						'menu_class' => 'dl-menu',
						'container' => false						
					));
				?>
			
			</nav>
			<?php
		}
		
		/**
		 * Print social icons
		 **/
		public static function social_icons( $target = '_blank' ) {
			
			// If Unyson Framework is active and Footer Widgets Area is enabled
			if( wplab_unicum_utils::is_unyson() ) {
				
				$linkedin_url 						= fw_get_db_settings_option( 'linkedin_url' );
				$youtube_url 							= fw_get_db_settings_option( 'youtube_url' );
				$vimeo_url 								= fw_get_db_settings_option( 'vimeo_url' );
				$facebook_url 						= fw_get_db_settings_option( 'facebook_url' );
				$twitter_url 							= fw_get_db_settings_option( 'twitter_url' );
				$google_plus_url 					= fw_get_db_settings_option( 'google_plus_url' );
				$pinterest_url 						= fw_get_db_settings_option( 'pinterest_url' );
				$instagram_url 						= fw_get_db_settings_option( 'instagram_url' );
				$flickr_url 							= fw_get_db_settings_option( 'flickr_url' );
				$behance_url 							= fw_get_db_settings_option( 'behance_url' );
				$google_play_url 					= fw_get_db_settings_option( 'google_play_url' );
				$app_store_url 						= fw_get_db_settings_option( 'app_store_url' );
				$windows_marketplace_url 	= fw_get_db_settings_option( 'windows_marketplace_url' );
				
				?>
				<div class="social-icons">
					<?php
						echo $linkedin_url <> '' ? '<a href="' . esc_attr( $linkedin_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-linkedin"></i></a>' : '';
						echo $youtube_url <> '' ? '<a href="' . esc_attr( $youtube_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-youtube-play"></i></a>' : '';
						echo $vimeo_url <> '' ? '<a href="' . esc_attr( $vimeo_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-vimeo"></i></a>' : '';
						echo $facebook_url <> '' ? '<a href="' . esc_attr( $facebook_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-facebook"></i></a>' : '';
						echo $twitter_url <> '' ? '<a href="' . esc_attr( $twitter_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-twitter"></i></a>' : '';
						echo $google_plus_url <> '' ? '<a href="' . esc_attr( $google_plus_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-google-plus"></i></a>' : '';
						echo $pinterest_url <> '' ? '<a href="' . esc_attr( $pinterest_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-pinterest-p"></i></a>' : '';
						echo $instagram_url <> '' ? '<a href="' . esc_attr( $instagram_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-instagram"></i></a>' : '';
						echo $flickr_url <> '' ? '<a href="' . esc_attr( $flickr_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-flickr"></i></a>' : '';
						echo $behance_url <> '' ? '<a href="' . esc_attr( $behance_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-behance"></i></a>' : '';
						echo $google_play_url <> '' ? '<a href="' . esc_attr( $google_play_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-google"></i></a>' : '';
						echo $app_store_url <> '' ? '<a href="' . esc_attr( $app_store_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-apple"></i></a>' : '';
						echo $windows_marketplace_url <> '' ? '<a href="' . esc_attr( $windows_marketplace_url ) . '" target="' . esc_attr( $target ) . '"><i class="fa fa-windows"></i></a>' : '';
					?>
				</div>
				<?php
				
			} else {
				esc_html_e( 'Please, activate Unyson Framework before using this widget', 'wplab-unicum' );
			}
			
		}
		
		/**
		 * Display share / like links
		 **/
		public static function share_links() {	
			$title = urlencode( get_the_title( get_the_ID() ) );
			$permalink = urlencode( get_permalink( get_the_ID() ) );
			$post_thumb = has_post_thumbnail() ? urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ) : '';
			?>
			<div class="indent social-icons">
				<a rel="nofollow" title="<?php esc_html_e('Share on Facebook', 'wplab-unicum'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?display=popup&amp;u=<?php echo $permalink; ?>"><i class="fa fa-facebook"></i></a>
				<a rel="nofollow" title="<?php esc_html_e('Share on Twitter', 'wplab-unicum'); ?>" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $permalink; ?>"><i class="fa fa-twitter"></i></a>
				<a rel="nofollow" title="<?php esc_html_e('Share on Pinterest', 'wplab-unicum'); ?>" target="_blank" href="http://pinterest.com/pin/create/button?description=<?php echo $title; ?>&amp;media=<?php echo $post_thumb; ?>&amp;url=<?php echo $permalink; ?>"><i class="fa fa-pinterest-p"></i></a>
				<a rel="nofollow" title="<?php esc_html_e('Share on Google Plus', 'wplab-unicum'); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo $permalink; ?>"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php
		}
		
		/**
		 * Footer widgets
		 **/
		public static function footer_widgets() {
			
			// If Unyson Framework is active and Footer Widgets Area is enabled
			if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_footer_widgets/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$footer_columns = fw_get_db_settings_option( 'display_footer_widgets/true/footer_widgets_columns' );
				?>
				<div id="footer-widgets" class="footer-columns-<?php echo esc_attr( $footer_columns ); ?>">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="widgets">
									<?php dynamic_sidebar( 'sidebar-footer' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			
		}
		
		/**
		 * Bottom bar at footer
		 **/
		public static function bottom_bar() {
			
			if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_bottom_bar/enabled' ), FILTER_VALIDATE_BOOLEAN ) ):
			
			?>
			<div id="bottom-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php echo fw_get_db_settings_option( 'display_bottom_bar/true/bottom_bar_content' ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
			elseif( ! wplab_unicum_utils::is_unyson() ):
			?>
			
			<div id="bottom-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>&copy;<?php echo date('Y'); ?> <?php echo esc_html( get_bloginfo('name') ); ?></p>
							<p>Designed by <a href="http://themeforest.net/user/themefire/?ref=wplab">ThemeFire</a> / Developed by <a href="http://themeforest.net/user/wplab/?ref=wplab">WPlab.Pro</a></p>
							<p>Only for <a href="http://themeforest.net/user/wplab/portfolio/?ref=wplab">Envato Market</a></p>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			endif;
			
		}
		
		/**
		 * Information for developers
		 **/		
		public static function dev_info() {
			if( wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'dev_info' ), FILTER_VALIDATE_BOOLEAN ) ):
			?>
<!--
===============================================================================================
Generated with <?php echo get_num_queries(); ?> SQL queries in <?php timer_stop(1); ?> seconds.
===============================================================================================
-->
			<?php
			endif;
		}
		
	}