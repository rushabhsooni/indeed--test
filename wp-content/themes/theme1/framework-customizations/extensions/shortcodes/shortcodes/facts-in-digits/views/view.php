<?php if (!defined('FW')) die('Forbidden');

global $wplab_unicum_core;

$allowed_tags = wp_kses_allowed_html( 'post' );

$text_styles = array();

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

$col_class = '';

$cols = isset( $atts['cols'] ) && is_numeric( $atts['cols'] ) ? $atts['cols'] : 3;

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
	case 4:
		$col_class = 'col-md-3';
	break;
}

if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
	$text_styles[] = 'color: ' . esc_attr( $atts['text_color'] ) . ';';
}

$text_styles = implode( ' ', $text_styles );

$uniqid = uniqid();

?>

<?php if( isset( $atts['items'] ) && count( $atts['items'] ) > 0 ): ?>
<!--
	Icons and digits
-->
<div id="facts-in-digits-id-<?php echo $uniqid; ?>" class="facts-in-digits" style="<?php echo esc_attr( $container_styles ); ?>">

	<svg width="100" height="50" version="1.1" xmlns="http://www.w3.org/2000/svg">
		<style>
			#facts-in-digits-id-<?php echo $uniqid; ?> path {
				fill: url(#FactsIconsGradient<?php echo $uniqid; ?>)
			}
		</style>
		<defs>
			<linearGradient id="FactsIconsGradient<?php echo $uniqid; ?>" gradientTransform="rotate(-25)">
				<stop offset="0%" stop-color="<?php echo ( isset( $atts['icon_color_1'] ) && $atts['icon_color_1'] <> '') ? esc_attr( $atts['icon_color_1'] ) : '#ff9700'; ?>" />
				<stop offset="67%" stop-color="<?php echo ( isset( $atts['icon_color_2'] ) && $atts['icon_color_2'] <> '') ? esc_attr( $atts['icon_color_2'] ) : '#fecb16'; ?>" />
			</linearGradient>
		</defs>
	</svg>

	<div class="container-fluid">
		<?php $count = count( $atts['items'] ); $i=0; foreach( $atts['items'] as $k=>$fact ): $i++; ?>
		
			<?php
				$icon_class = '';
				
				if( $fact['icon_type']['type'] == '') {
				
				} elseif( $fact['icon_type']['type'] == 'library' ) {
					$icon_class = $fact['icon_type']['library']['icon'];
				} elseif( $fact['icon_type']['type'] == 'custom' ) {

				}
			?>
		
			<?php if( $i == 1 ): ?>
			<div class="row">
			<?php endif; ?>
			
			<div class="col <?php echo esc_attr( $col_class ); ?>">

				<!-- Icon -->
				<?php if( $fact['icon_type']['type'] == 'library' ): ?>
					<i class="benefit-icon <?php echo esc_attr( $icon_class ); ?>" style="<?php echo implode( ' ', $icon_style ); ?>"></i>
				<?php endif; ?>
				
				<?php if( $fact['icon_type']['type'] == 'custom' ): ?>
					<img src="<?php echo esc_attr( $fact['icon_type']['custom']['icon']['url'] ); ?>" class="image-svg" alt="" />
				<?php endif; ?>

				<?php if( isset( $fact['number'] ) && is_numeric( $fact['number'] ) ): ?>
				<!-- Animated number -->
				<div class="num wow animationNuminate" data-to="<?php echo esc_attr( $fact['number'] ); ?>" style="<?php echo esc_attr( $text_styles ); ?>">0</div>
				<?php endif; ?>
				
				<?php if( isset( $fact['title'] ) && $fact['title'] <> '' ): ?>
				<!-- Description -->
				<div class="text" style="<?php echo esc_attr( $text_styles ); ?>"><?php echo wp_kses( $fact['title'], $allowed_tags ); ?></div>
				<?php endif; ?>

			</div>

			<?php if( $i == $cols || $i == $count ): ?>
			</div>
			<?php endif; if( $i == $cols ) { $i = 0; } ?>
			
		<?php endforeach; ?>
		
	</div>
</div>
<?php endif; 