<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'icon'       => array(
		'type' => 'icon',
		'label' => __( 'Icon', 'wplab-unicum' )
	),
	'title'    => array(
		'type'  => 'text',
		'label' => __( 'Title', 'wplab-unicum' ),
		'desc'  => __( 'Icon title', 'wplab-unicum' ),
	),
	'icon_start_color' => array(
		'label' => __('Icon Gradient Start Color', 'wplab-unicum'),
		'desc' => __('Select the custom icon start color', 'wplab-unicum'),
		'type' => 'color-picker',
	),
	'icon_end_color' => array(
		'label' => __('Icon Gradient End Color', 'wplab-unicum'),
		'desc' => __('Select the custom icon end color', 'wplab-unicum'),
		'type' => 'color-picker',
	),
	'title_color' => array(
		'label' => __('Title Custom Color', 'wplab-unicum'),
		'desc' => __('Select the custom title color', 'wplab-unicum'),
		'type' => 'color-picker',
	),
);