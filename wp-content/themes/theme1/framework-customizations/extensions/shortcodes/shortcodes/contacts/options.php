<?php if (!defined('FW')) die('Forbidden');

$options = array(

	'tab_address' => array(
		'title' => __( 'Address', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'address' => array(
				'type'  => 'textarea',
				'label' => __('Address', 'wplab-unicum')
			),
			'address_icon_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'address_icon' => 'default',
				),
				'picker' => array(
					'address_icon' => array(
						'label' => __( 'Icon', 'wplab-unicum' ),
						'type' => 'radio',
						'choices' => array(
							'default' => __( 'Default', 'wplab-unicum' ),
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
			'address_svg_icon_color' => array(
				'label' => __('Icon Color', 'wplab-unicum'),
				'description' => __('for SVG images only', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
			'address_text_color' => array(
				'label' => __('Text Color', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
		)
	),
	'tab_phone' => array(
		'title' => __( 'Phone', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'phone' => array(
				'type'  => 'textarea',
				'label' => __('Phones', 'wplab-unicum')
			),
			'phone_icon_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'phone_icon' => 'default',
				),
				'picker' => array(
					'phone_icon' => array(
						'label' => __( 'Icon', 'wplab-unicum' ),
						'type' => 'radio',
						'choices' => array(
							'default' => __( 'Default', 'wplab-unicum' ),
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
			'phone_svg_icon_color' => array(
				'label' => __('Icon Color', 'wplab-unicum'),
				'description' => __('for SVG images only', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
			'phone_text_color' => array(
				'label' => __('Text Color', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
		)
	),
	'tab_email' => array(
		'title' => __( 'Email', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'email' => array(
				'type'  => 'textarea',
				'label' => __('Contact emails', 'wplab-unicum')
			),
			'email_icon_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'email_icon' => 'default',
				),
				'picker' => array(
					'email_icon' => array(
						'label' => __( 'Icon', 'wplab-unicum' ),
						'type' => 'radio',
						'choices' => array(
							'default' => __( 'Default', 'wplab-unicum' ),
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
			'email_svg_icon_color' => array(
				'label' => __('Icon Color', 'wplab-unicum'),
				'description' => __('for SVG images only', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
			'email_text_color' => array(
				'label' => __('Text Color', 'wplab-unicum'),
				'type' => 'color-picker',
				'value' => '#ffffff'
			),
		)
	),
);