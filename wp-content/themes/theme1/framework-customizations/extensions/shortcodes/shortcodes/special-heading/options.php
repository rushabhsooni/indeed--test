<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_unicum_animations;

$options = array(

	array(
		'title'    => array(
			'type'  => 'text',
			'label' => __( 'Heading Title', 'wplab-unicum' ),
			'desc'  => __( 'Write the heading title content', 'wplab-unicum' ),
		),
		'heading' => array(
			'type'    => 'select',
			'label'   => __('Heading Size', 'wplab-unicum'),
			'choices' => array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
			)
		),
		'header_color' => array(
			'label' => __('Header color', 'wplab-unicum'),
			'type' => 'color-picker',
		),
		'text_align' => array(
			'type'    => 'select',
			'label'   => __('Text Align', 'wplab-unicum'),
			'value'		=> '',
			'choices' => array(
				'' => __('- Default -', 'wplab-unicum'),
				'left' => __('Left', 'wplab-unicum'),
				'center' => __('Center', 'wplab-unicum'),
				'right' => __('Right', 'wplab-unicum'),
			),
		),
		'text_transform' => array(
			'type'    => 'select',
			'label'   => __('Text Transform', 'wplab-unicum'),
			'value'		=> '',
			'choices' => array(
				'' => __('- Default -', 'wplab-unicum'),
				'none' => __('None', 'wplab-unicum'),
				'uppercase' => __('Uppercase', 'wplab-unicum'),
			),
		),
		'font_style' => array(
			'type'    => 'select',
			'label'   => __('Font Style', 'wplab-unicum'),
			'value'		=> '',
			'choices' => array(
				'' => __('- Default -', 'wplab-unicum'),
				'normal' => __('Normal', 'wplab-unicum'),
				'italic' => __('Italic', 'wplab-unicum'),
			),
		),
		'font_variant' => array(
			'type'    => 'select',
			'label'   => __('Font Variant', 'wplab-unicum'),
			'value'		=> '',
			'choices' => array(
				'' => __('- Default -', 'wplab-unicum'),
				'normal' => __('Normal', 'wplab-unicum'),
				'small-caps' => __('Small Caps', 'wplab-unicum'),
			),
		),
		'font_weight' => array(
			'type'    => 'select',
			'label'   => __('Font Weight', 'wplab-unicum'),
			'value'		=> '',
			'choices' => array(
				'' => __('- Default -', 'wplab-unicum'),
				'light' => __('Light', 'wplab-unicum'),
				'normal' => __('Normal', 'wplab-unicum'),
				'bold' => __('Bold', 'wplab-unicum'),
				'bolder' => __('Bolder', 'wplab-unicum'),
				'100' => '100',
				'300' => '300',
				'400' => '400',
				'600' => '600',
				'800' => '800',
			),
		),
		'animation' => array(
			'type' => 'multi-picker',
			'label' => false,
			'desc' => false,
			'picker' => array(
				'enabled' => array(
					'label' => __( 'Animate header?', 'wplab-unicum' ),
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
		'custom_classes' => array(
			'type'  => 'text',
			'label' => __( 'Custom CSS classes', 'wplab-unicum' ),
			'desc'  => __( 'Type here your own custom CSS classes', 'wplab-unicum' ),
		),
	)
);
