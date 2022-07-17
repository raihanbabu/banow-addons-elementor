<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_five_star_review_Widget extends \Elementor\Widget_Base {

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
		return 'bn_five_star_review';
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
		return __( 'BN Five Star Review', 'banow' );
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

		return [ 'bn-plugin', 'bn-helpers', 'bn-main', 'bn-typography', 'bn-spacing', 'bn-five-star-reviews' ];

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
			'fivestarreview_section',
			[
				'label' => __( 'Five Star Review', 'banow' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]

		);

		$this->add_control(
			'fivestarreview_image',
			[
				'label' => __( 'Choose Five Star Review Image', 'banow' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'fivestarreview_content_before',
			[
				'label' => __( 'Before Content', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Before Content', 'banow' ),
				'placeholder' => __( 'Type your Before Content', 'banow' ),
			]
		);

		$this->add_control(
			'fivestarreview_content_after',
			[
				'label' => __( 'After Content', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'After Content', 'banow' ),
				'placeholder' => __( 'Type your After Content', 'banow' ),
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

	// API

	$fiveStarCount = file_get_contents('https://api.musoapp.com.au/public/fiveStarCount.php');

	$feedback_count = json_decode($fiveStarCount);

		echo '<div id="lp-fsr" class="corset lp-fsr margin-top">
		<div class="row">
		  <div class="col-12">
		    <div class="fd-c ai-c jc-c">
		      <div>
		          <img alt="" class="lp-fsr__star" src="'.$settings['fivestarreview_image']['url'].'">
		          <img alt="" class="lp-fsr__star" src="'.$settings['fivestarreview_image']['url'].'">
		          <img alt="" class="lp-fsr__star" src="'.$settings['fivestarreview_image']['url'].'">
		          <img alt="" class="lp-fsr__star" src="'.$settings['fivestarreview_image']['url'].'">
		          <img alt="" class="lp-fsr__star" src="'.$settings['fivestarreview_image']['url'].'">
		        </div>
		        <div>

		          '. $settings['fivestarreview_content_before'] .'

		        	  <span id="lp-fsr-number" class="lp-fsr__number"> '.$feedback_count->data->fiveStarReviews.' </span>

		          '. $settings['fivestarreview_content_after'] .'

		        </div
		        </div>
		      </div>
		    </div>
		</div>';
	}
}

