<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_title_styles = $css_text_styles = $css_box_styles = array();

$uniqid = uniqid();

/**
 * @var array $atts
 */

if( isset( $atts['title_color'] ) && $atts['title_color'] <> '' ) {
	$css_title_styles[] = 'color: ' . $atts['title_color'] . ';';
}

if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
	$css_text_styles[] = 'color: ' . $atts['text_color'] . ';';
}

if( isset( $atts['box_border_color'] ) && $atts['box_border_color'] <> '' ) {
	$css_box_styles[] = 'border-color: ' . $atts['box_border_color'] . ';';
}

if( isset( $atts['box_bg_color'] ) && $atts['box_bg_color'] <> '' ) {
	$css_box_styles[] = 'background-color: ' . $atts['box_bg_color'] . ';';
}
 
?>
<?php
/*
 * `.fw-iconbox` supports 3 styles:
 * `fw-iconbox-1`, `fw-iconbox-2` and `fw-iconbox-3`
 */
?>
<div id="iconbox-id-<?php echo $uniqid; ?>" class="fw-iconbox clearfix <?php echo esc_attr($atts['style']); ?>" style="<?php echo esc_attr( implode( ' ', $css_box_styles ) ); ?>">
	<div class="fw-iconbox-image">
		<i class="<?php echo esc_attr($atts['icon']); ?>"></i>
	</div>
	<div class="fw-iconbox-aside">
		<div class="fw-iconbox-title">
			<h3 style="<?php echo esc_attr( implode( ' ', $css_title_styles ) ); ?>"><?php echo esc_html( $atts['title'] ); ?></h3>
		</div>
		<div class="fw-iconbox-text">
			<p style="<?php echo esc_attr( implode( ' ', $css_text_styles ) ); ?>"><?php echo strip_tags( $atts['content'] ); ?></p>
		</div>
	</div>
</div>

<?php
	if( isset( $atts['icon_start_color'] ) && $atts['icon_start_color'] <> '' ):
		$start_color = esc_attr( $atts['icon_start_color'] );
		$end_color = esc_attr( $atts['icon_end_color'] ); 
?>
<style>
	#iconbox-id-<?php echo $uniqid; ?> .fw-iconbox-image i.fa {
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