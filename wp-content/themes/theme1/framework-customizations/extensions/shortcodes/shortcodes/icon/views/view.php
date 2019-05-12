<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_title_styles = array();

$uniqid = uniqid();

/**
 * @var array $atts
 */

if( isset( $atts['title_color'] ) && $atts['title_color'] <> '' ) {
	$css_title_styles[] = 'color: ' . $atts['title_color'] . ';';
}
 
?>
<span id="icon-id-<?php echo $uniqid; ?>" class="fw-icon">
	<i class="<?php echo esc_attr($atts['icon']); ?>"></i>
	<?php if (!empty($atts['title'])): ?>
		<br/>
		<span class="list-title" style="<?php echo esc_attr( implode( ' ', $css_title_styles ) ); ?>"><?php echo esc_html( $atts['title'] ); ?></span>
	<?php endif; ?>
</span>

<?php
	if( isset( $atts['icon_start_color'] ) && $atts['icon_start_color'] <> '' ):
		$start_color = esc_attr( $atts['icon_start_color'] );
		$end_color = esc_attr( $atts['icon_end_color'] ); 
?>
<style>
	#icon-id-<?php echo $uniqid; ?> i.fa {
		background: <?php echo $start_color; ?>;
		background: -moz-linear-gradient(45deg, <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%);
		background: -webkit-gradient(left bottom, right top, color-stop(0%, <?php echo $start_color; ?>), color-stop(100%, <?php echo $end_color; ?>));
		background: -webkit-linear-gradient(45deg, <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%);
		background: -o-linear-gradient(45deg, <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%);
		background: -ms-linear-gradient(45deg, <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%);
		background: linear-gradient(45deg, <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%);
		filter: e(%("progid:DXImageTransform.Microsoft.gradient(startColorstr='%d', endColorstr='%d', GradientType=1)",<?php echo $start_color; ?>,<?php echo $end_color; ?>));
	  -webkit-background-clip: text;
	  -webkit-text-fill-color: transparent;
	}
</style>
<?php endif;