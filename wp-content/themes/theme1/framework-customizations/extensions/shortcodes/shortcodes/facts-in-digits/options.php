<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'facts' => array(
		'title' => __( 'Facts In Digits', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => __( 'Facts In Digits', 'wplab-unicum' ),
				'popup-title'   => __( 'Add/Edit Fact', 'wplab-unicum' ),
				'desc'          => __( 'Add Fact', 'wplab-unicum' ),
				'template'      => '{{=title}}',
				'popup-options' => array(
					'icon_type' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'value' => array(
							'type' => 'no_icon',
						),
						'picker' => array(
							'type' => array(
								'label' => __( 'Icon Type', 'wplab-unicum' ),
								'type' => 'radio',
								'choices' => array(
									'no_icon' => __( 'No Icon', 'wplab-unicum' ),
									'library' => __( 'Choose from Icon Library', 'wplab-unicum' ),
									'custom' => __( 'Custom SVG Icon', 'wplab-unicum' ),
								),
							)
						),
						'choices' => array(
							'library' => array(
							
								'icon' => array(
									'type'  => 'icon',
									'value' => 'fa-trophy',
									'label' => __('Icon', 'wplab-unicum'),
								)
							
							),
							'custom' => array(
							
								'icon' => array(
								  'type'  => 'upload',
								  'label' => __('Upload icon file', 'fw'),
								  'images_only' => true,
								),
							
							),
						)
					),
					'title' => array(
						'type'  => 'text',
						'label' => __('Title', 'wplab-unicum')
					),
					'number' => array(
						'type'  => 'short-text',
						'label' => __('Number', 'wplab-unicum')
					),
				),
			),
		)
	),
	'styling' => array(
		'title' => __( 'Styling', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'cols' => array(
				'label' => __( 'Columns', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '3',
				'choices' => array(
					'1' => __( 'One', 'wplab-unicum' ),
					'2' => __( 'Two', 'wplab-unicum' ),
					'3' => __( 'Three', 'wplab-unicum' ),
					'4' => __( 'Four', 'wplab-unicum' ),
				),
			),
			'icon_color_1' => array(
				'label' => __('Icon first color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
			'icon_color_2' => array(
				'label' => __('Icon second color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
			'text_color' => array(
				'label' => __('Text color', 'wplab-unicum'),
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