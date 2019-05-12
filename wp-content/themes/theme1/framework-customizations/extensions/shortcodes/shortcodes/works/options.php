<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'general' => array(
		'title' => __( 'General', 'wplab-unicum' ),
		'type' => 'tab',
		'options' => array(

			'section_header_style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'header_style' => '',
				),
				'picker' => array(
					'header_style' => array(
						'label' => __( 'Section header style', 'wplab-unicum' ),
						'type' => 'radio',
						'choices' => array(
							'default' => __( 'Title on left, filters on right', 'wplab-unicum' ),
							'centered' => __( 'Without title, center filters', 'wplab-unicum' ),
						),
					)
				),
				'choices' => array(
					'default' => array(
					
						'title' => array(
							'label' => __( 'Section title', 'wplab-unicum' ),
							'type' => 'text',
							'value' => __( 'Latest Works', 'wplab-unicum' )
						),
					
					),

				)
			),
			'display_filters' => array(
				'label' => __('Display Filters', 'wplab-unicum'),
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
			'filters_all_text' => array(
				'label' => __( '"All works" link text', 'wplab-unicum' ),
				'type' => 'text',
				'value' => __( 'All categories', 'wplab-unicum' )
			),
			'display_load_more' => array(
				'label' => __('Display "Load more" link', 'wplab-unicum'),
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
			'read_more_title' => array(
				'label' => __( '"Read more" link text', 'wplab-unicum' ),
				'type' => 'text',
				'value' => __( 'Load More Works', 'wplab-unicum' )
			),
			'row_height' => array(
				'label' => __( 'Images Max Height', 'wplab-unicum' ),
				'type' => 'text',
				'value' => 400
			),
			'row_min_height' => array(
				'label' => __( 'Images Min Height', 'wplab-unicum' ),
				'type' => 'text',
				'value' => 200
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
					'menu_order' => __('Menu', 'wplab-unicum')
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