<?php 

global $wplab_unicum_animations;

$options = array(

	array(
		'styling' => array(
			'title' => __( 'Styling', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
				
				'animation' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => __( 'Animate this section?', 'wplab-unicum' ),
							'desc' => __('Using CSS animation', 'wplab-unicum'),
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
						)
					),
					'choices' => array(
						'true' => array(

							'effect' => array(
								'label' => __( 'Choose animation effect', 'wplab-unicum' ),
								'type' => 'select',
								'value' => '',
								'choices' => array(
									array (
										'attr' => array(
											'label' => __( 'Animate.css Library', 'wplab-unicum' ),
										),
										'choices' => $wplab_unicum_animations,
									),
								),
							),

							'animation_delay' => array(
								'label' => __('Animation delay', 'wplab-unicum'),
								'desc' => __('For example: 0.3s', 'wplab-unicum'),
								'type' => 'text',
							),

						),
					),
					'show_borders' => false,
				),
			
			)
		),
		'attributes' => array(
			'title' => __( 'Attributes', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
				
				'column_class' => array(
					'label' => __('Custom CSS Classes', 'wplab-unicum'),
					'type' => 'text',
					'desc' => __('For example: my-custom-class', 'wplab-unicum'),
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
		),
		'responsiveness' => array(
			'title' => __( 'Responsiveness', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
			
				'hide_lg' => array(
					'label' => __('Hide at Large Desktops', 'wplab-unicum'),
					'desc' => __('Switch to "Yes" if you need to hide this section at large desktops (1200px and up)', 'wplab-unicum'),
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
				),
				'hide_md' => array(
					'label' => __('Hide at Medium Devices', 'wplab-unicum'),
					'desc' => __('Switch to "Yes" if you need to hide this section at Medium devices (desktops)', 'wplab-unicum'),
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
				),
				'hide_sm' => array(
					'label' => __('Hide at Tablets', 'wplab-unicum'),
					'desc' => __('Switch to "Yes" if you need to hide this section at Tablets (small screen size)', 'wplab-unicum'),
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
				),
				'hide_xs' => array(
					'label' => __('Hide at Phones', 'wplab-unicum'),
					'desc' => __('Switch to "Yes" if you need to hide this section at Phones (extra small screen size)', 'wplab-unicum'),
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
				),
			
			)
		),
	),

);