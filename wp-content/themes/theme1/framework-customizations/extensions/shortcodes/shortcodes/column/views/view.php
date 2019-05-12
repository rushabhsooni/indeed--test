<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_classes = $atttibutes = array();

$col_style = '';

/**
 * Custom CSS Classes
 **/
$css_classes[] = 'grid-column';
if( isset( $atts['column_class'] ) && $atts['column_class'] <> '' ) {
	$css_classes[] = esc_attr( $atts['column_class'] );
}

if( isset( $atts['hide_lg'] ) && filter_var( $atts['hide_lg'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-lg';
}

if( isset( $atts['hide_md'] ) && filter_var( $atts['hide_md'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-md';
}

if( isset( $atts['hide_sm'] ) && filter_var( $atts['hide_sm'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-sm';
}

if( isset( $atts['hide_xs'] ) && filter_var( $atts['hide_xs'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-xs';
}

/**
 * Custom Styles
 **/
$col_style .= wplab_unicum_utils::get_styles( array(
	'top_margin' 			=> isset( $atts['margin_top'] ) && $atts['margin_top'] <> '' ? $atts['margin_top'] : '',
	'right_margin' 		=> isset( $atts['margin_right'] ) && $atts['margin_right'] <> '' ? $atts['margin_right'] : '',
	'bottom_margin' 	=> isset( $atts['margin_bottom'] ) && $atts['margin_bottom'] <> '' ? $atts['margin_bottom'] : '',
	'left_margin' 		=> isset( $atts['margin_left'] ) && $atts['margin_left'] <> '' ? $atts['margin_left'] : '',
	'top_padding' 		=> isset( $atts['padding_top'] ) && $atts['padding_top'] <> '' ? $atts['padding_top'] : '',
	'right_padding' 	=> isset( $atts['padding_right'] ) && $atts['padding_right'] <> '' ? $atts['padding_right'] : '',
	'bottom_padding' 	=> isset( $atts['padding_bottom'] ) && $atts['padding_bottom'] <> '' ? $atts['padding_bottom'] : '',
	'left_padding' 		=> isset( $atts['padding_left'] ) && $atts['padding_left'] <> '' ? $atts['padding_left'] : '',
), '');

/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'wow';
	$css_classes[] = $atts['animation']['true']['effect'];
	$atttibutes[] = 'data-wow-delay="' . esc_attr( $atts['animation']['true']['animation_delay'] ) . '"';
}

$class = fw_ext_builder_get_item_width( 'page-builder', $atts['width'] . '/frontend_class' );
?>
<div class="<?php echo esc_attr( $class ); ?> <?php echo implode( ' ', $css_classes ); ?>" <?php echo implode( ' ', $atttibutes ); ?> style="<?php echo esc_attr( $col_style ); ?>">
	<?php echo do_shortcode( $content ); ?>
</div>
