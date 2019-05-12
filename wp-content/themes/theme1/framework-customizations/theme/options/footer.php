<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'footer' => array(
				'title' => __( 'Footer', 'wplab-unicum' ),
				'type' => 'tab',
				'options' => array(
	
					'footer_options' => array(
						'title' => __( 'Footer Settings', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
						
							'footer_options-box' => array(
								'title' => __( 'Footer Settings', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'display_footer_widgets' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => __( 'Display Footer Widgets', 'wplab-unicum' ),
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
											)
										),
										'choices' => array(
											'true' => array(
		
												'footer_widgets_columns' => array(
											    'type'  => 'slider',
											    'value' => 1,
											    'properties' => array(
										        'min' => 1,
										        'max' => 4,
											    ),
											    'label' => __( 'A number of columns for widgets', 'wplab-unicum' ),
												),

	
											),
										),
									),
									
									'footer_parallax' => array(
										'label' => __( 'Enable Parallax Effect', 'wplab-unicum' ),
										'type' => 'switch',
										'desc' => __( 'If disabled, a simple footer style will be used', 'wplab-unicum' ),
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
								
								)
							),
						
						)
					),
					'bottom_bar_options' => array(
						'title' => __( 'Bottom Bar', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
						
							'bottom_bar_options-box' => array(
								'title' => __( 'Bottom Bar', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'display_bottom_bar' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => __( 'Display Bottom Bar', 'wplab-unicum' ),
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
											)
										),
										'choices' => array(
											'true' => array(
		
												'bottom_bar_content' => array(
											    'type'  => 'wp-editor',
											    'value' => '',
											    'label' => __('Bottom Bar Content', 'wplab-unicum'),
											    'value'  => '<p>&copy;2015 Creative Agency <a href="">Unicum</a></p><p>Designed by <a href="http://themeforest.net/user/themefire/?ref=wplab">ThemeFire</a> / Developed by <a href="http://themeforest.net/user/wplab/?ref=wplab">WPlab.Pro</a></p><p>Only for <a href="http://themeforest.net/user/wplab/portfolio/?ref=wplab">Envato Market</a></p>',
											    'tinymce' => true,
											    'media_buttons' => false,
											    'teeny' => true,
											    'wpautop' => true,
											    //'reinit' => true,
											    'size' => 'large',
											    'editor_type' => 'tinymce',
											    'editor_height' => 200
												)
	
											),
										),
									),

								
								)
							),
						
						)
					),
	
				)
			)
		),
	);