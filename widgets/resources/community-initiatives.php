<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Community_Initiatives_Widget extends \Elementor\Widget_Base {
	
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
    	return "bn_community_initiatives";
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
    	return __("BN Community Initiatives", "banow");
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

    // public function get_script_depends() {

    //   return [ 'bn-community' ];

    // }

    // Style file add
    public function get_style_depends() {
    	return [
    		"bn-plugin",
    		"bn-helpers",
    		"bn-main",
    		"bn-typography",
    		"bn-spacing",
    		"bn-community",
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

    protected function register_controls()
    {
    	$this->start_controls_section(
    		"community_initiatives_section",
    		[
    			"label" => __("Hirers Initiatives", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$this->add_control(
    		"community_initiatives_title",
    		[
    			"label" => __("Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Title", "banow"),
    			"placeholder" => __("Type your Title", "banow"),
    		]
    	);

    	$repeater = new \Elementor\Repeater();
    	$repeater->add_control(
    		"initiatives_item_title",
    		[
    			"label" => __("Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Title", "banow"),
    			"placeholder" => __("Type your Title", "banow"),
    		]
    	);

    	$repeater->add_control(
    		"initiatives_item_content",
    		[
    			"label" => __("Content", "banow"),
    			"type" => \Elementor\Controls_Manager::WYSIWYG,
    			"default" => __("Content", "banow"),
    			"placeholder" => __("Type your Content", "banow"),
    		]
    	);

    	$repeater->add_control(
    		"initiatives_item_btn",
    		[
    			"label" => __("Button", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Button", "banow"),
    			"placeholder" => __("Type your Button", "banow"),
    		]
    	);

    	$repeater->add_control(
    		"initiatives_item_btn_link",
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

    	$repeater->add_control(
    		"initiatives_item_image",
    		[
    			"label" => __("Image", "banow"),
    			"type" => \Elementor\Controls_Manager::MEDIA,
    			"default" => [
    				"url" => \Elementor\Utils::get_placeholder_image_src(),
    			],
    		]
    	);

    	$this->add_control(
    		"community_initiatives_image_list",
    		[
    			"label" => __("Images List", "banow"),
    			"type" => \Elementor\Controls_Manager::REPEATER,
    			"fields" => $repeater->get_controls(),
    			"default" => [
    				[
    					"initiatives_item_title" => __(
    						"Initiatives Title #1",
    						"banow"
    					),
    				],
    			],
    			"title_field" => "{{{ initiatives_item_title }}}",
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

    protected function render()
    {
    	$settings = $this->get_settings_for_display();

    	echo '<div class="corset margin-top community">
    	<div class="row">
    	<div class="col-12 col-10-lg ofs-1-lg">
    	<h3>' . $settings["community_initiatives_title"] . '</h3>';

    	if ($settings["community_initiatives_image_list"]) {

    		foreach ($settings["community_initiatives_image_list"] as $initiatives_item ) {

    			echo '<div class="row community-initiative">
    			<div class="col-4 md-up">
    			<div>';

    			echo wp_get_attachment_image($initiatives_item["initiatives_item_image"]["id"], "full", false, ["class" => "community-image"] );

    			echo '</div>
    			</div>
    			<div class="col-12 col-8-md">
    			<h4>' . $initiatives_item["initiatives_item_title"] . '</h4>

    			<div class="md-down">

    			'. wp_get_attachment_image($initiatives_item["initiatives_item_image"]["id"], "full", false, ["class" => "community-image"] ) .'

    			</div>

    			'. $initiatives_item["initiatives_item_content"].'

    			<div>';

    			empty($initiatives_item["initiatives_item_btn_link"]["url"]) ? ($class = "btn--disabled") : ($class = "");

    			echo '<a class="btn btn--cta ' . $class . '" target="_blank" href="' . $initiatives_item["initiatives_item_btn_link"]["url"] . '">

    			'. $initiatives_item["initiatives_item_btn"] .'

    			</a>
    			</div>
    			</div>
    			</div>';
    		}
    	}

    	echo '</div>
    	</div>
    	</div>';
    }
}
