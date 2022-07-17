<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Community_Hero_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_community_hero";
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
        return __("BN Community Hero", "banow");
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

    public function get_script_depends() {
        return ["bn-community"];
    }

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
            "community_hero_section",
            [
                "label" => __("Hirers Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "community_hero_title",
            [
                "label" => __("Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Title", "banow"),
                "placeholder" => __("Type your Title", "banow"),
            ]
        );

        $this->add_control(
            "community_hero_content",
            [
                "label" => __("Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Content", "banow"),
                "placeholder" => __("Type your Content here", "banow"),
            ]
        );

        $this->add_control(
            "community_bg_image",
            [
                "label" => __("Background Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "community_hero_image",
            [
                "label" => __("Community Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "community_hero_image_list",
            [
                "label" => __("Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "community_hero_image" => __(
                            "Community Images",
                            "banow"
                        ),
                    ],
                ],
                "image_field" => "{{{ community_hero_image }}}",
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

        echo wp_get_attachment_image($settings["community_bg_image"]["id"], "full", false, ["class" => "community-saw md-up"] ) .'<div class="corset margin-top p-rel">
        <div class="community-cloud">';

        if ($settings["community_hero_image_list"]) {
            foreach ($settings["community_hero_image_list"] as $community_img) {
                echo wp_get_attachment_image($community_img["community_hero_image"]["id"], "full", false, ["class" => "js-artist community-cloud-artist", "style" => "border-radius: 50%", ] );
            }
        }

        echo '</div>
        <div class="row community-hero">
        <div class="col-12 ofs-1-lg">
        <h1>' . $settings["community_hero_title"] . '</h1>
        </div>
        <div class="community-hero-copy col-8-sm col-6-md col-5-lg ofs-1-lg">
        	'. $settings["community_hero_content"] .'
        </div>
        </div>
        </div>';
    }
}
