<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
$uniqid = uniqid();
$allowed_tags = wp_kses_allowed_html( 'post' );
 
$header_style = 'left';
if( isset( $atts['section_header_style']['header_style'] ) && in_array( $atts['section_header_style']['header_style'], array('left', 'centered') ) ) {
	$header_style = $atts['section_header_style']['header_style'];
}

$filters_all_text = isset( $atts['filters_all_text'] ) ? $atts['filters_all_text'] : esc_html__('All categories', 'wplab-unicum');

$read_more_title = isset( $atts['read_more_title'] ) ? $atts['read_more_title'] : esc_html__('Load More Works', 'wplab-unicum');

?>
<div class="portfolio">

	<div class="portfolio-header style-<?php echo esc_attr( $header_style ); ?>">
	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				
					<?php if( $header_style != 'centered' ): ?>
					<!--
						Section header
					-->
					<h2 class="h1"><?php echo wp_kses( $atts['section_header_style']['default']['title'], $allowed_tags ); ?></h2>
					<?php endif; ?>
				
					<?php if( isset( $atts['display_filters'] ) && filter_var( $atts['display_filters'], FILTER_VALIDATE_BOOLEAN ) ): ?>
					<!--
						Portfolio filters
					-->
					<div class="filters">
						<?php if( $filters_all_text <> '' ): ?>
						<a href="javascript:;" data-filter=".item" class="selected">
							<span class="line_wrap">
								<span class="line"></span>
								<?php echo wp_kses( $filters_all_text, $allowed_tags ); ?>
							</span>
						</a>
						<?php endif; ?>
						
						<?php
							// Get portfolio categories
							$terms = get_terms( 'fw-portfolio-category', array(
								'hide_empty' => true
							));
							if( count( $terms ) > 0 ): foreach( $terms as $term ):
						?>
						
						<a href="javascript:;" data-filter=".<?php echo esc_attr( $term->slug ); ?>">
							<span class="line_wrap">
								<span class="line"></span>
								<?php echo wp_kses( $term->name, $allowed_tags ); ?>
							</span>
						</a>
						
						<?php endforeach; endif; ?>

					</div>
					<?php endif; ?>
				
				</div>
			</div>
		</div>
		
	</div>
	<?php
		global $wplab_unicum_core;
		// get portfolio posts
		
		$cats = array();
		
		$tax_query_type = !is_null( $atts['taxonomy_query']['tax_query_type'] ) && isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';
		if( $tax_query_type == 'only' ) {
			$cats = explode(',', $atts['taxonomy_query']['only']['cats_include']);
		} elseif( $tax_query_type == 'except' ) {
			$cats = explode(',', $atts['taxonomy_query']['except']['cats_exclude']);
		}
		
		$paged = 1;
		
		$posts = $wplab_unicum_core->model('post')->get( array(
			'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
			'limit' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? $atts['posts_per_page'] : 10,
			'category' => $cats,
			'post_type' => 'fw-portfolio',
			'tax_name' => 'fw-portfolio-category',
			'with_thumbnail_only' => true,
			'paged' => $paged,
			'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
			'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
		));
		
		$max_num_pages = $posts->max_num_pages;
		
	?>
	
	<?php if( $posts->have_posts() ): ?>
		<!--
			Portfolio justified gallery
		-->
		<div class="portfolio-gallery" data-row-height="<?php echo esc_attr( $atts['row_height'] ); ?>" data-row-min-height="<?php echo esc_attr( $atts['row_min_height'] ); ?>">
		
			<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
			
			<?php
				$post_terms = wp_get_post_terms( get_the_ID(), 'fw-portfolio-category' );
				$post_terms_list = array();
				if( is_array( $post_terms ) ) {
					foreach( $post_terms as $k=>$v ) {
						$post_terms_list[] = $v->slug;
					}
				}
			?>
			<div class="item <?php echo esc_attr( implode( ' ', $post_terms_list ) ); ?>">
			
				<!--
					Thumbnail
				-->
				<?php the_post_thumbnail('full'); ?>
				<div class="caption">
					<!--
						Work title
					-->
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<!--
						Zoom link
					-->
					<?php
						
						$preview_link = '';

						if( filter_var( fw_get_db_post_option( get_the_ID(), 'video_portfolio' ), FILTER_VALIDATE_BOOLEAN ) ) {
							$preview_link = fw_get_db_post_option( get_the_ID(), 'video_url' );
						} else {
							$preview_link = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						}
						
					?>
					<a href="<?php echo esc_attr( $preview_link ); ?>" class="zoom lightbox"></a>
					
					<?php
						$categories = wplab_unicum_utils::get_categories();
						if( $categories <> '' ):
					?>
					<!--
						Cats
					-->
					<div class="tags">
						<?php echo wp_kses( $categories, $allowed_tags ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
			
		</div>
		
		<?php if( isset( $atts['display_load_more'] ) && filter_var( $atts['display_load_more'], FILTER_VALIDATE_BOOLEAN ) && $max_num_pages > $paged ): ?>
		<!--
			Pagination
		-->
		<div class="portfolio-pagination">
			<a
				data-sort-by="<?php echo esc_attr( $atts['sort_by'] ); ?>"
				data-order-by="<?php echo esc_attr( $atts['order_by'] ); ?>"
				data-posts-per-page="<?php echo esc_attr( $atts['posts_per_page'] ); ?>"
				data-cats-exclude="<?php echo $tax_query_type <> '' ? esc_attr( $atts['cats_exclude'] ) : ''; ?>"
				data-cats-include="<?php echo $tax_query_type <> '' ? esc_attr( $atts['cats_include'] ) : ''; ?>"
				data-tax-query-type="<?php echo esc_attr( $tax_query_type ); ?>"
				data-nextpage="<?php echo $paged + 1; ?>"
				href="javascript:;"
				class="portfolio-load-more"><i class="icon"></i> <?php if( $read_more_title <> '' ): ?><span><?php echo wp_kses( $read_more_title, $allowed_tags ); ?></span><?php endif; ?></a>
		</div>
		<?php endif; ?>
	
	<?php endif; ?>

</div>