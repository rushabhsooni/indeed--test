<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if( !function_exists('wplab_unicum_get_arr_name') ) {
	function wplab_unicum_get_arr_name( $data ) {
		return $data['name'];
	}
}

/**
 * @var array $atts
 */

$class_width = 'fw-col-sm-' . ceil(12 / count($atts['table']['cols']));
$allowed_tags = wp_kses_allowed_html( 'post' );

$table_style = 'style-image';
$table_style = array_search( 'alt-heading-row', array_map( 'wplab_unicum_get_arr_name', $atts['table']['rows'] )) !== false ? 'style-colorful' : $table_style;
$table_style = array_search( 'personal-heading-row', array_map( 'wplab_unicum_get_arr_name', $atts['table']['rows'] )) !== false ? 'style-clean' : $table_style;


?>
<div class="pricing-table <?php echo esc_attr( $table_style ); ?>">
	<ul class="pricing-table">
		<?php foreach ($atts['table']['cols'] as $col_key => $col): ?>
		
		<li class="table-column <?php echo $col['name'] == 'highlight-col' ? 'featured' : ''; ?>">
		
			<?php foreach ($atts['table']['rows'] as $row_key => $row): ?>
			
				<?php if ($row['name'] === 'heading-row'): ?>
					<!--
						Plan thumbnail and price
					-->
					<?php
						$bg_image = isset( $atts['table']['content'][$row_key][$col_key]['image']['url'] ) ? $atts['table']['content'][$row_key][$col_key]['image']['url'] : '';
						$title = $atts['table']['content'][$row_key][$col_key]['title'];
						$price = $atts['table']['content'][$row_key][$col_key]['price'];
						$period = $atts['table']['content'][$row_key][$col_key]['period'];
						
						$period_text = $period == '' ? $price : str_replace( '%price%', '<span>' . $price . '</span>', $period );
					?>
					<div class="table-row image-row thumbnail">
					
						<img src="<?php echo esc_attr( $bg_image ); ?>" alt="" />
					
						<div class="thumb-text">
							<h4><?php echo wp_kses( $title, $allowed_tags ); ?></h4>
							<div class="price"><?php echo wp_kses( $period_text, $allowed_tags ); ?></div>
						</div>
					</div>
				<?php elseif ($row['name'] === 'personal-heading-row'): ?>
				
					<!--
						Plan thumbnail and price
					-->
					<?php
						$price = $atts['table']['content'][$row_key][$col_key]['p_header_price'];
						$title = $atts['table']['content'][$row_key][$col_key]['p_header_title'];
						$desc = $atts['table']['content'][$row_key][$col_key]['p_header_desc'];
						$accent_color = $atts['table']['content'][$row_key][$col_key]['p_header_accent_color'];
						$uniqid = uniqid();
					?>
					<div id="pricing-table-header-id-<?php echo $uniqid; ?>" class="table-row table-personal-heading thumbnail">
					
						<div class="thumb-text">
							<div class="price"><?php echo wp_kses( $price, $allowed_tags ); ?></div>
							<h4><?php echo wp_kses( $title, $allowed_tags ); ?></h4>
							<div class="desc"><?php echo wp_kses( $desc, $allowed_tags ); ?></div>
						</div>
					</div>
					<div id="table-style-div-<?php echo $uniqid; ?>"></div>
					<?php ob_start(); ?>
						#pricing-table-header-id-<?php echo $uniqid; ?> {
					    border-top: 3px solid <?php echo $accent_color; ?>;
						}
						#pricing-table-header-id-<?php echo $uniqid; ?> .price {
							color: <?php echo $accent_color; ?>;
						}
						<?php
							$inline_css = ob_get_clean(); 
							echo '<script>var htmlDiv = document.getElementById("table-style-div-'.$uniqid.'"); htmlDiv.innerHTML = "<style>'.preg_replace('/[\n\r]/',"",$inline_css).'</style>";</script>';
						?>
				<?php elseif ($row['name'] === 'alt-heading-row'): ?>
					<!--
						Plan title
					-->
					<?php
						$title = $atts['table']['content'][$row_key][$col_key]['header_title'];
						$desc = $atts['table']['content'][$row_key][$col_key]['header_desc'];
						$color_left = $atts['table']['content'][$row_key][$col_key]['header_color_left'];
						$color_right = $atts['table']['content'][$row_key][$col_key]['header_color_right'];
						$uniqid = uniqid();
					?>
					<div id="pricing-table-header-id-<?php echo $uniqid; ?>" class="table-row thumbnail">
					
						<div class="thumb-text">
							<h4><?php echo wp_kses( $title, $allowed_tags ); ?></h4>
							<div><?php echo wp_kses( $desc, $allowed_tags ); ?></div>
						</div>
					</div>
					<div id="table-style-div-<?php echo $uniqid; ?>"></div>
					<?php ob_start(); ?>
						#pricing-table-header-id-<?php echo $uniqid; ?> {
					    background: <?php echo $color_left; ?>;
					    background: -moz-linear-gradient(45deg, <?php echo $color_left; ?> 0%, <?php echo $color_right; ?> 100%);
					    background: -webkit-gradient(left bottom, right top, color-stop(0%, <?php echo $color_left; ?>), color-stop(100%, <?php echo $color_right; ?>));
					    background: -webkit-linear-gradient(45deg, <?php echo $color_left; ?> 0%, <?php echo $color_right; ?> 100%);
					    background: -o-linear-gradient(45deg, <?php echo $color_left; ?> 0%, <?php echo $color_right; ?> 100%);
					    background: -ms-linear-gradient(45deg, <?php echo $color_left; ?> 0%, <?php echo $color_right; ?> 100%);
					    background: linear-gradient(45deg, <?php echo $color_left; ?> 0%, <?php echo $color_right; ?> 100%);
					    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $color_left; ?>', endColorstr='<?php echo $color_right; ?>', GradientType=1);
						}
						<?php
							$inline_css = ob_get_clean(); 
							echo '<script>var htmlDiv = document.getElementById("table-style-div-'.$uniqid.'"); htmlDiv.innerHTML = "<style>'.preg_replace('/[\n\r]/',"",$inline_css).'</style>";</script>';
						?>
				<?php elseif ($row['name'] === 'pricing-row'): ?>
					<!--
						Price
					-->
					<?php
						$price = $atts['table']['content'][$row_key][$col_key]['price_text'];
						$price_arr = explode( '.', $price );
						$price_color = $atts['table']['content'][$row_key][$col_key]['price_color'];
					?>
					<div class="table-row price" style="color: <?php echo esc_attr( $price_color ); ?>">
						<?php echo isset( $price_arr[1] ) && $price_arr[1] <> '' ? $price_arr[0] . '<sup>' . $price_arr[1] . '</sup>' : $price; ?> 
					</div>
				<?php elseif ($row['name'] === 'features-row'): ?>
				
					<?php
						$features = isset( $atts['table']['content'][$row_key][$col_key]['feature_icon']['features'] ) && is_array( $atts['table']['content'][$row_key][$col_key]['feature_icon']['features'] ) ? $atts['table']['content'][$row_key][$col_key]['feature_icon']['features'] : array();
						if( count( $features ) > 0 ):
					?>
				
					<!--
						Plan features
					-->
					<div class="table-row features">
					
						<ul>
							<?php foreach( $features as $feature ): ?>							
							<li><i class="fa <?php echo esc_attr( $feature['icon'] ); ?>" style="color: <?php echo esc_attr( $feature['icon_color'] ); ?>"></i> <?php echo wp_kses( $feature['feature_title'], $allowed_tags ); ?></li>
							<?php endforeach; ?>
						</ul>
					
					</div>
					<?php endif; ?>
				
				<?php elseif ($row['name'] === 'default-row'): ?>
				<!--
					Plan description
				-->
				<div class="table-row description"><?php echo wp_kses( $atts['table']['content'][$row_key][$col_key]['textarea'], $allowed_tags ); ?></div>
				<?php elseif ($row['name'] === 'button-row'): ?>
					<!--
						Buy button
					-->
					<?php $button = fw_ext( 'shortcodes' )->get_shortcode( 'button' ); ?>
					<div class="table-row table-button">
						<?php if ( false === empty( $atts['table']['content'][ $row_key ][ $col_key ]['button'] ) and false === empty($button) ) : ?>
							<?php echo $button->render($atts['table']['content'][ $row_key ][ $col_key ]['button']); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			
			<?php endforeach; ?>
		
		</li>
		<?php endforeach; ?>
	</ul>
</div>