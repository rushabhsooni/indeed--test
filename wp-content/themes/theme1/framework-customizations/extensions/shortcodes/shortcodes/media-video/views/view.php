<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
 
$lazy_load = isset( $atts['lazy_load'] ) && filter_var( $atts['lazy_load'], FILTER_VALIDATE_BOOLEAN );

global $wp_embed;
$iframe = $wp_embed->run_shortcode( '[embed]' . esc_attr( trim( $atts['url'] ) ) . '[/embed]' );

if( $lazy_load ) {
	$youtube_id = wplab_unicum_media::getYouTubeVideoId( $atts['url'] );
	if( $youtube_id <> '' ):
?>
	<div class="lazy-video" data-youtube-id="<?php echo esc_attr( $youtube_id ); ?>" data-ratio="16:9"></div>
	<?php else: ?>
	<p><?php esc_html_e('Can not find YouTube video ID', 'wplab-unicum'); ?></p>
	<?php endif; ?>

<?php } else { ?>
<div class="responsive-video-wrapper">
	<?php echo do_shortcode( $iframe ); ?>
</div>
<?php }