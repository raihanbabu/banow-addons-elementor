<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Faqs_Widget extends \Elementor\Widget_Base {
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
  	return "bn_faqs";
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
  	return __("BN FAQs", "banow");
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

    // Script file add

    public function get_script_depends() {
    	return ["bn-faqs"];
    }

    // Style file add

    public function get_style_depends() {
    	return [
    		"bn-plugin",
    		"bn-helpers",
    		"bn-main",
    		"bn-typography",
    		"bn-spacing",
    		"bn-faqs",
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
    		"artist_faqs_section",
    		[
    			"label" => __("FAQs Artists", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$this->add_control(
    		"faqs_main_title",
    		[
    			"label" => __("Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("FAQs", "banow"),
    			"placeholder" => __("FAQs Title", "banow"),
    		]
    	);

    	$repeater = new \Elementor\Repeater();

    	$repeater->add_control(
    		"artists_faqs_title",
    		[
    			"label" => __("Artists Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Artists Title", "banow"),
    			"placeholder" => __("Type your Artists Title", "banow"),
    		]
    	);

    	$repeater->add_control(
    		"artists_faqs_content",
    		[
    			"label" => __("Artists Content", "banow"),
    			"type" => \Elementor\Controls_Manager::WYSIWYG,
    			"default" => __("Artists Content", "banow"),
    			"placeholder" => __("Type your Artists Content", "banow"),
    		]
    	);

    	$this->add_control(
    		"faqs_content_artists_tab_lists",
    		[
    			"label" => __("Tab List", "banow"),
    			"type" => \Elementor\Controls_Manager::REPEATER,
    			"fields" => $repeater->get_controls(),
    			"default" => [
    				[
    					"artists_faqs_title" => __(
    						"Artists Title #1",
    						"banow"
    					),

    					"artists_faqs_content" => __(
    						"Artists Content #1",
    						"banow"
    					),
    				],
    			],

    			"title_field" => "{{{ artists_faqs_title }}}",
    		]
    	);

    	$this->end_controls_section();

    	$this->start_controls_section(
    		"artist_hirers_faqs_section",
    		[
    			"label" => __("FAQs Hirers", "banow"),
    			"tab" => \Elementor\Controls_Manager::TAB_CONTENT,
    		]
    	);

    	$repeater = new \Elementor\Repeater();

    	$repeater->add_control(
    		"hirers_faqs_title",
    		[
    			"label" => __("Hirers Title", "banow"),
    			"type" => \Elementor\Controls_Manager::TEXT,
    			"default" => __("Hirers Title", "banow"),
    			"placeholder" => __("Type your Hirers Title", "banow"),
    		]
    	);

    	$repeater->add_control(
    		"hirers_faqs_content",
    		[
    			"label" => __("Hirers Content", "banow"),
    			"type" => \Elementor\Controls_Manager::WYSIWYG,
    			"default" => __("Hirers Content", "banow"),
    			"placeholder" => __("Type your Hirers Content", "banow"),
    		]
    	);

    	$this->add_control(
    		"faqs_content_hirers_tab_lists",

    		[
    			"label" => __("Tab List", "banow"),
    			"type" => \Elementor\Controls_Manager::REPEATER,
    			"fields" => $repeater->get_controls(),
    			"default" => [
    				[
    					"hirers_faqs_title" => __(
    						"Hirers Title #1",
    						"banow"
    					),

    					"hirers_faqs_content" => __(
    						"Hirers Content #1",
    						"banow"
    					),
    				],
    			],

    			"title_field" => "{{{ hirers_faqs_title }}}",
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
    	echo '<div class="corset margin-top faqs">
    			<div class="row">
    				<div class="col ofs-0 col-10-md ofs-1-md col-8-lg ofs-2-lg">
    					<h1>' . get_the_title( ) . '</h1>
    					<div id="faqs-switch" class="faqs-switch" data-selected="artists">
	    					<div class="faqs-switch-thumb"></div>
	    					<div class="faqs-switch-option" data-option="artists" onclick="setFaqsMode(\'artists\')">Artists</div>
	    					<div class="faqs-switch-option" data-option="hirers" onclick="setFaqsMode(\'hirers\')">Hirers</div>
    					</div>
    				<div id="faqs-body-container" class="p-rel o-h">
    				<div id="faqs-artists" class="faqs-body">';

			    	if ($settings["faqs_content_artists_tab_lists"]) {

			    		foreach ( $settings["faqs_content_artists_tab_lists"] as $artists_content ) {
			    			echo '<div class="faqs-q">
			    				<h3>' . $artists_content["artists_faqs_title"] . '</h3>
			    				<div class="faqs-expander"></div>
			    				<div class="faqs-a">
			    				 '. $artists_content["artists_faqs_content"] .'
			    			</div>
			    			</div>';
			    		}
			    	}

			    	echo '</div>
			    	<div id="faqs-hirers" class="faqs-body">';

			    	if ($settings["faqs_content_hirers_tab_lists"]) {
			    		foreach ( $settings["faqs_content_hirers_tab_lists"] as $artists_content ) {

			    			echo '<div class="faqs-q">
			    			<h3>'. $artists_content["hirers_faqs_title"] . '</h3>
			    			<div class="faqs-expander"></div>
			    			<div class="faqs-a">
			    				'. $artists_content["hirers_faqs_content"] .'
			    			</div>
			    			</div>';
			    		}
			    	}

			    	echo "</div>
			    	</div>
			    </div>
			</div>
		</div>";
    }
}
