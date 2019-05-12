<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
global $wplab_unicum_core;

$cats = array();

$tax_query_type = !is_null( $atts['taxonomy_query']['tax_query_type'] ) && isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';
if( $tax_query_type == 'only' ) {
	$cats = explode(',', $atts['taxonomy_query']['only']['cats_include']);
} elseif( $tax_query_type == 'except' ) {
	$cats = explode(',', $atts['taxonomy_query']['except']['cats_exclude']);
}

$posts = $wplab_unicum_core->model('post')->get( array(
	'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
	'limit' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? $atts['posts_per_page'] : 10,
	'category' => $cats,
	'post_type' => 'post',
	'tax_name' => 'category',
	'with_thumbnail_only' => true,
	'paged' => 1,
	'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
	'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
));

?>

<div class="news-shortcode">
	<?php if( $posts->have_posts() ): ?>
	<!-- News Slider main container -->
	<div class="news-carousel swiper-container">
	  <!-- Additional required wrapper -->
	  <div class="swiper-wrapper">
	  	<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
	    <!-- Slides -->
	    <div class="swiper-slide">
			
				<!--
					News slide
				-->
				<div class="news-item">
					<?php
						$post_thumb_id = get_post_thumbnail_id( get_the_ID() );
						$thumb = wp_get_attachment_url( $post_thumb_id );
					?>
					<!--
						Post thumbnail
					-->
					<div class="thumbnail">
						<!-- hover overlay -->
						<div class="overlay"></div>
						<!-- hover links -->
						<a class="lightbox zoom" href="<?php echo esc_attr( $thumb ); ?>"></a>
						<a class="permalink" href="<?php the_permalink(); ?>"></a>
						<!-- post thumbnail -->
						<?php echo wplab_unicum_media::image( $thumb, 370, 250, true, true, 'full', $post_thumb_id ); ?>
					</div>
					
					<!--
						Post title
					-->
					<h4 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					
					<!--
						Post meta
					-->
					<div class="meta">
						<?php esc_html_e('by', 'wplab-unicum'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> <span class="separator">/</span> <?php the_time( get_option('date_format')); ?>
					</div>
					
					<!-- read more link -->
					<a href="<?php the_permalink(); ?>" class="read-more"></a>
				
				</div>
				
			
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
	  </div>
	  <?php if( isset( $atts['display_pagination'] ) && filter_var( $atts['display_pagination'], FILTER_VALIDATE_BOOLEAN ) ): ?>
	  <!-- Slider pagination -->
	  <div class="swiper-pagination"></div>
	  <?php endif; ?>
	</div>
	<?php endif; ?>
</div>