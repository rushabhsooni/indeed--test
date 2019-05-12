<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
 
$style = array();

if( isset( $atts['custom_color'] ) && $atts['custom_color'] <> '' ) {
	$style[] = 'color: ' . esc_attr( $atts['custom_color'] ) . ' !important;';
}

$unique_id = uniqid();

?>
<div id="shortcode-play-video-id-<?php echo $unique_id; ?>" class="shortcode-play-video">
	<?php if( isset( $atts['video_html_before'] ) && $atts['video_html_before'] <> '' ): ?>
		<?php echo apply_filters( 'the_content', $atts['video_html_before'] ); ?>
	<?php endif; ?>
	<?php if( isset( $atts['video_url'] ) && $atts['video_url'] <> '' ): ?>
		<a href="<?php echo esc_attr( $atts['video_url'] ); ?>" class="button-video-play lightbox wow wobble" data-wow-delay="0.2s"></a>
	<?php endif; ?>
	<div class="video-description"><?php echo isset( $atts['video_title'] ) && $atts['video_title'] <> '' ? esc_attr( $atts['video_title'] ) . '<br/>' : ''; ?><?php echo isset( $atts['video_subtitle'] ) && $atts['video_subtitle'] <> '' ? esc_attr( $atts['video_subtitle'] ) : ''; ?></div>
</div>
<?php if( !empty( $style ) ): ?>
<style type="text/css">
	#shortcode-play-video-id-<?php echo $unique_id; ?> * {
		<?php echo implode( ' ', $style ); ?>
	}
</style>
<?php endif; 