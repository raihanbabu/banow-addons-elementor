<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_About_Career_Showcases_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_career_showcases";
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
        return __("BN Career Showcases", "banow");
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
        return ["bn-career-showcases"];
    }

    // Style file add
    public function get_style_depends() {
        return [
            "bn-plugin",
            "bn-helpers",
            "bn-main",
            "bn-career",
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
            "career_showcases_section",
            [
                "label" => __("Career Showcases Content", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "career_showcases_title",
            [
                "label" => __("Career Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Career title", "banow"),
                "placeholder" => __("Type your Career title here", "banow"),
            ]
        );

        $this->add_control(
            "career_showcases_content",
            [
                "label" => __("Career Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Default Career Content", "banow"),
                "placeholder" => __("Type your Career Content here", "banow"),
            ]
        );

        $this->add_control(
            "career_showcases_link",
            [
                "label" => __("Video Link", "banow"),
                "type" => \Elementor\Controls_Manager::URL,
                "placeholder" => __("#", "banow"),
                "show_external" => true,
                "default" => [
                    "url" =>
                        "https://musoappuploads.s3.ap-southeast-2.amazonaws.com/uploads/showcase.mp4",
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

        echo '<div class="showcases__container">
        <div class="corset">
        <div class="row">
        <div class="col-5-lg">
        <h2 class="h2">' . $settings["career_showcases_title"] . '</h2>';

        echo $settings["career_showcases_content"];

        echo '</div>
        <div class="col-7-lg col">
	        <div class="fd-r jc-c ai-c">
		        <div id="showcase-video-container" class="showcases__video-container">
		        <video id="showcase-video" class="showcases__video">';

        echo '<source src="' . $settings["career_showcases_link"]["url"] . '" type="video/mp4" />';
        
        echo '</video>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>';
    }
}
