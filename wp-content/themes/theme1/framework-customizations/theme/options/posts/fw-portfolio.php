<?php 

/**
 * Portfolio options array
 **/
$options = array(
	'main' => array(
		'title'   => __( 'Project Post Settings', 'wplab-unicum' ),
		'type'    => 'box',
		'options' => array(

			'video_url' => array(
				'label' => __( 'Video URL', 'wplab-unicum' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => __( 'YouTube or Vimeo videos are supported', 'wplab-unicum' ),
			),
			
			'video_portfolio' => array(
				'label' => __( 'Use Video in preview', 'wplab-unicum' ),
				'type' => 'switch',
				'desc' => __( 'if enabled, your video (instead thumbnail) will be used in a lightbox preview and on single post', 'wplab-unicum' ),
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