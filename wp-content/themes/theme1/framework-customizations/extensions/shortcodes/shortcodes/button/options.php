<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_unicum_animations;

$options = array(
	'label'  => array(
		'label' => __( 'Button Label', 'wplab-unicum' ),
		'desc'  => __( 'This is the text that appears on your button', 'wplab-unicum' ),
		'type'  => 'text',
		'value' => 'Submit'
	),
	'link'   => array(
		'label' => __( 'Button Link', 'wplab-unicum' ),
		'desc'  => __( 'Where should your button link to', 'wplab-unicum' ),
		'type'  => 'text',
		'value' => '#'
	),
	'target' => array(
		'type'  => 'switch',
		'label'   => __( 'Open Link in New Window', 'wplab-unicum' ),
		'desc'    => __( 'Select here if you want to open the linked page in a new window', 'wplab-unicum' ),
		'right-choice' => array(
			'value' => '_blank',
			'label' => __('Yes', 'wplab-unicum'),
		),
		'left-choice' => array(
			'value' => '_self',
			'label' => __('No', 'wplab-unicum'),
		),
	),
	'size'  => array(
		'label'   => __( 'Button Size', 'wplab-unicum' ),
		'desc'    => __( 'Choose a size for your button', 'wplab-unicum' ),
		'type'    => 'select',
		'choices' => array(
			''      => __('Default', 'wplab-unicum'),
			'large' => __( 'Large', 'wplab-unicum' ),
		)
	),
	'color'  => array(
		'label'   => __( 'Button Style', 'wplab-unicum' ),
		'desc'    => __( 'Choose a color for your button', 'wplab-unicum' ),
		'type'    => 'select',
		'choices' => array(
			''      							=> __('Default', 'wplab-unicum'),
			'blue' 								=> __( 'Blue', 'wplab-unicum' ),
			'purple'  						=> __( 'Purple', 'wplab-unicum' ),
			'green' 							=> __( 'Green', 'wplab-unicum' ),
			'green-alt'   				=> __( 'Green Alternate', 'wplab-unicum' ),
			'orange'   						=> __( 'Orange', 'wplab-unicum' ),
			'pink'   							=> __( 'Pink', 'wplab-unicum' ),
			'gray'   							=> __( 'Grey', 'wplab-unicum' ),
			'black'   						=> __( 'Black', 'wplab-unicum' ),
			'red'   							=> __( 'Red', 'wplab-unicum' ),
			'turquoise'   				=> __( 'Turquoise', 'wplab-unicum' ),
			'violet'   						=> __( 'Violet', 'wplab-unicum' ),
			'apple'   						=> __( 'Buy via App Store', 'wplab-unicum' ),
			'android'							=> __( 'Buy via Google Marketplace', 'wplab-unicum' ),
		)
	),
	'animation' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'enabled' => array(
				'label' => __( 'Animate button?', 'wplab-unicum' ),
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
	'button_id'  => array(
		'label' => __( 'Button ID', 'wplab-unicum' ),
		'desc'  => __( 'Here you can set unique identifier for this button', 'wplab-unicum' ),
		'type'  => 'text',
		'value' => ''
	),
	'custom_classes'  => array(
		'label' => __( 'Custom CSS classes', 'wplab-unicum' ),
		'desc'  => __( 'For example: my-custom-class alignleft', 'wplab-unicum' ),
		'type'  => 'text',
		'value' => ''
	),
);