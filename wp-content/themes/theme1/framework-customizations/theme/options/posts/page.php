<?php 

/**
 * Get existing menus
 **/
$_existing_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

$_menus_array = array(
	'' => __('- Use Default menu -', 'wplab-unicum'),
);

if( !empty( $_existing_menus ) ) {
	foreach( $_existing_menus as $_menu_item ) {
		$_menus_array[ $_menu_item->slug ] = $_menu_item->name;
	}
}

/**
 * Page options array
 **/
$options = array(
	'main' => array(
		'title'   => __( 'Page Settings', 'wplab-unicum' ),
		'type'    => 'box',
		'options' => array(

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

			'enable_onepage_menu' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => __( 'One-page menu', 'wplab-unicum' ),
						'desc' => __( 'If enabled, theme menu will work as one-page menu', 'wplab-unicum' ),
						'type' => 'switch',
						'right-choice' => array(
							'value' => '1',
							'label' => __( 'Enabled', 'wplab-unicum' )
						),
						'left-choice' => array(
							'value' => '0',
							'label' => __( 'Disabled', 'wplab-unicum' )
						),
						'value' => '0',
					)
				),
				'choices' => array(
					'1' => array(
					
						'scroll_offset' => array(
							'label' => __( 'Scroll offset', 'wplab-unicum' ),
							'type'  => 'short-text',
							'value' => '50',
						),
						'scroll_speed' => array(
							'label' => __( 'Scroll speed', 'wplab-unicum' ),
							'type'  => 'short-text',
							'value' => '1100',
						),
						'scroll_easing' => array(
							'label' => __( 'Scroll easing', 'wplab-unicum' ),
							'desc' => __( 'this changes scrolling effect between sections', 'wplab-unicum' ),
							'type' => 'select',
							'value' => 'easeOutBack',
							'choices' => array(
								'jswing' => 'jswing',
								'def' => 'def',
								'easeInQuad' => 'easeInQuad',
								'easeOutQuad' => 'easeOutQuad',
								'easeInOutQuad' => 'easeInOutQuad',
								'easeInCubic' => 'easeInCubic',
								'easeOutCubic' => 'easeOutCubic',
								'easeInOutCubic' => 'easeInOutCubic',
								'easeInQuart' => 'easeInQuart',
								'easeOutQuart' => 'easeOutQuart',
								'easeInOutQuart' => 'easeInOutQuart',
								'easeInQuint' => 'easeInQuint',
								'easeOutQuint' => 'easeOutQuint',
								'easeInOutQuint' => 'easeInOutQuint',
								'easeInSine' => 'easeInSine',
								'easeOutSine' => 'easeOutSine',
								'easeInOutSine' => 'easeInOutSine',
								'easeInExpo' => 'easeInExpo',
								'easeOutExpo' => 'easeOutExpo',
								'easeInOutExpo' => 'easeInOutExpo',
								'easeInCirc' => 'easeInCirc',
								'easeOutCirc' => 'easeOutCirc',
								'easeInOutCirc' => 'easeInOutCirc',
								'easeInElastic' => 'easeInElastic',
								'easeOutElastic' => 'easeOutElastic',
								'easeInOutElastic' => 'easeInOutElastic',
								'easeInBack' => 'easeInBack',
								'easeOutBack' => 'easeOutBack',
								'easeInOutBack' => 'easeInOutBack',
								'easeInBounce' => 'easeInBounce',
								'easeOutBounce' => 'easeOutBounce',
								'easeInOutBounce' => 'easeInOutBounce',
							),
						),
					
					)
				)
			),
			
			'page_menu' => array(
				'label' => __( 'Custom header menu', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '',
				'choices' => $_menus_array,
				'desc' => __( 'Here you can change a header menu only for current page', 'wplab-unicum' ),
			),

		),
	),
);