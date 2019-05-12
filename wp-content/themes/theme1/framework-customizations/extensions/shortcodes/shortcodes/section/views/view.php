<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_classes = $atttibutes = array();
$main_row_style = $main_row_id = '';

/**
 * Custom background image
 **/
if( !isset( $atts['section_effects']['effect'] ) || $atts['section_effects']['effect'] != 'parallax' ) {
	
	if( isset( $atts['background_color'] ) && $atts['background_color'] <> '' ) {
		$main_row_style .= 'background-color: ' . $atts['background_color'] . '; ';
	}
	
	if( !empty( $atts['background_image']['data']['css'] ) && $atts['background_image']['data']['css']['background-image'] <> '' ) {
		$main_row_style .= 'background-image: ' . $atts['background_image']['data']['css']['background-image'] . '; ';
	}
	
	if( isset( $atts['background_repeat'] ) && $atts['background_repeat'] <> '' ) {
		$main_row_style .= 'background-repeat: ' . $atts['background_repeat'] . '; ';
	}
	
	if( isset( $atts['background_position'] ) && $atts['background_position'] <> '' ) {
		$main_row_style .= 'background-position: ' . $atts['background_position'] . '; ';
	}
	
	if( isset( $atts['background_cover'] ) && filter_var( $atts['background_cover'], FILTER_VALIDATE_BOOLEAN ) ) {
		$main_row_style .= 'background-size: cover; ';
	}
	
	if( ( isset( $atts['background_gradient_color_start'] ) && $atts['background_gradient_color_start'] <> '') && ( isset( $atts['background_gradient_color_end'] ) && $atts['background_gradient_color_end'] <> '') ) {
		$start_color = esc_attr( $atts['background_gradient_color_start'] );
		$end_color = esc_attr( $atts['background_gradient_color_end'] );
		$main_row_style .= '
			background: -moz-linear-gradient(45deg, ' . $start_color . ' 0%, ' . $end_color . ' 100%);
			background: -webkit-gradient(left bottom, right top, color-stop(0%, ' . $start_color . '), color-stop(100%, ' . $end_color . '));
			background: -webkit-linear-gradient(45deg, ' . $start_color . ' 0%, ' . $end_color . ' 100%);
			background: -o-linear-gradient(45deg, ' . $start_color . ' 0%, ' . $end_color . ' 100%);
			background: -ms-linear-gradient(45deg, ' . $start_color . ' 0%, ' . $end_color . ' 100%);
			background: linear-gradient(45deg, ' . $start_color . ' 0%, ' . $end_color . ' 100%);
			filter: e(%("progid:DXImageTransform.Microsoft.gradient(startColorstr=\'%d\', endColorstr=\'%d\', GradientType=1)",' . $start_color . ',' . $end_color . '));
		';
	}
	
}


/**
 * Custom ID
 **/
if( isset( $atts['section_id'] ) && $atts['section_id'] <> '' ) {
	$main_row_id = $atts['section_id'];
}

/**
 * Custom CSS Classes
 **/
if( isset( $atts['section_class'] ) && $atts['section_class'] <> '' ) {
	$css_classes[] = esc_attr( $atts['section_class'] );
}

if( isset( $atts['hide_bg_large_screens'] ) && filter_var( $atts['hide_bg_large_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-lg';
}

if( isset( $atts['hide_bg_medium_screens'] ) && filter_var( $atts['hide_bg_medium_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-md';
}

if( isset( $atts['hide_bg_small_screens'] ) && filter_var( $atts['hide_bg_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-sm';
}

if( isset( $atts['hide_bg_estra_small_screens'] ) && filter_var( $atts['hide_bg_estra_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-xs';
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
$main_row_style .= wplab_unicum_utils::get_styles( array(
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

/**
 * 	Stretch class
 **/
if( isset( $atts['container_stretch'] ) && $atts['container_stretch'] <> '' ) {
	$css_classes[] = $atts['container_stretch'];
}

/**
 * Is Full-width container
 **/
$sidebar_position = fw_ext_sidebars_get_current_position();

$p_tpl = basename( get_page_template() );
if( $p_tpl == 'page-template-custom.php' ) {
	$sidebar_position = 'full';
}

$container_class = ( isset( $atts['container_stretch'] ) && ( $atts['container_stretch'] == 'stretch_row_content' || $atts['container_stretch'] == 'stretch_row_content_no_paddings' ) ) || ( !is_null( $sidebar_position ) && $sidebar_position !== 'full' ) ? 'container-fluid' : 'container';

/**
 * Is Full-height row
 **/
if( isset( $atts['is_fullheight'] ) && filter_var( $atts['is_fullheight'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'full-height';
}

/**
 * Section effects
 **/
if( isset( $atts['section_effects']['effect'] ) && $atts['section_effects']['effect'] <> '' ) {
	
	/**
	 * Parallax Background Effect
	 **/
	if( $atts['section_effects']['effect'] == 'parallax' ) {
		$parallax_speed = $atts['section_effects']['parallax']['parallax_speed'] <> '' ? $atts['section_effects']['parallax']['parallax_speed'] : '0.2';
		$parallax_bg = isset( $atts['background_image']['data']['icon'] ) ? $atts['background_image']['data']['icon'] : '';
		
		if( $parallax_bg <> '' ) {
			$css_classes[] = 'parallax-section';
			$atttibutes[] = 'data-parallax="scroll"';
			$atttibutes[] = 'data-speed="' . esc_attr( $parallax_speed ) . '"';
			$atttibutes[] = 'data-image-src="' . esc_attr( $parallax_bg ) . '"';
		}
	}
	
	/**
	 * YouTube Video Background Effect
	 **/
	if( $atts['section_effects']['effect'] == 'video' ) {
		$css_classes[] = 'video-bg-section';
		$atttibutes[] = 'data-video-id="' . esc_attr( wplab_unicum_media::getYouTubeVideoId( $atts['section_effects']['video']['video'] ) ) . '"';
		$atttibutes[] = 'data-video-pause-scroll="' . esc_attr( $atts['section_effects']['video']['video_pause_on_scroll'] ) . '"';
		$atttibutes[] = 'data-video-mute="' . esc_attr( $atts['section_effects']['video']['video_mute'] ) . '"';
	}
	
}
?>
<div id="<?php echo esc_attr( $main_row_id ); ?>" class="fw-main-row <?php echo implode( ' ', $css_classes ); ?>" <?php echo implode( ' ', $atttibutes ); ?> style="<?php echo esc_attr( $main_row_style ); ?>">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
