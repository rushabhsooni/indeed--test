<?php
/**
 *	AJAX actions controller
 **/
class wplab_unicum_ajax_controller extends wplab_unicum_core_controller {
	
	function __construct() {
		
		// Auth user via AJAX
		add_action( 'wp_ajax_load_more_portfolio_posts', array( $this, 'load_more_portfolio_posts' ) );
		add_action( 'wp_ajax_nopriv_load_more_portfolio_posts', array( $this, 'load_more_portfolio_posts' ) );
		
		// Dismiss demo notice
		add_action( 'wp_ajax_theme_hide_activation_notice', array( $this, 'hide_activation_notice' ) );
		// Hide rate notice
		add_action( 'wp_ajax_theme_hide_rate_notice', array( $this, 'hide_rate_notice' ) );
		
	}
	
	/**
	 * Load more posts
	 **/
	function load_more_portfolio_posts() {
		global $wplab_unicum_core;
		
		$allowed_tags = wp_kses_allowed_html( 'post' );
		$response = array();
		$response['answer'] = 'ok';
		
		if( ! isset( $_POST['data'] ) || ! is_array( $_POST['data'] ) ) die( esc_html__('Wrong AJAX Request', 'wplab-unicum'));

		$cats = array();
		
		if( isset( $_POST['data']['taxQueryType'] ) && $_POST['data']['taxQueryType'] == 'only' ) {
			$cats = explode(',', $_POST['data']['catsInclude']);
		} elseif( isset( $_POST['data']['tax_query-type'] ) && $_POST['data']['taxQueryType'] == 'except' ) {
			$cats = explode(',', $_POST['data']['catsExclude']);
		}
		
		$paged = isset( $_POST['data']['nextpage'] ) && $_POST['data']['nextpage'] <> '' ? absint( $_POST['data']['nextpage'] ) : 1;

		$response['next_page'] = $paged + 1;

		$posts = $wplab_unicum_core->model('post')->get( array(
			'type' => isset( $_POST['data']['taxQueryType'] ) && $_POST['data']['taxQueryType'] <> '' ? esc_html( $_POST['data']['taxQueryType'] ) : 'all',
			'limit' => isset( $_POST['data']['postsPerPage'] ) && $_POST['data']['postsPerPage'] <> '' ? absint( $_POST['data']['postsPerPage'] ) : 10,
			'category' => $cats,
			'post_type' => 'fw-portfolio',
			'tax_name' => 'fw-portfolio-category',
			'with_thumbnail_only' => true,
			'paged' => $paged,
			'order' => isset( $_POST['data']['orderBy'] ) && $_POST['data']['orderBy'] <> '' ? esc_html( $_POST['data']['orderBy'] ) : 'date',
			'sort' => isset( $_POST['data']['sortBy'] ) && $_POST['data']['sortBy'] <> '' ? esc_html( $_POST['data']['sortBy'] ) : 'DESC',
		));
		
		if( $response['next_page'] > $posts->max_num_pages ) {
			$response['hide_more'] = 'yes';
		}
		
		if( $posts->have_posts() ):
			$response['answer'] = 'add';
			ob_start();
		
?>

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

<?php
		
			$response['html'] = ob_get_clean();
		endif;
		
		echo json_encode( $response );
		exit;
	}
	
	/**
	 * Hide activation notice
	 **/
	function hide_activation_notice() {
		update_option('wplab_unicum_hide_activation_message', true);
		die;
	}
	
	function hide_rate_notice() {
		update_option('wplab_unicum_hide_get_rating', true);
		die;
	}
}