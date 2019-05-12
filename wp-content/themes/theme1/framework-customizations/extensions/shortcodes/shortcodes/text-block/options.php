<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'text' => array(
		'type'   => 'wp-editor',
		'teeny'  => false,
		'reinit' => true,
		'label'  => __( 'Content', 'wplab-unicum' ),
		'desc'   => __( 'Enter some content for this texblock', 'wplab-unicum' )
	),
);
