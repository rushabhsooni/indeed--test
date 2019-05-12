<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
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

if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
	$text_styles[] = 'color: ' . esc_attr( $atts['text_color'] ) . ';';
}

$allowed_tags = wp_kses_allowed_html( 'post' );
$uniqid = uniqid();
?>
<?php if( isset( $atts['items'] ) && count( $atts['items'] ) > 0 ): ?>
<div class="testimonials-carousel owl-carousel" style="<?php echo esc_attr( $container_styles ); ?>">

	<!--
		Testimonial item
	-->
	<?php foreach( $atts['items'] as $k=>$testimonial ): ?>
	<div class="item <?php echo isset( $testimonial['avatar_photo']['data']['icon'] ) && $testimonial['avatar_photo']['data']['icon'] <> '' ? 'with-thumbs' : ''; ?>">
		<div class="text" style="<?php echo implode( ' ', $text_styles ); ?>">
			<?php echo apply_filters( 'the_content', $testimonial['text'] ); ?>
		</div>
		<div class="author" style="<?php echo implode( ' ', $text_styles ); ?>">
			<?php if( isset( $testimonial['avatar_photo']['data']['icon'] ) && $testimonial['avatar_photo']['data']['icon'] <> '' ): ?>
				<?php echo wplab_unicum_media::image( $testimonial['avatar_photo']['data']['icon'], 70, 70, true, true, 'full' ); ?>
			<?php endif; ?>
			<div class="author-name">
				<?php echo wp_kses( $testimonial['name'], $allowed_tags ); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

</div>
<?php endif; 