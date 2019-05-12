<?php get_header(); $allowed_tags = wp_kses_allowed_html( 'post' ); ?>

<div class="container">
	<div class="row">
	
		<!--
			Article
		-->
	
		<div id="content" class="<?php echo wplab_unicum_utils::get_content_classes(); ?>">

			<?php
			
				$page_title = '';
				
				if( is_search() ) {
					$page_title = sprintf( esc_html__( 'Search Results for &laquo;%s&raquo;', 'wplab-unicum' ), get_query_var( 's' ) );
				}
				
				if( is_archive() ) {
					$page_title = esc_html__( 'Blog Archive', 'wplab-unicum' );
				}
				
				if( is_author() ) {
					$page_title = sprintf( esc_html__( 'Posts by &laquo;%s&raquo;', 'wplab-unicum' ), get_query_var( 'author_name' ) );
				}
				
				if( is_category() ) {
					$page_title = sprintf( esc_html__( 'Posts in &laquo;%s&raquo; category', 'wplab-unicum' ), single_cat_title( '', false ) );
				}
				
				if( is_tag() ) {
					$page_title = sprintf( esc_html__( 'Posts tagged with &laquo;%s&raquo;', 'wplab-unicum' ), single_tag_title( '', false ) );
				}
				
				if( is_tax( 'fw-portfolio-category' ) ) {
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$page_title = sprintf( esc_html__( '%s in &laquo;%s&raquo; category', 'wplab-unicum' ), esc_html__( 'Works', 'wplab-unicum' ), $term->name );
				} 
			
			?>
			
			<?php if( $page_title <> '' ): ?>
			
				<h1 class="h3"><?php echo $page_title; ?></h1>
				<hr />
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php
						/**
						 * Check for supported post formats and custom post types
						 **/
						$post_format = get_post_format();
						$post_type = get_post_type();
					?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-part' ); ?>>
					
						<?php
						/**
						 * Gallery post format
						 **/
						if( $post_format == 'gallery' ):
							$post_gallery = wplab_unicum_utils::get_gallery();
						?>
							<header>
								<?php echo do_shortcode( $post_gallery ); ?>
							</header>
						<?php						
						/**
						 * Portfolio post type
						 **/
						elseif( wplab_unicum_utils::is_unyson() && $post_type == 'fw-portfolio' ):
							$portfolio_images = wplab_unicum_utils::get_portfolio_images();
						?>
							<header>
								<?php echo wp_kses( $portfolio_images, $allowed_tags ); ?>
							</header>
						<?php
						/**
						 * Video post format
						 **/
						elseif( $post_format == 'video' ):
							$content = get_the_content();
							$youtube_video = wplab_unicum_media::getYouTubeVideoId( $content );
							if( $youtube_video <> '' ) {
								?>
								<header>
									<div class="lazy-video" data-youtube-id="<?php echo esc_attr( $youtube_video ); ?>" data-ratio="16:9"></div>
								</header>
								<?php
							} else {
								?>
								<header>
									<?php echo wplab_unicum_utils::get_media( $post_format ); ?>
								</header>
								<?php
							}
							
						/**
						 * Audio post format
						 **/
						elseif( $post_format == 'audio' ):
							$post_audio = wplab_unicum_utils::get_media( $post_format );
						?>
							<header>
								<?php echo trim( $post_audio ) <> '' ? $post_audio : ''; ?>
							</header>
						<?php
						/**
						 * Image post format
						 **/
						elseif( $post_format == 'image' ):
							$image = esc_attr( wplab_unicum_utils::get_photo( get_the_content() ) );
						?>

							<header>
								<div class="overlay"></div>
								<a href="<?php echo $image; ?>">
									<img src="<?php echo $image; ?>" alt="" />
								</a>
								<a href="<?php echo $image; ?>" class="zoom lightbox"></a>
								<a href="<?php the_permalink(); ?>" class="link"></a>
							</header>
							<div class="clearfix"></div>
						
						<?php
						/**
						 * Simple post with thumbnail
						 **/
						elseif( has_post_thumbnail() ): ?>
							<header>
								<div class="overlay"></div>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
								<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ); ?>" class="zoom lightbox"></a>
								<a href="<?php the_permalink(); ?>" class="link"></a>
							</header>
							<div class="clearfix"></div>
						<?php endif; ?>
						
						<div class="indent post-excerpt">
						
							<?php if( $post_format == 'link' ): ?>
							
								<div class="link">
									<h4><?php the_title(); ?></h4>
									<a href="<?php echo strip_tags( get_the_content() ); ?>"><?php echo strip_tags( get_the_content() ); ?></a>
								</div>
							
							<?php elseif( $post_format == 'quote' || $post_format == 'chat' ): ?>
							
								<?php the_content(); ?>
								
							<?php elseif( $post_format == 'audio' && isset( $post_audio ) && $post_audio == '' ): ?>
								
								<h4 class="post-title-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								
								<?php the_content(); ?>
								
							<?php else: ?>
							
								<h4 class="post-title-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								
								<?php $excerpt = get_the_excerpt(); ?>
								
								<?php if( $excerpt <> '' ): ?>
								<div class="excerpt-text">
									<?php echo wp_kses( $excerpt, $allowed_tags ); ?>
								</div>
								<?php endif; ?>
							
							<?php endif; ?>
						
							<?php
								/**
								 * Get post categories
								 **/
								$cats_string = '';
								$post_categories = wplab_unicum_utils::get_categories();
								$cats_string = $post_categories <> '' ? '<span class="delimeter">/</span>' . esc_html__( 'In', 'wplab-unicum') . ' ' . $post_categories : ''; 
							?>
						
							<div class="post-data">
								<?php esc_html_e('by', 'wplab-unicum'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> <span class="delimeter">/</span> <?php the_time( get_option('date_format')); ?> <?php echo $cats_string; ?>
							</div>
						
							<a href="<?php the_permalink(); ?>" class="read-more"></a>
						
						</div>
					
					</article>
				
				<?php endwhile; ?>
			
				<!--
					Pagination
				-->
				<div class="pagination">
				
					<?php posts_nav_link( ' ', esc_html__( 'Previous', 'wplab-unicum'), esc_html__( 'Next', 'wplab-unicum') ); ?>
				
				</div>
			
			<?php else : ?>
			
				<h2 class="h1"><?php esc_html_e( 'No posts were found', 'wplab-unicum'); ?></h2>
				
				<p><?php esc_html_e( 'It seems, this category is empty. We can not find any posts in this category.', 'wplab-unicum'); ?></p>
			
			<?php endif; ?>
		
		</div>
		
		<?php get_sidebar(); ?>
		
	</div>
</div>

<?php get_footer(); 