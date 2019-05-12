<?php 

/**
 * Post options array
 **/
$options = array(
	'main' => array(
		'title'   => __( 'Post Settings', 'wplab-unicum' ),
		'type'    => 'box',
		'options' => array(

			'intro_header' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => __( 'Display Intro Header', 'wplab-unicum' ),
						'type' => 'switch',
						'right-choice' => array(
							'value' => '1',
							'label' => __( 'Yes', 'wplab-unicum' )
						),
						'left-choice' => array(
							'value' => '0',
							'label' => __( 'No', 'wplab-unicum' )
						),
						'value' => '0',
					)
				),
				'choices' => array(
					'1' => array(

						'intro_header_image' => array(
							'label' => __( 'Intro Image Background', 'wplab-unicum' ),
							'type' => 'upload'
						),

					),
				),
			),

		),
	),
);