<?php if (!defined('FW')) die('Forbidden');

global $wplab_unicum_core;

$_sliders_list = array(
	'' => __('- Select a slider -', 'wplab-unicum' ),
);

$sliders = array();

if( shortcode_exists('rev_slider') ) {
	$sliders = $wplab_unicum_core->model( 'slider' )->get_sliders();
}

if( !empty( $sliders ) ) {
	foreach( $sliders as $slider ) {
		$_sliders_list[ $slider->alias ] = $slider->title;
	}
}

$options = array(
	'slider_alias' => array(
		'label' => __( 'Choose a slider', 'wplab-unicum' ),
		'type' => 'select',
		'value' => '',
		'choices' => $_sliders_list,
		'desc' => __( 'Select one of created sliders', 'wplab-unicum' ),
	),
	'display_skip_slider' => array(
		'label' => __( 'Display "Skip slider" link', 'wplab-unicum' ),
		'type' => 'switch',
		'right-choice' => array(
			'value' => 'true',
			'label' => __( 'Yes', 'wplab-unicum' )
		),
		'left-choice' => array(
			'value' => 'false',
			'label' => __( 'No', 'wplab-unicum' )
		),
		'value' => 'false',
		'desc' => __( 'If enabled, an arrow link will be displayed at left bottom of slider', 'wplab-unicum' ),
	),
	'skip_slider_link_position' => array(
		'label' => __( '"Skip slider" link position', 'wplab-unicum' ),
		'type' => 'select',
		'value' => '',
		'choices' => array(
			'left' => __('Left', 'wplab-unicum' ),
			'center' => __('Center', 'wplab-unicum' ),
			'right' => __('Right', 'wplab-unicum' ),
		),
	),
);