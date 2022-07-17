<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Rotpg_Enter_And_support_Widget extends \Elementor\Widget_Base {

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
		return 'bn_rotpg_enter_and_support';
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
		return __( 'BN Enter And Support', 'banow' );
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
		return 'fa fa-code';
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
		return [ 'general' ];
	}

	// Style file add
	public function get_style_depends() {
		return [ 'bn-plugin', 'bn-helpers', 'bn-main', 'bn-typography','bn-buttons', 'bn-spacing', 'bn-rotpg' ];
	}

	/**
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'rotpg_enter_section',
			[
				'label' => __( 'Rotpg Hero', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'rotpg_enter_top_section_image',
			[
				'label' => __( 'Choose Enter Top Section Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_enter_right_image',
			[
				'label' => __( 'Choose Rotpg Right Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_enter_right_bottom_left_image',
			[
				'label' => __( 'Choose Rotpg Right Bottom Left Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'rotpg_enter_item_title',
			[
				'label' => __( 'Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title', 'banow' ),
				'placeholder' => __( 'Type your Title', 'banow' ),
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_sub_title',
			[
				'label' => __( 'Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Sub Title', 'banow' ),
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_title_right_image',
			[
				'label' => __( 'Enter Title Left Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_right_image',
			[
				'label' => __( 'Enter Right Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_content',
			[
				'label' => __( 'Content', 'banow' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'banow' ),
				'placeholder' => __( 'Type your Content', 'banow' ),
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_left_image',
			[
				'label' => __( 'Enter left Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_btn',
			[
				'label' => __( 'Button', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Button', 'banow' ),
				'placeholder' => __( 'Type your Button Title', 'banow' ),
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_btn_link',
			[
				'label' => __( 'Item Link', 'banow' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'banow' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'rotpg_enter_item_button_right_image',
			[
				'label' => __( 'Enter Button Right Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_enter_item_list',
			[
				'label' => __( 'Enter Item List', 'banow' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'rotpg_enter_item_title' => __('Enter Item Title #1', 'banow'),
						'rotpg_enter_item_sub_title' => __('Enter Item Sub Title #1', 'banow')
					]
				],
				'title_field' => '{{{ rotpg_enter_item_title }}}',
			]
		);

		$this->end_controls_section();

		// Support
		$this->start_controls_section(
			'rotpg_support_section',
			[
				'label' => __( 'Support Section', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'rotpg_support_title',
			[
				'label' => __( 'Support Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Support Title', 'banow' ),
				'placeholder' => __( 'Type your Support Title Title', 'banow' ),
			]
		);
		$this->add_control(
			'rotpg_support_left_image',
			[
				'label' => __( 'Left Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_support_middle_image',
			[
				'label' => __( 'Middle Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_support_right_image',
			[
				'label' => __( 'Right Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'rotpg_support__sub_title',
			[
				'label' => __( 'Support Sub', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Support Sub', 'banow' ),
				'placeholder' => __( 'Type your Support Sub Title', 'banow' ),
			]
		);
		$this->add_control(
			'rotpg_support_bottom_image',
			[
				'label' => __( 'Support Bottom Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'rotpg_support_bottom_top_image',
			[
				'label' => __( 'Support Bottom Top Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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

		echo '<div class="rotpg">
		<div class="rotpg__enter rotpg__white-bg p-rel">

		<img class="rotpg__rip rotpg__rip--top" src="'.$settings['rotpg_enter_top_section_image']['url'].'" />
		<!-- RIP GOES HERE -->
		<div class="corset">
		<div class="row p-rel">
		<div class="col ofs-0 col-6-md ofs-1-md col-6-lg ofs-1-lg">';

		if ($settings['rotpg_enter_item_list']) {

			$first_item = $settings['rotpg_enter_item_list'][0];

			echo '<div class="my-lg">
			<div class="rotpg-h1 p-rel d-ib">
			'. $first_item['rotpg_enter_item_title'] .'

			<div class="rotpg-h1--wide">'.$first_item['rotpg_enter_item_sub_title'].'</div>
			<img class="p-abs" style="bottom:5px; right:-140px; transform: rotate(-6deg); height:130px;" src="'.$first_item['rotpg_enter_item_right_image']['url'].'" />
			</div>
			<div class="p-rel">
			'. $first_item['rotpg_enter_item_content'] .'
			<img class="p-abs" style="top:0; left:-100px; transform: rotate(20deg); height: 80px" src="'.$first_item['rotpg_enter_item_left_image']['url'].'" />
			</div>
			<div class="p-rel">
			<a class="btn" href="'.$first_item['rotpg_enter_item_btn_link']['url'].'">'.$first_item['rotpg_enter_item_btn'].'</a>
			<img class="p-abs" style="top:0; left:200px; transform: rotate(-50deg); height: 80px" src="'.$first_item['rotpg_enter_item_right_image']['url'].'" />
			</div>
			</div>';
		}

		if ($settings['rotpg_enter_item_list']) {

			$second_item = $settings['rotpg_enter_item_list'][1];

			echo '<div class="my-lg">
			<div class="rotpg-h1 p-rel d-ib">
			'. $second_item['rotpg_enter_item_title'] .'
			<div class="rotpg-h1--wide">'.$second_item['rotpg_enter_item_sub_title'].'</div>
			<img class="p-abs" style="bottom:-10px; right:-170px; transform: rotate(60deg); height:200px;" src="'.$second_item['rotpg_enter_item_right_image']['url'].'" />
			<img class="p-abs" style="top:-10px; left:-200px; transform: rotate(0deg); height:100px;" src="'.$second_item['rotpg_enter_item_title_right_image']['url'].'" />
			</div>
			<div class="p-rel">
			'. $second_item['rotpg_enter_item_content'] .'
			</div>
			<div class="p-rel">
			<a class="btn" href="'.$second_item['rotpg_enter_item_btn_link']['url'].'">'.$second_item['rotpg_enter_item_btn'].'</a>
			<img class="p-abs" style="top:20px; left:200px; height: 200px" src="'.$second_item['rotpg_enter_item_button_right_image']['url'].'" />
			<img class="p-abs" style="top:100px; left:-180px; height:100px;" src="'.$second_item['rotpg_enter_item_left_image']['url'].'" />
			</div>
			</div>';
		}

		echo '</div>
		<div class="fb-0 col col-4-md md-up jc-c "> <img class="w-100" src="'.$settings['rotpg_enter_right_image']['url'].'" />
		<img class="p-abs" style="bottom:-70px; left:-70px" src="'.$settings['rotpg_enter_right_bottom_left_image']['url'].'" />
		</div>
		</div>';


// Support Sction

		echo '<div class="row h-100" style="margin-top: 200px">
		<div class="col p-rel pt-lg">
		<div class="h3 ta-c mb-lg">'.$settings['rotpg_support_title'].'</div>
		<div class="rotpg__supported-container mb-lg">
		<div class="rotpg__supported-logo">
		<img src="'.$settings['rotpg_support_left_image']['url'].'" />
		</div>
		<div class="rotpg__supported-logo">
		<img src="'.$settings['rotpg_support_middle_image']['url'].'" />
		</div>
		<div class="rotpg__supported-logo">
		<img src="'.$settings['rotpg_support_right_image']['url'].'" />
		</div>
		</div>
		<div class="rotpg__notice">
		'. $settings['rotpg_support__sub_title'] .'
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="rotpg__sticker-bg p-rel" style="background-image:url('.$settings['rotpg_support_bottom_image']['url'].')">
		<img class="rotpg__rip rotpg__rip--top" src="'.$settings['rotpg_support_bottom_top_image']['url'].'" />
		</div>
		</div>';
	}
}





