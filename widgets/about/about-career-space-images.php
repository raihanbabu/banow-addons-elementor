<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_About_Career_Space_Images_Widget extends \Elementor\Widget_Base {
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
        return "bn_career_space_images";
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
        return __("BN Career Space Images", "banow");
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
        // For The Core Team

        $this->start_controls_section(
            "content_careerspaceimage_section",
            [
                "label" => __("Career Spaces Images", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "content_careerspaceimage_main_title",
            [
                "label" => __("Career Spaces Images Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default title", "banow"),
                "placeholder" => __("Type your title here", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "careerteam_image",
            [
                "label" => __("Choose Space Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "careerimages_list",
            [
                "label" => __("Repeater List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "careerteam_image" => __("Space Image #1", "banow"),
                    ],
                ],

                "image_field" => "{{{ careerteam_image }}}",
            ]
        );
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

        echo '<div class="corset">
        	<h2 class="h2">' . $settings["content_careerspaceimage_main_title"] . '</h2>
        		<div class="space__container">';

        if ($settings["careerimages_list"]) {
            $num_img = 0;

            foreach ($settings["careerimages_list"] as $team_item) {

                if ($num_img == 4) {
                    $class_img = "md-up";
                } else {
                    $class_img = "";
                }

                echo '<img class="' . $class_img . " space__image space__image--" . $num_img++ . '" src="' . $team_item["careerteam_image"]["url"] . '" />';
            }
        }

        echo '</div></div>';
    }
}
