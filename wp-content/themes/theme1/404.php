<?php get_header(); $allowed_tags = wp_kses_allowed_html( 'post' ); ?>

<div class="container">
	<div class="row">
	
		<!--
			Page 404
		-->
	
		<div id="content" class="col-md-12 page-error-404">

			<?php if( wplab_unicum_utils::is_unyson() ): ?>
			
				<?php echo str_replace( '404', '<span>404</span>', fw_get_db_settings_option( 'page_404_content' ) ); ?>
			
			<?php else: ?>
			
				<h1><?php echo wp_kses( __( 'Error <span>404</span>', 'wplab-unicum' ), $allowed_tags ); ?></h1>
				
				<p><?php esc_html_e( 'Page not found', 'wplab-unicum' ); ?></p>
			
			<?php endif; ?>
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php get_search_form(); ?>
				</div>
			</div>

		</div>
	
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 