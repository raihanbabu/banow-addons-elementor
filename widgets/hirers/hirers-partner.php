<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Hirers_Partners_Widget extends \Elementor\Widget_Base {

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
        return "bn_hirers_partners";
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
        return __("BN Hirers Partners", "banow");
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

        // Main Title
        $this->start_controls_section(
            "hirers_main_title_section",
            [
                "label" => __("Partner Main Title", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_main_title",

            [
                "label" => __("Partner Main Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Partner Main Title", "banow"),
                "placeholder" => __("Type your Partner Main Title", "banow"),
            ]
        );

        $this->add_control(
            "hirers_main_title_image",
            [
                "label" => __("Partner Main Title Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
        // End Main Title

        // Hirers Companies
        $this->start_controls_section(
            "hirers_companies_section",
            [
                "label" => __("Hirers Companies Images", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_companies_title",
            [
                "label" => __("Hirers Companies Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Hirers Companies Title", "banow"),
                "placeholder" => __(
                    "Type your Hirers Companies Title",
                    "banow"
                ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hirers_companies_image",
            [
                "label" => __("Choose Hirers Companies Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "companies_image_list",
            [
                "label" => __("Images List", "banow"),
                "type" => \Elementor\Controls_Manager::REPEATER,
                "fields" => $repeater->get_controls(),
                "default" => [
                    [
                        "hirers_companies_image" => __(
                            "Companies Images",
                            "banow"
                        ),
                    ],
                ],
                "image_field" => "{{{ hirers_companies_image }}}",
            ]
        );

        $this->end_controls_section();
        // End Companies partner

        // Hirers partner
        $this->start_controls_section(
            "hirers_partners_section",
            [
                "label" => __("Hirers Partners Images", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "hirers_partners_title",
            [
                "label" => __("Hirers Partners Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Hirers Partners Title", "banow"),
                "placeholder" => __("Type your Hirers Partners Title", "banow"),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            "hirers_partners_image",
            [
                "label" => __("Choose Hirers Partners Image", "banow"),
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
                        "hirers_partners_image" => __(
                            "Partners Images",
                            "banow"
                        ),
                    ],
                ],
                "image_field" => "{{{ hirers_partners_image }}}",
            ]
        );
        $this->end_controls_section();

        // End Hirers partner
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
        <div class="partners-title" style="background-image: url(' . $settings["hirers_main_title_image"]["url"] . ')">' . $settings["hirers_main_title"] . '</div>
        <div class="logos">
        <div class="logos__heading">' . $settings["hirers_companies_title"] . '</div>
        <div class="logos__container">';

        if ($settings["companies_image_list"]) {
            foreach ($settings["companies_image_list"] as $companies_img) {
                echo '<img alt="Muso partner logo" class="logos__logo" src="' . $companies_img["hirers_companies_image"]["url"] . '" />';
            }
        }

        echo '</div>
        </div>
        <div class="logos">
        <div class="logos__heading">' . $settings["hirers_partners_title"] . '</div>
        <div class="logos__container">';

        if ($settings["partners_image_list"]) {
            foreach ($settings["partners_image_list"] as $partner_img) {
                echo '<img alt="Muso partner logo" class="logos__logo" src="' . $partner_img["hirers_partners_image"]["url"] . '" />';
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
