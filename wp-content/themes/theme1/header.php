<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<?php
	$custom_body_style = '';
	/**
	 * Custom background image for 404 page
	 **/
	if( wplab_unicum_utils::is_unyson() && is_404() ) {
		$custom_404_bg_image = fw_get_db_settings_option( 'page_404_content_bg' );
		$custom_body_style = isset( $custom_404_bg_image['url'] ) && $custom_404_bg_image['url'] <> '' ? 'background-image: url(' . $custom_404_bg_image['url'] . ')' : ''; 
	}
?>
<body <?php body_class(); ?>>

	<?php
		/**
		 * Display page preloader
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_unicum_front::preloader();
	?>
	
	<?php
		/**
		 * Display single post / single portfolio hero block
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_unicum_front::hero_head();
	?>
	
	<!--
		Main wrapper
	-->
	<div id="wrap">
	
		<!--
			Page header
		-->
		<header class="headroom" id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					
						<?php
							/**
							 * Display website logo
							 * this function located at /wproto/helper/front.php
							 **/
							wplab_unicum_front::logo();
						?>
						
						<?php
							/**
							 * Display website navigation
							 * this function located at /wproto/helper/front.php
							 **/
							wplab_unicum_front::menu();
						?>
					
					</div>
				</div>
			</div>
		</header>
		
		<!--
			Content section area
		-->
		<div id="content-wrapper" style="<?php echo esc_attr( $custom_body_style ); ?>">