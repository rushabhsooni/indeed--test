<?php get_header(); ?>

<div class="container">
	<div class="row">
	
		<!--
			Article
		-->
	
		<div id="content" class="<?php echo wplab_unicum_utils::get_content_classes(); ?>">
		
			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
		
			<?php
				$post_type = get_post_type();
				$post_format = get_post_format();
			?>
		
			<!--
				Article content
			-->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
					if( !in_array( $post_format, array( 'link', 'quote' ) ) ) {
						/**
						 * If intro header is not enabled
						 **/
						if( wplab_unicum_utils::is_unyson() && ! fw_get_db_post_option( get_the_ID(), 'intro_header/enabled' ) ) {
							?>
							<h1 class="h4"><?php the_title(); ?></h1>
							<?php
						} else {
							?>
							<h1 class="h4"><?php the_title(); ?></h1>
							<?php
						}	
					}
				?>

				<?php
					/**
					 * If post type is "Portfolio"
					 **/
					if( defined( 'FW' ) && $post_type == 'fw-portfolio' ):
						if( filter_var( fw_get_db_post_option( get_the_ID(), 'video_portfolio' ), FILTER_VALIDATE_BOOLEAN ) ):
							?>
							<header class="video-header">
								<div class="responsive-video-wrapper">
									<?php echo apply_filters( 'the_content', fw_get_db_post_option( get_the_ID(), 'video_url' ) ); ?>
								</div>
								<br />
							</header>
							<?php
						else:
							$portfolio_images = wplab_unicum_utils::get_portfolio_images();
							?>
								<header>
									<?php echo wp_kses( $portfolio_images, wp_kses_allowed_html( 'post' ) ); ?>
								</header>
							<?php
						endif;
						
						the_content();
							
					/**
					 * If post format is "Link"
					 **/
				 	elseif( $post_format == 'link'):
				 	?>
						<div class="link">
							<h4><?php the_title(); ?></h4>
							<a href="<?php strip_tags( get_the_content() ); ?>"><?php the_content(); ?></a>
						</div>
				 	<?php
				 	
				 	else:
				 	
				 		the_content();
				 	
					endif;
				?>

				<div class="clearfix"></div>

			</article>
			
			<?php
				/**
				 * Social share links
				 * this function located at /wproto/helper/front.php
				 **/
				if( !is_page() && wplab_unicum_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_share_links' ), FILTER_VALIDATE_BOOLEAN ) ) {
					wplab_unicum_front::share_links();
				}
			?>
			
			<?php
				/**
				 * Post pagination
				 **/
				wp_link_pages( array(
					'before' => '<div class="pagination post-pagination">',
					'after' => '</div>',
					'next_or_number' => 'next',
					'nextpagelink' => esc_html__('Next', 'wplab-unicum'),
					'previouspagelink' => esc_html__('Previous', 'wplab-unicum'),
				));
			?>
			
			<div class="clearfix"></div>
			
			<!--
				Comments block
			-->
			<?php if( !post_password_required() && comments_open() ): ?>
			
				<?php comments_template( '', true ); ?>
			
			<?php endif; ?>
			
			<?php endwhile; endif; ?>
		</div>
		
		<?php get_sidebar(); ?>
	
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 