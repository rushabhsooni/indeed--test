<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'video_html_before' => array(
    'type'  => 'wp-editor',
    'value' => '',
    'label' => __('Free text', 'wplab-unicum'),
    'value'  => '',
    'tinymce' => true,
    'media_buttons' => false,
    'teeny' => true,
    'wpautop' => true,
    'reinit' => true,
    'size' => 'large',
    'editor_type' => 'tinymce',
    'editor_height' => 200
	),
	'video_url' => array(
		'label' => __('Video URL', 'wplab-unicum'),
		'desc' => __('Will be opened in LightBox', 'wplab-unicum'),
		'type' => 'text',
		'value' => ''
	),
	'video_title' => array(
		'label' => __('Video Title', 'wplab-unicum'),
		'type' => 'text',
		'value' => ''
	),
	'video_subtitle' => array(
		'label' => __('Video Sub Title', 'wplab-unicum'),
		'type' => 'text',
		'value' => ''
	),
	'custom_color' => array(
		'label' => __('Custom Text Color', 'wplab-unicum'),
		'type' => 'color-picker',
	),
);