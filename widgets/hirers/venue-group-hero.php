<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class Elementor_Venue_Group_Widget extends \Elementor\Widget_Base {
    
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
        return "bn_venue_group_hero";
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
        return __("BN Venue Group", "banow");
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
            "bn-hero-venu",
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
            "venue_group_section",
            [
                "label" => __("Venue Group Hero", "banow"),
                "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            "venue_group_title",
            [
                "label" => __("Venue Group Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Venue Group Title", "banow"),
                "placeholder" => __("Type your Venue Group Title", "banow"),
            ]
        );

        $this->add_control(
            "venue_group_image",
            [
                "label" => __("Choose Venue Group Image", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "venue_group_image_for_mobile",
            [
                "label" => __("Choose Venue Group Image For Mobile", "banow"),
                "type" => \Elementor\Controls_Manager::MEDIA,
                "default" => [
                    "url" => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            "venue_group_content",
            [
                "label" => __("Venue Group Content", "banow"),
                "type" => \Elementor\Controls_Manager::WYSIWYG,
                "default" => __("Venue Group Content", "banow"),
                "placeholder" => __("Type your Venue Group Content", "banow"),
            ]
        );

        $this->add_control(
            "venue_group_box_title",
            [
                "label" => __("Venue Group Box Title", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Venue Group Box Title", "banow"),
                "placeholder" => __("Type your Venue Group Box Title", "banow"),
            ]
        );

        $this->add_control(
            "venue_group_btn_title",
            [
                "label" => __("Venue Group Button", "banow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => __("Venue Group Button", "banow"),
                "placeholder" => __("Type your Venue Group Button", "banow"),
            ]
        );

        $this->add_control(
            "venue_group_btn_link",
            [
                "label" => __("Venue Group Link", "banow"),
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

        echo '<div class="corset margin-top fg-1 fd-c jc-c venue-group">
        <div class="row p-rel">

        <div class="col-12 for-mobile">
            <img class="groups__hero-image-mobile" src="' . $settings["venue_group_image_for_mobile"]["url"] . '" alt="Multiple laptops and smartphones displaying various Muso features."/>
        </div>

        <div class="col-6 ofs-6 p-abs h-100 for-desktop">
        <div class="p-rel h-100">

        <img class="groups__hero-image" src="' . $settings["venue_group_image"]["url"] . '" alt="Multiple laptops and smartphones displaying various Muso features."/>
        </div>
        </div>
        <div class="col col-10-md col-8-lg col-6-xl">
        	<h1 class="groups__title">' . $settings["venue_group_title"] . '</h1>
        <div class="groups__hero-details">

        	'. $settings["venue_group_content"] .'

        <div class="brand-block groups__hero-cta-container">

        <div> ' . $settings["venue_group_box_title"] . '</div>

        <a class="groups__hero-cta" href="' . $settings["venue_group_btn_link"]["url"] . '" target="_blank">' . $settings["venue_group_btn_title"] . '</a>
        </div>
        </div>
        </div>
        </div>
        </div><style>
            .for-mobile {display: none;}
             @media screen and (max-width: 1079px) {
                .for-desktop {display: none;}
                .for-mobile {display: block;}
                .lp .margin-top{margin-top: 60px !important;}
            }
        </style>';
    }
}
