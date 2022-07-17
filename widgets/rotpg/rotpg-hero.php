<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Rotpg_Hero_Widget extends \Elementor\Widget_Base {
	
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
    	return "bn_rotpg_hero";
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
    	return __("BN Rotpg Hero", "banow");
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
    	return "fa fa-code";
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
    	return ["general"];
    }

    // Style file add
    public function get_style_depends() {
    	return [
    		"bn-plugin",
    		"bn-helpers",
    		"bn-main",
    		"bn-typography",
    		"bn-spacing",
    		"bn-rotpg",
    	];
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
    		"rotpg_hero_section",
    		[
    			"label" => __("Rotpg Hero", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$this->add_control(
    		"rotpg_hero_title",
    		[
    			"label" => __("Rotpg Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Rotpg Title", "banow"),
    			"placeholder" => __("Type your Title", "banow"),
    		]
    	);

    	$this->add_control(
    		"rotpg_hero_bg_image",
    		[
    			"label" => __("Choose Rotpg Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
    			],
    		]
    	);

    	$this->add_control(
    		"rotpg_hero_bottom_image",
    		[
    			"label" => __("Choose Rotpg Bottom Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
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

    	echo '<div class="rotpg__hero p-rel" alt="Rise of the Pub Gig" style="background-image: url(' . $settings["rotpg_hero_bg_image"]["url"] . ')">
    	<div class="corset h-100">
    	<div class="row h-100">
    	<div class="col p-rel h-100">
    	<div class="rotpg__hero-tag rotpg__hero-tag--high">
    	'. $settings["rotpg_hero_title"] .'
    	</div>
    	</div>
    	</div>
    	</div>
    	'. wp_get_attachment_image($settings["rotpg_hero_bottom_image"]["id"], "full", false, ["class" => "rotpg__rip rotpg__rip--bottom"] ) .'
    	</div>';
    }
}
