<?php
/**
 * Config
 **/
// Supported of CSS animations list
global $wplab_unicum_animations;
$wplab_unicum_animations = array(
	'bounce' => __('Bounce', 'wplab-unicum'),
	'flash' => __('Flash', 'wplab-unicum'),
	'pulse' => __('Pulse', 'wplab-unicum'),
	'shake' => __('Shake', 'wplab-unicum'),
	'swing' => __('Swing', 'wplab-unicum'),
	'tada' => __('Tada', 'wplab-unicum'),
	'wobble' => __('Wobble', 'wplab-unicum'),
	'bounceIn' => __('Bounce In', 'wplab-unicum'),
	'bounceInDown' => __('Bounce In Down', 'wplab-unicum'),
	'bounceInLeft' => __('Bounce In Left', 'wplab-unicum'),
	'bounceInRight' => __('Bounce In Right', 'wplab-unicum'),
	'bounceInUp' => __('Bounce In Up', 'wplab-unicum'),
	'fadeIn' => __('Fade In', 'wplab-unicum'),
	'fadeInDown' => __('Fade In Down', 'wplab-unicum'),
	'fadeInDownBig' => __('Fade In Down Big', 'wplab-unicum'),
	'fadeInLeft' => __('Fade In Left', 'wplab-unicum'),
	'fadeInLeftBig' => __('Fade In Left Big', 'wplab-unicum'),
	'fadeInRight' => __('Fade In Right', 'wplab-unicum'),
	'fadeInRightBig' => __('Fade In Right Big', 'wplab-unicum'),
	'fadeInUp' => __('Fade In Up', 'wplab-unicum'),
	'fadeInUpBig' => __('Fade In Up Big', 'wplab-unicum'),
	'flip' => __('Flip', 'wplab-unicum'),
	'flipInX' => __('Flip in X', 'wplab-unicum'),
	'flipInY' => __('Flip in Y', 'wplab-unicum'),
	'lightSpeedX' => __('Light Speed X', 'wplab-unicum'),
	'slideInDown' => __('Slide In Down', 'wplab-unicum'),
	'slideInLeft' => __('Slide In Left', 'wplab-unicum'),
	'slideInRight' => __('Slide In Right', 'wplab-unicum'),
	'rollIn' => __('Roll In', 'wplab-unicum'),
	'zoomIn' => __('Zoom In', 'wplab-unicum'),
	'zoomInDown' => __('Zoom In Down', 'wplab-unicum'),
	'zoomInRight' => __('Zoom In Right', 'wplab-unicum'),
	'zoomInLeft' => __('Zoom In Left', 'wplab-unicum'),
	'zoomInUp' => __('Zoom In Up', 'wplab-unicum'),
);

// CSS styles config
global $wplab_unicum_styles;

