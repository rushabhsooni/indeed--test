<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

use Elementor\Utils;

class Elementor_uae_info_box extends \Elementor\Widget_Base {

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
		return 'infobox';
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
		return __( 'Info Box', 'uae' );
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
		return 'fa fa-info-circle';
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
		wp_enqueue_style( 'uae-info-box', plugins_url( '../css/infobox.css' , __FILE__ ));
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'uae' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __( 'Select Style', 'uae' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
		     		'mega_info_box' 	=> esc_html__('Vertical', 'uae'),
		     		'mega_info_box_2' 	=> esc_html__('Horizental', 'uae'),
				],
				'default' 		=> 'mega_info_box',
			]
		);

		$this->add_control(
			'info_opt',
			[
				'label' => __( 'Select Image or Font icon', 'uae' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
		     		'show_image' 	=> esc_html__('Image', 'uae'),
		     		'show_icon' 	=> esc_html__('Font Icon', 'uae'),
				],
				'default' 		=> 'show_image',
			]
		);	

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'info_opt' => 'show_image',
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'info_opt' => 'show_image',
				],
			]
		);

		$this->add_control(
			'info_icon',
			[
				'label' => __( 'Icon', 'uae' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'      => esc_html__('Icon Font Size', 'uae'),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'size_units' => ['px'],
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'icon_width',
			[
				'label'      => esc_html__('Background Size', 'uae'),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'size_units' => ['px'],
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'infoclr',
			[
				'label' => __( 'Icon Color', 'uae' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'infobg',
			[
				'label' => __( 'Icon Background', 'uae' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'uae' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
		     		'0px' 	=> esc_html__('0px', 'uae'),
		     		'1px' 	=> esc_html__('1px', 'uae'),
		     		'2px' 	=> esc_html__('2px', 'uae'),
		     		'3px' 	=> esc_html__('3px', 'uae'),
		     		'5px' 	=> esc_html__('5px', 'uae'),
		     		'7px' 	=> esc_html__('7px', 'uae'),
		     		'10px' 	=> esc_html__('10px', 'uae'),
		     		'15px' 	=> esc_html__('15px', 'uae'),
				],
				'default' 		=> '0px',
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' => __( 'Border Style', 'uae' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
		     		'solid' 	=> esc_html__('Solid', 'uae'),
		     		'dotted' 	=> esc_html__('Dotted', 'uae'),
		     		'rige' 		=> esc_html__('Rige', 'uae'),
		     		'dashed' 	=> esc_html__('Dashed', 'uae'),
		     		'double' 	=> esc_html__('Double', 'uae'),
		     		'groove' 	=> esc_html__('Groove', 'uae'),
		     		'inset' 	=> esc_html__('Inset', 'uae'),
				],
				'default' 		=> 'solid',
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);

		$this->add_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 	'border_radius',
				'label'      => esc_html__('Border Radius', 'uae'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .uae-info-box img, .uae-info-box i' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'border_clr',
			[
				'label' => __( 'Border Color', 'uae' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '',
				'condition' => [
					'info_opt' => 'show_icon',
				],
			]
		);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'detail', 
			[
				'label'         => esc_html__('Info Detail', 'uae' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'info_title',
			[
				'label' => __( 'Title', 'uae' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'title_clr',
			[
				'label' => __( 'Title Color', 'uae' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'uae'),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uae-info-box .mega-info-title',
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Info Description', 'uae' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button', 
			[
				'label'         => esc_html__('Button', 'uae' ),
				'tab'           => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_title',
			[
				'label' => __( 'Button Text', 'uae' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => __('Link To', 'uae'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'uae'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __('Typography', 'uae'),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uae-info-box .mega-info-btn',
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
		 
		$target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

		//echo ( $html ) ? $html : $settings['url'];

		/************HTML CODING START*************/
		?>

		<div class="<?php echo $settings['effect']; ?> uae-info-box">
			<div class="mega-info-header">
				<?php if ($settings['info_opt'] == 'show_image') { ?>
					<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
				<?php } ?>
				<?php if ($settings['info_opt'] == 'show_icon') { ?>
					<i class="<?php echo $settings['info_icon']; ?>" aria-hidden="true" style="border: <?php echo $settings['border_width']; ?> <?php echo $settings['border_style']; ?> <?php echo $settings['border_clr']; ?>; border-radius: <?php echo $icon_radius; ?>; background: <?php echo $settings['infobg']; ?>; width: <?php echo $settings['icon_width']; ?>px; height: <?php echo $settings['icon_width']; ?>px; line-height: <?php echo $settings['icon_width']-$settings['border_width']*2; ?>px; font-size: <?php echo $settings['icon_size']; ?>px; color: <?php echo $settings['infoclr']; ?>;"></i>
				<?php } ?>
			</div>
			<div class="mega-info-footer">
				<h3 class="mega-info-title" style="color: <?php echo $settings['title_clr']; ?>;">
					<?php echo $settings['info_title']; ?>
				</h3>
				<div class="mega-info-desc">
					<?php echo $settings['content']; ?>
				</div>
				<a href="<?php echo $settings['btn_link']['url']; ?>" <?php echo $target.$nofollow; ?> style="color: #3eb4e6;">
					<?php echo $settings['btn_title']; ?>
				</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php  
		/************HTML CODING END*************/

	}
}