<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'general' => array(
			'title' => __( 'General', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
				'tabs' => array(
					'type'          => 'addable-popup',
					'label'         => __( 'Tabs', 'wplab-unicum' ),
					'popup-title'   => __( 'Add/Edit Tab', 'wplab-unicum' ),
					'desc'          => __( 'Create your tabs', 'wplab-unicum' ),
					'template'      => '{{=tab_title}}',
					'popup-options' => array(
						'tab_image' => array(
							'label' => __( 'Tab image', 'wplab-unicum' ),
							'desc' => __( 'Will be shown at the left part of tab', 'wplab-unicum' ),
							'type' => 'background-image',
						),
						'tab_title' => array(
							'type'  => 'text',
							'label' => __('Title', 'wplab-unicum')
						),
						'tab_content' => array(
							'type'  => 'wp-editor',
							'label' => __('Content', 'wplab-unicum'),
							'reinit' => true
						),
						'tab_icon_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'value' => array(
								'tab_icon' => '',
							),
							'picker' => array(
								'tab_icon' => array(
									'label' => __( 'Tab icon', 'wplab-unicum' ),
									'type' => 'radio',
									'choices' => array(
										'' => __( 'Without Icon', 'wplab-unicum' ),
										'fontawesome' => __( 'Choose an icon from Font Awesome library', 'wplab-unicum' ),
										'custom' => __( 'Upload custom icon', 'wplab-unicum' ),
									),
								)
							),
							'choices' => array(
								'fontawesome' => array(
								
									'icon' => array(
										'type' => 'icon',
										'label' => __( 'Icon', 'wplab-unicum' )
									),
								
								),
								'custom' => array(
								
									'custom_image' => array(
										'label' => __( 'Upload your own SVG image', 'wplab-unicum' ),
										'desc' => __( 'It will be used as a Tab Icon', 'wplab-unicum' ),
										'type' => 'upload',
									),
								
								),
							)
						),
					),
				),
			)
		),
		'styling' => array(
			'title' => __( 'Styling', 'wplab-unicum' ),
			'type' => 'tab',
			'options' => array(
				'tabs_background_color' => array(
					'label' => __('Custom Background Color', 'wplab-unicum'),
					'type' => 'color-picker',
					'value' => '#f9f0e7'
				),
				'tabs_background_accent' => array(
					'label' => __('Pagination Background Color', 'wplab-unicum'),
					'type' => 'color-picker',
					'value' => '#f4e7d7'
				),
				'tabs_icon_color' => array(
					'label' => __('Custom Icon Color', 'wplab-unicum'),
					'type' => 'color-picker',
					'value' => '#636363'
				),
				'tabs_icon_hover_gradient_left_color' => array(
					'label' => __('Custom Gradient Color 1', 'wplab-unicum'),
					'type' => 'color-picker',
					'value' => '#e91d62'
				),
				'tabs_icon_hover_gradient_right_color' => array(
					'label' => __('Custom Gradient Color 2', 'wplab-unicum'),
					'type' => 'color-picker',
					'value' => '#ff9700'
				),
			)
		),
	)

);