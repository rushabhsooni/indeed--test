<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'general' => array(
		'title' => __( 'General', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(

			'display_pagination' => array(
				'label' => __('Display Pagination', 'wplab-unicum'),
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
			),

		)
	),
	'query' => array(
		'title' => __( 'Query', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(
			'posts_per_page' => array(
				'label' => __( 'Posts per page', 'wplab-unicum' ),
				'type' => 'text',
				'value' => '10'
			),
			'order_by' => array(
				'label' => __( 'Posts ordering method', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'date' => __('Date', 'wplab-unicum' ),
					'ID' => 'ID',
					'modified' => __('Modified date', 'wplab-unicum' ),
					'title' => __('Title', 'wplab-unicum'),
					'rand' => __('Random', 'wplab-unicum'),
					'menu' => __('Menu', 'wplab-unicum')
				),
			),
			'sort_by' => array(
				'label' => __( 'Posts sorting method', 'wplab-unicum' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'DESC' => __('Descending', 'wplab-unicum'),
					'ASC' => __('Ascending', 'wplab-unicum'),
				),
			),
			'taxonomy_query' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'tax_query_type' => '',
				),
				'picker' => array(
					'tax_query_type' => array(
						'label' => __( 'Query from category', 'wplab-unicum' ),
						'type' => 'radio',
						'choices' => array(
							'' => __( 'All', 'wplab-unicum' ),
							'only' => __( 'Only', 'wplab-unicum' ),
							'except' => __( 'Except', 'wplab-unicum' ),
						),
					)
				),
				'choices' => array(
					'only' => array(
					
						'cats_include' => array(
							'label' => __('Categories', 'wplab-unicum'),
							'desc' => __('Type here category slugs to include or exclude, based on previous parameter. Explode multiple categories slugs by comma', 'wplab-unicum'),
							'type' => 'textarea',
							'value' => ''
						),
					
					),
					'except' => array(
					
						'cats_exclude' => array(
							'label' => __('Categories', 'wplab-unicum'),
							'desc' => __('Type here category slugs to include or exclude, based on previous parameter. Explode multiple categories slugs by comma', 'wplab-unicum'),
							'type' => 'textarea',
							'value' => ''
						),
					
					),
				)
			),
		)
	),
);