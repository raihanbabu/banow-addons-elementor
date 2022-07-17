<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Artists_Partners_Widget extends \Elementor\Widget_Base {

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
        return "bn_artists_partners";
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
        return __("BN Artists Partners", "banow");
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
            "bn-artis-hero",
            "bn-artis-sign-up",
            "bn-partners",
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
            "artist_partners_section",
            [
                "label" => __("Artists Partners Images", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "artist_partners_title",
            [
                "label" => __("Artists Partners Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Artists Partners Title", "banow"),
                "placeholder" => __(
                    "Type your Artists Partners Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "artist_partners_image",
            [
                "label" => __("Choose Artists Partners Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "partners_image_list",
            [
                "label" => __("Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "artist_partners_image" => __("Partners Images", "banow"),
                    ],
                ],
                "image_field" => "{{{ artist_partners_image }}}",
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

        echo '<div class="lp-full-block lp-partners margin-bottom">
        <div class="corset jc-c">
        <div class="row">
        <div class="col-12 jc-c">
        <div class="logos">
        <div class="logos__heading">' .
            $settings["artist_partners_title"] .
            '</div>
            <div class="logos__container">';

        if ($settings["partners_image_list"]) {
            foreach ($settings["partners_image_list"] as $partner_item) {
                echo wp_get_attachment_image( $partner_item["artist_partners_image"]["id"], "full", false, ["class" => "logos__logo"] );
            }
        }

        echo '</div>
        </div>
        </div>
        </div>
        </div>
        </div>';
    }
}
