<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'benefits' => array(
		'title' => __( 'Benefits', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => __( 'Benefits', 'wplab-unicum' ),
				'popup-title'   => __( 'Add/Edit Benefit', 'wplab-unicum' ),
				'desc'          => __( 'Add Benefit', 'wplab-unicum' ),
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
								  'label' => __('Upload icon file', 'visual'),
								  'images_only' => true,
								),
							
							),
						)
					),
					'title' => array(
						'type'  => 'text',
						'label' => __('Title', 'wplab-unicum')
					),
					'text' => array(
						'type'  => 'textarea',
						'label' => __('Text', 'wplab-unicum')
					),
					'read_more_link' => array(
						'type'  => 'text',
						'label' => __('"Read more" link (optional)', 'wplab-unicum')
					),
					'read_more_link_text' => array(
						'type'  => 'text',
						'label' => __('"Read more" custom text (optional)', 'wplab-unicum'),
						'value' => __( 'Read more', 'wplab-unicum')
					),
					'link_title' => array(
						'label' => __('Link title to "Read more" link', 'wplab-unicum'),
						'type' => 'switch',
						'right-choice' => array(
							'value' => 'true',
							'label' => __( 'Yes', 'wplab-unicum' )
						),
						'left-choice' => array(
							'value' => 'false',
							'label' => __( 'No', 'wplab-unicum' )
						),
						'value' => 'true',
					),
				),
			),
		)
	),
	'styling' => array(
		'title' => __( 'Styling', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'benefits_style' => array(
				'label' => __( 'Benefits Style', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'default' => __( 'Default', 'wplab-unicum' ),
					'with_borders' => __( 'With borders', 'wplab-unicum' ),
				),
			),
			'cols' => array(
				'label' => __( 'Columns', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '3',
				'choices' => array(
					'1' => __( 'One', 'wplab-unicum' ),
					'2' => __( 'Two', 'wplab-unicum' ),
					'3' => __( 'Three', 'wplab-unicum' ),
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
			'header_text_color' => array(
				'label' => __('Custom header and link color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
			'header_hover_color' => array(
				'label' => __('Custom header and link hover color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
			'desc_text_color' => array(
				'label' => __('Custom description text color', 'wplab-unicum'),
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