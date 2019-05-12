<?php 

global $wplab_unicum_animations;

$options = array(

	array(
		'styling' => array(
			'title' => __( 'Styling', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
			
				'container_stretch' => array(
					'label' => __( 'Container stretch', 'wplab-unicum' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'default' => __( 'Default', 'wplab-unicum' ),
						'stretch_row' => __( 'Stretch row', 'wplab-unicum' ),
						'stretch_row_content' => __( 'Stretch row and content', 'wplab-unicum' ),
						'stretch_row_content_no_paddings' => __( 'Stretch row and content without grid paddings', 'wplab-unicum' ),
					),
				),
				'is_fullheight' => array(
					'label' => __('Full Height', 'wplab-unicum'),
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
				'background_color' => array(
					'label' => __('Background Color', 'wplab-unicum'),
					'desc' => __('Select the custom background color', 'wplab-unicum'),
					'type' => 'color-picker',
				),
				'background_gradient_color_start' => array(
					'label' => __('Background Gradient Start Color', 'wplab-unicum'),
					'desc' => __('Select the custom gradient background color', 'wplab-unicum'),
					'type' => 'color-picker',
				),
				'background_gradient_color_end' => array(
					'label' => __('Background Gradient End Color', 'wplab-unicum'),
					'desc' => __('Select the custom gradient background color', 'wplab-unicum'),
					'type' => 'color-picker',
				),
				'background_image' => array(
					'label' => __('Background Image', 'wplab-unicum'),
					'desc' => __('Upload the background image', 'wplab-unicum'),
					'type' => 'background-image',
				),
				'background_cover' => array(
					'label' => __('Cover Background Image', 'wplab-unicum'),
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
				'background_repeat' => array(
					'label' => __( 'Background image repeat', 'wplab-unicum' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'no-repeat' => __( 'No repeat', 'wplab-unicum' ),
						'repeat-x' => __( 'Repeat horizontally', 'wplab-unicum' ),
						'repeat-y' => __( 'Repeat vertically', 'wplab-unicum' ),
						'repeat' => __( 'Repeat horizontally and vertically', 'wplab-unicum' ),
					),
				),
				'background_position' => array(
					'label' => __( 'Background image position', 'wplab-unicum' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'left top' => __( 'Left Top', 'wplab-unicum' ),
						'center top' => __( 'Center Top', 'wplab-unicum' ),
						'right top' => __( 'Right Top', 'wplab-unicum' ),
						'left bottom' => __( 'Left Bottom', 'wplab-unicum' ),
						'center bottom' => __( 'Center Bottom', 'wplab-unicum' ),
						'right bottom' => __( 'Right Bottom', 'wplab-unicum' ),
						'left center' => __( 'Left Center', 'wplab-unicum' ),
						'center center' => __( 'Center Center', 'wplab-unicum' ),
						'right center' => __( 'Right Center', 'wplab-unicum' ),
					),
				),
				
				'section_effects' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'value' => array(
						'effect' => '',
					),
					'picker' => array(
						'effect' => array(
							'label' => __( 'Section Effects', 'wplab-unicum' ),
							'type' => 'radio',
							'choices' => array(
								'' => __( 'No Effects', 'wplab-unicum' ),
								'parallax' => __( 'Parallax background', 'wplab-unicum' ),
								'video' => __( 'YouTube Video Background', 'wplab-unicum' ),
							),
						)
					),
					'choices' => array(
						'parallax' => array(
						
							'parallax_speed' => array(
								'label' => __('Parallax speed', 'wplab-unicum'),
								'desc' => __('Set a speed of parallax effect, e.g.: 1.5. Do not forget to assign some background image for this section.', 'wplab-unicum'),
								'type' => 'text',
								'value' => '1.5'
							),
						
						),
						'video' => array(
						
							'video' => array(
								'label' => __('Video URL', 'wplab-unicum'),
								'desc' => __('Insert YouTube Video URL to embed this video as background', 'wplab-unicum'),
								'type' => 'text',
							),
							'video_pause_on_scroll' => array(
								'label' => __('Pause video on scroll', 'wplab-unicum'),
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
							'video_mute' => array(
								'label' => __('Mute video', 'wplab-unicum'),
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
					)
				),
				
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
			
				'section_id' => array(
					'label' => __('Anchor (section ID)', 'wplab-unicum'),
					'desc' => __('For example: our-clients', 'wplab-unicum'),
					'type' => 'text',
				),
				
				'section_class' => array(
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
	),
	'responsiveness' => array(
		'title' => __( 'Responsiveness', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
		
			'hide_bg_large_screens' => array(
				'label' => __('Hide background image at large screens', 'wplab-unicum'),
				'desc' => __('Background-color will be still visible', 'wplab-unicum'),
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
			'hide_bg_medium_screens' => array(
				'label' => __('Hide background image at medium screens', 'wplab-unicum'),
				'desc' => __('Background-color will be still visible', 'wplab-unicum'),
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
			'hide_bg_small_screens' => array(
				'label' => __('Hide background image at small screens', 'wplab-unicum'),
				'desc' => __('Background-color will be still visible', 'wplab-unicum'),
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
			'hide_bg_estra_small_screens' => array(
				'label' => __('Hide background image at extra small screens', 'wplab-unicum'),
				'desc' => __('Background-color will be still visible', 'wplab-unicum'),
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

);