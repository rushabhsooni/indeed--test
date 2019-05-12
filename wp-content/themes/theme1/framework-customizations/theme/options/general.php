<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'general' => array(
				'title' => __( 'General', 'wplab-unicum' ),
				'type' => 'tab',
				'options' => array(
				
					'theme_options' => array(
						'title' => __( 'General options', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
	
							'theme_options-box' => array(
								'title' => __( 'General options', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'page_preloader' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'value' => array(
											'style' => 'hidden',
										),
										'picker' => array(
											'style' => array(
												'label' => __( 'Page preloader', 'wplab-unicum' ),
												'type' => 'radio',
												'choices' => array(
													'hidden' => __( 'Turn Off Page Preloader', 'wplab-unicum' ),
													'theme' => __( 'Theme Styled Preloader', 'wplab-unicum' ),
													'css' => __( 'Use CSS preloader from library', 'wplab-unicum' ),
													'custom' => __( 'Upload custom image as a Page Preloader', 'wplab-unicum' )
												),
											)
										),
										'choices' => array(
											'css' => array(
	
												'css_preloader_style' => array(
													'label' => __( 'Choose preloader style', 'wplab-unicum' ),
													'type' => 'select',
													'value' => '',
													'choices' => array(
														''  => '---',
														array (
															'attr' => array(
																'label' => __( 'Loaders.css Library', 'wplab-unicum' ),
															),
															'choices' => array(
																'ball-pulse' => __('Ball pulse', 'wplab-unicum'),
																'ball-grid-pulse' => __('Ball grid pulse', 'wplab-unicum'),
																'ball-clip-rotate' => __('Ball clip rotate', 'wplab-unicum'),
																'square-spin' => __('Square spin', 'wplab-unicum'),
																'ball-clip-rotate-multiple' => __('Ball clip rotate multiple', 'wplab-unicum'),
																'ball-pulse-rise' => __('Ball pulse rise', 'wplab-unicum'),
																'ball-rotate' => __('Ball rotate', 'wplab-unicum'),
																'cube-transition' => __('Cube transition', 'wplab-unicum'),
																'ball-zig-zag' => __('Ball zig-zag', 'wplab-unicum'),
																'ball-zig-zag-deflect' => __('Ball zig-zag deflect', 'wplab-unicum'),
																'ball-triangle-path' => __('Ball triangle path', 'wplab-unicum'),
																'ball-scale' => __('Ball scale', 'wplab-unicum'),
																'line-scale' => __('Line scale', 'wplab-unicum'),
																'line-scale-party' => __('Line scale party', 'wplab-unicum'),
																'ball-scale-multiple' => __('Ball scale multiple', 'wplab-unicum'),
																'ball-pulse-sync' => __('Ball pulse', 'wplab-unicum'),
																'ball-beat' => __('Ball beat', 'wplab-unicum'),
																'line-scale-pulse-out' => __('Line scale pulse out', 'wplab-unicum'),
																'line-scale-pulse-out-rapid' => __('Line scale pulse out rapid', 'wplab-unicum'),
																'ball-scale-ripple' => __('Ball scale ripple', 'wplab-unicum'),
																'ball-scale-ripple-multiple' => __('Ball scale ripple multiple', 'wplab-unicum'),
																'ball-spin-fade-loader' => __('Ball spin fade loader', 'wplab-unicum'),
																'line-spin-fade-loader' => __('Line spin fade loader', 'wplab-unicum'),
																'triangle-skew-spin' => __('Triangle skew spin', 'wplab-unicum'),
																'pacman' => __('Pacman', 'wplab-unicum'),
																'ball-grid-beat' => __('Ball grid beat', 'wplab-unicum'),
																'semi-circle-spin' => __('Cemi circle spin', 'wplab-unicum'),
															),
														),
													),
												),
	
											),
											'custom' => array(
												'custom_preloader_image' => array(
													'label' => __( 'Preloader image', 'wplab-unicum' ),
													'desc' => __( 'Choose your own preloader image', 'wplab-unicum' ),
													'type' => 'upload',
												),
												'custom_preloader_image_2x' => array(
													'label' => __( 'Preloader image for Retina Displays', 'wplab-unicum' ),
													'desc' => __( 'Choose your own preloader image for Retina Displays.', 'wplab-unicum' ),
													'type' => 'upload',
													'help'  => __( 'It should be in a twice size of your custom preloader image.', 'wplab-unicum' ),
												),
												'custom_preloader_image_width' => array(
													'label' => __( 'Preloader image width', 'wplab-unicum' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => __( 'value in pixels', 'wplab-unicum' ),
													'help' => __( 'Type here a width of preloader image in pixels, e.g.: 50', 'wplab-unicum' ),
												),
												'custom_preloader_image_height' => array(
													'label' => __( 'Preloader image Height', 'wplab-unicum' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => __( 'value in pixels', 'wplab-unicum' ),
													'help' => __( 'Type here a height of preloader image in pixels, e.g.: 50', 'wplab-unicum' ),
												),
											),
										),
										'show_borders' => false,
									),
									
									'smooth_scrolling' => array(
										'label' => __( 'Smooth Scrolling', 'wplab-unicum' ),
										'type' => 'switch',
										'right-choice' => array(
											'value' => 'true',
											'label' => __( 'Enabled', 'wplab-unicum' )
										),
										'left-choice' => array(
											'value' => 'false',
											'label' => __( 'Disabled', 'wplab-unicum' )
										),
										'value' => 'false',
										'desc' => __( 'If enabled, theme adds some delay when you scroll a website using a mouse scroller', 'wplab-unicum' ),
									),
									
									'go_top_link' => array(
										'label' => __( '"Go Top" link', 'wplab-unicum' ),
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
										'desc' => __( 'If enabled, a "Go Top" block will be displayed when you scroll the page', 'wplab-unicum' ),
									),
									
									'dev_info' => array(
										'label' => __( 'Display information for developers', 'wplab-unicum' ),
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
										'help' => __('If enabled, developers information will be displayed in HTML comment after primary footer tag.', 'wplab-unicum'),
										'desc' => __('Page generation time and SQL queries count', 'wplab-unicum' ),
									),
								
								)
							),
	
						),
					),
					
					'fonts_options' => array(
						'title' => __( 'Fonts', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'fonts_options-box' => array(
								'title' => __( 'Fonts', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'font_subsets' => array(
									  'type'  => 'checkboxes',
									  'value' => array(
									    'latin' => true,
									    'latin-ext' => false,
									    'cyrillic' => false,
									    'cyrillic-ext' => false,
									    'greek' => false,
									    'greek-ext' => false,
									    'vietnamese' => false,
									  ),
									  'label' => __('Google Fonts Additional subsets', 'wplab-recover'),
									  'desc'  => __('Here you can load additional subsets for Google Fonts', 'wplab-recover'),
									  'choices' => array(
									    'latin' => __('Latin', 'wplab-recover'),
									    'latin-ext' => __('Latin Extended', 'wplab-recover'),
									    'cyrillic' => __('Cyrillic', 'wplab-recover'),
									    'cyrillic-ext' => __('Cyrillic Extended', 'wplab-recover'),
									    'greek' => __('Greek', 'wplab-recover'),
									    'greek-ext' => __('Greek Extended', 'wplab-recover'),
									    'vietnamese' => __('Vietnamese', 'wplab-recover'),
									  ),
									),
									
									'font_styles' => array(
									  'type'  => 'checkboxes',
									  'value' => array(
									    '100' => true,
									    '100italic' => false,
									    '300' => false,
									    '300italic' => false,
									    '400' => true,
									    '400italic' => false,
									    '600' => false,
									    '600italic' => false,
									    '700' => true,
									    '700italic' => false,
									    '800' => false,
									    '800italic' => false,
									  ),
									  'label' => __('Google Fonts Additional styles', 'wplab-recover'),
									  'desc'  => __('Here you can load additional font styles for Google Fonts', 'wplab-recover'),
									  'choices' => array(
									    '100' => __('Thin 100', 'wplab-recover'),
									    '100italic' => __('Thin 100 Italic', 'wplab-recover'),
									    '300' => __('Light 300', 'wplab-recover'),
									    '300italic' => __('Light 300 Italic', 'wplab-recover'),
									    '400' => __('Normal 400', 'wplab-recover'),
									    '400italic' => __('Normal 400 Italic', 'wplab-recover'),
									    '600' => __('Semi-bold 600', 'wplab-recover'),
									    '600italic' => __('Semi-bold 600 Italic', 'wplab-recover'),
									    '700' => __('Bold 700', 'wplab-recover'),
									    '700italic' => __('Bold 700 Italic', 'wplab-recover'),
									    '800' => __('Extra-bold 800', 'wplab-recover'),
									    '800italic' => __('Extra-bold 800 Italic', 'wplab-recover'),
									  ),
									),
								
								)
							)
						
						)
					),
					
					'post' => array(
						'title' => __( 'Post settings', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
						
							'post_settings-box' => array(
								'title' => __( 'Post settings', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'display_share_links' => array(
										'label' => __( 'Display share links', 'wplab-unicum' ),
										'type' => 'switch',
										'desc' => __( 'this settings will show or hide social share links on a single post', 'wplab-unicum' ),
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
							)
						
						)
					),
					
					'page_404' => array(
						'title' => __( 'Page 404', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
						
							'page_404_settings-box' => array(
								'title' => __( 'Page 404 Settings', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'page_404_content_bg' => array(
										'label' => __( 'Background image', 'wplab-unicum' ),
										'desc' => __( 'Custom backround image for 404 page', 'wplab-unicum' ),
										'type' => 'upload',
									),
								
									'page_404_content' => array(
								    'type'  => 'wp-editor',
								    'value' => '',
								    'label' => __('Page 404 content', 'wplab-unicum'),
								    'value'  => '<h1 style="text-align: center;">Error 404</h1><p style="text-align: center;">Page not found</p>',
								    'tinymce' => true,
								    'media_buttons' => false,
								    'teeny' => true,
								    'wpautop' => true,
								    //'reinit' => true,
								    'size' => 'large',
								    'editor_type' => 'tinymce',
								    'editor_height' => 200
									)
								
								)
							)
						
						)
					),
					
					'social' => array(
						'title' => __( 'Social Icons', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
							
							'social_icons-box' => array(
								'title' => __( 'Social Icons', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
							
									'linkedin_url' => array(
										'label' => __( 'LinkedIn URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your LinkedIn profile URL', 'wplab-unicum' ),
									),
									'youtube_url' => array(
										'label' => __( 'YouTube URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your YouTube profile URL', 'wplab-unicum' ),
									),
									'vimeo_url' => array(
										'label' => __( 'Vimeo URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Vimeo profile URL', 'wplab-unicum' ),
									),
									'facebook_url' => array(
										'label' => __( 'Facebook URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Facebook profile URL', 'wplab-unicum' ),
									),
									'twitter_url' => array(
										'label' => __( 'Twitter URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Twitter profile URL', 'wplab-unicum' ),
									),
									'google_plus_url' => array(
										'label' => __( 'Google Plus URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Google Plus profile URL', 'wplab-unicum' ),
									),
									'pinterest_url' => array(
										'label' => __( 'Pinterest URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Pinterest profile URL', 'wplab-unicum' ),
									),
									'instagram_url' => array(
										'label' => __( 'Instagram URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Instagram profile URL', 'wplab-unicum' ),
									),
									'flickr_url' => array(
										'label' => __( 'Flickr URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Flickr profile URL', 'wplab-unicum' ),
									),
									'behance_url' => array(
										'label' => __( 'Behance URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Behance profile URL', 'wplab-unicum' ),
									),
									'google_play_url' => array(
										'label' => __( 'Google Play URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Google Play URL', 'wplab-unicum' ),
									),
									'app_store_url' => array(
										'label' => __( 'App Store URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your App Store URL', 'wplab-unicum' ),
									),
									'windows_marketplace_url' => array(
										'label' => __( 'Windows Marketplace URL', 'wplab-unicum' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => __( 'Paste here your Windows Marketplace URL', 'wplab-unicum' ),
									),
							
								),
							),
							
						),
					),
					
					'rss_feed' => array(
						'title' => __( 'RSS Feed', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
	
							'rss_feed-box' => array(
								'title' => __( 'RSS Feed', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'rss_feed' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => __( 'RSS Feed', 'wplab-unicum' ),
												'type' => 'switch',
												'right-choice' => array(
													'value' => 'false',
													'label' => __( 'Disabled', 'wplab-unicum' )
												),
												'left-choice' => array(
													'value' => 'true',
													'label' => __( 'Enabled', 'wplab-unicum' )
												),
												'value' => 'false',
											)
										),
										'choices' => array(
											'true' => array(
		
												'display_thumbnails_in_rss' => array(
													'label' => __( 'Add post thumbnails to the RSS Feed', 'wplab-unicum' ),
													'type' => 'switch',
													'desc' => __( 'If enabled, post thumbnail will be added for each post in your RSS feed', 'wplab-unicum' ),
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
										),
										'show_borders' => false,
									),
								
								)
							),
	
						),
					),
					
					'extra' => array(
						'title' => __( 'Extra Settings', 'wplab-unicum' ),
						'type' => 'tab',
						'options' => array(
	
							'extra-settings-box' => array(
								'title' => __( 'Extra Settings', 'wplab-unicum' ),
								'type' => 'box',
								'options' => array(
								
									'hide_admin_bar' => array(
										'label' => __( 'Hide Admin Bar', 'wplab-unicum' ),
										'type' => 'switch',
										'desc' => __( 'for logged non-admins at front-end part', 'wplab-unicum' ),
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
									
									'logout_non_admins' => array(
										'label' => __( 'Disable access to WP admin for logged non-admin users', 'wplab-unicum' ),
										'type' => 'switch',
										'desc' => __( 'If enabled, registered non-admins will be redirected to the website home if they try to access the admin panel', 'wplab-unicum' ),
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
	
						),
					),
	
				)
			)
		),
	);