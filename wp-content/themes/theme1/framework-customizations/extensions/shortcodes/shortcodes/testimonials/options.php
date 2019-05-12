<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'testimonials' => array(
		'title' => __( 'Testimonials', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => __( 'Testimonials', 'wplab-unicum' ),
				'popup-title'   => __( 'Add/Edit Testimonial', 'wplab-unicum' ),
				'desc'          => __( 'Add a testimonial', 'wplab-unicum' ),
				'template'      => '{{=name}}',
				'popup-options' => array(
					'avatar_photo' => array(
						'label' => __('Avatar Photo', 'wplab-unicum'),
						'type' => 'background-image',
					),
					'name' => array(
						'type'  => 'text',
						'label' => __('Name', 'wplab-unicum')
					),
					'text' => array(
						'type'  => 'textarea',
						'label' => __('Text', 'wplab-unicum')
					),
				),
			),
		)
	),
	'styling' => array(
		'title' => __( 'Styling', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'text_color' => array(
				'label' => __('Custom text color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
		)
	),
	'margins_paddings' => array(
		'title' => __( 'Margins and Paddings', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'margin_top' => array(
				'label' => __( 'Margin Top', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from top', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_right' => array(
				'label' => __( 'Margin Right', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from right', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_bottom' => array(
				'label' => __( 'Margin Bottom', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from bottom', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_left' => array(
				'label' => __( 'Margin Left', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from left', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_top' => array(
				'label' => __( 'Padding Top', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom top padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_right' => array(
				'label' => __( 'Padding Right', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom right padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_bottom' => array(
				'label' => __( 'Padding Bottom', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom bottom padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_left' => array(
				'label' => __( 'Padding Left', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom left padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
		)
	)
);