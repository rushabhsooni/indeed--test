<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'branding' => array(
				'title' => __( 'Branding', 'wplab-unicum' ),
				'type' => 'tab',
				'options' => array(
				
					'header-logo-box' => array(
						'title' => __( 'Branding', 'wplab-unicum' ),
						'type' => 'box',
						'limit' => 0,
						'options' => array(
						
							'header_logo_type' => array(
								'type' => 'multi-picker',
								'show_borders' => false,
								'label' => false,
								'desc' => false,
								'value' => array(
									'type' => 'title',
								),
								'picker' => array(
									'logo_type' => array(
										'label' => __( 'Logo Type', 'wplab-unicum' ),
										'type' => 'radio',
										'choices' => array(
											'title' => __( 'Site title only', 'wplab-unicum' ),
											'title_and_tagline'  => __( 'Site title and tagline', 'wplab-unicum' ),
											'image' => __( 'Image logo', 'wplab-unicum' ),
										),
									)
								),
								'choices' => array(
									'image' => array(
										'header_logo_image' => array(
											'label' => __( 'Header Logo', 'wplab-unicum' ),
											'type' => 'upload',
											'attr' => array( 'class' => 'wproto-image-auto-width' ),
										),
										'header_logo_image_2x' => array(
											'label' => __( 'Header Logo for Retina Displays', 'wplab-unicum' ),
											'help' => __( 'Image logo for Retina Displays should be in a double-size. E.g. If your logo has 150x75 pixels size, Retina logo should be 300x150 pixels size.', 'wplab-unicum' ),
											'attr' => array( 'class' => 'wproto-image-auto-width' ),
											'type' => 'upload'
										),
										'header_logo_width' => array(
											'label' => __( 'Logo Width', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here your image logo width in pixels, e.g.: 210', 'wplab-unicum' ),
										),
										'header_logo_height' => array(
											'label' => __( 'Logo Height', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here your image logo height in pixels, e.g.: 90', 'wplab-unicum' ),
										),
										'header_logo_margin_top' => array(
											'label' => __( 'Logo Top Margin', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here some value, it will be used as a Top Margin for your header logo in pixels, e.g. 45', 'wplab-unicum' ),
										),
										'header_logo_margin_right' => array(
											'label' => __( 'Logo Right Margin', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here some value, it will be used as a Right Margin for your header logo in pixels, e.g. 45', 'wplab-unicum' ),
										),
										'header_logo_margin_bottom' => array(
											'label' => __( 'Logo Bottom Margin', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here some value, it will be used as a Bottom Margin for your header logo in pixels, e.g. 45', 'wplab-unicum' ),
										),
										'header_logo_margin_left' => array(
											'label' => __( 'Logo Left Margin', 'wplab-unicum' ),
											'type' => 'short-text',
											'value' => '',
											'desc' => __( 'value in pixels', 'wplab-unicum' ),
											'help' => __( 'Type here some value, it will be used as a Left Margin for your header logo in pixels, e.g. 45', 'wplab-unicum' ),
										),
									)
								),

							),
						)
					),

				)
			)
		),
	);