<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'url'    => array(
		'type'  => 'text',
		'label' => __( 'Insert Video URL', 'wplab-unicum' ),
		'desc'  => __( 'Insert Video URL to embed this video', 'wplab-unicum' )
	),
	'lazy_load' => array(
		'label' => __('Lazy Load', 'wplab-unicum'),
		'desc' => __('Works only for YouTube videos', 'wplab-unicum'),
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
);
