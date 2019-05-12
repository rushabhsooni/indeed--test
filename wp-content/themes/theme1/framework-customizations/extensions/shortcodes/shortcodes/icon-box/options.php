<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'style'   => array(
		'type'    => 'select',
		'label'   => __('Box Style', 'wplab-unicum'),
		'choices' => array(
			'fw-iconbox-1' => __('Icon above title', 'wplab-unicum'),
			'fw-iconbox-2' => __('Icon in line with title', 'wplab-unicum')
		)
	),
	'icon'    => array(
		'type'  => 'icon',
		'label' => __('Choose an Icon', 'wplab-unicum'),
	),
	'title'   => array(
		'type'  => 'text',
		'label' => __( 'Title of the Box', 'wplab-unicum' ),
	),
	'content' => array(
		'type'  => 'textarea',
		'label' => __( 'Content', 'wplab-unicum' ),
		'desc'  => __( 'Enter the desired content', 'wplab-unicum' ),
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
	'text_color' => array(
		'label' => __('Text Custom Color', 'wplab-unicum'),
		'desc' => __('Select the custom text color', 'wplab-unicum'),
		'type' => 'color-picker',
	),
	'box_border_color' => array(
		'label' => __('Box Border Custom Color', 'wplab-unicum'),
		'desc' => __('Select the custom color for the box border', 'wplab-unicum'),
		'type' => 'color-picker',
	),
	'box_bg_color' => array(
		'label' => __('Box Background Custom Color', 'wplab-unicum'),
		'desc' => __('Select the custom background color for the box', 'wplab-unicum'),
		'type' => 'color-picker',
	),
);