<?php if (!defined('FW')) die('Forbidden');
global $wplab_unicum_core;
/**
 * @var $atts The shortcode attributes
 */
$header_styles = $icon_styles = $text_styles = $line_styles = array();
 
$container_styles = '';
/**
 * Custom Styles
 **/
$container_styles .= wplab_unicum_utils::get_styles( array(
	'top_margin' 			=> isset( $atts['margin_top'] ) && $atts['margin_top'] <> '' ? $atts['margin_top'] : '',
	'right_margin' 		=> isset( $atts['margin_right'] ) && $atts['margin_right'] <> '' ? $atts['margin_right'] : '',
	'bottom_margin' 	=> isset( $atts['margin_bottom'] ) && $atts['margin_bottom'] <> '' ? $atts['margin_bottom'] : '',
	'left_margin' 		=> isset( $atts['margin_left'] ) && $atts['margin_left'] <> '' ? $atts['margin_left'] : '',
	'top_padding' 		=> isset( $atts['padding_top'] ) && $atts['padding_top'] <> '' ? $atts['padding_top'] : '',
	'right_padding' 	=> isset( $atts['padding_right'] ) && $atts['padding_right'] <> '' ? $atts['padding_right'] : '',
	'bottom_padding' 	=> isset( $atts['padding_bottom'] ) && $atts['padding_bottom'] <> '' ? $atts['padding_bottom'] : '',
	'left_padding' 		=> isset( $atts['padding_left'] ) && $atts['padding_left'] <> '' ? $atts['padding_left'] : '',
), '');

$allowed_tags = wp_kses_allowed_html( 'post' );
$uniqid = uniqid();

$icon_style = array();

$cols = isset( $atts['cols'] ) && is_numeric( $atts['cols'] ) ? $atts['cols'] : 3;

$col_class = '';

switch( $cols ) {
	case 1:
		$col_class = 'col-md-12';
	break;
	case 2:
		$col_class = 'col-md-6';
	break;
	case 3:
		$col_class = 'col-md-4';
	break;
}

if( isset( $atts['header_text_color'] ) && $atts['header_text_color'] <> '' ) {
	$header_styles[] = 'color: ' . esc_attr( $atts['header_text_color'] ) . ';';
	$line_styles[] = 'border-color: ' . esc_attr( $atts['header_text_color'] ) . ';';
}

if( isset( $atts['desc_text_color'] ) && $atts['desc_text_color'] <> '' ) {
	$text_styles[] = 'color: ' . esc_attr( $atts['desc_text_color'] ) . ';';
}

$header_styles = implode( ' ', $header_styles );
$text_styles = implode( ' ', $text_styles );

