<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'team' => array(
		'title' => __( 'Team Members', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => __( 'Team Members', 'wplab-unicum' ),
				'popup-title'   => __( 'Add/Edit Team Member', 'wplab-unicum' ),
				'desc'          => __( 'Create your team', 'wplab-unicum' ),
				'template'      => '{{=name}}',
				'popup-options' => array(
					'avatar_photo' => array(
						'label' => __('Avatar Photo', 'wplab-unicum'),
						'type' => 'background-image',
					),
					'background_photo' => array(
						'label' => __('Background Photo', 'wplab-unicum'),
						'type' => 'background-image',
					),
					'name' => array(
						'type'  => 'text',
						'label' => __('Name', 'wplab-unicum')
					),
					'position' => array(
						'type'  => 'text',
						'label' => __('Position', 'wplab-unicum')
					),
					'free_text' => array(
						'type'  => 'textarea',
						'label' => __('Free Text', 'wplab-unicum')
					),
					'email' => array(
						'type'  => 'text',
						'label' => __('Email', 'wplab-unicum')
					),
					'send_message_button_text' => array(
						'type'  => 'text',
						'label' => __('Send Message Button Text', 'wplab-unicum')
					),
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
		)
	),
	'styling' => array(
		'title' => __( 'Styling', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'name_text_color' => array(
				'label' => __('Name Text Color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
			'free_text_color' => array(
				'label' => __('Free Text Color', 'wplab-unicum'),
				'type' => 'color-picker',
			),
		)
	),
	'margins_paddings' => array(
		'title' => __( 'Margins and Paddings', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'margin_top' => array(
				'label' => __( 'Margin Top', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from top', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_right' => array(
				'label' => __( 'Margin Right', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from right', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_bottom' => array(
				'label' => __( 'Margin Bottom', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from bottom', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'margin_left' => array(
				'label' => __( 'Margin Left', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom margin from left', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_top' => array(
				'label' => __( 'Padding Top', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom top padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_right' => array(
				'label' => __( 'Padding Right', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom right padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_bottom' => array(
				'label' => __( 'Padding Bottom', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom bottom padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
			'padding_left' => array(
				'label' => __( 'Padding Left', 'wplab-unicum' ),
				'type' => 'short-text',
				'value' => '',
				'desc' => __( 'custom left padding', 'wplab-unicum' ),
				'help' => __( 'Type here some value and unit of measure, e.g.: 50px or 20em, or 10%', 'wplab-unicum' ),
			),
		)
	)
);