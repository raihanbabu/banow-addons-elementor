<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Rotpg_About_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_rotpg_about";
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
        return __("BN Rotpg About", "banow");
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
            "bn-rotpg-form",
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
            "rotpg_about_section",
            [
                "label" => __("Rotpg Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "rotpg_about_left_image",
            [
                "label" => __("Choose About Left Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "rotpg_about_left_content",
            [
                "label" => __("About Left Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("About Left Content", "banow"),
                "placeholder" => __("Type your Left Content", "banow"),
            ]
        );

        $this->add_control(
            "rotpg_about_right_image",
            [
                "label" => __("Choose About Right Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "rotpg_about_right_content",
            [
                "label" => __("About Right Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("About Right Content", "banow"),
                "placeholder" => __("Type your Right Content", "banow"),
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

        echo '<div class="rotpg__black-bg">
        <!-- RIP GOES HERE -->
        <div class="corset">
        <div class="pt-xxl row p-rel">
        <div style="top: -10vw" class="ofs-1-lg col-5-lg col-6-md col p-rel" >
        <img style="transform: rotate(10deg);" class="w-100" src="' . $settings["rotpg_about_left_image"]["url"] . '" />

        <div class="ta-j">

        '. $settings["rotpg_about_left_content"] .'
        </div>
        </div>
        <div class="col-5-lg col-6-md col fd-c jc-c">

        <img style="transform: rotate(-3deg);" class="w-100" src="' . $settings["rotpg_about_right_image"]["url"] . '" />

        <div class="mt-lg ta-j">

        '. $settings["rotpg_about_right_content"] .'

        </div>
        </div>
        </div>
        </div>
        </div>';
    }
}
