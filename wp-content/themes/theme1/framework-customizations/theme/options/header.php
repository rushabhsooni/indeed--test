<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'header' => array(
				'title' => __( 'Header', 'wplab-unicum' ),
				'type' => 'tab',
				'options' => array(
	
					'header_options-box' => array(
						'title' => __( 'Header Settings', 'wplab-unicum' ),
						'type' => 'box',
						'options' => array(
						
							'menu_linethrough_effect' => array(
								'label' => __( 'Line through effect in menu', 'wplab-unicum' ),
								'type' => 'switch',
								'right-choice' => array(
									'value' => 'true',
									'label' => __( 'Enabled', 'wplab-unicum' )
								),
								'left-choice' => array(
									'value' => 'false',
									'label' => __( 'Disabled', 'wplab-unicum' )
								),
								'value' => 'true',
							),
						
							'header_scrolling' => array(
								'type' => 'multi-picker',
								'label' => false,
								'desc' => false,
								'picker' => array(
									'enabled' => array(
										'label' => __( 'Header Scrolling Effect', 'wplab-unicum' ),
										'type' => 'switch',
										'right-choice' => array(
											'value' => 'true',
											'label' => __( 'Enabled', 'wplab-unicum' )
										),
										'left-choice' => array(
											'value' => 'false',
											'label' => __( 'Disabled', 'wplab-unicum' )
										),
										'value' => 'true',
									)
								),
								'choices' => array(
									'true' => array(

										'header_scrolling_alt' => array(
											'label' => __( 'Do not hide header on scroll', 'wplab-unicum' ),
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


									),
								),
							),
						
						)
					)
	
				)
			)
		),
	);