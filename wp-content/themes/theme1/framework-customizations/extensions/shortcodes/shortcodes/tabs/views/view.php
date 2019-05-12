<?php
	if (!defined('FW')) die( 'Forbidden' );
	global $wplab_unicum_core;
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$section_styles = $pagination_styles = array();
	
	$tabs_bg = isset( $atts['tabs_background_color'] ) && $atts['tabs_background_color'] <> '' ? $atts['tabs_background_color'] : '#f9f0e7';
	$tabs_accent = isset( $atts['tabs_background_accent'] ) && $atts['tabs_background_accent'] <> '' ? $atts['tabs_background_accent'] : '#f4e7d7';
	$icon_color = isset( $atts['tabs_icon_color'] ) && $atts['tabs_icon_color'] <> '' ? $atts['tabs_icon_color'] : '#636363';
	$icon_grad_color_1 = isset( $atts['tabs_icon_hover_gradient_left_color'] ) && $atts['tabs_icon_hover_gradient_left_color'] <> '' ? $atts['tabs_icon_hover_gradient_left_color'] : '#e91d62';
	$icon_grad_color_2 = isset( $atts['tabs_icon_hover_gradient_right_color'] ) && $atts['tabs_icon_hover_gradient_right_color'] <> '' ? $atts['tabs_icon_hover_gradient_right_color'] : '#ff9700';
	
	$section_styles[] = 'background-color: ' . esc_attr( $tabs_bg ) . ';';
	
	$pagination_styles[] = 'background-color: ' . esc_attr( $tabs_accent ) . ';';
	
	$uniqid = uniqid();
?>

<?php if( isset( $atts['tabs'] ) && count( $atts['tabs'] ) > 0 ): ?>
<div id="tabs-shortcode-id-<?php echo $uniqid; ?>" class="tabs-shortcode">
	<div class="services" style="<?php echo implode(' ', $section_styles); ?>">
	
		<svg width="100" height="50" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<style>
				#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link path, #tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link polygon {
					fill: <?php echo esc_attr( $icon_color ); ?> !important;
				}
			</style>
		</svg>
	
		<svg width="100" height="50" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<style>
				#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link:hover path, #tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link:hover polygon,
				#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link.selected path, #tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link.selected polygon {
					fill: url(#TabsIconsGradient) !important;
				}
			</style>
			<defs>
				<linearGradient id="TabsIconsGradient" gradientTransform="rotate(-25)">
					<stop offset="0%" stop-color="<?php echo esc_attr( $icon_grad_color_1 ); ?>" />
					<stop offset="67%" stop-color="<?php echo esc_attr( $icon_grad_color_2 ); ?>" />
				</linearGradient>
			</defs>
		</svg>
	
		<?php $tab_num = 0; foreach( $atts['tabs'] as $k=>$tab ): $tab_num++; ?>
		<!--
			Tab element
		-->
		<?php
		
			$img_exists = !empty( $tab['tab_image']['data']['css'] ) && isset( $tab['tab_image']['data']['css']['background-image'] );
		
			$tab_styles = array();
			$tab_styles[] = $img_exists ? 'background-image: ' . $tab['tab_image']['data']['css']['background-image'] . ';' : '';
		?>
		<div id="services-tab-id-<?php echo $tab_num; ?>" style="<?php echo esc_attr( implode( ' ', $tab_styles ) ); ?>" class="service-item <?php if( ! $img_exists ): ?>noimage<?php endif; ?> <?php if( $tab_num == 1): ?>selected<?php endif; ?>">
		
			<!--
				Tab content
			-->
			<div class="container">
				<div class="row">
					<div class="<?php if( $img_exists ): ?>col-md-6 col-md-offset-6<?php else: ?>col-md-12<?php endif; ?>">
					
						<div class="tab-content">
					
							<?php echo apply_filters( 'the_content', $tab['tab_content'] ); ?>
						
						</div>
					
					</div>
				</div>
			</div>
		
		</div>
		<?php endforeach; ?>
	
	</div>
	
	<!--
		Tabs pagination
	-->
	<div class="services-pagination" style="<?php echo implode(' ', $pagination_styles); ?>">
	
		<?php $tab_num = 0; foreach( $atts['tabs'] as $k=>$tab ): $tab_num++; ?>
		<a href="#services-tab-id-<?php echo $tab_num; ?>" class="tab-link <?php if( $tab_num == 1): ?>selected<?php endif; ?>">
		
			<?php if( $tab['tab_icon_type']['tab_icon'] == 'custom' ): ?>
				<img src="<?php echo esc_attr( $tab['tab_icon_type']['custom']['custom_image']['url'] ); ?>" class="image-svg" alt="" />
			<?php elseif( $tab['tab_icon_type']['tab_icon'] == 'fontawesome' ): ?>
				<i class="fa <?php echo esc_attr( $tab['tab_icon_type']['fontawesome']['icon'] ); ?>"></i>
			<?php endif; ?>
			
			<span><?php echo wp_kses( $tab['tab_title'], $allowed_tags ); ?></span>
		</a>
		<?php endforeach; ?>
	
	</div>
</div>
<div id="tabs-style-div-<?php echo $uniqid; ?>"></div>
<?php ob_start(); ?>
	#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link:hover,
	#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .selected {
		<?php echo implode( ' ', $section_styles ); ?>
	}
	#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link i.fa {
		color: <?php echo esc_attr( $icon_color ); ?>;
		background: -webkit-linear-gradient( <?php echo esc_attr( $icon_color ); ?>, <?php echo esc_attr( $icon_color ); ?> );
	  -webkit-background-clip: text;
	  -webkit-text-fill-color: transparent;
	}
	#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .tab-link:hover i.fa,
	#tabs-shortcode-id-<?php echo $uniqid; ?> .services-pagination .selected i.fa {
		background: -webkit-linear-gradient( <?php echo esc_attr( $icon_grad_color_1 ); ?>, <?php echo esc_attr( $icon_grad_color_2 ); ?>);
	  -webkit-background-clip: text;
	  -webkit-text-fill-color: transparent;
	}
<?php
	$inline_css = ob_get_clean(); 
	echo '<script>var htmlDiv = document.getElementById("tabs-style-div-'.$uniqid.'"); htmlDiv.innerHTML = "<style>'.preg_replace('/[\n\r]/',"",$inline_css).'</style>";</script>';
endif; 