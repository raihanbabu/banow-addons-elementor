<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Hirers_Promote_Widget extends \Elementor\Widget_Base {

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
        return "bn_hirers_promote";
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
        return __("BN Hirers Promote", "banow");
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
            "bn-promo-widget",
            "bn-buttons",
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
            "hirers_promote_section",
            [
                "label" => __("Five Star Review", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_promote_title",
            [
                "label" => __("Promote Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Promote Title", "banow"),
                "placeholder" => __("Type your Promote Title", "banow"),
            ]
        );

        $this->add_control(
            "hirers_promote_btn_title",
            [
                "label" => __("Promote Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Promote Button", "banow"),
                "placeholder" => __("Type your Promote Button", "banow"),
            ]
        );

        $this->add_control(
            "hirers_promote_btn_link",
            [
                "label" => __("Promote Button Link", "banow"),
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hirers_promote_image",
            [
                "label" => __("Choose Promote Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "hirers_promote_image_list",
            [
                "label" => __("Promote Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "hirers_promote_image" => __("Promote Images", "banow"),
                    ],
                ],
                "image_field" => "{{{ hirers_promote_image }}}",
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

        echo '<div id="lp-fsr" class="corset lp-fsr margin-top">
        <div class="row">
        <div class="col-8-xl ofs-2-xl col-10-lg ofs-1-lg col-12 ofs-0">
        <div class="fd-r">
        <div class="h1 ta-l">
	        '. $settings["hirers_promote_title"] .'
        </div>
        
        <div class="fd-c jc-fe">
        <a class="btn btn--white mb-md ml-lg" href="' . $settings["hirers_promote_btn_link"]["url"] . '">' . $settings["hirers_promote_btn_title"] . '</a>
        </div>
        </div>
        </div>
        </div>
        <div class="row p-rel">
        <div class="lp-widget__container" style="font-size: 11px;">';

        if ($settings["hirers_promote_image_list"]) {
            foreach ($settings["hirers_promote_image_list"] as $promote_image) {
                echo wp_get_attachment_image($promote_image["hirers_promote_image"]["id"], "full", false, ["class" => "mx-xs"] );
            }
        }

        echo '</div>
        </div>
        </div>';
    }
}
