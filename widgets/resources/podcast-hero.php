<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Podcast_Hero_Widget extends \Elementor\Widget_Base {

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
    	return "bn_podcast_hero";
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
    	return __("BN Podcast Hero", "banow");
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
    		"podcast_hero_section",
    		[
    			"label" => __("Podcast Hero", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$this->add_control(
    		"podcast_hero_title",
    		[
    			"label" => __("Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Title", "banow"),
    			"placeholder" => __("Type your Title", "banow"),
    		]
    	);

    	$this->add_control(
    		"podcast_hero_sub_title",
    		[
    			"label" => __("Sub title Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Sub title Title", "banow"),
    			"placeholder" => __("Type your Sub title Title", "banow"),
    		]
    	);

    	$this->add_control(
    		"podcast_hero_content",
    		[
    			"label" => __("Content", "banow"),
    			"type" => \Elementor\Controls_Manager::WYSIWYG,
    			"default" => __("Content", "banow"),
    			"placeholder" => __("Type your Content here", "banow"),
    		]
    	);

    	$this->add_control(
    		"podcast_apple_image",
    		[
    			"label" => __("Apple Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
    			],
    		]
    	);

    	$this->add_control(
    		"podcast_apple_image_link",
    		[
    			"label" => __("Link", "banow"),
    			"type" => \Elementor\Controls_Manager::URL,
    			"placeholder" => __("#", "banow"),
    			"show_external" => true,
    			"default" => [
    				"url" => "",
    				"is_external" => true,
    				"nofollow" => true,
    			],
    		]
    	);

    	$this->add_control(
    		"podcast_spotify_image",
    		[
    			"label" => __("Spotify Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
    			],
    		]
    	);

    	$this->add_control(
    		"podcast_spotify_image_link",
    		[
    			"label" => __("Link", "banow"),
    			"type" => \Elementor\Controls_Manager::URL,
    			"placeholder" => __("#", "banow"),
    			"show_external" => true,
    			"default" => [
    				"url" => "",
    				"is_external" => true,
    				"nofollow" => true,
    			],
    		]
    	);

    	$this->add_control(
    		"podcast_bg_right",
    		[
    			"label" => __("Podcast right Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
    			],
    		]
    	);

    	$this->end_controls_section();
    	$this->start_controls_section(
    		"podcast_featured_iframe_section",
    		[
    			"label" => __("Podcast Feature Iframe Link", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$this->add_control(
    		"podcast_featured_iframe_link",
    		[
    			"label" => __("Iframe Link", "banow"),
    			"type" => \Elementor\Controls_Manager::URL,
    			"placeholder" => __("#", "banow"),
    			"show_external" => true,
    			"default" => [
    				"url" => "#",
    				"is_external" => true,
    				"nofollow" => true,
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

    	echo '<div class="corset margin-top">
    	<div class="row">
    	<div class="col-12 col-6-lg ofs-1-lg">
    	<div class="row">
    	<div class="col-12">
    	<h1>' . $settings["podcast_hero_title"] . '</h1>
    	<h3>' . $settings["podcast_hero_sub_title"] . '</h3>
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-6 col-12-lg">

    		'. $settings["podcast_hero_content"] .'

    	<div class="fd-c ai-fs" style="margin-top: 25px;">
    	<a target="_blank" href="' . $settings["podcast_apple_image_link"]["url"] . '" style="padding: 10px;">
    		'.wp_get_attachment_image($settings["podcast_apple_image"]["id"], "full", false, ["class" => "podcast-hero-image"] ) .'
    	</a>
    	<a target="_blank" href="' . $settings["podcast_spotify_image_link"]["url"] . '" style="padding: 10px;">
    		'. wp_get_attachment_image($settings["podcast_spotify_image"]["id"], "full", false, ["class" => "podcast-hero-image"] ).'</a>
    	</div>
    	</div>
    	<div class="col-6 lg-down">
    	<div>
   		 	'.wp_get_attachment_image($settings["podcast_bg_right"]["id"], "full", false, ["class" => "podcast-hero-image"] ).'
    	</div>
    	</div>
    	</div>
    	</div>
    	<div class="col-4 lg-up">
    	<div>
    		'. wp_get_attachment_image($settings["podcast_bg_right"]["id"], "full", false, ["class" => "podcast-hero-image"] ) .' </div>
    	</div>
    	</div>
    	</div>';

        // Podcast Feature Iframe Link

    	echo '<div class="corset">
    	<div class="row" style="justify-content:center">
    	<div class="col-6-xl col-8-lg col-10-md col-12">
    	<iframe src="' . $settings["podcast_featured_iframe_link"]["url"] . '" frameBorder="0" width="100%" height="400px" allow=" autoplay"></iframe>
    	</div>
    	</div>
    	</div>';
    }
}