$wplab_unicum_styles = array(
	'fonts' => array (
		'type' => 'section',
		'label' => __('Theme Fonts', 'wplab-unicum'),
		'options' => array(
		
			'primary_font' => array(
				'label' => __('Primary font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '1.6',
					'font_size_mobile' => '1.6',
					'line_height' => '24',
					'line_height_mobile' => '24',
					'font_style' => 'normal',
					'font_weight' => '300',
					'text_transform' => 'none',
					'font_variant' => 'normal',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h1_font' => array(
				'label' => __('H1 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '7.2',
					'font_size_mobile' => '4.8',
					'line_height' => '80',
					'line_height_mobile' => '56',
					'font_style' => 'normal',
					'font_weight' => '300',
					'text_transform' => 'none',
					'font_variant' => 'normal',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h2_font' => array(
				'label' => __('H2 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '6.6',
					'font_size_mobile' => '3.0',
					'line_height' => '74',
					'line_height_mobile' => '38',
					'font_style' => 'normal',
					'font_weight' => '300',
					'text_transform' => 'none',
					'font_variant' => 'normal',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h3_font' => array(
				'label' => __('H3 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '5.6',
					'font_size_mobile' => '2.4',
					'line_height' => '64',
					'line_height_mobile' => '32',
					'font_style' => 'normal',
					'font_weight' => '300',
					'text_transform' => 'none',
					'font_variant' => 'normal',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h4_font' => array(
				'label' => __('H4 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '4.8',
					'font_size_mobile' => '2.4',
					'line_height' => '56',
					'line_height_mobile' => '32',
					'font_style' => 'normal',
					'font_weight' => '300',
					'text_transform' => 'none',
					'font_variant' => 'normal',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h5_font' => array(
				'label' => __('H5 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '3.6',
					'font_size_mobile' => '2.4',
					'line_height' => '32',
					'line_height_mobile' => '32',
					'font_style' => 'normal',
					'font_weight' => '600',
					'text_transform' => 'none',
					'font_variant' => 'small-caps',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
			'h6_font' => array(
				'label' => __('H6 font', 'wplab-unicum'),
				'type' => 'font_picker',
				'value' => array(
					'font_size' => '2.4',
					'font_size_mobile' => '2.4',
					'line_height' => '32',
					'line_height_mobile' => '32',
					'font_style' => 'normal',
					'font_weight' => '600',
					'text_transform' => 'none',
					'font_variant' => 'small-caps',
					'font_family_type' => 'system',
					'font_family' => '',
				)
			),
			
		)
	),
	'accent_colors' => array (
		'type' => 'section',
		'label' => __('Accent Colors', 'wplab-unicum'),
		'options' => array(
		
			'color_accent_green' => array(
				'label' => __('Accent green color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#b1d750'
			),
			'color_accent_orange' => array(
				'label' => __('Accent orange color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ff9700'
			),
			'color_accent_yellow' => array(
				'label' => __('Accent yellow color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#fecb16'
			),
			'color_accent_blue' => array(
				'label' => __('Accent blue color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#00bff3'
			),
			'color_accent_purple' => array(
				'label' => __('Accent purple color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#6739b6'
			),
			'color_accent_green_alt' => array(
				'label' => __('Accent green alt color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#8dc63f'
			),
			'color_accent_pink' => array(
				'label' => __('Accent pink color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#e91d62'
			),
			'color_accent_gray' => array(
				'label' => __('Accent grey color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#cdcfd7'
			),
			'color_accent_black' => array(
				'label' => __('Accent black color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#111111'
			),
			'color_accent_red' => array(
				'label' => __('Accent red color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#f04e4e'
			),
			'color_accent_turquoise' => array(
				'label' => __('Accent turquoise color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#1cbbb4'
			),
			'color_accent_violet' => array(
				'label' => __('Accent violet color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#9c26b0'
			),
			'color_accent_pink_alt' => array(
				'label' => __('Accent pink alt color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#f06eaa'
			),
			'color_accent_inner' => array(
				'label' => __('Accent inner color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
		)
	),
	'header' => array (
		'type' => 'section',
		'label' => __('Header', 'wplab-unicum'),
		'options' => array(
		
			'header_bg' => array(
				'label' => __('Header background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#141414'
			),
			'header_menu_top_links' => array(
				'label' => __('Menu top links color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'header_menu_top_active' => array(
				'label' => __('Menu top links active color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#b1d750'
			),
			'header_submenu_bg' => array(
				'label' => __('Sub Menu background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#111111'
			),
			'header_submenu_active_link_color' => array(
				'label' => __('Sub Menu active link color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'header_submenu_active_link_bg' => array(
				'label' => __('Sub Menu active link background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#b1d750'
			),
			'header_bg_image' => array(
				'label' => __('Header background image', 'wplab-unicum'),
				'type' => 'bg_picker',
				'value' => array(
					'background_image' => '',
					'background_repeat' => 'no-repeat',
					'background_position' => 'left top',
					'background_size' => '100% 100%',
					'background_fixed' => 'no'
				)
			),
		
		)
	),
	'content' => array (
		'type' => 'section',
		'label' => __('Content', 'wplab-unicum'),
		'options' => array(
		
			'bg_body' => array(
				'label' => __('Body background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#fafafa'
			),
			'bg_alter' => array(
				'label' => __('Body alter background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'bg_alter_2' => array(
				'label' => __('Body third background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#f9f9f9'
			),
			'color_primary_text' => array(
				'label' => __('Text color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#636363'
			),
			'color_alt_text' => array(
				'label' => __('Alt text color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#acacac'
			),
			'color_white_text' => array(
				'label' => __('White text color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'color_headers_text' => array(
				'label' => __('Headers color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#111111'
			),
			'color_blockquote_icon' => array(
				'label' => __('Blockquote icon color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#f2f2f2'
			),
			'color_placeholder' => array(
				'label' => __('Placeholder color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#c2c2c2'
			),
			'color_borders' => array(
				'label' => __('Borders color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#c2c2c2'
			),
			'color_icons' => array(
				'label' => __('Icons color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#c2c2c2'
			),
			'color_borders_light' => array(
				'label' => __('Light borders color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ebebeb'
			),
			'content_bg_image' => array(
				'label' => __('Content background image', 'wplab-unicum'),
				'type' => 'bg_picker',
				'value' => array(
					'background_image' => '',
					'background_repeat' => 'no-repeat',
					'background_position' => 'left top',
					'background_size' => '100% 100%',
					'background_fixed' => 'no'
				)
			),
		)
	),
	'footer' => array (
		'type' => 'section',
		'label' => __('Footer', 'wplab-unicum'),
		'options' => array(
		
			'footer_bg' => array(
				'label' => __('Footer background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#141414'
			),
			'footer_bottom_bar_bg' => array(
				'label' => __('Footer bottom bar background color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#111111'
			),
			'footer_text_color' => array(
				'label' => __('Footer text color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#363636'
			),
			'footer_link_color' => array(
				'label' => __('Footer link color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'footer_alt_text_color' => array(
				'label' => __('Footer alt text color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#434343'
			),
			'footer_headers_color' => array(
				'label' => __('Footer headers color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'footer_placeholder_color' => array(
				'label' => __('Footer placeholder color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'footer_border_color' => array(
				'label' => __('Footer border color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#434343'
			),
			'footer_border_alt_color' => array(
				'label' => __('Footer border alt color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'footer_icon_color' => array(
				'label' => __('Footer icons color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#434343'
			),
			'footer_icon_hover_color' => array(
				'label' => __('Footer icons hover color', 'wplab-unicum'),
				'type' => 'color_picker',
				'value' => '#ffffff'
			),
			'footer_bg_image' => array(
				'label' => __('Footer background image', 'wplab-unicum'),
				'type' => 'bg_picker',
				'value' => array(
					'background_image' => '',
					'background_repeat' => 'no-repeat',
					'background_position' => 'left top',
					'background_size' => '100% 100%',
					'background_fixed' => 'no'
				)
			),
			'bottom_bar_bg_image' => array(
				'label' => __('Bottom bar background image', 'wplab-unicum'),
				'type' => 'bg_picker',
				'value' => array(
					'background_image' => '',
					'background_repeat' => 'no-repeat',
					'background_position' => 'left top',
					'background_size' => '100% 100%',
					'background_fixed' => 'no'
				)
			),
			
		)
	),
);