?>
<?php if( isset( $atts['items'] ) && count( $atts['items'] ) > 0 ): ?>
<div class="benefits" id="benefits-id-<?php echo $uniqid; ?>" style="<?php echo esc_attr( $container_styles ); ?>">

	<svg width="100" height="50" version="1.1" xmlns="http://www.w3.org/2000/svg">
		<style>
			#benefits-id-<?php echo $uniqid; ?> path {
				fill: url(#BenefitsIconsGradient<?php echo $uniqid; ?>)
			}
		</style>
		<defs>
			<linearGradient id="BenefitsIconsGradient<?php echo $uniqid; ?>" gradientTransform="rotate(-25)">
				<stop offset="0%" stop-color="<?php echo ( isset( $atts['icon_color_1'] ) && $atts['icon_color_1'] <> '') ? esc_attr( $atts['icon_color_1'] ) : '#ff9700'; ?>" />
				<stop offset="67%" stop-color="<?php echo ( isset( $atts['icon_color_2'] ) && $atts['icon_color_2'] <> '') ? esc_attr( $atts['icon_color_2'] ) : '#fecb16'; ?>" />
			</linearGradient>
		</defs>
	</svg>

	<div class="benefits-grid container-fluid style-<?php echo esc_attr( $atts['benefits_style'] ); ?>">
		
			<?php $count = count( $atts['items'] ); $i=0; foreach( $atts['items'] as $k=>$benefit ): $i++; ?>
			
			<?php if( $i == 1 ): ?>
			<div class="row">
			<?php endif; ?>
			
			<?php
				$link_title = isset( $benefit['link_title'] ) && filter_var( $benefit['link_title'], FILTER_VALIDATE_BOOLEAN );
				
				$icon_class = '';
				
				if( $benefit['icon_type']['type'] == '') {
				
				} elseif( $benefit['icon_type']['type'] == 'library' ) {
					$icon_class = $benefit['icon_type']['library']['icon'];
				} elseif( $benefit['icon_type']['type'] == 'custom' ) {

				}
			?>
			
			<div class="col <?php echo esc_attr( $col_class ); ?>">
			
				<!--
					Benefit item
				-->
				<div class="benefit-item type-<?php echo esc_attr( $benefit['icon_type']['type'] ); ?>">

					<?php if( $benefit['icon_type']['type'] == 'library' ): ?>
						<i class="benefit-icon <?php echo esc_attr( $icon_class ); ?>" style="<?php echo implode( ' ', $icon_style ); ?>"></i>
					<?php endif; ?>
					
					<?php if( $benefit['icon_type']['type'] == 'custom' ): ?>
						<img src="<?php echo esc_attr( $benefit['icon_type']['custom']['icon']['url'] ); ?>" class="image-svg" alt="" />
					<?php endif; ?>
					
					<!--
						Benefit text and description
					--> 											
					<div class="benefit-text">
						<?php if( isset( $benefit['title'] ) && $benefit['title'] <> '' ): ?>
						<h6 style="<?php echo esc_attr( $header_styles ); ?>">
							<?php if( $link_title ): ?><a href="<?php echo esc_attr( $benefit['read_more_link'] ); ?>"  style="<?php echo esc_attr( $header_styles ); ?>"><?php endif; ?>
							<?php echo wp_kses( $benefit['title'], $allowed_tags ); ?>
							<?php if( $link_title ): ?></a><?php endif; ?>
						</h6>
						<?php endif; ?>
						
						<div class="benefit-content-div" style="<?php echo esc_attr( $text_styles ); ?>">
							<?php echo apply_filters( 'the_content', $benefit['text'] ); ?>
						</div>
						
						<?php if( isset( $benefit['read_more_link'] ) && $benefit['read_more_link'] <> '' ): ?>
						<a href="<?php echo esc_attr( $benefit['read_more_link'] ); ?>" class="read-more" style="<?php echo esc_attr( $header_styles ); ?>">
							<span class="line_wrap">
								<span class="line" style="<?php echo esc_attr( implode( ' ', $line_styles ) ); ?>"></span><?php echo wp_kses( $benefit['read_more_link_text'], $allowed_tags ); ?>
							</span>
						</a>
						<?php endif; ?>
					</div>
					
				</div>
			
			</div>
			
			<?php if( $i == $cols || $i == $count ): ?>
			</div>
			<?php endif; if( $i == $cols ) { $i = 0; } ?>
			
			<?php endforeach; ?>
			
			<?php if( isset( $atts['header_hover_color'] ) && $atts['header_hover_color'] <> '' ): ?>
			<style>
				#benefits-id-<?php echo $uniqid; ?> .benefits-grid .benefit-item .read-more:hover, 
				#benefits-id-<?php echo $uniqid; ?> .benefits-grid .col:hover .benefit-item .benefit-text h6, 
				#benefits-id-<?php echo $uniqid; ?> .benefits-grid .col:hover .benefit-item .benefit-text h6 a, 
				#benefits-id-<?php echo $uniqid; ?> .benefits-grid .benefit-item .benefit-text h6 a:hover {
					color: <?php echo esc_attr( $atts['header_hover_color'] ); ?> !important;
				}
				#benefits-id-<?php echo $uniqid; ?> .benefits-grid .benefit-item .read-more span.line {
					border-color: <?php echo esc_attr( $atts['header_hover_color'] ); ?> !important;
				}
			</style>
			<?php endif; ?>

	</div>

</div>
<?php endif; 