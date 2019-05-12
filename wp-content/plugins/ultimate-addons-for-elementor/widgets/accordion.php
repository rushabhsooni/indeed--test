<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

use Elementor\Utils;

class Elementor_uae_accordion extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'css accordion';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Accordion', 'uae' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-plus-square';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ultimate-addons' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		wp_enqueue_style( 'accordion-css', plugins_url( '../css/accordion.css' , __FILE__ ));
		wp_enqueue_script( 'accordion-js', plugins_url( '../js/front/accordion.js' , __FILE__ ), array('jquery', 'jquery-ui-accordion'));
		
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'Accordion', 'uae' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'uae' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'titlebg',
			[
				'label'      => esc_html__('Title Background', 'uae'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
			]
		);

		$repeater->add_control(
			'borderclr',
			[
				'label'      => esc_html__('Border Color', 'uae'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
			]
		);

		$repeater->add_control(
			'desc_heading',
			[
				'label' => __('Description Section', 'uae'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'descbg',
			[
				'label'      => esc_html__('Description Background', 'uae'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
			]
		);

		$repeater->add_control(
			'borderclr2',
			[
				'label'      => esc_html__('Border Color', 'uae'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
			]
		);

		$repeater->add_control(
			'content',
			[
				// 'label' => esc_html__( 'Banner Description', 'uae' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'list_items',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'theme' => __( 'left', 'plugin-domain' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'accordions', 
			[
				'label'        => esc_html__('Title', 'uae' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titleclr',
			[
				'label'      => esc_html__('Title Color', 'uae'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __('Typography', 'uae'),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mega-accordion .ac-style',
			]
		);

		$this->add_responsive_control(
			'margin_tab',
			[
				'label' => __( 'Margin', 'uae' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mega-accordion .ac-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'uae' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mega-accordion .ac-style' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'uae' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mega-accordion .ac-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'desc', 
			[
				'label'         => esc_html__('Description', 'uae' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography2',
				'label' => __('Typography', 'uae'),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mega-accordion .mega-panel > *',
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label' => __( 'Padding', 'uae' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mega-accordion .mega-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'border_width2',
			[
				'label' => __( 'Border Width', 'uae' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mega-accordion .mega-panel' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		// $html = wp_oembed_get( $settings['ihe_link'] );
		 
		// $target = $settings['ihe_link']['is_external'] ? ' target="_blank"' : '';
		// $nofollow = $settings['ihe_link']['nofollow'] ? ' rel="nofollow"' : '';

		//echo ( $html ) ? $html : $settings['url'];

		/************HTML CODING START*************/
		?>

		<div class="mega-accordion">
			<?php foreach ($settings['list_items'] as $list_items) { ?>
				<h3 class="ac-style" style="border-style: solid; border-color: <?php echo $list_items['borderclr']; ?>; color: <?php echo $settings['titleclr']; ?>; background: <?php echo $list_items['titlebg']; ?>;">
					<?php echo $list_items['title']; ?>
				</h3>
				<div class="mega-panel" style="margin-bottom: <?php echo $titlemargin; ?>px; background: <?php echo $list_items['descbg']; ?>; border-width: <?php echo $borderwidth2; ?>; border-style: solid; border-color: <?php echo $list_items['borderclr2']; ?>;">
				  <?php echo $list_items['content']; ?>
				</div>
			<?php } ?>
		</div>

		<?php  
		/************HTML CODING END*************/

	}
}