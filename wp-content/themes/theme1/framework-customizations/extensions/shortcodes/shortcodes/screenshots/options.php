<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'images' => array(
    'type'  => 'multi-upload',
    'label' => __('Images', 'wplab-unicum'),
    'desc'  => __('Add images into Screenshots Carousel', 'wplab-unicum'),
    'images_only' => true,
	)
);