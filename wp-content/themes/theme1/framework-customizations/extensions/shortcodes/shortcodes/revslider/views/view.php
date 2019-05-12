<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */

$alias = $atts['slider_alias'];
$display_skip_slider = filter_var( $atts['display_skip_slider'], FILTER_VALIDATE_BOOLEAN );
$skip_slider_position = esc_attr( $atts['skip_slider_link_position'] );

echo '<div class="wproto-slider-container skip-link-position-' . $skip_slider_position . '">';
echo do_shortcode( '[rev_slider alias="' . $alias . '"]' );

if( $display_skip_slider ) {
	echo '<a href="javascript:;" class="skip-slider"></a>';
}

echo '</div>';