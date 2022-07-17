<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_HIWA_Hero_Widget extends \Elementor\Widget_Base {

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
		return 'bn_artists_hiwa_hero';
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
		return __( 'BN Artists HIWA Hero', 'banow' );
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
		return [ 'bn-plugin', 'bn-helpers', 'bn-main', 'bn-typography', 'bn-spacing' ];
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
			'hiwa_hero_section',
			[
				'label' => __( 'Artists HIWA Hero', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hiwa_hero_title',
			[
				'label' => __( 'Artist Artists HIWA Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Artist HIWA Title', 'banow' ),
				'placeholder' => __( 'Type your Artist HIWA Title', 'banow' ),

			]
		);

		$this->add_control(
			'hiwa_hero_sub_title',
			[
				'label' => __( 'Artists HIWA Sub Title', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Artists HIWA Sub Title', 'banow' ),
				'placeholder' => __( 'Type your Artists HIWA Sub Title', 'banow' ),
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

		echo '<div class="ta-c margin-top">
		<h1>'.$settings['hiwa_hero_title'].'</h1>
		<p>'.$settings['hiwa_hero_sub_title'].'</p>
		</div>';
	}
}

