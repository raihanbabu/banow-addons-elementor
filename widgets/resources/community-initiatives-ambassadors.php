<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Community_Ambassadors_Widget extends \Elementor\Widget_Base {

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
        return "bn_community_ambassadors";
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
        return __("BN Community Ambassadors", "banow");
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

    protected function register_controls() {
        $this->start_controls_section(
            "community_ambassadors_section",
            [
                "label" => __("Hirers Ambassadors", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "community_ambassador_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Title", "banow"),
                "placeholder" => __("Type your Title", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "ambassadors_item_name",
            [
                "label" => __("Name", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Name", "banow"),
                "placeholder" => __("Type your Name", "banow"),
            ]
        );

        $repeater->add_control(
            "ambassadors_item_state",
            [
                "label" => __("State", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("State", "banow"),
                "placeholder" => __("Type your State", "banow"),
            ]
        );

        $repeater->add_control(
            "ambassadors_item_btn_link",
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
            "ambassadors_item_image",
            [
                "label" => __("Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "community_ambassadors_item_list",
            [
                "label" => __("Ambassadors List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "ambassadors_item_name" => __("Name #1", "banow"),
                        "ambassadors_item_state" => __("State #1", "banow"),
                    ],
                ],
                "title_field" => "{{{ ambassadors_item_name }}}",
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

        echo '<div class="corset margin-top community">
        <div class="row">
        <div class="col-12 col-10-lg ofs-1-lg">
        <h2 class="ta-c">' . $settings["community_ambassador_title"] . '</h2>
        <div class="community-amb-container">';

        if ($settings["community_ambassadors_item_list"]) {
            foreach ($settings["community_ambassadors_item_list"] as $ambassadors_item ) {
            	echo '<a href="' . $ambassadors_item["ambassadors_item_btn_link"]["url"] . '" class="community-amb" target="_blank">
               	 '. wp_get_attachment_image($ambassadors_item["ambassadors_item_image"]["id"], "full", false, ["class" => ""] ) .'
                <div class="community-amb-name">
            	   	'. $ambassadors_item["ambassadors_item_name"] .'
                </div>
                <div class="community-amb-state">
                	'. $ambassadors_item["ambassadors_item_state"] .'
                </div>
                </a>';
            }
        }

        echo '</div>
        </div>
        </div>
        </div>';
    }
}
