<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_About_Career_Team_Widget extends \Elementor\Widget_Base {
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
        return "bn_about_career_team";
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
        return __("BN Career Teams", "banow");
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
            "bn-working-at-muso",
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
            "content_careerteam_section",
            [
                "label" => __("The Career Team", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "careerteam_main_title",
            [
                "label" => __("The Career Main Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default title", "banow"),
                "placeholder" => __("Type your title here", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "careerteam_image",
            [
                "label" => __("Choose Team Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            "careerteam_name",
            [
                "label" => __("Team Name", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Team Name", "banow"),
                "placeholder" => __("Type your Team Name here", "banow"),
            ]
        );

        $repeater->add_control(
            "careerteam_title",
            [
                "label" => __("Team Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Default Team Title", "banow"),
                "placeholder" => __("Type your Team Title here", "banow"),
            ]
        );

        $this->add_control(
            "careerteam_list",
            [
                "label" => __("Team List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "careerteam_name" => __("Team #1", "banow"),
                        "careerteam_title" => __("Change team text.", "banow"),
                    ],
                ],
                "title_field" => "{{{ careerteam_name }}}",
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

        echo '<div class="corset mt-xl">
        		<h2 class="h2">' . $settings["careerteam_main_title"] . '</h2>
        			<div class="fd-r jc-sb fw-w ">';

		        if ($settings["careerteam_list"]) {
		            foreach ($settings["careerteam_list"] as $careerteam_item) {

		                echo '<div class="team-member__container">';

		                echo wp_get_attachment_image ($careerteam_item["careerteam_image"]["id"], "full", false );

		                echo '<div class="team-member__name">' . $careerteam_item["careerteam_name"] . '</div>
		                <div class="team-member__title">' . $careerteam_item["careerteam_title"] . '</div> </div>';
		            }
		        }

        echo '</div>
        </div>';
    }
}
