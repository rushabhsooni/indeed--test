<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Option_Type_Table extends FW_Option_Type
{
	protected function _init() {}

	public function get_type() {
		return 'table';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static( $id, $option, $data ) {
		$table_shortcode = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'table' );

		$static_uri = $table_shortcode->get_declared_uri() . '/includes/fw-option-type-table/static/';

		wp_enqueue_style( 'fw-font-awesome' );

		wp_enqueue_style(
			'fw-option-' . $this->get_type() . '-default',
			$static_uri . 'css/default-styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		wp_enqueue_style(
			'fw-option-' . $this->get_type() . '-extended',
			$static_uri . 'css/extended-styles.css',
			array(),
			fw()->theme->manifest->get_version()
		);
		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$static_uri . 'js/scripts.js',
			array( 'jquery', 'fw-events', 'jquery-ui-sortable' ),
			fw()->theme->manifest->get_version(),
			true
		);

		wp_localize_script(
			'fw-option-' . $this->get_type(),
			'localizeTableBuilder',
			array(
				'msgEdit' => __( 'Edit', 'wplab-unicum' ),
				'maxCols' => apply_filters( 'fw_ext_shortcodes_table_max_columns', 6 )
			)
		);
		fw()->backend->option_type( 'popup' )->enqueue_static();
		fw()->backend->option_type( 'textarea-cell' )->enqueue_static();
	}


	/**
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {
		$table_shortcode = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'table' );

		if ( ! $table_shortcode ) {
			trigger_error(
				esc_html__( 'table-builder option type must be inside the table shortcode', 'wplab-unicum' ),
				E_USER_ERROR
			);
		}

		if ( ! isset( $data['value'] ) || empty( $data['value'] ) ) {
			$data['value'] = $option['value'];
		}

		$this->replace_with_defaults( $option );
		$view_path = $table_shortcode->get_declared_path() . '/includes/fw-option-type-table/views/view.php';

		return fw_render_view( $view_path, array(
			'id'     => $option['attr']['id'],
			'option' => $option,
			'data'   => $data,
		) );
	}

	protected function replace_with_defaults( &$option ) {
		$defaults                                           = $this->_get_defaults();
		$option['header_options']                           = $defaults['header_options'];
		$option['row_options']                              = $defaults['row_options'];
		$option['columns_options']                          = $defaults['columns_options'];
		$option['content_options']                          = $defaults['content_options'];
		$option['row_options']['name']['attr']['class']     = isset( $option['row_options']['name']['attr']['class'] ) ? $option['row_options']['name']['attr']['class'] . ' fw-table-builder-row-style' : 'fw-table-builder-row-style';
		$option['columns_options']['name']['attr']['class'] = isset( $option['columns_options']['name']['attr']['class'] ) ? $option['columns_options']['name']['attr']['class'] . ' fw-table-builder-col-style' : 'fw-table-builder-col-style';
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
		if ( ! is_array( $input_value ) ) {
			/**
			 * Execute get_value_from_input() on custom options
			 * because there may be `unique` option type that it must be updated
			 */
			foreach (array('button-row') as $row_type) {
				if (empty($option['content_options'][$row_type])) {
					continue;
				}

				$only_options = fw_extract_only_options($option['content_options'][$row_type]);

				foreach ($option['value']['rows'] as $i => $row) {
					if ($row['name'] !== $row_type || empty($option['value']['content'][$i])) {
						continue;
					}

					foreach ($option['value']['content'][$i] as &$row_values) {
						/**
						 * Move values in each $option['value'] because these values are in db format
						 * not $inpute_value (html) format
						 */
						foreach ($only_options as $o_id => $o_o) {
							if (isset($row_values[$o_id])) {
								$only_options[$o_id]['value'] = $row_values[$o_id];
							} else {
								unset($only_options[$o_id]['value']);
							}
						}

						$row_values = fw_get_options_values_from_input($only_options, array());
					}
				}
			}

			return $option['value'];
		}

		if ( ! isset( $input_value['content'] ) || empty( $input_value['content'] ) ) {
			$input_value['content'] = $option['value']['content'];
		}

		if ( ! isset( $input_value['rows'] ) || empty( $input_value['rows'] ) ) {
			$input_value['rows'] = $option['value']['rows'];
		}

		if ( ! isset( $input_value['cols'] ) || empty( $input_value['cols'] ) ) {
			$input_value['cols'] = $option['value']['cols'];
		}

		if ( isset( $input_value['content']['_template_key_row_'] ) ) {
			unset( $input_value['content']['_template_key_row_'] );
		}

		if ( isset( $input_value['rows']['_template_key_row_'] ) ) {
			unset( $input_value['rows']['_template_key_row_'] );
		}

		$value = array();

		if ( is_array( $input_value ) ) {
			if ( isset( $input_value['rows'] ) ) {
				$i = 0;
				foreach ($input_value['rows'] as $input_val) {
					$value['rows'][$i] = $input_val;
					$i++;
				}
			}

			if ( isset( $input_value['cols'] ) && is_array($input_value['cols']) ) {
				$value['cols'] =  $input_value['cols'] ;
			}

			if ( isset( $input_value['header_options'] ) and is_array( $input_value['header_options'] ) ) {
				$value['header_options'] = $input_value['header_options'];
			}

			if ( isset( $input_value['content'] ) && is_array( $input_value['content'] ) ) {
				$row_count = 0;
				foreach ( $input_value['content'] as $row => $input_value_rows_data ) {
					$cols = array();

					foreach ( $input_value_rows_data as $column => $input_value_cols_data ) {
						$row_name = $input_value['rows'][ $row ]['name'];

						foreach ( $option['content_options'][ $row_name ] as $id => $options ) {
							if ( $value['cols'][$column]['name'] == 'desc-col' ) {
								$cols[ $column ][ 'textarea' ]
									= fw()->backend->option_type( 'textarea-cell' )->get_value_from_input(
										$options,
										$input_value_cols_data[ 'default-row' ][ 'textarea-' . $row . '-' . $column ]
									);
								continue;
							}
							$cols[ $column ][ $id ]
								= fw()->backend->option_type( $options['type'] )->get_value_from_input(
									$options,
									$input_value_cols_data[ $row_name ][ $id . '-' . $row . '-' . $column ]
								);
						}

					}
					$value['content'][ $row_count++ ] = $cols;
				}
			}
		}

		return $value;
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		/** @var FW_Extension_Shortcodes $shortcodes */
		$shortcodes = fw_ext('shortcodes');
		/** @var FW_Shortcode_Table $table */
		$table = $shortcodes->get_shortcode('table');
		
		return apply_filters( 'fw_option_type_table_defaults', array(
			'header_options'  => array(
				'table_purpose' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Table Styling', 'wplab-unicum' ),
					'desc'    => esc_html__( 'Choose the table styling options', 'wplab-unicum' ),
					'choices' => array(
						'pricing' => esc_html__( 'Use the table as a pricing table', 'wplab-unicum' ),
						'tabular' => esc_html__( 'Use the table to display tabular data', 'wplab-unicum' ),
					),
					'value'   => 'pricing',
					'attr'    => array(
						'data-allowed-rows' => json_encode( array(
								'pricing' => 'default-row heading-row features-row pricing-row button-row alt-heading-row personal-heading-row',
								'tabular' => 'default-row heading-row'
							)
						),
						'data-allowed-cols' => json_encode( array(
							'pricing' => 'default-col highlight-col desc-col',
							'tabular' => 'default-col desc-col'
						) ),
					)
				)
			),
			'row_options'     => array(
				'name' => array(
					'type'    => 'select',
					'label'   => false,
					'desc'    => false,
					'choices' => array(
						'heading-row' => esc_html__( 'Image Heading row', 'wplab-unicum' ),
						'alt-heading-row' => esc_html__( 'Colorful heading', 'wplab-unicum' ),
						'personal-heading-row' => esc_html__( 'Personal Pricing heading', 'wplab-unicum' ),
						'pricing-row' => esc_html__( 'Colorful pricing row', 'wplab-unicum' ),
						'default-row' => esc_html__( 'Default row', 'wplab-unicum' ),
						'features-row' => esc_html__( 'Features', 'wplab-unicum' ),						
						'button-row'  => esc_html__( 'Button row', 'wplab-unicum' )
					),
				)
			),
			'columns_options' => array(
				'name' => array(
					'type'    => 'select',
					'label'   => false,
					'desc'    => false,
					'choices' => array(
						'default-col'   => esc_html__( 'Default column', 'wplab-unicum' ),
						'highlight-col' => esc_html__( 'Highlight column', 'wplab-unicum' )
					),
				)
			),
			'content_options' => array(
				'heading-row' => array(
					'title' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Plan Title', 'wplab-unicum')
						),
					),
					'price' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Price, e.g.: $20', 'wplab-unicum')
						),
					),
					'period' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('From %price% per month', 'wplab-unicum')
						),
					),
					'image' => array(
				    'type'  => 'upload',
				    'label' => esc_html__('Background image', 'wplab-unicum'),
				    'images_only' => true,
					),

				),			
				'alt-heading-row' => array(
					'header_title' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Plan Title', 'wplab-unicum')
						),
					),
					'header_desc' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Short Plan Description', 'wplab-unicum')
						),
					),
					'header_color_left' => array(
				    'type'  => 'color-picker',
				    'value' => '#8dc73f',
						'attr' => array(
							'placeholder' => esc_html__('Left gradient color', 'wplab-unicum')
						),
					),
					'header_color_right' => array(
				    'type'  => 'color-picker',
				    'value' => '#3bb678',
						'attr' => array(
							'placeholder' => esc_html__('Right gradient color', 'wplab-unicum')
						),
					),
				),
				'personal-heading-row' => array(
					'p_header_price' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Price', 'wplab-unicum')
						),
					),
					'p_header_title' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Plan Title', 'wplab-unicum')
						),
					),
					'p_header_desc' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Short Plan Description', 'wplab-unicum')
						),
					),
					'p_header_accent_color' => array(
				    'type'  => 'color-picker',
				    'value' => '#8dc73f',
						'attr' => array(
							'placeholder' => esc_html__('Accent color', 'wplab-unicum')
						),
					),
				),
				'pricing-row' => array(
					'price_text' => array(
						'type'  => 'text',
						'attr' => array(
							'placeholder' => esc_html__('Price', 'wplab-unicum')
						),
					),
					'price_color' => array(
				    'type'  => 'color-picker',
						'attr' => array(
							'placeholder' => esc_html__('Color', 'wplab-unicum')
						),
				    'label' => esc_html__('Price Color', 'wplab-unicum'),
					),
				),
				'default-row' => array(
					'textarea' => array(
						'type'  => 'text',
						'label' => false,
						'desc'  => false,
						'value' => '',
						'attr' => array(
							'placeholder' => esc_html__('Plan description', 'wplab-unicum'),
						),
					)
				),
				'features-row' => array(
					'feature_icon' => array(
						'type'          => 'popup',
						'popup-title'   => esc_html__( 'Edit Plan Features', 'wplab-unicum' ),
						'button'        => esc_html__( 'Edit Plan Features', 'wplab-unicum' ),
						'popup-options' => array(
						
							'features' => array(
								'type'          => 'addable-popup',
								'label'         => esc_html__( 'Features list', 'wplab-unicum' ),
								'popup-title'   => esc_html__( 'Add/Edit Feature', 'wplab-unicum' ),
								'desc'          => esc_html__( 'Add a Feature', 'wplab-unicum' ),
								'template'      => '{{=feature_title}}',
								'popup-options' => array(
									'feature_title' => array(
										'type'  => 'text',
										'attr' => array(
											'placeholder' => esc_html__('Feature title', 'wplab-unicum')
										),
									),
									'icon' => array(
										'type' => 'icon',
										'value' => 'fa-check'
									),
									'icon_color' => array(
								    'type'  => 'color-picker',
								    'value' => '#b1d750',
										'attr' => array(
											'placeholder' => esc_html__('Left gradient color', 'wplab-unicum')
										),
									),
								),
							),
						
						)
					)
				),				
				'button-row'  => array(
					'button' => ($button = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'button' ))
						? array(
							'type'          => 'popup',
							'popup-title'   => esc_html__( 'Button', 'wplab-unicum' ),
							'button'        => esc_html__( 'Add', 'wplab-unicum' ),
							'popup-options' => $button->get_options()
						)
						: array()
				),

			),
			'value'           => array(
				'header_options' => array(
					'table_purpose' => 'pricing',
				),
				'cols'    => array(
					array( 'name' => 'default-col' ),
					array( 'name' => 'default-col' ),
					array( 'name' => 'default-col' )
				),
				'rows'    => array(
					array( 'name' => 'default-row' ),
					array( 'name' => 'default-row' ),
					array( 'name' => 'default-row' )
				),
				'content' => $this->_fw_generate_default_values()
			)
		) );
	}

	private function _fw_generate_default_values( $cols = 3, $rows = 3 ) {
		$result = array();
		for ( $i = 0; $i < $rows; $i ++ ) {
			for ( $j = 0; $j < $cols; $j ++ ) {
				$result[ $i ][ $j ] = array(
					'textarea' => '',
					'amount' => '',
					'description' => '',
					'switch' => 'no',
					'button' => '',
				);
			}
		}

		return $result;
	}


	/**
	 * @internal
	 */
	public function _get_backend_width_type() {
		return 'full';
	}

}

FW_Option_Type::register( 'FW_Option_Type_Table' );
